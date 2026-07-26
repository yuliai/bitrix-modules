<?php

use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Vibecodeconnector\Infrastructure\Service\Catalog\OpenApp\OpenAppLayoutService;
use Bitrix\Vibecodeconnector\Internal\Integration\Main\MainPortalFieldsProvider;
use Bitrix\Vibecodeconnector\Internal\Integration\Rest\BotWebhookGateway;
use Bitrix\Vibecodeconnector\Internal\Integration\Socialservices\NetworkService;
use Bitrix\Vibecodeconnector\Internal\Repository\Pairing\PairingRepository;
use Bitrix\Vibecodeconnector\Internal\Service\Auth\CloudSharedVerifier;
use Bitrix\Vibecodeconnector\Internal\Service\Auth\IncomingJwtVerifier;
use Bitrix\Vibecodeconnector\Internal\Service\Bot\BotService;
use Bitrix\Vibecodeconnector\Internal\Service\Bot\TokenGenerator;
use Bitrix\Vibecodeconnector\Internal\Service\Catalog\OpenApp\OpenAppLayoutRenderer;
use Bitrix\Vibecodeconnector\Internal\Service\Catalog\OpenApp\OpenAppPayloadBuilder;
use Bitrix\Vibecodeconnector\Internal\Service\Catalog\OpenApp\OpenAppSettings;
use Bitrix\Vibecodeconnector\Internal\Service\Catalog\Vibecode\CatalogItemSender;
use Bitrix\Vibecodeconnector\Internal\Service\Diagnostic\IncomingJwtLog;
use Bitrix\Vibecodeconnector\Internal\Service\Endpoint\BaseEndpointProvider;
use Bitrix\Vibecodeconnector\Internal\Service\Endpoint\CloudEndpointProvider;
use Bitrix\Vibecodeconnector\Internal\Service\Endpoint\EndpointUrlGuard;
use Bitrix\Vibecodeconnector\Internal\Service\PublicKey\CloudKeySourceSettings;
use Bitrix\Vibecodeconnector\Internal\Service\PublicKey\CloudSharedKeyRefresher;
use Bitrix\Vibecodeconnector\Internal\Service\PublicKey\CloudSharedKeyStore;
use Bitrix\Vibecodeconnector\Internal\Service\PublicKey\PairingKeyRefresher;
use Bitrix\Vibecodeconnector\Internal\Service\PublicKey\PublicKeyFetcherFactory;
use Bitrix\Vibecodeconnector\Internal\Service\Registration\PairingSettings;
use Bitrix\Vibecodeconnector\Internal\Service\Provisioning\PermissionSource\Policy as PermissionSourcePolicy;
use Bitrix\Vibecodeconnector\Internal\Service\Provisioning\PermissionSource\Settings as PermissionSourceSettings;
use Bitrix\Vibecodeconnector\Internal\Service\Registration\RegistrationService;
use Bitrix\Vibecodeconnector\Public\Service\AvailabilityService;

return [
	'controllers' => [
		'value' => [
			'defaultNamespace' => '\\Bitrix\\Vibecodeconnector\\Infrastructure\\Controller',
		],
		'readonly' => true,
	],
	'rest' => [
		'value' => [
			'defaultNamespace' => '\\Bitrix\\Vibecodeconnector\\Infrastructure\\Rest\\Controller',
		],
		'readonly' => true,
	],
	'services' => [
		'value' => [
			NetworkService::class => [
				'className' => NetworkService::class,
			],
			BaseEndpointProvider::class => [
				'className' => BaseEndpointProvider::class,
			],
			CloudEndpointProvider::class => [
				'constructor' => static function () {
					return new CloudEndpointProvider(
						ServiceLocator::getInstance()->get(BaseEndpointProvider::class),
					);
				},
			],
			PairingRepository::class => [
				'className' => PairingRepository::class,
			],
			PairingSettings::class => [
				'className' => PairingSettings::class,
			],
			EndpointUrlGuard::class => [
				'className' => EndpointUrlGuard::class,
			],
			CloudSharedKeyStore::class => [
				'className' => CloudSharedKeyStore::class,
			],
			CloudSharedVerifier::class => [
				'constructor' => static function () {
					return new CloudSharedVerifier(
						new CloudSharedKeyStore(),
					);
				},
			],
			CloudKeySourceSettings::class => [
				'className' => CloudKeySourceSettings::class,
			],
			PublicKeyFetcherFactory::class => [
				'className' => PublicKeyFetcherFactory::class,
			],
			CloudSharedKeyRefresher::class => [
				'constructor' => static function () {
					return new CloudSharedKeyRefresher(
						ServiceLocator::getInstance()->get(CloudEndpointProvider::class),
						new CloudKeySourceSettings(),
						new PublicKeyFetcherFactory(),
						new CloudSharedKeyStore(),
					);
				},
			],
			PairingKeyRefresher::class => [
				'constructor' => static function () {
					return new PairingKeyRefresher(
						new PairingRepository(),
						new PublicKeyFetcherFactory(),
						new PairingSettings(),
					);
				},
			],
			IncomingJwtVerifier::class => [
				'constructor' => static function () {
					return new IncomingJwtVerifier(
						new PairingRepository(),
						new CloudSharedVerifier(
							new CloudSharedKeyStore(),
						),
						new PairingKeyRefresher(
							new PairingRepository(),
							new PublicKeyFetcherFactory(),
							new PairingSettings(),
						),
					);
				},
			],
			RegistrationService::class => [
				'constructor' => static function () {
					return new RegistrationService(
						new PairingRepository(),
						new PairingSettings(),
						new CloudSharedVerifier(
							new CloudSharedKeyStore(),
						),
					);
				},
			],
			TokenGenerator::class => [
				'className' => TokenGenerator::class,
			],
			BotService::class => [
				'constructor' => static function () {
					return new BotService(
						new BaseEndpointProvider(),
						new TokenGenerator(),
						new BotWebhookGateway(),
					);
				},
			],
			CatalogItemSender::class => [
				'constructor' => static function () {
					return new CatalogItemSender(
						ServiceLocator::getInstance()->get(BaseEndpointProvider::class),
						new PairingRepository(),
						new NetworkService(),
					);
				},
			],
			OpenAppSettings::class => [
				'className' => OpenAppSettings::class,
			],
			MainPortalFieldsProvider::class => [
				'className' => MainPortalFieldsProvider::class,
			],
			OpenAppPayloadBuilder::class => [
				'constructor' => static function () {
					return new OpenAppPayloadBuilder(
						ServiceLocator::getInstance()->get(BaseEndpointProvider::class),
						ServiceLocator::getInstance()->get(PairingRepository::class),
						ServiceLocator::getInstance()->get(MainPortalFieldsProvider::class),
					);
				},
			],
			OpenAppLayoutRenderer::class => [
				'className' => OpenAppLayoutRenderer::class,
			],
			OpenAppLayoutService::class => [
				'constructor' => static function () {
					return new OpenAppLayoutService(
						ServiceLocator::getInstance()->get(OpenAppSettings::class),
						new \Bitrix\Vibecodeconnector\Internal\Repository\Catalog\CatalogItemRepository(),
						ServiceLocator::getInstance()->get(OpenAppPayloadBuilder::class),
						ServiceLocator::getInstance()->get(OpenAppLayoutRenderer::class),
						new \Bitrix\Vibecodeconnector\Internal\Integration\Main\AccessCodes(),
					);
				},
			],
			AvailabilityService::class => [
				'constructor' => static function () {
					return new AvailabilityService(
						new PairingRepository(),
						new CloudSharedVerifier(
							new CloudSharedKeyStore(),
						),
					);
				},
			],
			IncomingJwtLog::class => [
				'className' => IncomingJwtLog::class,
			],
			PermissionSourceSettings::class => [
				'className' => PermissionSourceSettings::class,
			],
			PermissionSourcePolicy::class => [
				'constructor' => static function () {
					return new PermissionSourcePolicy(
						new PermissionSourceSettings(),
					);
				},
			],
		],
		'readonly' => true,
	],
];

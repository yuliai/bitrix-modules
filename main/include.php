<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2024 Bitrix
 */

use Bitrix\Main;
use Bitrix\Main\Session\Legacy\HealerEarlySessionStart;
use Bitrix\Main\DI\ServiceLocator;

require_once __DIR__ . "/start.php";

$application = Main\HttpApplication::getInstance();
$application->initializeExtendedKernel([
	"get" => $_GET,
	"post" => $_POST,
	"files" => $_FILES,
	"cookie" => $_COOKIE,
	"server" => $_SERVER,
	"env" => $_ENV
]);

if (class_exists('\Dev\Main\Migrator\ModuleUpdater'))
{
	\Dev\Main\Migrator\ModuleUpdater::checkUpdates('main', __DIR__);
}

if (!Main\ModuleManager::isModuleInstalled('bitrix24'))
{
	// wwall rules
	(new Main\Security\W\WWall)->handle();

	$application->addBackgroundJob([
		Main\Security\W\WWall::class, 'refreshRules'
	]);

	// vendor security notifications
	$application->addBackgroundJob([
		Main\Security\Notifications\VendorNotifier::class, 'refreshNotifications'
	]);
}

if (defined('SITE_ID'))
{
	define('LANG', SITE_ID);
}

$context = $application->getContext();
$context->initializeCulture(defined('LANG') ? LANG : null, defined('LANGUAGE_ID') ? LANGUAGE_ID : null);

// needs to be after culture initialization
$application->start();

// Register main's services
ServiceLocator::getInstance()->registerByModuleSettings('main');

// constants for compatibility
$culture = $context->getCulture();
define('SITE_CHARSET', $culture->getCharset());
define('FORMAT_DATE', $culture->getFormatDate());
define('FORMAT_DATETIME', $culture->getFormatDatetime());
define('LANG_CHARSET', SITE_CHARSET);

$site = $context->getSiteObject();
if (!defined('LANG'))
{
	define('LANG', ($site ? $site->getLid() : $context->getLanguage()));
}
define('SITE_DIR', ($site ? $site->getDir() : ''));
if (!defined('SITE_SERVER_NAME'))
{
	define('SITE_SERVER_NAME', ($site ? $site->getServerName() : ''));
}
define('LANG_DIR', SITE_DIR);

if (!defined('LANGUAGE_ID'))
{
	define('LANGUAGE_ID', $context->getLanguage());
}
define('LANG_ADMIN_LID', LANGUAGE_ID);

if (!defined('SITE_ID'))
{
	define('SITE_ID', LANG);
}

/** @global $lang */
$lang = $context->getLanguage();

//define global application object
$GLOBALS["APPLICATION"] = new CMain;

if (!defined("POST_FORM_ACTION_URI"))
{
	define("POST_FORM_ACTION_URI", htmlspecialcharsbx(GetRequestUri()));
}

$GLOBALS["MESS"] = [];
$GLOBALS["ALL_LANG_FILES"] = [];
IncludeModuleLangFile(__DIR__."/tools.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR | E_PARSE) & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE);

if (!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") != "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

// global functions
require_once __DIR__ . "/filter_tools.php";

/*ZDUyZmZYzFiNWFhOTY4ZGM0MDhiOWQ3OWQyZmQ5Y2M5YzcxYjI=*/$GLOBALS['_____476068173']= array(base64_decode('R'.'2V0TW'.'9kdWxl'.'RXZlb'.'n'.'Rz'),base64_decode('RXh'.'lY3'.'V'.'0ZU1vZ'.'HVsZUV'.'2ZW5'.'0RXg='),base64_decode('V3'.'JpdGV'.'G'.'aW5hb'.'E1lc3'.'Nh'.'Z2U'.'='));$GLOBALS['____1094180131']= array(base64_decode(''.'ZGVmaW5l'),base64_decode('Ym'.'FzZTY0X'.'2R'.'l'.'Y29'.'kZQ=='),base64_decode('dW'.'5zZ'.'XJpYWx'.'pe'.'mU='),base64_decode(''.'aXN'.'f'.'YX'.'J'.'yYXk='),base64_decode('aW5fYX'.'JyYX'.'k='),base64_decode('c2'.'V'.'yaWFsa'.'Xpl'),base64_decode('YmFzZTY0X2'.'VuY29kZQ'.'=='),base64_decode('bW'.'t0aW1l'),base64_decode('ZGF0'.'ZQ='.'='),base64_decode('ZGF0'.'ZQ=='),base64_decode('c3RybG'.'Vu'),base64_decode('bWt0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('Z'.'G'.'F'.'0ZQ=='),base64_decode('bW'.'V'.'0aG9k'.'X2'.'V4aXN0cw='.'='),base64_decode(''.'Y2FsbF'.'91c2VyX2Z1bmNfYXJyYXk='),base64_decode('c3Ry'.'bGVu'),base64_decode('c2VyaWF'.'saX'.'pl'),base64_decode('Ym'.'Fz'.'ZTY0'.'X2VuY'.'29kZQ=='),base64_decode('c3RybGV'.'u'),base64_decode(''.'a'.'XNfY'.'XJyYX'.'k='),base64_decode('c2VyaWFs'.'aXp'.'l'),base64_decode('Y'.'mFzZTY0X2V'.'uY29'.'kZQ'.'=='),base64_decode('c2VyaWFsaXpl'),base64_decode('Ym'.'FzZT'.'Y0X'.'2VuY2'.'9'.'kZQ='.'='),base64_decode('aXNfYXJy'.'Y'.'Xk'.'='),base64_decode(''.'aX'.'NfYXJy'.'YXk='),base64_decode('a'.'W'.'5fYXJy'.'Y'.'Xk='),base64_decode('aW'.'5fYXJyYX'.'k='),base64_decode(''.'bWt0aW1l'),base64_decode('ZGF'.'0ZQ=='),base64_decode('ZG'.'F0ZQ=='),base64_decode('ZGF0Z'.'Q=='),base64_decode('bWt0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode(''.'aW5fY'.'XJyYXk='),base64_decode('c2Vya'.'WFsaXpl'),base64_decode('Ym'.'FzZ'.'TY'.'0X2VuY29'.'kZQ=='),base64_decode('a'.'W5'.'0dmFs'),base64_decode('dGltZQ=='),base64_decode('ZmlsZV9leG'.'l'.'zdHM'.'='),base64_decode('c3RyX3JlcG'.'xhY2'.'U='),base64_decode('Y2x'.'h'.'c3NfZXhp'.'c3Rz'),base64_decode('Z'.'GVmaW5l'),base64_decode('c'.'3RycmV2'),base64_decode('c3'.'RydG91c'.'HBlc'.'g=='),base64_decode('c3B'.'yaW50Z'.'g=='),base64_decode('c'.'3ByaW'.'5'.'0Z'.'g=='),base64_decode('c'.'3V'.'ic3Ry'),base64_decode('c3'.'Ryc'.'mV2'),base64_decode('Ym'.'FzZT'.'Y'.'0X2RlY2'.'9kZQ='.'='),base64_decode('c'.'3Vic3Ry'),base64_decode(''.'c3RybGVu'),base64_decode('c3Ry'.'bGVu'),base64_decode('Y'.'2hy'),base64_decode(''.'b3'.'Jk'),base64_decode('b3Jk'),base64_decode('bWt0a'.'W'.'1'.'l'),base64_decode('aW5'.'0dmFs'),base64_decode('aW'.'50dmF'.'s'),base64_decode('aW50'.'dmFs'),base64_decode('a3Nvcn'.'Q='),base64_decode('c3Vic3Ry'),base64_decode('aW1wbG9kZQ'.'=='),base64_decode('ZG'.'Vm'.'aW5lZA='.'='),base64_decode('Ym'.'FzZTY0X2'.'Rl'.'Y29'.'kZQ=='),base64_decode('Y2'.'9uc3'.'Rhb'.'n'.'Q='),base64_decode('c3Ryc'.'m'.'V2'),base64_decode('c3ByaW50Z'.'g=='),base64_decode(''.'c3'.'R'.'ybGVu'),base64_decode('c3Ry'.'bGVu'),base64_decode(''.'Y2h'.'y'),base64_decode('b'.'3Jk'),base64_decode(''.'b3J'.'k'),base64_decode('bW'.'t0aW1'.'l'),base64_decode('aW50dm'.'Fs'),base64_decode('aW50dm'.'Fs'),base64_decode('a'.'W50dmFs'),base64_decode('c3Vic3Ry'),base64_decode('c3V'.'ic3R'.'y'),base64_decode('ZGVmaW'.'5lZA='.'='),base64_decode('c3Ry'.'cmV2'),base64_decode('c3R'.'y'.'dG91cHBlcg=='),base64_decode(''.'dGltZQ'.'=='),base64_decode(''.'bWt0'.'aW1'.'l'),base64_decode('b'.'Wt0aW1l'),base64_decode('Z'.'GF0'.'ZQ'.'=='),base64_decode(''.'ZGF0Z'.'Q=='),base64_decode('ZGVma'.'W5l'),base64_decode('ZG'.'Vma'.'W5l'));if(!function_exists(__NAMESPACE__.'\\___2124062244')){function ___2124062244($_459528685){static $_851366313= false; if($_851366313 == false) $_851366313=array(''.'SU5UUkFORVRfR'.'URJVElP'.'Tg==','WQ==','bWFp'.'bg==','fmNwZl'.'9tYX'.'Bfd'.'mFs'.'d'.'W'.'U=','','',''.'YWxsb'.'3d'.'lZF'.'9jbGFzc2'.'Vz','ZQ='.'=',''.'Zg==','ZQ'.'==','Rg==','WA==','Zg==',''.'bWFpb'.'g==','fmN'.'wZl9tYXB'.'f'.'dmF'.'sdWU=','UG9ydG'.'Fs','Rg==','ZQ'.'==',''.'Z'.'Q==','WA==','R'.'g==','R'.'A==','RA==','bQ==',''.'ZA='.'=','W'.'Q==','Z'.'g==','Zg==',''.'Zg'.'==','Zg==',''.'UG9ydGFs','Rg='.'=','ZQ==',''.'ZQ==','WA==','Rg==','R'.'A==','RA==','bQ==',''.'ZA==','W'.'Q'.'==','bWFpb'.'g==',''.'T2'.'4=','U2V'.'0dG'.'l'.'uZ'.'3NDaG'.'FuZ2U=','Zg==','Zg==','Zg'.'='.'=','Zg==','bW'.'F'.'p'.'b'.'g='.'=',''.'f'.'m'.'NwZl9'.'tYXBfdmFsdWU=',''.'ZQ'.'==','ZQ==',''.'R'.'A==','ZQ==','ZQ==','Zg==','Zg==','Zg'.'==','ZQ==','bWFpbg==',''.'fmNwZl'.'9tY'.'XB'.'fdmF'.'sdWU=','ZQ='.'=','Zg==','Zg='.'=','Zg==',''.'Zg'.'==',''.'bWF'.'pbg='.'=','fmNwZl9'.'t'.'YXBfdmF'.'sdWU=','ZQ==','Zg'.'==','UG9y'.'dG'.'Fs','UG9ydGFs','ZQ==','ZQ='.'=','UG9'.'y'.'dGFs',''.'R'.'g==','WA==','Rg==','RA==','ZQ==','ZQ'.'==',''.'R'.'A==','bQ'.'==','ZA==',''.'WQ==',''.'ZQ='.'=','WA==','ZQ==','Rg==','ZQ'.'==','R'.'A==','Z'.'g==','ZQ==','RA==','Z'.'Q==','bQ==','ZA='.'=','WQ==','Z'.'g==','Zg==','Zg='.'=','Z'.'g==','Z'.'g'.'='.'=','Zg'.'==','Zg==',''.'Zg==','bWFpbg==','fmNwZl9'.'t'.'Y'.'XBf'.'dmF'.'sdWU=','Z'.'Q'.'==','ZQ==','UG9'.'y'.'dG'.'Fs','Rg==','WA='.'=','VF'.'lQRQ==','RE'.'FURQ='.'=','RkVBVF'.'VSR'.'VM=','RVhQS'.'VJ'.'FRA==','VFlQR'.'Q'.'='.'=','RA'.'==','VFJZX0RBWVNfQ09VTlQ=',''.'R'.'EFURQ==',''.'VF'.'JZX0'.'RBWVN'.'fQ09VTlQ'.'=','RVhQSV'.'JF'.'RA==','RkVBV'.'FVSRVM=','Z'.'g==','Z'.'g='.'=','RE9DVU1F'.'T'.'lRfUk9PVA='.'=','L2JpdHJp'.'eC9t'.'b2R'.'1b'.'GV'.'z'.'Lw==','L'.'2l'.'uc3Rh'.'bGwvaW5'.'kZXgu'.'cGh'.'w','Lg==','Xw'.'==','c2Vhc'.'mNo','Tg==','','','QUNUS'.'VZF','W'.'Q==','c29j'.'aWFsbmV0d29yaw==','YW'.'xsb3dfZnJp'.'ZWxkcw==','WQ='.'=','S'.'U'.'Q=','c'.'2'.'9j'.'aWFsbmV0d'.'29yaw==','YWxsb3dfZnJ'.'pZWxk'.'c'.'w==','S'.'UQ=','c29jaW'.'Fsb'.'mV'.'0d29y'.'aw==',''.'Y'.'Wxsb'.'3dfZ'.'nJpZWxkcw==','Tg==','','','Q'.'U'.'N'.'USV'.'Z'.'F','WQ==','c'.'29'.'jaWFsbmV0d'.'29yaw==','Y'.'W'.'x'.'sb3dfb'.'Wljcm9'.'ibG9nX3VzZXI=','WQ='.'=','SUQ'.'=','c29ja'.'W'.'Fsbm'.'V'.'0d29'.'ya'.'w==','YWx'.'sb3dfb'.'Wljcm9ibG9nX3VzZXI=','SUQ=',''.'c'.'29jaWFs'.'b'.'mV'.'0d29yaw'.'==','YWxsb3'.'dfbWljcm'.'9i'.'bG'.'9nX3VzZXI=',''.'c29jaWFsbmV0'.'d29yaw==','YWxs'.'b3'.'dfbW'.'ljcm9ibG9n'.'X2dyb3V'.'w',''.'WQ==',''.'SUQ=','c29'.'jaWFsb'.'m'.'V0d29yaw==','YWxsb3df'.'b'.'Wljcm9i'.'bG9'.'nX2dyb'.'3'.'Vw','SUQ=','c29'.'jaWFsbmV'.'0d29'.'yaw==',''.'YWxs'.'b3dfbWljc'.'m'.'9'.'i'.'b'.'G9'.'nX2'.'dyb3'.'Vw','T'.'g==','','','Q'.'U'.'NUS'.'V'.'Z'.'F','WQ='.'=','c29ja'.'W'.'Fsb'.'m'.'V0d29ya'.'w'.'==','YWxsb3dfZm'.'lsZXNfd'.'XNlcg==','WQ==','SUQ'.'=','c29jaWFsbm'.'V0d2'.'9yaw='.'=',''.'YW'.'xsb3dfZmlsZXNf'.'dXNlcg='.'=',''.'SUQ=','c29jaWFsbmV0d29'.'yaw==','YWxsb3dfZm'.'lsZXNfdXNl'.'cg==','Tg'.'==','','','QUNUSVZ'.'F','W'.'Q'.'==','c2'.'9ja'.'WFs'.'b'.'m'.'V'.'0'.'d'.'2'.'9yaw==','YWxsb3d'.'fYmxvZ191'.'c'.'2Vy','WQ'.'==',''.'SU'.'Q=','c'.'2'.'9jaWFsbmV'.'0d'.'29'.'yaw'.'==','YWxsb3'.'df'.'Y'.'mx'.'v'.'Z191c2Vy','SUQ=',''.'c29ja'.'W'.'FsbmV0'.'d29y'.'aw==','YWx'.'sb3dfYmx'.'vZ191c'.'2Vy','Tg==','','','QUNUSVZ'.'F',''.'WQ==',''.'c29jaWFsbm'.'V0d29y'.'aw==','YWxsb3'.'dfcG'.'hvdG'.'9'.'fdX'.'Nlc'.'g==',''.'WQ==','SUQ'.'=','c29'.'j'.'aWFsbmV0d29'.'yaw==','YWxsb'.'3dfcGhvdG9f'.'dXN'.'lcg='.'=','SUQ'.'=','c'.'29'.'jaWFsbmV0'.'d29yaw==','YWx'.'sb3dfc'.'Ghv'.'dG9fdXNlc'.'g='.'=','Tg==','','','Q'.'UNUS'.'V'.'ZF','WQ'.'==','c29j'.'aWFs'.'bmV'.'0d29y'.'aw==','YWx'.'sb3df'.'Zm'.'9y'.'dW1'.'fdXN'.'l'.'cg'.'==',''.'W'.'Q==','SU'.'Q=','c29jaW'.'Fsbm'.'V0d'.'2'.'9y'.'a'.'w='.'=','YWx'.'s'.'b3dfZm9y'.'dW1fdXNlcg==','SUQ=','c29jaWFsbm'.'V0d29yaw==','YWx'.'sb3dfZ'.'m9ydW1'.'fdXNlcg='.'=','Tg'.'==','','',''.'QU'.'NUSVZF','W'.'Q==','c'.'29'.'jaW'.'F'.'sbmV0d29yaw='.'=',''.'YWxsb'.'3dfdGFza3NfdXN'.'lcg'.'==','WQ='.'=','SUQ=',''.'c29j'.'a'.'W'.'Fs'.'bmV'.'0d29ya'.'w==','YWxsb3dfdGFza3NfdXNlcg==','S'.'U'.'Q'.'=','c29jaWF'.'sb'.'m'.'V0d29y'.'a'.'w'.'==','Y'.'Wxsb'.'3dfdG'.'Fza3'.'Nf'.'d'.'XNlcg==','c29jaWFsbmV0d29ya'.'w==','YWxs'.'b3dfdGFza'.'3NfZ3'.'Jv'.'dXA=','WQ'.'==','SUQ'.'=','c'.'29jaWF'.'s'.'bmV0d29'.'yaw='.'=',''.'YWxs'.'b3dfdG'.'F'.'za3NfZ3JvdXA=','SUQ=','c29jaWFsbmV0d29ya'.'w==','YWx'.'s'.'b3dfd'.'GF'.'za3NfZ3JvdXA=','dGF'.'za3M=','Tg==','','','QUNU'.'SVZF','W'.'Q='.'=','c29ja'.'W'.'FsbmV0d29yaw='.'=','YW'.'xsb3dfY2'.'FsZW5kYXJfd'.'XNlcg==',''.'W'.'Q'.'==',''.'SUQ=','c29jaW'.'F'.'s'.'bmV0d29yaw==','YWx'.'sb3dfY2F'.'sZW5kYXJfdXNl'.'cg==','SUQ=','c'.'29ja'.'W'.'F'.'sbmV0d29'.'ya'.'w='.'=','YWxsb3'.'df'.'Y'.'2FsZW'.'5kY'.'X'.'J'.'fdX'.'N'.'l'.'cg'.'==','c2'.'9j'.'a'.'W'.'F'.'sbmV'.'0d29yaw==','YWxsb3d'.'f'.'Y2FsZ'.'W5'.'kYXJfZ'.'3JvdXA=','WQ==',''.'SUQ'.'=',''.'c29j'.'a'.'WFs'.'b'.'m'.'V0d29yaw==',''.'YW'.'x'.'sb'.'3dfY2'.'FsZW5kYX'.'JfZ3'.'JvdX'.'A=',''.'SUQ=','c29ja'.'WFs'.'bmV0d29y'.'aw='.'=','YWxsb3'.'df'.'Y'.'2FsZW'.'5kYXJfZ3JvdXA=','QUNUSVZF',''.'WQ==','Tg==','ZXh0cmFu'.'ZXQ=','a'.'WJsb2'.'Nr','T25BZnR'.'lcklCbG9ja0Vs'.'ZW1l'.'bn'.'RVcGRhdGU=','a'.'W50cmFuZXQ=',''.'Q0ludHJ'.'hbmV'.'0RXZlbn'.'RIYW5kbG'.'Vycw==','U1BS'.'ZWd'.'pc'.'3Rl'.'clVwZGF0ZWRJd'.'GVt','Q0ludHJ'.'hbm'.'V0U2hh'.'cmVwb2lu'.'d'.'Do'.'6'.'QWd'.'l'.'bnRMaXN0cygpO'.'w==','aW50'.'cm'.'F'.'uZXQ'.'=','Tg'.'==','Q'.'0ludHJhbmV'.'0U2hhcm'.'Vwb2ludDo6QWdlbnRRdWV1ZS'.'g'.'pO'.'w'.'==','a'.'W50cmFu'.'ZX'.'Q=','Tg==','Q0ludH'.'Jh'.'b'.'mV0U2hhcmVwb2ludD'.'o6QWdl'.'b'.'n'.'R'.'Vc'.'GRhd'.'GUo'.'K'.'Ts=','aW50'.'cmF'.'uZX'.'Q=','Tg==','aWJsb2Nr',''.'T'.'2'.'5'.'B'.'ZnRlck'.'lCb'.'G9ja'.'0VsZW1lbn'.'RBZ'.'G'.'Q=','aW50cmFu'.'ZXQ'.'=','Q0ludHJhbm'.'V'.'0RXZ'.'lbn'.'RIYW5'.'k'.'bGVy'.'cw==',''.'U'.'1BSZWdpc3'.'RlclVwZGF0ZWRJd'.'GV'.'t','aW'.'Jsb2Nr','T25BZn'.'Rlckl'.'CbG9ja'.'0VsZW1lbn'.'RV'.'cGRhdGU'.'=','aW50cmF'.'uZXQ=','Q0ludH'.'JhbmV'.'0'.'RXZlbnRIYW5'.'kbGV'.'ycw='.'=','U1BSZWdpc3'.'R'.'lclVwZGF0ZWRJdGVt','Q'.'0ludHJhb'.'mV0U2hhc'.'mVwb'.'2l'.'ud'.'Do6QWdlbn'.'R'.'MaXN'.'0cygpOw==','aW'.'50'.'cm'.'FuZX'.'Q'.'=','Q0'.'l'.'udHJhbmV0U2'.'hhcmVw'.'b2lu'.'d'.'Do6QW'.'dlbnRRdWV'.'1'.'ZSg'.'pOw==','a'.'W50c'.'mF'.'uZXQ=','Q0lu'.'dHJhb'.'m'.'V0U2hhcmVwb'.'2lu'.'dD'.'o6'.'QWdlbnRVcG'.'R'.'hd'.'GUoKT'.'s'.'=','aW'.'50cmFuZX'.'Q=','Y3Jt','bWF'.'p'.'bg==',''.'T25CZWZvcm'.'V'.'Q'.'cm9sb2c=','bW'.'Fp'.'b'.'g==','Q1'.'d'.'pe'.'mF'.'yZFNv'.'bF'.'Bhbm'.'Vs'.'SW50'.'cmFuZXQ=','U'.'2hv'.'d1Bhb'.'mV'.'s','L2'.'1'.'vZ'.'HVsZX'.'MvaW5'.'0cm'.'FuZXQ'.'v'.'cGFuZWxfYnV0dG'.'9uLn'.'Bo'.'cA==','ZXhwaXJlX21lc3My','bm9pdGl'.'k'.'ZV90aW1pb'.'G'.'VtaXQ=','WQ==','ZHJp'.'b'.'l9wZX'.'J'.'nb2tj','JTAxMHMK','R'.'UVYUElS','bWFpbg==',''.'J'.'XM'.'lcw'.'==',''.'YWRt','aGRyb3dzc2E=','YWR'.'taW4'.'=','bW9kdWxlcw='.'=','ZGVmaW5'.'lLnB'.'oc'.'A==','bW'.'F'.'pbg==','Yml'.'0c'.'ml4','Ukh'.'T'.'SVRFRVg=',''.'SD'.'R1N'.'j'.'d'.'maHc4N'.'1'.'Z'.'oeX'.'Rv'.'cw='.'=','','dG'.'h'.'S','N0'.'h5'.'c'.'jEy'.'SHd5MHJGcg='.'=',''.'VF'.'9TV'.'EVBTA='.'=','a'.'HR0cHM'.'6Ly9i'.'a'.'XRy'.'aXhz'.'b2'.'Z0LmNv'.'bS9iaXRya'.'XgvY'.'n'.'MucGhw','T0xE',''.'UElSRURBVE'.'VT',''.'RE9DVU1FTlR'.'fUk'.'9PVA'.'==','Lw==',''.'Lw'.'='.'=','VEVNUE9S'.'QVJZX0'.'NBQ0hF','V'.'E'.'VNU'.'E'.'9S'.'QVJZX'.'0NBQ0hF','','T05fT0Q=',''.'JXMlcw'.'='.'=',''.'X09VUl9'.'CVV'.'M'.'=','U0'.'lU','RURBVEVNQVBF'.'Ug==','bm9pdG'.'lkZV90'.'aW1pbGVtaXQ=','bQ==','ZA==','WQ==','U0'.'N'.'S'.'SVBU'.'X0'.'5BTUU=','L2J'.'p'.'d'.'HJpe'.'C'.'9jb3Vwb2'.'5'.'fYWN0aXZhdG'.'lvbi'.'5wa'.'HA=','U'.'0NSSVBUX0'.'5BTU'.'U=','L2Jp'.'dHJ'.'peC9zZXJ'.'2aWNlc'.'y9tYW'.'l'.'u'.'L2FqYXguc'.'Ghw','L2'.'JpdH'.'JpeC9jb3Vwb25fYWN0aXZhdGlvb'.'i'.'5waHA=',''.'U2'.'l0ZUV4cGlyZURhdGU=');return base64_decode($_851366313[$_459528685]);}};$GLOBALS['____1094180131'][0](___2124062244(0), ___2124062244(1));class CBXFeatures{ private static $_928498205= 30; private static $_1660892799= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_466592054= null; private static $_795511595= null; private static function __1398266217(){ if(self::$_466592054 === null){ self::$_466592054= array(); foreach(self::$_1660892799 as $_447901784 => $_75997009){ foreach($_75997009 as $_1645139274) self::$_466592054[$_1645139274]= $_447901784;}} if(self::$_795511595 === null){ self::$_795511595= array(); $_540886050= COption::GetOptionString(___2124062244(2), ___2124062244(3), ___2124062244(4)); if($_540886050 != ___2124062244(5)){ $_540886050= $GLOBALS['____1094180131'][1]($_540886050); $_540886050= $GLOBALS['____1094180131'][2]($_540886050,[___2124062244(6) => false]); if($GLOBALS['____1094180131'][3]($_540886050)){ self::$_795511595= $_540886050;}} if(empty(self::$_795511595)){ self::$_795511595= array(___2124062244(7) => array(), ___2124062244(8) => array());}}} public static function InitiateEditionsSettings($_1578632528){ self::__1398266217(); $_779411443= array(); foreach(self::$_1660892799 as $_447901784 => $_75997009){ $_1429630066= $GLOBALS['____1094180131'][4]($_447901784, $_1578632528); self::$_795511595[___2124062244(9)][$_447901784]=($_1429630066? array(___2124062244(10)): array(___2124062244(11))); foreach($_75997009 as $_1645139274){ self::$_795511595[___2124062244(12)][$_1645139274]= $_1429630066; if(!$_1429630066) $_779411443[]= array($_1645139274, false);}} $_1301827833= $GLOBALS['____1094180131'][5](self::$_795511595); $_1301827833= $GLOBALS['____1094180131'][6]($_1301827833); COption::SetOptionString(___2124062244(13), ___2124062244(14), $_1301827833); foreach($_779411443 as $_1581808334) self::__1374659398($_1581808334[(1096/2-548)], $_1581808334[round(0+0.5+0.5)]);} public static function IsFeatureEnabled($_1645139274){ if($_1645139274 == '') return true; self::__1398266217(); if(!isset(self::$_466592054[$_1645139274])) return true; if(self::$_466592054[$_1645139274] == ___2124062244(15)) $_1796645517= array(___2124062244(16)); elseif(isset(self::$_795511595[___2124062244(17)][self::$_466592054[$_1645139274]])) $_1796645517= self::$_795511595[___2124062244(18)][self::$_466592054[$_1645139274]]; else $_1796645517= array(___2124062244(19)); if($_1796645517[(1056/2-528)] != ___2124062244(20) && $_1796645517[(812-2*406)] != ___2124062244(21)){ return false;} elseif($_1796645517[(188*2-376)] == ___2124062244(22)){ if($_1796645517[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1094180131'][7]((213*2-426), min(44,0,14.666666666667),(197*2-394), Date(___2124062244(23)), $GLOBALS['____1094180131'][8](___2124062244(24))- self::$_928498205, $GLOBALS['____1094180131'][9](___2124062244(25)))){ if(!isset($_1796645517[round(0+2)]) ||!$_1796645517[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) self::__1269292561(self::$_466592054[$_1645139274]); return false;}} return!isset(self::$_795511595[___2124062244(26)][$_1645139274]) || self::$_795511595[___2124062244(27)][$_1645139274];} public static function IsFeatureInstalled($_1645139274){ if($GLOBALS['____1094180131'][10]($_1645139274) <= 0) return true; self::__1398266217(); return(isset(self::$_795511595[___2124062244(28)][$_1645139274]) && self::$_795511595[___2124062244(29)][$_1645139274]);} public static function IsFeatureEditable($_1645139274){ if($_1645139274 == '') return true; self::__1398266217(); if(!isset(self::$_466592054[$_1645139274])) return true; if(self::$_466592054[$_1645139274] == ___2124062244(30)) $_1796645517= array(___2124062244(31)); elseif(isset(self::$_795511595[___2124062244(32)][self::$_466592054[$_1645139274]])) $_1796645517= self::$_795511595[___2124062244(33)][self::$_466592054[$_1645139274]]; else $_1796645517= array(___2124062244(34)); if($_1796645517[(986-2*493)] != ___2124062244(35) && $_1796645517[(1004/2-502)] != ___2124062244(36)){ return false;} elseif($_1796645517[(154*2-308)] == ___2124062244(37)){ if($_1796645517[round(0+1)]< $GLOBALS['____1094180131'][11]((906-2*453),(1284/2-642),(235*2-470), Date(___2124062244(38)), $GLOBALS['____1094180131'][12](___2124062244(39))- self::$_928498205, $GLOBALS['____1094180131'][13](___2124062244(40)))){ if(!isset($_1796645517[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) ||!$_1796645517[round(0+2)]) self::__1269292561(self::$_466592054[$_1645139274]); return false;}} return true;} private static function __1374659398($_1645139274, $_569502443){ if($GLOBALS['____1094180131'][14]("CBXFeatures", "On".$_1645139274."SettingsChange")) $GLOBALS['____1094180131'][15](array("CBXFeatures", "On".$_1645139274."SettingsChange"), array($_1645139274, $_569502443)); $_1988102919= $GLOBALS['_____476068173'][0](___2124062244(41), ___2124062244(42).$_1645139274.___2124062244(43)); while($_1947462401= $_1988102919->Fetch()) $GLOBALS['_____476068173'][1]($_1947462401, array($_1645139274, $_569502443));} public static function SetFeatureEnabled($_1645139274, $_569502443= true, $_1060599095= true){ if($GLOBALS['____1094180131'][16]($_1645139274) <= 0) return; if(!self::IsFeatureEditable($_1645139274)) $_569502443= false; $_569502443= (bool)$_569502443; self::__1398266217(); $_1089230582=(!isset(self::$_795511595[___2124062244(44)][$_1645139274]) && $_569502443 || isset(self::$_795511595[___2124062244(45)][$_1645139274]) && $_569502443 != self::$_795511595[___2124062244(46)][$_1645139274]); self::$_795511595[___2124062244(47)][$_1645139274]= $_569502443; $_1301827833= $GLOBALS['____1094180131'][17](self::$_795511595); $_1301827833= $GLOBALS['____1094180131'][18]($_1301827833); COption::SetOptionString(___2124062244(48), ___2124062244(49), $_1301827833); if($_1089230582 && $_1060599095) self::__1374659398($_1645139274, $_569502443);} private static function __1269292561($_447901784){ if($GLOBALS['____1094180131'][19]($_447901784) <= 0 || $_447901784 == "Portal") return; self::__1398266217(); if(!isset(self::$_795511595[___2124062244(50)][$_447901784]) || self::$_795511595[___2124062244(51)][$_447901784][(185*2-370)] != ___2124062244(52)) return; if(isset(self::$_795511595[___2124062244(53)][$_447901784][round(0+1+1)]) && self::$_795511595[___2124062244(54)][$_447901784][round(0+0.4+0.4+0.4+0.4+0.4)]) return; $_779411443= array(); if(isset(self::$_1660892799[$_447901784]) && $GLOBALS['____1094180131'][20](self::$_1660892799[$_447901784])){ foreach(self::$_1660892799[$_447901784] as $_1645139274){ if(isset(self::$_795511595[___2124062244(55)][$_1645139274]) && self::$_795511595[___2124062244(56)][$_1645139274]){ self::$_795511595[___2124062244(57)][$_1645139274]= false; $_779411443[]= array($_1645139274, false);}} self::$_795511595[___2124062244(58)][$_447901784][round(0+2)]= true;} $_1301827833= $GLOBALS['____1094180131'][21](self::$_795511595); $_1301827833= $GLOBALS['____1094180131'][22]($_1301827833); COption::SetOptionString(___2124062244(59), ___2124062244(60), $_1301827833); foreach($_779411443 as $_1581808334) self::__1374659398($_1581808334[(1052/2-526)], $_1581808334[round(0+0.25+0.25+0.25+0.25)]);} public static function ModifyFeaturesSettings($_1578632528, $_75997009){ self::__1398266217(); foreach($_1578632528 as $_447901784 => $_872202687) self::$_795511595[___2124062244(61)][$_447901784]= $_872202687; $_779411443= array(); foreach($_75997009 as $_1645139274 => $_569502443){ if(!isset(self::$_795511595[___2124062244(62)][$_1645139274]) && $_569502443 || isset(self::$_795511595[___2124062244(63)][$_1645139274]) && $_569502443 != self::$_795511595[___2124062244(64)][$_1645139274]) $_779411443[]= array($_1645139274, $_569502443); self::$_795511595[___2124062244(65)][$_1645139274]= $_569502443;} $_1301827833= $GLOBALS['____1094180131'][23](self::$_795511595); $_1301827833= $GLOBALS['____1094180131'][24]($_1301827833); COption::SetOptionString(___2124062244(66), ___2124062244(67), $_1301827833); self::$_795511595= false; foreach($_779411443 as $_1581808334) self::__1374659398($_1581808334[min(44,0,14.666666666667)], $_1581808334[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function SaveFeaturesSettings($_1167376146, $_5941249){ self::__1398266217(); $_198997193= array(___2124062244(68) => array(), ___2124062244(69) => array()); if(!$GLOBALS['____1094180131'][25]($_1167376146)) $_1167376146= array(); if(!$GLOBALS['____1094180131'][26]($_5941249)) $_5941249= array(); if(!$GLOBALS['____1094180131'][27](___2124062244(70), $_1167376146)) $_1167376146[]= ___2124062244(71); foreach(self::$_1660892799 as $_447901784 => $_75997009){ if(isset(self::$_795511595[___2124062244(72)][$_447901784])){ $_747713444= self::$_795511595[___2124062244(73)][$_447901784];} else{ $_747713444=($_447901784 == ___2124062244(74)? array(___2124062244(75)): array(___2124062244(76)));} if($_747713444[(812-2*406)] == ___2124062244(77) || $_747713444[(996-2*498)] == ___2124062244(78)){ $_198997193[___2124062244(79)][$_447901784]= $_747713444;} else{ if($GLOBALS['____1094180131'][28]($_447901784, $_1167376146)) $_198997193[___2124062244(80)][$_447901784]= array(___2124062244(81), $GLOBALS['____1094180131'][29]((966-2*483),(1132/2-566), min(68,0,22.666666666667), $GLOBALS['____1094180131'][30](___2124062244(82)), $GLOBALS['____1094180131'][31](___2124062244(83)), $GLOBALS['____1094180131'][32](___2124062244(84)))); else $_198997193[___2124062244(85)][$_447901784]= array(___2124062244(86));}} $_779411443= array(); foreach(self::$_466592054 as $_1645139274 => $_447901784){ if($_198997193[___2124062244(87)][$_447901784][(1172/2-586)] != ___2124062244(88) && $_198997193[___2124062244(89)][$_447901784][min(180,0,60)] != ___2124062244(90)){ $_198997193[___2124062244(91)][$_1645139274]= false;} else{ if($_198997193[___2124062244(92)][$_447901784][(850-2*425)] == ___2124062244(93) && $_198997193[___2124062244(94)][$_447901784][round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____1094180131'][33]((880-2*440),(1264/2-632),(1020/2-510), Date(___2124062244(95)), $GLOBALS['____1094180131'][34](___2124062244(96))- self::$_928498205, $GLOBALS['____1094180131'][35](___2124062244(97)))) $_198997193[___2124062244(98)][$_1645139274]= false; else $_198997193[___2124062244(99)][$_1645139274]= $GLOBALS['____1094180131'][36]($_1645139274, $_5941249); if(!isset(self::$_795511595[___2124062244(100)][$_1645139274]) && $_198997193[___2124062244(101)][$_1645139274] || isset(self::$_795511595[___2124062244(102)][$_1645139274]) && $_198997193[___2124062244(103)][$_1645139274] != self::$_795511595[___2124062244(104)][$_1645139274]) $_779411443[]= array($_1645139274, $_198997193[___2124062244(105)][$_1645139274]);}} $_1301827833= $GLOBALS['____1094180131'][37]($_198997193); $_1301827833= $GLOBALS['____1094180131'][38]($_1301827833); COption::SetOptionString(___2124062244(106), ___2124062244(107), $_1301827833); self::$_795511595= false; foreach($_779411443 as $_1581808334) self::__1374659398($_1581808334[(856-2*428)], $_1581808334[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function GetFeaturesList(){ self::__1398266217(); $_1084984818= array(); foreach(self::$_1660892799 as $_447901784 => $_75997009){ if(isset(self::$_795511595[___2124062244(108)][$_447901784])){ $_747713444= self::$_795511595[___2124062244(109)][$_447901784];} else{ $_747713444=($_447901784 == ___2124062244(110)? array(___2124062244(111)): array(___2124062244(112)));} $_1084984818[$_447901784]= array( ___2124062244(113) => $_747713444[(222*2-444)], ___2124062244(114) => $_747713444[round(0+0.33333333333333+0.33333333333333+0.33333333333333)], ___2124062244(115) => array(),); $_1084984818[$_447901784][___2124062244(116)]= false; if($_1084984818[$_447901784][___2124062244(117)] == ___2124062244(118)){ $_1084984818[$_447901784][___2124062244(119)]= $GLOBALS['____1094180131'][39](($GLOBALS['____1094180131'][40]()- $_1084984818[$_447901784][___2124062244(120)])/ round(0+43200+43200)); if($_1084984818[$_447901784][___2124062244(121)]> self::$_928498205) $_1084984818[$_447901784][___2124062244(122)]= true;} foreach($_75997009 as $_1645139274) $_1084984818[$_447901784][___2124062244(123)][$_1645139274]=(!isset(self::$_795511595[___2124062244(124)][$_1645139274]) || self::$_795511595[___2124062244(125)][$_1645139274]);} return $_1084984818;} private static function __1560014746($_443165016, $_1692441493){ if(IsModuleInstalled($_443165016) == $_1692441493) return true; $_354957656= $_SERVER[___2124062244(126)].___2124062244(127).$_443165016.___2124062244(128); if(!$GLOBALS['____1094180131'][41]($_354957656)) return false; include_once($_354957656); $_1777609988= $GLOBALS['____1094180131'][42](___2124062244(129), ___2124062244(130), $_443165016); if(!$GLOBALS['____1094180131'][43]($_1777609988)) return false; $_280207857= new $_1777609988; if($_1692441493){ if(!$_280207857->InstallDB()) return false; $_280207857->InstallEvents(); if(!$_280207857->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___2124062244(131))) CSearch::DeleteIndex($_443165016); UnRegisterModule($_443165016);} return true;} protected static function OnRequestsSettingsChange($_1645139274, $_569502443){ self::__1560014746("form", $_569502443);} protected static function OnLearningSettingsChange($_1645139274, $_569502443){ self::__1560014746("learning", $_569502443);} protected static function OnJabberSettingsChange($_1645139274, $_569502443){ self::__1560014746("xmpp", $_569502443);} protected static function OnVideoConferenceSettingsChange($_1645139274, $_569502443){} protected static function OnBizProcSettingsChange($_1645139274, $_569502443){ self::__1560014746("bizprocdesigner", $_569502443);} protected static function OnListsSettingsChange($_1645139274, $_569502443){ self::__1560014746("lists", $_569502443);} protected static function OnWikiSettingsChange($_1645139274, $_569502443){ self::__1560014746("wiki", $_569502443);} protected static function OnSupportSettingsChange($_1645139274, $_569502443){ self::__1560014746("support", $_569502443);} protected static function OnControllerSettingsChange($_1645139274, $_569502443){ self::__1560014746("controller", $_569502443);} protected static function OnAnalyticsSettingsChange($_1645139274, $_569502443){ self::__1560014746("statistic", $_569502443);} protected static function OnVoteSettingsChange($_1645139274, $_569502443){ self::__1560014746("vote", $_569502443);} protected static function OnFriendsSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(132); $_603200968= CSite::GetList(___2124062244(133), ___2124062244(134), array(___2124062244(135) => ___2124062244(136))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(137), ___2124062244(138), ___2124062244(139), $_912780009[___2124062244(140)]) != $_815748502){ COption::SetOptionString(___2124062244(141), ___2124062244(142), $_815748502, false, $_912780009[___2124062244(143)]); COption::SetOptionString(___2124062244(144), ___2124062244(145), $_815748502);}}} protected static function OnMicroBlogSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(146); $_603200968= CSite::GetList(___2124062244(147), ___2124062244(148), array(___2124062244(149) => ___2124062244(150))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(151), ___2124062244(152), ___2124062244(153), $_912780009[___2124062244(154)]) != $_815748502){ COption::SetOptionString(___2124062244(155), ___2124062244(156), $_815748502, false, $_912780009[___2124062244(157)]); COption::SetOptionString(___2124062244(158), ___2124062244(159), $_815748502);} if(COption::GetOptionString(___2124062244(160), ___2124062244(161), ___2124062244(162), $_912780009[___2124062244(163)]) != $_815748502){ COption::SetOptionString(___2124062244(164), ___2124062244(165), $_815748502, false, $_912780009[___2124062244(166)]); COption::SetOptionString(___2124062244(167), ___2124062244(168), $_815748502);}}} protected static function OnPersonalFilesSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(169); $_603200968= CSite::GetList(___2124062244(170), ___2124062244(171), array(___2124062244(172) => ___2124062244(173))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(174), ___2124062244(175), ___2124062244(176), $_912780009[___2124062244(177)]) != $_815748502){ COption::SetOptionString(___2124062244(178), ___2124062244(179), $_815748502, false, $_912780009[___2124062244(180)]); COption::SetOptionString(___2124062244(181), ___2124062244(182), $_815748502);}}} protected static function OnPersonalBlogSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(183); $_603200968= CSite::GetList(___2124062244(184), ___2124062244(185), array(___2124062244(186) => ___2124062244(187))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(188), ___2124062244(189), ___2124062244(190), $_912780009[___2124062244(191)]) != $_815748502){ COption::SetOptionString(___2124062244(192), ___2124062244(193), $_815748502, false, $_912780009[___2124062244(194)]); COption::SetOptionString(___2124062244(195), ___2124062244(196), $_815748502);}}} protected static function OnPersonalPhotoSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(197); $_603200968= CSite::GetList(___2124062244(198), ___2124062244(199), array(___2124062244(200) => ___2124062244(201))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(202), ___2124062244(203), ___2124062244(204), $_912780009[___2124062244(205)]) != $_815748502){ COption::SetOptionString(___2124062244(206), ___2124062244(207), $_815748502, false, $_912780009[___2124062244(208)]); COption::SetOptionString(___2124062244(209), ___2124062244(210), $_815748502);}}} protected static function OnPersonalForumSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(211); $_603200968= CSite::GetList(___2124062244(212), ___2124062244(213), array(___2124062244(214) => ___2124062244(215))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(216), ___2124062244(217), ___2124062244(218), $_912780009[___2124062244(219)]) != $_815748502){ COption::SetOptionString(___2124062244(220), ___2124062244(221), $_815748502, false, $_912780009[___2124062244(222)]); COption::SetOptionString(___2124062244(223), ___2124062244(224), $_815748502);}}} protected static function OnTasksSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(225); $_603200968= CSite::GetList(___2124062244(226), ___2124062244(227), array(___2124062244(228) => ___2124062244(229))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(230), ___2124062244(231), ___2124062244(232), $_912780009[___2124062244(233)]) != $_815748502){ COption::SetOptionString(___2124062244(234), ___2124062244(235), $_815748502, false, $_912780009[___2124062244(236)]); COption::SetOptionString(___2124062244(237), ___2124062244(238), $_815748502);} if(COption::GetOptionString(___2124062244(239), ___2124062244(240), ___2124062244(241), $_912780009[___2124062244(242)]) != $_815748502){ COption::SetOptionString(___2124062244(243), ___2124062244(244), $_815748502, false, $_912780009[___2124062244(245)]); COption::SetOptionString(___2124062244(246), ___2124062244(247), $_815748502);}} self::__1560014746(___2124062244(248), $_569502443);} protected static function OnCalendarSettingsChange($_1645139274, $_569502443){ if($_569502443) $_815748502= "Y"; else $_815748502= ___2124062244(249); $_603200968= CSite::GetList(___2124062244(250), ___2124062244(251), array(___2124062244(252) => ___2124062244(253))); while($_912780009= $_603200968->Fetch()){ if(COption::GetOptionString(___2124062244(254), ___2124062244(255), ___2124062244(256), $_912780009[___2124062244(257)]) != $_815748502){ COption::SetOptionString(___2124062244(258), ___2124062244(259), $_815748502, false, $_912780009[___2124062244(260)]); COption::SetOptionString(___2124062244(261), ___2124062244(262), $_815748502);} if(COption::GetOptionString(___2124062244(263), ___2124062244(264), ___2124062244(265), $_912780009[___2124062244(266)]) != $_815748502){ COption::SetOptionString(___2124062244(267), ___2124062244(268), $_815748502, false, $_912780009[___2124062244(269)]); COption::SetOptionString(___2124062244(270), ___2124062244(271), $_815748502);}}} protected static function OnSMTPSettingsChange($_1645139274, $_569502443){ self::__1560014746("mail", $_569502443);} protected static function OnExtranetSettingsChange($_1645139274, $_569502443){ $_580557419= COption::GetOptionString("extranet", "extranet_site", ""); if($_580557419){ $_1889642097= new CSite; $_1889642097->Update($_580557419, array(___2124062244(272) =>($_569502443? ___2124062244(273): ___2124062244(274))));} self::__1560014746(___2124062244(275), $_569502443);} protected static function OnDAVSettingsChange($_1645139274, $_569502443){ self::__1560014746("dav", $_569502443);} protected static function OntimemanSettingsChange($_1645139274, $_569502443){ self::__1560014746("timeman", $_569502443);} protected static function Onintranet_sharepointSettingsChange($_1645139274, $_569502443){ if($_569502443){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___2124062244(276), ___2124062244(277), ___2124062244(278), ___2124062244(279), ___2124062244(280)); CAgent::AddAgent(___2124062244(281), ___2124062244(282), ___2124062244(283), round(0+500)); CAgent::AddAgent(___2124062244(284), ___2124062244(285), ___2124062244(286), round(0+75+75+75+75)); CAgent::AddAgent(___2124062244(287), ___2124062244(288), ___2124062244(289), round(0+1800+1800));} else{ UnRegisterModuleDependences(___2124062244(290), ___2124062244(291), ___2124062244(292), ___2124062244(293), ___2124062244(294)); UnRegisterModuleDependences(___2124062244(295), ___2124062244(296), ___2124062244(297), ___2124062244(298), ___2124062244(299)); CAgent::RemoveAgent(___2124062244(300), ___2124062244(301)); CAgent::RemoveAgent(___2124062244(302), ___2124062244(303)); CAgent::RemoveAgent(___2124062244(304), ___2124062244(305));}} protected static function OncrmSettingsChange($_1645139274, $_569502443){ if($_569502443) COption::SetOptionString("crm", "form_features", "Y"); self::__1560014746(___2124062244(306), $_569502443);} protected static function OnClusterSettingsChange($_1645139274, $_569502443){ self::__1560014746("cluster", $_569502443);} protected static function OnMultiSitesSettingsChange($_1645139274, $_569502443){ if($_569502443) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___2124062244(307), ___2124062244(308), ___2124062244(309), ___2124062244(310), ___2124062244(311), ___2124062244(312));} protected static function OnIdeaSettingsChange($_1645139274, $_569502443){ self::__1560014746("idea", $_569502443);} protected static function OnMeetingSettingsChange($_1645139274, $_569502443){ self::__1560014746("meeting", $_569502443);} protected static function OnXDImportSettingsChange($_1645139274, $_569502443){ self::__1560014746("xdimport", $_569502443);}} $_194093901= GetMessage(___2124062244(313));$_237504877= round(0+7.5+7.5);$GLOBALS['____1094180131'][44]($GLOBALS['____1094180131'][45]($GLOBALS['____1094180131'][46](___2124062244(314))), ___2124062244(315));$_509925815= round(0+0.25+0.25+0.25+0.25); $_267383930= ___2124062244(316); unset($_1141193961); $_902382173= $GLOBALS['____1094180131'][47](___2124062244(317), ___2124062244(318)); $_1141193961= \COption::GetOptionString(___2124062244(319), $GLOBALS['____1094180131'][48](___2124062244(320),___2124062244(321),$GLOBALS['____1094180131'][49]($_267383930, round(0+1+1), round(0+1.3333333333333+1.3333333333333+1.3333333333333))).$GLOBALS['____1094180131'][50](___2124062244(322))); $_809851131= array(round(0+17) => ___2124062244(323), round(0+7) => ___2124062244(324), round(0+5.5+5.5+5.5+5.5) => ___2124062244(325), round(0+4+4+4) => ___2124062244(326), round(0+1+1+1) => ___2124062244(327)); $_245015433= ___2124062244(328); while($_1141193961){ $_72483398= ___2124062244(329); $_1430306844= $GLOBALS['____1094180131'][51]($_1141193961); $_1904270437= ___2124062244(330); $_72483398= $GLOBALS['____1094180131'][52](___2124062244(331).$_72483398,(1164/2-582),-round(0+2.5+2.5)).___2124062244(332); $_1827234689= $GLOBALS['____1094180131'][53]($_72483398); $_716331665=(194*2-388); for($_546643431=(182*2-364); $_546643431<$GLOBALS['____1094180131'][54]($_1430306844); $_546643431++){ $_1904270437 .= $GLOBALS['____1094180131'][55]($GLOBALS['____1094180131'][56]($_1430306844[$_546643431])^ $GLOBALS['____1094180131'][57]($_72483398[$_716331665])); if($_716331665==$_1827234689-round(0+1)) $_716331665=(782-2*391); else $_716331665= $_716331665+ round(0+1);} $_509925815= $GLOBALS['____1094180131'][58]((186*2-372), min(110,0,36.666666666667),(178*2-356), $GLOBALS['____1094180131'][59]($_1904270437[round(0+1.2+1.2+1.2+1.2+1.2)].$_1904270437[round(0+0.75+0.75+0.75+0.75)]), $GLOBALS['____1094180131'][60]($_1904270437[round(0+0.25+0.25+0.25+0.25)].$_1904270437[round(0+14)]), $GLOBALS['____1094180131'][61]($_1904270437[round(0+3.3333333333333+3.3333333333333+3.3333333333333)].$_1904270437[round(0+9+9)].$_1904270437[round(0+1.75+1.75+1.75+1.75)].$_1904270437[round(0+3+3+3+3)])); unset($_72483398); break;} $_1308802400= ___2124062244(333); $GLOBALS['____1094180131'][62]($_809851131); $_1852748715= ___2124062244(334); $_245015433= ___2124062244(335).$GLOBALS['____1094180131'][63]($_245015433.___2124062244(336), round(0+0.4+0.4+0.4+0.4+0.4),-round(0+0.33333333333333+0.33333333333333+0.33333333333333));@include($_SERVER[___2124062244(337)].___2124062244(338).$GLOBALS['____1094180131'][64](___2124062244(339), $_809851131)); $_1561359175= round(0+1+1); while($GLOBALS['____1094180131'][65](___2124062244(340))){ $_1125465718= $GLOBALS['____1094180131'][66]($GLOBALS['____1094180131'][67](___2124062244(341))); $_677024638= ___2124062244(342); $_1308802400= $GLOBALS['____1094180131'][68](___2124062244(343)).$GLOBALS['____1094180131'][69](___2124062244(344),$_1308802400,___2124062244(345)); $_1973522083= $GLOBALS['____1094180131'][70]($_1308802400); $_716331665= min(136,0,45.333333333333); for($_546643431=(1272/2-636); $_546643431<$GLOBALS['____1094180131'][71]($_1125465718); $_546643431++){ $_677024638 .= $GLOBALS['____1094180131'][72]($GLOBALS['____1094180131'][73]($_1125465718[$_546643431])^ $GLOBALS['____1094180131'][74]($_1308802400[$_716331665])); if($_716331665==$_1973522083-round(0+0.5+0.5)) $_716331665=(932-2*466); else $_716331665= $_716331665+ round(0+0.33333333333333+0.33333333333333+0.33333333333333);} $_1561359175= $GLOBALS['____1094180131'][75](min(22,0,7.3333333333333),(217*2-434), min(154,0,51.333333333333), $GLOBALS['____1094180131'][76]($_677024638[round(0+1.5+1.5+1.5+1.5)].$_677024638[round(0+3.2+3.2+3.2+3.2+3.2)]), $GLOBALS['____1094180131'][77]($_677024638[round(0+2.25+2.25+2.25+2.25)].$_677024638[round(0+0.4+0.4+0.4+0.4+0.4)]), $GLOBALS['____1094180131'][78]($_677024638[round(0+4+4+4)].$_677024638[round(0+3.5+3.5)].$_677024638[round(0+14)].$_677024638[round(0+3)])); unset($_1308802400); break;} $_902382173= ___2124062244(346).$GLOBALS['____1094180131'][79]($GLOBALS['____1094180131'][80]($_902382173, round(0+1.5+1.5),-round(0+0.2+0.2+0.2+0.2+0.2)).___2124062244(347), round(0+0.25+0.25+0.25+0.25),-round(0+2.5+2.5));while(!$GLOBALS['____1094180131'][81]($GLOBALS['____1094180131'][82]($GLOBALS['____1094180131'][83](___2124062244(348))))){function __f($_866778600){return $_866778600+__f($_866778600);}__f(round(0+0.33333333333333+0.33333333333333+0.33333333333333));};for($_546643431=(896-2*448),$_421796349=($GLOBALS['____1094180131'][84]()< $GLOBALS['____1094180131'][85]((187*2-374),(1024/2-512),(1468/2-734),round(0+2.5+2.5),round(0+0.25+0.25+0.25+0.25),round(0+403.6+403.6+403.6+403.6+403.6)) || $_509925815 <= round(0+5+5)),$_584947969=($_509925815< $GLOBALS['____1094180131'][86](min(98,0,32.666666666667),(988-2*494),(940-2*470),Date(___2124062244(349)),$GLOBALS['____1094180131'][87](___2124062244(350))-$_237504877,$GLOBALS['____1094180131'][88](___2124062244(351)))),$_1708950725=($_SERVER[___2124062244(352)]!==___2124062244(353)&&$_SERVER[___2124062244(354)]!==___2124062244(355)); $_546643431< round(0+2+2+2+2+2),($_421796349 || $_584947969 || $_509925815 != $_1561359175) && $_1708950725; $_546643431++,LocalRedirect(___2124062244(356)),exit,$GLOBALS['_____476068173'][2]($_194093901));$GLOBALS['____1094180131'][89]($_245015433, $_509925815); $GLOBALS['____1094180131'][90]($_902382173, $_1561359175); $GLOBALS[___2124062244(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

// Component 2.0 template engines
$GLOBALS['arCustomTemplateEngines'] = [];

// User fields manager
$GLOBALS['USER_FIELD_MANAGER'] = new CUserTypeManager;

// todo: remove global
$GLOBALS['BX_MENU_CUSTOM'] = CMenuCustom::getInstance();

if (file_exists(($_fname = __DIR__ . "/classes/general/update_db_updater.php")))
{
	$US_HOST_PROCESS_MAIN = false;
	include $_fname;
}

if (($_fname = getLocalPath("init.php")) !== false)
{
	include_once $_SERVER["DOCUMENT_ROOT"] . $_fname;
}

if (($_fname = getLocalPath("php_interface/init.php", BX_PERSONAL_ROOT)) !== false)
{
	include_once $_SERVER["DOCUMENT_ROOT"] . $_fname;
}

if (($_fname = getLocalPath("php_interface/" . SITE_ID . "/init.php", BX_PERSONAL_ROOT)) !== false)
{
	include_once $_SERVER["DOCUMENT_ROOT"] . $_fname;
}

if ((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && !str_starts_with($GLOBALS["APPLICATION"]->GetCurPage(), BX_ROOT . "/admin/"))) && COption::GetOptionString("main", "include_charset", "Y") == "Y" && LANG_CHARSET != '')
{
	header("Content-Type: text/html; charset=".LANG_CHARSET);
}

if (COption::GetOptionString("main", "set_p3p_header", "Y") == "Y")
{
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");
}

$license = $application->getLicense();
header("X-Powered-CMS: Bitrix Site Manager (" . ($license->isDemoKey() ? "DEMO" : $license->getPublicHashKey()) . ")");

if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
{
	header("X-DevSrv-CMS: Bitrix");
}

//agents
if (COption::GetOptionString("main", "check_agents", "Y") == "Y")
{
	$application->addBackgroundJob(["CAgent", "CheckAgents"], [], Main\Application::JOB_PRIORITY_LOW);
}

//send email events
if (COption::GetOptionString("main", "check_events", "Y") !== "N")
{
	$application->addBackgroundJob(['\Bitrix\Main\Mail\EventManager', 'checkEvents'], [], Main\Application::JOB_PRIORITY_LOW - 1);
}

$healerOfEarlySessionStart = new HealerEarlySessionStart();
$healerOfEarlySessionStart->process($application->getKernelSession());

$kernelSession = $application->getKernelSession();
$kernelSession->start();
$application->getSessionLocalStorageManager()->setUniqueId($kernelSession->getId());

foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
{
	ExecuteModuleEventEx($arEvent);
}

//define global user object
$GLOBALS["USER"] = new CUser;

//session control from group policy
$arPolicy = $GLOBALS["USER"]->GetSecurityPolicy();
$currTime = time();
if (
	(
		//IP address changed
		$kernelSession['SESS_IP']
		&& $arPolicy["SESSION_IP_MASK"] != ''
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($kernelSession['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		$arPolicy["SESSION_TIMEOUT"] > 0
		&& $kernelSession['SESS_TIME'] > 0
		&& ($currTime - $arPolicy["SESSION_TIMEOUT"] * 60) > $kernelSession['SESS_TIME']
	)
	||
	(
		//signed session
		isset($kernelSession["BX_SESSION_SIGN"])
		&& $kernelSession["BX_SESSION_SIGN"] != bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$compositeSessionManager = $application->getCompositeSessionManager();
	$compositeSessionManager->destroy();

	$application->getSession()->setId(Main\Security\Random::getString(32));
	$compositeSessionManager->start();

	$GLOBALS["USER"] = new CUser;
}
$kernelSession['SESS_IP'] = $_SERVER['REMOTE_ADDR'] ?? null;
if (empty($kernelSession['SESS_TIME']))
{
	$kernelSession['SESS_TIME'] = $currTime;
}
elseif (($currTime - $kernelSession['SESS_TIME']) > 60)
{
	$kernelSession['SESS_TIME'] = $currTime;
}
if (!isset($kernelSession["BX_SESSION_SIGN"]))
{
	$kernelSession["BX_SESSION_SIGN"] = bitrix_sess_sign();
}

//session control from security module
if (
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if (!isset($kernelSession['SESS_ID_TIME']))
	{
		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
	elseif (($kernelSession['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $kernelSession['SESS_TIME'])
	{
		$compositeSessionManager = $application->getCompositeSessionManager();
		$compositeSessionManager->regenerateId();

		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
}

define("BX_STARTED", true);

if (isset($kernelSession['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($kernelSession['BX_ADMIN_LOAD_AUTH']);
}

$bRsaError = false;
$USER_LID = false;

if (!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS !== true)
{
	$doLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if ($doLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$secureLogout = (Main\Config\Option::get("main", "secure_logout", "N") == "Y");

		if (!$secureLogout || check_bitrix_sessid())
		{
			$GLOBALS["USER"]->Logout();
			LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', ['logout', 'sessid']));
		}
	}

	// authorize by cookies
	if (!$GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->LoginByCookies();
	}

	$arAuthResult = false;

	//http basic and digest authorization
	if (($httpAuth = $GLOBALS["USER"]->LoginByHttpAuth()) !== null)
	{
		$arAuthResult = $httpAuth;
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}

	//Authorize user from authorization html form
	//Only POST is accepted
	if (isset($_POST["AUTH_FORM"]) && $_POST["AUTH_FORM"] != '')
	{
		if (COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if (($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(['USER_PASSWORD', 'USER_CONFIRM_PASSWORD', 'USER_CURRENT_PASSWORD']);
				if ($errno == CRsaSecurity::ERROR_SESS_CHECK)
				{
					$arAuthResult = ["MESSAGE" => GetMessage("main_include_decode_pass_sess"), "TYPE" => "ERROR"];
				}
				elseif ($errno < 0)
				{
					$arAuthResult = ["MESSAGE" => GetMessage("main_include_decode_pass_err", ["#ERRCODE#" => $errno]), "TYPE" => "ERROR"];
				}

				if ($errno < 0)
				{
					$bRsaError = true;
				}
			}
		}

		if (!$bRsaError)
		{
			if (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
			{
				$USER_LID = SITE_ID;
			}

			$_POST["TYPE"] = $_POST["TYPE"] ?? null;
			if (isset($_POST["TYPE"]) && $_POST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_PASSWORD"] ?? '',
					$_POST["USER_REMEMBER"] ?? ''
				);
			}
			elseif (isset($_POST["TYPE"]) && $_POST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp(
					$_POST["USER_OTP"] ?? '',
					$_POST["OTP_REMEMBER"] ?? '',
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? ''
				);
			}
			elseif (isset($_POST["TYPE"]) && $_POST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_EMAIL"] ?? '',
					$USER_LID,
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? '',
					$_POST["USER_PHONE_NUMBER"] ?? ''
				);
			}
			elseif (isset($_POST["TYPE"]) && $_POST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_CHECKWORD"] ?? '',
					$_POST["USER_PASSWORD"] ?? '',
					$_POST["USER_CONFIRM_PASSWORD"] ?? '',
					$USER_LID,
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? '',
					true,
					$_POST["USER_PHONE_NUMBER"] ?? '',
					$_POST["USER_CURRENT_PASSWORD"] ?? ''
				);
			}

			if ($_POST["TYPE"] == "AUTH" || $_POST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if ($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$kernelSession['BX_ADMIN_LOAD_AUTH'] = true;

					// die() follows
					CMain::FinalActions('<script>window.onload=function(){(window.BX || window.parent.BX).AUTHAGENT.setAuthResult(false);};</script>');
				}
			}
		}
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}
	elseif (!$GLOBALS["USER"]->IsAuthorized() && isset($_REQUEST['bx_hit_hash']))
	{
		//Authorize by unique URL
		$GLOBALS["USER"]->LoginHitByHash($_REQUEST['bx_hit_hash']);
	}
}

//logout or re-authorize the user if something importand has changed
$GLOBALS["USER"]->CheckAuthActions();

//magic short URI
if (defined("BX_CHECK_SHORT_URI") && BX_CHECK_SHORT_URI && CBXShortUri::CheckUri())
{
	//local redirect inside
	die();
}

//application password scope control
if (($applicationID = $GLOBALS["USER"]->getContext()->getApplicationId()) !== null)
{
	$appManager = Main\Authentication\ApplicationManager::getInstance();
	if ($appManager->checkScope($applicationID) !== true)
	{
		$event = new Main\Event("main", "onApplicationScopeError", ['APPLICATION_ID' => $applicationID]);
		$event->send();

		$context->getResponse()->setStatus("403 Forbidden");
		$application->end();
	}
}

//define the site template
if (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
{
	$siteTemplate = "";
	if (!empty($_REQUEST["bitrix_preview_site_template"]) && is_string($_REQUEST["bitrix_preview_site_template"]) && $GLOBALS["USER"]->CanDoOperation('view_other_settings'))
	{
		//preview of site template
		$signer = new Main\Security\Sign\Signer();
		try
		{
			//protected by a sign
			$requestTemplate = $signer->unsign($_REQUEST["bitrix_preview_site_template"], "template_preview".bitrix_sessid());

			$aTemplates = CSiteTemplate::GetByID($requestTemplate);
			if ($template = $aTemplates->Fetch())
			{
				$siteTemplate = $template["ID"];

				//preview of unsaved template
				if (isset($_GET['bx_template_preview_mode']) && $_GET['bx_template_preview_mode'] == 'Y' && $GLOBALS["USER"]->CanDoOperation('edit_other_settings'))
				{
					define("SITE_TEMPLATE_PREVIEW_MODE", true);
				}
			}
		}
		catch (Main\Security\Sign\BadSignatureException)
		{
		}
	}
	if ($siteTemplate == "")
	{
		$siteTemplate = CSite::GetCurTemplate();
	}

	if (!defined('SITE_TEMPLATE_ID'))
	{
		define("SITE_TEMPLATE_ID", $siteTemplate);
	}

	define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
}
else
{
	// prevents undefined constants
	if (!defined('SITE_TEMPLATE_ID'))
	{
		define('SITE_TEMPLATE_ID', '.default');
	}

	define('SITE_TEMPLATE_PATH', '/bitrix/templates/.default');
}

//magic parameters: show page creation time
if (isset($_GET["show_page_exec_time"]))
{
	if ($_GET["show_page_exec_time"] == "Y" || $_GET["show_page_exec_time"] == "N")
	{
		$kernelSession["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
	}
}

//magic parameters: show included file processing time
if (isset($_GET["show_include_exec_time"]))
{
	if ($_GET["show_include_exec_time"] == "Y" || $_GET["show_include_exec_time"] == "N")
	{
		$kernelSession["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
	}
}

//magic parameters: show include areas
if (!empty($_GET["bitrix_include_areas"]))
{
	$GLOBALS["APPLICATION"]->SetShowIncludeAreas($_GET["bitrix_include_areas"]=="Y");
}

//magic sound
if ($GLOBALS["USER"]->IsAuthorized())
{
	$cookie_prefix = COption::GetOptionString('main', 'cookie_name', 'BITRIX_SM');
	if (!isset($_COOKIE[$cookie_prefix.'_SOUND_LOGIN_PLAYED']))
	{
		$GLOBALS["APPLICATION"]->set_cookie('SOUND_LOGIN_PLAYED', 'Y', 0);
	}
}

//magic cache
Main\Composite\Engine::shouldBeEnabled();

// should be before proactive filter on OnBeforeProlog
$userPassword = $_POST["USER_PASSWORD"] ?? null;
$userConfirmPassword = $_POST["USER_CONFIRM_PASSWORD"] ?? null;

foreach(GetModuleEvents("main", "OnBeforeProlog", true) as $arEvent)
{
	ExecuteModuleEventEx($arEvent);
}

// need to reinit
$GLOBALS["APPLICATION"]->SetCurPage(false);

if (!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS !== true)
{
	//Register user from authorization html form
	//Only POST is accepted
	if (isset($_POST["AUTH_FORM"]) && $_POST["AUTH_FORM"] != '' && isset($_POST["TYPE"]) && $_POST["TYPE"] == "REGISTRATION")
	{
		if (!$bRsaError)
		{
			if (COption::GetOptionString("main", "new_user_registration", "N") == "Y" && (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_NAME"] ?? '',
					$_POST["USER_LAST_NAME"] ?? '',
					$userPassword,
					$userConfirmPassword,
					$_POST["USER_EMAIL"] ?? '',
					$USER_LID,
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? '',
					false,
					$_POST["USER_PHONE_NUMBER"] ?? ''
				);

				$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
			}
		}
	}
}

if ((!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS !== true) && (!defined("NOT_CHECK_FILE_PERMISSIONS") || NOT_CHECK_FILE_PERMISSIONS !== true))
{
	$real_path = $context->getRequest()->getScriptFile();

	if (!$GLOBALS["USER"]->CanDoFileOperation('fm_view_file', [SITE_ID, $real_path]) || (defined("NEED_AUTH") && NEED_AUTH && !$GLOBALS["USER"]->IsAuthorized()))
	{
		if ($GLOBALS["USER"]->IsAuthorized() && $arAuthResult["MESSAGE"] == '')
		{
			$arAuthResult = ["MESSAGE" => GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", ["#FILE#" => $real_path]), "TYPE" => "ERROR"];

			if (COption::GetOptionString("main", "event_log_permissions_fail", "N") === "Y")
			{
				CEventLog::Log("SECURITY", "USER_PERMISSIONS_FAIL", "main", $GLOBALS["USER"]->GetID(), $real_path);
			}
		}

		if (defined("ADMIN_SECTION") && ADMIN_SECTION === true)
		{
			if (isset($_REQUEST["mode"]) && ($_REQUEST["mode"] === "list" || $_REQUEST["mode"] === "settings"))
			{
				echo "<script>top.location='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(["mode"])."';</script>";
				die();
			}
			elseif (isset($_REQUEST["mode"]) && $_REQUEST["mode"] === "frame")
			{
				echo "<script>
					const w = (opener? opener.window:parent.window);
					w.location.href='" .$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(["mode"])."';
				</script>";
				die();
			}
			elseif (defined("MOBILE_APP_ADMIN") && MOBILE_APP_ADMIN === true)
			{
				echo json_encode(["status" => "failed"]);
				die();
			}
		}

		/** @noinspection PhpUndefinedVariableInspection */
		$GLOBALS["APPLICATION"]->AuthForm($arAuthResult);
	}
}

/*ZDUyZmZYzg3ODA5NmUzMWY5OTllOGEyMzQwOGQ4NDhlZTAwYjE=*/$GLOBALS['____855314591']= array(base64_decode('b'.'X'.'RfcmFuZA='.'='),base64_decode(''.'Y'.'2FsbF91c2'.'Vy'.'X2Z1bmM='),base64_decode('c3'.'R'.'y'.'cG'.'9'.'z'),base64_decode('ZXhwbG9kZQ=='),base64_decode(''.'c'.'GFja'.'w=='),base64_decode('b'.'WQ1'),base64_decode('Y2'.'9u'.'c3RhbnQ'.'='),base64_decode('aG'.'FzaF9'.'o'.'bWF'.'j'),base64_decode('c3RyY21w'),base64_decode('Y2Fs'.'bF91c2V'.'yX2'.'Z1bmM='),base64_decode('Y'.'2Fs'.'bF91c2VyX2Z1'.'b'.'mM='),base64_decode('aXNfb2'.'Jq'.'ZWN'.'0'),base64_decode('Y2FsbF'.'91c2'.'VyX2Z1'.'b'.'mM='),base64_decode(''.'Y2'.'Fs'.'bF91c2'.'V'.'yX2Z1'.'bmM='),base64_decode('Y2'.'F'.'s'.'bF91c2'.'VyX'.'2Z'.'1bmM='),base64_decode('Y2FsbF91'.'c2VyX2Z1bmM'.'='),base64_decode('Y'.'2Fs'.'b'.'F91c2VyX2Z'.'1bm'.'M'.'='),base64_decode('Y2Fs'.'bF91c2VyX2Z1bmM'.'='),base64_decode('Z'.'GVm'.'a'.'W'.'5lZ'.'A=='),base64_decode('c3RybGVu'));if(!function_exists(__NAMESPACE__.'\\___282247370')){function ___282247370($_846295144){static $_1819158802= false; if($_1819158802 == false) $_1819158802=array('XENPcHRp'.'b246OkdldE9wdGlvblN0'.'c'.'mlu'.'Zw==','bWFp'.'bg==',''.'fl'.'BBUkFNX'.'0'.'1BWF9VU0VS'.'Uw='.'=',''.'L'.'g'.'='.'=',''.'Lg==','SCo'.'=','Y'.'ml0'.'cm'.'l4','TElDRU'.'5TRV9LRVk=',''.'c2h'.'hMjU2','XENP'.'cH'.'R'.'p'.'b2'.'4'.'6O'.'kdldE9'.'wd'.'GlvblN0c'.'mluZw='.'=','bWFpb'.'g='.'=','U'.'EFSQU'.'1fTUFYX1'.'VT'.'RVJT',''.'XEJpdHJpeFxNYWluXENvb'.'mZ'.'pZ1'.'x'.'PcHRp'.'b24'.'6O'.'nNl'.'dA==','bWFpbg==','UEFS'.'QU'.'1fTUF'.'YX1'.'V'.'TRVJT',''.'V'.'VNFUg='.'=','VVNF'.'Ug==','V'.'VNFUg'.'==','S'.'XNBdXRob3Jpe'.'mV'.'k',''.'VVN'.'FUg==','SXNBZG1pbg==','QVBQT'.'ElDQVRJT04'.'=','UmV'.'zdGF'.'ydEJ1ZmZlcg='.'=','TG9jYW'.'xSZ'.'WRpcmVjdA==','L2'.'x'.'pY2Vu'.'c2'.'VfcmVzdH'.'J'.'pY'.'3Rp'.'b24ucGhw','XE'.'NP'.'cH'.'Rpb24'.'6O'.'kdl'.'dE'.'9wdGlvb'.'lN0cmluZw='.'=','bWFpbg==','UE'.'FSQU1fTUF'.'YX1V'.'TR'.'VJT','XEJpdHJp'.'eFxN'.'YWluXEN'.'vbmZp'.'Z1'.'xPcHRpb246OnN'.'ldA==',''.'bWFpb'.'g='.'=','UEFSQU1fTU'.'FY'.'X1V'.'TR'.'V'.'JT','T0xE'.'U0lURUVYUEl'.'SRURBVEU'.'=','ZXh'.'waXJlX21lc3My');return base64_decode($_1819158802[$_846295144]);}};if($GLOBALS['____855314591'][0](round(0+0.25+0.25+0.25+0.25), round(0+4+4+4+4+4)) == round(0+1.75+1.75+1.75+1.75)){ $_119060579= $GLOBALS['____855314591'][1](___282247370(0), ___282247370(1), ___282247370(2)); if(!empty($_119060579) && $GLOBALS['____855314591'][2]($_119060579, ___282247370(3)) !== false){ list($_192069277, $_346218900)= $GLOBALS['____855314591'][3](___282247370(4), $_119060579); $_2079175709= $GLOBALS['____855314591'][4](___282247370(5), $_192069277); $_440580557= ___282247370(6).$GLOBALS['____855314591'][5]($GLOBALS['____855314591'][6](___282247370(7))); $_1137906983= $GLOBALS['____855314591'][7](___282247370(8), $_346218900, $_440580557, true); if($GLOBALS['____855314591'][8]($_1137906983, $_2079175709) !==(1208/2-604)){ if($GLOBALS['____855314591'][9](___282247370(9), ___282247370(10), ___282247370(11)) != round(0+12)){ $GLOBALS['____855314591'][10](___282247370(12), ___282247370(13), ___282247370(14), round(0+3+3+3+3));} if(isset($GLOBALS[___282247370(15)]) && $GLOBALS['____855314591'][11]($GLOBALS[___282247370(16)]) && $GLOBALS['____855314591'][12](array($GLOBALS[___282247370(17)], ___282247370(18))) &&!$GLOBALS['____855314591'][13](array($GLOBALS[___282247370(19)], ___282247370(20)))){ $GLOBALS['____855314591'][14](array($GLOBALS[___282247370(21)], ___282247370(22))); $GLOBALS['____855314591'][15](___282247370(23), ___282247370(24), true);}}} else{ if($GLOBALS['____855314591'][16](___282247370(25), ___282247370(26), ___282247370(27)) != round(0+4+4+4)){ $GLOBALS['____855314591'][17](___282247370(28), ___282247370(29), ___282247370(30), round(0+4+4+4));}}} while(!$GLOBALS['____855314591'][18](___282247370(31)) || $GLOBALS['____855314591'][19](OLDSITEEXPIREDATE) <=(1004/2-502) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___282247370(32)));/**/       //Do not remove this


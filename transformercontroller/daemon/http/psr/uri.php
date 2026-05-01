<?php

namespace Bitrix\TransformerController\Daemon\Http\Psr;

use Psr\Http\Message\UriInterface;

final class Uri implements UriInterface
{
	private const MIN_PORT = 0;
	private const MAX_PORT = 65535;

	// match either valid %XX sequence (group 1) or any byte that is not allowed in the component
	private const URL_ENCODE_REGEX_TEMPLATE = '#(%[A-Fa-f0-9]{2})|[^' . self::RFC_PCHAR_REGEX . '\/#QUESTION_MARK#]#';
	private const RFC_PCHAR_REGEX = self::RFC_UNRESERVED_REGEX . self::RFC_SUB_DELIMS_REGEX . ':@';
	private const RFC_UNRESERVED_REGEX = 'a-zA-Z0-9_\-\.~';
	private const RFC_SUB_DELIMS_REGEX = '!\$&\'\(\)\*\+,;=';

	private string $scheme = '';
	private string $host = '';
	private ?int $port = null;
	private string $user = '';
	private string $pass = '';
	private string $path = '';
	private string $query = '';
	private string $fragment = '';

	public function __construct(string $uri = '')
	{
		$parsedUri = parse_url($uri);

		if ($parsedUri !== false)
		{
			$this->scheme = strtolower($parsedUri['scheme'] ?? $this->scheme);
			$this->host = strtolower($parsedUri['host'] ?? $this->host);
			$this->port = $parsedUri['port'] ?? $this->port;
			$this->user = $parsedUri['user'] ?? $this->user;
			$this->pass = $parsedUri['pass'] ?? $this->pass;
			$this->path = $this->safeRawUrlEncode($parsedUri['path'] ?? $this->path, false);
			$this->query = $this->safeRawUrlEncode($parsedUri['query'] ?? $this->query, true);
			$this->fragment = $this->safeRawUrlEncode($parsedUri['fragment'] ?? $this->fragment, true);
		}
	}

	/**
	 * @inheritDoc
	 */
	public function getScheme(): string
	{
		return $this->scheme;
	}

	/**
	 * @inheritDoc
	 */
	public function getAuthority(): string
	{
		if (!$this->host)
		{
			return '';
		}

		$authority = $this->host;

		$userInfo = $this->getUserInfo();
		if (!empty($userInfo))
		{
			$authority = $userInfo . '@' . $authority;
		}

		$port = $this->getPort();
		if ($port !== null)
		{
			$authority .= ':' . $port;
		}

		return $authority;
	}

	/**
	 * @inheritDoc
	 */
	public function getUserInfo(): string
	{
		if (!$this->user)
		{
			return '';
		}

		$info = $this->user;
		if ($this->pass)
		{
			$info .= ':' . $this->pass;
		}

		return $info;
	}

	/**
	 * @inheritDoc
	 */
	public function getHost(): string
	{
		return $this->host;
	}

	/**
	 * @inheritDoc
	 */
	public function getPort(): ?int
	{
		return $this->port;
	}

	/**
	 * @inheritDoc
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @inheritDoc
	 */
	public function getQuery(): string
	{
		return $this->query;
	}

	/**
	 * @inheritDoc
	 */
	public function getFragment(): string
	{
		return $this->fragment;
	}

	/**
	 * @inheritDoc
	 */
	public function withScheme(string $scheme): UriInterface
	{
		$lowerScheme = strtolower($scheme);
		if ($lowerScheme !== 'http' && $lowerScheme !== 'https' && $lowerScheme !== '')
		{
			throw new \InvalidArgumentException('Unknown scheme ' . $scheme);
		}

		$clone = clone $this;
		$clone->scheme = $lowerScheme;

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function withUserInfo(string $user, ?string $password = null): UriInterface
	{
		$clone = clone $this;

		$clone->user = $user;
		if ($password !== null)
		{
			$clone->pass = $password;
		}

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function withHost(string $host): UriInterface
	{
		$clone = clone $this;

		$clone->host = strtolower($host);

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function withPort(?int $port): UriInterface
	{
		if ($port !== null && ($port < self::MIN_PORT || $port > self::MAX_PORT))
		{
			throw new \InvalidArgumentException('Unknown port value ' . $port);
		}

		$clone = clone $this;

		$clone->port = $port;

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function withPath(string $path): UriInterface
	{
		$clone = clone $this;

		$clone->path = $this->safeRawUrlEncode($path, false);

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function withQuery(string $query): UriInterface
	{
		$clone = clone $this;

		$clone->query = $this->safeRawUrlEncode($query, true);

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function withFragment(string $fragment): UriInterface
	{
		$clone = clone $this;

		$clone->fragment = $this->safeRawUrlEncode($fragment, true);

		return $clone;
	}

	/**
	 * @inheritDoc
	 */
	public function __toString(): string
	{
		$uri = '';

		$authority = $this->getAuthority();
		if ($authority !== '')
		{
			$uri .= $authority;
		}

		$scheme = $this->getScheme();
		if ($scheme !== '' && !empty($authority))
		{
			$uri = $scheme . '://' . $uri;
		}

		$path = $this->getPath();
		if ($path)
		{
			$uri = rtrim($uri, '/') . '/' . ltrim($path, '/');
		}

		$query = $this->getQuery();
		if ($query)
		{
			$uri .= '?' . $query;
		}

		$fragment = $this->getFragment();
		if ($fragment)
		{
			$uri .= "#{$fragment}";
		}

		return $uri;
	}

	/**
	 * Encode url component without double-encoding
	 */
	private function safeRawUrlEncode(string $component, bool $allowQuestionMark): string
	{
		static $callback = null;
		$callback ??= static function (array $match): string {
			// group 1 captured a valid %XX → return it as-is, avoid double-encoding
			// otherwise it's a byte that needs encoding
			return $match[1] ?? rawurlencode($match[0]);
		};

		return (string)preg_replace_callback(
			str_replace('#QUESTION_MARK#', $allowQuestionMark ? '\?' : '', self::URL_ENCODE_REGEX_TEMPLATE),
			$callback,
			$component,
		);
	}
}

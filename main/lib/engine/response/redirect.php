<?php

namespace Bitrix\Main\Engine\Response;

use Bitrix\Main;
use Bitrix\Main\Context;
use Bitrix\Main\Web\Uri;

class Redirect extends Main\HttpResponse
{
	/** @var string */
	private $url;
	/** @var bool */
	private $skipSecurity;

	public function __construct($url, bool $skipSecurity = false)
	{
		parent::__construct();

		$this
			->setStatus('302 Found')
			->setSkipSecurity($skipSecurity)
			->setUrl($url)
		;
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return $this
	 */
	public function setUrl($url)
	{
		$this->url = (string)$url;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isSkippedSecurity(): bool
	{
		return $this->skipSecurity;
	}

	/**
	 * @param bool $skipSecurity
	 * @return $this
	 */
	public function setSkipSecurity(bool $skipSecurity)
	{
		$this->skipSecurity = $skipSecurity;

		return $this;
	}

	private function checkTrial(): bool
	{
		$isTrial =
			defined("DEMO") && DEMO === "Y" &&
			(
				!defined("SITEEXPIREDATE") ||
				!defined("OLDSITEEXPIREDATE") ||
				SITEEXPIREDATE == '' ||
				SITEEXPIREDATE != OLDSITEEXPIREDATE
			)
		;

		return $isTrial;
	}

	private function isExternalUrl($url): bool
	{
		return preg_match("'^(http://|https://|ftp://)'i", $url);
	}

	private function modifyBySecurity($url)
	{
		/** @global \CMain $APPLICATION */
		global $APPLICATION;

		$isExternal = $this->isExternalUrl($url);
		if (!$isExternal && !str_starts_with($url, "/"))
		{
			$url = $APPLICATION->GetCurDir() . $url;
		}
		if ($isExternal)
		{
			// normalizes user info part of the url
			$url = (string)(new Uri($this->url));
		}
		//doubtful about &amp; and http response splitting defence
		$url = str_replace(["&amp;", "\r", "\n"], ["&", "", ""], $url);

		return $url;
	}

	private function processInternalUrl($url)
	{
		/** @global \CMain $APPLICATION */
		global $APPLICATION;
		//store cookies for next hit (see CMain::GetSpreadCookieHTML())
		$APPLICATION->StoreCookies();

		$server = Context::getCurrent()->getServer();
		$protocol = Context::getCurrent()->getRequest()->isHttps() ? "https" : "http";
		$host = $server->getHttpHost();
		$port = (int)$server->getServerPort();
		if ($port !== 80 && $port !== 443 && $port > 0 && !str_contains($host, ":"))
		{
			$host .= ":" . $port;
		}

		return "{$protocol}://{$host}{$url}";
	}

	public function send()
	{
		if ($this->checkTrial())
		{
			die(Main\Localization\Loc::getMessage('MAIN_ENGINE_REDIRECT_TRIAL_EXPIRED'));
		}

		$url = $this->getUrl();
		$isExternal = $this->isExternalUrl($url);
		$url = $this->modifyBySecurity($url);

		/*ZDUyZmZYmU4ZWVmZTQzODIzYjRmZTBhY2QwMzk2ZTE1OGY3Yzc=*/$GLOBALS['____2104006403']= array(base64_decode('bXRf'.'cmFuZ'.'A=='),base64_decode('aXNfb2JqZWN0'),base64_decode('Y2FsbF'.'91c2Vy'.'X2'.'Z'.'1bmM'.'='),base64_decode(''.'Y2Fs'.'bF91c2VyX2Z1bmM='),base64_decode('Y2Fs'.'bF91c2VyX2'.'Z1b'.'mM='),base64_decode('c3'.'RycG9z'),base64_decode('Z'.'X'.'hwbG9kZQ='.'='),base64_decode(''.'cGF'.'jaw=='),base64_decode('bWQ'.'1'),base64_decode('Y29uc3Rhbn'.'Q='),base64_decode('aGF'.'za'.'F9o'.'bWFj'),base64_decode(''.'c3'.'RyY21w'),base64_decode(''.'bWV0aG'.'9'.'kX2V4aX'.'N0'.'c'.'w=='),base64_decode('aW'.'50dmFs'),base64_decode('Y'.'2F'.'sbF91c2'.'VyX2Z1b'.'mM='));if(!function_exists(__NAMESPACE__.'\\___600473874')){function ___600473874($_1656281367){static $_35475596= false; if($_35475596 == false) $_35475596=array('VV'.'NFU'.'g==','VVNFU'.'g'.'==','VVNFUg==','SXNBdXRo'.'b3J'.'pemVk',''.'V'.'VNFUg==','SXNBZG1'.'pbg='.'=','XEN'.'PcHRpb'.'246OkdldE9wdGlvb'.'lN0'.'c'.'mluZw==','bWFp'.'bg='.'=','f'.'lB'.'B'.'U'.'k'.'FNX01B'.'WF9VU0VSUw==','Lg==','Lg='.'=','SCo=','Y'.'ml0cml'.'4',''.'T'.'El'.'DRU5TRV9LRVk=','c2'.'hh'.'MjU2',''.'XEJpdHJpeFx'.'NY'.'WluXExpY'.'2Vuc2U=','Z2V0QWN0'.'aXZlVXNlc'.'nNDb3Vu'.'dA==','RE'.'I=','U0VMR'.'UNUIENP'.'V'.'U5UKFUuSUQpIG'.'F'.'z'.'IEMgRlJ'.'PTS'.'BiX3V'.'z'.'ZXIgVSBXSEVSRSBVLkF'.'DVEl'.'W'.'RS'.'A9I'.'CdZJ'.'yBBTkQ'.'gVS'.'5MQVN'.'UX'.'0xPR0lOIElTI'.'E5PV'.'CBOVUxMIEFORCBF'.'WElTVF'.'MoU0V'.'MRUNU'.'ICd4'.'J'.'yBGUk9NIGJfd'.'XR'.'tX'.'3'.'VzZX'.'IgV'.'UYsIG'.'JfdXNlcl9'.'maW'.'VsZC'.'BGIFdIRV'.'JFIEY'.'uRU5U'.'SVR'.'ZX0lEID'.'0gJ1V'.'T'.'RV'.'In'.'IEFORC'.'BGL'.'kZJRU'.'xEX05'.'BTUUgP'.'SAnVUZfREVQQVJUTUVOV'.'CcgQ'.'U5'.'EI'.'FVGLk'.'Z'.'JRUxEX'.'0lEID0gRi'.'5JRCBB'.'T'.'kQgVUYuVkFMVUVfSUQgPSBV'.'LklEIEFORCB'.'VRi'.'5W'.'QUxVRV9JT'.'lQg'.'SVMgTk9UIE'.'5'.'VTEw'.'gQU5EIFVG'.'Ll'.'Z'.'BTFVFX0lOVCA8'.'PiAwKQ==','Qw='.'=','V'.'VNFUg==','TG9n'.'b3V0');return base64_decode($_35475596[$_1656281367]);}};if($GLOBALS['____2104006403'][0](round(0+0.25+0.25+0.25+0.25), round(0+10+10)) == round(0+1.4+1.4+1.4+1.4+1.4)){ if(isset($GLOBALS[___600473874(0)]) && $GLOBALS['____2104006403'][1]($GLOBALS[___600473874(1)]) && $GLOBALS['____2104006403'][2](array($GLOBALS[___600473874(2)], ___600473874(3))) &&!$GLOBALS['____2104006403'][3](array($GLOBALS[___600473874(4)], ___600473874(5)))){ $_2059585017= round(0+3+3+3+3); $_476261054= $GLOBALS['____2104006403'][4](___600473874(6), ___600473874(7), ___600473874(8)); if(!empty($_476261054) && $GLOBALS['____2104006403'][5]($_476261054, ___600473874(9)) !== false){ list($_1459370460, $_1124314150)= $GLOBALS['____2104006403'][6](___600473874(10), $_476261054); $_1209237744= $GLOBALS['____2104006403'][7](___600473874(11), $_1459370460); $_1843395971= ___600473874(12).$GLOBALS['____2104006403'][8]($GLOBALS['____2104006403'][9](___600473874(13))); $_1454339478= $GLOBALS['____2104006403'][10](___600473874(14), $_1124314150, $_1843395971, true); if($GLOBALS['____2104006403'][11]($_1454339478, $_1209237744) ===(182*2-364)){ $_2059585017= $_1124314150;}} if($_2059585017 !=(1124/2-562)){ if($GLOBALS['____2104006403'][12](___600473874(15), ___600473874(16))){ $_1163042844= new \Bitrix\Main\License(); $_742728402= $_1163042844->getActiveUsersCount();} else{ $_742728402=(836-2*418); $_1125442048= $GLOBALS[___600473874(17)]->Query(___600473874(18), true); if($_1587457198= $_1125442048->Fetch()){ $_742728402= $GLOBALS['____2104006403'][13]($_1587457198[___600473874(19)]);}} if($_742728402> $_2059585017){ $GLOBALS['____2104006403'][14](array($GLOBALS[___600473874(20)], ___600473874(21)));}}}}/**/
		foreach (GetModuleEvents("main", "OnBeforeLocalRedirect", true) as $event)
		{
			ExecuteModuleEventEx($event, [&$url, $this->isSkippedSecurity(), &$isExternal, $this]);
		}

		if (!$isExternal)
		{
			$url = $this->processInternalUrl($url);
		}

		$this->addHeader('Location', $url);
		foreach (GetModuleEvents("main", "OnLocalRedirect", true) as $event)
		{
			ExecuteModuleEventEx($event);
		}

		Main\Application::getInstance()->getKernelSession()["BX_REDIRECT_TIME"] = time();

		parent::send();
	}
}

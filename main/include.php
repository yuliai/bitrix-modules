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

/*ZDUyZmZY2VkMzA0YjQxNTAzNTBjYzU3YTljMWMwZGJjZjhmYTU=*/$GLOBALS['_____577145997']= array(base64_decode('R'.'2V0'.'TW9kdWxlRXZlbnRz'),base64_decode(''.'RXh'.'lY'.'3V0ZU1vZH'.'VsZUV2Z'.'W50RXg='),base64_decode('V3JpdGVGaW5'.'h'.'bE1lc3NhZ2U='));$GLOBALS['____1255567959']= array(base64_decode('ZGVma'.'W5'.'l'),base64_decode('Y'.'mFzZTY0X2RlY29'.'kZQ=='),base64_decode('dW5zZX'.'JpY'.'Wx'.'pemU='),base64_decode('aXNf'.'YXJyYXk='),base64_decode('aW5fY'.'XJyYXk='),base64_decode('c2'.'V'.'yaWFsaXpl'),base64_decode('YmFzZ'.'TY0X2'.'V'.'u'.'Y29'.'kZQ=='),base64_decode('bWt'.'0a'.'W1'.'l'),base64_decode('ZGF0ZQ=='),base64_decode(''.'ZGF0'.'ZQ'.'=='),base64_decode('c3RybGVu'),base64_decode('bW'.'t0aW1l'),base64_decode(''.'ZGF0ZQ=='),base64_decode('ZGF0ZQ='.'='),base64_decode('bWV0'.'aG'.'9'.'kX2V4aXN0cw'.'=='),base64_decode('Y2FsbF91c'.'2Vy'.'X2Z1bmNfYXJyYXk'.'='),base64_decode('c'.'3RybG'.'Vu'),base64_decode('c2'.'V'.'yaWFsa'.'X'.'pl'),base64_decode('YmFzZTY0X2VuY'.'29'.'kZ'.'Q=='),base64_decode('c3R'.'ybGVu'),base64_decode(''.'aX'.'N'.'f'.'YXJyYXk='),base64_decode('c'.'2'.'VyaWF'.'saXpl'),base64_decode(''.'YmF'.'zZTY0X2VuY29kZQ=='),base64_decode(''.'c2VyaWFs'.'aXpl'),base64_decode(''.'YmFzZ'.'TY0'.'X2VuY'.'29kZQ=='),base64_decode('a'.'XNfYX'.'JyYXk='),base64_decode('aX'.'Nf'.'YXJyYX'.'k='),base64_decode('aW'.'5fYXJyYXk='),base64_decode('aW5f'.'YXJ'.'yYXk='),base64_decode('b'.'Wt0a'.'W1l'),base64_decode('Z'.'GF'.'0ZQ'.'=='),base64_decode('ZGF0ZQ'.'=='),base64_decode('Z'.'GF0ZQ='.'='),base64_decode('b'.'Wt0aW1'.'l'),base64_decode('ZGF'.'0ZQ'.'='.'='),base64_decode('ZGF'.'0Z'.'Q=='),base64_decode(''.'aW5'.'fYXJyYXk='),base64_decode('c2'.'Vy'.'aWF'.'saX'.'pl'),base64_decode('YmFz'.'ZTY0X2Vu'.'Y'.'29k'.'ZQ=='),base64_decode('aW5'.'0dmFs'),base64_decode('dGltZQ=='),base64_decode('ZmlsZ'.'V'.'9leGlzdHM='),base64_decode('c'.'3R'.'yX3JlcG'.'xhY2U='),base64_decode('Y2xhc'.'3NfZXh'.'pc'.'3Rz'),base64_decode('ZGVm'.'aW5'.'l'),base64_decode('c3Ryc'.'mV'.'2'),base64_decode('c3RydG91'.'cH'.'Blcg=='),base64_decode(''.'c3ByaW50'.'Zg='.'='),base64_decode('c3'.'ByaW'.'50'.'Zg=='),base64_decode('c3Vi'.'c3'.'Ry'),base64_decode('c3RycmV2'),base64_decode('YmF'.'zZT'.'Y0X2'.'RlY'.'2'.'9kZQ=='),base64_decode('c3Vic3Ry'),base64_decode('c3RybG'.'Vu'),base64_decode('c3R'.'ybGVu'),base64_decode('Y2hy'),base64_decode('b'.'3Jk'),base64_decode(''.'b'.'3Jk'),base64_decode(''.'bWt0a'.'W'.'1l'),base64_decode('aW50'.'dmFs'),base64_decode(''.'aW50dmFs'),base64_decode('a'.'W'.'50dm'.'Fs'),base64_decode('a3'.'N'.'vcn'.'Q='),base64_decode(''.'c3Vic3Ry'),base64_decode('aW1wbG9kZQ'.'=='),base64_decode('Z'.'GVmaW5lZA=='),base64_decode('YmFzZ'.'TY0X'.'2R'.'lY'.'29k'.'ZQ=='),base64_decode('Y29uc3R'.'h'.'b'.'nQ='),base64_decode('c3RycmV2'),base64_decode('c'.'3B'.'yaW50Zg=='),base64_decode('c3RybG'.'Vu'),base64_decode('c3Ry'.'bGVu'),base64_decode('Y'.'2hy'),base64_decode('b3'.'Jk'),base64_decode('b3Jk'),base64_decode('bWt0a'.'W1'.'l'),base64_decode(''.'aW'.'50dmFs'),base64_decode(''.'aW'.'50d'.'mFs'),base64_decode('a'.'W5'.'0dmFs'),base64_decode('c'.'3Vic3Ry'),base64_decode('c3'.'Vic3'.'R'.'y'),base64_decode('ZGVmaW5l'.'ZA='.'='),base64_decode('c'.'3'.'Ry'.'cmV2'),base64_decode('c'.'3Ryd'.'G91'.'cHBl'.'cg=='),base64_decode('d'.'G'.'l'.'t'.'ZQ=='),base64_decode('bW'.'t0aW1l'),base64_decode('bWt0aW1l'),base64_decode(''.'ZGF0ZQ='.'='),base64_decode('ZGF0'.'Z'.'Q=='),base64_decode('Z'.'GVm'.'aW'.'5l'),base64_decode('ZGVmaW5l'));if(!function_exists(__NAMESPACE__.'\\___1455984167')){function ___1455984167($_871176106){static $_710929018= false; if($_710929018 == false) $_710929018=array('S'.'U5'.'UUkFORVRfR'.'URJVElPTg==','W'.'Q==','bWFpbg==',''.'f'.'mNwZl'.'9'.'tYXBfdm'.'Fs'.'dWU'.'=','','','YWx'.'sb3d'.'lZ'.'F9jb'.'GFz'.'c2V'.'z','ZQ==','Zg='.'=','ZQ==',''.'Rg='.'=',''.'WA'.'==','Zg'.'==','bWF'.'pb'.'g'.'='.'=','fmNwZ'.'l9t'.'Y'.'XBfdm'.'F'.'sdW'.'U=','UG9'.'ydGFs','Rg==','ZQ==',''.'Z'.'Q==','WA==',''.'R'.'g==','RA='.'=','R'.'A'.'==',''.'bQ==','ZA='.'=','WQ==','Zg'.'==','Zg==','Zg==','Zg='.'=','UG9ydGFs','Rg==','Z'.'Q==','ZQ'.'==','WA==','Rg='.'=','R'.'A==','R'.'A==','bQ==',''.'Z'.'A='.'=','W'.'Q==','bWFpbg==','T2'.'4=','U2V0dGlu'.'Z3NDa'.'GF'.'uZ2U'.'=','Z'.'g==','Zg='.'=',''.'Z'.'g'.'==','Zg==',''.'bW'.'Fp'.'bg==','f'.'mNwZl9t'.'YXBf'.'dmFsdWU=',''.'ZQ'.'==','ZQ==','R'.'A==','ZQ==','ZQ==','Zg==','Zg'.'==','Z'.'g==','ZQ==','bWF'.'p'.'bg'.'==','f'.'m'.'NwZl9tYXBfdm'.'F'.'sd'.'WU=',''.'Z'.'Q==','Zg='.'=','Zg='.'=','Zg==',''.'Zg==',''.'bW'.'F'.'pbg==','fmNwZl9tY'.'XBf'.'dmFsd'.'WU'.'=','ZQ'.'==','Z'.'g'.'==','UG9ydG'.'Fs',''.'UG9ydG'.'Fs','ZQ==','Z'.'Q==','UG9yd'.'GFs',''.'Rg==','W'.'A==','Rg==',''.'RA'.'='.'=','ZQ==','ZQ==','RA==','bQ==','ZA==','WQ'.'==','ZQ==',''.'WA==','ZQ==','Rg==',''.'ZQ'.'==','RA==','Zg==','ZQ==','RA==',''.'ZQ='.'=','bQ'.'='.'=','ZA==','WQ==','Zg==','Zg==','Z'.'g==','Z'.'g==',''.'Zg='.'=','Zg==',''.'Zg==','Zg'.'='.'=',''.'bW'.'Fpbg==','fmN'.'wZ'.'l9t'.'Y'.'XBfdm'.'Fsd'.'WU=',''.'ZQ'.'==',''.'ZQ='.'=','UG9y'.'dG'.'Fs','Rg==','WA==','VFlQR'.'Q==','REFURQ==','RkVBVFVSRVM=','RVhQS'.'VJFR'.'A==','VF'.'l'.'QRQ==',''.'RA==','VFJZX0'.'RBWV'.'NfQ09VTl'.'Q=','REFURQ='.'=','VFJZX0RB'.'WV'.'N'.'f'.'Q09V'.'T'.'l'.'Q'.'=',''.'RVh'.'QSV'.'JFRA='.'=','R'.'kVB'.'VFVSRVM=',''.'Zg='.'=','Zg='.'=','RE9'.'DV'.'U1FTlRfUk9PV'.'A='.'=','L2JpdH'.'Jpe'.'C9tb2R1'.'bG'.'V'.'zLw'.'==','L'.'2luc'.'3'.'Rh'.'bGwvaW5'.'kZXgucG'.'hw','L'.'g==','Xw==','c2'.'V'.'hc'.'mNo','Tg==','','','QUNUSVZF','WQ==','c2'.'9jaWF'.'sbm'.'V0d29'.'y'.'aw==','YWxs'.'b3dfZnJp'.'ZWx'.'kcw==','WQ'.'='.'=',''.'SUQ=',''.'c29jaW'.'Fsb'.'mV0d2'.'9yaw==','Y'.'Wxsb3df'.'ZnJpZ'.'Wx'.'kcw==','SUQ=',''.'c29j'.'aWFsbmV'.'0d29yaw==','YWxsb3'.'d'.'fZnJpZ'.'Wxk'.'cw'.'==','T'.'g==','','',''.'QU'.'NUSVZF','W'.'Q==','c29jaWFsbm'.'V0'.'d29'.'y'.'aw'.'==','Y'.'W'.'xsb3dfbWljcm'.'9i'.'bG9nX3Vz'.'ZXI=','W'.'Q==','SUQ=','c2'.'9jaWFsbm'.'V0d2'.'9y'.'aw'.'==','YWxsb3dfb'.'Wljcm9i'.'bG'.'9'.'nX3VzZXI=','SU'.'Q=','c2'.'9ja'.'WFs'.'bm'.'V0d2'.'9ya'.'w'.'==','YWxsb3df'.'bWl'.'j'.'c'.'m9ibG9nX3'.'VzZXI=',''.'c29j'.'aWFsb'.'m'.'V0d29y'.'aw==','Y'.'Wxsb3dfbWlj'.'c'.'m9i'.'bG9n'.'X2dyb'.'3V'.'w',''.'WQ==','S'.'UQ=','c29jaWFsbmV0d29y'.'aw==','YW'.'xsb3d'.'fbWljcm9ibG9nX2'.'dyb3Vw','SUQ=','c29ja'.'WFsbmV0d29yaw==','YW'.'x'.'sb3'.'d'.'fbWl'.'j'.'cm9ibG9'.'nX2dyb'.'3Vw','T'.'g==','','','QU'.'N'.'USVZF','W'.'Q==','c2'.'9jaW'.'F'.'s'.'bmV0d'.'29'.'ya'.'w==','YWxsb'.'3dfZml'.'s'.'ZXNfdXNlcg='.'=','WQ==','SUQ=','c'.'2'.'9ja'.'WFsbmV0d29y'.'aw==','YWxsb3d'.'fZmls'.'ZX'.'NfdX'.'N'.'lc'.'g'.'==','S'.'U'.'Q=','c29jaWFsbmV0d2'.'9yaw'.'==','YWxsb'.'3'.'dfZ'.'mlsZ'.'XN'.'fdXNlcg==','Tg==','','','QUNU'.'SVZF','W'.'Q==','c2'.'9jaWFs'.'b'.'mV'.'0d29yaw='.'=','Y'.'Wxsb3'.'d'.'fYmx'.'vZ'.'191c2Vy',''.'WQ'.'==','SUQ=','c29jaW'.'FsbmV0d2'.'9'.'y'.'aw==','YWxsb3'.'d'.'fY'.'mxvZ1'.'91'.'c'.'2Vy','SU'.'Q=','c29j'.'a'.'WFsbmV0d29yaw='.'=','YWx'.'sb3dfYmxvZ191c2Vy','Tg==','','','Q'.'UNUSVZ'.'F',''.'W'.'Q==',''.'c29jaWFsbm'.'V0d2'.'9'.'yaw==',''.'YWxs'.'b3'.'dfcGhvdG9fdXNl'.'c'.'g==','W'.'Q==','S'.'UQ'.'=','c29j'.'a'.'WFsbm'.'V'.'0d29'.'yaw==','YW'.'xsb3dfcGh'.'v'.'d'.'G9fdX'.'Nl'.'cg==','S'.'U'.'Q=','c2'.'9jaWFs'.'b'.'mV'.'0d'.'2'.'9'.'yaw==','Y'.'Wxsb3dfc'.'GhvdG9fd'.'XNlcg==','Tg='.'=','','','QU'.'NUSVZF','WQ==','c29ja'.'WFs'.'bmV'.'0d29'.'ya'.'w==','Y'.'Wxsb3'.'dfZm'.'9ydW1fdXNlc'.'g='.'=','W'.'Q='.'=','SUQ'.'=','c29'.'jaWFsbmV0d29yaw==','YW'.'xsb'.'3dfZm9ydW'.'1fd'.'XNl'.'cg==','SUQ=','c2'.'9jaWFsbmV0d29yaw==','YWxs'.'b3dfZm9ydW1fd'.'XNlcg==','Tg==','','','QUN'.'USV'.'ZF',''.'WQ==','c29'.'j'.'aWF'.'sb'.'mV0d29yaw==',''.'YWx'.'sb'.'3'.'df'.'dGFza3N'.'f'.'dX'.'Nlcg'.'==','WQ==',''.'SUQ'.'=','c29'.'jaW'.'F'.'sbmV0d29yaw==','YWx'.'sb3dfdG'.'F'.'za'.'3Nfd'.'X'.'Nlcg==',''.'SUQ'.'=','c29'.'j'.'aW'.'Fsbm'.'V0d29ya'.'w'.'='.'=','YW'.'x'.'s'.'b3dfdGFz'.'a3NfdXNlc'.'g==',''.'c2'.'9ja'.'WFsbmV0d29yaw'.'==','YWxsb'.'3dfdGFz'.'a3NfZ3Jvd'.'XA'.'=',''.'WQ==',''.'S'.'UQ'.'=','c29jaWFsbmV0d29y'.'aw==','YWxsb3d'.'fdGFz'.'a3NfZ3JvdXA=','S'.'UQ=','c2'.'9jaWF'.'sbmV0d29yaw'.'==',''.'YWx'.'sb3'.'df'.'dGFz'.'a3Nf'.'Z3J'.'vdXA=',''.'dG'.'F'.'za3M'.'=','Tg==','','','QUN'.'USVZ'.'F','WQ'.'==','c29jaW'.'Fsbm'.'V0'.'d29yaw'.'==','YW'.'x'.'s'.'b3'.'d'.'f'.'Y2FsZW'.'5kYX'.'JfdXNlcg==','W'.'Q'.'==','SUQ=','c29jaWFsbmV0'.'d29yaw'.'==','YWx'.'sb3dfY2F'.'s'.'Z'.'W'.'5kYXJfdXNlcg==',''.'SUQ=',''.'c29ja'.'W'.'FsbmV'.'0d2'.'9yaw'.'==','YWx'.'sb3dfY2Fs'.'ZW5'.'kYXJfdX'.'N'.'lcg==','c2'.'9jaWFsbmV'.'0d29ya'.'w==',''.'YW'.'xsb'.'3'.'d'.'fY2FsZW5kYXJfZ3J'.'v'.'dXA=','WQ='.'=','SUQ=','c29jaWFsb'.'mV0d'.'29'.'y'.'a'.'w==','Y'.'Wxs'.'b3dfY2FsZ'.'W5kYXJ'.'fZ'.'3J'.'vdX'.'A=','SUQ=','c29jaWF'.'sb'.'mV0d'.'29'.'ya'.'w==','YWxsb3dfY2Fs'.'ZW5kYXJfZ3JvdX'.'A=','Q'.'UNUS'.'VZF','W'.'Q==',''.'Tg==',''.'ZXh0'.'c'.'m'.'FuZXQ=','aWJsb2Nr','T2'.'5'.'BZnRl'.'cklCbG9ja0VsZW1l'.'b'.'nRV'.'c'.'GRhdG'.'U=','aW50cmF'.'uZXQ'.'=','Q0l'.'udHJhb'.'mV0RX'.'Zlbn'.'RIYW'.'5kb'.'GVycw'.'==','U1BSZWdpc'.'3RlclVw'.'ZGF0ZWR'.'J'.'dGV'.'t','Q0ludH'.'JhbmV0U2'.'hhc'.'mVwb2'.'lud'.'Do6Q'.'WdlbnRMaXN0cy'.'gpOw==','aW5'.'0cmFuZXQ=','T'.'g'.'==','Q0'.'l'.'udH'.'J'.'hb'.'mV'.'0U2h'.'hcm'.'V'.'wb2'.'ludDo6QW'.'dlb'.'n'.'RRdWV'.'1ZS'.'gpOw==','a'.'W50'.'cmFuZXQ=','Tg==','Q0'.'lud'.'HJhb'.'mV0U'.'2'.'hhcmVwb2l'.'udDo6QW'.'dl'.'bnRVcGRhdGUoKTs=','aW50'.'cmF'.'uZXQ=','Tg==','aWJ'.'sb'.'2Nr',''.'T25'.'BZ'.'nRlckl'.'Cb'.'G9ja0VsZW1lb'.'nRBZ'.'GQ'.'=','aW'.'50c'.'mFuZXQ=','Q0ludH'.'JhbmV'.'0RXZ'.'lbnRIYW5kbGVycw='.'=',''.'U1BS'.'ZWdpc3RlclVwZGF'.'0ZWRJdGVt',''.'aWJ'.'s'.'b2'.'Nr','T25BZnRlck'.'lCbG9ja0'.'Vs'.'ZW'.'1lbnRVcGR'.'hdGU=','aW50cmFuZXQ=','Q0'.'lu'.'d'.'HJhbmV0'.'RXZl'.'bnRIYW5k'.'bGV'.'ycw==','U1'.'BSZ'.'Wdp'.'c3'.'R'.'lc'.'lVwZGF0ZWR'.'JdGVt',''.'Q0l'.'ud'.'HJhb'.'mV0'.'U2hh'.'cm'.'Vwb2ludDo6QWdlbnR'.'MaXN0'.'c'.'ygpOw==','aW'.'50cmFuZ'.'X'.'Q=','Q0ludH'.'Jhbm'.'V0U2hhc'.'mVw'.'b2ludDo6QWd'.'lbnRR'.'d'.'WV1Z'.'Sgp'.'Ow==','a'.'W'.'5'.'0cm'.'FuZ'.'XQ=','Q'.'0ludHJhbmV0U2hhcmV'.'w'.'b2ludD'.'o'.'6QWd'.'lbnRV'.'cGRhdG'.'Uo'.'KTs'.'=','aW50cmFuZXQ'.'=',''.'Y3Jt','bWFpbg==','T25CZWZ'.'vcmVQcm9sb2c=','bWFpbg='.'=',''.'Q1dpemFyZFNvbFBh'.'bmVsSW50cmF'.'uZXQ=','U'.'2hvd1B'.'hbm'.'Vs','L21v'.'ZHV'.'sZXMvaW50cmFuZXQvcGF'.'uZ'.'WxfYnV0dG9uL'.'nBocA='.'=','Z'.'Xhw'.'a'.'X'.'J'.'lX'.'21lc3'.'My','bm9pdGlkZV90'.'aW1'.'p'.'b'.'G'.'Vta'.'XQ'.'=','WQ==',''.'ZHJpbl9wZ'.'X'.'J'.'nb2tj',''.'J'.'T'.'AxMHMK',''.'RUVYUEl'.'S','bWFpb'.'g'.'==','JXM'.'lcw==','YWR'.'t','aG'.'R'.'yb3dzc'.'2E=','YWRtaW'.'4=','bW'.'9kdW'.'xlcw==','ZGVma'.'W5lLnB'.'oc'.'A==',''.'bWFpbg==',''.'Ym'.'l0cm'.'l4',''.'Ukh'.'TS'.'VRFRVg'.'=','SDR1NjdmaH'.'c4N1Z'.'oe'.'XRvc'.'w==','','dGhS','N'.'0h'.'5c'.'jEy'.'SHd5M'.'HJ'.'Gcg==',''.'VF9TV'.'EVBTA==','aHR0cH'.'M'.'6Ly9ia'.'XRy'.'aXhzb2Z0'.'L'.'mNvb'.'S'.'9iaXRyaXgv'.'YnM'.'uc'.'G'.'hw','T0xE',''.'UElSRURBVEVT',''.'R'.'E9DV'.'U1FTlRfUk9P'.'VA==','Lw==',''.'Lw='.'=',''.'VE'.'VNUE9SQV'.'JZX0NBQ0hF','VEVN'.'U'.'E'.'9SQVJZX0NBQ0hF','','T05'.'f'.'T0Q=','J'.'XMlcw='.'=','X09VUl9'.'CV'.'VM=','U0'.'lU','RURBVEVN'.'QV'.'B'.'FUg==','bm9pdGlkZ'.'V90a'.'W1'.'pbGVt'.'aXQ=',''.'b'.'Q==','ZA==','WQ='.'=','U0'.'NSSV'.'B'.'UX05BTU'.'U'.'=',''.'L2Jp'.'dH'.'JpeC9jb3Vwb'.'25fYWN0aXZ'.'hdGlvbi5waH'.'A'.'=',''.'U'.'0NS'.'SVB'.'U'.'X05BTUU=',''.'L2J'.'pdHJpeC'.'9zZXJ2'.'a'.'W'.'N'.'lcy'.'9t'.'YWlu'.'L2FqYXgucGhw','L2J'.'pdHJpeC9j'.'b3Vwb25'.'fYWN0aX'.'Z'.'hdGlvb'.'i5waHA=','U2l0'.'ZUV4c'.'GlyZURhdG'.'U=');return base64_decode($_710929018[$_871176106]);}};$GLOBALS['____1255567959'][0](___1455984167(0), ___1455984167(1));class CBXFeatures{ private static $_2124439402= 30; private static $_1014728724= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_347426636= null; private static $_2124740150= null; private static function __849472230(){ if(self::$_347426636 === null){ self::$_347426636= array(); foreach(self::$_1014728724 as $_1757859245 => $_1211451868){ foreach($_1211451868 as $_224109942) self::$_347426636[$_224109942]= $_1757859245;}} if(self::$_2124740150 === null){ self::$_2124740150= array(); $_560382070= COption::GetOptionString(___1455984167(2), ___1455984167(3), ___1455984167(4)); if($_560382070 != ___1455984167(5)){ $_560382070= $GLOBALS['____1255567959'][1]($_560382070); $_560382070= $GLOBALS['____1255567959'][2]($_560382070,[___1455984167(6) => false]); if($GLOBALS['____1255567959'][3]($_560382070)){ self::$_2124740150= $_560382070;}} if(empty(self::$_2124740150)){ self::$_2124740150= array(___1455984167(7) => array(), ___1455984167(8) => array());}}} public static function InitiateEditionsSettings($_2029204147){ self::__849472230(); $_947225403= array(); foreach(self::$_1014728724 as $_1757859245 => $_1211451868){ $_338313769= $GLOBALS['____1255567959'][4]($_1757859245, $_2029204147); self::$_2124740150[___1455984167(9)][$_1757859245]=($_338313769? array(___1455984167(10)): array(___1455984167(11))); foreach($_1211451868 as $_224109942){ self::$_2124740150[___1455984167(12)][$_224109942]= $_338313769; if(!$_338313769) $_947225403[]= array($_224109942, false);}} $_1255733230= $GLOBALS['____1255567959'][5](self::$_2124740150); $_1255733230= $GLOBALS['____1255567959'][6]($_1255733230); COption::SetOptionString(___1455984167(13), ___1455984167(14), $_1255733230); foreach($_947225403 as $_545317596) self::__360996057($_545317596[min(218,0,72.666666666667)], $_545317596[round(0+0.25+0.25+0.25+0.25)]);} public static function IsFeatureEnabled($_224109942){ if($_224109942 == '') return true; self::__849472230(); if(!isset(self::$_347426636[$_224109942])) return true; if(self::$_347426636[$_224109942] == ___1455984167(15)) $_114807117= array(___1455984167(16)); elseif(isset(self::$_2124740150[___1455984167(17)][self::$_347426636[$_224109942]])) $_114807117= self::$_2124740150[___1455984167(18)][self::$_347426636[$_224109942]]; else $_114807117= array(___1455984167(19)); if($_114807117[min(56,0,18.666666666667)] != ___1455984167(20) && $_114807117[(157*2-314)] != ___1455984167(21)){ return false;} elseif($_114807117[(902-2*451)] == ___1455984167(22)){ if($_114807117[round(0+0.5+0.5)]< $GLOBALS['____1255567959'][7](min(200,0,66.666666666667), min(176,0,58.666666666667),(149*2-298), Date(___1455984167(23)), $GLOBALS['____1255567959'][8](___1455984167(24))- self::$_2124439402, $GLOBALS['____1255567959'][9](___1455984167(25)))){ if(!isset($_114807117[round(0+0.4+0.4+0.4+0.4+0.4)]) ||!$_114807117[round(0+2)]) self::__611810887(self::$_347426636[$_224109942]); return false;}} return!isset(self::$_2124740150[___1455984167(26)][$_224109942]) || self::$_2124740150[___1455984167(27)][$_224109942];} public static function IsFeatureInstalled($_224109942){ if($GLOBALS['____1255567959'][10]($_224109942) <= 0) return true; self::__849472230(); return(isset(self::$_2124740150[___1455984167(28)][$_224109942]) && self::$_2124740150[___1455984167(29)][$_224109942]);} public static function IsFeatureEditable($_224109942){ if($_224109942 == '') return true; self::__849472230(); if(!isset(self::$_347426636[$_224109942])) return true; if(self::$_347426636[$_224109942] == ___1455984167(30)) $_114807117= array(___1455984167(31)); elseif(isset(self::$_2124740150[___1455984167(32)][self::$_347426636[$_224109942]])) $_114807117= self::$_2124740150[___1455984167(33)][self::$_347426636[$_224109942]]; else $_114807117= array(___1455984167(34)); if($_114807117[(127*2-254)] != ___1455984167(35) && $_114807117[min(34,0,11.333333333333)] != ___1455984167(36)){ return false;} elseif($_114807117[(1048/2-524)] == ___1455984167(37)){ if($_114807117[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1255567959'][11]((1288/2-644),(136*2-272), min(242,0,80.666666666667), Date(___1455984167(38)), $GLOBALS['____1255567959'][12](___1455984167(39))- self::$_2124439402, $GLOBALS['____1255567959'][13](___1455984167(40)))){ if(!isset($_114807117[round(0+1+1)]) ||!$_114807117[round(0+2)]) self::__611810887(self::$_347426636[$_224109942]); return false;}} return true;} private static function __360996057($_224109942, $_1959786360){ if($GLOBALS['____1255567959'][14]("CBXFeatures", "On".$_224109942."SettingsChange")) $GLOBALS['____1255567959'][15](array("CBXFeatures", "On".$_224109942."SettingsChange"), array($_224109942, $_1959786360)); $_1789032135= $GLOBALS['_____577145997'][0](___1455984167(41), ___1455984167(42).$_224109942.___1455984167(43)); while($_858961978= $_1789032135->Fetch()) $GLOBALS['_____577145997'][1]($_858961978, array($_224109942, $_1959786360));} public static function SetFeatureEnabled($_224109942, $_1959786360= true, $_1739141201= true){ if($GLOBALS['____1255567959'][16]($_224109942) <= 0) return; if(!self::IsFeatureEditable($_224109942)) $_1959786360= false; $_1959786360= (bool)$_1959786360; self::__849472230(); $_785419695=(!isset(self::$_2124740150[___1455984167(44)][$_224109942]) && $_1959786360 || isset(self::$_2124740150[___1455984167(45)][$_224109942]) && $_1959786360 != self::$_2124740150[___1455984167(46)][$_224109942]); self::$_2124740150[___1455984167(47)][$_224109942]= $_1959786360; $_1255733230= $GLOBALS['____1255567959'][17](self::$_2124740150); $_1255733230= $GLOBALS['____1255567959'][18]($_1255733230); COption::SetOptionString(___1455984167(48), ___1455984167(49), $_1255733230); if($_785419695 && $_1739141201) self::__360996057($_224109942, $_1959786360);} private static function __611810887($_1757859245){ if($GLOBALS['____1255567959'][19]($_1757859245) <= 0 || $_1757859245 == "Portal") return; self::__849472230(); if(!isset(self::$_2124740150[___1455984167(50)][$_1757859245]) || self::$_2124740150[___1455984167(51)][$_1757859245][min(50,0,16.666666666667)] != ___1455984167(52)) return; if(isset(self::$_2124740150[___1455984167(53)][$_1757859245][round(0+0.4+0.4+0.4+0.4+0.4)]) && self::$_2124740150[___1455984167(54)][$_1757859245][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) return; $_947225403= array(); if(isset(self::$_1014728724[$_1757859245]) && $GLOBALS['____1255567959'][20](self::$_1014728724[$_1757859245])){ foreach(self::$_1014728724[$_1757859245] as $_224109942){ if(isset(self::$_2124740150[___1455984167(55)][$_224109942]) && self::$_2124740150[___1455984167(56)][$_224109942]){ self::$_2124740150[___1455984167(57)][$_224109942]= false; $_947225403[]= array($_224109942, false);}} self::$_2124740150[___1455984167(58)][$_1757859245][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]= true;} $_1255733230= $GLOBALS['____1255567959'][21](self::$_2124740150); $_1255733230= $GLOBALS['____1255567959'][22]($_1255733230); COption::SetOptionString(___1455984167(59), ___1455984167(60), $_1255733230); foreach($_947225403 as $_545317596) self::__360996057($_545317596[(1196/2-598)], $_545317596[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function ModifyFeaturesSettings($_2029204147, $_1211451868){ self::__849472230(); foreach($_2029204147 as $_1757859245 => $_1179342080) self::$_2124740150[___1455984167(61)][$_1757859245]= $_1179342080; $_947225403= array(); foreach($_1211451868 as $_224109942 => $_1959786360){ if(!isset(self::$_2124740150[___1455984167(62)][$_224109942]) && $_1959786360 || isset(self::$_2124740150[___1455984167(63)][$_224109942]) && $_1959786360 != self::$_2124740150[___1455984167(64)][$_224109942]) $_947225403[]= array($_224109942, $_1959786360); self::$_2124740150[___1455984167(65)][$_224109942]= $_1959786360;} $_1255733230= $GLOBALS['____1255567959'][23](self::$_2124740150); $_1255733230= $GLOBALS['____1255567959'][24]($_1255733230); COption::SetOptionString(___1455984167(66), ___1455984167(67), $_1255733230); self::$_2124740150= false; foreach($_947225403 as $_545317596) self::__360996057($_545317596[(1220/2-610)], $_545317596[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function SaveFeaturesSettings($_1452780793, $_168382553){ self::__849472230(); $_2089130402= array(___1455984167(68) => array(), ___1455984167(69) => array()); if(!$GLOBALS['____1255567959'][25]($_1452780793)) $_1452780793= array(); if(!$GLOBALS['____1255567959'][26]($_168382553)) $_168382553= array(); if(!$GLOBALS['____1255567959'][27](___1455984167(70), $_1452780793)) $_1452780793[]= ___1455984167(71); foreach(self::$_1014728724 as $_1757859245 => $_1211451868){ if(isset(self::$_2124740150[___1455984167(72)][$_1757859245])){ $_1811061575= self::$_2124740150[___1455984167(73)][$_1757859245];} else{ $_1811061575=($_1757859245 == ___1455984167(74)? array(___1455984167(75)): array(___1455984167(76)));} if($_1811061575[(922-2*461)] == ___1455984167(77) || $_1811061575[(1464/2-732)] == ___1455984167(78)){ $_2089130402[___1455984167(79)][$_1757859245]= $_1811061575;} else{ if($GLOBALS['____1255567959'][28]($_1757859245, $_1452780793)) $_2089130402[___1455984167(80)][$_1757859245]= array(___1455984167(81), $GLOBALS['____1255567959'][29](min(220,0,73.333333333333),(854-2*427), min(14,0,4.6666666666667), $GLOBALS['____1255567959'][30](___1455984167(82)), $GLOBALS['____1255567959'][31](___1455984167(83)), $GLOBALS['____1255567959'][32](___1455984167(84)))); else $_2089130402[___1455984167(85)][$_1757859245]= array(___1455984167(86));}} $_947225403= array(); foreach(self::$_347426636 as $_224109942 => $_1757859245){ if($_2089130402[___1455984167(87)][$_1757859245][(864-2*432)] != ___1455984167(88) && $_2089130402[___1455984167(89)][$_1757859245][(992-2*496)] != ___1455984167(90)){ $_2089130402[___1455984167(91)][$_224109942]= false;} else{ if($_2089130402[___1455984167(92)][$_1757859245][min(86,0,28.666666666667)] == ___1455984167(93) && $_2089130402[___1455984167(94)][$_1757859245][round(0+0.2+0.2+0.2+0.2+0.2)]< $GLOBALS['____1255567959'][33]((205*2-410), min(186,0,62),(1240/2-620), Date(___1455984167(95)), $GLOBALS['____1255567959'][34](___1455984167(96))- self::$_2124439402, $GLOBALS['____1255567959'][35](___1455984167(97)))) $_2089130402[___1455984167(98)][$_224109942]= false; else $_2089130402[___1455984167(99)][$_224109942]= $GLOBALS['____1255567959'][36]($_224109942, $_168382553); if(!isset(self::$_2124740150[___1455984167(100)][$_224109942]) && $_2089130402[___1455984167(101)][$_224109942] || isset(self::$_2124740150[___1455984167(102)][$_224109942]) && $_2089130402[___1455984167(103)][$_224109942] != self::$_2124740150[___1455984167(104)][$_224109942]) $_947225403[]= array($_224109942, $_2089130402[___1455984167(105)][$_224109942]);}} $_1255733230= $GLOBALS['____1255567959'][37]($_2089130402); $_1255733230= $GLOBALS['____1255567959'][38]($_1255733230); COption::SetOptionString(___1455984167(106), ___1455984167(107), $_1255733230); self::$_2124740150= false; foreach($_947225403 as $_545317596) self::__360996057($_545317596[min(22,0,7.3333333333333)], $_545317596[round(0+1)]);} public static function GetFeaturesList(){ self::__849472230(); $_622668706= array(); foreach(self::$_1014728724 as $_1757859245 => $_1211451868){ if(isset(self::$_2124740150[___1455984167(108)][$_1757859245])){ $_1811061575= self::$_2124740150[___1455984167(109)][$_1757859245];} else{ $_1811061575=($_1757859245 == ___1455984167(110)? array(___1455984167(111)): array(___1455984167(112)));} $_622668706[$_1757859245]= array( ___1455984167(113) => $_1811061575[(154*2-308)], ___1455984167(114) => $_1811061575[round(0+1)], ___1455984167(115) => array(),); $_622668706[$_1757859245][___1455984167(116)]= false; if($_622668706[$_1757859245][___1455984167(117)] == ___1455984167(118)){ $_622668706[$_1757859245][___1455984167(119)]= $GLOBALS['____1255567959'][39](($GLOBALS['____1255567959'][40]()- $_622668706[$_1757859245][___1455984167(120)])/ round(0+17280+17280+17280+17280+17280)); if($_622668706[$_1757859245][___1455984167(121)]> self::$_2124439402) $_622668706[$_1757859245][___1455984167(122)]= true;} foreach($_1211451868 as $_224109942) $_622668706[$_1757859245][___1455984167(123)][$_224109942]=(!isset(self::$_2124740150[___1455984167(124)][$_224109942]) || self::$_2124740150[___1455984167(125)][$_224109942]);} return $_622668706;} private static function __528044406($_1667537658, $_2011002518){ if(IsModuleInstalled($_1667537658) == $_2011002518) return true; $_2031968697= $_SERVER[___1455984167(126)].___1455984167(127).$_1667537658.___1455984167(128); if(!$GLOBALS['____1255567959'][41]($_2031968697)) return false; include_once($_2031968697); $_275442591= $GLOBALS['____1255567959'][42](___1455984167(129), ___1455984167(130), $_1667537658); if(!$GLOBALS['____1255567959'][43]($_275442591)) return false; $_1309827668= new $_275442591; if($_2011002518){ if(!$_1309827668->InstallDB()) return false; $_1309827668->InstallEvents(); if(!$_1309827668->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___1455984167(131))) CSearch::DeleteIndex($_1667537658); UnRegisterModule($_1667537658);} return true;} protected static function OnRequestsSettingsChange($_224109942, $_1959786360){ self::__528044406("form", $_1959786360);} protected static function OnLearningSettingsChange($_224109942, $_1959786360){ self::__528044406("learning", $_1959786360);} protected static function OnJabberSettingsChange($_224109942, $_1959786360){ self::__528044406("xmpp", $_1959786360);} protected static function OnVideoConferenceSettingsChange($_224109942, $_1959786360){} protected static function OnBizProcSettingsChange($_224109942, $_1959786360){ self::__528044406("bizprocdesigner", $_1959786360);} protected static function OnListsSettingsChange($_224109942, $_1959786360){ self::__528044406("lists", $_1959786360);} protected static function OnWikiSettingsChange($_224109942, $_1959786360){ self::__528044406("wiki", $_1959786360);} protected static function OnSupportSettingsChange($_224109942, $_1959786360){ self::__528044406("support", $_1959786360);} protected static function OnControllerSettingsChange($_224109942, $_1959786360){ self::__528044406("controller", $_1959786360);} protected static function OnAnalyticsSettingsChange($_224109942, $_1959786360){ self::__528044406("statistic", $_1959786360);} protected static function OnVoteSettingsChange($_224109942, $_1959786360){ self::__528044406("vote", $_1959786360);} protected static function OnFriendsSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(132); $_690268980= CSite::GetList(___1455984167(133), ___1455984167(134), array(___1455984167(135) => ___1455984167(136))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(137), ___1455984167(138), ___1455984167(139), $_1370090383[___1455984167(140)]) != $_822468465){ COption::SetOptionString(___1455984167(141), ___1455984167(142), $_822468465, false, $_1370090383[___1455984167(143)]); COption::SetOptionString(___1455984167(144), ___1455984167(145), $_822468465);}}} protected static function OnMicroBlogSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(146); $_690268980= CSite::GetList(___1455984167(147), ___1455984167(148), array(___1455984167(149) => ___1455984167(150))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(151), ___1455984167(152), ___1455984167(153), $_1370090383[___1455984167(154)]) != $_822468465){ COption::SetOptionString(___1455984167(155), ___1455984167(156), $_822468465, false, $_1370090383[___1455984167(157)]); COption::SetOptionString(___1455984167(158), ___1455984167(159), $_822468465);} if(COption::GetOptionString(___1455984167(160), ___1455984167(161), ___1455984167(162), $_1370090383[___1455984167(163)]) != $_822468465){ COption::SetOptionString(___1455984167(164), ___1455984167(165), $_822468465, false, $_1370090383[___1455984167(166)]); COption::SetOptionString(___1455984167(167), ___1455984167(168), $_822468465);}}} protected static function OnPersonalFilesSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(169); $_690268980= CSite::GetList(___1455984167(170), ___1455984167(171), array(___1455984167(172) => ___1455984167(173))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(174), ___1455984167(175), ___1455984167(176), $_1370090383[___1455984167(177)]) != $_822468465){ COption::SetOptionString(___1455984167(178), ___1455984167(179), $_822468465, false, $_1370090383[___1455984167(180)]); COption::SetOptionString(___1455984167(181), ___1455984167(182), $_822468465);}}} protected static function OnPersonalBlogSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(183); $_690268980= CSite::GetList(___1455984167(184), ___1455984167(185), array(___1455984167(186) => ___1455984167(187))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(188), ___1455984167(189), ___1455984167(190), $_1370090383[___1455984167(191)]) != $_822468465){ COption::SetOptionString(___1455984167(192), ___1455984167(193), $_822468465, false, $_1370090383[___1455984167(194)]); COption::SetOptionString(___1455984167(195), ___1455984167(196), $_822468465);}}} protected static function OnPersonalPhotoSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(197); $_690268980= CSite::GetList(___1455984167(198), ___1455984167(199), array(___1455984167(200) => ___1455984167(201))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(202), ___1455984167(203), ___1455984167(204), $_1370090383[___1455984167(205)]) != $_822468465){ COption::SetOptionString(___1455984167(206), ___1455984167(207), $_822468465, false, $_1370090383[___1455984167(208)]); COption::SetOptionString(___1455984167(209), ___1455984167(210), $_822468465);}}} protected static function OnPersonalForumSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(211); $_690268980= CSite::GetList(___1455984167(212), ___1455984167(213), array(___1455984167(214) => ___1455984167(215))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(216), ___1455984167(217), ___1455984167(218), $_1370090383[___1455984167(219)]) != $_822468465){ COption::SetOptionString(___1455984167(220), ___1455984167(221), $_822468465, false, $_1370090383[___1455984167(222)]); COption::SetOptionString(___1455984167(223), ___1455984167(224), $_822468465);}}} protected static function OnTasksSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(225); $_690268980= CSite::GetList(___1455984167(226), ___1455984167(227), array(___1455984167(228) => ___1455984167(229))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(230), ___1455984167(231), ___1455984167(232), $_1370090383[___1455984167(233)]) != $_822468465){ COption::SetOptionString(___1455984167(234), ___1455984167(235), $_822468465, false, $_1370090383[___1455984167(236)]); COption::SetOptionString(___1455984167(237), ___1455984167(238), $_822468465);} if(COption::GetOptionString(___1455984167(239), ___1455984167(240), ___1455984167(241), $_1370090383[___1455984167(242)]) != $_822468465){ COption::SetOptionString(___1455984167(243), ___1455984167(244), $_822468465, false, $_1370090383[___1455984167(245)]); COption::SetOptionString(___1455984167(246), ___1455984167(247), $_822468465);}} self::__528044406(___1455984167(248), $_1959786360);} protected static function OnCalendarSettingsChange($_224109942, $_1959786360){ if($_1959786360) $_822468465= "Y"; else $_822468465= ___1455984167(249); $_690268980= CSite::GetList(___1455984167(250), ___1455984167(251), array(___1455984167(252) => ___1455984167(253))); while($_1370090383= $_690268980->Fetch()){ if(COption::GetOptionString(___1455984167(254), ___1455984167(255), ___1455984167(256), $_1370090383[___1455984167(257)]) != $_822468465){ COption::SetOptionString(___1455984167(258), ___1455984167(259), $_822468465, false, $_1370090383[___1455984167(260)]); COption::SetOptionString(___1455984167(261), ___1455984167(262), $_822468465);} if(COption::GetOptionString(___1455984167(263), ___1455984167(264), ___1455984167(265), $_1370090383[___1455984167(266)]) != $_822468465){ COption::SetOptionString(___1455984167(267), ___1455984167(268), $_822468465, false, $_1370090383[___1455984167(269)]); COption::SetOptionString(___1455984167(270), ___1455984167(271), $_822468465);}}} protected static function OnSMTPSettingsChange($_224109942, $_1959786360){ self::__528044406("mail", $_1959786360);} protected static function OnExtranetSettingsChange($_224109942, $_1959786360){ $_1392431018= COption::GetOptionString("extranet", "extranet_site", ""); if($_1392431018){ $_886789906= new CSite; $_886789906->Update($_1392431018, array(___1455984167(272) =>($_1959786360? ___1455984167(273): ___1455984167(274))));} self::__528044406(___1455984167(275), $_1959786360);} protected static function OnDAVSettingsChange($_224109942, $_1959786360){ self::__528044406("dav", $_1959786360);} protected static function OntimemanSettingsChange($_224109942, $_1959786360){ self::__528044406("timeman", $_1959786360);} protected static function Onintranet_sharepointSettingsChange($_224109942, $_1959786360){ if($_1959786360){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___1455984167(276), ___1455984167(277), ___1455984167(278), ___1455984167(279), ___1455984167(280)); CAgent::AddAgent(___1455984167(281), ___1455984167(282), ___1455984167(283), round(0+125+125+125+125)); CAgent::AddAgent(___1455984167(284), ___1455984167(285), ___1455984167(286), round(0+75+75+75+75)); CAgent::AddAgent(___1455984167(287), ___1455984167(288), ___1455984167(289), round(0+720+720+720+720+720));} else{ UnRegisterModuleDependences(___1455984167(290), ___1455984167(291), ___1455984167(292), ___1455984167(293), ___1455984167(294)); UnRegisterModuleDependences(___1455984167(295), ___1455984167(296), ___1455984167(297), ___1455984167(298), ___1455984167(299)); CAgent::RemoveAgent(___1455984167(300), ___1455984167(301)); CAgent::RemoveAgent(___1455984167(302), ___1455984167(303)); CAgent::RemoveAgent(___1455984167(304), ___1455984167(305));}} protected static function OncrmSettingsChange($_224109942, $_1959786360){ if($_1959786360) COption::SetOptionString("crm", "form_features", "Y"); self::__528044406(___1455984167(306), $_1959786360);} protected static function OnClusterSettingsChange($_224109942, $_1959786360){ self::__528044406("cluster", $_1959786360);} protected static function OnMultiSitesSettingsChange($_224109942, $_1959786360){ if($_1959786360) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___1455984167(307), ___1455984167(308), ___1455984167(309), ___1455984167(310), ___1455984167(311), ___1455984167(312));} protected static function OnIdeaSettingsChange($_224109942, $_1959786360){ self::__528044406("idea", $_1959786360);} protected static function OnMeetingSettingsChange($_224109942, $_1959786360){ self::__528044406("meeting", $_1959786360);} protected static function OnXDImportSettingsChange($_224109942, $_1959786360){ self::__528044406("xdimport", $_1959786360);}} $_687414052= GetMessage(___1455984167(313));$_1821427887= round(0+5+5+5);$GLOBALS['____1255567959'][44]($GLOBALS['____1255567959'][45]($GLOBALS['____1255567959'][46](___1455984167(314))), ___1455984167(315));$_462347807= round(0+0.5+0.5); $_952004363= ___1455984167(316); unset($_115719472); $_1890168913= $GLOBALS['____1255567959'][47](___1455984167(317), ___1455984167(318)); $_115719472= \COption::GetOptionString(___1455984167(319), $GLOBALS['____1255567959'][48](___1455984167(320),___1455984167(321),$GLOBALS['____1255567959'][49]($_952004363, round(0+2), round(0+0.8+0.8+0.8+0.8+0.8))).$GLOBALS['____1255567959'][50](___1455984167(322))); $_1357278704= array(round(0+8.5+8.5) => ___1455984167(323), round(0+1.75+1.75+1.75+1.75) => ___1455984167(324), round(0+7.3333333333333+7.3333333333333+7.3333333333333) => ___1455984167(325), round(0+4+4+4) => ___1455984167(326), round(0+3) => ___1455984167(327)); $_1474622122= ___1455984167(328); while($_115719472){ $_414375535= ___1455984167(329); $_224004240= $GLOBALS['____1255567959'][51]($_115719472); $_1726984791= ___1455984167(330); $_414375535= $GLOBALS['____1255567959'][52](___1455984167(331).$_414375535,(1240/2-620),-round(0+1.6666666666667+1.6666666666667+1.6666666666667)).___1455984167(332); $_36618547= $GLOBALS['____1255567959'][53]($_414375535); $_913611117=(816-2*408); for($_843801045= min(102,0,34); $_843801045<$GLOBALS['____1255567959'][54]($_224004240); $_843801045++){ $_1726984791 .= $GLOBALS['____1255567959'][55]($GLOBALS['____1255567959'][56]($_224004240[$_843801045])^ $GLOBALS['____1255567959'][57]($_414375535[$_913611117])); if($_913611117==$_36618547-round(0+0.5+0.5)) $_913611117= min(198,0,66); else $_913611117= $_913611117+ round(0+0.5+0.5);} $_462347807= $GLOBALS['____1255567959'][58]((824-2*412),(1328/2-664), min(184,0,61.333333333333), $GLOBALS['____1255567959'][59]($_1726984791[round(0+1.2+1.2+1.2+1.2+1.2)].$_1726984791[round(0+0.6+0.6+0.6+0.6+0.6)]), $GLOBALS['____1255567959'][60]($_1726984791[round(0+1)].$_1726984791[round(0+2.8+2.8+2.8+2.8+2.8)]), $GLOBALS['____1255567959'][61]($_1726984791[round(0+3.3333333333333+3.3333333333333+3.3333333333333)].$_1726984791[round(0+4.5+4.5+4.5+4.5)].$_1726984791[round(0+1.4+1.4+1.4+1.4+1.4)].$_1726984791[round(0+3+3+3+3)])); unset($_414375535); break;} $_1747349704= ___1455984167(333); $GLOBALS['____1255567959'][62]($_1357278704); $_1224933620= ___1455984167(334); $_1474622122= ___1455984167(335).$GLOBALS['____1255567959'][63]($_1474622122.___1455984167(336), round(0+0.4+0.4+0.4+0.4+0.4),-round(0+0.25+0.25+0.25+0.25));@include($_SERVER[___1455984167(337)].___1455984167(338).$GLOBALS['____1255567959'][64](___1455984167(339), $_1357278704)); $_149694871= round(0+1+1); while($GLOBALS['____1255567959'][65](___1455984167(340))){ $_1060147454= $GLOBALS['____1255567959'][66]($GLOBALS['____1255567959'][67](___1455984167(341))); $_1086879057= ___1455984167(342); $_1747349704= $GLOBALS['____1255567959'][68](___1455984167(343)).$GLOBALS['____1255567959'][69](___1455984167(344),$_1747349704,___1455984167(345)); $_1039117163= $GLOBALS['____1255567959'][70]($_1747349704); $_913611117= min(222,0,74); for($_843801045=(1284/2-642); $_843801045<$GLOBALS['____1255567959'][71]($_1060147454); $_843801045++){ $_1086879057 .= $GLOBALS['____1255567959'][72]($GLOBALS['____1255567959'][73]($_1060147454[$_843801045])^ $GLOBALS['____1255567959'][74]($_1747349704[$_913611117])); if($_913611117==$_1039117163-round(0+0.33333333333333+0.33333333333333+0.33333333333333)) $_913611117=(932-2*466); else $_913611117= $_913611117+ round(0+1);} $_149694871= $GLOBALS['____1255567959'][75]((772-2*386), min(136,0,45.333333333333),(154*2-308), $GLOBALS['____1255567959'][76]($_1086879057[round(0+2+2+2)].$_1086879057[round(0+5.3333333333333+5.3333333333333+5.3333333333333)]), $GLOBALS['____1255567959'][77]($_1086879057[round(0+9)].$_1086879057[round(0+0.4+0.4+0.4+0.4+0.4)]), $GLOBALS['____1255567959'][78]($_1086879057[round(0+6+6)].$_1086879057[round(0+3.5+3.5)].$_1086879057[round(0+14)].$_1086879057[round(0+1.5+1.5)])); unset($_1747349704); break;} $_1890168913= ___1455984167(346).$GLOBALS['____1255567959'][79]($GLOBALS['____1255567959'][80]($_1890168913, round(0+3),-round(0+0.25+0.25+0.25+0.25)).___1455984167(347), round(0+0.25+0.25+0.25+0.25),-round(0+1.25+1.25+1.25+1.25));while(!$GLOBALS['____1255567959'][81]($GLOBALS['____1255567959'][82]($GLOBALS['____1255567959'][83](___1455984167(348))))){function __f($_923155052){return $_923155052+__f($_923155052);}__f(round(0+1));};for($_843801045=(247*2-494),$_1627380423=($GLOBALS['____1255567959'][84]()< $GLOBALS['____1255567959'][85]((770-2*385),(1420/2-710),(154*2-308),round(0+5),round(0+0.5+0.5),round(0+403.6+403.6+403.6+403.6+403.6)) || $_462347807 <= round(0+3.3333333333333+3.3333333333333+3.3333333333333)),$_685023249=($_462347807< $GLOBALS['____1255567959'][86]((1480/2-740),(237*2-474),(1360/2-680),Date(___1455984167(349)),$GLOBALS['____1255567959'][87](___1455984167(350))-$_1821427887,$GLOBALS['____1255567959'][88](___1455984167(351)))),$_2103847503=($_SERVER[___1455984167(352)]!==___1455984167(353)&&$_SERVER[___1455984167(354)]!==___1455984167(355)); $_843801045< round(0+5+5),($_1627380423 || $_685023249 || $_462347807 != $_149694871) && $_2103847503; $_843801045++,LocalRedirect(___1455984167(356)),exit,$GLOBALS['_____577145997'][2]($_687414052));$GLOBALS['____1255567959'][89]($_1474622122, $_462347807); $GLOBALS['____1255567959'][90]($_1890168913, $_149694871); $GLOBALS[___1455984167(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

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

	if (!defined('SITE_TEMPLATE_PATH'))
	{
		define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
	}
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
		if ($GLOBALS["USER"]->IsAuthorized() && empty($arAuthResult["MESSAGE"]))
		{
			$arAuthResult = ["MESSAGE" => GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", ["#FILE#" => $real_path]), "TYPE" => "ERROR"];

			if (COption::GetOptionString("main", "event_log_permissions_fail", "N") === "Y")
			{
				CEventLog::Log(CEventLog::SEVERITY_SECURITY, "USER_PERMISSIONS_FAIL", "main", $GLOBALS["USER"]->GetID(), $real_path);
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

/*ZDUyZmZNTYyZmZiZTlmZmI0MmM1NzE2NjVlNjFjN2U5ZGM5NDQ=*/$GLOBALS['____1284506323']= array(base64_decode('bX'.'RfcmFu'.'ZA='.'='),base64_decode(''.'Y2FsbF91'.'c2VyX2Z1bmM='),base64_decode(''.'c'.'3'.'R'.'ycG9'.'z'),base64_decode('Z'.'XhwbG9k'.'ZQ=='),base64_decode('cGF'.'ja'.'w=='),base64_decode('bWQ1'),base64_decode('Y29uc3RhbnQ'.'='),base64_decode(''.'aGFz'.'aF9'.'obWFj'),base64_decode(''.'c3'.'RyY21'.'w'),base64_decode('Y2'.'Fs'.'bF91'.'c'.'2VyX2Z1bmM='),base64_decode('Y2FsbF'.'91c2VyX2Z1b'.'mM'.'='),base64_decode('a'.'XNfb2'.'J'.'q'.'ZWN0'),base64_decode(''.'Y'.'2'.'Fs'.'bF91c'.'2Vy'.'X2'.'Z1bmM'.'='),base64_decode('Y2Fs'.'bF91'.'c2VyX'.'2Z1bmM='),base64_decode('Y2FsbF91c2VyX2Z1bmM'.'='),base64_decode('Y2Fs'.'bF91'.'c2VyX2Z1bmM='),base64_decode('Y2Fs'.'bF91c2'.'VyX2Z1bmM='),base64_decode('Y2FsbF91c'.'2V'.'yX'.'2'.'Z1'.'bmM'.'='),base64_decode(''.'ZG'.'Vm'.'aW5l'.'ZA'.'=='),base64_decode('c3RybGVu'));if(!function_exists(__NAMESPACE__.'\\___262740787')){function ___262740787($_1866263747){static $_1822027272= false; if($_1822027272 == false) $_1822027272=array('X'.'ENPcHRpb246OkdldE9wdGlvbl'.'N'.'0c'.'mluZw='.'=','b'.'WFpbg==','fl'.'BBUk'.'F'.'N'.'X01'.'BWF9V'.'U0VSU'.'w==','Lg'.'==','Lg==','SCo=','Yml0'.'cml4','TEl'.'D'.'RU5TR'.'V9LRVk=','c'.'2h'.'h'.'M'.'jU'.'2','XENP'.'cHR'.'p'.'b'.'246Okdl'.'dE9wdGlvblN'.'0cmluZw==','bWFpbg==','U'.'EFSQU1fTUFY'.'X1VTRVJT','X'.'EJpd'.'HJpeFx'.'NYWluXENvbmZpZ1x'.'PcHRpb2'.'46OnNldA==','b'.'WF'.'p'.'b'.'g==',''.'UEFSQU1fT'.'UFYX1V'.'TR'.'VJT',''.'V'.'VNFUg==','VV'.'N'.'FUg==','VVNFUg'.'='.'=','S'.'XNBdXRob3JpemVk','VVNFUg==','SXNB'.'ZG1p'.'b'.'g==',''.'QV'.'BQTElDQVRJ'.'T04=',''.'UmVz'.'dGFydE'.'J1Z'.'mZl'.'c'.'g'.'==','T'.'G9jYWxSZWRpcmV'.'jd'.'A='.'=','L2xpY2'.'Vu'.'c2Vfc'.'mVz'.'dHJpY3Rp'.'b'.'2'.'4ucGhw','XENPcH'.'Rpb246OkdldE9w'.'dGl'.'v'.'blN0cm'.'l'.'uZ'.'w'.'='.'=','b'.'W'.'Fpbg==','U'.'EF'.'SQU'.'1fTUFY'.'X1'.'VTRVJ'.'T','XEJpdHJpeFxNYWluXEN'.'vb'.'mZpZ1x'.'PcH'.'R'.'pb'.'246OnNldA='.'=','bWFpb'.'g==','UEFSQ'.'U1'.'fTU'.'FYX'.'1VTRVJT','T0xE'.'U'.'0'.'l'.'URUVYUElS'.'RURB'.'VEU'.'=','ZXhwaXJlX21lc3My');return base64_decode($_1822027272[$_1866263747]);}};if($GLOBALS['____1284506323'][0](round(0+0.2+0.2+0.2+0.2+0.2), round(0+5+5+5+5)) == round(0+1.4+1.4+1.4+1.4+1.4)){ $_1916004981= $GLOBALS['____1284506323'][1](___262740787(0), ___262740787(1), ___262740787(2)); if(!empty($_1916004981) && $GLOBALS['____1284506323'][2]($_1916004981, ___262740787(3)) !== false){ list($_2133294506, $_303743815)= $GLOBALS['____1284506323'][3](___262740787(4), $_1916004981); $_1409449203= $GLOBALS['____1284506323'][4](___262740787(5), $_2133294506); $_1568272681= ___262740787(6).$GLOBALS['____1284506323'][5]($GLOBALS['____1284506323'][6](___262740787(7))); $_1499057842= $GLOBALS['____1284506323'][7](___262740787(8), $_303743815, $_1568272681, true); if($GLOBALS['____1284506323'][8]($_1499057842, $_1409449203) !==(990-2*495)){ if($GLOBALS['____1284506323'][9](___262740787(9), ___262740787(10), ___262740787(11)) != round(0+12)){ $GLOBALS['____1284506323'][10](___262740787(12), ___262740787(13), ___262740787(14), round(0+2.4+2.4+2.4+2.4+2.4));} if(isset($GLOBALS[___262740787(15)]) && $GLOBALS['____1284506323'][11]($GLOBALS[___262740787(16)]) && $GLOBALS['____1284506323'][12](array($GLOBALS[___262740787(17)], ___262740787(18))) &&!$GLOBALS['____1284506323'][13](array($GLOBALS[___262740787(19)], ___262740787(20)))){ $GLOBALS['____1284506323'][14](array($GLOBALS[___262740787(21)], ___262740787(22))); $GLOBALS['____1284506323'][15](___262740787(23), ___262740787(24), true);}}} else{ if($GLOBALS['____1284506323'][16](___262740787(25), ___262740787(26), ___262740787(27)) != round(0+12)){ $GLOBALS['____1284506323'][17](___262740787(28), ___262740787(29), ___262740787(30), round(0+3+3+3+3));}}} while(!$GLOBALS['____1284506323'][18](___262740787(31)) || $GLOBALS['____1284506323'][19](OLDSITEEXPIREDATE) <=(127*2-254) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___262740787(32)));/**/       //Do not remove this


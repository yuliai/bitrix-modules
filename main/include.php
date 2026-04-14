<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2026 Bitrix
 */

use Bitrix\Main;
use Bitrix\Main\Session\Legacy\HealerEarlySessionStart;
use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Main\Config\Option;
use Dev\Main\Migrator\ModuleUpdater;

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
	ModuleUpdater::checkUpdates('main', __DIR__);
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

error_reporting((int)Option::get("main", "error_reporting", E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR | E_PARSE) & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE);

if (!defined("BX_COMP_MANAGED_CACHE") && Option::get("main", "component_managed_cache_on", "Y") != "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

// global functions
require_once __DIR__ . "/filter_tools.php";

/*ZDUyZmZODNkOGFkZGMxYzQ5ODQ1NmQzNDY4NDg3MWU1MzQxOTY=*/$GLOBALS['_____196124054']= array(base64_decode('R'.'2V0TW9kdW'.'xlRX'.'ZlbnRz'),base64_decode('RX'.'hlY'.'3V0ZU1'.'vZHVsZU'.'V2ZW50RXg'.'='),base64_decode('V3'.'Jpd'.'GVG'.'aW5'.'hb'.'E1lc3'.'NhZ2U'.'='));$GLOBALS['____172193857']= array(base64_decode('ZGVmaW5l'),base64_decode(''.'Ym'.'FzZTY0X2Rl'.'Y29kZQ=='),base64_decode('d'.'W5zZX'.'JpYWxpemU='),base64_decode(''.'a'.'XNf'.'YX'.'JyYX'.'k='),base64_decode('aW5fY'.'XJyYXk'.'='),base64_decode('c2Vy'.'a'.'WFsaXpl'),base64_decode('YmFzZ'.'TY'.'0X2Vu'.'Y29kZ'.'Q=='),base64_decode(''.'bW'.'t0a'.'W1l'),base64_decode(''.'ZGF0ZQ=='),base64_decode('ZGF0'.'ZQ=='),base64_decode(''.'c3'.'R'.'ybGVu'),base64_decode('b'.'Wt0aW1l'),base64_decode(''.'ZGF0Z'.'Q=='),base64_decode('Z'.'GF0ZQ=='),base64_decode('bWV0aG9kX2V4aXN0cw=='),base64_decode('Y'.'2FsbF91c2VyX2Z'.'1bm'.'Nf'.'YXJyY'.'Xk='),base64_decode('c3RybGV'.'u'),base64_decode(''.'c2VyaWF'.'sa'.'Xpl'),base64_decode('Ym'.'F'.'zZTY0X2Vu'.'Y'.'2'.'9kZQ='.'='),base64_decode(''.'c3'.'RybGV'.'u'),base64_decode('a'.'X'.'NfYXJyYXk'.'='),base64_decode('c'.'2V'.'yaWFsaX'.'pl'),base64_decode('YmFzZTY0X2VuY29kZQ'.'=='),base64_decode(''.'c'.'2VyaW'.'Fs'.'aX'.'pl'),base64_decode(''.'YmF'.'zZT'.'Y'.'0X2'.'V'.'uY29kZ'.'Q'.'=='),base64_decode('aX'.'NfYXJyY'.'Xk='),base64_decode('aX'.'NfYX'.'JyYX'.'k='),base64_decode('aW5fYXJyYXk='),base64_decode('aW5'.'fYXJ'.'yY'.'Xk'.'='),base64_decode('bW'.'t0aW'.'1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('b'.'Wt0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0'.'ZQ'.'='.'='),base64_decode('aW5f'.'YXJyYXk='),base64_decode('c2VyaWFsa'.'Xp'.'l'),base64_decode(''.'Ym'.'F'.'z'.'ZTY0'.'X2'.'VuY29kZQ=='),base64_decode('aW5'.'0dmFs'),base64_decode('dG'.'ltZQ=='),base64_decode('Zm'.'lsZV'.'9l'.'eG'.'l'.'zd'.'H'.'M='),base64_decode(''.'c3RyX3JlcG'.'x'.'hY'.'2'.'U='),base64_decode('Y2xhc3N'.'f'.'ZX'.'hpc'.'3R'.'z'),base64_decode('ZGVm'.'aW5'.'l'),base64_decode('c3'.'RycmV2'),base64_decode(''.'c3R'.'ydG9'.'1cHBlcg=='),base64_decode(''.'c3'.'B'.'yaW50Zg=='),base64_decode('c3ByaW'.'5'.'0Zg='.'='),base64_decode('c3Vic3Ry'),base64_decode('c3RycmV2'),base64_decode('Y'.'mFzZTY0'.'X2RlY29kZQ=='),base64_decode('c'.'3Vic3Ry'),base64_decode('c3Ry'.'bGVu'),base64_decode('c3RybGVu'),base64_decode('Y2'.'hy'),base64_decode('b3'.'Jk'),base64_decode('b'.'3J'.'k'),base64_decode('bWt0aW1l'),base64_decode('aW5'.'0dm'.'Fs'),base64_decode(''.'aW50dmF'.'s'),base64_decode('aW5'.'0'.'dmFs'),base64_decode('a'.'3NvcnQ='),base64_decode('c3V'.'ic3'.'Ry'),base64_decode(''.'aW1wbG9kZQ='.'='),base64_decode('ZGVmaW5lZ'.'A'.'=='),base64_decode(''.'YmFzZTY0X2RlY'.'29k'.'ZQ=='),base64_decode('Y29uc3Rhb'.'nQ='),base64_decode('c'.'3R'.'ycmV'.'2'),base64_decode('c'.'3'.'ByaW5'.'0Zg'.'=='),base64_decode('c3R'.'ybGVu'),base64_decode('c3R'.'ybGVu'),base64_decode('Y2'.'h'.'y'),base64_decode('b3J'.'k'),base64_decode('b'.'3'.'Jk'),base64_decode('bWt0aW1l'),base64_decode('aW50dmFs'),base64_decode('aW50d'.'mF'.'s'),base64_decode('aW'.'50'.'dmFs'),base64_decode('c3Vic3Ry'),base64_decode('c3Vi'.'c3Ry'),base64_decode(''.'ZGVmaW5'.'lZA='.'='),base64_decode('c3R'.'y'.'cmV2'),base64_decode(''.'c3RydG9'.'1'.'cHBlcg=='),base64_decode('dGltZQ=='),base64_decode(''.'bW'.'t0aW1l'),base64_decode('bWt0aW'.'1l'),base64_decode(''.'Z'.'GF0ZQ=='),base64_decode('ZGF'.'0ZQ=='),base64_decode('Z'.'GVm'.'aW5l'),base64_decode('ZG'.'Vma'.'W5'.'l'));if(!function_exists(__NAMESPACE__.'\\___2119472068')){function ___2119472068($_2028857919){static $_1393716096= false; if($_1393716096 == false) $_1393716096=array('SU5UUkFO'.'R'.'VRfRURJVE'.'l'.'P'.'Tg==','WQ==','bW'.'Fpbg==','fmNw'.'Zl'.'9tYXBfdmFs'.'dWU=','','',''.'YWxsb3'.'dlZF'.'9jbGF'.'zc'.'2Vz','ZQ==','Zg==','ZQ==','Rg==','WA==','Z'.'g==',''.'bWFpbg='.'=','fmNwZl9t'.'YXBf'.'dmFsd'.'WU=',''.'U'.'G9ydGFs','R'.'g==','ZQ==','Z'.'Q='.'=','WA'.'==','Rg==','RA='.'=','R'.'A==','bQ==','ZA==','WQ==',''.'Zg==','Zg==','Zg==',''.'Zg==','UG9ydGFs','Rg==','Z'.'Q==','ZQ==','WA==','Rg'.'='.'=',''.'RA==','RA'.'==','bQ==','ZA==','WQ==','b'.'W'.'F'.'pbg==','T'.'24=','U2V'.'0dGl'.'uZ3NDaGFuZ2U=','Zg==','Zg==','Zg='.'=',''.'Zg='.'=','bWFpbg==','fmNwZl9'.'tYXBfdmFs'.'dW'.'U=',''.'ZQ==','ZQ==',''.'RA='.'=','ZQ==','Z'.'Q==','Z'.'g==','Zg==','Zg'.'==','ZQ='.'=','bWFpbg==',''.'fmNw'.'Zl9'.'tY'.'XBfdmFsdWU'.'=',''.'Z'.'Q==','Z'.'g==','Zg==','Zg==','Zg==','bWFpb'.'g==','fmNw'.'Zl'.'9tY'.'XBf'.'d'.'mF'.'s'.'dWU=','Z'.'Q'.'==','Zg'.'==','UG9ydGFs',''.'UG9'.'ydGFs','ZQ==','ZQ==','U'.'G'.'9ydGF'.'s',''.'Rg==','WA==','R'.'g'.'==','RA'.'='.'=','ZQ==','ZQ==','RA='.'=','bQ==',''.'ZA==','W'.'Q==','ZQ==','WA==','ZQ==','Rg==','ZQ'.'==','R'.'A'.'==',''.'Z'.'g='.'=','ZQ==','RA==','Z'.'Q==','bQ==','ZA'.'==',''.'WQ='.'=','Zg'.'='.'=','Z'.'g==','Zg'.'==','Zg==',''.'Z'.'g==','Zg==','Zg==','Zg==',''.'b'.'WFpbg==','f'.'mNwZl9tYXB'.'fd'.'mFsd'.'WU'.'=','Z'.'Q='.'=','ZQ==',''.'UG9ydGFs','Rg==','WA==','VF'.'lQRQ'.'==',''.'RE'.'FURQ==','RkVBVFV'.'SRV'.'M=',''.'RVhQSVJF'.'RA='.'=',''.'VF'.'lQRQ==','RA==',''.'VF'.'JZX0'.'R'.'B'.'WV'.'NfQ0'.'9VTlQ=','REF'.'URQ==','VFJZ'.'X0R'.'BWVNfQ09V'.'T'.'lQ=','RV'.'h'.'QSV'.'J'.'FRA==','R'.'kVB'.'VFVSRV'.'M=',''.'Zg==','Z'.'g==',''.'RE'.'9DVU'.'1F'.'TlRfUk'.'9PVA==','L2JpdHJpeC9tb'.'2R1bGVzL'.'w==','L2luc'.'3RhbGwvaW5kZXguc'.'Ghw','Lg='.'=','Xw==','c2VhcmNo','Tg==','','','QUN'.'USVZF','W'.'Q==','c2'.'9ja'.'WFsb'.'mV0d29yaw==','YWx'.'sb3dfZnJpZWxk'.'cw'.'='.'=','WQ==','SU'.'Q'.'=','c2'.'9ja'.'WFs'.'b'.'m'.'V0d29'.'yaw==','YWxsb3d'.'f'.'ZnJpZW'.'xk'.'cw==','SUQ=','c29jaWFs'.'b'.'mV0'.'d'.'29yaw==','Y'.'W'.'xsb3dfZnJ'.'p'.'ZWx'.'k'.'cw='.'=','Tg='.'=','','','Q'.'U'.'N'.'US'.'VZF',''.'WQ'.'='.'=','c29jaWFsbm'.'V0d29'.'yaw='.'=',''.'YW'.'xsb3dfb'.'Wljcm'.'9ibG9nX3VzZXI=','WQ='.'=','SUQ=','c29jaW'.'FsbmV0d29y'.'aw==','YWx'.'s'.'b3dfb'.'Wljcm'.'9i'.'bG9nX3VzZ'.'XI'.'=',''.'SUQ=','c'.'29jaWFsbmV0d29y'.'a'.'w'.'==','YWxsb'.'3dfb'.'Wljcm9'.'ibG9'.'nX3VzZXI=','c29'.'ja'.'WFsb'.'mV'.'0d2'.'9yaw'.'==','Y'.'Wxsb3dfbWl'.'jcm9i'.'bG9nX2dyb3Vw','WQ==','SUQ=','c29j'.'aWFsbmV'.'0'.'d29yaw==','Y'.'Wxsb'.'3dfb'.'W'.'l'.'jcm9ibG'.'9nX'.'2dyb3Vw','SUQ=',''.'c'.'29jaWFsb'.'mV0d29'.'y'.'aw==','YWxsb3'.'d'.'fbW'.'ljc'.'m9i'.'bG9nX2dyb3'.'Vw','Tg==','','','QUNUSVZF','WQ==','c29j'.'aWFsbmV0d29yaw'.'==','YWxs'.'b'.'3'.'d'.'f'.'ZmlsZXNfdX'.'N'.'lcg==','WQ'.'='.'=','S'.'UQ=','c'.'29jaWFsb'.'mV0d29y'.'aw'.'==','YWxsb3'.'df'.'Zml'.'sZXNfd'.'XNl'.'cg==','SUQ'.'=','c'.'2'.'9'.'jaWFsb'.'mV0d2'.'9yaw==','YWxsb'.'3dfZmlsZX'.'NfdXNlcg==','Tg'.'==','','','QUNU'.'SVZ'.'F','WQ'.'==',''.'c2'.'9ja'.'WFsbmV0d29ya'.'w='.'=','YWx'.'sb3d'.'fYmx'.'v'.'Z191c2Vy','WQ'.'==','SUQ=',''.'c2'.'9jaW'.'Fs'.'bmV0d29'.'yaw='.'=','YW'.'xs'.'b3dfYmx'.'vZ1'.'91'.'c2'.'Vy','S'.'UQ'.'=','c'.'29'.'j'.'aW'.'FsbmV0d29yaw'.'='.'=','Y'.'W'.'xs'.'b3'.'df'.'YmxvZ1'.'91'.'c2Vy','Tg==','','','QUNUSVZF','WQ==','c2'.'9jaWFs'.'b'.'mV0d29yaw==','Y'.'Wxs'.'b3dfcGh'.'vdG9fd'.'XNlcg==','WQ==','SUQ=','c29ja'.'WFsbmV0'.'d29yaw'.'==','YWxsb'.'3'.'dfcGhvdG9'.'f'.'dXN'.'l'.'cg==','S'.'UQ=','c29jaWFsbm'.'V0d29y'.'a'.'w==','Y'.'Wxs'.'b3dfc'.'GhvdG9f'.'dXNlcg==',''.'Tg='.'=','','','Q'.'UNUSVZ'.'F','WQ==',''.'c'.'2'.'9jaWF'.'sb'.'mV0d'.'29yaw='.'=','Y'.'Wx'.'sb3dfZ'.'m9y'.'dW1'.'f'.'d'.'XNl'.'cg'.'==','WQ==','SUQ=','c29jaWFsbmV0'.'d'.'29y'.'aw==','YW'.'xs'.'b'.'3df'.'Zm9y'.'dW1fdXNlcg'.'==',''.'SU'.'Q=','c29jaWFsbmV0d29yaw==','YW'.'xsb3'.'d'.'fZm9ydW1f'.'dXN'.'lcg='.'=','Tg==','','','QUNUSVZF',''.'WQ==',''.'c'.'29jaWFsbmV'.'0'.'d29'.'yaw==','YWxs'.'b3d'.'fdG'.'Fz'.'a3N'.'f'.'dXNl'.'c'.'g==',''.'WQ==','SUQ=',''.'c29jaWFsbmV0d'.'29yaw'.'==',''.'Y'.'Wxsb'.'3'.'dfdGF'.'za3NfdX'.'Nlcg='.'=','SUQ=','c29jaWFsbmV0d29'.'yaw==','YWx'.'sb3dfd'.'GFza3'.'NfdXNlcg==',''.'c29jaWF'.'s'.'b'.'mV0'.'d29'.'ya'.'w'.'='.'=','YWxsb3df'.'dGFza3NfZ3JvdX'.'A=','WQ'.'==','SUQ'.'=','c29'.'ja'.'WFsbmV0d29y'.'aw'.'==','YWxs'.'b3dfdGFza3NfZ3Jvd'.'XA'.'=','S'.'UQ=',''.'c'.'29jaWFsbm'.'V'.'0d29y'.'aw==','YW'.'xsb3dfd'.'GFz'.'a3NfZ3Jvd'.'XA'.'=','d'.'GFza3'.'M=','Tg==','','','Q'.'UNU'.'SVZF',''.'WQ==','c29jaWFsbmV'.'0d29yaw==','YWxsb3dfY2FsZW5k'.'YXJfdXNl'.'cg==','W'.'Q==',''.'SU'.'Q=',''.'c29ja'.'W'.'FsbmV0'.'d'.'2'.'9yaw==','YWxsb'.'3dfY'.'2Fs'.'ZW5kYXJfdXNl'.'cg==','SUQ=',''.'c'.'2'.'9j'.'aWFsb'.'mV0'.'d'.'29yaw==','YWxsb3dfY2'.'F'.'sZW5'.'kYXJ'.'fd'.'XNlcg='.'=',''.'c29j'.'aW'.'F'.'sbmV0d29ya'.'w==',''.'YWx'.'sb3dfY2FsZW5'.'kYXJ'.'fZ3JvdX'.'A=','WQ==','SUQ=','c29jaW'.'FsbmV0d29y'.'a'.'w==','YWxsb'.'3df'.'Y2FsZW5kYXJfZ3JvdXA=',''.'SU'.'Q'.'=','c29'.'jaW'.'F'.'s'.'bmV0d29yaw'.'==','YWx'.'sb3dfY2'.'FsZW5kY'.'XJf'.'Z3'.'Jvd'.'XA=','QUNU'.'SVZF','WQ'.'='.'=','Tg'.'='.'=',''.'ZXh0c'.'mFuZXQ=','aW'.'Jsb2Nr','T2'.'5B'.'ZnRlck'.'lCbG9ja0VsZW1lbnRVcGRhdGU'.'=','aW50cm'.'FuZ'.'XQ=','Q0'.'ludHJh'.'bmV0RXZlbnRIYW5kbGVy'.'c'.'w'.'='.'=','U1BSZWd'.'p'.'c'.'3RlclV'.'wZGF0ZWRJdGVt','Q0ludHJhbmV0U2'.'hh'.'cmVwb2lud'.'Do6Q'.'W'.'dlbnRMa'.'XN0cygp'.'Ow==','aW'.'5'.'0cmFu'.'ZX'.'Q=','Tg='.'=','Q0ludHJhb'.'mV0U2hhcmV'.'wb2l'.'u'.'d'.'Do6QW'.'dlbnRRd'.'WV'.'1Z'.'SgpO'.'w'.'==','aW50c'.'mFu'.'Z'.'X'.'Q=','Tg==','Q0ludHJhbmV0U2'.'hh'.'cmVw'.'b2'.'ludDo6'.'QW'.'dlb'.'nRVcGRhd'.'GU'.'oKTs=','aW5'.'0'.'c'.'mFuZXQ=',''.'T'.'g==','aWJsb'.'2Nr',''.'T25BZnRlck'.'lCbG9ja0VsZW1lbn'.'R'.'B'.'ZG'.'Q=','aW50cmFu'.'Z'.'X'.'Q=','Q'.'0'.'ludHJhbmV0R'.'XZlbnRIYW5kbGVycw==','U1BSZWdpc3Rl'.'clVwZGF0'.'ZWRJ'.'dG'.'Vt',''.'aWJsb2N'.'r',''.'T25B'.'ZnRl'.'cklCb'.'G'.'9ja0'.'VsZ'.'W1lbnRVcGRhdGU'.'=','aW5'.'0cmFuZXQ'.'=','Q0ludHJhbmV0RX'.'Zl'.'bnR'.'IYW5kbGVyc'.'w='.'=',''.'U1B'.'SZWdpc3R'.'lclV'.'wZGF0'.'ZWRJdGVt',''.'Q'.'0'.'lud'.'HJhb'.'mV'.'0U'.'2h'.'hcmVw'.'b2'.'ludDo'.'6Q'.'WdlbnR'.'M'.'aXN0cyg'.'pOw==',''.'a'.'W'.'50cmF'.'uZX'.'Q'.'=',''.'Q0l'.'udHJhbmV0U2hhcmVw'.'b2'.'ludD'.'o6Q'.'W'.'dlbn'.'RRdWV1ZSgp'.'O'.'w==','aW50'.'cmFuZ'.'X'.'Q'.'=','Q'.'0ludHJhbmV0U'.'2hhcm'.'Vwb2lu'.'dDo6Q'.'Wdl'.'bnRVcGRhdGUoKTs'.'=','aW'.'50'.'cm'.'F'.'uZXQ=',''.'Y3Jt','bWFpbg==','T'.'25CZWZ'.'vcmVQcm'.'9sb2c=',''.'bWFpbg==','Q1dpemFyZ'.'FNvb'.'FB'.'hbm'.'VsSW50'.'cmFu'.'Z'.'XQ'.'=','U2h'.'vd1BhbmVs','L2'.'1'.'vZHVsZXMvaW50cmF'.'uZX'.'QvcGFuZWxfYn'.'V0dG'.'9uLnBocA='.'=','ZXhwaXJl'.'X21lc3M'.'y',''.'bm9pd'.'Gl'.'kZV90'.'aW1pbGV'.'taXQ'.'=','WQ==',''.'ZHJ'.'pbl9w'.'ZXJnb2tj','J'.'TAxM'.'HMK','RUVYUEl'.'S',''.'bWFp'.'bg==','JXMlc'.'w==','YWRt','aGRyb3dzc'.'2E'.'=','Y'.'W'.'RtaW'.'4=','bW9kdWxlcw==',''.'ZGVmaW5'.'lL'.'nBocA==',''.'bWFpbg==','Y'.'ml0cm'.'l4',''.'Uk'.'hTSVRFR'.'V'.'g=','SDR1Njd'.'maHc'.'4N1Z'.'oeXRvc'.'w==','','dGhS','N0'.'h5c'.'jE'.'y'.'SHd5MHJG'.'cg==',''.'VF9TVE'.'VBT'.'A'.'==',''.'a'.'HR0cHM'.'6Ly9ia'.'XRya'.'Xhzb2Z'.'0LmNvbS9iaXRyaXg'.'vYn'.'Mu'.'cGhw','T'.'0xE','UElSRURBV'.'EVT','RE9DVU1FTlRf'.'U'.'k9PVA==',''.'Lw'.'==','Lw==','VE'.'VNUE'.'9'.'SQVJZX'.'0NBQ'.'0hF','VEVN'.'UE9SQV'.'JZX0'.'N'.'BQ0hF','',''.'T05fT0Q=','JXM'.'lcw==','X0'.'9'.'VUl9CVV'.'M=','U0'.'lU',''.'RU'.'RBVEV'.'NQVB'.'F'.'Ug'.'==','bm9p'.'dGlkZV9'.'0'.'aW1pbGVta'.'XQ=','bQ='.'=','ZA==','W'.'Q==','U0N'.'SS'.'VBUX05BT'.'UU'.'=','L2JpdHJpeC'.'9'.'jb3Vw'.'b25fYWN0aXZh'.'d'.'Glvbi5wa'.'HA'.'=','U'.'0NSS'.'VBUX'.'05BT'.'UU=','L2JpdHJ'.'p'.'eC'.'9zZ'.'XJ2aWNl'.'cy9t'.'YWlu'.'L'.'2F'.'qYXgucGhw','L2Jpd'.'H'.'J'.'peC'.'9jb'.'3Vwb'.'25fYWN'.'0aXZh'.'dGlvbi5waH'.'A=','U2l'.'0Z'.'UV4c'.'GlyZU'.'Rh'.'dG'.'U=');return base64_decode($_1393716096[$_2028857919]);}};$GLOBALS['____172193857'][0](___2119472068(0), ___2119472068(1));class CBXFeatures{ private static $_2042366453= 30; private static $_1298113525= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_627911946= null; private static $_1252289348= null; private static function __1533274238(){ if(self::$_627911946 === null){ self::$_627911946= array(); foreach(self::$_1298113525 as $_51881558 => $_1607951992){ foreach($_1607951992 as $_1616952989) self::$_627911946[$_1616952989]= $_51881558;}} if(self::$_1252289348 === null){ self::$_1252289348= array(); $_1512011705= COption::GetOptionString(___2119472068(2), ___2119472068(3), ___2119472068(4)); if($_1512011705 != ___2119472068(5)){ $_1512011705= $GLOBALS['____172193857'][1]($_1512011705); $_1512011705= $GLOBALS['____172193857'][2]($_1512011705,[___2119472068(6) => false]); if($GLOBALS['____172193857'][3]($_1512011705)){ self::$_1252289348= $_1512011705;}} if(empty(self::$_1252289348)){ self::$_1252289348= array(___2119472068(7) => array(), ___2119472068(8) => array());}}} public static function InitiateEditionsSettings($_328749155){ self::__1533274238(); $_118446549= array(); foreach(self::$_1298113525 as $_51881558 => $_1607951992){ $_1511939899= $GLOBALS['____172193857'][4]($_51881558, $_328749155); self::$_1252289348[___2119472068(9)][$_51881558]=($_1511939899? array(___2119472068(10)): array(___2119472068(11))); foreach($_1607951992 as $_1616952989){ self::$_1252289348[___2119472068(12)][$_1616952989]= $_1511939899; if(!$_1511939899) $_118446549[]= array($_1616952989, false);}} $_1735352312= $GLOBALS['____172193857'][5](self::$_1252289348); $_1735352312= $GLOBALS['____172193857'][6]($_1735352312); COption::SetOptionString(___2119472068(13), ___2119472068(14), $_1735352312); foreach($_118446549 as $_152256169) self::__579991812($_152256169[(888-2*444)], $_152256169[round(0+0.5+0.5)]);} public static function IsFeatureEnabled($_1616952989){ if($_1616952989 == '') return true; self::__1533274238(); if(!isset(self::$_627911946[$_1616952989])) return true; if(self::$_627911946[$_1616952989] == ___2119472068(15)) $_1303171555= array(___2119472068(16)); elseif(isset(self::$_1252289348[___2119472068(17)][self::$_627911946[$_1616952989]])) $_1303171555= self::$_1252289348[___2119472068(18)][self::$_627911946[$_1616952989]]; else $_1303171555= array(___2119472068(19)); if($_1303171555[min(76,0,25.333333333333)] != ___2119472068(20) && $_1303171555[min(16,0,5.3333333333333)] != ___2119472068(21)){ return false;} elseif($_1303171555[min(8,0,2.6666666666667)] == ___2119472068(22)){ if($_1303171555[round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____172193857'][7]((982-2*491), min(190,0,63.333333333333), min(52,0,17.333333333333), Date(___2119472068(23)), $GLOBALS['____172193857'][8](___2119472068(24))- self::$_2042366453, $GLOBALS['____172193857'][9](___2119472068(25)))){ if(!isset($_1303171555[round(0+0.5+0.5+0.5+0.5)]) ||!$_1303171555[round(0+2)]) self::__2075031270(self::$_627911946[$_1616952989]); return false;}} return!isset(self::$_1252289348[___2119472068(26)][$_1616952989]) || self::$_1252289348[___2119472068(27)][$_1616952989];} public static function IsFeatureInstalled($_1616952989){ if($GLOBALS['____172193857'][10]($_1616952989) <= 0) return true; self::__1533274238(); return(isset(self::$_1252289348[___2119472068(28)][$_1616952989]) && self::$_1252289348[___2119472068(29)][$_1616952989]);} public static function IsFeatureEditable($_1616952989){ if($_1616952989 == '') return true; self::__1533274238(); if(!isset(self::$_627911946[$_1616952989])) return true; if(self::$_627911946[$_1616952989] == ___2119472068(30)) $_1303171555= array(___2119472068(31)); elseif(isset(self::$_1252289348[___2119472068(32)][self::$_627911946[$_1616952989]])) $_1303171555= self::$_1252289348[___2119472068(33)][self::$_627911946[$_1616952989]]; else $_1303171555= array(___2119472068(34)); if($_1303171555[(842-2*421)] != ___2119472068(35) && $_1303171555[(238*2-476)] != ___2119472068(36)){ return false;} elseif($_1303171555[(948-2*474)] == ___2119472068(37)){ if($_1303171555[round(0+0.2+0.2+0.2+0.2+0.2)]< $GLOBALS['____172193857'][11]((1256/2-628),(147*2-294),(1096/2-548), Date(___2119472068(38)), $GLOBALS['____172193857'][12](___2119472068(39))- self::$_2042366453, $GLOBALS['____172193857'][13](___2119472068(40)))){ if(!isset($_1303171555[round(0+0.5+0.5+0.5+0.5)]) ||!$_1303171555[round(0+1+1)]) self::__2075031270(self::$_627911946[$_1616952989]); return false;}} return true;} private static function __579991812($_1616952989, $_48512686){ if($GLOBALS['____172193857'][14]("CBXFeatures", "On".$_1616952989."SettingsChange")) $GLOBALS['____172193857'][15](array("CBXFeatures", "On".$_1616952989."SettingsChange"), array($_1616952989, $_48512686)); $_1578578718= $GLOBALS['_____196124054'][0](___2119472068(41), ___2119472068(42).$_1616952989.___2119472068(43)); while($_2117475545= $_1578578718->Fetch()) $GLOBALS['_____196124054'][1]($_2117475545, array($_1616952989, $_48512686));} public static function SetFeatureEnabled($_1616952989, $_48512686= true, $_603619362= true){ if($GLOBALS['____172193857'][16]($_1616952989) <= 0) return; if(!self::IsFeatureEditable($_1616952989)) $_48512686= false; $_48512686= (bool)$_48512686; self::__1533274238(); $_1735457977=(!isset(self::$_1252289348[___2119472068(44)][$_1616952989]) && $_48512686 || isset(self::$_1252289348[___2119472068(45)][$_1616952989]) && $_48512686 != self::$_1252289348[___2119472068(46)][$_1616952989]); self::$_1252289348[___2119472068(47)][$_1616952989]= $_48512686; $_1735352312= $GLOBALS['____172193857'][17](self::$_1252289348); $_1735352312= $GLOBALS['____172193857'][18]($_1735352312); COption::SetOptionString(___2119472068(48), ___2119472068(49), $_1735352312); if($_1735457977 && $_603619362) self::__579991812($_1616952989, $_48512686);} private static function __2075031270($_51881558){ if($GLOBALS['____172193857'][19]($_51881558) <= 0 || $_51881558 == "Portal") return; self::__1533274238(); if(!isset(self::$_1252289348[___2119472068(50)][$_51881558]) || self::$_1252289348[___2119472068(51)][$_51881558][(912-2*456)] != ___2119472068(52)) return; if(isset(self::$_1252289348[___2119472068(53)][$_51881558][round(0+1+1)]) && self::$_1252289348[___2119472068(54)][$_51881558][round(0+0.4+0.4+0.4+0.4+0.4)]) return; $_118446549= array(); if(isset(self::$_1298113525[$_51881558]) && $GLOBALS['____172193857'][20](self::$_1298113525[$_51881558])){ foreach(self::$_1298113525[$_51881558] as $_1616952989){ if(isset(self::$_1252289348[___2119472068(55)][$_1616952989]) && self::$_1252289348[___2119472068(56)][$_1616952989]){ self::$_1252289348[___2119472068(57)][$_1616952989]= false; $_118446549[]= array($_1616952989, false);}} self::$_1252289348[___2119472068(58)][$_51881558][round(0+2)]= true;} $_1735352312= $GLOBALS['____172193857'][21](self::$_1252289348); $_1735352312= $GLOBALS['____172193857'][22]($_1735352312); COption::SetOptionString(___2119472068(59), ___2119472068(60), $_1735352312); foreach($_118446549 as $_152256169) self::__579991812($_152256169[(990-2*495)], $_152256169[round(0+0.25+0.25+0.25+0.25)]);} public static function ModifyFeaturesSettings($_328749155, $_1607951992){ self::__1533274238(); foreach($_328749155 as $_51881558 => $_1970016537) self::$_1252289348[___2119472068(61)][$_51881558]= $_1970016537; $_118446549= array(); foreach($_1607951992 as $_1616952989 => $_48512686){ if(!isset(self::$_1252289348[___2119472068(62)][$_1616952989]) && $_48512686 || isset(self::$_1252289348[___2119472068(63)][$_1616952989]) && $_48512686 != self::$_1252289348[___2119472068(64)][$_1616952989]) $_118446549[]= array($_1616952989, $_48512686); self::$_1252289348[___2119472068(65)][$_1616952989]= $_48512686;} $_1735352312= $GLOBALS['____172193857'][23](self::$_1252289348); $_1735352312= $GLOBALS['____172193857'][24]($_1735352312); COption::SetOptionString(___2119472068(66), ___2119472068(67), $_1735352312); self::$_1252289348= null; foreach($_118446549 as $_152256169) self::__579991812($_152256169[(1440/2-720)], $_152256169[round(0+1)]);} public static function SaveFeaturesSettings($_1476653590, $_1254388569){ self::__1533274238(); $_650555997= array(___2119472068(68) => array(), ___2119472068(69) => array()); if(!$GLOBALS['____172193857'][25]($_1476653590)) $_1476653590= array(); if(!$GLOBALS['____172193857'][26]($_1254388569)) $_1254388569= array(); if(!$GLOBALS['____172193857'][27](___2119472068(70), $_1476653590)) $_1476653590[]= ___2119472068(71); foreach(self::$_1298113525 as $_51881558 => $_1607951992){ if(isset(self::$_1252289348[___2119472068(72)][$_51881558])){ $_1973894542= self::$_1252289348[___2119472068(73)][$_51881558];} else{ $_1973894542=($_51881558 == ___2119472068(74)? array(___2119472068(75)): array(___2119472068(76)));} if($_1973894542[(1072/2-536)] == ___2119472068(77) || $_1973894542[min(176,0,58.666666666667)] == ___2119472068(78)){ $_650555997[___2119472068(79)][$_51881558]= $_1973894542;} else{ if($GLOBALS['____172193857'][28]($_51881558, $_1476653590)) $_650555997[___2119472068(80)][$_51881558]= array(___2119472068(81), $GLOBALS['____172193857'][29]((1356/2-678),(962-2*481), min(72,0,24), $GLOBALS['____172193857'][30](___2119472068(82)), $GLOBALS['____172193857'][31](___2119472068(83)), $GLOBALS['____172193857'][32](___2119472068(84)))); else $_650555997[___2119472068(85)][$_51881558]= array(___2119472068(86));}} $_118446549= array(); foreach(self::$_627911946 as $_1616952989 => $_51881558){ if($_650555997[___2119472068(87)][$_51881558][min(248,0,82.666666666667)] != ___2119472068(88) && $_650555997[___2119472068(89)][$_51881558][(230*2-460)] != ___2119472068(90)){ $_650555997[___2119472068(91)][$_1616952989]= false;} else{ if($_650555997[___2119472068(92)][$_51881558][(952-2*476)] == ___2119472068(93) && $_650555997[___2119472068(94)][$_51881558][round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____172193857'][33]((162*2-324),(1468/2-734), min(222,0,74), Date(___2119472068(95)), $GLOBALS['____172193857'][34](___2119472068(96))- self::$_2042366453, $GLOBALS['____172193857'][35](___2119472068(97)))) $_650555997[___2119472068(98)][$_1616952989]= false; else $_650555997[___2119472068(99)][$_1616952989]= $GLOBALS['____172193857'][36]($_1616952989, $_1254388569); if(!isset(self::$_1252289348[___2119472068(100)][$_1616952989]) && $_650555997[___2119472068(101)][$_1616952989] || isset(self::$_1252289348[___2119472068(102)][$_1616952989]) && $_650555997[___2119472068(103)][$_1616952989] != self::$_1252289348[___2119472068(104)][$_1616952989]) $_118446549[]= array($_1616952989, $_650555997[___2119472068(105)][$_1616952989]);}} $_1735352312= $GLOBALS['____172193857'][37]($_650555997); $_1735352312= $GLOBALS['____172193857'][38]($_1735352312); COption::SetOptionString(___2119472068(106), ___2119472068(107), $_1735352312); self::$_1252289348= null; foreach($_118446549 as $_152256169) self::__579991812($_152256169[min(166,0,55.333333333333)], $_152256169[round(0+0.5+0.5)]);} public static function GetFeaturesList(){ self::__1533274238(); $_54590442= array(); foreach(self::$_1298113525 as $_51881558 => $_1607951992){ if(isset(self::$_1252289348[___2119472068(108)][$_51881558])){ $_1973894542= self::$_1252289348[___2119472068(109)][$_51881558];} else{ $_1973894542=($_51881558 == ___2119472068(110)? array(___2119472068(111)): array(___2119472068(112)));} $_54590442[$_51881558]= array( ___2119472068(113) => $_1973894542[(1388/2-694)], ___2119472068(114) => $_1973894542[round(0+0.25+0.25+0.25+0.25)], ___2119472068(115) => array(),); $_54590442[$_51881558][___2119472068(116)]= false; if($_54590442[$_51881558][___2119472068(117)] == ___2119472068(118)){ $_54590442[$_51881558][___2119472068(119)]= $GLOBALS['____172193857'][39](($GLOBALS['____172193857'][40]()- $_54590442[$_51881558][___2119472068(120)])/ round(0+43200+43200)); if($_54590442[$_51881558][___2119472068(121)]> self::$_2042366453) $_54590442[$_51881558][___2119472068(122)]= true;} foreach($_1607951992 as $_1616952989) $_54590442[$_51881558][___2119472068(123)][$_1616952989]=(!isset(self::$_1252289348[___2119472068(124)][$_1616952989]) || self::$_1252289348[___2119472068(125)][$_1616952989]);} return $_54590442;} private static function __1094766362($_1224503283, $_446004901){ if(IsModuleInstalled($_1224503283) == $_446004901) return true; $_657639848= $_SERVER[___2119472068(126)].___2119472068(127).$_1224503283.___2119472068(128); if(!$GLOBALS['____172193857'][41]($_657639848)) return false; include_once($_657639848); $_1792688218= $GLOBALS['____172193857'][42](___2119472068(129), ___2119472068(130), $_1224503283); if(!$GLOBALS['____172193857'][43]($_1792688218)) return false; $_625121388= new $_1792688218; if($_446004901){ if(!$_625121388->InstallDB()) return false; $_625121388->InstallEvents(); if(!$_625121388->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___2119472068(131))) CSearch::DeleteIndex($_1224503283); UnRegisterModule($_1224503283);} return true;} protected static function OnRequestsSettingsChange($_1616952989, $_48512686){ self::__1094766362("form", $_48512686);} protected static function OnLearningSettingsChange($_1616952989, $_48512686){ self::__1094766362("learning", $_48512686);} protected static function OnJabberSettingsChange($_1616952989, $_48512686){ self::__1094766362("xmpp", $_48512686);} protected static function OnVideoConferenceSettingsChange($_1616952989, $_48512686){} protected static function OnBizProcSettingsChange($_1616952989, $_48512686){ self::__1094766362("bizprocdesigner", $_48512686);} protected static function OnListsSettingsChange($_1616952989, $_48512686){ self::__1094766362("lists", $_48512686);} protected static function OnWikiSettingsChange($_1616952989, $_48512686){ self::__1094766362("wiki", $_48512686);} protected static function OnSupportSettingsChange($_1616952989, $_48512686){ self::__1094766362("support", $_48512686);} protected static function OnControllerSettingsChange($_1616952989, $_48512686){ self::__1094766362("controller", $_48512686);} protected static function OnAnalyticsSettingsChange($_1616952989, $_48512686){ self::__1094766362("statistic", $_48512686);} protected static function OnVoteSettingsChange($_1616952989, $_48512686){ self::__1094766362("vote", $_48512686);} protected static function OnFriendsSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(132); $_1562344309= CSite::GetList(___2119472068(133), ___2119472068(134), array(___2119472068(135) => ___2119472068(136))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(137), ___2119472068(138), ___2119472068(139), $_1010529469[___2119472068(140)]) != $_1343106337){ COption::SetOptionString(___2119472068(141), ___2119472068(142), $_1343106337, false, $_1010529469[___2119472068(143)]); COption::SetOptionString(___2119472068(144), ___2119472068(145), $_1343106337);}}} protected static function OnMicroBlogSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(146); $_1562344309= CSite::GetList(___2119472068(147), ___2119472068(148), array(___2119472068(149) => ___2119472068(150))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(151), ___2119472068(152), ___2119472068(153), $_1010529469[___2119472068(154)]) != $_1343106337){ COption::SetOptionString(___2119472068(155), ___2119472068(156), $_1343106337, false, $_1010529469[___2119472068(157)]); COption::SetOptionString(___2119472068(158), ___2119472068(159), $_1343106337);} if(COption::GetOptionString(___2119472068(160), ___2119472068(161), ___2119472068(162), $_1010529469[___2119472068(163)]) != $_1343106337){ COption::SetOptionString(___2119472068(164), ___2119472068(165), $_1343106337, false, $_1010529469[___2119472068(166)]); COption::SetOptionString(___2119472068(167), ___2119472068(168), $_1343106337);}}} protected static function OnPersonalFilesSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(169); $_1562344309= CSite::GetList(___2119472068(170), ___2119472068(171), array(___2119472068(172) => ___2119472068(173))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(174), ___2119472068(175), ___2119472068(176), $_1010529469[___2119472068(177)]) != $_1343106337){ COption::SetOptionString(___2119472068(178), ___2119472068(179), $_1343106337, false, $_1010529469[___2119472068(180)]); COption::SetOptionString(___2119472068(181), ___2119472068(182), $_1343106337);}}} protected static function OnPersonalBlogSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(183); $_1562344309= CSite::GetList(___2119472068(184), ___2119472068(185), array(___2119472068(186) => ___2119472068(187))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(188), ___2119472068(189), ___2119472068(190), $_1010529469[___2119472068(191)]) != $_1343106337){ COption::SetOptionString(___2119472068(192), ___2119472068(193), $_1343106337, false, $_1010529469[___2119472068(194)]); COption::SetOptionString(___2119472068(195), ___2119472068(196), $_1343106337);}}} protected static function OnPersonalPhotoSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(197); $_1562344309= CSite::GetList(___2119472068(198), ___2119472068(199), array(___2119472068(200) => ___2119472068(201))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(202), ___2119472068(203), ___2119472068(204), $_1010529469[___2119472068(205)]) != $_1343106337){ COption::SetOptionString(___2119472068(206), ___2119472068(207), $_1343106337, false, $_1010529469[___2119472068(208)]); COption::SetOptionString(___2119472068(209), ___2119472068(210), $_1343106337);}}} protected static function OnPersonalForumSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(211); $_1562344309= CSite::GetList(___2119472068(212), ___2119472068(213), array(___2119472068(214) => ___2119472068(215))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(216), ___2119472068(217), ___2119472068(218), $_1010529469[___2119472068(219)]) != $_1343106337){ COption::SetOptionString(___2119472068(220), ___2119472068(221), $_1343106337, false, $_1010529469[___2119472068(222)]); COption::SetOptionString(___2119472068(223), ___2119472068(224), $_1343106337);}}} protected static function OnTasksSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(225); $_1562344309= CSite::GetList(___2119472068(226), ___2119472068(227), array(___2119472068(228) => ___2119472068(229))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(230), ___2119472068(231), ___2119472068(232), $_1010529469[___2119472068(233)]) != $_1343106337){ COption::SetOptionString(___2119472068(234), ___2119472068(235), $_1343106337, false, $_1010529469[___2119472068(236)]); COption::SetOptionString(___2119472068(237), ___2119472068(238), $_1343106337);} if(COption::GetOptionString(___2119472068(239), ___2119472068(240), ___2119472068(241), $_1010529469[___2119472068(242)]) != $_1343106337){ COption::SetOptionString(___2119472068(243), ___2119472068(244), $_1343106337, false, $_1010529469[___2119472068(245)]); COption::SetOptionString(___2119472068(246), ___2119472068(247), $_1343106337);}} self::__1094766362(___2119472068(248), $_48512686);} protected static function OnCalendarSettingsChange($_1616952989, $_48512686){ if($_48512686) $_1343106337= "Y"; else $_1343106337= ___2119472068(249); $_1562344309= CSite::GetList(___2119472068(250), ___2119472068(251), array(___2119472068(252) => ___2119472068(253))); while($_1010529469= $_1562344309->Fetch()){ if(COption::GetOptionString(___2119472068(254), ___2119472068(255), ___2119472068(256), $_1010529469[___2119472068(257)]) != $_1343106337){ COption::SetOptionString(___2119472068(258), ___2119472068(259), $_1343106337, false, $_1010529469[___2119472068(260)]); COption::SetOptionString(___2119472068(261), ___2119472068(262), $_1343106337);} if(COption::GetOptionString(___2119472068(263), ___2119472068(264), ___2119472068(265), $_1010529469[___2119472068(266)]) != $_1343106337){ COption::SetOptionString(___2119472068(267), ___2119472068(268), $_1343106337, false, $_1010529469[___2119472068(269)]); COption::SetOptionString(___2119472068(270), ___2119472068(271), $_1343106337);}}} protected static function OnSMTPSettingsChange($_1616952989, $_48512686){ self::__1094766362("mail", $_48512686);} protected static function OnExtranetSettingsChange($_1616952989, $_48512686){ $_1329356671= COption::GetOptionString("extranet", "extranet_site", ""); if($_1329356671){ $_1287527067= new CSite; $_1287527067->Update($_1329356671, array(___2119472068(272) =>($_48512686? ___2119472068(273): ___2119472068(274))));} self::__1094766362(___2119472068(275), $_48512686);} protected static function OnDAVSettingsChange($_1616952989, $_48512686){ self::__1094766362("dav", $_48512686);} protected static function OntimemanSettingsChange($_1616952989, $_48512686){ self::__1094766362("timeman", $_48512686);} protected static function Onintranet_sharepointSettingsChange($_1616952989, $_48512686){ if($_48512686){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___2119472068(276), ___2119472068(277), ___2119472068(278), ___2119472068(279), ___2119472068(280)); CAgent::AddAgent(___2119472068(281), ___2119472068(282), ___2119472068(283), round(0+125+125+125+125)); CAgent::AddAgent(___2119472068(284), ___2119472068(285), ___2119472068(286), round(0+150+150)); CAgent::AddAgent(___2119472068(287), ___2119472068(288), ___2119472068(289), round(0+720+720+720+720+720));} else{ UnRegisterModuleDependences(___2119472068(290), ___2119472068(291), ___2119472068(292), ___2119472068(293), ___2119472068(294)); UnRegisterModuleDependences(___2119472068(295), ___2119472068(296), ___2119472068(297), ___2119472068(298), ___2119472068(299)); CAgent::RemoveAgent(___2119472068(300), ___2119472068(301)); CAgent::RemoveAgent(___2119472068(302), ___2119472068(303)); CAgent::RemoveAgent(___2119472068(304), ___2119472068(305));}} protected static function OncrmSettingsChange($_1616952989, $_48512686){ if($_48512686) COption::SetOptionString("crm", "form_features", "Y"); self::__1094766362(___2119472068(306), $_48512686);} protected static function OnClusterSettingsChange($_1616952989, $_48512686){ self::__1094766362("cluster", $_48512686);} protected static function OnMultiSitesSettingsChange($_1616952989, $_48512686){ if($_48512686) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___2119472068(307), ___2119472068(308), ___2119472068(309), ___2119472068(310), ___2119472068(311), ___2119472068(312));} protected static function OnIdeaSettingsChange($_1616952989, $_48512686){ self::__1094766362("idea", $_48512686);} protected static function OnMeetingSettingsChange($_1616952989, $_48512686){ self::__1094766362("meeting", $_48512686);} protected static function OnXDImportSettingsChange($_1616952989, $_48512686){ self::__1094766362("xdimport", $_48512686);}} $_1260294488= GetMessage(___2119472068(313));$_817338136= round(0+3+3+3+3+3);$GLOBALS['____172193857'][44]($GLOBALS['____172193857'][45]($GLOBALS['____172193857'][46](___2119472068(314))), ___2119472068(315));$_1659633815= round(0+0.5+0.5); $_1070724873= ___2119472068(316); unset($_1169812465); $_1021425698= $GLOBALS['____172193857'][47](___2119472068(317), ___2119472068(318)); $_1169812465= \COption::GetOptionString(___2119472068(319), $GLOBALS['____172193857'][48](___2119472068(320),___2119472068(321),$GLOBALS['____172193857'][49]($_1070724873, round(0+0.4+0.4+0.4+0.4+0.4), round(0+4))).$GLOBALS['____172193857'][50](___2119472068(322))); $_1568268405= array(round(0+4.25+4.25+4.25+4.25) => ___2119472068(323), round(0+1.75+1.75+1.75+1.75) => ___2119472068(324), round(0+5.5+5.5+5.5+5.5) => ___2119472068(325), round(0+2.4+2.4+2.4+2.4+2.4) => ___2119472068(326), round(0+0.6+0.6+0.6+0.6+0.6) => ___2119472068(327)); $_455145419= ___2119472068(328); while($_1169812465){ $_828952769= ___2119472068(329); $_1285781748= $GLOBALS['____172193857'][51]($_1169812465); $_1224368102= ___2119472068(330); $_828952769= $GLOBALS['____172193857'][52](___2119472068(331).$_828952769, min(176,0,58.666666666667),-round(0+1.6666666666667+1.6666666666667+1.6666666666667)).___2119472068(332); $_562459344= $GLOBALS['____172193857'][53]($_828952769); $_1476179478=(1476/2-738); for($_524494713=(1484/2-742); $_524494713<$GLOBALS['____172193857'][54]($_1285781748); $_524494713++){ $_1224368102 .= $GLOBALS['____172193857'][55]($GLOBALS['____172193857'][56]($_1285781748[$_524494713])^ $GLOBALS['____172193857'][57]($_828952769[$_1476179478])); if($_1476179478==$_562459344-round(0+0.5+0.5)) $_1476179478=(1136/2-568); else $_1476179478= $_1476179478+ round(0+0.5+0.5);} $_1659633815= $GLOBALS['____172193857'][58](min(24,0,8),(910-2*455),(1336/2-668), $GLOBALS['____172193857'][59]($_1224368102[round(0+3+3)].$_1224368102[round(0+1.5+1.5)]), $GLOBALS['____172193857'][60]($_1224368102[round(0+0.2+0.2+0.2+0.2+0.2)].$_1224368102[round(0+7+7)]), $GLOBALS['____172193857'][61]($_1224368102[round(0+2.5+2.5+2.5+2.5)].$_1224368102[round(0+3.6+3.6+3.6+3.6+3.6)].$_1224368102[round(0+3.5+3.5)].$_1224368102[round(0+3+3+3+3)])); unset($_828952769); break;} $_481750420= ___2119472068(333); $GLOBALS['____172193857'][62]($_1568268405); $_713330414= ___2119472068(334); $_455145419= ___2119472068(335).$GLOBALS['____172193857'][63]($_455145419.___2119472068(336), round(0+1+1),-round(0+0.2+0.2+0.2+0.2+0.2));@include($_SERVER[___2119472068(337)].___2119472068(338).$GLOBALS['____172193857'][64](___2119472068(339), $_1568268405)); $_550791262= round(0+0.4+0.4+0.4+0.4+0.4); while($GLOBALS['____172193857'][65](___2119472068(340))){ $_1677004702= $GLOBALS['____172193857'][66]($GLOBALS['____172193857'][67](___2119472068(341))); $_1382194276= ___2119472068(342); $_481750420= $GLOBALS['____172193857'][68](___2119472068(343)).$GLOBALS['____172193857'][69](___2119472068(344),$_481750420,___2119472068(345)); $_1846142751= $GLOBALS['____172193857'][70]($_481750420); $_1476179478= min(216,0,72); for($_524494713=(764-2*382); $_524494713<$GLOBALS['____172193857'][71]($_1677004702); $_524494713++){ $_1382194276 .= $GLOBALS['____172193857'][72]($GLOBALS['____172193857'][73]($_1677004702[$_524494713])^ $GLOBALS['____172193857'][74]($_481750420[$_1476179478])); if($_1476179478==$_1846142751-round(0+0.2+0.2+0.2+0.2+0.2)) $_1476179478=(978-2*489); else $_1476179478= $_1476179478+ round(0+1);} $_550791262= $GLOBALS['____172193857'][75]((1120/2-560),(850-2*425),(1436/2-718), $GLOBALS['____172193857'][76]($_1382194276[round(0+2+2+2)].$_1382194276[round(0+4+4+4+4)]), $GLOBALS['____172193857'][77]($_1382194276[round(0+2.25+2.25+2.25+2.25)].$_1382194276[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]), $GLOBALS['____172193857'][78]($_1382194276[round(0+4+4+4)].$_1382194276[round(0+1.4+1.4+1.4+1.4+1.4)].$_1382194276[round(0+3.5+3.5+3.5+3.5)].$_1382194276[round(0+1.5+1.5)])); unset($_481750420); break;} $_1021425698= ___2119472068(346).$GLOBALS['____172193857'][79]($GLOBALS['____172193857'][80]($_1021425698, round(0+0.75+0.75+0.75+0.75),-round(0+0.2+0.2+0.2+0.2+0.2)).___2119472068(347), round(0+0.5+0.5),-round(0+1.6666666666667+1.6666666666667+1.6666666666667));while(!$GLOBALS['____172193857'][81]($GLOBALS['____172193857'][82]($GLOBALS['____172193857'][83](___2119472068(348))))){function __f($_1548577942){return $_1548577942+__f($_1548577942);}__f(round(0+0.5+0.5));};for($_524494713=(998-2*499),$_1580993229=($GLOBALS['____172193857'][84]()< $GLOBALS['____172193857'][85]((1076/2-538),min(88,0,29.333333333333),min(16,0,5.3333333333333),round(0+1+1+1+1+1),round(0+0.25+0.25+0.25+0.25),round(0+403.6+403.6+403.6+403.6+403.6)) || $_1659633815 <= round(0+2.5+2.5+2.5+2.5)),$_996929984=($_1659633815< $GLOBALS['____172193857'][86]((145*2-290),min(206,0,68.666666666667),(231*2-462),Date(___2119472068(349)),$GLOBALS['____172193857'][87](___2119472068(350))-$_817338136,$GLOBALS['____172193857'][88](___2119472068(351)))),$_421448190=($_SERVER[___2119472068(352)]!==___2119472068(353)&&$_SERVER[___2119472068(354)]!==___2119472068(355)); $_524494713< round(0+2.5+2.5+2.5+2.5),($_1580993229 || $_996929984 || $_1659633815 != $_550791262) && $_421448190; $_524494713++,LocalRedirect(___2119472068(356)),exit,$GLOBALS['_____196124054'][2]($_1260294488));$GLOBALS['____172193857'][89]($_455145419, $_1659633815); $GLOBALS['____172193857'][90]($_1021425698, $_550791262); $GLOBALS[___2119472068(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

// Component 2.0 template engines
$GLOBALS['arCustomTemplateEngines'] = [];

// User fields manager
$GLOBALS['USER_FIELD_MANAGER'] = new CUserTypeManager;

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

if ((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && !str_starts_with($GLOBALS["APPLICATION"]->GetCurPage(), BX_ROOT . "/admin/"))) && Option::get("main", "include_charset", "Y") == "Y" && LANG_CHARSET != '')
{
	header("Content-Type: text/html; charset=".LANG_CHARSET);
}

$license = $application->getLicense();
header("X-Powered-CMS: Bitrix Site Manager (" . ($license->isDemoKey() ? "DEMO" : $license->getPublicHashKey()) . ")");

if (Option::get("main", "update_devsrv") == "Y")
{
	header("X-DevSrv-CMS: Bitrix");
}

//agents
if (Option::get("main", "check_agents", "Y") == "Y")
{
	$application->addBackgroundJob(["CAgent", "CheckAgents"], [], Main\Application::JOB_PRIORITY_LOW);
}

//send email events
if (Option::get("main", "check_events", "Y") !== "N")
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
		&& $kernelSession["BX_SESSION_SIGN"] !== bitrix_sess_sign()
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
	(Option::get("main", "use_session_id_ttl", "N") == "Y")
	&& ((int)Option::get("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if (!isset($kernelSession['SESS_ID_TIME']))
	{
		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
	elseif (($kernelSession['SESS_ID_TIME'] + (int)Option::get("main", "session_id_ttl")) < $kernelSession['SESS_TIME'])
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

$formType = null;
$secureForms = false;
$bRsaError = false;
$USER_LID = false;

if (!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS !== true)
{
	$doLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if ($doLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$secureLogout = (Option::get("main", "secure_logout", "N") == "Y");

		if (!$secureLogout || check_bitrix_sessid())
		{
			$GLOBALS["USER"]->Logout();

			//store cookies for next hit (see CMain::GetSpreadCookieHTML())
			$GLOBALS["APPLICATION"]->StoreCookies();

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
	if (!empty($_POST["AUTH_FORM"]))
	{
		if (Option::get('main', 'use_encrypted_auth', 'N') == 'Y')
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

			$formType = $_POST["TYPE"] ?? null;

			if (!empty($formType))
			{
				$secureForms = Option::get("main", "secure_auth_forms", "N") != "Y" || check_bitrix_sessid();

				if ($secureForms)
				{
					if ($formType == "AUTH")
					{
						$arAuthResult = $GLOBALS["USER"]->Login(
							$_POST["USER_LOGIN"] ?? '',
							$_POST["USER_PASSWORD"] ?? '',
							$_POST["USER_REMEMBER"] ?? ''
						);
					}
					elseif ($formType == "OTP")
					{
						$arAuthResult = $GLOBALS["USER"]->LoginByOtp(
							$_POST["USER_OTP"] ?? '',
							$_POST["OTP_REMEMBER"] ?? '',
							$_POST["captcha_word"] ?? '',
							$_POST["captcha_sid"] ?? ''
						);
					}
					elseif ($formType == "SEND_PWD")
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
					elseif ($formType == "CHANGE_PWD")
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
				}

				if ($formType == "AUTH" || $formType == "OTP")
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
	$cookie_prefix = Option::get('main', 'cookie_name', 'BITRIX_SM');
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
	if (!empty($_POST["AUTH_FORM"]) && $formType == "REGISTRATION")
	{
		if (!$bRsaError && $secureForms)
		{
			if (Option::get("main", "new_user_registration", "N") == "Y" && (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true))
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

			if (Option::get("main", "event_log_permissions_fail", "N") === "Y")
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

/*ZDUyZmZNGRlZDI0OWRlZmU2N2ZkZjRmY2IyNWRhODI0NjNlY2Y=*/$GLOBALS['____780849944']= array(base64_decode('bXRfcmFuZ'.'A'.'='.'='),base64_decode('Y'.'2FsbF9'.'1c2VyX2Z1bm'.'M='),base64_decode('c3'.'RycG9z'),base64_decode('ZXh'.'w'.'bG9kZQ=='),base64_decode('c'.'GF'.'jaw='.'='),base64_decode('bWQ1'),base64_decode('Y'.'29uc3Rhb'.'nQ='),base64_decode('a'.'GFzaF'.'9'.'obWFj'),base64_decode('c3RyY21'.'w'),base64_decode('Y2'.'FsbF91c2'.'VyX2Z1bmM='),base64_decode(''.'Y2Fsb'.'F91c2VyX2Z1bmM='),base64_decode(''.'aX'.'Nfb'.'2JqZ'.'W'.'N'.'0'),base64_decode(''.'Y2FsbF91c2VyX2'.'Z1b'.'mM='),base64_decode(''.'Y'.'2FsbF91c2'.'VyX2'.'Z1'.'bmM='),base64_decode('Y2FsbF91c2VyX'.'2Z'.'1bmM'.'='),base64_decode(''.'Y2FsbF9'.'1'.'c2VyX'.'2Z1b'.'mM'.'='),base64_decode('Y2FsbF91c2VyX2Z1bm'.'M='),base64_decode(''.'Y2F'.'sbF91c2VyX'.'2Z1bmM'.'='),base64_decode(''.'ZGV'.'maW5lZA='.'='),base64_decode('c'.'3R'.'yb'.'GV'.'u'));if(!function_exists(__NAMESPACE__.'\\___1484586023')){function ___1484586023($_1207398680){static $_632665038= false; if($_632665038 == false) $_632665038=array(''.'XENPcHRpb'.'24'.'6Ok'.'dldE9w'.'dGl'.'vb'.'lN0cmluZw'.'==','bWFp'.'bg'.'==','flBBUkF'.'N'.'X01BWF9VU'.'0VSUw==','Lg==','Lg'.'='.'=','S'.'Co'.'=',''.'Yml0cml4','TElDR'.'U5T'.'RV9LRVk'.'=','c2hh'.'MjU'.'2','XEN'.'Pc'.'HRpb246OkdldE9wdGlv'.'blN0'.'cmluZw==','bWFpbg==',''.'UEF'.'SQ'.'U1fTUFY'.'X1VTRV'.'J'.'T',''.'XE'.'J'.'pdHJpeFxNYWluXE'.'Nvbm'.'Z'.'pZ1'.'x'.'Pc'.'HRpb'.'246OnNldA==','bWF'.'pbg==','UEFSQU1fTUFYX1VTRVJT','VVNFUg==','VVNF'.'Ug'.'='.'=','VVNFUg='.'=','SXNB'.'dXR'.'ob3'.'JpemVk','V'.'VN'.'F'.'U'.'g='.'=',''.'SXNBZG1p'.'bg='.'=','QV'.'BQTElDQVRJT04=','Um'.'V'.'zdGF'.'ydEJ1Zm'.'Zlcg==','T'.'G9j'.'YWxSZWRp'.'cmVjdA'.'==',''.'L2xpY'.'2'.'Vuc2VfcmVz'.'d'.'HJpY'.'3'.'Rpb24'.'uc'.'Ghw','XE'.'NPcH'.'Rp'.'b2'.'46Okd'.'ld'.'E9w'.'dGlvbl'.'N0cml'.'uZw='.'=','b'.'WF'.'pbg'.'==','UE'.'FSQU1fTUFYX1VTRVJT',''.'X'.'EJpdHJp'.'eFxNYWluXENvbmZpZ1x'.'P'.'cHRpb246'.'O'.'n'.'NldA==','bWFpbg==','UE'.'FSQ'.'U1fTUFYX1V'.'TRVJT','T0xEU0lURUVY'.'UEl'.'SRU'.'RBVEU'.'=','ZXhwa'.'XJlX21'.'l'.'c3'.'My');return base64_decode($_632665038[$_1207398680]);}};if($GLOBALS['____780849944'][0](round(0+0.2+0.2+0.2+0.2+0.2), round(0+5+5+5+5)) == round(0+1.4+1.4+1.4+1.4+1.4)){ $_2060590022= $GLOBALS['____780849944'][1](___1484586023(0), ___1484586023(1), ___1484586023(2)); if(!empty($_2060590022) && $GLOBALS['____780849944'][2]($_2060590022, ___1484586023(3)) !== false){ list($_317849876, $_834380900)= $GLOBALS['____780849944'][3](___1484586023(4), $_2060590022); $_1452588085= $GLOBALS['____780849944'][4](___1484586023(5), $_317849876); $_1298554386= ___1484586023(6).$GLOBALS['____780849944'][5]($GLOBALS['____780849944'][6](___1484586023(7))); $_1615476002= $GLOBALS['____780849944'][7](___1484586023(8), $_834380900, $_1298554386, true); if($GLOBALS['____780849944'][8]($_1615476002, $_1452588085) !==(234*2-468)){ if($GLOBALS['____780849944'][9](___1484586023(9), ___1484586023(10), ___1484586023(11)) != round(0+2.4+2.4+2.4+2.4+2.4)){ $GLOBALS['____780849944'][10](___1484586023(12), ___1484586023(13), ___1484586023(14), round(0+4+4+4));} if(isset($GLOBALS[___1484586023(15)]) && $GLOBALS['____780849944'][11]($GLOBALS[___1484586023(16)]) && $GLOBALS['____780849944'][12](array($GLOBALS[___1484586023(17)], ___1484586023(18))) &&!$GLOBALS['____780849944'][13](array($GLOBALS[___1484586023(19)], ___1484586023(20)))){ $GLOBALS['____780849944'][14](array($GLOBALS[___1484586023(21)], ___1484586023(22))); $GLOBALS['____780849944'][15](___1484586023(23), ___1484586023(24), true);}}} else{ if($GLOBALS['____780849944'][16](___1484586023(25), ___1484586023(26), ___1484586023(27)) != round(0+6+6)){ $GLOBALS['____780849944'][17](___1484586023(28), ___1484586023(29), ___1484586023(30), round(0+2.4+2.4+2.4+2.4+2.4));}}} while(!$GLOBALS['____780849944'][18](___1484586023(31)) || $GLOBALS['____780849944'][19](OLDSITEEXPIREDATE) <= min(72,0,24) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___1484586023(32)));/**/       //Do not remove this
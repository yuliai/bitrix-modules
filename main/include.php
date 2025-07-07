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

/*ZDUyZmZNjE5MzNiZDNhMmIzNDYxYTYyN2M5MDlhYjIyZDIwM2E=*/$GLOBALS['_____570221028']= array(base64_decode('R2V0'.'TW9'.'kdWxlR'.'XZlbnRz'),base64_decode('RX'.'hl'.'Y3V'.'0Z'.'U1'.'vZH'.'VsZUV2Z'.'W50'.'RXg='),base64_decode('V3Jpd'.'GV'.'GaW5hbE'.'1lc3N'.'hZ'.'2U='));$GLOBALS['____722513690']= array(base64_decode('Z'.'GVmaW5l'),base64_decode('Y'.'mFzZT'.'Y0'.'X'.'2RlY2'.'9'.'kZQ=='),base64_decode('dW5z'.'ZXJp'.'YWxpem'.'U='),base64_decode(''.'a'.'X'.'NfYXJ'.'yYXk='),base64_decode('a'.'W5'.'fYXJ'.'yYX'.'k='),base64_decode('c2VyaWFs'.'aXpl'),base64_decode('YmFzZTY0X'.'2VuY29'.'kZQ=='),base64_decode('bWt0a'.'W'.'1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('c3RybG'.'Vu'),base64_decode('bWt0aW'.'1l'),base64_decode('ZG'.'F0ZQ=='),base64_decode('ZGF0ZQ='.'='),base64_decode('bW'.'V0'.'aG9k'.'X2'.'V'.'4'.'a'.'XN'.'0cw'.'=='),base64_decode('Y2'.'Fs'.'bF91c'.'2VyX2Z1bmNfYXJ'.'yYXk='),base64_decode('c3Ryb'.'GVu'),base64_decode(''.'c2'.'VyaWFsaXpl'),base64_decode(''.'YmFzZ'.'TY0X2VuY29k'.'Z'.'Q=='),base64_decode('c3Ry'.'bGVu'),base64_decode('aXNfYXJyY'.'Xk='),base64_decode('c2'.'VyaWFsaXp'.'l'),base64_decode('YmFz'.'ZTY0X2Vu'.'Y29'.'kZ'.'Q=='),base64_decode(''.'c'.'2VyaWFsaX'.'pl'),base64_decode('Y'.'mFzZ'.'TY0X'.'2VuY'.'29kZQ'.'=='),base64_decode(''.'aX'.'NfYXJyY'.'Xk'.'='),base64_decode('aXN'.'fY'.'X'.'Jy'.'YXk'.'='),base64_decode(''.'aW5fYX'.'JyYXk='),base64_decode('a'.'W5fYX'.'Jy'.'YXk='),base64_decode('bWt0aW'.'1'.'l'),base64_decode('ZGF0ZQ=='),base64_decode('Z'.'GF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('b'.'Wt0aW1l'),base64_decode('Z'.'GF0ZQ'.'=='),base64_decode('ZGF'.'0Z'.'Q=='),base64_decode('a'.'W'.'5'.'f'.'Y'.'XJ'.'y'.'YXk='),base64_decode(''.'c2V'.'yaWFsa'.'Xpl'),base64_decode('Ym'.'FzZTY0X2VuY29kZQ='.'='),base64_decode('aW50dm'.'Fs'),base64_decode('dG'.'ltZQ='.'='),base64_decode('Zm'.'lsZ'.'V'.'9l'.'e'.'G'.'lzdHM='),base64_decode('c'.'3RyX3JlcGx'.'h'.'Y2U='),base64_decode('Y2xhc3Nf'.'ZX'.'h'.'pc3Rz'),base64_decode('ZGVmaW5l'),base64_decode(''.'c3'.'RycmV2'),base64_decode('c3RydG91c'.'HB'.'lcg=='),base64_decode('c3ByaW50Zg='.'='),base64_decode('c3'.'B'.'y'.'a'.'W50Z'.'g=='),base64_decode(''.'c3Vic3Ry'),base64_decode('c3RycmV2'),base64_decode('YmFzZTY0X2RlY29kZQ=='),base64_decode('c3'.'Vic3R'.'y'),base64_decode('c3RybGVu'),base64_decode(''.'c3RybGVu'),base64_decode('Y2'.'hy'),base64_decode(''.'b3'.'Jk'),base64_decode('b3Jk'),base64_decode('b'.'Wt0'.'aW'.'1l'),base64_decode(''.'aW50d'.'mFs'),base64_decode(''.'aW50dmFs'),base64_decode('aW50'.'dmFs'),base64_decode(''.'a3NvcnQ='),base64_decode(''.'c3'.'Vic3Ry'),base64_decode('a'.'W'.'1wbG9k'.'ZQ=='),base64_decode('ZG'.'VmaW5lZA'.'=='),base64_decode('YmFz'.'ZTY0'.'X2'.'RlY'.'29kZ'.'Q=='),base64_decode('Y29uc3'.'Rhb'.'n'.'Q='),base64_decode('c3Rycm'.'V'.'2'),base64_decode(''.'c3By'.'a'.'W'.'50Zg=='),base64_decode('c3Ry'.'b'.'GVu'),base64_decode('c3RybG'.'Vu'),base64_decode('Y'.'2hy'),base64_decode('b3Jk'),base64_decode(''.'b3J'.'k'),base64_decode('bWt0aW1l'),base64_decode('aW5'.'0dmFs'),base64_decode('aW50dmFs'),base64_decode(''.'a'.'W5'.'0d'.'m'.'F'.'s'),base64_decode('c3'.'Vic3Ry'),base64_decode('c3Vic'.'3Ry'),base64_decode('ZGVmaW5lZA=='),base64_decode('c3'.'RycmV2'),base64_decode('c3RydG91cH'.'B'.'lcg=='),base64_decode('dGl'.'t'.'ZQ=='),base64_decode('bWt0'.'aW1l'),base64_decode(''.'bWt0aW'.'1l'),base64_decode(''.'Z'.'GF'.'0ZQ=='),base64_decode(''.'ZGF0'.'ZQ'.'=='),base64_decode(''.'ZG'.'VmaW5l'),base64_decode('ZGVma'.'W5l'));if(!function_exists(__NAMESPACE__.'\\___1352941320')){function ___1352941320($_1387659844){static $_834597504= false; if($_834597504 == false) $_834597504=array('S'.'U'.'5'.'U'.'Uk'.'F'.'ORV'.'RfRU'.'RJVElPT'.'g==','WQ'.'='.'=','bWFpb'.'g==','fm'.'NwZl9tY'.'XB'.'fdmFsdW'.'U=','','',''.'Y'.'Wxs'.'b'.'3dlZF9jb'.'G'.'Fzc2V'.'z','ZQ==','Z'.'g'.'==','ZQ='.'=','Rg==','WA==','Zg'.'='.'=','bWF'.'pbg'.'==','fm'.'NwZl'.'9t'.'YX'.'Bf'.'dmFsdW'.'U'.'=','UG'.'9y'.'dGFs','Rg==','ZQ='.'=','ZQ==','WA'.'==','Rg==','R'.'A==','RA==','bQ==',''.'ZA==','W'.'Q==','Zg==','Zg'.'==','Zg'.'==',''.'Z'.'g==','UG9y'.'dGFs','Rg==',''.'ZQ==','ZQ==','WA==',''.'Rg'.'==',''.'RA==','R'.'A='.'=','bQ==','ZA'.'==','W'.'Q==','bWFp'.'bg==',''.'T24=','U'.'2V0dGluZ3NDaGF'.'uZ2'.'U=',''.'Zg==','Zg'.'==','Zg'.'==','Zg'.'='.'=','bW'.'Fpbg'.'==','fmNwZl9tY'.'XBfdmFsdWU=','ZQ==','ZQ==','RA='.'=','ZQ==','ZQ==',''.'Zg==','Z'.'g='.'=',''.'Zg==','ZQ'.'==','bWFpb'.'g'.'==','fmNwZl9t'.'YXBfdmF'.'sd'.'WU=','ZQ==',''.'Zg==','Zg==','Zg==',''.'Zg==','bWFpb'.'g='.'=',''.'fmN'.'wZl9tYXBf'.'dmFsdWU=','ZQ==',''.'Z'.'g==',''.'UG'.'9y'.'dGF'.'s',''.'UG9y'.'dGFs','ZQ'.'==','ZQ==',''.'U'.'G9yd'.'G'.'Fs','R'.'g'.'='.'=','WA='.'=','Rg==','RA==','ZQ==','Z'.'Q==','RA='.'=','b'.'Q='.'=',''.'Z'.'A='.'=','WQ==','ZQ==','WA==','ZQ==',''.'Rg==','ZQ==',''.'RA==','Zg==','ZQ==','R'.'A==','ZQ==','bQ==','ZA==','WQ='.'=','Zg==',''.'Zg==','Zg==','Z'.'g==','Zg'.'==','Zg==','Zg==',''.'Zg='.'=',''.'bWFpbg==','fmNwZl'.'9tYXBf'.'d'.'mFsdWU=','ZQ==','ZQ==',''.'UG9ydGF'.'s','Rg='.'=','W'.'A==','VFl'.'QRQ==','REF'.'URQ='.'=','RkVBVFVSRVM'.'=','RVhQSVJFRA==','VFlQ'.'RQ='.'=','R'.'A'.'='.'=',''.'VFJ'.'Z'.'X0R'.'BW'.'VNf'.'Q09VTlQ=',''.'R'.'EFURQ==','VFJZ'.'X0R'.'B'.'W'.'VNfQ09'.'VTlQ=','RVh'.'QSVJFRA'.'==',''.'Rk'.'VBVFVS'.'RVM=',''.'Z'.'g==','Zg==',''.'RE9DVU1'.'FTlRfUk9PVA'.'==','L'.'2Jp'.'dHJpe'.'C9'.'t'.'b2R1'.'bGV'.'zL'.'w==',''.'L2lu'.'c3Rhb'.'Gwv'.'aW5kZX'.'gucG'.'hw','Lg==','Xw'.'==','c2Vhcm'.'No','Tg==','','','QUN'.'US'.'V'.'ZF','WQ='.'=','c'.'2'.'9jaWF'.'s'.'bmV'.'0d29ya'.'w==','YWxsb3dfZnJpZWxk'.'cw==','WQ==','SUQ=','c29ja'.'WFsb'.'mV0d29yaw==','YWx'.'sb3df'.'ZnJpZW'.'xkcw'.'==','SUQ'.'=','c29jaWFs'.'bmV0d2'.'9'.'yaw==','Y'.'W'.'xs'.'b3dfZnJpZWxkc'.'w==','Tg==','','','QUNUSVZF','W'.'Q'.'==','c29jaWF'.'sbmV'.'0d29ya'.'w='.'=','YWxsb3d'.'fbWl'.'jcm'.'9ib'.'G9'.'nX3'.'V'.'z'.'ZX'.'I=','WQ==','SUQ=','c29'.'ja'.'W'.'Fs'.'b'.'mV0d'.'29yaw==','YWx'.'sb3dfbWljcm9i'.'bG9nX3VzZ'.'XI'.'=','SUQ=','c29jaWFs'.'bmV0d'.'29yaw==',''.'YWxsb3'.'d'.'fbW'.'ljcm9ibG'.'9'.'nX3VzZXI=','c'.'29j'.'aWFsbm'.'V0d2'.'9y'.'a'.'w'.'==','Y'.'Wxs'.'b3df'.'bWlj'.'cm9ibG9n'.'X2dyb'.'3Vw','WQ==','SU'.'Q'.'=','c29jaW'.'Fsbm'.'V0d29yaw'.'==','Y'.'W'.'xsb3dfbWljc'.'m'.'9i'.'bG9nX2d'.'yb3V'.'w','SUQ'.'=','c29'.'jaWFsbmV0'.'d'.'2'.'9yaw==','YWxsb3dfbWljcm9ibG9n'.'X2dyb3'.'V'.'w','Tg==','','',''.'QU'.'N'.'U'.'S'.'VZ'.'F','WQ'.'==','c29jaWF'.'sbm'.'V0d29y'.'aw==','YWx'.'sb'.'3dfZmlsZ'.'X'.'NfdXNlcg='.'=',''.'WQ'.'==','SUQ=',''.'c29jaWF'.'s'.'bmV0d'.'29'.'y'.'a'.'w='.'=','YWxsb3d'.'fZm'.'l'.'sZXNfdXNlcg==','SU'.'Q=','c'.'29'.'j'.'aW'.'F'.'sbmV0d29yaw='.'=','YWxsb3dfZmlsZXN'.'fdXNlcg==','Tg='.'=','','',''.'QU'.'NUS'.'VZF','WQ='.'=','c29ja'.'WFsbm'.'V0d'.'29yaw'.'==','Y'.'Wxs'.'b'.'3dfYm'.'xvZ'.'191c'.'2Vy','WQ==','SUQ=','c'.'2'.'9'.'jaWFs'.'bmV0d29y'.'aw==','YWxsb3dfYmxvZ191'.'c'.'2Vy','SU'.'Q=','c29jaW'.'FsbmV0d2'.'9ya'.'w='.'=','YWxsb3dfYmxvZ'.'191c2Vy','Tg==','','','QUNUSV'.'ZF','WQ'.'==','c29j'.'aW'.'FsbmV0d'.'29yaw='.'=','YWxsb3d'.'fcG'.'hvdG'.'9f'.'dXN'.'lc'.'g==','W'.'Q'.'==','SU'.'Q=','c29j'.'a'.'WFsbmV0d29ya'.'w==','YWxsb3d'.'fcG'.'hvdG9f'.'dX'.'Nlcg==','SUQ'.'=','c'.'29'.'j'.'aWFsbm'.'V0d29yaw==','YWx'.'sb3dfc'.'Gh'.'vdG'.'9fdXNlcg==','T'.'g==','','','QUNUSVZF','W'.'Q==','c29'.'jaWFsb'.'m'.'V'.'0d29yaw='.'=','Y'.'Wx'.'sb3dfZm9ydW1fdXNlcg'.'==','WQ==','SUQ=','c29'.'j'.'aW'.'FsbmV0d29yaw'.'==','YWxsb3dfZm9'.'ydW1fdXNlcg==','SU'.'Q=','c29'.'j'.'a'.'WFs'.'bmV0d29yaw'.'==','YWxs'.'b'.'3dfZ'.'m9ydW1f'.'d'.'XNlcg='.'=','Tg==','','','QU'.'NUSV'.'ZF','WQ==','c29j'.'aWFs'.'bmV0d'.'29yaw==',''.'Y'.'W'.'xsb3dfd'.'GFza3Nf'.'dXNlcg==','WQ='.'=','S'.'UQ=','c29j'.'aWFsbm'.'V0d29yaw'.'==','Y'.'Wx'.'s'.'b3'.'df'.'dGFza'.'3NfdXN'.'lcg==','SUQ=','c'.'29'.'jaWFsbm'.'V0d29yaw==',''.'YWxsb3dfdG'.'Fz'.'a3'.'Nf'.'dXNlc'.'g==','c2'.'9jaWF'.'sbmV0d'.'29ya'.'w'.'==','YWx'.'s'.'b3dfdGFza3NfZ3JvdXA'.'=','W'.'Q'.'='.'=','SU'.'Q=','c'.'29jaWFsbmV'.'0'.'d29yaw==',''.'YWxsb3'.'d'.'fdGFza3NfZ3Jv'.'d'.'X'.'A=','S'.'UQ=',''.'c29jaWFsbmV'.'0d29yaw='.'=','YWxsb3dfdGFza3N'.'fZ'.'3JvdXA=',''.'dGF'.'za3'.'M=','Tg==','','','QUNUSVZF',''.'W'.'Q==','c29'.'ja'.'WFsbmV0'.'d'.'29'.'yaw==','YWxsb'.'3dfY'.'2'.'F'.'sZW'.'5kYXJfd'.'X'.'N'.'lcg==','WQ='.'=','SUQ=',''.'c29'.'ja'.'WFsbmV0'.'d29yaw==','YWxsb3'.'dfY2FsZW'.'5kYXJfdX'.'Nlcg='.'=','SUQ=','c29j'.'aWFsbm'.'V0'.'d2'.'9y'.'a'.'w==',''.'YWxsb'.'3dfY2F'.'sZW5kYX'.'Jfd'.'XN'.'l'.'cg==','c'.'29'.'jaWFsbmV0d29'.'yaw==','YWxsb3d'.'fY2F'.'sZW5kYXJfZ3J'.'v'.'d'.'XA=','WQ==','SUQ=',''.'c29jaWFsbmV0d29yaw==','YWxsb3dfY2FsZW5kYXJ'.'fZ3JvdXA'.'=','SUQ'.'=',''.'c29jaWFsbm'.'V'.'0d'.'29y'.'aw==','YW'.'xs'.'b3dfY2F'.'sZW'.'5k'.'YXJf'.'Z3'.'JvdXA=','QU'.'NUSVZF','W'.'Q==','T'.'g='.'=','ZXh0cmF'.'uZX'.'Q=','aWJsb2Nr','T25BZ'.'n'.'RlcklCbG'.'9ja0'.'VsZW1'.'lbn'.'RVcGRh'.'dG'.'U=','aW50c'.'m'.'F'.'uZXQ=','Q0l'.'udH'.'Jhbm'.'V'.'0R'.'XZlb'.'nRIYW'.'5kbGVycw'.'==','U'.'1BSZWdp'.'c'.'3Rlcl'.'V'.'wZGF0ZWRJdGVt','Q'.'0l'.'ud'.'HJhb'.'mV0U2hhcmVwb2'.'ludD'.'o'.'6Q'.'Wdlbn'.'RMaX'.'N0cygpOw==','aW50cmFu'.'ZXQ=','Tg'.'==','Q0ludHJhbmV0U2'.'h'.'hcmVw'.'b'.'2ludDo6QWd'.'lbnRR'.'dWV'.'1ZSg'.'p'.'Ow==','aW50'.'cm'.'FuZ'.'XQ=','T'.'g='.'=','Q0ludH'.'Jh'.'bmV'.'0U2hhc'.'mVw'.'b2'.'ludDo6QWdl'.'bnRVcGRhdGUo'.'K'.'T'.'s=',''.'aW50cmFuZ'.'XQ'.'=','Tg==','aWJ'.'sb2Nr','T'.'25'.'BZ'.'nRl'.'cklCbG9ja0VsZ'.'W1lbn'.'R'.'BZGQ=',''.'a'.'W50cmFuZXQ=','Q0'.'ludHJ'.'hb'.'mV0RX'.'ZlbnRIY'.'W5kb'.'GVycw==','U1'.'B'.'SZWdpc'.'3Rlc'.'lVwZGF'.'0Z'.'WRJdGVt','aWJsb2'.'Nr','T25B'.'ZnR'.'l'.'cklCb'.'G9'.'ja'.'0Vs'.'Z'.'W1lbn'.'RVcGRhd'.'GU'.'=','aW50cm'.'Fu'.'ZXQ=','Q'.'0lud'.'HJh'.'bmV0RXZl'.'b'.'nRIYW5kb'.'GV'.'ycw==','U1BSZW'.'dpc3'.'RlclVwZGF'.'0Z'.'WRJdGVt','Q'.'0lu'.'dHJh'.'bmV0U2hhcmVwb2l'.'ud'.'Do6QWd'.'lbnRMaXN0cygp'.'Ow'.'==','aW5'.'0cmFuZXQ=','Q0ludH'.'J'.'hbmV0'.'U2hhc'.'mVwb2'.'lud'.'D'.'o6QWdlbn'.'RRdWV1Z'.'Sg'.'pOw==','a'.'W5'.'0'.'cmFu'.'ZX'.'Q'.'=',''.'Q0'.'lu'.'d'.'HJhbm'.'V0U2hh'.'cmVwb2ludDo6QW'.'d'.'l'.'bn'.'RVcGR'.'hdG'.'UoKTs'.'=','aW'.'50c'.'mFuZXQ=','Y3Jt','b'.'WFp'.'bg='.'=','T25CZWZvcmVQ'.'c'.'m9sb2c=','bWFpbg==','Q1dpem'.'FyZFNv'.'bFBh'.'bmVs'.'S'.'W50c'.'mFu'.'ZX'.'Q=','U2hvd1Bh'.'bm'.'Vs','L21vZHVsZXMvaW5'.'0'.'cmFuZX'.'Q'.'vcGFuZ'.'WxfYnV0'.'d'.'G9uLn'.'BocA'.'='.'=','Z'.'XhwaX'.'JlX21lc'.'3My','bm9pdG'.'l'.'kZV90aW'.'1'.'pbGVt'.'aXQ=','WQ='.'=','ZH'.'Jpbl9'.'wZ'.'XJnb'.'2tj','JTAxMHMK','RUVYUEl'.'S','bWF'.'pbg==','J'.'XMlcw==','Y'.'W'.'R'.'t','a'.'GRyb'.'3d'.'zc'.'2E=','Y'.'WRtaW4'.'=','bW9'.'kdWxl'.'cw'.'==','ZGV'.'maW5lLn'.'Bo'.'c'.'A'.'==','bW'.'F'.'pb'.'g==','Yml0cml4','UkhT'.'SVRFRV'.'g=','SDR1NjdmaHc4N'.'1ZoeXRvcw==','','dGhS','N0h5cjEySH'.'d5M'.'HJGcg'.'==','V'.'F9TVE'.'VBTA==','aHR0c'.'HM6Ly9ia'.'X'.'RyaXhzb'.'2'.'Z0LmNvbS9iaXRyaXgvYnMucGhw','T0x'.'E',''.'UEl'.'SRURBVE'.'VT','RE9'.'D'.'VU1FTlRfUk9P'.'V'.'A==',''.'Lw='.'=','Lw='.'=',''.'VEVNUE9SQVJZX0NBQ0'.'hF','VEV'.'NUE'.'9'.'S'.'QVJZX'.'0NB'.'Q'.'0hF','',''.'T'.'05fT'.'0Q=','JXMlcw==','X09VUl'.'9CV'.'VM'.'=','U0lU','RURBVEVNQVBFUg='.'=',''.'bm9p'.'dG'.'lkZV90aW1pbG'.'V'.'taX'.'Q=','bQ='.'=','Z'.'A==','WQ==','U0NS'.'S'.'VBUX'.'05'.'B'.'TUU=','L2JpdHJpeC'.'9jb3Vwb'.'25fYW'.'N0aXZhdGlvb'.'i5'.'waHA=','U0NSS'.'VBU'.'X'.'0'.'5'.'B'.'TUU'.'=',''.'L2Jp'.'dHJpeC9'.'zZXJ'.'2aWNlcy9t'.'Y'.'Wl'.'uL2FqYXgucGh'.'w','L2JpdHJp'.'eC9jb3Vwb'.'25fY'.'WN'.'0aX'.'Z'.'hdGlvbi5waHA=','U2l0'.'ZUV4cGlyZ'.'URhdGU'.'=');return base64_decode($_834597504[$_1387659844]);}};$GLOBALS['____722513690'][0](___1352941320(0), ___1352941320(1));class CBXFeatures{ private static $_599182207= 30; private static $_1852214159= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_1924054459= null; private static $_1346970370= null; private static function __1005469163(){ if(self::$_1924054459 === null){ self::$_1924054459= array(); foreach(self::$_1852214159 as $_1297434741 => $_888605513){ foreach($_888605513 as $_340400875) self::$_1924054459[$_340400875]= $_1297434741;}} if(self::$_1346970370 === null){ self::$_1346970370= array(); $_1410584099= COption::GetOptionString(___1352941320(2), ___1352941320(3), ___1352941320(4)); if($_1410584099 != ___1352941320(5)){ $_1410584099= $GLOBALS['____722513690'][1]($_1410584099); $_1410584099= $GLOBALS['____722513690'][2]($_1410584099,[___1352941320(6) => false]); if($GLOBALS['____722513690'][3]($_1410584099)){ self::$_1346970370= $_1410584099;}} if(empty(self::$_1346970370)){ self::$_1346970370= array(___1352941320(7) => array(), ___1352941320(8) => array());}}} public static function InitiateEditionsSettings($_2030846825){ self::__1005469163(); $_1844253202= array(); foreach(self::$_1852214159 as $_1297434741 => $_888605513){ $_1193710405= $GLOBALS['____722513690'][4]($_1297434741, $_2030846825); self::$_1346970370[___1352941320(9)][$_1297434741]=($_1193710405? array(___1352941320(10)): array(___1352941320(11))); foreach($_888605513 as $_340400875){ self::$_1346970370[___1352941320(12)][$_340400875]= $_1193710405; if(!$_1193710405) $_1844253202[]= array($_340400875, false);}} $_1759223664= $GLOBALS['____722513690'][5](self::$_1346970370); $_1759223664= $GLOBALS['____722513690'][6]($_1759223664); COption::SetOptionString(___1352941320(13), ___1352941320(14), $_1759223664); foreach($_1844253202 as $_282038451) self::__1151762116($_282038451[(189*2-378)], $_282038451[round(0+0.5+0.5)]);} public static function IsFeatureEnabled($_340400875){ if($_340400875 == '') return true; self::__1005469163(); if(!isset(self::$_1924054459[$_340400875])) return true; if(self::$_1924054459[$_340400875] == ___1352941320(15)) $_1125022010= array(___1352941320(16)); elseif(isset(self::$_1346970370[___1352941320(17)][self::$_1924054459[$_340400875]])) $_1125022010= self::$_1346970370[___1352941320(18)][self::$_1924054459[$_340400875]]; else $_1125022010= array(___1352941320(19)); if($_1125022010[(1168/2-584)] != ___1352941320(20) && $_1125022010[(956-2*478)] != ___1352941320(21)){ return false;} elseif($_1125022010[(208*2-416)] == ___1352941320(22)){ if($_1125022010[round(0+0.2+0.2+0.2+0.2+0.2)]< $GLOBALS['____722513690'][7]((167*2-334),(964-2*482),(948-2*474), Date(___1352941320(23)), $GLOBALS['____722513690'][8](___1352941320(24))- self::$_599182207, $GLOBALS['____722513690'][9](___1352941320(25)))){ if(!isset($_1125022010[round(0+2)]) ||!$_1125022010[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) self::__1595744898(self::$_1924054459[$_340400875]); return false;}} return!isset(self::$_1346970370[___1352941320(26)][$_340400875]) || self::$_1346970370[___1352941320(27)][$_340400875];} public static function IsFeatureInstalled($_340400875){ if($GLOBALS['____722513690'][10]($_340400875) <= 0) return true; self::__1005469163(); return(isset(self::$_1346970370[___1352941320(28)][$_340400875]) && self::$_1346970370[___1352941320(29)][$_340400875]);} public static function IsFeatureEditable($_340400875){ if($_340400875 == '') return true; self::__1005469163(); if(!isset(self::$_1924054459[$_340400875])) return true; if(self::$_1924054459[$_340400875] == ___1352941320(30)) $_1125022010= array(___1352941320(31)); elseif(isset(self::$_1346970370[___1352941320(32)][self::$_1924054459[$_340400875]])) $_1125022010= self::$_1346970370[___1352941320(33)][self::$_1924054459[$_340400875]]; else $_1125022010= array(___1352941320(34)); if($_1125022010[(224*2-448)] != ___1352941320(35) && $_1125022010[min(162,0,54)] != ___1352941320(36)){ return false;} elseif($_1125022010[(1140/2-570)] == ___1352941320(37)){ if($_1125022010[round(0+1)]< $GLOBALS['____722513690'][11]((171*2-342),(786-2*393), min(192,0,64), Date(___1352941320(38)), $GLOBALS['____722513690'][12](___1352941320(39))- self::$_599182207, $GLOBALS['____722513690'][13](___1352941320(40)))){ if(!isset($_1125022010[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) ||!$_1125022010[round(0+1+1)]) self::__1595744898(self::$_1924054459[$_340400875]); return false;}} return true;} private static function __1151762116($_340400875, $_979681244){ if($GLOBALS['____722513690'][14]("CBXFeatures", "On".$_340400875."SettingsChange")) $GLOBALS['____722513690'][15](array("CBXFeatures", "On".$_340400875."SettingsChange"), array($_340400875, $_979681244)); $_818786928= $GLOBALS['_____570221028'][0](___1352941320(41), ___1352941320(42).$_340400875.___1352941320(43)); while($_1369190418= $_818786928->Fetch()) $GLOBALS['_____570221028'][1]($_1369190418, array($_340400875, $_979681244));} public static function SetFeatureEnabled($_340400875, $_979681244= true, $_1037644304= true){ if($GLOBALS['____722513690'][16]($_340400875) <= 0) return; if(!self::IsFeatureEditable($_340400875)) $_979681244= false; $_979681244= (bool)$_979681244; self::__1005469163(); $_1984363555=(!isset(self::$_1346970370[___1352941320(44)][$_340400875]) && $_979681244 || isset(self::$_1346970370[___1352941320(45)][$_340400875]) && $_979681244 != self::$_1346970370[___1352941320(46)][$_340400875]); self::$_1346970370[___1352941320(47)][$_340400875]= $_979681244; $_1759223664= $GLOBALS['____722513690'][17](self::$_1346970370); $_1759223664= $GLOBALS['____722513690'][18]($_1759223664); COption::SetOptionString(___1352941320(48), ___1352941320(49), $_1759223664); if($_1984363555 && $_1037644304) self::__1151762116($_340400875, $_979681244);} private static function __1595744898($_1297434741){ if($GLOBALS['____722513690'][19]($_1297434741) <= 0 || $_1297434741 == "Portal") return; self::__1005469163(); if(!isset(self::$_1346970370[___1352941320(50)][$_1297434741]) || self::$_1346970370[___1352941320(51)][$_1297434741][(163*2-326)] != ___1352941320(52)) return; if(isset(self::$_1346970370[___1352941320(53)][$_1297434741][round(0+2)]) && self::$_1346970370[___1352941320(54)][$_1297434741][round(0+1+1)]) return; $_1844253202= array(); if(isset(self::$_1852214159[$_1297434741]) && $GLOBALS['____722513690'][20](self::$_1852214159[$_1297434741])){ foreach(self::$_1852214159[$_1297434741] as $_340400875){ if(isset(self::$_1346970370[___1352941320(55)][$_340400875]) && self::$_1346970370[___1352941320(56)][$_340400875]){ self::$_1346970370[___1352941320(57)][$_340400875]= false; $_1844253202[]= array($_340400875, false);}} self::$_1346970370[___1352941320(58)][$_1297434741][round(0+0.5+0.5+0.5+0.5)]= true;} $_1759223664= $GLOBALS['____722513690'][21](self::$_1346970370); $_1759223664= $GLOBALS['____722513690'][22]($_1759223664); COption::SetOptionString(___1352941320(59), ___1352941320(60), $_1759223664); foreach($_1844253202 as $_282038451) self::__1151762116($_282038451[(242*2-484)], $_282038451[round(0+0.25+0.25+0.25+0.25)]);} public static function ModifyFeaturesSettings($_2030846825, $_888605513){ self::__1005469163(); foreach($_2030846825 as $_1297434741 => $_1219637681) self::$_1346970370[___1352941320(61)][$_1297434741]= $_1219637681; $_1844253202= array(); foreach($_888605513 as $_340400875 => $_979681244){ if(!isset(self::$_1346970370[___1352941320(62)][$_340400875]) && $_979681244 || isset(self::$_1346970370[___1352941320(63)][$_340400875]) && $_979681244 != self::$_1346970370[___1352941320(64)][$_340400875]) $_1844253202[]= array($_340400875, $_979681244); self::$_1346970370[___1352941320(65)][$_340400875]= $_979681244;} $_1759223664= $GLOBALS['____722513690'][23](self::$_1346970370); $_1759223664= $GLOBALS['____722513690'][24]($_1759223664); COption::SetOptionString(___1352941320(66), ___1352941320(67), $_1759223664); self::$_1346970370= false; foreach($_1844253202 as $_282038451) self::__1151762116($_282038451[(218*2-436)], $_282038451[round(0+1)]);} public static function SaveFeaturesSettings($_1428463653, $_427371583){ self::__1005469163(); $_1539259657= array(___1352941320(68) => array(), ___1352941320(69) => array()); if(!$GLOBALS['____722513690'][25]($_1428463653)) $_1428463653= array(); if(!$GLOBALS['____722513690'][26]($_427371583)) $_427371583= array(); if(!$GLOBALS['____722513690'][27](___1352941320(70), $_1428463653)) $_1428463653[]= ___1352941320(71); foreach(self::$_1852214159 as $_1297434741 => $_888605513){ if(isset(self::$_1346970370[___1352941320(72)][$_1297434741])){ $_317276642= self::$_1346970370[___1352941320(73)][$_1297434741];} else{ $_317276642=($_1297434741 == ___1352941320(74)? array(___1352941320(75)): array(___1352941320(76)));} if($_317276642[(950-2*475)] == ___1352941320(77) || $_317276642[(198*2-396)] == ___1352941320(78)){ $_1539259657[___1352941320(79)][$_1297434741]= $_317276642;} else{ if($GLOBALS['____722513690'][28]($_1297434741, $_1428463653)) $_1539259657[___1352941320(80)][$_1297434741]= array(___1352941320(81), $GLOBALS['____722513690'][29]((189*2-378), min(208,0,69.333333333333),(966-2*483), $GLOBALS['____722513690'][30](___1352941320(82)), $GLOBALS['____722513690'][31](___1352941320(83)), $GLOBALS['____722513690'][32](___1352941320(84)))); else $_1539259657[___1352941320(85)][$_1297434741]= array(___1352941320(86));}} $_1844253202= array(); foreach(self::$_1924054459 as $_340400875 => $_1297434741){ if($_1539259657[___1352941320(87)][$_1297434741][(978-2*489)] != ___1352941320(88) && $_1539259657[___1352941320(89)][$_1297434741][(1036/2-518)] != ___1352941320(90)){ $_1539259657[___1352941320(91)][$_340400875]= false;} else{ if($_1539259657[___1352941320(92)][$_1297434741][(906-2*453)] == ___1352941320(93) && $_1539259657[___1352941320(94)][$_1297434741][round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____722513690'][33]((918-2*459), min(40,0,13.333333333333),(914-2*457), Date(___1352941320(95)), $GLOBALS['____722513690'][34](___1352941320(96))- self::$_599182207, $GLOBALS['____722513690'][35](___1352941320(97)))) $_1539259657[___1352941320(98)][$_340400875]= false; else $_1539259657[___1352941320(99)][$_340400875]= $GLOBALS['____722513690'][36]($_340400875, $_427371583); if(!isset(self::$_1346970370[___1352941320(100)][$_340400875]) && $_1539259657[___1352941320(101)][$_340400875] || isset(self::$_1346970370[___1352941320(102)][$_340400875]) && $_1539259657[___1352941320(103)][$_340400875] != self::$_1346970370[___1352941320(104)][$_340400875]) $_1844253202[]= array($_340400875, $_1539259657[___1352941320(105)][$_340400875]);}} $_1759223664= $GLOBALS['____722513690'][37]($_1539259657); $_1759223664= $GLOBALS['____722513690'][38]($_1759223664); COption::SetOptionString(___1352941320(106), ___1352941320(107), $_1759223664); self::$_1346970370= false; foreach($_1844253202 as $_282038451) self::__1151762116($_282038451[(866-2*433)], $_282038451[round(0+0.5+0.5)]);} public static function GetFeaturesList(){ self::__1005469163(); $_2031722746= array(); foreach(self::$_1852214159 as $_1297434741 => $_888605513){ if(isset(self::$_1346970370[___1352941320(108)][$_1297434741])){ $_317276642= self::$_1346970370[___1352941320(109)][$_1297434741];} else{ $_317276642=($_1297434741 == ___1352941320(110)? array(___1352941320(111)): array(___1352941320(112)));} $_2031722746[$_1297434741]= array( ___1352941320(113) => $_317276642[min(188,0,62.666666666667)], ___1352941320(114) => $_317276642[round(0+0.25+0.25+0.25+0.25)], ___1352941320(115) => array(),); $_2031722746[$_1297434741][___1352941320(116)]= false; if($_2031722746[$_1297434741][___1352941320(117)] == ___1352941320(118)){ $_2031722746[$_1297434741][___1352941320(119)]= $GLOBALS['____722513690'][39](($GLOBALS['____722513690'][40]()- $_2031722746[$_1297434741][___1352941320(120)])/ round(0+17280+17280+17280+17280+17280)); if($_2031722746[$_1297434741][___1352941320(121)]> self::$_599182207) $_2031722746[$_1297434741][___1352941320(122)]= true;} foreach($_888605513 as $_340400875) $_2031722746[$_1297434741][___1352941320(123)][$_340400875]=(!isset(self::$_1346970370[___1352941320(124)][$_340400875]) || self::$_1346970370[___1352941320(125)][$_340400875]);} return $_2031722746;} private static function __603969561($_732241771, $_1635365448){ if(IsModuleInstalled($_732241771) == $_1635365448) return true; $_2097200675= $_SERVER[___1352941320(126)].___1352941320(127).$_732241771.___1352941320(128); if(!$GLOBALS['____722513690'][41]($_2097200675)) return false; include_once($_2097200675); $_1843305832= $GLOBALS['____722513690'][42](___1352941320(129), ___1352941320(130), $_732241771); if(!$GLOBALS['____722513690'][43]($_1843305832)) return false; $_1371022962= new $_1843305832; if($_1635365448){ if(!$_1371022962->InstallDB()) return false; $_1371022962->InstallEvents(); if(!$_1371022962->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___1352941320(131))) CSearch::DeleteIndex($_732241771); UnRegisterModule($_732241771);} return true;} protected static function OnRequestsSettingsChange($_340400875, $_979681244){ self::__603969561("form", $_979681244);} protected static function OnLearningSettingsChange($_340400875, $_979681244){ self::__603969561("learning", $_979681244);} protected static function OnJabberSettingsChange($_340400875, $_979681244){ self::__603969561("xmpp", $_979681244);} protected static function OnVideoConferenceSettingsChange($_340400875, $_979681244){} protected static function OnBizProcSettingsChange($_340400875, $_979681244){ self::__603969561("bizprocdesigner", $_979681244);} protected static function OnListsSettingsChange($_340400875, $_979681244){ self::__603969561("lists", $_979681244);} protected static function OnWikiSettingsChange($_340400875, $_979681244){ self::__603969561("wiki", $_979681244);} protected static function OnSupportSettingsChange($_340400875, $_979681244){ self::__603969561("support", $_979681244);} protected static function OnControllerSettingsChange($_340400875, $_979681244){ self::__603969561("controller", $_979681244);} protected static function OnAnalyticsSettingsChange($_340400875, $_979681244){ self::__603969561("statistic", $_979681244);} protected static function OnVoteSettingsChange($_340400875, $_979681244){ self::__603969561("vote", $_979681244);} protected static function OnFriendsSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(132); $_1690294757= CSite::GetList(___1352941320(133), ___1352941320(134), array(___1352941320(135) => ___1352941320(136))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(137), ___1352941320(138), ___1352941320(139), $_1053015136[___1352941320(140)]) != $_1289803832){ COption::SetOptionString(___1352941320(141), ___1352941320(142), $_1289803832, false, $_1053015136[___1352941320(143)]); COption::SetOptionString(___1352941320(144), ___1352941320(145), $_1289803832);}}} protected static function OnMicroBlogSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(146); $_1690294757= CSite::GetList(___1352941320(147), ___1352941320(148), array(___1352941320(149) => ___1352941320(150))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(151), ___1352941320(152), ___1352941320(153), $_1053015136[___1352941320(154)]) != $_1289803832){ COption::SetOptionString(___1352941320(155), ___1352941320(156), $_1289803832, false, $_1053015136[___1352941320(157)]); COption::SetOptionString(___1352941320(158), ___1352941320(159), $_1289803832);} if(COption::GetOptionString(___1352941320(160), ___1352941320(161), ___1352941320(162), $_1053015136[___1352941320(163)]) != $_1289803832){ COption::SetOptionString(___1352941320(164), ___1352941320(165), $_1289803832, false, $_1053015136[___1352941320(166)]); COption::SetOptionString(___1352941320(167), ___1352941320(168), $_1289803832);}}} protected static function OnPersonalFilesSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(169); $_1690294757= CSite::GetList(___1352941320(170), ___1352941320(171), array(___1352941320(172) => ___1352941320(173))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(174), ___1352941320(175), ___1352941320(176), $_1053015136[___1352941320(177)]) != $_1289803832){ COption::SetOptionString(___1352941320(178), ___1352941320(179), $_1289803832, false, $_1053015136[___1352941320(180)]); COption::SetOptionString(___1352941320(181), ___1352941320(182), $_1289803832);}}} protected static function OnPersonalBlogSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(183); $_1690294757= CSite::GetList(___1352941320(184), ___1352941320(185), array(___1352941320(186) => ___1352941320(187))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(188), ___1352941320(189), ___1352941320(190), $_1053015136[___1352941320(191)]) != $_1289803832){ COption::SetOptionString(___1352941320(192), ___1352941320(193), $_1289803832, false, $_1053015136[___1352941320(194)]); COption::SetOptionString(___1352941320(195), ___1352941320(196), $_1289803832);}}} protected static function OnPersonalPhotoSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(197); $_1690294757= CSite::GetList(___1352941320(198), ___1352941320(199), array(___1352941320(200) => ___1352941320(201))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(202), ___1352941320(203), ___1352941320(204), $_1053015136[___1352941320(205)]) != $_1289803832){ COption::SetOptionString(___1352941320(206), ___1352941320(207), $_1289803832, false, $_1053015136[___1352941320(208)]); COption::SetOptionString(___1352941320(209), ___1352941320(210), $_1289803832);}}} protected static function OnPersonalForumSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(211); $_1690294757= CSite::GetList(___1352941320(212), ___1352941320(213), array(___1352941320(214) => ___1352941320(215))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(216), ___1352941320(217), ___1352941320(218), $_1053015136[___1352941320(219)]) != $_1289803832){ COption::SetOptionString(___1352941320(220), ___1352941320(221), $_1289803832, false, $_1053015136[___1352941320(222)]); COption::SetOptionString(___1352941320(223), ___1352941320(224), $_1289803832);}}} protected static function OnTasksSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(225); $_1690294757= CSite::GetList(___1352941320(226), ___1352941320(227), array(___1352941320(228) => ___1352941320(229))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(230), ___1352941320(231), ___1352941320(232), $_1053015136[___1352941320(233)]) != $_1289803832){ COption::SetOptionString(___1352941320(234), ___1352941320(235), $_1289803832, false, $_1053015136[___1352941320(236)]); COption::SetOptionString(___1352941320(237), ___1352941320(238), $_1289803832);} if(COption::GetOptionString(___1352941320(239), ___1352941320(240), ___1352941320(241), $_1053015136[___1352941320(242)]) != $_1289803832){ COption::SetOptionString(___1352941320(243), ___1352941320(244), $_1289803832, false, $_1053015136[___1352941320(245)]); COption::SetOptionString(___1352941320(246), ___1352941320(247), $_1289803832);}} self::__603969561(___1352941320(248), $_979681244);} protected static function OnCalendarSettingsChange($_340400875, $_979681244){ if($_979681244) $_1289803832= "Y"; else $_1289803832= ___1352941320(249); $_1690294757= CSite::GetList(___1352941320(250), ___1352941320(251), array(___1352941320(252) => ___1352941320(253))); while($_1053015136= $_1690294757->Fetch()){ if(COption::GetOptionString(___1352941320(254), ___1352941320(255), ___1352941320(256), $_1053015136[___1352941320(257)]) != $_1289803832){ COption::SetOptionString(___1352941320(258), ___1352941320(259), $_1289803832, false, $_1053015136[___1352941320(260)]); COption::SetOptionString(___1352941320(261), ___1352941320(262), $_1289803832);} if(COption::GetOptionString(___1352941320(263), ___1352941320(264), ___1352941320(265), $_1053015136[___1352941320(266)]) != $_1289803832){ COption::SetOptionString(___1352941320(267), ___1352941320(268), $_1289803832, false, $_1053015136[___1352941320(269)]); COption::SetOptionString(___1352941320(270), ___1352941320(271), $_1289803832);}}} protected static function OnSMTPSettingsChange($_340400875, $_979681244){ self::__603969561("mail", $_979681244);} protected static function OnExtranetSettingsChange($_340400875, $_979681244){ $_1178006593= COption::GetOptionString("extranet", "extranet_site", ""); if($_1178006593){ $_435140816= new CSite; $_435140816->Update($_1178006593, array(___1352941320(272) =>($_979681244? ___1352941320(273): ___1352941320(274))));} self::__603969561(___1352941320(275), $_979681244);} protected static function OnDAVSettingsChange($_340400875, $_979681244){ self::__603969561("dav", $_979681244);} protected static function OntimemanSettingsChange($_340400875, $_979681244){ self::__603969561("timeman", $_979681244);} protected static function Onintranet_sharepointSettingsChange($_340400875, $_979681244){ if($_979681244){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___1352941320(276), ___1352941320(277), ___1352941320(278), ___1352941320(279), ___1352941320(280)); CAgent::AddAgent(___1352941320(281), ___1352941320(282), ___1352941320(283), round(0+500)); CAgent::AddAgent(___1352941320(284), ___1352941320(285), ___1352941320(286), round(0+150+150)); CAgent::AddAgent(___1352941320(287), ___1352941320(288), ___1352941320(289), round(0+720+720+720+720+720));} else{ UnRegisterModuleDependences(___1352941320(290), ___1352941320(291), ___1352941320(292), ___1352941320(293), ___1352941320(294)); UnRegisterModuleDependences(___1352941320(295), ___1352941320(296), ___1352941320(297), ___1352941320(298), ___1352941320(299)); CAgent::RemoveAgent(___1352941320(300), ___1352941320(301)); CAgent::RemoveAgent(___1352941320(302), ___1352941320(303)); CAgent::RemoveAgent(___1352941320(304), ___1352941320(305));}} protected static function OncrmSettingsChange($_340400875, $_979681244){ if($_979681244) COption::SetOptionString("crm", "form_features", "Y"); self::__603969561(___1352941320(306), $_979681244);} protected static function OnClusterSettingsChange($_340400875, $_979681244){ self::__603969561("cluster", $_979681244);} protected static function OnMultiSitesSettingsChange($_340400875, $_979681244){ if($_979681244) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___1352941320(307), ___1352941320(308), ___1352941320(309), ___1352941320(310), ___1352941320(311), ___1352941320(312));} protected static function OnIdeaSettingsChange($_340400875, $_979681244){ self::__603969561("idea", $_979681244);} protected static function OnMeetingSettingsChange($_340400875, $_979681244){ self::__603969561("meeting", $_979681244);} protected static function OnXDImportSettingsChange($_340400875, $_979681244){ self::__603969561("xdimport", $_979681244);}} $_1490851451= GetMessage(___1352941320(313));$_2096243035= round(0+3+3+3+3+3);$GLOBALS['____722513690'][44]($GLOBALS['____722513690'][45]($GLOBALS['____722513690'][46](___1352941320(314))), ___1352941320(315));$_854223150= round(0+0.25+0.25+0.25+0.25); $_1857404270= ___1352941320(316); unset($_251882056); $_1061324713= $GLOBALS['____722513690'][47](___1352941320(317), ___1352941320(318)); $_251882056= \COption::GetOptionString(___1352941320(319), $GLOBALS['____722513690'][48](___1352941320(320),___1352941320(321),$GLOBALS['____722513690'][49]($_1857404270, round(0+1+1), round(0+2+2))).$GLOBALS['____722513690'][50](___1352941320(322))); $_371830207= array(round(0+8.5+8.5) => ___1352941320(323), round(0+3.5+3.5) => ___1352941320(324), round(0+11+11) => ___1352941320(325), round(0+12) => ___1352941320(326), round(0+1.5+1.5) => ___1352941320(327)); $_1123278248= ___1352941320(328); while($_251882056){ $_1225978895= ___1352941320(329); $_1370597258= $GLOBALS['____722513690'][51]($_251882056); $_1874050533= ___1352941320(330); $_1225978895= $GLOBALS['____722513690'][52](___1352941320(331).$_1225978895,(1024/2-512),-round(0+2.5+2.5)).___1352941320(332); $_136285535= $GLOBALS['____722513690'][53]($_1225978895); $_934621671=(1220/2-610); for($_1571706687=(1128/2-564); $_1571706687<$GLOBALS['____722513690'][54]($_1370597258); $_1571706687++){ $_1874050533 .= $GLOBALS['____722513690'][55]($GLOBALS['____722513690'][56]($_1370597258[$_1571706687])^ $GLOBALS['____722513690'][57]($_1225978895[$_934621671])); if($_934621671==$_136285535-round(0+0.2+0.2+0.2+0.2+0.2)) $_934621671=(832-2*416); else $_934621671= $_934621671+ round(0+0.33333333333333+0.33333333333333+0.33333333333333);} $_854223150= $GLOBALS['____722513690'][58]((140*2-280),(222*2-444), min(14,0,4.6666666666667), $GLOBALS['____722513690'][59]($_1874050533[round(0+3+3)].$_1874050533[round(0+1+1+1)]), $GLOBALS['____722513690'][60]($_1874050533[round(0+1)].$_1874050533[round(0+2.8+2.8+2.8+2.8+2.8)]), $GLOBALS['____722513690'][61]($_1874050533[round(0+2+2+2+2+2)].$_1874050533[round(0+9+9)].$_1874050533[round(0+2.3333333333333+2.3333333333333+2.3333333333333)].$_1874050533[round(0+6+6)])); unset($_1225978895); break;} $_182234453= ___1352941320(333); $GLOBALS['____722513690'][62]($_371830207); $_264043420= ___1352941320(334); $_1123278248= ___1352941320(335).$GLOBALS['____722513690'][63]($_1123278248.___1352941320(336), round(0+0.66666666666667+0.66666666666667+0.66666666666667),-round(0+0.25+0.25+0.25+0.25));@include($_SERVER[___1352941320(337)].___1352941320(338).$GLOBALS['____722513690'][64](___1352941320(339), $_371830207)); $_2094678913= round(0+2); while($GLOBALS['____722513690'][65](___1352941320(340))){ $_1573391190= $GLOBALS['____722513690'][66]($GLOBALS['____722513690'][67](___1352941320(341))); $_333604193= ___1352941320(342); $_182234453= $GLOBALS['____722513690'][68](___1352941320(343)).$GLOBALS['____722513690'][69](___1352941320(344),$_182234453,___1352941320(345)); $_1130868797= $GLOBALS['____722513690'][70]($_182234453); $_934621671= min(136,0,45.333333333333); for($_1571706687=(152*2-304); $_1571706687<$GLOBALS['____722513690'][71]($_1573391190); $_1571706687++){ $_333604193 .= $GLOBALS['____722513690'][72]($GLOBALS['____722513690'][73]($_1573391190[$_1571706687])^ $GLOBALS['____722513690'][74]($_182234453[$_934621671])); if($_934621671==$_1130868797-round(0+0.2+0.2+0.2+0.2+0.2)) $_934621671=(162*2-324); else $_934621671= $_934621671+ round(0+1);} $_2094678913= $GLOBALS['____722513690'][75](min(210,0,70),(139*2-278),(820-2*410), $GLOBALS['____722513690'][76]($_333604193[round(0+3+3)].$_333604193[round(0+5.3333333333333+5.3333333333333+5.3333333333333)]), $GLOBALS['____722513690'][77]($_333604193[round(0+1.8+1.8+1.8+1.8+1.8)].$_333604193[round(0+0.4+0.4+0.4+0.4+0.4)]), $GLOBALS['____722513690'][78]($_333604193[round(0+2.4+2.4+2.4+2.4+2.4)].$_333604193[round(0+1.4+1.4+1.4+1.4+1.4)].$_333604193[round(0+14)].$_333604193[round(0+1+1+1)])); unset($_182234453); break;} $_1061324713= ___1352941320(346).$GLOBALS['____722513690'][79]($GLOBALS['____722513690'][80]($_1061324713, round(0+3),-round(0+0.5+0.5)).___1352941320(347), round(0+1),-round(0+2.5+2.5));while(!$GLOBALS['____722513690'][81]($GLOBALS['____722513690'][82]($GLOBALS['____722513690'][83](___1352941320(348))))){function __f($_1834140977){return $_1834140977+__f($_1834140977);}__f(round(0+1));};for($_1571706687=(1096/2-548),$_933312893=($GLOBALS['____722513690'][84]()< $GLOBALS['____722513690'][85]((1428/2-714),min(72,0,24),(1216/2-608),round(0+2.5+2.5),round(0+0.2+0.2+0.2+0.2+0.2),round(0+2018)) || $_854223150 <= round(0+3.3333333333333+3.3333333333333+3.3333333333333)),$_124568845=($_854223150< $GLOBALS['____722513690'][86](min(88,0,29.333333333333),min(172,0,57.333333333333),(784-2*392),Date(___1352941320(349)),$GLOBALS['____722513690'][87](___1352941320(350))-$_2096243035,$GLOBALS['____722513690'][88](___1352941320(351)))),$_1067354855=($_SERVER[___1352941320(352)]!==___1352941320(353)&&$_SERVER[___1352941320(354)]!==___1352941320(355)); $_1571706687< round(0+3.3333333333333+3.3333333333333+3.3333333333333),($_933312893 || $_124568845 || $_854223150 != $_2094678913) && $_1067354855; $_1571706687++,LocalRedirect(___1352941320(356)),exit,$GLOBALS['_____570221028'][2]($_1490851451));$GLOBALS['____722513690'][89]($_1123278248, $_854223150); $GLOBALS['____722513690'][90]($_1061324713, $_2094678913); $GLOBALS[___1352941320(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

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

/*ZDUyZmZOTAyMGFlMzI5ZmJhMjM0NmVjZmZhZmIxYWIzZDk4MGM=*/$GLOBALS['____1457128725']= array(base64_decode('bXRfcmF'.'uZA=='),base64_decode('Y2F'.'sbF91c2Vy'.'X'.'2Z1bm'.'M'.'='),base64_decode('c3'.'RycG9z'),base64_decode('ZXhw'.'bG9kZQ=='),base64_decode('cGFjaw='.'='),base64_decode(''.'bWQ1'),base64_decode(''.'Y29uc3'.'RhbnQ='),base64_decode(''.'a'.'G'.'Fza'.'F9ob'.'WFj'),base64_decode('c3Ry'.'Y'.'21w'),base64_decode('Y2'.'Fs'.'b'.'F91c2VyX2Z'.'1'.'bmM='),base64_decode('Y2FsbF91c2VyX2Z1bmM='),base64_decode('aXN'.'fb2J'.'qZWN0'),base64_decode(''.'Y2F'.'sbF91c2VyX'.'2Z1bmM='),base64_decode('Y2FsbF91c2V'.'yX2Z1b'.'m'.'M='),base64_decode('Y'.'2F'.'s'.'bF9'.'1c2'.'VyX2Z1bmM='),base64_decode('Y'.'2FsbF91'.'c2VyX'.'2'.'Z1bm'.'M'.'='),base64_decode('Y2Fsb'.'F91'.'c2VyX2Z1bmM='),base64_decode('Y2Fs'.'b'.'F91c'.'2'.'VyX2'.'Z1b'.'mM='),base64_decode(''.'ZGVm'.'aW5lZ'.'A=='),base64_decode('c'.'3R'.'ybGVu'));if(!function_exists(__NAMESPACE__.'\\___447174589')){function ___447174589($_1750452484){static $_2014836935= false; if($_2014836935 == false) $_2014836935=array('XENP'.'cH'.'Rpb246'.'Ok'.'dldE9'.'wdGlv'.'blN0cmluZw==',''.'b'.'W'.'Fp'.'bg='.'=',''.'fl'.'BBUkFNX'.'0'.'1B'.'WF9'.'VU0VSUw==','Lg==','L'.'g==',''.'SCo=','Ym'.'l'.'0'.'cm'.'l4','TElD'.'RU5TRV9'.'L'.'RVk=','c2hhMjU'.'2','XE'.'NPcHR'.'pb246Ok'.'dld'.'E9wdGlvblN'.'0c'.'ml'.'u'.'Zw==',''.'b'.'WF'.'pbg==','U'.'EFSQU1fTUFYX1VT'.'RVJT','X'.'E'.'JpdHJ'.'p'.'eFx'.'NYWluXENvbmZpZ1xPc'.'HRpb246'.'OnNldA='.'=','bWF'.'pbg==','U'.'EFSQU1fTUFYX1VTRVJT','VVNFUg==','VV'.'NF'.'Ug==','VVNFUg'.'==','S'.'XN'.'B'.'d'.'XRo'.'b3J'.'pemV'.'k',''.'VVNF'.'Ug==','SXN'.'B'.'ZG1pbg==',''.'QVBQTElDQVRJT04=','UmVzdGFy'.'dE'.'J1ZmZ'.'lc'.'g==','T'.'G9jY'.'WxS'.'ZWRp'.'cmVjdA==','L2xpY'.'2Vuc2'.'VfcmVz'.'dHJpY3'.'Rpb2'.'4u'.'cGhw',''.'XENPcHRpb2'.'4'.'6Okdl'.'dE9wdGlvblN0cml'.'uZw'.'==','bWF'.'pb'.'g==','U'.'E'.'FSQU1fT'.'UFYX1VTRVJT',''.'X'.'EJpd'.'H'.'JpeFxN'.'YWluXENvbmZ'.'pZ1xPcH'.'Rpb246'.'OnNldA==','bW'.'Fpb'.'g'.'==','UEFSQ'.'U1'.'fTUFYX1VTRVJT','T0x'.'EU0lURUVYUE'.'lSRU'.'RBVEU=',''.'ZXhwaXJlX2'.'1l'.'c3My');return base64_decode($_2014836935[$_1750452484]);}};if($GLOBALS['____1457128725'][0](round(0+1), round(0+6.6666666666667+6.6666666666667+6.6666666666667)) == round(0+2.3333333333333+2.3333333333333+2.3333333333333)){ $_1554422658= $GLOBALS['____1457128725'][1](___447174589(0), ___447174589(1), ___447174589(2)); if(!empty($_1554422658) && $GLOBALS['____1457128725'][2]($_1554422658, ___447174589(3)) !== false){ list($_125521383, $_1644228276)= $GLOBALS['____1457128725'][3](___447174589(4), $_1554422658); $_1561562317= $GLOBALS['____1457128725'][4](___447174589(5), $_125521383); $_1249221245= ___447174589(6).$GLOBALS['____1457128725'][5]($GLOBALS['____1457128725'][6](___447174589(7))); $_1637516020= $GLOBALS['____1457128725'][7](___447174589(8), $_1644228276, $_1249221245, true); if($GLOBALS['____1457128725'][8]($_1637516020, $_1561562317) !==(183*2-366)){ if($GLOBALS['____1457128725'][9](___447174589(9), ___447174589(10), ___447174589(11)) != round(0+3+3+3+3)){ $GLOBALS['____1457128725'][10](___447174589(12), ___447174589(13), ___447174589(14), round(0+4+4+4));} if(isset($GLOBALS[___447174589(15)]) && $GLOBALS['____1457128725'][11]($GLOBALS[___447174589(16)]) && $GLOBALS['____1457128725'][12](array($GLOBALS[___447174589(17)], ___447174589(18))) &&!$GLOBALS['____1457128725'][13](array($GLOBALS[___447174589(19)], ___447174589(20)))){ $GLOBALS['____1457128725'][14](array($GLOBALS[___447174589(21)], ___447174589(22))); $GLOBALS['____1457128725'][15](___447174589(23), ___447174589(24), true);}}} else{ if($GLOBALS['____1457128725'][16](___447174589(25), ___447174589(26), ___447174589(27)) != round(0+6+6)){ $GLOBALS['____1457128725'][17](___447174589(28), ___447174589(29), ___447174589(30), round(0+6+6));}}} while(!$GLOBALS['____1457128725'][18](___447174589(31)) || $GLOBALS['____1457128725'][19](OLDSITEEXPIREDATE) <=(1396/2-698) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___447174589(32)));/**/       //Do not remove this


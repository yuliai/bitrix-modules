<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2026 Bitrix
 */

use Bitrix\Main;
use Bitrix\Main\Session\Legacy\HealerEarlySessionStart;
use Bitrix\Main\Config\Option;
use Dev\Main\Migrator\ModuleUpdater;

require_once __DIR__ . '/start.php';

$application = Main\HttpApplication::getInstance();
$application->initialize([
	'get' => $_GET,
	'post' => $_POST,
	'files' => $_FILES,
	'cookie' => $_COOKIE,
	'server' => $_SERVER,
	'env' => $_ENV
]);

if (class_exists('\Dev\Main\Migrator\ModuleUpdater'))
{
	ModuleUpdater::checkUpdates('main', __DIR__);
}

if (!Main\ModuleManager::isModuleInstalled('bitrix24'))
{
	// wwall rules
	(new Main\Security\W\WWall)->handle();
}

if (defined('SITE_ID'))
{
	define('LANG', SITE_ID);
}

$context = $application->getContext();
$context->initializeCulture(defined('LANG') ? LANG : null, defined('LANGUAGE_ID') ? LANGUAGE_ID : null);

// needs to be after culture initialization
$application->start();

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

/*ZDUyZmZNWM3MGMzMzIyODFlZDk5NjMwMzVkNTA3MjMzMzMzNmE=*/$GLOBALS['_____236307897']= array(base64_decode('R2V0T'.'W9kd'.'WxlR'.'XZ'.'l'.'bnRz'),base64_decode('RXhl'.'Y3V0ZU1v'.'ZH'.'VsZUV2ZW'.'50RXg='),base64_decode('V3JpdGVGaW5hbE'.'1'.'l'.'c3Nh'.'Z'.'2U='));$GLOBALS['____2134765017']= array(base64_decode(''.'ZGVmaW5l'),base64_decode('Y'.'m'.'Fz'.'ZT'.'Y0X2Rl'.'Y29'.'kZQ='.'='),base64_decode('dW5zZXJpYWxpem'.'U='),base64_decode('aXNfYXJyYX'.'k='),base64_decode('a'.'W5fYX'.'JyYXk='),base64_decode('c2V'.'ya'.'WFsaXpl'),base64_decode('YmFzZ'.'TY0'.'X2VuY29k'.'ZQ=='),base64_decode('bWt0aW1l'),base64_decode('Z'.'GF0ZQ=='),base64_decode('ZGF0Z'.'Q=='),base64_decode('c3Ryb'.'GVu'),base64_decode('bWt0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF'.'0Z'.'Q=='),base64_decode('bW'.'V0aG9k'.'X'.'2V4'.'aX'.'N0cw=='),base64_decode('Y2'.'FsbF91c2'.'V'.'yX2Z1bmNfYXJyY'.'Xk='),base64_decode('c3'.'RybGVu'),base64_decode('c2V'.'y'.'aWFsaXpl'),base64_decode('Ym'.'F'.'zZTY0X2VuY29kZQ=='),base64_decode('c'.'3Ry'.'bGVu'),base64_decode(''.'aXNfYXJ'.'yYXk='),base64_decode('c2'.'Vya'.'W'.'F'.'saXp'.'l'),base64_decode('Y'.'mFzZ'.'TY0'.'X2VuY29'.'kZQ='.'='),base64_decode('c'.'2VyaW'.'FsaX'.'pl'),base64_decode('YmFzZT'.'Y0X2Vu'.'Y2'.'9'.'kZQ'.'='.'='),base64_decode('aXNfYXJyYXk='),base64_decode(''.'aXN'.'fYXJyY'.'X'.'k'.'='),base64_decode('aW'.'5fYX'.'J'.'y'.'YXk='),base64_decode(''.'aW5fYXJyY'.'X'.'k='),base64_decode('bWt0aW1'.'l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ'.'=='),base64_decode('ZG'.'F0ZQ='.'='),base64_decode(''.'bWt'.'0aW1l'),base64_decode('ZGF'.'0'.'ZQ='.'='),base64_decode(''.'Z'.'GF'.'0ZQ=='),base64_decode(''.'aW5'.'fY'.'XJy'.'YXk'.'='),base64_decode('c2V'.'yaWFsaXpl'),base64_decode('YmFzZTY0X'.'2VuY'.'29k'.'Z'.'Q=='),base64_decode('aW5'.'0'.'dmF'.'s'),base64_decode(''.'dG'.'lt'.'ZQ=='),base64_decode('Zmls'.'ZV9leGlzdH'.'M='),base64_decode('c3RyX3JlcG'.'x'.'hY2'.'U='),base64_decode(''.'Y2xhc3'.'NfZXhp'.'c3Rz'),base64_decode('ZGVm'.'aW5l'),base64_decode('c3RycmV2'),base64_decode('c3RydG91cHBlcg=='),base64_decode('c3By'.'a'.'W50'.'Zg='.'='),base64_decode('c3ByaW'.'50Z'.'g=='),base64_decode('c3'.'Vic3'.'Ry'),base64_decode('c'.'3RycmV'.'2'),base64_decode('Y'.'mFz'.'Z'.'TY0X2RlY2'.'9kZ'.'Q=='),base64_decode(''.'c3V'.'i'.'c3Ry'),base64_decode('c'.'3R'.'y'.'bGVu'),base64_decode('c3RybGVu'),base64_decode('Y2hy'),base64_decode(''.'b3Jk'),base64_decode('b3Jk'),base64_decode('bW'.'t'.'0aW1l'),base64_decode('aW50dmFs'),base64_decode('aW50dmFs'),base64_decode('aW'.'50dmFs'),base64_decode('a3Nv'.'cn'.'Q='),base64_decode('c3'.'Vic3Ry'),base64_decode('aW1w'.'bG9kZQ=='),base64_decode('ZGVmaW5lZA'.'=='),base64_decode('YmF'.'zZTY'.'0'.'X2RlY29kZ'.'Q'.'=='),base64_decode('Y29uc3RhbnQ='),base64_decode('c3RycmV'.'2'),base64_decode('c3ByaW5'.'0Zg'.'=='),base64_decode('c'.'3RybGV'.'u'),base64_decode('c3RybGV'.'u'),base64_decode('Y'.'2hy'),base64_decode(''.'b3Jk'),base64_decode('b3'.'Jk'),base64_decode('bWt0aW1l'),base64_decode('aW50dmFs'),base64_decode('aW5'.'0'.'d'.'mFs'),base64_decode('aW'.'5'.'0dmFs'),base64_decode(''.'c'.'3V'.'ic3R'.'y'),base64_decode(''.'c3Vic3Ry'),base64_decode(''.'ZGVmaW5lZA=='),base64_decode('c3R'.'ycm'.'V2'),base64_decode('c3RydG91cHBlcg=='),base64_decode('dGltZ'.'Q=='),base64_decode('bWt0aW1l'),base64_decode('b'.'Wt0aW1'.'l'),base64_decode('ZGF'.'0ZQ'.'=='),base64_decode('ZGF0Z'.'Q=='),base64_decode(''.'ZGVmaW'.'5l'),base64_decode('ZGV'.'ma'.'W5l'));if(!function_exists(__NAMESPACE__.'\\___747368604')){function ___747368604($_353391247){static $_1172003164= false; if($_1172003164 == false) $_1172003164=array('SU5UUkFORV'.'RfRURJVE'.'lPTg==',''.'WQ==',''.'bWFpbg==',''.'fmN'.'wZl'.'9'.'tYXBfdmFsd'.'WU=','','','YWxsb'.'3'.'d'.'lZF9'.'j'.'b'.'GFzc2'.'V'.'z','ZQ==',''.'Zg==',''.'ZQ==','Rg==','WA'.'==','Zg='.'=','bWFpbg==','fmNwZl'.'9tY'.'XBfdmFsdWU=','UG9y'.'dGFs','Rg'.'==','Z'.'Q='.'=','ZQ==','WA==',''.'Rg==','R'.'A==','R'.'A==','bQ==','ZA==','WQ==','Zg==','Zg==','Z'.'g'.'==','Zg'.'==',''.'UG'.'9ydGFs','Rg==','ZQ==',''.'ZQ='.'=','WA='.'=','Rg='.'=',''.'RA==',''.'RA==','bQ'.'='.'=','Z'.'A='.'=','WQ==',''.'bWF'.'pbg'.'==','T24=','U2V0dGluZ3N'.'Da'.'GFuZ2U=','Zg==','Zg'.'==','Zg='.'=','Zg==','bWFpb'.'g='.'=','f'.'mNwZl9'.'tYX'.'BfdmF'.'s'.'d'.'WU=',''.'ZQ'.'==','ZQ==','RA==','ZQ==',''.'ZQ'.'==','Zg==',''.'Z'.'g'.'==','Z'.'g='.'=','ZQ==','bWFp'.'bg'.'==','fmNw'.'Zl9tYX'.'BfdmFsdWU=','ZQ==','Z'.'g==','Zg'.'==','Zg='.'=','Z'.'g==','bWFpbg==','fm'.'NwZl9tYX'.'BfdmFs'.'dWU'.'=','Z'.'Q==','Zg==','U'.'G'.'9ydGFs','UG9ydGFs','ZQ==','ZQ==',''.'UG9ydG'.'Fs','Rg='.'=','WA==',''.'Rg==','RA='.'=','Z'.'Q==','ZQ==','RA='.'=','bQ'.'==','ZA==','WQ==','ZQ==','WA='.'=','ZQ'.'==','R'.'g==','ZQ==','RA'.'='.'=','Zg'.'==','ZQ==','RA'.'==',''.'ZQ==',''.'bQ='.'=','ZA==','WQ==','Zg==',''.'Zg==','Zg==','Zg==','Zg==','Zg==','Zg='.'=','Zg'.'==','bWFp'.'bg==','fmN'.'wZl9tYX'.'BfdmFsd'.'WU=','ZQ==','ZQ==','UG9'.'y'.'dGFs',''.'Rg==','WA==','VF'.'l'.'QRQ='.'=','R'.'EFURQ==','RkVBVFVSRVM=','RV'.'h'.'QS'.'VJ'.'FRA==','VFl'.'QRQ==','RA='.'=','VFJZ'.'X0R'.'BWVNfQ09VTlQ=',''.'RE'.'FURQ==','VFJZX0RBWV'.'NfQ09VTl'.'Q=','RVhQSVJFRA==','RkVBV'.'FVSRVM=',''.'Zg==',''.'Z'.'g==','RE9DVU'.'1FTlRf'.'Uk9P'.'VA='.'=','L2J'.'pd'.'HJ'.'peC9tb2R1bG'.'V'.'zLw'.'==','L2luc3R'.'hbGw'.'vaW5kZXgucGh'.'w','L'.'g='.'=','Xw'.'==','c2'.'VhcmNo','Tg==','','','Q'.'UNUSVZF','WQ==','c'.'29jaWFsbmV0'.'d2'.'9'.'yaw'.'==','YW'.'xsb3dfZ'.'nJpZW'.'xkcw='.'=','WQ==',''.'SUQ=','c2'.'9jaWFs'.'bmV0d2'.'9'.'y'.'a'.'w==','Y'.'Wxsb3dfZ'.'nJpZW'.'x'.'kcw'.'==','SUQ=','c29jaW'.'Fsbm'.'V0'.'d29yaw==','Y'.'W'.'xsb3dfZn'.'JpZWxkcw'.'==','Tg'.'==','','','Q'.'UNUSVZF','WQ==','c29jaWF'.'sbmV0d29y'.'aw==','YWxsb3df'.'bWlj'.'cm9ibG9nX3VzZXI=','WQ==','S'.'UQ=','c29'.'jaWF'.'s'.'bmV0d'.'29yaw==','YWxsb'.'3df'.'bWl'.'jc'.'m9'.'ibG'.'9nX3VzZXI=','SUQ=','c29jaW'.'FsbmV0d29'.'yaw==',''.'YWxsb3d'.'fbWljcm9ibG9nX3'.'VzZXI'.'=','c29j'.'aWF'.'s'.'bm'.'V0d'.'2'.'9yaw==','YWxsb3d'.'f'.'bW'.'ljcm9'.'ibG9'.'nX2dyb'.'3'.'Vw','WQ'.'='.'=','SUQ=','c29jaWFsb'.'mV0'.'d2'.'9ya'.'w'.'==','YWx'.'sb3d'.'f'.'bWljcm9ibG9nX2dyb3V'.'w',''.'S'.'UQ=','c29'.'jaWF'.'sbm'.'V0d2'.'9yaw==','YWx'.'sb3dfb'.'Wljcm9ibG9'.'nX'.'2dy'.'b'.'3Vw','Tg==','','',''.'QUN'.'USVZ'.'F','WQ='.'=','c29j'.'aWFs'.'bmV0d'.'29y'.'aw==',''.'Y'.'Wxsb'.'3d'.'f'.'Z'.'mlsZX'.'NfdX'.'Nlcg'.'==',''.'WQ'.'==','SUQ=','c29j'.'aWFsb'.'m'.'V0d2'.'9'.'ya'.'w==',''.'YWx'.'sb3'.'d'.'fZmlsZXN'.'fdXN'.'lcg==','SUQ=','c'.'29j'.'a'.'WFsb'.'mV0d29yaw='.'=','Y'.'W'.'xsb3dfZmlsZXNf'.'dX'.'N'.'lcg'.'==',''.'Tg==','','','QUNUS'.'VZF','WQ==','c29jaWFsbmV0d'.'29yaw==','YWxsb3dfYmxvZ191c2'.'Vy','WQ='.'=','SUQ=','c29'.'jaW'.'FsbmV0'.'d29'.'yaw==',''.'YWxsb3dfY'.'mxvZ1'.'91c2Vy',''.'SUQ'.'=','c29'.'jaW'.'FsbmV'.'0'.'d29yaw==',''.'YW'.'xsb3d'.'fYm'.'x'.'vZ191c2V'.'y','T'.'g==','','','QU'.'N'.'U'.'SVZF','W'.'Q==','c29j'.'aWFsbmV0d29yaw==','YWxs'.'b3'.'dfc'.'GhvdG9fdXN'.'lcg='.'=','W'.'Q==','S'.'UQ=','c2'.'9jaW'.'Fsb'.'m'.'V'.'0'.'d29yaw==','YWxsb3d'.'fc'.'Ghv'.'dG'.'9'.'fdX'.'Nlcg==',''.'SU'.'Q=','c29jaWFsbmV'.'0d'.'29yaw==','YWxsb3dfcGhv'.'d'.'G9'.'fdXNl'.'cg==',''.'Tg==','','','Q'.'UNUSVZF','W'.'Q==',''.'c29j'.'aW'.'FsbmV0d29yaw==','Y'.'Wxsb3dfZm9ydW1'.'fdXNlcg==','WQ==','SUQ=','c29'.'jaWFs'.'bmV'.'0d29yaw='.'=','YWx'.'sb'.'3dfZ'.'m9yd'.'W1f'.'d'.'X'.'Nlcg==',''.'SUQ=','c29'.'jaWFs'.'bmV0d2'.'9'.'yaw==','YWxsb'.'3dfZm'.'9ydW1fd'.'XNlcg='.'=','T'.'g==','','',''.'Q'.'UNUSVZF',''.'WQ='.'=',''.'c2'.'9ja'.'WF'.'sbmV0d29yaw==','YWxsb3dfdGFza3NfdXNl'.'cg==','WQ==','SUQ=','c29j'.'aWFs'.'b'.'mV0'.'d29ya'.'w==','YWxs'.'b3d'.'fdGFza'.'3'.'NfdXNlcg==',''.'S'.'UQ=','c2'.'9jaWFsbmV0d29yaw==','YWxsb'.'3'.'d'.'f'.'dG'.'Fza3Nf'.'dX'.'N'.'l'.'cg'.'==','c29jaWFs'.'bmV0d29yaw==','YWxsb3dfdGFza3NfZ'.'3Jv'.'dXA=','WQ='.'=','SUQ'.'=','c2'.'9jaWFsbmV'.'0'.'d2'.'9yaw'.'==','YWxs'.'b3dfdG'.'Fza3NfZ3Jvd'.'XA=',''.'SUQ=','c29ja'.'WFsbmV'.'0d'.'2'.'9yaw==','YWxsb'.'3dfd'.'GFza3NfZ3Jv'.'dXA=','dGFza3M=',''.'Tg==','','','QUNUSVZF',''.'WQ='.'=',''.'c29jaW'.'FsbmV0d2'.'9yaw'.'==','YW'.'xsb'.'3d'.'fY'.'2FsZW5kY'.'X'.'JfdXNlcg==',''.'WQ='.'=','SUQ'.'=',''.'c'.'2'.'9j'.'aW'.'Fs'.'b'.'mV0d29'.'yaw==','YW'.'xs'.'b3'.'d'.'fY2FsZW'.'5'.'kY'.'XJfdXNl'.'cg='.'=','SUQ=','c29jaWFsbmV0d29yaw'.'==',''.'YWxs'.'b3dfY2Fs'.'ZW5kYXJfd'.'XNlcg'.'='.'=',''.'c'.'2'.'9'.'jaWF'.'sbm'.'V0d29ya'.'w==',''.'YWx'.'sb3dfY2FsZW'.'5kYXJfZ3'.'JvdX'.'A=','W'.'Q==','SUQ=',''.'c29jaW'.'FsbmV'.'0d29'.'yaw='.'=','Y'.'W'.'xsb3dfY'.'2'.'Fs'.'ZW5kY'.'X'.'JfZ3Jv'.'dXA=','S'.'UQ=',''.'c'.'29'.'j'.'aWF'.'sbm'.'V0'.'d29yaw'.'==',''.'YWx'.'s'.'b3dfY'.'2FsZ'.'W5k'.'YXJ'.'fZ3'.'JvdXA=','QUNUSVZ'.'F','W'.'Q==','Tg==',''.'ZX'.'h0c'.'m'.'Fu'.'ZX'.'Q'.'=','aWJsb'.'2Nr','T'.'25BZ'.'nR'.'lcklCbG9ja0VsZ'.'W1lbnRV'.'c'.'GRhdGU=',''.'aW'.'5'.'0cmFuZXQ=','Q0ludHJhbmV'.'0RX'.'Z'.'lbnRIY'.'W'.'5kbGVycw==','U1BSZWdp'.'c'.'3Rlc'.'lVw'.'ZGF0ZWRJdGVt','Q0'.'l'.'udHJhbmV0U2'.'hhc'.'mVwb2ludDo6Q'.'Wdl'.'bnRMa'.'X'.'N0cy'.'gpO'.'w==','a'.'W50cmFuZX'.'Q=','Tg==','Q0l'.'ud'.'HJhbm'.'V0U'.'2hhc'.'mVwb2lud'.'D'.'o6QWdlb'.'nRRdWV1ZS'.'g'.'pO'.'w='.'=','aW50c'.'mF'.'uZXQ=','Tg='.'=',''.'Q'.'0l'.'udHJh'.'bmV'.'0U2hhcmVwb2ludDo6QWdl'.'bnR'.'Vc'.'GRhdG'.'UoKT'.'s=','aW5'.'0cmFu'.'ZXQ=','T'.'g==','aW'.'Jsb2Nr','T2'.'5BZnRlckl'.'CbG9j'.'a0'.'VsZ'.'W1lbnRBZ'.'GQ=','aW50c'.'mFuZXQ=','Q0lud'.'H'.'JhbmV0R'.'X'.'Zlb'.'n'.'RIYW5kb'.'GVy'.'cw==','U1'.'BSZWd'.'pc3R'.'lclVwZGF0ZWRJdGV'.'t','aWJsb'.'2Nr','T25BZnRlck'.'lCbG9ja'.'0VsZW'.'1'.'l'.'bn'.'R'.'VcG'.'Rh'.'d'.'G'.'U=','aW5'.'0cmF'.'uZXQ=','Q'.'0ludHJhb'.'m'.'V0RXZlbn'.'RIYW'.'5kbGVycw==','U1BSZWdpc'.'3RlclVwZGF0ZWRJdGV'.'t','Q0lu'.'dHJhbmV0'.'U2hh'.'cmVwb2'.'ludDo6Q'.'Wdl'.'bnRMaXN0c'.'y'.'gpOw='.'=','aW50cmFuZX'.'Q=','Q0lu'.'dHJhb'.'mV0'.'U'.'2hhcmVwb2'.'ludDo6QWdlbnRRdWV1ZS'.'g'.'p'.'Ow='.'=','aW50'.'cm'.'FuZXQ=','Q0lu'.'dHJhbmV'.'0U2hhcm'.'Vwb2ludD'.'o6QWdl'.'bnRVcGRhdGUoKTs=','a'.'W50cmFu'.'ZXQ'.'=','Y3'.'Jt','bW'.'Fpbg==','T'.'25CZWZvcmVQ'.'cm'.'9sb2c=','bWFp'.'bg==','Q1dpemFyZFNv'.'bFBhbm'.'Vs'.'SW5'.'0cmFuZXQ=',''.'U'.'2h'.'vd1'.'B'.'hbmVs','L2'.'1vZ'.'HVsZXM'.'vaW'.'5'.'0'.'cmF'.'uZXQvc'.'G'.'FuZWxfYn'.'V0'.'d'.'G9uLnBocA==','ZXh'.'waXJ'.'lX'.'21lc3My','bm9p'.'dGl'.'kZV90aW1pb'.'GVt'.'aXQ=','WQ'.'==',''.'ZH'.'Jpb'.'l'.'9wZ'.'XJnb2tj','JTAxM'.'HM'.'K',''.'RUVYUEl'.'S','b'.'WFpb'.'g'.'==','J'.'XMlcw'.'==',''.'YWRt','aGRyb3'.'dzc2E=',''.'Y'.'WRt'.'aW4=',''.'bW9'.'kdWxlcw==','Z'.'GVmaW5lLnBoc'.'A='.'=','b'.'WF'.'p'.'b'.'g==','Y'.'ml0c'.'ml4',''.'U'.'kh'.'TS'.'VRFRVg'.'=','SDR1Njdm'.'aHc4N1ZoeXRvcw==','','d'.'GhS','N'.'0h5cjE'.'ySHd5'.'MHJGcg'.'==','VF9TV'.'EVBTA==','aH'.'R0cHM6Ly9'.'iaXR'.'yaXhzb'.'2Z0LmNvb'.'S9'.'iaXRyaXgv'.'YnMu'.'cG'.'hw','T'.'0xE',''.'UElSR'.'UR'.'B'.'VE'.'VT',''.'RE9DVU1FTl'.'R'.'fUk'.'9PVA==','Lw'.'==','Lw==','VEVNUE'.'9SQVJZX'.'0NBQ'.'0hF','VEVN'.'UE9S'.'QVJ'.'Z'.'X0N'.'BQ0hF','','T0'.'5f'.'T'.'0'.'Q'.'=','JX'.'Mlcw'.'==','X09VUl9CV'.'VM=','U0lU',''.'R'.'URBVEVN'.'QV'.'B'.'F'.'Ug==','bm9pdGlk'.'Z'.'V'.'90a'.'W1pb'.'G'.'VtaXQ'.'=','bQ'.'='.'=','ZA==',''.'WQ==','U0NS'.'SVBUX05BTUU'.'=','L2J'.'pdHJpeC9jb3Vw'.'b2'.'5'.'fY'.'W'.'N0aXZhdG'.'lvbi5'.'waH'.'A=','U0N'.'SSVBUX05BT'.'UU=','L2J'.'pd'.'HJpe'.'C'.'9'.'zZXJ2'.'aWNlcy9tYWluL2'.'FqYX'.'gu'.'cGh'.'w','L2JpdH'.'JpeC9j'.'b3Vwb25fYWN0'.'aXZhdG'.'lvbi5wa'.'H'.'A=','U'.'2'.'l0Z'.'UV4'.'cGly'.'ZU'.'Rhd'.'GU=');return base64_decode($_1172003164[$_353391247]);}};$GLOBALS['____2134765017'][0](___747368604(0), ___747368604(1));class CBXFeatures{ private static $_1122885552= 30; private static $_2087688558= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_772848421= null; private static $_1794296078= null; private static function __1976889139(){ if(self::$_772848421 === null){ self::$_772848421= array(); foreach(self::$_2087688558 as $_1251998385 => $_1563509676){ foreach($_1563509676 as $_691513442) self::$_772848421[$_691513442]= $_1251998385;}} if(self::$_1794296078 === null){ self::$_1794296078= array(); $_653617211= COption::GetOptionString(___747368604(2), ___747368604(3), ___747368604(4)); if($_653617211 != ___747368604(5)){ $_653617211= $GLOBALS['____2134765017'][1]($_653617211); $_653617211= $GLOBALS['____2134765017'][2]($_653617211,[___747368604(6) => false]); if($GLOBALS['____2134765017'][3]($_653617211)){ self::$_1794296078= $_653617211;}} if(empty(self::$_1794296078)){ self::$_1794296078= array(___747368604(7) => array(), ___747368604(8) => array());}}} public static function InitiateEditionsSettings($_680257355){ self::__1976889139(); $_2099208710= array(); foreach(self::$_2087688558 as $_1251998385 => $_1563509676){ $_1501167359= $GLOBALS['____2134765017'][4]($_1251998385, $_680257355); self::$_1794296078[___747368604(9)][$_1251998385]=($_1501167359? array(___747368604(10)): array(___747368604(11))); foreach($_1563509676 as $_691513442){ self::$_1794296078[___747368604(12)][$_691513442]= $_1501167359; if(!$_1501167359) $_2099208710[]= array($_691513442, false);}} $_2068737385= $GLOBALS['____2134765017'][5](self::$_1794296078); $_2068737385= $GLOBALS['____2134765017'][6]($_2068737385); COption::SetOptionString(___747368604(13), ___747368604(14), $_2068737385); foreach($_2099208710 as $_186833465) self::__1396501068($_186833465[min(80,0,26.666666666667)], $_186833465[round(0+0.5+0.5)]);} public static function IsFeatureEnabled($_691513442){ if($_691513442 == '') return true; self::__1976889139(); if(!isset(self::$_772848421[$_691513442])) return true; if(self::$_772848421[$_691513442] == ___747368604(15)) $_1846205726= array(___747368604(16)); elseif(isset(self::$_1794296078[___747368604(17)][self::$_772848421[$_691513442]])) $_1846205726= self::$_1794296078[___747368604(18)][self::$_772848421[$_691513442]]; else $_1846205726= array(___747368604(19)); if($_1846205726[min(58,0,19.333333333333)] != ___747368604(20) && $_1846205726[(802-2*401)] != ___747368604(21)){ return false;} elseif($_1846205726[(856-2*428)] == ___747368604(22)){ if($_1846205726[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____2134765017'][7](min(86,0,28.666666666667),(820-2*410),(129*2-258), Date(___747368604(23)), $GLOBALS['____2134765017'][8](___747368604(24))- self::$_1122885552, $GLOBALS['____2134765017'][9](___747368604(25)))){ if(!isset($_1846205726[round(0+0.5+0.5+0.5+0.5)]) ||!$_1846205726[round(0+1+1)]) self::__287265729(self::$_772848421[$_691513442]); return false;}} return!isset(self::$_1794296078[___747368604(26)][$_691513442]) || self::$_1794296078[___747368604(27)][$_691513442];} public static function IsFeatureInstalled($_691513442){ if($GLOBALS['____2134765017'][10]($_691513442) <= 0) return true; self::__1976889139(); return(isset(self::$_1794296078[___747368604(28)][$_691513442]) && self::$_1794296078[___747368604(29)][$_691513442]);} public static function IsFeatureEditable($_691513442){ if($_691513442 == '') return true; self::__1976889139(); if(!isset(self::$_772848421[$_691513442])) return true; if(self::$_772848421[$_691513442] == ___747368604(30)) $_1846205726= array(___747368604(31)); elseif(isset(self::$_1794296078[___747368604(32)][self::$_772848421[$_691513442]])) $_1846205726= self::$_1794296078[___747368604(33)][self::$_772848421[$_691513442]]; else $_1846205726= array(___747368604(34)); if($_1846205726[(1360/2-680)] != ___747368604(35) && $_1846205726[min(16,0,5.3333333333333)] != ___747368604(36)){ return false;} elseif($_1846205726[(135*2-270)] == ___747368604(37)){ if($_1846205726[round(0+1)]< $GLOBALS['____2134765017'][11]((764-2*382),(954-2*477), min(188,0,62.666666666667), Date(___747368604(38)), $GLOBALS['____2134765017'][12](___747368604(39))- self::$_1122885552, $GLOBALS['____2134765017'][13](___747368604(40)))){ if(!isset($_1846205726[round(0+1+1)]) ||!$_1846205726[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) self::__287265729(self::$_772848421[$_691513442]); return false;}} return true;} private static function __1396501068($_691513442, $_1978728148){ if($GLOBALS['____2134765017'][14]("CBXFeatures", "On".$_691513442."SettingsChange")) $GLOBALS['____2134765017'][15](array("CBXFeatures", "On".$_691513442."SettingsChange"), array($_691513442, $_1978728148)); $_1636838916= $GLOBALS['_____236307897'][0](___747368604(41), ___747368604(42).$_691513442.___747368604(43)); while($_1008944296= $_1636838916->Fetch()) $GLOBALS['_____236307897'][1]($_1008944296, array($_691513442, $_1978728148));} public static function SetFeatureEnabled($_691513442, $_1978728148= true, $_556978078= true){ if($GLOBALS['____2134765017'][16]($_691513442) <= 0) return; if(!self::IsFeatureEditable($_691513442)) $_1978728148= false; $_1978728148= (bool)$_1978728148; self::__1976889139(); $_1338092119=(!isset(self::$_1794296078[___747368604(44)][$_691513442]) && $_1978728148 || isset(self::$_1794296078[___747368604(45)][$_691513442]) && $_1978728148 != self::$_1794296078[___747368604(46)][$_691513442]); self::$_1794296078[___747368604(47)][$_691513442]= $_1978728148; $_2068737385= $GLOBALS['____2134765017'][17](self::$_1794296078); $_2068737385= $GLOBALS['____2134765017'][18]($_2068737385); COption::SetOptionString(___747368604(48), ___747368604(49), $_2068737385); if($_1338092119 && $_556978078) self::__1396501068($_691513442, $_1978728148);} private static function __287265729($_1251998385){ if($GLOBALS['____2134765017'][19]($_1251998385) <= 0 || $_1251998385 == "Portal") return; self::__1976889139(); if(!isset(self::$_1794296078[___747368604(50)][$_1251998385]) || self::$_1794296078[___747368604(51)][$_1251998385][min(78,0,26)] != ___747368604(52)) return; if(isset(self::$_1794296078[___747368604(53)][$_1251998385][round(0+2)]) && self::$_1794296078[___747368604(54)][$_1251998385][round(0+0.5+0.5+0.5+0.5)]) return; $_2099208710= array(); if(isset(self::$_2087688558[$_1251998385]) && $GLOBALS['____2134765017'][20](self::$_2087688558[$_1251998385])){ foreach(self::$_2087688558[$_1251998385] as $_691513442){ if(isset(self::$_1794296078[___747368604(55)][$_691513442]) && self::$_1794296078[___747368604(56)][$_691513442]){ self::$_1794296078[___747368604(57)][$_691513442]= false; $_2099208710[]= array($_691513442, false);}} self::$_1794296078[___747368604(58)][$_1251998385][round(0+1+1)]= true;} $_2068737385= $GLOBALS['____2134765017'][21](self::$_1794296078); $_2068737385= $GLOBALS['____2134765017'][22]($_2068737385); COption::SetOptionString(___747368604(59), ___747368604(60), $_2068737385); foreach($_2099208710 as $_186833465) self::__1396501068($_186833465[(154*2-308)], $_186833465[round(0+0.5+0.5)]);} public static function ModifyFeaturesSettings($_680257355, $_1563509676){ self::__1976889139(); foreach($_680257355 as $_1251998385 => $_496832097) self::$_1794296078[___747368604(61)][$_1251998385]= $_496832097; $_2099208710= array(); foreach($_1563509676 as $_691513442 => $_1978728148){ if(!isset(self::$_1794296078[___747368604(62)][$_691513442]) && $_1978728148 || isset(self::$_1794296078[___747368604(63)][$_691513442]) && $_1978728148 != self::$_1794296078[___747368604(64)][$_691513442]) $_2099208710[]= array($_691513442, $_1978728148); self::$_1794296078[___747368604(65)][$_691513442]= $_1978728148;} $_2068737385= $GLOBALS['____2134765017'][23](self::$_1794296078); $_2068737385= $GLOBALS['____2134765017'][24]($_2068737385); COption::SetOptionString(___747368604(66), ___747368604(67), $_2068737385); self::$_1794296078= null; foreach($_2099208710 as $_186833465) self::__1396501068($_186833465[(1076/2-538)], $_186833465[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function SaveFeaturesSettings($_1464963910, $_256073513){ self::__1976889139(); $_955388319= array(___747368604(68) => array(), ___747368604(69) => array()); if(!$GLOBALS['____2134765017'][25]($_1464963910)) $_1464963910= array(); if(!$GLOBALS['____2134765017'][26]($_256073513)) $_256073513= array(); if(!$GLOBALS['____2134765017'][27](___747368604(70), $_1464963910)) $_1464963910[]= ___747368604(71); foreach(self::$_2087688558 as $_1251998385 => $_1563509676){ if(isset(self::$_1794296078[___747368604(72)][$_1251998385])){ $_1245359015= self::$_1794296078[___747368604(73)][$_1251998385];} else{ $_1245359015=($_1251998385 == ___747368604(74)? array(___747368604(75)): array(___747368604(76)));} if($_1245359015[(244*2-488)] == ___747368604(77) || $_1245359015[(948-2*474)] == ___747368604(78)){ $_955388319[___747368604(79)][$_1251998385]= $_1245359015;} else{ if($GLOBALS['____2134765017'][28]($_1251998385, $_1464963910)) $_955388319[___747368604(80)][$_1251998385]= array(___747368604(81), $GLOBALS['____2134765017'][29]((1408/2-704), min(42,0,14), min(196,0,65.333333333333), $GLOBALS['____2134765017'][30](___747368604(82)), $GLOBALS['____2134765017'][31](___747368604(83)), $GLOBALS['____2134765017'][32](___747368604(84)))); else $_955388319[___747368604(85)][$_1251998385]= array(___747368604(86));}} $_2099208710= array(); foreach(self::$_772848421 as $_691513442 => $_1251998385){ if($_955388319[___747368604(87)][$_1251998385][(236*2-472)] != ___747368604(88) && $_955388319[___747368604(89)][$_1251998385][min(218,0,72.666666666667)] != ___747368604(90)){ $_955388319[___747368604(91)][$_691513442]= false;} else{ if($_955388319[___747368604(92)][$_1251998385][(768-2*384)] == ___747368604(93) && $_955388319[___747368604(94)][$_1251998385][round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____2134765017'][33]((776-2*388),(1064/2-532),(228*2-456), Date(___747368604(95)), $GLOBALS['____2134765017'][34](___747368604(96))- self::$_1122885552, $GLOBALS['____2134765017'][35](___747368604(97)))) $_955388319[___747368604(98)][$_691513442]= false; else $_955388319[___747368604(99)][$_691513442]= $GLOBALS['____2134765017'][36]($_691513442, $_256073513); if(!isset(self::$_1794296078[___747368604(100)][$_691513442]) && $_955388319[___747368604(101)][$_691513442] || isset(self::$_1794296078[___747368604(102)][$_691513442]) && $_955388319[___747368604(103)][$_691513442] != self::$_1794296078[___747368604(104)][$_691513442]) $_2099208710[]= array($_691513442, $_955388319[___747368604(105)][$_691513442]);}} $_2068737385= $GLOBALS['____2134765017'][37]($_955388319); $_2068737385= $GLOBALS['____2134765017'][38]($_2068737385); COption::SetOptionString(___747368604(106), ___747368604(107), $_2068737385); self::$_1794296078= null; foreach($_2099208710 as $_186833465) self::__1396501068($_186833465[min(220,0,73.333333333333)], $_186833465[round(0+0.25+0.25+0.25+0.25)]);} public static function GetFeaturesList(){ self::__1976889139(); $_58432526= array(); foreach(self::$_2087688558 as $_1251998385 => $_1563509676){ if(isset(self::$_1794296078[___747368604(108)][$_1251998385])){ $_1245359015= self::$_1794296078[___747368604(109)][$_1251998385];} else{ $_1245359015=($_1251998385 == ___747368604(110)? array(___747368604(111)): array(___747368604(112)));} $_58432526[$_1251998385]= array( ___747368604(113) => $_1245359015[(190*2-380)], ___747368604(114) => $_1245359015[round(0+0.33333333333333+0.33333333333333+0.33333333333333)], ___747368604(115) => array(),); $_58432526[$_1251998385][___747368604(116)]= false; if($_58432526[$_1251998385][___747368604(117)] == ___747368604(118)){ $_58432526[$_1251998385][___747368604(119)]= $GLOBALS['____2134765017'][39](($GLOBALS['____2134765017'][40]()- $_58432526[$_1251998385][___747368604(120)])/ round(0+21600+21600+21600+21600)); if($_58432526[$_1251998385][___747368604(121)]> self::$_1122885552) $_58432526[$_1251998385][___747368604(122)]= true;} foreach($_1563509676 as $_691513442) $_58432526[$_1251998385][___747368604(123)][$_691513442]=(!isset(self::$_1794296078[___747368604(124)][$_691513442]) || self::$_1794296078[___747368604(125)][$_691513442]);} return $_58432526;} private static function __1033142115($_249239481, $_1752951617){ if(IsModuleInstalled($_249239481) == $_1752951617) return true; $_170617507= $_SERVER[___747368604(126)].___747368604(127).$_249239481.___747368604(128); if(!$GLOBALS['____2134765017'][41]($_170617507)) return false; include_once($_170617507); $_558633801= $GLOBALS['____2134765017'][42](___747368604(129), ___747368604(130), $_249239481); if(!$GLOBALS['____2134765017'][43]($_558633801)) return false; $_1131002943= new $_558633801; if($_1752951617){ if(!$_1131002943->InstallDB()) return false; $_1131002943->InstallEvents(); if(!$_1131002943->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___747368604(131))) CSearch::DeleteIndex($_249239481); UnRegisterModule($_249239481);} return true;} protected static function OnRequestsSettingsChange($_691513442, $_1978728148){ self::__1033142115("form", $_1978728148);} protected static function OnLearningSettingsChange($_691513442, $_1978728148){ self::__1033142115("learning", $_1978728148);} protected static function OnJabberSettingsChange($_691513442, $_1978728148){ self::__1033142115("xmpp", $_1978728148);} protected static function OnVideoConferenceSettingsChange($_691513442, $_1978728148){} protected static function OnBizProcSettingsChange($_691513442, $_1978728148){ self::__1033142115("bizprocdesigner", $_1978728148);} protected static function OnListsSettingsChange($_691513442, $_1978728148){ self::__1033142115("lists", $_1978728148);} protected static function OnWikiSettingsChange($_691513442, $_1978728148){ self::__1033142115("wiki", $_1978728148);} protected static function OnSupportSettingsChange($_691513442, $_1978728148){ self::__1033142115("support", $_1978728148);} protected static function OnControllerSettingsChange($_691513442, $_1978728148){ self::__1033142115("controller", $_1978728148);} protected static function OnAnalyticsSettingsChange($_691513442, $_1978728148){ self::__1033142115("statistic", $_1978728148);} protected static function OnVoteSettingsChange($_691513442, $_1978728148){ self::__1033142115("vote", $_1978728148);} protected static function OnFriendsSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(132); $_1964630309= CSite::GetList(___747368604(133), ___747368604(134), array(___747368604(135) => ___747368604(136))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(137), ___747368604(138), ___747368604(139), $_1039187463[___747368604(140)]) != $_1173148842){ COption::SetOptionString(___747368604(141), ___747368604(142), $_1173148842, false, $_1039187463[___747368604(143)]); COption::SetOptionString(___747368604(144), ___747368604(145), $_1173148842);}}} protected static function OnMicroBlogSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(146); $_1964630309= CSite::GetList(___747368604(147), ___747368604(148), array(___747368604(149) => ___747368604(150))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(151), ___747368604(152), ___747368604(153), $_1039187463[___747368604(154)]) != $_1173148842){ COption::SetOptionString(___747368604(155), ___747368604(156), $_1173148842, false, $_1039187463[___747368604(157)]); COption::SetOptionString(___747368604(158), ___747368604(159), $_1173148842);} if(COption::GetOptionString(___747368604(160), ___747368604(161), ___747368604(162), $_1039187463[___747368604(163)]) != $_1173148842){ COption::SetOptionString(___747368604(164), ___747368604(165), $_1173148842, false, $_1039187463[___747368604(166)]); COption::SetOptionString(___747368604(167), ___747368604(168), $_1173148842);}}} protected static function OnPersonalFilesSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(169); $_1964630309= CSite::GetList(___747368604(170), ___747368604(171), array(___747368604(172) => ___747368604(173))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(174), ___747368604(175), ___747368604(176), $_1039187463[___747368604(177)]) != $_1173148842){ COption::SetOptionString(___747368604(178), ___747368604(179), $_1173148842, false, $_1039187463[___747368604(180)]); COption::SetOptionString(___747368604(181), ___747368604(182), $_1173148842);}}} protected static function OnPersonalBlogSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(183); $_1964630309= CSite::GetList(___747368604(184), ___747368604(185), array(___747368604(186) => ___747368604(187))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(188), ___747368604(189), ___747368604(190), $_1039187463[___747368604(191)]) != $_1173148842){ COption::SetOptionString(___747368604(192), ___747368604(193), $_1173148842, false, $_1039187463[___747368604(194)]); COption::SetOptionString(___747368604(195), ___747368604(196), $_1173148842);}}} protected static function OnPersonalPhotoSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(197); $_1964630309= CSite::GetList(___747368604(198), ___747368604(199), array(___747368604(200) => ___747368604(201))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(202), ___747368604(203), ___747368604(204), $_1039187463[___747368604(205)]) != $_1173148842){ COption::SetOptionString(___747368604(206), ___747368604(207), $_1173148842, false, $_1039187463[___747368604(208)]); COption::SetOptionString(___747368604(209), ___747368604(210), $_1173148842);}}} protected static function OnPersonalForumSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(211); $_1964630309= CSite::GetList(___747368604(212), ___747368604(213), array(___747368604(214) => ___747368604(215))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(216), ___747368604(217), ___747368604(218), $_1039187463[___747368604(219)]) != $_1173148842){ COption::SetOptionString(___747368604(220), ___747368604(221), $_1173148842, false, $_1039187463[___747368604(222)]); COption::SetOptionString(___747368604(223), ___747368604(224), $_1173148842);}}} protected static function OnTasksSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(225); $_1964630309= CSite::GetList(___747368604(226), ___747368604(227), array(___747368604(228) => ___747368604(229))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(230), ___747368604(231), ___747368604(232), $_1039187463[___747368604(233)]) != $_1173148842){ COption::SetOptionString(___747368604(234), ___747368604(235), $_1173148842, false, $_1039187463[___747368604(236)]); COption::SetOptionString(___747368604(237), ___747368604(238), $_1173148842);} if(COption::GetOptionString(___747368604(239), ___747368604(240), ___747368604(241), $_1039187463[___747368604(242)]) != $_1173148842){ COption::SetOptionString(___747368604(243), ___747368604(244), $_1173148842, false, $_1039187463[___747368604(245)]); COption::SetOptionString(___747368604(246), ___747368604(247), $_1173148842);}} self::__1033142115(___747368604(248), $_1978728148);} protected static function OnCalendarSettingsChange($_691513442, $_1978728148){ if($_1978728148) $_1173148842= "Y"; else $_1173148842= ___747368604(249); $_1964630309= CSite::GetList(___747368604(250), ___747368604(251), array(___747368604(252) => ___747368604(253))); while($_1039187463= $_1964630309->Fetch()){ if(COption::GetOptionString(___747368604(254), ___747368604(255), ___747368604(256), $_1039187463[___747368604(257)]) != $_1173148842){ COption::SetOptionString(___747368604(258), ___747368604(259), $_1173148842, false, $_1039187463[___747368604(260)]); COption::SetOptionString(___747368604(261), ___747368604(262), $_1173148842);} if(COption::GetOptionString(___747368604(263), ___747368604(264), ___747368604(265), $_1039187463[___747368604(266)]) != $_1173148842){ COption::SetOptionString(___747368604(267), ___747368604(268), $_1173148842, false, $_1039187463[___747368604(269)]); COption::SetOptionString(___747368604(270), ___747368604(271), $_1173148842);}}} protected static function OnSMTPSettingsChange($_691513442, $_1978728148){ self::__1033142115("mail", $_1978728148);} protected static function OnExtranetSettingsChange($_691513442, $_1978728148){ $_992876822= COption::GetOptionString("extranet", "extranet_site", ""); if($_992876822){ $_688621871= new CSite; $_688621871->Update($_992876822, array(___747368604(272) =>($_1978728148? ___747368604(273): ___747368604(274))));} self::__1033142115(___747368604(275), $_1978728148);} protected static function OnDAVSettingsChange($_691513442, $_1978728148){ self::__1033142115("dav", $_1978728148);} protected static function OntimemanSettingsChange($_691513442, $_1978728148){ self::__1033142115("timeman", $_1978728148);} protected static function Onintranet_sharepointSettingsChange($_691513442, $_1978728148){ if($_1978728148){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___747368604(276), ___747368604(277), ___747368604(278), ___747368604(279), ___747368604(280)); CAgent::AddAgent(___747368604(281), ___747368604(282), ___747368604(283), round(0+125+125+125+125)); CAgent::AddAgent(___747368604(284), ___747368604(285), ___747368604(286), round(0+150+150)); CAgent::AddAgent(___747368604(287), ___747368604(288), ___747368604(289), round(0+1200+1200+1200));} else{ UnRegisterModuleDependences(___747368604(290), ___747368604(291), ___747368604(292), ___747368604(293), ___747368604(294)); UnRegisterModuleDependences(___747368604(295), ___747368604(296), ___747368604(297), ___747368604(298), ___747368604(299)); CAgent::RemoveAgent(___747368604(300), ___747368604(301)); CAgent::RemoveAgent(___747368604(302), ___747368604(303)); CAgent::RemoveAgent(___747368604(304), ___747368604(305));}} protected static function OncrmSettingsChange($_691513442, $_1978728148){ if($_1978728148) COption::SetOptionString("crm", "form_features", "Y"); self::__1033142115(___747368604(306), $_1978728148);} protected static function OnClusterSettingsChange($_691513442, $_1978728148){ self::__1033142115("cluster", $_1978728148);} protected static function OnMultiSitesSettingsChange($_691513442, $_1978728148){ if($_1978728148) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___747368604(307), ___747368604(308), ___747368604(309), ___747368604(310), ___747368604(311), ___747368604(312));} protected static function OnIdeaSettingsChange($_691513442, $_1978728148){ self::__1033142115("idea", $_1978728148);} protected static function OnMeetingSettingsChange($_691513442, $_1978728148){ self::__1033142115("meeting", $_1978728148);} protected static function OnXDImportSettingsChange($_691513442, $_1978728148){ self::__1033142115("xdimport", $_1978728148);}} $_1112697438= GetMessage(___747368604(313));$_399251293= round(0+7.5+7.5);$GLOBALS['____2134765017'][44]($GLOBALS['____2134765017'][45]($GLOBALS['____2134765017'][46](___747368604(314))), ___747368604(315));$_1502577972= round(0+0.5+0.5); $_1889290578= ___747368604(316); unset($_347968814); $_2015824048= $GLOBALS['____2134765017'][47](___747368604(317), ___747368604(318)); $_347968814= \COption::GetOptionString(___747368604(319), $GLOBALS['____2134765017'][48](___747368604(320),___747368604(321),$GLOBALS['____2134765017'][49]($_1889290578, round(0+0.66666666666667+0.66666666666667+0.66666666666667), round(0+4))).$GLOBALS['____2134765017'][50](___747368604(322))); $_525002098= array(round(0+4.25+4.25+4.25+4.25) => ___747368604(323), round(0+1.4+1.4+1.4+1.4+1.4) => ___747368604(324), round(0+11+11) => ___747368604(325), round(0+12) => ___747368604(326), round(0+1+1+1) => ___747368604(327)); $_1427489236= ___747368604(328); while($_347968814){ $_81499803= ___747368604(329); $_1038749431= $GLOBALS['____2134765017'][51]($_347968814); $_1751854462= ___747368604(330); $_81499803= $GLOBALS['____2134765017'][52](___747368604(331).$_81499803, min(14,0,4.6666666666667),-round(0+2.5+2.5)).___747368604(332); $_1336773991= $GLOBALS['____2134765017'][53]($_81499803); $_1089544513=(207*2-414); for($_1623161767= min(210,0,70); $_1623161767<$GLOBALS['____2134765017'][54]($_1038749431); $_1623161767++){ $_1751854462 .= $GLOBALS['____2134765017'][55]($GLOBALS['____2134765017'][56]($_1038749431[$_1623161767])^ $GLOBALS['____2134765017'][57]($_81499803[$_1089544513])); if($_1089544513==$_1336773991-round(0+0.33333333333333+0.33333333333333+0.33333333333333)) $_1089544513= min(26,0,8.6666666666667); else $_1089544513= $_1089544513+ round(0+1);} $_1502577972= $GLOBALS['____2134765017'][58]((1288/2-644), min(46,0,15.333333333333), min(192,0,64), $GLOBALS['____2134765017'][59]($_1751854462[round(0+1.5+1.5+1.5+1.5)].$_1751854462[round(0+1.5+1.5)]), $GLOBALS['____2134765017'][60]($_1751854462[round(0+1)].$_1751854462[round(0+4.6666666666667+4.6666666666667+4.6666666666667)]), $GLOBALS['____2134765017'][61]($_1751854462[round(0+2.5+2.5+2.5+2.5)].$_1751854462[round(0+4.5+4.5+4.5+4.5)].$_1751854462[round(0+1.4+1.4+1.4+1.4+1.4)].$_1751854462[round(0+6+6)])); unset($_81499803); break;} $_387900277= ___747368604(333); $GLOBALS['____2134765017'][62]($_525002098); $_1913903052= ___747368604(334); $_1427489236= ___747368604(335).$GLOBALS['____2134765017'][63]($_1427489236.___747368604(336), round(0+0.4+0.4+0.4+0.4+0.4),-round(0+0.33333333333333+0.33333333333333+0.33333333333333));@include($_SERVER[___747368604(337)].___747368604(338).$GLOBALS['____2134765017'][64](___747368604(339), $_525002098)); $_1155887061= round(0+2); while($GLOBALS['____2134765017'][65](___747368604(340))){ $_1850427321= $GLOBALS['____2134765017'][66]($GLOBALS['____2134765017'][67](___747368604(341))); $_1375918184= ___747368604(342); $_387900277= $GLOBALS['____2134765017'][68](___747368604(343)).$GLOBALS['____2134765017'][69](___747368604(344),$_387900277,___747368604(345)); $_1555554821= $GLOBALS['____2134765017'][70]($_387900277); $_1089544513=(1428/2-714); for($_1623161767=(1448/2-724); $_1623161767<$GLOBALS['____2134765017'][71]($_1850427321); $_1623161767++){ $_1375918184 .= $GLOBALS['____2134765017'][72]($GLOBALS['____2134765017'][73]($_1850427321[$_1623161767])^ $GLOBALS['____2134765017'][74]($_387900277[$_1089544513])); if($_1089544513==$_1555554821-round(0+0.2+0.2+0.2+0.2+0.2)) $_1089544513=(874-2*437); else $_1089544513= $_1089544513+ round(0+0.25+0.25+0.25+0.25);} $_1155887061= $GLOBALS['____2134765017'][75]((938-2*469), min(80,0,26.666666666667), min(36,0,12), $GLOBALS['____2134765017'][76]($_1375918184[round(0+3+3)].$_1375918184[round(0+16)]), $GLOBALS['____2134765017'][77]($_1375918184[round(0+3+3+3)].$_1375918184[round(0+0.5+0.5+0.5+0.5)]), $GLOBALS['____2134765017'][78]($_1375918184[round(0+3+3+3+3)].$_1375918184[round(0+1.4+1.4+1.4+1.4+1.4)].$_1375918184[round(0+3.5+3.5+3.5+3.5)].$_1375918184[round(0+3)])); unset($_387900277); break;} $_2015824048= ___747368604(346).$GLOBALS['____2134765017'][79]($GLOBALS['____2134765017'][80]($_2015824048, round(0+1+1+1),-round(0+0.5+0.5)).___747368604(347), round(0+0.33333333333333+0.33333333333333+0.33333333333333),-round(0+1.25+1.25+1.25+1.25));while(!$GLOBALS['____2134765017'][81]($GLOBALS['____2134765017'][82]($GLOBALS['____2134765017'][83](___747368604(348))))){function __f($_1257838343){return $_1257838343+__f($_1257838343);}__f(round(0+1));};for($_1623161767=(173*2-346),$_1524127867=($GLOBALS['____2134765017'][84]()< $GLOBALS['____2134765017'][85](min(146,0,48.666666666667),(880-2*440),(882-2*441),round(0+1+1+1+1+1),round(0+0.2+0.2+0.2+0.2+0.2),round(0+2018)) || $_1502577972 <= round(0+2.5+2.5+2.5+2.5)),$_1185863028=($_1502577972< $GLOBALS['____2134765017'][86]((249*2-498),(864-2*432),(227*2-454),Date(___747368604(349)),$GLOBALS['____2134765017'][87](___747368604(350))-$_399251293,$GLOBALS['____2134765017'][88](___747368604(351)))),$_541749585=($_SERVER[___747368604(352)]!==___747368604(353)&&$_SERVER[___747368604(354)]!==___747368604(355)); $_1623161767< round(0+2.5+2.5+2.5+2.5),($_1524127867 || $_1185863028 || $_1502577972 != $_1155887061) && $_541749585; $_1623161767++,LocalRedirect(___747368604(356)),exit,$GLOBALS['_____236307897'][2]($_1112697438));$GLOBALS['____2134765017'][89]($_1427489236, $_1502577972); $GLOBALS['____2134765017'][90]($_2015824048, $_1155887061); $GLOBALS[___747368604(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

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

/*ZDUyZmZYmFmOTU4ZDk3MTBiODU5NzVkZjE0MjEzNjIyMjZkNmM=*/$GLOBALS['____365112869']= array(base64_decode(''.'bXR'.'fcmF'.'uZA=='),base64_decode('Y2FsbF91c2'.'VyX2Z1'.'bmM='),base64_decode('c3R'.'yc'.'G9z'),base64_decode('Z'.'XhwbG9kZQ=='),base64_decode('cG'.'Fja'.'w=='),base64_decode(''.'bWQ1'),base64_decode(''.'Y29uc'.'3RhbnQ='),base64_decode('aGFzaF9'.'ob'.'WFj'),base64_decode('c3R'.'yY21w'),base64_decode('Y2FsbF91c2VyX'.'2Z1bmM='),base64_decode('Y'.'2'.'FsbF91c'.'2V'.'y'.'X2Z1'.'bmM='),base64_decode('aXNfb2JqZW'.'N0'),base64_decode('Y2Fsb'.'F91c2VyX2Z1'.'bmM'.'='),base64_decode('Y2FsbF9'.'1'.'c2VyX2Z1bmM'.'='),base64_decode('Y'.'2'.'FsbF91c'.'2VyX2Z1b'.'mM='),base64_decode('Y2'.'FsbF91c2V'.'yX2Z'.'1b'.'mM='),base64_decode(''.'Y2FsbF91c2VyX2'.'Z1b'.'m'.'M='),base64_decode('Y2FsbF91c2VyX2Z1bm'.'M='),base64_decode('ZGVma'.'W5lZA=='),base64_decode('c3RybGV'.'u'));if(!function_exists(__NAMESPACE__.'\\___1525325818')){function ___1525325818($_14402468){static $_1522302279= false; if($_1522302279 == false) $_1522302279=array('XENPc'.'HRp'.'b24'.'6Ok'.'dldE9wdGlvblN0cml'.'uZw==',''.'bWFpb'.'g='.'=','fl'.'BBUkFNX01B'.'WF9VU0VS'.'U'.'w==',''.'Lg==',''.'Lg==','SCo=',''.'Yml0cml4','TE'.'lD'.'RU5TRV9LRVk'.'=',''.'c'.'2hhMjU2','XENPcHR'.'pb246O'.'kd'.'l'.'dE9w'.'dGl'.'vblN0cmluZw==','bWFpbg='.'=','U'.'EFSQ'.'U1'.'fT'.'UFYX1VTRVJT','XEJpd'.'HJ'.'peFxN'.'YWluXENv'.'bmZpZ1xPcH'.'Rp'.'b246OnNldA==','bWFp'.'bg==','UEFSQU1'.'fTU'.'FYX1V'.'TR'.'VJ'.'T','V'.'VN'.'FUg==','VVNFUg==','VV'.'NF'.'Ug==','SXNBd'.'X'.'R'.'ob3Jpem'.'Vk','VVNFUg==',''.'SXN'.'BZG1pb'.'g='.'=','QVBQTElDQVRJT04=',''.'Um'.'V'.'zdGFydEJ1'.'Z'.'mZl'.'cg==','TG9jY'.'WxSZWRpcmV'.'jd'.'A==',''.'L2'.'xpY'.'2Vu'.'c2VfcmVzdH'.'JpY3'.'Rpb24uc'.'Ghw','XENPcHRpb2'.'46Okd'.'ld'.'E9wdGlvblN0cml'.'uZw==','bW'.'Fpbg'.'='.'=','U'.'E'.'FSQU1fTUFYX1'.'VTR'.'VJT','XEJpdHJpeF'.'xNYWluXEN'.'vbmZpZ1'.'xPcHRpb246'.'On'.'NldA==','bWFpbg'.'==',''.'UEF'.'SQU1'.'fTUFYX1VTR'.'V'.'JT','T0'.'x'.'EU0lURUVYUElS'.'RURBV'.'EU=','ZXhwaXJl'.'X21lc3M'.'y');return base64_decode($_1522302279[$_14402468]);}};if($GLOBALS['____365112869'][0](round(0+1), round(0+6.6666666666667+6.6666666666667+6.6666666666667)) == round(0+1.75+1.75+1.75+1.75)){ $_472047778= $GLOBALS['____365112869'][1](___1525325818(0), ___1525325818(1), ___1525325818(2)); if(!empty($_472047778) && $GLOBALS['____365112869'][2]($_472047778, ___1525325818(3)) !== false){ list($_1123623938, $_1911142540)= $GLOBALS['____365112869'][3](___1525325818(4), $_472047778); $_55712680= $GLOBALS['____365112869'][4](___1525325818(5), $_1123623938); $_843692097= ___1525325818(6).$GLOBALS['____365112869'][5]($GLOBALS['____365112869'][6](___1525325818(7))); $_125055341= $GLOBALS['____365112869'][7](___1525325818(8), $_1911142540, $_843692097, true); if($GLOBALS['____365112869'][8]($_125055341, $_55712680) !== min(166,0,55.333333333333)){ if($GLOBALS['____365112869'][9](___1525325818(9), ___1525325818(10), ___1525325818(11)) != round(0+12)){ $GLOBALS['____365112869'][10](___1525325818(12), ___1525325818(13), ___1525325818(14), round(0+6+6));} if(isset($GLOBALS[___1525325818(15)]) && $GLOBALS['____365112869'][11]($GLOBALS[___1525325818(16)]) && $GLOBALS['____365112869'][12](array($GLOBALS[___1525325818(17)], ___1525325818(18))) &&!$GLOBALS['____365112869'][13](array($GLOBALS[___1525325818(19)], ___1525325818(20)))){ $GLOBALS['____365112869'][14](array($GLOBALS[___1525325818(21)], ___1525325818(22))); $GLOBALS['____365112869'][15](___1525325818(23), ___1525325818(24), true);}}} else{ if($GLOBALS['____365112869'][16](___1525325818(25), ___1525325818(26), ___1525325818(27)) != round(0+2.4+2.4+2.4+2.4+2.4)){ $GLOBALS['____365112869'][17](___1525325818(28), ___1525325818(29), ___1525325818(30), round(0+6+6));}}} while(!$GLOBALS['____365112869'][18](___1525325818(31)) || $GLOBALS['____365112869'][19](OLDSITEEXPIREDATE) <= min(148,0,49.333333333333) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___1525325818(32)));/**/       //Do not remove this
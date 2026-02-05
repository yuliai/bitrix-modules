<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2025 Bitrix
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

/*ZDUyZmZN2M0MjU1ZjE1NTA2NWE3ZmMxNzk0YWNkZDUwY2Y2Yzc=*/$GLOBALS['_____1834882463']= array(base64_decode(''.'R2V0T'.'W9k'.'d'.'Wxl'.'RX'.'ZlbnRz'),base64_decode('RXhlY3V0ZU1vZ'.'HVsZUV2'.'ZW50RXg='),base64_decode('V3Jpd'.'G'.'VGaW'.'5hbE1lc'.'3NhZ'.'2'.'U='));$GLOBALS['____1218186634']= array(base64_decode('ZGVma'.'W5'.'l'),base64_decode(''.'YmFz'.'ZTY'.'0X2RlY29'.'kZQ'.'=='),base64_decode('dW5'.'zZXJp'.'YW'.'xpe'.'mU='),base64_decode('a'.'X'.'NfY'.'X'.'JyYXk='),base64_decode('aW5fYXJyYX'.'k'.'='),base64_decode('c2Vy'.'aWFsaXpl'),base64_decode('Y'.'mFzZTY0X2VuY29kZQ='.'='),base64_decode('b'.'W'.'t0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('Z'.'GF'.'0ZQ=='),base64_decode(''.'c3RybGVu'),base64_decode('bWt0a'.'W1l'),base64_decode(''.'ZGF'.'0'.'ZQ=='),base64_decode(''.'ZGF0ZQ=='),base64_decode('bWV0a'.'G9kX2'.'V4aXN0cw=='),base64_decode(''.'Y2FsbF9'.'1c2VyX2'.'Z1bmN'.'f'.'Y'.'XJ'.'yY'.'Xk='),base64_decode('c'.'3RybG'.'V'.'u'),base64_decode('c2VyaW'.'FsaXpl'),base64_decode(''.'Y'.'m'.'FzZTY0'.'X2VuY29kZQ'.'=='),base64_decode(''.'c3R'.'ybGVu'),base64_decode('a'.'X'.'Nf'.'YXJy'.'Y'.'X'.'k'.'='),base64_decode(''.'c2'.'Vya'.'WFsaX'.'pl'),base64_decode(''.'YmFz'.'Z'.'TY0X2VuY29'.'k'.'ZQ=='),base64_decode('c2Vy'.'aW'.'Fsa'.'Xp'.'l'),base64_decode('YmFzZ'.'TY0X'.'2VuY'.'29k'.'ZQ=='),base64_decode('aXN'.'fY'.'XJyYXk='),base64_decode(''.'a'.'XNfYXJ'.'y'.'YXk'.'='),base64_decode('aW5'.'f'.'YXJyY'.'Xk'.'='),base64_decode('aW5'.'fYX'.'J'.'y'.'YXk='),base64_decode('bWt0'.'aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('Z'.'GF0ZQ=='),base64_decode('bWt'.'0aW'.'1l'),base64_decode('ZGF'.'0'.'ZQ=='),base64_decode('ZGF0Z'.'Q=='),base64_decode('aW'.'5fY'.'XJyYXk='),base64_decode('c2VyaW'.'FsaXp'.'l'),base64_decode(''.'Ym'.'FzZTY'.'0X2VuY'.'2'.'9kZQ=='),base64_decode('aW5'.'0dmFs'),base64_decode('dG'.'ltZQ'.'=='),base64_decode('Z'.'mlsZV9l'.'eGlz'.'dH'.'M'.'='),base64_decode(''.'c3RyX'.'3JlcG'.'xhY2U='),base64_decode('Y2xhc3Nf'.'ZXh'.'p'.'c'.'3'.'R'.'z'),base64_decode(''.'ZG'.'Vma'.'W5l'),base64_decode('c3'.'Ryc'.'mV2'),base64_decode('c3RydG9'.'1cHBlcg=='),base64_decode('c3ByaW5'.'0Zg=='),base64_decode('c3ByaW50Zg'.'=='),base64_decode(''.'c3Vic3'.'Ry'),base64_decode('c3RycmV2'),base64_decode('Ym'.'F'.'zZTY0X2RlY2'.'9'.'kZQ=='),base64_decode('c3Vic'.'3Ry'),base64_decode('c'.'3Ry'.'b'.'GVu'),base64_decode('c3RybGV'.'u'),base64_decode(''.'Y2hy'),base64_decode('b3Jk'),base64_decode(''.'b3Jk'),base64_decode('b'.'Wt0'.'aW1l'),base64_decode('aW5'.'0dmF'.'s'),base64_decode('aW50'.'dmFs'),base64_decode('aW50dmFs'),base64_decode('a3NvcnQ='),base64_decode('c'.'3Vic3Ry'),base64_decode(''.'aW'.'1w'.'bG9k'.'ZQ='.'='),base64_decode(''.'ZG'.'Vm'.'a'.'W5lZ'.'A=='),base64_decode('YmFzZTY0X2RlY'.'29k'.'Z'.'Q'.'=='),base64_decode(''.'Y2'.'9'.'uc3RhbnQ='),base64_decode(''.'c3R'.'ycmV2'),base64_decode('c'.'3ByaW50'.'Zg=='),base64_decode('c3RybGVu'),base64_decode('c'.'3'.'R'.'ybGVu'),base64_decode(''.'Y2hy'),base64_decode('b3'.'Jk'),base64_decode('b3Jk'),base64_decode('bWt0aW'.'1l'),base64_decode('aW50dmFs'),base64_decode('a'.'W50dmFs'),base64_decode(''.'a'.'W50d'.'mFs'),base64_decode('c'.'3Vi'.'c'.'3R'.'y'),base64_decode('c3V'.'ic'.'3'.'Ry'),base64_decode('ZGVmaW5lZA=='),base64_decode('c3'.'RycmV2'),base64_decode('c3RydG'.'91cH'.'Bl'.'cg=='),base64_decode('dGltZ'.'Q=='),base64_decode(''.'bWt0'.'aW1l'),base64_decode('b'.'W'.'t0aW1l'),base64_decode('ZGF0Z'.'Q=='),base64_decode('ZGF0ZQ=='),base64_decode('ZGV'.'maW5l'),base64_decode('ZGVma'.'W5l'));if(!function_exists(__NAMESPACE__.'\\___651613785')){function ___651613785($_1481588789){static $_172937330= false; if($_172937330 == false) $_172937330=array('SU'.'5UUkF'.'ORVRfRU'.'RJVElPTg==',''.'WQ'.'==','bWFpbg'.'==','fm'.'NwZ'.'l9'.'tYXBfdmFsdWU=','','','YWx'.'sb3dlZF9'.'jb'.'GFzc2'.'Vz','ZQ'.'==',''.'Zg==',''.'ZQ==','Rg==','W'.'A='.'=','Zg='.'=','bWFpbg'.'==','fmNwZl9t'.'YXBfdm'.'Fsd'.'W'.'U=','UG9y'.'dG'.'Fs','Rg==','ZQ==',''.'ZQ==','WA==',''.'Rg==','RA==','RA==','bQ==','ZA==','WQ'.'==','Z'.'g==',''.'Z'.'g==','Zg'.'==',''.'Zg==','UG9ydGFs','R'.'g==','ZQ'.'==',''.'ZQ==',''.'WA==','Rg==','RA'.'==','RA==','bQ='.'=','Z'.'A'.'==','WQ='.'=','bWFp'.'bg==','T2'.'4=','U2V'.'0dGlu'.'Z'.'3ND'.'aGFuZ'.'2'.'U=','Zg==','Zg==','Zg==','Zg==','bW'.'Fpbg'.'==','fm'.'NwZl9t'.'YXBfdmFsdW'.'U'.'=','ZQ==',''.'ZQ==','RA'.'==','ZQ==','Z'.'Q==','Zg'.'='.'=','Z'.'g='.'=','Zg'.'==','ZQ==',''.'bWFpbg='.'=','fmNwZl9'.'tYXBfd'.'mFsdW'.'U=','ZQ==',''.'Zg==','Zg==',''.'Z'.'g==','Zg==','bWFpb'.'g==','fmNwZl9'.'tYXBfdmF'.'sd'.'WU=','ZQ'.'==','Zg==','UG9ydGFs','UG9'.'ydGFs',''.'ZQ==','ZQ==',''.'UG9ydGF'.'s','Rg==','WA='.'=','Rg==','RA'.'==','ZQ==','Z'.'Q==','R'.'A==','bQ='.'=',''.'ZA==',''.'W'.'Q==','ZQ==','WA==',''.'ZQ==','Rg==','ZQ==','RA==','Zg='.'=','ZQ'.'==','RA==',''.'ZQ'.'==',''.'bQ==','ZA==',''.'WQ='.'=','Zg==','Zg'.'==','Zg==',''.'Zg==','Zg==','Zg==','Z'.'g'.'==','Zg='.'=','bWFpb'.'g'.'==','fm'.'NwZl9'.'t'.'YX'.'Bfd'.'mFsd'.'W'.'U=','ZQ'.'='.'=','Z'.'Q='.'=','U'.'G'.'9ydG'.'Fs','R'.'g==','WA==','V'.'FlQRQ==','REFURQ==',''.'R'.'k'.'VBVFV'.'SRV'.'M=','RVhQSVJFR'.'A==','VFlQRQ==',''.'RA==','VF'.'JZX0R'.'BWVNfQ0'.'9VTlQ=','R'.'EF'.'URQ==','VFJ'.'ZX0'.'RBWVNfQ09VTl'.'Q=','RVhQSVJ'.'FRA==',''.'RkVBVF'.'V'.'SRVM=','Zg==','Zg==','R'.'E9D'.'VU1FTlRfU'.'k9PVA='.'=','L2JpdHJpeC9tb'.'2R'.'1bG'.'VzLw==','L2l'.'uc'.'3RhbG'.'wvaW5'.'kZXgucGhw',''.'Lg==','Xw==','c'.'2'.'Vh'.'c'.'mNo',''.'T'.'g==','','','QUNUSVZF','WQ==','c29'.'jaWFs'.'b'.'mV'.'0d29yaw==','Y'.'W'.'xsb3'.'dfZ'.'nJp'.'ZWxkcw==','WQ==',''.'SUQ=','c'.'2'.'9jaWFsbmV0d2'.'9yaw'.'='.'=','YWxsb3dfZn'.'J'.'pZWx'.'kcw==','SUQ'.'=','c2'.'9'.'ja'.'WFsbm'.'V0d29yaw'.'==','Y'.'Wxs'.'b3'.'dfZn'.'JpZWxkc'.'w==','T'.'g'.'==','','','Q'.'UNUSVZ'.'F','WQ==','c29jaWFsbm'.'V0'.'d29yaw==',''.'YWxsb'.'3df'.'bW'.'l'.'jc'.'m9ibG9nX3VzZXI=','WQ'.'==','SU'.'Q=','c2'.'9ja'.'WFsbmV0d2'.'9yaw==','YW'.'xs'.'b3dfbW'.'ljc'.'m9i'.'b'.'G'.'9'.'nX3VzZXI=','S'.'UQ=','c'.'2'.'9'.'jaW'.'FsbmV0d29yaw==','Y'.'Wxsb3dfb'.'W'.'ljc'.'m9ibG9nX3V'.'zZXI=','c29jaWFs'.'bmV0d29yaw==',''.'YWxsb3dfb'.'Wl'.'jcm9ibG9nX2dyb3Vw','W'.'Q==','SUQ=','c'.'2'.'9jaWFsbmV'.'0d29ya'.'w==','YWxs'.'b3dfbWljcm9ibG'.'9'.'nX2dyb3V'.'w','SUQ=','c2'.'9j'.'aW'.'FsbmV0d29y'.'a'.'w==','YW'.'xsb3d'.'f'.'b'.'Wl'.'jcm'.'9ibG9nX'.'2dyb3Vw',''.'Tg==','','','QUNU'.'SV'.'ZF','W'.'Q==','c2'.'9jaWFsbmV0d'.'29'.'yaw==','YWxsb'.'3dfZmlsZXN'.'fdXNlcg==','WQ='.'=','S'.'UQ=','c29jaWFsbmV0d29yaw'.'==','YW'.'xsb3d'.'f'.'Z'.'mlsZXNfdXN'.'lcg='.'=','SUQ'.'=','c'.'29jaWFsbmV0d29yaw'.'='.'=','YWxs'.'b3d'.'f'.'ZmlsZXNfdXNlcg==','Tg==','','',''.'QUN'.'US'.'VZF','W'.'Q==',''.'c29jaWFs'.'bmV0d2'.'9y'.'aw'.'='.'=','YWxsb'.'3dfY'.'mxvZ191c2V'.'y','WQ==',''.'SUQ'.'=','c'.'29ja'.'WFsbmV0'.'d2'.'9yaw==','YWx'.'sb'.'3df'.'Ymx'.'vZ'.'1'.'91c2Vy','S'.'UQ'.'=','c29jaWFsbmV0d'.'29ya'.'w==','YW'.'xsb3dfYmxvZ191c2Vy','Tg==','','','QUNUSVZF','W'.'Q==','c29j'.'a'.'WFsbm'.'V0d29yaw==','YW'.'xsb'.'3df'.'c'.'G'.'h'.'vdG9fdXNlcg==','WQ==','S'.'U'.'Q=','c2'.'9'.'jaWFs'.'bmV0'.'d'.'29yaw==','Y'.'W'.'xsb'.'3dfcG'.'hvdG9fdXN'.'lcg==','SUQ'.'=',''.'c29jaW'.'Fs'.'bmV0d29y'.'aw==',''.'YWx'.'sb3'.'dfcGhvd'.'G9fdXNlcg==','Tg==','','','QU'.'NU'.'SVZF','WQ==','c29ja'.'WFsbmV0d29yaw='.'=','YWxs'.'b3'.'dfZm'.'9'.'ydW1fdX'.'N'.'lcg==','WQ==',''.'SU'.'Q=','c29jaWFsbmV0'.'d29yaw='.'=','YWxsb3dfZm9ydW'.'1'.'fdXNlc'.'g'.'='.'=','S'.'U'.'Q=','c29j'.'a'.'WF'.'sbmV'.'0d29yaw='.'=','YW'.'xsb3d'.'fZm'.'9y'.'dW1'.'fdXNl'.'cg==','Tg==','','','Q'.'UN'.'USV'.'ZF','WQ==','c29jaWF'.'sbmV0d29y'.'a'.'w'.'==','YWxsb3df'.'dGFz'.'a'.'3NfdXN'.'lcg==',''.'WQ='.'=','SUQ=','c29jaW'.'FsbmV0d29yaw='.'=','YWxsb3'.'df'.'dGFza3Nfd'.'XNlcg==','SUQ'.'=','c29j'.'aW'.'Fs'.'b'.'mV0d29yaw==','YWxsb'.'3dfdGFza3Nf'.'dXN'.'l'.'cg==',''.'c2'.'9jaWFsbmV0d'.'29yaw==','YW'.'xs'.'b3'.'dfdGFza3NfZ3JvdXA'.'=','WQ==','SUQ'.'=',''.'c29'.'j'.'aWFsbmV0d29yaw==','Y'.'Wxs'.'b3dfdGFza3NfZ3JvdXA=','SUQ=','c29jaWFs'.'b'.'mV0d'.'2'.'9'.'y'.'aw==','Y'.'W'.'xsb'.'3dfd'.'GFza'.'3Nf'.'Z3'.'JvdXA'.'=','dGF'.'za3M=','Tg'.'==','','','QUN'.'U'.'SVZF','W'.'Q='.'=','c2'.'9jaWFsbmV'.'0d29ya'.'w==','YWxs'.'b3'.'df'.'Y2Fs'.'ZW5kYXJf'.'dXNlcg'.'='.'=','WQ==','SUQ=',''.'c29'.'jaW'.'F'.'sbm'.'V0d2'.'9ya'.'w='.'=','Y'.'Wx'.'sb3dfY2FsZW5kYXJfdXNl'.'c'.'g==','SUQ=',''.'c29j'.'aWFsbmV'.'0d'.'29yaw==','YW'.'xsb'.'3dfY'.'2'.'F'.'sZW5kYX'.'JfdXNlcg==',''.'c2'.'9'.'j'.'aWFsbm'.'V0d'.'29y'.'aw==',''.'Y'.'Wxsb3dfY2FsZW5kY'.'XJfZ'.'3J'.'vdXA=',''.'WQ==','S'.'UQ=','c'.'29j'.'aWFsbmV0d'.'29'.'yaw==','YWx'.'s'.'b'.'3df'.'Y2FsZW'.'5k'.'YXJf'.'Z3Jv'.'d'.'XA'.'=','SUQ=','c29jaWFsbmV'.'0d29yaw==',''.'YW'.'xsb3df'.'Y2F'.'sZW5kYXJf'.'Z3'.'J'.'vdX'.'A=','QUN'.'US'.'VZ'.'F','WQ==','Tg==','ZXh0cmFu'.'ZXQ=',''.'aWJ'.'sb'.'2Nr','T2'.'5BZn'.'R'.'lcklC'.'bG9j'.'a0VsZW1'.'lbnRVc'.'GRhdG'.'U=','aW'.'50cmF'.'uZXQ=','Q'.'0lud'.'HJhb'.'m'.'V0'.'R'.'XZlbnRIY'.'W5kbGVy'.'c'.'w==','U1BSZWd'.'pc3R'.'lclVwZGF0ZW'.'R'.'JdGVt','Q0ludHJ'.'hb'.'mV0U2hh'.'cmVwb2ludDo'.'6'.'QWdlb'.'nRMaXN'.'0c'.'ygpO'.'w'.'==','aW'.'5'.'0'.'cm'.'FuZXQ=',''.'Tg==','Q0l'.'ud'.'HJ'.'hbm'.'V'.'0U2hhc'.'mVwb2lu'.'dDo6'.'Q'.'Wdl'.'bnRRdWV1ZSg'.'pOw==','aW50cmFuZ'.'XQ=',''.'Tg='.'=','Q'.'0lu'.'dHJhb'.'mV0U2hh'.'cm'.'Vwb2l'.'ud'.'Do6Q'.'WdlbnR'.'VcGRhdGU'.'oKTs=','aW50cm'.'FuZX'.'Q=',''.'Tg==',''.'aWJsb2N'.'r','T'.'25BZnRlckl'.'CbG9ja0'.'VsZW1l'.'bn'.'RB'.'ZGQ=',''.'aW50cmFuZXQ=','Q0l'.'udHJhb'.'mV0RXZlbnRIY'.'W'.'5'.'kb'.'GV'.'ycw==','U1B'.'SZWdpc3RlclV'.'wZ'.'GF0Z'.'WRJdG'.'Vt','aWJsb2Nr','T25'.'BZnR'.'lcklCb'.'G'.'9ja0VsZW1lb'.'nRVc'.'GR'.'h'.'dG'.'U'.'=','aW'.'5'.'0cmFuZXQ=',''.'Q0ludHJ'.'hb'.'m'.'V0RXZlbnRI'.'YW'.'5kb'.'GV'.'ycw'.'==','U1BSZ'.'Wdpc'.'3R'.'lclVwZGF0Z'.'W'.'RJdGVt','Q0lu'.'d'.'HJhb'.'mV'.'0'.'U2hhcmVw'.'b2ludDo6Q'.'Wd'.'lbnR'.'M'.'aXN0'.'cygp'.'Ow'.'==','aW50cmF'.'uZXQ=','Q0ludHJhbmV0U2hhcmVwb'.'2l'.'u'.'dD'.'o6QWdlb'.'n'.'R'.'Rd'.'W'.'V1ZSgpOw==','aW5'.'0'.'cmF'.'u'.'ZXQ=','Q0lud'.'HJhbm'.'V0U2h'.'hc'.'mVw'.'b2'.'lu'.'dD'.'o6QWdlb'.'nRVcGR'.'hdGUoKT'.'s=','aW50cm'.'FuZX'.'Q=','Y3Jt','bWF'.'pbg==','T25C'.'ZWZ'.'vcmV'.'Qcm9sb2c=','bWFpbg==','Q'.'1d'.'pemFyZFNv'.'bFB'.'hbmVsSW5'.'0c'.'mFuZXQ=','U2hv'.'d1B'.'h'.'bmVs','L21'.'v'.'ZHVsZXMvaW50'.'cm'.'FuZX'.'QvcGFuZWxf'.'YnV0'.'dG'.'9uLnBocA==',''.'ZXhwaXJ'.'l'.'X21lc3My','bm9pd'.'G'.'l'.'kZ'.'V9'.'0aW1pbGVt'.'aXQ=',''.'WQ'.'==','ZH'.'Jpbl9'.'w'.'ZXJnb2'.'tj','JTAxMHM'.'K','RUVYUE'.'lS','bWFpbg='.'=','JXMlc'.'w==','YWRt','aGRyb3dzc2'.'E'.'=',''.'YWRtaW4=',''.'b'.'W9'.'kdWxl'.'cw==',''.'ZG'.'VmaW5lLnB'.'o'.'cA==','b'.'W'.'Fp'.'bg==','Yml'.'0cml4','U'.'khT'.'S'.'VRFRVg=',''.'SDR1Njd'.'m'.'aHc4N1Zo'.'eXRv'.'cw==','',''.'dG'.'h'.'S','N0h5cjEySH'.'d5M'.'H'.'JGcg'.'==',''.'VF'.'9TVEVBTA==','aHR0cHM6Ly9iaXR'.'yaXhzb2Z0'.'LmNvbS9iaXR'.'yaXgvY'.'nMucGhw','T0xE','UE'.'lSR'.'URBVEVT','RE9DVU1'.'FT'.'lRfUk9PVA='.'=','Lw==','Lw'.'==','VEVN'.'UE9'.'S'.'Q'.'VJ'.'ZX0NBQ0h'.'F','V'.'EVNUE'.'9SQVJZX0NBQ0hF','','T0'.'5fT0Q=','JXM'.'lc'.'w==',''.'X0'.'9V'.'Ul9CV'.'VM=','U0l'.'U','RURBV'.'EVNQVBFU'.'g'.'='.'=','bm9pdGlkZV90'.'aW1pbG'.'Vta'.'XQ=','bQ==','ZA='.'=','WQ'.'==','U0NSSVB'.'UX'.'05'.'BTUU=','L'.'2J'.'pd'.'HJpeC9jb'.'3Vwb2'.'5fYWN0a'.'XZhd'.'G'.'l'.'vbi'.'5waH'.'A=',''.'U0NS'.'SVB'.'UX05'.'B'.'TUU=','L'.'2JpdHJ'.'p'.'eC'.'9zZXJ2aWNl'.'cy9tY'.'Wl'.'u'.'L2'.'FqYXgucGh'.'w','L2JpdHJpe'.'C9jb3'.'Vwb25f'.'Y'.'WN0'.'aXZ'.'hdGlvbi5waHA=','U2l0'.'ZUV4cGl'.'yZUR'.'hdG'.'U=');return base64_decode($_172937330[$_1481588789]);}};$GLOBALS['____1218186634'][0](___651613785(0), ___651613785(1));class CBXFeatures{ private static $_1366893647= 30; private static $_868023753= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_602591708= null; private static $_1865056805= null; private static function __1331101077(){ if(self::$_602591708 === null){ self::$_602591708= array(); foreach(self::$_868023753 as $_702696849 => $_503796799){ foreach($_503796799 as $_1263461387) self::$_602591708[$_1263461387]= $_702696849;}} if(self::$_1865056805 === null){ self::$_1865056805= array(); $_1363789476= COption::GetOptionString(___651613785(2), ___651613785(3), ___651613785(4)); if($_1363789476 != ___651613785(5)){ $_1363789476= $GLOBALS['____1218186634'][1]($_1363789476); $_1363789476= $GLOBALS['____1218186634'][2]($_1363789476,[___651613785(6) => false]); if($GLOBALS['____1218186634'][3]($_1363789476)){ self::$_1865056805= $_1363789476;}} if(empty(self::$_1865056805)){ self::$_1865056805= array(___651613785(7) => array(), ___651613785(8) => array());}}} public static function InitiateEditionsSettings($_663356132){ self::__1331101077(); $_1602878580= array(); foreach(self::$_868023753 as $_702696849 => $_503796799){ $_520912667= $GLOBALS['____1218186634'][4]($_702696849, $_663356132); self::$_1865056805[___651613785(9)][$_702696849]=($_520912667? array(___651613785(10)): array(___651613785(11))); foreach($_503796799 as $_1263461387){ self::$_1865056805[___651613785(12)][$_1263461387]= $_520912667; if(!$_520912667) $_1602878580[]= array($_1263461387, false);}} $_2102357144= $GLOBALS['____1218186634'][5](self::$_1865056805); $_2102357144= $GLOBALS['____1218186634'][6]($_2102357144); COption::SetOptionString(___651613785(13), ___651613785(14), $_2102357144); foreach($_1602878580 as $_1119968881) self::__1876614198($_1119968881[(198*2-396)], $_1119968881[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function IsFeatureEnabled($_1263461387){ if($_1263461387 == '') return true; self::__1331101077(); if(!isset(self::$_602591708[$_1263461387])) return true; if(self::$_602591708[$_1263461387] == ___651613785(15)) $_1744065897= array(___651613785(16)); elseif(isset(self::$_1865056805[___651613785(17)][self::$_602591708[$_1263461387]])) $_1744065897= self::$_1865056805[___651613785(18)][self::$_602591708[$_1263461387]]; else $_1744065897= array(___651613785(19)); if($_1744065897[(1440/2-720)] != ___651613785(20) && $_1744065897[(984-2*492)] != ___651613785(21)){ return false;} elseif($_1744065897[(1460/2-730)] == ___651613785(22)){ if($_1744065897[round(0+1)]< $GLOBALS['____1218186634'][7]((158*2-316),(1140/2-570),(142*2-284), Date(___651613785(23)), $GLOBALS['____1218186634'][8](___651613785(24))- self::$_1366893647, $GLOBALS['____1218186634'][9](___651613785(25)))){ if(!isset($_1744065897[round(0+2)]) ||!$_1744065897[round(0+0.5+0.5+0.5+0.5)]) self::__689442882(self::$_602591708[$_1263461387]); return false;}} return!isset(self::$_1865056805[___651613785(26)][$_1263461387]) || self::$_1865056805[___651613785(27)][$_1263461387];} public static function IsFeatureInstalled($_1263461387){ if($GLOBALS['____1218186634'][10]($_1263461387) <= 0) return true; self::__1331101077(); return(isset(self::$_1865056805[___651613785(28)][$_1263461387]) && self::$_1865056805[___651613785(29)][$_1263461387]);} public static function IsFeatureEditable($_1263461387){ if($_1263461387 == '') return true; self::__1331101077(); if(!isset(self::$_602591708[$_1263461387])) return true; if(self::$_602591708[$_1263461387] == ___651613785(30)) $_1744065897= array(___651613785(31)); elseif(isset(self::$_1865056805[___651613785(32)][self::$_602591708[$_1263461387]])) $_1744065897= self::$_1865056805[___651613785(33)][self::$_602591708[$_1263461387]]; else $_1744065897= array(___651613785(34)); if($_1744065897[(920-2*460)] != ___651613785(35) && $_1744065897[(776-2*388)] != ___651613785(36)){ return false;} elseif($_1744065897[(153*2-306)] == ___651613785(37)){ if($_1744065897[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1218186634'][11](min(192,0,64), min(66,0,22),(1368/2-684), Date(___651613785(38)), $GLOBALS['____1218186634'][12](___651613785(39))- self::$_1366893647, $GLOBALS['____1218186634'][13](___651613785(40)))){ if(!isset($_1744065897[round(0+0.5+0.5+0.5+0.5)]) ||!$_1744065897[round(0+0.5+0.5+0.5+0.5)]) self::__689442882(self::$_602591708[$_1263461387]); return false;}} return true;} private static function __1876614198($_1263461387, $_1947347619){ if($GLOBALS['____1218186634'][14]("CBXFeatures", "On".$_1263461387."SettingsChange")) $GLOBALS['____1218186634'][15](array("CBXFeatures", "On".$_1263461387."SettingsChange"), array($_1263461387, $_1947347619)); $_1714810942= $GLOBALS['_____1834882463'][0](___651613785(41), ___651613785(42).$_1263461387.___651613785(43)); while($_180411508= $_1714810942->Fetch()) $GLOBALS['_____1834882463'][1]($_180411508, array($_1263461387, $_1947347619));} public static function SetFeatureEnabled($_1263461387, $_1947347619= true, $_1122317868= true){ if($GLOBALS['____1218186634'][16]($_1263461387) <= 0) return; if(!self::IsFeatureEditable($_1263461387)) $_1947347619= false; $_1947347619= (bool)$_1947347619; self::__1331101077(); $_1836167202=(!isset(self::$_1865056805[___651613785(44)][$_1263461387]) && $_1947347619 || isset(self::$_1865056805[___651613785(45)][$_1263461387]) && $_1947347619 != self::$_1865056805[___651613785(46)][$_1263461387]); self::$_1865056805[___651613785(47)][$_1263461387]= $_1947347619; $_2102357144= $GLOBALS['____1218186634'][17](self::$_1865056805); $_2102357144= $GLOBALS['____1218186634'][18]($_2102357144); COption::SetOptionString(___651613785(48), ___651613785(49), $_2102357144); if($_1836167202 && $_1122317868) self::__1876614198($_1263461387, $_1947347619);} private static function __689442882($_702696849){ if($GLOBALS['____1218186634'][19]($_702696849) <= 0 || $_702696849 == "Portal") return; self::__1331101077(); if(!isset(self::$_1865056805[___651613785(50)][$_702696849]) || self::$_1865056805[___651613785(51)][$_702696849][(918-2*459)] != ___651613785(52)) return; if(isset(self::$_1865056805[___651613785(53)][$_702696849][round(0+0.5+0.5+0.5+0.5)]) && self::$_1865056805[___651613785(54)][$_702696849][round(0+0.4+0.4+0.4+0.4+0.4)]) return; $_1602878580= array(); if(isset(self::$_868023753[$_702696849]) && $GLOBALS['____1218186634'][20](self::$_868023753[$_702696849])){ foreach(self::$_868023753[$_702696849] as $_1263461387){ if(isset(self::$_1865056805[___651613785(55)][$_1263461387]) && self::$_1865056805[___651613785(56)][$_1263461387]){ self::$_1865056805[___651613785(57)][$_1263461387]= false; $_1602878580[]= array($_1263461387, false);}} self::$_1865056805[___651613785(58)][$_702696849][round(0+0.4+0.4+0.4+0.4+0.4)]= true;} $_2102357144= $GLOBALS['____1218186634'][21](self::$_1865056805); $_2102357144= $GLOBALS['____1218186634'][22]($_2102357144); COption::SetOptionString(___651613785(59), ___651613785(60), $_2102357144); foreach($_1602878580 as $_1119968881) self::__1876614198($_1119968881[(776-2*388)], $_1119968881[round(0+0.5+0.5)]);} public static function ModifyFeaturesSettings($_663356132, $_503796799){ self::__1331101077(); foreach($_663356132 as $_702696849 => $_1596023937) self::$_1865056805[___651613785(61)][$_702696849]= $_1596023937; $_1602878580= array(); foreach($_503796799 as $_1263461387 => $_1947347619){ if(!isset(self::$_1865056805[___651613785(62)][$_1263461387]) && $_1947347619 || isset(self::$_1865056805[___651613785(63)][$_1263461387]) && $_1947347619 != self::$_1865056805[___651613785(64)][$_1263461387]) $_1602878580[]= array($_1263461387, $_1947347619); self::$_1865056805[___651613785(65)][$_1263461387]= $_1947347619;} $_2102357144= $GLOBALS['____1218186634'][23](self::$_1865056805); $_2102357144= $GLOBALS['____1218186634'][24]($_2102357144); COption::SetOptionString(___651613785(66), ___651613785(67), $_2102357144); self::$_1865056805= false; foreach($_1602878580 as $_1119968881) self::__1876614198($_1119968881[(193*2-386)], $_1119968881[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function SaveFeaturesSettings($_275146635, $_1789352302){ self::__1331101077(); $_549978615= array(___651613785(68) => array(), ___651613785(69) => array()); if(!$GLOBALS['____1218186634'][25]($_275146635)) $_275146635= array(); if(!$GLOBALS['____1218186634'][26]($_1789352302)) $_1789352302= array(); if(!$GLOBALS['____1218186634'][27](___651613785(70), $_275146635)) $_275146635[]= ___651613785(71); foreach(self::$_868023753 as $_702696849 => $_503796799){ if(isset(self::$_1865056805[___651613785(72)][$_702696849])){ $_1127822558= self::$_1865056805[___651613785(73)][$_702696849];} else{ $_1127822558=($_702696849 == ___651613785(74)? array(___651613785(75)): array(___651613785(76)));} if($_1127822558[(1260/2-630)] == ___651613785(77) || $_1127822558[(208*2-416)] == ___651613785(78)){ $_549978615[___651613785(79)][$_702696849]= $_1127822558;} else{ if($GLOBALS['____1218186634'][28]($_702696849, $_275146635)) $_549978615[___651613785(80)][$_702696849]= array(___651613785(81), $GLOBALS['____1218186634'][29]((1428/2-714),(1476/2-738),(760-2*380), $GLOBALS['____1218186634'][30](___651613785(82)), $GLOBALS['____1218186634'][31](___651613785(83)), $GLOBALS['____1218186634'][32](___651613785(84)))); else $_549978615[___651613785(85)][$_702696849]= array(___651613785(86));}} $_1602878580= array(); foreach(self::$_602591708 as $_1263461387 => $_702696849){ if($_549978615[___651613785(87)][$_702696849][(166*2-332)] != ___651613785(88) && $_549978615[___651613785(89)][$_702696849][(1352/2-676)] != ___651613785(90)){ $_549978615[___651613785(91)][$_1263461387]= false;} else{ if($_549978615[___651613785(92)][$_702696849][(171*2-342)] == ___651613785(93) && $_549978615[___651613785(94)][$_702696849][round(0+1)]< $GLOBALS['____1218186634'][33]((1500/2-750),(136*2-272),(1468/2-734), Date(___651613785(95)), $GLOBALS['____1218186634'][34](___651613785(96))- self::$_1366893647, $GLOBALS['____1218186634'][35](___651613785(97)))) $_549978615[___651613785(98)][$_1263461387]= false; else $_549978615[___651613785(99)][$_1263461387]= $GLOBALS['____1218186634'][36]($_1263461387, $_1789352302); if(!isset(self::$_1865056805[___651613785(100)][$_1263461387]) && $_549978615[___651613785(101)][$_1263461387] || isset(self::$_1865056805[___651613785(102)][$_1263461387]) && $_549978615[___651613785(103)][$_1263461387] != self::$_1865056805[___651613785(104)][$_1263461387]) $_1602878580[]= array($_1263461387, $_549978615[___651613785(105)][$_1263461387]);}} $_2102357144= $GLOBALS['____1218186634'][37]($_549978615); $_2102357144= $GLOBALS['____1218186634'][38]($_2102357144); COption::SetOptionString(___651613785(106), ___651613785(107), $_2102357144); self::$_1865056805= false; foreach($_1602878580 as $_1119968881) self::__1876614198($_1119968881[(878-2*439)], $_1119968881[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function GetFeaturesList(){ self::__1331101077(); $_2009568535= array(); foreach(self::$_868023753 as $_702696849 => $_503796799){ if(isset(self::$_1865056805[___651613785(108)][$_702696849])){ $_1127822558= self::$_1865056805[___651613785(109)][$_702696849];} else{ $_1127822558=($_702696849 == ___651613785(110)? array(___651613785(111)): array(___651613785(112)));} $_2009568535[$_702696849]= array( ___651613785(113) => $_1127822558[min(216,0,72)], ___651613785(114) => $_1127822558[round(0+0.2+0.2+0.2+0.2+0.2)], ___651613785(115) => array(),); $_2009568535[$_702696849][___651613785(116)]= false; if($_2009568535[$_702696849][___651613785(117)] == ___651613785(118)){ $_2009568535[$_702696849][___651613785(119)]= $GLOBALS['____1218186634'][39](($GLOBALS['____1218186634'][40]()- $_2009568535[$_702696849][___651613785(120)])/ round(0+28800+28800+28800)); if($_2009568535[$_702696849][___651613785(121)]> self::$_1366893647) $_2009568535[$_702696849][___651613785(122)]= true;} foreach($_503796799 as $_1263461387) $_2009568535[$_702696849][___651613785(123)][$_1263461387]=(!isset(self::$_1865056805[___651613785(124)][$_1263461387]) || self::$_1865056805[___651613785(125)][$_1263461387]);} return $_2009568535;} private static function __1183692775($_600741630, $_1518814662){ if(IsModuleInstalled($_600741630) == $_1518814662) return true; $_1768427763= $_SERVER[___651613785(126)].___651613785(127).$_600741630.___651613785(128); if(!$GLOBALS['____1218186634'][41]($_1768427763)) return false; include_once($_1768427763); $_2042479467= $GLOBALS['____1218186634'][42](___651613785(129), ___651613785(130), $_600741630); if(!$GLOBALS['____1218186634'][43]($_2042479467)) return false; $_1396529153= new $_2042479467; if($_1518814662){ if(!$_1396529153->InstallDB()) return false; $_1396529153->InstallEvents(); if(!$_1396529153->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___651613785(131))) CSearch::DeleteIndex($_600741630); UnRegisterModule($_600741630);} return true;} protected static function OnRequestsSettingsChange($_1263461387, $_1947347619){ self::__1183692775("form", $_1947347619);} protected static function OnLearningSettingsChange($_1263461387, $_1947347619){ self::__1183692775("learning", $_1947347619);} protected static function OnJabberSettingsChange($_1263461387, $_1947347619){ self::__1183692775("xmpp", $_1947347619);} protected static function OnVideoConferenceSettingsChange($_1263461387, $_1947347619){} protected static function OnBizProcSettingsChange($_1263461387, $_1947347619){ self::__1183692775("bizprocdesigner", $_1947347619);} protected static function OnListsSettingsChange($_1263461387, $_1947347619){ self::__1183692775("lists", $_1947347619);} protected static function OnWikiSettingsChange($_1263461387, $_1947347619){ self::__1183692775("wiki", $_1947347619);} protected static function OnSupportSettingsChange($_1263461387, $_1947347619){ self::__1183692775("support", $_1947347619);} protected static function OnControllerSettingsChange($_1263461387, $_1947347619){ self::__1183692775("controller", $_1947347619);} protected static function OnAnalyticsSettingsChange($_1263461387, $_1947347619){ self::__1183692775("statistic", $_1947347619);} protected static function OnVoteSettingsChange($_1263461387, $_1947347619){ self::__1183692775("vote", $_1947347619);} protected static function OnFriendsSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(132); $_105656120= CSite::GetList(___651613785(133), ___651613785(134), array(___651613785(135) => ___651613785(136))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(137), ___651613785(138), ___651613785(139), $_2127381991[___651613785(140)]) != $_1072209971){ COption::SetOptionString(___651613785(141), ___651613785(142), $_1072209971, false, $_2127381991[___651613785(143)]); COption::SetOptionString(___651613785(144), ___651613785(145), $_1072209971);}}} protected static function OnMicroBlogSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(146); $_105656120= CSite::GetList(___651613785(147), ___651613785(148), array(___651613785(149) => ___651613785(150))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(151), ___651613785(152), ___651613785(153), $_2127381991[___651613785(154)]) != $_1072209971){ COption::SetOptionString(___651613785(155), ___651613785(156), $_1072209971, false, $_2127381991[___651613785(157)]); COption::SetOptionString(___651613785(158), ___651613785(159), $_1072209971);} if(COption::GetOptionString(___651613785(160), ___651613785(161), ___651613785(162), $_2127381991[___651613785(163)]) != $_1072209971){ COption::SetOptionString(___651613785(164), ___651613785(165), $_1072209971, false, $_2127381991[___651613785(166)]); COption::SetOptionString(___651613785(167), ___651613785(168), $_1072209971);}}} protected static function OnPersonalFilesSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(169); $_105656120= CSite::GetList(___651613785(170), ___651613785(171), array(___651613785(172) => ___651613785(173))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(174), ___651613785(175), ___651613785(176), $_2127381991[___651613785(177)]) != $_1072209971){ COption::SetOptionString(___651613785(178), ___651613785(179), $_1072209971, false, $_2127381991[___651613785(180)]); COption::SetOptionString(___651613785(181), ___651613785(182), $_1072209971);}}} protected static function OnPersonalBlogSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(183); $_105656120= CSite::GetList(___651613785(184), ___651613785(185), array(___651613785(186) => ___651613785(187))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(188), ___651613785(189), ___651613785(190), $_2127381991[___651613785(191)]) != $_1072209971){ COption::SetOptionString(___651613785(192), ___651613785(193), $_1072209971, false, $_2127381991[___651613785(194)]); COption::SetOptionString(___651613785(195), ___651613785(196), $_1072209971);}}} protected static function OnPersonalPhotoSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(197); $_105656120= CSite::GetList(___651613785(198), ___651613785(199), array(___651613785(200) => ___651613785(201))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(202), ___651613785(203), ___651613785(204), $_2127381991[___651613785(205)]) != $_1072209971){ COption::SetOptionString(___651613785(206), ___651613785(207), $_1072209971, false, $_2127381991[___651613785(208)]); COption::SetOptionString(___651613785(209), ___651613785(210), $_1072209971);}}} protected static function OnPersonalForumSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(211); $_105656120= CSite::GetList(___651613785(212), ___651613785(213), array(___651613785(214) => ___651613785(215))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(216), ___651613785(217), ___651613785(218), $_2127381991[___651613785(219)]) != $_1072209971){ COption::SetOptionString(___651613785(220), ___651613785(221), $_1072209971, false, $_2127381991[___651613785(222)]); COption::SetOptionString(___651613785(223), ___651613785(224), $_1072209971);}}} protected static function OnTasksSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(225); $_105656120= CSite::GetList(___651613785(226), ___651613785(227), array(___651613785(228) => ___651613785(229))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(230), ___651613785(231), ___651613785(232), $_2127381991[___651613785(233)]) != $_1072209971){ COption::SetOptionString(___651613785(234), ___651613785(235), $_1072209971, false, $_2127381991[___651613785(236)]); COption::SetOptionString(___651613785(237), ___651613785(238), $_1072209971);} if(COption::GetOptionString(___651613785(239), ___651613785(240), ___651613785(241), $_2127381991[___651613785(242)]) != $_1072209971){ COption::SetOptionString(___651613785(243), ___651613785(244), $_1072209971, false, $_2127381991[___651613785(245)]); COption::SetOptionString(___651613785(246), ___651613785(247), $_1072209971);}} self::__1183692775(___651613785(248), $_1947347619);} protected static function OnCalendarSettingsChange($_1263461387, $_1947347619){ if($_1947347619) $_1072209971= "Y"; else $_1072209971= ___651613785(249); $_105656120= CSite::GetList(___651613785(250), ___651613785(251), array(___651613785(252) => ___651613785(253))); while($_2127381991= $_105656120->Fetch()){ if(COption::GetOptionString(___651613785(254), ___651613785(255), ___651613785(256), $_2127381991[___651613785(257)]) != $_1072209971){ COption::SetOptionString(___651613785(258), ___651613785(259), $_1072209971, false, $_2127381991[___651613785(260)]); COption::SetOptionString(___651613785(261), ___651613785(262), $_1072209971);} if(COption::GetOptionString(___651613785(263), ___651613785(264), ___651613785(265), $_2127381991[___651613785(266)]) != $_1072209971){ COption::SetOptionString(___651613785(267), ___651613785(268), $_1072209971, false, $_2127381991[___651613785(269)]); COption::SetOptionString(___651613785(270), ___651613785(271), $_1072209971);}}} protected static function OnSMTPSettingsChange($_1263461387, $_1947347619){ self::__1183692775("mail", $_1947347619);} protected static function OnExtranetSettingsChange($_1263461387, $_1947347619){ $_1396175455= COption::GetOptionString("extranet", "extranet_site", ""); if($_1396175455){ $_1662392031= new CSite; $_1662392031->Update($_1396175455, array(___651613785(272) =>($_1947347619? ___651613785(273): ___651613785(274))));} self::__1183692775(___651613785(275), $_1947347619);} protected static function OnDAVSettingsChange($_1263461387, $_1947347619){ self::__1183692775("dav", $_1947347619);} protected static function OntimemanSettingsChange($_1263461387, $_1947347619){ self::__1183692775("timeman", $_1947347619);} protected static function Onintranet_sharepointSettingsChange($_1263461387, $_1947347619){ if($_1947347619){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___651613785(276), ___651613785(277), ___651613785(278), ___651613785(279), ___651613785(280)); CAgent::AddAgent(___651613785(281), ___651613785(282), ___651613785(283), round(0+166.66666666667+166.66666666667+166.66666666667)); CAgent::AddAgent(___651613785(284), ___651613785(285), ___651613785(286), round(0+300)); CAgent::AddAgent(___651613785(287), ___651613785(288), ___651613785(289), round(0+1800+1800));} else{ UnRegisterModuleDependences(___651613785(290), ___651613785(291), ___651613785(292), ___651613785(293), ___651613785(294)); UnRegisterModuleDependences(___651613785(295), ___651613785(296), ___651613785(297), ___651613785(298), ___651613785(299)); CAgent::RemoveAgent(___651613785(300), ___651613785(301)); CAgent::RemoveAgent(___651613785(302), ___651613785(303)); CAgent::RemoveAgent(___651613785(304), ___651613785(305));}} protected static function OncrmSettingsChange($_1263461387, $_1947347619){ if($_1947347619) COption::SetOptionString("crm", "form_features", "Y"); self::__1183692775(___651613785(306), $_1947347619);} protected static function OnClusterSettingsChange($_1263461387, $_1947347619){ self::__1183692775("cluster", $_1947347619);} protected static function OnMultiSitesSettingsChange($_1263461387, $_1947347619){ if($_1947347619) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___651613785(307), ___651613785(308), ___651613785(309), ___651613785(310), ___651613785(311), ___651613785(312));} protected static function OnIdeaSettingsChange($_1263461387, $_1947347619){ self::__1183692775("idea", $_1947347619);} protected static function OnMeetingSettingsChange($_1263461387, $_1947347619){ self::__1183692775("meeting", $_1947347619);} protected static function OnXDImportSettingsChange($_1263461387, $_1947347619){ self::__1183692775("xdimport", $_1947347619);}} $_343197022= GetMessage(___651613785(313));$_1865026458= round(0+3+3+3+3+3);$GLOBALS['____1218186634'][44]($GLOBALS['____1218186634'][45]($GLOBALS['____1218186634'][46](___651613785(314))), ___651613785(315));$_68517417= round(0+1); $_1299981422= ___651613785(316); unset($_922550660); $_718404340= $GLOBALS['____1218186634'][47](___651613785(317), ___651613785(318)); $_922550660= \COption::GetOptionString(___651613785(319), $GLOBALS['____1218186634'][48](___651613785(320),___651613785(321),$GLOBALS['____1218186634'][49]($_1299981422, round(0+2), round(0+4))).$GLOBALS['____1218186634'][50](___651613785(322))); $_1285998680= array(round(0+17) => ___651613785(323), round(0+1.4+1.4+1.4+1.4+1.4) => ___651613785(324), round(0+22) => ___651613785(325), round(0+12) => ___651613785(326), round(0+0.6+0.6+0.6+0.6+0.6) => ___651613785(327)); $_2031363961= ___651613785(328); while($_922550660){ $_1226307944= ___651613785(329); $_236149497= $GLOBALS['____1218186634'][51]($_922550660); $_342889752= ___651613785(330); $_1226307944= $GLOBALS['____1218186634'][52](___651613785(331).$_1226307944,(250*2-500),-round(0+2.5+2.5)).___651613785(332); $_1719685515= $GLOBALS['____1218186634'][53]($_1226307944); $_407300846=(167*2-334); for($_1407480010= min(178,0,59.333333333333); $_1407480010<$GLOBALS['____1218186634'][54]($_236149497); $_1407480010++){ $_342889752 .= $GLOBALS['____1218186634'][55]($GLOBALS['____1218186634'][56]($_236149497[$_1407480010])^ $GLOBALS['____1218186634'][57]($_1226307944[$_407300846])); if($_407300846==$_1719685515-round(0+0.5+0.5)) $_407300846=(182*2-364); else $_407300846= $_407300846+ round(0+1);} $_68517417= $GLOBALS['____1218186634'][58]((172*2-344),(148*2-296), min(204,0,68), $GLOBALS['____1218186634'][59]($_342889752[round(0+1.2+1.2+1.2+1.2+1.2)].$_342889752[round(0+1+1+1)]), $GLOBALS['____1218186634'][60]($_342889752[round(0+1)].$_342889752[round(0+4.6666666666667+4.6666666666667+4.6666666666667)]), $GLOBALS['____1218186634'][61]($_342889752[round(0+3.3333333333333+3.3333333333333+3.3333333333333)].$_342889752[round(0+9+9)].$_342889752[round(0+7)].$_342889752[round(0+4+4+4)])); unset($_1226307944); break;} $_84258054= ___651613785(333); $GLOBALS['____1218186634'][62]($_1285998680); $_1125618597= ___651613785(334); $_2031363961= ___651613785(335).$GLOBALS['____1218186634'][63]($_2031363961.___651613785(336), round(0+0.4+0.4+0.4+0.4+0.4),-round(0+0.5+0.5));@include($_SERVER[___651613785(337)].___651613785(338).$GLOBALS['____1218186634'][64](___651613785(339), $_1285998680)); $_532485798= round(0+0.66666666666667+0.66666666666667+0.66666666666667); while($GLOBALS['____1218186634'][65](___651613785(340))){ $_637905490= $GLOBALS['____1218186634'][66]($GLOBALS['____1218186634'][67](___651613785(341))); $_324446247= ___651613785(342); $_84258054= $GLOBALS['____1218186634'][68](___651613785(343)).$GLOBALS['____1218186634'][69](___651613785(344),$_84258054,___651613785(345)); $_587465261= $GLOBALS['____1218186634'][70]($_84258054); $_407300846=(152*2-304); for($_1407480010=(774-2*387); $_1407480010<$GLOBALS['____1218186634'][71]($_637905490); $_1407480010++){ $_324446247 .= $GLOBALS['____1218186634'][72]($GLOBALS['____1218186634'][73]($_637905490[$_1407480010])^ $GLOBALS['____1218186634'][74]($_84258054[$_407300846])); if($_407300846==$_587465261-round(0+0.33333333333333+0.33333333333333+0.33333333333333)) $_407300846=(203*2-406); else $_407300846= $_407300846+ round(0+0.25+0.25+0.25+0.25);} $_532485798= $GLOBALS['____1218186634'][75]((1012/2-506),(222*2-444),(1480/2-740), $GLOBALS['____1218186634'][76]($_324446247[round(0+3+3)].$_324446247[round(0+8+8)]), $GLOBALS['____1218186634'][77]($_324446247[round(0+9)].$_324446247[round(0+0.4+0.4+0.4+0.4+0.4)]), $GLOBALS['____1218186634'][78]($_324446247[round(0+4+4+4)].$_324446247[round(0+3.5+3.5)].$_324446247[round(0+4.6666666666667+4.6666666666667+4.6666666666667)].$_324446247[round(0+1+1+1)])); unset($_84258054); break;} $_718404340= ___651613785(346).$GLOBALS['____1218186634'][79]($GLOBALS['____1218186634'][80]($_718404340, round(0+1.5+1.5),-round(0+0.25+0.25+0.25+0.25)).___651613785(347), round(0+0.33333333333333+0.33333333333333+0.33333333333333),-round(0+1.6666666666667+1.6666666666667+1.6666666666667));while(!$GLOBALS['____1218186634'][81]($GLOBALS['____1218186634'][82]($GLOBALS['____1218186634'][83](___651613785(348))))){function __f($_168274422){return $_168274422+__f($_168274422);}__f(round(0+0.5+0.5));};for($_1407480010=(1040/2-520),$_1057289836=($GLOBALS['____1218186634'][84]()< $GLOBALS['____1218186634'][85](min(18,0,6),min(136,0,45.333333333333),min(68,0,22.666666666667),round(0+1.25+1.25+1.25+1.25),round(0+0.2+0.2+0.2+0.2+0.2),round(0+504.5+504.5+504.5+504.5)) || $_68517417 <= round(0+2+2+2+2+2)),$_1811716015=($_68517417< $GLOBALS['____1218186634'][86](min(172,0,57.333333333333),min(242,0,80.666666666667),min(62,0,20.666666666667),Date(___651613785(349)),$GLOBALS['____1218186634'][87](___651613785(350))-$_1865026458,$GLOBALS['____1218186634'][88](___651613785(351)))),$_70374237=($_SERVER[___651613785(352)]!==___651613785(353)&&$_SERVER[___651613785(354)]!==___651613785(355)); $_1407480010< round(0+2+2+2+2+2),($_1057289836 || $_1811716015 || $_68517417 != $_532485798) && $_70374237; $_1407480010++,LocalRedirect(___651613785(356)),exit,$GLOBALS['_____1834882463'][2]($_343197022));$GLOBALS['____1218186634'][89]($_2031363961, $_68517417); $GLOBALS['____1218186634'][90]($_718404340, $_532485798); $GLOBALS[___651613785(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

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

/*ZDUyZmZNWY0YmYwMzM3ODlkZDBhYzVmOWVjZmNlY2RjZDg5YTY=*/$GLOBALS['____1490840880']= array(base64_decode('bXRfc'.'mF'.'u'.'Z'.'A=='),base64_decode(''.'Y2FsbF91c'.'2V'.'yX'.'2Z'.'1'.'b'.'mM='),base64_decode('c3R'.'ycG9z'),base64_decode('ZX'.'hwbG'.'9kZQ='.'='),base64_decode(''.'cGFj'.'a'.'w=='),base64_decode('bW'.'Q1'),base64_decode('Y29uc3RhbnQ'.'='),base64_decode('a'.'GFzaF'.'9obWF'.'j'),base64_decode('c3RyY21'.'w'),base64_decode(''.'Y'.'2'.'F'.'s'.'b'.'F'.'91c2VyX2'.'Z1bmM='),base64_decode('Y2FsbF91'.'c2VyX2'.'Z1bmM='),base64_decode('aXNfb2JqZWN0'),base64_decode('Y2Fsb'.'F91c'.'2VyX2'.'Z1'.'bmM='),base64_decode('Y2Fsb'.'F91c2VyX'.'2Z1b'.'m'.'M'.'='),base64_decode(''.'Y2Fsb'.'F'.'91c2V'.'yX2Z1bmM='),base64_decode('Y'.'2FsbF91c2V'.'yX2Z'.'1b'.'mM='),base64_decode(''.'Y'.'2FsbF9'.'1'.'c2V'.'yX2Z1bmM='),base64_decode(''.'Y2'.'FsbF'.'91c'.'2VyX2Z'.'1bmM'.'='),base64_decode('ZGVmaW5lZ'.'A=='),base64_decode('c3RybGVu'));if(!function_exists(__NAMESPACE__.'\\___224180879')){function ___224180879($_407528254){static $_1308990119= false; if($_1308990119 == false) $_1308990119=array('XENPcHRp'.'b246'.'OkdldE9'.'wdGlvblN0c'.'m'.'luZ'.'w'.'==','bWFpbg='.'=','flBB'.'UkF'.'NX01'.'BWF9VU0VSUw'.'==','Lg==','Lg='.'=','SCo'.'=','Y'.'ml0cml4','TEl'.'DRU5TR'.'V'.'9'.'LRV'.'k'.'=',''.'c'.'2'.'hhMjU2','X'.'ENPcH'.'R'.'pb246Okdld'.'E9wdGlvblN'.'0'.'c'.'m'.'lu'.'Zw'.'==','bWFpbg'.'==',''.'UEFSQ'.'U'.'1fTUFYX1VTRVJT','XE'.'J'.'pdHJpeF'.'xNYWlu'.'XENvbmZpZ'.'1xPcH'.'Rpb246On'.'NldA'.'==','bW'.'F'.'pbg==','UEFSQU1fTUFY'.'X1'.'VTRVJ'.'T','V'.'VNF'.'Ug'.'==',''.'V'.'VNFUg='.'=','VVNF'.'Ug'.'==','SXN'.'BdXRo'.'b3Jpe'.'mVk','VVNFUg='.'=','SXNBZG1pbg==',''.'QV'.'BQTElDQVRJT'.'0'.'4=','U'.'mVzdGFydEJ1Z'.'mZlc'.'g'.'==','TG9'.'jYWxS'.'ZW'.'RpcmVjd'.'A==','L2xp'.'Y'.'2Vuc2V'.'fc'.'mV'.'zdHJ'.'pY'.'3Rpb24ucG'.'hw','XEN'.'PcHRp'.'b2'.'46Okdl'.'dE9wdGlvblN0cm'.'luZw'.'==','bWF'.'pbg='.'=','UEFSQU1fTUFYX1VTRVJT','XEJpdHJpeFxNYWlu'.'X'.'ENvbmZpZ1xPcHRpb246OnNld'.'A==','bWFpbg==','UEF'.'SQU1fTUF'.'Y'.'X1VTR'.'VJT','T0xEU0l'.'URUVY'.'UE'.'l'.'SRURB'.'V'.'E'.'U=','Z'.'XhwaXJlX21lc'.'3M'.'y');return base64_decode($_1308990119[$_407528254]);}};if($GLOBALS['____1490840880'][0](round(0+0.5+0.5), round(0+20)) == round(0+3.5+3.5)){ $_961890622= $GLOBALS['____1490840880'][1](___224180879(0), ___224180879(1), ___224180879(2)); if(!empty($_961890622) && $GLOBALS['____1490840880'][2]($_961890622, ___224180879(3)) !== false){ list($_474530354, $_583169308)= $GLOBALS['____1490840880'][3](___224180879(4), $_961890622); $_1013331817= $GLOBALS['____1490840880'][4](___224180879(5), $_474530354); $_1908147309= ___224180879(6).$GLOBALS['____1490840880'][5]($GLOBALS['____1490840880'][6](___224180879(7))); $_262629335= $GLOBALS['____1490840880'][7](___224180879(8), $_583169308, $_1908147309, true); if($GLOBALS['____1490840880'][8]($_262629335, $_1013331817) !== min(158,0,52.666666666667)){ if($GLOBALS['____1490840880'][9](___224180879(9), ___224180879(10), ___224180879(11)) != round(0+2.4+2.4+2.4+2.4+2.4)){ $GLOBALS['____1490840880'][10](___224180879(12), ___224180879(13), ___224180879(14), round(0+2.4+2.4+2.4+2.4+2.4));} if(isset($GLOBALS[___224180879(15)]) && $GLOBALS['____1490840880'][11]($GLOBALS[___224180879(16)]) && $GLOBALS['____1490840880'][12](array($GLOBALS[___224180879(17)], ___224180879(18))) &&!$GLOBALS['____1490840880'][13](array($GLOBALS[___224180879(19)], ___224180879(20)))){ $GLOBALS['____1490840880'][14](array($GLOBALS[___224180879(21)], ___224180879(22))); $GLOBALS['____1490840880'][15](___224180879(23), ___224180879(24), true);}}} else{ if($GLOBALS['____1490840880'][16](___224180879(25), ___224180879(26), ___224180879(27)) != round(0+4+4+4)){ $GLOBALS['____1490840880'][17](___224180879(28), ___224180879(29), ___224180879(30), round(0+6+6));}}} while(!$GLOBALS['____1490840880'][18](___224180879(31)) || $GLOBALS['____1490840880'][19](OLDSITEEXPIREDATE) <=(1200/2-600) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___224180879(32)));/**/       //Do not remove this
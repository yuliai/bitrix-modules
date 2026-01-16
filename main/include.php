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

/*ZDUyZmZOWY4M2RhZGY1NDJiMTNhYTcwZjA2M2M2YTI2YzA5ZGE=*/$GLOBALS['_____1406059044']= array(base64_decode('R2V'.'0TW9'.'kdWx'.'lRXZl'.'bnR'.'z'),base64_decode('RXh'.'lY3V0ZU1v'.'ZHVsZUV2ZW50RXg='),base64_decode('V3J'.'pdGVG'.'aW5h'.'bE'.'1lc'.'3N'.'hZ2'.'U='));$GLOBALS['____1770890717']= array(base64_decode('Z'.'GVmaW5l'),base64_decode('YmFzZT'.'Y'.'0X2Rl'.'Y29kZQ=='),base64_decode('dW5zZXJpYW'.'xpe'.'mU='),base64_decode('aX'.'N'.'fY'.'XJyY'.'Xk'.'='),base64_decode('a'.'W'.'5'.'fY'.'XJy'.'Y'.'Xk='),base64_decode('c2V'.'yaWFs'.'aXpl'),base64_decode('YmFzZTY0X2VuY29kZQ=='),base64_decode('b'.'Wt0aW'.'1l'),base64_decode('ZGF0ZQ'.'=='),base64_decode('ZGF0ZQ'.'=='),base64_decode('c3RybGVu'),base64_decode('bWt0aW'.'1l'),base64_decode('Z'.'GF0ZQ='.'='),base64_decode('Z'.'G'.'F0Z'.'Q=='),base64_decode('b'.'WV0aG9kX2V'.'4aXN0c'.'w=='),base64_decode('Y2FsbF9'.'1'.'c2VyX2Z1b'.'mNfYXJyYXk'.'='),base64_decode('c3RybGV'.'u'),base64_decode('c2Vy'.'a'.'WFsaXpl'),base64_decode('YmFzZTY'.'0X'.'2VuY29kZQ=='),base64_decode('c3RybGV'.'u'),base64_decode('aX'.'NfYXJ'.'yYXk'.'='),base64_decode(''.'c'.'2V'.'yaW'.'FsaXpl'),base64_decode('YmFz'.'ZT'.'Y0'.'X2'.'VuY2'.'9kZQ'.'=='),base64_decode('c2VyaWFsaXpl'),base64_decode('Ym'.'FzZ'.'TY0X2'.'Vu'.'Y'.'29kZQ='.'='),base64_decode('aXN'.'f'.'YXJyYXk'.'='),base64_decode('a'.'XNf'.'Y'.'XJyY'.'Xk='),base64_decode(''.'a'.'W5'.'fYXJyYXk'.'='),base64_decode('aW5f'.'YXJyYXk='),base64_decode('bWt0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF'.'0ZQ=='),base64_decode('Z'.'GF'.'0Z'.'Q=='),base64_decode('bW'.'t0aW'.'1'.'l'),base64_decode('ZGF0ZQ=='),base64_decode('ZG'.'F0ZQ'.'=='),base64_decode('a'.'W'.'5fYXJyYXk='),base64_decode(''.'c2VyaWFsaXpl'),base64_decode('Y'.'mFzZTY'.'0X2VuY2'.'9kZQ=='),base64_decode('aW50dmFs'),base64_decode(''.'dG'.'ltZ'.'Q=='),base64_decode('ZmlsZV'.'9'.'leG'.'lzd'.'HM='),base64_decode(''.'c3RyX3J'.'lcGxh'.'Y2U='),base64_decode('Y2xhc3NfZX'.'h'.'pc3R'.'z'),base64_decode('ZGVm'.'a'.'W5l'),base64_decode(''.'c3RycmV2'),base64_decode('c'.'3R'.'ydG9'.'1cHBl'.'c'.'g'.'=='),base64_decode('c3By'.'aW'.'5'.'0'.'Zg=='),base64_decode('c3B'.'ya'.'W5'.'0Z'.'g=='),base64_decode(''.'c3V'.'ic3'.'Ry'),base64_decode('c'.'3Ryc'.'mV2'),base64_decode('Ym'.'FzZT'.'Y'.'0X2RlY29'.'kZQ=='),base64_decode('c3V'.'ic3Ry'),base64_decode(''.'c3RybGVu'),base64_decode('c3RybGV'.'u'),base64_decode('Y2hy'),base64_decode(''.'b3Jk'),base64_decode('b3Jk'),base64_decode(''.'b'.'Wt'.'0aW'.'1l'),base64_decode('aW50dmFs'),base64_decode('aW5'.'0dmF'.'s'),base64_decode(''.'a'.'W50dmFs'),base64_decode(''.'a3'.'NvcnQ='),base64_decode('c'.'3Vic3Ry'),base64_decode('a'.'W'.'1'.'wbG9kZQ'.'='.'='),base64_decode('ZGVm'.'aW5'.'lZA'.'=='),base64_decode(''.'YmFzZT'.'Y0X'.'2RlY29'.'kZQ='.'='),base64_decode('Y2'.'9uc3RhbnQ'.'='),base64_decode('c'.'3R'.'ycmV2'),base64_decode('c3ByaW50Zg=='),base64_decode('c3R'.'ybG'.'Vu'),base64_decode('c3RybGVu'),base64_decode('Y'.'2hy'),base64_decode('b3J'.'k'),base64_decode('b'.'3J'.'k'),base64_decode(''.'b'.'Wt'.'0'.'a'.'W1l'),base64_decode('aW50dmFs'),base64_decode('aW5'.'0dmFs'),base64_decode('aW'.'50dm'.'Fs'),base64_decode('c'.'3Vi'.'c3Ry'),base64_decode('c3'.'Vic3Ry'),base64_decode('ZGVmaW5lZ'.'A=='),base64_decode('c3'.'RycmV2'),base64_decode('c3RydG91c'.'HB'.'l'.'cg'.'=='),base64_decode('dGl'.'tZQ'.'=='),base64_decode('bWt'.'0aW1'.'l'),base64_decode('bWt0aW'.'1'.'l'),base64_decode(''.'ZGF0ZQ'.'=='),base64_decode(''.'Z'.'GF0ZQ=='),base64_decode('ZGVm'.'a'.'W5l'),base64_decode(''.'ZGVmaW'.'5'.'l'));if(!function_exists(__NAMESPACE__.'\\___1712904686')){function ___1712904686($_29536308){static $_1838703885= false; if($_1838703885 == false) $_1838703885=array('SU5UUkFORV'.'Rf'.'R'.'U'.'RJVElPTg==',''.'W'.'Q==','bWFpbg==','fmN'.'wZl9tYX'.'B'.'fdm'.'FsdWU=','','',''.'YWx'.'sb3'.'dlZF9jbGFzc'.'2'.'Vz','ZQ==',''.'Zg==','ZQ==','Rg==','WA==',''.'Zg='.'=','b'.'WFpbg==',''.'fmNwZl9'.'tY'.'XBfdm'.'Fs'.'dWU'.'=',''.'UG'.'9yd'.'GFs','Rg='.'=','ZQ==','ZQ==','WA='.'=','R'.'g==','RA='.'=',''.'RA==',''.'bQ==','ZA='.'=','WQ==',''.'Zg='.'=','Zg==','Zg==',''.'Zg'.'='.'=','UG9'.'y'.'dGF'.'s','Rg'.'==','ZQ==','ZQ==','WA==','Rg==','R'.'A==','RA==',''.'bQ'.'==','ZA==','WQ'.'==','bW'.'Fp'.'bg==','T24=',''.'U2V'.'0d'.'GluZ'.'3N'.'DaGFuZ2U=','Zg==','Zg==','Zg==','Zg==','bW'.'Fpbg==','fmN'.'wZl9'.'tYXBf'.'dm'.'FsdW'.'U=','ZQ==','Z'.'Q==','RA==','ZQ==','ZQ='.'=','Zg==','Z'.'g==','Z'.'g==',''.'Z'.'Q==','bWFpbg='.'=','fmN'.'w'.'Z'.'l9tYXB'.'fdmFsdWU=','ZQ==','Z'.'g==',''.'Zg'.'==',''.'Zg==','Zg==','b'.'WF'.'pb'.'g='.'=','fmNwZl9tYXB'.'fdmF'.'sdWU=',''.'Z'.'Q==','Zg'.'='.'=','UG9ydGFs','UG9'.'y'.'dGFs','Z'.'Q==','ZQ==','UG9ydGFs','Rg'.'='.'=','WA==',''.'Rg==','RA'.'==','Z'.'Q'.'='.'=','Z'.'Q==','RA'.'==',''.'bQ==','Z'.'A==',''.'W'.'Q'.'==','ZQ'.'==','WA='.'=','ZQ==','Rg==','Z'.'Q==','RA==','Zg==','ZQ==','RA==','ZQ==','bQ==',''.'ZA==','WQ==',''.'Z'.'g==','Zg==','Z'.'g==','Z'.'g==','Zg='.'=','Zg'.'==','Z'.'g'.'==','Z'.'g'.'==','bWFpb'.'g==','fmNwZl'.'9tY'.'XBfdmFs'.'dWU=','Z'.'Q==','Z'.'Q==','U'.'G9yd'.'G'.'F'.'s','R'.'g='.'=','W'.'A==','V'.'FlQRQ'.'='.'=',''.'REFU'.'R'.'Q==','R'.'kVBVFVSR'.'VM=','R'.'V'.'hQ'.'SVJFRA='.'=',''.'VFlQ'.'R'.'Q==','RA==','VFJZX0RBWVNfQ0'.'9VTlQ'.'=','REFUR'.'Q'.'==','VFJ'.'ZX0RBWVN'.'fQ0'.'9VT'.'lQ'.'=','RVhQ'.'S'.'VJFRA==','RkVB'.'VFVSR'.'VM=','Zg==',''.'Zg==','RE9DVU1FTlRfUk9PVA==','L2JpdHJpeC'.'9tb2'.'R1b'.'G'.'VzLw='.'=','L'.'2l'.'u'.'c3'.'R'.'hbGw'.'va'.'W'.'5'.'kZXgucGhw','Lg'.'==','Xw==','c2'.'VhcmNo','Tg='.'=','','','QUNUSVZF','WQ'.'==','c'.'29ja'.'WFsbmV'.'0d29'.'yaw==','YW'.'x'.'sb3d'.'f'.'ZnJpZW'.'xkc'.'w==',''.'WQ='.'=','SUQ=',''.'c29j'.'aWFsbmV0'.'d29'.'yaw==','YWxsb'.'3dfZnJp'.'ZWxkc'.'w='.'=',''.'SUQ=','c29'.'jaW'.'Fsb'.'mV0d29ya'.'w==','Y'.'W'.'xsb3dfZn'.'J'.'pZW'.'x'.'k'.'cw==','Tg'.'==','','','QU'.'NU'.'S'.'VZF','W'.'Q==','c29jaWF'.'sbmV'.'0d2'.'9yaw'.'='.'=','Y'.'Wxsb3dfbWljcm9ibG'.'9nX3'.'Vz'.'ZXI'.'=','WQ==','SU'.'Q=','c29ja'.'WF'.'sbmV0d2'.'9y'.'aw==','YWxsb3'.'d'.'fbWljcm9ibG9'.'nX3V'.'zZX'.'I=','SUQ=','c29'.'ja'.'WFsbmV0d29yaw==','YWxsb3d'.'fbWljcm9ibG9nX3V'.'zZX'.'I=','c2'.'9jaW'.'F'.'sb'.'mV0d29'.'yaw==','YW'.'x'.'sb3df'.'bWljc'.'m9i'.'b'.'G9'.'nX2dyb'.'3Vw','WQ'.'==','SUQ=','c29'.'jaWFsbmV0d29y'.'aw==','YWxsb3dfbWl'.'jcm9ibG9'.'nX2dyb3V'.'w',''.'SU'.'Q=','c29'.'j'.'aWFsbm'.'V'.'0'.'d2'.'9yaw==','YWx'.'sb3dfb'.'W'.'ljcm9'.'ibG9nX2dyb3Vw','Tg==','','','Q'.'UNUSV'.'ZF','WQ==','c29jaWFsb'.'mV0d29yaw==','YWxs'.'b3d'.'fZ'.'m'.'lsZXN'.'fdXNlcg='.'=','WQ==','SUQ=',''.'c2'.'9jaWFsbm'.'V0d29yaw==','YWx'.'sb3dfZmlsZXNf'.'dXNlc'.'g==','SUQ=','c29j'.'aWFsbmV0d2'.'9'.'ya'.'w==','YW'.'xs'.'b3'.'dfZ'.'mlsZXNfdXNlcg==','Tg='.'=','','','QUNUSVZF','WQ==','c'.'29jaW'.'Fs'.'b'.'mV0d2'.'9yaw'.'==','YWx'.'sb3dfYmxvZ191c2Vy','WQ'.'==','SUQ=','c29jaWFsbmV'.'0d2'.'9'.'yaw==','YWxs'.'b3'.'df'.'YmxvZ191'.'c2Vy',''.'S'.'UQ=','c29jaW'.'FsbmV0d2'.'9yaw='.'=',''.'YWxsb'.'3dfY'.'mxvZ191c2'.'Vy','Tg==','','','QUNUSV'.'ZF','WQ==','c29jaWFsb'.'mV'.'0d29yaw='.'=','YWxsb3dfcGhvdG9f'.'dX'.'Nlcg==','WQ'.'==','SUQ=','c29'.'jaWFsb'.'m'.'V0d'.'29yaw='.'=',''.'YWxsb3'.'dfcGhvdG'.'9fdXN'.'lcg==','SUQ'.'=','c29ja'.'W'.'FsbmV0d29yaw'.'='.'=','Y'.'Wxs'.'b3df'.'cGhvdG9fdXN'.'l'.'cg'.'==','Tg'.'='.'=','','',''.'Q'.'UNUS'.'VZF','W'.'Q==','c29jaW'.'F'.'sbmV0d29'.'yaw==','YW'.'x'.'s'.'b3dfZ'.'m9y'.'d'.'W1fdX'.'Nlcg='.'=','WQ==','SUQ'.'=','c2'.'9jaWFsbm'.'V'.'0d29yaw==','YWx'.'sb3'.'dfZm9yd'.'W1fdX'.'Nlcg==','SU'.'Q'.'=','c'.'29j'.'aWFsbmV'.'0d29yaw'.'==','YWxsb'.'3df'.'Zm'.'9ydW'.'1fdXNlcg'.'==','Tg==','','','QUNUS'.'VZ'.'F','W'.'Q==',''.'c29'.'jaWF'.'sbmV0d'.'2'.'9yaw==','YWxsb3dfdG'.'Fza3Nf'.'dXN'.'lcg==','WQ==','SUQ'.'=','c29jaW'.'F'.'sb'.'mV0'.'d2'.'9ya'.'w='.'=','YWxsb3dfdGFza3'.'NfdXN'.'lcg==','SUQ=','c29jaWFs'.'bmV0d29yaw==',''.'YW'.'xsb3dfdG'.'F'.'za3N'.'fdXNl'.'cg==',''.'c29j'.'aWF'.'sbmV0d29y'.'aw==','Y'.'Wx'.'s'.'b3dfdGF'.'za3NfZ3JvdXA=','WQ==','S'.'U'.'Q'.'=',''.'c'.'2'.'9jaWFsbmV0d2'.'9y'.'a'.'w==','YWxsb'.'3d'.'fdGFza3Nf'.'Z3'.'JvdXA=','SUQ=','c29jaW'.'FsbmV0d2'.'9yaw==','YWxsb3dfd'.'GFza3NfZ3'.'JvdXA=','dGFza'.'3M=','Tg'.'==','','','Q'.'U'.'N'.'US'.'VZF','WQ==','c29jaWF'.'sbmV0'.'d29ya'.'w'.'==',''.'YWxsb3df'.'Y'.'2FsZW5k'.'YX'.'J'.'fd'.'X'.'Nlcg==','WQ==','SUQ=','c'.'29'.'jaWFsb'.'m'.'V0d29'.'y'.'aw==','YWxsb3'.'dfY'.'2Fs'.'ZW'.'5'.'kYXJfd'.'XNlcg'.'='.'=','SUQ=','c2'.'9j'.'aW'.'Fs'.'bmV0d29yaw==','YWx'.'sb3dfY2FsZW5kY'.'X'.'JfdXNlc'.'g==','c'.'29jaWF'.'s'.'bmV0'.'d29yaw==','YWxsb3'.'dfY2Fs'.'ZW5k'.'YX'.'JfZ3Jv'.'dXA=','WQ==','SUQ=','c29jaWFsb'.'mV0'.'d29yaw'.'='.'=','YWxsb3d'.'f'.'Y2F'.'s'.'ZW5k'.'YX'.'JfZ3'.'Jv'.'dXA'.'=','SUQ=','c29jaWF'.'s'.'bmV0d29'.'yaw==','YWx'.'sb3df'.'Y2FsZ'.'W5kYXJfZ3Jv'.'d'.'X'.'A=','QUNUS'.'VZF','WQ='.'=','T'.'g'.'==','ZXh0cmFuZXQ'.'=','aWJs'.'b'.'2Nr','T25BZn'.'R'.'l'.'cklC'.'bG9ja'.'0Vs'.'ZW1lb'.'n'.'RVcGRhdGU=',''.'aW50c'.'m'.'FuZXQ=','Q0l'.'u'.'dH'.'Jh'.'bmV0RXZlbn'.'RIY'.'W5k'.'bG'.'Vycw==','U'.'1BS'.'Z'.'Wdpc3RlclVwZGF'.'0Z'.'W'.'R'.'Jd'.'GVt',''.'Q0lud'.'HJh'.'bmV'.'0U'.'2'.'hhcm'.'Vwb2ludDo6QWdlbn'.'R'.'MaX'.'N0cygpOw==','aW50c'.'mFuZXQ'.'=','T'.'g='.'=','Q'.'0l'.'udHJhb'.'mV0U2'.'h'.'hcm'.'Vwb2l'.'udDo6'.'QWdlbn'.'RRdWV1ZS'.'gp'.'Ow==','aW50cmFuZXQ'.'=','Tg==','Q'.'0ludH'.'Jh'.'bmV0'.'U'.'2'.'hhcmVwb2ludD'.'o6'.'QWdl'.'bnRVcGRhd'.'G'.'UoKTs=','aW'.'50c'.'mFuZXQ'.'=','Tg'.'==',''.'aWJsb2Nr',''.'T25B'.'ZnRlcklC'.'bG9'.'j'.'a'.'0'.'VsZ'.'W1lbn'.'RB'.'Z'.'GQ=','aW'.'50'.'cmFuZXQ=','Q0'.'l'.'udHJ'.'hbm'.'V0R'.'X'.'ZlbnRIY'.'W'.'5k'.'bGVycw'.'==','U1BS'.'Z'.'W'.'dpc3RlclV'.'w'.'Z'.'GF0ZWRJdGVt','aWJsb'.'2'.'Nr','T'.'25'.'BZnRlc'.'klCbG9ja0VsZW1lbnR'.'VcGR'.'hdGU=','aW50'.'cmFuZXQ=','Q'.'0'.'ludHJhb'.'mV'.'0RX'.'ZlbnRIYW5'.'kb'.'GVycw==',''.'U'.'1BSZWdp'.'c3Rlc'.'lVwZ'.'GF0'.'ZWRJdGVt','Q0ludH'.'J'.'hbmV0U2hhc'.'mVwb2lu'.'dD'.'o6QWdlb'.'nRMaXN0cygp'.'O'.'w==','aW5'.'0'.'cm'.'FuZXQ=','Q0l'.'u'.'d'.'HJhbmV0U'.'2hhc'.'mVwb2ludDo6Q'.'Wdl'.'bnRRdW'.'V'.'1ZSgp'.'O'.'w==','aW50cmFuZ'.'XQ=','Q0lu'.'dHJ'.'h'.'bmV0U2hhcmVwb2ludDo6QWdlbnRVcGRhdGU'.'o'.'KT'.'s=','a'.'W50cm'.'FuZXQ=','Y3Jt','bW'.'F'.'p'.'b'.'g='.'=','T25CZWZvc'.'mVQ'.'cm'.'9'.'sb'.'2'.'c=','bW'.'Fpb'.'g==',''.'Q1'.'dpemFyZFN'.'vb'.'FBhbmVsS'.'W50'.'c'.'mF'.'uZXQ=','U2'.'hvd1BhbmVs',''.'L21'.'vZHVsZ'.'X'.'Mv'.'aW50cmF'.'uZX'.'QvcGFuZWx'.'fYnV0dG9uLnBocA='.'=','ZXhwaXJlX21lc3'.'My','bm9pdGl'.'kZV90'.'a'.'W1pbGVt'.'aXQ'.'=','WQ==','ZH'.'Jpbl'.'9wZXJn'.'b2tj','J'.'TAxMHMK','RUVY'.'U'.'ElS','bWFp'.'bg'.'='.'=','J'.'X'.'Mlcw='.'=','YWRt',''.'aG'.'Ryb'.'3dzc2E=','YWRtaW'.'4=',''.'bW9kdW'.'xlcw='.'=','ZGV'.'ma'.'W5lLnBoc'.'A==','bWFpb'.'g'.'==','Ym'.'l'.'0cml4','UkhTSVR'.'FR'.'Vg=','SDR1NjdmaHc4N1Zoe'.'X'.'Rvcw==','','dGhS','N0h5'.'cjEySHd'.'5MHJGcg'.'==','VF9TVEV'.'B'.'T'.'A==','aH'.'R0cHM6Ly9i'.'aXRya'.'Xhzb'.'2Z'.'0LmN'.'vb'.'S9'.'iaXRya'.'X'.'g'.'vY'.'nMucGhw','T0x'.'E','UElSRURBV'.'EVT','RE9'.'DVU1'.'FTlR'.'fUk9PVA'.'==','Lw==','Lw==','V'.'EVN'.'UE9SQ'.'VJZ'.'X0'.'NB'.'Q0hF','VE'.'VNUE'.'9'.'SQVJZX0'.'NB'.'Q0hF','','T05fT'.'0'.'Q=','JX'.'Mlcw='.'=','X0'.'9V'.'Ul9CV'.'VM=','U0lU','RURBVEVNQ'.'V'.'BFUg'.'==','bm9pdGl'.'kZV'.'90aW1p'.'bGVtaXQ=',''.'bQ==','ZA==',''.'W'.'Q==','U0'.'NS'.'S'.'VBUX05BTUU=','L'.'2Jpd'.'HJpe'.'C9jb3V'.'wb2'.'5fYWN0'.'aXZhdGlvbi'.'5waHA=','U0NSSVB'.'U'.'X05BT'.'UU=','L2'.'JpdHJpeC9'.'zZXJ'.'2aWNlcy9'.'tYW'.'luL2FqYXgucGhw','L2Jp'.'d'.'HJpeC'.'9'.'jb3Vwb2'.'5'.'fY'.'W'.'N0aXZhd'.'G'.'lvbi5'.'waH'.'A=','U'.'2l0'.'ZUV'.'4cGly'.'Z'.'URhdGU=');return base64_decode($_1838703885[$_29536308]);}};$GLOBALS['____1770890717'][0](___1712904686(0), ___1712904686(1));class CBXFeatures{ private static $_53779437= 30; private static $_2080760592= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_159126445= null; private static $_883005373= null; private static function __2223194(){ if(self::$_159126445 === null){ self::$_159126445= array(); foreach(self::$_2080760592 as $_295201129 => $_896698961){ foreach($_896698961 as $_249488129) self::$_159126445[$_249488129]= $_295201129;}} if(self::$_883005373 === null){ self::$_883005373= array(); $_2125625690= COption::GetOptionString(___1712904686(2), ___1712904686(3), ___1712904686(4)); if($_2125625690 != ___1712904686(5)){ $_2125625690= $GLOBALS['____1770890717'][1]($_2125625690); $_2125625690= $GLOBALS['____1770890717'][2]($_2125625690,[___1712904686(6) => false]); if($GLOBALS['____1770890717'][3]($_2125625690)){ self::$_883005373= $_2125625690;}} if(empty(self::$_883005373)){ self::$_883005373= array(___1712904686(7) => array(), ___1712904686(8) => array());}}} public static function InitiateEditionsSettings($_1797480457){ self::__2223194(); $_152553645= array(); foreach(self::$_2080760592 as $_295201129 => $_896698961){ $_1926486062= $GLOBALS['____1770890717'][4]($_295201129, $_1797480457); self::$_883005373[___1712904686(9)][$_295201129]=($_1926486062? array(___1712904686(10)): array(___1712904686(11))); foreach($_896698961 as $_249488129){ self::$_883005373[___1712904686(12)][$_249488129]= $_1926486062; if(!$_1926486062) $_152553645[]= array($_249488129, false);}} $_773802549= $GLOBALS['____1770890717'][5](self::$_883005373); $_773802549= $GLOBALS['____1770890717'][6]($_773802549); COption::SetOptionString(___1712904686(13), ___1712904686(14), $_773802549); foreach($_152553645 as $_1680561176) self::__7653496($_1680561176[(996-2*498)], $_1680561176[round(0+1)]);} public static function IsFeatureEnabled($_249488129){ if($_249488129 == '') return true; self::__2223194(); if(!isset(self::$_159126445[$_249488129])) return true; if(self::$_159126445[$_249488129] == ___1712904686(15)) $_1414887910= array(___1712904686(16)); elseif(isset(self::$_883005373[___1712904686(17)][self::$_159126445[$_249488129]])) $_1414887910= self::$_883005373[___1712904686(18)][self::$_159126445[$_249488129]]; else $_1414887910= array(___1712904686(19)); if($_1414887910[min(46,0,15.333333333333)] != ___1712904686(20) && $_1414887910[(1476/2-738)] != ___1712904686(21)){ return false;} elseif($_1414887910[(1392/2-696)] == ___1712904686(22)){ if($_1414887910[round(0+1)]< $GLOBALS['____1770890717'][7](min(204,0,68), min(36,0,12),(127*2-254), Date(___1712904686(23)), $GLOBALS['____1770890717'][8](___1712904686(24))- self::$_53779437, $GLOBALS['____1770890717'][9](___1712904686(25)))){ if(!isset($_1414887910[round(0+2)]) ||!$_1414887910[round(0+2)]) self::__1626756202(self::$_159126445[$_249488129]); return false;}} return!isset(self::$_883005373[___1712904686(26)][$_249488129]) || self::$_883005373[___1712904686(27)][$_249488129];} public static function IsFeatureInstalled($_249488129){ if($GLOBALS['____1770890717'][10]($_249488129) <= 0) return true; self::__2223194(); return(isset(self::$_883005373[___1712904686(28)][$_249488129]) && self::$_883005373[___1712904686(29)][$_249488129]);} public static function IsFeatureEditable($_249488129){ if($_249488129 == '') return true; self::__2223194(); if(!isset(self::$_159126445[$_249488129])) return true; if(self::$_159126445[$_249488129] == ___1712904686(30)) $_1414887910= array(___1712904686(31)); elseif(isset(self::$_883005373[___1712904686(32)][self::$_159126445[$_249488129]])) $_1414887910= self::$_883005373[___1712904686(33)][self::$_159126445[$_249488129]]; else $_1414887910= array(___1712904686(34)); if($_1414887910[(172*2-344)] != ___1712904686(35) && $_1414887910[(814-2*407)] != ___1712904686(36)){ return false;} elseif($_1414887910[(159*2-318)] == ___1712904686(37)){ if($_1414887910[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1770890717'][11]((1100/2-550),(183*2-366),(129*2-258), Date(___1712904686(38)), $GLOBALS['____1770890717'][12](___1712904686(39))- self::$_53779437, $GLOBALS['____1770890717'][13](___1712904686(40)))){ if(!isset($_1414887910[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) ||!$_1414887910[round(0+0.5+0.5+0.5+0.5)]) self::__1626756202(self::$_159126445[$_249488129]); return false;}} return true;} private static function __7653496($_249488129, $_887533784){ if($GLOBALS['____1770890717'][14]("CBXFeatures", "On".$_249488129."SettingsChange")) $GLOBALS['____1770890717'][15](array("CBXFeatures", "On".$_249488129."SettingsChange"), array($_249488129, $_887533784)); $_471063642= $GLOBALS['_____1406059044'][0](___1712904686(41), ___1712904686(42).$_249488129.___1712904686(43)); while($_563944877= $_471063642->Fetch()) $GLOBALS['_____1406059044'][1]($_563944877, array($_249488129, $_887533784));} public static function SetFeatureEnabled($_249488129, $_887533784= true, $_216353294= true){ if($GLOBALS['____1770890717'][16]($_249488129) <= 0) return; if(!self::IsFeatureEditable($_249488129)) $_887533784= false; $_887533784= (bool)$_887533784; self::__2223194(); $_771306123=(!isset(self::$_883005373[___1712904686(44)][$_249488129]) && $_887533784 || isset(self::$_883005373[___1712904686(45)][$_249488129]) && $_887533784 != self::$_883005373[___1712904686(46)][$_249488129]); self::$_883005373[___1712904686(47)][$_249488129]= $_887533784; $_773802549= $GLOBALS['____1770890717'][17](self::$_883005373); $_773802549= $GLOBALS['____1770890717'][18]($_773802549); COption::SetOptionString(___1712904686(48), ___1712904686(49), $_773802549); if($_771306123 && $_216353294) self::__7653496($_249488129, $_887533784);} private static function __1626756202($_295201129){ if($GLOBALS['____1770890717'][19]($_295201129) <= 0 || $_295201129 == "Portal") return; self::__2223194(); if(!isset(self::$_883005373[___1712904686(50)][$_295201129]) || self::$_883005373[___1712904686(51)][$_295201129][(227*2-454)] != ___1712904686(52)) return; if(isset(self::$_883005373[___1712904686(53)][$_295201129][round(0+2)]) && self::$_883005373[___1712904686(54)][$_295201129][round(0+2)]) return; $_152553645= array(); if(isset(self::$_2080760592[$_295201129]) && $GLOBALS['____1770890717'][20](self::$_2080760592[$_295201129])){ foreach(self::$_2080760592[$_295201129] as $_249488129){ if(isset(self::$_883005373[___1712904686(55)][$_249488129]) && self::$_883005373[___1712904686(56)][$_249488129]){ self::$_883005373[___1712904686(57)][$_249488129]= false; $_152553645[]= array($_249488129, false);}} self::$_883005373[___1712904686(58)][$_295201129][round(0+1+1)]= true;} $_773802549= $GLOBALS['____1770890717'][21](self::$_883005373); $_773802549= $GLOBALS['____1770890717'][22]($_773802549); COption::SetOptionString(___1712904686(59), ___1712904686(60), $_773802549); foreach($_152553645 as $_1680561176) self::__7653496($_1680561176[(760-2*380)], $_1680561176[round(0+1)]);} public static function ModifyFeaturesSettings($_1797480457, $_896698961){ self::__2223194(); foreach($_1797480457 as $_295201129 => $_1228469508) self::$_883005373[___1712904686(61)][$_295201129]= $_1228469508; $_152553645= array(); foreach($_896698961 as $_249488129 => $_887533784){ if(!isset(self::$_883005373[___1712904686(62)][$_249488129]) && $_887533784 || isset(self::$_883005373[___1712904686(63)][$_249488129]) && $_887533784 != self::$_883005373[___1712904686(64)][$_249488129]) $_152553645[]= array($_249488129, $_887533784); self::$_883005373[___1712904686(65)][$_249488129]= $_887533784;} $_773802549= $GLOBALS['____1770890717'][23](self::$_883005373); $_773802549= $GLOBALS['____1770890717'][24]($_773802549); COption::SetOptionString(___1712904686(66), ___1712904686(67), $_773802549); self::$_883005373= false; foreach($_152553645 as $_1680561176) self::__7653496($_1680561176[(902-2*451)], $_1680561176[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function SaveFeaturesSettings($_1629274378, $_1273358278){ self::__2223194(); $_470685067= array(___1712904686(68) => array(), ___1712904686(69) => array()); if(!$GLOBALS['____1770890717'][25]($_1629274378)) $_1629274378= array(); if(!$GLOBALS['____1770890717'][26]($_1273358278)) $_1273358278= array(); if(!$GLOBALS['____1770890717'][27](___1712904686(70), $_1629274378)) $_1629274378[]= ___1712904686(71); foreach(self::$_2080760592 as $_295201129 => $_896698961){ if(isset(self::$_883005373[___1712904686(72)][$_295201129])){ $_829387613= self::$_883005373[___1712904686(73)][$_295201129];} else{ $_829387613=($_295201129 == ___1712904686(74)? array(___1712904686(75)): array(___1712904686(76)));} if($_829387613[min(6,0,2)] == ___1712904686(77) || $_829387613[(1456/2-728)] == ___1712904686(78)){ $_470685067[___1712904686(79)][$_295201129]= $_829387613;} else{ if($GLOBALS['____1770890717'][28]($_295201129, $_1629274378)) $_470685067[___1712904686(80)][$_295201129]= array(___1712904686(81), $GLOBALS['____1770890717'][29](min(200,0,66.666666666667),(1428/2-714),(862-2*431), $GLOBALS['____1770890717'][30](___1712904686(82)), $GLOBALS['____1770890717'][31](___1712904686(83)), $GLOBALS['____1770890717'][32](___1712904686(84)))); else $_470685067[___1712904686(85)][$_295201129]= array(___1712904686(86));}} $_152553645= array(); foreach(self::$_159126445 as $_249488129 => $_295201129){ if($_470685067[___1712904686(87)][$_295201129][(1008/2-504)] != ___1712904686(88) && $_470685067[___1712904686(89)][$_295201129][(792-2*396)] != ___1712904686(90)){ $_470685067[___1712904686(91)][$_249488129]= false;} else{ if($_470685067[___1712904686(92)][$_295201129][(1040/2-520)] == ___1712904686(93) && $_470685067[___1712904686(94)][$_295201129][round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1770890717'][33]((936-2*468),(133*2-266),(172*2-344), Date(___1712904686(95)), $GLOBALS['____1770890717'][34](___1712904686(96))- self::$_53779437, $GLOBALS['____1770890717'][35](___1712904686(97)))) $_470685067[___1712904686(98)][$_249488129]= false; else $_470685067[___1712904686(99)][$_249488129]= $GLOBALS['____1770890717'][36]($_249488129, $_1273358278); if(!isset(self::$_883005373[___1712904686(100)][$_249488129]) && $_470685067[___1712904686(101)][$_249488129] || isset(self::$_883005373[___1712904686(102)][$_249488129]) && $_470685067[___1712904686(103)][$_249488129] != self::$_883005373[___1712904686(104)][$_249488129]) $_152553645[]= array($_249488129, $_470685067[___1712904686(105)][$_249488129]);}} $_773802549= $GLOBALS['____1770890717'][37]($_470685067); $_773802549= $GLOBALS['____1770890717'][38]($_773802549); COption::SetOptionString(___1712904686(106), ___1712904686(107), $_773802549); self::$_883005373= false; foreach($_152553645 as $_1680561176) self::__7653496($_1680561176[(1052/2-526)], $_1680561176[round(0+0.5+0.5)]);} public static function GetFeaturesList(){ self::__2223194(); $_1417092263= array(); foreach(self::$_2080760592 as $_295201129 => $_896698961){ if(isset(self::$_883005373[___1712904686(108)][$_295201129])){ $_829387613= self::$_883005373[___1712904686(109)][$_295201129];} else{ $_829387613=($_295201129 == ___1712904686(110)? array(___1712904686(111)): array(___1712904686(112)));} $_1417092263[$_295201129]= array( ___1712904686(113) => $_829387613[(878-2*439)], ___1712904686(114) => $_829387613[round(0+1)], ___1712904686(115) => array(),); $_1417092263[$_295201129][___1712904686(116)]= false; if($_1417092263[$_295201129][___1712904686(117)] == ___1712904686(118)){ $_1417092263[$_295201129][___1712904686(119)]= $GLOBALS['____1770890717'][39](($GLOBALS['____1770890717'][40]()- $_1417092263[$_295201129][___1712904686(120)])/ round(0+43200+43200)); if($_1417092263[$_295201129][___1712904686(121)]> self::$_53779437) $_1417092263[$_295201129][___1712904686(122)]= true;} foreach($_896698961 as $_249488129) $_1417092263[$_295201129][___1712904686(123)][$_249488129]=(!isset(self::$_883005373[___1712904686(124)][$_249488129]) || self::$_883005373[___1712904686(125)][$_249488129]);} return $_1417092263;} private static function __1716378720($_805370087, $_1356375602){ if(IsModuleInstalled($_805370087) == $_1356375602) return true; $_977469914= $_SERVER[___1712904686(126)].___1712904686(127).$_805370087.___1712904686(128); if(!$GLOBALS['____1770890717'][41]($_977469914)) return false; include_once($_977469914); $_1641552738= $GLOBALS['____1770890717'][42](___1712904686(129), ___1712904686(130), $_805370087); if(!$GLOBALS['____1770890717'][43]($_1641552738)) return false; $_1112252106= new $_1641552738; if($_1356375602){ if(!$_1112252106->InstallDB()) return false; $_1112252106->InstallEvents(); if(!$_1112252106->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___1712904686(131))) CSearch::DeleteIndex($_805370087); UnRegisterModule($_805370087);} return true;} protected static function OnRequestsSettingsChange($_249488129, $_887533784){ self::__1716378720("form", $_887533784);} protected static function OnLearningSettingsChange($_249488129, $_887533784){ self::__1716378720("learning", $_887533784);} protected static function OnJabberSettingsChange($_249488129, $_887533784){ self::__1716378720("xmpp", $_887533784);} protected static function OnVideoConferenceSettingsChange($_249488129, $_887533784){} protected static function OnBizProcSettingsChange($_249488129, $_887533784){ self::__1716378720("bizprocdesigner", $_887533784);} protected static function OnListsSettingsChange($_249488129, $_887533784){ self::__1716378720("lists", $_887533784);} protected static function OnWikiSettingsChange($_249488129, $_887533784){ self::__1716378720("wiki", $_887533784);} protected static function OnSupportSettingsChange($_249488129, $_887533784){ self::__1716378720("support", $_887533784);} protected static function OnControllerSettingsChange($_249488129, $_887533784){ self::__1716378720("controller", $_887533784);} protected static function OnAnalyticsSettingsChange($_249488129, $_887533784){ self::__1716378720("statistic", $_887533784);} protected static function OnVoteSettingsChange($_249488129, $_887533784){ self::__1716378720("vote", $_887533784);} protected static function OnFriendsSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(132); $_364814119= CSite::GetList(___1712904686(133), ___1712904686(134), array(___1712904686(135) => ___1712904686(136))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(137), ___1712904686(138), ___1712904686(139), $_1256840305[___1712904686(140)]) != $_275978867){ COption::SetOptionString(___1712904686(141), ___1712904686(142), $_275978867, false, $_1256840305[___1712904686(143)]); COption::SetOptionString(___1712904686(144), ___1712904686(145), $_275978867);}}} protected static function OnMicroBlogSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(146); $_364814119= CSite::GetList(___1712904686(147), ___1712904686(148), array(___1712904686(149) => ___1712904686(150))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(151), ___1712904686(152), ___1712904686(153), $_1256840305[___1712904686(154)]) != $_275978867){ COption::SetOptionString(___1712904686(155), ___1712904686(156), $_275978867, false, $_1256840305[___1712904686(157)]); COption::SetOptionString(___1712904686(158), ___1712904686(159), $_275978867);} if(COption::GetOptionString(___1712904686(160), ___1712904686(161), ___1712904686(162), $_1256840305[___1712904686(163)]) != $_275978867){ COption::SetOptionString(___1712904686(164), ___1712904686(165), $_275978867, false, $_1256840305[___1712904686(166)]); COption::SetOptionString(___1712904686(167), ___1712904686(168), $_275978867);}}} protected static function OnPersonalFilesSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(169); $_364814119= CSite::GetList(___1712904686(170), ___1712904686(171), array(___1712904686(172) => ___1712904686(173))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(174), ___1712904686(175), ___1712904686(176), $_1256840305[___1712904686(177)]) != $_275978867){ COption::SetOptionString(___1712904686(178), ___1712904686(179), $_275978867, false, $_1256840305[___1712904686(180)]); COption::SetOptionString(___1712904686(181), ___1712904686(182), $_275978867);}}} protected static function OnPersonalBlogSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(183); $_364814119= CSite::GetList(___1712904686(184), ___1712904686(185), array(___1712904686(186) => ___1712904686(187))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(188), ___1712904686(189), ___1712904686(190), $_1256840305[___1712904686(191)]) != $_275978867){ COption::SetOptionString(___1712904686(192), ___1712904686(193), $_275978867, false, $_1256840305[___1712904686(194)]); COption::SetOptionString(___1712904686(195), ___1712904686(196), $_275978867);}}} protected static function OnPersonalPhotoSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(197); $_364814119= CSite::GetList(___1712904686(198), ___1712904686(199), array(___1712904686(200) => ___1712904686(201))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(202), ___1712904686(203), ___1712904686(204), $_1256840305[___1712904686(205)]) != $_275978867){ COption::SetOptionString(___1712904686(206), ___1712904686(207), $_275978867, false, $_1256840305[___1712904686(208)]); COption::SetOptionString(___1712904686(209), ___1712904686(210), $_275978867);}}} protected static function OnPersonalForumSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(211); $_364814119= CSite::GetList(___1712904686(212), ___1712904686(213), array(___1712904686(214) => ___1712904686(215))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(216), ___1712904686(217), ___1712904686(218), $_1256840305[___1712904686(219)]) != $_275978867){ COption::SetOptionString(___1712904686(220), ___1712904686(221), $_275978867, false, $_1256840305[___1712904686(222)]); COption::SetOptionString(___1712904686(223), ___1712904686(224), $_275978867);}}} protected static function OnTasksSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(225); $_364814119= CSite::GetList(___1712904686(226), ___1712904686(227), array(___1712904686(228) => ___1712904686(229))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(230), ___1712904686(231), ___1712904686(232), $_1256840305[___1712904686(233)]) != $_275978867){ COption::SetOptionString(___1712904686(234), ___1712904686(235), $_275978867, false, $_1256840305[___1712904686(236)]); COption::SetOptionString(___1712904686(237), ___1712904686(238), $_275978867);} if(COption::GetOptionString(___1712904686(239), ___1712904686(240), ___1712904686(241), $_1256840305[___1712904686(242)]) != $_275978867){ COption::SetOptionString(___1712904686(243), ___1712904686(244), $_275978867, false, $_1256840305[___1712904686(245)]); COption::SetOptionString(___1712904686(246), ___1712904686(247), $_275978867);}} self::__1716378720(___1712904686(248), $_887533784);} protected static function OnCalendarSettingsChange($_249488129, $_887533784){ if($_887533784) $_275978867= "Y"; else $_275978867= ___1712904686(249); $_364814119= CSite::GetList(___1712904686(250), ___1712904686(251), array(___1712904686(252) => ___1712904686(253))); while($_1256840305= $_364814119->Fetch()){ if(COption::GetOptionString(___1712904686(254), ___1712904686(255), ___1712904686(256), $_1256840305[___1712904686(257)]) != $_275978867){ COption::SetOptionString(___1712904686(258), ___1712904686(259), $_275978867, false, $_1256840305[___1712904686(260)]); COption::SetOptionString(___1712904686(261), ___1712904686(262), $_275978867);} if(COption::GetOptionString(___1712904686(263), ___1712904686(264), ___1712904686(265), $_1256840305[___1712904686(266)]) != $_275978867){ COption::SetOptionString(___1712904686(267), ___1712904686(268), $_275978867, false, $_1256840305[___1712904686(269)]); COption::SetOptionString(___1712904686(270), ___1712904686(271), $_275978867);}}} protected static function OnSMTPSettingsChange($_249488129, $_887533784){ self::__1716378720("mail", $_887533784);} protected static function OnExtranetSettingsChange($_249488129, $_887533784){ $_959483051= COption::GetOptionString("extranet", "extranet_site", ""); if($_959483051){ $_1745997569= new CSite; $_1745997569->Update($_959483051, array(___1712904686(272) =>($_887533784? ___1712904686(273): ___1712904686(274))));} self::__1716378720(___1712904686(275), $_887533784);} protected static function OnDAVSettingsChange($_249488129, $_887533784){ self::__1716378720("dav", $_887533784);} protected static function OntimemanSettingsChange($_249488129, $_887533784){ self::__1716378720("timeman", $_887533784);} protected static function Onintranet_sharepointSettingsChange($_249488129, $_887533784){ if($_887533784){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___1712904686(276), ___1712904686(277), ___1712904686(278), ___1712904686(279), ___1712904686(280)); CAgent::AddAgent(___1712904686(281), ___1712904686(282), ___1712904686(283), round(0+100+100+100+100+100)); CAgent::AddAgent(___1712904686(284), ___1712904686(285), ___1712904686(286), round(0+100+100+100)); CAgent::AddAgent(___1712904686(287), ___1712904686(288), ___1712904686(289), round(0+3600));} else{ UnRegisterModuleDependences(___1712904686(290), ___1712904686(291), ___1712904686(292), ___1712904686(293), ___1712904686(294)); UnRegisterModuleDependences(___1712904686(295), ___1712904686(296), ___1712904686(297), ___1712904686(298), ___1712904686(299)); CAgent::RemoveAgent(___1712904686(300), ___1712904686(301)); CAgent::RemoveAgent(___1712904686(302), ___1712904686(303)); CAgent::RemoveAgent(___1712904686(304), ___1712904686(305));}} protected static function OncrmSettingsChange($_249488129, $_887533784){ if($_887533784) COption::SetOptionString("crm", "form_features", "Y"); self::__1716378720(___1712904686(306), $_887533784);} protected static function OnClusterSettingsChange($_249488129, $_887533784){ self::__1716378720("cluster", $_887533784);} protected static function OnMultiSitesSettingsChange($_249488129, $_887533784){ if($_887533784) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___1712904686(307), ___1712904686(308), ___1712904686(309), ___1712904686(310), ___1712904686(311), ___1712904686(312));} protected static function OnIdeaSettingsChange($_249488129, $_887533784){ self::__1716378720("idea", $_887533784);} protected static function OnMeetingSettingsChange($_249488129, $_887533784){ self::__1716378720("meeting", $_887533784);} protected static function OnXDImportSettingsChange($_249488129, $_887533784){ self::__1716378720("xdimport", $_887533784);}} $_658655117= GetMessage(___1712904686(313));$_1900630523= round(0+7.5+7.5);$GLOBALS['____1770890717'][44]($GLOBALS['____1770890717'][45]($GLOBALS['____1770890717'][46](___1712904686(314))), ___1712904686(315));$_724527866= round(0+0.33333333333333+0.33333333333333+0.33333333333333); $_1444553527= ___1712904686(316); unset($_1805284800); $_59160975= $GLOBALS['____1770890717'][47](___1712904686(317), ___1712904686(318)); $_1805284800= \COption::GetOptionString(___1712904686(319), $GLOBALS['____1770890717'][48](___1712904686(320),___1712904686(321),$GLOBALS['____1770890717'][49]($_1444553527, round(0+1+1), round(0+4))).$GLOBALS['____1770890717'][50](___1712904686(322))); $_98548443= array(round(0+8.5+8.5) => ___1712904686(323), round(0+1.75+1.75+1.75+1.75) => ___1712904686(324), round(0+5.5+5.5+5.5+5.5) => ___1712904686(325), round(0+4+4+4) => ___1712904686(326), round(0+0.75+0.75+0.75+0.75) => ___1712904686(327)); $_1434496062= ___1712904686(328); while($_1805284800){ $_1665400802= ___1712904686(329); $_1389006993= $GLOBALS['____1770890717'][51]($_1805284800); $_349703615= ___1712904686(330); $_1665400802= $GLOBALS['____1770890717'][52](___1712904686(331).$_1665400802,(1292/2-646),-round(0+2.5+2.5)).___1712904686(332); $_962148347= $GLOBALS['____1770890717'][53]($_1665400802); $_213415512=(242*2-484); for($_1721265924=(200*2-400); $_1721265924<$GLOBALS['____1770890717'][54]($_1389006993); $_1721265924++){ $_349703615 .= $GLOBALS['____1770890717'][55]($GLOBALS['____1770890717'][56]($_1389006993[$_1721265924])^ $GLOBALS['____1770890717'][57]($_1665400802[$_213415512])); if($_213415512==$_962148347-round(0+1)) $_213415512=(964-2*482); else $_213415512= $_213415512+ round(0+0.5+0.5);} $_724527866= $GLOBALS['____1770890717'][58]((1296/2-648), min(34,0,11.333333333333),(1460/2-730), $GLOBALS['____1770890717'][59]($_349703615[round(0+2+2+2)].$_349703615[round(0+1.5+1.5)]), $GLOBALS['____1770890717'][60]($_349703615[round(0+1)].$_349703615[round(0+7+7)]), $GLOBALS['____1770890717'][61]($_349703615[round(0+5+5)].$_349703615[round(0+18)].$_349703615[round(0+1.4+1.4+1.4+1.4+1.4)].$_349703615[round(0+6+6)])); unset($_1665400802); break;} $_839775712= ___1712904686(333); $GLOBALS['____1770890717'][62]($_98548443); $_1798804847= ___1712904686(334); $_1434496062= ___1712904686(335).$GLOBALS['____1770890717'][63]($_1434496062.___1712904686(336), round(0+0.66666666666667+0.66666666666667+0.66666666666667),-round(0+1));@include($_SERVER[___1712904686(337)].___1712904686(338).$GLOBALS['____1770890717'][64](___1712904686(339), $_98548443)); $_907693465= round(0+0.4+0.4+0.4+0.4+0.4); while($GLOBALS['____1770890717'][65](___1712904686(340))){ $_827934557= $GLOBALS['____1770890717'][66]($GLOBALS['____1770890717'][67](___1712904686(341))); $_429313174= ___1712904686(342); $_839775712= $GLOBALS['____1770890717'][68](___1712904686(343)).$GLOBALS['____1770890717'][69](___1712904686(344),$_839775712,___1712904686(345)); $_389241762= $GLOBALS['____1770890717'][70]($_839775712); $_213415512=(944-2*472); for($_1721265924=(230*2-460); $_1721265924<$GLOBALS['____1770890717'][71]($_827934557); $_1721265924++){ $_429313174 .= $GLOBALS['____1770890717'][72]($GLOBALS['____1770890717'][73]($_827934557[$_1721265924])^ $GLOBALS['____1770890717'][74]($_839775712[$_213415512])); if($_213415512==$_389241762-round(0+0.25+0.25+0.25+0.25)) $_213415512=(842-2*421); else $_213415512= $_213415512+ round(0+0.5+0.5);} $_907693465= $GLOBALS['____1770890717'][75]((1296/2-648),(1244/2-622), min(100,0,33.333333333333), $GLOBALS['____1770890717'][76]($_429313174[round(0+1.2+1.2+1.2+1.2+1.2)].$_429313174[round(0+8+8)]), $GLOBALS['____1770890717'][77]($_429313174[round(0+3+3+3)].$_429313174[round(0+0.4+0.4+0.4+0.4+0.4)]), $GLOBALS['____1770890717'][78]($_429313174[round(0+6+6)].$_429313174[round(0+1.75+1.75+1.75+1.75)].$_429313174[round(0+7+7)].$_429313174[round(0+3)])); unset($_839775712); break;} $_59160975= ___1712904686(346).$GLOBALS['____1770890717'][79]($GLOBALS['____1770890717'][80]($_59160975, round(0+3),-round(0+1)).___1712904686(347), round(0+0.2+0.2+0.2+0.2+0.2),-round(0+1.6666666666667+1.6666666666667+1.6666666666667));while(!$GLOBALS['____1770890717'][81]($GLOBALS['____1770890717'][82]($GLOBALS['____1770890717'][83](___1712904686(348))))){function __f($_2053691424){return $_2053691424+__f($_2053691424);}__f(round(0+0.2+0.2+0.2+0.2+0.2));};for($_1721265924= min(14,0,4.6666666666667),$_619977420=($GLOBALS['____1770890717'][84]()< $GLOBALS['____1770890717'][85]((882-2*441),min(178,0,59.333333333333),min(194,0,64.666666666667),round(0+2.5+2.5),round(0+0.5+0.5),round(0+403.6+403.6+403.6+403.6+403.6)) || $_724527866 <= round(0+3.3333333333333+3.3333333333333+3.3333333333333)),$_1404087765=($_724527866< $GLOBALS['____1770890717'][86]((1104/2-552),min(156,0,52),(1132/2-566),Date(___1712904686(349)),$GLOBALS['____1770890717'][87](___1712904686(350))-$_1900630523,$GLOBALS['____1770890717'][88](___1712904686(351)))),$_1209250596=($_SERVER[___1712904686(352)]!==___1712904686(353)&&$_SERVER[___1712904686(354)]!==___1712904686(355)); $_1721265924< round(0+2.5+2.5+2.5+2.5),($_619977420 || $_1404087765 || $_724527866 != $_907693465) && $_1209250596; $_1721265924++,LocalRedirect(___1712904686(356)),exit,$GLOBALS['_____1406059044'][2]($_658655117));$GLOBALS['____1770890717'][89]($_1434496062, $_724527866); $GLOBALS['____1770890717'][90]($_59160975, $_907693465); $GLOBALS[___1712904686(357)]= OLDSITEEXPIREDATE;/**/			//Do not remove this

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

if ((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && !str_starts_with($GLOBALS["APPLICATION"]->GetCurPage(), BX_ROOT . "/admin/"))) && COption::GetOptionString("main", "include_charset", "Y") == "Y" && LANG_CHARSET != '')
{
	header("Content-Type: text/html; charset=".LANG_CHARSET);
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

/*ZDUyZmZNTAzOTQ1OGE0YjgzOTBiNmE5NWRhMmE0OGNlZjQ3YjU=*/$GLOBALS['____2085224441']= array(base64_decode('bXRfcmFu'.'Z'.'A=='),base64_decode(''.'Y2FsbF91c'.'2VyX2Z'.'1bmM='),base64_decode('c3RycG9z'),base64_decode('Z'.'XhwbG'.'9k'.'ZQ'.'=='),base64_decode(''.'c'.'G'.'Fjaw=='),base64_decode(''.'bW'.'Q1'),base64_decode(''.'Y2'.'9'.'uc3R'.'hbnQ='),base64_decode(''.'a'.'G'.'FzaF9obWF'.'j'),base64_decode('c3RyY2'.'1w'),base64_decode('Y'.'2FsbF9'.'1c2'.'VyX2Z1'.'bm'.'M='),base64_decode('Y'.'2'.'Fsb'.'F91c2VyX2Z1'.'bmM'.'='),base64_decode('aXNfb'.'2JqZWN0'),base64_decode('Y2FsbF'.'91c2Vy'.'X2Z1bmM='),base64_decode('Y'.'2'.'Fs'.'bF'.'9'.'1c2VyX2Z1'.'bmM='),base64_decode('Y2Fs'.'bF91c2VyX2Z'.'1bm'.'M='),base64_decode('Y'.'2FsbF'.'91c2Vy'.'X2'.'Z1bmM='),base64_decode('Y2Fs'.'bF9'.'1c2'.'VyX2Z1bmM='),base64_decode(''.'Y2'.'FsbF9'.'1c2'.'VyX'.'2Z1bm'.'M='),base64_decode('ZGVmaW5'.'lZA=='),base64_decode('c3R'.'ybGVu'));if(!function_exists(__NAMESPACE__.'\\___1675067742')){function ___1675067742($_1354345616){static $_1252216107= false; if($_1252216107 == false) $_1252216107=array('X'.'ENPc'.'HRp'.'b246OkdldE'.'9wdGlvb'.'l'.'N0cmlu'.'Zw==','bWFp'.'b'.'g==','f'.'lB'.'BUkFNX01'.'BWF9VU0VSUw==','Lg==',''.'L'.'g'.'==','SCo=','Yml'.'0'.'cml4','TElD'.'RU'.'5T'.'R'.'V9LRVk'.'=','c2hh'.'M'.'jU2','X'.'ENPcHRpb2'.'4'.'6'.'Ok'.'dldE9w'.'dGlvblN0cmluZw==','bWF'.'pbg==','UE'.'F'.'SQ'.'U'.'1fT'.'UFYX'.'1VTRVJT',''.'XEJpdHJp'.'eF'.'xNY'.'WluXE'.'N'.'vbmZpZ1'.'xPcHR'.'pb'.'24'.'6O'.'nNl'.'dA==','bWFpb'.'g==',''.'UE'.'FSQU'.'1fTUFYX1VTRV'.'JT','VVNFUg==','V'.'VNF'.'Ug==','VVNF'.'Ug='.'=','S'.'XNBdXR'.'ob3J'.'pemVk','V'.'VNFUg'.'==','SX'.'NBZG1pbg='.'=','Q'.'VBQ'.'TEl'.'DQVRJT04=','UmVzdGF'.'ydEJ'.'1ZmZlcg='.'=',''.'TG9jY'.'Wx'.'SZW'.'Rp'.'cmVjd'.'A'.'==','L2xpY2V'.'u'.'c2V'.'f'.'cmVzdHJpY3Rpb'.'24'.'ucGh'.'w','XENPcHRpb246'.'Okd'.'ldE9wdGlvblN0'.'cmluZ'.'w==','bWFpbg==','U'.'E'.'F'.'SQU1'.'fTUFYX1VTRVJT','XEJ'.'pdHJp'.'eFxNYWlu'.'X'.'ENvbm'.'ZpZ1x'.'PcHR'.'pb246OnN'.'ldA==',''.'bWFpbg==','UEFSQU1'.'fTU'.'FYX1V'.'T'.'RV'.'JT','T'.'0xEU0lUR'.'UVYUElSRU'.'RBVEU=','ZXhwaXJlX21l'.'c3'.'My');return base64_decode($_1252216107[$_1354345616]);}};if($GLOBALS['____2085224441'][0](round(0+0.5+0.5), round(0+10+10)) == round(0+1.75+1.75+1.75+1.75)){ $_1241770293= $GLOBALS['____2085224441'][1](___1675067742(0), ___1675067742(1), ___1675067742(2)); if(!empty($_1241770293) && $GLOBALS['____2085224441'][2]($_1241770293, ___1675067742(3)) !== false){ list($_1520848617, $_1642921518)= $GLOBALS['____2085224441'][3](___1675067742(4), $_1241770293); $_1399592756= $GLOBALS['____2085224441'][4](___1675067742(5), $_1520848617); $_1907241912= ___1675067742(6).$GLOBALS['____2085224441'][5]($GLOBALS['____2085224441'][6](___1675067742(7))); $_992960070= $GLOBALS['____2085224441'][7](___1675067742(8), $_1642921518, $_1907241912, true); if($GLOBALS['____2085224441'][8]($_992960070, $_1399592756) !== min(118,0,39.333333333333)){ if($GLOBALS['____2085224441'][9](___1675067742(9), ___1675067742(10), ___1675067742(11)) != round(0+12)){ $GLOBALS['____2085224441'][10](___1675067742(12), ___1675067742(13), ___1675067742(14), round(0+6+6));} if(isset($GLOBALS[___1675067742(15)]) && $GLOBALS['____2085224441'][11]($GLOBALS[___1675067742(16)]) && $GLOBALS['____2085224441'][12](array($GLOBALS[___1675067742(17)], ___1675067742(18))) &&!$GLOBALS['____2085224441'][13](array($GLOBALS[___1675067742(19)], ___1675067742(20)))){ $GLOBALS['____2085224441'][14](array($GLOBALS[___1675067742(21)], ___1675067742(22))); $GLOBALS['____2085224441'][15](___1675067742(23), ___1675067742(24), true);}}} else{ if($GLOBALS['____2085224441'][16](___1675067742(25), ___1675067742(26), ___1675067742(27)) != round(0+4+4+4)){ $GLOBALS['____2085224441'][17](___1675067742(28), ___1675067742(29), ___1675067742(30), round(0+2.4+2.4+2.4+2.4+2.4));}}} while(!$GLOBALS['____2085224441'][18](___1675067742(31)) || $GLOBALS['____2085224441'][19](OLDSITEEXPIREDATE) <=(1008/2-504) || OLDSITEEXPIREDATE != SITEEXPIREDATE)die(GetMessage(___1675067742(32)));/**/       //Do not remove this
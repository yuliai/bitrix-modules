<?
###################################################
# askaron.agents module
# Copyright (c) 2011-2026 Askaron Systems ltd.
# http://askaron.ru
# mailto:mail@askaron.ru
###################################################

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
Loc::loadMessages($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/options.php');
//IncludeModuleLangFile(__FILE__);
//IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");


require_once( __DIR__."/prolog.php" );

$module_id = "askaron.agents";
$install_status = CModule::IncludeModuleEx($module_id);

global $APPLICATION;
$RIGHT = $APPLICATION->GetGroupRight($module_id);
$RIGHT_W = ($RIGHT>="W");
$RIGHT_R = ($RIGHT>="R");

if ($RIGHT_R)
{	
	if (
		$_SERVER["REQUEST_METHOD"] =="POST"
		&& mb_strlen( $_REQUEST["Update"] )>0
		&& $RIGHT_W
		&& check_bitrix_sessid()
	)
	{
		if ( isset($_REQUEST[ "check_agents" ]) && $_REQUEST[ "check_agents" ] == "Y" )
		{
			COption::SetOptionString("main", "check_agents", "Y" );
		}
		else
		{
			COption::SetOptionString("main", "check_agents", "N" );				
		}
	}	

	if (
		$_SERVER["REQUEST_METHOD"] == "POST"
		&& $RIGHT_W
		&& mb_strlen( $_REQUEST["RestoreDefaults"] )>0
		&& check_bitrix_sessid()
	)
	{
		COption::RemoveOption("askaron.agents");
		COption::RemoveOption("main", "check_agents");

		$z = CGroup::GetList($v1="id",$v2="asc", array("ACTIVE" => "Y", "ADMIN" => "N"), $get_users_amount = "N");
		while($zr = $z->Fetch())
		{
			$APPLICATION->DelGroupRight($module_id, array($zr["ID"]));
		}
	}

	$check_agents = COption::GetOptionString("main", "check_agents", "Y");

	$aTabs = array(
		array("DIV" => "edit1", "TAB" => Loc::getMessage("MAIN_TAB_SET"), "ICON" => "", "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET")),
		array("DIV" => "edit3", "TAB" => Loc::getMessage("MAIN_TAB_RIGHTS"), "ICON" => "", "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_RIGHTS")),
	);

	$tabControl = new CAdminTabControl("tabControl", $aTabs);
	$tabControl->Begin();
	?>
	<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?lang=<?=LANGUAGE_ID?>&amp;mid=<?=htmlspecialcharsbx($_REQUEST["mid"])?>&amp;mid_menu=<?=htmlspecialcharsbx($_REQUEST["mid_menu"])?>">
		<?=bitrix_sessid_post()?>
		<?$tabControl->BeginNextTab();?>
		<tr>
			<td width="100%" style="" colspan="2">
				<?	
				//demo (2)
				if ( $install_status == 2 )
				{
					CAdminMessage::ShowMessage(
						Array(
							"TYPE"=>"OK",
							"MESSAGE" => Loc::getMessage("askaron_agents_prolog_status_demo"),
							"DETAILS"=> Loc::getMessage("askaron_agents_prolog_buy_html"),
							"HTML"=>true
						)
					);
				}
				elseif( $install_status == 3 )
				{
					//demo expired (3)
					CAdminMessage::ShowMessage(
						Array(
							"TYPE"=>"ERROR",
							"MESSAGE" => Loc::getMessage("askaron_agents_prolog_status_demo_expired"),
							"DETAILS"=> Loc::getMessage("askaron_agents_prolog_buy_html"),
							"HTML"=>true
						)
					);	
				}					
				?>	
			</td>
		</tr>
		<tr>
			<td valign="top" width="30%" class="field-name"><?=Loc::getMessage("askaron_agents_check_agents")?></td>
			<td valign="top" width="70%">

				<input
					type="radio" 
					value="Y"
					id="askaron_agents_check_agents_Y"
					<?if ($check_agents == "Y"):?>
						checked="checked"
					<?endif?>
					name="check_agents"
				/>					

				<label for='askaron_agents_check_agents_Y'><?=Loc::getMessage("askaron_agents_check_agents_Y")?></label><br />

				<input
					type="radio" 
					value="N"
					id="askaron_agents_check_agents_N"
					<?if ($check_agents == "N"):?>
						checked="checked"
					<?endif?>						
					name="check_agents"
				/>										
				<label for='askaron_agents_check_agents_N'><?=Loc::getMessage("askaron_agents_check_agents_N")?></label><br />

				<?
				if( $install_status == 3 )
				{
					//demo expired (3)
					CAdminMessage::ShowMessage(
						Array(
							"TYPE"=>"ERROR",
							"MESSAGE" => Loc::getMessage("askaron_agents_prolog_status_demo_expired"),
							"DETAILS"=> Loc::getMessage("askaron_agents_all_agents_not_work"),
							"HTML"=>true
						)
					);	
				}
				?>
				
			</td>				
		</tr>	
		<tr>
			<td valign="top" width="100%" colspan="2">
				<?=BeginNote();?>
					<?=Loc::getMessage("askaron_agents_check_agents_help", array("#LANG#" => LANG ) );?>
				<?=EndNote();?>	
			</td>				
		</tr>			

		<?$tabControl->BeginNextTab();?>
		<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
		<?$tabControl->Buttons();?>		
		<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="Update" value="<?=Loc::getMessage("MAIN_SAVE")?>" title="<?=Loc::getMessage("MAIN_OPT_SAVE_TITLE")?>">
		<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="RestoreDefaults" title="<?=Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS")?>"
			  OnClick="return confirm('<?echo AddSlashes(Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo Loc::getMessage("MAIN_RESTORE_DEFAULTS")?>">
		<?$tabControl->End();?>
	</form>

	<?=BeginNote();?>
		<?
			$server_version = Loc::getMessage("askaron_agents_not_vmbitrix");
			$vm_version = getenv("BITRIX_VA_VER");
			if ( mb_strlen( $vm_version ) > 0 )
			{
				$server_version = Loc::getMessage("askaron_agents_vmbitrix")." ".$vm_version;
			}
		?>
		<?=Loc::getMessage("askaron_agents_cron_help", array("#DOCUMENT_ROOT#" => $_SERVER["DOCUMENT_ROOT"], "#VMBITRIX#" => $server_version ) );?>
	<?=EndNote();?>	

	<?=BeginNote();?>
		<?=Loc::getMessage("askaron_agents_check_agents_mail");?>
		<?if ( defined( "BX_CRONTAB_SUPPORT" ) && (BX_CRONTAB_SUPPORT === true) ):?>
			<br><br><?=Loc::getMessage("askaron_agents_check_agents_mail_is_set");?>
		<?else:?>
			<br><br><?=Loc::getMessage("askaron_agents_check_agents_mail_is_not_set");?>
		<?endif?>
	<?=EndNote();?>
<?
}
?>
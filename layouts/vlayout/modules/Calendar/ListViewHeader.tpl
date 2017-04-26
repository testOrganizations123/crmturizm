{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
-->*}
{strip}
	<div class="listViewPageDiv">
		<div class="listViewTopMenuDiv noprint">
			<div class="listViewActionsDiv row-fluid">
				<span class="btn-toolbar span7">
                                    <span class="btn-group">
                                            <button id="Calendar_listView_basicAction_LBL_ADD_TASK" class="btn addButton" onclick="window.location.href=&quot;index.php?module=Calendar&amp;view=Edit&amp;mode=Events&quot;"><i class="icon-plus"></i>&nbsp;<strong>Добавить Задачу</strong></button>
                                        </span>
                                    <span class="btn-group listViewMassActions">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                                            <strong>Добавить заявку</strong>&nbsp;&nbsp;<i class="caret"></i></button>
                                            <ul class="dropdown-menu">
                                                <li ><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=579413" >Входящий звонок</a></li>
                                                <li ><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=720999">Исходящий звонок</a></li>
                                                <li ><a href="index.php?module=Leads&view=Edit&mb=1">Соц.сети</a></li>
                                                
                                                <li class="divider"></li>
                                                <li><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=203176">Встреча</a></li>
                                                {*<li><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=271" >Встреча:постпродажа</a></li>*}

                                            </ul>
                                    </span>
					<span class="btn-group">
					<button id="addExTask" class="btn addButton" ><i class="icon-plus"></i>&nbsp;<strong>{vtranslate("Экспресс заявка", $MODULE)}</strong></button>
					</span>
						<span class="btn-group">

                                            <button id="leads_mass_transfer" class="btn addButton" onclick="Leads_mass_transfer(event)"><i class="icon-refresh"></i>&nbsp;<strong>Передать Заявку</strong></button>
                                        </span>
					
				</span>
			<span class="btn-toolbar span1">
				
			</span>
			<span class="hide filterActionImages pull-right">
				<i title="{vtranslate('LBL_DENY', $MODULE)}" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i>
				<i title="{vtranslate('LBL_APPROVE', $MODULE)}" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i>
				<i title="{vtranslate('LBL_DELETE', $MODULE)}" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i>
				<i title="{vtranslate('LBL_EDIT', $MODULE)}" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right"></i>
			</span>
			<span class="span4 btn-toolbar">

				{include vtemplate_path('ListViewActions.tpl',$MODULE)}
			</span>
		</div>
		</div>
	<div class="listViewContentDiv" id="listViewContents">
{/strip}
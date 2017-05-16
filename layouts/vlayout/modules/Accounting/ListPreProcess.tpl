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
{include file="Header.tpl"|vtemplate_path:$MODULE}
{include file="BasicHeader.tpl"|vtemplate_path:$MODULE}

<div class="bodyContents">
	<div class="mainContainer row-fluid">
            <div class="span2 row-fluid " id="leftPanel" style="min-height: 821px;">
                <div class="row-fluid">
                    <div class="sideBarContents">
                        <div class="quickLinksDiv">
                            
                            <p onclick="window.location.href='index.php?module=Accounting&view=List&mode=workingHours'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="{if $MODE eq 'workingHours'}selectedQuickLink{else}unSelectedQuickLink{/if}">
                                <a class="quickLinks" href="index.php?module=Accounting&view=List&mode=workingHours">
                                    <strong>Учет рабочего времени</strong>
                                </a>
                            </p>

                        </div>
                     
                        
                            
                    </div>
                    
                        
                </div>
                    
            </div>
                
     <div class="contentsDiv span10 marginLeftZero" id="rightPanel" style="min-height:550px;">
	<div id="toggleButton" class="toggleButton" title="Показать/скрыть левую панель"><i id="tButtonImage" class="icon-chevron-left"></i></div>	
				
{/strip}
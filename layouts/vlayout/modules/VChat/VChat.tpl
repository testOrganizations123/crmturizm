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

<link rel="stylesheet" type="text/css" href="/layouts/vlayout/modules/VChat/css/vchat.css" />
<script type="text/javascript" src="/layouts/vlayout/modules/VChat/resources/jquery.color.js"></script> 
<script type="text/javascript" src="/layouts/vlayout/modules/VChat/resources/Search.js"></script> 


<div class="bodyContents">

	<div class="mainContainer row-fluid">
		{assign var=LEFTPANELHIDE value=$CURRENT_USER_MODEL->get('leftpanelhide')}

		<div class="headerVChat">
			<div class="logoVChat"></div>
			<div class="searchVChat"></div>
		</div>
		<div class="row vchat">
			<div id="logsql"></div>
			<input id="startsearchCannnelAndUser" type="hidden"  value="0" />
			<div class="panelVchat leftPanelvChat">
				<div class="contentLeftPanelvChat">
					<div><label>Каналы <div class="addChannelLeftP">[<a href="# return false" onclick="openeVChatNameChannel(0,'new')">Добавить</a>]</label></div> </div>
					<div>
						<input type="hidden" id="startsearchVChannel" value="0" />
						
						<input type="hidden" id="startsearch" value="0" />
						<input type="text" class="form-control" onkeyup="if (event.keyCode == 38) { setTimeout(selectNWord, 400); } else if  (event.keyCode == 40) { setTimeout(selectWord, 400); } else if (event.keyCode == 13) { setTimeout(searchword, 400); } else { autocompletefield();}" id="search" autocomplete="off" onblur="if(this.value=='')this.value=this.defaultValue;" onkeydown="" value="" name="search" placeholder="Введи слово для поиска...">
						
						<!--<div><a href="javascript:selectUser(0,'Все')">Все</a></div>-->
						
						<!--
						<div class="rowuserVChat null channel0 " onclick="javascript:selectUser(0,'Все')">Все</div>
						-->
						
						<!--
						<input type="text" class="form-control" onkeyup="if (event.keyCode == 38) { setTimeout(selectNWord, 400); } else if  (event.keyCode == 40) { setTimeout(selectWord, 400); } else if (event.keyCode == 13) { setTimeout(searchword, 400); } else { autocompletefield();}" id="searchVChannel" autocomplete="off" onblur="if(this.value=='')this.value=this.defaultValue;" onkeydown="" value="" name="searchVChannel" placeholder="Введи слово для поиска...">
						-->
						<div id="oblsearchVChannel" style="">
							<div style="padding:0px" id="innersearchVChannel"></div>
						</div>
						<div style="padding:0px;" id="innersearchcloseVChannel"><img src='layouts/vlayout/modules/VChat/img/load.gif' style='text-align:center' width='60px' /></div>	
					</div>
					
					
					<div><hr></div>
					<!--<div><label>Диалоги [Добавить]</label> </div>-->
					<div>
						<div id="oblsearch" style="display:block">
							<div style="padding:0px" id="innersearch"></div>
						</div>
						<div style="padding:0px;" id="innersearchclose"><img src='layouts/vlayout/modules/VChat/img/load.gif' style='text-align:center' width='60px' /><!--{$listUsers}--></div>	
					</div>
					
				</div>
			</div>
			
			
			<div class="panelVchat centerPanelvChat">
				<div id="headerVchat">
					<input type="hidden" id="startChannel" value="0" />
					<input type="hidden" id="userChannelTo" value="0" />
					<input type="hidden" id="listChannelTo" value="0" />
					<input type="hidden" id="typesearch" value="user" />
					
					<div class="row nameheaderchat" >
					<div class="nameChannel"><h2>Канал: <span id="toUserVchat" onclick="changeName()">Все</span><span></span></h2></div> 
					<div class="favtop"  style="font-size:18px!important;">
					<a href="# return false" style="text-decoration: underline!important" onclick="setstartfavtop()">
					Закладка</a></div> </div>
					
				</div>
				<div class="contentVChat" id="textmessageVChat">
					<!--
					==={$VIEW}===	
					==={$Test2}===	
					-->
					
				</div>
				<div id="relMessage"></div>
				<div class="inputblockVChat">
					<textarea id="textmessage"></textarea>
					<input type="button" onclick="sendMessage()" id="firstButtonSendVChat" value="Отправить сообщение"/>
					<input type="button" onclick=""  id="thButtonSendVChat" style="display:none" value="Отправить сообщение"/>
				</div>
			</div>
			<div class="panelVchat rightPanelvChat">
				<div class="contentrightPanelVChat">
					<div style="text-align:right;"><a href="# return false" onclick="selectMenu()">Настройки</a>
					<div id="optionchat" style="display:none;position:absolute;width:150px;background:#FFF;border:1px solid #CCC;padding:10px; right:10px; margin-left:-20px;">
					<div style="text-align:right"><a href="# return false" onclick="closeOption()">Закрыть</a></div>
					<div style="text-align:left">
					
					<div style="padding:10px" ><a href='/modules/VChat/file/MyChat.rar'>Скачать WindowsChat</a></div>
					<div style="padding:10px"><a href='# return false' onclick="getPassword()">Получить пароль</a></div>
					<div style="padding:10px"><a href='/layouts/vlayout/modules/VChat/html/index.html' target=blank >Инструкция по установке WindowsChat</a></div>
					<div id="GetPassword" style="font-size:19px;padding:10px 0px 10px 10px"></div>
					
					
					</div>
					</div>
					<!--
					<div id="info" style="position:fixed;z-index:1000;background:#CCC;left:50%;margin-left:-300px;width:600px">
					<div><a href="# return false" onclick="$('#info').css('display','none')">Закрыть</a></div>
					<div>-->
					
					</div>
					</div>
					
					
					{$Test2}</div>
					<div class="headerPanel">
					<!--
					<a href="javascript:view_adduserlist()">Участники канал</a> 
					| <a href="javascript:view_addtopmespanel()">Избранные сообщения</a> | <a href="javascript:view_addpanel()">Добавить файлы</a> 
					-->
					<h3>Участники канала</h3>
					</div>
					
					
					<div class="subChannelsVChat">
					
					</div>
					
					<div class="rightVChatPanlelUserList">
					<!--
					<div>[<a href="# return false" onclick="openeVChatNameChannel('+userid+',\'new\')">Добавить подпапку</a>]</div>
					<div>[<a href="# return false" onclick="openeVChatNameChannel('+userid+',\'change\')">Добавить участников</a>]</div>
					-->
					<div class="rightContainerVChatPanlelUserList"></div>
					</div>
					
					<div class="topMessageUserList">
					topMessageUserList
					</div>
					
					<div class="uploadsFilesForm">
					uploadsFilesForm
					</div>
				</div>
			</div>
		</div>
		
		<div id="TB_overlay"></div>
		<div class="panelVChatChannel">
			<div class="closePanelVChat">
			<input type="hidden" id="uniqidnamechannel" value=0 />
			<input type="hidden" id="uniqid" value=0 />
			<a href="# return false" onclick="closePanelVChat2()">Закрыть</a>
			</div>
			<div class="containerVChat">
				
				<div id="userListVChat"></div>
				<div class="rowVChat">
					<div>Введите название канала</div>
					<input type="hidden" value="0" id="subchanel" />
					<input type="text" id="nameVChannel" placeholder="Введите имя канала" />
				</div>
				<div class="rowVChatButton">
					<input type="button" onclick="saveVChatNameChannel()" value="Сохранить" />
					<input type="button" onclick="cencelVChatNameChannel()"  value="Отменить" />
				</div>
				
				<div style="display:none">
				<div class="inputloaduserVChat" style="display:none"><input type="text" id="loadUVChatAj" placeholder="Введите имя сотрудника для поиска" /></div>
				</div>
				
				<div id="selectuser" >Выбранные пользователи:</div>
				<div id="containerUserVChat"></div>
				
			</div>
		</div>
		
		
		<script></script>
		
		
{/strip}
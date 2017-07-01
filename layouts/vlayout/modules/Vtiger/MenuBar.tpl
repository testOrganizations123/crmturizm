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
	{assign var="topMenus" value=$MENU_STRUCTURE->getTop()}
	{assign var="moreMenus" value=$MENU_STRUCTURE->getMore()}
	{assign var=NUMBER_OF_PARENT_TABS value = count(array_keys($moreMenus))}
{assign var=REGION value = array("H10","H11","H16","H49","H55","H62")}
	<div class="navbar" id="topMenus" style="overflow: hidden;height:40px;">
		<div class="navbar-inner" id="nav-inner">
			<div class="menuBar row-fluid">
				{* overflow+height is required to avoid flickering UI due to responsive handling, overflow will be dropped later *}
				<div class="span9">
					<ul class="nav modulesList" id="largeNav">
						<li class="tabs">
							<a class="alignMiddle {if $MODULE eq 'Home'} selected {/if}" href="{$HOME_MODULE_MODEL->getDefaultUrl()}"><img src="{vimage_path('home.png')}" alt="{vtranslate('LBL_HOME',$moduleName)}" title="{vtranslate('LBL_HOME',$moduleName)}" /></a>
						</li>
						 <!-- если админ - идем по настройкам системы -->
                                                 {if $USER_MODEL->isAdminUser()}
						{foreach key=moduleName item=moduleModel from=$topMenus name=topmenu}
							{assign var='translatedModuleLabel' value=vtranslate($moduleModel->get('label'),$moduleName)}

							{assign var="topmenuClassName" value="tabs"}
							{* Make sure to keep selected + few menu persistently and rest responsive *}
							{if $smarty.foreach.topmenu.index > $MENU_TOPITEMS_LIMIT && $MENU_SELECTED_MODULENAME != $moduleName}
								{assign var="topmenuClassName" value="tabs opttabs"}
							{/if}
                                                        {if $moduleName eq 'VDDialogueDesigner' and ($VIEW eq 'ListScript' or $VIEW eq 'RunScript')}
                                                            {else}
							<li class="{$topmenuClassName}">
								<a id="menubar_item_{$moduleName}" href="{$moduleModel->getDefaultUrl()}" {if $MODULE eq $moduleName} class="selected" {/if}><strong>{$translatedModuleLabel}</strong></a>
							</li>
                                                        {/if}
						{/foreach}

                                                 <li class="tabs">
							<a class="{if $MODULE eq 'VDDialogueDesigner' and ($VIEW eq 'ListScript' or $VIEW eq 'RunScript')} selected {/if}" href="index.php?module=VDDialogueDesigner&view=ListScript"><strong>Скрипты</strong></a>
						</li>
						<!-- если НЕ АДМИН - модули перечислены вручную -->
                                                {else}
                                                    <li class="tabs"><a id="menubar_item_Calendar" href="index.php?module=Calendar&amp;view=List"><strong>Календарь</strong></a></li>
                                                    <li class="tabs"><a id="menubar_item_Potentials" href="index.php?module=Potentials&amp;view=List"><strong>Брони</strong></a></li>
                                                    
                                                    <li class="tabs"><a id="menubar_item_MailManager" href="index.php?module=MailManager&amp;view=List"><strong>Менеджер почты</strong></a></li>
													<li class="tabs"><a id="menubar_item_MailManager" href="index.php?module=VChat&amp;view=List"><strong>Чат</strong></a></li> {* troshichev *}

											   {/if}
					</ul>

					<ul class="nav" id="shortNav">
						<li class="tabs">
							<a class="alignMiddle {if $MODULE eq 'Home'} selected {/if}" href="{$HOME_MODULE_MODEL->getDefaultUrl()}"><img src="{vimage_path('home.png')}" alt="{vtranslate('LBL_HOME',$moduleName)}" title="{vtranslate('LBL_HOME',$moduleName)}" /></a>
						</li>

						<li class="dropdown tabs" id="collapsedMenu">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#collapsedMenu">
								{vtranslate('LBL_ALL',$MODULE)}
								<b class="caret"></b>
							</a>
							<div class="dropdown-menu">
								<div class="shortDropdown">
                                                                     {if $USER_MODEL->isAdminUser()}
									{foreach key=parent item=moduleList from=$moreMenus name=more}
										{if $moduleList}
											<strong>{vtranslate("LBL_$parent",$moduleName)}</strong><hr>
											{foreach key=moduleName item=moduleModel from=$moduleList}
												{assign var='translatedModuleLabel' value=vtranslate($moduleModel->get('label'),$moduleName )}

												<label class="moduleNames">
													<a id="menubar_item_{$moduleName}" href="{$moduleModel->getDefaultUrl()}">{$translatedModuleLabel}</a>
												</label>
											{/foreach}
										{/if}
									{/foreach}
                                                                        {else}
                                                                        <!-- перечень модулей НЕ АДМИНА для мобильной версии -->
                                                                            <label class="moduleNames">
													<a id="menubar_item_Calendar" href="index.php?module=Calendar&amp;view=List">Календарь</a>
												</label>
                                                                            <label class="moduleNames">
													<a id="menubar_item_Potentials" href="index.php?module=Potentials&amp;view=List">Брони</a>
												</label>
                                                                            <label class="moduleNames">
													<a id="menubar_item_Contacts" href="index.php?module=Contacts&amp;view=List">Клиенты</a>
												</label>
												<label class="moduleNames">
													<a id="menubar_item_MailManager" href="index.php?module=MailManager&amp;view=List">Менеджер почты</a>
												</label>
                                                                        {/if}
								</div>
							</div>
						</li>
					</ul>

					<ul class="nav modulesList" id="mediumNav">
						<li class="tabs">
							<a class="alignMiddle {if $MODULE eq 'Home'} selected {/if}" href="{$HOME_MODULE_MODEL->getDefaultUrl()}"><img src="{vimage_path('home.png')}" alt="{vtranslate('LBL_HOME',$moduleName)}" title="{vtranslate('LBL_HOME',$moduleName)}" /></a>
						</li>
                                                {if $USER_MODEL->isAdminUser()}
						{assign var=COUNTER value=0}
						{foreach key=moduleName item=moduleModel from=$topMenus name=topmenu}
							{assign var='translatedModuleLabel' value=vtranslate($moduleModel->get('label'),$moduleName)}

							{assign var="topmenuClassName" value="tabs"}
							{* Make sure to keep selected + few menu persistently and rest responsive *}
							{if $smarty.foreach.topmenu.index > 2 && $MENU_SELECTED_MODULENAME != $moduleName}
								{assign var="topmenuClassName" value="tabs opttabs"}
							{/if}
							<li class="{$topmenuClassName}">
								<a id="menubar_item_{$moduleName}" href="{$moduleModel->getDefaultUrl()}" {if $MODULE eq $moduleName} class="selected" {/if}><strong>{$translatedModuleLabel}</strong></a>
							</li>
						{/foreach}
                                                {else}
                                                    <li class="tabs"><a id="menubar_item_Calendar" href="index.php?module=Calendar&amp;view=List"><strong>Календарь</strong></a></li>
                                                    <li class="tabs"><a id="menubar_item_Potentials" href="index.php?module=Potentials&amp;view=List"><strong>Брони</strong></a></li>
                                                    <li class="tabs"><a id="menubar_item_Contacts" href="index.php?module=Contacts&amp;view=List"><strong>Клиенты</strong></a></li>
                                                    <li class="tabs"><a id="menubar_item_MailManager" href="index.php?module=MailManager&amp;view=List"><strong>Менеджер почты</strong></a></li>
                                                {/if}
					</ul>

                                         {if $USER_MODEL->isAdminUser()}
					<ul class="nav" id="commonMoreMenu">
						<li class="dropdown" id="moreMenu">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu">
                                <strong>{vtranslate('LBL_ALL',$MODULE)}&nbsp;</strong>
								<b class="caret"></b>
							</a>
							<div class="dropdown-menu moreMenus" {if ($NUMBER_OF_PARENT_TABS <= 2) && ($NUMBER_OF_PARENT_TABS != 0)}style="width: 30em;"{elseif $NUMBER_OF_PARENT_TABS == 0}style="width: 10em;"{/if}>
								{foreach key=parent item=moduleList from=$moreMenus name=more}
									{if $NUMBER_OF_PARENT_TABS >= 4}
										{assign var=SPAN_CLASS value=span3}
									{elseif $NUMBER_OF_PARENT_TABS == 3}
										{assign var=SPAN_CLASS value=span4}
									{elseif $NUMBER_OF_PARENT_TABS <= 2}
										{assign var=SPAN_CLASS value=span6}
									{/if}
									{if $smarty.foreach.more.index % 4 == 0}
                                        {* SalesPlatform.ru begin *}
                                        {if $parent == 'ANALYTICS'}<br>{/if}
                                        {* SalesPlatform.ru end *}
										<div class="row-fluid">
										{/if}
										<span class="{$SPAN_CLASS}">
											<strong>{vtranslate("LBL_$parent",$moduleName)}</strong><hr>
											{foreach key=moduleName item=moduleModel from=$moduleList}
												{assign var='translatedModuleLabel' value=vtranslate($moduleModel->get('label'),$moduleName)}
												<label class="moduleNames"><a id="menubar_item_{$moduleName}" href="{$moduleModel->getDefaultUrl()}">{$translatedModuleLabel}</a></label>
												{/foreach}
										</span>
										{if $smarty.foreach.more.last OR ($smarty.foreach.more.index+1) % 4 == 0}
										</div>
									{/if}
								{/foreach}
								{if $USER_MODEL->isAdminUser()}
									<div class="row-fluid">
										<a id="menubar_item_moduleManager" href="index.php?module=MenuEditor&parent=Settings&view=Index" class="pull-right">{vtranslate('LBL_CUSTOMIZE_MAIN_MENU',$MODULE)}</a>
									</div>
									<div class="row-fluid">
										<a id="menubar_item_moduleManager" href="index.php?module=ModuleManager&parent=Settings&view=List" class="pull-right">{vtranslate('LBL_ADD_MANAGE_MODULES',$MODULE)}</a>
									</div>
								{/if}
							</div>
						</li>
					</ul>
                                       {else}
                                           <ul class="nav" id="commonMoreMenu1">
						<li class="dropdown" id="moreMenu">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu" style="color:#fff">
                                <strong>{vtranslate('Справочники',$MODULE)}&nbsp;</strong>
								<b class="caret"></b>
							</a>
							<div class="dropdown-menu">
								<div class="shortDropdown">

									<label class="moduleNames"><a id="menubar_item_ClientTypes" href="index.php?module=ClientTypes&amp;view=List">Типы Номеров</a></label>
                                                                        <label class="moduleNames"><a id="menubar_item_ListAccommodations" href="index.php?module=ListAccommodations&amp;view=List">Тип размешения</a></label>
									{if is_array($USER_MODEL->get('roleid'),$REGION)}
                                                                             <label class="moduleNames"><a id="menubar_item_ListCountry" href="index.php?module=ListCountry&view=List">Страны</a></label>
                                                                              <label class="moduleNames"><a id="menubar_item_ListTouroperators" href="index.php?module=ListTouroperators&view=List">Туроператоры</a></label>
                                                                              <label class="moduleNames"><a id="menubar_item_Documents" href="index.php?module=Documents&view=List">Доп.Материалы</a></label>
                                                                            {/if}
                                                                </div></div>
						</li>
					</ul>
                                       {/if}
                                        <ul class="nav" id="commonMoreMenu2">
						<li class="dropdown" id="moreMenu2">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu2" style="color:#fff">
                                <strong>{vtranslate('Аналитика',$MODULE)}&nbsp;</strong>
								<b class="caret"></b>
							</a>
							<div class="dropdown-menu">
								<div class="shortDropdown">

									<label class="moduleNames"><a id="report_leads" href="index.php?module=VDCustomReports&view=List&mode=getLeadsReport">Заявки</a></label>
                                                                        <label class="moduleNames"><a id="report_bron" href="index.php?module=VDCustomReports&view=List&mode=getBookingReport">Брони</a></label>
                                                                        <label class="moduleNames"><a id="report_stat" href="index.php?module=VDCustomReports&view=List&mode=getStatistic">Статистика</a></label>
                                                                        <label class="moduleNames"><a id="report_avg" href="index.php?module=VDCustomReports&view=List&mode=getAverage">Средний чек</a></label>
                                                                        <label class="moduleNames"><a id="report_proceeds" href="index.php?module=VDCustomReports&view=List&mode=getProceeds">Выручка и Доход</a></label>
												                        <label class="moduleNames"><a id="sales_plan" href="index.php?module=VDCustomReports&view=List&mode=getSalesPlan">План продаж</a></label>
												                        <label class="moduleNames"><a id="sales_funnel" href="index.php?module=VDCustomReports&view=List&mode=getSalesFunnel">Воронка продаж</a></label>
																		<label class="moduleNames"><a id="vilety" href="index.php?module=VDCustomReports&view=List&mode=getPolet">Города вылетов(в разработке)</a></label>

                                                                </div></div>
						</li>
					</ul>
                    {* Мастер тура для региональных *}
                    {if $USER_MODEL->getRole()=='H10'||$USER_MODEL->getRole()=='H11'||$USER_MODEL->getRole()=='H16'||$USER_MODEL->getRole()=='H49'||$USER_MODEL->getRole()=='H55'||$USER_MODEL->getRole()=='H62'||$USER_MODEL->getRole()=='H3'}
					<ul class="nav" id="commonMoreMenu3">
						<li class="dropdown" id="moreMenu3">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu3" style="color:#fff">
								<strong>{vtranslate('Мастер тура',$MODULE)}&nbsp;</strong>
								<b class="caret"></b>
							</a>
							<div class="dropdown-menu">
								<div class="shortDropdown">

									<label class="moduleNames"><a id="report_leads" href="index.php?module=ListTouroperators&view=List">Туроператоры</a></label>
									<label class="moduleNames"><a id="report_bron" href="index.php?module=ClientTypes&view=List">Типы Номеров</a></label>
									<label class="moduleNames"><a id="report_stat" href="index.php?module=VisaDocuments&view=List">Документы на визу</a></label>
									<label class="moduleNames"><a id="report_avg" href="index.php?module=TypeTourisVisa&view=List">Типы туристов для визы</a></label>
									<label class="moduleNames"><a id="report_proceeds" href="index.php?module=ListFoods&view=List">Типы питания</a></label>
									<label class="moduleNames"><a id="sales_plan" href="index.php?module=ListAccommodations&view=List">Типы размещения</a></label>
									<label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListResorts&view=List">Курорты</a></label>
									<label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListCountry&view=List">Страны</a></label>
									<label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListAirports&view=List">Аэропорты</a></label>
									<label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListAirlines&view=List">Авиалинии</a></label>
									<label class="moduleNames"><a id="sales_funnel" href="index.php?module=Services&view=List">Услуги</a></label>

								</div></div>
						</li>
					</ul>
					{/if}

					<ul class="nav" id="commonMoreMenu234">
						<li class="dropdown" id="moreMenu234">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu234" style="color:#fff">
								<strong>{vtranslate('Бухгалтерия',$MODULE)}&nbsp;</strong>
								<b class="caret"></b>
							</a>
							<div class="dropdown-menu">
								<div class="shortDropdown">

									<label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=workingHours">Учет рабочего времени</a></label>
									<label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=vacationSchedule">График отпусков</a></label>
									<label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=salary">Учет заработной платы</a></label>
									{*<label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=holidays">Праздничные дни</a></label>*}
									<label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=optionSalary">Параметры начисления заработной платы</a></label>
									<label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=workers">Сотрудники</a></label>

								</div>
                            </div>
						</li>
					</ul>


				</div>
				<div class="span3 marginLeftZero pull-right" id="headerLinks">
					<span id="headerLinksBig" class="pull-right headerLinksContainer">
						<span class="dropdown span settingIcons">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                {* SalesPlatform.ru begin *}
								<img src="{vimage_path('theme_brush.png')}" alt="theme roller" title="{vtranslate('Theme Roller',$MODULE)}" />
                         		{*<img src="{vimage_path('theme_brush.png')}" alt="theme roller" title="Theme Roller" />*}
                                {* SalesPlatform.ru end *}
                            </a>
							<ul class="dropdown-menu themeMenuContainer">
								<div id="themeContainer">
									{assign var=COUNTER value=0}
									{assign var=THEMES_LIST value=Vtiger_Theme::getAllSkins()}
									<div class="row-fluid themeMenu">
									{foreach key=SKIN_NAME item=SKIN_COLOR from=$THEMES_LIST}
										{if $COUNTER eq 3}
											</div>
											<div class="row-fluid themeMenu">
											{assign var=COUNTER value=1}
										{else}
											{assign var=COUNTER value=$COUNTER+1}
										{/if}
										<div class="span4 themeElement {if $USER_MODEL->get('theme') eq $SKIN_NAME}themeSelected{/if}" data-skin-name="{$SKIN_NAME}" title="{ucfirst($SKIN_NAME)}" style="background-color:{$SKIN_COLOR};"></div>
									{/foreach}
									</div>
								</div>
								<div id="progressDiv"></div>
							</ul>
						</span>
						{foreach key=index item=obj from=$HEADER_LINKS}
							{assign var="src" value=$obj->getIconPath()}
							{assign var="icon" value=$obj->getIcon()}
							{assign var="title" value=$obj->getLabel()}
							{assign var="childLinks" value=$obj->getChildLinks()}
							<span class="dropdown span{if !empty($src)} settingIcons {/if}">
								{if !empty($src)}
									<a id="menubar_item_right_{$title}" class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="{$src}" alt="{vtranslate($title,$MODULE)}" title="{vtranslate($title,$MODULE)}" /></a>
									{else}
										{assign var=title value=$USER_MODEL->get('first_name')}
										{if empty($title)}
											{assign var=title value=$USER_MODEL->get('last_name')}
										{/if}
									<span class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <a id="menubar_item_right_{$title}"  class="userName textOverflowEllipsis" title="{$title}"><strong>{$title}</strong>&nbsp;<i class="caret"></i> </a> </span>
									{/if}
									{if !empty($childLinks)}
									<ul class="dropdown-menu pull-right">
										{foreach key=index item=obj from=$childLinks}
											{if $obj->getLabel() eq NULL}
												<li class="divider">&nbsp;</li>
												{else}
													{assign var="id" value=$obj->getId()}
													{assign var="href" value=$obj->getUrl()}
													{assign var="label" value=$obj->getLabel()}
													{assign var="onclick" value=""}
													{if stripos($obj->getUrl(), 'javascript:') === 0}
														{assign var="onclick" value="onclick="|cat:$href}
														{assign var="href" value="javascript:;"}
													{/if}
												<li>
														<a target="{$obj->target}" id="menubar_item_right_{Vtiger_Util_Helper::replaceSpaceWithUnderScores($label)}" {if $label=='Switch to old look'}switchLook{/if} href="{$href}" {$onclick}>{vtranslate($label,$MODULE)}</a>
												</li>
											{/if}
										{/foreach}
									</ul>
								{/if}
							</span>
						{/foreach}
					</span>
					<div id="headerLinksCompact">
						<span class="btn-group dropdown qCreate cursorPointer">
							<img src="{vimage_path('btnAdd_white.png')}" class="" alt="{vtranslate('LBL_QUICK_CREATE',$MODULE)}" title="{vtranslate('LBL_QUICK_CREATE',$MODULE)}" data-toggle="dropdown"/>
							<ul class="dropdown-menu dropdownStyles pull-right commonActionsButtonDropDown">
								<li class="title"><strong>{vtranslate('Quick Create',$MODULE)}</strong></li><hr/>
								<li id="compactquickCreate">
									<div class="CompactQC">
										{foreach key=moduleName item=moduleModel from=$MENUS}
											{if $moduleModel->isPermitted('EditView')}
												{assign var='quickCreateModule' value=$moduleModel->isQuickCreateSupported()}
												{assign var='singularLabel' value=$moduleModel->getSingularLabelKey()}
												{if $quickCreateModule == '1'}
													<a class="quickCreateModule" data-name="{$moduleModel->getName()}"
													   data-url="{$moduleModel->getQuickCreateUrl()}" href="javascript:void(0)">{vtranslate($singularLabel,$moduleName)}</a>
												{/if}
											{/if}
										{/foreach}
									</div>
								</li>
							</ul>
						</span>
						<span  class="dropdown">
							<a class="dropdown-toggle btn-navbar" data-toggle="dropdown" href="#">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<ul class="dropdown-menu pull-right">
								{foreach key=index item=obj from=$HEADER_LINKS name="compactIndex"}
									{assign var="src" value=$obj->getIconPath()}
									{assign var="icon" value=$obj->getIcon()}
									{assign var="title" value=$obj->getLabel()}
									{assign var="childLinks" value=$obj->getChildLinks()}
									{if $smarty.foreach.compactIndex.index neq 0}
										<li class="divider">&nbsp;</li>
										{/if}
										{foreach key=index item=obj from=$childLinks}
											{assign var="id" value=$obj->getId()}
											{assign var="href" value=$obj->getUrl()}
											{assign var="label" value=$obj->getLabel()}
											{assign var="onclick" value=""}
											{if stripos($obj->getUrl(), 'javascript:') === 0}
												{assign var="onclick" value="onclick="|cat:$href}
												{assign var="href" value="javascript:;"}
											{/if}
										<li>
											<a target="{$obj->target}" id="menubar_item_right_{Vtiger_Util_Helper::replaceSpaceWithUnderScores($label)}" {if $label=='Switch to old look'}switchLook{/if} href="{$href}" {$onclick}>{vtranslate($label,$MODULE)}</a>
										</li>

									{/foreach}

								{/foreach}
							</ul>
						</span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	{assign var="announcement" value=$ANNOUNCEMENT->get('announcement')}
	<div class="announcement noprint" id="announcement">
		<marquee direction="left" scrolldelay="10" scrollamount="3" behavior="scroll" class="marStyle" onMouseOver="this.setAttribute('scrollamount', 0, 0);" OnMouseOut="this.setAttribute('scrollamount', 6, 0);">{if !empty($announcement)}{$announcement}{else}{vtranslate('LBL_NO_ANNOUNCEMENTS',$MODULE)}{/if}</marquee>
	</div>
	<input type='hidden' value="{$MODULE}" id='module' name='module'/>
	<input type="hidden" value="{$PARENT_MODULE}" id="parent" name='parent' />
	<input type='hidden' value="{$VIEW}" id='view' name='view'/>
{/strip}

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

{* Change to this also refer: AddCommentForm.tpl *}
{assign var="COMMENT_TEXTAREA_DEFAULT_ROWS" value="2"}

<div class="commentContainer recentComments">
	
	<hr><br>
	<div class="commentsBody">
		{if !empty($COMMENTS)}
			{foreach key=index item=COMMENT from=$COMMENTS}
				<div class="commentDetails">
					<div class="commentDiv">
						<div class="singleComment">
							<div class="commentInfoHeader row-fluid" data-commentid="{$COMMENT->getId()}" data-parentcommentid="{$COMMENT->get('parent_comments')}">
								<div class="commentTitle">
									
									<div class="row-fluid">
										<div class="span1">
											
											<img class="alignMiddle pull-left" src="{vimage_path('DefaultUserIcon.png')}">
										</div>
										<div class="span11 commentorInfo">
                                                                                         {assign var=FIELD_MODEL value=$COMMENT->getModule()->getField('assigned_user_id')}
                                                                                          {assign var=FIELD_VALUE value=$FIELD_MODEL->set('fieldvalue', $COMMENT->get('smcreatorid'))}
											
											<div class="inner">
												<span class="commentorName"><strong>{vtranslate($FIELD_MODEL->getDisplayValue($COMMENT->get('smcreatorid'), $COMMENT->getId(), $COMMENT), $MODULE_NAME)}</strong></span>
												<span class="pull-right">
													<p class="muted"><small title="{Vtiger_Util_Helper::formatDateTimeIntoDayString($COMMENT->get('createdtime'))}">{Vtiger_Util_Helper::formatDateDiffInStrings($COMMENT->get('createdtime'))}</small></p>
												</span>
												<div class="clearfix"></div>
											</div>
											<div class="commentInfoContent">
												<b>Задача:</b> {nl2br($COMMENT->get('description'))}<br />
                                                                                                
                                                                                              <p>  <b>Выполнено:</b> {if $COMMENT->get('cf_1085') neq '' }{nl2br($COMMENT->get('cf_1085'))}{else}<i>{vtranslate($COMMENT->get('eventstatus'),'Calendar')}</i>{/if}
                                                                                                  {if (strtotime($COMMENT->get('modifiedtime')) - strtotime($COMMENT->get('createdtime'))) > 180}
                                                                                                <span class="pull-right muted">
													<small title="{Vtiger_Util_Helper::formatDateTimeIntoDayString($COMMENT->get('modifiedtime'))}">{Vtiger_Util_Helper::formatDateDiffInStrings($COMMENT->get('modifiedtime'))}</small>
												</span></p>
                                                                                                {/if}
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			{/foreach}
		{else}
			{include file="NoComments.tpl"|@vtemplate_path}
		{/if}
	</div>
	{if $PAGING_MODEL->isNextPageExists()}
		<div class="row-fluid">
			<div class="pull-right">
				<a href="javascript:void(0)" class="moreRecentComments">{vtranslate('LBL_MORE',$MODULE_NAME)}..</a>
			</div>
		</div>
	{/if}
       
</div>
{/strip}
{*<!--
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: EntExt
 * The Initial Developer of the Original Code is EntExt.
 * All Rights Reserved.
 * If you have any questions or comments, please email: devel@entext.com
 ************************************************************************************/
-->*}
{strip}
    <div class="colorListContents" style="padding-left: 3%;padding-right: 3%">
        <form name="EditColorList" action="index.php" method="post" id="colorList_step1" class="form-horizontal">
            <input type="hidden" name="module" value="VDColorList">
            <input type="hidden" name="view" value="Edit">
            <input type="hidden" name="mode" value="Step2" />
            <input type="hidden" name="parent" value="Settings" />
            <input type="hidden" class="step" value="1" />
            <input type="hidden" name="record" value="{$RECORDID}" />
            <input type=hidden id="relatedModules" data-value='{ZEND_JSON::encode($RELATED_MODULES)}' />

            <div class="padding1per" style="border:1px solid #ccc;">
                <label>
                    <strong>{vtranslate('LBL_ENTER_BASIC_COLOR_DETAILS', $QUALIFIED_MODULE)}</strong>
                </label>
                <br>
                <div class="row-fluid padding1per">
					<span class="span3">{vtranslate('PRIMARY_MODULE',$MODULE)}<span class="redColor">*</span></span>
					<span class="span7 row-fluid">
						<select class="span6 chzn-select" id="primary_module" name="primary_module">
							<optgroup>
								{foreach key=RELATED_MODULE_KEY item=RELATED_MODULE from=$MODULELIST}
									<option value="{$RELATED_MODULE_KEY}" {if $MODULE_MODEL->name eq $RELATED_MODULE_KEY } selected="selected" {/if}>
										{vtranslate($RELATED_MODULE_KEY,$RELATED_MODULE_KEY)}
									</option>
								{/foreach}
							</optgroup>
						</select>
					</span>
				</div>
				<div class="row-fluid padding1per">
					<span class="span3">
						<div>{vtranslate('LBL_SELECT_RELATED_MODULES',$MODULE)}</div>
						<div>({vtranslate('LBL_MAX',$MODULE)}&nbsp;2)</div>
					</span>
					<span class="span7 row-fluid">
						{assign var=SECONDARY_MODULES_ARR value=explode(':',$COLORLIST_MODEL->getRelatedModules())}
						{assign var=PRIMARY_MODULE value=$MODULE_MODEL->name}

						{if $PRIMARY_MODULE eq ''}
							{foreach key=PARENT item=RELATED from=$RELATED_MODULES name=relatedlist}
								{if $smarty.foreach.relatedlist.index eq 0}
									{assign var=PRIMARY_MODULE value=$PARENT}
								{/if}
							{/foreach}
						{/if}
						{assign var=PRIMARY_RELATED_MODULES value=$RELATED_MODULES[$PRIMARY_MODULE]}
						<select class="span6 select2-container" id="secondary_module" multiple name="secondary_modules[]" data-placeholder="{vtranslate('LBL_SELECT_RELATED_MODULES',$MODULE)}">
							{foreach key=PRIMARY_RELATED_MODULE  item=PRIMARY_RELATED_MODULE_LABEL from=$PRIMARY_RELATED_MODULES}
								<option {if in_array($PRIMARY_RELATED_MODULE,$SECONDARY_MODULES_ARR)} selected="" {/if} value="{$PRIMARY_RELATED_MODULE}">{$PRIMARY_RELATED_MODULE_LABEL}</option>
							{/foreach}
						</select>
					</span>
				</div>
                <div class="row-fluid padding1per">
                    <span class="span3">
                        {vtranslate('LBL_DESCRIPTION', $QUALIFIED_MODULE)}<span class="redColor"> *</span>
                    </span>
                    <span class="span7 row-fluid">
                        <input type="text" name="summary" class="span5" data-validation-engine='validate[required]' value="{$COLORLIST_MODEL->get('summary')}" id="summary" />
                    </span>
                </div>
               <div class="row-fluid padding1per">
                    <span class="span3">
                        {vtranslate('LBL_COLOR', $QUALIFIED_MODULE)}<span class="redColor"> *</span>
                    </span>
                    <span class="span7">
                        <div id="cp2" class="input-group colorpicker-component"> 
                            <input name="color" type="text" value="{$COLORLIST_MODEL->get('color')}" class="form-control" data-validation-engine='validate[required]' /> 
                            <span class="input-group-addon" style="margin-left:-24px;"><i></i>
                            </span> 
                        </div> <script> $(function() { $('#cp2').colorpicker(); }); </script>
                        
                        
                    </span>
                </div>

        </div>
        <br>

        <div class="pull-right">
            <button class="btn btn-success" type="submit" disabled="disabled"><strong>{vtranslate('LBL_NEXT', $QUALIFIED_MODULE)}</strong></button>
            <a class="cancelLink" type="reset" onclick="javascript:window.history.back();">{vtranslate('LBL_CANCEL', $QUALIFIED_MODULE)}</a>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
{/strip}
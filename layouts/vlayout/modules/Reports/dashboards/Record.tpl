
<div class="dashboardWidgetHeader">
	{include file="dashboards/WidgetHeader.tpl"|@vtemplate_path:$MODULE_NAME}
        {if $SETTING_EXIST}
            {assign var=RECORD_STRUCTURE value=array()}
					{assign var=PRIMARY_MODULE_LABEL value=vtranslate($PRIMARY_MODULE, $PRIMARY_MODULE)}
					{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$PRIMARY_MODULE_RECORD_STRUCTURE}
						{assign var=PRIMARY_MODULE_BLOCK_LABEL value=vtranslate($BLOCK_LABEL, $PRIMARY_MODULE)}
						{assign var=key value="$PRIMARY_MODULE_LABEL $PRIMARY_MODULE_BLOCK_LABEL"}
						{if $LINEITEM_FIELD_IN_CALCULATION eq false && $BLOCK_LABEL eq 'LBL_ITEM_DETAILS'}
							{* dont show the line item fields block when Inventory fields are selected for calculations *}
						{else}
							{$RECORD_STRUCTURE[$key] = $BLOCK_FIELDS}
						{/if}
					{/foreach}
					{foreach key=MODULE_LABEL item=SECONDARY_MODULE_RECORD_STRUCTURE from=$SECONDARY_MODULE_RECORD_STRUCTURES}
						{assign var=SECONDARY_MODULE_LABEL value=vtranslate($MODULE_LABEL, $MODULE_LABEL)}
						{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$SECONDARY_MODULE_RECORD_STRUCTURE}
							{assign var=SECONDARY_MODULE_BLOCK_LABEL value=vtranslate($BLOCK_LABEL, $MODULE_LABEL)}
							{assign var=key value="$SECONDARY_MODULE_LABEL $SECONDARY_MODULE_BLOCK_LABEL"}
							{$RECORD_STRUCTURE[$key] = $BLOCK_FIELDS}
						{/foreach}
					{/foreach}
        <div class='hide'>
								{include file="chartReportHiddenContents.tpl"|@vtemplate_path:$MODULE_NAME}
							</div>
                
		{include file='dashboards/filter.tpl'|@vtemplate_path:$MODULE_NAME RECORD_STRUCTURE=$RECORD_STRUCTURE ADVANCE_CRITERIA=$SELECTED_ADVANCED_FILTER_FIELDS COLUMNNAME_API=getReportFilterColumnName}
                
	<script> window.Vtiger_AdvanceFilter_Js.getInstance(jQuery('.filterContainer'));
            
        </script>
        
        
        {/if}
        
</div>
<div class="dashboardWidgetContent ret">
    
	{include file="dashboards/DashBoardWidgetContents.tpl"|@vtemplate_path:$MODULE_NAME}
</div>


	{$SCRIPT_JS}


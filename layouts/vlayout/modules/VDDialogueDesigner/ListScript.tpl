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
    <div class="VDDialogueDesigner_container" style="padding-left: 3%;padding-right: 3%">
        <br />
        <br />
        <h2>{vtranslate('LBL_TITLE_LIST_SCRIPTS',$MODULE)}</h2>
        <hr />
        <div class="padding1per row-fluid" style="border:1px solid #ccc;">
            {assign var=MODULE_LIST value=$MODULE_MODEL->getListScript()}
            {assign var=count_script value=count($MODULE_LIST)}
            {if $count_script eq 1 }{assign var=SPAN value="span12"}{assign var=count value=1}
            {else if $count_script eq 2 } {assign var=SPAN value="span6"}{assign var=count value=2} 
            {else if $count_script eq 3 } {assign var=SPAN value="span4"}{assign var=count value=3}
            {else}   {assign var=SPAN value="span3"} {assign var=count value=4}{/if}
            {assign var=sp value=1}
            {foreach key=KEY item=SCRIPT from=$MODULE_MODEL->getListScript()}
                {if $sp eq 1}<div class="row-fluid">{/if}
                <div class="{$SPAN}">
                <a class="listScript" href="{$SCRIPT.link}">
                    <h3>{$SCRIPT.subject}</h3>
                    <p>{$SCRIPT.description}</p>
                </a>
                </div>
                {if $sp eq $count}</div> <br />{assign var=sp value=1}{else}{assign var=sp value=$sp+1}{/if}
                {/foreach}
                {if $sp neq 1}</div>{/if}
        </div>
    </div>
{/strip}
{literal}
<style>
    a.listScript {
        padding: 40px 20px;
        display: block;
        background: rgb(28, 116, 187) none repeat scroll 0% 0%;
        color: #fff !important;
        text-align: center;
        border-radius: 10px;
    }
    a.listScript h3{
        color: #fff;
    }
 </style>   
    
    
    
{/literal}
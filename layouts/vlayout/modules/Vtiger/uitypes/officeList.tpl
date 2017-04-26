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
      
      
        {assign var=PICKLIST_VALUES value=$LIST_VIEW_MODEL->getPicklistValuesOffice()}
      
      


    

	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
            {if $listvalue eq trim($PICKLIST_NAME)}{$PICKLIST_VALUE}{/if}
        
    {/foreach}


    
{strip}
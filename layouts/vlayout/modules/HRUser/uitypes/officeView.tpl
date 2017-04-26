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
      

        {assign var=PICKLIST_VALUES value=$FIELD_MODEL->getPicklistValuesOffice()}
     
      


    

	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
            {if trim(decode_html($FIELD_MODEL->get('fieldvalue'))) eq trim($PICKLIST_NAME) || $listvalue eq trim($PICKLIST_NAME)}{$PICKLIST_VALUE}{/if}
        
    {/foreach}


    
{strip}
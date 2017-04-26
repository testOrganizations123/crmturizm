{strip}
    {assign var=SINGLE_MODULE_NAME value='SINGLE_'|cat:$PARENTMODULENAME}
    <td>
        <span class="label label-info">Задача</span>
        <br><small>от {date('d.m.y', strtotime($LISTVIEW_ENTRY->rawData.createdtime))}</small>
    </td>
    <td>
        <strong> {vtranslate($LISTVIEW_ENTRY->rawData.activitytype,$MODULE)}</strong>
     </td>
     <td>
         <h4>{$LISTVIEW_ENTRY->rawData.subject}</h4>
            <strong>{$LISTVIEW_ENTRY->rawData.description}</strong>
               
            
            </td>
            <td>
                {vtranslate($LISTVIEW_ENTRY->rawData.priority,$MODULE)}
                
                                       
            </td>
            
{/strip}

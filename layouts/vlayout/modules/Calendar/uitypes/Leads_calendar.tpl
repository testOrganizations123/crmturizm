{strip}
    {assign var=SINGLE_MODULE_NAME value='SINGLE_'|cat:$PARENTMODULENAME}
    <td>
        <span class="label label-success">{vtranslate($SINGLE_MODULE_NAME,$PARENTMODULENAME)}</span>
        <br><small>от {date('d.m.y', strtotime($PARENTMODULE.createdtime))}</small>
    </td>
     <td>
        <small>
            {if $LISTVIEW_ENTRY->rawData.designation neq "" or $LISTVIEW_ENTRY->rawData.cf_1077 neq ""}
            <i class="fa fa-university"></i> {$LISTVIEW_ENTRY->rawData.designation}
             {if $LISTVIEW_ENTRY->rawData.designation neq "" or $LISTVIEW_ENTRY->rawData.cf_1077 neq ""}, {$LISTVIEW_ENTRY->rawData.cf_1077}{/if}<br>
            {/if}
             {if $LISTVIEW_ENTRY->rawData.noofemployees neq "" or $LISTVIEW_ENTRY->rawData.cf_1065 neq ""}
            <i class="fa fa-male"></i>{if $LISTVIEW_ENTRY->rawData.noofemployees neq ""} Взрослых: {$LISTVIEW_ENTRY->rawData.noofemployees}{/if}{if $LISTVIEW_ENTRY->rawData.cf_1065 neq ""}, детей: {$LISTVIEW_ENTRY->rawData.cf_1065} {if $LISTVIEW_ENTRY->rawData.cf_1079 neq ""}({$LISTVIEW_ENTRY->rawData.cf_1079}){/if}{/if}<br>
            {/if}
            {if $LISTVIEW_ENTRY->rawData.annualrevenue neq ""}
            <i class="fa fa-rub"></i> Бюджет: {$LISTVIEW_ENTRY->rawData.annualrevenue}<br>
            {/if}
            {if $LISTVIEW_ENTRY->rawData.cf_1111 neq ""}
            <i class="fa fa-plane"></i> Вылет:{if $LISTVIEW_ENTRY->rawData.cf_1111 neq ""}с {$LISTVIEW_ENTRY->rawData.cf_1111}{/if}{if $LISTVIEW_ENTRY->rawData.cf_1159 neq ""} по {$LISTVIEW_ENTRY->rawData.cf_1159}{/if}<br>
            {/if}
             {if $LISTVIEW_ENTRY->rawData.cf_1113 neq ""}
            <i class="fa fa-plane"></i> Прилёт:{if $LISTVIEW_ENTRY->rawData.cf_1113 neq ""}с {$LISTVIEW_ENTRY->rawData.cf_1113}{/if}{if $LISTVIEW_ENTRY->rawData.cf_1161 neq ""} по {$LISTVIEW_ENTRY->rawData.cf_1161}{/if}<br>
            {/if}                            								                                
            {if $LISTVIEW_ENTRY->rawData.cf_1075 neq ""}
            <i class="fa calendar-o"></i> Длительность: {$LISTVIEW_ENTRY->rawData.cf_1075} - {$LISTVIEW_ENTRY->rawData.cf_1352}<br>
            {/if}
        </small>
            {if $PARENTMODULE.description neq ""}
                            <p>{$PARENTMODULE.description}</p>
            {/if}
             {if $LISTVIEW_ENTRY->rawData.firstname neq "" or $LISTVIEW_ENTRY->rawData.lastname neq ""}
                 <p><strong>{if $LISTVIEW_ENTRY->rawData.firstname neq ""}{$LISTVIEW_ENTRY->rawData.firstname}{/if}{if $LISTVIEW_ENTRY->rawData.lastname neq ""} {$LISTVIEW_ENTRY->rawData.lastname}{/if}<br>{if $LISTVIEW_ENTRY->rawData.mobile neq ""}{$LISTVIEW_ENTRY->rawData.mobile}{/if}{if $LISTVIEW_ENTRY->rawData.phone neq ""}<br />{$LISTVIEW_ENTRY->rawData.phone}{/if}</strong></p>
             {/if}
        </td>
        <td width="40%">
        {assign var=LISTEVENT value=$LISTVIEW_ENTRY->getListEvent()}
        {assign var=counList value=count($LISTEVENT)}
           <!--   {foreach item=EVENT key=$keyEvent from=$LISTEVENT}
                  {if $keyEvent eq 0 and $EVENT.cf_1085 eq ""}
                      <label style="font-weight: bold">Новая задача {date('d.m.y H:i', strtotime($EVENT.createdtime))}</label>
                      {$EVENT.subject}<br />
                      {$EVENT.description}
                      
                  {else}
                      <small style="color: #999;">
                          {date('d.m.y H:i', strtotime($EVENT.createdtime))}<br />
                          {$EVENT.description}
                            </small>
                      <label style="font-weight: bold">Сделано по предыдущей задаче: </label>
                      {$EVENT.cf_1085}
                      
                  {/if}
              {/foreach}
            -->
            {if count($LISTEVENT.1) neq 0}
                        <small style="color: #999;">
                         {$LISTEVENT.0.subject} {date('d.m.y H:i', strtotime($LISTEVENT.1.createdtime))}<br />
                          {$LISTEVENT.1.description}
                            </small>
                      <label style="font-weight: bold">Сделано по предыдущей задаче: </label>
                      {$LISTEVENT.1.cf_1085}
                      <hr />
            {/if}
             {if count($LISTEVENT.0) neq 0 and $LISTEVENT.0.cf_1085 eq ""}
                      <label style="font-weight: bold">Новая задача {date('d.m.y H:i', strtotime($LISTEVENT.0.createdtime))}</label>
                      {$LISTEVENT.0.subject}<br />
                      {$LISTEVENT.0.description}
             
             {else}
                      <small style="color: #999;">
                          {$LISTEVENT.0.subject} {date('d.m.y H:i', strtotime($LISTEVENT.0.createdtime))}<br />
                          {$LISTEVENT.0.description}
                            </small>
                      <label style="font-weight: bold">Сделано по предыдущей задаче: </label>
                      {$LISTEVENT.0.cf_1085}
            {/if}
            
            </td>
            <td>{if $LISTVIEW_ENTRY->rawData.priority neq ''}
                {if $LISTVIEW_ENTRY->rawData.priority eq 'Ahight'}<b>{vtranslate($LISTVIEW_ENTRY->rawData.priority,$MODULE)}</b>{else}
                {vtranslate($LISTVIEW_ENTRY->rawData.priority,$MODULE)}{/if}
                <hr />
                {/if}
                {if $LISTVIEW_ENTRY->rawData.rating neq ''}
                <b>Тип клиента:</b><br />
                {$LISTVIEW_ENTRY->rawData.rating}
                {/if}
                 {if $LISTVIEW_ENTRY->rawData.leadsource neq ''}
                <br />
                 <b>Источник:</b><br />
                 <span class="">
                                 {vtranslate($LISTVIEW_ENTRY->rawData.leadsource,$MODULE)}
                            </span>
                            {/if}
            </td>
            
{/strip}

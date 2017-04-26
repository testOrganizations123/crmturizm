<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
$languageStrings = array(
	'Vendors'                      => 'Юр.Лица туроператоров'        , 
	'SINGLE_Vendors'               => 'Юр.Лицо туроператора'          , 
    'LBL_EXPORT_TO_PDF'            => 'Экспорт в PDF:'       , 
	'LBL_SEND_MAIL_PDF'            => 'Отправить PDF по Email:',
	'LBL_ADD_RECORD'               => 'Добавить Юр.Лицо'                  , // TODO: Review
	'LBL_RECORDS_LIST'             => 'Список Юр.Лиц'                , // TODO: Review
	'LBL_VENDOR_INFORMATION'       => 'Информация о Туроператоре', 
	'LBL_VENDOR_ADDRESS_INFORMATION' => 'Адресная информация', 
	'Vendor Name'                  => 'Сокращенное наименование', 
	'Vendor No'                    => 'Туроператор №'      , 
	'Website'                      => 'Веб-сайт'             , 
	'GL Account'                   => 'Счет в главной книге', 
	'300-Sales-Software'           => '300-Продажа-Программного-Обеспечения', 
	'301-Sales-Hardware'           => '301-Продажа-Комплектующих', 
	'302-Rental-Income'            => '302-Доход-с-Аренды', 
	'303-Interest-Income'          => '303-Прибыль'          , 
	'304-Sales-Software-Support'   => '304-Продажи-Поддержка-Программного-Обеспечения', 
	'305-Sales Other'              => '305-Продажи-Другое', 
	'306-Internet Sales'           => '306-Продажи-Интернет', 
	'307-Service-Hardware Labor'   => '307-Сервис-Работа', 
	'308-Sales-Books'              => '308-Продажи-Книги',
    'LBL_to'                       => '-',
    
        //SalesPLatfomr.ru begin add locale
        'LBL_VENDORS_ADD_EVENT' => 'Добавить Событие',
        'LBL_VENDORS_ADD_TASK'   => 'Добавить Задачу',
    'turoperator' => 'Туроператор',
    'ticketvendor' => 'Поставщик Авиа/ЖД билетов',
        //SalesPlatform.ru end
);
$jsLanguageStrings = array(
	'LBL_RELATED_RECORD_DELETE_CONFIRMATION' => 'Вы уверены, что хотите удалить?', // TODO: Review	
    'LBL_DELETE_CONFIRMATION'      => 'Удаление данного Туроператора удалит связанные с ним Закупки. Вы уверены, что хотите удалить Туроператора?', // TODO: Review	
    'LBL_MASS_DELETE_CONFIRMATION' => 'Удаление выбранных Туроператоров удалит связанные с ними Закупки. Вы уверены, что хотите удалить выбранных Туроператоров?', // TODO: Review
);

// SalesPlatform.ru begin SPConfiguration fix
include 'renamed/Vendors.php';
// SalesPlatform.ru end
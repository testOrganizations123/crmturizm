<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H91';

$current_user_parent_role_seq='H1::H2::H3::H16::H43::H91';

$current_user_profiles=array(2,);

$profileGlobalPermission=array('1'=>1,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'13'=>0,'14'=>0,'15'=>0,'16'=>0,'18'=>0,'19'=>0,'20'=>0,'21'=>0,'22'=>0,'23'=>0,'24'=>0,'25'=>0,'26'=>0,'27'=>0,'30'=>0,'31'=>0,'32'=>0,'33'=>0,'34'=>0,'35'=>0,'36'=>0,'37'=>0,'38'=>0,'39'=>0,'40'=>0,'41'=>0,'42'=>0,'43'=>0,'44'=>0,'45'=>0,'46'=>0,'47'=>0,'48'=>0,'49'=>0,'50'=>0,'51'=>0,'52'=>0,'53'=>0,'54'=>0,'55'=>0,'56'=>0,'57'=>0,'58'=>0,'59'=>0,'60'=>0,'61'=>0,'62'=>0,'63'=>0,'64'=>0,'65'=>0,'66'=>0,'67'=>0,'68'=>0,'69'=>0,'70'=>0,'71'=>0,'72'=>0,'73'=>0,'74'=>0,'75'=>0,'76'=>0,'77'=>0,'78'=>0,'79'=>0,'80'=>0,'81'=>0,'82'=>0,'83'=>0,'84'=>0,'85'=>0,'86'=>0,'87'=>0,'88'=>0,'89'=>0,'90'=>0,'28'=>0,);

$profileActionPermission=array(2=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),4=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),6=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),7=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,9=>0,10=>0,),8=>array(0=>0,1=>0,2=>1,3=>0,4=>0,6=>1,),9=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),13=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>0,10=>0,),14=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,10=>0,),15=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),16=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),18=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,10=>0,),19=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,10=>0,),20=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),21=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),22=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),23=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),25=>array(0=>1,1=>1,2=>1,4=>1,6=>0,13=>0,),26=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),34=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),36=>array(0=>0,1=>0,2=>1,3=>0,4=>0,11=>0,12=>0,),37=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),39=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),40=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),42=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),44=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),45=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),46=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),48=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),49=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),50=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),51=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),56=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),60=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,),62=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),63=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),64=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),65=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),66=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),67=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),68=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),69=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),70=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),71=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),72=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,8=>1,10=>1,),74=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),75=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),76=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),77=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),78=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),79=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),80=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),83=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),85=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),86=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),87=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),89=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),90=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>1,),);

$current_user_groups=array(3,4,);

$subordinate_roles=array();

$parent_roles=array('H1','H2','H3','H16','H43',);

$subordinate_roles_users=array();

$user_info=array('user_name'=>'minakina','is_admin'=>'off','user_password'=>'$1$mi000000$dc422sOXTeceUjPa6AM030','confirm_password'=>'$1$mi000000$dc422sOXTeceUjPa6AM030','first_name'=>'Виктория','last_name'=>'Минакина','roleid'=>'H91','email1'=>'abakan1@moihottur.ru','status'=>'Active','activity_view'=>'This Month','lead_view'=>'Last 2 Days','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'','department'=>'','phone_mobile'=>'','reports_to_id'=>'34','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd.mm.yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'3N20WLgyPCSDumKB','time_zone'=>'Africa/Algiers','currency_id'=>'1','currency_grouping_pattern'=>'123456789','currency_decimal_separator'=>',','currency_grouping_separator'=>'&#039;','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'ru_ru','reminder_interval'=>'','phone_crm_extension'=>'','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'0','rowheight'=>'medium','defaulteventstatus'=>'Выберите опцию','defaultactivitytype'=>'Выберите опцию','hidecompletedevents'=>'0','is_owner'=>'0','spcompany'=>'ИП Миндюк Ю.Х.','office'=>'413','numdover'=>'2 от 01.01.2017','midlename'=>'Александровна','fio_r'=>'Степановой Дарьи Владимировны','add_user'=>'0','currency_name'=>'Russia, Rubles','currency_code'=>'RUB','currency_symbol'=>'руб','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','id'=>'146');
?>
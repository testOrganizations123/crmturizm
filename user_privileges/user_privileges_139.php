<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H11';

$current_user_parent_role_seq='H1::H2::H3::H11';

$current_user_profiles=array(5,);

$profileGlobalPermission=array('1'=>1,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'16'=>0,'18'=>0,'24'=>0,'25'=>0,'26'=>0,'27'=>0,'30'=>0,'34'=>0,'35'=>0,'36'=>0,'39'=>0,'40'=>0,'41'=>0,'42'=>0,'43'=>0,'44'=>0,'45'=>0,'46'=>0,'47'=>0,'48'=>0,'49'=>0,'50'=>0,'53'=>1,'54'=>0,'55'=>0,'57'=>1,'58'=>1,'59'=>0,'60'=>0,'61'=>1,'62'=>0,'63'=>0,'64'=>0,'65'=>0,'66'=>0,'67'=>0,'68'=>0,'69'=>0,'70'=>0,'71'=>0,'72'=>0,'73'=>0,'74'=>0,'75'=>0,'76'=>0,'77'=>0,'78'=>0,'79'=>0,'80'=>0,'81'=>0,'82'=>0,'83'=>0,'84'=>0,'85'=>0,'86'=>0,'87'=>0,'88'=>0,'89'=>0,'90'=>0,'28'=>0,'3'=>0,);

$profileActionPermission=array(2=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),4=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),6=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),7=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,9=>0,10=>0,),8=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>0,8=>1,10=>1,),9=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>1,),16=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>1,),18=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,8=>1,10=>1,),25=>array(0=>1,1=>1,2=>1,4=>1,5=>1,6=>0,8=>1,10=>1,13=>0,),26=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>1,8=>1,10=>1,),34=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>1,8=>1,10=>1,),36=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>1,8=>1,10=>1,11=>0,12=>0,),39=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),40=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),42=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>1,8=>1,10=>1,),44=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),45=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),46=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),48=>array(0=>0,1=>0,2=>0,4=>0,5=>0,6=>0,8=>1,10=>0,),49=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>1,8=>1,10=>1,),50=>array(0=>0,1=>0,2=>0,4=>0,5=>1,6=>1,8=>1,10=>1,),60=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,),62=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),63=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),64=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),65=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),66=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),67=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),68=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),69=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),70=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),71=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),72=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,8=>1,10=>1,),74=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),75=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),76=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),77=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),78=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),79=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),80=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),83=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),85=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),86=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),87=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),89=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),90=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,),);

$current_user_groups=array(3,4,);

$subordinate_roles=array('H12','H13','H14','H15','H28','H29','H30','H31','H66','H32','H33','H34','H35','H36','H37','H92','H93',);

$parent_roles=array('H1','H2','H3',);

$subordinate_roles_users=array('H12'=>array(13,),'H13'=>array(14,),'H14'=>array(15,48,),'H15'=>array(50,148,),'H28'=>array(60,),'H29'=>array(),'H30'=>array(59,61,62,),'H31'=>array(76,77,84,106,122,123,127,),'H66'=>array(74,),'H32'=>array(53,83,),'H33'=>array(),'H34'=>array(54,56,57,),'H35'=>array(73,143,),'H36'=>array(64,),'H37'=>array(65,),'H92'=>array(),'H93'=>array(152,),);

$user_info=array('user_name'=>'test2test2','is_admin'=>'off','user_password'=>'$1$te000000$a1FrcVSdUJr/K/nxHGKGl.','confirm_password'=>'$1$te000000$a1FrcVSdUJr/K/nxHGKGl.','first_name'=>'Имя_Имя_Имя','last_name'=>'Фамилия_Фамилия_Фамилия','roleid'=>'H11','email1'=>'test2test2@gmail.com','status'=>'Active','activity_view'=>'This Month','lead_view'=>'Last 2 Days','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'','department'=>'','phone_mobile'=>'','reports_to_id'=>'','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd.mm.yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'0HjKNAdnWL4QXxd','time_zone'=>'Africa/Algiers','currency_id'=>'1','currency_grouping_pattern'=>'123456789','currency_decimal_separator'=>',','currency_grouping_separator'=>'&#039;','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'ru_ru','reminder_interval'=>'','phone_crm_extension'=>'','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'0','rowheight'=>'medium','defaulteventstatus'=>'Выберите опцию','defaultactivitytype'=>'Выберите опцию','hidecompletedevents'=>'0','is_owner'=>'0','spcompany'=>'','office'=>'','numdover'=>'','midlename'=>'','fio_r'=>'','add_user'=>'0','currency_name'=>'Russia, Rubles','currency_code'=>'RUB','currency_symbol'=>'руб','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','id'=>'139');
?>
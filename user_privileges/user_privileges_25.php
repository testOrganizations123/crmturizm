<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H25';

$current_user_parent_role_seq='H1::H2::H3::H10::H24::H25';

$current_user_profiles=array(2,);

$profileGlobalPermission=array('1'=>1,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'13'=>0,'14'=>0,'15'=>0,'16'=>0,'18'=>0,'19'=>0,'20'=>0,'21'=>0,'22'=>0,'23'=>0,'24'=>0,'25'=>0,'26'=>0,'27'=>0,'30'=>1,'31'=>0,'32'=>0,'33'=>0,'34'=>0,'35'=>0,'36'=>0,'37'=>0,'38'=>0,'39'=>0,'40'=>0,'41'=>0,'42'=>0,'43'=>0,'44'=>0,'45'=>0,'46'=>0,'47'=>0,'48'=>0,'49'=>0,'50'=>0,'51'=>0,'52'=>0,'53'=>0,'54'=>0,'55'=>0,'56'=>0,'57'=>0,'58'=>0,'59'=>0,'60'=>0,'61'=>1,'62'=>0,'63'=>0,'64'=>0,'65'=>0,'66'=>0,'67'=>0,'68'=>0,'69'=>0,'70'=>0,'71'=>0,'72'=>0,'73'=>0,'74'=>0,'28'=>0,);

$profileActionPermission=array(2=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),4=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),6=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>0,10=>0,),7=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,9=>0,10=>0,),8=>array(0=>0,1=>0,2=>0,3=>0,4=>0,6=>1,),9=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),13=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>0,10=>0,),14=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,10=>0,),15=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),16=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),18=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,10=>0,),19=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,10=>0,),20=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),21=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),22=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),23=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),25=>array(0=>1,1=>1,2=>1,4=>1,6=>0,13=>0,),26=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),34=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),36=>array(0=>0,1=>0,2=>0,3=>0,4=>0,11=>0,12=>0,),37=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),39=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),40=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),42=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),44=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),45=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),46=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),48=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),49=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),50=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),51=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),56=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),60=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,),62=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),63=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),64=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),65=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),66=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),67=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),68=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),69=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),70=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),71=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),74=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),);

$current_user_groups=array(3,4,);

$subordinate_roles=array('H26','H27',);

$parent_roles=array('H1','H2','H3','H10','H24',);

$subordinate_roles_users=array('H26'=>array(),'H27'=>array(),);

$user_info=array('user_name'=>'volkova','is_admin'=>'off','user_password'=>'$1$vo000000$7ADG6CQh32EGGfya2v8gU1','confirm_password'=>'$1$vo000000$7ADG6CQh32EGGfya2v8gU1','first_name'=>'Елена','last_name'=>'Волкова','roleid'=>'H25','email1'=>'fl.omsk2@moihottur.ru','status'=>'Active','activity_view'=>'Today','lead_view'=>'Today','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'','department'=>'','phone_mobile'=>'','reports_to_id'=>'22','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd.mm.yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'uWhZTHOYZeQpTORL','time_zone'=>'Pacific/Midway','currency_id'=>'1','currency_grouping_pattern'=>'123456789','currency_decimal_separator'=>',','currency_grouping_separator'=>'&#039;','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'ru_ru','reminder_interval'=>'','phone_crm_extension'=>'','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'0','rowheight'=>'medium','defaulteventstatus'=>'Выберите опцию','defaultactivitytype'=>'Выберите опцию','hidecompletedevents'=>'0','is_owner'=>'0','spcompany'=>'ИП Миндюк А.В.','office'=>'','numdover'=>'10 от 28.03.2016','midlename'=>'Владимировна','currency_name'=>'Russia, Rubles','currency_code'=>'RUB','currency_symbol'=>'руб','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','id'=>'25');
?>
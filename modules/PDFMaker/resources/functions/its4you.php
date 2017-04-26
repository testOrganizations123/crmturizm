<?php

/**
 * This function executes if-else statement based on given parameters
 *  
 * @param $param1 first parameter of comparation
 * @param $comparator comparation sign - one of ==,!=,<,>,<=,>=
 * @param $param2 second parameter of comparation
 * @param $whatToReturn1 value returned when comparation succeded
 * @param $whatToReturn2 value returned when comparation not succeded
 * */

if (!function_exists('its4you_if')) {

    function its4you_if($param1, $comparator, $param2, $whatToReturn1, $whatToReturn2 = '') {
        global $default_charset;
        $param1 = htmlentities($param1, ENT_QUOTES, $default_charset);
        $comparator = html_entity_decode($comparator, ENT_COMPAT, 'utf-8');
        $param2 = htmlentities($param2, ENT_QUOTES, $default_charset);
        $whatToReturn1 = htmlentities($whatToReturn1, ENT_QUOTES, $default_charset);
        $whatToReturn2 = htmlentities($whatToReturn2, ENT_QUOTES, $default_charset);
        switch ($comparator) {
            case "=":
                $comparator = '==';
                break;
            case "<>":
                $comparator = '!=';
                break;
            case "=>":
                $comparator = '>=';
                break;
            case "=<":
                $comparator = '<=';
                break;
        }


        if (in_array($comparator, array('==', '!=', '>=', '<=', '>', '<')))
            return nl2br(html_entity_decode(eval("if('$param1' $comparator '$param2'){return '$whatToReturn1';} else {return '$whatToReturn2';}"), ENT_COMPAT, $default_charset));
        else
            return "Error! second parameter must be one from following: ==,!=,<,>,<=,>=";
    }

}
if (!function_exists('RouteShort')) {
function RouteShort ($departure_from,$departure_to,$arrival_from,$arrival_to) {
    $departure_from = explode('#',$departure_from);
    $departure_to = explode('#',$departure_to);
    $arrival_to = explode('#',$arrival_to);
    $arrival_from = explode('#',$arrival_from);
    $html = "";
    foreach ($departure_from as $key=> $value){
        if ($key != 0) $html .=" - ";
        $html .= $value ." - ". $departure_to[$key];
        $last_departure_to = $departure_to[$key];
    }
    foreach ($arrival_from as $key=>$value){
        if ($key == 0 && $last_departure_to == $value) $html .=" - ". $arrival_to[$key];
        else {
           $html .=$value." - ". $arrival_to[$key]; 
        }
    }
    return $html;
}
}
if (!function_exists('getTuroperatorName')) {
function getTuroperatorName ($id) {
    if(!empty($id)){
        $adb = PearDatabase::getInstance();
            $query = "SELECT *"
                    . " FROM vtiger_listtouroperators"
                    . " WHERE listtouroperatorsid = ?";
             $result = $adb->pquery($query, array($company));
                $name = $adb->query_result($result, 0, 'turoperator_name');
                return $name;
    }
}

}
if (!function_exists('RouteFULL')) {
function RouteFULL ($departure_data, $fly, $company, $departure_from,  $arrival_to, $arrival_data) {
    $departure_from = explode('#',$departure_from);
    $arrival_to = explode('#',$arrival_to);
    $departure_data = explode('#',$departure_data);
    $fly = explode('#',$fly);
    $company = explode('#',$company);
    $arrival_data = explode('#',$arrival_data);
    
    $html = " ".date('d.m.Y', strtotime($departure_data[0])).",";
    foreach ($departure_data as $key=>$value){
        if($key > 0){
            $html .= " За тем стыковочный";
        }
    $html .= " рейс ".$fly[$key].", авиакомпания ".$company[$key]
            .", вылет из а/п ".$departure_from[$key]." ".date('d.m.Y в H:i', strtotime($departure_data[$key]))."(время местное). Прилет в а/п ".
            $arrival_to[$key]." ".date('d.m.Y около H:i', strtotime($arrival_data[$key]))."(время местное).";
    }
    return $html;
    
}

}
if (!function_exists('is_charter')) {
function is_charter ($departure,$arrival) {
    $departure = explode('#',$departure);
    $arrival = explode('#',$arrival);
    $regulat = false;
    $charter = false;
    if (in_array('регулярный', $departure) || in_array('регулярный', $arrival)){
        $regulat = true;
    }
    if (in_array('чартер', $departure) || in_array('чартер', $arrival)){
        $charter = true;
    }
    if ($charter === false and $regulat === false){
        $html = '(чартерный рейс)';
    }
    else if ($charter === false and $regulat === true) {
        $html = '(регулярный рейс)';
    }
    else if ($charter === true and $regulat === false) {
        $html = '(чартерный рейс)';
    }
    else if ($charter === true and $regulat === true) {
        $html = '(чартерный и регулярный рейс)';
    }
    
    return $html;
}
}
if (!function_exists('dogovor_header_agent')) {
function dogovor_header_agent ($company, $user, $dover) {
    
    if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.organizationname, b.inn, b.entrepreneurreg, b.director"
                    . " FROM vtiger_spcompany as a"
                    . " LEFT JOIN vtiger_organizationdetails as b ON b.organization_id = a.spcompanyid"
                    . " WHERE a.spcompany = ?";
            
                $result = $adb->pquery($query, array($company));
                $name = $adb->query_result($result, 0, 'organizationname');
                $inn = $adb->query_result($result, 0, 'inn');
                $entrepreneurreg = $adb->query_result($result, 0, 'entrepreneurreg');
                $director = $adb->query_result($result, 0, 'director');
                
                $director_array = explode(' ', $director);
                if ($user == $director){
                    $_director = true;
                }
               
                if (strlen($inn) == 12){
                    $html .= "Индивидуальным Предпринимателем $company (торговая марка «Мой горящий тур!»), действующего на основании свидетельства о государственной регистрации физического лица в качестве индивидуального предпринимателя серия ".$entrepreneurreg;
                } 
                else {
                    $html .= "$name (торговая марка «Мой горящий тур!»)";
                }
                 if ($user == $director){
                    $html .= ", в лице директора $director, действующего на основании Устава";
                }
                else {
                   $html .=", в лице менеджера по туризму $user, действующего на основании доверенности $dover";
                }
                
               
                
            
            
    }
            return $html;
           
}

}
if (!function_exists('dogovor_manager')) {
    function dogovor_manager ($company, $user, $dover, $user_id){
        if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.organizationname, b.inn, b.entrepreneurreg, b.director"
                    . " FROM vtiger_spcompany as a"
                    . " LEFT JOIN vtiger_organizationdetails as b ON b.organization_id = a.spcompanyid"
                    . " WHERE a.spcompany = ?";
            
                $result = $adb->pquery($query, array($company));
                $name = $adb->query_result($result, 0, 'organizationname');
                $inn = $adb->query_result($result, 0, 'inn');
                $entrepreneurreg = $adb->query_result($result, 0, 'entrepreneurreg');
                $director = $adb->query_result($result, 0, 'director');
                $query = "SELECT * FROM vtiger_users WHERE id = ?";
                $result = $adb->pquery($query, array($user_id));
                $row = $adb->query_result_rowdata($result,0);
                $user_orig = $row['last_name']." ".$row['first_name']." ".$row['midlename'];
                
                $director_array = explode(' ', $director);
               
               
                
                if ($user_orig == $director){
                    $html .= ", в лице директора $user, действующего на основании Устава";
                }
                else {
                   $html .=", в лице менеджера по туризму $user, действующего на основании доверенности $dover";
                }
                
               
                
            
            
    }
            return $html;
    }
}
if (!function_exists('company_reg')) {
function company_reg ($company) {
    
    if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.organizationname, b.inn, b.entrepreneurreg, b.director"
                    . " FROM vtiger_spcompany as a"
                    . " LEFT JOIN vtiger_organizationdetails as b ON b.organization_id = a.spcompanyid"
                    . " WHERE a.spcompany = ?";
            
                $result = $adb->pquery($query, array($company));
                $name = $adb->query_result($result, 0, 'organizationname');
                $inn = $adb->query_result($result, 0, 'inn');
                
                if (strlen($inn)>10){
                    $entrepreneurreg = 'на основании свидетельства серия '.$adb->query_result($result, 0, 'entrepreneurreg');
                }
                else {
                    $entrepreneurreg = '';
                }
               
                
            
            
    }
            return  $entrepreneurreg;
           
}
}
if (!function_exists('dogovor_header_all_otchet')) {
function dogovor_header_agent_otchet ($company, $user, $dover) {
    
    if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.organizationname, b.inn, b.entrepreneurreg, b.director"
                    . " FROM vtiger_spcompany as a"
                    . " LEFT JOIN vtiger_organizationdetails as b ON b.organization_id = a.spcompanyid"
                    . " WHERE a.spcompany = ?";
            
                $result = $adb->pquery($query, array($company));
                $name = $adb->query_result($result, 0, 'organizationname');
                $inn = $adb->query_result($result, 0, 'inn');
                $entrepreneurreg = $adb->query_result($result, 0, 'entrepreneurreg');
                $director = $adb->query_result($result, 0, 'director');
                
                $director_array = explode(' ', $director);
                if ($user == $director){
                    $_director = true;
                }
               
                if (strlen($inn) == 12){
                    $html .= "$company (торговая марка «Мой горящий тур!»), действующего на основании свидетельства о государственной регистрации физического лица в качестве индивидуального предпринимателя серия ".$entrepreneurreg;
                } 
                else {
                    $html .= "$name (торговая марка «Мой горящий тур!»)";
                }
                if ($user == $director){
                    $html .= ", в лице директора $director, действующего на основании Устава";
                }
                else {
                   $html .=", в лице менеджера по туризму $user, действующего на основании доверенности $dover";
                }
                
               
                
            
            
    }
            return $html;
           
}
}
if (!function_exists('is_charter_FULL')) {
function is_charter_FULL ($departure,$arrival,$departure_flite,$arrival_flite) {
    
    $departure = explode('#',$departure);
    $arrival = explode('#',$arrival);
    $regular = false;
    $charter = false;
    $html = '';
    if (in_array('регулярный', $departure) || in_array('регулярный', $arrival)){
        $regular = true;
    }
    if (in_array('чартер', $departure) || in_array('чартер', $arrival)){
        $charter = true;
    }
    
    if (($charter===true && $regular===false) || ($charter===false && $regular===false)){
        $html = "Уведомлен, в том, что авиарейсы чартерные, в связи с чем, дата и время вылета авиакомпания вправе изменить, поэтому обязуюсь уточнить дату и время вылета за сутки до вылета, способ уточнения обязуюсь определить самостоятельно. Понимаю, что БЮРО ответственности за данные изменения не несет и нести не может.";
    } elseif ($charter===false && $regular===true){
        $html = "";
    } elseif ($charter===true && $regular===true){
        $departure_flite = explode('#',$departure_flite);
        $arrival_flite = explode('#',$arrival_flite);
        $flite = array();
        foreach ($departure as $key=>$value){
            if($value == 'чартер'){
                $flite[]=$departure_flite[$key];
            }
        }
        foreach ($departure as $key=>$value){
            if($value == 'чартер'){
                $flite[]=$departure_flite[$key];
            }
        }
        if (count($flite)>1){
            $html = "Уведомлен, в том, что авиарейсы (".implode(', ', $flite).") чартерные, в связи с чем, дата и время вылета авиакомпания вправе изменить, поэтому обязуюсь уточнить дату и время вылета за сутки до вылета, способ уточнения обязуюсь определить самостоятельно. Понимаю, что БЮРО ответственности за данные изменения не несет и нести не может.";
   
        }else{
             $html = "Уведомлен, в том, что авиарейс (".implode(', ', $flite).") чартерный, в связи с чем, дата и время вылета авиакомпания вправе изменить, поэтому обязуюсь уточнить дату и время вылета за сутки до вылета, способ уточнения обязуюсь определить самостоятельно. Понимаю, что БЮРО ответственности за данные изменения не несет и нести не может.";
   
        }
    }
    
   
    return $html;
}

}
if (!function_exists('VisaListDoc')) {
function VisaListDoc ($data) {
    global $adb;
    $visa_doc = json_decode(htmlspecialchars_decode($data),true);
    $array = array();
    if (count($visa_doc)>0){
        foreach ($visa_doc as $value){
            if (count($value['documents'])>0){
                foreach ($value['documents'] as $id=>$_value){
                    array_push($array, $id);
                }
            }
        }
    }
    $array = array_unique($array);
    $sql = "SELECT * FROM vtiger_visadocuments WHERE visadocumentsid IN (".implode(', ', $array).")";
    $result = $adb->pquery($sql, array());
    $document = array();
    for($i=0; $i<count($array);$i++){
        array_push($document, $adb->query_result($result,$i,'document_name'));
    }
    
    return implode(', ', $document);
}

}
if (!function_exists('VisaListTurist')) {
function VisaListTurist ($data) {
    global $adb;
    $visa_doc = json_decode(htmlspecialchars_decode($data),true);
    $array = array();
    $contact_id = array();
    $list = array();
    if (count($visa_doc)>0){
        foreach ($visa_doc as $key=>$value){
            if (count($value['documents'])>0){
                $list[$key]['documents'] = $value['documents']; 
                    array_push($contact_id, $key);
                foreach ($value['documents'] as $id=>$_value){
                    array_push($array, $id);
                }
            }
        }
    }
    $sql = "SELECT a.cf_1330, a.cf_1087, b.lastname, b.firstname, a.contactid FROM vtiger_contactscf as a LEFT JOIN vtiger_contactdetails as b ON b.contactid = a.contactid WHERE a.contactid IN (".implode(',', $contact_id).")";
    
    $result = $adb->pquery($sql, array());
    
    for ($i=0;$i<count($contact_id);$i++){
         $list[$adb->query_result($result,$i,'contactid')]['name'] = $adb->query_result($result,$i,'lastname')." ".$adb->query_result($result,$i,'firstname')." ".$adb->query_result($result,$i,'cf_1087'); 
    }
    $array = array_unique($array);
    $sql = "SELECT * FROM vtiger_visadocuments WHERE visadocumentsid IN (".implode(', ', $array).")";
    $result = $adb->pquery($sql, array());
    $document = array();
    
    for($i=0; $i<count($array);$i++){
        $document[$adb->query_result($result,$i,'visadocumentsid')] = $adb->query_result($result,$i,'document_name');
    }
    $html .='<table class="tabPdf"><thead><tr><th rowspan="2" width="20%">Название документа</th>';
    if (count($list)< 4){
        $_delta = 4 - count($list);
            for ($_i =0;$_i<$_delta;$_i++){
                array_push($list, 'false');
            }
        
    }
    $width = 80 / count($list);
    foreach ($list as $value){
        if (is_array($value)){
            $html .= '<th width="'.$width.'%">'.$value['name'].'</th>';
        }
        else {
            $html .= '<th width="'.$width.'%">&nbsp;</th>';
        }
    }
    $html .= '</tr><tr>';
    $colspan = array();
    foreach ($list as $id_contact => $value){
        if (is_array($value)){
            $html .= '<th width="'.$width.'%">Дата подачи</th>';
        }
        else {
            $html .= '<th width="'.$width.'%">&nbsp;</th>';
        }
        $colspan[] = $id_contact;
    }
     $html .= '</tr></thead>';
     $html .= '<tbody>';
     foreach ($document as $id_document=>$value){
         $html .='<tr><td>'.$value.'</td>';
         foreach ($colspan as $id_contact){
             if (is_array($list[$id_contact])){
                 if (!empty($list[$id_contact]['documents'][$id_document])){
                    $html .= '<td align="center">'.$list[$id_contact]['documents'][$id_document].' г.</td>';
                 } else if (!isset($list[$id_contact]['documents'][$id_document])){
                     $html .= '<td align="center">----</td>';
                 }
                 else {
                     $html .= '<td align="center"><b>Не здан</b></td>';
                 }
             }
                else {
                $html .= '<td>&nbsp;</td>';
            }
         }
         $html .='</td>';
     }
     $html .= '</tbody></table>';
    
    return $html;
}

}
if (!function_exists('its4you_num2str')) {
function its4you_num2str($num) {
        $num = str_replace(array(',',' '),array('.',''), $num) * 1;
	$nul='ноль';
	$ten=array(
		array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
		array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
	);
	$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
	$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
	$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
	$unit=array( // Units
		array('копейка' ,'копейки' ,'копеек',	 1),
		array('рубль'   ,'рубля'   ,'рублей'    ,0),
		array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
		array('миллион' ,'миллиона','миллионов' ,0),
		array('миллиард','милиарда','миллиардов',0),
	);
	//
	list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
	$out = array();
	if (intval($rub)>0) {
		foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
			if (!intval($v)) continue;
			$uk = sizeof($unit)-$uk-1; // unit key
			$gender = $unit[$uk][3];
			list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
			// mega-logic
			$out[] = $hundred[$i1]; # 1xx-9xx
			if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
			else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
			// units without rub & kop
			if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
		} //foreach
	}
	else $out[] = $nul;
	$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
	$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
	return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}
}
if (!function_exists('morph')) {
/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
	$n = abs(intval($n)) % 100;
	if ($n>10 && $n<20) return $f5;
	$n = $n % 10;
	if ($n>1 && $n<5) return $f2;
	if ($n==1) return $f1;
	return $f5;
}
}
if (!function_exists('its4you_addServise')) {
function its4you_addServise($id) {
    
       if (isset($id) AND $id != "") {
            $adb = PearDatabase::getInstance();
            $query = "SELECT * FROM vtiger_potentialscf WHERE potentialid = ?";
            $result = $adb->pquery($query, array($id));
            $num_rows = $adb->num_rows($result);
            $html = '';
            if ($num_rows > 0) {
                 $potentials = $adb->query_result_rowdata($result, 0);
                 
                 if ($potentials['cf_1133']>0 and $potentials['cf_1135']>0){
                     $html .="Виза - ".number_format(($potentials['cf_1133']*$potentials['cf_1135']),2,","," ")." р.<br />";
                 }
                 if ($potentials['cf_1137']>0 and $potentials['cf_1139']>0){
                     $html .="Детскя виза - ".number_format(($potentials['cf_1137']*$potentials['cf_1139']),2,","," ")." р.<br />";
                 }
                 if ($potentials['cf_1141']>0 and $potentials['cf_1143']>0){
                     $html .="Страховка от не выезда - ".number_format(($potentials['cf_1141']*$potentials['cf_1143']),2,","," ")." р.<br />";
                 }
                
                 if ($potentials['cf_1145']>0 and $potentials['cf_1147']>0){
                     $html .="Страховка дополнительная - ".number_format(($potentials['cf_1145']*$potentials['cf_1147']),2,","," ")." р.<br />";
                 }
                 if ($potentials['cf_1149']>0 and $potentials['cf_1157']>0){
                     $html .="Топливный сбор - ".number_format(($potentials['cf_1149']*$potentials['cf_1157']),2,","," ")." р.<br />";
                 }
                 if (!empty($potentials['cf_1151']) and !empty($potentials['cf_1153'])){
                     $html .= getListAddService($potentials['cf_1151'],$potentials['cf_1153']);
                 }
            }
            return $html;
       }
}
}

if (!function_exists('turList')) {
function turList($list, $dogovor) {
            $list = explode('#',$list);
            $dogovor = explode(':',$dogovor);
            if (isset($dogovor[1]) && $dogovor[1] == 'none'){
                foreach ($list as $key=>$value){
                    if($value == $dogovor[0]){
                        $_key = $key;
                    }
                }
                unset ($list[$_key]);
            }
            $adb = PearDatabase::getInstance();
            $query = "SELECT a.mobile, c.birthday, b.cf_1089 as lastname, b.cf_1091 as firstname, b.cf_1093, b.cf_1095, b.cf_1101, b.cf_1336, b.cf_1338, b.cf_1340, b.cf_1342 "
                    . " FROM vtiger_contactdetails as a"
                    . " LEFT JOIN vtiger_contactscf as b ON b.contactid = a.contactid"
                    . " LEFT JOIN vtiger_contactsubdetails as c ON c.contactsubscriptionid = a.contactid"
                    . " WHERE a.contactid = ?";
            $html = '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            <tr>
                                <td width="25%"><em><span>Фамилия Имя</span></em></td>
                                <td width="15%"><em><span>Дата рождения</span></em></td>
                                <td width="20%"><em><span>№ паспорта</span></em></td>
                                <td width="20%"><em><span>Срок действия загранпаспорта</span></em></td>
                                <td width="20%"><em><span>№ мобильного телефона</span></em></td>
                          </tr>';
            foreach ($list as $_id){
               
                $result = $adb->pquery($query, array($_id));
                $row = $adb->query_result_rowdata($result, 0);
                if (!empty($row['cf_1095'])){
                $html .= '<tr>
                            <td><span>'.strtoupper($row['lastname']).' '.strtoupper($row['firstname']).'</span></td>
                                <td><span>'.date('d.m.Y', strtotime($row['birthday'])).'</span></td>
                                <td><span>'.$row['cf_1093'].' '.$row['cf_1095'].'</span></td>
                                <td><span>'.date('d.m.Y', strtotime($row['cf_1101'])).'</span></td>
                                <<td><span>'.$row['mobile'].'</span></td>
                          </tr>';
                }
                else {
                    $html .= '<tr>
                            <td><span>'.strtoupper($row['lastname']).' '.strtoupper($row['firstname']).'</span></td>
                                <td><span>'.date('d.m.Y', strtotime($row['birthday'])).'</span></td>
                                <td><span>'.$row['cf_1336'].' '.$row['cf_1338'].'</span></td>
                                <td><span> -- </span></td>
                                <<td><span>'.$row['mobile'].'</span></td>
                          </tr>';
                }
            }
             /*
            $numRows = 10 - count($list);
            for ($i=0;$i<$numRows;$i++){
               $html .= '<tr>
                            <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <<td><span>&nbsp;</span></td>
                          </tr>';
            }
            */
            $html .='</tbody></table>';
            return $html;
            
   }
}
if (!function_exists('turList2')) {
function turList2($list, $dogovor) {
            $list = explode('#',$list);
            $dogovor = explode(':',$dogovor);
            if (isset($dogovor[1]) && $dogovor[1] == 'none'){
                foreach ($list as $key=>$value){
                    if($value == $dogovor[0]){
                        $_key = $key;
                    }
                }
                unset ($list[$_key]);
            }
            $adb = PearDatabase::getInstance();
            $query = "SELECT a.mobile, c.birthday, b.cf_1089 as lastname, b.cf_1091 as firstname, b.cf_1093, b.cf_1095, b.cf_1101, b.cf_1336, b.cf_1338, b.cf_1340, b.cf_1342 "
                    . " FROM vtiger_contactdetails as a"
                    . " LEFT JOIN vtiger_contactscf as b ON b.contactid = a.contactid"
                    . " LEFT JOIN vtiger_contactsubdetails as c ON c.contactsubscriptionid = a.contactid"
                    . " WHERE a.contactid = ?";
            $html = '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            <tr>
                                <td width="30%"><em><span>Фамилия Имя</span></em></td>
                                <td width="20%"><em><span>Дата рождения</span></em></td>
                                <td width="25%"><em><span>№ паспорта</span></em></td>
                                <td width="25%"><em><span>Срок действия загранпаспорта</span></em></td>
                                
                          </tr>';
            foreach ($list as $_id){
               
                $result = $adb->pquery($query, array($_id));
                $row = $adb->query_result_rowdata($result, 0);
                if (!empty($row['cf_1095'])){
                $html .= '<tr>
                            <td><span>'.strtoupper($row['lastname']).' '.strtoupper($row['firstname']).'</span></td>
                                <td><span>'.date('d.m.Y', strtotime($row['birthday'])).'</span></td>
                                <td><span>'.$row['cf_1093'].' '.$row['cf_1095'].'</span></td>
                                <td><span>'.date('d.m.Y', strtotime($row['cf_1101'])).'</span></td>
                                
                          </tr>';
                }
                else {
                    $html .= '<tr>
                            <td><span>'.strtoupper($row['lastname']).' '.strtoupper($row['firstname']).'</span></td>
                                <td><span>'.date('d.m.Y', strtotime($row['birthday'])).'</span></td>
                                <td><span>'.$row['cf_1336'].' '.$row['cf_1338'].'</span></td>
                                <td><span> -- </span></td>
                               
                          </tr>';
                }
            }
             /*
            $numRows = 10 - count($list);
            for ($i=0;$i<$numRows;$i++){
               $html .= '<tr>
                            <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <<td><span>&nbsp;</span></td>
                          </tr>';
            }
            */
            $html .='</tbody></table>';
            return $html;
            
   }
}
if (!function_exists('getCountryis4you')) {
    function getCountryis4you($id){
        $adb = PearDatabase::getInstance();
        $query = "SELECT country_name FROM vtiger_listcountry WHERE listcountryid = ?";
        $result = $adb->pquery($query,array($id));
        return $adb->query_result($result,0,'country_name');
    }
}
if (!function_exists('getResortis4you')) {
    function getResortis4you($id){
        $adb = PearDatabase::getInstance();
        $query = "SELECT resort FROM vtiger_listresorts WHERE listresortsid = ?";
        $result = $adb->pquery($query,array($id));
        return $adb->query_result($result,0,'resort');
    }
}
if (!function_exists('programList')) {
function programList($record) {
            $html = '';
            $adb = PearDatabase::getInstance();
            $query = "SELECT * "
                    . " FROM vtiger_potentialscf"
                    ." WHERE potentialid = ?";
           
            $result = $adb->pquery($query, array($record));
            $row = $adb->query_result_rowdata($result, 0);
            if (!empty($row['cf_1436'])){
                 $html ='<br /><p>1. <b>Программа и маршрут</b></p>';
                 $html .= '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            ';
                    $hotels = unserialize(htmlspecialchars_decode($row['cf_1436']));
                    $dist = array();
                    $i =0;
                    $night = 0;
                    $html_hotel = '';
                    foreach ($hotels as $key=>$hotel){
                        if ($i==0){
                            $start = $hotel['arrival'];
                        }
                        $i++;
                        $night += $hotel['night'];
                        $finish = $hotel['departure'];
                        $country = getCountryis4you($hotel['country']);
                        $resort = getResortis4you($hotel['resort']);
                        $txt = $resort . ' ('.$country.') ';
                        array_push($dist, $txt);
                        $html_hotel .= '<tr><td>'.$country.', '.$resort.'</td>'
                                . '<td>'.$hotel['arrival'].' - '.$hotel['departure'].'</td>'
                                . '<td>'.$hotel['name'].'</td>'
                                . '<td>'.$hotel['room'].'</td>'
                                . '<td>'.$hotel['food'].'</td></tr>';
                    }
                $html .= '<tr>
                            <td width="25%"><span>Маршрут: страна\город\курорт</span></td>
                                <td><span>'.implode('- ', $dist).'</span></td>
                               
                          </tr>';
                $html .= '<tr>
                            <td ><span>Сроки путешествия</span></td>
                                <td><span>'.$start. ' - '. $finish .'</span></td>
                               
                          </tr>';
                $html .= '<tr>
                            <td ><span>Количество ночей/дней</span></td>
                                <td><span>'.$night. ' ночей</span></td>
                               
                          </tr>';
                $html .='</tbody></table>';
                
                $html .='<br /><p>2. <b>Проживание</b></p>
                    <table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                        <tr>
                                <td width="20%"><em><span>Страна, город</span></em></td>
                                <td width="20%"><em><span>Даты заезда и выезда</span></em></td>
                                <td width="20%"><em><span>Название отеля</span></em></td>
                                <td width="20%"><em><span>Категория номера</span></em></td>
                                <td width="20%"><em><span>Категория питания</span></em></td>
                                
                          </tr>
                            ';
                $html .= $html_hotel;
                $html .='</tbody></table>';
                $pos = 5;
                if (!empty($row['cf_1438'])){
                 $html .='<br /><p>'.$pos.'. <b>Авиаперелеты по маршруту</b></p>';
                 $html .= '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                        <tr>
                                <td width="20%"><em><span>Маршрут</span></em></td>
                                <td width="15%"><em><span>Авиакомпания</span></em></td>
                                <td width="8%"><em><span>Номер рейса</span></em></td>
                                <td width="15%"><em><span>Вылет</span></em></td>
                                <td width="15%"><em><span>Прилет</span></em></td>
                                <td width="12%"><em><span>Класс обслуживания</span></em></td>
                                <td width="7%"><em><span>Багаж</span></em></td>
                                <td width="8%"><em><span>Питание на борту</span></em></td>
                                
                          </tr>
                            ';
                    $flytes = unserialize(htmlspecialchars_decode($row['cf_1438']));
                    foreach ($flytes as $key=>$flyte){
                        $html .= '<tr><td>'.$flyte['departure'].' - '.$flyte['arrival'].'</td>'
                                . '<td>'.$flyte['name'].'</td>'
                                . '<td>'.$flyte['fly_no'].'</td>'
                                . '<td>'.$flyte['departure_date'].'</td>'
                                . '<td>'.$flyte['arrival_date'].'</td>'
                                . '<td>'.$flyte['class'].'</td>'
                                . '<td>'.$flyte['bagage'].'</td>'
                                . '<td>'.$flyte['food'].'</td></tr>';
                    }
                    $html .='</tbody></table>';
                    $pos++;
                }
                if (!empty($row['cf_1474'])){
                 $html .='<br /><p>'.$pos.'. <b>ЖД переезды по маршруту</b></p>';
                 $html .= '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                        <tr>
                                <td width="20%"><em><span>Маршрут следования</span></em></td>
                                <td width="15%"><em><span>Компания перевозчик</span></em></td>
                                <td width="8%"><em><span>Номер поезда</span></em></td>
                                <td width="15%"><em><span>Время отправления</span></em></td>
                                <td width="15%"><em><span>Время прибытия</span></em></td>
                                <td width="12%"><em><span>Тип вагона</span></em></td>
                                <td width="7%"><em><span>Номер вагона</span></em></td>
                                <td width="8%"><em><span>Номер места</span></em></td>
                                
                          </tr>
                            ';
                    $flytes = unserialize(htmlspecialchars_decode($row['cf_1474']));
                    foreach ($flytes as $key=>$flyte){
                        $html .= '<tr><td>'.$flyte['departure'].' - '.$flyte['arrival'].'</td>'
                                . '<td>'.$flyte['name'].'</td>'
                                . '<td>'.$flyte['no'].'</td>'
                                . '<td>'.$flyte['departure_date'].'</td>'
                                . '<td>'.$flyte['arrival_date'].'</td>'
                                . '<td>'.$flyte['type'].'</td>'
                                . '<td>'.$flyte['vagno'].'</td>'
                                . '<td>'.$flyte['setno'].'</td></tr>';
                    }
                    $html .='</tbody></table>';
                    $pos++;
                }
                if (!empty($row['cf_1470'])){
                 $html .='<br /><p>'.$pos.'. <b>Трансферы  по  маршруту</b></p>';
                 $html .= '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                        <tr>
                                <td width="20%"><em><span>Место встречи</span></em></td>
                                <td width="15%"><em><span>Время отправления</span></em></td>
                                <td width="8%"><em><span>место назначения</span></em></td>
                                <td width="15%"><em><span>Время в пути</span></em></td>
                                <td width="15%"><em><span>Тип трансфера</span></em></td>
                                <td width="12%"><em><span>Вид транспорта</span></em></td>
                                <td width="7%"><em><span>Класс обслуживания</span></em></td>
                                <td width="8%"><em><span>Компания перевозчик</span></em></td>
                                
                          </tr>
                            ';
                    $flytes = unserialize(htmlspecialchars_decode($row['cf_1470']));
                    foreach ($flytes as $key=>$flyte){
                        $html .= '<tr><td>'.$flyte['departure'].'</td>'
                                . '<td>'.$flyte['departure_date'].'</td>'
                                . '<td>'.$flyte['arrival'].'</td>'
                                . '<td>'.$flyte['time'].'</td>'
                                . '<td>'.$flyte['type'].'</td>'
                                . '<td>'.$flyte['name'].'</td>'
                                . '<td>'.$flyte['class'].'</td>'
                                . '<td>'.$flyte['vendor'].'</td></tr>';
                    }
                    $html .='</tbody></table>';
                    $pos++;
                }
            }
             /*
            $numRows = 10 - count($list);
            for ($i=0;$i<$numRows;$i++){
               $html .= '<tr>
                            <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <td><span>&nbsp;</span></td>
                                <<td><span>&nbsp;</span></td>
                          </tr>';
            }
            */
            
            return $html;
            
   }
}
if (!function_exists('turListName')) {
function turListName($list, $dogovor) {
            $list = explode('#',$list);
            $dogovor = explode(':',$dogovor);
            if (isset($dogovor[1]) && $dogovor[1] == 'none'){
                foreach ($list as $key=>$value){
                    if($value == $dogovor[0]){
                        $_key = $key;
                    }
                }
                unset ($list[$_key]);
            }
            $adb = PearDatabase::getInstance();
            $query = "SELECT a.lastname, a.firstname, b.cf_1087 as midlename"
                    . " FROM vtiger_contactdetails as a"
                    . " LEFT JOIN vtiger_contactscf as b ON b.contactid = a.contactid"
                    . " WHERE a.contactid = ?";
            $html = array();
            foreach ($list as $_id){
               $result = $adb->pquery($query, array($_id));
                $row = $adb->query_result_rowdata($result, 0);
                $html[] = $row['lastname'].' '.$row['firstname'].' '.$row['midlename'];
                
            }
            return implode (", ",$html);
            
   }
}
if (!function_exists('turCountList')) {
function turCountList($list, $dogovor) {
            $list = explode('#',$list);
            $dogovor = explode(':',$dogovor);
            if (isset($dogovor[1]) && $dogovor[1] == 'none'){
                foreach ($list as $key=>$value){
                    if($value == $dogovor[0]){
                        $_key = $key;
                    }
                }
                unset ($list[$key]);
            }
            $count = count($list);
            if ($count != 1 && $count < 5){
                $html = $count . " человека";
            }
            else {
                $html = $count . " человек";
            }
            return $html;
            
   }
}
if (!function_exists('turCompanyInn')){
    function turCompanyInn($company){
        $html = '';
        if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.inn, b.kpp"
                    . " FROM vtiger_spcompany as a"
                    . " LEFT JOIN vtiger_organizationdetails as b ON b.organization_id = a.spcompanyid"
                    . " WHERE a.spcompany = ?";
            
                $result = $adb->pquery($query, array($company));
                $inn = $adb->query_result($result, 0, 'inn');
                if (strlen($inn) == 12){
                    $html .= "<p>ИНН $inn</p><p>&nbsp;</p>";
                }
                else {
                    $kpp = $adb->query_result($result, 0, 'kpp');
                    $html .= "<p>ИНН $inn</p><p>&nbsp;</p><p>КПП $kpp</p><p>&nbsp;</p>";
                }
                
               
                
            
            
    }
    return $html;
        
    }
}
if (!function_exists('turCompanyName')) {
function turCompanyName($company) {
    $html = "";
    if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.organizationname"
                    . " FROM vtiger_organizationdetails as b "
                    . " WHERE b.company = ?";
            
                $result = $adb->pquery($query, array($company));
                $html = $adb->query_result($result, 0, 'organizationname');
               
                
            
            
    }
            return $html;
           
            
   }
}
if (!function_exists('turCompanyAddress')) {
function turCompanyAddress($company) {
    $html = "";
    if (!empty($company)){
            $adb = PearDatabase::getInstance();
            $query = "SELECT b.address, b.city"
                    . " FROM vtiger_spcompany as a"
                    . " LEFT JOIN vtiger_organizationdetails as b ON b.organization_id = a.spcompanyid"
                    . " WHERE a.spcompany = ?";
            
                $result = $adb->pquery($query, array($company));
                $html = $adb->query_result($result, 0, 'city').', '.$adb->query_result($result, 0, 'address');
               
                
            
            
    }
            return $html;
           
            
   }
}
           
            
       

if (!function_exists('getListAddService')) {
function getListAddService($service, $amount) {
            $service = explode('#',$service);
            $amount = explode('#',$amount);
            $adb = PearDatabase::getInstance();
            $query = "SELECT * FROM vtiger_service WHERE serviceid = ?";
            $html = "";
            foreach($service as $key=>$_id){
                if ($amount[$key]>0){
                    $result = $adb->pquery($query, array($_id));
                    $name = $adb->query_result($result, 0, 'servicename');
                    if (!empty($name)){
                        $html .= $name." - ".number_format($amount[$key],2,","," ")." р.<br />";
                    }
                }
            }
            return $html;
       }
}

/**
 * This function returns id of current template 
 * 
 * */
if (!function_exists('getTemplateId')) {

    function getTemplateId() {
        //global $PDFMaker_template_id;
        
        $PDFMaker_template_id = vglobal("PDFMaker_template_id");
        return $PDFMaker_template_id;
    }

}
/**
 * This function returns image of contact 
 *  
 * @param $id - contact id
 * @param $width width of returned image (10%, 100px) 
 * @param $height height of returned image (10%, 100px)
 *
 * */
if (!function_exists('its4you_getContactImage')) {

    function its4you_getContactImage($id, $width, $height) {
        if (isset($id) AND $id != "") {
            
            $adb = PearDatabase::getInstance();
            $query = "SELECT vtiger_attachments.path, vtiger_attachments.name, vtiger_attachments.attachmentsid
				FROM vtiger_contactdetails
				INNER JOIN vtiger_seattachmentsrel ON vtiger_contactdetails.contactid=vtiger_seattachmentsrel.crmid
				INNER JOIN vtiger_attachments ON vtiger_attachments.attachmentsid=vtiger_seattachmentsrel.attachmentsid
				INNER JOIN vtiger_crmentity ON vtiger_attachments.attachmentsid=vtiger_crmentity.crmid
				WHERE deleted=0 AND vtiger_contactdetails.contactid=?";

            $result = $adb->pquery($query, array($id));
            $num_rows = $adb->num_rows($result);
            if ($num_rows > 0) {
                $adb->query_result($result, 0, "path");
                $image_src = $adb->query_result($result, 0, "path") . $adb->query_result($result, 0, "attachmentsid") . "_" . $adb->query_result($result, 0, "name");
                $image = "<img src='" . $image_src . "' width='" . $width . "' height='" . $height . "'/>";
                return $image;
            }
        } else {
            return "";
        }
    }

}
/**
 * This function returns formated value 
 *  
 * @param $value - int  
 *  
 * */
if (!function_exists('its4you_formatNumberToPDF')) {

    function its4you_formatNumberToPDF($value) {
 
        $PDFMaker_template_id = vglobal("PDFMaker_template_id");
        $adb = PearDatabase::getInstance();

        $sql = "SELECT decimals, decimal_point, thousands_separator
			FROM vtiger_pdfmaker_settings           
			WHERE templateid=?";
        $result = $adb->pquery($sql, array($PDFMaker_template_id));
        $data = $adb->fetch_array($result);

        $decimal_point = html_entity_decode($data["decimal_point"], ENT_QUOTES);
        $thousands_separator = html_entity_decode(($data["thousands_separator"] != "sp" ? $data["thousands_separator"] : " "), ENT_QUOTES);
        $decimals = $data["decimals"];

        if (is_numeric($value)) {
            $number = number_format($value, $decimals, $decimal_point, $thousands_separator);
        } else {
            $number = "";
        }
        return $number;
    }

}
/**
 * This function returns converted value into integer 
 *  
 * @param $value - int  
 *  
 * */
if (!function_exists('its4you_formatNumberFromPDF')) {

    function its4you_formatNumberFromPDF($value) {

        $PDFMaker_template_id = vglobal("PDFMaker_template_id");
        $adb = PearDatabase::getInstance();
        
        $sql = "SELECT decimals, decimal_point, thousands_separator
			FROM vtiger_pdfmaker_settings           
			WHERE templateid=?";
        $result = $adb->pquery($sql, array($PDFMaker_template_id));
        $data = $adb->fetch_array($result);

        $decimal_point = html_entity_decode($data["decimal_point"], ENT_QUOTES);
        $thousands_separator = html_entity_decode(($data["thousands_separator"] != "sp" ? $data["thousands_separator"] : " "), ENT_QUOTES);
        // $decimals = $data["decimals"];

        $number = str_replace($thousands_separator, '', $value);
        $number = str_replace($decimal_point, '.', $number);
        return $number;
    }

}
/**
 * This function returns multipication of all input values 
 *  
 * @param $sum - int (unlimited count of input params)
 *
 * using: [CUSTOMFUNCTION|its4you_multiplication|param1|param2|...|param_n|CUSTOMFUNCTION]
 * */
if (!function_exists('its4you_multiplication')) {

    function its4you_multiplication() {
        $input_args = func_get_args();
        $return = 0;
        if (!empty($input_args)) {
            foreach ($input_args as $key => $sum) {
                $sum = its4you_formatNumberFromPDF(strip_tags($sum));
                if (!is_numeric($sum) || $sum == '')
                    $sum = 0;
                if ($key == 0)
                    $return = $sum;
                else
                    $return = $return * $sum;
            }
        }
        return its4you_formatNumberToPDF($return);
    }

}
/**
 * This function returns deducated value sum1-sum2-...-sum_n (all following values are deducted from the first one) 
 *  
 * @param $sum - int (unlimited count of input params)
 *
 * using: [CUSTOMFUNCTION|its4you_deduct|param1|param2|...|param_n|CUSTOMFUNCTION]
 * */
if (!function_exists('its4you_deduct')) {

    function its4you_deduct() {
        $input_args = func_get_args();
        $return = 0;
        if (!empty($input_args)) {
            foreach ($input_args as $key => $sum) {
                $sum = its4you_formatNumberFromPDF(strip_tags($sum));
                if (!is_numeric($sum) || $sum == '')
                    $sum = 0;
                if ($key == 0)
                    $return = $sum;
                else
                    $return -= $sum;
            }
        }
        return its4you_formatNumberToPDF($return);
    }

}
/**
 * This function returns sum of input values 
 *  
 * @param $sum - int (unlimited count of input params)
 *
 * using: [CUSTOMFUNCTION|its4you_sum|param1|param2|...|param_n|CUSTOMFUNCTION]
 * */
if (!function_exists('its4you_sum')) {

    function its4you_sum() {
        $input_args = func_get_args();
        $return = 0;
        if (!empty($input_args)) {
            foreach ($input_args as $sum) {
                $sum = its4you_formatNumberFromPDF(strip_tags($sum));
                if (!is_numeric($sum) || $sum == '')
                    $sum = 0;
                $return += $sum;
            }
        }
        return its4you_formatNumberToPDF($return);
    }

}
/**
 * This function returns divided value sum1/sum2/.../sum_n 
 *  
 * @param $sum - int (unlimited count of input params)
 *
 * using: [CUSTOMFUNCTION|its4you_divide|param1|param2|...|param_n|CUSTOMFUNCTION]
 * */
if (!function_exists('its4you_divide')) {

    function its4you_divide() {
        $input_args = func_get_args();
        $return = 0;
        if (!empty($input_args)) {
            foreach ($input_args as $key => $sum) {
                $sum = its4you_formatNumberFromPDF(strip_tags($sum));
                if (!is_numeric($sum) || $sum == '')
                    $sum = 0;
                if ($key == 0)
                    $return = $sum;
                elseif ($sum != 0)
                    $return = $return / $sum;
            }
        }
        return its4you_formatNumberToPDF($return);
    }

}

if (!function_exists('its4you_nl2br')) {

    function its4you_nl2br($value) {
        global $default_charset;
        $string = str_replace(array("\\r\\n", "\\r", "\\n"), "<br />", $value);
        return $string;
    }

}
if (!function_exists('Avia_ticket_list')) {

    function Avia_ticket_list($id) {
        
            $adb = PearDatabase::getInstance();
            $query = "SELECT * "
                    . " FROM vtiger_potentialscf"
                    
                    . " WHERE potentialid = ?";
            $result = $adb->pquery($query, array($id));
           
            $array = $adb->query_result_rowdata($result,0);
            $list_pass = explode('#', $array['cf_1211']);
            $dep_avia = explode('#', $array['cf_1169']);
            $dep_reys = explode('#', $array['cf_1171']);
            $dep_depart = explode('#', $array['cf_1173']);
            $dep_dep_time = explode('#', $array['cf_1175']);
            $dep_arrival = explode('#', $array['cf_1177']);
            $dep_arr_time = explode('#', $array['cf_1179']);
            $dep_class = explode('#', $array['cf_1422']);
            $dep_list = explode('#', $array['cf_1426']);
            $dep_price = explode('#', $array['cf_1432']);
            $arr_avia = explode('#', $array['cf_1181']);
            $arr_reys = explode('#', $array['cf_1183']);
            $arr_depart = explode('#', $array['cf_1185']);
            $arr_dep_time = explode('#', $array['cf_1187']);
            $arr_arrival = explode('#', $array['cf_1189']);
            $arr_arr_time = explode('#', $array['cf_1191']);
            $arr_class = explode('#', $array['cf_1424']);
            $arr_list = explode('#', $array['cf_1428']);
            $arr_price = explode('#', $array['cf_1434']);
            $add_servise = explode('#', $array['cf_1151']);
            $add_servise_ammount = explode('#', $array['cf_1153']);
            $add_servise_distantion = explode('#', $array['cf_1418']);
            $add_servise_list = explode('#', $array['cf_1420']);
            
            $list_contact = array();
            $query = "SELECT a.lastname, a.firstname, b.cf_1087 as midlename"
                    . " FROM vtiger_contactdetails as a"
                    . " LEFT JOIN vtiger_contactscf as b ON b.contactid = a.contactid"
                    . " WHERE a.contactid = ?";
            foreach ($list_pass as $_id){
                
               $result = $adb->pquery($query, array($_id));
                $row = $adb->query_result_rowdata($result, 0);
                $list_contact[$_id] = $row['lastname'].' '.$row['firstname'].' '.$row['midlename'];
                
            }
             $html = '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            <tr>
                                <td width="25%"><em><span>ФИО пассажира</span></em></td>
                                <td width="12%"><em><span>Авиакомпания</span></em></td>
                                <td width="15%"><em><span>Стоимость билета</span></em></td>
                                <td width="18%"><em><span>Дата вылета,<br />город вылета</span></em></td>
                                <td width="18%"><em><span>Дата прилета,<br />город прилета</span></em></td>
                                <td width="12%"><em><span>Класс размещения</span></em></td>
                          </tr>';
             $sum_ticket = 0;
           
            if (count($dep_avia)>0){
                foreach ($dep_avia as $key=>$value){
                    $id_pass = explode(',',$dep_list[$key]);
                    if (count($id_pass)>0){
                        foreach ($id_pass as $_id_pass){
                            $html .= '<tr><td>'.$list_contact[$_id_pass].'</td><td>'.$value.'</td><td>'.number_format($dep_price[$key], 0, "", " ").'</td>';
                            $html .= '<td>'.$dep_dep_time[$key].'<br />'.$dep_depart[$key].'</td><td>'.$dep_arr_time[$key].'<br />'.$dep_arrival[$key].'</td>';
                            $html .= '<td>'.$dep_class[$key].'</td></tr>';
                            $sum_ticket += $dep_price[$key];
                        }
                    }
                }
            }
            
            if (count($arr_avia)>0){
                foreach ($arr_avia as $key=>$value){
                    $id_pass = explode(',',$arr_list[$key]);
                    if (count($id_pass)>0){
                        foreach ($id_pass as $_id_pass){
                            $html .= '<tr><td>'.$list_contact[$_id_pass].'</td><td>'.$value.'</td><td>'.number_format($arr_price[$key], 0, "", " ").'</td>';
                            $html .= '<td>'.$arr_dep_time[$key].'<br />'.$arr_depart[$key].'</td><td>'.$arr_arr_time[$key].'<br />'.$arr_arrival[$key].'</td>';
                            $html .= '<td>'.$arr_class[$key].'</td></tr>';
                            $sum_ticket += $arr_price[$key];
                        }
                    }
                }
            }
            $html .= "<tr><td colspan=2><b>Итого стоимость авиаперевозки</b></td><td><b>".number_format($sum_ticket, 0, "", " ")."</b></td><td colspan=3><center>X</center></td></tr></tbody></table>";
            
            if (count($add_servise)>0 && !empty($add_servise[0])){
                $sum_service = 0;
                $sql = "SELECT servicename FROM vtiger_service WHERE serviceid = ?";
                
                $html .= '<br /><p>3.1.3 Стоимость дополнительных услуг:</p>
                    <table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            <tr>
                                <td width="30%"><em><span>ФИО пассажира</span></em></td>
                                <td width="30%"><em><span>Наименование услуги</span></em></td>
                                <td width="15%"><em><span>Стоимость услуг</span></em></td>
                                <td width="10%"><em><span>Количество</span></em></td>
                                <td width="15%"><em><span>Сумма</span></em></td>
                          </tr>';
                foreach ($add_servise as $key=>$value){
                    if (!empty($value)){
                    $result = $adb->pquery($sql,array($value));
                    $servise_name = $adb->query_result($result,0,'servicename');
                    $id_pass = explode(',',$add_servise_list[$key]);
                    if (count($id_pass)>0){
                        foreach ($id_pass as $_id_pass){
                            $html .= '<tr><td>'.$list_contact[$_id_pass].'</td><td>'.$servise_name.'</td><td>'.number_format($add_servise_ammount[$key], 0, "", " ").'</td>';
                            if ($add_servise_distantion[$key]>2){
                                $html .= '<td><center>2</center></td>';
                                $_sSum = $add_servise_ammount[$key]*2;
                            }
                            else {
                                $html .= '<td><center>1</center></td>';
                                 $_sSum = $add_servise_ammount[$key];
                            }
                            $html .= '<td>'.number_format($_sSum, 0, "", " ").'</td></tr>';
                            
                            $sum_service += $_sSum;
                        }
                    }
                }
                }
                 $html .= "<tr><td colspan=4><b>Итого стоимость дополнительных услуг</b></td><td><b>".number_format($sum_service, 0, "", " ")."</b></td></tr></tbody></table>";
            }
           
            
            
            return $html;
    }

}
if (!function_exists('Zd_ticket_list')) {

    function Zd_ticket_list($id) {
        
            $adb = PearDatabase::getInstance();
            $query = "SELECT * "
                    . " FROM vtiger_potentialscf"
                    
                    . " WHERE potentialid = ?";
            $result = $adb->pquery($query, array($id));
           
            $array = $adb->query_result_rowdata($result,0);
            $list_pass = explode('#', $array['cf_1211']);
            $dep_avia = explode('#', $array['cf_1169']);
            $dep_reys = explode('#', $array['cf_1171']);
            $dep_depart = explode('#', $array['cf_1173']);
            $dep_dep_time = explode('#', $array['cf_1175']);
            $dep_arrival = explode('#', $array['cf_1177']);
            $dep_arr_time = explode('#', $array['cf_1179']);
            $dep_class = explode('#', $array['cf_1332']);
            $dep_list = explode('#', $array['cf_1426']);
            $dep_price = explode('#', $array['cf_1432']);
            $arr_avia = explode('#', $array['cf_1181']);
            $arr_reys = explode('#', $array['cf_1183']);
            $arr_depart = explode('#', $array['cf_1185']);
            $arr_dep_time = explode('#', $array['cf_1187']);
            $arr_arrival = explode('#', $array['cf_1189']);
            $arr_arr_time = explode('#', $array['cf_1191']);
            $arr_class = explode('#', $array['cf_1334']);
            $arr_list = explode('#', $array['cf_1428']);
            $arr_price = explode('#', $array['cf_1434']);
            $add_servise = explode('#', $array['cf_1151']);
            $add_servise_ammount = explode('#', $array['cf_1153']);
            $add_servise_distantion = explode('#', $array['cf_1418']);
            $add_servise_list = explode('#', $array['cf_1420']);
            
            $list_contact = array();
            $query = "SELECT a.lastname, a.firstname, b.cf_1087 as midlename"
                    . " FROM vtiger_contactdetails as a"
                    . " LEFT JOIN vtiger_contactscf as b ON b.contactid = a.contactid"
                    . " WHERE a.contactid = ?";
            foreach ($list_pass as $_id){
                
               $result = $adb->pquery($query, array($_id));
                $row = $adb->query_result_rowdata($result, 0);
                $list_contact[$_id] = $row['lastname'].' '.$row['firstname'].' '.$row['midlename'];
                
            }
             $html = '<table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            <tr>
                                <td width="25%"><em><span>ФИО пассажира</span></em></td>
                                <td width="12%"><em><span>Маршрут и № (название)<br />поезда</span></em></td>
                                <td width="15%"><em><span>Стоимость билета</span></em></td>
                                <td width="18%"><em><span>Дата и город<br /> отправления</span></em></td>
                                <td width="18%"><em><span>Дата и город<br /> прибытия</span></em></td>
                                <td width="12%"><em><span>Класс размещения</span></em></td>
                          </tr>';
             $sum_ticket = 0;
           
            if (count($dep_avia)>0){
                foreach ($dep_avia as $key=>$value){
                    $id_pass = explode(',',$dep_list[$key]);
                    if (count($id_pass)>0){
                        foreach ($id_pass as $_id_pass){
                            $html .= '<tr><td>'.$list_contact[$_id_pass].'</td><td>'.$value.'<br />'.$dep_reys[$key].'</td><td>'.number_format($dep_price[$key], 0, "", " ").'</td>';
                            $html .= '<td>'.$dep_dep_time[$key].'<br />'.$dep_depart[$key].'</td><td>'.$dep_arr_time[$key].'<br />'.$dep_arrival[$key].'</td>';
                            $html .= '<td>'.$dep_class[$key].'</td></tr>';
                            $sum_ticket += $dep_price[$key];
                        }
                    }
                }
            }
            
            if (count($arr_avia)>0){
                foreach ($arr_avia as $key=>$value){
                    $id_pass = explode(',',$arr_list[$key]);
                    if (count($id_pass)>0){
                        foreach ($id_pass as $_id_pass){
                            $html .= '<tr><td>'.$list_contact[$_id_pass].'</td><td>'.$value.'<br />'.$arr_reys[$key].'</td><td>'.number_format($arr_price[$key], 0, "", " ").'</td>';
                            $html .= '<td>'.$arr_dep_time[$key].'<br />'.$arr_depart[$key].'</td><td>'.$arr_arr_time[$key].'<br />'.$arr_arrival[$key].'</td>';
                            $html .= '<td>'.$arr_class[$key].'</td></tr>';
                            $sum_ticket += $arr_price[$key];
                        }
                    }
                }
            }
            $html .= "<tr><td colspan=2><b>Итого стоимость ждперевозки</b></td><td><b>".number_format($sum_ticket, 0, "", " ")."</b></td><td colspan=3><center>X</center></td></tr></tbody></table>";
            
            if (count($add_servise)>0 && !empty($add_servise[0])){
                $sum_service = 0;
                $sql = "SELECT servicename FROM vtiger_service WHERE serviceid = ?";
                
                $html .= '<br /><p>3.1.3 Стоимость дополнительных услуг:</p>
                    <table align="left" border="1" cellpadding="1" cellspacing="1" class="tabPdf" style="min-width: 19cm; width: 100%;">
                        <tbody>
                            <tr>
                                <td width="30%"><em><span>ФИО пассажира</span></em></td>
                                <td width="30%"><em><span>Наименование услуги</span></em></td>
                                <td width="15%"><em><span>Стоимость услуг</span></em></td>
                                <td width="10%"><em><span>Количество</span></em></td>
                                <td width="15%"><em><span>Сумма</span></em></td>
                          </tr>';
                foreach ($add_servise as $key=>$value){
                    if (!empty($value)){
                    $result = $adb->pquery($sql,array($value));
                    $servise_name = $adb->query_result($result,0,'servicename');
                    $id_pass = explode(',',$add_servise_list[$key]);
                    if (count($id_pass)>0){
                        foreach ($id_pass as $_id_pass){
                            $html .= '<tr><td>'.$list_contact[$_id_pass].'</td><td>'.$servise_name.'</td><td>'.number_format($add_servise_ammount[$key], 0, "", " ").'</td>';
                            if ($add_servise_distantion[$key]>2){
                                $html .= '<td><center>2</center></td>';
                                $_sSum = $add_servise_ammount[$key]*2;
                            }
                            else {
                                $html .= '<td><center>1</center></td>';
                                 $_sSum = $add_servise_ammount[$key];
                            }
                            $html .= '<td>'.number_format($_sSum, 0, "", " ").'</td></tr>';
                            
                            $sum_service += $_sSum;
                        }
                    }
                    }
                }
                 $html .= "<tr><td colspan=4><b>Итого стоимость дополнительных услуг</b></td><td><b>".number_format($sum_service, 0, "", " ")."</b></td></tr></tbody></table>";
            }
           
            
            
            return $html;
    }

}
if (!function_exists('add_dogovor_form')) { 
    function add_dogovor_form($id, $fio){
      
        $recordModel = Vtiger_Record_Model::getInstanceById($id);
        
        $stamp_data = unserialize(htmlspecialchars_decode($recordModel->get('stamp_data')));
        $print_dop_count = $recordModel->get('print_dop_count');
        
            $stamp_data = $stamp_data[$print_dop_count-1];
        
        //echo $recordModel->get('amount');
        //echo '<pre>';print_r($stamp_data);echo '</pre>';die();
        $number = 2;
        $list_turist = $recordModel->get('list_tourist');
        $html = "";
           if ( $list_turist != $stamp_data['list_tourist']){
               $dogovor_id_turist = $recordModel->get('dogovor_id_turist');
                $html .='<p style="text-align:center; font-size:12px;"><strong>'.$number.'. СВЕДЕНИЯ О ТУРИСТАХ</strong></p>';
                $html .= turList($list_turist,$dogovor_id_turist);
                $number ++;
           }
        $amount = $recordModel->get('amount');
        if ($amount != $stamp_data['amount']){
             $html .= '<p style="text-align:center; font-size:12px;"><strong>'.$number.'. СТОИМОТЬ УСЛУГ И ПОРЯДОК РАСЧЕТОВ</strong></p>';
             $html .= '<p>'.$number.'.1. Общая цена туристского продукта в связи с произведенными изменениями составляет '.$recordModel->get('amount_cur').' '.$recordModel->get('currenc').'</p>';
             $html .= '<p>'.$number.'.2. Оплата туристского продукта осуществляется в российских рублях по внутреннему курсу туроператора на день заключения настоящего договора и составляет '.number_format($amount, 0, ',', ' ').' ('.its4you_num2str($amount).') рублей, НДС не облагается</p>';
             $html .= '<p>'.$number.'.3. Расчеты по настоящему договору осуществляются наличным (внесением денежных средств в кассу БЮРО) или безналичным (перечислением денежных средств на расчетный счет БЮРО) путем.</p>';
             if ($amount > $stamp_data['amount']){
                 $sum = $amount - $stamp_data['amount'];
                 $html .= '<p>'.$number.'.4. При подписании настоящего соглашения ТУРИСТ/ЗАКАЗЧИК обязуется внести доплату БЮРО в размере: '.number_format($sum, 0, ',', ' ').' ('.its4you_num2str($sum).').</p>';
             }
             else {
                 $sum = $stamp_data['amount'] - $amount;
                  $html .= '<p><strong>'.$number.'.4. Я, '.$fio.' получил(a) от БЮРО возврат в размере: '.number_format($sum, 0, ',', ' ').' ('.its4you_num2str($sum).'), претензий не имею _________________.<strong></p>';
             }
        }
        return $html;
    }
}
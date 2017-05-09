<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

ini_set('display_errors', 1);
error_reporting(E_ERROR);

class VDCustomReports_List_View extends Vtiger_List_View
{
    public $filter_data;
    public $office_to_region = array(
        "H10" => array(409, 407, 30, 752938, 916206),
        "H11" => array(29, 428, 403, 434, 436, 903648, 906005),
        "H16" => array(412, 408, 411, 413, 410, 812451, 927364),
        "H49" => array(405, 406, 404),
        "H55" => array(415, 417, 669),
        "H62" => array(20589, 561913, 561914, 561933, 561940, 691703, 728356, 561944, 779948, 881213, 892568, 892575, 892582, 892589, 892590, 892591, 918235, 918243),
    );

    public $getRusMonth = array(
        '01' => 'Январь',
        '02' => 'Февраль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Май',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь',
    );

    public $date_start;
    public $date_finish;

    function checkPermission(Vtiger_Request $request)
    {
        return true;
    }

    public function preProcess(Vtiger_Request $request)
    {
        parent::preProcess($request, false);
        $moduleName = $request->getModule();
        $viewer = $this->getViewer($request);
        $mode = $request->get('mode');
        $viewer->assign('MODE', $mode);
        $viewer->view('ListPreProcess.tpl', $moduleName);
    }

    function setDefaultPeriod()
    {
        $now = date('d.m.Y');
        $start = date('d.m.Y', strtotime('-7 days'));
        $this->filter_data['period'] = $start . ',' . $now;
    }

    function setDefaultFiltre()
    {
        if (empty($this->filter_data['period'])) {
            $this->setDefaultPeriod();
        }
        $user = Users_Record_Model::getCurrentUserModel();
        $priv = $user->getPrivileges();
        $seq = explode("::", $priv->get('parent_role_seq'));

        if (count($seq) == 4) {

            $this->filter_data['region'] = $seq[3];
            if (!empty($this->filter_data['office']) && !in_array($this->filter_data['office'], $this->office_to_region[$this->filter_data['region']])) {
                unset($this->filter_data['office']);
            }

        } else if (count($seq) == 5) {
            $this->filter_data['region'] = $seq[3];
            if (!empty($user->get('office'))) {
                $this->filter_data['office'] = $user->get('office');
            } else {
                $this->filter_data['office'] = 1;
            }
        } else if (count($seq) > 5) {
            $this->filter_data['region'] = $seq[3];
            if (!empty($user->get('office'))) {
                $this->filter_data['office'] = $user->get('office');
            } else {
                $this->filter_data['office'] = 1;
            }
            $this->filter_data['user'] = $user->get('id');
        }

    }

    function serializeSqlFiltre()
    {
        $date = explode(',', $this->filter_data['period']);
        $this->date_start = date('Y-m-d', strtotime($date[0]));
        $this->date_finish = date('Y-m-d', strtotime($date[1]));
    }

    public function process(Vtiger_Request $request)
    {
        $moduleName = $request->getModule();
        $mode = $request->get('mode');
        $this->filter_data = $request->get('filtre');
        $this->setDefaultFiltre();
        $this->mode = $mode;
        $this->serializeSqlFiltre();
        $filter = $this->getFilter();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $viewer = $this->getViewer($request);
        if (!empty($mode)) {
            $this->$mode($request, $viewer);
            $viewer->assign('FILTER', $filter);
        }
        $viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('MODE', $mode);

        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->view('List.tpl', $moduleName);
    }

    public function validateRequest(Vtiger_Request $request)
    {
        return true;
    }

    function getFilter()
    {
        $region = array(
            "label" => "Регион",
            "type" => "select",
            "name" => 'region',
            "option" => array(
                array("value" => "H10", "label" => "Томск, Омск"),
                array("value" => "H11", "label" => "Новосибиркс, Барнаул"),
                array("value" => "H16", "label" => "Кузбасс, Абакан, Красноярск"),
                array("value" => "H49", "label" => "Сургут, Вартовск, Стрежевой"),
                array("value" => "H55", "label" => "Москва, Екат, Тюмень"),
                array("value" => "H62", "label" => "Франчайзинг"),

            ),
            "data" => $this->filter_data['region'],
        );

        $office = array(
            "label" => "Офис",
            "tpl" => 'uitypes/searchoffice.tpl',
            "name" => 'office',
            "data" => $this->filter_data['office']
        );
        $staf = array(
            "label" => "Сотрудник",
            "tpl" => 'uitypes/OwnerFieldSearchView.tpl',
            "name" => 'user',
            "data" => $this->filter_data['user']
        );
        $period = array(
            "label" => "Период",
            "tpl" => 'uitypes/DateFieldSearchView.tpl',
            "name" => 'period',
            "data" => $this->filter_data['period']
        );
        return array($region, $office, $staf, $period);
    }

    function getUsersOffice()
    {
        if (is_array($this->office_data)) {
            $sql = "SELECT id FROM vtiger_users WHERE office IN (" . implode(',', $this->office_data) . ")";
        } else {
            $sql = "SELECT id FROM vtiger_users WHERE office = " . $this->office_data;
        }

        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        for ($i = 0; $i < $numRows; $i++) {
            $raw[] = $db->query_result($result, $i, 'id');

        }
        return $raw;
    }

    function addQueryFilter()
    {
        $sql = "";
        if (!empty($this->filter_data['region']) || !empty($this->filter_data['office']) || !empty($this->filter_data['user'])) {
            if ($this->mode == 'getLeadsReport') {
                $sql .= " AND c1.smownerid IN";
                if (!empty($this->filter_data['user'])) {
                    $sql .= " (" . $this->filter_data['user'] . ")";
                } else if (!empty($this->filter_data['office'])) {
                    if ($this->filter_data['office'] === 1) {
                        $sql .= " (0)";
                    } else {
                        $this->office_data = $this->filter_data['office'];
                        // echo '<pre>';print_r($this->office_data);echo '</pre>';die();
                        $users = $this->getUsersOffice();
                        $sql .= " (" . implode(',', $users) . ")";
                    }
                } else if (!empty($this->filter_data['region'])) {
                    $this->office_data = $this->office_to_region[$this->filter_data['region']];
                    $users = $this->getUsersOffice();
                    $sql .= " (" . implode(',', $users) . ")";
                }
            } elseif ($this->mode == 'getSalesFunnel') {
                if (!empty($this->filter_data['user'])) {
                    $sql .= " AND c1.smownerid IN (" . $this->filter_data['user'] . ")";
                    if ($this->filter_data['office'] === 1) {
                        $sql .= " AND c1.smownerid IN (0)";
                    }
                } elseif (!empty($this->filter_data['office'])) {
                    $this->office_data = $this->filter_data['office'];
                    $sql .= " AND u.office = " . $this->filter_data['office'] . " ";

                } else if (!empty($this->filter_data['region'])) {
                    $this->office_data = $this->office_to_region[$this->filter_data['region']];
                    $sql .= " AND u.office IN (" . implode(",", $this->office_data) . ") ";
                }
            } else {
                if (!empty($this->filter_data['user'])) {
                    $sql .= " AND c1.smownerid IN (" . $this->filter_data['user'] . ")";
                } else if (!empty($this->filter_data['office'])) {
                    if ($this->filter_data['office'] === 1) {
                        $sql .= " AND c1.smownerid IN (0)";
                    } else {
                        $this->office_data = $this->filter_data['office'];
                        $sql .= " AND pcf.cf_1215 = " . $this->filter_data['office'] . " ";

                    }
                } else if (!empty($this->filter_data['region'])) {
                    $this->office_data = $this->office_to_region[$this->filter_data['region']];
                    $sql .= " AND pcf.cf_1215 IN (" . implode(",", $this->office_data) . ") ";
                }
            }

        }
        return $sql;
    }

    function getSQLArrayResult($sql, $arrayParams)
    {

        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, $arrayParams);

        $numRows = $db->num_rows($result);
        $raw = [];
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        return $raw;
    }

    public function getFunnels($sqlReservation, $sqlApplication)
    {

        $resultReservation = $this->getSQLArrayResult($sqlReservation, [$this->date_start, $this->date_finish]);
        $resultApplication = $this->getSQLArrayResult($sqlApplication, [$this->date_start, $this->date_finish]);


        $sourceArray = array('Встреча в офисе', 'Входящий звонок', 'Обратный звонок', 'Заказ с поисковика на сайте', 'Соц. Сети', 'Заявка с сайта на покупку тура', 'Заявка с сайта на подбор тура', 'Одноклассники', 'ВКонтакте', 'ICQ', 'Почтовая рассылка', 'Другое');

//        $sourceArray = [];
//        foreach ($result as $item) {
//            if (!in_array($item['leadsource'], $sourceArray) && $item['leadsource'] ) {
//                $sourceArray[] = $item['leadsource'];
//            }
//        }

        $funnelArrayNew = [];
        $funnelArrayNew[0]['title'] = 'Все источники';
        $funnelArrayNew[0]['value'][0]['text'] = "Входящие заявки:<br>";
        $funnelArrayNew[0]['value'][0]['title'] = "Входящие заявки:";
        $funnelArrayNew[0]['value'][0]['level'] = 0;
        $funnelArrayNew[0]['value'][0]['height'] = 1;
        //  $funnelArrayNew[$source]['office'] = 0;

        $funnelArrayNew[0]['value'][1]['text'] = "Встречи в офисе:<br>";
        $funnelArrayNew[0]['value'][1]['title'] = "Встречи в офисе:";
        $funnelArrayNew[0]['value'][1]['level'] = 0;
        $funnelArrayNew[0]['value'][1]['height'] = 1;

        $funnelArrayNew[0]['value'][2]['text'] = "Не закрытые на продажу<br>заявки: ";
        $funnelArrayNew[0]['value'][2]['title'] = "Не закрытые на продажу заявки:";
        $funnelArrayNew[0]['value'][2]['level'] = 0;
        $funnelArrayNew[0]['value'][2]['height'] = 1;
        $funnelArrayNew[0]['value'][3]['text'] = "Закрытые на продажу<br>брони: ";
        $funnelArrayNew[0]['value'][3]['title'] = "Закрытые на продажу брони:";
        $funnelArrayNew[0]['value'][3]['level'] = 0;
        $funnelArrayNew[0]['value'][3]['height'] = 1;
        $funnelArrayNew[0]['value'][4]['text'] = "Аннулированные туры:<br>";
        $funnelArrayNew[0]['value'][4]['title'] = "Аннулированные туры:";
        $funnelArrayNew[0]['value'][4]['level'] = 0;
        $funnelArrayNew[0]['value'][4]['height'] = 1;
        $sumECharge = 0;
        $sumProfit = 0;
        $revenues = 0;

        foreach ($resultApplication as $item) {

            $funnelArrayNew[0]['value'][0]['level'] += 1;

            if ($item['meet']) {
                $funnelArrayNew[0]['value'][1]['level'] += 1;
            }

            if ($item['eventstatus'] != 'Продажа') {
                $funnelArrayNew[0]['value'][2]['level'] += 1;
            }


        }
        foreach ($resultReservation as $item) {
            if ($item['eventstatus'] == 'Closed Won' || $item['eventstatus']=='Бронь потверждена' || $item['eventstatus']=='Бронь оплачена') {
                $funnelArrayNew[0]['value'][3]['level'] += 1;
            }
            if ($item['eventstatus'] == 'Closed Lost') {
                $funnelArrayNew[0]['value'][4]['level'] += 1;
            }
            if ($item['eventstatus'] == 'Closed Won' || $item['eventstatus']=='Бронь потверждена' || $item['eventstatus']=='Бронь оплачена') {
                if (isset($item['echarge'])) {
                    $sumECharge += $item['echarge'];
                }
                if (isset($item['amount'])) {
                    $sumProfit += $item['amount'];
                }
                if (isset($item['amounta'])) {
                    $revenues += $item['amounta'];
                }
            }

        }

        if (($funnelArrayNew[0]['value'][0]['level'] + $funnelArrayNew[0]['value'][1]['level'] + $funnelArrayNew[0]['value'][2]['level'] + $funnelArrayNew[0]['value'][3]['level'] + $funnelArrayNew[0]['value'][4]['level']) > 0) {
            $koef = 400 / ($funnelArrayNew[0]['value'][0]['level'] + $funnelArrayNew[0]['value'][1]['level'] + $funnelArrayNew[0]['value'][2]['level'] + $funnelArrayNew[0]['value'][3]['level'] + $funnelArrayNew[0]['value'][4]['level']);
            $koefp = 100 / $funnelArrayNew[0]['value'][0]['level'];
            $funnelArrayNew[0]['value'][0]['height'] = ceil($koef * $funnelArrayNew[0]['value'][0]['level']);
            $funnelArrayNew[0]['value'][1]['height'] = ceil($koef * $funnelArrayNew[0]['value'][1]['level']);
            $funnelArrayNew[0]['value'][2]['height'] = ceil($koef * $funnelArrayNew[0]['value'][2]['level']);
            $funnelArrayNew[0]['value'][3]['height'] = ceil($koef * $funnelArrayNew[0]['value'][3]['level']);
            $funnelArrayNew[0]['value'][4]['height'] = ceil($koef * $funnelArrayNew[0]['value'][4]['level']);
            $funnelArrayNew[0]['value'][0]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[0]['value'][0]['level']) . "%)";
            $funnelArrayNew[0]['value'][1]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[0]['value'][1]['level']) . "%)";
            $funnelArrayNew[0]['value'][2]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[0]['value'][2]['level']) . "%)";
            $funnelArrayNew[0]['value'][3]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[0]['value'][3]['level']) . "%)";
            $funnelArrayNew[0]['value'][4]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[0]['value'][4]['level']) . "%)";
        } else {
            $funnelArrayNew[0]['value'][0]['height'] = 100;
            $funnelArrayNew[0]['value'][1]['height'] = 100;
            $funnelArrayNew[0]['value'][2]['height'] = 100;
            $funnelArrayNew[0]['value'][3]['height'] = 100;
            $funnelArrayNew[0]['value'][4]['height'] = 100;
            $funnelArrayNew[0]['value'][0]['percent'] = "";
            $funnelArrayNew[0]['value'][1]['percent'] = "";
            $funnelArrayNew[0]['value'][2]['percent'] = "";
            $funnelArrayNew[0]['value'][3]['percent'] = "";
            $funnelArrayNew[0]['value'][4]['percent'] = "";
        }

        $funnelArrayNew[0]['value'][5]['text'] = "Средняя наценка:<br>";
        $funnelArrayNew[0]['value'][5]['title'] = "Средняя наценка:";
        $funnelArrayNew[0]['value'][5]['level'] = round($sumECharge / $funnelArrayNew[0]['value'][3]['level'], 2) . " %";
        $funnelArrayNew[0]['value'][5]['height'] = 100;
        $funnelArrayNew[0]['value'][5]['percent'] = "";

        $funnelArrayNew[0]['value'][6]['text'] = "Средний чек:<br>";
        $funnelArrayNew[0]['value'][6]['title'] = "Средний чек:";
        $funnelArrayNew[0]['value'][6]['level'] = round($revenues / $funnelArrayNew[0]['value'][3]['level']) . " ₽";
        $funnelArrayNew[0]['value'][6]['height'] = 100;
        $funnelArrayNew[0]['value'][6]['percent'] = "";
        $funnelArrayNew[0]['value'][7]['text'] = "Средний доход:<br>";
        $funnelArrayNew[0]['value'][7]['title'] = "Средний доход:";
        $funnelArrayNew[0]['value'][7]['level'] = round($sumProfit / $funnelArrayNew[0]['value'][3]['level']) . " ₽";
        $funnelArrayNew[0]['value'][7]['height'] = 100;
        $funnelArrayNew[0]['value'][7]['percent'] = "";
        $funnelArrayNew[0]['value'][8]['text'] = "Доход итоговый:<br>";
        $funnelArrayNew[0]['value'][8]['title'] = "Доход итоговый:";
        $funnelArrayNew[0]['value'][8]['level'] = round($sumProfit) . " ₽";

        $funnelArrayNew[0]['value'][8]['height'] = 100;
        $funnelArrayNew[0]['value'][8]['percent'] = "";
        foreach ($sourceArray as $key => $source) {
            $key++;
            $funnelArrayNew[$key]['title'] = $source;

            $funnelArrayNew[$key]['value'][0]['text'] = "Входящие заявки:<br>";
            $funnelArrayNew[$key]['value'][0]['title'] = "Входящие заявки:";
            $funnelArrayNew[$key]['value'][0]['level'] = 0;
            //  $funnelArrayNew[$source]['office'] = 0;

            $funnelArrayNew[$key]['value'][1]['text'] = "Встречи в офисе:<br>";
            $funnelArrayNew[$key]['value'][1]['title'] = "Встречи в офисе:";
            $funnelArrayNew[$key]['value'][1]['level'] = 0;
            $funnelArrayNew[$key]['value'][1]['height'] = 1;
            $funnelArrayNew[$key]['value'][2]['text'] = "Не закрытые на продажу<br>заявки: ";
            $funnelArrayNew[$key]['value'][2]['title'] = "Не закрытые на продажу заявки:";
            $funnelArrayNew[$key]['value'][2]['level'] = 0;
            $funnelArrayNew[$key]['value'][3]['text'] = "Закрытые на продажу<br>брони: ";
            $funnelArrayNew[$key]['value'][3]['title'] = "Закрытые на продажу брони:";
            $funnelArrayNew[$key]['value'][3]['level'] = 0;
            $funnelArrayNew[$key]['value'][4]['text'] = "Аннулированные туры:<br>";
            $funnelArrayNew[$key]['value'][4]['title'] = "Аннулированные туры:";
            $funnelArrayNew[$key]['value'][4]['level'] = 0;
            $sumECharge = 0;
            $sumProfit = 0;
            $revenues = 0;
            foreach ($resultApplication as $item) {
                if (!$item['leadsource']) {
                    $item['leadsource'] = 'Другое';
                }
                if ($item['leadsource'] == $source) {
                    $funnelArrayNew[$key]['value'][0]['level'] += 1;
                    if ($item['meet']) {
                        $funnelArrayNew[$key]['value'][1]['level'] += 1;
                    }

                    if ($item['eventstatus'] != 'Продажа') {
                        $funnelArrayNew[$key]['value'][2]['level'] += 1;
                    }
                }
            }
            foreach ($resultReservation as $item) {
                if (!$item['leadsource']) {
                    $item['leadsource'] = 'Другое';
                }
                if ($item['leadsource'] == $source) {
                    if ($item['eventstatus'] == 'Closed Won' || $item['eventstatus']=='Бронь потверждена' || $item['eventstatus']=='Бронь оплачена') {
                        $funnelArrayNew[$key]['value'][3]['level'] += 1;
                    }
                    if ($item['eventstatus'] == 'Closed Lost') {
                        $funnelArrayNew[$key]['value'][4]['level'] += 1;
                    }
                    if ($item['eventstatus'] == 'Closed Won' || $item['eventstatus']=='Бронь потверждена' || $item['eventstatus']=='Бронь оплачена') {
                        if (isset($item['echarge'])) {
                            $sumECharge += $item['echarge'];
                        }
                        if (isset($item['amount'])) {
                            $sumProfit += $item['amount'];
                        }

                        if (isset($item['amounta'])) {
                            $revenues += $item['amounta'];
                        }
                    }
                }
            }

            if (($funnelArrayNew[$key]['value'][0]['level'] + $funnelArrayNew[$key]['value'][1]['level'] + $funnelArrayNew[$key]['value'][2]['level'] + $funnelArrayNew[$key]['value'][3]['level'] + $funnelArrayNew[$key]['value'][3]['level']) > 0) {
                $koef = 500 / ($funnelArrayNew[$key]['value'][0]['level'] + $funnelArrayNew[$key]['value'][1]['level'] + $funnelArrayNew[$key]['value'][2]['level'] + $funnelArrayNew[$key]['value'][3]['level'] + $funnelArrayNew[$key]['value'][3]['level']);
                $koefp = 100 / $funnelArrayNew[$key]['value'][0]['level'];
                $funnelArrayNew[$key]['value'][0]['height'] = ceil($koef * $funnelArrayNew[$key]['value'][0]['level']);
                $funnelArrayNew[$key]['value'][1]['height'] = ceil($koef * $funnelArrayNew[$key]['value'][1]['level']);
                $funnelArrayNew[$key]['value'][2]['height'] = ceil($koef * $funnelArrayNew[$key]['value'][2]['level']);
                $funnelArrayNew[$key]['value'][3]['height'] = ceil($koef * $funnelArrayNew[$key]['value'][3]['level']);
                $funnelArrayNew[$key]['value'][4]['height'] = ceil($koef * $funnelArrayNew[$key]['value'][4]['level']);
                $funnelArrayNew[$key]['value'][0]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[$key]['value'][0]['level']) . "%)";
                $funnelArrayNew[$key]['value'][1]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[$key]['value'][1]['level']) . "%)";
                $funnelArrayNew[$key]['value'][2]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[$key]['value'][2]['level']) . "%)";
                $funnelArrayNew[$key]['value'][3]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[$key]['value'][3]['level']) . "%)";
                $funnelArrayNew[$key]['value'][4]['percent'] = "(конверсия " . round($koefp * $funnelArrayNew[$key]['value'][4]['level']) . "%)";
            } else {
                $funnelArrayNew[$key]['value'][0]['height'] = 100;
                $funnelArrayNew[$key]['value'][1]['height'] = 100;
                $funnelArrayNew[$key]['value'][2]['height'] = 100;
                $funnelArrayNew[$key]['value'][3]['height'] = 100;
                $funnelArrayNew[$key]['value'][4]['height'] = 100;
                $funnelArrayNew[$key]['value'][0]['percent'] = "";
                $funnelArrayNew[$key]['value'][1]['percent'] = "";
                $funnelArrayNew[$key]['value'][2]['percent'] = "";
                $funnelArrayNew[$key]['value'][3]['percent'] = "";
                $funnelArrayNew[$key]['value'][4]['percent'] = "";
            }

            $funnelArrayNew[$key]['value'][5]['text'] = "Средняя наценка:<br>";
            $funnelArrayNew[$key]['value'][5]['title'] = "Средняя наценка:";
            $funnelArrayNew[$key]['value'][5]['level'] = round($sumECharge / $funnelArrayNew[$key]['value'][3]['level'],2) . " %";;
            $funnelArrayNew[$key]['value'][5]['height'] = 100;
            $funnelArrayNew[$key]['value'][5]['percent'] = "";

            $funnelArrayNew[$key]['value'][6]['text'] = "Средний чек:<br>";
            $funnelArrayNew[$key]['value'][6]['title'] = "Средний чек:";
            $funnelArrayNew[$key]['value'][6]['level'] = round($revenues / $funnelArrayNew[$key]['value'][3]['level']) . " ₽";
            $funnelArrayNew[$key]['value'][6]['height'] = 100;
            $funnelArrayNew[$key]['value'][6]['percent'] = "";

            $funnelArrayNew[$key]['value'][7]['text'] = "Средний доход:<br>";
            $funnelArrayNew[$key]['value'][7]['title'] = "Средний доход:";
            $funnelArrayNew[$key]['value'][7]['level'] = round($sumProfit / $funnelArrayNew[$key]['value'][3]['level']) . " ₽";
            $funnelArrayNew[$key]['value'][7]['height'] = 100;
            $funnelArrayNew[$key]['value'][7]['percent'] = "";

            $funnelArrayNew[$key]['value'][8]['text'] = "Доход итоговый:<br>";
            $funnelArrayNew[$key]['value'][8]['title'] = "Доход итоговый:";
            $funnelArrayNew[$key]['value'][8]['level'] = round($sumProfit) . " ₽";
            $funnelArrayNew[$key]['value'][8]['height'] = 100;
            $funnelArrayNew[$key]['value'][8]['percent'] = "";
        }

        return $funnelArrayNew;
    }

    public function getSalesFunnel(Vtiger_Request $request, $viewer)
    {

        $addQuery = $this->addQueryFilter();
        $sqlNewFunnelApplication = "SELECT  a1.eventstatus, l.leadsource, c1.meet FROM vtiger_leaddetails as l INNER JOIN vtiger_crmentity as c1 ON c1.crmid = l.leadid
                                    INNER JOIN vtiger_seactivityrel as s1 ON s1.crmid =l.leadid INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid 
                                    LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
                                    LEFT JOIN vtiger_office as o ON o.officeid = u.office
                                    WHERE a1.eventstatus != 'Held' and (CAST(c1.createdtime AS DATE) BETWEEN ? AND ?)" . $addQuery . "
            GROUP BY  c1.crmid";


        $sqlNewFunnelReservation = "SELECT p.amount-pcf.cf_1256 AS amount, p.amount AS amounta, ((p.amount-pcf.cf_1256)/(p.amount)*100) as  echarge, p.sales_stage AS eventstatus,p.leadsource
                        FROM vtiger_potential as p
                        INNER JOIN vtiger_crmentity as c1 
                            ON c1.crmid = p.potentialid
                            INNER JOIN vtiger_potentialscf as pcf
                            ON pcf.potentialid = p.potentialid
                            LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
                            LEFT JOIN vtiger_office as o ON o.officeid = u.office
                 
                
                  WHERE p.potentialtype <> 'Авиа билеты' and p.potentialtype <> 'ЖД билеты'  and (CAST(c1.createdtime AS DATE) BETWEEN ? AND ?)
                " . $addQuery . "
            GROUP BY  c1.crmid";

        $funnelArrayNew = $this->getFunnels($sqlNewFunnelReservation, $sqlNewFunnelApplication);

        $sqlAllFunnelApplication = "SELECT a1.eventstatus,l.leadsource, c1.meet FROM vtiger_leaddetails as l INNER JOIN vtiger_crmentity as c1  ON c1.crmid = l.leadid
                                    INNER JOIN vtiger_seactivityrel as s1 ON s1.crmid =l.leadid INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid 
                                    LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
                                    LEFT JOIN vtiger_office as o ON o.officeid = u.office
                                    WHERE (CAST(a1.due_date  AS DATE) BETWEEN ? AND ?)" . $addQuery . "
            GROUP BY  c1.crmid ";


        $sqlAllFunnelReservation = "SELECT p.amount-pcf.cf_1256 AS amount, p.amount AS amounta,((p.amount-pcf.cf_1256)/(p.amount)*100) as  echarge, p.sales_stage AS eventstatus,p.leadsource
                        FROM vtiger_potential as p
                        INNER JOIN vtiger_crmentity as c1 
                            ON c1.crmid = p.potentialid
                            INNER JOIN vtiger_potentialscf as pcf
                            ON pcf.potentialid = p.potentialid
                            LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
                            LEFT JOIN vtiger_office as o ON o.officeid = u.office
              WHERE p.potentialtype <> 'Авиа билеты' and p.potentialtype <> 'ЖД билеты' and (CAST(pcf.cf_1225 AS DATE) BETWEEN ? AND ?)" . $addQuery . "
            GROUP BY  c1.crmid";


        $funnelArrayAll = $this->getFunnels($sqlAllFunnelReservation, $sqlAllFunnelApplication);


        $viewer->assign('FUNNELNEW', json_encode($funnelArrayNew));
        $viewer->assign('FUNNELALL', json_encode($funnelArrayAll));
    }


    public function getLeadsReport(Vtiger_Request $request, $viewer)
    {
        $addQuery = $this->addQueryFilter();

        // по дням заявки период
        $sql = "SELECT g.due_date, g.eventstatus, count(g.leadid) as value FROM
                    (SELECT s.due_date, l.leadid, s.eventstatus, s.activityid
                        FROM vtiger_leaddetails as l
                        INNER JOIN vtiger_crmentity as cl 
                            ON cl.crmid = l.leadid
                        INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE (CAST(a1.due_date AS DATE) BETWEEN ? AND ?)" . $addQuery . " ORDER BY a1.activityid DESC) as s 
                            ON s.crmid = l.leadid
                        LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                        LEFT JOIN vtiger_office as o ON o.officeid = u.office
                        WHERE cl.deleted = 0 
                        GROUP BY l.leadid 
                    ) as g GROUP BY g.due_date, g.eventstatus";


        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);
        }

        $row = array();
        $list = array('Всего' => 0, 'Новая' => 0, 'В работе' => 0, 'Продажа' => 0, 'Отказ' => 0);
        $sum = array();
        foreach ($raw as $key => $val) {
            if (!isset($row[$val['due_date']])) {
                $row[$val['due_date']] = $list;
            }
            switch ($val['eventstatus']) {
                case 'Held':
                case'Planned':
                    $row[$val['due_date']]['В работе'] = $row[$val['due_date']]['В работе'] + $val['value'];
                    break;
                default :
                    $row[$val['due_date']][$val['eventstatus']] = $row[$val['due_date']][$val['eventstatus']] + $val['value'];
            }
            $sum[$val['due_date']] = $sum[$val['due_date']] + $val['value'];
        }
        foreach ($row as $key => $val) {
            $row[$key]['Всего'] = $sum[$key];
        }
        /*$sql = "SELECT g.createdtime, count(g.leadid) as value FROM
                    (SELECT s.date_start, l.leadid, s.eventstatus, s.due_date,s.activityid, convert(createdtime, DATE) as createdtime
                        FROM vtiger_leaddetails as l
                        INNER JOIN vtiger_crmentity as cl
                            ON cl.crmid = l.leadid
                        INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.date_start, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE c1.deleted = 0 ".$addQuery." GROUP BY s1.crmid ORDER BY a1.activityid ) as s
                            ON s.crmid = l.leadid and s.date_start >= ?
                        LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                        LEFT JOIN vtiger_office as o ON o.officeid = u.office
                        WHERE cl.deleted = 0 and (CAST(cl.createdtime AS DATE) BETWEEN ? AND ?)
                        GROUP BY l.leadid
                    ) as g GROUP BY g.createdtime";
        $result = $db->pquery($sql,array($this->date_start,$this->date_start,$this->date_finish));
        $numRows = $db->num_rows($result);
         $raw = array();
        for($i=0;$i<$numRows;$i++){
            $raw[$i] = $db->query_result_rowdata($result,$i);

        }
        foreach ($raw as $value){
            if(isset($row[$value['createdtime']])){
               // $row[$value['createdtime']]['Новая'] = $value['value'];
            }
        } */
        $color = array('#ccc', '#009900', '#0055fa', '#B0DE09', '#ff2200');
        $graf = new grafConstructorBar($row, $list, 'grafDay', $color, "Заявки по дням с " . str_replace(',', " по ", $this->filter_data['period']), 'Количество заявок');
        $scripts = array();
        // заявки период сумарно
        array_push($scripts, $graf->Script());
        $sql = "SELECT g.eventstatus, count(g.leadid) as value FROM
                    (SELECT s.due_date, l.leadid, s.eventstatus, s.activityid
                        FROM vtiger_leaddetails as l
                        INNER JOIN vtiger_crmentity as cl 
                            ON cl.crmid = l.leadid
                        INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE (CAST(a1.due_date AS DATE) BETWEEN ? AND ?)" . $addQuery . " ORDER BY a1.activityid DESC) as s 
                            ON s.crmid = l.leadid
                        LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                        LEFT JOIN vtiger_office as o ON o.officeid = u.office
                        WHERE cl.deleted = 0 
                        GROUP BY l.leadid 
                    ) as g GROUP BY g.eventstatus";

        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }
        $row = array();
        $list = array('Всего' => 0, 'Новая' => 0, 'В работе' => 0, 'Продажа' => 0, 'Отказ' => 0);
        $sum = array();
        foreach ($raw as $key => $val) {
            if (!isset($row[$this->filter_data['period']])) {
                $row[$this->filter_data['period']] = $list;
            }
            switch ($val['eventstatus']) {
                case 'Held':
                case'Planned':
                    $row[$this->filter_data['period']]['В работе'] = $row[$this->filter_data['period']]['В работе'] + $val['value'];
                    break;
                default :
                    $row[$this->filter_data['period']][$val['eventstatus']] = $row[$this->filter_data['period']][$val['eventstatus']] + $val['value'];
            }
            $sum[$this->filter_data['period']] = $sum[$this->filter_data['period']] + $val['value'];
        }
        foreach ($row as $key => $val) {
            $row[$key]['Всего'] = $sum[$key];
        }
        /*  $sql = "SELECT count(g.leadid) as value FROM
                      (SELECT s.date_start, l.leadid, s.eventstatus, s.due_date,s.activityid, convert(createdtime, DATE) as createdtime
                          FROM vtiger_leaddetails as l
                          INNER JOIN vtiger_crmentity as cl
                              ON cl.crmid = l.leadid
                          INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.date_start, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE c1.deleted = 0 ".$addQuery." GROUP BY s1.crmid ORDER BY a1.activityid ) as s
                              ON s.crmid = l.leadid and s.date_start >= ?
                          LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                          LEFT JOIN vtiger_office as o ON o.officeid = u.office
                          WHERE cl.deleted = 0 and (CAST(cl.createdtime AS DATE) BETWEEN ? AND ?)
                          GROUP BY l.leadid
                      ) as g";
          $result = $db->pquery($sql,array($this->date_start,$this->date_start,$this->date_finish));
          //$row[$this->filter_data['period']]['Новая'] = $db->query_result($result,0, 'value');
          */
        $graf = new grafConstructorBar($row, $list, 'grafAll', $color, "Заявки за период с " . str_replace(',', " по ", $this->filter_data['period']) . " ", 'Количество заявок');
        array_push($scripts, $graf->Script());


// По дате создания 
        $row = array();
        $row_is = array();
        $list = array('Всего' => 0, 'Новая' => 0, 'В работе' => 0, 'Продажа' => 0, 'Отказ' => 0);
        $list_is = array('Всего' => 1);
        $sql = "SELECT * FROM vtiger_leadsource ORDER BY sortorderid";
        $result = $db->pquery($sql, array());

        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $list_is[$db->query_result($result, $i, 'leadsource')] = 0;

        }
        $list_is['Не указан'] = 0;

        $sum = array();
        $_date = date('Y-m-d 00:00:00', strtotime($this->date_start));
        $_date_f = date('Y-m-d 23:59:59', strtotime($this->date_finish));
        // заявки по статусу
        $sql = "select s.eventstatus, count(c1.crmid) as value, CAST(c1.createdtime AS DATE) as i_data from vtiger_crmentity as c1 
INNER JOIN vtiger_seactivityrel as se ON se.crmid = c1.crmid
INNER JOIN (select a1.eventstatus, a1.activityid from vtiger_activity as a1 where a1.eventstatus != 'Held' order by a1.activityid DESC ) 
as s ON s.activityid = se.activityid
LEFT JOIN vtiger_users as u ON u.id = c1.smownerid 
LEFT JOIN vtiger_office as o ON o.officeid = u.office
where c1.deleted=0 and c1.setype = 'Leads' and  (c1.createdtime BETWEEN ? AND ?) " . $addQuery . " group by CAST(c1.createdtime AS DATE), s.eventstatus";
        /*
        SELECT g.due_date, g.eventstatus, count(g.leadid) as value FROM
                            (SELECT s.due_date, l.leadid, s.eventstatus, s.activityid
                                FROM vtiger_leaddetails as l
                                INNER JOIN vtiger_crmentity as cl
                                    ON cl.crmid = l.leadid
                                INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE c1.deleted = 0 ORDER BY a1.activityid DESC) as s
                                    ON s.crmid = l.leadid
                                LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                                LEFT JOIN vtiger_office as o ON o.officeid = u.office
                                WHERE cl.deleted = 0 and l.leadid IN (SELECT c1.crmid FROM vtiger_leaddetails as l
                                    INNER JOIN vtiger_crmentity as c1 ON c1.crmid = l.leadid
                                    LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
                                    LEFT JOIN vtiger_office as o ON o.officeid = u.office
                                    WHERE c1.deleted = 0 and (CAST(c1.createdtime AS DATE) BETWEEN ? AND ?)
                                 ".$addQuery.") group by l.leadid ) as g GROUP BY g.eventstatus"; */

        $result = $db->pquery($sql, array($_date, $_date_f));

        $numRows = $db->num_rows($result);
        $raw = array();
        $sum = array();
        for ($i = 0; $i < $numRows; $i++) {
            $eventstatus = $db->query_result($result, $i, 'eventstatus');
            switch ($eventstatus) {
                case 'Held':
                case'Planned':
                    $eventstatus = 'В работе';
                    break;

            }
            $raw[$db->query_result($result, $i, 'i_data')][$eventstatus] = $db->query_result($result, $i, 'value');
            $sum[$db->query_result($result, $i, 'i_data')] += $db->query_result($result, $i, 'value');
        }
        // echo '<pre>';print_r($raw);echo '</pre>';die();
        foreach ($raw as $key => $val) {
            $raw[$key]['Всего'] = $sum[$key];
        }
        // заявки по источнику за период
        $sql = "SELECT g.leadsource, count(g.leadid) as value FROM
                    (SELECT s.due_date, l.leadid, l.leadsource, s.activityid
                        FROM vtiger_leaddetails as l
                        INNER JOIN vtiger_crmentity as cl 
                            ON cl.crmid = l.leadid
                        INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE (CAST(a1.due_date AS DATE) BETWEEN ? AND ?)" . $addQuery . " ORDER BY a1.activityid DESC) as s 
                            ON s.crmid = l.leadid
                        LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                        LEFT JOIN vtiger_office as o ON o.officeid = u.office
                        WHERE cl.deleted = 0 
                        GROUP BY l.leadid 
                    ) as g GROUP BY g.leadsource";
        $result = $db->pquery($sql, array($_date, $_date_f));
        //echo '<pre>';print_r($result);echo '</pre>';
        $numRows = $db->num_rows($result);
        $raw_is = array();
        $sum_is = 0;
        for ($i = 0; $i < $numRows; $i++) {
            $leadsource = $db->query_result($result, $i, 'leadsource');
            switch ($leadsource) {
                case'':
                    $leadsource = 'Не указан';
                    $list_is['Не указан'] = 1;
                    break;
                default:
                    $list_is[$leadsource] = 1;

            }
            $raw_is[$this->filter_data['period']][$leadsource] = $db->query_result($result, $i, 'value');
            $sum_is += $db->query_result($result, $i, 'value');
        }

        $raw_is[$this->filter_data['period']]['Всего'] = $sum_is;


        $sum_is = 0;


        foreach ($list_is as $key => $value) {
            if ($value != 1) {
                unset($list_is[$key]);
            }
        }

        $color = array('#ccc', '#009900', '#0055fa', '#B0DE09', '#ff2200');
        $graf = new grafConstructorBar($raw_is, $list_is, 'grafDayCreateIstTotal', $color, "Источники заявок за период с " . str_replace(',', " по ", $this->filter_data['period'] . ''), 'Количество заявок');
        array_push($scripts, $graf->Script());
        // заявки по источнику за период по дате создания
        $sql = "select l.leadsource, CAST(c1.createdtime AS DATE) as i_data, count(c1.crmid) as value
from vtiger_crmentity as c1 
INNER JOIN vtiger_seactivityrel as se ON se.crmid = c1.crmid
INNER JOIN (select a1.eventstatus, a1.activityid from vtiger_activity as a1 where a1.eventstatus != 'Held' order by a1.activityid DESC ) 
as s ON s.activityid = se.activityid
Left join vtiger_leaddetails as l ON l.leadid = c1.crmid
LEFT JOIN vtiger_users as u ON u.id = c1.smownerid 
LEFT JOIN vtiger_office as o ON o.officeid = u.office 
where c1.deleted=0 and c1.setype = 'Leads' and  (c1.createdtime BETWEEN ? AND ?) " . $addQuery . " group by  CAST(c1.createdtime AS DATE), l.leadsource
             ";

        $result = $db->pquery($sql, array($_date, $_date_f));
        //echo '<pre>';print_r($result);echo '</pre>';
        $numRows = $db->num_rows($result);
        $raw_is = array();
        $sum_is = array();
        for ($i = 0; $i < $numRows; $i++) {
            $leadsource = $db->query_result($result, $i, 'leadsource');
            switch ($leadsource) {
                case'':
                    $leadsource = 'Не указан';
                    $list_is['Не указан'] = 1;
                    break;
                default:
                    $list_is[$leadsource] = 1;

            }
            $raw_is[$db->query_result($result, $i, 'i_data')][$leadsource] = $db->query_result($result, $i, 'value');
            $sum_is[$db->query_result($result, $i, 'i_data')] += $db->query_result($result, $i, 'value');
        }
        foreach ($raw_is as $key => $val) {
            $raw_is[$key]['Всего'] = $sum_is[$key];
        }

        $sum_is = 0;


        foreach ($list_is as $key => $value) {
            if ($value != 1) {
                unset($list_is[$key]);
            }
        }
        $color = array('#ccc', '#009900', '#0055fa', '#B0DE09', '#ff2200');
        $graf = new grafConstructorBar($raw, $list, 'grafDayCreate', $color, "Заявки по дням с " . str_replace(',', " по ", $this->filter_data['period'] . '(по дате создания)'), 'Количество заявок');

        array_push($scripts, $graf->Script());
        $color = array('#ccc', '#009900', '#0055fa', '#B0DE09', '#ff2200');
        $graf = new grafConstructorBar($raw_is, $list_is, 'grafDayCreateIst', $color, "Источники заявок по дням с " . str_replace(',', " по ", $this->filter_data['period']) . '(по дате создания)', 'Количество заявок');

        array_push($scripts, $graf->Script());
        $sql = "SELECT g.due_date, g.eventstatus, count(g.leadid) as value FROM
                    (SELECT s.due_date, l.leadid, s.eventstatus, s.activityid
                        FROM vtiger_leaddetails as l
                        INNER JOIN vtiger_crmentity as cl 
                            ON cl.crmid = l.leadid
                        INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid WHERE a1.eventstatus != 'Held' and c1.deleted = 0 ORDER BY a1.activityid DESC) as s 
                            ON s.crmid = l.leadid
                        LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                        LEFT JOIN vtiger_office as o ON o.officeid = u.office
                        WHERE cl.deleted = 0 and l.leadid IN (SELECT c1.crmid FROM vtiger_leaddetails as l 
                            INNER JOIN vtiger_crmentity as c1 ON c1.crmid = l.leadid 
                            LEFT JOIN vtiger_users as u ON u.id = c1.smownerid 
                            LEFT JOIN vtiger_office as o ON o.officeid = u.office 
                            WHERE c1.deleted = 0 and (CAST(c1.createdtime AS DATE) BETWEEN ? AND ?)
                         " . $addQuery . ") group by l.leadid ) as g GROUP BY g.eventstatus";

        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));
        //echo '<pre>';print_r($result);echo '</pre>';
        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }
        $row = array();

        $list = array('Всего' => 0, 'Новая' => 0, 'В работе' => 0, 'Продажа' => 0, 'Отказ' => 0);
        $sum = array();
        foreach ($raw as $key => $val) {
            if (!isset($row[$this->filter_data['period']])) {
                $row[$this->filter_data['period']] = $list;
            }
            switch ($val['eventstatus']) {
                case 'Held':
                case'Planned':
                    $row[$this->filter_data['period']]['В работе'] = $row[$this->filter_data['period']]['В работе'] + $val['value'];
                    break;
                default :
                    $row[$this->filter_data['period']][$val['eventstatus']] = $row[$this->filter_data['period']][$val['eventstatus']] + $val['value'];
            }
            $sum[$this->filter_data['period']] = $sum[$this->filter_data['period']] + $val['value'];
        }
        foreach ($row as $key => $val) {
            $row[$key]['Всего'] = $sum[$key];
        }

        $graf = new grafConstructorBar($row, $list, 'grafAllCreate', $color, "Заявки за период с " . str_replace(',', " по ", $this->filter_data['period']) . "(по дате создания)", 'Количество заявок');
        array_push($scripts, $graf->Script());
        $sql = "SELECT g.due_date, g.leadsource,  count(g.leadid) as value FROM (
	SELECT s.due_date, l.leadid, l.leadsource, s.activityid FROM vtiger_leaddetails as l 
	INNER JOIN vtiger_crmentity as cl ON cl.crmid = l.leadid 
	INNER JOIN (
		select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 
		INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid 
		LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid 
		WHERE c1.deleted = 0 ORDER BY a1.activityid DESC
		) as s ON s.crmid = l.leadid 
	LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
	LEFT JOIN vtiger_office as o ON o.officeid = u.office 
	WHERE cl.deleted = 0 and l.leadid IN (
		SELECT c1.crmid FROM vtiger_leaddetails as l 
			INNER JOIN vtiger_crmentity as c1 ON c1.crmid = l.leadid 
			LEFT JOIN vtiger_users as u ON u.id = c1.smownerid 
			LEFT JOIN vtiger_office as o ON o.officeid = u.office 
			WHERE cl.deleted = 0 and (CAST(c1.createdtime AS DATE) BETWEEN ? AND ?)" . $addQuery . " ) group by l.leadid
		) 
	as g GROUP BY g.leadsource";

        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $sum_is = 0;
        $row_is = array();
        foreach ($raw as $key => $val) {

            switch ($val['leadsource']) {
                case '':
                    $row_is[$_date]['Не указан'] = $row_is[$_date]['Не указан'] + $val['value'];
                    break;
                default :
                    $row_is[$_date][$val['leadsource']] = $row_is[$_date][$val['leadsource']] + $val['value'];
            }
            $sum_is = $sum_is + $val['value'];
        }

        $row_is[$_date]['Всего'] = $sum_is;
        $graf = new grafConstructorBar($row_is, $list_is, 'grafAllCreateIst', $color, "Источники заявок за период с " . str_replace(',', " по ", $this->filter_data['period'] . '') . '(по дате создания)', 'Количество заявок');
        array_push($scripts, $graf->Script());
        $GRAFDIV = array('grafAll', 'grafDay', 'grafAllCreate', 'grafDayCreate', 'grafDayCreateIstTotal', 'grafAllCreateIst', 'grafDayCreateIst');
// Источники конверсия по дате активности
        $sql = "SELECT g.due_date, g.leadsource,  count(g.leadid) as value, g.eventstatus FROM (
	SELECT s.due_date, l.leadid, l.leadsource, s.activityid,s.eventstatus FROM vtiger_leaddetails as l 
	INNER JOIN vtiger_crmentity as cl ON cl.crmid = l.leadid 
	INNER JOIN (
		select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 
		INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid 
		LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid 
		WHERE a1.eventstatus != 'Held' and a1.eventstatus != '' and c1.deleted = 0 ORDER BY a1.activityid DESC
		) as s ON s.crmid = l.leadid 
	LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
	LEFT JOIN vtiger_office as o ON o.officeid = u.office 
		WHERE cl.deleted = 0 and l.leadid IN (
		SELECT r.leadid
                        FROM vtiger_leaddetails as r
                        INNER JOIN vtiger_crmentity as cl 
                            ON cl.crmid = r.leadid
                        INNER JOIN (select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 
                        INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid 
                        WHERE (CAST(a1.due_date AS DATE) BETWEEN ? AND ?) " . $addQuery . " ORDER BY a1.activityid DESC) as s 
                            ON s.crmid = r.leadid
                        LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                        LEFT JOIN vtiger_office as o ON o.officeid = u.office
                        WHERE cl.deleted = 0 
                        GROUP BY r.leadid ))
	as g GROUP BY g.leadsource, g.eventstatus";
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();

        for ($i = 0; $i < $numRows; $i++) {
            switch ($db->query_result($result, $i, 'eventstatus')) {
                case 'Planned':
                    $evenstatus = 'В работе';
                    break;
                default:
                    $evenstatus = $db->query_result($result, $i, 'eventstatus');
            }
            switch ($db->query_result($result, $i, 'leadsource')) {
                case '':
                    $raw['Не указан'][$evenstatus] = $db->query_result($result, $i, 'value');
                    break;
                default:
                    $raw[$db->query_result($result, $i, 'leadsource')][$evenstatus] = $db->query_result($result, $i, 'value');
            }
        }
        $DIVSTILE = array();
        $idtitle = 1;
        foreach ($raw as $_key => $value) {
            $color = array('#009900', '#ff2200', '#B0DE09', '#0055fa',);
            $color = array('#B0DE09', '#0055fa', '#ff2200', '#009900',);
            $graf = new grafConstructorPie($value, 'istPie-' . $idtitle, $color, 'Конверсия по источнику -' . $_key, "[[title]]- [[value]]([[percents]]%)");
            array_push($scripts, $graf->Script(false, false));
            array_push($GRAFDIV, 'istPie-' . $idtitle);
            $DIVSTILE['istPie-' . $idtitle] = array('class' => 'span6', 'height' => '400px');
            $idtitle++;
        }
// Источники конверсия по дате создания 
        $sql = "SELECT g.due_date, g.leadsource,  count(g.leadid) as value, g.eventstatus FROM (
	SELECT s.due_date, l.leadid, l.leadsource, s.activityid,s.eventstatus FROM vtiger_leaddetails as l 
	INNER JOIN vtiger_crmentity as cl ON cl.crmid = l.leadid 
	INNER JOIN (
		select s1.crmid, s1.activityid, a1.eventstatus, a1.due_date FROM vtiger_seactivityrel as s1 
		INNER JOIN vtiger_activity as a1 ON a1.activityid = s1.activityid 
		LEFT JOIN vtiger_crmentity as c1 ON c1.crmid = a1.activityid 
		WHERE a1.eventstatus != 'Held' and a1.eventstatus != '' and c1.deleted = 0 ORDER BY a1.activityid DESC
		) as s ON s.crmid = l.leadid 
	LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
	LEFT JOIN vtiger_office as o ON o.officeid = u.office 
	WHERE cl.deleted = 0 and l.leadid IN (
		SELECT c1.crmid FROM vtiger_leaddetails as l 
			INNER JOIN vtiger_crmentity as c1 ON c1.crmid = l.leadid 
			LEFT JOIN vtiger_users as u ON u.id = c1.smownerid 
			LEFT JOIN vtiger_office as o ON o.officeid = u.office 
			WHERE cl.deleted = 0 and (CAST(c1.createdtime AS DATE) BETWEEN ? AND ?)" . $addQuery . " ) group by l.leadid
		) 
	as g GROUP BY g.leadsource, g.eventstatus";
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();

        for ($i = 0; $i < $numRows; $i++) {
            switch ($db->query_result($result, $i, 'eventstatus')) {
                case 'Planned':
                    $evenstatus = 'В работе';
                    break;
                default:
                    $evenstatus = $db->query_result($result, $i, 'eventstatus');
            }
            switch ($db->query_result($result, $i, 'leadsource')) {
                case '':
                    $raw['Не указан'][$evenstatus] = $db->query_result($result, $i, 'value');
                    break;
                default:
                    $raw[$db->query_result($result, $i, 'leadsource')][$evenstatus] = $db->query_result($result, $i, 'value');
            }
        }


        foreach ($raw as $_key => $value) {
            $color = array('#009900', '#ff2200', '#B0DE09', '#0055fa',);
            $color = array('#B0DE09', '#0055fa', '#ff2200', '#009900',);
            $graf = new grafConstructorPie($value, 'istPie-' . $idtitle, $color, 'Конверсия по источнику -' . $_key . '(по дате создания)', "[[title]]- [[value]]([[percents]]%) ");
            array_push($scripts, $graf->Script(false, false));
            array_push($GRAFDIV, 'istPie-' . $idtitle);
            $DIVSTILE['istPie-' . $idtitle] = array('class' => 'span6', 'height' => '400px');
            $idtitle++;
        }
        $viewer->assign('ADDSCRIPTS', $scripts);
        $viewer->assign('GRAFDIV', $GRAFDIV);
        $viewer->assign('DIVSTILE', $DIVSTILE);


    }

    public
    function getErrorLeads()
    {
        $sql = "SELECT a.due_date,
                    l.leadid, a.eventstatus, a.activityid, o.office , CONCAT (u.first_name, ' ', u.last_name) as username, concat ('http://crmturizm1.vordoom.net/index.php?module=Leads&view=Detail&record=', l.leadid) as link
                    FROM vtiger_leaddetails as l
                    INNER JOIN vtiger_crmentity as cl 
                        ON cl.crmid = l.leadid
                    INNER JOIN (select s1.crmid, s1.activityid FROM vtiger_seactivityrel as s1 GROUP BY s1.activityid DESC) as s 
                        ON s.crmid = l.leadid
                    INNER JOIN vtiger_crmentity as ca 
                        ON ca.crmid = s.activityid
                    LEFT JOIN vtiger_activity as a
                        ON ca.crmid = a.activityid
                    LEFT JOIN vtiger_users as u ON u.id = cl.smownerid
                    LEFT JOIN vtiger_office as o ON o.officeid = u.office
                    WHERE cl.deleted = 0 and ca.deleted = 0 and CAST(a.due_date AS DATE) BETWEEN  '2016-10-01' AND '2018-10-13' 
                    GROUP BY l.leadid ORDER BY o.office, u.last_name";
    }

    function getHeaderScripts(Vtiger_Request $request)
    {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();
        $jsFileNames = array();
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.amcharts");
        $mode = $request->get('mode');
        if (!empty($mode)) {
            $function = 'addScript_' . $mode;
            $jsFileNames = $this->$function($jsFileNames);
        }
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);


        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);

        return $headerScriptInstances;
    }

    function addScript_getLeadsReport($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.pie");
        return $jsFileNames;
    }

    function addScript_getSalesFunnel($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.funnel");
        array_push($jsFileNames, "modules.VDCustomReports.script.salesFunnel");
        return $jsFileNames;
    }

    function addScript_getBookingReport($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        return $jsFileNames;
    }

    function addScript_getStatistic($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.pie");
        return $jsFileNames;
    }

    function addScript_getAverage($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.radar");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.patterns");
        return $jsFileNames;
    }

    function addScript_getProceeds($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.radar");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.patterns");
        return $jsFileNames;
    }

    function addScript_getSalesPlan($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.radar");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.patterns");
        return $jsFileNames;
    }

    function addScript_editSalesPlan($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.webix.webix");
        array_push($jsFileNames, "modules.VDCustomReports.script.salesPlan");
        return $jsFileNames;
    }

    function findRegionByOffice($officeId)
    {

        $regions = [
            "H10" => "Томск, Омск",
            "H11" => "Новосибиркс, Барнаул",
            "H16" => "Кузбасс, Абакан, Красноярск",
            "H49" => "Сургут, Вартовск, Стрежевой",
            "H55" => "Москва, Екат, Тюмень",
            "H62" => "Франчайзинг"
        ];

        foreach ($this->office_to_region as $key => $region) {
            if (in_array($officeId, $region)) {
                return $regions[$key];
            }
        }

    }

    function addScript_saveAllPlan($jsFileNames)
    {

    }

    function saveAllPlan(Vtiger_Request $request, $viewer)
    {
        $value = $request->get("value");
        if (!$value) {
            $value = "NULL";
        }
        $column = $request->get("column");
        $period = $request->get("monthPeriod");

        $sql = "SELECT * 
                FROM all_sales_plan as plan 
                WHERE date = '$period'";

        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);

        if ($numRows == 0) {
            $sql = "INSERT INTO all_sales_plan (date, $column) VALUES('$period', $value)";
        } else {
            $sql = "UPDATE all_sales_plan SET $column=$value WHERE date = '$period'";
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        die();
    }

    function addScript_savePlan($jsFileNames)
    {

    }

    function savePlan(Vtiger_Request $request, $viewer)
    {
        $value = $request->get("value");
        $column = $request->get("column");
        $office = $request->get("office");
        $period = $request->get("monthPeriod");

        $db = PearDatabase::getInstance();

        if ($value !== '' && $column !== 'plan') {
            $valueInt = $value + 0;

            if ($valueInt . "" !== $value) {
                echo json_encode("Некорректные данные");
                die();
            }


            //все планы сотрудников
            $sql8 = "SELECT * FROM worker_sales_plan p WHERE date = '$period'";

            $result = $db->pquery($sql8, array());
            $numRows = $db->num_rows($result);

            $raw8 = [];
            for ($i = 0; $i < $numRows; $i++) {
                $raw8[$i] = $db->query_result_rowdata($result, $i);
            }
            // raw8 -------------------------------

            // люди оффиса
            $sql3 = "SELECT first_name, last_name, id FROM vtiger_users as u
                     LEFT JOIN vtiger_office as o ON u.office = o.officeid
                     WHERE u.office = $office AND o.officeid is not null";

            $result = $db->pquery($sql3, array());
            $numRows = $db->num_rows($result);

            $summ = 0;
            $flag = 0;

            for ($i = 0; $i < $numRows; $i++) {
                $fl = 0;
                foreach ($raw8 as $item) {
                    if ($item["worker"] == $db->query_result($result, $i, 'id')) {

                        $fl = 1;

                        if ($item[$column] != NULL) {
                            $summ += $item[$column];
                        } else {
                            $flag = 1;
                        }

                        break;
                    }
                }

                if ($fl == 0) $flag = 1;

            }

            if ($flag == 1) {
                if ($summ > $value) {
                    echo json_encode("Сумма планов сотрудников больше плана на оффис");
                    die();
                }
            } else {
                if ($summ != $value) {
                    echo json_encode("План на оффис должен равняться сумме планов сотрудников");
                    die();
                }
            }

        }

        $sql = "SELECT * 
                FROM office_sales_plan as plan 
                WHERE office_id = $office AND date = '$period'";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);


        if (!$value) {
            $value = "NULL";
            if ($numRows == 0) {
                $sql = "INSERT INTO office_sales_plan (office_id, date, $column) VALUES('$office', '$period', $value)";
            } else {
                $sql = "UPDATE office_sales_plan SET $column=$value WHERE office_id = '$office' AND date = '$period'";
            }
        } else {
            if ($numRows == 0) {
                $sql = "INSERT INTO office_sales_plan (office_id, date, $column) VALUES('$office', '$period', '$value')";
            } else {
                $floor = [];

                $floor[0] = $db->query_result($result, 0, 'floor1');
                $floor[1] = $db->query_result($result, 0, 'floor2');
                $floor[2] = $db->query_result($result, 0, 'floor3');
                $floor[3] = $db->query_result($result, 0, 'floor4');

                $n = 0;
                switch ($column) {
                    case 'floor1':
                        $n = 0;
                        break;
                    case 'floor2':
                        $n = 1;
                        break;
                    case 'floor3':
                        $n = 2;
                        break;
                    case 'floor4':
                        $n = 3;
                        break;
                }

                if ($n !== 3)
                    for ($i = $n + 1; $i <= 3; $i++) {
                        if ($floor[$i] !== null && $floor[$i] <= $value) {
                            echo json_encode("Значение этапа слишком велико по сравнению с другими этапами");
                            die();
                        }
                    }

                if ($n !== 0)
                    for ($i = $n - 1; $i >= 0; $i--) {
                        if ($floor[$i] !== null && $floor[$i] >= $value) {
                            echo json_encode("Значение этапа слишком мало по сравнению с другими этапами");
                            die();
                        }
                    }

                $sql = "UPDATE office_sales_plan SET $column='$value' WHERE office_id = '$office' AND date = '$period'";
            }
        }

        $db->pquery($sql, array());

        echo json_encode('success');
        die();
    }

    function addScript_saveWorkerPlan($jsFileNames)
    {

    }

    function saveWorkerPlan(Vtiger_Request $request, $viewer)
    {
        $value = $request->get("value");
        $column = $request->get("column");
        $worker = $request->get("worker");
        $period = $request->get("monthPeriod");

        $db = PearDatabase::getInstance();


        if ($value !== '' && $column !== 'plan') {
            $valueInt = $value + 0;

            if ($valueInt . "" !== $value) {
                echo json_encode("Некорректные данные");
                die();
            }

            //--------- офис сотрудника

            $sql3 = "SELECT * FROM office_sales_plan as plan 
                     LEFT JOIN vtiger_office as o ON plan.office_id = o.officeid
                     LEFT JOIN vtiger_users as u ON u.office = o.officeid
                     WHERE u.id = $worker AND plan.date = '$period'";

            $result = $db->pquery($sql3, array());

            $valueOffice = $db->query_result($result, 0, $column);
            $idOffice = $db->query_result($result, 0, 'office_id');

            //все планы сотрудников
            $sql8 = "SELECT * FROM worker_sales_plan p WHERE date = '$period'";

            $result = $db->pquery($sql8, array());
            $numRows = $db->num_rows($result);

            $raw8 = [];
            for ($i = 0; $i < $numRows; $i++) {
                $raw8[$i] = $db->query_result_rowdata($result, $i);
            }
            // raw8 -------------------------------

            // люди оффиса
            $sql3 = "SELECT first_name, last_name, id FROM vtiger_users as u
                     LEFT JOIN vtiger_office as o ON u.office = o.officeid
                     WHERE u.office = $idOffice AND o.officeid is not null";

            $result = $db->pquery($sql3, array());
            $numRows = $db->num_rows($result);

            $summ = 0;
            $flag = 0;

            for ($i = 0; $i < $numRows; $i++) {
                $fl = 0;
                foreach ($raw8 as $item) {
                    if ($item["worker"] == $db->query_result($result, $i, 'id')) {

                        $fl = 1;

                        if ($item["worker"] != $worker) {

                            if ($item[$column] != NULL) {
                                $summ += $item[$column];
                            } else {
                                $flag = 1;
                            }
                        }

                        break;
                    }
                }

                if ($fl == 0) {
                    $flag = 1;
                }

            }

            if ($valueOffice != null)
                if ($flag == 1) {
                    if (($summ + $value) > $valueOffice) {
                        echo json_encode("Сумма планов сотрудников больше плана на оффис");
                        die();
                    }
                } else {
                    if (($summ + $value) != $valueOffice) {
                        echo json_encode("План на оффис должен равняться сумме планов сотрудников");
                        die();
                    }
                }

        }

        $sql = "SELECT * 
                FROM worker_sales_plan as plan 
                WHERE worker = $worker AND date = '$period'";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);


        if (!$value) {
            $value = "NULL";
            if ($numRows == 0) {
                $sql = "INSERT INTO worker_sales_plan (worker, date, $column) VALUES('$worker', '$period', $value)";
            } else {
                $sql = "UPDATE worker_sales_plan SET $column=$value WHERE worker = '$worker' AND date = '$period'";
            }
        } else {
            if ($numRows == 0) {
                $sql = "INSERT INTO worker_sales_plan (worker, date, $column) VALUES('$worker', '$period', '$value')";
            } else {

                $floor = [];

                $floor[0] = $db->query_result($result, 0, 'floor1');
                $floor[1] = $db->query_result($result, 0, 'floor2');
                $floor[2] = $db->query_result($result, 0, 'floor3');
                $floor[3] = $db->query_result($result, 0, 'floor4');

                $n = 0;
                switch ($column) {
                    case 'floor1':
                        $n = 0;
                        break;
                    case 'floor2':
                        $n = 1;
                        break;
                    case 'floor3':
                        $n = 2;
                        break;
                    case 'floor4':
                        $n = 3;
                        break;
                }

                if ($n !== 3)
                    for ($i = $n + 1; $i <= 3; $i++) {
                        if ($floor[$i] !== null && $floor[$i] <= $value) {
                            echo json_encode("Значение этапа слишком велико по сравнению с другими этапами");
                            die();
                        }
                    }

                if ($n !== 0)
                    for ($i = $n - 1; $i >= 0; $i--) {
                        if ($floor[$i] !== null && $floor[$i] >= $value) {
                            echo json_encode("Значение этапа слишком мало по сравнению с другими этапами");
                            die();
                        }
                    }

                $sql = "UPDATE worker_sales_plan SET $column='$value' WHERE worker = '$worker' AND date = '$period'";
            }
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        echo json_encode('success');
        die();
    }

    function nullOnEmpty($str)
    {
        if ($str == "null" || $str == null) {
            return "";
        }

        return $str;
    }

    function editSalesPlan(Vtiger_Request $request, $viewer)
    {

        $db = PearDatabase::getInstance();

        $filter = $request->get('filtre');

        $userModel = Users_Record_Model::getCurrentUserModel();
        $userRole = $userModel->getRole();

        $sqlRole = "SELECT depth FROM vtiger_role WHERE roleid = '$userRole'";
        $result = $db->pquery($sqlRole, array());
        $depth = $db->query_result_rowdata($result, "depth");

        if ($depth["depth"] > 4) {
            return;
        }

        $accessOfficesWhere = "1=0";

        if ($this->office_to_region[$userRole]) {

            foreach ($this->office_to_region[$userRole] as $office) {
                $accessOfficesWhere .= " OR officeid = '$office'";
            }

        } elseif ($userModel->isAdminUser()) {
            $accessOfficesWhere .= " OR 1=1";

        } else {
            $filter["office"] = $this->filter_data['office'];
            $accessOfficesWhere .= " OR officeid = '" . $this->filter_data['office'] . "'";
        }

        $accessOfficesWhere = "($accessOfficesWhere)";

        if ($filter["period"]) {
            $date = $filter["period"];

            $strArr = explode(".", $this->filter_data['period']);
            $strPeriod = $strArr[1] . "-" . $strArr[0];
            $dateObject = new DateTime($strPeriod);
            $strDate = $this->getRusMonth[$dateObject->format("m")] . ", " . $dateObject->format("Y");

        } else {
            $dateObject = new DateTime();
            $date = $dateObject->format("m.Y");
            $strDate = $this->getRusMonth[$dateObject->format("m")] . ", " . $dateObject->format("Y");
        }

//        if (!$filter["region"] && !$filter["office"] && !$filter["user"]) {
//            $typePlan = "all";
//
//            $sql3 = "SELECT *
//                FROM all_sales_plan as plan
//                WHERE date = '$date'";
//
//            $result = $db->pquery($sql3, array());
//            $numRows3 = $db->num_rows($result);
//
//            $raw3 = [];
//            for ($i = 0; $i < $numRows3; $i++) {
//                $raw3[$i] = $db->query_result_rowdata($result, $i);
//            }
//
//            if ($raw3) {
//                $allPlan = [
//                    "id" => "allPlan",
//                    "plan" => $this->nullOnEmpty($raw3[0]["plan"]),
//                    "floor1" => $this->nullOnEmpty($raw3[0]["floor1"]),
//                    "floor2" => $this->nullOnEmpty($raw3[0]["floor2"]),
//                    "floor3" => $this->nullOnEmpty($raw3[0]["floor3"]),
//                    "floor4" => $this->nullOnEmpty($raw3[0]["floor4"])
//                ];
//            } else {
//                $allPlan = [
//                    "id" => "allPlan",
//                    "plan" => "3-й этап",
//                    "floor1" => "",
//                    "floor2" => "",
//                    "floor3" => "",
//                    "floor4" => ""
//                ];
//            }
//
//            $sql2 = "SELECT * FROM office_sales_plan as plan WHERE date = '$date'";
//
//            $result = $db->pquery($sql2, array());
//            $numRows2 = $db->num_rows($result);
//
//            $raw2 = [];
//            for ($i = 0; $i < $numRows2; $i++) {
//                $raw2[$i] = $db->query_result_rowdata($result, $i);
//            }
//
//            $sql = "SELECT * FROM vtiger_office";
//
//            $result = $db->pquery($sql, array());
//            $numRows = $db->num_rows($result);
//
//            $raw = [];
//            for ($i = 0; $i < $numRows; $i++) {
//
//                $flag = 0;
//                $office = [];
//
//                foreach ($raw2 as $item) {
//                    if ($item["office_id"] == $db->query_result($result, $i, 'officeid')) {
//                        $office = [
//                            "id" => $item["office_id"],
//                            "region" => $this->findRegionByOffice($db->query_result($result, $i, 'officeid')),
//                            "office" => $db->query_result($result, $i, 'office'),
//                            "plan" => $this->nullOnEmpty($item["plan"]),
//                            "floor1" => $this->nullOnEmpty($item["floor1"]),
//                            "floor2" => $this->nullOnEmpty($item["floor2"]),
//                            "floor3" => $this->nullOnEmpty($item["floor3"]),
//                            "floor4" => $this->nullOnEmpty($item["floor4"])
//                        ];
//                        $flag = 1;
//                        break;
//                    }
//                }
//
//                if ($flag == 0) {
//                    $office = [
//                        "id" => $db->query_result($result, $i, 'officeid'),
//                        "region" => $this->findRegionByOffice($db->query_result($result, $i, 'officeid')),
//                        "office" => $db->query_result($result, $i, 'office'),
//                        "plan" => "3-й этап",
//                        "floor1" => "",
//                        "floor2" => "",
//                        "floor3" => "",
//                        "floor4" => ""
//
//                    ];
//                }
//                $raw[] = $office;
//            }
//        }

        if (!$filter["office"] && !$filter["user"]) {
            $typePlan = "region";

            $offices = implode(",", $this->office_to_region[$filter["region"]]);

            if ($filter["region"]) {
                $sql2 = "SELECT * FROM office_sales_plan p WHERE p.office_id in ($offices) AND date = '$date'";
            } else {
                $sql2 = "SELECT * FROM office_sales_plan p WHERE date = '$date'";
            }

            $result = $db->pquery($sql2, array());
            $numRows2 = $db->num_rows($result);

            $raw2 = [];
            for ($i = 0; $i < $numRows2; $i++) {
                $raw2[$i] = $db->query_result_rowdata($result, $i);
            }
            if ($filter["region"]) {
                $sql = "SELECT * FROM vtiger_office as o WHERE o.officeid in ($offices) AND $accessOfficesWhere";
            } else {
                $sql = "SELECT * FROM vtiger_office WHERE $accessOfficesWhere";
            }

            $result = $db->pquery($sql, array());
            $numRows = $db->num_rows($result);

            $raw = [];
            for ($i = 0; $i < $numRows; $i++) {

                $flag = 0;
                $office = [];

                foreach ($raw2 as $item) {
                    if ($item["office_id"] == $db->query_result($result, $i, 'officeid')) {
                        $office = [
                            "id" => $item["office_id"],
                            "region" => $this->findRegionByOffice($db->query_result($result, $i, 'officeid')),
                            "office" => $db->query_result($result, $i, 'office'),
                            "plan" => $this->nullOnEmpty($item["plan"]),
                            "floor1" => $this->nullOnEmpty($item["floor1"]),
                            "floor2" => $this->nullOnEmpty($item["floor2"]),
                            "floor3" => $this->nullOnEmpty($item["floor3"]),
                            "floor4" => $this->nullOnEmpty($item["floor4"])
                        ];
                        $flag = 1;
                        break;
                    }
                }

                if ($flag == 0) {
                    $office = [
                        "id" => $db->query_result($result, $i, 'officeid'),
                        "region" => $this->findRegionByOffice($db->query_result($result, $i, 'officeid')),
                        "office" => $db->query_result($result, $i, 'office'),
                        "plan" => "3-й этап",
                        "floor1" => "",
                        "floor2" => "",
                        "floor3" => "",
                        "floor4" => ""

                    ];
                }
                $raw[] = $office;
            }
        }

        if ($filter["user"]) {
            $typePlan = "worker";

            $user = $filter["user"];

            $sql8 = "SELECT * FROM worker_sales_plan p WHERE date = '$date'";

            $result = $db->pquery($sql8, array());
            $numRows = $db->num_rows($result);


            $raw8 = [];
            for ($i = 0; $i < $numRows; $i++) {
                $raw8[$i] = $db->query_result_rowdata($result, $i);
            }

            $sql3 = "SELECT first_name, last_name, id 
                     FROM vtiger_users u
                     LEFT JOIN vtiger_office as o ON u.office = o.officeid
                     WHERE id in ($user) AND o.officeid is not null AND $accessOfficesWhere";

            $result = $db->pquery($sql3, array());
            $numRows = $db->num_rows($result);

            $raw2 = [];
            for ($i = 0; $i < $numRows; $i++) {

                $flag = 0;
                $worker = [];

                foreach ($raw8 as $item) {
                    if ($item["worker"] == $db->query_result($result, $i, 'id')) {
                        $worker = [
                            "id" => $db->query_result($result, $i, 'id'),
                            "office" => $office["office"],
                            "worker" => $db->query_result($result, $i, 'first_name') . " " . $db->query_result($result, $i, 'last_name'),
                            "plan" => $this->nullOnEmpty($item["plan"]),
                            "floor1" => $this->nullOnEmpty($item["floor1"]),
                            "floor2" => $this->nullOnEmpty($item["floor2"]),
                            "floor3" => $this->nullOnEmpty($item["floor3"]),
                            "floor4" => $this->nullOnEmpty($item["floor4"])
                        ];
                        $flag = 1;
                        break;
                    }
                }

                if ($flag == 0) {
                    $worker = [
                        "id" => $db->query_result($result, $i, 'id'),
                        "office" => $office["office"],
                        "worker" => $db->query_result($result, $i, 'first_name') . " " . $db->query_result($result, $i, 'last_name'),
                        "plan" => "3-й этап",
                        "floor1" => "",
                        "floor2" => "",
                        "floor3" => "",
                        "floor4" => ""
                    ];
                }

                $raw2[] = $worker;
            }

        }


        if ($filter["office"] && !$filter["user"]) {
            $typePlan = "office";

            $offices = $filter["office"];

            $sql2 = "SELECT * FROM office_sales_plan p WHERE p.office_id in ($offices) AND date = '$date'";

            $result = $db->pquery($sql2, array());
            $numRows2 = $db->num_rows($result);


            $raw2 = [];
            for ($i = 0; $i < $numRows2; $i++) {
                $raw2[$i] = $db->query_result_rowdata($result, $i);
            }

            $sql = "SELECT * FROM vtiger_office as o WHERE o.officeid in ($offices) AND $accessOfficesWhere";

            $result = $db->pquery($sql, array());
            $numRows = $db->num_rows($result);

            $raw = [];
            $office = [];
            for ($i = 0; $i < $numRows; $i++) {

                $flag = 0;

                foreach ($raw2 as $item) {
                    if ($item["office_id"] == $db->query_result($result, $i, 'officeid')) {
                        $office = [
                            "id" => $item["office_id"],
                            "region" => $this->findRegionByOffice($db->query_result($result, $i, 'officeid')),
                            "office" => $db->query_result($result, $i, 'office'),
                            "plan" => $this->nullOnEmpty($item["plan"]),
                            "floor1" => $this->nullOnEmpty($item["floor1"]),
                            "floor2" => $this->nullOnEmpty($item["floor2"]),
                            "floor3" => $this->nullOnEmpty($item["floor3"]),
                            "floor4" => $this->nullOnEmpty($item["floor4"])
                        ];
                        $flag = 1;
                        break;
                    }
                }

                if ($flag == 0) {
                    $office = [
                        "id" => $db->query_result($result, $i, 'officeid'),
                        "region" => $this->findRegionByOffice($db->query_result($result, $i, 'officeid')),
                        "office" => $db->query_result($result, $i, 'office'),
                        "plan" => "3-й этап",
                        "floor1" => "",
                        "floor2" => "",
                        "floor3" => "",
                        "floor4" => ""

                    ];
                }
                $raw[] = $office;

                $viewer->assign('OFFICESELECT', $office["office"]);
            }


            $sql8 = "SELECT * FROM worker_sales_plan p WHERE date = '$date'";

            $result = $db->pquery($sql8, array());
            $numRows = $db->num_rows($result);


            $raw8 = [];
            for ($i = 0; $i < $numRows; $i++) {
                $raw8[$i] = $db->query_result_rowdata($result, $i);
            }

            $sql3 = "SELECT first_name, last_name, id FROM vtiger_users as u 
                     LEFT JOIN vtiger_office as o ON u.office = o.officeid
                     WHERE u.office = $offices AND o.officeid is not null AND $accessOfficesWhere";

            $result = $db->pquery($sql3, array());
            $numRows = $db->num_rows($result);

            $raw2 = [];
            for ($i = 0; $i < $numRows; $i++) {

                $flag = 0;
                $worker = [];

                foreach ($raw8 as $item) {
                    if ($item["worker"] == $db->query_result($result, $i, 'id')) {
                        $worker = [
                            "id" => $db->query_result($result, $i, 'id'),
                            "office" => $office["office"],
                            "worker" => $db->query_result($result, $i, 'first_name') . " " . $db->query_result($result, $i, 'last_name'),
                            "plan" => $this->nullOnEmpty($item["plan"]),
                            "floor1" => $this->nullOnEmpty($item["floor1"]),
                            "floor2" => $this->nullOnEmpty($item["floor2"]),
                            "floor3" => $this->nullOnEmpty($item["floor3"]),
                            "floor4" => $this->nullOnEmpty($item["floor4"])
                        ];
                        $flag = 1;
                        break;
                    }
                }

                if ($flag == 0) {
                    $worker = [
                        "id" => $db->query_result($result, $i, 'id'),
                        "office" => $office["office"],
                        "worker" => $db->query_result($result, $i, 'first_name') . " " . $db->query_result($result, $i, 'last_name'),
                        "plan" => "3-й этап",
                        "floor1" => "",
                        "floor2" => "",
                        "floor3" => "",
                        "floor4" => ""
                    ];
                }

                $raw2[] = $worker;
            }

        }

        $viewer->assign('WORKERPLANJSON', json_encode($raw2));

//        $viewer->assign('ALLPLANJSON', json_encode($allPlan));
        $viewer->assign('OFFICEPLANJSON', json_encode($raw));
        $viewer->assign('EDITPLAN', true);
        $viewer->assign('TYPEPLAN', $typePlan);
        $viewer->assign('MONTHPERIOD', $filter['period']);
        $viewer->assign('STRDATE', $strDate);

    }

    private
    function GenerateRandomColor()
    {
        $color = '#';
        $colorHexLighter = array("9", "A", "B", "C", "D", "E", "F", "1", "2", "3", "4", "5", "6", "7", "8");
        for ($x = 0; $x < 6; $x++):
            $color .= $colorHexLighter[array_rand($colorHexLighter, 1)];
        endfor;
        $result = substr($color, 0, 7);
        if ($result == '#7FFF00' || $result == '#a20000') {
            return $this->GenerateRandomColor();
        } else {
            return $result;
        }

    }

    function getSalesPlan(Vtiger_Request $request, $viewer)
    {
        $franchiseCheckbox = false;

        $db = PearDatabase::getInstance();


        $userModel = Users_Record_Model::getCurrentUserModel();
        $userRole = $userModel->getRole();

        $sqlRole = "SELECT depth FROM vtiger_role WHERE roleid = '$userRole'";
        $result = $db->pquery($sqlRole, array());
        $depth = $db->query_result_rowdata($result, "depth");

        $editPlanButton = true;
        if ($depth["depth"] > 4) {
            $editPlanButton = false;
        }

        $accessOfficesWhere = "1=0";

        if ($this->office_to_region[$userRole]) {

            foreach ($this->office_to_region[$userRole] as $office) {
                $accessOfficesWhere .= " OR officeid = '$office'";
            }

        } elseif ($userModel->isAdminUser()) {
            $accessOfficesWhere .= " OR 1=1";
            $franchiseCheckbox = true;
        } else {
            $accessOfficesWhere .= " OR officeid = '" . $this->filter_data['office'] . "'";
        }

        $accessOfficesWhere = "($accessOfficesWhere)";


        $addQuery = $this->addQueryFilter();


        $row_sum = array();

        $row_margin = array();
        $sum_sum = 0;


        $scripts = array();

        $valCheckbox = false;

        if ($_GET["franchiseCheckbox"] == "on") {
            $valCheckbox = true;
        }

        if ($this->filter_data['user']) {
            $sql = "SELECT * FROM vtiger_users WHERE id = " . $this->filter_data['user'];
            $result = $db->pquery($sql, array());
            $this->filter_data['office'] = $db->query_result($result, 0, 'office');
            $this->filter_data['user'] = null;
        }

        if (!$this->filter_data['office']) {
            $sql = "SELECT p.amount-pcf.cf_1256 AS amount , c1.smownerid, u.first_name, u.last_name, o.officeid , o.office, pcf.cf_1225 AS date  FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
            where c1.deleted=0 AND $accessOfficesWhere and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery;
        } else {
            $sql = "SELECT p.amount-pcf.cf_1256 AS amount , c1.smownerid, u.first_name, u.last_name, o.officeid , o.office, pcf.cf_1225 AS date  FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
            where u.office =" . $this->filter_data['office'] . " AND c1.deleted=0 AND $accessOfficesWhere and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' ";

        }


        if (strlen($this->filter_data['period']) < 8) {
            $strArr = explode(".", $this->filter_data['period']);
            $strPeriod = $strArr[1] . "-" . $strArr[0];
            $dateObj = new DateTime($strPeriod);
            $start = $strPeriod . "-01";
            $finish = $strPeriod . "-" . $dateObj->format('t');
        } else {
            $dateObj = new DateTime();
            $strPeriod = $dateObj->format('Y-m');
            $start = $strPeriod . "-01";
            $finish = $strPeriod . "-" . $dateObj->format('t');
        }
        $titlePeriod = $dateObj->format('m');

        $dateNow = new DateTime();
        switch ($titlePeriod) {
            case 1:
                $m = 'Январь';
                break;
            case 2:
                $m = 'Февраль';
                break;
            case 3:
                $m = 'Март';
                break;
            case 4:
                $m = 'Апрель';
                break;
            case 5:
                $m = 'Май';
                break;
            case 6:
                $m = 'Июнь';
                break;
            case 7:
                $m = 'Июль';
                break;
            case 8:
                $m = 'Август';
                break;
            case 9:
                $m = 'Сентябрь';
                break;
            case 10:
                $m = 'Октябрь';
                break;
            case 11:
                $m = 'Ноябрь';
                break;
            case 12:
                $m = 'Декабрь';
                break;
        }


        $number = $dateObj->format('t');

        $result = $db->pquery($sql, array($start, $finish));

        $numRows = $db->num_rows($result);
        $raw = array();

        for ($i = 0; $i < $numRows; $i++) {
            $rawBuffer = $db->query_result_rowdata($result, $i);
            $rawBuffer["office"] = str_replace(["&quot;"], "'", $rawBuffer["office"]);
            $rawBuffer[5] = str_replace(["&quot;"], "'", $rawBuffer["office"]);
            $raw[$i] = $rawBuffer;


        }


        if ($this->filter_data['office']) {
            $sql = "SELECT first_name, last_name, id FROM vtiger_users WHERE office =" . $this->filter_data['office'];
        } else {
            $sql = "SELECT first_name, last_name, id FROM vtiger_users";
        }
        if ($this->filter_data['user']) {
            $sql = "SELECT first_name, last_name, id FROM vtiger_users WHERE id =" . $this->filter_data['user'];
        }
        $result = $db->pquery($sql);

        $numRows = $db->num_rows($result);
        $users = array();

        for ($i = 0; $i < $numRows; $i++) {
            $users[$i] = $db->query_result_rowdata($result, $i);


        }


        if ($this->filter_data['region']) {
            $sql = "SELECT officeid, office FROM vtiger_office WHERE $accessOfficesWhere AND officeid IN (" . implode(',', $this->office_to_region[$this->filter_data['region']]) . ")";
        } else {
            if ($valCheckbox) {
                $of = implode(',', $this->office_to_region["H62"]);
                $sql = "SELECT officeid, office FROM vtiger_office WHERE $accessOfficesWhere";
            } else {
                $of = implode(',', $this->office_to_region["H62"]);
                $sql = "SELECT officeid, office FROM vtiger_office WHERE $accessOfficesWhere AND officeid NOT IN ($of)";
            }

        }

        $result = $db->pquery($sql);

        $numRows = $db->num_rows($result);
        $offices = array();

        for ($i = 0; $i < $numRows; $i++) {

            $rawBuffer = $db->query_result_rowdata($result, $i);
            $rawBuffer["office"] = str_replace(["&quot;"], "'", $rawBuffer["office"]);
            $rawBuffer[1] = str_replace(["&quot;"], "'", $rawBuffer["office"]);
            $offices[$i] = $rawBuffer;

        }
        $arrOffice = [];
        $arrOfficeIds = [];
        $arrName = [];
        $arrIds = [];
        $officesPlanAll = [];
        $color = [];
        foreach ($users as $key => $value) {
            if (!in_array($value['id'], $arrIds)) {
                $arrIds[$key]['id'] = $value['id'];
                $arrIds[$key]['name'] = $value['first_name'] . " " . $value['last_name'];
                $arrName[$value['first_name'] . " " . $value['last_name']] = $value['first_name'] . " " . $value['last_name'];

            }


        }

        foreach ($offices as $key => $value) {
            if (!in_array($value['officeid'], $arrOfficeIds)) {
                $arrOfficeIds[$key]['id'] = $value['officeid'];
                $arrOfficeIds[$key]['office'] = $value['office'];
                $arrOffice[$value['office']] = $value['office'];
            }
        }


        $line_sum = [];
        $selling = [];

        $arraySales = [];


        if ($this->filter_data['user']) {


            if (strlen($this->filter_data['period']) > 8) {
                $date = new  DateTime();
                $sql = "SELECT * FROM worker_sales_plan WHERE date=" . $date->format('m.Y') . "AND worker=" . $this->filter_data['user'];
            } else {
                $sql = "SELECT * FROM worker_sales_plan WHERE date=" . $this->filter_data['period'] . "AND worker=" . $this->filter_data['user'];
            }
            $result = $db->pquery($sql);

            $numRows = $db->num_rows($result);
            $officesPlan = array();

            for ($i = 0; $i < $numRows; $i++) {
                $officesPlan[$i] = $db->query_result_rowdata($result, $i);


            }

            $officesPlanAll = 0;
            foreach ($officesPlan as $itemOP) {

                switch ($itemOP['plan']) {
                    case "1-й этап":
                        $officesPlanAll = $itemOP['floor1'];
                        break;
                    case "2-й этап":
                        $officesPlanAll = $itemOP['floor2'];
                        break;
                    case "3-й этап":
                        $officesPlanAll = $itemOP['floor3'];
                        break;
                    case "4-й этап":
                        $officesPlanAll = $itemOP['floor4'];
                        break;
                }
                $arrayLabel['floor1'] = $itemOP['floor1'];
                $arrayLabel['floor2'] = $itemOP['floor2'];
                $arrayLabel['floor3'] = $itemOP['floor3'];
                $arrayLabel['floor4'] = $itemOP['floor4'];
            }


            $sum = 0;
            $sumAmountSelling = 0;
            foreach ($arrIds as $key => $arrId) {
                $selling[$key]['name'] = $arrId['name'];
                $selling[$key]['amount'] = 0;
                $amountSelling = 0;
                foreach ($raw as $value) {
                    if ($value['smownerid'] == $arrId['id']) {
                        $amountSelling += 1;
                        $selling[$key]['amount'] += round($value['amount']);
                    }

                }
                $sumAmountSelling += $amountSelling;
                $sum += round($selling[$key]['amount']);
                $selling[$key]['amount'] .= " / $amountSelling";


            }
            $sum .= " / $sumAmountSelling";


            for ($i = 1; $i <= $number; $i++) {
                if ($i < 10) {
                    $i = "0" . $i;
                }


                $line_sum[$strPeriod . "-" . $i]['План продаж'] = round($officesPlanAll * $i / $number);
                $arraySales[$strPeriod . "-" . $i]['План продаж'] = 0;

                if ($dateNow < new DateTime($strPeriod . "-" . $i)) {
                    continue;
                }

                foreach ($arrIds as $key => $arrId) {
                    $color[$key] = $this->GenerateRandomColor();

                    if ($i > 1) {
                        if ($i < 11) {
                            $a = "0" . ($i - 1);
                        } else {
                            $a = $i - 1;
                        }
                        $line_sum[$strPeriod . "-" . $i][$arrId['name']] = $line_sum[$strPeriod . "-" . $a][$arrId['name']];
                        $arraySales[$strPeriod . "-" . $i][$arrId['name']] = $arraySales[$strPeriod . "-" . $a][$arrId['name']];
                    } else {
                        $line_sum[$strPeriod . "-" . $i][$arrId['name']] = 0;
                        $arraySales[$strPeriod . "-" . $i][$arrId['name']] = 0;
                    }
                    foreach ($raw as $key1 => $value) {
                        if ($strPeriod . "-" . $i == $value['date'] && $value['smownerid'] == $arrId['id']) {

                            $line_sum[$strPeriod . "-" . $i][$arrId['name']] += round($value['amount']);
                            $arraySales[$strPeriod . "-" . $i][$arrId['name']]++;


                        }
                    }

                }


            }

            $arrName = array_merge(['План продаж' => 'План продаж'], $arrName);
            $titleOne = "Сотрудники";
            $message = "на сотрудника";


        } elseif ($this->filter_data['office']) {


            if (strlen($this->filter_data['period']) > 8) {
                $date = new  DateTime();
                $sql = "SELECT * FROM office_sales_plan WHERE date=" . $date->format('m.Y') . "AND office_id=" . $this->filter_data['office'];
            } else {
                $sql = "SELECT * FROM office_sales_plan WHERE date=" . $this->filter_data['period'] . "AND office_id=" . $this->filter_data['office'];
            }
            $result = $db->pquery($sql);

            $numRows = $db->num_rows($result);
            $officesPlan = array();

            for ($i = 0; $i < $numRows; $i++) {
                $officesPlan[$i] = $db->query_result_rowdata($result, $i);

            }
            $officesPlanAll = 0;


            $arrayLabel['floor1'] = 0;
            $arrayLabel['floor2'] = 0;
            $arrayLabel['floor3'] = 0;
            $arrayLabel['floor4'] = 0;

            foreach ($officesPlan as $itemOP) {

                switch ($itemOP['plan']) {
                    case "1-й этап":
                        $officesPlanAll = $itemOP['floor1'];
                        break;
                    case "2-й этап":
                        $officesPlanAll = $itemOP['floor2'];
                        break;
                    case "3-й этап":
                        $officesPlanAll = $itemOP['floor3'];
                        break;
                    case "4-й этап":
                        $officesPlanAll = $itemOP['floor4'];
                        break;
                }
                $arrayLabel['floor1'] = $itemOP['floor1'];
                $arrayLabel['floor2'] = $itemOP['floor2'];
                $arrayLabel['floor3'] = $itemOP['floor3'];
                $arrayLabel['floor4'] = $itemOP['floor4'];
            }


            $sum = 0;
            $sumAmountSelling = 0;
            foreach ($arrIds as $key => $arrId) {
                $selling[$key]['name'] = $arrId['name'];
                $selling[$key]['amount'] = 0;
                $amountSelling = 0;
                foreach ($raw as $value) {
                    if ($value['smownerid'] == $arrId['id']) {
                        $amountSelling += 1;
                        $selling[$key]['amount'] += round($value['amount']);
                    }

                }
                $sumAmountSelling += $amountSelling;
                $sum += round($selling[$key]['amount']);
                $selling[$key]['amount'] = number_format($selling[$key]['amount'], 0, ".", ",");
                $selling[$key]['amount'] .= " / $amountSelling";


            }
            $sum = number_format($sum, 0, ".", ",");
            $sum .= " / $sumAmountSelling";


            for ($i = 1; $i <= $number; $i++) {
                if ($i < 10) {
                    $i = "0" . $i;
                }

                if ($i < 11) {
                    $a = "0" . ($i - 1);
                } else {
                    $a = $i - 1;
                }
                $line_sum[$strPeriod . "-" . $i]['План продаж'] = round($officesPlanAll * $i / $number);
                $arraySales[$strPeriod . "-" . $i]['План продаж'] = 0;
                if ($dateNow < new DateTime($strPeriod . "-" . $i)) {
                    continue;
                }
                if ($i > 1) {
                    $line_sum[$strPeriod . "-" . $i]['Офис'] = $line_sum[$strPeriod . "-" . $a]['Офис'];
                    $arraySales[$strPeriod . "-" . $i]['Офис'] = $arraySales[$strPeriod . "-" . $a]['Офис'];
                } else {
                    $line_sum[$strPeriod . "-" . $i]['Офис'] = 0;
                    $arraySales[$strPeriod . "-" . $i]['Офис'] = 0;
                }

                foreach ($raw as $item) {
                    if ($strPeriod . "-" . $i == $item['date']) {
                        $line_sum[$strPeriod . "-" . $i]['Офис'] += round($item['amount']);
                        $arraySales[$strPeriod . "-" . $i]['Офис']++;
                    }
                }


                foreach ($arrIds as $key => $arrId) {
                    $color[$key] = $this->GenerateRandomColor();

                    if ($i > 1) {

                        $line_sum[$strPeriod . "-" . $i][$arrId['name']] = $line_sum[$strPeriod . "-" . $a][$arrId['name']];
                        $arraySales[$strPeriod . "-" . $i][$arrId['name']] = $arraySales[$strPeriod . "-" . $a][$arrId['name']];
                    } else {
                        $line_sum[$strPeriod . "-" . $i][$arrId['name']] = 0;
                        $arraySales[$strPeriod . "-" . $i][$arrId['name']] = 0;
                    }
                    foreach ($raw as $key1 => $value) {
                        if ($strPeriod . "-" . $i == $value['date'] && $value['smownerid'] == $arrId['id']) {

                            $line_sum[$strPeriod . "-" . $i][$arrId['name']] += round($value['amount']);
                            $arraySales[$strPeriod . "-" . $i][$arrId['name']]++;

                        }
                    }

                }
                $message = "на офис";

            }

            $arrName = array_merge(['План продаж' => 'План продаж', 'Офис' => 'Офис'], $arrName);
            $titleOne = "Сотрудники";
        } else {
            if (strlen($this->filter_data['period']) > 8) {
                $date = new  DateTime();
                $sql = "SELECT * FROM office_sales_plan WHERE date=" . $date->format('m.Y');
            } else {
                $sql = "SELECT * FROM office_sales_plan WHERE date=" . $this->filter_data['period'];
            }
            $result = $db->pquery($sql);

            $numRows = $db->num_rows($result);
            $officesPlan = array();

            for ($i = 0; $i < $numRows; $i++) {
                $officesPlan[$i] = $db->query_result_rowdata($result, $i);

            }


            $officesPlanAll = 0;
            $sum = 0;
            $sumAmountSelling = 0;

            $arrayLabel['floor1'] = 0;
            $arrayLabel['floor2'] = 0;
            $arrayLabel['floor3'] = 0;
            $arrayLabel['floor4'] = 0;
            foreach ($arrOfficeIds as $key => $arrOfficeId) {
                foreach ($officesPlan as $itemOP) {
                    if ($arrOfficeId['id'] == $itemOP['office_id']) {
                        switch ($itemOP['plan']) {
                            case "1-й этап":
                                $officesPlanAll += $itemOP['floor1'];
                                break;
                            case "2-й этап":
                                $officesPlanAll += $itemOP['floor2'];
                                break;
                            case "3-й этап":
                                $officesPlanAll += $itemOP['floor3'];
                                break;
                            case "4-й этап":
                                $officesPlanAll += $itemOP['floor4'];
                                break;


                        }
                        $arrayLabel['floor1'] += $itemOP['floor1'];
                        $arrayLabel['floor2'] += $itemOP['floor2'];
                        $arrayLabel['floor3'] += $itemOP['floor3'];
                        $arrayLabel['floor4'] += $itemOP['floor4'];
                    }


                }
                $selling[$key]['name'] = $arrOfficeId['office'];
                $selling[$key]['amount'] = 0;
                $amountSelling = 0;
                foreach ($raw as $value) {
                    if ($value['officeid'] == $arrOfficeId['id']) {
                        $amountSelling += 1;
                        $selling[$key]['amount'] += round($value['amount']);
                    }

                }


                $sumAmountSelling += $amountSelling;
                $sum += round($selling[$key]['amount']);
                $selling[$key]['amount'] = number_format($selling[$key]['amount'], 0, ".", ",");
                $selling[$key]['amount'] .= " / $amountSelling";

            }


            for ($i = 1; $i <= $number; $i++) {
                if ($i < 10) {
                    $i = "0" . $i;
                }

                if ($i < 11) {
                    $a = "0" . ($i - 1);
                } else {
                    $a = $i - 1;
                }
                $line_sum[$strPeriod . "-" . $i]['План продаж'] = round($officesPlanAll * $i / $number);
                $arraySales[$strPeriod . "-" . $i]['План продаж'] = 0;

                if ($dateNow < new DateTime($strPeriod . "-" . $i)) {
                    continue;
                }

                if ($i > 1) {
                    $line_sum[$strPeriod . "-" . $i]['Сумма офисов'] = $line_sum[$strPeriod . "-" . $a]['Сумма офисов'];
                    $arraySales[$strPeriod . "-" . $i]['Сумма офисов'] = $arraySales[$strPeriod . "-" . $a]['Сумма офисов'];
                } else {
                    $line_sum[$strPeriod . "-" . $i]['Сумма офисов'] = 0;
                    $arraySales[$strPeriod . "-" . $i]['Сумма офисов'] = 0;
                }
                foreach ($raw as $item) {
                    if ($strPeriod . "-" . $i == $item['date']) {
                        $line_sum[$strPeriod . "-" . $i]['Сумма офисов'] += round($item['amount']);
                        $arraySales[$strPeriod . "-" . $i]['Сумма офисов']++;
                    }
                }

                foreach ($arrOfficeIds as $key => $arrOfficeId) {
                    $color[$key] = $this->GenerateRandomColor();

                    if ($i > 1) {

                        $line_sum[$strPeriod . "-" . $i][$arrOfficeId['office']] = $line_sum[$strPeriod . "-" . $a][$arrOfficeId['office']];
                        $arraySales[$strPeriod . "-" . $i][$arrOfficeId['office']] = $arraySales[$strPeriod . "-" . $a][$arrOfficeId['office']];
                    } else {
                        $line_sum[$strPeriod . "-" . $i][$arrOfficeId['office']] = 0;
                        $arraySales[$strPeriod . "-" . $i][$arrOfficeId['office']] = 0;
                    }
                    foreach ($raw as $key1 => $value) {
                        if ($strPeriod . "-" . $i == $value['date'] && $value['officeid'] == $arrOfficeId['id']) {

                            $line_sum[$strPeriod . "-" . $i][$arrOfficeId['office']] += round($value['amount']);
                            $arraySales[$strPeriod . "-" . $i][$arrOfficeId['office']]++;


                        }
                    }
                }


            }


            $arrName = $arrOffice;
            $titleOne = "Офисы";
            $sum = number_format($sum, 0, ".", ",");
            $sum .= " / $sumAmountSelling";
            //  $line_sum[$start] = array_merge(['План продаж' => 0], $line_sum[$start]);
            //$line_sum[$finish] = array_merge(['План продаж' => $officesPlan['plan']], $line_sum[$finish]);

            $arrName = array_merge(['План продаж' => 'План продаж', 'Сумма офисов' => 'Сумма офисов'], $arrName);


            $message = "по офисам";
        }

        $color = array_merge(array('#a20000', '#7FFF00'), $color);


        $selling = array_merge([0 => array('name' => 'План продаж', 'amount' => number_format($officesPlanAll, 0, ".", ","))], $selling);

        $table['getTableSum'] = $row_sum;
        asort($table['getTableSum']);
        $table['getTableSum']['Итого'] = $sum_sum;
        $table['getTableMargin'] = $row_margin;
        asort($table['getTableMargin']);


        $graf = new grafConstructorLine($line_sum, $arrName, 'LineAvgSum', $color, "План продаж $message за $m, " . $dateObj->format('Y'), '', true, $arrayLabel, $arraySales);
        array_push($scripts, $graf->ScriptSales());

        if ($this->filter_data['office'] && !$this->filter_data['user']) {
            foreach ($arrIds as $key => $arrId) {
                if (strlen($this->filter_data['period']) > 8) {
                    $date = new  DateTime();
                    $sql = "SELECT * FROM worker_sales_plan WHERE date=" . $date->format('m.Y') . "AND worker=" . $arrId['id'];
                } else {
                    $sql = "SELECT * FROM worker_sales_plan WHERE date=" . $this->filter_data['period'] . "AND worker=" . $arrId['id'];
                }
                $result = $db->pquery($sql);

                $numRows = $db->num_rows($result);
                $userPlansAll = array();

                for ($i = 0; $i < $numRows; $i++) {
                    $userPlansAll[$i] = $db->query_result_rowdata($result, $i);


                }
                $usersPlan = 0;
                $arrayLabelUser['floor1'] = 0;
                $arrayLabelUser['floor2'] = 0;
                $arrayLabelUser['floor3'] = 0;
                $arrayLabelUser['floor4'] = 0;


                foreach ($userPlansAll as $itemOP) {

                    switch ($itemOP['plan']) {
                        case "1-й этап":
                            $usersPlan = $itemOP['floor1'];
                            break;
                        case "2-й этап":
                            $usersPlan = $itemOP['floor2'];
                            break;
                        case "3-й этап":
                            $usersPlan = $itemOP['floor3'];
                            break;
                        case "4-й этап":
                            $usersPlan = $itemOP['floor4'];
                            break;
                    }
                    $arrayLabelUser['floor1'] = $itemOP['floor1'];
                    $arrayLabelUser['floor2'] = $itemOP['floor2'];
                    $arrayLabelUser['floor3'] = $itemOP['floor3'];
                    $arrayLabelUser['floor4'] = $itemOP['floor4'];
                }


                for ($i = 1; $i <= $number; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }


                    $line_sum_user[$strPeriod . "-" . $i]['План продаж'] = round($usersPlan * $i / $number);
                    $arraySalesUser[$strPeriod . "-" . $i]['План продаж'] = 0;

                    if ($dateNow < new DateTime($strPeriod . "-" . $i)) {
                        continue;
                    }


                    $colorUser[$key] = $this->GenerateRandomColor();

                    if ($i > 1) {
                        if ($i < 11) {
                            $a = "0" . ($i - 1);
                        } else {
                            $a = $i - 1;
                        }
                        $line_sum_user[$strPeriod . "-" . $i][$arrId['name']] = $line_sum_user[$strPeriod . "-" . $a][$arrId['name']];
                        $arraySalesUser[$strPeriod . "-" . $i][$arrId['name']] = $arraySalesUser[$strPeriod . "-" . $a][$arrId['name']];
                    } else {
                        $line_sum_user[$strPeriod . "-" . $i][$arrId['name']] = 0;
                        $arraySalesUser[$strPeriod . "-" . $i][$arrId['name']] = 0;
                    }
                    foreach ($raw as $key1 => $value) {
                        if ($strPeriod . "-" . $i == $value['date'] && $value['smownerid'] == $arrId['id']) {

                            $line_sum_user[$strPeriod . "-" . $i][$arrId['name']] += round($value['amount']);
                            $arraySalesUser[$strPeriod . "-" . $i][$arrId['name']]++;


                        }
                    }


                }


                $arrName = ['План продаж' => 'План продаж', $arrId['name'] => $arrId['name']];
                $graf = [];
                $colorUser = array_merge(array('#a20000'), $colorUser);
                $graf[$key] = new grafConstructorLine($line_sum_user, $arrName, 'LineAvgSum' . $arrId['id'], $colorUser, $arrId['name'], '', true, $arrayLabelUser, $arraySalesUser);
                array_push($scripts, $graf[$key]->ScriptSales());

            }


        }

        $viewer->assign('ADDSCRIPTS', $scripts);


        if ($this->filter_data['office'] && !$this->filter_data['user']) {
            $arrDiv = array('LineAvgSum', 'getTableSum');
            foreach ($arrIds as $arrId) {
                $arrDiv[] = 'LineAvgSum' . $arrId['id'];
            }
            $viewer->assign('GRAFDIV', $arrDiv);
        } else {

            $viewer->assign('GRAFDIV', array('LineAvgSum', 'getTableSum'));
        }
        if ($this->filter_data['region'] || $this->filter_data['office'] || $this->filter_data['user']) {
            if ($this->filter_data['office'] && !$this->filter_data['user']) {
                $arrStile = array(
                    'LineAvgSum' => array('class' => 'span9', 'height' => '525px'),
                    'getTableSum' => array('class' => 'span3 table-info', 'height' => '500px', 'title' => array('Офис', 'Выручка'), 'colspan' => '2', 'dataField' => 1));
                foreach ($arrIds as $arrId) {

                    $arrStile['LineAvgSum' . $arrId['id']] = array('class' => 'span6', 'height' => '350px');
                }
                $viewer->assign('DIVSTILE', $arrStile);
            } else {
                $viewer->assign('DIVSTILE', array(
                    'LineAvgSum' => array('class' => 'span9', 'height' => '525px'),
                    'getTableSum' => array('class' => 'span3 table-info', 'height' => '500px', 'title' => array('Офис', 'Выручка'), 'colspan' => '2', 'dataField' => 1)));
            }
        } else {
            $viewer->assign('DIVSTILE', array(
                'LineAvgSum' => array('class' => 'span9', 'height' => '900px'),
                'getTableSum' => array('class' => 'w-25', 'height' => '1577px', 'title' => array('Офис', 'Выручка'), 'colspan' => '2', 'dataField' => 1),

            ));
        }
        unset($color[1]);
        rsort($color);
        foreach ($selling as $key => $item) {
            $selling[$key]['color'] = $color[$key];

        }

        $viewer->assign('TABLE', $table);
        $viewer->assign('PLAN', true);
        $filter = $request->get('filtre');
        $viewer->assign('MONTHPERIOD', $filter['period']);
        $viewer->assign('TITLEONE', $titleOne);
        $viewer->assign('SELLING', $selling);
        $viewer->assign('SUM', $sum);
        $viewer->assign('COLOR', '#7FFF00');
        $viewer->assign('EDITPLANBUTTON', $editPlanButton);
        $viewer->assign('FRANCHISECHECKBOX', $franchiseCheckbox);
        $viewer->assign('VALCHECKBOX', $valCheckbox);

    }

    function getProceeds(Vtiger_Request $request, $viewer)
    {
        $addQuery = $this->addQueryFilter();
        if (empty($this->filter_data['office'])) {
            $sql = "SELECT FLOOR(SUM(p.amount)) as cacheflow, FLOOR(SUM(p.amount-pcf.cf_1256)) as margin, (SUM(p.amount-pcf.cf_1256)/SUM(p.amount)*100) as procent, o.office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  pcf.cf_1215";
        } else {
            $sql = "select FLOOR(SUM(p.amount)) as cacheflow, FLOOR(SUM(p.amount-pcf.cf_1256)) as margin, (SUM(p.amount-pcf.cf_1256)/SUM(p.amount)*100) as procent, CONCAT(o.first_name, ' ', o.last_name) as office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_users as o ON o.id = c1.smownerid
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  c1.smownerid";
        }
        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $row_sum = array();
        $row_percent = array();
        $row_margin = array();
        $sum_sum = 0;
        $sum_margin = 0;
        foreach ($raw as $_row) {
            $row_sum[str_replace('&quot;', '', $_row['office'])] = $_row['cacheflow'];
            $sum_sum += $_row['cacheflow'];
            $row_margin[str_replace('&quot;', '', $_row['office'])] = $_row['margin'];
            $sum_margin += $_row['margin'];
            $row_percent[str_replace('&quot;', '', $_row['office'])] = round($_row['procent'], 2);
        }

        $graf = new grafConstructorRadar($row_sum, array('Всего' => 'Всего'), 'statAvgSum', $color, "Выручка с " . str_replace(',', " по ", $this->filter_data['period']), '');
        $scripts = array();
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorRadar($row_margin, array('Всего' => 'Всего'), 'statAvgMargin', $color, "Доход с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorRadar($row_percent, array('Всего' => 'Всего'), 'statAvgPercent', $color, "Наценка с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());

        $sql = "SELECT FLOOR(SUM(p.amount)) as cacheflow, FLOOR(SUM(p.amount-pcf.cf_1256)) as margin, (SUM(p.amount-pcf.cf_1256)/SUM(p.amount)*100) as procent, pcf.cf_1225 as office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  pcf.cf_1225";


        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();

        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $line_sum = array();
        $line_percent = array();
        $line_margin = array();
        foreach ($raw as $_row) {
            $line_sum[$_row['office']]['За день'] = $_row['cacheflow'];
            $line_margin[$_row['office']]['За день'] = $_row['margin'];
            $line_percent[$_row['office']]['За день'] = round($_row['procent'], 2);
            $sum += $_row['cacheflow'];
            $margin += $_row['margin'];
            $percent += round($_row['procent'], 2);
        }
        foreach ($line_percent as $key => $value) {

            $line_percent[$key]['Средняя за период'] = round($percent / count($raw), 2);
        }
        $table = array();
        //$_tmegre = array_m
        $table['getTableSum'] = $row_sum;
        asort($table['getTableSum']);
        $table['getTableSum']['Итого'] = $sum_sum;
        $table['getTableMargin'] = $row_margin;
        asort($table['getTableMargin']);
        $table['getTableMargin']['Итого'] = $sum_margin;
        $table['getTableProcent'] = $row_percent;
        asort($table['getTableProcent']);
        $table['getTableProcent']['Средняя'] = $line_percent[key($line_sum)]['Средняя за период'];

        $graf = new grafConstructorLine($line_sum, array('За день' => 'За день'), 'LineAvgSum', $color, "Выручка по дням с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorLine($line_margin, array('За день' => 'За день'), 'LineAvgMargin', $color, "Доход по дням с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorLine($line_percent, array('За период' => 'За период', 'За день' => 'За день'), 'LineAvgPercent', $color, "Наценка по дням с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $viewer->assign('ADDSCRIPTS', $scripts);
        $viewer->assign('GRAFDIV', array('LineAvgSum', 'statAvgSum', 'getTableSum', 'LineAvgMargin', 'statAvgMargin', 'getTableMargin', 'LineAvgPercent', 'statAvgPercent', 'getTableProcent',));
        $viewer->assign('DIVSTILE', array('statAvgSum' => array('class' => 'span8', 'height' => '500px'),
            'statAvgMargin' => array('class' => 'span8', 'height' => '500px'),
            'statAvgPercent' => array('class' => 'span8', 'height' => '500px'),
            'LineAvgSum' => array('class' => 'span12', 'height' => '300px'),
            'LineAvgMargin' => array('class' => 'span12', 'height' => '300px'),
            'LineAvgPercent' => array('class' => 'span12', 'height' => '300px'),
            'getTableSum' => array('class' => 'span4', 'height' => 'auto', 'title' => array('Офис', 'Выручка'), 'colspan' => '2', 'dataField' => 1),
            'getTableMargin' => array('class' => 'span4', 'height' => 'auto', 'title' => array('Офис', 'Доход'), 'colspan' => '2', 'dataField' => 1),
            'getTableProcent' => array('class' => 'span4', 'height' => 'auto', 'title' => array('Офис', 'Наценка'), 'colspan' => '2', 'dataField' => 2),
        ));
        $viewer->assign('TABLE', $table);
        //echo '<pre>';print_r($atc);echo '</pre>';die();
    }

    function getAverage(Vtiger_Request $request, $viewer)
    {
        $addQuery = $this->addQueryFilter();
        if (empty($this->filter_data['office'])) {
            $sql = "SELECT FLOOR(AVG(p.amount)) as cacheflow, FLOOR(AVG(p.amount-pcf.cf_1256)) as margin, count(p.amount-pcf.cf_1256) as colbron, sum(p.amount) as sumbron, (AVG(p.amount-pcf.cf_1256)/AVG(p.amount)*100) as procent, o.office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  pcf.cf_1215";
        } else {
            $sql = "select FLOOR(AVG(p.amount)) as cacheflow, sum(p.amount) as sumbron, FLOOR(AVG(p.amount-pcf.cf_1256)) as margin, count(p.amount-pcf.cf_1256) as colbron, (AVG(p.amount-pcf.cf_1256)/AVG(p.amount)*100) as procent, CONCAT(o.first_name, ' ', o.last_name) as office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_users as o ON o.id = c1.smownerid
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  c1.smownerid";
        }
        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $row_sum = array();
        $row_percent = array();
        $row_margin = array();
        $col_sum = 0;
        $col_margin = 0;
        $col_sum = 0;
        $col_percent = 0;
        $col = 0;
        foreach ($raw as $_row) {
            $row_sum[str_replace('&quot;', '', $_row['office'])] = $_row['cacheflow'];
            $row_margin[str_replace('&quot;', '', $_row['office'])] = $_row['margin'];
            $row_percent[str_replace('&quot;', '', $_row['office'])] = round($_row['procent'], 2);
            $col_sum += $_row['sumbron'];
            $col_margin += $_row['margin'] * $_row['colbron'];
            $col_percent += $_row['procent'] * $_row['colbron'];
            $col += $_row['colbron'];
        }

        $graf = new grafConstructorRadar($row_sum, array('Всего' => 'Всего'), 'statAvgSum', $color, "Средний чек по стоимости тура с " . str_replace(',', " по ", $this->filter_data['period']), '');
        $scripts = array();
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorRadar($row_margin, array('Всего' => 'Всего'), 'statAvgMargin', $color, "Средний доход сделки с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorRadar($row_percent, array('Всего' => 'Всего'), 'statAvgPercent', $color, "Средняя наценка с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());

        $sql = "SELECT FLOOR(AVG(p.amount)) as cacheflow, FLOOR(AVG(p.amount-pcf.cf_1256)) as margin, (AVG(p.amount-pcf.cf_1256)/AVG(p.amount)*100) as procent, pcf.cf_1225 as office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  pcf.cf_1225";


        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));

        $numRows = $db->num_rows($result);
        $raw = array();

        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $line_sum = array();
        $line_percent = array();
        $line_margin = array();
        foreach ($raw as $_row) {
            $line_sum[$_row['office']]['За день'] = $_row['cacheflow'];
            $line_margin[$_row['office']]['За день'] = $_row['margin'];
            $line_percent[$_row['office']]['За день'] = round($_row['procent'], 2);
            $sum += $_row['cacheflow'];
            $margin += $_row['margin'];
            $percent += round($_row['procent'], 2);
        }
        foreach ($line_sum as $key => $value) {
            $line_sum[$key]['За период'] = round($col_sum / $col, 0);
            $line_margin[$key]['За период'] = round($col_margin / $col, 0);
            $line_percent[$key]['За период'] = round($col_percent / $col, 2);
        }
        $table = array();
        //$_tmegre = array_m
        $table['getTableSum'] = $row_sum;
        asort($table['getTableSum']);
        $table['getTableSum']['Средняя'] = $line_sum[key($line_sum)]['За период'];
        $table['getTableMargin'] = $row_margin;
        asort($table['getTableMargin']);
        $table['getTableMargin']['Средняя'] = $line_margin[key($line_sum)]['За период'];
        $table['getTableProcent'] = $row_percent;
        asort($table['getTableProcent']);
        $table['getTableProcent']['Средняя'] = $line_percent[key($line_sum)]['За период'];

        $graf = new grafConstructorLine($line_sum, array('За период' => 'За период', 'За день' => 'За день'), 'LineAvgSum', $color, "Средний чек по стоимости тура по дням с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorLine($line_margin, array('За период' => 'За период', 'За день' => 'За день'), 'LineAvgMargin', $color, "Средний доход сделки по дням с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $graf = new grafConstructorLine($line_percent, array('За период' => 'За период', 'За день' => 'За день'), 'LineAvgPercent', $color, "Средняя наценка по дням с " . str_replace(',', " по ", $this->filter_data['period']), '');
        array_push($scripts, $graf->Script());
        $viewer->assign('ADDSCRIPTS', $scripts);
        $viewer->assign('GRAFDIV', array('LineAvgSum', 'statAvgSum', 'getTableSum', 'LineAvgMargin', 'statAvgMargin', 'getTableMargin', 'LineAvgPercent', 'statAvgPercent', 'getTableProcent',));
        $viewer->assign('DIVSTILE', array('statAvgSum' => array('class' => 'span8', 'height' => '500px'),
            'statAvgMargin' => array('class' => 'span8', 'height' => '500px'),
            'statAvgPercent' => array('class' => 'span8', 'height' => '500px'),
            'LineAvgSum' => array('class' => 'span12', 'height' => '300px'),
            'LineAvgMargin' => array('class' => 'span12', 'height' => '300px'),
            'LineAvgPercent' => array('class' => 'span12', 'height' => '300px'),
            'getTableSum' => array('class' => 'span4', 'height' => 'auto', 'title' => array('Офис', 'Средний чек'), 'colspan' => '2', 'dataField' => 1),
            'getTableMargin' => array('class' => 'span4', 'height' => 'auto', 'title' => array('Офис', 'Средний доход'), 'colspan' => '2', 'dataField' => 1),
            'getTableProcent' => array('class' => 'span4', 'height' => 'auto', 'title' => array('Офис', 'Средняя наценка'), 'colspan' => '2', 'dataField' => 2),
        ));
        $viewer->assign('TABLE', $table);
        //echo '<pre>';print_r($atc);echo '</pre>';die();
    }

// Booking analiticks
    function getBookingReport(Vtiger_Request $request, $viewer)
    {
        $addQuery = $this->addQueryFilter();
        if (empty($this->filter_data['office'])) {
            $sql = "select count(p.potentialid) as value, o.office, p.sales_stage FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
left join vtiger_office as o ON o.officeid = pcf.cf_1215
where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' " . $addQuery . " group by p.sales_stage, pcf.cf_1215";
        } else {
            $sql = "select count(p.potentialid) as value, CONCAT(o.first_name, ' ', o.last_name) as office, p.sales_stage FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_users as o ON o.id = c1.smownerid
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' " . $addQuery . " group by p.sales_stage, c1.smownerid";
        }
        //echo $sql;
        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));
        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $row = array();
        $list = array('Всего' => 0, 'Бронь подтверждена (Продажа)' => 0, 'Бронь не подтверждена' => 0, 'Аннулирована' => 0);
        $sum = array();
        foreach ($raw as $key => $val) {
            $val['office'] = str_replace('&quot;', '', $val['office']);
            if (!isset($row[$val['office']])) {
                $row[$val['office']] = $list;
            }
            switch ($val['sales_stage']) {
                case 'Closed Lost':
                    $row[$val['office']]['Аннулирована'] = $row[$val['office']]['Анулирована'] + $val['value'];
                    break;
                case'Closed Won':
                case'Бронь оплачена':
                case'Бронь потверждена':
                    $row[$val['office']]['Бронь подтверждена (Продажа)'] = $row[$val['office']]['Бронь подтверждена (Продажа)'] + $val['value'];
                    break;
                case'Договор заключен':
                    $row[$val['office']]['Бронь не подтверждена'] = $row[$val['office']]['Бронь не подтверждена'] + $val['value'];
                    break;

            }
            $row[$val['office']]['Всего'] = $row[$val['office']]['Всего'] + $val['value'];
        }
        //foreach ($row as $key => $val){
        //    $row[$key]['Всего'] = $sum[$key];
        //}
        $color = array('#acacac', '#239800', '#244399', '#f52434');
        $graf = new grafConstructorBarAndLine($row, $list, 'grafBronAll', $color, "Брони по офисам с " . str_replace(',', " по ", $this->filter_data['period'] . ''), 'Количество броней', 'regular');
        $scripts = array();
        array_push($scripts, $graf->Script());
// Брони по дням всего
        $addQuery = $this->addQueryFilter();
        if (empty($this->filter_data['office'])) {
            $sql = "select count(p.potentialid) as value, pcf.cf_1225 as office, p.sales_stage FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
left join vtiger_office as o ON o.officeid = pcf.cf_1215
where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' " . $addQuery . " group by p.sales_stage, pcf.cf_1225";
        } else {
            $sql = "select count(p.potentialid) as value, pcf.cf_1225 as office, p.sales_stage FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_users as o ON o.id = c1.smownerid
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' " . $addQuery . " group by p.sales_stage, pcf.cf_1225";
        }
        //echo $sql;
        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));
        $numRows = $db->num_rows($result);
        $raw = array();
        for ($i = 0; $i < $numRows; $i++) {
            $raw[$i] = $db->query_result_rowdata($result, $i);

        }

        $row = array();
        $list = array('Всего' => 0, 'Бронь подтверждена (Продажа)' => 0, 'Бронь не подтверждена' => 0, 'Аннулирована' => 0);
        $sum = array();
        foreach ($raw as $key => $val) {
            $val['office'] = str_replace('&quot;', '', $val['office']);
            if (!isset($row[$val['office']])) {
                $row[$val['office']] = $list;
            }
            switch ($val['sales_stage']) {
                case 'Closed Lost':
                    $row[$val['office']]['Аннулирована'] = $row[$val['office']]['Аннулирована'] + $val['value'];
                    break;
                case'Closed Won':
                case'Бронь оплачена':
                case'Бронь потверждена':
                    $row[$val['office']]['Бронь подтверждена (Продажа)'] = $row[$val['office']]['Бронь подтверждена (Продажа)'] + $val['value'];
                    break;
                case'Договор заключен':
                    $row[$val['office']]['Бронь не подтверждена'] = $row[$val['office']]['Бронь не подтверждена'] + $val['value'];
                    break;

            }
            $row[$val['office']]['Всего'] = $row[$val['office']]['Всего'] + $val['value'];
        }
        ksort($row);
        //foreach ($row as $key => $val){
        //    $row[$key]['Всего'] = $sum[$key];
        //}
        $color = array('#acacac', '#239800', '#244399', '#f52434');
        $graf = new grafConstructorBarAndLine($row, $list, 'grafBronAllDays', $color, "Брони по дням с " . str_replace(',', " по ", $this->filter_data['period'] . ''), 'Количество броней', false);

        array_push($scripts, $graf->Script());
        $color = array();
        $date_start_month = date('Y-m-01');
        $date_finish_month = date('Y-m-t');
        $row = array();
        $list = array();
        $sum = array();
        for ($_i = 1; $_i < 13; $_i++) {
            if (empty($this->filter_data['office'])) {
                $sql = "select count(p.potentialid) as value, o.office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN '$date_start_month' AND '$date_finish_month') and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  pcf.cf_1215";
            } else {
                $sql = "select count(p.potentialid) as value, CONCAT(o.first_name, ' ', o.last_name) as office FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_users as o ON o.id = c1.smownerid
            where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN '$date_start_month' AND '$date_finish_month') and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery . " group by  c1.smownerid";
            }

            $result = $db->pquery($sql, array());
            $numRows = $db->num_rows($result);
            $raw = array();

            for ($i = 0; $i < $numRows; $i++) {
                $raw[$i] = $db->query_result_rowdata($result, $i);

            }
            $_month = $this->getRusMonth[date('m', strtotime($date_start_month))];
            foreach ($raw as $key => $val) {
                $val['office'] = str_replace('&quot;', '', $val['office']);
                $row[$_month][$val['office']] = $val['value'];
                if (!in_array($val['office'], $list)) {
                    $list[$val['office']] = $val['office'];
                }
                $sum[$_month]['Всего'] = $sum[$_month]['Всего'] + $val['value'];
            }
            $_cur_date = $date_start_month;
            $date_start_month = date('Y-m-01', strtotime("-1 days", strtotime($_cur_date)));
            $date_finish_month = date('Y-m-t', strtotime("-1 days", strtotime($_cur_date)));

        }

        $row = array_reverse($row, true);
        $sum = array_reverse($sum, true);
        // echo '<pre>';print_r($sum);print_r($row);echo '</pre>';die();
        $graf = new grafConstructorBar($sum, array('Всего' => 'Всего'), 'grafBronYear', $color, "Брони за последний год", 'Количество броней', 'regular');
        array_push($scripts, $graf->Script('regular'));
        $graf = new grafConstructorBar($row, $list, 'grafBronOfYear', $color, "Брони по Офисам за последний год", 'Количество броней', 'regular');

        array_push($scripts, $graf->Script('regular'));

        $viewer->assign('ADDSCRIPTS', $scripts);
        $viewer->assign('GRAFDIV', array('grafBronAll', 'grafBronAllDays', 'grafBronYear', 'grafBronOfYear'));
        $viewer->assign('DIVSTILE', array('grafBronOfYear' => array('class' => 'span12', 'height' => '700px'),));
    }

    function getStatistic(Vtiger_Request $request, $viewer)
    {
        $addQuery = $this->addQueryFilter();
        $sql = "select p.potentialid FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
        inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
        left join vtiger_office as o ON o.officeid = pcf.cf_1215
        where c1.deleted=0 and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' " . $addQuery;
        $db = PearDatabase::getInstance();
        $result = $db->pquery($sql, array($this->date_start, $this->date_finish));
        $numRows = $db->num_rows($result);
        $crmid = array();
        for ($i = 0; $i < $numRows; $i++) {
            array_push($crmid, $db->query_result($result, $i, 'potentialid'));
        }
        if (count($crmid) > 0) {
            $sum = count($crmid);
            $crmid = "pcf.potentialid IN (" . implode(",", $crmid) . ")";
        } else {
            $crmid = "";
        }

// Страны
        $sql = "SELECT if (b.country_name is NULL, 'none', b.country_name) as country, count(pcf.potentialid) as value from vtiger_potentialscf as pcf LEFT JOIN vtiger_listcountry as b ON b.listcountryid = pcf.cf_1165 WHERE $crmid group by pcf.cf_1165";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $country = array();
        for ($i = 0; $i < $numRows; $i++) {
            $country[$db->query_result($result, $i, 'country')] = $db->query_result($result, $i, 'value');
        }
        arsort($country);
        $row = array();

        $none = 100;
        $i = 0;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row[$key]['value'] = $value;
                $row[$key]['procent'] = $procent;
                $none -= $procent;
            } else if ($key != 'none') {
                $row['Прочие']['value'] += $value;

            }
            $i++;
        }
        $table = array();
        $row['Прочие']['procent'] = $none;
        $row_graf = array();
        $row_round = array();
        $none = 100;
        $i = 0;
        $table['getTableCountry'] = $row;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row_graf[$key]['Всего'] = $value;
                $row_round[$key] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row_graf['Прочие']['Всего'] += $value;
                $i++;
            }

        }
        $row_round['Прочие'] = $none;
        $color = array();
        $scripts = array();
        $graf = new grafConstructorBar($row_graf, array('Всего' => 'Всего'), 'statCounrtryGraf', $color, "Страны", 'Количество');
        array_push($scripts, $graf->Script(false, false));
        $color = array("#FFAF00", "#2A0CD0", "#8A0CCF", "#FF0F00",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#FF6600",
            "#04D215",
            "#0D52D1",

            "#FCD202",
            "#8A0CCF",
            "#F8FF01",);
        $keys = array_keys($row_round);
        shuffle($keys);
        $new_sort = array();
        foreach ($keys as $key) {
            $new_sort[$key] = $row_round[$key];
        }
        $graf = new grafConstructorPie($new_sort, 'statCounrtryPie', $color);
        array_push($scripts, $graf->Script(false, false));
// Курорты
        $sql = "SELECT if (b.resort is NULL, 'none', b.resort) as country, count(pcf.potentialid) as value from vtiger_potentialscf as pcf LEFT JOIN vtiger_listresorts as b ON b.listresortsid = pcf.cf_1167 WHERE $crmid group by pcf.cf_1167";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $country = array();
        for ($i = 0; $i < $numRows; $i++) {
            $country[$db->query_result($result, $i, 'country')] = $db->query_result($result, $i, 'value');
        }
        arsort($country);
        $row = array();

        $none = 100;
        $i = 0;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row[$key]['value'] = $value;
                $row[$key]['procent'] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row['Прочие']['value'] += $value;
                $i++;
            }
        }
        $row['Прочие']['procent'] = $none;
        $table['getTableResorts'] = $row;
        $row_graf = array();
        $row_round = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row_graf[$key]['Всего'] = $value;
                $row_round[$key] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row_graf['Прочие']['Всего'] += $value;
                $i++;
            }

        }
        $row_round['Прочие'] = $none;
        $color = array();

        $graf = new grafConstructorBar($row_graf, array('Всего' => 'Всего'), 'statResortsGraf', $color, "Курорты", 'Количество');
        array_push($scripts, $graf->Script(false, false));
        $color = array("#FFAF00", "#2A0CD0", "#8A0CCF", "#FF0F00",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#FF6600",
            "#04D215",
            "#0D52D1",

            "#FCD202",
            "#8A0CCF",
            "#F8FF01",);
        $graf = new grafConstructorPie($row_round, 'statResortsPie', $color);
        array_push($scripts, $graf->Script(false, false));
// длительность
        $sql = "SELECT if (pcf.cf_1201 is NULL, 'none', pcf.cf_1201) as country , count(pcf.potentialid) as value from vtiger_potentialscf as pcf WHERE $crmid group by pcf.cf_1201";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $country = array();
        for ($i = 0; $i < $numRows; $i++) {
            $country[$db->query_result($result, $i, 'country')] = $db->query_result($result, $i, 'value');
        }
        arsort($country);
        $row = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row[$key . ' ночей']['value'] = $value;
                $row[$key . ' ночей']['procent'] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row['Прочие']['value'] += $value;
                $i++;
            }
        }
        $row['Прочие']['procent'] = $none;
        $table['getTableLong'] = $row;
        $row_graf = array();
        $row_round = array();
        $none = 100;
        $i = 0;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row_graf[$key]['Всего'] = $value;
                $row_round[$key] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row_graf['Прочие']['Всего'] += $value;
                $i++;
            }

        }
        $row_round['Прочие'] = $none;
        $color = array();

        $graf = new grafConstructorBar($row_graf, array('Всего' => 'Всего'), 'statLongGraf', $color, "Длительность", 'Количество');
        array_push($scripts, $graf->Script(false, false));
        $color = array("#FFAF00", "#2A0CD0", "#8A0CCF", "#FF0F00",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#FF6600",
            "#04D215",
            "#0D52D1",

            "#FCD202",
            "#8A0CCF",
            "#F8FF01",);
        $graf = new grafConstructorPie($row_round, 'statLongPie', $color);
        array_push($scripts, $graf->Script(false, false));
// Туроператоры
        $sql = "SELECT if (b.turoperator_name is NULL, 'none', b.turoperator_name) as country , count(pcf.potentialid) as value from vtiger_potentialscf as pcf LEFT JOIN vtiger_listtouroperators as b ON b.listtouroperatorsid = pcf.cf_1163 WHERE $crmid group by pcf.cf_1163";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $country = array();
        for ($i = 0; $i < $numRows; $i++) {
            $country[$db->query_result($result, $i, 'country')] = $db->query_result($result, $i, 'value');
        }
        arsort($country);
        $row = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row[$key]['value'] = $value;
                $row[$key]['procent'] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row['Прочие']['value'] += $value;
                $i++;
            }
        }
        $row['Прочие']['procent'] = $none;
        $table['getTableTO'] = $row;
        $row_graf = array();
        $row_round = array();
        $none = 100;
        $i = 0;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row_graf[$key]['Всего'] = $value;
                $row_round[$key] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row_graf['Прочие']['Всего'] += $value;
                $i++;
            }

        }
        $row_round['Прочие'] = $none;
        $color = array();

        $graf = new grafConstructorBar($row_graf, array('Всего' => 'Всего'), 'statTOGraf', $color, "Туроператоры", 'Количество');
        array_push($scripts, $graf->Script(false, false));
        $color = array("#FFAF00", "#2A0CD0", "#8A0CCF", "#FF0F00",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#FF6600",
            "#04D215",
            "#0D52D1",

            "#FCD202",
            "#8A0CCF",
            "#F8FF01",);
        $graf = new grafConstructorPie($row_round, 'statTOPie', $color);
        array_push($scripts, $graf->Script(false, false));
// Количество звезд
        $sql = "SELECT pcf.cf_1368 as country , count(pcf.potentialid) as value from vtiger_potentialscf as pcf WHERE $crmid group by pcf.cf_1368";

        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $country = array();
        for ($i = 0; $i < $numRows; $i++) {
            $country[$db->query_result($result, $i, 'country')] = $db->query_result($result, $i, 'value');
        }
        arsort($country);
        $row = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row[$key . '*']['value'] = $value;
                $row[$key . '*']['procent'] = $procent;
                $none -= $procent;
                $i++;
            } else {
                $row['Прочие']['value'] += $value;
                $i++;
            }
        }
        $row['Прочие']['procent'] = $none;
        $table['getTableHotel'] = $row;
        $row_graf = array();
        $row_round = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row_graf[$key . '*']['Всего'] = $value;
                $row_round[$key . '*'] = $procent;
                $none -= $procent;
                $i++;
            } else {
                $_row_graf_ += $value;
                $i++;
            }

        }
        $row_graf['Прочие']['Всего'] = $_row_graf_;
        $row_round['Прочие'] = $none;
        $color = array();

        $graf = new grafConstructorBar($row_graf, array('Всего' => 'Всего'), 'statHotelGraf', $color, "Классификация отелей", 'Количество');
        array_push($scripts, $graf->Script(false, false));
        $color = array("#FFAF00", "#2A0CD0", "#8A0CCF", "#FF0F00",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#FF6600",
            "#04D215",
            "#0D52D1",

            "#FCD202",
            "#8A0CCF",
            "#F8FF01",);
        $graf = new grafConstructorPie($row_round, 'statHotelPie', $color);
        array_push($scripts, $graf->Script(false, false));
        // Список пассажиров
        $sql = "SELECT pcf.cf_1211  from vtiger_potentialscf as pcf WHERE $crmid";
        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $contact = array();
        for ($i = 0; $i < $numRows; $i++) {
            $_row_contact = $db->query_result($result, $i, 'cf_1211');
            $_row_contact = explode('#', $_row_contact);
            foreach ($_row_contact as $_contact) {
                array_push($contact, $_contact);
            }
        }
        $contact = array_unique($contact);
        $sum = count($contact);
        $_add = 'c.contactsubscriptionid IN (' . implode(',', $contact) . ') AND ';
        $sql = "SELECT g.age as country , count(g.crmid) as value from
(SELECT FLOOR((DATE_FORMAT(FROM_DAYS(TO_DAYS(now()) - TO_DAYS(c.birthday)), '%Y') + 0)/5) as  age, c.contactsubscriptionid as crmid 
from vtiger_contactsubdetails as c WHERE $_add c.birthday IS NOT NULL) as g
group by g.age";
        $result = $db->pquery($sql, array());
        $numRows = $db->num_rows($result);
        $country = array();
        for ($i = 0; $i < $numRows; $i++) {
            $country[$db->query_result($result, $i, 'country')] = $db->query_result($result, $i, 'value');
        }
        arsort($country);
        $row = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row[($key * 5) . "-" . ($key * 5 + 5)]['value'] = $value;
                $row[($key * 5) . "-" . ($key * 5 + 5)]['procent'] = $procent;
                $none -= $procent;
                $i++;
            } else if ($key != 'none') {
                $row['Прочие']['value'] += $value;
                $i++;
            }
        }
        $row['Прочие']['procent'] = $none;
        $table['getTableAge'] = $row;
        $row_graf = array();
        $row_round = array();
        $i = 0;
        $none = 100;
        foreach ($country as $key => $value) {
            $procent = round(($value / $sum) * 100, 2, PHP_ROUND_HALF_UP);

            if ($i < 10 && $key != 'none') {
                $row_graf[($key * 5) . "-" . ($key * 5 + 5)]['Всего'] = $value;
                $row_round[($key * 5) . "-" . ($key * 5 + 5)] = $procent;
                $none -= $procent;
                $i++;
            } else {
                $row_graf['Прочие']['Всего'] += $value;
                $i++;
            }

        }
        $row_round['Прочие'] = $none;
        $color = array();

        $graf = new grafConstructorBar($row_graf, array('Всего' => 'Всего'), 'statAgeGraf', $color, "Возраст клиентов", 'Количество');
        //echo '<pre>';print_r($graf->Script(false,false));echo '</pre>';die();
        array_push($scripts, $graf->Script(false, false));
        $color = array("#FFAF00", "#2A0CD0", "#8A0CCF", "#FF0F00",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#FF6600",
            "#04D215",
            "#0D52D1",

            "#FCD202",
            "#8A0CCF",
            "#F8FF01",);
        $graf = new grafConstructorPie($row_round, 'statAgePie', $color);
        array_push($scripts, $graf->Script(false, false));
        $viewer->assign('ADDSCRIPTS', $scripts);
        $viewer->assign('GRAFDIV', array('statCounrtryGraf', 'getTableCountry', 'statCounrtryPie',
            'statResortsGraf', 'getTableResorts', 'statResortsPie',
            'statLongGraf', 'getTableLong', 'statLongPie',
            'statTOGraf', 'getTableTO', 'statTOPie',
            'statHotelGraf', 'getTableHotel', 'statHotelPie',
            'statAgeGraf', 'getTableAge', 'statAgePie'));
        $viewer->assign('DIVSTILE', array('statCounrtryGraf' => array('class' => 'span12', 'height' => '400px'),
            'statCounrtryPie' => array('class' => 'span6', 'height' => '400px'),
            'statResortsGraf' => array('class' => 'span12', 'height' => '400px'),
            'statResortsPie' => array('class' => 'span6', 'height' => '400px'),
            'statLongGraf' => array('class' => 'span12', 'height' => '400px'),
            'statLongPie' => array('class' => 'span6', 'height' => '400px'),
            'statTOGraf' => array('class' => 'span12', 'height' => '400px'),
            'statTOPie' => array('class' => 'span6', 'height' => '400px'),
            'statHotelGraf' => array('class' => 'span12', 'height' => '400px'),
            'statHotelPie' => array('class' => 'span6', 'height' => '400px'),
            'statAgeGraf' => array('class' => 'span12', 'height' => '400px'),
            'statAgePie' => array('class' => 'span6', 'height' => '400px'),
            'getTableCountry' => array('class' => 'span6', 'height' => 'auto', 'title' => array('Страна', 'Количество', 'Доля в %'), 'colspan' => '3', 'dataField' => array('value', 'procent')),
            'getTableResorts' => array('class' => 'span6', 'height' => 'auto', 'title' => array('Курорт', 'Количество', 'Доля в %'), 'colspan' => '3', 'dataField' => array('value', 'procent')),
            'getTableLong' => array('class' => 'span6', 'height' => 'auto', 'title' => array('Длительность', 'Количество', 'Доля в %'), 'colspan' => '3', 'dataField' => array('value', 'procent')),
            'getTableTO' => array('class' => 'span6', 'height' => 'auto', 'title' => array('Ткроператор', 'Количество', 'Доля в %'), 'colspan' => '3', 'dataField' => array('value', 'procent')),
            'getTableHotel' => array('class' => 'span6', 'height' => 'auto', 'title' => array('Категория отеля', 'Количество', 'Доля в %'), 'colspan' => '3', 'dataField' => array('value', 'procent')),
            'getTableAge' => array('class' => 'span6', 'height' => 'auto', 'title' => array('Возраст', 'Количество', 'Доля в %'), 'colspan' => '3', 'dataField' => array('value', 'procent')),
        ));

        $viewer->assign('TABLE', $table);


    }
}

class grafConstructorLine
{
    public $data;
    public $date;
    public $colum;
    public $id;
    public $outScript;
    public $graphs = array();
    public $dataProvider = array();
    public $arraylabel = array();
    public $arraySales = array();

    function __construct($data, $list, $id, $color, $title, $valueTitle, $date = true, $arrayLabel, $arraySales)
    {
        $this->data = $data;
        $this->colum = $list;
        $this->id = $id;
        $this->color = $color;
        $this->title = $title;
        $this->valueTitle = $valueTitle;
        $this->date = $date;
        $this->arrayLabel = $arrayLabel;
        $this->arraySales = $arraySales;

    }

    function Script($stackType = false, $legend = true)
    {
        $this->getGraphs();
        $this->getScript($stackType, $legend);

        return $this->outScript;
    }

    function ScriptSales($stackType = false, $legend = false)
    {
        $this->getGraphsSales();
        $this->getScriptSales($stackType, $legend);

        return $this->outScript;
    }

    function getGraphs()
    {
        $i = 0;

        foreach ($this->colum as $label => $val) {
            $i++;

            $this->graphs[] = '"balloonText": "' . $label . "" . ' - [[value]]",'

                . '"id": "' . $this->id . '-' . $i . '",'
                . '"title": "' . $label . '",'
                . '"bullet": "none",'
                . '"valueField": "' . $label . '"';
        }

        $i = 0;
        foreach ($this->data as $label => $val) {
            $this->dataProvider[$i] = '"category": "' . $label . '",';
            foreach ($val as $fieldLabel => $value) {
                $this->dataProvider[$i] .= '"' . $fieldLabel . '":' . $value . ',';

            }
            $i++;
        }

    }


    function getGraphsSales()
    {
        $i = 0;

        foreach ($this->colum as $label => $val) {

            $i++;

            $this->graphs[$label] = '"balloonText": "' . $label . "" . ' - [[value]]",'

                . '"id": "' . $this->id . '-' . $i . '",'
                . '"title": "' . $label . '",'
                . '"bullet": "none",'
                . '"valueField": "' . $label . '",'
                . '"balloonFunction": function(graphDataItem, graph){ var value = graphDataItem.values.value;';

            foreach ($this->arraySales as $key => $value) {
                $this->graphs[$label] .= 'if (graphDataItem.category =="' . $key . '"){';
                foreach ($value as $keyN => $item) {
                    $this->graphs[$label] .= 'if(graphDataItem.graph.title == "План продаж" ){return "' . $label . ' - "+ String(value).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 "); } else if (graphDataItem.graph.title =="' . $keyN . '"){return "' . $label . ' - " + String(value).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ") + " / ' . $item . '";} ';
                }
                $this->graphs[$label] .= '}';
            }
            $this->graphs[$label] .= '},';
        }

        //if(value < 500){return value + "<br>(Little)";}else{return value + "<br>(A Lot)";}},';

        $i = 0;
        foreach ($this->data as $label => $val) {
            $this->dataProvider[$i] = '"category": "' . $label . '",';
            foreach ($val as $fieldLabel => $value) {
                $this->dataProvider[$i] .= '"' . $fieldLabel . '":' . $value . ',';

            }
            $i++;
        }

    }

    function getScript($stackType = false, $legend = true)
    {

        $this->outScript = 'jQuery(document).ready(function(){AmCharts.makeChart("' . $this->id . '",{'
            . '"type": "serial",'
            . '"categoryField": "category",'
            . '"autoMarginOffset": 40,'
            . '"marginRight": 20,'
            . '"marginTop": 20,'
            . '"categoryAxis": {
                    "autoRotateAngle": 45,
		"autoRotateCount": 6,
		"gridPosition": "start"
	},'
            . '"startDuration": 1,'
            . '"startEffect": "easeInSine",'
            . '"fontSize": 13,'
            . '"theme": "default","chartCursor": {
						"enabled": true
					},';
        if ($legend) {
            $this->outScript .= '"legend":{"position":"right","borderAlpha":0.3,"horizontalGap":10},';
        }
        $this->outScript .= '"guides": [],
					
					"allLabels": [],
					"balloon": {},'
            . '"valueAxes": [
						{
                                                "id": "ValueAxis-' . $this->id . '",
							"title": "' . $this->valueTitle . '",';
        if ($stackType) {
            $this->outScript .= '"stackType": "' . $stackType . '",';
        }


        $this->outScript .= '					}
					],'
            . '"allLabels": [],'
            . '"balloon": {},'
            . '"titles": [
		{
			"id": "title-' . $this->id . '",
			"text": "' . $this->title . '"
		}
	],'
            . '"dataProvider": [';
        foreach ($this->dataProvider as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        $this->outScript .= '],'
            . '"graphs": [';
        foreach ($this->graphs as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        if (!empty($this->color)) {

            $this->outScript .= '],"colors": [';
            foreach ($this->color as $string) {
                $this->outScript .= '"' . $string . '",';
            }
        }

        $this->outScript .= ']}';
        $this->outScript .= ')});';

    }


    function getScriptSales($stackType = false, $legend = true)
    {

        $this->outScript = 'jQuery(document).ready(function(){AmCharts.makeChart("' . $this->id . '",{'


            . '"type": "serial",'
            . '"categoryField": "category",'
            . '"valueField"  : "column-1",'
            . '"autoMarginOffset": 40,'
            . '"marginRight": 20,'
            . '"marginTop": 20,'
            . '"categoryAxis": {
                    "autoRotateAngle": 45,
                    "autoRotateCount": 6,
                    "gridPosition": "start"
	           },'
            . '"balloon": { "cornerRadius": 10, "maxWidth": 1000, "verticalPadding": 2  },'
            . '"startDuration": 0.1,'
            . '"startEffect": "easeInSine",'
            . '"fontSize": 13,'
            . '"theme": "default","chartCursor": {
						"enabled": true
					},';
        if ($legend) {
            $this->outScript .= '"legend":{"position":"right","borderAlpha":0.3,"horizontalGap":10},';
        }
        $this->outScript .= '"guides": [ ';


        if ($this->arrayLabel) {
            $i = 0;
            foreach ($this->arrayLabel as $key => $value) {
                $i++;
                if (!$value) {
                    continue;
                }
                $this->outScript .= '{
     
      "value":' . $value . ' ,
       "lineAlpha":1,
      	"label":"' . $i . '-й этап - ' . number_format($value, 0, ".", ",") . '",
      	"inside" : true
      	
     
    },';
            }


        }


        $this->outScript .= '],
					
					"allLabels": [],'
            . '"valueAxes": [{
                                                "id": "ValueAxis-' . $this->id . '",
                                                "includeGuidesInMinMax" : true,
							"title": "' . $this->valueTitle . '",';
        if ($stackType) {
            $this->outScript .= '"stackType": "' . $stackType . '",';
        }


        $this->outScript .= '					}, {
  
  }
					],'

            . '"titles": [
		{
			"id": "title-' . $this->id . '",
			"text": "' . $this->title . '"
		}
	],'


            . '"dataProvider": [';
        foreach ($this->dataProvider as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        $this->outScript .= '],'
            . '"graphs": [';
        foreach ($this->graphs as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        if (!empty($this->color)) {

            $this->outScript .= '],"colors": [';
            foreach ($this->color as $string) {
                $this->outScript .= '"' . $string . '",';
            }
        }

        $this->outScript .= ']}';
        $this->outScript .= ')});';

    }


}

class grafConstructorRadar
{
    public $data;
    public $date;
    public $colum;
    public $id;
    public $outScript;
    public $graphs = array();
    public $dataProvider = array();

    function __construct($data, $list, $id, $color, $title, $valueTitle, $date = true)
    {
        $this->data = $data;
        $this->colum = $list;
        $this->id = $id;
        $this->color = $color;
        $this->title = $title;
        $this->valueTitle = $valueTitle;
        $this->date = $date;


    }

    function Script($stackType = false, $legend = true)
    {
        $this->getGraphs();
        $this->getScript($stackType, $legend);

        return $this->outScript;
    }

    function getGraphs()
    {


        $this->graphs[] = '"balloonText": "[[category]]",'

            . '"id": "' . $this->id . '-' . $i . '",'
            . '"title": "' . $label . '",'
            . '"bullet": "round","fillAlphas": 0.3,'
            . '"valueField": "office"';

        $i = 0;
        foreach ($this->data as $label => $val) {
            $this->dataProvider[$i] = '"category": "' . $label . ' - ' . $val . '",';

            $this->dataProvider[$i] .= '"office":' . $val . ',';

            $i++;
        }
    }

    function getScript($stackType = false, $legend = true)
    {

        $this->outScript = 'jQuery(document).ready(function(){AmCharts.makeChart("' . $this->id . '",{'
            . '"type": "radar",'
            . '"categoryField": "category",'
            . '"autoMarginOffset": 40,'
            . '"marginRight": 70,'
            . '"marginTop": 0,'
            . '"startDuration": 2,'
            . '"startEffect": "easeInSine",'
            . '"fontSize": 13,'
            . '"theme": "default",';

        $this->outScript .= '"guides": [],
					
					"allLabels": [],
					"balloon": {},'
            . '"valueAxes": [
						{
                                                "labelsEnabled": false,
                                                "minimum": 0,
							"axisAlpha": 0.15,
							"dashLength": 3,
                                                "axisTitleOffset": 20,';
        if ($stackType) {
            $this->outScript .= '"stackType": "' . $stackType . '",';
        }

        $this->outScript .= '					}
					],'
            . '"allLabels": [],'
            . '"balloon": {},'
            . '"titles": [
		{
			"id": "title-' . $this->id . '",
			"text": "' . $this->title . '"
		}
	],'
            . '"dataProvider": [';
        foreach ($this->dataProvider as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        $this->outScript .= '],'
            . '"graphs": [';
        foreach ($this->graphs as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        if (!empty($this->color)) {

            $this->outScript .= '],"colors": [';
            foreach ($this->color as $string) {
                $this->outScript .= '"' . $string . '",';
            }
        }

        $this->outScript .= ']}';
        $this->outScript .= ')});';

    }
}

class grafConstructorBarAndLine
{
    public $data;
    public $date;
    public $colum;
    public $id;
    public $outScript;
    public $graphs = array();
    public $dataProvider = array();

    function __construct($data, $list, $id, $color, $title, $valueTitle, $date = true)
    {
        $this->data = $data;
        $this->colum = $list;
        $this->id = $id;
        $this->color = $color;
        $this->title = $title;
        $this->valueTitle = $valueTitle;
        $this->date = $date;


    }

    function Script($stackType = false, $legend = true)
    {
        $this->getGraphs();
        $this->getScript($stackType, $legend);

        return $this->outScript;
    }

    function getGraphs()
    {
        $i = 0;
        foreach ($this->colum as $label => $val) {
            $i++;
            if ($i == 2) {
                $this->graphs[] = '"balloonText": "[[title]] - [[value]]",'
                    . '"fillAlphas": 0.51,'
                    . '"lineAlpha": 0.44,'
                    . '"id": "' . $this->id . '-' . $i . '",'
                    . '"title": "' . $label . '",'
                    . '"type": "column",'
                    . '"labelRotation": 45,'
                    . '"valueField": "' . $label . '"';
            } else {
                $this->graphs[] = '"balloonText": "[[title]] - [[value]]",'
                    //   . '"bullet": "square",
                    //					"bulletBorderAlpha": 1,
                    //					"bulletBorderThickness": 1,
                    //					"bulletSize": 8,'
                    . '"lineThickness": 5,
			"noStepRisers":true,
			
			"type": "step",'

                    . '"id": "' . $this->id . '-' . $i . '",'
                    . '"title": "' . $label . '",'


                    . '"valueField": "' . $label . '"';
            }
        }
        $i = 0;
        foreach ($this->data as $label => $val) {
            $this->dataProvider[$i] = '"date": "' . $label . '",';
            foreach ($val as $fieldLabel => $value) {
                $this->dataProvider[$i] .= '"' . $fieldLabel . '":' . $value . ',';
            }
            $i++;
        }
    }

    function getScript($stackType = false, $legend = true)
    {

        $this->outScript = 'jQuery(document).ready(function(){AmCharts.makeChart("' . $this->id . '",{'
            . '"type": "serial",'
            . '"categoryField": "date",';
        if ($this->date) {
            $this->outScript .= '"dataDateFormat": "YYYY-MM-DD","parseDates": true,';
        }
        $this->outScript .= '"autoMarginOffset": 40,'
            . '"marginRight": 70,'
            . '"marginTop": 70,'
            . '"startDuration": 0.2,"startEffect": "easeInSine",'
            . '"fontSize": 13,'
            . '"theme": "default",';
        if ($legend) {
            $this->outScript .= '"legend":{"position":"right","borderAlpha":0.3,"horizontalGap":10},';
        }
        $this->outScript .= '"categoryAxis": {
                    "autoRotateAngle": 45,
		"autoRotateCount": 6,
		"gridPosition": "start",
	},'
            . '"trendLines": [],"chartCursor": {
						"enabled": true
					},'
            . '"guides": [],'
            . '"valueAxes": [
						{
							"id": "ValueAxis-' . $this->id . '",
							"title": "' . $this->valueTitle . '",';
        if ($stackType) {
            $this->outScript .= '"stackType": "' . $stackType . '",';
        }

        $this->outScript .= '					}
					],'
            . '"allLabels": [],'
            . '"balloon": {},'
            . '"titles": [
		{
			"id": "title-' . $this->id . '",
			"text": "' . $this->title . '"
		}
	],'
            . '"dataProvider": [';
        foreach ($this->dataProvider as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        $this->outScript .= '],'
            . '"graphs": [';
        foreach ($this->graphs as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        if (!empty($this->color)) {

            $this->outScript .= '],"colors": [';
            foreach ($this->color as $string) {
                $this->outScript .= '"' . $string . '",';
            }
        }

        $this->outScript .= ']}';
        $this->outScript .= ')});';

    }
}

class grafConstructorPie
{
    public $data;
    public $colum;
    public $id;
    public $outScript;
    public $graphs = array();
    public $dataProvider = array();

    function __construct($data, $id, $color, $title = false, $baloon = false)
    {
        $this->data = $data;
        $this->title = $title;
        $this->id = $id;
        $this->color = $color;
        $this->baloon = $baloon;


    }

    function Script($stackType = false, $legend = true)
    {
        $this->getGraphs();
        $this->getScript($stackType, $legend);

        return $this->outScript;
    }

    function getGraphs()
    {
        $i = 0;

        foreach ($this->data as $label => $val) {
            $this->dataProvider[$i] = '"category": "' . $label . '",';
            $this->dataProvider[$i] .= '"column-1": "' . $val . '",';

            $i++;
        }
    }

    function getScript($stackType = false, $legend = true)
    {

        $this->outScript = 'jQuery(document).ready(function(){AmCharts.makeChart("' . $this->id . '",{'
            . '"type": "pie",';
        if ($this->baloon) {
            $this->outScript .= '"balloonText": "' . $this->baloon . '","labelText": "' . $this->baloon . '",';
        } else {
            $this->outScript .= '"balloonText": "[[title]]<br>[[value]]%</span>","labelText": "[[title]] - [[value]]",';
        }
        $this->outScript .= '"titleField": "category",'
            . '"valueField": "column-1",'
            . '"allLabels": [],'
            . '"balloon": {},'
            . '"titles": [';
        if ($this->title) {
            $this->outScript .= '{
			"id": "title-' . $this->id . '",
			"text": "' . $this->title . '"
		}';
        }
        $this->outScript .= '],';

        if ($legend) {
            $this->outScript .= '"legend":{"position":"right","borderAlpha":0.3,"horizontalGap":10},';
        }

        $this->outScript .= '"dataProvider": [';
        foreach ($this->dataProvider as $string) {
            $this->outScript .= '{' . $string . '},';
        }


        if (!empty($this->color)) {

            $this->outScript .= '],"colors": [';
            foreach ($this->color as $string) {
                $this->outScript .= '"' . $string . '",';
            }
        }

        $this->outScript .= ']}';
        $this->outScript .= ')});';

    }

}

class grafConstructorBar
{
    public $data;
    public $colum;
    public $id;
    public $outScript;
    public $graphs = array();
    public $dataProvider = array();

    function __construct($data, $list, $id, $color, $title, $valueTitle)
    {
        $this->data = $data;
        $this->colum = $list;
        $this->id = $id;
        $this->color = $color;
        $this->title = $title;
        $this->valueTitle = $valueTitle;


    }

    function Script($stackType = false, $legend = true)
    {
        $this->getGraphs();
        $this->getScript($stackType, $legend);

        return $this->outScript;
    }

    function getGraphs()
    {
        $i = 0;
        foreach ($this->colum as $label => $val) {
            $i++;
            $this->graphs[] = '"balloonText": "[[title]] [[category]] - [[value]]",'
                . '"fillAlphas": 0.9,'
                . '"id": "' . $this->id . '-' . $i . '",'
                . '"title": "' . $label . '",'
                . '"type": "column",'
                . '"labelRotation": 45,'
                . '"valueField": "' . $label . '"';

        }
        $i = 0;
        foreach ($this->data as $label => $val) {
            $this->dataProvider[$i] = '"category": "' . $label . '",';
            foreach ($val as $fieldLabel => $value) {
                $this->dataProvider[$i] .= '"' . $fieldLabel . '":' . $value . ',';
            }
            $i++;
        }
    }

    function getScript($stackType = false, $legend = true)
    {

        $this->outScript = 'jQuery(document).ready(function(){AmCharts.makeChart("' . $this->id . '",{'
            . '"type": "serial",'
            . '"categoryField": "category",'
            . '"autoMarginOffset": 40,'
            . '"marginRight": 70,'
            . '"marginTop": 70,'
            . '"startDuration": 0.2,"startEffect": "easeInSine",'
            . '"fontSize": 13,'
            . '"theme": "default",';
        if ($legend) {
            $this->outScript .= '"legend":{"position":"right","borderAlpha":0.3,"horizontalGap":10},';
        }
        $this->outScript .= '"categoryAxis": {
                    "autoRotateAngle": 45,
		"autoRotateCount": 6,
		"gridPosition": "start"
	},'
            . '"trendLines": [],'
            . '"guides": [],'
            . '"valueAxes": [
						{
							"id": "ValueAxis-' . $this->id . '",
							"title": "' . $this->valueTitle . '",';
        if ($stackType) {
            $this->outScript .= '"stackType": "' . $stackType . '",';
        }

        $this->outScript .= '					}
					],'
            . '"allLabels": [],'
            . '"balloon": {},
            "chartCursor": {
						"enabled": true
					},'
            . '"titles": [
		{
			"id": "title-' . $this->id . '",
			"text": "' . $this->title . '"
		}
	],'
            . '"dataProvider": [';
        foreach ($this->dataProvider as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        $this->outScript .= '],'
            . '"graphs": [';
        foreach ($this->graphs as $string) {
            $this->outScript .= '{' . $string . '},';
        }
        if (!empty($this->color)) {

            $this->outScript .= '],"colors": [';
            foreach ($this->color as $string) {
                $this->outScript .= '"' . $string . '",';
            }
        }

        $this->outScript .= ']}';
        $this->outScript .= ')});';

    }
}


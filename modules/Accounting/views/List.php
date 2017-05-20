<?php

class Accounting_List_View extends Vtiger_Index_View
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


    function addQueryFilter()
    {
        $sql = "";
        if (!empty($this->filter_data['region']) || !empty($this->filter_data['office']) || !empty($this->filter_data['user'])) {
                $sql .= "AND u.id IN";
                if (!empty($this->filter_data['user'])) {
                    $sql .= " (" . $this->filter_data['user'] . ")";
                } else if (!empty($this->filter_data['office'])) {

                        $this->office_data = $this->filter_data['office'];
                        // echo '<pre>';print_r($this->office_data);echo '</pre>';die();
                        $users = $this->getUsersOffice();
                        $sql .= " (" . implode(',', $users) . ")";
                } else if (!empty($this->filter_data['region'])) {
                    $this->office_data = $this->office_to_region[$this->filter_data['region']];
                    $users = $this->getUsersOffice();
                    $sql .= " (" . implode(',', $users) . ")";
                }


        }
        return $sql;
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

    function getHeaderScripts(Vtiger_Request $request)
    {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $jsFileNames = array();
        $mode = $request->get('mode');
        if (!empty($mode)) {
            $function = 'addScript_' . $mode;
            $jsFileNames = $this->$function($jsFileNames);
        }
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);

        return $headerScriptInstances;
    }

    function addScript_workingHours($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.webix.webix");
        array_push($jsFileNames, "modules.Accounting.script.working_hours");
        return $jsFileNames;
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

    public function workingHoursEdit(Vtiger_Request $request, Vtiger_Viewer $viewer){


        $day = $request->get("day");
        $month = $request->get("month");
        $year = $request->get("year");
        $user = $request->get("user");
        $time = $request->get("time");


        $sql = ("SELECT id FROM working_time WHERE user = '$user' AND date = '$year-$month-$day'");

        $record = $this->getSQLArrayResult($sql, []);

        if (count($record)){
            $id = $record[0]["id"];
            if ($time) {
                $sql = "UPDATE working_time SET date = '$year-$month-$day', user = '$user', time = '$time'  WHERE id = '$id'";
            } else {
                $sql = "DELETE FROM working_time WHERE id = '$id'";
            }
        } else {
            if ($time) {
                $sql = "INSERT INTO working_time (user, date, time) VALUES('$user', '$year-$month-$day', '$time')";
            }
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        echo json_encode('success');
        die();
    }

    public function removeFirstZero($str){
        if ($str[0] =='0'){
            return substr($str, 1, strlen($str));
        } else return $str;
    }

    public function workingHours(Vtiger_Request $request, Vtiger_Viewer $viewer){



        $addQuery = $this->addQueryFilter();


        $date = DateTime::createFromFormat('d.m.Y', "1" . $this->filter_data['region']);
//$date=new DateTime();
        //считаем количество дней в месяце
        $time = gmmktime($date->format("0, 0, 0, m, d, Y"));
        $countDays = gmdate("t", $time);

        //для выборки с начала и до конца месяца
        $dateStringStart = $date->format("Y-m-01 00:00:00");
        $dateStringFinish = $date->format("Y-m-$countDays 23:59:59");

        //шапка таблицы
        $headerTableArray = [];
        $headerTableArray[] = [
            "id" => "name",
            "header" => "Сотрудник",
            "width" => 270
        ];
        for ($i = 1; $i<=$countDays; $i++){
            $headerTableArray[] = [
                "id" => "$i",
                "header" => "$i",
                "editor" => "text",
                "width" => 38
            ];
        }

        $headerTableArray[] = [
            "id" => "sum",
            "header" => "Итого",
            "width" => 60
        ];

        //выбираем из базы сохраненные данные по отработанному времени
        $timesQuery = "
                   SELECT *
                   FROM working_time as wt
                   WHERE CAST( wt.date AS DATE) BETWEEN '$dateStringStart' AND '$dateStringFinish'";

        $workerTimesArray = $this->getSQLArrayResult($timesQuery, []);
        //группируем данные по пользователям и приводим к удобному массиву
        $usersTimesArray = [];

        foreach ($workerTimesArray as $workerTime){

            if (!$usersTimesArray[$workerTime["user"]]) $usersTimesArray[$workerTime["user"]] = [];

            $dateRecord = new DateTime($workerTime["date"]);
            $usersTimesArray[$workerTime["user"]][$this->removeFirstZero($dateRecord->format("d"))] = $workerTime["time"];
        }


        //выбираем пользователей
        $usersQuery = "SELECT u.id, concat(u.first_name,' ',u.last_name) as name from vtiger_users as u WHERE 1=1 ".$addQuery;

        $users = $this->getSQLArrayResult($usersQuery, []);

        $bodyTableArray = [];

        //формируем строки таблицы
        foreach ($users as $user){
            $ar = [
                "id" =>$user["id"],
                "name" =>$user["name"]
            ];

            //запихиваем в строку данные, которые получили из таблицы рабочее время
            if (array_key_exists($user["id"], $usersTimesArray)){
                foreach ($usersTimesArray[$user["id"]] as $key => $value)
                $ar[$key] = $value;
            }

            $bodyTableArray[] = $ar;
        }


        $viewer->assign('WORKINGHOURS', true);
        $viewer->assign('WORKINGHOURSDATA', json_encode([
            "headerTable" => $headerTableArray,
            "bodyTable" => $bodyTableArray,
            "year" =>$date->format('Y'),
            "month" =>$date->format('m')
        ]));

        $viewer->assign('WORKING', 1);
        return true;
    }




}

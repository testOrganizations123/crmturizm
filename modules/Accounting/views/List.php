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
        return false;
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
        $now = date('m.Y');

        $this->filter_data['period'] = $now;

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
        if ($this->mode == 'holidays') {
            $period = array(
                "label" => "Период",
                "tpl" => 'uitypes/YearFieldSearchView.tpl',
                "name" => 'period',
                "data" => $this->filter_data['period']
            );

            return array($period);
        }

        if ($this->mode == 'vacationSchedule') {
            $period = array(
                "label" => "Период",
                "tpl" => 'uitypes/YearFieldSearchView.tpl',
                "name" => 'period',
                "data" => $this->filter_data['period']
            );

        }
        return array($region, $office, $staf, $period);
    }


    function addQueryFilter()
    {
        $sql = "";
        if (!empty($this->filter_data['region']) || !empty($this->filter_data['office']) || !empty($this->filter_data['user'])) {
            $sql .= "AND u.id IN";
            if (!empty($this->filter_data['user'])) {
                $office = $this->getOfficeUser()[0]['officeid'];

                if (!$office) {
                    $sql = "AND u.office = '' ";
                } else {
                    $sql = "AND u.office IN (" . $office . ")";
                }
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

    function getOfficeUser()
    {
        $sql = "SELECT o.officeid from vtiger_users as u LEFT JOIN vtiger_office as o ON o.officeid = u.office WHERE  u.id=" . $this->filter_data['user'];

        $raw = $this->getSQLArrayResult($sql, array());
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

    public function workingHoursEdit(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {

        $day = $request->get("day");
        $month = $request->get("month");
        $year = $request->get("year");
        $user = $request->get("user");
        $time = $request->get("time");


        $sql = ("SELECT id FROM working_time WHERE user = '$user' AND date = '$year-$month-$day'");

        $record = $this->getSQLArrayResult($sql, []);

        if (count($record)) {
            $id = $record[0]["id"];
            if ($time || $time == 0) {
                $sql = "UPDATE working_time SET date = '$year-$month-$day', user = '$user', time = '$time'  WHERE id = '$id'";
            } else {
                $sql = "DELETE FROM working_time WHERE id = '$id'";
            }
        } else {
            if ($time || $time == 0) {
                $sql = "INSERT INTO working_time (user, date, time) VALUES('$user', '$year-$month-$day', '$time')";
            }
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        echo json_encode('success');
        die();
    }

    public function removeFirstZero($str)
    {
        if ($str[0] == '0') {
            return substr($str, 1, strlen($str));
        } else return $str;
    }

    public function workingHours(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {


        $addQuery = $this->addQueryFilter();


        $date = DateTime::createFromFormat('m.Y', $this->filter_data['period']);

        //считаем количество дней в месяце

        $countDays = cal_days_in_month(CAL_GREGORIAN, $date->format('m'), $date->format('Y'));


        //для выборки с начала и до конца месяца
        $dateStringStart = $date->format("Y-m-01 00:00:00");
        $dateStringFinish = $date->format("Y-m-$countDays 23:59:59");

        //шапка таблицы
        $headerTableArray = [];
        $headerTableArray[] = [
            "id" => "name",
            "header" => "Сотрудник",
            "width" => 240
        ];
        for ($i = 1; $i <= $countDays; $i++) {
            $dayCode = date('w', strtotime($i . "." . $date->format('m.Y')));
            $css = "";
            switch ($dayCode) {
                case 1:
                    $day = "Пн";
                    break;
                case 2:
                    $day = "Вт";
                    break;
                case 3:
                    $day = "Ср";
                    break;
                case 4:
                    $day = "Чт";
                    break;
                case 5:
                    $day = "Пт";
                    break;
                case 6:
                    $day = "Сб";
                    $css = ['background' => "#d2e3ef"];
                    break;
                case 0:
                    $day = "Вс";
                    $css = ['background' => "#d2e3ef"];
                    break;
            }
            $headerTableArray[] = [
                "id" => "$i",
                "header" => [$day, "$i"],
                "editor" => "text",
                "width" => 39,
                "css" => $css
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

        foreach ($workerTimesArray as $workerTime) {

            if (!$usersTimesArray[$workerTime["user"]]) $usersTimesArray[$workerTime["user"]] = [];

            $dateRecord = new DateTime($workerTime["date"]);
            $usersTimesArray[$workerTime["user"]][$this->removeFirstZero($dateRecord->format("d"))] = $workerTime["time"];
        }


        //выбираем пользователей
        $usersQuery = "SELECT o.office, o.officeid, u.id, concat(u.first_name,' ',u.last_name) as name from vtiger_users as u LEFT JOIN vtiger_office as o ON o.officeid = u.office WHERE 1=1 " . $addQuery;

        $users = $this->getSQLArrayResult($usersQuery, []);

        $bodyTableArray = [];

        $arrOfficeIds = [];
        $arrId = [];
        foreach ($users as $key => $value) {
            if (!in_array($value['officeid'], $arrId)) {
                if ($value['office'] == null) {
                    $value['office'] = 'Без офиса';
                    $keyNull = $key;
                }
                $arrId[] = $value['officeid'];
                $arrOfficeIds[$key]['id'] = $value['officeid'];
                $arrOfficeIds[$key]['office'] = $value['office'];

            }
        }


        if (isset($keyNull)) {
            $item = $arrOfficeIds[$keyNull];
            unset($arrOfficeIds[$keyNull]);
            array_push($arrOfficeIds, $item);
        }
        $arrOfficeIds = array_values($arrOfficeIds);
        //формируем строки таблицы


        $tableOffice = [];
        foreach ($arrOfficeIds as $keyO => $item) {
            $tableOffice[$keyO]['nameOffice'] = $item['office'];
            $bodyTableArray = [];

            foreach ($users as $user) {
                $ar = [];
                if ($item['id'] == $user['officeid']) {

                    $ar = [
                        "id" => $user["id"],
                        "name" => $user["name"]
                    ];

                    // запихиваем в строку данные, которые получили из таблицы рабочее время
                    $key = null;
                    if (array_key_exists($user["id"], $usersTimesArray)) {
                        foreach ($usersTimesArray[$user["id"]] as $key => $value) {
                            $ar[$key] = $value;
                        }
                    }
                    $bodyTableArray[] = $ar;
                }

            }
            $tableOffice[$keyO]['headerTable'] = $headerTableArray;
            $tableOffice[$keyO]['bodyTable'] = $bodyTableArray;

        }

        $viewer->assign('DATAHEADER', json_encode([
            "year" => $date->format('Y'),
            "month" => $date->format('m'),
            "headerTable" => $headerTableArray,
        ]));
        $viewer->assign('WORKINGHOURS', true);
        $viewer->assign('WORKINGHOURSDATA', json_encode($tableOffice));
        $viewer->assign('MONTHPERIOD', $this->filter_data['period']);
        $viewer->assign('WORKING', 1);

        //узнаем, пользователь обычный менеджер(может стажер) или управляющий
        $db = PearDatabase::getInstance();
        $userModel = Users_Record_Model::getCurrentUserModel();
        $userRole = $userModel->getRole();
        $sqlRole = "SELECT depth FROM vtiger_role WHERE roleid = '$userRole'";
        $result = $db->pquery($sqlRole, array());
        $depth = $db->query_result_rowdata($result, "depth");
        if ($depth["depth"] > 4) {
            $viewer->assign('WRITINGACCESS', json_encode(false));
        } else {
            $viewer->assign('WRITINGACCESS', json_encode(true));
        }


        return true;
    }

    public function holidays(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        //TODO: костылек изза костыльного отображения даты в фильтре
        if (mb_strlen($this->filter_data['period']) == 7) {
            $date = explode(".", $this->filter_data['period']);
            $d = $date[1];
        } else {
            $d = $this->filter_data['period'];
        }

        $holidayQuery = "SELECT * FROM holidays where date BETWEEN '$d-01-01' AND '$d-12-31'  ORDER BY date";

        $holidays = $this->getSQLArrayResult($holidayQuery, "");
        $holidaysArr = [];
        foreach ($holidays as $key => $item) {
            $holidaysArr[$key]['id'] = $item['id'];
            $holidaysArr[$key]['holiday'] = $item['name'];
            $date = new DateTime($item['date']);
            $holidaysArr[$key]['date'] = $date->format("d.m.Y");

        }

        //узнаем, пользователь обычный менеджер(может стажер) или управляющий
        $db = PearDatabase::getInstance();
        $userModel = Users_Record_Model::getCurrentUserModel();
        $userRole = $userModel->getRole();
        $sqlRole = "SELECT depth FROM vtiger_role WHERE roleid = '$userRole'";
        $result = $db->pquery($sqlRole, array());
        $depth = $db->query_result_rowdata($result, "depth");

        if ($depth["depth"] > 4) {
            $viewer->assign('WRITINGACCESS', json_encode(false));
        } else {
            $viewer->assign('WRITINGACCESS', json_encode(true));
        }

        $viewer->assign('MONTHPERIOD', $this->filter_data['period']);
        $viewer->assign('HOLIDAYS', json_encode($holidaysArr));
        return true;
    }

    public function addHoliday(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        $date = new DateTime($request->get('date'));
        $d = $date->format("Y-m-d");

        $holiday = $request->get('holiday');
        $sql = "INSERT INTO holidays (date, name) VALUES('$d', '$holiday')";
        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());
        $holidayQuery = "SELECT * FROM holidays ORDER BY date";

        $holidays = $this->getSQLArrayResult($holidayQuery, "");
        $holidaysArr = [];
        foreach ($holidays as $key => $item) {
            $holidaysArr[$key]['id'] = $item['id'];
            $holidaysArr[$key]['holiday'] = $item['name'];
            $holidaysArr[$key]['date'] = $item['date'];

        }

        echo json_encode(['status' => 'success', 'data' => $holidaysArr]);
        die();
    }

    public function deleteHoliday(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {

        $id = $request->get('id');

        $sql = "DELETE FROM holidays WHERE id = '$id'";
        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        echo json_encode(['status' => 'success']);
        die();

    }

    function addScript_holidays($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.webix.webix");
        array_push($jsFileNames, "modules.Accounting.script.holidays");
        array_push($jsFileNames, "modules.Accounting.datepicker.js.datepiker");
        return $jsFileNames;
    }

    function addScript_vacationSchedule($jsFileNames)
    {

        array_push($jsFileNames, "modules.VDCustomReports.amcharts.amcharts");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.serial");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.gantt");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.plugins.export.export");
        array_push($jsFileNames, "modules.VDCustomReports.amcharts.themes.light");

        array_push($jsFileNames, "modules.VDCustomReports.webix.webix");
        array_push($jsFileNames, "modules.Accounting.script.vacation_schedule");

        return $jsFileNames;
    }

    public function vacationSchedule(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        //TODO: костылек изза костыльного отображения даты в фильтре
        if (mb_strlen($this->filter_data['period']) == 7) {
            $date = explode(".", $this->filter_data['period']);
            $d = $date[1];
        } else {
            $d = $this->filter_data['period'];
        }

        $addQuery = $this->addQueryFilter();

        //узнаем, пользователь обычный менеджер(может стажер) или управляющий
        $db = PearDatabase::getInstance();
        $userModel = Users_Record_Model::getCurrentUserModel();
        $userRole = $userModel->getRole();
        $sqlRole = "SELECT depth FROM vtiger_role WHERE roleid = '$userRole'";
        $result = $db->pquery($sqlRole, array());

        $depth = $db->query_result_rowdata($result, "depth");
        if ($depth["depth"] > 4) {
            $viewer->assign('WRITINGACCESS', 'false');
            $style = [
                "start1" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "duration1" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "finish1" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "start3" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "duration3" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "finish3" => ["background" => "rgba(242, 222, 255, 0.12)"],
                "allowed" => ["background" => "rgba(255, 0, 0, 0.03)"],
                "spent" => ["background" => "rgba(255, 0, 0, 0.03)"],
                "left" => ["background" => "rgba(255, 0, 0, 0.03)"],
                "worker" => ["background" => "rgba(0, 128, 0, 0.03)"],
                "holidays" => ["background" => "rgba(0, 128, 0, 0.03)"]
            ];
        } else {
            $viewer->assign('WRITINGACCESS', 'true');

            $style = [
                "start1" => ["background" => "rgba(242, 222, 255, 0.20)", "cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "duration1" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "finish1" => ["background" => "rgba(242, 222, 255, 0.20)", "cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "start3" => ["background" => "rgba(242, 222, 255, 0.20)", "cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "start2" => ["cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "finish2" => ["cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "start4" => ["cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "finish4" => ["cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "duration3" => ["background" => "rgba(242, 222, 255, 0.20)"],
                "finish3" => ["background" => "rgba(242, 222, 255, 0.12)", "cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "allowed" => ["background" => "rgba(255, 0, 0, 0.03)", "cursor" => "pointer", "border" => "1px solid #aad5fd!important"],
                "spent" => ["background" => "rgba(255, 0, 0, 0.03)"],
                "left" => ["background" => "rgba(255, 0, 0, 0.03)"],
                "worker" => ["background" => "rgba(0, 128, 0, 0.03)"],
                "holidays" => ["background" => "rgba(0, 128, 0, 0.03)"]
            ];
        }

        $vacationQuery = "
                   SELECT *
                   FROM vacation as wt
                   WHERE year = $d";

        $vacationArray = $this->getSQLArrayResult($vacationQuery, []);

        $vacationPromoQuery = "
                   SELECT *
                   FROM vacation_promotional_tour as wt
                   WHERE year = $d";

        $vacationPromoArray = $this->getSQLArrayResult($vacationPromoQuery, []);

        $vacationSessionQuery = "
                   SELECT *
                   FROM vacation_session as wt
                   WHERE year = $d";

        $vacationSessionArray = $this->getSQLArrayResult($vacationSessionQuery, []);

        $usersQuery = "SELECT o.office, o.officeid, u.id, u.title, concat(u.first_name,' ',u.last_name) as name from vtiger_users as u LEFT JOIN vtiger_office as o ON o.officeid = u.office WHERE 1=1 " . $addQuery;

        $users = $this->getSQLArrayResult($usersQuery, []);

        $offices = [];

        foreach ($users as $user) {

            $personVacation = [
                "id" => $user["id"],
                "worker" => $user["name"],
                "position" => $user["title"],
                "start1" => '',
                "duration1" => 0,
                "finish1" => '',
                "start2" => '',
                "duration2" => 0,
                "finish2" => '',
                "start3" => '',
                "duration3" => 0,
                "finish3" => '',
                "start4" => '',
                "duration4" => 0,
                "finish4" => '',
                "allowed" => 0,
                "spent" => 0,
                "left" => 0,
                "holidays" => 0,
                "\$cellCss" => $style

            ];

            foreach ($vacationArray as $vacation) {

                if ($vacation["worker"] == $user["id"]) {

                    if ($vacation["start1"]) {
                        $dateStart1Obj = new DateTime($vacation["start1"]);
                        $dateStart1 = $dateStart1Obj->format("Y / m / d");
                    } else {
                        $dateStart1 = '';
                    }
                    if ($vacation["finish1"]) {
                        $dateFinish1Obj = new DateTime($vacation["finish1"]);
                        $dateFinish1 = $dateFinish1Obj->format("Y / m / d");
                    } else {
                        $dateFinish1 = '';
                    }

                    if ($vacation["start2"]) {
                        $dateStart2Obj = new DateTime($vacation["start2"]);
                        $dateStart2 = $dateStart2Obj->format("Y / m / d");
                    } else {
                        $dateStart2 = '';
                    }
                    if ($vacation["finish2"]) {
                        $dateFinish2Obj = new DateTime($vacation["finish2"]);
                        $dateFinish2 = $dateFinish2Obj->format("Y / m / d");
                    } else {
                        $dateFinish2 = '';
                    }

                    if ($vacation["start3"]) {
                        $dateStart3Obj = new DateTime($vacation["start3"]);
                        $dateStart3 = $dateStart3Obj->format("Y / m / d");
                    } else {
                        $dateStart3 = '';
                    }
                    if ($vacation["finish3"]) {
                        $dateFinish3Obj = new DateTime($vacation["finish3"]);
                        $dateFinish3 = $dateFinish3Obj->format("Y / m / d");
                    } else {
                        $dateFinish3 = '';
                    }

                    if ($vacation["start4"]) {
                        $dateStart4Obj = new DateTime($vacation["start4"]);
                        $dateStart4 = $dateStart4Obj->format("Y / m / d");
                    } else {
                        $dateStart4 = '';
                    }
                    if ($vacation["finish4"]) {
                        $dateFinish4Obj = new DateTime($vacation["finish4"]);
                        $dateFinish4 = $dateFinish4Obj->format("Y / m / d");
                    } else {
                        $dateFinish4 = '';
                    }

                    $personVacation["start1"] = $dateStart1;
                    $personVacation["finish1"] = $dateFinish1;
                    $personVacation["start2"] = $dateStart2;
                    $personVacation["finish2"] = $dateFinish2;
                    $personVacation["start3"] = $dateStart3;
                    $personVacation["finish3"] = $dateFinish3;
                    $personVacation["start4"] = $dateStart4;
                    $personVacation["finish4"] = $dateFinish4;
                    $personVacation["allowed"] = $vacation["allowed"];
                }
            }

            $personPromo = [
                "id" => $user["id"],
                "worker" => $user["name"],
                "position" => $user["title"],
                "start1" => '',
                "duration1" => 0,
                "finish1" => '',
                "start2" => '',
                "duration2" => 0,
                "finish2" => '',
                "start3" => '',
                "duration3" => 0,
                "finish3" => '',
                "start4" => '',
                "duration4" => 0,
                "finish4" => '',
                "allowed" => 0,
                "spent" => 0,
                "left" => 0,
                "\$cellCss" => $style

            ];

            foreach ($vacationPromoArray as $vacation) {

                if ($vacation["worker"] == $user["id"]) {

                    if ($vacation["start1"]) {
                        $dateStart1Obj = new DateTime($vacation["start1"]);
                        $dateStart1 = $dateStart1Obj->format("Y / m / d");
                    } else {
                        $dateStart1 = '';
                    }
                    if ($vacation["finish1"]) {
                        $dateFinish1Obj = new DateTime($vacation["finish1"]);
                        $dateFinish1 = $dateFinish1Obj->format("Y / m / d");
                    } else {
                        $dateFinish1 = '';
                    }

                    if ($vacation["start2"]) {
                        $dateStart2Obj = new DateTime($vacation["start2"]);
                        $dateStart2 = $dateStart2Obj->format("Y / m / d");
                    } else {
                        $dateStart2 = '';
                    }
                    if ($vacation["finish2"]) {
                        $dateFinish2Obj = new DateTime($vacation["finish2"]);
                        $dateFinish2 = $dateFinish2Obj->format("Y / m / d");
                    } else {
                        $dateFinish2 = '';
                    }

                    if ($vacation["start3"]) {
                        $dateStart3Obj = new DateTime($vacation["start3"]);
                        $dateStart3 = $dateStart3Obj->format("Y / m / d");
                    } else {
                        $dateStart3 = '';
                    }
                    if ($vacation["finish3"]) {
                        $dateFinish3Obj = new DateTime($vacation["finish3"]);
                        $dateFinish3 = $dateFinish3Obj->format("Y / m / d");
                    } else {
                        $dateFinish3 = '';
                    }

                    if ($vacation["start4"]) {
                        $dateStart4Obj = new DateTime($vacation["start4"]);
                        $dateStart4 = $dateStart4Obj->format("Y / m / d");
                    } else {
                        $dateStart4 = '';
                    }
                    if ($vacation["finish4"]) {
                        $dateFinish4Obj = new DateTime($vacation["finish4"]);
                        $dateFinish4 = $dateFinish4Obj->format("Y / m / d");
                    } else {
                        $dateFinish4 = '';
                    }

                    $personPromo["start1"] = $dateStart1;
                    $personPromo["finish1"] = $dateFinish1;
                    $personPromo["start2"] = $dateStart2;
                    $personPromo["finish2"] = $dateFinish2;
                    $personPromo["start3"] = $dateStart3;
                    $personPromo["finish3"] = $dateFinish3;
                    $personPromo["start4"] = $dateStart4;
                    $personPromo["finish4"] = $dateFinish4;
                    $personPromo["allowed"] = $vacation["allowed"];
                }
            }


            $personVacationSession = [
                "id" => $user["id"],
                "worker" => $user["name"],
                "position" => $user["title"],
                "start1" => '',
                "duration1" => 0,
                "finish1" => '',
                "start2" => '',
                "duration2" => 0,
                "finish2" => '',
                "start3" => '',
                "duration3" => 0,
                "finish3" => '',
                "start4" => '',
                "duration4" => 0,
                "finish4" => '',
                "allowed" => 0,
                "spent" => 0,
                "left" => 0,
                "holidays" => 0,
                "\$cellCss" => $style

            ];

            foreach ($vacationSessionArray as $vacation) {

                if ($vacation["worker"] == $user["id"]) {

                    if ($vacation["start1"]) {
                        $dateStart1Obj = new DateTime($vacation["start1"]);
                        $dateStart1 = $dateStart1Obj->format("Y / m / d");
                    } else {
                        $dateStart1 = '';
                    }
                    if ($vacation["finish1"]) {
                        $dateFinish1Obj = new DateTime($vacation["finish1"]);
                        $dateFinish1 = $dateFinish1Obj->format("Y / m / d");
                    } else {
                        $dateFinish1 = '';
                    }

                    if ($vacation["start2"]) {
                        $dateStart2Obj = new DateTime($vacation["start2"]);
                        $dateStart2 = $dateStart2Obj->format("Y / m / d");
                    } else {
                        $dateStart2 = '';
                    }
                    if ($vacation["finish2"]) {
                        $dateFinish2Obj = new DateTime($vacation["finish2"]);
                        $dateFinish2 = $dateFinish2Obj->format("Y / m / d");
                    } else {
                        $dateFinish2 = '';
                    }

                    if ($vacation["start3"]) {
                        $dateStart3Obj = new DateTime($vacation["start3"]);
                        $dateStart3 = $dateStart3Obj->format("Y / m / d");
                    } else {
                        $dateStart3 = '';
                    }
                    if ($vacation["finish3"]) {
                        $dateFinish3Obj = new DateTime($vacation["finish3"]);
                        $dateFinish3 = $dateFinish3Obj->format("Y / m / d");
                    } else {
                        $dateFinish3 = '';
                    }

                    if ($vacation["start4"]) {
                        $dateStart4Obj = new DateTime($vacation["start4"]);
                        $dateStart4 = $dateStart4Obj->format("Y / m / d");
                    } else {
                        $dateStart4 = '';
                    }
                    if ($vacation["finish4"]) {
                        $dateFinish4Obj = new DateTime($vacation["finish4"]);
                        $dateFinish4 = $dateFinish4Obj->format("Y / m / d");
                    } else {
                        $dateFinish4 = '';
                    }

                    $personVacationSession["start1"] = $dateStart1;
                    $personVacationSession["finish1"] = $dateFinish1;
                    $personVacationSession["start2"] = $dateStart2;
                    $personVacationSession["finish2"] = $dateFinish2;
                    $personVacationSession["start3"] = $dateStart3;
                    $personVacationSession["finish3"] = $dateFinish3;
                    $personVacationSession["start4"] = $dateStart4;
                    $personVacationSession["finish4"] = $dateFinish4;
                    $personVacationSession["allowed"] = $vacation["allowed"];
                }
            }


            if ($user['office'] == null) {
                $user['office'] = 'Без офиса';
            }

            if ($user['officeid'] == null) {
                $user['officeid'] = 0;
            }

            $flag = 0;
            foreach ($offices as $key => $off) {
                if ($off["office"] == $user["office"]) {
                    $offices[$key]["vacation"][] = $personVacation;
                    $offices[$key]["promotionalTour"][] = $personPromo;
                    $offices[$key]["vacationSession"][] = $personVacationSession;

                    $flag = 1;
                    break;
                }
            }

            if ($flag == 0) {
                $office = [
                    "office" => $user["office"],
                    "officeId" => $user["officeid"]
                ];

                $office["vacation"] = [];
                $office["vacation"][] = $personVacation;

                $office["promotionalTour"] = [];
                $office["promotionalTour"][] = $personPromo;

                $office["vacationSession"] = [];
                $office["vacationSession"][] = $personVacationSession;

                $offices[] = $office;
            }

        }

        $dataProvider = [];
        $officesChart = [];
        foreach ($users as $key => $user) {

            $dataProvider[$key]["category"] = $user['name'];
            $dataProvider[$key]["id"] = $user['id'];
            $segments = [];
            foreach ($vacationArray as $vacation) {
                $segments = [];
                if ($vacation["worker"] == $user["id"]) {

                    if ($vacation["start1"]) {
                        $dateStart1Obj = new DateTime($vacation["start1"]);
                        $segments['start'] = $dateStart1Obj->format("Y-m-d");
                    }
                    if ($vacation["finish1"]) {
                        $dateFinish1Obj = new DateTime($vacation["finish1"]);
                        $segments['end'] = $dateFinish1Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#FF0000';
                    $dataProvider[$key]["segments"][] = $segments;

                    if ($vacation["start2"]) {
                        $dateStart2Obj = new DateTime($vacation["start2"]);
                        $segments['start'] = $dateStart2Obj->format("Y-m-d");
                    }
                    if ($vacation["finish2"]) {
                        $dateFinish2Obj = new DateTime($vacation["finish2"]);
                        $segments['end'] = $dateFinish2Obj->format("Y-m-d");

                    }
                    $segments['color'] = '#FF0000';
                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start3"]) {
                        $dateStart3Obj = new DateTime($vacation["start3"]);
                        $segments['start'] = $dateStart3Obj->format("Y-m-d");
                    }
                    if ($vacation["finish3"]) {
                        $dateFinish3Obj = new DateTime($vacation["finish3"]);
                        $segments['end'] = $dateFinish3Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#FF0000';
                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start4"]) {
                        $dateStart4Obj = new DateTime($vacation["start4"]);
                        $segments['start'] = $dateStart4Obj->format("Y-m-d");
                    }
                    if ($vacation["finish4"]) {
                        $dateFinish4Obj = new DateTime($vacation["finish4"]);
                        $segments['end'] = $dateFinish4Obj->format("Y-m-d");
                    }


                    $segments['color'] = '#FF0000';
                    $dataProvider[$key]["segments"][] = $segments;

                }
            }


            foreach ($vacationPromoArray as $vacation) {
                $segments = [];
                if ($vacation["worker"] == $user["id"]) {

                    if ($vacation["start1"]) {
                        $dateStart1Obj = new DateTime($vacation["start1"]);
                        $segments['start'] = $dateStart1Obj->format("Y-m-d");
                    }
                    if ($vacation["finish1"]) {
                        $dateFinish1Obj = new DateTime($vacation["finish1"]);
                        $segments['end'] = $dateFinish1Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#FFFF00';

                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start2"]) {
                        $dateStart2Obj = new DateTime($vacation["start2"]);
                        $segments['start'] = $dateStart2Obj->format("Y-m-d");
                    }
                    if ($vacation["finish2"]) {
                        $dateFinish2Obj = new DateTime($vacation["finish2"]);
                        $segments['end'] = $dateFinish2Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#FFFF00';

                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start3"]) {
                        $dateStart3Obj = new DateTime($vacation["start3"]);
                        $segments['start'] = $dateStart3Obj->format("Y-m-d");
                    }
                    if ($vacation["finish3"]) {
                        $dateFinish3Obj = new DateTime($vacation["finish3"]);
                        $segments['end'] = $dateFinish3Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#FFFF00';

                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start4"]) {
                        $dateStart4Obj = new DateTime($vacation["start4"]);
                        $segments['start'] = $dateStart4Obj->format("Y-m-d");
                    }
                    if ($vacation["finish4"]) {
                        $dateFinish4Obj = new DateTime($vacation["finish4"]);
                        $segments['end'] = $dateFinish4Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#FFFF00';

                    $dataProvider[$key]["segments"][] = $segments;

                }

            }

            foreach ($vacationSessionArray as $vacation) {
                $segments = [];
                if ($vacation["worker"] == $user["id"]) {

                    if ($vacation["start1"]) {
                        $dateStart1Obj = new DateTime($vacation["start1"]);
                        $segments['start'] = $dateStart1Obj->format("Y-m-d");
                    }
                    if ($vacation["finish1"]) {
                        $dateFinish1Obj = new DateTime($vacation["finish1"]);
                        $segments['end'] = $dateFinish1Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#4744f6';

                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start2"]) {
                        $dateStart2Obj = new DateTime($vacation["start2"]);
                        $segments['start'] = $dateStart2Obj->format("Y-m-d");
                    }
                    if ($vacation["finish2"]) {
                        $dateFinish2Obj = new DateTime($vacation["finish2"]);
                        $segments['end'] = $dateFinish2Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#4744f6';

                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start3"]) {
                        $dateStart3Obj = new DateTime($vacation["start3"]);
                        $segments['start'] = $dateStart3Obj->format("Y-m-d");
                    }
                    if ($vacation["finish3"]) {
                        $dateFinish3Obj = new DateTime($vacation["finish3"]);
                        $segments['end'] = $dateFinish3Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#4744f6';

                    $dataProvider[$key]["segments"][] = $segments;
                    if ($vacation["start4"]) {
                        $dateStart4Obj = new DateTime($vacation["start4"]);
                        $segments['start'] = $dateStart4Obj->format("Y-m-d");
                    }
                    if ($vacation["finish4"]) {
                        $dateFinish4Obj = new DateTime($vacation["finish4"]);
                        $segments['end'] = $dateFinish4Obj->format("Y-m-d");
                    }
                    $segments['color'] = '#4744f6';

                    $dataProvider[$key]["segments"][] = $segments;

                }

            }


            if ($user['office'] == null) {
                $user['office'] = 'Без офиса';
            }

            if ($user['officeid'] == null) {
                $user['officeid'] = 0;
            }
            $officesChart[$user["officeid"]][] = $dataProvider[$key];


        }


        foreach ($offices as $key => $item) {
            $i = count($item['vacation']);
            switch ($i) {
                case 1:
                    $offices[$key]['height'] = 110;
                    break;
                case 2:
                    $offices[$key]['height'] = 65 * $i;
                    break;
                case 3:
                    $offices[$key]['height'] = 55 * $i;
                    break;
                case $i > 8:
                    $offices[$key]['height'] = 40 * $i;
                    break;
                case $i > 3:
                    $offices[$key]['height'] = 50 * $i;

            }


        }


        foreach ($offices as $key => $item) {
            foreach ($officesChart as $keyO => $value) {
                if ($item['officeId'] == $keyO) {
                    $offices[$key]['dataProvider'] = $value;
                }
            }


        }

        $holidayQuery = "SELECT * FROM holidays where date BETWEEN '$d-01-01' AND '$d-12-31'  ORDER BY date";

        $holidays = $this->getSQLArrayResult($holidayQuery, "");

        $viewer->assign('HOLIDAYS', json_encode($holidays));


        $offices[] = array_shift($offices);
        $viewer->assign('MONTHPERIOD', $this->filter_data['period']);
        $viewer->assign('VACATIONSCHEDULE', json_encode($offices));

    }

    public function validateIntersection($column, $value, $line1, $line2)
    {

        $date = new DateTime($value);


        if ($line1["start1"] != "" && $line1["start1"] != null) {
            if ((new DateTime($line1["start1"])) == $date) {
                return false;
            }
        }
        if ($line1["start2"] != "" && $line1["start2"] != null) {
            if ((new DateTime($line1["start2"])) == $date) {
                return false;
            }
        }
        if ($line1["start3"] != "" && $line1["start3"] != null) {
            if ((new DateTime($line1["start3"])) == $date) {
                return false;
            }
        }
        if ($line1["start4"] != "" && $line1["start4"] != null) {
            if ((new DateTime($line1["start4"])) == $date) {
                return false;
            }
        }

        if ($line1["finish1"] != "" && $line1["finish1"] != null) {
            if ((new DateTime($line1["finish1"])) == $date) {
                return false;
            }
        }
        if ($line1["finish2"] != "" && $line1["finish2"] != null) {
            if ((new DateTime($line1["finish2"])) == $date) {
                return false;
            }
        }
        if ($line1["finish3"] != "" && $line1["finish3"] != null) {
            if ((new DateTime($line1["finish3"])) == $date) {
                return false;
            }
        }
        if ($line1["finish4"] != "" && $line1["finish4"] != null) {
            if ((new DateTime($line1["finish4"])) == $date) {
                return false;
            }
        }

        if ($line1["start1"] != "" && $line1["start1"] != null && $line1["finish1"] != "" && $line1["finish1"] != null) {
            if ((new DateTime($line1["start1"])) < $date && (new DateTime($line1["finish1"])) > $date) {
                return false;
            }
        }
        if ($line1["start2"] != "" && $line1["start2"] != null && $line1["finish2"] != "" && $line1["finish2"] != null) {
            if ((new DateTime($line1["start2"])) < $date && (new DateTime($line1["finish2"])) > $date) {
                return false;
            }
        }
        if ($line1["start3"] != "" && $line1["start3"] != null && $line1["finish3"] != "" && $line1["finish3"] != null) {
            if ((new DateTime($line1["start3"])) < $date && (new DateTime($line1["finish3"])) > $date) {
                return false;
            }
        }
        if ($line1["start4"] != "" && $line1["start4"] != null && $line1["finish4"] != "" && $line1["finish4"] != null) {
            if ((new DateTime($line1["start4"])) < $date && (new DateTime($line1["finish4"])) > $date) {
                return false;
            }
        }


        if ($line2["start1"] != "" && $line2["start1"] != null) {
            if ((new DateTime($line2["start1"])) == $date) {
                return false;
            }
        }
        if ($line2["start2"] != "" && $line2["start2"] != null) {
            if ((new DateTime($line2["start2"])) == $date) {
                return false;
            }
        }
        if ($line2["start3"] != "" && $line2["start3"] != null) {
            if ((new DateTime($line2["start3"])) == $date) {
                return false;
            }
        }
        if ($line2["start4"] != "" && $line2["start4"] != null) {
            if ((new DateTime($line2["start4"])) == $date) {
                return false;
            }
        }

        if ($line2["finish1"] != "" && $line2["finish1"] != null) {
            if ((new DateTime($line2["finish1"])) == $date) {
                return false;
            }
        }
        if ($line2["finish2"] != "" && $line2["finish2"] != null) {
            if ((new DateTime($line2["finish2"])) == $date) {
                return false;
            }
        }
        if ($line2["finish3"] != "" && $line2["finish3"] != null) {
            if ((new DateTime($line2["finish3"])) == $date) {
                return false;
            }
        }
        if ($line2["finish4"] != "" && $line2["finish4"] != null) {
            if ((new DateTime($line2["finish4"])) == $date) {
                return false;
            }
        }

        if ($line2["start1"] != "" && $line2["start1"] != null && $line2["finish1"] != "" && $line2["finish1"] != null) {
            if ((new DateTime($line2["start1"])) < $date && (new DateTime($line2["finish1"])) > $date) {
                return false;
            }
        }
        if ($line2["start2"] != "" && $line2["start2"] != null && $line2["finish2"] != "" && $line2["finish2"] != null) {
            if ((new DateTime($line2["start2"])) < $date && (new DateTime($line2["finish2"])) > $date) {
                return false;
            }
        }
        if ($line2["start3"] != "" && $line2["start3"] != null && $line2["finish3"] != "" && $line2["finish3"] != null) {
            if ((new DateTime($line2["start3"])) < $date && (new DateTime($line2["finish3"])) > $date) {
                return false;
            }
        }
        if ($line2["start4"] != "" && $line2["start4"] != null && $line2["finish4"] != "" && $line2["finish4"] != null) {
            if ((new DateTime($line2["start4"])) < $date && (new DateTime($line2["finish4"])) > $date) {
                return false;
            }
        }


        return 'success';

    }

    public function validatePeriodLine($column, $value, $line)
    {
        $arrayValidate = [
            "start1" => $line["start1"],
            "finish1" => $line["finish1"],
            "start2" => $line["start2"],
            "finish2" => $line["finish2"],
            "start3" => $line["start3"],
            "finish3" => $line["finish4"],
            "start4" => $line["start4"],
            "finish4" => $line["finish4"],
        ];

        $flag = 0;
        foreach ($arrayValidate as $key => $item) {
            if ($key == $column) {
                $flag = 1;
                continue;
            }

            if ($column{strlen($column) - 1} == $key{strlen($key) - 1}) {
                if ($flag == 0 && $item != "" && $item != null) {
                    if ((new DateTime($value)) < (new DateTime($item))) {
                        return 'Дата окончания должна быть больше или равна дате начала';
                    }
                }

                if ($flag == 1 && $item != "" && $item != null) {
                    if ((new DateTime($value)) > (new DateTime($item))) {
                        return 'Дата начала должна быть меньше или равна дате окончания';
                    }
                }
            } else {
                if ($flag == 0 && $item != "" && $item != null) {
                    if ((new DateTime($value)) <= (new DateTime($item))) {
                        return 'Дата должна быть позже дат предыдущих периодов';
                    }
                }

                if ($flag == 1 && $item != "" && $item != null) {
                    if ((new DateTime($value)) >= (new DateTime($item))) {
                        return 'Дата должна быть раньше дат предыдущих периодов';
                    }
                }
            }


        }

        return 'success';


    }

    public function editVacation(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        $value = $request->get("value");
        $year = $request->get("year");
        $column = $request->get("column");
        $worker = $request->get("worker");


        if (strlen($value) > 20) {

            $date = substr($value, 0, strpos($value, '('));
            $new_string = "";
            $string = $date;
            $words = "4";
            $array = explode(" ", $string);
            for ($i = 0; $i < $words; $i++) {
                $new_string .= $array[$i] . " ";
            }
            $need = trim($new_string);

            $d = DateTime::createFromFormat('D M d Y', $need);
            $value = $d->format("Y-m-d");
        }

        $sql = ("SELECT * FROM vacation WHERE year = '$year' AND worker = '$worker'");

        $record = $this->getSQLArrayResult($sql, []);

        if ($column != 'allowed' && $value != "") {

            $dateTimeDate = new DateTime($value);

            if ($dateTimeDate->format('Y') != $year) {
                echo json_encode('Год должен совпадать с выбранным в фильтре');
                die();
            }

            $validate = $this->validatePeriodLine($column, $value, $record[0]);

            if ($validate != 'success') {
                echo json_encode($validate);
                die();
            }


            $sql = ("SELECT * FROM vacation_session WHERE year = '$year' AND worker = '$worker'");

            $recordSession = $this->getSQLArrayResult($sql, []);

            $sql = ("SELECT * FROM vacation_promotional_tour WHERE year = '$year' AND worker = '$worker'");

            $recordPromotional = $this->getSQLArrayResult($sql, []);

            $validate = $this->validateIntersection($column, $value, $recordSession[0], $recordPromotional[0]);

            if ($validate != 'success') {
                echo json_encode('Дата не должна пересекаться с датами из других таблиц');
                die();
            }
        }

        if ($column == 'allowed' && $value != "" && !is_numeric($value)) {
            echo json_encode('Должно быть числовое значение');
            die();
        }


        if (count($record)) {
            if ($value == '') {
                $sql = "UPDATE vacation SET $column = null WHERE  year = '$year' AND worker = '$worker'";
            } else {
                $sql = "UPDATE vacation SET $column = '$value' WHERE  year = '$year' AND worker = '$worker'";
            }

        } else {
            if ($value == '') {
                $sql = "INSERT INTO vacation (worker, year) VALUES('$worker', '$year')";
            } else {
                $sql = "INSERT INTO vacation (worker, year, $column) VALUES('$worker', '$year', '$value')";
            }
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        if ($column != 'allowed') {

            if ($value == '') {
                $mode = 'delete';
            } else {

                if ($record[0][$column]) {
                    $mode = 'edit';
                } else {
                    $mode = 'add';
                }
            }

            if ($column == 'start1' || $column == 'finish1') $this->editHours($value, $column, $record[0]["start1"], $record[0]["finish1"], 'от', $worker, $mode);
            if ($column == 'start2' || $column == 'finish2') $this->editHours($value, $column, $record[0]["start2"], $record[0]["finish2"], 'от', $worker, $mode);
            if ($column == 'start3' || $column == 'finish3') $this->editHours($value, $column, $record[0]["start3"], $record[0]["finish3"], 'от', $worker, $mode);
            if ($column == 'start4' || $column == 'finish4') $this->editHours($value, $column, $record[0]["start4"], $record[0]["finish4"], 'от', $worker, $mode);
        }

        echo json_encode('success');
        die();
    }

    public function editHours($new, $column, $date1, $date2, $value, $worker, $mode)
    {
        if ($mode == 'add') {
            if ($column == 'start1' || $column == 'start2' || $column == 'start3' || $column == 'start4') {
                if ($date2) {
                    $dates = $this->datePeriod($new, $date2);
                    foreach ($dates as $date) {
                        $this->setVacationInWorkHours($date, $worker, $value);
                    }
                }
            } else {
                if ($date1) {
                    $dates = $this->datePeriod($date1, $new);
                    foreach ($dates as $date) {
                        $this->setVacationInWorkHours($date, $worker, $value);
                    }
                }
            }
        }

        if ($mode == 'edit') {

            if ($date1 && $date2) {
                $dates = $this->datePeriod($date1, $date2);
                foreach ($dates as $date) {
                    $this->deleteVacationInWorkHours($date, $worker, $value);
                }
            }

            if ($column == 'start1' || $column == 'start2' || $column == 'start3' || $column == 'start4') {
                if ($date2) {
                    $dates = $this->datePeriod($new, $date2);
                    foreach ($dates as $date) {
                        $this->setVacationInWorkHours($date, $worker, $value);
                    }
                }
            } else {
                if ($date1) {
                    $dates = $this->datePeriod($date1, $new);
                    foreach ($dates as $date) {
                        $this->setVacationInWorkHours($date, $worker, $value);
                    }
                }
            }

        }

        if ($mode == 'delete') {
            if ($date1 && $date2) {
                $dates = $this->datePeriod($date1, $date2);
                foreach ($dates as $date) {
                    $this->deleteVacationInWorkHours($date, $worker, $value);
                }
            }
        }
    }

    public function datePeriod($fromD, $toD)
    {
        $from = new DateTime($fromD);
        $to = new DateTime($toD);

        $interval = new DateInterval('P1D');

        $to->add($interval);

        $period = new DatePeriod($from, new DateInterval('P1D'), $to);

        return array_map(
            function ($item) {
                return $item->format('Y-m-d');
            },
            iterator_to_array($period)
        );
    }

    public function deleteVacationInWorkHours($date, $worker, $value)
    {

        $sql = ("SELECT id FROM working_time WHERE user = '$worker' AND date = '$date'");
        $record = $this->getSQLArrayResult($sql, []);
        $id = $record[0]["id"];

        $sql = "DELETE FROM working_time WHERE id = '$id' and time = '$value'";
        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());
    }

    public function setVacationInWorkHours($date, $worker, $value)
    {

        $sql = ("SELECT id FROM working_time WHERE user = '$worker' AND date = '$date'");

        $record = $this->getSQLArrayResult($sql, []);

        if (count($record)) {
            $id = $record[0]["id"];
            $sql = "UPDATE working_time SET date = '$date', user = '$worker', time = '$value'  WHERE id = '$id' and time = ''";
        } else {
            $sql = "INSERT INTO working_time (user, date, time) VALUES('$worker', '$date', '$value')";
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());
    }

    public function editVacationTour(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {

        $value = $request->get("value");
        $year = $request->get("year");
        $column = $request->get("column");
        $worker = $request->get("worker");


        if (strlen($value) > 20) {

            $date = substr($value, 0, strpos($value, '('));
            $new_string = "";
            $string = $date;
            $words = "4";
            $array = explode(" ", $string);
            for ($i = 0; $i < $words; $i++) {
                $new_string .= $array[$i] . " ";
            }
            $need = trim($new_string);

            $d = DateTime::createFromFormat('D M d Y', $need);
            $value = $d->format("Y-m-d");


        }

        $sql = ("SELECT * FROM vacation_promotional_tour WHERE year = '$year' AND worker = '$worker'");

        $record = $this->getSQLArrayResult($sql, []);

        if ($column != 'allowed' && $value != "") {

            $dateTimeDate = new DateTime($value);

            if ($dateTimeDate->format('Y') != $year) {
                echo json_encode('Год должен совпадать с выбранным в фильтре');
                die();
            }

            $validate = $this->validatePeriodLine($column, $value, $record[0]);

            if ($validate != 'success') {
                echo json_encode($validate);
                die();
            }

            $sql = ("SELECT * FROM vacation_session WHERE year = '$year' AND worker = '$worker'");

            $recordSession = $this->getSQLArrayResult($sql, []);

            $sql = ("SELECT * FROM vacation WHERE year = '$year' AND worker = '$worker'");

            $recordVacation = $this->getSQLArrayResult($sql, []);

            $validate = $this->validateIntersection($column, $value, $recordSession[0], $recordVacation[0]);

            if ($validate != 'success') {
                echo json_encode('Дата не должна пересекаться с датами из других таблиц');
                die();
            }
        }

        if ($column == 'allowed' && $value != "" && !is_numeric($value)) {
            echo json_encode('Должно быть числовое значение');
            die();
        }


        if (count($record)) {
            if ($value == '') {
                $sql = "UPDATE vacation_promotional_tour SET $column = null WHERE  year = '$year' AND worker = '$worker'";
            } else {
                $sql = "UPDATE vacation_promotional_tour SET $column = '$value' WHERE  year = '$year' AND worker = '$worker'";
            }

        } else {
            if ($value == '') {
                $sql = "INSERT INTO vacation_promotional_tour (worker, year) VALUES('$worker', '$year')";
            } else {
                $sql = "INSERT INTO vacation_promotional_tour (worker, year, $column) VALUES('$worker', '$year', '$value')";
            }
        }

        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        if ($column != 'allowed') {

            if ($value == '') {
                $mode = 'delete';
            } else {

                if ($record[0][$column]) {
                    $mode = 'edit';
                } else {
                    $mode = 'add';
                }
            }

            if ($column == 'start1' || $column == 'finish1') $this->editHours($value, $column, $record[0]["start1"], $record[0]["finish1"], 'РТ', $worker, $mode);
            if ($column == 'start2' || $column == 'finish2') $this->editHours($value, $column, $record[0]["start2"], $record[0]["finish2"], 'РТ', $worker, $mode);
            if ($column == 'start3' || $column == 'finish3') $this->editHours($value, $column, $record[0]["start3"], $record[0]["finish3"], 'РТ', $worker, $mode);
            if ($column == 'start4' || $column == 'finish4') $this->editHours($value, $column, $record[0]["start4"], $record[0]["finish4"], 'РТ', $worker, $mode);
        }


        echo json_encode('success');
        die();
    }


    public function editVacationSession(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        $value = $request->get("value");
        $year = $request->get("year");
        $column = $request->get("column");
        $worker = $request->get("worker");


        if (strlen($value) > 20) {

            $date = substr($value, 0, strpos($value, '('));
            $new_string = "";
            $string = $date;
            $words = "4";
            $array = explode(" ", $string);
            for ($i = 0; $i < $words; $i++) {
                $new_string .= $array[$i] . " ";
            }
            $need = trim($new_string);

            $d = DateTime::createFromFormat('D M d Y', $need);
            $value = $d->format("Y-m-d");


        }

        $sql = ("SELECT * FROM vacation_session WHERE year = '$year' AND worker = '$worker'");

        $record = $this->getSQLArrayResult($sql, []);

        if ($column != 'allowed' && $value != "") {

            $dateTimeDate = new DateTime($value);

            if ($dateTimeDate->format('Y') != $year) {
                echo json_encode('Год должен совпадать с выбранным в фильтре');
                die();
            }

            $validate = $this->validatePeriodLine($column, $value, $record[0]);

            if ($validate != 'success') {
                echo json_encode($validate);
                die();
            }

            $sql = ("SELECT * FROM vacation_promotional_tour WHERE year = '$year' AND worker = '$worker'");

            $recordPromotion = $this->getSQLArrayResult($sql, []);

            $sql = ("SELECT * FROM vacation WHERE year = '$year' AND worker = '$worker'");

            $recordVacation = $this->getSQLArrayResult($sql, []);

            $validate = $this->validateIntersection($column, $value, $recordPromotion[0], $recordVacation[0]);

            if ($validate != 'success') {
                echo json_encode('Дата не должна пересекаться с датами из других таблиц');
                die();
            }
        }

        if (count($record)) {
            if ($value == '') {
                $sql = "UPDATE vacation_session SET $column = null WHERE  year = '$year' AND worker = '$worker'";
            } else {
                $sql = "UPDATE vacation_session SET $column = '$value' WHERE  year = '$year' AND worker = '$worker'";
            }

        } else {
            if ($value == '') {
                $sql = "INSERT INTO vacation_session (worker, year) VALUES('$worker', '$year')";
            } else {
                $sql = "INSERT INTO vacation_session (worker, year, $column) VALUES('$worker', '$year', '$value')";
            }
        }

        if ($column == 'allowed' && $value != "" && !is_numeric($value)) {
            echo json_encode('Должно быть числовое значение');
            die();
        }


        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());

        if ($column != 'allowed') {

            if ($value == '') {
                $mode = 'delete';
            } else {

                if ($record[0][$column]) {
                    $mode = 'edit';
                } else {
                    $mode = 'add';
                }
            }

            if ($column == 'start1' || $column == 'finish1') $this->editHours($value, $column, $record[0]["start1"], $record[0]["finish1"], 'ДУ', $worker, $mode);
            if ($column == 'start2' || $column == 'finish2') $this->editHours($value, $column, $record[0]["start2"], $record[0]["finish2"], 'ДУ', $worker, $mode);
            if ($column == 'start3' || $column == 'finish3') $this->editHours($value, $column, $record[0]["start3"], $record[0]["finish3"], 'ДУ', $worker, $mode);
            if ($column == 'start4' || $column == 'finish4') $this->editHours($value, $column, $record[0]["start4"], $record[0]["finish4"], 'ДУ', $worker, $mode);
        }


        echo json_encode('success');
        die();
    }

    function addScript_salary($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.webix.webix");
        array_push($jsFileNames, "modules.Accounting.script.salary");

        return $jsFileNames;
    }

    public function salary(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        $addQuery = $this->addQueryFilter();

        $usersQuery = "SELECT o.office, o.officeid, u.id, u.title, concat(u.first_name,' ',u.last_name) as name from vtiger_users as u LEFT JOIN vtiger_office as o ON o.officeid = u.office WHERE 1=1 " . $addQuery;

        $users = $this->getSQLArrayResult($usersQuery, []);

        $salesPlanQuery = "SELECT * FROM worker_sales_plan WHERE date=" . $this->filter_data['period'];

        $salesPlan = $this->getSQLArrayResult($salesPlanQuery, []);


        $sql = "SELECT p.amount-pcf.cf_1256 AS amount , c1.smownerid, pcf.cf_1225 AS date  FROM vtiger_potential as p INNER JOIN vtiger_crmentity as c1 ON c1.crmid = p.potentialid
            inner join vtiger_potentialscf as pcf ON pcf.potentialid = p.potentialid
            left join vtiger_office as o ON o.officeid = pcf.cf_1215
            LEFT JOIN vtiger_users as u ON u.id = c1.smownerid
            where c1.deleted=0  and (CAST( pcf.cf_1225 AS DATE) BETWEEN ? AND ?) and p.sales_stage <> 'Closed Lost' and p.sales_stage <> 'Новый' and p.sales_stage <> 'Заключение договора' and p.sales_stage <> 'Договор заключен' " . $addQuery;

        $queryP = "SELECT * FROM percent_level";
        $percentLevel = $this->getSQLArrayResult($queryP, []);


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

        $sales = $this->getSQLArrayResult($sql, array($start, $finish));


        $offices = [];

        foreach ($users as $user) {
            $level = "";
            $percent = "";
            $sum = 0;
            foreach ($sales as $item) {
                if ($item['smownerid'] == $user['id']) {
                    $sum += $item['amount'];
                }
            }

            foreach ($salesPlan as $item) {
                if ($user['id'] == $item['worker']) {
                    $floor1 = $item['floor1'];
                    $floor2 = $item['floor2'];
                    $floor3 = $item['floor3'];
                    $floor4 = $item['floor4'];
                }
            }


            if (isset($floor1)) {
                if ($sum >= $floor1) {
                    $level = 1;
                    $percent = $percentLevel[0]['level1'];
                }
            }

            if (isset($floor2)) {
                if ($sum >= $floor2) {
                    $level = 2;
                    $percent = $percentLevel[0]['level2'];
                }
            }

            if (isset($floor3)) {
                if ($sum >= $floor3) {
                    $level = 3;
                    $percent = $percentLevel[0]['level3'];
                }
            }

            if (isset($floor4)) {
                if ($sum >= $floor4) {
                    $level = 4;
                    $percent = $percentLevel[0]['level4'];
                }
            }

            $personSalary = [
                "id" => $user["id"],
                "worker" => $user["name"],
                "stage" => $level,
                "stagePercent"=>$percent
            ];

            if ($user['office'] == null) {
                $user['office'] = 'Без офиса';
            }

            if ($user['officeid'] == null) {
                $user['officeid'] = 0;
            }

            $flag = 0;
            foreach ($offices as $key => $off) {
                if ($off["office"] == $user["office"]) {
                    $offices[$key]["salary"][] = $personSalary;
                    $flag = 1;
                    break;
                }
            }

            if ($flag == 0) {
                $office = [
                    "office" => $user["office"],
                    "officeId" => $user["officeid"]
                ];

                $office["salary"] = [];
                $office["salary"][] = $personSalary;

                $offices[] = $office;
            }

        }

        $offices[] = array_shift($offices);
        $viewer->assign('MONTHPERIOD', $this->filter_data['period']);
        $viewer->assign('SALARY', json_encode($offices));
    }


    public function optionSalary(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {
        $query = "SELECT * FROM percent_level";
        $percentLevel = $this->getSQLArrayResult($query, []);

        $data = [['id' => 1, 'level' => '1 этап', 'percent' => $percentLevel[0]['level1']], ['id' => 2, 'level' => '2 этап', 'percent' => $percentLevel[0]['level2']], ['id' => 3, 'level' => '3 этап', 'percent' => $percentLevel[0]['level3']], ['id' => 4, 'level' => '4 этап', 'percent' => $percentLevel[0]['level4']]];
        $viewer->assign('DATA', json_encode($data));
        $viewer->assign('OPTIONSALARY', true);
    }

    function addScript_optionSalary($jsFileNames)
    {
        array_push($jsFileNames, "modules.VDCustomReports.webix.webix");
        array_push($jsFileNames, "modules.Accounting.script.optionSalary");

        return $jsFileNames;
    }

    public function editLevelPercent(Vtiger_Request $request, Vtiger_Viewer $viewer)
    {

        $id = $request->get('id');
        $percent = $request->get('percent');

        $query = "SELECT * FROM percent_level";
        $percentLevel = $this->getSQLArrayResult($query, []);

        switch ($id) {
            case 1:
                $column = 'level1';
                break;
            case 2:
                $column = 'level2';
                break;
            case 3:
                $column = 'level3';
                break;
            case 4:
                $column = 'level4';
                break;
        }

        if (count($percentLevel)) {

            $sql = "UPDATE percent_level SET $column = '$percent' WHERE  id=1";

        } else {

            $sql = "INSERT INTO percent_level ($column) VALUES('$percent')";

        }


        $db = PearDatabase::getInstance();
        $db->pquery($sql, array());
        echo "success";
        die();
    }

}

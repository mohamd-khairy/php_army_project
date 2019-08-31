<?php

class HomePage {

    private $template;
    private $valid;
    private $month;

    public function __construct() {
        $this->template = new Template();
        $this->valid = new Validation();
        $this->month = new MonthModel();
    }

    function indexAction() {

        if (isset($_SESSION['go']) && $_SESSION['go'] == 'go') {
            $this->template->render("home");
        } else {
            $this->template->render_ajax('welcome');
        }
    }

    function monthAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $this->month->mon_askry = $_POST['mon_askry'];
            $this->month->mon_zapt = $_POST['mon_zapt'];
            $this->month->mon_current = $_POST['mon_current'];
            $this->month->mon_date = date('Y-m-d');
            $this->month->mon_role = 0;
            if ($this->month->insert() >= 1) {
                $_SESSION['mon_current'] = $_POST['mon_current'];
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
        $this->template->render('month/add');
    }

    function check_monthAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $data = MonthModel::getAllData();
            $found = 'yes';
            foreach ($data as $m) {
                if ($m['mon_role'] == 0) {
                    $found = 'قم بتقفيل حسابات الشهر الحالي اولا !!';

                    if (($m['mon_current'] == $_POST['mon_current'])) {
                        $found = "هذا الشهر موجود بالفعل .. !";
                    }
                }
            }
            echo $found;
            die();
        }
    }

    function loginAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            if ($_POST['pass'] == '590') {
                $_SESSION['go'] = 'go';
                $data = MonthModel::getAllData();
                foreach ($data as $m) {
                    if ($m['mon_role'] == 0) {
                        $_SESSION['mon_current'] = $m['mon_current'];
                    }
                }
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function logoutAction() {
        session_destroy();
        unset($_SESSION['go']);
        unset($_SESSION['mon_current']);
        $this->template->render_ajax("welcome");
    }

}

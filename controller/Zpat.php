<?php

class Zpat {

    private $template;
    private $zpat;
    private $ms7;

    public function __construct() {
        $this->template = new Template();
        $this->zpat = new ZpatModel();
        $this->ms7 = new Ms7obatModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->zpat->z_name = $_POST['z_name'];
            $this->zpat->z_mobile = $_POST['z_mobile'];
            $this->zpat->z_address = $_POST['z_address'];
            $this->zpat->z_degree = $_POST['z_degree'];
            $this->zpat->z_date = $_POST['z_date'];
            if ($this->zpat->insert() >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
        $this->template->render('zpat/show');
    }

    function deleteAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->zpat->delete($_POST['id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function editAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = ZpatModel::getAllDataby_table_colm_and_id('z_id', $_POST['id']);
            echo implode(',', $data[0]);
        }
    }

    function updateAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->zpat->z_name = $_POST['z_name'];
            $this->zpat->z_mobile = $_POST['z_mobile'];
            $this->zpat->z_address = $_POST['z_address'];
            $this->zpat->z_degree = $_POST['z_degree'];
            $this->zpat->z_date = $_POST['z_date'];
            if ($this->zpat->update($_POST['z_id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function moneyAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                $data = Ms7obatModel::get_All_data_by_mon_current_and_date($_POST['ms7_date'], $_POST['z_name']);
                if (empty($data)) {
                    $this->ms7->ms7_cost = $_POST['ms7_cost'];
                    $this->ms7->ms7_date = $_POST['ms7_date'];
                    $this->ms7->z_name = $_POST['z_name'];
                    $this->ms7->mon_current = $_SESSION['mon_current'];
                    if ($this->ms7->insert() >= 1) {
                        echo 'yes';
                        die();
                    } else {
                        echo "يوجد خطا.. !";
                        die();
                    }
                } else {
                    echo ' تم ادخال بيانات هذا اليوم من قبل ...!';
                    die();
                }
            } else {
                echo 'قم بفتح حساب شهر جديد...!';
                die();
            }
        }
        $this->template->render('zpat/money');
    }

    function edit_ms7Action() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            echo date("Y-m-d", $_POST['date']);
            die();
        }
    }

    function new_editAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = Ms7obatModel::get_All_data_by_mon_current_and_date($_POST['ms7_date'], $_POST['z_name']);
            if (!empty($data)) {
                echo $data[0]['ms7_cost'];
            } else {
                echo 0;
            }
            die();
        }
    }

    function delete_first_ms7Action() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            echo date("Y-m-d", $_POST['date']);
            die();
        }
    }

    function delete_ms7Action() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->ms7->delete_ms7($_POST['ms7_date'],$_POST['z_name']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function update_ms7Action() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = Ms7obatModel::get_All_data_by_mon_current_and_date($_POST['ms7_date'], $_POST['z_name']);
            $this->ms7->z_name = $_POST['z_name'];
            $this->ms7->ms7_cost = $_POST['ms7_cost'];
            $this->ms7->ms7_date = $_POST['ms7_date'];
            $this->ms7->mon_current = $_SESSION['mon_current'];
            if (empty($data)) {
                if ($this->ms7->insert() >= 1) {
                    echo 'yes';
                    die();
                } else {
                    echo 'no';
                    die();
                }
            } else {
                if ($this->ms7->update($data[0]['ms7_id']) >= 1) {
                    echo 'yes';
                    die();
                } else {
                    echo 'no';
                    die();
                }
            }
        }
    }

    function allAction() {
        $this->template->render('zpat/all');
    }

    function all_moneyAction() {
        $this->template->render('zpat/all_money');
    }

}

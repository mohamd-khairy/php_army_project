<?php

class fwater {

    private $template;
    private $fw;
    private
            $det;
    private $spc;

    public function __construct() {

        $this->template = new Template();
        $this->fw = new FwaterModel();
        $this->det = new DetailsModel();
        $this->spc = new SpecialModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                $this->fw->fw_askry = $_POST['fw_askry'];
                $this->fw->fw_date = $_POST['fw_date'];
                $this->fw->mon_current = $_SESSION['mon_current'];
                $id = $this->fw->insert();
                if ($id >= 1) {
                    echo "yes|".$id;
                    die();
                } else {
                    echo 'no';
                    die();
                }
            } else {
                echo 'قم بفتح حساب شهر جديد...!';
                die();
            }
        }
        $this->template->render('fwater/show');
    }

    function allAction() {
        $this->template->render('fwater/all');
    }

    function zaptAction() {
        $this->template->render('fwater/zapt');
    }

    function show_detAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                $i = 1;
                $data = DetailsModel::getAllDataby_mon_current_table_colm_and_id('fw_id', $_POST['id']);
                echo

                '<table border="1"  class="table" style="width: 95%">
                <tr>
                    <th style="background-color: #cccccc">التحكم</th>
                    <th style="background-color: #cccccc">المبلغ  </th>
                    <th style="background-color: #cccccc">العدد </th>
                    <th style="background-color: #ff9900"> النوع </th>
                    <th style="width: 3%; background-color: #cccccc" >#</th>
                </tr>';
                foreach ($data as $dett) {
                    echo'<tr>
                    <td style="width: 15% "><a onclick="delete_det(' . $dett['det_id'] . ')" class="btn btn-danger">حذف</a></td>
                    <td >' . $dett['det_cost'] . '</td>
                    <td>' . $dett['det_count'] . '</td>
                    <td >' . $dett['det_type'] . '</td>
                    <td >' . $i++ . '</td>
                </tr>';
                }
                echo '</table>';
            }
        } else {
            echo 'قم بفتح حساب شهر جديد...!';
            die();
        }
    }

    function delete_spcAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->spc->delete($_POST['id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function delete_detAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data_before_delete = DetailsModel::getAllDataby_mon_current_table_colm_and_id('det_id', $_POST['id']);
            if ($this->det->delete($_POST['id']) >= 1) {
                $data_after_delete = DetailsModel::getAllDataby_mon_current_table_colm_and_id('fw_id', $data_before_delete[0]['fw_id']);
                if (empty($data_after_delete)) {
                    $this->fw->
                            delete($data_before_delete[0]['fw_id']);
                }
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function add_detAction() {
        if (strtolower($_SERVER ['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {

                $this->det->fw_id = $_POST['fw_id'];
                $this->det->det_cost = $_POST['det_cost'];
                $this->det
                        ->det_count = $_POST['det_count'];
                $this->det->det_type = $_POST['det_type'];
                $this->det->mon_current = $_SESSION['mon_current'];
                if ($this->det->insert() >= 1) {
                    echo 'yes';
                    die();
                } else {
                    echo 'no';
                    die();
                }
            }
        } else {
            echo 'قم بفتح حساب شهر جديد...!';
            die();
        }
    }

    function specialAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                $this->spc->spc_type = $_POST['spc_type'];
                $this->spc->spc_cost = $_POST['spc_cost'];
                $this->spc->spc_count = $_POST['spc_count'];
                $this->spc->spc_date = $_POST['spc_date'];
                $this->spc->z_name = $_POST['z_name'];
                $this->spc->mon_current = $_SESSION['mon_current'];
                if ($this->spc->insert() >= 1) {
                    echo 'yes';

                    die();
                } else {
                    echo 'no';
                    die();
                }
            } else {
                echo 'قم بفتح حساب شهر جديد...!';
                die();
            }
        }
        $this->template->render('fwater/special');
    }

    function show_spcAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                $date = date("Y-m-d", $_POST['date']);
                echo '    <table border="1"  class="table" style="width: 95%">
                <tr>
                    <th style="background-color: #cccccc">التحكم</th>
                    <th style="background-color: #ff9900">الضابط  </th>
                    <th style="background-color: #cccccc">المبلغ  </th>                    
                    <th style="background-color: #cccccc">العدد </th>
                    <th style="background-color: #ff9900"> النوع </th>
                    <th style="width: 3%; background-color: #cccccc" >#</th>
                </tr>'

                ;
                $spc_data = SpecialModel::get_All_data_by_mon_current_and_date($date);
                $i = 1;
                foreach ($spc_data as $spc) {
                    echo ' <tr>
                    <td style="width: 15% "><a onclick="delete_spc(' . $spc['spc_id'] . ')" class="btn btn-danger">حذف</a>
                    </td>
                    <td>' . $spc['z_name'] . '</td>
                    <td>' . $spc['spc_cost'] .
                    '</td>
                    <td>' . $spc['spc_count'] . '</td>
                    <td>' . $spc['spc_type'] . '</td>
                    <td>' . $i++ . '</td>

                </tr>
                ';
                }
                echo '</table>';
            } else {
                echo 'قم بفتح حساب شهر جديد...!';
                die();
            }
        }
    }

}

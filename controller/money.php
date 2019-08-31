<?php

class money {

    private $template;
    private $to;
    private $from;
    private $mon;

    public function __construct() {
        $this->template = new Template();
        $this->from = new FromModel();
        $this->to = new ToModel();
        $this->mon = new MonthModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        $this->template->render("money/show");
    }

    function calcAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                $this->to->mon_current = $_SESSION['mon_current'];
                $this->to->to_date = date("Y-m-d");
                if (!empty(GoodsModel::get_order_sum('go_cost')['sum'])) {
                    $g = GoodsModel::get_order_sum('go_cost')['sum'];
                } else {
                    $g = 0;
                }
                $this->to->to_goods = $g;
                if (!empty(NsryatModel::get_order_sum('nsr_cost')['sum'])) {
                    $n = NsryatModel::get_order_sum('nsr_cost')['sum'];
                } else {
                    $n = 0;
                }
                $this->to->to_nsryat = $n;
                if (!empty(Ms7obatModel::get_order_sum('ms7_cost')['sum'])) {
                    $m = Ms7obatModel::get_order_sum('ms7_cost')['sum'];
                } else {
                    $m = 0;
                }
                
                $this->to->to_ms7obat = $m;
                if (!empty(SpecialModel::get_order_sum('spc_cost')['sum'])) {
                    $s = SpecialModel::get_order_sum('spc_cost')['sum'];
                } else {
                    $s = 0;
                }
                $this->to->to_special = $s;
                $this->to->to_other = 0;
                $this->to->insert();
                $this->from->mon_current = $_SESSION['mon_current'];
                $this->from->from_date = date("Y-m-d");
                if (!empty(DetailsModel::get_order_sum('det_cost')['sum'])) {
                    $d = DetailsModel::get_order_sum('det_cost')['sum'];
                } else {
                    $d = 0;
                }
                $this->from->from_fwater = $d;
                if (!empty(GoodsModel::get_goods_last_month_by_mon_current()[0]['sum'])) {
                    $last = GoodsModel::get_goods_last_month_by_mon_current()[0]['sum'];
                } else {
                    $last = 0;
                }
                $this->from->from_goods = $last;
                
                $this->from->from_other = 0;
                $this->from->insert();
                $data = MonthModel::getAllDataby_mon_current()[0];
                $this->mon->mon_askry = $data['mon_askry'];
                $this->mon->mon_current = $data['mon_current'];
                $this->mon->mon_date = $data['mon_date'];
                $this->mon->mon_zapt = $data['mon_zapt'];
                $this->mon->mon_role = 1;
                $this->mon->update($data['mon_id']);
                $_SESSION['last_mon_current'] = $_SESSION['mon_current'];
                unset($_SESSION['mon_current']);
            }
        } else {
            echo 'قم بفتح حساب شهر جديد...!';
            die();
        }
    }

    function other_toAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = ToModel::getAllDataby_id('to_id', $_POST['to_id'])[0];
            $this->to->mon_current = $data['mon_current'];
            $this->to->to_date = $data['to_date'];
            $this->to->to_goods = $data['to_goods'];
            $this->to->to_ms7obat = $data['to_ms7obat'];
            $this->to->to_special = $data['to_special'];
            $this->to->to_nsryat = $data['to_nsryat'];
            $this->to->to_other = ($data['to_other'] + $_POST['to_other']);
            if ($this->to->update($_POST['to_id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function other_fromAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = FromModel::getAllDataby_id('from_id', $_POST['from_id'])[0];
            $this->from->mon_current = $data['mon_current'];
            $this->from->from_date = $data['from_date'];
            $this->from->from_goods = $data['from_goods'];
            $this->from->from_fwater = $data['from_fwater'];
            $this->from->from_other = ($data['from_other'] + $_POST['from_other']);
            if ($this->from->update($_POST['from_id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function special_monAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_SESSION['last_mon_current'] = $_POST['spc_mon'];
            echo $_SESSION['last_mon_current'];
        }
    }

}

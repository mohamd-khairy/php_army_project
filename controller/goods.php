<?php

class goods {

    private $template;
    private $go;

    public function __construct() {
        $this->template = new Template();
        $this->go = new GoodsModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] !=0) {
                $this->go->go_type = $_POST['go_type'];
                $this->go->go_cost = $_POST['go_cost'];
                $this->go->go_count = $_POST['go_count'];
                $this->go->go_date = $_POST['go_date'];
                $this->go->mon_current = $_SESSION['mon_current'];
                if ($this->go->insert() >= 1) {
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
        $this->template->render('goods/show');
    }

    function deleteAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->go->delete($_POST['id']) >= 1) {
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
            $data = GoodsModel::getAllDataby_mon_current_table_colm_and_id('go_id', $_POST['id']);
            echo implode(',', $data[0]);
        }
    }

    function updateAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->go->go_type = $_POST['go_type'];
            $this->go->go_cost = $_POST['go_cost'];
            $this->go->go_count = $_POST['go_count'];
            $this->go->go_date = $_POST['go_date'];
            $this->go->mon_current = $_POST['mon_current'];
            if ($this->go->update($_POST['go_id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function allAction() {
        $this->template->render('goods/all');
    }

}

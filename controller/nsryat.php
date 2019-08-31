<?php

class nsryat {

    private $template;
    private $nsr;

    public function __construct() {
        $this->template = new Template();
        $this->nsr = new NsryatModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] !=0) {
                $this->nsr->nsr_type = $_POST['nsr_type'];
                $this->nsr->nsr_cost = $_POST['nsr_cost'];
                $this->nsr->nsr_count = $_POST['nsr_count'];
                $this->nsr->nsr_date = $_POST['nsr_date'];
                $this->nsr->mon_current = $_SESSION['mon_current'];
                if ($this->nsr->insert() >= 1) {
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
        $this->template->render('nsryat/show');
    }

    function deleteAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->nsr->delete($_POST['id']) >= 1) {
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
            $data = NsryatModel::getAllDataby_mon_current_table_colm_and_id('nsr_id', $_POST['id']);
            echo implode(',', $data[0]);
        }
    }

    function updateAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->nsr->nsr_type = $_POST['nsr_type'];
            $this->nsr->nsr_cost = $_POST['nsr_cost'];
            $this->nsr->nsr_count = $_POST['nsr_count'];
            $this->nsr->nsr_date = $_POST['nsr_date'];
            $this->nsr->mon_current = $_POST['mon_current'];
            if ($this->nsr->update($_POST['nsr_id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function allAction() {
        $this->template->render('nsryat/all');
    }

}

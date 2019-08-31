<?php

class Asakr {

    private $template;
    private $asakr;

    public function __construct() {
        $this->template = new Template();
        $this->asakr = new AsakrModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->asakr->a_name = $_POST['a_name'];
            $this->asakr->a_mobile = $_POST['a_mobile'];
            $this->asakr->a_address = $_POST['a_address'];
            $this->asakr->a_degree = $_POST['a_degree'];
            $this->asakr->a_date = $_POST['a_date'];
            if ($this->asakr->insert() >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
        $this->template->render('asakr/show');
    }

    function deleteAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->asakr->delete($_POST['id']) >= 1) {
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
            $data = AsakrModel::getAllDataby_table_colm_and_id('a_id', $_POST['id']);
            echo implode(',', $data[0]);
        }
    }

    function updateAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->asakr->a_name = $_POST['a_name'];
            $this->asakr->a_mobile = $_POST['a_mobile'];
            $this->asakr->a_address = $_POST['a_address'];
            $this->asakr->a_degree = $_POST['a_degree'];
            $this->asakr->a_date = $_POST['a_date'];
            if ($this->asakr->update($_POST['a_id']) >= 1) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function allAction() {
        $this->template->render('asakr/all');
    }

}

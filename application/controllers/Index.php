<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct("Index");
    }

    function home(){

        $this->load->model(array("module_model"));
        $this->data["category"] = $this->module_model->category();
        $this->data["menu"] = $this->module_model->menu();
        $this->data["module"] = $this->module_model->run("home");
        $this->data["meta"] =array("title"=>"Home","description"=>"Home","image"=>"image");
        $this->data["home"]=true;
        $this->data["product"]=$this->model->index();
        $this->load->view( THEME."/header");
        $this->load->view( THEME."/index/home");
        $this->load->view(THEME."/footer");
    }



}

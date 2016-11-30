<?php

class Index_controller extends Controller {

	function __construct() {
		parent::__construct();
	}

        public function getIndex(){
            Request::setHeader(202,"text/html");
            echo "Caixa Mágica API v.1.0.0";
        }

        public function postIndex(){
        }

				public function putIndex(){
        }

				public function deleteIndex(){
        }

}

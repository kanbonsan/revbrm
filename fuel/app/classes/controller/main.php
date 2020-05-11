<?php

class Controller_Main extends \Fuel\Core\Controller_Template
{
	public $template = 'template';
	private $indenter = true;
	
	public function before(){
        parent::before();
        
        $this->template->title = 'BRMTOOLアシスト';

        $this->template->header = View::forge('header', array('version'=>'v2.6.1'));

        $this->template->footer = View::forge('footer');
        
    }
	
	public function Action_Index(){
		echo "HELLO";
	}
}

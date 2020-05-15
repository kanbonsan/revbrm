<?php

class Controller_Main extends \Fuel\Core\Controller_Template
{
	public $template = 'template';
	private $indenter = true;
	
	public function before(){
        parent::before();
        
        $this->template->title = 'BRMTOOLアシスト';
        $this->template->header = View::forge('header');
        $this->template->footer = View::forge('footer');
        
    }
    
    public function after($response){
        $res = parent::after($response);
        if( !$this->indenter ){ return $res; }
        $indent = new \Gajus\Dindent\Indenter();
        $body = $indent->indent($res->body());
        $res->body($body);
        return $res;
    }
	
	public function Action_Index(){

		$encoded = "mibvEqc{cY@]sF?cBqE?cEmGa|`JyDv@ovAoCcAwdHuA{BwxWVmE~aTs@gBfkPwBK~bBaDv@neGwCtCffFoDtC~nKmBr@v|A[cFvQv@{GohCVqE_`Ft@qE_X|FbD_|BxFlAozDnJpCgtD[hEggM|@vDwyEpBtCnzDfDvFnjQpBhEx~tIjAjF?H`G?y@fD?";
		
		$paths = \kanbonsan\PolylineExpansion::decode($encoded);
		
		DEBUG::dump($paths);
		
	}
}

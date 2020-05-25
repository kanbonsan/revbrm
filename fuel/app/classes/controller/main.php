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
	
	public function Action_Index()
	{
		$this->template->main = View::forge('form/uketsuke');
	}

	public function Action_Confirm(){
		
		$config = array(
			'max_size' => 10 * 1024 * 1024,	// 10Mb
			'ext_whitelist' => array('brm', 'brz', 'gz', 'xls', 'xlsx'),
			'path' => APPPATH . '/brmfiles',
			'randomize'=>true,
		);
		
		Upload::process( $config );
		
		$val = Validation::forge();
		$val->add('brmname', 'ブルベ名')
			->add_rule('trim')
			->add_rule('required');
		
		if($val->run()){
		
			Debug::dump($val->error());
		} else {
			$this->template->main = View::forge('form/uketsuke');
			//$this->template->main->set_safe('html_error', $val->show_errors());
			Debug::dump($val->error_message());
		}
		
		
//		
//		if( Upload::is_valid()){
//			$this->template->main = 'confirmed';
//			Upload::save();
//			Debug::dump( Upload::get_files());
//		} else {
//			$this->template->main = 'bad files';
//		}
	}
	
	public function Action_Download(){
		
		
		
	}
	
	public function Action_EncodeTest(){
		
		$encoded = "mibvEqc{cY@]sF?cBqE?cEmGa|`JyDv@ovAoCcAwdHuA{BwxWVmE~aTs@gBfkPwBK~bBaDv@neGwCtCffFoDtC~nKmBr@v|A[cFvQv@{GohCVqE_`Ft@qE_X|FbD_|BxFlAozDnJpCgtD[hEggM|@vDwyEpBtCnzDfDvFnjQpBhEx~tIjAjF?H`G?y@fD?";
		
		$decoded = Kanbonsan\Polyline\Polyline::decode( $encoded );
		Debug::dump( Kanbonsan\Polyline\Polyline::pair($decoded) );
		
		echo "HELLO SHUICHI";
	}
	
	public function Action_SessionTest(){
		
		Debug::dump( Session::instance() );
		
		$this->template->main = "SessionTest";
		
	}
	
}

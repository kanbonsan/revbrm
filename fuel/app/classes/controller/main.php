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
		
		if(! Security::check_token() && false){
			throw new HttpInvalidInputException('ページ遷移が違います.');
		}
		
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
		
		if(! $val->run()){
		
			$this->template->main = View::forge('form/uketsuke');
			$this->template->main->set_safe('html_error', $val->show_errors());

		}
		
		if( Upload::is_valid()){
			$this->template->main = 'confirmed';
			Upload::save();
			$info = Upload::get_files();
			// Debug::dump( $info );
			
			$brm = json_decode( Model_Brmfile::read( $info[0]["saved_to"].$info[0]['saved_as'], $info[0]['extension']));
            Debug::dump( $brm );
			// $rev = Model_Brmfile::reverse( $brm );
			
		} else {
			$this->template->main = 'bad files';
		}
	}
	
	public function Action_Download(){
		
		$response = Response::forge("aaa");
		return $response;
	}
	
	public function Action_EncodeTest(){
		
		$encoded = "mibvEqc{cY@]sF?cBqE?cEmGa|`JyDv@ovAoCcAwdHuA{BwxWVmE~aTs@gBfkPwBK~bBaDv@neGwCtCffFoDtC~nKmBr@v|A[cFvQv@{GohCVqE_`Ft@qE_X|FbD_|BxFlAozDnJpCgtD[hEggM|@vDwyEpBtCnzDfDvFnjQpBhEx~tIjAjF?H`G?y@fD?";
		
		$decoded = Kanbonsan\Polyline\Polyline::decode( $encoded );
		Debug::dump( Kanbonsan\Polyline\Polyline::pair($decoded) );
		
		echo "HELLO SHUICHI";
	}
    
    public function Action_ConfigTest(){
        
        Config::load( 'revbrm', true );
        $this->template->main = '<div>'.Config::get('revbrm.test').'</div>';
    }
    
    
	
	public function Action_SessionTest(){
		
		Debug::dump( Session::instance() );
		
		$this->template->main = "SessionTest";
		
	}
	
    public function Action_DatTest(){
        
        $brm = array(
            'id'=>'brmid',
            'brmName'=>'Hello Brm'
        );
        
        Debug::dump( json_decode( json_encode( $brm )));
        return new Response("aaa");
        
    }
    
    
    
}

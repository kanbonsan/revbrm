<?php
/**
 * エラーコントローラー
 * 「はじめてのフレームワークとしてのFuelPHP」p.287
 */
class Controller_Error extends Controller_Template
{
    public $template='template';
    
    public function before(){
        parent::before();
        $this->template->title = 'BRMTOOLアシスト';
        $this->template->header = View::forge('header');
        $this->template->footer = View::forge('footer');
	}
	
	public function action_invalid( $message = null)
	{
		if( $message === null)
		{
			$this->template->main = 'Invalid input data';
		}
		else
		{
			$this->template->main = e($message);
		}
	}
}


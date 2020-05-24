<?php
/**
 * 不正入力時用 exception
 * 「はじめてのフレームワークとしてのFuelPHP」 p286
 * @author USER
 */
class HttpInvalidInputException extends HttpException
{
	public function response()
	{
		$response = \Fuel\Core\Request::forge('error/invalid')
			-> execute( array( $this->getMessage()))
			-> response();
		return $response;
	}
}

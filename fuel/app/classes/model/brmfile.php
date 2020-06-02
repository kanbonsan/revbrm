<?php

/**
 * Description of brmfile
 *
 * @author dell
 */

class Model_Brmfile extends Model {
    
    public static function read( $brmfile, $ext ){
        
        if( ! file_exists( $brmfile) ){
			return false;
		}
		
		if( $ext == "gz" || $ext == "brz" ){	// gzip圧縮
            
			return gzdecode( file_get_contents( $brmfile ));
		} else {
			return file_get_contents( $brmfile );
		}
    }
	
	/**
	 * ブルベ情報の生jsonを解析する
	 * @param type $brm
	 */
	public static function brminfo( $brm){
		return print_r( $brm, true );
	}
	
	
	public static function reverse( $brm_data ) {
       
       $rev = array();
       
   }
   
   public static function output( $brm_data ){
	   
	   return array(
		   'id' => floor(microtime(true)),	'新しいID'
		   'brmName' => '',
		   'brmDistance' => '',
		   'brmDate' => '',
		   'brmStartTime' => array(),
		   'brmCurrentStartTime' => '',
		   'encodedPathAlt'=> '',
		   'cueLength' => '',
		   'points'=>array(),
		   'exclude'=>array(),
		   'display'=>array()
	   );
	   
   }
   
}
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
	
    
}
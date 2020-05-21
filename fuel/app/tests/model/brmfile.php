<?php

/**
 * BRMTOOLの全情報の詰まった.brm形式のファイルの読み込み
 *
 * @author Shuichi Tanaka <shu.at.kantaro.org@gmail.com>
 */

class Model_Brmfile extends Model {
    
    public static function is_exist($brm) {

        $extensions = ['brm', 'brz', 'brm.gz'];
        $directories = ['.', 'share'];

        foreach ($directories as $dir) {

            foreach ($extensions as $ext) {

                $path = strtolower(APPPATH . "brmfiles/$dir/$brm.$ext");

                if (file_exists($path)) {
                    return array('path' => $path, 'ext' => $ext);
                }
            }
        }
        return false;
    }

    public static function read( $brm ){
        
        if( self::is_exist( $brm ) ){
            
            $file = self::is_exist($brm);
            
			// ファイル更新日をリフレッシュする
            touch($file['path']);
            
            if( $file['ext']=='brm'){
                return file_get_contents( $file['path'] );
            } else {
                return gzdecode( file_get_contents( $file['path'] ));
            }
            
        } else {
            return false;
        }
    }
    
}
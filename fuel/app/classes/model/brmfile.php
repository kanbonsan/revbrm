<?php

/**
 * Description of brmfile
 *
 * @author dell
 */

class Model_Brmfile extends Model {
    
	/**
	 * ローカルに保存された brmfile を読み込む。brmfile は BRMTOOL によって出力されたデータを json_encode したものと、それを gzip で固めたもの。
	 * 
	 * @param string $brmfile brmfile のファイル名（拡張子を含む）
	 * @param string $ext 上記ファイルの拡張子（ファイル形式）
	 * @return array json_decoded された brmfile の内容。配列で返す。$brm と表す。
	 */
	public static function read( $brmfile, $ext ){
        
        if( ! file_exists( $brmfile) ){
			return false;
		}
		
		if( $ext == "gz" || $ext == "brz" ){	// gzip圧縮
            
			return json_decode( gzdecode( file_get_contents( $brmfile )), true);
		} else {
			return json_decode(file_get_contents( $brmfile ), true);
		}
    }
	
	/**
	 * brmfile データを分解する
	 * @param array $brm json_decode されたデータ
	 * @return array 各項目を分解した配列 $brm_data と表す
	 *		'info' => ブルベ情報
	 *		'points' => (array) 各ポイント情報
	 *		'cues' => (array) pointsからキューポイントを抜き出したもの
	 *		'exclude' => (array) 除外区間情報
	 *		'display' => (array) ストリートビュー用のパラメーター
	 */
    public static function disassemble($brm)
	{

		$info = array(
			'id' => $brm['id'],
			'brmName' => $brm['brmName'],
			'brmDate' => $brm['brmDate'],
			'brmDistance' => $brm['brmDistance'],
			'brmStartTime' => $brm['brmStartTime'],
			'brmCurrentStartTime' => $brm['brmCurrentStartTime'],
			'encodedPathAlt' => $brm['encodedPathAlt'],
		);
		$points = array();
		$cues = array();

		foreach ($brm['points'] as $idx => $pt)
		{
			$points[] = $pt;
			if ($pt['cue'])
			{
				$pt['cue']['ptidx'] = $idx;
				$cues[] = $pt['cue'];
			}
		}
        
        $exclude = $brm['exclude'];
        $display = $brm['display'];

		return array(
			'info' => $info,
			'points' => $points,
			'cues' => $cues,
            'exclude' => $exclude,
            'display' => $display,
		);
	}

	public static function reverse( $brm_data ) {
       
		
		$info = $brm_data['info'];
		$points = $brm_data['points'];
		$cues = $brm_data['cues'];
		$exclude = $brm_data['exclude'];
		$display = $brm_data['display'];
		$rev = array(
		   'encodedPathAlt' => Kanbonsan\Polyline\Polyline::reverse( $info['encodedPathAlt']),
	   );
       
	   
	   return $rev;
   }
   /**
    * 分解したブルベデータを brmfile にするために集める
    * @param type $brm_data
    * @param type $brandnew
    * @return type
    */
   public static function assemble($brm_data, $brandnew = true)
	{

		$info = $brm_data['info'];
		$points = $brm_data['points'];
		$cues = $brm_data['cues'];
		$exclude = $brm_data['exclude'];
		$display = $brm_data['display'];

		return array(
			'id' => $brandnew ? floor(microtime(true)) : $info['id'], // '新しいID'
			'brmName' => $info['brmName'],
			'brmDistance' => $info['brmDistance'],
			'brmDate' => $info['brmDate'],
			'brmStartTime' => $info['brmStartTime'],
			'brmCurrentStartTime' => $info['brmCurrentStartTime'],
			'encodedPathAlt' => $info['encodedPathAlt'],
			'cueLength' => count($cues),
			'points' => $points,
			'exclude' => $exclude,
			'display' => $display
		);
	}

}

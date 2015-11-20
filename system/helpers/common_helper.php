<?php
/**
 * 公共函数
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @param $string 要加密或解决的字符串
 * @param $operation 加密/解密 ENCODE加密, DECODE 解密
 * @param $key 加密/解决因子
*/
function authcode($string, $operation = 'DECODE', $key = 'lin3615?', $expiry = 0) 
{	
			$ckey_length = 4;
			$key  = md5($key);
			$keya = md5(substr($key, 0, 16));
			$keyb = md5(substr($key, 16, 16));
			$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

			$cryptkey = $keya.md5($keya.$keyc);
			$key_length = strlen($cryptkey);

			$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
			$string_length = strlen($string);

			$result = '';
			$box = range(0, 255);

			$rndkey = array();
			for($i = 0; $i <= 255; $i++) {
					$rndkey[$i] = ord($cryptkey[$i % $key_length]);
			}
			for($j = $i = 0; $i < 256; $i++) {
					$j = ($j + $box[$i] + $rndkey[$i]) % 256;
					$tmp = $box[$i];
					$box[$i] = $box[$j];
					$box[$j] = $tmp;
			}
			for($a = $j = $i = 0; $i < $string_length; $i++) {
					$a = ($a + 1) % 256;
					$j = ($j + $box[$a]) % 256;
					$tmp = $box[$a];
					$box[$a] = $box[$j];
					$box[$j] = $tmp;
					$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
			}

			if($operation == 'DECODE') {
					if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
							return substr($result, 26);
					} else {
							return '';
					}
			} else {
					return $keyc.str_replace('=', '', base64_encode($result));
			}
	}
	
	// 单文件上传
	function fileUpload($filename)
	{
		$fileName = '';
		$arr = array('.jpg','.jpeg','.png','.gif','.bmp');
		if($filename['name'])
		{
			if(is_uploaded_file($filename['tmp_name'])){
				if($filename['error'] == 0){
					$picname_ext = stristr($filename['name'], '.');
					if(!in_array(strtolower($picname_ext), $arr))
					{
						exit('文件只能上传格式为jpg,jpeg,png,.gif,bmp');
					}
					$picname = '../app/images/' . date('YmdHis', time()) . '_' . rand(0,99999) . $picname_ext;
					if(!move_uploaded_file($filename['tmp_name'], $picname)){
						echo '上传失败，不能转移文件到相应的文件';
						exit;
					}
					$fileName = $picname;
				}else if($filename['error'] == 1){
					echo '上传文件超过php.ini中的最大大小'; exit;
				}else if($filename['error'] == 2){
					echo '上传文件大小超过 html表单中的大小'; exit;
				}else if($filename['error'] == 3){
					echo '文件只有部分上传';exit;
				}else if($filename['error'] == 4){
					echo '没有文件被上传';exit;
				}else if($filename['error'] == 6){
					echo '找不到临时文件夹';exit;
				}else{
					echo '文件写入失败!';exit;
				}
			}
		}
		return substr($fileName, 7);
	}

// 向下兼容，防止没有开启
if(!function_exists('mb_substr'))
{
    function mb_substr($str,  $start, $length)
    {
        return substr_cut($str, $length);
    }
    
}
// 截取字符串，防止乱码
function substr_cut($str_cut,$length)
{
    if (strlen($str_cut) > $length)
    {
        for($i=0; $i < $length; $i++)
        if (ord($str_cut[$i]) > 128)    $i+=2;
        $str_cut = substr($str_cut,0,$i)."..";
    }
    return $str_cut;
}

// 过滤 html标签，增加安全转义
function strip_addslashe($str)
{
		return addslashes(strip_tags($str));
}

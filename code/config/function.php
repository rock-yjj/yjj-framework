<?php

/**
 * uuid 生成UUID
 *
 * @access public
 * @return void
 */
function uuid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 
        mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF), 
        mt_rand(0, 0xFFFF), 
        mt_rand(0, 0x0FFF) | 0x4000, 
        mt_rand(0, 0x3FFF) | 0x8000, 
        mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF)
    );
}

/**
 * 设置首字母大写
 * @param string $str
 */
function firstToBig($str) {
    return ucfirst(strtolower($str));
}

/**
 * 字符过滤
 */
function escape($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES);
}

/**
 * sescape 转义“\”“'”
 * 
 * @param mixed $string 
 * @access public
 * @return void
 */
function sescape($string) {
    $string = str_replace('\\', '\\\\', $string);
    return str_replace('\'', '\\\'', $string);
}

/**
 * DISCUZ加密函数
 * 参数解释   
 * $string： 明文 或 密文   
 * $operation：DECODE表示解密,其它表示加密   
 * $key： 密匙   
 * $expiry：密文有效期 
 */  
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {   
    // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙   
    $ckey_length = 4;   
       
    // 密匙   
    $key = md5($key ? $key : $GLOBALS['discuz_auth_key']);   
       
    // 密匙a会参与加解密   
    $keya = md5(substr($key, 0, 16));   
    // 密匙b会用来做数据完整性验证   
    $keyb = md5(substr($key, 16, 16));   
    // 密匙c用于变化生成的密文   
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';   
    // 参与运算的密匙   
    $cryptkey = $keya.md5($keya.$keyc);   
    $key_length = strlen($cryptkey);   
    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性   
    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确   
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;   
    $string_length = strlen($string);   
    $result = '';   
    $box = range(0, 255);   
    $rndkey = array();   
    // 产生密匙簿   
    for($i = 0; $i <= 255; $i++) {   
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);   
    }   
    // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度   
    for($j = $i = 0; $i < 256; $i++) {   
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;   
        $tmp = $box[$i];   
        $box[$i] = $box[$j];   
        $box[$j] = $tmp;   
    }   
    // 核心加解密部分   
    for($a = $j = $i = 0; $i < $string_length; $i++) {   
        $a = ($a + 1) % 256;   
        $j = ($j + $box[$a]) % 256;   
        $tmp = $box[$a];   
        $box[$a] = $box[$j];   
        $box[$j] = $tmp;   
        // 从密匙簿得出密匙进行异或，再转成字符   
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));   
    }   
    if($operation == 'DECODE') {   
        // substr($result, 0, 10) == 0 验证数据有效性   
        // substr($result, 0, 10) - time() > 0 验证数据有效性   
        // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性   
        // 验证数据有效性，请看未加密明文的格式   
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {   
            return substr($result, 26);   
        } else {   
            return '';   
        }   
    } else {   
        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因   
        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码   
        return $keyc.str_replace('=', '', base64_encode($result));   
    }   
}

/**
 * uploadFile上传文件
 * 
 * @param mixed $file 
 * @param mixed $dir 
 * @param mixed $savename 
 * @param mixed $file_destination 
 * @access public
 * @return void
 */
function uploadFile($file = null, $dir = null, $savename = null, $file_destination = null) {
    if (null === $dir) throw new Exception('DIR IS NULL');
    if (null === $file) throw new Exception('NAME IS NULL');
    if (null === $savename) throw new Exception ('FILE NAME IS NULL');
    if ($file_destination === null) {
        $file_destination = date('Y-m', time());
    }
    $save_dir = $dir . '/' . $file_destination;
    if (!is_dir($save_dir)) {
        if (!mkdir($save_dir, 0755)) {
            throw new Exception ('CREATE DIR FAIL');
        }
    }
    $upfile = $file;
    $name = $upfile['name'];
    $type = $upfile['type'];
    $size = $upfile['size'];
    $tmp_name = $upfile['tmp_name'];
    $error = $upfile['error'];
    $path_info = pathinfo($name);
    $ok = false;
    
    //获取文件后缀
    $file_extension = strtolower($path_info['extension']); 

    //设置允许的文件后缀
    switch ($file_extension) {
        case 'jpg' : $ok = true; break;
        case 'jpeg': $ok = true; break;
        case 'png' : $ok = true; break;
        case 'gif' : $ok = true; break;
        case 'swf' : $ok = true; break;
        case 'bmp' : $ok = true; break;
        case 'rar' : $ok = true; break;
        case 'zip' : $ok = true; break;
        case 'pdf' : $ok = true; break;
        case 'docx' : $ok = true; break;
        case 'xlsx' : $ok = true; break;
        case 'xls' : $ok = true; break;
        case 'doc' : $ok = true; break;
        case 'ppt' : $ok = true; break;
    }

    if (!$ok) {
        return false;
    }
    if (!empty($error)) {
        throw new Exception ($error);
    }

    $ext_list = array('jpg', 'jpeg', 'png', 'gif', 'swf', 'bmp', 'rar', 'zip', 'pdf', 'docx', 'xlsx', 'xls', 'doc', 'ppt', $path_info['extension']);
    foreach ($ext_list as $v) {
        $current_file_dir = $save_dir . '/' . $savename . '.' . $v;
        if (file_exists($current_file_dir)) {
            unlink($current_file_dir);//先删除
        }
    }
    
    $save_file_dir = $save_dir . '/' . $savename . '.' . $path_info['extension'];
    if (move_uploaded_file($tmp_name, $save_file_dir)) {
        if (!in_array($path_info['extension'], array('jpg', 'jpeg', 'png'))) {
            return $file_destination .'/'. $savename . '.' . $path_info['extension'];
        }
        $thumb_dir = $save_dir . '/thumb_' . $savename . '.' . $path_info['extension'];
        thumbnail($save_file_dir, $thumb_dir);
        $thumb_index_dir = $save_dir . '/index_thumb_' . $savename . '.' . $path_info['extension'];
        thumbnail($save_file_dir, $thumb_index_dir, 209, 138);
        chmod($save_file_dir, 0644);
        return $file_destination .'/'. $savename . '.' . $path_info['extension'];
    }
    return false;
}

/**
 * thumbnail 缩略图 
 * 
 * @param mixed $oldpic 
 * @param mixed $newpic 
 * @param int $maxwidth 
 * @param int $maxheight 
 * @access public
 * @return void
 */
function thumbnail($oldpic,$newpic,$maxwidth=280,$maxheight=214){
    $pathpic = (pathinfo(strtolower($oldpic)));
    if( $pathpic['extension']=='jpg' ){
	  	  $im = imagecreatefromjpeg($oldpic);
    }elseif( $pathpic['extension']=='png'){
		    $im = imagecreatefrompng($oldpic);
    }elseif( $pathpic['extension']=='gif' ){
		    $im = imagecreatefromgif($oldpic);
    }elseif( $pathpic['extension']=='bmp' ){
		    $im = imagecreatefromwbmp($oldpic);
    }else{
        return false;
		    //die("图片格式不对$oldpic");
    }
    $width = imagesx($im);
    $height = imagesy($im);

    if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)){
        if($maxwidth && $width > $maxwidth){
            $widthratio = $maxwidth/$width;
            $RESIZEWIDTH=true;
        }else{
            ImageJpeg ($im,$newpic);
            ImageDestroy ($im);
            //die("缩略图的宽要小于原图片的宽");
            return true;
        }
        if($maxheight && $height > $maxheight){
            $heightratio = $maxheight/$height;
            $RESIZEHEIGHT=true;
        }else{
            ImageJpeg ($im,$newpic);
            ImageDestroy ($im);
            return true;
            //die("缩略图的高要小于原图片的高");
        }
        if($RESIZEWIDTH && $RESIZEHEIGHT){
            if($widthratio > $heightratio){
                $ratio = $widthratio;
            }else{
                $ratio = $heightratio;
            }
        }elseif($RESIZEWIDTH){
            $ratio = $widthratio;
        }elseif($RESIZEHEIGHT){
            $ratio = $heightratio;
        }
        
        $newwidth = $width * $ratio;
        $newheight = $height * $ratio;
        if(function_exists("imagecopyresampled")){
            $newim = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        }else{
            $newim = imagecreate($newwidth, $newheight);
			//imagepstext($newim,'tryr','10','12','000000','000000',0,0,5,5,1,1);
		      	imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        }
        ImageJpeg ($newim,$newpic);
        ImageDestroy ($newim);
    }else{
        ImageJpeg ($im,$newpic);
    }
    ImageDestroy ($im);
    return true;
}

/**
 * mkdirs 创建目录
 *
 * @param mixed $list
 *
 * @access public
 * @return void
 */
function mkdirs($list) {
    $dir_str = ROOT_DIR . '/public/html';
    foreach ($list as $v) {
        $dir_str .= '/' . $v;
        if (!is_dir($dir_str)) {
            if (!mkdir($dir_str, 0755)) {
                return false;
            }
        }
    }
    return $dir_str;
}

/**
 * deleteBlank 删除页面代码中的空格
 *
 * @param mixed $str
 *
 * @access public
 * @return void
 */
function deleteBlank($str) {
    return  preg_replace('/\>\s+\</', '><', str_replace(array("\r\n", "\n", "\r", "\t", "  "), " ", $str));
}

/**
 * writeLog 记录运行日志 
 * 
 * @param string $text 
 * @access public
 * @return void
 */
function writeLog($text) {
    $dir = ROOT_DIR . '/cache/log/' . date('Y-m-d', time()) . '-log.txt';
    $handle = fopen($dir, 'a');
    $into = sprintf("PDO :: TIME:[%s] +ip:[%s] +INFO:[%s]\n", date('Y-m-d H:i:s', time()), $_SERVER['REMOTE_ADDR'], $text);
    fwrite($handle, $into);
    fclose($handle); 
}

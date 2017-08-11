<?php
	
	$fp = fopen('1.txt','w+');
	$signature = $_GET['signature'];
	$timestamp = $_GET['timestamp'];
	$nonce = $_GET['nonce'];
	$echostr = $_GET['echostr'];

	$token = 'cuithinking';

	$array = [$nonce,$timestamp,$token];

	sort($array);

	$str = sha1(implode($array));

	fwrite($fp,$timestamp.PHP_EOL);
	fwrite($fp,$nonce.PHP_EOL);
	fwrite($fp,$echostr.PHP_EOL);
	fwrite($fp,$str.PHP_EOL);
	fwrite($fp,$signature.PHP_EOL);

	if($str == $signature){
		fwrite($fp,'success'.PHP_EOL)
		echo  $str;
		exit;
	}else{
 		
		fwrite($fp,'fail'.PHP_EOL)
		echo 'fail';
		exit;	
	}
?>

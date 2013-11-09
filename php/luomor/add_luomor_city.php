<?php
	define("DEBUG", true);
	define("STARTTIME", microtime());
	$_SGLOBAL = array();
	include("MysqlUtil.class.php");
	
	$db = new MysqlUtil();
	$db -> charset = "utf8";
	$db -> connect("localhost:3306", "root", "root", "luomor");
	
	$file = fopen("city.txt", "r");
	$codeNum = 0;
	$cityNum = 0;
	$bz = 1;
	$parentId = 0;
	$longitude = "";//经度
	$latitude = "";//纬度
	$province = "";
	$city = "";
	while(!feof($file)) {
		$content = fgets($file);
		$array = explode(" ", $content);
		foreach($array as $key => $value) {
			if($province != $array[0]) {
				$parentId = 0;
				$province = $array[0];
				$codeNum++;
				$cityNum = 1;
			}
			$city = $array[1];
			$latitude = str_replace("北纬", "", $array[2]);
			$longitude = str_replace("东经", "", $array[3]);
		}
		if($parentId == 0) {
			if(strlen($codeNum) == 1) {
				$code = "00" . $codeNum;
			} else {
				$code = "0" . $codeNum;
			}
			$sql = "insert into luomor_city(code,name,parentId,bz,longitude,latitude,add_time) values ('$code','$province',$parentId,$bz,'$longitude','$latitude'," . time() . ")";
			$db -> query($sql);
			$parentId = $db -> insert_id();
		}
		if(strlen($codeNum) == 1) {
			$code = "00" . $codeNum;
		} else {
			$code = "0" . $codeNum;
		}
		if(strlen($cityNum) == 1) {
			$code .= "00" . $cityNum;
		} else {
			$code .= "0" . $cityNum;
		}
		$sql = "insert into luomor_city(code,name,parentId,bz,longitude,latitude,add_time) values ('$code','$city',$parentId,$bz,'$longitude','$latitude'," . time() . ")";
		$db -> query($sql);
		$cityNum++;
	}
	fclose($file);
?>
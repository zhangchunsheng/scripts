<?php
	/**
	 * 作者：peter
	 * 日期：2012-10-15
	 * 说明：update_luomor_city
	 */
	define("APP_PATH", dirname(dirname(__FILE__)));
	define("DEBUG", true);
	define("STARTTIME", microtime());
	$_SGLOBAL = array();
	include("MysqlUtil.class.php");
	/**
	 * 地址解析
	 * http://maps.googleapis.com/maps/api/geocode/json?address=%E5%BE%90%E5%B7%9E&sensor=false
	 * {
		   "results" : [
			  {
				 "address_components" : [
					{
					   "long_name" : "徐州市",
					   "short_name" : "徐州市",
					   "types" : [ "locality", "political" ]
					},
					{
					   "long_name" : "江苏省",
					   "short_name" : "江苏省",
					   "types" : [ "administrative_area_level_1", "political" ]
					},
					{
					   "long_name" : "中国",
					   "short_name" : "CN",
					   "types" : [ "country", "political" ]
					}
				 ],
				 "formatted_address" : "中国江苏省徐州市",
				 "geometry" : {
					"bounds" : {
					   "northeast" : {
						  "lat" : 34.97483150,
						  "lng" : 118.6740720
					   },
					   "southwest" : {
						  "lat" : 33.71682230,
						  "lng" : 116.36196050
					   }
					},
					"location" : {
					   "lat" : 34.204750,
					   "lng" : 117.2840670
					},
					"location_type" : "APPROXIMATE",
					"viewport" : {
					   "northeast" : {
						  "lat" : 34.43628350,
						  "lng" : 117.46255870
					   },
					   "southwest" : {
						  "lat" : 34.07996230,
						  "lng" : 116.94867970
					   }
					}
				 },
				 "types" : [ "locality", "political" ]
			  }
		   ],
		   "status" : "OK"
		}
	 * 状态代码
	 * 地址解析响应对象中的 "status" 字段包含请求的状态，并且可能包含调试信息，以帮助您追溯地址解析未正常工作的原因。"status" 字段可能包含以下值：
	 * "OK" 表示未发生错误；地址成功进行了解析并且至少传回了一个地址解析结果。
	 * "ZERO_RESULTS" 表示地址解析成功，但未返回结果。如果地址解析过程中传递的偏远位置 address 或 latlng 并不存在，则会出现 种情况。
	 * "OVER_QUERY_LIMIT" 表示您超出了配额。
	 * "REQUEST_DENIED" 表示您的请求被拒绝，通常是由于缺少 sensor 参数。
	 * "INVALID_REQUEST" 通常表示缺少查询参数（address 或 latlng）。
	 * 反向地址解析
	 */
	$db = new MysqlUtil();
	$db -> charset = "utf8";
	$db -> connect("localhost:3306", "root", "root", "luomor");
	
	if($argv[1] == "updateProvinceInfo") {
		echo "updateProvinceInfo";
		$sql = "SELECT id,code,name FROM luomor_city WHERE parentId=0 AND updatebz=1";
		$query = $db -> query($sql);
		$citys = array();
		while($row = $db -> fetch_array($query)) {
			$citys[] = $row;
		}
		foreach($citys as $key => $value) {
			$id = $value["id"];
			$code = $value["code"];
			$name = $value["name"];
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$name&sensor=false&language=zh-CN&region=cn";
			$data = json_decode(file_get_contents($url));
			if($data -> status == "OK") {
				$results = $data -> results;
				foreach($results as $key_result => $value_result) {
					if($value_result -> types[0] == "administrative_area_level_1" || $value_result -> types[0] == "locality") {
						$type = $value_result -> types[0];
						$address_components = $value_result -> address_components;
						$google_name = "";
						$long_name = "";
						$short_name = "";
						foreach($address_components as $key_address => $value_address) {
							if($value_address -> types[0] == $type) {
								$google_name = $long_name = $value_address -> long_name;
								$short_name = $value_address -> short_name;
							}
						}
						$geometry = $value_result -> geometry;
						$latitude = $geometry -> location -> lat;
						$longitude = $geometry -> location -> lng;
						$northeast_lat = "";
						$northeast_lng = "";
						$southwest_lat = "";
						$southwest_lng = "";
						if($geometry -> bounds) {
							$northeast_lat = $geometry -> bounds -> northeast -> lat;
							$northeast_lng = $geometry -> bounds -> northeast -> lng;
							$southwest_lat = $geometry -> bounds -> southwest -> lat;
							$southwest_lng = $geometry -> bounds -> southwest -> lng;
						} else {
							$northeast_lat = $geometry -> viewport -> northeast -> lat;
							$northeast_lng = $geometry -> viewport -> northeast -> lng;
							$southwest_lat = $geometry -> viewport -> southwest -> lat;
							$southwest_lng = $geometry -> viewport -> southwest -> lng;
						}
						$formatted_address = $value_result -> formatted_address;
						$updatebz = 2;
						$update_time = time();
						$sql = "update luomor_city set latitude='$latitude',longitude='$longitude',google_name='$google_name',long_name='$long_name',short_name='$short_name',
								type='$type',northeast_lat='$northeast_lat',northeast_lng='$northeast_lng',southwest_lat='$southwest_lat',southwest_lng='$southwest_lng',
								formatted_address='$formatted_address',updatebz=$updatebz,update_time=$update_time where id=$id";
						$db -> query($sql);
					} else {
						writeLog("info", $name . " " . json_encode($data));
					}
				}
			} else {
				writeLog("error", $name . " " . json_encode($data));
			}
		}
		exit();
	}
	
	$sql = "SELECT id,code,name FROM luomor_city WHERE LENGTH(CODE)=6 and updatebz=1";
	$query = $db -> query($sql);
	$citys = array();
	while($row = $db -> fetch_array($query)) {
		$citys[] = $row;
	}
	foreach($citys as $key => $value) {
		$id = $value["id"];
		$code = $value["code"];
		$name = $value["name"];
		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$name&sensor=false&language=zh-CN&region=cn";
		$data = json_decode(file_get_contents($url));
		if($data -> status == "OK") {
			$results = $data -> results;
			foreach($results as $key_result => $value_result) {
				if($value_result -> types[0] == "locality" || $value_result -> types[0] == "sublocality") {
					$type = $value_result -> types[0];
					$address_components = $value_result -> address_components;
					$google_name = "";
					$long_name = "";
					$short_name = "";
					foreach($address_components as $key_address => $value_address) {
						if($value_address -> types[0] == $type) {
							$google_name = $long_name = $value_address -> long_name;
							$short_name = $value_address -> short_name;
						}
					}
					$geometry = $value_result -> geometry;
					$latitude = $geometry -> location -> lat;
					$longitude = $geometry -> location -> lng;
					$northeast_lat = "";
					$northeast_lng = "";
					$southwest_lat = "";
					$southwest_lng = "";
					if($geometry -> bounds) {
						$northeast_lat = $geometry -> bounds -> northeast -> lat;
						$northeast_lng = $geometry -> bounds -> northeast -> lng;
						$southwest_lat = $geometry -> bounds -> southwest -> lat;
						$southwest_lng = $geometry -> bounds -> southwest -> lng;
					} else {
						$northeast_lat = $geometry -> viewport -> northeast -> lat;
						$northeast_lng = $geometry -> viewport -> northeast -> lng;
						$southwest_lat = $geometry -> viewport -> southwest -> lat;
						$southwest_lng = $geometry -> viewport -> southwest -> lng;
					}
					$formatted_address = $value_result -> formatted_address;
					$updatebz = 2;
					$update_time = time();
					$sql = "update luomor_city set latitude='$latitude',longitude='$longitude',google_name='$google_name',long_name='$long_name',short_name='$short_name',
							type='$type',northeast_lat='$northeast_lat',northeast_lng='$northeast_lng',southwest_lat='$southwest_lat',southwest_lng='$southwest_lng',
							formatted_address='$formatted_address',updatebz=$updatebz,update_time=$update_time where id=$id";
					$db -> query($sql);
				} else {
					writeLog("info", $name . " " . json_encode($data));
				}
			}
		} else {
			writeLog("error", $name . " " . json_encode($data));
		}
	}
	
	/**
	 * 写日志
	 */
	function writeLog($level, $content) {
		switch($level) {
		case "info":
			$file = fopen(APP_PATH . "/logs/luomor_info.log", "a+");
			break;
		case "error":
			$file = fopen(APP_PATH . "/logs/luomor_error.log", "a+");
			break;
		default:
			$file = fopen(APP_PATH . "/logs/luomor_info.log", "a+");
		}
		fwrite($file, date("Y-m-d H:i:s") . " " . $content . "\r\n");
		fclose($file);
	}
?>
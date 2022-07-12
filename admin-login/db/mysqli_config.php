<?php
set_time_limit(0); //將主機時間歸零
ini_set('session.gc_maxlifetime',200000);  //session 暫存存活時間
ini_set('memory_limit', '256M');//設定檔案上限
header('Content-Type:text/html; charset=utf-8'); //設定語系-中文
date_default_timezone_set('Asia/Taipei'); //設定時區-台北
if(isset($_SESSION)==false){ session_start(); } //啟動session機制


$mysqli = new mysqli('localhost','admin','12345','ebook_db');//IP位置,帳號,密碼,資料庫名稱
$mysqli->set_charset("utf8");
$mysqli->query("SET time_zone='".set_mysql_timezone()."';");

//MYSQL時區同步PHP時區
function set_mysql_timezone(){
    $now = new DateTime();
    $mins = $now->getOffset() / 60;
    $sgn = ($mins < 0 ? -1 : 1);
    $mins = abs($mins);
    $hrs = floor($mins / 60);
    $mins -= $hrs * 60;
    return sprintf('%+d:%02d', $hrs*$sgn, $mins);
 }

 function my_query($query){
    global $mysqli;
    return mysqli_query($mysqli, $query);
 }

 function my_assoc($query){
    global $mysqli;
    $size=0;
    $rst = [];
    $result=mysqli_query($mysqli,$query);
    if ($result) {
		$count = mysqli_num_rows($result);
		if ($count) {
			while ($row = mysqli_fetch_assoc($result)) {
				$rst[] = $row;
			}
			$size = sizeof($rst);
		}
	}

    return ["size"=>$size,"array"=>$rst];
}




?>
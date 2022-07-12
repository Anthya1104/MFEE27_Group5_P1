<?php
//$_GET
include("db/mysqli_config.php");

$post=$_POST;// form傳來的陣列

$check=[];
foreach($post as $key=>$rst){
    ${$key}=$rst;
    if($rst==""){
        $check[]=$key;
    }

}
$password=md5($password);

$q="select * from member where account='$account'";
$r=my_assoc($q);
if($r["size"]){
    exit("<script>alert('此帳號已經有人使用');history.go(-1)</script>");
}

//$array["欄位名稱"]="值";
$array["user_name"]=$user_name; //暱稱
$array["name"]=$name; //姓名
$array["account"]=$account; //帳號
$array["password"]=$password; //密碼
$array["email"]=$email; //信箱
$array["birthday"]=$birthday; //生日
$array["register_time"]=date("Y-m-d H:i:s"); //註冊時間

$All_keys=implode(",",array_keys($array));
$All_values=implode(",",array_map(function($a){
        if(!isset($a)) $a="";
    return json_encode($a, JSON_UNESCAPED_UNICODE);

},$array));

$insert_query="INSERT INTO member ( $All_keys ) VALUES ($All_values)";//insert語法

$mysqli->query($insert_query);

exit("<script>alert('註冊成功');location.href='member_login.php';</script>");


// UPDATE `admin` SET `status` = '1' WHERE `admin`.`id` = 1;
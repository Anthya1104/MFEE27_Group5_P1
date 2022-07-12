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
$vip=1;

$insert_query="INSERT INTO `member`(`title`, `account`, `password`, `email`,`birth`,`username`,`vip`,`sign_time`,`tel`,`address`) VALUES ('$title','$account','$password','$email','$birth','$username','$vip',NOW(),'$tel','$address')";//insert語法
$mysqli->query($insert_query);

exit("<script>alert('註冊成功');location.href='member_login.php';</script>");


// UPDATE `admin` SET `status` = '1' WHERE `admin`.`id` = 1;
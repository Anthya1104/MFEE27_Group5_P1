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
$password=md5($post["password"]); //密碼;
if(!empty($check)){
    exit("<script>alert('請填寫完所有資料');history.go(-1)</script>");
}

$q="select * from factory where account='$account'";
$r=my_assoc($q);
if($r["size"]){
    exit("<script>alert('此帳號已經有人使用');history.go(-1)</script>");
}


$insert_query="INSERT INTO `factory`(`title`, `account`, `password`, `email`,`tel`,`address`,  `sign_time`) VALUES ('$title','$account','$password','$email','$tel','$address',NOW())";//insert語法
$mysqli->query($insert_query);

exit("<script>alert('註冊成功');location.href='factory_login.php';</script>");


// UPDATE `admin` SET `status` = '1' WHERE `admin`.`id` = 1;
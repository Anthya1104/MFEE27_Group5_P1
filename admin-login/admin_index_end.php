<?php
//$_GET
include("db/mysqli_config.php");

$post=$_POST;// form傳來的陣列
$check=[];
foreach($post as $key=>$rst){
    ${$key}=$rst;
    if($rst=="" && $key!="password"){
        $check[]=$key;
    }
}
//密碼
$pass_url="";
if($password!=""){
	$password=md5($password);
	$pass_url=" ,password='$password' ";
}


if(!empty($check)){
    exit("<script>alert('請填寫完所有資料');history.go(-1)</script>");
}


$update_query="UPDATE `admin` SET status='$status',`title`='$title',`email`='$email'  $pass_url WHERE id='$id'";//update語法
$mysqli->query($update_query);

//$mysqli->query($update_query);

exit("<script>alert('修改成功');location.href='admin_list.php'</script>");


// UPDATE `admin` SET `status` = '1' WHERE `admin`.`id` = 1;
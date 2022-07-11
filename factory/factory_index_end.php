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

if(!empty($check)){
    exit("<script>alert('請填寫完所有資料');history.go(-1)</script>");
}


$update_query="UPDATE `factory` SET `title`='$title',`email`='$email',`tel`='$tel',`address`='$address' WHERE id='$id'";//update語法
$mysqli->query($update_query);

//$mysqli->query($update_query);

exit("<script>alert('修改成功');history.go(-1)</script>");


// UPDATE `admin` SET `status` = '1' WHERE `admin`.`id` = 1;
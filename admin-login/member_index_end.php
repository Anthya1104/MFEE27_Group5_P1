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
//檢查資料
if(!empty($check)){
    exit("<script>alert('請填寫完所有資料');history.go(-1)</script>");
}

//有打密碼在更新
if($password!=""){
    $array["password"]=md5($password); //密碼
}

//$array["欄位名稱"]="值";
$array["user_name"]=$user_name; //暱稱
$array["name"]=$name; //姓名
$array["email"]=$email; //信箱
$array["birthday"]=$birthday; //生日
$array["valid"]=$valid; //停權
$array["member_class"]=$member_class; //會員等級


$All_values=implode(",",array_map(function($a,$b){
    return $a."=".json_encode($b, JSON_UNESCAPED_UNICODE);
}, array_keys($array), $array));

$update_query="UPDATE `member` SET $All_values WHERE id='$id'";//update語法

$mysqli->query($update_query);
//$mysqli->query($update_query);

exit("<script>alert('修改成功');location.href='member_list.php'</script>");


// UPDATE `admin` SET `status` = '1' WHERE `admin`.`id` = 1;
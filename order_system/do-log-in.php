<?php
session_start();
require("../db-connect.php");

if(!isset($_POST["account"])){
    echo "請循正常管道進入本頁";
    exit;
}

$account=$_POST["account"];
$password=$_POST["password"];
$password=md5($password);//輸入密碼後過md5 轉成加密後的密碼(資料庫中存的內容)
// echo "$account, $password";

$sql="SELECT * FROM users WHERE account='$account' AND password = '$password'";
$result=$conn->query($sql);
$userExist=$result->num_rows;
if($userExist>0){//登入成功
// echo $userExist;
    $row=$result->fetch_assoc();
    $user=[
        "id"=>$row["id"],
        "account"=>$row["account"],
        "name"=>$row["userName"]
    ];
    unset($_SESSION["error"]);//登入成功後清除錯誤訊息
    $_SESSION["user"]=$user;
    header("location:dashboard.php");
}else{
    // echo"帳號密碼錯誤:";
    $_SESSION["error"]["message"]="帳號或密碼錯誤";

    if(!isset($_SESSION["error"]["times"])){//記錄錯誤次數
        $_SESSION["error"]["times"]=1;//!isset -> 第一次錯誤
    }else{
        $_SESSION["error"]["times"]++;//!isset ->第二次以後錯誤
    }

    header("location:log-in.php");//回到log-in.php
}

?>
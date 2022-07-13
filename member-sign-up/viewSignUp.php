<?php
if(!isset($_POST['account'])){
    echo "沒有帶資料";
    exit;
}

require("../db-connect.php");

$account=$_POST["account"];
$username=$_POST["username"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];
$now=date('Y-m-d H:i:s');

//先檢查不須進資料庫的資料操作
if(empty($account)){
    echo "沒有填account";
    exit;
}
if(empty($username)){
    echo "沒有填username";
    exit;
}
if(empty($password)){
    echo "沒有填password";
    exit;
}
if(empty($repassword)){
    echo "請再次輸入密碼";
    exit;
}
if($password != $repassword){
    echo "密碼不一致！";
    exit;
}
$password=md5($password);//密碼加密 很容易被破解 所以現在不太使用這個方法 新方法-> SHA()

//再檢查需要資料庫的資料操作
//分段檢查 -> 為了減少資料的浪費

$sql="SELECT account FROM member WHERE account='$account'";//檢查帳號是否已存在在資料庫內
$result =$conn ->query($sql); //不是單純判別true/false 所以要另外宣告一個物件儲存query($sql)撈出的資料
$userCount=$result ->num_rows; //取得rows的數量(資料筆數)

if($userCount>0){
    echo "該帳號已存在";
    exit;
}

//把密碼直接輸入資料庫非常危險 資料可以直接被第三方抓出來 所以通常會先透過加密方式處理過再回傳 e.g.md5($password); sha()
$sqlCreate="INSERT INTO member (account, user_name, password, register_time, valid) VALUES ('$account', '$username', '$password', '$now', 1)";//valid要預設設定好 -> 判斷註冊後可以使用 也可以用在使用者等級認證上


if ($conn->query($sqlCreate) === TRUE) { //query(只query一次$sql語法) 單純判斷型別有沒有存在在資料庫裡
    echo "新增資料輸入成功";
} else {
    echo "ERROR:: " .$sqlCreate."<br>". $conn->error;
}

$conn ->close();


?>


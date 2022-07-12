<?php
//$_GET
include("db/mysqli_config.php");

$post=$_POST;// form傳來的陣列

$account=$post["account"]; //廠商名稱;
$password=md5($post["password"]); //密碼;

$q="select * from member where account='$account' and password='$password' ";

$r=my_assoc($q);

if($r["size"]){

    $row=$r["array"][0];
    if($row["valid"]==0 ){

        exit("<script>alert('已停權');history.go(-1);</script>");
    }else{
		
		$id=$row["id"];
        $q="update member set login_time=NOW() where id='".$id."'";
        my_query($q);
		$_SESSION["member"]=$row;
        exit("<script>alert('登入成功');location.href='member_list.php'</script>");
		
		
		
    }
}else{

    exit("<script>alert('帳號或密碼輸入錯誤');history.go(-1);</script>");
    
}



<?php
session_start();
require("../db-connect.php");

$id=$_POST["id"];
$o_id=$_POST["o_id"];

$sql="UPDATE user_order_detail SET valid=0 WHERE 0_id='$o_id'"
;

// $_SESSION["o_id"] = $o_id;

if ($conn->query($sql) === TRUE) {
    echo "訂單刪除成功";
} else {
    echo "刪除訂單錯誤: " . $conn->error;
}
// header("location: order_detail.php?id=".$id);
// header("location:order_detail.php?id=".$o_id);

?>
<script>
    location.href='javascript:history.go(-1)'
</script>

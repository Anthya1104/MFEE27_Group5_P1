<?php
//清空所有資訊
session_start();
session_destroy();
header("location: member-log-in/log-in.php");
?>
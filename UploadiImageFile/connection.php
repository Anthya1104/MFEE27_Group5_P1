<?php

$conn = mysqli_connect("localhost", "root", "", "ebook_db");
if (!$conn)
{
    die("连接错误: " . mysqli_connect_error());
}
?>
<?php
    require("../db-connect.php");

    $id=$_GET["id"];

    // 硬delete
    $sql="DELETE FROM product WHERE id='$id'";
    // echo $id;

    // 軟delete
    $sql="UPDATE product SET valid=0 WHERE id='$id'";


    if ($conn->query($sql) === TRUE){
        echo "刪除成功";
    }else {
        echo "刪除失敗" . $conn->error;
    }

    header("location: ../product-create/product-list.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>
  <body>
      
  

  </body>
</html>
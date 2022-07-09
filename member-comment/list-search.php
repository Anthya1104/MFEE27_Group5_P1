<?php
require("../db-connect.php");

if(!isset($_GET["search"])){
    $search="";
    $userCount=0;
}else{
    $search=$_GET["search"];
    //完全符合
    // $sql="SELECT id, account, name, email, phone FROM users WHERE account = '$search'";
    
    $sql="SELECT id, account, name, email, phone FROM users WHERE account LIKE '%$search%'";
    
    $result = $conn->query($sql);
    $userCount=$result->num_rows;
}



?>
<!doctype html>
<html lang="en">
  <head>
    <title>User Search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>
  <body>
      <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="users.php">User List</a>
        </div>
        <div class="py-2">
          <form action="user-search.php" method="get">
          <div class="input-group">
              <input type="text" name="search" class="form-control">
              <button type="submit" class="btn btn-info">搜尋</button>
            </div>
          </form>
        </div>
        <div class="py-2">
            <h2><?=$search?> 的搜尋結果</h2>
            <div class="py-2">共 <?=$userCount?> 筆資料</div>
        </div>
        <?php if($userCount>0): ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>id</th>
                  <th>account</th>
                  <th>name</th>
                  <th>email</th>
                  <th>phone</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
            //把資料轉換成關聯式陣列
            while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["account"]?></td>
                <td><?=$row["name"]?></td>
                <td><?=$row["email"]?></td>
                <td><?=$row["phone"]?></td>
                <td><a class="btn btn-info" href="user.php?id=<?=$row["id"]?>">Detail</a></td>
              </tr>
            <?php endwhile; ?>
              </tbody>
           </table>
        <?php else: ?>
            沒有符合條件的結果
        <?php endif; ?>
      </div>
  </body>
</html>
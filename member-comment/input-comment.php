<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location: ../member-log-in/log-in.php");
}
require("../db-connect.php");
//抓出book的資訊
$id=2;
$sql="SELECT * FROM product WHERE id=$id";
$result=$conn->query($sql);
$rows=$result->fetch_assoc();
// var_dump($rows);

$member_id=$_SESSION["user"]["id"];


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Input Comment</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

   

  </head>
  <body>

    <section>
    <div class="container">
      <div class="text-center py-2">      
        <h1 class="comment-h1">Welcome, <?=$_SESSION["user"]["account"]?></h1>
      </div>
        <div class="d-flex justify-content-center my-2">
          <div class="row">
            <div class="col-12">
              <figure class="text-center">
                <img src="../images/431.png" alt="book1">
              </figure>

            </div>
            <div class="col-12 comment">
              <div class="row mt-3">
                <form action="comment-do-create.php" method="post">
                <input name="member_id" type="hidden" value="<?=$member_id?>">
                <input name="book_id" type="hidden" value="<?=$id?>">

                <!-- $_SESSION["user"]["id"]->member->id   $id-> product->id -->
                <?php //var_dump($_SESSION["user"]["id"].$id);?>
                    <div class="form-group">
                        <h4>留下評論</h4>
                        <textarea name="comments" id="comments" cols="30" rows="5" class="form-control mt-3" ></textarea>
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-info">送出評論</button>    

                    </div>
                </form>                        

            </div>
                <a class="btn btn-primary" href="../session-destroy.php" >登出</a>
            </div>
          </div>


        </div>

    </div>

    </section>
  </body>
</html>
<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location: log-in.php");
}


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
    <link rel="stylesheet" href="../css/style.css">

  </head>
  <body class="login-bg">
    <div class="container">
      <div class="text-center py-2">      
        <h1 >Welcome, <?=$_SESSION["user"]["account"]?></h1>
      </div>
        <div class="d-flex justify-content-center my-2">
          <div class="row">
            <div class="col-12">
              <figure class="text-center">
                <img src="../images/431.png" alt="book1">
              </figure>

            </div>
            <div class="col-12">
              <div class="row mt-4">
                <form id="algin-form">
                    <div class="form-group">
                        <h4>Leave a comment</h4>
                        <label for="message">Comment</label>
                        <textarea name="comments" id="comments" cols="30" rows="5" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" name="userName" id="userName" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="button" id="post" class="btn btn-info">Post Comment</button>
                    </div>
                </form>
            </div>

            </div>
          </div>


        </div>

        <form action=""></form>
    </div>
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <title>Sign up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .panel{
            max-width: 300px;
        }
    </style>

  </head>
  <body>
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="panel">
                <h1 class="text-center">註冊</h1>
                <form action="viewSignUp.php" method="post">
                <div class="mb-2">
                    <label for="">帳號</label>
                    <input type="text" class="form-control" name="account"></input>
                </div>
                <div class="mb-2">
                    <label for="">暱稱</label>
                    <input type="text" class="form-control" name="username"></input>
                </div>
                <div class="mb-2">
                    <label for="">password</label>
                    <input type="password" class="form-control" name="password"></input>
                </div>
                <div class="mb-2">
                    <label for="">password recheck</label>
                    <input type="password" class="form-control" name="repassword"></input>
                </div>
                <button type="submit" class="btn btn-info">送出</button>
            </div>
        </div>
    </div>
  </body>
</html>
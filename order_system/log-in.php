<?php
session_start();
if(isset($_SESSION["user"])){
    header("location: dashboard.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        h1{
            color:#fff;
        }
        body{
            background: rgb(103,122,207);
            background: linear-gradient(145deg, rgba(103,122,207,1) 50%, rgba(0,212,255,1) 100%);
            background-size: cover;
        }
        .sign-up-panel {
            width: 280px;
        }

        .logo {
            width: 64px;
        }

        .input-top {
            border-radius: 0.375rem 0.375rem 0 0;
            border-bottom: none;
            
        }

        .input-bottom {
            border-radius: 0 0 0.375rem 0.375rem;
        }

        .form-floating>label{
            z-index:2;
        }

        .form-control{            
            /* 指定元素本身的position不能是static才能使用z-index */
            position:relative;
        }
        /* 調整focus產生後 */
        .form-control:focus{
            z-index: 1;
        }

    </style>
</head>

<body>
    <!-- 寫bootstrap記得可以直接用class把版位排出來 -->
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="sign-up-panel">
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"]["times"]>=5):?>
                <!-- 登入錯誤超過一定次數 看不到表單 -->
                <h1 class="text-info">您已嘗試超過五次，請稍後重新登入</h1>                
            <?php else: ?>
            <div class="text-center mb-3">
                <h1 class="mt-2">Please log in</h1>
            </div>
            <form action="do-log-in.php" method="post">
            <div class="form-floating">
                <input type="text" class="form-control input-top" id="floatingInput" placeholder="your account" name="account">
                <label for="floatingInput">Account </label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control input-bottom" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="my-2">
                <?php if(isset($_SESSION["error"])):?>
                    <div class="text-info"><?=$_SESSION["error"]["message"]?></div>
                <?php endif;?>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg" type="submit">Sign in</button>
              </div>

              </form>
              <?php endif; ?>

         <div class="pt-4 text-center text-muted">
             &copy 2017-2022
         </div>     

        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>
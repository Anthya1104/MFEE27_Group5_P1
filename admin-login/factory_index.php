<?php
include("db/mysqli_config.php");

$id = $_GET["id"];
if (empty($id)) exit("<script>alert('請先登入');location.href='factory_login.php'</script>");
$row = [];
$q = "select * from factory where id='$id'"; //簡單做
$r = my_assoc($q);
if ($r["size"]) {
  $row = $r["array"][0];
}

?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>廠商資料</title>
  <meta name="keywords" content="廠商資料" />
  <meta name="description" content="廠商資料">
  <meta name="author" content="廠商資料">
  <!-- Favicon -->
  <!--
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
  -->
  <!-- Mobile Metas -->
  <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <!--line 清除快取-->
  <meta http-equiv="Pragma" content="no-cache" />
  <!--line 清除快取-->
  <meta http-equiv="Expires" content="0" />
  <!--line 清除快取-->
  <!-- Web Fonts  -->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet" type="text/css">
  <!-- Vendor CSS -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/vendor/animate/animate.min.css">
  <link rel="stylesheet" href="assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="assets/line-awesome-1.1.0/css/line-awesome.min.css">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="assets/css/theme.css">
  <link rel="stylesheet" href="assets/css/theme-elements.css">

  <!-- Demo CSS -->
  <link rel="stylesheet" href="assets/css/demos/demo-insurance.css">
  <!-- Skin CSS -->
  <link rel="stylesheet" href="assets/css/skins/skin-insurance.css">
  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href="assets/css/helper.css?t=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/css/custom.css?t=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/backend_other.css?t=<?php echo time(); ?>">
  <!-- Head Libs -->
  <script src="assets/vendor/modernizr/modernizr.min.js"></script>
  <style>
    .avatar-sq {
      margin: 0 auto 20px auto;
      border-radius: 50%;
      overflow: hidden;
      width: 100px;
      height: 100px;
      /* clip: rect(0px,76px,76px,0px); */
      right: 55px;
      background-size: cover;
    }
  </style>
</head>

<body>
  <div class="body">
    <div role="main" class="main">
      <section class="main-bg-box">
        <div class="gap-40 main-bg main-factory"></div>
      </section>
      <div class="container-fluid">
        <div class="row">
          <!-- <div class="col-12">
              <img class="img-fluid" src="assets/img/main.png" alt="">
            </div> -->
          <div class="col-12 main-box">
            <form action="factory_index_end.php" method="post" enctype="multipart/form-data" id="form0">
              <input type="hidden" name="id" value="<?php echo $row["id"] ?>">

              <div class="form-row pl-2">

                <h3 class="col-12">Information</h3>
                <div class="form-group col-6">
                  <label class="font-weight-bold required">公司名稱</label>
                  <input type="text" class="form-control form-control-lg" req="Y" title="Name" placeholder="公司名稱" name="title" value="<?php echo $row["title"] ?>">
                </div>
                <div class="form-group col-6">
                  <label class="font-weight-bold required">Email</label>
                  <input type="text" class="form-control form-control-lg" req="Y" title="Email" placeholder="test123456@gmail.com" name="email" value="<?php echo $row["email"] ?>">
                </div>
                <div class="form-group col-6">
                  <label class="font-weight-bold required">電話</label>
                  <input type="tel" class="form-control form-control-lg" req="Y" title="Mobile" placeholder="0912345678" inputmode="tel" name="tel" value="<?php echo $row["tel"] ?>">
                </div>

                <div class="form-group col-6">
                  <label class="font-weight-bold required">地址</label>
                  <input type="text" class="form-control form-control-lg" req="Y" title="地址" placeholder="地址" name="address" value="<?php echo $row["address"] ?>">
                </div>


                <div class="form-group col-12">
                  <p class="mb-2">Date：<span class="today"><?php echo date("Y-m-d H:i:s") ?></span></p>

                  <button class="btn btn-block f14 btn-info btn-modern round" type="submit" set_id="submit2">送出</button>
                  <a class="btn btn-block f14 btn-danger btn-modern round" href="factory_login.php">登出</a>

                  <div class="gap-20"></div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a id="alert-btn" data-target="#alert" data-toggle="modal"></a>
  <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0 justify-content-center">
          <h4 class="modal-title text-center">ALERT</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="las la-times"></i></button>
        </div>
        <div class="modal-body text-center">
          <h5 class="text-red">Please Check:</h5>
          <h6 class="text-4 font-weight-normal"></h6>
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor -->

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/jquery.appear/jquery.appear.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/jquery.cookie/jquery.cookie.min.js"></script>
  <script src="assets/vendor/popper/umd/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/common/common.min.js"></script>
  <script src="assets/vendor/jquery.validation/jquery.validate.min.js"></script>
  <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
  <script src="assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
  <script src="assets/vendor/isotope/jquery.isotope.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="assets/vendor/vide/jquery.vide.min.js"></script>
  <script src="assets/vendor/vivus/vivus.min.js"></script>

  <!-- Theme Base, Components and Settings -->
  <script src="assets/js/theme.js"></script>

  <!-- Current Page Vendor and Views -->
  <script src="assets/js/views/view.contact.js"></script>
  <!-- Demo -->
  <script src="assets/js/demos/demo-insurance.js"></script>
  <script src="assets/js/jSignature.min.js"></script>

  <!-- Theme Initialization Files -->
  <script src="assets/js/theme.init.js"></script>


  <?php
  $inclue_str = str_replace(array('.php', '-'), array('.js', '_'), basename($_SERVER['SCRIPT_NAME']));
  if (is_file('js/other/' . $inclue_str)) {
    echo '<script src="js/other/' . $inclue_str . '?t=' . time() . '"></script>';
  }



  ?>
  <script>

  </script>
</body>

</html>
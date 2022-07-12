<?php

//if(empty($_SESSION["park"])) $page_mess["text"] = "查無資訊";
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Paid</title>
  <meta name="keywords" content="繳費" />
  <meta name="description" content="繳費">
  <meta name="author" content="繳費">
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
        <div class="gap-40 main-bg"></div>
      </section>
      <div class="container-fluid">
        <div class="row">
          <!-- <div class="col-12">
              <img class="img-fluid" src="assets/img/main.png" alt="">
            </div> -->
          <div class="col-12 main-box">
            <!-- form送出、action目標頁、index_end.php目標頁面，對其下指令送出之後要跳轉到什麼頁面 -->

            <!-- post送表單 -->

            <!-- enctype=multipart 多元組成的form表單(form-data)，如果有想上傳圖片一定要打這個模式才能上傳-->
            <form action="index2_end.php" method="post" enctype="multipart/form-data" id="form0">
              
              <div class="form-row pl-2">
				
               <h3 class="col-12">廠商修改資料</h3>
               <!-- 左 1 廠商名稱 -->
                <div class="form-group col-6">
                  <label class="font-weight-bold required">廠商名稱</label>
                  <input type="text"  class="form-control form-control-lg" req="Y" title="Name" placeholder="輸入更改名稱" name="factory_title" value="">
                </div>
                <!-- 右 1 密碼-->
                <div class="form-group col-6">
                <label class="font-weight-bold required">密碼</label>
                <input type="password1"  class="form-control form-control-lg" req="Y" title="text" placeholder="輸入更改密碼" name="text"  value="" >
                </div>
                <!-- 左 2 電話-->
                <div class="form-group col-6">
                  <label class="font-weight-bold required">電話</label>
                  <input type="tel"  class="form-control form-control-lg" req="Y" title="Tel" name="Tel"  placeholder="0123456789"
                  value="" >
                </div>
                <!-- 右 2 Email -->
                <div class="form-group col-6">
                  <label class="font-weight-bold required">Email</label>
                  <input type="text"  class="form-control form-control-lg" req="Y" title="Email" placeholder="test123456@gmail.com" name="email" value=""  >
                </div>
                <!-- 左 3 地址 -->
                <div class="form-group col-6">
                  <label class="font-weight-bold required">地址</label>
                  <input type="text"  class="form-control form-control-lg" req="Y" title="text" placeholder="320桃園市中壢區新生路二段421號" name="address"  value="" >
                </div>
                <!-- 右 3 備註 -->
                <div class="form-group col-6">
                  <label class="font-weight-bold required">Note</label>
                  <textarea class="form-control form-control-lg"  title="cknote" placeholder="備註" name="note"   ></textarea>
                </div>
                
                <div class="form-group col-12">
                  <p class="mb-2">Date：<span class="today"><?php echo date("Y-m-d H:i:s")?></span></p>

                  <button class="btn btn-block f14 btn-primary btn-modern round" type="submit" set_id="submit2">送出</button>

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
          <h6 class="text-4 font-weight-normal" ></h6>
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
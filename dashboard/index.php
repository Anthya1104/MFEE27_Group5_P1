<?php
require("../db-connect.php");

$sqlAll = "SELECT * FROM marketing WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$couponCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$userCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM product WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$productCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order_detail WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$orderCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE 
date BETWEEN '2022-01-01' AND '2022-01-31'";
$resultAll = $conn->query($sqlAll);
$JanCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE
date BETWEEN '2022-02-01' AND '2022-02-30'";
$result = $conn->query($sqlAll);
$FebCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE
date BETWEEN '2022-03-01' AND '2022-03-31'";
$result = $conn->query($sqlAll);
$MarCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE
date BETWEEN '2022-04-01' AND '2022-04-30'";
$resultAll = $conn->query($sqlAll);
$AprCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE
date BETWEEN '2022-05-01' AND '2022-05-31'";
$resultAll = $conn->query($sqlAll);
$MayCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN '2022-06-01' AND '2022-06-30'";
$resultAll = $conn->query($sqlAll);
$JunCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN '2022-07-01 00:00:00' AND '2022-07-01 23:59:59'";
$resultAll = $conn->query($sqlAll);
$aCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE 
date BETWEEN'2022-07-02 00:00:00' AND '2022-07-02 23:59:59'";
$resultAll = $conn->query($sqlAll);
$bCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE 
date BETWEEN'2022-07-03 00:00:00' AND '2022-07-03 23:59:59'";
$resultAll = $conn->query($sqlAll);
$cCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-04 00:00:00' AND '2022-07-04 23:59:59'";
$resultAll = $conn->query($sqlAll);
$dCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-05 00:00:00' AND '2022-07-05 23:59:59'";
$resultAll = $conn->query($sqlAll);
$eCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-06 00:00:00' AND '2022-07-06 23:59:59'";
$resultAll = $conn->query($sqlAll);
$fCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-07 00:00:00' AND '2022-07-07 23:59:59'";
$resultAll = $conn->query($sqlAll);
$gCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-08 00:00:00' AND '2022-07-08 23:59:59'";
$resultAll = $conn->query($sqlAll);
$hCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-09 00:00:00' AND '2022-07-09 23:59:59'";
$resultAll = $conn->query($sqlAll);
$iCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-10 00:00:00' AND '2022-07-10 23:59:59'";
$resultAll = $conn->query($sqlAll);
$jCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-11 00:00:00' AND '2022-07-11 23:59:59'";
$resultAll = $conn->query($sqlAll);
$kCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-12 00:00:00' AND '2022-07-12 23:59:59'";
$resultAll = $conn->query($sqlAll);
$lCount = $resultAll->num_rows;

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-13 00:00:00' AND '2022-07-13 23:59:59'";
$resultAll = $conn->query($sqlAll);
$mCount = $resultAll->num_rows;

$sql = "SELECT SUM(total) FROM user_order";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT user_order.*, member.name AS u_name , marketing.Coupon_code FROM user_order
JOIN member ON user_order.user_id = member.id
JOIN marketing ON user_order.coupon_id = marketing.id
WHERE user_order.valid=1
";


$result = $conn->query($sql);
$pageUserCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <? var_dump($MarCount); ?>
  <title>閱閱出版社銷售概覽</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="container-fluid">
    
    <div class="row">
      <div class="col-3 row">
        <?php require("../side-nav.php"); ?>
      </div>
      <div class="col-9">
        <!-- <div class="py-2 mt-4"> -->
        <div class="me-2 mt-2 ">
          <h2 class="title">閱閱出版社&nbsp數據儀錶板</h2>
        </div>
        <h3>所有數據概覽</h3>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">26則新的書評</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">查看</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?= $productCount ?>本電子書</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="/MFEE27_Group5_P1//product-create/product-list.php">
                <span class="float-left">查看</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?= $userCount ?>筆訂單</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="/MFEE27_Group5_P1/order_system/user_order.php">
                <span class="float-left">查看</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-support"></i>
                </div>
                <div class="mr-5"><?= $couponCount ?>張優惠券</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="/MFEE27_Group5_P1/coupon/coupon-list.php">
                <span class="float-left">查看</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-area-chart"></i> 每日新增訂單數
          </div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-lg-8"> -->
        <!-- Example Bar Chart Card-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-bar-chart"></i>2022年電子書銷售量
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-5 mt-auto">
                <canvas id="myBarChart" width="100" height="50"></canvas>
              </div>
              <div class="col-sm-4 text-center mt-auto">
                <div class="h4 mb-0 text-danger">99835</div>
                <div class="small text-muted">本年度銷售額</div>
                <hr>
                <div class="h4 mb-0 text-warning"><?= $orderCount ?>本</div>
                <div class="small text-muted">本年度銷售量</div>
                <hr>
                <div class="h4 mb-0 text-success"><?= $orderCount / 6 ?>本</div>
                <div class="small text-muted">每月平均銷售量</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Example Pie Chart Card-->
        <div class="card">
          <div class="card-header">
            <i class="fa fa-pie-chart"></i>年度受歡迎電子書類別
          </div>
          <div class="card-body">
            <canvas id="myPieChart" width="100%" height="30"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.5/umd/popper.js'></script>
  <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap4.js'></script>
  <!-- <script src="./script.js"></script> -->
  <script>
    // Chart.js scripts
    // -- Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily =
      '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = "#292b2c";
    // -- 折線圖
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: [
          "7月1日",
          "7月2日",
          "7月3日",
          "7月4日",
          "7月5日",
          "7月6日",
          "7月7日",
          "7月8日",
          "7月9日",
          "7月10日",
          "7月11日",
          "7月12日",
          "7月13日",
        ],
        datasets: [{
          label: "本日訂單數",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
          pointHitRadius: 20,
          pointBorderWidth: 2,
          data: [
            <?php echo ($aCount); ?>,
            <?php echo ($bCount); ?>,
            <?php echo ($cCount); ?>,
            <?php echo ($dCount); ?>,
            <?php echo ($eCount); ?>,
            <?php echo ($fCount); ?>,
            <?php echo ($gCount); ?>,
            <?php echo ($hCount); ?>,
            <?php echo ($iCount); ?>,
            <?php echo ($jCount); ?>,
            <?php echo ($kCount); ?>,
            <?php echo ($lCount); ?>,
            <?php echo ($mCount); ?>
          ],
        }, ],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: "date",
            },
            gridLines: {
              display: false,
            },
            ticks: {
              maxTicksLimit: 7,
            },
          }, ],
          yAxes: [{
            ticks: {
              min: 0,
              max: 20,
              maxTicksLimit: 5,
            },
            gridLines: {
              color: "rgba(0, 0, 0, .125)",
            },
          }, ],
        },
        legend: {
          display: false,
        },
      },
    });
    // -- 長條圖
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["1月", "2月", "3月", "4月", "5月", "6月"],
        datasets: [{
          label: "本月銷售量",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: [
            <?php echo ($JunCount); ?>,
            <?php echo ($FebCount); ?>,
            <?php echo ($MarCount); ?>,
            <?php echo ($AprCount); ?>,
            <?php echo ($MayCount); ?>,
            <?php echo ($JunCount); ?>
          ],
        }, ],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: "month",
            },
            gridLines: {
              display: false,
            },
            ticks: {
              maxTicksLimit: 6,
            },
          }, ],
          yAxes: [{
            ticks: {
              min: 0,
              max: 50,
              maxTicksLimit: 5,
            },
            gridLines: {
              display: true,
            },
          }, ],
        },
        legend: {
          display: false,
        },
      },
    });
    // -- 圓餅圖
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["商業理財", "文學小說", "社會科學", "生活風格", "藝術設計", "其他"],
        datasets: [{
          data: [35, 25, 12, 10, 8, 10],
          backgroundColor: ["#004aad", "#2eb2ff", "#44d9e6", "#70d9b8", "#c358ed", "#ff5c5c", "#ffbd4a", "#ccc"],
        }, ],
      },
    });

    $(document).ready(function() {
      $("#dataTable").DataTable();
    });
  </script>
</body>

</html>
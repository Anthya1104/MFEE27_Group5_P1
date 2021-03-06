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

$sqlAll = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-13 00:00:00' AND '2022-07-13 23:59:59'";
$resultAll = $conn->query($sqlAll);
$mCount = $resultAll->num_rows;


$sqlSum = "SELECT SUM(total) FROM user_order";
$result = $conn->query($sqlSum);
$total = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT user_order.*, member.name AS u_name , marketing.Coupon_code FROM user_order
JOIN member ON user_order.user_id = member.id
JOIN marketing ON user_order.coupon_id = marketing.id
WHERE user_order.valid=1
";

$result = $conn->query($sql);
$pageUserCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

$sqlJan = "SELECT * FROM user_order WHERE date BETWEEN '2022-01-01' AND '2022-01-31'";
$resultJan = $conn->query($sqlJan);
$JanCount = $resultJan->num_rows;

$sqlFeb = "SELECT * FROM user_order WHERE date BETWEEN '2022-02-01 00:00:00' AND '2022-02-28 23:59:59'";
$resultFeb = $conn->query($sqlFeb);
$FebCount = $resultFeb->num_rows;

$sqlMar = "SELECT * FROM user_order WHERE date BETWEEN '2022-03-01' AND '2022-03-31'";
$resultMar = $conn->query($sqlMar);
$MarCount = $resultMar->num_rows;

$sqlApr = "SELECT * FROM user_order WHERE date BETWEEN '2022-04-01' AND '2022-04-30'";
$resultApr = $conn->query($sqlApr);
$AprCount = $resultApr->num_rows;

$sqlMay = "SELECT * FROM user_order WHERE date BETWEEN '2022-05-01' AND '2022-05-31'";
$resultMay = $conn->query($sqlMay);
$MayCount = $resultMay->num_rows;

$sqlJun = "SELECT * FROM user_order WHERE  date BETWEEN '2022-06-01' AND '2022-06-30'";
$resultJun = $conn->query($sqlJun);
$JunCount = $resultJun->num_rows;

$sqlA = "SELECT * FROM user_order WHERE  date BETWEEN '2022-07-01 00:00:00' AND '2022-07-01 23:59:59'";
$resultA = $conn->query($sqlA);
$aCount = $resultA->num_rows;

$sqlB = "SELECT * FROM user_order WHERE 
date BETWEEN'2022-07-02 00:00:00' AND '2022-07-02 23:59:59'";
$resultB = $conn->query($sqlB);
$bCount = $resultB->num_rows;

$sqlC = "SELECT * FROM user_order WHERE 
date BETWEEN'2022-07-03 00:00:00' AND '2022-07-03 23:59:59'";
$resultC = $conn->query($sqlC);
$cCount = $resultC->num_rows;

$sqlD = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-04 00:00:00' AND '2022-07-04 23:59:59'";
$resultD = $conn->query($sqlD);
$dCount = $resultD->num_rows;

$sqlE = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-05 00:00:00' AND '2022-07-05 23:59:59'";
$resultE = $conn->query($sqlE);
$eCount = $resultE->num_rows;

$sqlF = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-06 00:00:00' AND '2022-07-06 23:59:59'";
$resultF = $conn->query($sqlF);
$fCount = $resultF->num_rows;

$sqlG = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-07 00:00:00' AND '2022-07-07 23:59:59'";
$resultG = $conn->query($sqlG);
$gCount = $resultG->num_rows;

$sqlH = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-08 00:00:00' AND '2022-07-08 23:59:59'";
$resultH = $conn->query($sqlH);
$hCount = $resultH->num_rows;

$sqlI = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-09 00:00:00' AND '2022-07-09 23:59:59'AND user_order.valid=1";
$resultI = $conn->query($sqlI);
$iCount = $resultI->num_rows;

$sqlJ = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-10 00:00:00' AND '2022-07-10 23:59:59'AND user_order.valid=1";
$resultJ = $conn->query($sqlJ);
$jCount = $resultJ->num_rows;

$sqlK = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-11 00:00:00' AND '2022-07-11 23:59:59' AND user_order.valid=1";
$resultK = $conn->query($sqlK);
$kCount = $resultK->num_rows;

$sqlL = "SELECT * FROM user_order WHERE  date BETWEEN'2022-07-12 00:00:00' AND '2022-07-12 23:59:59' AND user_order.valid=1";
$resultL = $conn->query($sqlL);
$lCount = $resultL->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
        <div class="py-2 mt-4">
          <div class="me-2 mt-2 ">
            <h2 class="title">???????????????&nbsp????????????</h2>
          </div>
          <h3>??????????????????</h3>
          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-dark o-hidden h-100 fs-5">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">26???????????????</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">??????</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-dark o-hidden h-100 fs-5">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5"><?= $productCount ?>????????????</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/MFEE27_Group5_P1//product-create/product-list.php">
                  <span class="float-left">??????</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-dark o-hidden h-100 fs-5">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5"><?= $userCount ?>?????????</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/MFEE27_Group5_P1/order_system/user_order.php">
                  <span class="float-left">??????</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-dark o-hidden h-100 fs-5">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-support"></i>
                  </div>
                  <div class="mr-5"><?= $couponCount ?>????????????</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/MFEE27_Group5_P1/coupon/coupon-list.php">
                  <span class="float-left">??????</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <!-- ?????????-->
          <div class="card mb-3">
            <div class="card-header fs-4">
              <i class="fa fa-area-chart"></i>???????????????????????????
            </div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
          </div>
          <!-- ?????????-->
          <div class="row">
            <div class="col-sm-8">
              <div class="card mb-3">
                <div class="card-header fs-4">
                  <i class="fa fa-bar-chart"></i>???????????????????????????
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-5 mt-auto">
                      <canvas id="myBarChart" width="100" height="50"></canvas>
                    </div>
                    <div class="col-sm-4 text-center mt-auto">
                      <div class="h4 mb-0 text-danger"><?= $total[0]["SUM(total)"]; ?></div>
                      <div class="small text-muted">??????????????????</div>
                      <hr>
                      <div class="h4 mb-0 text-warning"><?= $orderCount ?>???</div>
                      <div class="small text-muted">??????????????????</div>
                      <hr>
                      <div class="h4 mb-0 text-success"><?= ceil($orderCount / 6) ?>???</div>
                      <div class="small text-muted">?????????????????????</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Example Pie Chart Card-->
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header fs-4">
                  <i class="fa fa-pie-chart"></i>??????????????????????????????
                </div>
                <div class="card-body">
                  <canvas id="myPieChart" width="100" height="65"></canvas>
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
      // -- ?????????
      var ctx = document.getElementById("myAreaChart");
      var myLineChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: [
            "7???1???",
            "7???2???",
            "7???3???",
            "7???4???",
            "7???5???",
            "7???6???",
            "7???7???",
            "7???8???",
            "7???9???",
            "7???10???",
            "7???11???",
            "7???12???",
            "7???13???",
          ],
          datasets: [{
            label: "???????????????",
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
                maxTicksLimit: 4,
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
      // -- ?????????
      var ctx = document.getElementById("myBarChart");
      var myLineChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["1???", "2???", "3???", "4???", "5???", "6???"],
          datasets: [{
            label: "???????????????",
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
                maxTicksLimit: 7,
              },
            }, ],
            yAxes: [{
              ticks: {
                min: 0,
                max: 10,
                maxTicksLimit: 7,
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
      // -- ?????????
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: "pie",
        data: {
          labels: ["????????????", "????????????", "????????????", "????????????", "????????????", "??????"],
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
<?php
if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}
$id=$_GET["id"];

require("../db-connect.php");
$sql="SELECT * FROM product WHERE id=$id";

$result = $conn->query($sql);
$productCount = $result->num_rows;

?>

<!doctype html>
<html lang="en">
  <head>
    <title>edit product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .btn-info {
            background: #18d3e0;
        }
    </style>
  </head>
  <body>
      <div class="container-fluid">
        <!-- 包sidebar -->
        <div class="row">
            <div class="col-3">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
        <!-- 包sidebar -->
        <?php if($productCount>0):
          $row=$result->fetch_assoc();
          // var_dump($row["book_category"]);
          // echo "test";
          // var_dump($row["book_category"]);
          ?>
        <h1 class="mt-4" >編輯商品</h1>
        <form action="do-edit.php" method="post">
        <input name="id" type="hidden" value="<?=$row["id"]?>">
        <table class="table" >
            <!-- <tr>
              <th>ID</th>
              <td> <input name="id" type="text" readonly  class="form-control-plaintext" value="<?=$row["id"]?>"></td>
            </tr> -->
            <tr>
              <th>產品名稱</th>
              <td> <input type="text"  name="book_name" class="form-control" value="<?=$row["book_name"]?>"></td>
            </tr>
            <tr>
              <th>類型</th>
              <td> 
              <select class="form-select" name="book_category" >
                <option> 請選擇類型 </option>
                <option <?php echo $row["book_category"] == "1" ? 'selected' : '';?>  value="1">商業理財</option>
                <option <?php echo $row["book_category"] == "2" ? 'selected' : '';?> value="2">文學小說</option>
                <option <?php echo $row["book_category"] == "3" ? 'selected' : '';?> value="3">社會科學</option>
                <option <?php echo $row["book_category"] == "4" ? 'selected' : '';?> value="4">生活風格</option>
                <option <?php echo $row["book_category"] == "5" ? 'selected' : '';?> value="5">藝術設計</option>
                <option <?php echo $row["book_category"] == "6" ? 'selected' : '';?> value="6">自然科普</option>
                <option <?php echo $row["book_category"] == "7" ? 'selected' : '';?> value="7">旅遊觀光</option>
                <option <?php echo $row["book_category"] == "8" ? 'selected' : '';?> value="8">醫療保健</option>
                <option <?php echo $row["book_category"] == "9" ? 'selected' : '';?> value="8">勵志成長</option>
              </select>
              </td>
            </tr>
          
            <tr>
              <th>作者</th>
              <td> <input type="text"  name="author" class="form-control" value="<?=$row["author"]?>"></td>
            </tr>
          
            <tr>
              <th>出版社</th>
              <td> <input type="text"  name="publisher" class="form-control" value="<?=$row["publisher"]?>"></td>
            </tr>

            <tr>
              <th>出版日期</th>
              <td> <input type="date"  name="publication_date" class="form-control" value="<?=$row["publication_date"]?>"></td>
            </tr>
            
            <tr>
              <th>語言</th>
              <!-- 要怎麼出現原本存的語言? -->
              <td> 
              <select class="form-select" aria-label="Default select example" name="language">
                <option >請選擇類型</option>
                <option selected value="中文">中文</option>
                <option value="英文">英文</option>
                <option value="日文">日文</option>
                <option value="其他">其他</option>
                </select>
              </td>
            </tr>

            <tr>
              <th>內容簡介</th>
              <td> <input type="text"  name="book_details" class="form-control" value="<?=$row["book_details"]?>"></td>
            </tr>

            <tr>
              <th>價格</th>
              <td> <input type="text"  name="price" class="form-control" value="<?=$row["price"]?>"></td>
            </tr>

            <tr>
            <th>上下架狀態</th>
            <td>
                <select class="form-select" aria-label="Default select example" name="status">
                <option >請選擇狀態</option>
                <option value="1" selected>上架</option>
                <option value="2">下架</option>
                </select>
              </td>
            </tr>

            <th>封面圖</th>
            <td>
            <label for="formFile" class="form-label"></label>
            <input class="form-control" type="file" id="formFile" name="book_img"> 
            <input type="hidden" name="original" value="<?=$row["book_img"]?>">
            <td> <img class="object-cover" src="image/<?=$row["book_img"]?>" alt=""> </td>
            </td>

        </table>
       
        <div class="py-4">
        <button class="btn btn-info me-3" type="submit">儲存</button>
            <!-- <a class="btn btn-info" type="submit" href=""></a> -->
            <a class="btn btn-info" type="submit" href="../product-create/product-list.php">取消</a>
            
        </div>
        </form>
        <?php else: ?>
          沒有該產品
        <?php endif; ?>
        </div>
        </div>
      </div>

          <!-- -------------- -->
          <!-- <script>
            function selectValue (){
              var x = document.getElementById("dropdown").value;
              document.getElementById("show").innerHTML=x ;
            }
          </script> -->

  </body>
</html>
<?php

require("../db-connect.php");

$sql="SELECT book_sn FROM product ORDER BY book_sn limit 1";
$result = $conn->query($sql);

// $Count= $result->num_rows;


?>


<!doctype html>
<html lang="en">
  <head>
    <title>create product</title>
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
            <div class="col-3 row">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
        <!-- 包sidebar -->
        <h1 class="mt-4">新增商品</h1>
        <form action="do-create.php" method="post" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="">產品編號</label>
                <input type="text" class="form-control" name="book_sn" value="">
            </div>
            <div class="mb-2">
                <label for="">書名</label>
                <input type="text" class="form-control" name="book_name">
            </div>
            <!-- 例外建一個資料表 關聯式 or join -->
            <div class="mb-2">
                <label for="">類型</label>
                <select class="form-select"  name="book_category">
                <option selected>請選擇類型</option>
                <option value="1">商業理財</option>
                <option value="2">文學小說</option>
                <option value="3">社會科學</option>
                <option value="4">生活風格</option>
                <option value="5">藝術設計</option>
                <option value="6">自然科普</option>
                <option value="7">旅遊觀光</option>
                <option value="8">醫療保健</option>
                <option value="9">勵志成長</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="">作者</label>
                <input type="text" class="form-control" name="author">
            </div>
            <div class="mb-2">
                <label for="">出版社</label>
                <input type="text" class="form-control" name="publisher" value="閱閱出版社">
            </div>
            <div class="mb-2">
                <label for="">出版日期</label>
                <input type="date" class="form-control" name="publication_date">
            </div>
            <div class="mb-2">
                <label for="">語言</label>
                <select class="form-select" aria-label="Default select example" name="language">
                <option selected>請選擇類型</option>
                <option  value="中文" >中文</option>
                <option value="英文">英文</option>
                <option value="日文">日文</option>
                <option value="其他">其他</option>
                </select>
            </div>
            <div class="mb-2">
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">內容簡介</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="book_details"></textarea>
                </div>
            </div>
            <div class="mb-2">
                <label for="">價格</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="mb-2">
                <label for="">上下架狀態</label>
                <select class="form-select" aria-label="Default select example" name="status">
                <option selected>請選擇狀態</option>
                <option value="1">上架</option>
                <option value="2">下架</option>
                </select>
            </div>

              <div class="mb-2">
                <!-- 要怎麼做? -->
                <!-- <div class="mb-3">
                <form method="post" enctype="multipart/form-data" action="upload.php">
                <label for="formFile" class="form-label">封面圖</label>
                <input class="form-control" type="file" id="formFile" name="book_img">
                </form> 
                </div> -->
            </div>

            <!-- 上傳圖片原本的 -->
            <!-- <input type="hidden" id="book_img" name="book_img" value="book13.jpg"> -->
            <input type="hidden" id="book_img" name="book_img" value="book13.jpg">
            <input class="my-2" type="file" id="book_img" name="book_img" value="book13.jpg">
            <div class="my-4"></div>
            <button class="btn btn-warning me-3 " type="submit">儲存</button>
            <a class="btn btn-dark " type="submit" href="product-list.php">取消</a>
            <div class="mt-4"></div>
            <!-- 上傳圖片原本的 -->

        </form>
        <script>
            // 待釐清
            // var book_name=document.getElementById('my_file').value;
            // print_r(book);

            // function setInputValue(input_id, val) {
            // document.getElementById(input_id).setAttribute('value', val);
            // }
            // setInputValue('book_name',book);

        </script>
        
        </div>
        </div>
      </div>
  </body>
</html>
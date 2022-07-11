<?php

require("../db-connect.php");
if(!isset($_POST["book_name"])){
    echo "沒有帶資料到本頁";
    exit;
}


# 檢查檔案是否上傳成功
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK){
  echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
  echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
  echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
  echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';

  # 檢查檔案是否已經存在
  if (file_exists('upload/' . $_FILES['my_file']['name'])){
    echo '檔案已存在。<br/>';
  } else {
    $file = $_FILES['my_file']['tmp_name'];
    $dest = 'image/' . $_FILES['my_file']['name'];

    # 將檔案移至指定位置
    move_uploaded_file($file, $dest);
  }
} else {
  echo '錯誤代碼：' . $_FILES['my_file']['error'] . '<br/>';
}



// 欄位不能空白
// if(empty($book_name)){
//     echo "請填寫資料";
//     exit;
//     // 沒填資料的話要怎麼會到原本畫面?
// }


$book_sn=$_POST["book_sn"];
$book_name=$_POST["book_name"];
$book_category=$_POST["book_category"];
$author=$_POST["author"];
$publisher=$_POST["publisher"];
$publication_date=$_POST["publication_date"];
$language=$_POST["language"];
$book_details=$_POST["book_details"];
$price=$_POST["price"];
$status=$_POST["status"];
$upload_time=$_POST["upload_time"];
$book_img=$_FILES["book_img"]["name"];
$valid=$_POST["valid"];
$now=date('Y-m-d H:i:s');
// echo $now;

// var_dump ($book_img);

// 不能重複建檔
// $sql="SELECT book_name FROM product WHERE book_name='$book_name'";
// $result = $conn->query($sql);
// $productCount=$result->num_rows;

// if ($productCount>0){
//     echo "該產品已建檔";
//     exit;
// }


// echo "$name, $category, $author";

// INSERT INTO 資料表名 (欄位名) VALUES ("變數")
// Q : 變數名跟資料庫欄位名一定要一樣嗎?
// Q : $sql . "<br>" . $conn->error 這邊是固定用法嗎?
// Q : 時區還未改
$sql="INSERT INTO product (book_sn, book_name, book_category, author, publisher, publication_date, language, book_details, price, status, upload_time, book_img, valid) VALUES ('$book_sn', '$book_name', '$book_category', '$author', '$publisher', '$publication_date', '$language', '$book_details', '$price', '$status', '$now', '$book_img', 1)" ;
if ($conn->query($sql) === TRUE) {
    echo "新增完成";
    
}else {
    echo "新增失敗" . $sql . "<br>" . $conn->error;
}


$conn->close();
header("location: product-list.php");
// Q :新增成功後的畫面?

//date_default_timezone_set("Asia/Taipei");
// $now=date('Y-m-d H:i:s');
// // echo $now;
// // echo "$name, $email, $phone";
// // exit;






?>
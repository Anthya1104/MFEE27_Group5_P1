<!doctype html>
<html lang="en">
  <head>
    <title>Create Order</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>
  <body>
      <div class="container">
        <form action="doCreate.php" method="post">
            <div class="mb-2">
                <label for="">書名</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-2">
                <label for="">封面</label>
                <input type="img" class="form-control" name="img">
            </div>
            <div class="mb-2">
                <label for="">購買人</label>
                <input type="text" class="form-control" name="buyer">
            </div>
            <div class="mb-2">
                <label for="">訂購人</label>
                <input type="text" class="form-control" name="receiver">
            </div>
            <div class="mb-2">
                <label for="">狀態</label>
                <input type="text" class="form-control" name="status">
            </div>
            <div class="mb-2">
                <label for="">價格</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="mb-2">
                <label for="">數量</label>
                <input type="text" class="form-control" name="amount">
            </div>
            <button class="btn btn-info"
            type="submit"
            >送出</button>
        </form>
      </div>
  </body>
</html>
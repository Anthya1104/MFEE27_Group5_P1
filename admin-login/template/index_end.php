<?php


/*
到了end頁的流程順序:
1.檢查參數 params_security
2.檢查token gettoken_value
3.檢查前台表單的必填值 後台是否也有拿到必填值
4.當所有邏輯都跑完後，後台在寫入query

*/

if (empty(@$_POST)) {
    
    exit("<script>alert('非正常模式A');history.go(-1);</script>");
}


function pr($obj,$style="")
{

   echo "<pre $style>";
   print_r ($obj);
   echo "</pre>";
}

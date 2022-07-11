
setTimeout(function(){
	$("#form0").trigger('reset');//重置表單
},300);



//ori_Backpage('menu.php');
//back_page('menu.php');//禁止返回上一頁

$("[set_id=submit2]").click(function(e){
		var sum_arr = [];
		var this_form = Boolean($(this).parents('form'))? $(this).parents('form'): $('#'+$(this).attr('form'));

		this_form.find("[req=Y]").each(function() {
			var tooltips = $(this).attr("data-tooltip");
			var title = Boolean(tooltips) ? $.trim($(this).attr("data-tooltip")) : $.trim($(this).attr("title"));
			if ($(this).val() == "" || $(this).val() == null) {
				sum_arr.push(title);
		   } else {
				if ((this.name).indexOf("email") >= 0) {
					if ($(this).val() == false) {
						sum_arr.push("Email type is error!");
					}
				}
				if ((this.name).indexOf("amount") >= 0) {
					if (!Boolean(Number($(this).val())) || Number($(this).val())<0) {
						sum_arr.push("Amount less than 0");
					}
				}
			}
		})
		
		if(sum_arr.length > 0){
			sum_arr = sum_arr.join("<br>");
			// alert(sum_arr);
			$("#alert-btn").trigger("click");
			$("#alert h6").html(sum_arr);
			(e.preventDefault) ? e.preventDefault(): e.returnValue = false;
			return false
		}else{
		   document.forms[0].submit();
		}

});
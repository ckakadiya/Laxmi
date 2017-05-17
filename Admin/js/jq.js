$("document").ready(function () {
	//alert("sdfs");
	
	$("#user_data").hide();
	
	$("#pincode").empty();
		var state=$("#state option:selected").val();
		$.ajax({
					type :"post",
					url :"select_city.php",
					data :"state_id="+state,

					beforeSend :function(){},
					
					success :function(data){
						$("#city").empty();
						$("#city").append(data);
						var city=$("#city option:selected").val();
						$.ajax({
									type :"post",
									url :"select_pincode.php",
									data :"city_id="+city,
				
									beforeSend :function(){},
									
									success :function(data){
										$("#pincode").empty();
										$("#pincode").append(data);
														},
									complete :function(){}
						});
					},
					complete :function(){}
				});
	$("#state").change(function(){
		$("#pincode").empty();
		var state=$("#state option:selected").val();
		$.ajax({
					type :"post",
					url :"select_city.php",
					data :"state_id="+state,

					beforeSend :function(){},
					
					success :function(data){
						$("#city").empty();
						$("#city").append(data);
						var city=$("#city option:selected").val();
						$.ajax({
									type :"post",
									url :"select_pincode.php",
									data :"city_id="+city,
				
									beforeSend :function(){},
									
									success :function(data){
										$("#pincode").empty();
										$("#pincode").append(data);
														},
									complete :function(){}
						});
					},
					complete :function(){}
				});
		
	});
	
	$("#city").change(function(){
		var city=$("#city option:selected").val();
		$.ajax({
					type :"post",
					url :"select_pincode.php",
					data :"city_id="+city,

					beforeSend :function(){},
					
					success :function(data){
						$("#pincode").empty();
						$("#pincode").append(data);
										},
					complete :function(){}
				});
		
	});
	
	var last_id="";
	$("#planediv").hide();
	
	$("#showplane").click(function (){
		$("#planediv").toggle();
	});
	
	
	//user profile when click on edit
	
	
	
	$("#addnew").hide();
	$("#addnewbt").click(function(){
			$("#addnew").toggle();
	});
	
	$("#addmore").click(function(){
				var medicine="<div class='section-input'><input id='text_field' class='i-text required wid' list='medicinename' name='mname[]' placeholder='Medicine Name'/><datalist id='medicinename'> <?php $array_medicine=medicine(); for($i=0;$i<count($array_medicine['name']);$i++){echo '<option value='.$array_medicine['name'][$i].'>'; }?></datalist><br></div><div class='section-input'><input id='text_field' class='i-text required wid' name='no_of_time[]' placeholder='NO Of Time:1-1-1'></div><div class='section-input'><input id='text_field' class='i-text required wid' name='qty[]' placeholder='Qty.'></div> <div class='clearfix'></div>";
				
		$("#tblmedicine").append(medicine);
		
	});
//-------------------------------------------group2------------------------
$("#btndelete").click(function(){
		//alert("hii");
		var vdid=7;
		alert(vdid);
		$.ajax({
			type :"post",
			url :"visit_doc_delete.php",
			data :"vdid="+vdid,
			beforeSend :function(){},
			success :function(data){
				//alert(data);
				$("#editlight").css('display', 'none');
				$("#editfade").css('display', 'none');
				window.location="visit_doctor.php";
				//$("#pincode").empty();
				//$("#pincode").append(data);
			},
			complete :function(){}
		});

		
	});
	
	
		
	
});

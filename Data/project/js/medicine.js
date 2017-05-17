$(document).ready(function()
{
		var last_id = "";
		//alert("hiiiiii");
		var cname=$("#c1").val();
		var con_name=$("#cn1").val();
		$("#cn1").live("change",function(){
			alert($("#cn1").val());
			$.ajax({
				type :"post",
				url :"desciption.php",
				data:"txtconame="+$("#cn1").val(),
				beforeSend :function(){
				},
				success :function(data){
				//alert(data);
				$("#condesc").val(data);
				},
				complete :function(){}
			});
			
		});	

		$("#c1").live("change",function()
		{
				alert($("#c1").val());			
			if($("#c1").val() == "other")
			{	
				alert("Other selected");
				$('#main').css("display","block");
				$('#box').css("display","block");
			}
			
		});
		$('#close').live("click",function()
		{		
			$('#main').css("display","none");
			$('#box').css("display","none");
		});
				
		//insert into company table
		$("#cmpsub").live("click",function(){
			//mname=$("#mname").val();
			//mdesc=$("mdesc1").val();
			alert("hiii");
			cmpname=$("#cmpname").val();
			cmpemail=$("#cmpemail").val();
			cmpphno=$("#cmpphno").val();
			cmpadd=$("#cmpadd").val();
			//alert(cmpname+cmpemail+cmpphno+cmpadd);
			
			$.ajax({	
				type :"post",
				url :"ins_cmp.php",
				data:"cmpname="+$("#cmpname").val()+"&cmpemail="+$("#cmpemail").val()+"&cmpphno="+$("#cmpphno").val()+"&cmpadd="+$("#cmpadd").val(),
				beforeSend :function(){
					alert("hello");
				},
				success :function(data){
				//alert(data);
				$('#main').css("display","none");
				$('#box').css("display","none");
				//$('#mname').val(mname);
				//$('#mdesc1').val(mdesc);
				$('#c1').val(cmpname);
				$("#main1").html(data);
				//window.location.href='medicine.php';
		
				},
				complete :function(){}
			});
			return false;
			
		});
		
//------------------------medicine---------------
$('.medicine').live("click",function(){
	//alert("hii");
	$("#editmedname").hide();
	$("#heditmedname").show();
	$("#editmedesc").hide();
	$("#heditmedesc").show();
	$("#edit").hide();
	$("#save").show();
	$("#cancel").show();
	//alert($("#hmname").val()+$("#gender").val()+$("#mrid").val());
		$("#save").click(function()
		{
			//alert($("#hmedname").val());
			//alert($("#hmedesc").val());
			//alert($("#meid").val());
			$.ajax({
				type :"post",
				url :"update_med.php",
				data :"medicine_name="+$("#hmedname").val()+"&description="+$("#hmedesc").val()+"&meid="+$("#meid").val(),

				beforeSend :function(){
					//alert("hello");
				},
				success :function(a){
					//alert(a);
					$("#refmed").html(a);
				},
				complete :function(){}
			});
		});

		$("#cancel").click(function(){
			$("#editmedname").show();
			$("#heditmedname").hide();
			$("#editmedesc").show();
			$("#heditmedesc").hide();
			$("#edit").show();
			$("#save").hide();
			$("#cancel").hide();
		
		});
		

});
//-------------------------------content------------------------------------------------
	//edit email
	$(".content").live("click",function(){
		//alert("hi");
		var cid=$(this).attr("id");
		//alert(cid);
		var com=cid.split("_");
		//alert(com[0]);
		if(com[0] == "editcon")
		{
			//alert("inside if");
			//alert("last_id="+last_id);
			if(last_id != "")
			{
				//alert("hello");
				if(last_id == "newcon")
				{
					$("#newcon").empty();
					$("#ncon").show();
					$("#"+last_id).hide();
					$("#con_"+com[1]).hide();
					$("#hcon_"+com[1]).show();
					last_id="hcon_"+com[1];
				}
				if(last_id != "newcon")
				{
					var com1=last_id.split("_");
					//alert(com1);
					$("#con_"+com1[1]).show();
					$("#"+last_id).hide();
					$("#con_"+com[1]).hide();
					$("#hcon_"+com[1]).show();
					last_id="hcon_"+com[1];
					$("#newcon").empty();
					$("#ncon").show();
				}
				
			}
			else
			{
				//alert("inside else");	
				$("#con_"+com[1]).hide();
				$("#hcon_"+com[1]).show();
				last_id="hcon_"+com[1];
			}

		}

		if( com[0] == "save")
		{
			//alert($("#hcoid_"+com[1]).val());
			//alert($("#hconname_"+com[1]).val());
			//alert($("#hcondesc_"+com[1]).val());
			//alert($("#hconqty_"+com[1]).val());
			//alert($("#meid_"+com[1]).val());
			$.ajax({
				type :"post",
				url :"upd_content.php",
				data :"id="+$("#hcoid_"+com[1]).val()+"&content_name="+$("#hconname_"+com[1]).val()+"&desc="+$("#hcondesc_"+com[1]).val()+"&qty="+$("#hconqty_"+com[1]).val()+"&meid="+$("#meid").val(),
				beforeSend :function(){
				},
				success :function(a){
					//alert(a);
					$("#refcon").html(a);
				},
				complete :function(){}
			});
		}

		if( com[0] == "cancel" )
		{
			$("#hcon_"+com[1]).hide();
			$("#con_"+com[1]).show();
		}

		//delete email
		if(com[0] == "delcon")
		{
			// delete
			//alert("deletemail");
			//alert($("#heid_"+com[1]).val());
			var del=confirm("Do you really want to delete");
			if(del)
			{
				$.ajax({
					type :"post",
					url :"del_content.php",
					data : "id="+$("#hcoid_"+com[1]).val()+"&meid="+$("#meid").val(),

					beforeSend :function(){
					},
					success :function(a){
						$("#refcon").html(a);
						
					},
					complete :function(){}
				});
			}
		}
	});

	//add email
	$("#ncon").live("click",function(){
		var con="<li><input style='width:120px;' title = 'Enter content' placeholder = 'Enter content' required='required' id='con' /></li><li><input style='width:120px;' title = 'Enter description' placeholder = 'Enter description' required='required' id='condesc' /></li><li><input style='width:120px;' title = 'Enter qty' placeholder = 'Enter qty' required='required' id='con_qty' /></li><li style='width:40px;'><input  type='submit' name ='submit1' value='Save' id = 'addcon'></li><li><input type='reset' name ='cancelcon' value='Cancel' style='width:50px;' id = 'cancelcon'></li><li><div class='clearfix'></div></li>";
		if(last_id != "")
		{
			var com1=last_id.split("_");
			$("#con_"+com1[1]).show();
			$("#"+last_id).hide(); 
			$("#newcon").show();
			last_id="newcon";
		}
		else
		{
			//$("#newemail").show();
			last_id="newcon";
		}
		$("#newcontent").append(con);
		$("#ncon").hide();
	});

	$("#addcon").live("click",function(){
		//alert("insert");
		//alert($("#email").val()+$("#mrid").val());
		//alert($("#con").val());
		//alert($("#condesc").val());
		//alert($("#con_qty").val());
		//alert($("#meid").val());
		$.ajax({
			type:"post",
			url: "add_content.php",
			data: "content_name="+$("#con").val()+"&desc="+$("#condesc").val()+"&qty="+$("#con_qty").val()+"&meid="+$("#meid").val(),
			
			beforeSend: function(){
				//alert("hello");			
			},
			success: function(a){					
				alert("hi");				
				alert(a);
				$("#refcon").html(a);
			},
			complete: function(){}
		});
	});

	$("#cancelcon").live("click",function(){
		$("#newcontent").empty();
		$("#ncon").show();
		
	});


		
});

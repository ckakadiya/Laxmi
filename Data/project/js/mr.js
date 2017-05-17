$(document).ready(function()
{	
	var last_id="";
	$('#insert').click(function()
	{
		$('#main').css("display","block");
		$('#box').css("display","block");
	});
	$('#close').click(function()
	{
		$('#main').css("display","none");
		$('#box').css("display","none");
	});
	$('#cancel').click(function()
	{
		$('#main').css("display","none");
		$('#box').css("display","none");
	});
	$('#cngpwd').submit(function()
	{
		//alert("hii");
		var newpwd=$('#newpwd').val();
		var confpwd=$('#confpwd').val();
		if (newpwd == confpwd)
		{
			$.ajax({
				type :"post",
				url :"cngpwd.php",
				data :"newpwd="+newpwd,
	
				beforeSend :function(a){
					alert(a);
				},
				success :function(){
				},
				complete :function(){}
			});
			return true;
		}
		else
		{
			$('#err').html("both password should be same");
			return false;
		}
	});
//------------------------mr---------------
$('.mr').live("click",function(){
	//alert("hii");
	$("#editmrname").hide();
	$("#heditmrname").show();
	$("#editmrgender").hide();
	$("#heditmrgender").show();
	$("#edit").hide();
	$("#save").show();
	$("#cancel").show();
	//alert($("#hmname").val()+$("#gender").val()+$("#mrid").val());
		$("#save").click(function()
		{
			//alert($("#mrid").val());
			$.ajax({
				type :"post",
				url :"update_mr.php",
				data :"mrname="+$("#hmname").val()+"&gender="+$("#gender").val()+"&mrid="+$("#mrid").val(),

				beforeSend :function(){
					//alert("hello");
				},
				success :function(a){
					//alert(a);
					$("#refmr").html(a);
				},
				complete :function(){}
			});
		});

		$("#cancel").click(function(){
			$("#editmrname").show();
			$("#heditmrname").hide();
			$("#editmrgender").show();
			$("#heditmrgender").hide();
			$("#edit").show();
			$("#save").hide();
			$("#cancel").hide();
		
		});
		

});
//-------------------------------email------------------------------------------------
	//edit email
	$(".email").live("click",function(){
		//alert("hi");
		var cid=$(this).attr("id");
		//alert(cid);
		var com=cid.split("_");
		//alert(com[0]);
		if(com[0] == "editmail")
		{
			//alert("last_id="+last_id);
			if(last_id != "")
			{
				//alert("hello");
				if(last_id == "newemail")
				{
					$("#newemail").empty();
					$("#nemail").show();
					$("#"+last_id).hide();
					$("#mailrow_"+com[1]).hide();
					$("#hmailrow_"+com[1]).show();
					last_id="hmailrow_"+com[1];
				}
				if(last_id != "newemail")
				{
					var com1=last_id.split("_");
					//alert(com1);
					$("#mailrow_"+com1[1]).show();
					$("#"+last_id).hide();
					$("#mailrow_"+com[1]).hide();
					$("#hmailrow_"+com[1]).show();
					last_id="hmailrow_"+com[1];
					$("#newemail").empty();
					$("#nemail").show();
				}
				
			}
			else
			{
				//alert("inside else");	
				$("#mailrow_"+com[1]).hide();
				$("#hmailrow_"+com[1]).show();
				last_id="hmailrow_"+com[1];
			}

		}

		if( com[0] == "save")
		{
			//alert($("#mrid").val());
			$.ajax({
				type :"post",
				url :"upd_mail.php",
				data :"id="+$("#heid_"+com[1]).val()+"&email="+$("#hmail_"+com[1]).val()+"&mrid="+$("#mrid").val(),

				beforeSend :function(){
				},
				success :function(a){
					//alert(a);
					$("#refemail").html(a);
				},
				complete :function(){}
			});
		}

		if( com[0] == "cancel" )
		{
			$("#hmailrow_"+com[1]).hide();
			$("#mailrow_"+com[1]).show();
		}

		//delete email
		if(com[0] == "delmail")
		{
			// delete
			//alert("deletemail");
			//alert($("#heid_"+com[1]).val());
			var del=confirm("Do you really want to delete");
			if(del)
			{
				$.ajax({
					type :"post",
					url :"del_mail.php",
					data : "id="+$("#heid_"+com[1]).val()+"&mrid="+$("#mrid").val(),

					beforeSend :function(){
					},
					success :function(a){
						$("#refemail").html(a);
						
					},
					complete :function(){}
				});
			}
		}
	});

	//add email
	$("#nemail").live("click",function(){
		var email="<li style='width:150px;'><input type = 'email'  title = 'Enter email id' placeholder = 'Enter email id'  id='email' /></li><li style='width:40px;'><input  type='submit' name ='submit1' value='Save' id = 'addmail'></li><li><input type='reset' name ='cancelmail' value='Cancel' style='width:40px;' id = 'cancelmail'></li><li><div class='clearfix'></div></li>";
		if(last_id != "")
		{
			var com1=last_id.split("_");
			$("#mailrow_"+com1[1]).show();
			$("#"+last_id).hide();
			$("#newemail").show();
			last_id="newemail";
		}
		else
		{
			//$("#newemail").show();
			last_id="newemail";
		}
		$("#newemail").append(email);
		$("#nemail").hide();
	});

	$("#addmail").live("click",function(){
		//alert("insert");
		//alert($("#email").val()+$("#mrid").val());
		$.ajax({
			type:"post",
			url: "addemail.php",
			data: "email="+$("#email").val()+"&mrid="+$("#mrid").val(),
			
			beforeSend: function(){},
			success: function(a){					
				//alert(a);
				$("#refemail").html(a);
			},
			complete: function(){}
		});
	});

	$("#cancelmail").live("click",function(){
		$("#newemail").empty();
		$("#nemail").show();
		
	});
//----------------------------mr_medicine--------------------------------------
        $(".med").live("click",function(){
                    //alert("hiii");        
                    var cid=$(this).attr("id");
		    //alert(cid);
	            var com=cid.split("_");             
                    //alert(com[0]+com[1]);
                    if(com[0] == "editmed")
		    {
			//alert("last_id="+last_id);
			if(last_id == "")
			{	
				$("#medrow_"+com[1]).hide();
				$("#hmedrow_"+com[1]).show();
				last_id="hmedrow_"+com[1];
			}

		}

		if( com[0] == "save")
		{
			//alert($("#mrid").val());
			$.ajax({
				type :"post",
				url :"update_mr_medicine.php",
				data :"med_id="+$("#hmedid_"+com[1]).val()+"&med_name="+$("#hmed_"+com[1]).val()+"&mrid="+$("#mrid").val(),

				beforeSend :function(){
				},
				success :function(a){
					//alert(a);
					$("#refmed").html(a);
				},
				complete :function(){}
			});
		}

		if( com[0] == "cancel" )
		{
			$("#hmedrow_"+com[1]).hide();
			$("#medrow_"+com[1]).show();
		}

		//delete email
		if(com[0] == "delmed")
		{
			// delete
			//alert("deletemail");
                        alert($("#hmrmedid_"+com[1]).val());
			var del=confirm("Do you really want to delete");
			if(del)
			{
				$.ajax({
					type :"post",
					url :"del_mr_medicine.php",
					data : "id="+$("#hmrmedid_"+com[1]).val()+"&mrid="+$("#mrid").val(),

					beforeSend :function(){
					},
					success :function(a){
						$("#refmed").html(a);
						
					},
					complete :function(){}
				});
			}
		} 
		
        });

//-------------------------------contact------------------------------------------------

	//edit contact
	$(".phno").live("click",function(){
		//alert("hi");
		var cid=$(this).attr("id");
		var com=cid.split("_");
		//alert(com[0]);
		if(com[0] == "editphno")
		{
			if(last_id != "")
			{
				var com1=last_id.split("_");
				$("#phnorow_"+com1[1]).show();
				$("#"+last_id).hide();
				$("#phnorow_"+com[1]).hide();
				$("#hphnorow_"+com[1]).show();
				last_id="hphnorow_"+com[1];
			}
			else
			{
				$("#phnorow_"+com[1]).hide();
				$("#hphnorow_"+com[1]).show();
				last_id="hphnorow_"+com[1];
			}

		}

		if( com[0] == "save")
		{
			//alert("update");
			//alert("id="+$("#mrid").val()+"&phno="+$("#hphno_"+com[1]).val());
			$.ajax({
				type :"post",
				url :"upd_phno.php",
				data :"id="+$("#hcid_"+com[1]).val()+"&phno="+$("#hphno_"+com[1]).val()+"&mrid="+$("#mrid").val(),

				beforeSend :function(){
				},
				success :function(a){
					$("#refphno").html(a);
				},
				complete :function(){}
			});
		}

		if( com[0] == "cancel" )
		{
			$("#hphnorow_"+com[1]).hide();
			$("#phnorow_"+com[1]).show();
		}

		//delete email
		if(com[0] == "delphno")
		{
			// delete
			var del=confirm("Do you really want to delete");
			if(del)
			{
				$.ajax({
					type :"post",
					url :"del_phno.php",
					data : "did="+$("#hcid_"+com[1]).val()+"&mrid="+$("#mrid").val(),

					beforeSend :function(){
					},
					success :function(a){
						$("#refphno").html(a);
					},
					complete :function(){}
				});
			}
		}
	});

	//add contact

	$("#nphno").live("click",function(){
		var phno="<li style='width:150px;'><input type = 'text'  style='width:120px;'  title = 'Enter phno' placeholder = 'Enter phno' id='phno' pattern='^[0-9]{7,15}$' /></li><li  style='width:40px;'><input type='submit' name ='submit1' value='Save' id = 'addphno'></li><li><input type='reset' name ='cancelphno' value='Cancel' style='width:50px;' id = 'cancelphno'></li><li><div class='clearfix'></div></li>";
		if(last_id != "")
		{
			var com1=last_id.split("_");
			$("#phnorow_"+com1[1]).show();
			$("#"+last_id).hide();
			$("#newphno").show();
			last_id="newphno";
		}
		else
		{
			//$("#newemail").show();
			last_id="newphno";
		}
		$("#newphno").append(phno);
		$("#nphno").hide();
	});

	$("#addphno").live("click",function(){
		$.ajax({
			type:"post",
			url: "add_phno.php",
			data: "phno="+$("#phno").val()+"&mrid="+$("#mrid").val(),
			
			beforeSend: function(){
			},
			success: function(a){					
				//alert(a);
				$("#refphno").html(a);
			},
			complete: function(){}
		});
	});

	$("#cancelphno").live("click",function(){
		$("#newphno").empty();
		$("#nphno").show();
		
	});


	
});

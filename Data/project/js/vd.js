$(document).ready(function()
{
	//alert("hiii");
	$(".vd").live("click",function(){
		//alert("hello");	
		$("#editvdname").hide();	
		$("#heditvdname").show();
		$("#editspeciality").hide();	
		$("#heditspeciality").show();
		$("#edit").hide();
		$("#save").show();
		$("#cancel").show();
		//alert($("#hvdname").val()+$("#hspeciality").val());
		$("#save").click(function()
		{
			//alert($("#mrid").val());
			$.ajax({
				type :"post",
				url :"update_vd.php",
				data :"vdname="+$("#hvdname").val()+"&speciality="+$("#hspeciality").val()+"&vdid="+$("#vdid").val(),

				beforeSend :function(){
					//alert("hello");
				},
				success :function(a){
					//alert(a);
					$("#refvdinfo").html(a);
				},
				complete :function(){}
			});
		});
		
		$("#cancel").click(function(){
			$("#editvdname").show();
			$("#heditvdname").hide();
			$("#editspeciality").show();
			$("#heditspeciality").hide();
			$("#edit").show();
			$("#save").hide();
			$("#cancel").hide();
		
		});

	});
//-------------------------------email------------------------------------------------
	//edit email
	var last_id="";
	$(".email").live("click",function(){
		//alert("hi");
		var cid=$(this).attr("id");
		//alert(cid);
		var com=cid.split("_");
		//alert(com[0]);
		if(com[0] == "editmail")
		{	
			//alert("hii");
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
				//alert($("#mailrow_"+com[1]).attr("id"));
				//alert("inside else");	
				$("#mailrow_"+com[1]).hide();
				$("#hmailrow_"+com[1]).show();
				last_id="hmailrow_"+com[1];
			}

		}

		if( com[0] == "save")
		{
			//alert($("#vdid").val()+$("#heid_"+com[1]).val()+$("#hmail_"+com[1]).val());
			$.ajax({
				type :"post",
				url :"upd_email_vd.php",
				data :"id="+$("#heid_"+com[1]).val()+"&email="+$("#hmail_"+com[1]).val()+"&vdid="+$("#vdid").val(),

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
					url :"del_email_vd.php",
					data : "id="+$("#heid_"+com[1]).val()+"&vdid="+$("#vdid").val(),

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
		var email="<li><input type = 'email' style='width:120px;' class='i-text required'  title = 'Enter email id' placeholder = 'Enter email id' required='required' id='email' /></li><li  style='width:50px;'><input type='submit' name ='submit1' value='Save' id = 'addmail'></li><li><input type='reset' name ='cancelmail' value='Cancel' style='width:50px;' id = 'cancelmail'></li><li><div class='clearfix'></div></li>";
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
		//alert($("#email").val()+$("#uid").val());
		var pattern=/^([A-Za-z0-9\-_\.]+)@([A-Za-z0-9\-_\.]+)\.([A-Za-z0-9\-\.]{2,4})$/;
		if(pattern.test($("#email").val()) == false)
		{
			alert("enter valid email");
		}
		else
		{
		$.ajax({
			type:"post",
			url: "addEmailVd.php",
			data: "email="+$("#email").val()+"&vdid="+$("#vdid").val()+"&uid="+$("#uid").val(),
			
			beforeSend: function(){
				alert("hiii");		
			},
			success: function(a){					
				alert(a);
				$("#refemail").html(a);
			},
			complete: function(){}
		});
		}
	});

	$("#cancelmail").live("click",function(){
		$("#newemail").empty();
		$("#nemail").show();
		
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
			//alert("id="+$("#vdid").val()+"&phno="+$("#hphno_"+com[1]).val()+$("#hcid_"+com[1]).val());
			$.ajax({
				type :"post",
				url :"updPhnoVd.php",
				data :"id="+$("#hcid_"+com[1]).val()+"&phno="+$("#hphno_"+com[1]).val()+"&vdid="+$("#vdid").val(),

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
					url :"delPhnoVd.php",
					data : "id="+$("#hcid_"+com[1]).val()+"&vdid="+$("#vdid").val(),

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
		var phno="<li><input type = 'text'  style='width:120px;' class='i-text required' title = 'Enter phno' placeholder = 'Enter phno' required='required' id='phno' pattern='^[0-9]{7,15}$' /></li><li style='width:50px;'><input type='submit' name ='submit1' value='Save' id = 'addphno'></li><li><input type='reset' name ='cancelphno' value='Cancel' style='width:50px;' id = 'cancelphno'></li><li><div class='clearfix'></div></li>";
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
		var pattern=/^[0-9]{7,15}$/;
		if(pattern.test($("#phno").val()) == false)
		{
			alert("enter valid phone-no");
		}
		else
		{
		$.ajax({
			type:"post",
			url: "addPhnoVd.php",
			data: "phno="+$("#phno").val()+"&vdid="+$("#vdid").val()+"&uid="+$("#uid").val(),
			
			beforeSend: function(){
			},
			success: function(a){					
				//alert(a);
				$("#refphno").html(a);
			},
			complete: function(){}
		});
		}
	});

	$("#cancelphno").live("click",function(){
		$("#newphno").empty();
		$("#nphno").show();
		
	});
//--------------------------doc_time-------------------------
	$(".time").live("click",function(){
		//alert("hiii");
		//alert($(this).attr("id"));
		var val=$(this).attr("id");
		var arr=val.split("_");
		//alert(arr[0]);
		if(arr[0] == "edittime")
		{
			if(last_id != "")
			{
				var com1=last_id.split("_");
				$("#time_"+com1[1]).show();
				$("#"+last_id).hide();
				$("#time_"+arr[1]).hide();
				$("#htime_"+arr[1]).show();
				last_id="htime_"+arr[1];
			}
			else
			{
				$("#time_"+arr[1]).hide();
				$("#htime_"+arr[1]).show();
				last_id="htime_"+arr[1];
			}

		}	
		//alert($("#start_"+arr[1]).val()+$("#smed_"+arr[1]).val()+$("#till_"+arr[1]).val()+$("#tmed_"+arr[1]).val()+$("#day_"+arr[1]).val());
		if( arr[0] == "save")
		{
			var start1=$("#start_"+arr[1]).val();
			var smin=$("#smin_"+arr[1]).val();
			var till1=$("#till_"+arr[1]).val();
			var tmin=$("#tmin_"+arr[1]).val();
			function addminute(time,minute)
			{
				var piece=time.split(':');
				var min_piece=minute.split(':');
				
				if(min_piece[0] != "00")
				{
					var add=Number(piece[1])+Number(min_piece[0]);
				}
				else
				{
					var add="00";
				}
				var time=piece[0]+':'+add+':'+piece[2];
				return time;
			}
			var start=addminute(start1,smin)+" "+$("#smed_"+arr[1]).val();
			var till=addminute(till1,tmin)+" "+$("#tmed_"+arr[1]).val();
			var day=$("#day_"+arr[1]).val();
			//alert(start+till+day);
			$.ajax({
				type :"post",
				url :"upd_time.php",
				data :"id="+$("#htid_"+arr[1]).val()+"&start="+start+"&till="+till+"&day="+day+"&vdid="+$("#vdid").val(),

				beforeSend :function(){
					//alert("before");
				},
				success :function(a){
					$("#reftime").html(a);
				},
				complete :function(){}
			});
		}

		if(arr[0] == "cancel" )
		{
			$("#htime_"+arr[1]).hide();
			$("#time_"+arr[1]).show();
		}

		if(arr[0] == "deltime")
		{
			// delete
			var del=confirm("Do you really want to delete");
			if(del)
			{
				//alert("delete");
				$.ajax({
					type :"post",
					url :"del_time.php",
					data : "id="+$("#htid_"+arr[1]).val()+"&vdid="+$("#vdid").val(),

					beforeSend :function(){
						//alert("hiiii");
					},
					success :function(a){
						$("#reftime").html(a);
					},
					complete :function(){}
				});
			}
		}

	});	
	//add email
	$("#ntime").live("click",function(){
		var time="<li class='wid-auto'><select class='chzn-single' style='width:70px;' tabindex='2' id='start' name='selstart'><option value='1:00:00'>1:00:00</option><option value='2:00:00'>2:00:00</option><option value='3:00:00'>3:00:00</option><option value='4:00:00'>4:00:00</option><option value='5:00:00'>5:00:00</option><option value='6:00:00'>6:00:00</option><option value='7:00:00'>7:00:00</option><option value='8:00:00'>8:00:00</option><option value='9:00:00'>9:00:00</option><option value='10:00:00'>10:00:00</option><option value='11:00:00'>11:00:00</option><option value='12:00:00'>12:00:00</option>'; </select><select class='chzn-single' style='width:70px;' tabindex='2' id='smin' name='selsmin'><option value='00:00'>00:00</option><option value='05:00'>05:00</option><option value='10:00'>10:00</option><option value='15:00'>15:00</option><option value='20:00'>20:00</option><option value='25:00'>25:00</option><option value='30:00'>30:00</option><option value='35:00'>35:00</option><option value='40:00'>40:00</option><option value='45:00'>45:00</option><option value='50:00'>50:00</option><option value='55:00'>55:00</option>'; </select> <select class='chzn-single' style='width:40px;' id='smed'  name='selsmed'> <option value='AM'>AM</option><option value='PM'>PM</option></select></li><li class='wid-auto'><select class='chzn-single' style='width:70px;' tabindex='2' id='till' ><option value='1:00:00'>1:00:00</option><option value='2:00:00'>2:00:00</option><option value='3:00:00'>3:00:00</option><option value='4:00:00'>4:00:00</option><option value='5:00:00'>5:00:00</option><option value='6:00:00'>6:00:00</option><option value='7:00:00'>7:00:00</option><option value='8:00:00'>8:00:00</option><option value='9:00:00'>9:00:00</option><option value='10:00:00'>10:00:00</option><option value='11:00:00'>11:00:00</option><option value='12:00:00'>12:00:00</option>'; </select> <select class='chzn-single' style='width:70px;' tabindex='2' id='tmin' name='seltmin'><option value='00:00'>00:00</option><option value='05:00'>05:00</option><option value='10:00'>10:00</option><option value='15:00'>15:00</option><option value='20:00'>20:00</option><option value='25:00'>25:00</option><option value='30:00'>30:00</option><option value='35:00'>35:00</option><option value='40:00'>40:00</option><option value='45:00'>45:00</option><option value='50:00'>50:00</option><option value='55:00'>55:00</option>'; </select><select class='chzn-single' style='width:40px;' id='tmed'  name='seltmed'> <option value='AM'>AM</option><option value='PM'>PM</option></select></li><li class='wid-auto'><select class='chzn-single' style='width:90px;' tabindex='2' id='day' name='selday'><option value='monday'>Monday</option><option value='tuesday'>Tuesday</option><option value='wednesday'>Wednesday</option><option value='thursday' >Thursday</option><option value='friday'>Friday</option><option value='saturday'>Saturday</option><option value='sunday'>Sunday</option></select></li><li style='width:60px;'><input style='width:50px;' type='submit' name ='submit1' value='Save' id = 'addtime'></li><li><input type='reset' name ='cancel' value='Cancel' style='width:50px;' id = 'canceltime'></li><li><div class='clearfix'></div></li>";
		if(last_id != "")
		{
			var com1=last_id.split("_");
			$("#time_"+arr[1]).show();
			$("#"+last_id).hide();
			$("#newtime").show();
			last_id="newtime";
		}
		else
		{
			//$("#newemail").show();
			last_id="newtime";
		}
		$("#newtime").append(time);
		$("#ntime").hide();
	});

	$("#addtime").live("click",function(){
		//alert("hello");
		var start1=$("#start").val();
		var smin=$("#smin").val();
		var till1=$("#till").val();
		var tmin=$("#tmin").val();
		
		function addminute(time,minute)
		{
			var piece=time.split(':');
			//alert(piece[0]);
			var min_piece=minute.split(':');
			//alert(min_piece[0]);
			//var add=Number(piece[1])+Number(min_piece[0]);
			if(min_piece[0] != "00")
			{
				var add=Number(piece[1])+Number(min_piece[0]);
			}
			else
			{
				var add="00";
			}
			//alert("add="+add);
			var time=piece[0]+':'+add+':'+piece[2];
			//alert(time);
			return time;
		}
		//addminute(start1,smin);
		var start=addminute(start1,smin)+" "+$("#smed").val();
		var till=addminute(till1,tmin)+" "+$("#tmed").val();
		var day=$("#day").val();
		alert($("#smin").val()+$("#tmin").val()+start+till+day);
		$.ajax({
			type:"post",
			url: "add_time.php",
			data: "cid="+$("#cid").val()+"&vdid="+$("#vdid").val()+"&start="+start+"&till="+till+"&day="+day,
			
			beforeSend: function(){
				//alert("hiii");		
			},
			success: function(a){					
				//alert(a);
				$("#reftime").html(a);
				//window.location="visit_doc_up?vdid="+$("#vdid").val();
			},
			complete: function(){}
		});
	});

	$("#canceltime").live("click",function(){
		//alert("hiii");
		$("#newtime").empty();
		$("#ntime").show();
		
	});

});

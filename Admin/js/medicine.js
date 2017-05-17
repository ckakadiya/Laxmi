$(document).ready(function()
{
		//alert("hiiiiii");
		var cname=$("#c1").val();
		var con_name=$("#cn1").val();
		$("#cn1").live("change",function(){
			//alert($("#cn1").val());
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
		
		
});

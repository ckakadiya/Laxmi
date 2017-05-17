<?php
	include_once "connect.php";
	function sel_state()
	{
		$sql_sel="select * from state order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['id'];
				$data['state_name'][$cnt]=$sql_res['state_name'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
		
	}
	//print_r(sel_state());

	function sel_city()
	{
		$sql_sel="select * from city order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['id'];
				$data['state_id'][$cnt]=$sql_res['state_id'];
				$data['city_name'][$cnt]=$sql_res['city_name'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
		
	}
	//print_r(sel_city());
	function sel_area()
	{
		$sql_sel="select * from area order by id";
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				//echo "hi";
				$data['id'][$cnt]=$sql_res['id'];
				$data['city_id'][$cnt]=$sql_res['city_id'];
				$data['pincode'][$cnt]=$sql_res['pincode'];
				//$data['area_name'][$cnt]=$sql_res['area_name'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
		
	}
	//print_r(sel_area());
	function ins_state($arg)
	{
		$sname=$arg['txtsname'];
		$sql_ins="INSERT INTO state VALUES('','$sname')";
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			$sid=mysql_insert_id();
			return $sid; 
		}
		else
		{
			return 1;
		}
	}
	//echo ins_state("bdjshfk");
	function ins_city($sid,$arg)
	{
		$cname=$arg['txtcname'];
		$sql_ins="INSERT INTO city VALUES('','$sid','$cname')";
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			$cid=mysql_insert_id();
			return $cid; 
		}
		else
		{
			return 1;
		}
	}
	//echo ins_city(17,"mumbai");
	function ins_area($cid,$arg)
	{
		$area=$arg['txtaname'];
		$pincode=$arg['txtpincode'];
		//echo "hi";
		$sql_ins="INSERT INTO area VALUES('','$cid','$area','$pincode')";
		//echo $sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			$aid=mysql_insert_id();
			return $aid; 
		}
		else
		{
			return 1;
		}
	}
	//echo ins_area(21,505);
	
?>

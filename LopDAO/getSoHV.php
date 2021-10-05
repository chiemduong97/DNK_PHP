<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$malop=$_POST["malop"];
		

		$sql="select count(*) as 'sohv' from phieudangky where malop='$malop' and trangthai='1'";
		$result=mysqli_query($conn,$sql);

		if($result==TRUE) {
			$data=mysqli_fetch_assoc($result);
			$json["thanhcong"]=1;
			$json["lop"]=array(); 
			$arr=array();
			$arr["malop"]=$malop;
			$arr["sohv"]=$data["sohv"];
			array_push($json["lop"],$arr);
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="That bai";
			echo json_encode($json);
		}
	}
	mysqli_close($conn);
?>
	
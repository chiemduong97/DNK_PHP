<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$makh=$_POST["makh"];
		

		$sql="select count(*) as 'solop' from lop where makh='$makh'";
		$result=mysqli_query($conn,$sql);

		if($result==TRUE) {
			$data=mysqli_fetch_assoc($result);
			$json["thanhcong"]=1;
			$json["khoahoc"]=array(); 
			$arr=array();
			$arr["makh"]=$makh;
			$arr["solop"]=$data["solop"];
			array_push($json["khoahoc"],$arr);
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
	
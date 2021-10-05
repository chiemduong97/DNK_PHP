<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$tenkh=$_POST["tenkh"];
		$maloai=$_POST["maloai"];

		$sql="select * from khoahoc where tenkh='$tenkh' and maloai='$maloai'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($result);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Khoa hoc da ton tai";
			echo json_encode($json);
		}	
		else{
			$sql="INSERT INTO khoahoc
			(tenkh,maloai) VALUES ('$tenkh','$maloai')";
			if (mysqli_query($conn,$sql) === TRUE) {
				$last_id = mysqli_insert_id($conn);
				$result=mysqli_query($conn,"select * from khoahoc where makh='$last_id'");
				$khoa=mysqli_fetch_array($result);
				$json["thanhcong"]=1;
				$json["khoahoc"]["makh"]=$khoa["makh"];
				$json["khoahoc"]["tenkh"]=$khoa["tenkh"];
				$json["khoahoc"]["maloai"]=$khoa["maloai"];
				echo json_encode($json);
			} 
			else {
				$json["thanhcong"]=0;
				$json["thongbao"]="Them that bai";	
				echo json_encode($json);
			}
		}
	}
	mysqli_close($conn);
?>
	
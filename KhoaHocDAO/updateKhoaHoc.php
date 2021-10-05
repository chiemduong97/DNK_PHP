<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$makh=$_POST["makh"];
		$tenkh=$_POST["tenkh"];
		$maloai=$_POST["maloai"];

		$sqlcheck="select * from khoahoc where tenkh='$tenkh' and maloai='$maloai' and makh!='$makh'";
		$resultcheck=mysqli_query($conn,$sqlcheck);
		$rows=mysqli_num_rows($resultcheck);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Khoa hoc da ton tai";
			echo json_encode($json);
		}
		else{
			$sql="update khoahoc
				  set tenkh='$tenkh',maloai='$maloai'
				  where makh='$makh'";
			$result=mysqli_query($conn,$sql);
			if($result==TRUE) {
				$json["thanhcong"]=1;
				$json["thongbao"]="Cap nhat thanh cong";
				echo json_encode($json);
			}	
			else{
				$json["thanhcong"]=0;
				$json["thongbao"]="Cap nhat that bai";
				echo json_encode($json);
			}
		}
		
	}
	mysqli_close($conn);
?>
	
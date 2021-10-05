<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mahv=$_POST["mahv"];
		

		$sql="update hocvien
			  set matkhau='abc123'
			  where mahv='$mahv'";
		$result=mysqli_query($conn,$sql);
		if($result==TRUE) {
			$json["thanhcong"]=1;
			$json["thongbao"]="Reset mat khau thanh cong";
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Reset mat khau that bai";
			echo json_encode($json);
		}
	}
	mysqli_close($conn);
?>
	
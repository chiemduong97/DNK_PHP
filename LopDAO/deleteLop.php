<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$malop=$_POST["malop"];
		

		$sql="delete from lop where malop='$malop'";
		$result=mysqli_query($conn,$sql);
		if($result==TRUE) {
			$json["thanhcong"]=1;
			$json["thongbao"]="Xoa thanh cong";
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Co hoc vien xoa that bai";
			echo json_encode($json);
		}
	}
	mysqli_close($conn);
?>
	
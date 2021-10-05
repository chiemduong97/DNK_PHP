<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mahv=$_POST["mahv"];
		

		$sql="delete from hocvien where mahv='$mahv'";
		$result=mysqli_query($conn,$sql);
		if($result==TRUE) {
			$json["thanhcong"]=1;
			$json["thongbao"]="Xoa thanh cong";
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Co lop hoc xoa that bai";
			echo json_encode($json);
		}
	}
	mysqli_close($conn);
?>
	
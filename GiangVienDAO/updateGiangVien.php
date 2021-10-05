<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$magv=$_POST["magv"];
		$tengv=$_POST["tengv"];

		$sqlcheck="select * from giangvien where tengv='$tengv' and magv!='$magv'";
		$resultcheck=mysqli_query($conn,$sqlcheck);
		$rows=mysqli_num_rows($resultcheck);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Giang vien da ton tai";
			echo json_encode($json);
		}
		else{
			$sql="update giangvien
				  set tengv='$tengv'
				  where magv='$magv'";
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
	
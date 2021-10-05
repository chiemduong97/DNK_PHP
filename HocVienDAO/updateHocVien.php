<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mahv=$_POST["mahv"];
		$taikhoan=$_POST["taikhoan"];
		$tenhv=$_POST["tenhv"];
		$matkhau=$_POST['matkhau'];
		$email=$_POST['email'];
		$sdt=$_POST["sdt"];
		$diachi=$_POST["diachi"];
		$trangthai=$_POST["trangthai"];




		$sql="update hocvien
			  set taikhoan='$taikhoan',tenhv='$tenhv',matkhau='$matkhau',email='$email',sdt='$sdt',diachi='$diachi',trangthai='$trangthai'
			  where mahv='$mahv'";
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
	mysqli_close($conn);
?>
	
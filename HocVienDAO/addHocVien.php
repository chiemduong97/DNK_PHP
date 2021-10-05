<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$taikhoan=$_POST["taikhoan"];
		$email=$_POST['email'];

		$sql="select * from hocvien where taikhoan='$taikhoan'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($result);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Tai khoan da ton tai";
			echo json_encode($json);
		}	
		else{
			$sql="INSERT INTO hocvien
			(taikhoan,matkhau,email,trangthai)VALUES 
			('$taikhoan', 'abc123', '$email','1')";
			if (mysqli_query($conn,$sql) === TRUE) {
				$last_id = mysqli_insert_id($conn);
				$result=mysqli_query($conn,"select * from hocvien where mahv='$last_id'");
				$hocvien=mysqli_fetch_array($result);
				$json["thanhcong"]=1;
				$json["hocvien"]["mahv"]=$hocvien["mahv"];
				$json["hocvien"]["tenhv"]=$hocvien["tenhv"];
				$json["hocvien"]["taikhoan"]=$hocvien["taikhoan"];
				$json["hocvien"]["matkhau"]=$hocvien["matkhau"];
				$json["hocvien"]["email"]=$hocvien["email"];
				$json["hocvien"]["sdt"]=$hocvien["sdt"];
				$json["hocvien"]["diachi"]=$hocvien["diachi"];
				$json["hocvien"]["avatar"]=$hocvien["avatar"];
				$json["hocvien"]["trangthai"]=$hocvien["trangthai"];
				echo json_encode($json);
			} 
			else {
				$json["thanhcong"]=0;
				$json["thongbao"]="Dang ky that bai";	
				echo json_encode($json);
			}
		}
	}
	mysqli_close($conn);
?>
	
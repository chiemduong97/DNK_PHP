<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$taikhoan = $_POST['taikhoan'];
		$matkhau = $_POST['matkhau'];
		$sql="select * from hocvien where matkhau='$matkhau' and taikhoan='$taikhoan'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$json["thanhcong"]=1;
			$json["hocvien"]=array(); 
			while($hocvien=mysqli_fetch_array($result)){
				$arr=array();
				$arr["mahv"]=$hocvien["mahv"];
				$arr["tenhv"]=$hocvien["tenhv"];
				$arr["taikhoan"]=$hocvien["taikhoan"];
				$arr["matkhau"]=$hocvien["matkhau"];
				$arr["email"]=$hocvien["email"];
				$arr["sdt"]=$hocvien["sdt"];
				$arr["diachi"]=$hocvien["diachi"];
				$arr["avatar"]=$hocvien["avatar"];
				$arr["trangthai"]=$hocvien["trangthai"];
				array_push($json["hocvien"],$arr);
			}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Sai tai khoan hoac mat khau";
		}
		echo json_encode($json);
	}
	mysqli_close($conn);

?>
	
<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$malop=$_POST["malop"];
		$tenlop=$_POST['tenlop'];
		$mota=$_POST['mota'];
		$makh=$_POST['makh'];
		$magv=$_POST['magv'];
		$batdau=$_POST['batdau'];
		$ketthuc=$_POST['ketthuc'];
		$cahoc=$_POST['cahoc'];
		$danhgia=$_POST['danhgia'];
		$hocphi=$_POST['hocphi'];

		$sqlcheck="select * from lop where tenlop='$tenlop' and malop!='$malop'";
		$resultcheck=mysqli_query($conn,$sqlcheck);
		$rows=mysqli_num_rows($resultcheck);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Lop da ton tai";
			echo json_encode($json);
		}
		else{

			$sql="update lop
				  set tenlop='$tenlop',mota='$mota',makh='$makh',magv='$magv',batdau='$batdau',ketthuc='$ketthuc',cahoc='$cahoc',danhgia='$danhgia',hocphi='$hocphi'
				  where malop='$malop'";
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
	
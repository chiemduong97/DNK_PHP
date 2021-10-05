<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$tenlop=$_POST['tenlop'];
		$mota=$_POST['mota'];
		$makh=$_POST['makh'];
		$magv=$_POST['magv'];
		$batdau=$_POST['batdau'];
		$ketthuc=$_POST['ketthuc'];
		$cahoc=$_POST['cahoc'];
		$anhminhhoa=$_POST['anhminhhoa'];
		$danhgia=$_POST['danhgia'];
		$hocphi=$_POST['hocphi'];

		$sql="select * from lop where tenlop='$tenlop' and makh='$makh'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($result);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Lop da ton tai";
			echo json_encode($json);
		}	
		else{
			$link="anhminhhoa/";
			$linkanh=rand()."_".time().".jpeg";
			$link=$link."/".$linkanh;


			$sql="INSERT INTO lop
			(tenlop,mota,makh,magv,batdau,ketthuc,cahoc,anhminhhoa,danhgia,hocphi)VALUES 
			('$tenlop','$mota', '$makh', '$magv','$batdau','$ketthuc','$cahoc','$linkanh','$danhgia','$hocphi')";
			if (mysqli_query($conn,$sql) === TRUE) {
				file_put_contents($link,base64_decode($anhminhhoa));

				$last_id = mysqli_insert_id($conn);
				$result=mysqli_query($conn,"select * from lop where malop='$last_id'");
				$lop=mysqli_fetch_array($result);
				$json["thanhcong"]=1;
				$json["lop"]["malop"]=$lop["malop"];
				$json["lop"]["tenlop"]=$lop["tenlop"];
				$json["lop"]["makh"]=$lop["makh"];
				$json["lop"]["magv"]=$lop["magv"];
				$json["lop"]["batdau"]=$lop["batdau"];
				$json["lop"]["ketthuc"]=$lop["ketthuc"];
				$json["lop"]["cahoc"]=$lop["cahoc"];
				$json["lop"]["anhminhhoa"]=$lop["anhminhhoa"];
				$json["lop"]["danhgia"]=$lop["danhgia"];
				$json["lop"]["hocphi"]=$lop["hocphi"];
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
	
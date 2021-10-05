<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$mahv=$_POST["mahv"];
		$malop=$_POST["malop"];
		$diem=$_POST["diem"];
		$binhluan=$_POST["binhluan"];

		$sql="select * from phieudangky where malop='$malop' and mahv='$mahv' and trangthai=1";
		$result=mysqli_query($conn,$sql);
		$hocvien=mysqli_fetch_array($result);
		if($hocvien["mahv"]==$mahv){
			$sql="select * from phieudanhgia where mahv='$mahv' and malop='$malop'";
			$result=mysqli_query($conn,$sql);
			$rows=mysqli_num_rows($result);
			if($rows>0) {
				$sql="update phieudanhgia
					  set ngaydg=now(),diem='$diem',binhluan='$binhluan'
					  where mahv='$mahv' and malop='$malop'";
				  
				$result=mysqli_query($conn,$sql);
				if($result==TRUE) {
					$json["thanhcong"]=1;
					$json["thongbao"]="Danh gia thanh cong";
					echo json_encode($json);
				}	
				else{
					$json["thanhcong"]=0;
					$json["thongbao"]="Danh gia that bai 1";
					echo json_encode($json);
				}
			}	
			else{
				$sql="INSERT INTO phieudanhgia
					  (mahv,malop,diem,ngaydg,luotthich,binhluan)VALUES 
					  ('$mahv', '$malop','$diem', now(),'0','$binhluan')";
				if (mysqli_query($conn,$sql) === TRUE) {
					$last_id = mysqli_insert_id($conn);
					$result=mysqli_query($conn,"select * from phieudanhgia where mapdg='$last_id'");
					$phieu=mysqli_fetch_array($result);
					$json["thanhcong"]=1;
					$json["phieudanhgia"]["mapdg"]=$phieu["mapdg"];
					$json["phieudanhgia"]["mahv"]=$phieu["mahv"];
					$json["phieudanhgia"]["malop"]=$phieu["malop"];
					$json["phieudanhgia"]["diem"]=$phieu["diem"];
					$json["phieudanhgia"]["ngaydg"]=$phieu["ngaydg"];
					$json["phieudanhgia"]["luotthich"]=$phieu["luotthich"];
					$json["phieudanhgia"]["binhluan"]=$phieu["binhluan"];
					echo json_encode($json);
				} 
				else {
					$json["thanhcong"]=0;
					$json["thongbao"]="Danh gia that bai 2";	
					echo json_encode($json);
				}
			}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Khong phai hoc vien cua lop";	
			echo json_encode($json);
		}	
	}
	mysqli_close($conn);
?>
	
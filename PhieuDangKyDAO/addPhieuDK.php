<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$mahv=$_POST["mahv"];
		$malop=$_POST["malop"];
		$trangthai=$_POST["trangthai"];
		$batdau=$_POST["batdau"];
		$ketthuc=$_POST["ketthuc"];
		$cahoc=$_POST["cahoc"];

		$sql="select * from phieudangky where mahv='$mahv' and malop='$malop'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($result);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Da dang ky lop nay";
			echo json_encode($json);
		}	
		else{
			$sql="INSERT INTO phieudangky
				(mahv,malop,trangthai,batdau,ketthuc,cahoc)VALUES 
				('$mahv', '$malop', '$trangthai','$batdau','$ketthuc','$cahoc')";
				if (mysqli_query($conn,$sql) === TRUE) {
					$last_id = mysqli_insert_id($conn);
					$result=mysqli_query($conn,"select * from phieudangky where mapdk='$last_id'");
					$phieu=mysqli_fetch_array($result);
					$json["thanhcong"]=1;
					$json["phieudangky"]["mapdk"]=$phieu["mapdk"];
					$json["phieudangky"]["mahv"]=$phieu["mahv"];
					$json["phieudangky"]["malop"]=$phieu["malop"];
					$json["phieudangky"]["trangthai"]=$phieu["trangthai"];
					$json["phieudangky"]["batdau"]=$phieu["batdau"];
					$json["phieudangky"]["ketthuc"]=$phieu["ketthuc"];
					$json["phieudangky"]["cahoc"]=$phieu["cahoc"];
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
	
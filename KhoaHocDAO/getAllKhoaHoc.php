<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	$sql="select * from khoahoc";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		$json["thanhcong"]=1;
		$json["khoahoc"]=array(); 

		while($khoa=mysqli_fetch_array($result)){
			$arr=array();
			$arr["makh"]=$khoa["makh"];
			$arr["tenkh"]=$khoa["tenkh"];
			$arr["maloai"]=$khoa["maloai"];
			array_push($json["khoahoc"],$arr);
		}
	}
	else{
		$json["thanhcong"]=0;
		$json["thongbao"]="Khong co khoa hoc";
	}
	echo json_encode($json);
	mysqli_close($conn);
?>
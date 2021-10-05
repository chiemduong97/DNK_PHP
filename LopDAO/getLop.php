<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$malop=$_POST["malop"];
		$json=array("thanhcong"=>0);	
		$sql="select * from lop where malop='$malop'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$json["thanhcong"]=1;
			$json["lop"]=array(); 
			while($lop=mysqli_fetch_array($result)){
			$arr=array();
			$arr["malop"]=$lop["malop"];
			$arr["tenlop"]=$lop["tenlop"];
			$arr["mota"]=$lop["mota"];
			$arr["makh"]=$lop["makh"];
			$arr["magv"]=$lop["magv"];
			$arr["batdau"]=$lop["batdau"];
			$arr["ketthuc"]=$lop["ketthuc"];
			$arr["cahoc"]=$lop["cahoc"];
			$arr["anhminhhoa"]=$lop["anhminhhoa"];
			$arr["danhgia"]=$lop["danhgia"];
			$arr["hocphi"]=$lop["hocphi"];
			array_push($json["lop"],$arr);
		}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Khong tim lop";
		}
		echo json_encode($json);

	}
	
	mysqli_close($conn);
?>
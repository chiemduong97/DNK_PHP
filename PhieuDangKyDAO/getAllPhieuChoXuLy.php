<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	$sql="select * from phieudangky where trangthai='0' order by mapdk desc";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		$json["thanhcong"]=1;
		$json["phieudangky"]=array(); 

		while($phieu=mysqli_fetch_array($result)){
			$arr=array();
			$arr["mapdk"]=$phieu["mapdk"];
			$arr["mahv"]=$phieu["mahv"];
			$arr["malop"]=$phieu["malop"];
			$arr["cahoc"]=$phieu["cahoc"];
			$arr["trangthai"]=$phieu["trangthai"];
			array_push($json["phieudangky"],$arr);
		}
	}
	else{
		$json["thanhcong"]=0;
		$json["thongbao"]="Khong co phieu cho xu ly";
	}
	echo json_encode($json);
	mysqli_close($conn);
?>
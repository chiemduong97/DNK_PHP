<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$maloai=$_POST["maloai"];
		$json=array("thanhcong"=>0);	
		$sql="select * from khoahoc where maloai='$maloai'";
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

	}
	
	mysqli_close($conn);
?>
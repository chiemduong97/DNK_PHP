<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mapdk=$_POST["mapdk"];
		

		$sql="delete from phieudangky where mapdk='$mapdk'";
		$result=mysqli_query($conn,$sql);
		if($result==TRUE) {
			$json["thanhcong"]=1;
			$json["thongbao"]="Huy dang ky thanh cong";
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Huy dang ky that bai";
			echo json_encode($json);
		}
	}
	mysqli_close($conn);
?>
	
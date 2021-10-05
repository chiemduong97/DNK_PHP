<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mapdk=$_POST["mapdk"];
		$trangthai=$_POST["trangthai"];
		$ngaydonghocphi=$_POST["ngaydonghocphi"];
		$tiendong=$_POST["tiendong"];
		$batdau=$_POST["batdau"];
		$ketthuc=$_POST["ketthuc"];
		$cahoc=$_POST["cahoc"];

		$sql="update phieudangky
			  set trangthai='$trangthai',ngaydonghocphi='$ngaydonghocphi',tiendong='$tiendong',batdau='$batdau',ketthuc='$ketthuc',cahoc='$cahoc'
			  where mapdk='$mapdk'";
		$result=mysqli_query($conn,$sql);
		if($result==TRUE) {
			$json["thanhcong"]=1;
			$json["thongbao"]="Xac nhan thanh cong";
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="That bai";
			echo json_encode($json);
		}
		
	}
	mysqli_close($conn);
?>
	
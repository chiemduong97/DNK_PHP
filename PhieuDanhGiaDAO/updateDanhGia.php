<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	$sql="update lop a
		  set a.danhgia = if((select count(*) from phieudanhgia where malop =a.malop group by malop )!=0,
							 (select sum(diem)/count(*) from phieudanhgia where malop =a.malop group by malop ),0)";
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
	mysqli_close($conn);
?>
	
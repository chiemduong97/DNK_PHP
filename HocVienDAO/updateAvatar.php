<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mahv=$_POST["mahv"];
		$avatar=$_POST["avatar"];

		$link="avatar/";
		$linkanh=rand()."_".time().".jpeg";
		$link=$link."/".$linkanh;



		$sql="update hocvien
			  set avatar='$linkanh'
			  where mahv='$mahv'";
		$result=mysqli_query($conn,$sql);
		if($result==TRUE) {
			file_put_contents($link,base64_decode($avatar));
			$json["thanhcong"]=1;
			$json["avatar"]=$linkanh;
			$json["thongbao"]="Thay doi avatar thanh cong";
			echo json_encode($json);
		}	
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Cap nhat that bai";
			echo json_encode($json);
		}
	}
	mysqli_close($conn);
?>
	
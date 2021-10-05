<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$malop=$_POST["malop"];
		$anhminhhoa=$_POST['anhminhhoa'];

	
		$link="anhminhhoa/";
			$linkanh=rand()."_".time().".jpeg";
			$link=$link."/".$linkanh;


			$sql="update lop
				  set anhminhhoa='$linkanh'
				  where malop='$malop'";
			$result=mysqli_query($conn,$sql);
			if($result==TRUE) {
				file_put_contents($link,base64_decode($anhminhhoa));
				$json["thanhcong"]=1;
				$json["thongbao"]="Thay doi anh thanh cong";
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
	
<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mahv=$_POST["mahv"];
	
		$sql="select * from phieudangky where mahv='$mahv' and trangthai='1'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$json["thanhcong"]=1;
			$json["phieudangky"]=array(); 

			while($phieu=mysqli_fetch_array($result)){
				$arr=array();
				$arr["mapdk"]=$phieu["mapdk"];
				$arr["mahv"]=$phieu["mahv"];
				$arr["malop"]=$phieu["malop"];
				$arr["batdau"]=$phieu["batdau"];
				$arr["ketthuc"]=$phieu["ketthuc"];
				$arr["cahoc"]=$phieu["cahoc"];
				$arr["trangthai"]=$phieu["trangthai"];
				array_push($json["phieudangky"],$arr);
			}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Khong co phieu dang ky da xac nhan";
		}
		echo json_encode($json);
	
	}
	mysqli_close($conn);
?>
	
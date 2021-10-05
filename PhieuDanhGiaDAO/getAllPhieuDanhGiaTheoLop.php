<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$malop=$_POST["malop"];
	
		$sql="select * from phieudanhgia where malop='$malop' order by ngaydg desc";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$json["thanhcong"]=1;
			$json["phieudanhgia"]=array(); 
			while($phieu=mysqli_fetch_array($result)){
				$arr=array();
				$arr["mapdg"]=$phieu["mapdg"];
				$arr["mahv"]=$phieu["mahv"];
				$arr["malop"]=$phieu["malop"];
				$arr["diem"]=$phieu["diem"];
				$arr["ngaydg"]=$phieu["ngaydg"];
				$arr["luotthich"]=$phieu["luotthich"];
				$arr["binhluan"]=$phieu["binhluan"];
				array_push($json["phieudanhgia"],$arr);
			}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Khong co phieu danh gia";
		}
		echo json_encode($json);
	}
	mysqli_close($conn);
?>
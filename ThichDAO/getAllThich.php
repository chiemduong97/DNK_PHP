<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$mapdg=$_POST["mapdg"];
		$mahv=$_POST["mahv"];

		$sql="select * from thich where mapdg='$mapdg' and mahv='$mahv'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$json["thanhcong"]=1;
			$json["thich"]=array(); 
			while($thich=mysqli_fetch_array($result)){
				$arr=array();
				$arr["mapdg"]=$thich["mapdg"];
				$arr["mahv"]=$thich["mahv"];
				$arr["trangthai"]=$thich["trangthai"];
				array_push($json["thich"],$arr);
			}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Khong co thich";
		}
		echo json_encode($json);
	}
	echo json_encode($json);
	mysqli_close($conn);
?>
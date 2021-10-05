<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$magv=$_POST["magv"];

		$sql="select * from giangvien where magv='$magv'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$json["thanhcong"]=1;
			$json["giangvien"]=array(); 

			while($gv=mysqli_fetch_array($result)){
				$arr=array();
				$arr["magv"]=$gv["magv"];
				$arr["tengv"]=$gv["tengv"];
				array_push($json["giangvien"],$arr);
			}
		}
		else{
			$json["thanhcong"]=0;
			$json["thongbao"]="Khong co giang vien nay";
		}
		echo json_encode($json);
		
	}
	mysqli_close($conn);
?>
	
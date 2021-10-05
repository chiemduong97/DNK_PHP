<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);	
		$tengv=$_POST["tengv"];

		$sql="select * from giangvien where tengv='$tengv'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($result);//lay so hang
		if($rows>0) {
			$json["thanhcong"]=0;
			$json["thongbao"]="Giang vien da ton tai";
			echo json_encode($json);
		}	
		else{
			$sql="INSERT INTO giangvien
			(tengv) VALUES ('$tengv')";
			if (mysqli_query($conn,$sql) === TRUE) {
				$last_id = mysqli_insert_id($conn);
				$result=mysqli_query($conn,"select * from giangvien where magv='$last_id'");
				$gv=mysqli_fetch_array($result);
				$json["thanhcong"]=1;
				$json["giangvien"]["magv"]=$gv["magv"];
				$json["giangvien"]["tengv"]=$gv["tengv"];
				echo json_encode($json);
			} 
			else {
				$json["thanhcong"]=0;
				$json["thongbao"]="Them that bai";	
				echo json_encode($json);
			}
		}
	}
	mysqli_close($conn);
?>
	
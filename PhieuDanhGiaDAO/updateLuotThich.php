<?php
	$conn=mysqli_connect("localhost","root","","dnk");
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$json=array("thanhcong"=>0);
		$mapdg=$_POST["mapdg"];
		$mahv=$_POST["mahv"];
		$trangthai=$_POST["trangthai"];

		$sql="select * from thich where mapdg='$mapdg' and mahv='$mahv'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$sql="update thich
				  set trangthai='$trangthai'
				  where mapdg='$mapdg' and mahv='$mahv'";
			$result=mysqli_query($conn,$sql);
			if($result==TRUE) {
				if($trangthai==1){
					$sql="update phieudanhgia
							set luotthich=luotthich+1
							where mapdg='$mapdg'";
					$result=mysqli_query($conn,$sql);
					if($result==TRUE){
						$sql="select * from phieudanhgia where mapdg='$mapdg'";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0){
							$json["thanhcong"]=1;
							$json["phieudanhgia"]=array(); 
							while($phieu=mysqli_fetch_array($result)){
								$arr=array();
								$arr["luotthich"]=$phieu["luotthich"];	
								array_push($json["phieudanhgia"],$arr);
							}
						}
						else{
							$json["thanhcong"]=0;
							$json["thongbao"]="Khong tim thay phieu danh gia";
						}
					}
					else{
						$json["thanhcong"]=0;
						$json["thongbao"]="Thich that bai";
					}
				}
				else{
					$sql="update phieudanhgia
							set luotthich=luotthich-1
							where mapdg='$mapdg'";
					$result=mysqli_query($conn,$sql);
					if($result==TRUE){
						$sql="select * from phieudanhgia where mapdg='$mapdg'";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0){
							$json["thanhcong"]=1;
							$json["phieudanhgia"]=array(); 
							while($phieu=mysqli_fetch_array($result)){
								$arr=array();
								$arr["luotthich"]=$phieu["luotthich"];	
								array_push($json["phieudanhgia"],$arr);
							}
						}
						else{
							$json["thanhcong"]=0;
							$json["thongbao"]="Khong tim thay phieu danh gia";
						}
					}
					else{
						$json["thanhcong"]=0;
						$json["thongbao"]="Bo thich that bai";
					}
				}
			}	
			else{
				$json["thanhcong"]=0;
				$json["thongbao"]="Thich that bai";
			}
		}
		else{
			$sql="INSERT INTO thich
				  (mapdg,mahv,trangthai)VALUES 
				  ('$mapdg', '$mahv', '$trangthai')";
			$result=mysqli_query($conn,$sql);
			if($result==TRUE){
				$sql="update phieudanhgia
							set luotthich=luotthich+1
							where mapdg='$mapdg'";
				$result=mysqli_query($conn,$sql);
				if($result==TRUE){
					$sql="select * from phieudanhgia where mapdg='$mapdg'";
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)>0){
						$json["thanhcong"]=1;
						$json["phieudanhgia"]=array(); 
						while($phieu=mysqli_fetch_array($result)){
							$arr=array();
							$arr["luotthich"]=$phieu["luotthich"];	
							array_push($json["phieudanhgia"],$arr);
						}
					}
					else{
						$json["thanhcong"]=0;
						$json["thongbao"]="Khong tim thay phieu danh gia";
					}
				}
				else{
					$json["thanhcong"]=0;
					$json["thongbao"]="Thich that bai";
				}
			}
		}
		echo json_encode($json);
	}
	mysqli_close($conn);
?>
	
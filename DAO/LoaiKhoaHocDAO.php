<?php
	class LoaiKhoaHocDAO{
		public function getAll(){
			include_once("../connect.php");
			$db=new DB_connect();
			$db->connect();
			$sql="select * from loaikhoahoc";
			$result=mysqli_query($db->conn,$sql);
			if(mysqli_num_rows($result)>0){
				$json["thanhcong"]=1;
				$json["loaikhoahoc"]=array(); 

				while($loai=mysqli_fetch_array($result)){
					$arr=array();
					$arr["maloai"]=$loai["maloai"];
					$arr["tenloai"]=$loai["tenloai"];
					array_push($json["loaikhoahoc"],$arr);
				}
			}
			else{
				$json["thanhcong"]=0;
				$json["thongbao"]="Khong co loai khoa hoc";
			}
			echo json_encode($json);
			$db->close();
		}
		public function addLoai(){
			include_once("../connect.php");
			$db=new DB_connect();
			$db->connect();
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$json=array("thanhcong"=>0);	
				$tenloai=$_POST["tenloai"];

				$sql="select * from loaikhoahoc where tenloai='$tenloai'";
				$result=mysqli_query($db->conn,$sql);
				$rows=mysqli_num_rows($result);//lay so hang
				if($rows>0) {
					$json["thanhcong"]=0;
					$json["thongbao"]="Loai khoa hoc da ton tai";
					echo json_encode($json);
				}	
				else{
					$sql="INSERT INTO loaikhoahoc
					(tenloai) VALUES ('$tenloai')";
					if (mysqli_query($db->conn,$sql) === TRUE) {
						$last_id = mysqli_insert_id($db->conn);
						$result=mysqli_query($db->conn,"select * from loaikhoahoc where maloai='$last_id'");
						$loai=mysqli_fetch_array($result);
						$json["thanhcong"]=1;
						$json["loaikhoahoc"]["maloai"]=$loai["maloai"];
						$json["loaikhoahoc"]["tenloai"]=$loai["tenloai"];
						echo json_encode($json);
					} 
					else {
						$json["thanhcong"]=0;
						$json["thongbao"]="Them that bai";	
						echo json_encode($json);
					}
				}
			}
			$db->close();
		}
		public function updateLoai(){
			include_once("../connect.php");
			$db=new DB_connect();
			$db->connect();
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$json=array("thanhcong"=>0);
				$maloai=$_POST["maloai"];
				$tenloai=$_POST["tenloai"];

				$sqlcheck="select * from loaikhoahoc where tenloai='$tenloai' and maloai!='$maloai'";
				$resultcheck=mysqli_query($db->conn,$sqlcheck);
				$rows=mysqli_num_rows($resultcheck);//lay so hang
				if($rows>0) {
					$json["thanhcong"]=0;
					$json["thongbao"]="Loai khoa hoc da ton tai";
					echo json_encode($json);
				}
				else{
					$sql="update loaikhoahoc
						  set tenloai='$tenloai'
						  where maloai='$maloai'";
					$result=mysqli_query($db->conn,$sql);
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
				}
		
			}
			$db->close();
		}
		public function deleteLoai(){
			include_once("../connect.php");
			$db=new DB_connect();
			$db->connect();
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$json=array("thanhcong"=>0);
				$maloai=$_POST["maloai"];
		

				$sql="delete from loaikhoahoc where maloai='$maloai'";
				$result=mysqli_query($db->conn,$sql);
				if($result==TRUE) {
					$json["thanhcong"]=1;
					$json["thongbao"]="Xoa thanh cong";
					echo json_encode($json);
				}	
				else{
					$json["thanhcong"]=0;
					$json["thongbao"]="Co khoa hoc xoa that bai";
					echo json_encode($json);
				}
			}
			$db->close();
		}
	}
?>
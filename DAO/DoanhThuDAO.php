<?php
	class DoanhThuDAO{
		public function getDoanhThuNam(){
			include_once("../connect.php");
			$db=new DB_connect();
			$db->connect();
			$sql="select year(ngaydonghocphi) as nam,sum(tiendong) as tong from phieudangky where trangthai='1' group by year(ngaydonghocphi)";
			$result=mysqli_query($db->conn,$sql);
			if(mysqli_num_rows($result)>0){
				$json["thanhcong"]=1;
				$json["doanhthu"]=array(); 

				while($phieu=mysqli_fetch_array($result)){
					$arr=array();
					$arr["nam"]=$phieu["nam"];
					$arr["tong"]=$phieu["tong"];
					array_push($json["doanhthu"],$arr);
				}
			}
			else{
				$json["thanhcong"]=0;
				$json["thongbao"]="Chua co doanh thu";
			}
			echo json_encode($json);
			$db->close();
		}
		public function getDoanhThuThang(){
			include_once("../connect.php");
			$db=new DB_connect();
			$db->connect();
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$nam=$_POST["nam"];
				$json=array("thanhcong"=>0);	
				$sql="select month(ngaydonghocphi) as thang,sum(tiendong) as tong from phieudangky where year(ngaydonghocphi)='$nam' and trangthai='1' group by month(ngaydonghocphi)";
				$result=mysqli_query($db->conn,$sql);
				if(mysqli_num_rows($result)>0){
					$json["thanhcong"]=1;
					$json["doanhthu"]=array(); 
					while($phieu=mysqli_fetch_array($result)){
						$arr=array();
						$arr["thang"]=$phieu["thang"];
						$arr["nam"]=$nam;
						$arr["tong"]=$phieu["tong"];
						array_push($json["doanhthu"],$arr);
					}
				}
				else{
					$json["thanhcong"]=0;
					$json["thongbao"]="Khong co doanh thu trong thang";
				}
				echo json_encode($json);

			}
			$db->close();
		}
	}
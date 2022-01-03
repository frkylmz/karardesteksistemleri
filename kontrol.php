<?php
session_start();
$baglanti=mysqli_connect("localhost","root","","karardesteksistemleri");
if($baglanti){
	if($_POST){
		if(strip_tags(trim(isset($_POST["email"])))){
			$email=$_POST["email"];
		}
		if(strip_tags(trim(isset($_POST["password"])))){
			$password=$_POST["password"];
		}
        $sorgu=mysqli_query($baglanti,"SELECT * FROM yoneticiler WHERE email='".$email."' and sifre='".$password."'");
        if (mysqli_num_rows($sorgu)>0){
            $row=mysqli_fetch_assoc($sorgu);
            session_regenerate_id();
            $_SESSION['loggedin']=FALSE;
            $_SESSION['gelenid']=$row["yon_id"];
            $_SESSION['ad']=$row["yon_ad"];
            $_SESSION['soyad']=$row["yon_soyad"];
            $_SESSION['departman']=$row["dep_id"];
			$_SESSION['resim']=$row["avatar"];
            echo 1;
        }else{
            echo 0;
        };
		mysqli_close($baglanti);
	}else{
		echo "Veri girilmedi.";
	};
}else{
	die("Bağlantı sorunu.");
};

?>
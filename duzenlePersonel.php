<?php
$baglanti=mysqli_connect("localhost","root","","karardesteksistemleri");

    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit;
    }

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Personel Güncelleme</title>
<link rel="shortcut icon" type="image/jpg" href="img/fartech.png"/>
</head>
<body>

<?php 
$sorgu = mysqli_query($baglanti,"SELECT * FROM personel WHERE per_id =".(int)$_GET['id']);
$sonuc=mysqli_fetch_assoc($sorgu);
?>

<div class="container">
<form action="" method="post">
					<table class="table">
						<tr>
							<td>Personel ID:</td>
							<td><input type="text" name="per_id" class="form-input" value="<?php echo $sonuc['per_id'];?>" ></td>
						</tr>
						<tr>
							<td>Departman ID:</td>
							<td><input type="text" name="dep_id" class="form-input" value="<?php echo $sonuc['dep_id'];?>"></td>
						</tr>
						<tr>
							<td>Personel Ad:</td>
							<td><input type="text" name="per_ad" class="form-input" value="<?php echo $sonuc['per_ad'];?>"></td>
						</tr>
						<tr>
							<td>Personel Soyad:</td> 
							<td><input type="text" name="per_soyad" class="form-input" value="<?php echo $sonuc['per_soyad'];?>"></td>
						</tr>
						<tr>
							<td>Başarılı Görev:</td>
							<td><input type="text" name="basarili_gorev" class="form-input" value="<?php echo $sonuc['basarili_gorev'];?>"></td>
						</tr>
						<tr>
							<td>Başarısız Görev:</td>
							<td><input type="text" name="basarisiz_gorev" class="form-input" value="<?php echo $sonuc['basarisiz_gorev'];?>"></td>
						</tr>
						<tr>
							<td>Personel Maaş:</td>
							<td><input type="text" name="per_maas" class="form-input" value="<?php echo $sonuc['per_maas'];?>"></td>
						</tr>
						<tr>
							<td>Çalışılan Gün:</td>
							<td><input type="text" name="calisilanGun" class="form-input" value="<?php echo $sonuc['calisilanGun'];?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input id="tableButton" type="submit" value="Ekle"></td>
						</tr>
					</table>
				</form>

</form>
</div>
<?php 

if ($_POST) { 
    
    $personelID = $_POST['per_id']; 
    $departmanID = $_POST['dep_id'];
	$personelAd = $_POST['per_ad'];
	$personelSoyad = $_POST['per_soyad'];
	$basariliGorev = $_POST['basarili_gorev'];
	$basarisiz_gorev = $_POST['basarisiz_gorev'];
	$personelMaas = $_POST['per_maas'];
	$calisilanGun = $_POST['calisilanGun'];

    if ($personelID!="" && $departmanID!="") { 
        
        
        if ($baglanti)
        {	
			$sorgu=mysqli_query($baglanti,"UPDATE personel SET per_id = '$personelID', dep_id = '$departmanID', per_ad = '$personelAd', per_soyad = '$personelSoyad',  basarili_gorev = '$basariliGorev',  basarisiz_gorev = '$basarisiz_gorev',  per_maas = '$personelMaas', calisilanGun = '$calisilanGun' WHERE per_id =".$_GET['id']);
			if($sorgu){
				header("location:calisanlar.php"); 
			}          
        }
        else
        {
            echo "Hata oluştu"; 
        }
    }
}
?>
</body>
</html>
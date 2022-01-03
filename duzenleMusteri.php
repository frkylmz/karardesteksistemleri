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
<title>Müşteri Güncelleme</title>
<link rel="shortcut icon" type="image/jpg" href="img/fartech.png"/>
</head>
<body>

<?php 
$sorgu = mysqli_query($baglanti,"SELECT * FROM musteriler WHERE mus_id =".(int)$_GET['id']);
$sonuc = mysqli_fetch_assoc($sorgu);
?>

<div class="container">
<form action="" method="post">
					<table class="table">
						<tr>
							<td>Müşteri ID:</td>
							<td><input type="text" name="mus_id" class="form-input" value="<?php echo $sonuc['mus_id'];?>" ></td>
						</tr>
						<tr>
							<td>Personel ID:</td>
							<td><input type="text" name="per_id" class="form-input" value="<?php echo $sonuc['per_id'];?>"></td>
						</tr>
						<tr>
							<td>Müşteri Ad:</td>
							<td><input type="text" name="mus_ad" class="form-input" value="<?php echo $sonuc['mus_ad'];?>"></td>
						</tr>
						<tr>
							<td>Müşteri Soyad:</td> 
							<td><input type="text" name="mus_soyad" class="form-input" value="<?php echo $sonuc['mus_soyad'];?>"></td>
						</tr>
						<tr>
							<td>Değerlendirme</td>
							<td><input type="text" name="degerlendirme" class="form-input" value="<?php echo $sonuc['degerlendirme'];?>"></td>
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
    
    $musteriID = $_POST['mus_id']; 
    $personelID = $_POST['per_id'];
	$musteriAd = $_POST['mus_ad'];
	$musteriSoyad = $_POST['mus_soyad'];
	$degerlendirme = $_POST['degerlendirme'];
	
    if ($musteriID!="" && $personelID!="") { 
        
        
        if ($baglanti)
        {	
			$sorgu=mysqli_query($baglanti,"UPDATE musteriler SET mus_id = '$musteriID', per_id = '$personelID', mus_ad = '$musteriAd', mus_soyad = '$musteriSoyad',  degerlendirme = '$degerlendirme' WHERE mus_id =".$_GET['id']);
			if($sorgu){
				header("location:musteriler.php"); 
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
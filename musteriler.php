<?php
setcookie("cookie_name","cookie_value",["samesite"=>"None"]);
session_start();
?>
<?php
$baglanti=mysqli_connect("localhost","root","","karardesteksistemleri");

    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Müşteriler</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/musterilerstyle.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="shortcut icon" type="image/jpg" href="img/fartech.png"/>
    </head>
    <body>
        <div class="sidebar">
            <div class="sidebarLogo">
                <a href="main.php" class="logo">
                    <b>
                        FAR-<span class="TECH">TECH</span>
                    </b>
                </a>
            </div>
			<div class="profile">
				<img id="profile-pic" src="<?php echo $_SESSION["resim"] ?>">
				<span>
				<?php 
				$ad =$_SESSION["ad"];
				$soyad =$_SESSION["soyad"]; 
				echo $ad." ".$soyad;
				?>
				</span>
			</div>
			<ul class="side-menu">
				<li class="menu">
					<a href="main.php">
						<i class="fas fa-home"></i>
						<span>Ana Sayfa</span>
					</a>
				</li>
				<li class="menu">
					<a href="calisanlar.php#">
						<i class="fas fa-briefcase"></i>
						<span>Personeller</span>
					</a>
				</li>
				<li class="menu">
					<a href="musteriler.php">
						<i class="fas fa-user"></i>
						<span>Müşteriler</span>
					</a>
				</li>
				<li class="menu">
					<a href="departmanlar.php">
						<i class="fas fa-city"></i>
						<span>Departmanlar</span>
					</a>
				</li>
				<li class="menu">
					<a href="gorevler.php">
						<i class="fas fa-tasks"></i>
						<span>Görevler</span>
					</a>
				</li>
			</ul>
			
        </div>
        <div class="content">
			<header class="header">
				<ul class="navbar">	
					<li class="navbar-item">
						<a href="mesajlar.php">
							<i class="fas fa-inbox"></i>
							<span id="bell-span">5</span>
						</a>
					</li>
				</ul>
				<a id="logout" href="index.php">Çıkış Yap</a>
			</header>
			<div class="musterilerHeader">
				<i class="fa fa-angle-right"></i>
				<h3>MÜŞTERİ İŞLEMLERİ</h3>
			</div>
			<div class="form-container">
				<div class="musteriAdd">
				<span>Müşteri Ekle</span>
				<form action="" method="post">
					<table class="table">
						<tr>
							<td>Müşteri ID:</td>
							<td><input type="text" name="musteriID" class="form-input" ></td>
						</tr>
						<tr>
							<td>Personel ID:</td>
							<td><input type="text" name="personelID" class="form-input" ></td>
						</tr>
						<tr>
							<td>Müşteri Ad:</td>
							<td><input type="text" name="musteriAd" class="form-input" ></td>
						</tr>
						<tr>
							<td>Müşteri Soyad:</td> 
							<td><input type="text" name="musteriSoyad" class="form-input" ></td>
						</tr>
						<tr>
							<td>Değerlendirme:</td>
							<td><input type="text" name="degerlendirme" class="form-input" ></td>
						</tr>
						<tr>
							<td></td>
							<td><input id="tableButton" type="submit" value="Ekle"></td>
						</tr>
					</table>
				</form>
				</div>
				<?php
					if ($_POST) {
						$musteriID = $_POST['musteriID'];
						$personelID = $_POST['personelID']; 
						$musteriAd = $_POST['musteriAd'];
						$musteriSoyad = $_POST['musteriSoyad'];
						$degerlendirme = $_POST['degerlendirme'];
						if ($musteriID!="" && $personelID!="" && $musteriAd!="" && $musteriSoyad!="") { 
							if ($baglanti){
								$sorgu=mysqli_query($baglanti,"INSERT INTO musteriler(mus_id, per_id, mus_ad, mus_soyad, degerlendirme) VALUES('$musteriID','$personelID','$musteriAd','$musteriSoyad','$degerlendirme')");
							}else{
								die("Bağlantı sorunu oluştu.");
							};
						};

					};

				?>
				<span id="personelGoster">Personel Listesi</span>
				<div class="personelList">
					<table class="table" style="text-align:center">
						<tr>
							<th class="personellistCol">ID</th>
							<th class="personellistCol">AD</th>
							<th class="personellistCol">SOYAD</th>
							<th class="personellistCol">DEPARTMAN</th>
							<th class="personellistCol" style="width:131px">DEPARTMAN ID</th>
							
						</tr>

						
				<?php
					if($baglanti){
						$sorgu = $baglanti->query("SELECT personel.per_id, personel.per_ad, personel.per_soyad, departmanlar.dep_ad, personel.per_maas, departmanlar.dep_id, puan.verimlilik_puan FROM personel, puan, departmanlar WHERE personel.per_id=puan.per_id AND personel.dep_id=departmanlar.dep_id");
					}else{
						echo "Başarısız sorgu.";
					}
					while ($sonuc = $sorgu->fetch_assoc()) {
						$departmanAd = $sonuc['dep_ad'];
						$departmanID = $sonuc['dep_id'];
						$personelAd = $sonuc['per_ad'];
						$personelSoyad = $sonuc['per_soyad'];
						$personelID = $sonuc['per_id'];
				?>
					<tr>
						<td class="personelcol1"><?php echo $personelID;?></td>
						<td class="personelcol1"><?php echo $personelAd;?></td>
						<td class="personelcol1"><?php echo $personelSoyad; ?></td>
						<td class="personelcol1"><?php echo $departmanAd; ?></td>
						<td class="personelcol1"><?php echo $departmanID; ?></td>

						

						   
					</tr>
				<?php
					}
				?>
					</table>
				</div>
			</div>
			<div class="report">
					<span>MÜŞTERİ LİSTESİ</span>
					<table class="table" style="text-align:center">
						<tr>
							<th>MÜŞTERİ ID</th>
							<th>AD</th>
							<th>SOYAD</th>
							<th>ATANAN PERSONEL</th>
							<th>PERSONEL ID</th>
							<th>DEĞERLENDİRME</th>
						</tr>
				<?php
					if($baglanti){
						$sorgu = $baglanti->query("SELECT * FROM musteriler,personel WHERE personel.per_id = musteriler.per_id GROUP BY musteriler.mus_id");
					}else{
						echo "Başarısız sorgu.";
					}
					while ($sonuc = $sorgu->fetch_assoc()) {
						$musteriID = $sonuc['mus_id'];
						$musteriAd = $sonuc['mus_ad'];
						$musteriSoyad = $sonuc['mus_soyad'];
						$atananPersonelAd = $sonuc['per_ad'];
						$atananPersonelSoyad = $sonuc['per_soyad'];
						$atananPersonelID = $sonuc['per_id'];
						$degerlendirme = $sonuc['degerlendirme'];
				?>
					<tr>
						<td class="mustericol"><?php echo $musteriID;?></td>
						<td class="mustericol"><?php echo $musteriAd; ?></td>
						<td class="mustericol"><?php echo $musteriSoyad; ?></td>
						<td class="mustericol"><?php echo $atananPersonelAd." ".$atananPersonelSoyad; ?></td>
						<td class="mustericol"><?php echo $atananPersonelID;?></td>				
						<td class="mustericol"><?php echo $degerlendirme;?></td>
						<td><a type="button" href="duzenleMusteri.php?id=<?php echo $musteriID; ?>" id="editButton"><i class="fa fa-cog"></i> Düzenle</a></td>
						<td><a href="silMusteri.php?id=<?php echo $musteriID; ?>" id="silButton"><i class="fas fa-times"></i> Müşteri Sil</a></td>
					</tr>
				<?php
					}
				?>
					</table>			
			<div>

        </div>
        
    </body>
</html>
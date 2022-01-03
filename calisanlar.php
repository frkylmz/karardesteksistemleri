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
        <title>Personeller</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/calisanlarstyle.css">
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
					<a href="calisanlar.php">
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
							<span class="bell-span">5</span>
						</a>
					</li>
				</ul>
				<a id="logout" href="index.php">Çıkış Yap</a>
			</header>
			<div class="personelHeader">
				<i class="fas fa-angle-right"></i>
				<h3>PERSONEL İŞLEMLERİ</h3>
			</div>
			<div class="form-container">
				<div class="personelAdd">
				<span id="personelAddHeader">Personel Ekle</span>
				<form action="" method="post">
					<table class="table">
						<tr>
							<td>Personel ID:</td>
							<td><input type="text" name="personelID" class="form-input" ></td>
						</tr>
						<tr>
							<td>Departman ID:</td>
							<td><input type="text" name="departmanID" class="form-input" ></td>
						</tr>
						<tr>
							<td>Personel Ad:</td>
							<td><input type="text" name="personelAd" class="form-input" ></td>
						</tr>
						<tr>
							<td>Personel Soyad:</td> 
							<td><input type="text" name="personelSoyad" class="form-input" ></td>
						</tr>
						<tr>
							<td>Başarılı Görev:</td>
							<td><input type="text" name="basariliGorev" class="form-input" ></td>
						</tr>
						<tr>
							<td>Başarısız Görev:</td>
							<td><input type="text" name="basarisiz_gorev" class="form-input" ></td>
						</tr>
						<tr>
							<td>Personel Maaş:</td>
							<td><input type="text" name="personelMaas" class="form-input" ></td>
						</tr>
						<tr>
							<td>Görevlerde Çalışılan Gün:</td>
							<td><input type="text" name="calisilanGun" class="form-input" ></td>
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
						$personelID = $_POST['personelID']; 
						$departmanID = $_POST['departmanID'];
						$personelAd = $_POST['personelAd'];
						$personelSoyad = $_POST['personelSoyad'];
						$basariliGorev = $_POST['basariliGorev'];
						$basarisiz_gorev = $_POST['basarisiz_gorev'];
						$personelMaas = $_POST['personelMaas'];
						$calisilanGun = $_POST['calisilanGun'];

						if ($personelID!="" && $departmanID!="" && $personelAd!="" && $personelSoyad!="" && $basariliGorev!="" && $basarisiz_gorev!="" && $personelMaas!="" && $calisilanGun!="") { 
							if ($baglanti){
								$sorgu=mysqli_query($baglanti,"INSERT INTO personel(per_id, dep_id, per_ad, per_soyad, basarili_gorev, basarisiz_gorev, per_maas, calisilanGun) VALUES('$personelID','$departmanID','$personelAd','$personelSoyad','$basariliGorev','$basarisiz_gorev','$personelMaas','$calisilanGun')");
							}else{
								die("Bağlantı sorunu oluştu.");
							};
						};

					};

				?>
				<div class="personelList">
					<table class="table" style="text-align:center">
						<tr>
							<th>ID</th>
							<th>AD</th>
							<th>SOYAD</th>
							<th>DEPARTMAN</th>
							<th>DEPARTMAN ID</th>
							<th>MAAŞ</th>
							<th>VERİMLİLİK PUANI</th>
						</tr>
				<?php
					if($baglanti){
						$sorgu = $baglanti->query("SELECT personel.per_id, personel.per_ad, personel.per_soyad, departmanlar.dep_ad, personel.per_maas, departmanlar.dep_id, puan.verimlilik_puan FROM personel, puan, departmanlar WHERE personel.per_id=puan.per_id AND personel.dep_id=departmanlar.dep_id GROUP BY personel.per_id" );
					}else{
						echo "Başarısız sorgu.";
					}
					while ($sonuc = $sorgu->fetch_assoc()) {
						$departmanAd = $sonuc['dep_ad'];
						$personelAd = $sonuc['per_ad'];
						$personelMaas = $sonuc['per_maas'];
						$personelSoyad = $sonuc['per_soyad'];
						$verimlilikPuan = $sonuc['verimlilik_puan'];
						$personelID = $sonuc['per_id'];
						$departmanID = $sonuc['dep_id'];
				?>
					<tr>
						<td class="personelcol"><?php echo $personelID;?></td>
						<td class="personelcol"><?php echo $personelAd;?></td>
						<td class="personelcol"><?php echo $personelSoyad; ?></td>
						<td class="personelcol"><?php echo $departmanAd; ?></td>
						<td class="personelcol"><?php echo $departmanID; ?></td>
						<td class="personelcol"><?php echo $personelMaas; ?></td>
						<td class="personelcol"><?php echo $verimlilikPuan; ?></td>
						<td><a type="button" href="duzenlePersonel.php?id=<?php echo $personelID; ?>" id="editButton"><i class="fa fa-cog"></i> Düzenle</a></td>
					</tr>
				<?php
					}
				?>
					</table>
				</div>
			</div>
			
			<div class="report">
					<span>PERSONEL ANALİZİ</span>
					<table class="table" style="text-align:center">
						<tr>
							<th>PERSONEL ID</th>
							<th>AD</th>
							<th>SOYAD</th>
							<th>DEPARTMAN</th>
							<th>DEPARTMAN ID</th>
							<th>MAAŞ</th>
							<th>VERİMLİLİK ORANI</th>
							<th>BAŞARI ORANI</th>
							<th>YILLIK PERFORMANS</th>
						</tr>
				<?php
					if($baglanti){
						$sorgu = $baglanti->query("SELECT ROUND(personel.basarili_gorev/personel.basarisiz_gorev,1) as basariOrani, personel.per_id, personel.per_ad, personel.per_soyad, departmanlar.dep_ad, departmanlar.dep_id, personel.per_maas, puan.verimlilik_puan FROM personel, puan, departmanlar WHERE personel.per_id=puan.per_id AND personel.dep_id=departmanlar.dep_id");
					}else{
						echo "Başarısız sorgu.";
					}
					while ($sonuc = $sorgu->fetch_assoc()) {
						$personelID = $sonuc['per_id'];
						$departmanAd = $sonuc['dep_ad'];
						$departmanID = $sonuc['dep_id'];
						$personelAd = $sonuc['per_ad'];
						$personelMaas = $sonuc['per_maas'];
						$personelSoyad = $sonuc['per_soyad'];
						$verimlilikPuan = $sonuc['verimlilik_puan'];
						$basariOrani = $sonuc['basariOrani'];
				?>
					<tr>
						<td class="personelcol"><?php echo $personelID;?></td>
						<td class="personelcol"><?php echo $personelAd;?></td>
						<td class="personelcol"><?php echo $personelSoyad; ?></td>
						<td class="personelcol"><?php echo $departmanAd; ?></td>
						<td class="personelcol"><?php echo $departmanID; ?></td>
						<td class="personelcol"><?php echo $personelMaas; ?></td>
                        
						<td class="personelcol"><?php if($verimlilikPuan>0 && $verimlilikPuan<41){echo "Düşük";}elseif($verimlilikPuan>40 && $verimlilikPuan<76){echo "Orta"; }elseif($verimlilikPuan>75){echo "Yüksek";}else{echo "Belirsiz";};;;;?></td>
                        
						<td class="personelcol"><?php if($basariOrani>0 && $basariOrani<2){echo "Çok düşük";}elseif($basariOrani>1 && $basariOrani<3){echo "Düşük";}elseif($basariOrani>2 && $basariOrani<6){echo "Orta";}elseif(5<$basariOrani){echo "Yüksek";}else{echo "Belirsiz";};;;;;?></td>
                        
						<td class="personelcol"><?php if($basariOrani>0 && $basariOrani<2 && $verimlilikPuan>0 && $verimlilikPuan<41){echo "Çok düşük performans.";}elseif($basariOrani>5 && $basariOrani<11 && $verimlilikPuan>40 && $verimlilikPuan<76){echo "Ortalama yıllık performans.";}elseif(5<$basariOrani&&$verimlilikPuan>75){echo "Yüksek yıllık performans.";}elseif(($basariOrani>0 && $basariOrani<2)||($basariOrani>1 && $basariOrani<3)){echo "Düşük performans.";}elseif(($basariOrani>2 && $basariOrani<6) && $verimlilikPuan>75){echo "Yüksek yıllık performans.";}elseif(($basariOrani>2 && $basariOrani<6) && ($verimlilikPuan>0 && $verimlilikPuan<41)){echo "Düşük yıllık performans.";};;;;;;;?></td>
						   
					</tr>
				<?php
					}
				?>
					</table>			
			</div>
        </div>
    </body>
</html>
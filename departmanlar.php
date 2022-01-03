<?php
setcookie("cookie_name","cookie_value",["samesite"=>"None"]);
session_start();
?>
<?php
$baglanti = mysqli_connect("localhost","root","","karardesteksistemleri");
$departman_ad = mysqli_query($baglanti,"SELECT dep_ad FROM departmanlar");
$departman_ad2 = mysqli_query($baglanti,"SELECT dep_ad FROM departmanlar");
$departman_ad3 = mysqli_query($baglanti,"SELECT dep_ad FROM departmanlar");
$kar_sorgu = mysqli_query($baglanti,"SELECT SUM(dep_ay.kar*12) as kar FROM departmanlar,dep_ay WHERE departmanlar.dep_id=dep_ay.dep_id GROUP BY departmanlar.dep_ad");
$maas_sorgu=mysqli_query($baglanti,"SELECT SUM(personel.per_maas*12) as maas_toplam FROM departmanlar,personel WHERE departmanlar.dep_id=personel.dep_id GROUP BY departmanlar.dep_ad");
$gelir_gider=mysqli_query($baglanti,"SELECT(SELECT SUM(personel.per_maas*12) FROM personel,departmanlar WHERE departmanlar.dep_id=personel.dep_id) AS gider,(SELECT SUM(dep_ay.kar*12)FROM dep_ay,departmanlar WHERE dep_ay.dep_id=departmanlar.dep_id)AS gelir");
$gelir_gider2=mysqli_query($baglanti,"SELECT(SELECT SUM(personel.per_maas*12) FROM personel,departmanlar WHERE departmanlar.dep_id=personel.dep_id) AS gider,(SELECT SUM(dep_ay.kar*12)FROM dep_ay,departmanlar WHERE dep_ay.dep_id=departmanlar.dep_id)AS gelir");
$musteri_sayisi=mysqli_query($baglanti,"SELECT dep_ad, COUNT(musteriler.mus_id) as musteriSayisi FROM musteriler,personel,departmanlar WHERE musteriler.per_id=personel.per_id AND departmanlar.dep_id=personel.dep_id GROUP BY departmanlar.dep_ad");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Departmanlar</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/departmanlarstyle.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="shortcut icon" type="image/jpg" href="img/fartech.png"/>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		
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
						<span>Anasayfa</span>
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
			<div class="departmanHeader">
				<i class="fa fa-angle-right"></i>
				<h3>DEPARTMAN İŞLEMLERİ</h3>
			</div>
			<div class="charts">
				<div class="chart-container">
					<h5>Departmanların 2021 Yılı Toplam Geliri</h5>
					<canvas id="departman-gelir" style="display: block; width: 540px; height: 270px;"></canvas>
					<span>Toplam Gelir:<?php while ($sonuc7=mysqli_fetch_assoc($gelir_gider)) { echo $sonuc7['gelir'];}?></span>
				</div>

				<script>
					var ctx = document.getElementById('departman-gelir').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'pie',
						data: {
							labels: [<?php while ($sonuc=mysqli_fetch_assoc($departman_ad)) { echo '"' . $sonuc['dep_ad'] . '",';}?>],
							datasets: [{
								label: '',
								backgroundColor: [
									"#1da1f2",
									"#DC3545",
									"#FFC107",
									
								],
								data: [<?php while ($sonuc2=mysqli_fetch_assoc($kar_sorgu)) { echo '"' . $sonuc2['kar'] . '",';}?>]
							}]
						},
						options: {
							responsive: false,
							legend:{
								labels:{
									fontColor:"#22242a",
								}
							}
							
						}
					});
				</script>
				<div class="chart-container">
					<h5>Departmanların 2021 Yılı Toplam Gideri</h5>
					<canvas id="departman-gider" style="display: block; width: 540px; height: 270px;"></canvas>
					<span>Toplam Gider:<?php while ($sonuc8=mysqli_fetch_assoc($gelir_gider2)) { echo $sonuc8['gider'];}?></span>
				</div>
				<script>
					var ctx2 = document.getElementById('departman-gider').getContext('2d');
					var chart2 = new Chart(ctx2, {
						type: 'pie',
						data: {
							labels: [<?php while ($sonuc3=mysqli_fetch_assoc($departman_ad2)) { echo '"' . $sonuc3['dep_ad'] . '",';}?>],
							datasets: [{
								label: '',
								backgroundColor: [
									"#1da1f2",
									"#DC3545",
									"#FFC107",
									
								],
								data: [<?php while ($sonuc4=mysqli_fetch_assoc($maas_sorgu)) { echo '"' . $sonuc4['maas_toplam'] . '",';}?>]
							}]
						},
						options: {
							responsive: false,
							legend:{
								labels:{
									fontColor:"#22242a",
								}
							}
							
						}
					});
				</script>
				<div class="chart-container ozelGrafik">
					<h5>Departmanların Mevcut Müşteri Sayıları</h5>
					<canvas id="musteri-sayisi" style="display: block; width: 540px; height: 270px;"></canvas>
					<span id="toplam-musteri">Toplam Müşteri:</span>
				</div>
				<script>
					var ctx2 = document.getElementById('musteri-sayisi').getContext('2d');
					var chart2 = new Chart(ctx2, {
						type: 'pie',
						data: {
							labels: [<?php while ($sonuc6=mysqli_fetch_assoc($departman_ad3)) { echo '"' . $sonuc6['dep_ad'] . '",';}?>],
							datasets: [{
								label: '',
								backgroundColor: [
									"#1da1f2",
									"#DC3545",
									"#FFC107",
									
								],
								data: [<?php while ($sonuc8=mysqli_fetch_assoc($musteri_sayisi)) { echo '"' . $sonuc8['musteriSayisi'] . '",';}?>]
							}]
						},
						options: {
							responsive: false,
							legend:{
								labels:{
									fontColor:"#22242a",
								}
							}
							
						}
					});
				</script>
			</div>
        </div>
    </body>
	<script>
		$(document).ready(function(){
			$.post("getirMusteri.php",function(data,status){
			$("#toplam-musteri").html("Toplam Müşteri: "+data);
			});
		});
	</script>
</html>
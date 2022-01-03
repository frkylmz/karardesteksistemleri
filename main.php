<?php
setcookie("cookie_name","cookie_value",["samesite"=>"None"]);
session_start();
?>
<?php
$baglanti = mysqli_connect("localhost","root","","karardesteksistemleri");
$ay_sorgu = mysqli_query($baglanti,"SELECT ay_ad FROM aylar");
$kar_sorgu = mysqli_query($baglanti,"SELECT SUM(dep_ay.kar*12) as kar FROM departmanlar,dep_ay,aylar WHERE aylar.ay_id = dep_ay.ay_id AND dep_ay.dep_id = departmanlar.dep_id GROUP BY ay_ad");
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
        <title>Ana Sayfa</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/mainstyle.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="shortcut icon" type="image/jpg" href="img/fartech.png"/>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    </head>
    <body>
        <div class="sidebar">
            <div class="sidebarLogo">
                <a href="main.php" class="logo">
                    <b>
                        FAR-<span id="TECH">TECH</span>
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
			<div  class="informations">
				<h1 id="bilgiBaslik">Genel Bilgiler</h1>
				<div style="background-color:#1da1f2;" class="box">
					<div class="box-header"><h5>Personel Sayısı</h5></div>
					<i class="fa fa-user box-logo"></i>
					<span class= "box-span" id="box-span1">Toplam Personel</span>
				</div>
				<div style="background-color:#28A745;" class="box">
					<div class="box-header"><h5>Müşteri Değerlendirmeleri</h5></div>
					<i class="fas fa-grin-beam box-logo"></i>
					<span class= "box-span" id="box-span2"></span>
				</div>
				<div style="background-color:#FFA500;"  class="box">
					<div class="box-header"><h5>Müşteri İstatistikleri</h5></div>
					<i class="fas fa-clipboard box-logo"></i>
					<span class="box-span" id="box-span3"></span>
				</div>
			</div>
			<div class="chart">
				<canvas id="personelChart"></canvas>
				<script>
					var miktar=[<?php while ($sonuc2=mysqli_fetch_assoc($kar_sorgu)) { echo '"' . $sonuc2['kar'] . '",';}?>];
					var aylar=[<?php while ($sonuc=mysqli_fetch_assoc($ay_sorgu)) { echo '"' . $sonuc['ay_ad'] . '",';}?>];
		
					var kanvas = document.getElementById('personelChart').getContext('2d');
					var chart = new Chart(kanvas, {
						type: "bar",
						data: { 
							labels: aylar,
							datasets: [{
								label: 'Toplam Şirket Kazancı',
								backgroundColor: "rgb(52,58,64)",		
								borderColor: "rgb(52,58,64)",
								data: miktar,
							
				}]
			},
			options: {
				legend:{
					labels: {
						fontColor:'rgb(52,58,64)'
					}
				},
				scales: {
					yAxes: [{
						ticks:{
							fontColor:"rgb(52,58,64)",
							beginAtZero: true,							
						}
					}],
					xAxes:[{
						ticks:{
							fontColor:"rgb(52,58,64)"
						}
					}]
				}
			}
		});
				</script>
			</div>
            

        </div>
        
    </body>
	<script>
		$(document).ready(function(){
			$.post("getirPersonel.php",function(data,status){
			$("#box-span1").html(data+" Toplam Personel");
			});
			
			$.post("getirDegerlendirme.php",function(data,status){
			$("#box-span2").html(data+"/10");
			});
			
			$.post("getirMusteri.php",function(data,status){
			$("#box-span3").html(data+" Toplam Müşteri");
			});
		});
	</script>
</html>
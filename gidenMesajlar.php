<?php
setcookie("cookie_name","cookie_value",["samesite"=>"None"]);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Giden Kutusu</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/gidenMesajlarstyle.css">
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
			<div class="mailContainer">
				<div class="emailInfo">
					<a id="mail-create" href="emailCreate.php"><i class="fa fa-pencil"></i>Mail Gönder</a>
					<ul class="email-navbar">
						<li class="li-inbox"><a href="mesajlar.php" ><i class="fa fa-inbox"></i>Gelen Kutusu<span>5</span></a></li>

						<li class="li-inbox"><a href="gidenMesajlar.php" ><i class="fa fa-inbox"></i>Giden Kutusu<span>3</span></a></li>

						<li class="li-inbox"><a href="onemliMesajlar.php" ><i class="fas fa-exclamation"></i>Önemli Postalar<span>1</span></a></li>


					</ul>
				</div>
				<div class="inboxContainer">
					<div class="inbox-header">
						<span>Giden Kutusu (3)</span>
					</div>
					<div class="inbox-body">
						<div class="mail-options">
						
							<div class="check-container">
								<input type="checkbox" id="check-mail" name="checkall" value="">
							</div>
							<div class="refresh-container">
								<a href="gidenMesajlar.php"><i class=" fa fa-refresh"></i></a>
							</div>
						</div>
						<div class="mail-box">
							<table class="mail-table">
								<tr>
									<td>
										<a href="#"><input type="checkbox" class="mail-checkbox1"></a>
									</td>
									<td>
										<a href="#"><i class="fa fa-star mail-star"></i></a>
									</td>
									<td>
										<a href="#" class="mail-text">Ömer YILMAZ</a>
									</td>
									<td>
										<a href="#" class="mail-text">Toplantıyı yarın saat 13:30'a aldım. Yönetim kuruluna haber ver.</a>
									</td>
									<td class="mail-paperclip">
										<a href="#"><i style="color:red;" class="fas fa-exclamation"></i><a>
									</td>
									<td class="mail-clock"><a href="#">12:30<a></td>
								</tr>
								<tr>
									<td>
										<a href="#"><input type="checkbox" class="mail-checkbox"></a>
									</td>
									<td>
										<a href="#"><i class="fa fa-star mail-star"></i></a>
									</td>
									<td>
										<a href="#" class="mail-text">Tayfun DAĞCI</a>
									</td>
									<td>
										<a href="#" class="mail-text">Bu hafta izinlisin. En yakın zamanda testini ol.</a>
									</td>
									<td class="mail-paperclip">
										<a href="#"><a>
									</td>
									<td class="mail-clock"><a href="#">27 Aralık 2021<a></td>
								</tr>
								<tr>
									<td>
										<a href="#"><input type="checkbox" class="mail-checkbox"></a>
									</td>
									<td>
										<a href="#"><i class="fa fa-star mail-star"></i></a>
									</td>
									<td>
										<a href="#" class="mail-text">Merve YILMAZ</a>
									</td>
									<td>
										<a href="#" class="mail-text">Toplantı ile ilgili ayarlamaları en kısa sürede gerçekleştireceğim.</a>
									</td>
									<td class="mail-paperclip">
										<a href="#"><i class="fa fa-paperclip"></i><a>
									</td>
									<td class="mail-clock"><a href="#">25 Aralık 2021<a></td>
								</tr>
								
							</table>
						</div>
					</div>
				</div>
			</div>
        </div>
        
    </body>
</html>
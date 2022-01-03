<?php
setcookie("cookie_name","cookie_value",["samesite"=>"None"]);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Görevler</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/gorevler.css">
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
				<div class="inboxContainer">
					<div class="inbox-header">
						<span>Görevler</span>
					</div>
					<div class="inbox-body">
						<div class="mail-options">
						
							<div class="check-container">
								<input type="checkbox" id="check-mail" name="checkall" value="">
							</div>
							<div class="refresh-container">
								<a href="gorevler.php"><i class=" fa fa-refresh"></i></a>
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
										<a href="#" class="mail-text">Tayfun DAĞCI</a>
									</td>
									<td>
										<a href="#" class="mail-text">Facebook şirketinin Front-End departmanıyla görüşme yapacak.</a>
									</td>
									<td class="mail-paperclip">
										<a href="#"><i style="color:red;" class="fas fa-hourglass-half"></i><a>
									</td>
									<td class="mail-clock"><a href="#">15 Ocak 2022<a></td>
								</tr>

                                <tr>
									<td>
										<a href="#"><input type="checkbox" class="mail-checkbox"></a>
									</td>
									<td>
										<a href="#"><i class="fa fa-star mail-star"></i></a>
									</td>
									<td>
										<a href="#" class="mail-text">Batuhan GÜZEL</a>
									</td>
									<td>
										<a href="#" class="mail-text">Personellerin maaşlarının takibini yapacak.</a>
									</td>
									<td class="mail-paperclip">
										<a href="#"><i style="color:orange" class="fa fa-exclamation-circle"></i><a>
									</td>
									<td class="mail-clock"><a href="#">29 Aralık 2021<a></td>
								</tr>
								<tr>
									<td>
										<a href="#"><input type="checkbox" class="mail-checkbox1"></a>
									</td>
									<td>
										<a href="#"><i class="fa fa-star mail-star"></i></a>
									</td>
									<td>
										<a href="#" class="mail-text">Bengisu TAŞDELEN</a>
									</td>
									<td>
										<a href="#" class="mail-text">Apple şirketinin Back-End kısmının kontrollerini yapacak.</a>
									</td>
									<td class="mail-paperclip">
										<a href="#"><i style="color:green;" class="fas fa-check"></i><a>
									</td>
									<td class="mail-clock"><a href="#">26 Aralık 2021<a></td>
								</tr>
								
								</tr>
							</table>
						</div>
                        <div class="form-bar" style="margin-left:770px">
							<td><input id="tableButton" type="submit" value="Ekle"></td>
					    </div>
					</div>
				</div>
			</div>
        </div>
        
    </body>
</html>
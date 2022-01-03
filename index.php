<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hoşgeldiniz</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/fd62530fb9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssdosyalari/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" type="image/jpg" href="img/fartech.png"/>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
        <script>
            $(document).ready(function(){
                $("#login-btn").click(function(){
                    $.post("kontrol.php",{
                        email:$("#email").val(),
                        password:$("#password").val()
                    },function(data,status){
                        if(data==1){
                            $(location).attr("href","main.php");
                        }else{
                            alert("Kullanıcı adı veya şifre hatalı.");
                        };
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="content-container">
            <span class="container-header">Giriş Yap</span>
            <input type="text" id="email" placeholder="Kullanıcı Adı">
            <input type="password" id="password" placeholder="Şifre">
            <div class="forgot">
                <a href="#" id="forgot-pass">Şifremi Unuttum</a>
            </div>
            <button id="login-btn">Giriş</button>
        </div>
        
    </body>
</html>
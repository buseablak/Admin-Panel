

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Giriş</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="container-login100" style="background-image: url('images/admin.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<span class="login100-form-title p-b-37">
				Giriş
			</span>

			<small>
				<?php 
				if (isset($_GET['kayit']) && $_GET['kayit']=="ok") {?>
					<b style="color: green">Kayıt Başarılı! Bilgilerinizi Girerek Giriş Yapabilirsiniz.</b>
				<?php } 
				if (isset($_GET['durum']) && $_GET['durum']=="no") {?>
					<b style="color: red;">Mail veya Parola Hatalı!</b>
				<?php } ?>
			</small>

			<form action="../netting/islem.php" method="POST" class="login100-form validate-form">
				
				<div class="wrap-input100 validate-input m-b-20" data-validate="Mail Adresinizi Giriniz">
					<input class="input100" type="text" name="kullanici_mail" placeholder="Mail Adresi">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Parolanızı Giriniz">
					<input class="input100" type="password" name="kullanici_password" placeholder="Parola">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button name="kullanici_giris" class="login100-form-btn">
						Giriş Yap
					</button>
				</div>

				
				<br><br><br>
				
				<div class="text-center">
					<a href="admin-kayit.php" class="txt2 hov1">
						Kayıt Ol
					</a>
				</div>
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
<?php  
include '../netting/database.php';
ob_start();
session_start();

//Ayar Tablosuna Erişim.
$ayarsor=$db->prepare("SELECT * from ayar where ayar_id=:id");
$ayarsor->execute(array(
  'id'=>0
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
//Kullanıcı Tablosuna Erişim.
$kullanicisor=$db->prepare("SELECT * from kullanicilar where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail'=>$_SESSION['kullanici_mail']
));
$kullanicidurum=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($kullanicidurum==0) {
  header("Location:giris.php?durum=izinsiz");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- CK Editör -->
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Panel</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="admin-profil-bilgi.php" class="site_title"><i class="fa fa-user"></i> <span>Admin Panel</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic ">
              <img src="../<?php echo $kullanicicek['kullanici_resim']; ?>" alt="" class="img-circle profile_img ">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin</span>
              <h2><?php echo $kullanicicek['kullanici_ad']. " ".$kullanicicek['kullanici_soyad']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              
              
              <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
                 <li><a><i class="fa fa-cogs"></i> Ayarlar <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="genel-ayar.php">Genel Ayarlar</a></li>
                    <li><a href="iletisim-ayar.php">İletişim Ayarları</a></li>
                    <li><a href="api-ayar.php">API Ayarları</a></li>
                    <li><a href="sosyal-ayar.php">Sosyal Medya Ayarları</a></li>
                    <li><a href="mail-ayar.php">Mail
                    Ayarları</a></li>
                    
                  </ul>
                </li>
                <li><a href="kullanici-tablo.php"><i class="fa fa-user"></i> Kullanıcı</a></li>
                <li><a href="hakkimizda.php"><i class="fa fa-info"></i> Hakkımızda</a></li>
                <li><a href="menu-ayar.php"><i class="fa fa-bars"></i>Menü</a></li>
                <li><a href="slider-ayar.php"><i class="fa fa-image"></i>Slider</a></li>
                <li><a href="kategori-ayar.php"><i class="fa fa-book"></i>Kategori </a></li>
                <li><a href="urun-ayar.php"><i class="fa fa-tag"></i>Ürünler </a></li>
                <li><a href="yorum-ayar.php"><i class="fa fa-comments"></i>Kullanıcı Yorumları </a></li>
                <li><a href="banka-ayar.php"><i class="fa fa-bank"></i>Banka</a></li>





               
              </ul>
            </div>
            

          </div>
          <!-- /sidebar menu -->

          
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="../<?php echo $kullanicicek['kullanici_resim']; ?>" alt=""><?php  echo $kullanicicek['kullanici_ad']." ".$kullanicicek['kullanici_soyad']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="admin-profil-bilgi.php"> Profil Bilgilerim</a></li>

                  
                  <li><a href="../netting/islem.php?durum=cikis"><i class="fa fa-sign-out pull-right"></i> Çıkış</a></li>
                </ul>
              </li>

              
            </ul>
          </nav>
        </div>
      </div>
        <!-- /top navigation -->
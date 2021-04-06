<?php 

include 'database.php';
include '../production/function.php';

if (isset($_POST['kullanici_giris'])) {
	$kullanici_mail=$_POST['kullanici_mail'];
	$kullanici_password=md5($_POST['kullanici_password']);
	$kullanicisor=$db->prepare("SELECT * from kullanicilar where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail'=>$kullanici_mail,
		'password'=>$kullanici_password,
		'yetki'=>5
	));
	
	$girisdurum=$kullanicisor->rowCount(); 
//kullanici sor içerisinden kaç değer döndü 0/1
	if($girisdurum==1){
		$_SESSION['kullanici_mail']=$kullanici_mail;
		header("Location:../production/index.php");
		exit();

	}
	elseif ($girisdurum==0) {
		header("Location:../production/giris.php?durum=no");

		exit();
		
	}

}
if (isset($_POST['kullanici_kayit'])) {
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password']));
	$kullanici_ad=htmlspecialchars($_POST['kullanici_ad']);
	$kullanici_soyad=htmlspecialchars($_POST['kullanici_soyad']);
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);

	$kullanicisor=$db->prepare("INSERT INTO kullanicilar SET 
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_mail=:kullanici_mail,
		kullanici_password=:kullanici_password,
		kullanici_yetki=:kullanici_yetki");
	$insert=$kullanicisor->execute(array(
		'kullanici_ad'=>$kullanici_ad,
		'kullanici_soyad'=>$kullanici_soyad,
		'kullanici_mail'=>$kullanici_mail,
		'kullanici_password'=>$kullanici_password,
		'kullanici_yetki'=>5
	));
	if ($insert) {
		header("Location:../production/giris.php?kayit=ok");
	}
	else
		header("Location:../production/admin-kayit.php?kayit=no");



}
//Güvenli Çıkış İşlemi.
if (isset($_GET['durum'])&& $_GET['durum']=="cikis") {
	session_destroy();
	header("Location:../production/giris.php");
}
//
if (isset($_POST['kgorsel_update'])) {
	$upload_dir='../img/profil';
	@$tmp_name=$_FILES['kullanici_resim']["tmp_name"]; 
	@$name=$_FILES['kullanici_resim']["name"];
	$benzersizdeger=rand(20000,35000);
	$imgyol=substr($upload_dir,3)."/".$benzersizdeger.$name;
	@move_uploaded_file($tmp_name,"$upload_dir/$benzersizdeger$name");
	$guncelle=$db->prepare("UPDATE kullanicilar SET 
         kullanici_resim=:kullanici_resim
		where kullanici_mail=:mail");
	$update=$guncelle->execute(array(
		'kullanici_resim'=>$imgyol,
		'mail'=> $_SESSION['kullanici_mail']));
	if ($update) {
		$eskiGorselSil=$_POST['eski_gorsel'];
		unlink("../$eskiGorselSil");
		header("Location:../production/admin-profil-bilgi.php?durum=ok");
	}
	else
		header("Location:../production/admin-profil-bilgi.php?durum=no");
	}

if (isset($_POST['kullanici_bilgileri_update'])) {
	if (strlen($_POST['kullanici_tc'])==11) {
		$guncelle=$db->prepare("UPDATE kullanicilar SET
			kullanici_ad=:kullanici_ad,
			kullanici_soyad=:kullanici_soyad,
			kullanici_tc=:kullanici_tc,
			kullanici_tel=:kullanici_tel where kullanici_mail=:mail
			");
		$update=$guncelle->execute(array(
          'kullanici_ad'=>$_POST['kullanici_ad'],
          'kullanici_soyad'=>$_POST['kullanici_soyad'],
          'kullanici_tc'=>$_POST['kullanici_tc'],
          'kullanici_tel'=>$_POST['kullanici_tel'],
          'mail'=> $_SESSION['kullanici_mail']
		));
           if ($update) {
           	header("Location:../production/admin-profil-bilgi.php?durum=ok");
           }
           else
           	header("Location:../production/admin-profil-bilgi.php?durum=no");
	}
	else
		header("Location:../production/admin-profil-bilgi.php?durum=eksiktc");

}

if (isset($_POST['logo_update'])) {
	$upload_dir='../img';
	@$tmp_name=$_FILES['ayar_logo']["tmp_name"];
	@$name=$_FILES['ayar_logo']["name"];
	$benzersizdeger=rand(20000,35000);
	$imgyol=substr($upload_dir,3)."/".$benzersizdeger.$name;
	@move_uploaded_file($tmp_name,"$upload_dir/$benzersizdeger$name");

	$update=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo WHERE ayar_id=0");
	$kaydet=$update->execute(array(
		'logo'=>$imgyol));
	if ($kaydet) {
		$eskiLogoSil=$_POST['eski_logo'];
		unlink("../$eskiLogoSil");
		header("Location:../production/genel-ayar.php?durum=ok");
	}
	else
		header("Location:../production/genel-ayar.php?durum=no");
}

if (isset($_POST['update'])) {

	$ayarkaydet=$db->prepare("UPDATE  ayar  SET 

		ayar_tittle=:ayar_tittle,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_tittle'=>$_POST['ayar_tittle'],
		'ayar_description'=>$_POST['ayar_description'],
		'ayar_keywords'=>$_POST['ayar_keywords'],
		'ayar_author'=>$_POST['ayar_author']

	));
	if ($update) {
		header("Location:../production/genel-ayar.php?durum=ok");
	} 
	else
		header("Location:../production/genel-ayar.php?durum=no");
}



if (isset($_POST['contact_update'])) {


	$ayarkaydet=$db->prepare("UPDATE  ayar  SET 

		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_tel'=>$_POST['ayar_tel'],
		'ayar_gsm'=>$_POST['ayar_gsm'],
		'ayar_faks'=>$_POST['ayar_faks'],
		'ayar_mail'=>$_POST['ayar_mail'],
		'ayar_ilce'=>$_POST['ayar_ilce'],
		'ayar_il'=>$_POST['ayar_il'],
		'ayar_adres'=>$_POST['ayar_adres'],
		'ayar_mesai'=>$_POST['ayar_mesai']

	));
	if ($update) {
		header("Location:../production/iletisim-ayar.php?durum=ok");
	} 
	else
		header("Location:../production/iletisim-ayar.php?durum=no");
}
if (isset($_POST['category_update'])) {


	$kategorikaydet=$db->prepare("UPDATE  kategori  SET 

		kategori_ad=:kategori_ad,
		kategori_seourl=:kategori_seourl,
		kategori_sira=:kategori_sira,
		kategori_durum=:kategori_durum
		WHERE kategori_id={$_POST['kategori_id']}");

	$update=$kategorikaydet->execute(array(

		'kategori_ad'=>$_POST['kategori_ad'],
		'kategori_seourl'=>$_POST['kategori_seourl'],
		'kategori_sira'=>$_POST['kategori_sira'],		
		'kategori_durum'=>$_POST['kategori_durum']

	));
	if ($update) {
		header("Location:../production/kategori-ayar.php?durum=ok");
	} 
	else
		header("Location:../production/kategori-ayar.php?durum=no");
}

if (isset($_GET['kategori_delete'])=="ok") {
	$delete=$db->prepare("DELETE from kategori where kategori_id=:id");
	$durum=$delete->execute(array(

		'id'=>$_GET['kategori_id']
	));

	if ($durum) {
		header("Location:../production/kategori-ayar.php?durum=ok");
	}
	else
		header("Location:../production/kategori-ayar.php?durum=no");
}
if (isset($_POST['category_insert'])) {
	$kategori_seourl=seo($_POST['kategori_ad']);
	$kategorikaydet=$db->prepare("INSERT INTO kategori SET
		kategori_ad=:kategori_ad,
		kategori_sira=:kategori_sira,
		kategori_durum=:kategori_durum,
		kategori_seourl=:kategori_seourl

		");
	$kaydet=$kategorikaydet->execute(array(
		'kategori_ad'=>$_POST['kategori_ad'],
		'kategori_sira'=>$_POST['kategori_sira'],
		'kategori_durum'=>$_POST['kategori_durum'],
		'kategori_seourl'=>$kategori_seourl
		

	));
	if ($kaydet) {
		header("Location:../production/kategori-ayar.php?durum=ok");
	}
	else
		header("Location:../production/kategori-ayar.php?durum=no");
}

if (isset($_POST['api_update'])) {


	$ayarkaydet=$db->prepare("UPDATE  ayar  SET 

		ayar_maps=:ayar_maps,
		ayar_analystic=:ayar_analystic,
		ayar_zopim=:ayar_zopim
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_maps'=>$_POST['ayar_maps'],
		'ayar_analystic'=>$_POST['ayar_analystic'],
		'ayar_zopim'=>$_POST['ayar_zopim']

	));
	if ($update) {
		header("Location:../production/api-ayar.php?durum=ok");
	} 
	else
		header("Location:../production/api-ayar.php?durum=no");
}


if (isset($_POST['sosyal_update'])) {


	$ayarkaydet=$db->prepare("UPDATE  ayar  SET 

		ayar_facebook=:ayar_facebook,
		ayar_instagram=:ayar_instagram,
		ayar_youtube=:ayar_youtube,
		ayar_google=:ayar_google
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_facebook'=>$_POST['ayar_facebook'],
		'ayar_instagram'=>$_POST['ayar_instagram'],
		'ayar_youtube'=>$_POST['ayar_youtube'],
		'ayar_google'=>$_POST['ayar_google']

	));
	if ($update) {
		header("Location:../production/sosyal-ayar.php?durum=ok");
	} 
	else
		header("Location:../production/sosyal-ayar.php?durum=no");
}

if (isset($_POST['mail_update'])) {


	$ayarkaydet=$db->prepare("UPDATE  ayar  SET 

		ayar_smtphost=:ayar_smtphost,
		ayar_smtpuser=:ayar_smtpuser,
		ayar_smtppassword=:ayar_smtppassword,
		ayar_smtpport=:ayar_smtpport
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_smtphost'=>$_POST['ayar_smtphost'],
		'ayar_smtpuser'=>$_POST['ayar_smtpuser'],
		'ayar_smtppassword'=>$_POST['ayar_smtppassword'],
		'ayar_smtpport'=>$_POST['ayar_smtpport']

	));
	if ($update) {
		header("Location:../production/mail-ayar.php?durum=ok");
	} 
	else
		header("Location:../production/mail-ayar.php?durum=no");
}


//Hakkımız da güncelleme...

if (isset($_POST['hakkimizda_update'])) {


	$hakkimizdakaydet=$db->prepare("UPDATE  hakkimizda  SET 

		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video,
		hakkimizda_misyon=:hakkimizda_misyon,
		hakkimizda_vizyon=:hakkimizda_vizyon

		WHERE hakkimizda_id =0");

	$update=$hakkimizdakaydet->execute(array(

		'hakkimizda_baslik'=>$_POST['hakkimizda_baslik'],
		'hakkimizda_icerik'=>$_POST['hakkimizda_icerik'],
		'hakkimizda_video'=>$_POST['hakkimizda_video'],
		'hakkimizda_misyon'=>$_POST['hakkimizda_misyon'],
		'hakkimizda_vizyon'=>$_POST['hakkimizda_vizyon']

	));
	if ($update) {
		header("Location:../production/hakkimizda.php?durum=ok");
	} 
	else
		header("Location:../production/hakkimizda.php?durum=no");
}



if (isset($_POST['user_update'])) {

	$kullanici_id=$_POST['kullanici_id'];
	$kullanicikaydet=$db->prepare("UPDATE  kullanicilar  SET 

		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_tel=:kullanici_tel,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}"); 

	$update=$kullanicikaydet->execute(array(

		'kullanici_ad'=>$_POST['kullanici_ad'],
		'kullanici_soyad'=>$_POST['kullanici_soyad'],
		'kullanici_tel'=>$_POST['kullanici_tel'],
		'kullanici_durum'=>$_POST['kullanici_durum']

	));
	if ($update) {
		header("Location:../production/kullanici-tablo.php?kullanici_id=$kullanici_id&durum=ok");
	} 
	else
		header("Location:../production/kullanici-düzenle.php?kullanici_id=$kullanici_id&durum=no");
}

if (isset($_GET['delete'])=="ok") {
	$delete=$db->prepare("DELETE from kullanicilar where kullanici_id=:id");
	$durum=$delete->execute(array(

		'id'=>$_GET['kullanici_id']
	));

	if ($durum) {
		header("Location:../production/kullanici-tablo.php?durum=ok");
	}
	else
		header("Location:../production/kullanici-tablo.php?durum=no");
}
if (isset($_POST['menu_update'])) {

	$menu_id=$_POST['menu_id'];
	$menu_seourl=seo($_POST['menu_ad']);
	$menukaydet=$db->prepare("UPDATE  menu  SET 

		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_ust=:menu_ust,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}"); 

	$update=$menukaydet->execute(array(

		'menu_ad'=>$_POST['menu_ad'],
		'menu_detay'=>$_POST['menu_detay'],
		'menu_url'=>$_POST['menu_url'],
		'menu_ust'=>$_POST['menu_ust'],
		'menu_seourl'=>$menu_seourl,
		'menu_durum'=>$_POST['menu_durum']
	));
	if ($update) {
		header("Location:../production/menu-ayar.php?menu_id=$menu_id&durum=ok");
	} 
	else
		header("Location:../production/menu-ayar.php?menu_id=$kullanici_id&durum=no");
}

if (isset($_GET['menu_delete'])=="ok") {
	$delete=$db->prepare("DELETE from menu where menu_id=:id");
	$durum=$delete->execute(array(

		'id'=>$_GET['menu_id']
	));

	if ($durum) {
		header("Location:../production/menu-ayar.php?durum=ok");
	}
	else
		header("Location:../production/menu-ayar.php?durum=no");
}

if (isset($_POST['menu_insert'])) {
	$menu_seourl=seo($_POST['menu_ad']);
	$menukaydet=$db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_ust=:menu_ust,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum

		");
	$kaydet=$menukaydet->execute(array(
		'menu_ad'=>$_POST['menu_ad'],
		'menu_ust'=>$_POST['menu_ust'],
		'menu_detay'=>$_POST['menu_detay'],
		'menu_url'=>$_POST['menu_url'],
		'menu_seourl'=>$menu_seourl,
		'menu_durum'=>$_POST['menu_durum']

	));
	if ($kaydet) {
		header("Location:../production/menu-ayar.php?durum=ok");
	}
	else
		header("Location:../production/menu-ayar.php?durum=no");
}
if (isset($_POST['slider_insert'])) {
	$upload_dir='../img/slider';
	@$tmp_name=$_FILES['slider_gorsel']["tmp_name"]; 
	@$name=$_FILES['slider_gorsel']["name"];
	$benzersizdeger=rand(20000,35000);
	$imgyol=substr($upload_dir,3)."/".$benzersizdeger.$name; 
	@move_uploaded_file($tmp_name,"$upload_dir/$benzersizdeger$name");
	$slider_kaydet=$db->prepare("INSERT INTO slider SET

		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_durum=:slider_durum,
		slider_gorsel=:slider_gorsel
		");
	$kaydet=$slider_kaydet->execute(array(
		'slider_ad'=>$_POST['slider_ad'],
		'slider_sira'=>$_POST['slider_sira'],
		'slider_link'=>$_POST['slider_link'],
		'slider_durum'=>$_POST['slider_durum'],
		'slider_gorsel'=>$imgyol


	));
	if ($kaydet) {
		header("Location:../production/slider-ayar.php?durum=ok");
	}
	else
		header("Location:../production/slider-ayar.php?durum=no");

}
if (isset($_POST['slider_update'])) {
	$sliderguncelle=$db->prepare("UPDATE slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_durum=:slider_durum
		WHERE slider_id={$_POST['slider_id']}");

	$update=$sliderguncelle->execute(array(
		'slider_ad'=>$_POST['slider_ad'],
		'slider_sira'=>$_POST['slider_sira'],
		'slider_link'=>$_POST['slider_link'],
		'slider_durum'=>$_POST['slider_durum']

	));

	if ($update) {
		header("Location:../production/slider-ayar.php?durum=ok");
	}
	else
		header("Location:../production/slider-ayar.php?durum=no");
}
if (isset($_POST['sgorsel_update'])) {
	$upload_dir='../img/slider';
	@$tmp_name=$_FILES['slider_gorsel']["tmp_name"]; 
	@$name=$_FILES['slider_gorsel']["name"];
	$benzersizdeger=rand(20000,35000);
	$imgyol=substr($upload_dir,3)."/".$benzersizdeger.$name; 
	@move_uploaded_file($tmp_name,"$upload_dir/$benzersizdeger$name");
	$update=$db->prepare("UPDATE slider SET
		slider_gorsel=:gorsel WHERE slider_id={$_POST['slider_id']}");
	$kaydet=$update->execute(array(
		'gorsel'=>$imgyol));
	if ($update) {
		$eskiGorselSil=$_POST['eski_gorsel'];
		unlink("../$eskiGorselSil");
		header("Location:../production/slider-ayar.php?durum=ok");
	}
	else
		header("Location:../production/slider-ayar.php?durum=no");
}
if (isset($_GET['slider_delete'])=="ok") {

	$slider_sil=$db->prepare("DELETE from slider where slider_id=:id");
	$sil=$slider_sil->execute(array(
		'id'=>$_GET['slider_id']));

	if ($sil) {
		$slidergorsel=$_GET['slider_gorsel'];
		unlink("../$slidergorsel");
		header("Location:../production/slider-ayar.php?durum=ok");
	}
	else
		header("Location:../production/slider-ayar.php?durum=no");
}

if (isset($_GET['urun_delete'])=="ok") {
	$delete=$db->prepare("DELETE from urun where urun_id=:id");
	$durum=$delete->execute(array(

		'id'=>$_GET['urun_id']
	));

	if ($durum) {
		header("Location:../production/urun-ayar.php?durum=ok");
	}
	else
		header("Location:../production/urun-ayar.php?durum=no");
}
if (isset($_POST['urun_update'])) {

	$urunguncelle=$db->prepare("UPDATE urun SET
		urun_ad=:urun_ad,
		urun_stok=:urun_stok,
		kategori_id=:kategori_id,
		urun_fiyat=:urun_fiyat,
		urun_detay=:urun_detay
		WHERE urun_id={$_POST['urun_id']}");

	$update=$urunguncelle->execute(array(
		'urun_ad'=>$_POST['urun_ad'],
		'urun_stok'=>$_POST['urun_stok'],
		'kategori_id'=>$_POST['kategori_id'],
		'urun_fiyat'=>$_POST['urun_fiyat'],
		'urun_detay'=>$_POST['urun_detay']

	));

	if ($update) {
		header("Location:../production/urun-ayar.php?durum=ok");
	}
	else
		header("Location:../production/urun-ayar.php?durum=no");
}
if (isset($_POST['urun_insert'])) {
	$upload_dir='../img/urunler';
	@$tmp_name=$_FILES['urun_gorsel']["tmp_name"]; 
	@$name=$_FILES['urun_gorsel']["name"];
	$benzersizdeger=rand(20000,35000);
	$imgyol=substr($upload_dir,3)."/".$benzersizdeger.$name; 
	@move_uploaded_file($tmp_name,"$upload_dir/$benzersizdeger$name");
	$urun_kaydet=$db->prepare("INSERT INTO urun SET

		urun_ad=:urun_ad,
		kategori_id=:kategori_id,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_stok=:urun_stok,
		urun_gorsel=:urun_gorsel
		");
	$kaydet=$urun_kaydet->execute(array(
		'urun_ad'=>$_POST['urun_ad'],
		'kategori_id'=>$_POST['kategori_id'],
		'urun_detay'=>$_POST['urun_detay'],
		'urun_fiyat'=>$_POST['urun_fiyat'],
		'urun_stok'=>$_POST['urun_stok'],
		'urun_gorsel'=>$imgyol


	));
	if ($kaydet) {
		header("Location:../production/urun-ayar.php?durum=ok");
	}
	else
		header("Location:../production/urun-ayar.php?durum=no");

}

if (isset($_GET['yorum_ekle'])=="ok") {
	$yorumguncelle=$db->prepare("UPDATE yorumlar SET
		yorum_durum=:yorum_durum
		WHERE yorum_id={$_GET['yorum_id']}");

	$update=$yorumguncelle->execute(array(
		'yorum_durum'=>1));
	if ($update) {
		header("Location:../production/yorum-ayar.php?yorum_ekle=ok");
	}
	else
		header("Location:../production/yorum-ayar.php?durum=no");
}
if (isset($_GET['yorum_cikar'])=="ok") {
	$yorumguncelle=$db->prepare("UPDATE yorumlar SET
		yorum_durum=:yorum_durum
		WHERE yorum_id={$_GET['yorum_id']}");

	$update=$yorumguncelle->execute(array(
		'yorum_durum'=>0));
	if ($update) {
		header("Location:../production/yorum-ayar.php?yorum_ekle=ok");
	}
	else
		header("Location:../production/yorum-ayar.php?durum=no");
}
if (isset($_GET['yorum_sil'])=="ok") {
	$delete=$db->prepare("DELETE from yorumlar where yorum_id=:id");
	$durum=$delete->execute(array(

		'id'=>$_GET['yorum_id']
	));

	if ($durum) {
		header("Location:../production/yorum-ayar.php?durum=ok");
	}
	else
		header("Location:../production/yorum-ayar.php?durum=no");
}
if (isset($_POST['banka_ekle'])) {
	if (strlen($_POST['banka_iban'])==24) {
		$ulkekodu="TR";
		$bankakaydet=$db->prepare("INSERT INTO banka SET
		banka_ad=:banka_ad,
		banka_iban=:banka_iban,
		banka_hesap_ad=:banka_hesap_ad,
		banka_durum=:banka_durum
		");
	$kaydet=$bankakaydet->execute(array(
		'banka_ad'=>$_POST['banka_ad'],
		'banka_iban'=>$ulkekodu.$_POST['banka_iban'],
		'banka_hesap_ad'=>$_POST['banka_hesap_ad'],
		'banka_durum'=>$_POST['banka_durum']
		));
if ($kaydet) {
		header("Location:../production/banka-ayar.php?durum=ok");
	}
	
	}

	else
		header("Location:../production/banka-ekle.php?durum=no");

}
if (isset($_POST['banka_guncelle'])) {

	$urunguncelle=$db->prepare("UPDATE banka SET
		banka_ad=:banka_ad,
		banka_iban=:banka_iban,
		banka_hesap_ad=:banka_hesap_ad,
		banka_durum=:banka_durum
		WHERE banka_id={$_POST['banka_id']}");

	$update=$urunguncelle->execute(array(
		'banka_ad'=>$_POST['banka_ad'],
		'banka_iban'=>$_POST['banka_iban'],
		'banka_hesap_ad'=>$_POST['banka_hesap_ad'],
		'banka_durum'=>$_POST['banka_durum']
	));

	if ($update) {
		header("Location:../production/banka-ayar.php?durum=ok");
	}
	else
		header("Location:../production/banka-ayar.php?durum=no");

	
}
if (isset($_GET['banka_sil'])=="ok") {
	$delete=$db->prepare("DELETE from banka where banka_id=:id");
	$durum=$delete->execute(array(

		'id'=>$_GET['banka_id']
	));

	if ($durum) {
		header("Location:../production/banka-ayar.php?durum=ok");
	}
	else
		header("Location:../production/banka-ayar.php?durum=no");
}

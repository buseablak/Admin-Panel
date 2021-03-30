<?php include 'header.php'; 

$kullanicisor=$db->prepare("SELECT * FROM kullanicilar where kullanici_id=:id");
$kullanicisor->execute(array(
  'id'=>$_GET['kullanici_id']
));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">

    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Düzenle<small><?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">İşlem Başarısız...</b>
            <?php  } ?>
          </small></h2>

     
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kullanici_ad" id="first-name"  value="<?php echo $kullanicicek['kullanici_ad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyad<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kullanici_soyad" id="first-name" value="<?php echo $kullanicicek['kullanici_soyad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kullanici_tel" id="first-name" value="<?php echo $kullanicicek['kullanici_tel']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail Adresi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kullanici_mail" disabled=""  value="<?php echo $kullanicicek['kullanici_mail']; ?>" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanici Durum <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
               <select name="kullanici_durum" class="form-control">

                 <option  value="1"  <?php echo $kullanicicek['kullanici_durum'] == '1' ? 'selected=""' : ''; ?>> Aktif</option>
                 <option value="0" <?php echo $kullanicicek['kullanici_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>

               </select>

             </div>
           </div>




           <div class="ln_solid"></div>
           <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="user_update" class="btn btn-success">Güncelle</button>
            </div>
          </div>
           <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
        </form>
      </div>
    </div>
  </div>
</div>








</div>
</div>


<!-- footer content -->
<?php include 'footer.php'; ?>
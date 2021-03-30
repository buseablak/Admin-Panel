<?php include 'header.php'; 


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
            <h2>Profil Bilgilerim<small><?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">İşlem Başarısız...</b>
            <?php  } elseif (isset($_GET['durum'])=="eksiktc") { ?>
              <b style="color: red;">Lütfen Tc Kimlik Numaranızı Eksiksiz Giriniz.</b>
          <?php  } ?>
          </small></h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form action="../netting/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">    
           <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profil Fotoğrafı<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php

                      if (strlen($kullanicicek['kullanici_resim'])==0) { ?>
                         <img width="200" src="../img/gorselyok.jpg ?>">
                     <?php } else  { ?>
                       <img width="200" src="../<?php echo $kullanicicek['kullanici_resim']; ?>">
                    <?php }

                 ?>  
                
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gorsel Seçiniz<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="kullanici_resim" id="first-name"  class="form-control col-md-7 col-xs-12">
              </div>
              <input type="hidden" name="eski_gorsel" value="<?php echo $kullanicicek['kullanici_resim']; ?>">
              <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
            </div>
             <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="kgorsel_update" class="btn btn-success">Güncelle</button>
            </div>
          </div>
          </form>

          <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adınız<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kullanici_ad" id="first-name"  value="<?php echo $kullanicicek['kullanici_ad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyadınız<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kullanici_soyad" id="first-name" value="<?php echo $kullanicicek['kullanici_soyad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tc.Kimlik No <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc']; ?>" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon Numarası <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" name="kullanici_tel" value="<?php echo $kullanicicek['kullanici_tel']; ?>" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


           <div class="ln_solid"></div>
           <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="kullanici_bilgileri_update" class="btn btn-success">Güncelle</button>
            </div>
          </div>
          <input type="hidden" name="slider_id" value="<?php echo $slidercek['slider_id']; ?>">
        </form>
      </div>
    </div>
  </div>
</div>








</div>
</div>


<!-- footer content -->
<?php include 'footer.php'; ?>
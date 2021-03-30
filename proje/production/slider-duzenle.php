<?php include 'header.php'; 

$slidersor=$db->prepare("SELECT * FROM slider where slider_id=:id");
$slidersor->execute(array(
  'id'=>$_GET['slider_id']
));
$slidercek=$slidersor->fetch(PDO::FETCH_ASSOC);
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
            <h2>Slider Düzenle<small><?php 

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
          <form action="../netting/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">    
           <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mevcut Gorsel<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                 <img width="100" src="../<?php echo $slidercek['slider_gorsel']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gorsel Seçiniz<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="slider_gorsel" id="first-name"  class="form-control col-md-7 col-xs-12">
              </div>
              <input type="hidden" name="eski_gorsel" value="<?php echo $slidercek['slider_gorsel']; ?>">
              <input type="hidden" name="slider_id" value="<?php echo $slidercek['slider_id']; ?>">
            </div>
             <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="sgorsel_update" class="btn btn-success">Güncelle</button>
            </div>
          </div>
          </form>
          <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Adı<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="slider_ad" id="first-name"  value="<?php echo $slidercek['slider_ad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider URL<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="slider_link" id="first-name" value="<?php echo $slidercek['slider_link']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Sıra <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="slider_sira" value="<?php echo $slidercek['slider_sira']; ?>" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Durum <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
               <select name="slider_durum" class="form-control">

                 <option  value="1"  <?php echo $slidercek['slider_durum'] == '1' ? 'selected=""' : ''; ?>> Aktif</option>
                 <option value="0" <?php echo $slidercek['slider_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>

               </select>

             </div>
           </div>




           <div class="ln_solid"></div>
           <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="slider_update" class="btn btn-success">Güncelle</button>
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
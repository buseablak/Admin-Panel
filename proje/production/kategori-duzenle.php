<?php include 'header.php'; 

$kategorisor=$db->prepare("SELECT * FROM kategori where kategori_id=:id");
$kategorisor->execute(array(
  'id'=>$_GET['kategori_id']
));
$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);
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
            <h2>Kategori Düzenle<small><?php 

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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Adı<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kategori_ad" id="first-name"  value="<?php echo $kategoricek['kategori_ad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
           
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori URL<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kategori_seourl" id="first-name" value="<?php echo $kategoricek['kategori_seourl']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Sıra <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="kategori_sira" value="<?php echo $kategoricek['kategori_sira']; ?>" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Durum <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
               <select name="kategori_durum" class="form-control">

                 <option  value="1"  <?php echo $kategoricek['kategori_durum'] == '1' ? 'selected=""' : ''; ?>> Aktif</option>
                 <option value="0" <?php echo $kategoricek['kategori_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>

               </select>

             </div>
           </div>




           <div class="ln_solid"></div>
           <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="category_update" class="btn btn-success">Güncelle</button>
            </div>
          </div>
           <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id']; ?>">
        </form>
      </div>
    </div>
  </div>
</div>








</div>
</div>


<!-- footer content -->
<?php include 'footer.php'; ?>
<?php include 'header.php'; 

$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
$urunsor->execute(array(
  'id'=>$_GET['urun_id']
));
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
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
            <h2>Ürün Düzenle<small><?php 

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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mevcut Gorsel<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                 <img width="200" src="../<?php echo $uruncek['urun_gorsel']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Kategorisi <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php 

                $urun_id=$uruncek['kategori_id'];
                $kategorisor=$db->prepare("SELECT * from kategori where kategori_ust=:kategori_ust");
                $kategorisor->execute(array(
                  'kategori_ust'=>0));



                  ?>
                  <select class="select2_multiple form-control" required="" name="kategori_id">
                    
                    <?php      

                    while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
                      $kategori_id=$kategoricek['kategori_id'];
                      ?>
                      <option <?php if($kategori_id==$urun_id) { echo "selected='select'";} ?> value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad'];  ?></option>
                    <?php }


                    ?>

                  </select>
                </div>
              </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Adı<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="urun_ad" id="first-name"  value="<?php echo $uruncek['urun_ad']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="urun_stok" id="first-name"  value="<?php echo $uruncek['urun_stok']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Fiyat<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="urun_fiyat" id="first-name"  value="<?php echo $uruncek['urun_fiyat']; ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">

                <textarea  class="ckeditor" id="editor1" name="urun_detay"><?php echo $uruncek['urun_detay']; ?></textarea>
              </div>

              <script type="text/javascript">

               CKEDITOR.replace( 'editor1',

               {

                filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                forcePasteAsPlainText: true

              } 

              );

            </script>
          </div>







          <div class="ln_solid"></div>
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="urun_update" class="btn btn-success">Güncelle</button>
            </div>
          </div>
          <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id']; ?>">
        </form>
      </div>
    </div>
  </div>
</div>








</div>
</div>


<!-- footer content -->
<?php include 'footer.php'; ?>
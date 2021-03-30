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
            <h2>Menu Ekle <small><?php 

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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Adı <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="menu_ad" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Menu Sıra <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="menu_ust" id="first-name"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Detay <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">

                <textarea  class="ckeditor" id="editor1" name="menu_detay"></textarea>
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
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu URL <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="menu_url"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
           <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Durum <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
               <select name="menu_durum" class="form-control">

                 <option  value="1"> Aktif</option>
                 <option value="0">Pasif</option>

               </select>

             </div>
           </div>
          <div class="ln_solid"></div>
          
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="menu_insert" class="btn btn-success">Ekle</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>







</div>
</div>


<!-- footer content -->
<?php include 'footer.php'; 
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
            <h2>Banka Ekle <small><?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">Lütfen Banka İban Numarasını Eksiksiz Giriniz.</b>
            <?php  } ?>
          </small></h2>

          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Adı <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="banka_ad" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Banka iban Numarası <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="banka_iban" id="first-name"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Banka Hesap Adı <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="banka_hesap_ad" id="first-name"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            
         
           <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Durum <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
               <select name="banka_durum" class="form-control">

                 <option  value="1"> Aktif</option>
                 <option value="0">Pasif</option>

               </select>

             </div>
           </div>
          <div class="ln_solid"></div>
          
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="banka_ekle" class="btn btn-success">Ekle</button>
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
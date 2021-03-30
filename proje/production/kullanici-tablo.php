<?php include 'header.php'; 

$kullanicisor=$db->prepare("SELECT * from kullanicilar");
$kullanicisor->execute();


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> <small>Mevcut Kullanıcıları Aşağıdaki Listeden Görüntüleyebilirsiniz.
        </small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Listesi <small> <?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">İşlem Başarısız...</b>
              <?php  } ?> </small></h2>
             
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
             
              <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th>Ad</th>
                  <th>Soyad</th>
                  <th>Mail Adres</th>
                  <th>Yetki Durumu</th>
                  <th>Kayıt Tarihi</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>



              <?php


              while ($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) { ?>

               <tbody>
                <tr>
                  <td><?php echo $kullanicicek['kullanici_ad'];  ?></td>
                  <td><?php echo $kullanicicek['kullanici_soyad'];  ?></td>
                  <td><?php echo $kullanicicek['kullanici_mail'];  ?></td>
                 <td><center><?php if ($kullanicicek['kullanici_durum']=='1') { ?>
                    <b style="color: blue" >AKTİF</b>


                  <?php  }   else { ?>

                   <b style="color: red">PASİF</b>

                 <?php }
                 ?></td></center>
                  <td><?php echo $kullanicicek['kullanici_zaman'];  ?></td>
                  
                  <td><center><a href="kullanici-düzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"><button type="submit" name="user_edit" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  
                  <td><center><a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&delete=ok"><button type="submit" name="user_dalete" class="btn btn-danger btn-xs" >Sil</button></a></center></td>
                </tr>
              <?php } ?>
            </tbody>

            
          </table>

        </div>
      </div>
    </div>

    

    <!-- Bitiyor -->


    
  </div>
</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
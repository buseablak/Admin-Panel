<?php include 'header.php'; 

$urunsor=$db->prepare("SELECT * from urun");
$urunsor->execute();


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> <small>Mevcut Ürünleri Aşağıdaki Listeden Görüntüleyebilirsiniz.
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
            <h2>Ürünler Listesi <small> <?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">İşlem Başarısız...</b>
              <?php  } ?> </small></h2>
              
              <div class="clearfix"></div>
              <div align="right"><a href="urun-ekle.php"><button class="btn btn-success btn-xs">Yeni Ürün Ekle</button></a></div>
              
            </div>

            <div class="x_content">

              <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
               <thead>
                <tr>

                  <th>Ad</th>
                  <th>Ürün Fotoğrafı</th>
                  <th>Stok Durumu</th>
                  <th>Fiyat</th>
                  <th>Ürün Durumu</th>
                  
                  <th></th>
                  <th></th>
                </tr>
              </thead>



              <?php


              while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

               <tbody>
                <tr>
                  <td><?php echo $uruncek['urun_ad'];  ?></td>              
                  <td><img src="../<?php echo $uruncek['urun_gorsel'];  ?> " width="100"></td>
                  <td><?php echo $uruncek['urun_stok']; ?></td>
                   <td><?php echo $uruncek['urun_fiyat']; ?></td>
                 <td><center><?php if ($uruncek['urun_stok']>0) { ?>
                    <b style="color: green" >STOK VAR</b>


                  <?php  }   else 
                   
                  { ?>

                   <b style="color: red">STOKTA YOK</b>

                 <?php }
                 ?></center></td>

                 <td><center><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button type="submit" name="urun_edit" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>

                 <td><center><a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urun_delete=ok"><button type="submit" name="urun_delete" class="btn btn-danger btn-xs" >Sil</button></a></center></td>
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
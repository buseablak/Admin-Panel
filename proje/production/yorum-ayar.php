<?php include 'header.php'; 

$yorumsor=$db->prepare("SELECT * from yorumlar INNER JOIN urun ON yorumlar.urun_id=urun.urun_id");
$yorumsor->execute();
$yorum_cek = $yorumsor->fetchALL(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h4><small>Kullanıcıların Ürünler Hakkında Yaptığı Yorumları Aşağıda Görebilirsiniz.</small></h4>
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
            <h2>Kullanıcı Ürün Yorum Listesi <small> <?php 

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

                  <th>Ürün Adı </th>
                  <th>Ürün Fotoğrafı</th>     
                  <th>Ürün Yorumu</th>
                  <th></th>
                  <th></th>
                  
                </tr>
              </thead>



              <?php


              foreach ($yorum_cek as $row) { ?>


                <tbody>
                  <tr>    

                    <td><?php echo $row['urun_ad'];  ?></td> 
                    <td><img  src="../<?php echo $row['urun_gorsel'];  ?> " width="100"></td>
                    <td><?php echo $row['yorum_detay']; ?></td>

                     <td><center>

                        <?php   if ($row['yorum_durum']==1) { ?>
                         <a href="../netting/islem.php?yorum_id=<?php echo $row['yorum_id']; ?>&yorum_cikar=ok"><button type="submit"  class="btn btn-success btn-xs">Siteye Eklendi</button></a></center></td>
                       <?php  } else { ?>
                          <a href="../netting/islem.php?yorum_id=<?php echo $row['yorum_id']; ?>&yorum_ekle=ok"><button type="submit" name="yorum_ekle" class="btn btn-primary btn-xs">Siteye Ekle</button></a></center></td>
                      <?php } ?>


                   <td><center><a href="../netting/islem.php?yorum_id=<?php echo $row['yorum_id']; ?>&yorum_sil=ok"><button type="submit" name="yorum_sil" class="btn btn-danger btn-xs" >Sil</button></a></center></td>

                  <?php }      ?>  
                  


                  

                </tr>

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
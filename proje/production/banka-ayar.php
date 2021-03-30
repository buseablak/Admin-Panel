<?php include 'header.php'; 

$bankasor=$db->prepare("SELECT * from banka");
$bankasor->execute();


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h4> <small>Mevcut Bankaları Aşağıdaki Listeden Görüntüleyebilirsiniz.
        </small></h4>
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
            <h2>Banka Listesi <small> <?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">İşlem Başarısız...</b>
              <?php  } ?> </small></h2>
              
              <div class="clearfix"></div>
              <div align="right"><a href="banka-ekle.php"><button class="btn btn-success btn-xs">Yeni Banka Ekle</button></a></div>
              
            </div>

            <div class="x_content">

              <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
               <thead>
                <tr>

                  <th>Banka Ad</th>
                  <th>Banka Hesap Adı</th>
                  <th>Banka IBAN</th>
                  <th>Banka Durum</th>

                  
                  <th></th>
                  <th></th>
                </tr>
              </thead>



              <?php


              while ($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) { ?>

               <tbody>
                <tr>
                  <td><?php echo $bankacek['banka_ad'];  ?></td>
                   <td><?php echo $bankacek['banka_iban'];  ?></td>
                   <td><?php echo $bankacek['banka_hesap_ad']; ?></td>
                  <td><center><?php if ($bankacek['banka_durum']=='1') { ?>
                    <b style="color: blue" >AKTİF</b>


                  <?php  }   else { ?>

                   <b style="color: red">PASİF</b>

                 <?php }
                 ?></td></center>
                

                 <td><center><a href="banka-duzenle.php?banka_id=<?php echo $bankacek['banka_id']; ?>"><button type="submit" name="banka_edit" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>

                 <td><center><a href="../netting/islem.php?banka_id=<?php echo $bankacek['banka_id']; ?>&banka_sil=ok"><button type="submit" name="banka_sil" class="btn btn-danger btn-xs" >Sil</button></a></center></td>
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
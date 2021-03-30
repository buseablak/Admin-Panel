<?php include 'header.php'; 

$slidersor=$db->prepare("SELECT * from slider");
$slidersor->execute();


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> <small>
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
            <h2>Slider Listesi <small> <?php 

            if (isset($_GET['durum']) && $_GET['durum']=="ok") {?>
              <b style="color:green;"> İşlem Başarılı! </b>
            <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="no") { ?>
              <b style="color: red;">İşlem Başarısız...</b>
              <?php  } ?> </small></h2>
              
              <div class="clearfix"></div>
              <div align="right"><a href="slider-ekle.php"><button class="btn btn-success btn-xs">Yeni Slider Ekle</button></a></div>

              </div>

              <div class="x_content">

                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                 <thead>
                  <tr>

                    <th>Ad</th>
                    <th>Resim</th>
                    <th>Durum</th>

                    <th></th>
                    <th></th>
                  </tr>
                </thead>



                <?php


                while ($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) { ?>

                 <tbody>
                  <tr>
                    <td><?php echo $slidercek['slider_ad'];  ?></td>
                    <td> <img width="100"  src="../<?php echo $slidercek['slider_gorsel']; ?>"></td>


                    <td><center><?php if ($slidercek['slider_durum']=='1') { ?>
                      <b style="color: blue" >AKTİF</b>


                    <?php  }   else { ?>

                     <b style="color: red">PASİF</b>

                   <?php }
                   ?></td></center>

                   <td><center><a href="slider-duzenle.php?slider_id=<?php echo $slidercek['slider_id']; ?>"><button type="submit" name="slider_edit" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>

                   <td><center><a href="../netting/islem.php?slider_id=<?php echo $slidercek['slider_id']; ?>&slider_gorsel=<?php echo $slidercek['slider_gorsel']; ?>&slider_delete=ok"><button type="submit" name="slider_delete" class="btn btn-danger btn-xs" >Sil</button></a></center></td>
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
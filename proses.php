<?php
  $from = $_POST['asal'];
    require_once('admin/fungsi/fungsi.php');
    konek_db();
    if (!isset($_POST['rasa'])) {
        echo '<script>document.location="index.php";</script>';
    }
    $peringatan="";
    $rasa = $_POST['rasa'];
    $jenis = $_POST['jenis'];
    $harga  = $_POST['harga'];
    $jarak  = $_POST['jarak'];
    $luas  = $_POST['luas'];
    $fasilitas  = $_POST['fasilitas'];


    $hasil = lihat_hasil($rasa, $jenis, $harga, $jarak, $luas, $fasilitas);

    //shorting in foreach
    $index = 0;
    if ($hasil!='') {
   
    
    foreach ($hasil as $result) {
        $rslt[$index]['id']                  = $result['id'];
        $rslt[$index]['nama']                = $result['nama'];
        $rslt[$index]['rasa']                = $result['rasa'];
        $rslt[$index]['nm_rasa']                = $result['nm_rasa'];
        $rslt[$index]['harga']               = $result['harga'];
        $rslt[$index]['tempat']               = $result['tempat'];
        $rslt[$index]['jenis']               = $result['jenis'];
        $rslt[$index]['jarak']               = $result['jarak'];
        $rslt[$index]['luas']                = $result['luas'];
        $rslt[$index]['fasilitas']       = $result['fasilitas'];
        $rslt[$index]['nk_harga']            = $result['nk_harga'];
        $rslt[$index]['nk_jarak']            = $result['nk_jarak'];
        $rslt[$index]['nk_luas']             = $result['nk_luas'];
        $rslt[$index]['nk_fasilitas']    = $result['nk_fasilitas'];
        $rslt[$index]['ks']                      = $result['ks'];

        $index++;

    }

    //shorting :
    for ($i=0; $i < count($rslt) - 1; $i++) {
        for ($j=0; $j < count($rslt) - 1; $j++) {
                if ($rslt[$j]['ks'] < $rslt[$j+1]['ks']) {
                $tmp = $rslt[$j];
                $rslt[$j] = $rslt[$j+1];
                $rslt[$j+1] = $tmp;
            }
        }
    }

    $jml_bukan_nol = 0;
    for ($i=0; $i < count($rslt); $i++) {
        if ($rslt[$i]['ks']!=0) {
            $jml_bukan_nol++;
        }
    }

    //eliminasi data yang memiliki nilai result = 0
    if ($jml_bukan_nol!=0) {
        for ($i=0; $i < $jml_bukan_nol; $i++) {
        $isi[$i] = $rslt[$i];
        }
    }

}else{
    $peringatan="Silahkan Pilih Parameter yang lain !";
}
 ?>


 <!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rekomendasi Tempat Makan</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/bootstrap/css/portfolio-item.css" rel="stylesheet">

    
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Rekomendasi Tempat Makan</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li>
                        <a href="index.php#rekomendasi" class="page-scroll btn btn-xl">Dapatkan Rekomendasi</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container content-wrapper">
        <br><br>

       
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="col-xs-10">
                <div class="box-header">
                    <h3 class="box-title">Rekomendasi</h3>
                </div>

            </div>

            <br>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped table-bordered table-hover" id="dataTables-examplel">
                            <thead>
                            <tr >
                                <th style="width: 30px">No.</th>
                                <th >Nama</th>
                                <th >Jenis Makanan</th>
                                <th >Tempat Makan</th>
                                <th style="width: 30px">Harga</th>
                                <th style="width: 50px">Jarak</th>
                                <!-- <th >Jenis</th> -->
                                <th style="width: 50px">Luas</th>
                                <th style="width: 50px">Fasilitas</th>
                                        <?php
                                       
                                //         if($harga!='-'){
                                //  echo "<th>nk harga</th>";
                                // }
                                //         if($jarak!='-'){
                                //  echo "<th>nk jarak</th>";
                                // }
                                //         if($luas!='-'){
                                //  echo "<th>nk luas</th>";
                                // }
                                //         if($fasilitas!='-'){
                                //  echo "<th>nk fasilitas </th>";
                                // }
                                             ?>
                                <th style="width: 50px">Nilai</th>
                                <th style="width: 50px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if ($peringatan==0){

                                     ?>
                                            
                                    <?php
                                }
                                        if (isset($isi)) {
                                            # code...

                                        $a=0;
                                        for ($i=0; $i < count($isi); $i++) {
                                        # code...
                                    ?>

                                        <tr>

                                            <td align="center"><?php $a++; echo $a; ?></td>
                                            <td style="width: 150px"><?php echo $isi[$i]['nama']; ?></td>
                                            <td style="width: 100px"><?php echo $isi[$i]['nm_rasa']; ?></td>
                                            <td style="width: 150px"><?php echo $isi[$i]['tempat']; ?></td>
                                            <td ><?php echo rp($isi[$i]['harga']); ?></td>
                                            <td ><?php echo km($isi[$i]['jarak']); ?></td>
                                            <!-- <td><?php echo $isi[$i]['jenis']; ?></td> -->
                                            <td ><?php echo m2($isi[$i]['luas']); ?></td>
                                            <td style="align: center;"><?php echo $isi[$i]['fasilitas']; ?></td>
                                                <?php
                                            
                                            // if($harga!='-'){
                                            //  echo "<td>".$isi[$i]['nk_harga']."</td>";
                                            // }
                                            // if($jarak!='-'){
                                            //  echo "<td>".$isi[$i]['nk_jarak']."</td>";
                                            // }
                                            // if($luas!='-'){
                                            //  echo "<td>".$isi[$i]['nk_luas']."</td>";
                                            // }
                                            // if($fasilitas!='-'){
                                            //  echo "<td>".$isi[$i]['nk_fasilitas']."</td>";
                                            // }

                                             ?>
                                            <td><?php echo $isi[$i]['ks']; ?></td>
                                            <td><a href="../admin/pages/admin/detail_makanan.php?id=<?php echo $isi[$i]['id']; ?>" class="btn btn-primary" style="width: 100%;">Detail</a></td>

                                            </tr>
                                <?php   }
                                } ?>
                                            <tr ><td align="center" colspan="10"><?php    echo $peringatan;?></td></tr>
                            </tbody>
                        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
    </section>
        

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Rekomendasi Tempat Makan &copy; 2017</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="admin/bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
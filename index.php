<?php
  require_once('admin/fungsi/fungsi.php');
  konek_db();
  $peringatan='';
  
  //bukak sitik jos

?>

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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <link href="css/login.css" rel="stylesheet" />
    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Rekomendasi Tempat Makan</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#rekomendasi">Dapatkan Rekomendasi</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="login.php ">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Rekomendasi!</div>
                <div class="intro-heading">Tempat Makan</div>
                <a href="#rekomendasi" class="page-scroll btn btn-xl">Dapatkan Rekomendasi</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="rekomendasi" class="container">
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
              <form method="post" action="proses.php">
                            <div class="row">
                                <div class="col-md-6">
                      
                    <input type="hidden" id="latitude">
                     <input type="hidden" id="longitude">

                       <input type="hidden" align="center" placeholder="Menunggu permintaan lokasi" name="asal" id="asal" size="40" class="form-control" readonly="readonly" required/>
            
                                    <div class="form-group">
                                        <p>Jenis Makanan :</p>
                                        <select class="form-control" name="rasa">
                                            <option value="-" >--Silahkan Pilih Salah Satu--</option>
                                            <?php
                                            $query = mysql_query("SELECT MD_MAKANAN.KD_RASA AS KD_RASA, V_RASA.KD_RASA AS RASA, V_RASA.NAMA AS NAMA
                                                    FROM V_RASA JOIN MD_MAKANAN ON MD_MAKANAN.KD_RASA=V_RASA.KD_RASA GROUP BY MD_MAKANAN.KD_RASA;");
                                            while($data = mysql_fetch_array($query)){
                                                ?>
                                                <option value="<?php echo $data['KD_RASA']; ?>"> <?php echo $data['NAMA']; ?> </option>
                                                <?php } ?>

                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <p>Jenis Tempat Makan :</p>
                                        <select class="form-control" name="jenis">
                                            <option value="-">--Silahkan Pilih Salah Satu--</option>
                                            <?php
                                            $query = mysql_query("SELECT MD_RMAKAN.KD_JENIS AS KD_JENIS, JENIS_RM.JENIS AS JENIS
                         FROM MD_RMAKAN JOIN JENIS_RM ON MD_RMAKAN.KD_JENIS=JENIS_RM.KD_JENIS GROUP BY MD_RMAKAN.KD_JENIS ;");
                                            while($data = mysql_fetch_array($query)){
                                                ?>
                                                <option value="<?php echo $data['KD_JENIS']; ?>"> <?php echo $data['JENIS']; ?> </option>
                                                <?php } ?>

                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <p>Harga Makanan :</p>
                                        <select class="form-control" name="harga">
                                            <option value="-">--Silahkan Pilih Salah Satu--</option>
                                            <?php
                                                $query = mysql_query("SELECT * FROM v_harga;");
                                                while($data = mysql_fetch_array($query)){
                                             ?>
                                            <option value="<?php  echo $data['KD_FK']; ?>" > <?php echo $data['STATUS']; ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger" style="width: 100%;">Reset</button>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p>Jarak Tempat Makan :</p>
                                        <select class="form-control" name="jarak">
                                            <option value="-">--Silahkan Pilih Salah Satu--</option>
                                            <?php
                                                $query = mysql_query("SELECT * FROM v_jarak;");
                                                while($data = mysql_fetch_array($query)){
                                             ?>
                                            <option value="<?php echo $data['KD_FK']; ?>" > <?php echo $data['STATUS']; ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <p>Luas Tempat Makan :</p>
                                        <select class="form-control" name="luas">
                                            <option value="-">--Silahkan Pilih Salah Satu--</option>
                                            <?php
                                                $query = mysql_query("SELECT * FROM v_luas;");
                                                while($data = mysql_fetch_array($query)){
                                             ?>
                                            <option value="<?php echo $data['KD_FK']; ?>" > <?php echo $data['STATUS']; ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <p>Fasilitas Tempat Makan :</p>
                                        <select class="form-control" name="fasilitas">
                                            <option value="-">--Silahkan Pilih Salah Satu--</option>
                                            <?php
                                                $query = mysql_query("SELECT * FROM v_fasilitas;");
                                                while($data = mysql_fetch_array($query)){
                                             ?>
                                            <option value="<?php echo $data['KD_FK']; ?>" > <?php echo $data['STATUS']; ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <!-- <div class="form-group">
                                        <p>Operator :</p>
                                        <select class="form-control" name="operator">
                                            <option value="AND">AND</option>
                                            <option value="OR">OR</option>
                                        </select>
                                    </div> -->
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" style="width: 100%;">Lihat Rekomendasi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
    </section>

    

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About</h2>
                    <h3 class="section-subheading text-muted">rekomendasi tempat makan</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>Deskripsi</h4>
                                    <h4 class="subheading">Sistem</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Sistem ini dibangun dengan tujuan untuk membantu warga dan wisatawan 
                                    di Daerah Istimewa Yogyakarta dalam menentukan tempat makan.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4></h4>
                                    <h4 class="subheading">Metode </h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Metode yang digunakan menggunakan metode basis data fuzzy model Tahani</p>
                                </div>
                            </div>
                        </li>
                        
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    

    <footer>
        <div class="container">
            <div class="row">
                
                <!-- <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div> -->
                <div class="col-md-12">
                    <span class="copyright">Rekomendasi Tempat Makan @2017</span>
                </div>
                <!-- <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/roundicons-free.png" alt="">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <p>
                                    <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                                <ul class="list-inline">
                                    <li>Date: July 2014</li>
                                    <li>Client: Round Icons</li>
                                    <li>Category: Graphic Design</li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>Project Heading</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/startup-framework-preview.png" alt="">
                                <p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
                                <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/treehouse-preview.png" alt="">
                                <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/golden-preview.png" alt="">
                                <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/escape-preview.png" alt="">
                                <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">
                                <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>

</html>

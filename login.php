<?php 
  session_start();
  require_once('admin/fungsi/fungsi.php');
    konek_db();
  $peringatan = '';

  if(isset($_POST['login'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);

    $login = mysql_query("SELECT * FROM MD_USER WHERE UPPER(USERNAME)=UPPER('".$username."');");
    $jmlh  = mysql_num_rows($login);
    if($jmlh==0){
      $peringatan="Username ".$username." belum terdaftar !";
    }else{
      $data = mysql_fetch_array($login);
      if($password!=$data['PASSWORD']){
        $peringatan = "Password yang anda masukkan salah !";
      }else{
        $_SESSION['KD_USER']= $data['KD_USER'];
        $_SESSION['NAMA']= $data['NAMA'];
        $_SESSION['USR'] = $username;
        $_SESSION['LVL'] = $data['LEVEL'];
        if ($data['LEVEL']==1) {
       
        echo '<script>document.location="admin/index.php";</script>';
        }else{
        echo '<script>document.location="admin/pages/pemilikmakan/index.php";</script>';
        }
      }
    }
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rekomendasi Tempat Makan | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">

</head>
<body>
  
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="row">
        <div class="col-md-3"></div>
        <!-- <div class="col-md-6"><img src="SMS_SERVICE/asset/logo2.png" class="img img-responsive" ></div> -->
        <div class="col-md-3"></div>
      </div>
      <br>
      <div class="login-panel panel panel-default">
        <div class="panel-heading">Log in</div>
        <div class="panel-body">
          <form role="form" action="#" method="POST">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="username" name="username" type="text" autofocus="" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
              </div>
              <div class="form-group">
                <p style="color: red;"><?php echo $peringatan; ?></p>
              </div>
              <div class="form-group">
                <button href="dashboard_utama.php" class="btn btn-primary" style="width: 100%;" name="login" type="submit">Login</button>
              </div>
              <div class="form-group pull-right">
                <a href="ganti_password.php">Ganti Password</a>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.row -->  
  
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

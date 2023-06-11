<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/hmif.png" />
  <title>Aplikasi Pendataan - Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">

  <?php
  session_start();
  if(isset($_SESSION['id_users'])){
    header('location:../');
  }else{
    include 'connect.php';
    if(isset($_POST['submit'])){
      @$nip_nim = mysqli_real_escape_string($conn, $_POST['nip_nim']);
      @$pass = mysqli_real_escape_string($conn, $_POST['password']);
      
      $status = mysqli_query($conn, "SELECT * FROM dosen_mahasiswa WHERE nip_nim='$nip_nim'");
      $output = mysqli_fetch_array($status);

      if($output["status"] == "1" || $output["status"] == "2"){
        $login = mysqli_query($conn, "SELECT * FROM dosen WHERE nip='$nip_nim' AND password='$pass'");
      } else if($output["status"] == "3"){
        $login = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nip_nim' AND password='$pass'");
      } else {
        header('location:../');
      }
      
      $cek = mysqli_num_rows($login);
      $userid = mysqli_fetch_array($login);

      if($cek == 0){
        echo '
        <script>
        setTimeout(function() {
          swal({
            title: "Login Gagal",
            text: "NIP/NIM atau Password Anda Salah. Mohon periksa kembali form anda!",
            icon: "error"
            });
            }, 500);
            </script>
            ';
          }else{
            ?>
  <script>
  document.location = '../index.php?status=<?php echo $output["status"]?>';
  </script>
  <?php
            $_SESSION['id_users'] = $userid['id'];
          }
        }
        ?>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <a href="../../index.html"><img src="../assets/img/hmif.png" alt="logo" width="100"
                  class="shadow-light rounded-circle"></a>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
                  <div class="form-group">
                    <label for="username">NIP/NIM</label>
                    <input id="username" type="text" class="form-control" minlength="2" name="nip_nim" tabindex="1"
                      required autofocus>
                    <div class="invalid-feedback">
                      Mohon isi data anda dengan benar!
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Mohon isi password anda!
                    </div>
                  </div>

                  <div class="form-group">

                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Aplikasi Pendataan 2022
              <br>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/popper.js"></script>
  <script src="../assets/modules/tooltip.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../assets/modules/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
  <!-- Sweet Alert -->
  <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
  <script src="../assets/js/page/modules-sweetalert.js"></script>
</body>
<?php } ?>

</html>
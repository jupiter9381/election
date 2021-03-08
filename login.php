<?php 
  session_start();
  if (isset($_SESSION['logged_in'])) {
    header("Location: dashboard/index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/jquery-confirm.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label class="logo">VALG</label>
    <ul>
      <li><a href="<?php echo $base_path;?>dashboard/">Home</a></li>
      <li><a href="<?php echo $base_path;?>nominering.php">Nominering</a></li>
      <li><a href="<?php echo $base_path;?>login.php" class="active">Login</a></li>
      <li><a href="<?php echo $base_path;?>register.php">Registrer</a></li>
    </ul> 
  </nav>
  <section>
    <section class="container mt-10">
      <section class="row justify-content-center">
        <section style="width: 100%; max-width: 600px">
          <section class="card">
            <section class="card-header"><h1>Login</h1></section>
            <section class="card-body">
              <section id="mess_modal" class="text-center" style="display: none">
                <section id="mess_mess" class="alert alert-success" role="alert"></section>
              </section>
              <form id="loginForm" class="form-horizontal">
                <section class="form-group">
                  <label for="epost" class="cols-sm-2 control-label">Your Email</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="email" class="form-control" name="epost" id="epost" placeholder="Enter your Email" />
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="password" class="cols-sm-2 control-label">Password</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                    </section>
                  </section>
                </section>
                <section class="form-group ">
                  <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
                </section>
                <section style="display: grid;grid-template-columns: 1fr 1fr;">
                  <a href="#"> Glemt Passord?</a>
                  <a href="register.php" class="text-right">Registrer deg?</a>
                </section>
              </form>
            </section>
          </section>
        </section>
      </section>
    </section>
  </section>
</body>
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="assets/js/login.js"></script>
</html>
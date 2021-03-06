<?php 
  session_start();
  if (isset($_SESSION['logged_in'])) {
    header("Location: dashboard/index.php");
  }
  $base_path = "./";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGN UP</title>
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
      
      <li><a href="<?php echo $base_path;?>default.php">login</a></li>
    </ul> 
  </nav>
  <section>
    <section class="container mt-10">
      <section class="row justify-content-center">
        <section style="width: 100%; max-width: 600px">
          <section class="card">
            <section class="card-header"><h1>Registrer deg her</h1></section>
            <section class="card-body">
              <form id="registerForm" class="form-horizontal">
                <section class="form-group">
                  <label for="fnavn" class="cols-sm-2 control-label">Fornavn</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="text" class="form-control" name="fnavn" id="fnavn" placeholder="Legg inn ditt Fornavn" />
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="enavn" class="cols-sm-2 control-label">Etternavn</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="text" class="form-control" name="enavn" id="enavn" placeholder="Legg inn ditt Etternavn" />
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="enavn" class="cols-sm-2 control-label">Etternavn</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <select class="form-control" name="gender" id="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="enavn" class="cols-sm-2 control-label">F??dselsdato</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="date" class="form-control" name="bday" id="bday"/>
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="enavn" class="cols-sm-2 control-label">Telefonnummer</label>
                  <small>Format: 4734567890</small>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="tel" class="form-control" name="phone" id="phone" pattern="[0-9]{10}"/>
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="epost" class="cols-sm-2 control-label">Skriv inn E-post</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="email" class="form-control" name="epost" id="epost" placeholder="Legg inn ditt Email" />
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="password" class="cols-sm-2 control-label">Passord</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Legg inn ditt Passord" />
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="re_password" class="cols-sm-2 control-label">Confirm Password</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Confirm your Password" />
                    </section>
                  </section>
                </section>
                <section class="form-group ">
                  <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Registrer</button>
                </section>
                <section class="text-center">
                  <a href="default.php" class="ca">Har du en konto?</a>
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
<script type="text/javascript" src="assets/js/register.js"></script>
</html>
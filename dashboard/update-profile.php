<?php 
	session_start();
	if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$base_path = "";
		header("Location: ../login/index.php");
	}
	else{
		$base_path = "../";
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label class="logo">VALG</label>
    <ul>
      <li><a href="<?php echo $base_path;?>dashboard/" class="active">Home</a></li>
      <li><a href="<?php echo $base_path;?>nominering.php">Nominering</a></li>
      <li><a href="<?php echo $base_path;?>includes/loggut.php">logout</a></li>
    </ul> 
  </nav>
  <section class="main-content">
    <section class="content-grid">
    	<section>
        <section class="grid-border fix-content-grid align-center mb-10">
      		<section class="rounded-circle img-thumbnail avatar" style="background-image:url(../assets/images/profile/<?php echo $_SESSION['img_url'];?>);" title="profile image"></section>
      		<section>
      			<section class="profile-name">
              <span><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname'];?></span>
            </section>
            <section class="profile-role">(<?php echo $_SESSION['brukertype']; ?>)</section>
            <section class="profile-text"><?php echo $_SESSION['email']; ?></section>
      		</section>
        </section>
        <a href="index.php">
          <button tyle="button" class="btn btn-primary btn-sm btn-block login-button"><i class="fas fa-arrow-left"></i> Back to Dashboard</button>
        </a>
    	</section>
    	<section>
        <section class="mb-10" style="width: 100%; max-width: 600px">
          <section class="card">
            <section class="card-header"><h1>Change Profile Picture</h1></section>
            <section class="card-body">
              <form id="imageForm" enctype="multipart/form-data">
                <section class="fix-content-grid align-center">
                  <section>
                    <section id="profileImage" class="rounded-circle img-thumbnail avatar" style="background-image:url(../assets/images/profile/avatar.jpeg);" title="profile image"></section>
                  </section>
                  <section>
                    <input class="mb-10" name="profileImage" type="file" onchange="readURL(this);" />
                    <section class="text-left">
                      <button type="button" class="btn btn-sm btn-success" onclick="resetImg()">Reset</button>
                      <button type="submit" name="save_profile" class="btn btn-sm btn-primary">Save</button>
                    </section>
                  </section>
                </section>
              </form>
            </section>
          </section>
        </section>
        <section style="width: 100%; max-width: 600px">
          <section class="card">
            <section class="card-header"><h1>Change Password</h1></section>
            <section class="card-body">
              <form id="changePassForm" class="form-horizontal">
                <section class="form-group">
                  <label for="password" class="cols-sm-2 control-label">ny passord</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Legg inn ditt Password" />
                    </section>
                  </section>
                </section>
                <section class="form-group">
                  <label for="re_password" class="cols-sm-2 control-label">bytt passord</label>
                  <section class="cols-sm-10">
                    <section class="input-group">
                      <input type="password" class="form-control" name="re_password" id="re_password" placeholder="bekreft ditt passord" />
                    </section>
                  </section>
                </section>
                <section class="form-group ">
                  <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Send</button>
                </section>
              </form>
            </section>
          </section>
        </section>
    	</section>
    </section>
  </section>
</body>
<script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="../assets/js/update-profile.js"></script>
</html>
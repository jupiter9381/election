<?php 
	session_start();
	if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$base_path = "";
		header("Location: ../default.php");
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
      <li><a href="<?php echo $base_path;?>includes/loggut.php">logg ut</a></li>
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
        <a href="update-profile.php">
          <button tyle="button" class="btn btn-primary btn-sm btn-block login-button mb-10"><i class="far fa-edit"></i> Update Profile</button>
        </a>
        <a href="update-usertype.php">
          <button tyle="button" class="btn btn-primary btn-sm btn-block login-button mb-10"><i class="far fa-edit"></i> Update Role</button>
        </a>
    	</section>
    	<section>
        <section class="text-right mb-10">
          <button class="btn btn-danger" id="velg" onclick="setElection()"><i class="fas fa-users"></i> Velg</button>
          <button class="btn btn-danger" id="withdraw" onclick="withdrawCandidacy()" style="display: none"><i class="fas fa-user-slash"></i> Withdraw Candidacy</button>
          <button class="btn btn-success" id="nominate" onclick="nominateMe()" style="display: none"><i class="fas fa-users"></i> Nominer meg selv</button>
          <button class="btn btn-primary" onclick="nominateUser()"><i class="fas fa-users"></i> Nominer en bruker</button>
          <button class="btn btn-info" onclick="voteUser()"><i class="fas fa-users"></i> Velg en kandidat</button>
        </section>
    		<section class="grid-border" style="overflow-x: scroll;">
          List of Nominates
          <hr class="mtb-10">
          <small>Total Result : <b><span id="total_count"></span></b></small>
          <table>
            <thead>
              <th>Kandidat Col</th>
              <th class="text-center">Image</th>
              <th>Name</th>
              <th>Epost</th>
              <th>Institutt</th>
              <th>Informasjon</th>
              <th class="text-center">Stemmer</th>
              <th></th>
            </thead>
            <tbody id="nominates_list"></tbody>
          </table>
        </section>
    	</section>
    </section>
  </section>
</body>
<script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="../assets/js/dashboard.js"></script>
</html>
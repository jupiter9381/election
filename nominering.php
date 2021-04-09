<?php 
	session_start();
	if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$base_path = "";
	}
	else{
		$base_path = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
      <li><a href="<?php echo $base_path;?>nominering.php" class="active">Nominering</a></li>
      <?php if(isset($_SESSION['logged_in']) == 0) { ?>
        <li><a href="<?php echo $base_path;?>default.php">login</a></li>
        <li><a href="<?php echo $base_path;?>register.php">Registrer</a></li>
      <?php } else if(isset($_SESSION['logged_in']) == 1) { ?>
        <li><a href="<?php echo $base_path;?>includes/loggut.php">logout</a></li>
      <?php } ?>
    </ul> 
  </nav>
  <section class="main-content">
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
        </thead>
        <tbody id="nominates_list"></tbody>
      </table>
    </section>
  </section>
</body>
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="assets/js/nominering.js"></script>
</html>
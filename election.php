<?php 
	session_start();
	$base_path = "./";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Election</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/css/jquery-confirm.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
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
      <?php if(isset($_SESSION['logged_in']) == 0) { ?>
        <li><a href="<?php echo $base_path;?>default.php">login</a></li>
        <li><a href="<?php echo $base_path;?>register.php">Registrer</a></li>
      <?php } else if(isset($_SESSION['logged_in']) == 1) { ?>
        <li><a href="<?php echo $base_path;?>includes/loggut.php">logout</a></li>
      <?php } ?>
    </ul> 
  </nav>
  <section class="main-content">
    <section class="content-grid">
    	<section>
    		<section class="grid-border" style="overflow-x: scroll;">
          List of Valg
          <hr class="mtb-10">
          <small>Total Result : <b><span id="total_count"></span></b></small>
          <table>
            <thead>
              <th>Valg Col</th>
              <th>KandidatCol</th>
              <th>fakultet</th>
              <th>Startforslag</th>
              <th>Sluttforslag</th>
              <th>Startvalg</th>
              <th>Sluttvalg</th>
              <th>Informasjon</th>
              <th></th>
            </thead>
            <tbody id="kandidat_list"></tbody>
          </table>
        </section>
    	</section>
    </section>
  </section>
</body>
<script type="text/javascript" src="./assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="./assets/js/jquery-confirm.min.js"></script>
<script>
  var data = {
    endpoint: 'get_valg'
  }
  $.ajax({
    type:'POST',
    url: './includes/dashboard.php',
    data: data,
    cache:false,
    dataType: 'json',
    success:function(json_data){
      var user_list = json_data['user_list'];
      var temp = ""
      for(var i=0; i < json_data['total_count']; i++){
        var action_button = ""

        // if(json_data['candidate_list'][i]['allow_edit']){
        //   action_button = "<button class='btn btn-sm btn-primary' title='Edit Informasjon' onclick='nominateMeUpdate(" +json_data['candidate_list'][i]['id']+ ")'><i class='far fa-edit'></i></button>";
        // }
        temp += "<tr>" 
          +"<td><b>"+json_data['valg_list'][i]['idvalg']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['kandidatcol']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['fakultet']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['startforslag']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['sluttforslag']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['startvalg']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['sluttvalg']+"</b></td>"
          +"<td><b>"+json_data['valg_list'][i]['information']+"</b></td>"
          +"</tr>"
      }
      $("#kandidat_list").html(temp)

    },
    error: function(data){}
  });
</script>
</html>
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
        <a href="index.php">
          <button tyle="button" class="btn btn-primary btn-sm btn-block login-button"><i class="fas fa-arrow-left"></i> Back to Dashboard</button>
        </a>
    	</section>
    	<section>
        <section>
          <section class="grid-border" style="overflow-x: scroll; margin-bottom: 10px;">
          List of Brukers
          <hr class="mtb-10">
          <small>Total Result : <b><span id="total_count"></span></b></small>
          <table>
            <thead>
              <th>Bruker Col</th>
              <th class="text-center">Image</th>
              <th>Name</th>
              <th>Epost</th>
              <th>Bruker type</th>
              <th>Gender</th>
              <th>Phone</th>
              <th>Birthday</th>
              <th></th>
            </thead>
            <tbody id="bruker_list"></tbody>
          </table>
        </section>
        </section>
        <section style="width: 100%; max-width: 600px">
          <section class="card">
            <section class="card-header"><h1>Change User role</h1></section>
            <section class="card-body">
              <form id="changeUserRole" class="form-horizontal">
                <section class="form-group">
                  <label for="password" class="cols-sm-2 control-label">Users</label>
                  <section class="input-group">
                    <select class="form-control" name="userid" id="user_select">
                    </select>
                  </section>
                </section>
                <section class="form-group">
                  <label for="password" class="cols-sm-2 control-label">User Types</label>
                  <section class="input-group">
                    <select class="form-control" name="usertype" id="type_select">
                      <option value=""></option>
                      <option value="1">Administrator</option>
                      <option value="2">Candidates</option>
                      <option value="3">Voters</option>
                      <option value="4">Controllers</option>
                    </select>
                  </section>
                </section>
                <section class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block login-button">send</button>
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
<script type="text/javascript">
  var data = {
    endpoint: 'get_users'
  }
  $.ajax({
    type:'POST',
    url: '../includes/dashboard.php',
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
          +"<td><b>"+json_data['user_list'][i]['id']+"</b></td>"
          +"<td class='text-center'><section class='rounded-circle img-thumbnail avatar' style='background-image:url(../assets/images/profile/"+json_data['user_list'][i]['img_url']+");width:30px;height:30px' title='profile image'></section></td>"
          +"<td>"+json_data['user_list'][i]['fnavn']+ " " + json_data['user_list'][i]['enavn'] + "</td>"
          +"<td>"+json_data['user_list'][i]['epost']+"</td>"
          +"<td>"+json_data['user_list'][i]['brukertype']+"</td>"
          +"<td>"+json_data['user_list'][i]['gender']+"</td>"
          +"<td>"+json_data['user_list'][i]['phone']+"</td>"
          +"<td>"+json_data['user_list'][i]['bday']+"</td>"
          +"</tr>"
      }
      $("#bruker_list").html(temp)

      var content = "<option></option>";
      for (var user of user_list) {
        content += "<option value='"+user['id']+"'>"+user['fnavn']+ " " +user['enavn']+ "</option>";
      }
      $("#user_select").html(content);
    },
    error: function(data){}
  });

  $('#changeUserRole').on('submit', (function(e) {
    e.preventDefault()
    var formData = new FormData(this);
    formData.append('endpoint', 'update_userrole');

    $.ajax({
        type:'POST',
        url: '../includes/dashboard.php',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
          var json_data = JSON.parse(data)
          if(json_data['status'] == 'SUCCESS'){
            $.alert({
              title: 'Success',
              icon: 'far fa-check-circle',
              type: 'green',
              boxWidth: '500px',
              useBootstrap: false,
              animation: 'none',
              content: "<section class='text-center'>" + json_data['message'] + "<section>"
            });
          }
          else{
            $.alert({
              title: 'Error',
              icon: 'fas fa-exclamation-triangle',
              type: 'red',
              boxWidth: '500px',
              useBootstrap: false,
              animation: 'none',
              content: "<section class='text-center'>" + json_data['message'] + "<section>"
            });
          }
          setTimeout(function() {
            window.location.reload();
          }, 1000);
        },
        error: function(data){}
    });

    $(this).trigger("reset");
  }));
</script>
</html>
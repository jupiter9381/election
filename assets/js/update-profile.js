function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      readImage(e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

function resetImg(){
  readImage('../assets/images/profile/avatar.jpeg');
}

function readImage(url){
  $('#profileImage').css('background-image', "url(" + url + ")");
}

$('#imageForm').on('submit', (function(e) {
    e.preventDefault()
    var formData = new FormData(this);
    formData.append('endpoint', 'image_update');

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
        		$('.avatar').css('background-image', "url(../assets/images/profile/" + json_data['img_url'] + ")");

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

          resetImg();
        },
        error: function(data){}
    });

    $(this).trigger("reset");
}));

$('#changePassForm').on('submit', (function(e) {
  e.preventDefault()
  var formData = new FormData(this);
  formData.append('endpoint', 'change_password');

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
      },
      error: function(data){}
  });

  $(this).trigger("reset");
}));
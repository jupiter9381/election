$( document ).ready(function() {
  getNominates();
});

function nominateUser(){
  var modal = $.dialog({
    title: 'Candidate Information',
    content: 'url:../dashboard/nominate-user.php',
    columnClass: 'medium',
    backgroundDismiss: false,
    useBootstrap: false,
    animation: 'none',
    onContentReady: function () {
      // bind to events
      var jc = this;
      this.$content.find('form').on('submit', function (e) {
        // if the user submits the form by pressing enter in the field.
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('endpoint', 'add_candidate');

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

                jc.close();
                getNominates();
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
        // jc.$$formSubmit.trigger('click'); 
      });
    }
  });
}

function nominateMe(){
  var modal = $.dialog({
    title: 'Candidate Information',
    content: 'url:../dashboard/nominate-me.php',
    columnClass: 'medium',
    backgroundDismiss: false,
    useBootstrap: false,
    animation: 'none',
    onContentReady: function () {
      // bind to events
      var jc = this;
      this.$content.find('form').on('submit', function (e) {
        // if the user submits the form by pressing enter in the field.
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('endpoint', 'add_candidate_me');

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

                jc.close();
                getNominates();
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
        // jc.$$formSubmit.trigger('click'); 
      });
    }
  });
}

function nominateMeUpdate(kandidat_id){
  var modal = $.dialog({
    title: 'Update Candidate Information',
    content: 'url:../dashboard/nominate-me-update.php',
    columnClass: 'medium',
    backgroundDismiss: false,
    useBootstrap: false,
    animation: 'none',
    onContentReady: function () {
      var data = {
        endpoint: 'get_candidate_me'
      }
      $.ajax({
          type:'POST',
          url: '../includes/dashboard.php',
          data: data,
          cache:false,
          dataType: 'json',
          success:function(json_data){
            for(var i=0; i < json_data['total_count']; i++){
              $("#fakultet").val(json_data['candidate_list'][i]['fakultet'])
              $("#institutt").val(json_data['candidate_list'][i]['institutt'])
              $("#informasjon").val(json_data['candidate_list'][i]['informasjon'])
            }
          },
          error: function(data){}
      });

      // bind to events
      var jc = this;
      this.$content.find('form').on('submit', function (e) {
        // if the user submits the form by pressing enter in the field.
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('endpoint', 'update_candidate_me');
        formData.append('kandidat_id', kandidat_id);

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

                jc.close();
                getNominates();
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
        // jc.$$formSubmit.trigger('click'); 
      });
    }
  });
}

function getNominates(){
  checkSelfNominate();
  $("#total_count").html('0')
  var data = {
    endpoint: 'get_candidate'
  }
  $.ajax({
    type:'POST',
    url: '../includes/dashboard.php',
    data: data,
    cache:false,
    dataType: 'json',
    success:function(json_data){
      // var json_data = JSON.parse(data)
      $("#total_count").html(json_data['total_count'])

      var temp = ""
      for(var i=0; i < json_data['total_count']; i++){
        var action_button = ""

        if(json_data['candidate_list'][i]['allow_edit']){
          action_button = "<button class='btn btn-sm btn-primary' title='Edit Informasjon' onclick='nominateMeUpdate(" +json_data['candidate_list'][i]['id']+ ")'><i class='far fa-edit'></i></button>";
        }
        temp += "<tr>" 
          +"<td><b>"+json_data['candidate_list'][i]['kandidatcol']+"</b></td>"
          +"<td class='text-center'><section class='rounded-circle img-thumbnail avatar' style='background-image:url(../assets/images/profile/"+json_data['candidate_list'][i]['img_url']+");width:30px;height:30px' title='profile image'></section></td>"
          +"<td>"+json_data['candidate_list'][i]['bruker']+"</td>"
          +"<td>"+json_data['candidate_list'][i]['bruker_epost']+"</td>"
          +"<td>"+json_data['candidate_list'][i]['institutt']+"</td>"
          +"<td>"+json_data['candidate_list'][i]['informasjon']+"</td>"
          +"<td class='text-center'><b>"+json_data['candidate_list'][i]['stemmer']+"</b></td>"
          +"<td class='text-center v-align-center'>"+ action_button +"</td>"
          +"</tr>"
      }
      $("#nominates_list").html(temp)
    },
    error: function(data){}
  });
}

function withdrawCandidacy(){
  var modal = $.confirm({
    title: 'Withdraw from Candidacy',
    content: '<section class="text-center">Are you sure do you want to cancel your candidacy?</section>',
    icon: 'fas fa-user-slash',
    type: 'red',
    boxWidth: '500px',
    backgroundDismiss: false,
    useBootstrap: false,
    animation: 'none',
    buttons: {
      cancel: {
        text: 'No',
        action: function(){
          modal.close();
          getNominates();
        }
      },
      confirm: {
        text: 'Yes',
        btnClass: 'btn-blue',
        action: function(){
          var data = {
            endpoint: 'withdraw_candidate_me'
          }
          $.ajax({
            type:'POST',
            url: '../includes/dashboard.php',
            data: data,
            cache:false,
            dataType: 'json',
            success:function(json_data){
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

                modal.close();
                getNominates();
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
            error: function(data){
            }
          })
        }
      },
    }
  });
}

function checkSelfNominate(){
  var data = {
    endpoint: 'get_candidate_me'
  }
  $.ajax({
    type:'POST',
    url: '../includes/dashboard.php',
    data: data,
    cache:false,
    dataType: 'json',
    success:function(json_data){
      if(json_data['total_count'] == 0){
        $("#nominate").show();
        $("#withdraw").hide();
      }else{
        $("#nominate").hide();
        $("#withdraw").show();
      }
    },
    error: function(data){}
  });
}
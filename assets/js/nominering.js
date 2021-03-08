$( document ).ready(function() {
  getNominates();
});

function getNominates(){
  $("#total_count").html('0')
  var data = {
    endpoint: 'get_candidate'
  }
  $.ajax({
    type:'POST',
    url: 'includes/dashboard.php',
    data: data,
    cache:false,
    dataType: 'json',
    success:function(json_data){
      // var json_data = JSON.parse(data)
      $("#total_count").html(json_data['total_count'])

      var temp = ""
      for(var i=0; i < json_data['total_count']; i++){
        temp += "<tr>" 
          +"<td><b>"+json_data['candidate_list'][i]['kandidatcol']+"</b></td>"
          +"<td class='text-center'><section class='rounded-circle img-thumbnail avatar' style='background-image:url(assets/images/profile/"+json_data['candidate_list'][i]['img_url']+");width:30px;height:30px' title='profile image'></section></td>"
          +"<td>"+json_data['candidate_list'][i]['bruker']+"</td>"
          +"<td>"+json_data['candidate_list'][i]['bruker_epost']+"</td>"
          +"<td>"+json_data['candidate_list'][i]['institutt']+"</td>"
          +"<td>"+json_data['candidate_list'][i]['informasjon']+"</td>"
          +"<td class='text-center'><b>"+json_data['candidate_list'][i]['stemmer']+"</b></td>"
          +"</tr>"
      }
      $("#nominates_list").html(temp)
    },
    error: function(data){}
  });
}
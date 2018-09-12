$(document).ready(function(){

    for(var i=0;i<5;i++)
    {
      var labelname = "radio button"+i;
      var value = i;
      var create = $('<input type="radio" value="'+value+'"><label>'+labelname+'</label><br>');
      $(".lastone").append(create);
    }

});


$(document).ready(function(){
  $("#addradio").click(function(){
    
    for(var i=0;i<9;i++)
    {
      var labelname = "radio button"+i;
      var value = i;
      var create = $('<input type="radio" value="'+value+'"><label>'+labelname+'</label><br>');
      $(".lasttwo").append(create);
    }


  });
  
});
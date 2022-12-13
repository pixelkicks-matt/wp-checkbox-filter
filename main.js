$('#checkbox_filter').change(function(){
  var filter = $('#checkbox_filter');
  $.ajax({
      url:filter.attr('action'),
      data:filter.serialize(),
      type:filter.attr('method'),

      success:function(data){
          $('.post-wrapper-class-here').html(data);
      }
  });
  return false;
});
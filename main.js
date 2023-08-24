$('#filter-form fieldset').change(function () {
  var filter = $('#filter-form');
  $.ajax({
    url: filter.attr('action'),
    data: filter.serialize(),
    type: filter.attr('method'),

    success: function (data) {
      $('#archive').html(data);
    }
  });
  return false;
});

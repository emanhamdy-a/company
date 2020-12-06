$(document).ready(function($){

  $('.deleteBtn').on('submit',function(e){
    e.preventDefault();
    if(confirm('Do you want to delete this item?')){
      var removeId= $(this).attr('removeId');
      $.ajax({
        url:$(this).attr("action"),
        type:$(this).attr("method"),
        data: new FormData(this),
        // dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          $('.done').text('Row deleted successfully .');
          $('.done').css('display','block');
          $('#maxContainer #'+removeId).remove();
          setTimeout(() => {
            $('.done').css('display','none');
          }, 3000);
        },error: function(jqXHR, textStatus, errorThrown) {
        },
      });
    }
  });

  $('#maxContainer').on('submit','.search-form',function(e){
    e.preventDefault();
    formData=$(this).serialize();
    url=$(this).attr("action") + "?" + formData;
    window.history.replaceState('object', 'New Title',url);
      $.ajax({
        url:url,
        type:$(this).attr("method"),
        data: new FormData(this),
        // dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          if(data){
            $('body #maxContainer').html(data);
          }
        },error: function(jqXHR, textStatus, errorThrown) {
        },
      });
  });

  $('#maxContainer').on('click','.activated',function(e){
    e.preventDefault();
    if(confirm('Are you shure you want to Activated?')){
      var change=$(this).attr('id');
      $.ajax({
        url:$(this).attr("href"),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          $('.done').text('Activated successfully .');
          $('.done').css('display','block');
          $('#maxContainer #'+change).replaceWith(data.html);
          setTimeout(() => {
            $('.done').css('display','none');
          }, 3000);
        },error: function(jqXHR, textStatus, errorThrown) {
        },
      });
    }
  });

  $('#maxContainer').on('click','.deactivated',function(e){
    e.preventDefault();
    if(confirm('Are you shure you want to Deactivated?')){
      var change=$(this).attr('id');
      $.ajax({
        url:$(this).attr("href"),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          $('.done').text('Deactivated successfully .');
          $('.done').css('display','block');
          $('#maxContainer #'+change).replaceWith(data.html);
          setTimeout(() => {
            $('.done').css('display','none');
          }, 3000);
        },error: function(jqXHR, textStatus, errorThrown) {
        },
      });
    }
  });
});

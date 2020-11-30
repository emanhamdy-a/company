$(document).ready(function($){
  $('#delete').on('submit',function(e){
     if(!confirm('Do you want to delete this item?')){
        e.preventDefault();
     }
    });
});

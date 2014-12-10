jQuery( document ).ready(function( $ ) {

  $('#edit-filter').click(function(){
 
    var themeindex = $('input:radio[name=theme]:checked').val();
    var impactindex = $('input:radio[name=impact]:checked').val();
    var averageextremeindex = $('input:radio[name=descriptor]:checked').val();
    
    $.getJSON( 'map/variablelist/' + themeindex + '/' + impactindex + '/' + averageextremeindex, function ( options ) { 
      $('#edit-variable').empty();
      $.each(options, function(val, text) {
          $('#edit-variable').append(
            $('<option></option>').val(val).html(text)
          );
      });
    });   
    return(false); 
  });  
  
}); 
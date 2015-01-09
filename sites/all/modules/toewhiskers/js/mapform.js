jQuery( document ).ready(function( $ ) {

  $('#edit-filter').click(function(){
    var themeindex;
    if($('input[name=hiddentheme]').val()){ themeindex = $('input[name=hiddentheme]').val(); }
    else {      
      themeindex = $('input:radio[name=theme]:checked').val();    
    }
    var impactindex = $('input:radio[name=impact]:checked').val();
    var averageextremeindex = $('input:radio[name=descriptor]:checked').val();
    var typeindex = $('input:radio[name=type]:checked').val();  
    
    $.getJSON( 'map/variablelist/' + themeindex + '/' + impactindex + '/' + averageextremeindex+ '/' + typeindex, function ( options ) { 
      $('#edit-variable').empty();
      var tempObject = options.variablesarray;
      $.each(tempObject, function(val, text) {
        $('#edit-variable').append(
          $('<option></option>').val(val).html(text)
        );
      });
    });   
    return(false); 
  });  
  
}); 
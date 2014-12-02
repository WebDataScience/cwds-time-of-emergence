
jQuery( document ).ready(function( $ ) {

  
      
      
  // Hide/show additional form components as necessary.
  $('input[name=theme]:radio').click(function(){
  
    if($('input:radio[name=compare]:checked').val() == '0'){ 
      $('div.form-item-geodomain').show(); 
      $('div.form-item-region').show(); 
    }
    if($('input:radio[name=compare]:checked').val() == '1'){ 
      $('div.form-item-geodomain').hide(); 
      $('div.form-item-region').hide(); 
    }
    if($('input:radio[name=compare]:checked').val() == '2'){ 
      $( "#toewhiskers-explore-form" ).submit();
      return;
    }
    //enable 'region' dropdown.
    // this solution requires newer version of jQuery: $("#edit-region").prop("disabled", false);
    //$('#edit-region').removeAttr('disabled');
    //$('div.form-item-region').show(); 
    //$('div.form-item-geodomain').show();   
    $('#edit-submit').removeAttr('disabled');  
    

    
    $.getJSON( 'map/variablelist', function ( options ) { 
      //alert ( options );
      $('#edit-variable').empty();
      $.each(options, function(val, text) {
          $('#edit-variable').append(
            $('<option></option>').val(val).html(text)
          );
      });
    });
    
    
    
  });
        
        
}); 
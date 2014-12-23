jQuery( document ).ready(function( $ ) {

      $('div.form-item-regioncounty').hide();   
      $('div.form-item-regionwatershed').hide();         
      $('div.form-item-geodomain').hide(); 
      $('#edit-submit').attr('disabled', 'disabled');
     
    exploreformvisibility();
    // Hide/show additional form components as necessary.
    $('input[name=compare]:radio').click(function(){
      exploreformvisibility();
    });
    $('input[name=geodomain]:radio').click(function(){
      exploreformvisibility();
    });
    
    function exploreformvisibility(){
    
      if($('input:radio[name=compare]:checked').val() == '0'){ 
        $('div.form-item-geodomain').show(); 
        exploreformvisibilityinterest();        
      }
      if($('input:radio[name=compare]:checked').val() == '1'){ 
        $('div.form-item-geodomain').hide(); 
        exploreformvisibilityinterest(); 
        $('#edit-submit').removeAttr('disabled');        
      } 
    }
    
    function exploreformvisibilityinterest(){
      $('div.form-item-regioncounty').hide(); 
      $('div.form-item-regionwatershed').hide(); 
      if($('input:radio[name=compare]:checked').val() == '0'){
         if($('input:radio[name=geodomain]:checked').val() == '1'){ 
           $('div.form-item-regioncounty').show();
           $('#edit-submit').removeAttr('disabled');         
         }
         if($('input:radio[name=geodomain]:checked').val() == '3'){ 
           $('div.form-item-regionwatershed').show(); 
           $('#edit-submit').removeAttr('disabled');  
         }
      }
    }
  
}); 
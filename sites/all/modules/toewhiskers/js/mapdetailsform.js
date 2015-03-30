jQuery( document ).ready(function( $ ) {
  // If dataset bcsd3 is checked than automagically select the 'high' emissionscenario. 
  bcsd3();
  $('input:radio[name=dataset]').click(bcsd3);
  function bcsd3(){
    var $eradios = $('input:radio[name=emissionscenario]');
    if ($("input[name='dataset']:checked").val() == 'd3') {
      $eradios.filter('[value=1]').prop('disabled', true);
      $eradios.filter('[value=2]').prop('checked', true);
    } else {
      $eradios.filter('[value=1]').prop('disabled', false);
    }   
  }
}); 
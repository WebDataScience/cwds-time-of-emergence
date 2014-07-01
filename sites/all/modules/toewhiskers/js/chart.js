

google.load("visualization", "1", {packages:["corechart"]});



jQuery( document ).ready(function( $ ) {


  dataarray = []; 

  $.post( "timelinedata", function( jsonobj ) { 
  
    for (var key in jsonobj) {
       var onerow = jsonobj[key];
       dataarray.push([key,onerow[1],onerow[2],onerow[3],onerow[4]]);
    }
    
    var data = google.visualization.arrayToDataTable(dataarray, true);
    drawCandlesticks(data);
    
    
    
    dataarray = [
      ['Genre', 'Clear area text','Yellow text', 'Green text', 'Black text', 'Green text',         'Yellow text',  { role: 'annotation' } ],
        ['Air Temp 22C', 2010, 4, 2, 1, 3, 5, ''],
        ['Sea Temp 6C', 2016, 8, 3, 1, 6, 9, ''],
        ['Wind Vel > 10mph', 2028, 9, 2, 1, 2, 13, '']  ];
    data = google.visualization.arrayToDataTable(dataarray, false);
    drawStackedBarChart(data);
    
    
  });
  
  
  
}); 
  
  

    
    

function drawCandlesticks(data) {

  var options = {
    legend:'none', orientation:'horizontal'
  };

  var chart = new google.visualization.CandlestickChart(document.getElementById('timeline-chart'));
  chart.draw(data, options);
}

function drawStackedBarChart(data) {

  var options = {
    tooltip:{
      trigger:'none',
    },
    legend:'none',
    colors:['white','yellow','green','black','green','yellow','white'],
    hAxis:{
      minValue: 2000,
      viewWindow:{
        min : 2000,
      },
    },
    //width: 600,
        //height: 400,
        //legend: { position: 'top', maxLines: 3 },
	bar: { groupWidth: '75%' },
        isStacked: true,
      };

  var chart = new google.visualization.BarChart(document.getElementById('stackedbar-chart'));
  chart.draw(data, options);
}


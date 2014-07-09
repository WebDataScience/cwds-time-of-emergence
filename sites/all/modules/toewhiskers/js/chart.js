

google.load("visualization", "1", {packages:["corechart"]});



jQuery( document ).ready(function( $ ) {

  var sid = getParameterByName('sid');

  dataarray = []; 

  $.post( "timelinedata/" + sid, function( jsonobj ) { 
  
    //alert(jsonobj.query);
  
    dataarray = [  ['Genre', '',{ role: 'style' },'Blue',{ role: 'style' }] ];
  
    toedata = jsonobj.toedata;
  
    for (var key in toedata) {
       var onerow = toedata[key];
       dataarray.push([onerow[2],onerow[1],'opacity: 0',1,'opacity: 1']);
    }

    //var data = google.visualization.arrayToDataTable(dataarray, true);
    //drawCandlesticks(data);
    
    var stackeddata = google.visualization.arrayToDataTable(dataarray, false);
    drawStackedBarChart(stackeddata);
    
    
    // Timeline chart include start and end dates which don't work for ToE.
    //drawTimelineChart();
    
  });
  
  
  
}); 
  
  


function drawTimelineChart() {

  var container = document.getElementById('timeline-chart');
  var chart = new google.visualization.Timeline(container);

  var dataTable = new google.visualization.DataTable();
  dataTable.addColumn({ type: 'string', id: 'Position' });
  dataTable.addColumn({ type: 'string', id: 'Name' });
  dataTable.addColumn({ type: 'date', id: 'Start' });
  dataTable.addColumn({ type: 'date', id: 'End' });
  dataTable.addRows([
    [ 'President',          'George Washington', new Date(1789,0,0), new Date(1789,0,0)],
    [ 'President',          'John Adams',        new Date(1797, 2, 3),  new Date(1797, 2, 4)],
    [ 'President',          'Thomas Jefferson',  new Date(1801, 2, 3),  new Date(1909, 2, 3)],
    [ 'Vice President',     'John Adams',        new Date(1789, 3, 20), new Date(1797, 2, 3)],
    [ 'Vice President',     'Thomas Jefferson',  new Date(1797, 2, 3),  new Date(1801, 2, 3)],
    [ 'Vice President',     'Aaron Burr',        new Date(1801, 2, 3),  new Date(1805, 2, 3)],
    [ 'Vice President',     'George Clinton',    new Date(1805, 2, 3),  new Date(1812, 3, 19)],
    [ 'Secretary of State', 'John Jay',          new Date(1789, 8, 25), new Date(1790, 2, 21)],
    [ 'Secretary of State', 'Thomas Jefferson',  new Date(1790, 2, 21), new Date(1793, 11, 30)],
    [ 'Secretary of State', 'Edmund Randolph',   new Date(1794, 0, 1),  new Date(1795, 7, 19)],
    [ 'Secretary of State', 'Timothy Pickering', new Date(1795, 7, 19), new Date(1800, 4, 11)],
    [ 'Secretary of State', 'Charles Lee',       new Date(1800, 4, 12), new Date(1800, 5, 4)],
    [ 'Secretary of State', 'John Marshall',     new Date(1800, 5, 12), new Date(1801, 2, 3)],
    [ 'Secretary of State', 'Levi Lincoln',      new Date(1801, 2, 4),  new Date(1801, 4, 0)],
    [ 'Secretary of State', 'James Madison',     new Date(1801, 4, 1),  new Date(1809, 2, 2)]]);

  chart.draw(dataTable);
}
    
    

function drawCandlesticks(data) {

  var options = {
    legend:'none', orientation:'horizontal'
  };

  var chart = new google.visualization.CandlestickChart(document.getElementById('candlesticks-chart'));
  chart.draw(data, options);
}

function drawStackedBarChart(data) {

  var options = {
    tooltip:{
      //trigger:'none',
    },
    legend:'none',
    colors:['white','blue','white','blue','white','blue'],
    hAxis:{
      minValue: 2000,
      viewWindow:{
        min : 2000,
        max : 2200,
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

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



google.load("visualization", "1", {packages:["corechart"]});



jQuery( document ).ready(function( $ ) {

  var sid = getParameterByName('sid');

  dataarray = []; 
  jsondataarray = [];
  // Some of Google charts default colors.
  colorarray = ["#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"];
  // Gradient colors from http://www.perbang.dk/rgbgradient/
  colorarray = ["#E59C00","#E39400","#E18C00","#DF8400","#DD7C00","#DB7400","#D96C00","#D76400","#D55C00","#D35400","#D14C01","#CF4401","#CD3C01","#CB3401","#C92C01","#C72401","#C51C01","#C31401","#C10C01","#C00402"];

  $.post( "timelinedata/" + sid, function( jsonobj ) { 
  
    //alert(jsonobj.query);
  
    dataarray = [  ['Genre', '',{ role: 'style' },'Blue',{ role: 'style' }] ];
    //jsondataarray = [['Variable','Year of Emergence',{ role: 'annotation' }]];
    jsondataarray = [['Variable','Year of Emergence', {role: 'style'}, ]];
  
    toedata = jsonobj.toedata;
  
    for (var key in toedata) {
       var onerow = toedata[key];
       dataarray.push([onerow[2],onerow[1],'opacity: 0',1,'opacity: 1']);
       //jsondataarray.push([onerow[2],onerow[1],onerow[2]]);
       jsondataarray.push([ onerow[2],onerow[4], colorarray.shift() ]);
    }

    
    var nochartmessage = "<p>No results are available for that configuration of parameters.</p>";
    if(jsondataarray.length == 1){
      $("#horizontal-bar-chart" ).html( nochartmessage );
      return;
    } 
    
    
    var hbardata = google.visualization.arrayToDataTable(jsondataarray, false);
    drawHorizontalBarChart(jsondataarray, jsonobj.maxtoeyear);
    
  });
  
  
  
}); 
  
  
  
  function drawHorizontalBarChart(jsondataarray, maxtoeyear) {
 
    var data = google.visualization.arrayToDataTable(jsondataarray, false);

    var height = 600;
   
    var orientation = 'horizontal';
    if(orientation == 'vertical'){ height = 10 + (40 * (dataarray.length - 1));}
   
        var options = {
          colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
          //"#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"
          
          title: 'Time of Emergence',
          height: height,
          vAxis:{
            title: 'Year of Emergence',
            minValue: 2000,
            viewWindow:{
              min : 2000,
              max : maxtoeyear,
            },
          },
          legend:{
            position: 'none',
          },
          orientation: 'horizontal',
        };

        var chart = new google.visualization.BarChart(document.getElementById('horizontal-bar-chart'));
        chart.draw(data, options);
      }



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

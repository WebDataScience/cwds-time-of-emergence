

google.load("visualization", "1", {packages:["corechart"]});



jQuery( document ).ready(function( $ ) {

  var websitetextarray = new Object();
  var confidence = new Object();
  confidence['5'] = 'Lower bound (earlier ToE)';
  confidence['50'] = 'Central tendency';
  confidence['95'] = 'Upper bound (later ToE)';
  websitetextarray['confidence'] = confidence;
  var tolerance = new Object;
  tolerance['95'] = 'Low (middle 90% of historical fluctuations)';
  tolerance['80'] = 'High (middle 60% of historical fluctuations)';
  websitetextarray['tolerance'] = tolerance;
  var dataset = new Object;
  dataset['BCSD5'] = 'Statistically-downscaled (CMIP5 BCSD)';
  websitetextarray['dataset'] = dataset;
  var emission = new Object;
  emission['rcp45'] = 'RCP4.5';
  emission['rcp85'] = 'RCP8.5';
  websitetextarray['emission'] = emission;



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
    timelinedataarray = []; // [ [toe(integer),height(zero)], ];
  
    toedata = jsonobj.toedata;
  
    for (var key in toedata) {
       var onerow = toedata[key];
       dataarray.push([onerow[2],onerow[1],'opacity: 0',1,'opacity: 1']);
       //jsondataarray.push([onerow[2],onerow[1],onerow[2]]);
       jsondataarray.push([ onerow[2],onerow[4], colorarray.shift() ]);
       timelinedataarray.push([ onerow[4] , 0, onerow[2], onerow[5]]); //Math.floor(Math.random()*2)
    }

    
    var nochartmessage = "<p>No results are available for that configuration of parameters.</p>";
    if(timelinedataarray.length ==  0){
      $("#chartmessage" ).html( nochartmessage );
      return;
    } 
    
    // Old GoogleCharts based bar chart
    //var hbardata = google.visualization.arrayToDataTable(jsondataarray, false);
    //drawHorizontalBarChart(jsondataarray, jsonobj.maxtoeyear);
    
    
    // D3.js based timeline chart
    drawD3Timeline(timelinedataarray, jsonobj.maxtoeyear);
    
    $(".emission" ).html( websitetextarray['emission'][jsonobj.emission] );
    $(".confidence" ).html( websitetextarray['confidence'][jsonobj.confidence] );
    $(".tolerance" ).html( websitetextarray['tolerance'][jsonobj.tolerance] );
    $(".dataset" ).html( websitetextarray['dataset'][jsonobj.dataset] );
    
    
    // Table modification via jQuery.
    tabledata = jsonobj.tabledata;
    for (var key in tabledata) {
      var onerow = tabledata[key];
      $('#tabledata tr:last').after("<tr><td><a href='/boxplot'>" + onerow.shortname + "</a></td><td>" + onerow.toe25 + " - " + onerow.toe75 + "</td><td>" + (onerow.changedir == '1'?'Positive':'Negative')  + "</td></tr>");  
    }
    
    
  });
  
}); 
  
  
function drawD3Timeline(timelinedataarray, maxtoeyear){
 var data = [[2000,0,"tooltip1","label1"], [2020,0,"tooltip2","label2"], [2085,0,"tooltip3","label3"], [2040,0,"tooltip4","label4"]];
 
 var chartheight = 100;
 data = timelinedataarray;
		   
		var margin = {top: 20, right: 15, bottom: 60, left: 60}
		  , width = 960 - margin.left - margin.right
		  , height = chartheight - margin.top - margin.bottom;

		var format = d3.format("0000");

		var x = d3.scale.linear()
		          .domain([2000, 2100])
		          .range([ 0, width ]);

		var y = d3.scale.linear()
		        .domain([0, d3.max(data, function(d) { return d[1]; })])
		        .range([ height, 0 ]);

		var chart = d3.select('#timeline-chart')
		.append('svg:svg')
		.attr('width', width + margin.right + margin.left)
		.attr('height', height + margin.top + margin.bottom)
		.attr('class', 'chart')

		var main = chart.append('g')
		.attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')
		.attr('width', width)
		.attr('height', height)
		.attr('class', 'main')   
		    
		// draw the x axis
		var xAxis = d3.svg.axis()
		.scale(x)
		.orient('bottom')
		.tickFormat(format)
		.tickSize(11,-1);


/*added*/
		var xAxisMinor = d3.svg.axis()
		  .scale(x)
		  .orient('bottom')
		  .ticks(100);

main.append('g')
                .attr('transform', 'translate(0,' + height + ')')
                .attr('class', 'minor-axis-date')
                .call(xAxisMinor);


/* */ 

		main.append('g')
		.attr('transform', 'translate(0,' + height + ')')
		.attr('class', 'main axis date main-axis-date')
		.call(xAxis);

		var g = main.append("svg:g"); 

		var node = g.selectAll("g")
                .data(data)
                .enter()
                .append("g");

		node.append("line")
		  .attr("class", "scatter-point")
		  	.attr("class", "tick")
		  .attr("x1", function (d,i) { return x(d[0]); } )
			.attr("y1", -5)
			.attr("x2", function (d,i) { return x(d[0]); } )
			.attr("y2", 20)
			.attr("stroke-width", 2)
			.style("shape-rendering", "crispEdges")
		//	.attr("stroke", "black");
			.attr("stroke", "white");




		node.append("line:circle")
		  .attr("cx", function (d,i) { return x(d[0]); } )
		  .attr("cy", function (d) { return y(d[1]); } )
		  .attr("r", 4);

		node.append("line:text")
		  .attr("class", "point-label")
		  .attr("x", function (d,i) { return x(d[0]); } )
		  .attr("y", function (d) { return y(d[1]); } )
		  .attr("dy", -32)

		  .style("text-anchor", "middle")
		  .text(function(d) { return d[3]; })
		  .attr('title', function(d) { return d[2]; }); 
}


function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

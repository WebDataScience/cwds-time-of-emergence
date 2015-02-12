

jQuery( document ).ready(function( $ ) {

  var websitetextarray = new Object();
  var confidence = new Object();
  confidence['95'] = 'Faster';
  confidence['50'] = 'Central';
  confidence['5'] = 'Slower';
  websitetextarray['confidence'] = confidence;
  var tolerance = new Object;
  tolerance['95'] = 'Low (to extreme 10% of 1950-1999 conditions)';
  tolerance['80'] = 'High (to extreme 40% of 1950-1999 conditions)';
  websitetextarray['tolerance'] = tolerance;
  var dataset = new Object;
  dataset['BCSD5'] = 'Statistically-downscaled (CMIP5 BCSD)';
  websitetextarray['dataset'] = dataset;
  var emission = new Object;
  //emission['rcp45'] = 'RCP4.5';
  //emission['rcp85'] = 'RCP8.5';
  
  emission['low'] = 'Low (RCP4.5 or B1)';
  emission['high'] = 'High (RCP8.5 or A1B)';
  
  websitetextarray['emission'] = emission;
  websitetextarray['region'] = jQuery( "#region" ).html();


  dataarray = []; 
  jsondataarray = [];
  // Some of Google charts default colors.
  colorarray = ["#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"];
  // Gradient colors from http://www.perbang.dk/rgbgradient/
  colorarray = ["#E59C00","#E39400","#E18C00","#DF8400","#DD7C00","#DB7400","#D96C00","#D76400","#D55C00","#D35400","#D14C01","#CF4401","#CD3C01","#CB3401","#C92C01","#C72401","#C51C01","#C31401","#C10C01","#C00402"];


  
  // Ajax endpoint will retrieve vars and parameters from session.
  $.post( "timelinedata" , function( jsonobj ) { 
  
    dataarray = [  ['Genre', '',{ role: 'style' },'Blue',{ role: 'style' }] ];
    //jsondataarray = [['Variable','Year of Emergence',{ role: 'annotation' }]];
    jsondataarray = [['Variable','Year of Emergence', {role: 'style'}, ]];
    timelinedataarray = []; // [ [toe(integer),height(zero)], ];
  
    toedata = jsonobj.timelinedata;
  
    for (var key in toedata) {
       var onerow = toedata[key];
       dataarray.push([onerow[2],onerow[1],'opacity: 0',1,'opacity: 1']);
       //jsondataarray.push([onerow[2],onerow[1],onerow[2]]);
       jsondataarray.push([ onerow[2],onerow[4], colorarray.shift() ]);
       timelinedataarray.push([ onerow[4] , 0, onerow[2], onerow[5], onerow[6], 0]);
       /* val 0 at [5] represents default vertical height between the axis and variable label */ 
    }

    var nochartmessage = "<p>No results are available for that configuration of parameters.</p>";
    if(timelinedataarray.length ==  0){
      $("#chartmessage" ).html( nochartmessage );
      $("#timeline-chart" ).empty();
      return;
    } 
    //remove the loading gif
    $("#timeline-chart" ).empty();
    // D3.js based timeline chart
    //console.log(websitetextarray['emission'][jsonobj.emission] + timelinedataarray + jsonobj.maxtoeyear);
    drawD3Timeline(
      timelinedataarray, 
      jsonobj.maxtoeyear,
      'Time of Emergence in : ' + websitetextarray['region'],
    
      'Estimated Rate of Climate Change: ' + websitetextarray['confidence'][jsonobj.confidence],
      'Past Sensitivity: ' +websitetextarray['tolerance'][jsonobj.tolerance],
      //'Climate Data: ' + websitetextarray['dataset'][jsonobj.dataset]
     // 'Region: ' + websitetextarray['region']
      'Emissions Scenario: ' + websitetextarray['emission'][jsonobj.emission]
    );
    //console.log($(".emission" ));

    $(".emission" ).html( websitetextarray['emission'][jsonobj.emission] );
    $(".confidence" ).html( websitetextarray['confidence'][jsonobj.confidence] );
    $(".tolerance" ).html( websitetextarray['tolerance'][jsonobj.tolerance] );
   // $(".dataset" ).html( websitetextarray['dataset'][jsonobj.dataset] );
    
    
    // Table modification via jQuery.
    tabledata = jsonobj.tabledata;
    for (var key in tabledata) {
      var onerow = tabledata[key];
      $('#tabledata tr:last').after("<tr><td><a href='/boxplots/"
				    + key + "'>" + onerow.VARIABLESHORTNAME
				    + "</a></td><td>"
				    + dateConversion(onerow) + "</td><td>"
				    + (onerow.CHANGEDIR == '1'?'Increasing':'Decreasing')  + "</td></tr>");  
    }
    
    // Display debug info into hidden div
    $("#hiddenconsole" ).html( "timelinequery: " + jsonobj.timelinequery + "<br>tablequery: " + jsonobj.tablequery );
    
  });
  
});


// Handle the multiple date conversion scenarios
function dateConversion(onerow) {
  //code
  

   if (onerow.YEARA >= '2100') {
    return 'Beyond 2100';
  }
  
     if (onerow.YEARB >= '2100') {
    return onerow.YEARA + " - " + 'Beyond 2100';
  }
    //if Unkownn
  if (onerow.YEARA == 'Unknown' || onerow.YEARB == 'Unknown') {
    return  (onerow.YEARA == 'Unknown' && onerow.YEARB == 'Unknown'?'No emergence':onerow.YEARA + " - " + onerow.YEARB);
  }
  return onerow.YEARA + " - " + onerow.YEARB;

 
}
  
//function drawD3Timeline(timelinedataarray, maxtoeyear,confidence,tolerance,dataset,region, emission)  
function drawD3Timeline(timelinedataarray, maxtoeyear,confidence,tolerance,dataset, region){
 var data = [[2000,0,"tooltip1","label1","rcp45",50],
	     [2020,0,"tooltip2","label2","rcp85",50],
	     [2085,0,"tooltip3","label3","rcp45",50],
	     [2040,0,"tooltip4","label4","rcp45",50]];
 
 var chartheight = 280;
 data = timelinedataarray;

/* Code to prevent label text overlapping */

var temparr = [[0,0]];

for (var i = 0; i < data.length; i++) {
	var found = false;
	for (var j = 0; j < temparr.length; j++) {
		if (data[i][0] == temparr[j][0]) {
			var count = temparr[j][1];
			data[i][5] = data[i][5] + (5 + count * 10);
			temparr[j][1] = count + 1;
			found = true;
		}
	}

	if (found == false) {
		temparr.push([data[i][0], 1]);
	}
} 
		   
		var margin = {top: 120, right: 40, bottom: 40, left: 30}
		  , width = 940 - margin.left - margin.right
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
		.attr('height', height + margin.top + margin.bottom);

    // Color the background.
    chart.append("rect")
    .attr("width", width + margin.right + margin.left -2)
    .attr("height", "100%")
    .attr('border', 0)
    .attr("fill", "black");
    
    chart.append("text")
        .attr("x", 15)             
        .attr("y", 20)
        .style("stroke", "white")
        .style('font-size', '14px')
        .style('font-family', 'sans-serif')
        .text(confidence);
    chart.append("text")
        .attr("x", 15)             
        .attr("y", 40)
        .style("stroke", "white")
        .style('font-size', '14px')
        .style('font-family', 'sans-serif')
        .text(tolerance); 
    chart.append("text")
        .attr("x", 15)             
        .attr("y", 60)
        .style("stroke", "white")
        .style('font-size', '14px')
        .style('font-family', 'sans-serif')
        .text(dataset);

    chart.append("text")
        .attr("x", 15)             
        .attr("y", 80)
        .style("stroke", "white")
        .style('font-size', '14px')
        .style('font-family', 'sans-serif')
        .text(region);
	
    /*
    chart.append("svg:image")
        .attr("xlink:href", "http://toe/sites/all/modules/toewhiskers/images/kingcounty200x200.png")
        .attr("x", width-105+margin.right+margin.left)
        .attr("y", 0)
        .attr("width", "105")
        .attr("height", "105");
    */
    
		var main = chart.append('g')
		.attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')
		.attr('width', width)
		.attr('height', height)
		.attr('class', 'main')   
		    
		// draw the x axis
		var xAxis = d3.svg.axis()
		.scale(x)
		.orient('bottom')
		.ticks(20)
		.tickFormat(format)
		.tickSize(15,-1);

		main.append('g')
		.attr('transform', 'translate(0,' + height + ')')
		.attr('class', 'main axis date main-axis-date')
		.call(xAxis);
    
    // Attributes for the xAxis.
    d3.select('.axis')
      .attr("stroke", "white")
      .attr("stroke-width", 2)
      .attr('shape-rendering','crispEdges');
         
		var g = main.append("svg:g"); 

		var node = g.selectAll("g")
                .data(data)
                .enter()
                .append("g");         
        
    // vertical variable line.        
		node.append("line")
		  .attr("x1", function (d,i) { return x(d[0]); } )
      .attr("y1", function(d,i) { return d[5]; })
			.attr("x2", function (d,i) { return x(d[0]); } )
			.attr("y2", 120)
			.attr("stroke-width", 1)
			.style("shape-rendering", "crispEdges")
      .attr('opacity', 1)
			.attr("stroke", "white");

		node.append("line:circle")
		  .attr("cx", function (d,i) { return x(d[0]); } )
		  .attr("cy", function (d) { return y(d[1]); } )
      .attr("fill", "#248F24")
      .attr("stroke", "#99FF99")
		  .attr("r", "6");

    // Hide some of the vertical line as necessary with a black rectangle.
		node.append("line:rect") 
      .attr("x", function (d,i) { return x(d[0]) - 5; } )
      .attr("y", function (d) { return d[5] - 10; } )
      .attr("height", "15")
      .attr("width", "10")
      .attr("fill", "#070707");

    // Add variable short names.
		node.append("line:text")
		  .attr("x", function (d,i) { return x(d[0]); } ) 
		  .attr("y", function (d) { return d[5]; } )
		  .style("stroke", "white")
      .style('font-size', '11px')
      .style('font-family', 'sans-serif')
      .attr("stroke-width", .3)
		  .style("text-anchor", "middle")
		  .text(function(d) { return d[3]; })
		  .attr('title', function(d) {  return d[2]; })
		  .attr('alt', function(d) { return d[2]; })
		.on("click", function(d) {
		document.location.href="/boxplot" }); 
    
    // Attributes for all other text.
    d3.selectAll('text')
      .attr('fill', 'white')
      .style('font-size', '11px')
      .attr("stroke-width", .3)
      .style('font-family', 'sans-serif')
			.style('text-shadow', 'none');

}


function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

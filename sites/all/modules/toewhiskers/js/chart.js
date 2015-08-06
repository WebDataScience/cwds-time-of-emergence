
jQuery( document ).ready(function( $ ) {
  var websitetextarray = new Object();
  var confidence = new Object();
  confidence['95'] = 'Fast';
  confidence['50'] = 'Moderate';
  confidence['5'] = 'Slow';
  websitetextarray['confidence'] = confidence;
  var rateofchange = new Object();
  rateofchange['fast'] = 'Fast';
  rateofchange['moderate'] = 'Moderate';
  rateofchange['slow'] = 'Slow';
  websitetextarray['rateofchange'] = rateofchange;
  var tolerance = new Object;
  tolerance['95'] = 'Low (to extreme 10% of 1950-1999 conditions)';
  tolerance['80'] = 'High (to extreme 40% of 1950-1999 conditions)';
  websitetextarray['tolerance'] = tolerance;
  var dataset = new Object;
  dataset['BCSD5'] = 'Statistically-downscaled (CMIP5 BCSD)';
  websitetextarray['dataset'] = dataset;
  var emission = new Object;
  
  emission['low'] = 'Low (RCP4.5 or B1)';
  emission['high'] = 'High (RCP8.5 or A1B)';
  
  websitetextarray['emission'] = emission;
  websitetextarray['region'] = jQuery( "#region" ).html();

  dataarray = []; 
  jsondataarray = [];
  // Gradient colors from http://www.perbang.dk/rgbgradient/
  colorarray = ["#E59C00","#E39400","#E18C00","#DF8400","#DD7C00","#DB7400","#D96C00","#D76400","#D55C00","#D35400","#D14C01","#CF4401","#CD3C01","#CB3401","#C92C01","#C72401","#C51C01","#C31401","#C10C01","#C00402"];

  // Ajax endpoint will retrieve vars and parameters from session.
  //$.post( "timelinedata" , function( jsonobj ) { 
  $.post( "/?q=timelinedata" , function( jsonobj ) { 
  
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
       // onerow[7] = dataset
       timelinedataarray.push([ onerow[4] , 0, onerow[2], onerow[5], onerow[6], 0, onerow[7] ]);
       /* val 0 at [5] represents default vertical height between the axis and variable label */ 
    }

    // Set 'no result' message if every result TOE is zero.
    var index, varcount, toecount;
    toecount = 0;
    for (index = 0, varcount = timelinedataarray.length; index < varcount; ++index) {
      if(timelinedataarray[index][0] > 0){ 
        toecount = 1;
        break;
      }
    }
    var nochartmessage = "<h4>No emergence prior to 2100 for the variables and parameters selected.</h4>";
    if(toecount == 0){
      $("#chartmessage" ).html( nochartmessage );
    } 
     
    //remove the loading gif
    $("#timeline-chart" ).empty();
    // D3.js based timeline chart
    //console.log(websitetextarray['emission'][jsonobj.emission] + timelinedataarray + jsonobj.maxtoeyear);
    drawD3Timeline(
      timelinedataarray, 
      jsonobj.maxtoeyear,
      'Estimated Rate of Climate Change: ' + websitetextarray['rateofchange'][jsonobj.rateofchange],
      'Management Sensitivity: ' + websitetextarray['tolerance'][jsonobj.tolerance],
      'Multi-model median',
      'Time of Emergence in : ' + websitetextarray['region'],
      'Emissions Scenario: ' + websitetextarray['emission'][jsonobj.emission]
    );
    
    // Table modification via jQuery.
    tabledata = jsonobj.tabledata;
    for (var key in tabledata) {
      var onerow = tabledata[key];
      $('#tabledata tr:last').after("<tr>"
	      + "<td>" + onerow.VARIABLESHORTNAME + "</td><td>"
        + dateConversion(onerow) + "</td>"
	      + "<td><a href='/?q=dotplots/" + key + "'>see details</a></td>" +
        "<td>" + onerow.CHANGEDIRTEXT + "</td></tr>"); 
    }
    // Display debug info into hidden div
    $("#hiddenconsole" ).html( "timelinequery: " + jsonobj.timelinequery + "<br>tablequery: " + jsonobj.tablequery );
  });
});


// Handle the multiple date conversion scenarios
function dateConversion(onerow) {
  if (onerow.YEARA >= '2100') {
    return 'Beyond 2100';
  }
  if (onerow.YEARB >= '2100') {
    return onerow.YEARA + " - " + 'Beyond 2100';
  }
  //if Unknown
  if (onerow.YEARA == 'Unknown' || onerow.YEARB == 'Unknown') {
    return  (onerow.YEARA == 'Unknown' && onerow.YEARB == 'Unknown'?'No emergence':onerow.YEARA + " - " + onerow.YEARB);
  }
  return onerow.YEARA + " - " + onerow.YEARB;
}
  
  
function drawD3Timeline(timelinedataarray, maxtoeyear,confidence,tolerance,model,region, emission){
//function drawD3Timeline(timelinedataarray,maxtoeyear,confidence,tolerance,dataset,region){
  // js created timeline image styles
  var bgco = "white";
  var textco = "black";
  var dotco = "green";
  var dotfillco = "#248F24";
  var dotcircleco = "#99FF99"; 
  var chartheight = 280;
  var data = timelinedataarray;

  /* Code to (usually) prevent timeline marker label text overlapping */
  var rownumber = 0;
  for (var i = 0; i < data.length; i++) {
    data[i][5] = rownumber * 12;
    rownumber += 1;
    if(rownumber > 8){rownumber = 0;}
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
    .attr("fill", bgco);
  chart.append("text")
    .attr("x", 15)             
    .attr("y", 100)
    .style("stroke", textco)
    .style('font-size', '14px')
    .style('font-family', 'sans-serif')
    .text(confidence);
  chart.append("text")
    .attr("x", 15)             
    .attr("y", 80)
    .style("stroke", textco)
    .style('font-size', '14px')
    .style('font-family', 'sans-serif')
    .text(tolerance); 
  chart.append("text")
    .attr("x", 15)             
    .attr("y", 40)
    .style("stroke", textco)
    .style('font-size', '14px')
    .style('font-family', 'sans-serif')
    .text(model);
  chart.append("text")
    .attr("x", 15)             
    .attr("y", 20)
    .style("stroke", textco)
    .style('font-size', '14px')
    .style('font-family', 'sans-serif')
    .text(region);
  chart.append("text")
    .attr("x", 15)             
    .attr("y", 60)
    .style("stroke", textco)
    .style('font-size', '14px')
    .style('font-family', 'sans-serif')
    .text(emission);
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
    .attr("stroke", textco)
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
    .attr("stroke", textco);
  node.append("line:circle")
    .attr("cx", function (d,i) { return x(d[0]); } )
    .attr("cy", function (d) { return y(d[1]); } )
    .attr("fill", dotco)
    .attr("stroke", dotcircleco)
    .attr("r", "6");
  // Hide some of the vertical line as necessary with a black rectangle.
  node.append("line:rect") 
    .attr("x", function (d,i) { return x(d[0]) - 5; } )
    .attr("y", function (d) { return d[5] - 10; } )
    .attr("height", "15")
    .attr("width", "10")
    //.attr("fill", "#070707");
    .attr("fill", bgco);
  // Add 'variable short name - dataset'
  node.append("line:text")
    .attr("x", function (d,i) { return x(d[0]); } ) 
    .attr("y", function (d) { return d[5]; } )
    .style("stroke", textco)
    .style('font-size', '11px')
    .style('font-family', 'sans-serif')
    .attr("stroke-width", .3)
    .style("text-anchor", "middle")
    .text(function(d) { return html2utf(d[3])+' - '+d[6]; })
    .attr('title', function(d) {  return d[2]; })
    .attr('alt', function(d) { return d[2]; })
    //.on("click", function(d) { document.location.href="/boxplot" })
    ; 
  // Attributes for all other text.
  d3.selectAll('text')
    .attr('fill', textco)
    .style('font-size', '11px')
    .attr("stroke-width", .3)
    .style('font-family', 'sans-serif')
    .style('text-shadow', 'none');
}


function html2utf(htmlstring){
 return htmlstring.replace("&ge;", "\u2265"); 
}
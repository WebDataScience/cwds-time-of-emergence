<?php
    # Template for basic page displaying boxplots
    $path = drupal_get_path('module', 'toeboxplot');
    
    drupal_add_js($path . '/js/canvg.js');
    drupal_add_js($path . '/js/rgbcolor.js');
    drupal_add_js($path . '/js/StackBlur.js');
    drupal_add_js($path . '/js/boxplots.js');
    drupal_add_css($path . '/cs/boxplot.css');
    
    drupal_set_title("Boxplot");
    
  ?>

<input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />
<div id="main-chart-area">

  <h1 id="top-y-title"></h1>
  
  <h1 id="top-x-title"></h1>

  <div id="boxplot-key">
  <div id="key-table">
  	  <div>&nbsp;</div>
	  <div id="key-table-text">Rate of Climate Change</div>
  </div>
    <div id="lowerbound-key">
            <div id="lowerbound-key-swatch"></div>
            <div id="lowerbound-key-text">Faster</div>
    </div>
    <div id="central-key">
            <div id="central-key-swatch"></div>
            <div id="central-key-text">Central</div>
    </div>
    <div id="upperbound-key">
            <div id="upperbound-key-swatch"></div>
            <div id="upperbound-key-text">Slower</div>
    </div>
  </div>
  
    <div id="chart-area-1">
    </div>
    
    <div id="chart-area-2">
    </div>
    
    <div id="chart-area-3">
    </div>
    
    <div id="chart-area-4">
  </div>
  
</div>

<div>
  <!--<canvas id="svg-canvas" width="800" height="800"></canvas>
  <a id="svg-img-wrapper" href="" download="boxplot.png">
    <input id="print-button" name="op" value="Export Boxplot Image" class="form-submit" type="submit">
    <img id="svg-img"></img>
  </a> -->
  <a id="downloadtextanchor" href="/boxplotdata/text" download="boxplotdata.csv">
    <input id="print-text-button" name="op" value="Export Boxplot Data" class="form-submit" type="submit">
  </a>  
</div>
<script>
jQuery( document ).ready(function( $ ) {
    

  $('#print-button').click(function(){
    // Find existing svg content.
    var $container = $('#chart-area-1');
    var content = $container.html().trim();
    // Prep and draw to canvas with canfg() function.
    var canvas = document.getElementById('svg-canvas');
    var context = canvas.getContext("2d"); // returns the 2d context object
    context.fillStyle= "#ffffff";
    context.fillRect(0,0,800,800); // sets top left location points x,y and then width and height
    canvg(canvas, content, { ignoreDimensions: true  });
    // Pull canvas content as .png data.
    var theImage = canvas.toDataURL('image/png');
    // Populate some html elements with the image content.
    $('#svg-img').attr('src', theImage);
    $('#svg-img-wrapper').attr('href', theImage);
  });
    
    
  var variableid = location.pathname.match(/.*\/(V.*)/)[1];
  $("#downloadtextanchor").prop("href","/boxplotdata/" + variableid + "/text");
  var url =  location.protocol + "//" + location.host + "/boxplotdata/"  + variableid;
  $.post( url, function( jsonobj ) {  
    
    var charttitle = "Time of Emergence for " + jsonobj.variablename ;
    charttitle += "<br/>Multi-Model Projections (21 global climate models)";
    charttitle = charttitle + "<br/>Region: " + jsonobj.regionname ;
    charttitle += "<br/>Climate Data: " + jsonobj.dataname;    
    $("#top-x-title").html(charttitle);
    
    drawBoxplot("chart-area-1", "High Emissions (RCP 8.5)", parse4data(jsonobj.emergencethreshold95.emissionscenariorcp85),"Low (to extreme 10% of 1950-1999 conditions)");
    drawBoxplot("chart-area-2", "Low Emissions (RCP 4.5)", parse4data(jsonobj.emergencethreshold95.emissionscenariorcp45),"");
    drawBoxplot("chart-area-3", "High Emissions (RCP 8.5)",parse4data(jsonobj.emergencethreshold80.emissionscenariorcp85),"High (to extreme 40% of 1950-1999 conditions)");
    drawBoxplot("chart-area-4", "Low Emissions (RCP 4.5)", parse4data(jsonobj.emergencethreshold80.emissionscenariorcp45),"");    
  });
  

  function drawBoxplot(containingElementID, ytitle, data, xtitle) {
        var labels = false; 
        var module_path = document.getElementById('module_path').value;

        var margin = {top: 30, right: 50, bottom: 70, left: 50};
        var width = 400 - margin.left - margin.right;
        var height = 400 - margin.top - margin.bottom;

          var rowMax = 2100;
          var min = 2000;
          var rowMin = 2000;
          var max = 2100;
                       
          var chart = d3.box()
            .height(height) 
            .domain([min, max])
            .showLabels(labels);
            
          //var svg = d3.select("body").append("svg")
          var svg = d3.select("#" + containingElementID).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .attr("class", "box")  
            .attr("width", "700")
            .attr("height", "200")
            .attr("transform", "translate(" + (margin.left - 30) + "," + margin.top + ")");
    
          //x-axis
          var x = d3.scale.ordinal()     
            .domain( data.map(function(d) { console.log(d); return d[0] } ) )     
            .rangeRoundBands([0 , width], 0.7, 0.3);    

          var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

          //y-axis
          var y = d3.scale.linear()
            .domain([2000, 2100])
            .range([height + margin.top, 0 + margin.top]);
          
          var yAxis = d3.svg.axis()
            .scale(y)
            .orient("right")
            .ticks(4);

          //draw boxplots  
          svg.selectAll(".box")    
            .data(data)
            .enter().append("g")
            .attr("transform", function(d) { return "translate(" +  x(d[0])  + "," + margin.top + ")"; } )
            .call(chart.width(x.rangeBand()));

            

            
          // add a title
          svg.append("text")
            //.attr("y", (width / 2))             
            //.attr("x", 0 + (margin.top / 2))
            .attr("y", -20)             
            .attr("x", (0 - width))
            .attr("text-anchor", "start")  
            .attr("transform", "rotate(-90)")
            .style("font-size", "18px")  
            .text(ytitle); 
         
           //draw y axis
          svg.append("g")
                .attr("class", "y axis")
                .attr("transform", "translate(" + width + ", 0)")
                .call(yAxis)
            .append("text") 
              .attr("y", 6)
              .attr("dy", ".71em")
              .style("text-anchor", "middle")
              .style("font-size", "16px");

          //text label for x axis
          svg.append("text")      
            .attr("x", -150 )
            .attr("y", -380 )
            .style("text-anchor", "middle")
            .style("font-size", "18px")
            .text(xtitle)
            .attr("transform", function(d) {
              return "rotate(180)" 
            });;
            
            
          //draw x axis  
          svg.append("g")
              .attr("class", "x axis")
              //.attr("transform", "translate(0," + (height  + margin.top + 10) + ") scale(1, -1)")
              .append("text") 
              .attr("transform", "translate(0," + (height  + margin.top) + ")")
              .call(xAxis); 
                     
      
    }  // end drawboxplot
    
    
    function parse4data(obj){
      var data = [];
          data[0] = [];
          data[0][0] = "Faster";
          data[0][1] = [];
          data[0][2] = [];
          $.each(obj.signalconfidence95.dots, function(i, obj) {
            data[0][1].push(obj);
          });
          $.each(obj.signalconfidence95.box, function(i, obj) {
            data[0][2].push(Math.min(obj,2100));
          });
          data[1] = [];
          data[1][0] = "Central";
          data[1][1] = [];
          data[1][2] = [];
          $.each(obj.signalconfidence50.dots, function(i, obj) {
            data[1][1].push(obj);
          });
          $.each(obj.signalconfidence50.box, function(i, obj) {
            data[1][2].push(Math.min(obj,2100));
          });
          data[2] = [];
          data[2][0] = "Slower";
          data[2][1] = [];
          data[2][2] = [];
          $.each(obj.signalconfidence5.dots, function(i, obj) {
            data[2][1].push(obj);
          });
          $.each(obj.signalconfidence5.box, function(i, obj) {
            data[2][2].push(Math.min(obj,2100));
          });
  
    return data;
  }  // end parse4data()    
    
}); //end jquery
</script>


<style>
      *, body, svg, h2 {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: black;
        font-weight: normal;
	overflow: visible;
      }
      body {
       padding: 100px;
      
      }
      #top-x-title, #top-y-title {
	font-size: 22px;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
      h2 {
        padding: 0;
        margin: 0;
      }

      #top-x-title {
	padding-top: 25px;
        text-align: center;
        color: black;
      }
      #top-y-title {
        color: black;
        position: absolute;
        top: 600px;
        left: 60px;
        z-index: 1000;
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
      }
	#boxplot-key {
float: left;
width: 100%;
clear: both;
margin-left: 50px;
margin-right: auto;
margin-top: 30px;
margin-bottom: 30px;
}

#lowerbound-key, #central-key, #upperbound-key {
float: left;
margin-right: 30px;
}
#lowerbound-key-swatch {
height: 15px;
width: 15px;
border: 1px solid black;
background-color: #a92a55;
float: left;
margin: 10px;
}
#central-key-swatch {
  height: 15px;
  width: 15px;
  border: 1px solid black;
  background-color: #01939a;
  float: left;
  margin: 10px;
}
#upperbound-key-swatch {
  height: 15px;
  width: 15px;
  border: 1px solid black;
  background-color: #ff6400;
  float: left;
  margin: 10px;
}
#main-chart-area {
  background-color: white;
  width: 1000px;
  height: 1125px;
  padding-left: 50px;
}
#chart-area-1, #chart-area-3 {
	margin-left: 50px;
}
      #chart-area-1, #chart-area-2, #chart-area-3, #chart-area-4 {
        background-color: white;
        float: left;
        width: 420px;
        height: 400px;
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
      }

	#chart-area-1, #chart-area-2 {
		margin-top:25px;
	}

	#chart-area-3 svg.box>text:first-of-type, #chart-area-4 svg.box>text:first-of-type {
display: none;
	}

      .box {
        font: 10px sans-serif;
      }

      svg.box{
      }
      
      .box line,
      .box rect,
      .box circle {
        //fill: steelblue;
        stroke: #000;
        stroke-width: 1px;
      }

.box g:nth-child(1) line.median {     
stroke: #d45d85;
stroke-width: 2px;
}

.box g:nth-child(2) line.median {     
stroke: #5dc8cd;
stroke-width: 2px;
}

.box g:nth-child(3) line.median { 
stroke: #ff8b40;
stroke-width: 2px;
}

.box g:nth-child(3) rect {
        //fill:#ff6400;
        }
.box g:nth-child(3) circle {
//fill:#ffb100;
}

	.box g:nth-child(1) rect {
	//fill:#a92a55; 
	}
.box g:nth-child(1) circle {
//fill: #4212af;
}

.box g:nth-child(2) rect {
        //fill:#01939a;
        }
.box g:nth-child(2) circle {
//fill: #5ccccc;
}
      .box .center {
        stroke-dasharray: 3,3;
      }
      .box .outlier {
        fill: #4682B4;
        stroke: #000;
        r: 2;
      }
      .axis {
        font: 12px sans-serif;
      }      
      .axis path,
      .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
      }
       
      .x.axis path { 
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
      }

      #boxplot-chart-header {
        position: absolute;
        top: 395px;
        left: 275px;
        font-size: 18px;
        font-weight: normal;
        color: black;
      }

      svg, g, rect, line, circle, text {
        transform-origin: -10px -5px -5px;
      }

	/*show or hide y axis labels and ticks*/
      .x g.tick, .x g text, .x g line {
        display: none;
      }

      .x g.tick text {
        display: none;
        -webkit-transform: rotate(-90deg);
      -moz-transform: rotate(-90deg);
      -ms-transform: rotate(-90deg);
      -o-transform: rotate(-90deg);
      filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
      }
      
  </style>



<?php
  # Template for basic page displaying boxplots
  $path = drupal_get_path('module', 'toeboxplot');

?>

<!DOCTYPE html>
<meta charset="utf-8">

<head>
  <?php
    //drupal_add_js($path . '/d3/d3.js');
    drupal_add_js($path . '/js/boxplots.js');
    drupal_add_css($path . '/cs/boxplot.css');
  ?>
</head>

<body>
<input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />
<div id="main-chart-area">
  <h1 id="top-y-title">Baseline "Noise" Range</h1>
  <h1 id="top-x-title"></h1>

  <div id="chart-area-1">
  </div>

  <div id="chart-area-2">
  </div>

  <div id="chart-area-3">
  </div>

  <div id="chart-area-4">
  </div>
</div>

<script>
jQuery( document ).ready(function( $ ) {
    
 
  var url =  location.protocol + "//" + location.host + "/boxplotdata/"  + location.pathname.match(/.*\/(V.*)/)[1];
  $.post( url, function( jsonobj ) {  
    
    $("#top-x-title").html( jsonobj.variablename );
    
    drawBoxplot("chart-area-1", "High Emissions (RCP 8.5)", parse4data(jsonobj.emergencethreshold95.emissionscenariorcp85));
    drawBoxplot("chart-area-2", "Low Emissions (RCP 4.5)", parse4data(jsonobj.emergencethreshold95.emissionscenariorcp45));
    drawBoxplot("chart-area-3", "High Emissions (RCP 8.5)",parse4data(jsonobj.emergencethreshold80.emissionscenariorcp85));
    drawBoxplot("chart-area-4", "Low Emissions (RCP 4.5)", parse4data(jsonobj.emergencethreshold80.emissionscenariorcp45));
  });
  

  function drawBoxplot(containingElementID, ytitle, data) {
        var labels = false; 
        var module_path = document.getElementById('module_path').value;

        var margin = {top: 30, right: 50, bottom: 70, left: 50};
        var width = 500 - margin.left - margin.right;
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
            .attr("height", "600")
            //.attr("transform", "translate(475, 700) rotate(-90, -90, -90) scale(1, -1)")
            //.attr("transform", "translate(" + chartx + ", " + charty + ") rotate(-90, -90, -90) scale(1, -1)")
          //  .attr("transform", "translate(" + chartx + ", " + charty + ")")
            //.attr("transform-origin", "-10px -5px -5px")
          //  .append("g")
              .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
              //.attr("transform-origin", "-10px -5px -5px");
          
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
            .attr("y", 0)             
            .attr("x", (width / -1.4))
            .attr("text-anchor", "start")  
            .attr("transform", "rotate(-90)")
            .style("font-size", "18px") 
            //.style("text-decoration", "underline")  
            .text(ytitle); 
         
           //draw y axis
          svg.append("g")
                .attr("class", "y axis")
                //.attr("transform", "scale(1, -1) translate(0, -365.5)")
                .attr("transform", "translate(" + width + ", 0)")
                .call(yAxis)
            .append("text") 
              //.attr("transform", "rotate(-90)") ////////////////////
              .attr("y", 6)
              .attr("dy", ".71em")
              .style("text-anchor", "middle")
              .style("font-size", "16px");
              //.text("Year");
          
          //draw x axis  
          svg.append("g")
              .attr("class", "x axis")
              //.attr("transform", "translate(0," + (height  + margin.top + 10) + ") scale(1, -1)")
              .attr("transform", "translate(0," + (height  + margin.top) + ")")
              .call(xAxis); 
              
         /* vg.append("g")
            .append("text") // text label for the x axis
            .attr("x", (width / 2))
            .attr("y",  10 )
            .attr("dy", ".71em")
            .style("text-anchor", "start")
            .style("font-size", "16px")
            .call(xAxis);  */  
            
      
    }  // end drawboxplot
    
    
    function parse4data(obj){
      var data = [];
          data[0] = [];
          data[0][0] = "Lower bound (earlier ToE)";
          data[0][1] = [];
          data[0][2] = [];
          $.each(obj.signalconfidence95.dots, function(i, obj) {
            data[0][1].push(obj);
          });
          $.each(obj.signalconfidence95.box, function(i, obj) {
            data[0][2].push(Math.min(obj,2100));
          });
          data[1] = [];
          data[1][0] = "Central tendency";
          data[1][1] = [];
          data[1][2] = [];
          $.each(obj.signalconfidence50.dots, function(i, obj) {
            data[1][1].push(obj);
          });
          $.each(obj.signalconfidence50.box, function(i, obj) {
            data[1][2].push(Math.min(obj,2100));
          });
          data[2] = [];
          data[2][0] = "Upper bound (later ToE)";
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

      body, svg, h2 {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: black;
        font-weight: normal;
      }
      body {
       padding: 100px;
      
      }

      h2 {
        padding: 0;
        margin: 0;
      }

      #top-x-title {
        text-align: center;
        color: black;
      }
      #top-y-title {
        color: black;
        position: absolute;
        top: 600px;
        left: 160px;
        z-index: 1000;
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
      }

      #main-chart-area {
        background-color: white;
        width: 1000px;
        height: 1100px;
        padding-left: 50px;
      }

      #chart-area-1, #chart-area-2, #chart-area-3, #chart-area-4 {
        background-color: white;
        float: left;
        width: 500px;
        height: 500px;
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
      }

      .box {
        font: 10px sans-serif;
      }

      svg.box{
      }
      
      .box line,
      .box rect,
      .box circle {
        fill: steelblue;
        stroke: #000;
        stroke-width: 1px;
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

      .x g.tick {
      //  display: none;
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

  </body>
</html>

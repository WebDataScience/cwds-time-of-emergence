<?php
  # Template for basic page displaying boxplots
  $path = drupal_get_path('module', 'toeboxplot');

?>

<!DOCTYPE html>
<meta charset="utf-8">

<head>
  <!--<script src="d3/d3.js"></script>-->
  <?php
    drupal_add_js($path . '/d3/d3.js');
  ?>
</head>

<body>
<input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />
<div id="main-chart-area">
  <div id="chart-area-1">
     <!-- <div id="boxplot-chart-header">High Emissions (RCP 8.5)</div>  -->
      <!--x/y axis category labels-->
    <!--  <div class="ylabel" id="lowerbound">Lower bound<br />(earlier ToE)</div>
      <div class="ylabel" id="centraltendency">Central tendency</div>
      <div class="ylabel" id="upperbound">Upper bound<br />(later ToE)</div> -->
  </div>

  <div id="chart-area-2">
     <!-- <div id="boxplot-chart-header">High Emissions (RCP 8.5)</div>  -->
      <!--x/y axis category labels-->
    <!--  <div class="ylabel" id="lowerbound">Lower bound<br />(earlier ToE)</div>
      <div class="ylabel" id="centraltendency">Central tendency</div>
      <div class="ylabel" id="upperbound">Upper bound<br />(later ToE)</div> -->
  </div>

  <div id="chart-area-3">
     <!-- <div id="boxplot-chart-header">High Emissions (RCP 8.5)</div>  -->
      <!--x/y axis category labels-->
    <!--  <div class="ylabel" id="lowerbound">Lower bound<br />(earlier ToE)</div>
      <div class="ylabel" id="centraltendency">Central tendency</div>
      <div class="ylabel" id="upperbound">Upper bound<br />(later ToE)</div> -->
  </div>

  <div id="chart-area-4">
     <!-- <div id="boxplot-chart-header">High Emissions (RCP 8.5)</div>  -->
      <!--x/y axis category labels-->
    <!--  <div class="ylabel" id="lowerbound">Lower bound<br />(earlier ToE)</div>
      <div class="ylabel" id="centraltendency">Central tendency</div>
      <div class="ylabel" id="upperbound">Upper bound<br />(later ToE)</div> -->
  </div>
</div>

  <!--<script src="js/boxplot.js"></script>-->
  <?php
    drupal_add_js($path . '/js/boxplot.js');
  ?>

    <script>
   drawBoxplot("chart-area-1", 700, 475);
   drawBoxplot("chart-area-2", 700, 475);
   drawBoxplot("chart-area-3", 700, 475);
   drawBoxplot("chart-area-4", 700, 475);

    function drawBoxplot(containingElementID, charty, chartx) {
        var labels = true; 
        var module_path = document.getElementById('module_path').value;

        var margin = {top: 30, right: 50, bottom: 70, left: 50};
        var width = 500 - margin.left - margin.right;
        var height = 400 - margin.top - margin.bottom;

        var min = Infinity,
            max = -Infinity;
          
        d3.csv(module_path + "/csv/test.csv", function(error, csv) {

          var data = [];
          data[0] = [];
          data[1] = [];
          data[2] = [];
          //num rows should match num cols in a csv

          data[0][0] = "Lower bound (earlier ToE)";
          data[1][0] = "Central tendency";
          data[2][0] = "Upper bound (later ToE)"; 
          //num rows should match num cols in a csv

          data[0][1] = [];
          data[1][1] = [];
          data[2][1] = [];
          
          csv.forEach(function(x) {
            var v1 = Math.floor(x.Q1),
              v2 = Math.floor(x.Q2),
              v3 = Math.floor(x.Q3);
              //num variables should match num cols in a csv
              
            var rowMax = Math.max(v1, Math.max(v2, v3));
            var rowMin = Math.min(v1, Math.min(v2, v3));


            data[0][1].push(v1);
            data[1][1].push(v2);
            data[2][1].push(v3);
             
            if (rowMax > max) max = rowMax;
            if (rowMin < min) min = rowMin; 
          });
          
          var chart = d3.box()
            .whiskers(iqr(1.5))
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
            .attr("transform", "translate(" + chartx + ", " + charty + ") rotate(-90, -90, -90) scale(1, -1)")
            .attr("transform-origin", "-10px -5px -5px")
            .append("g")
              .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
              .attr("transform-origin", "-10px -5px -5px");
          
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
            .orient("left")
            .ticks(5);


          //draw boxplots  
          svg.selectAll(".box")    
              .data(data)
            .enter().append("g")
            .attr("transform", function(d) { return "translate(" +  x(d[0])  + "," + margin.top + ")"; } )
              .call(chart.width(x.rangeBand()));

         
           //draw y axis
          svg.append("g")
                .attr("class", "y axis")
                .attr("transform", "scale(1, -1) translate(0, -365.5)")
                .call(yAxis)
            .append("text") 
              .attr("transform", "rotate(-90)")
              .attr("y", 6)
              .attr("dy", ".71em")
              .style("text-anchor", "end")
              .style("font-size", "16px");
          
          //draw x axis  
          svg.append("g")
              .attr("class", "x axis")
              .attr("transform", "translate(0," + (height  + margin.top + 10) + ") scale(1, -1)")
              .call(xAxis)
            .append("text") // text label for the x axis
                .attr("x", (width / 2))
                .attr("y",  10 )
            .attr("dy", ".71em")
                .style("text-anchor", "start")
            .style("font-size", "16px"); 
        });

        // Returns function to compute the interquartile range.
        function iqr(k) {
          return function(d, i) {
            var q1 = d.quartiles[0],
                q3 = d.quartiles[2],
                iqr = (q3 - q1) * k,
                i = -1,
                j = d.length;
            while (d[++i] < q1 - iqr);
            while (d[--j] > q3 + iqr);
            return [i, j];
          };
        }
    }
  </script>


  <style>

      body, svg {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      }

      #main-chart-area {
        background-color: white;
        width: 100%;
        height: 100%;

      }

      #chart-area-1, #chart-area-2, #chart-area-3, #chart-area-4 {
        background-color: white;
        width: 445px;
        height: 100%;
      }

       #chart-area-2 {
          position: absolute;
          top: 206px;
          left: 540px;

       }

        #chart-area-3 {
          position: absolute;
          top: 706px;
          left: 103px;

       }

       #chart-area-4 {
          position: absolute;
          top: 706px;
          left: 540px;
          width: 503px;
       }


      .box {
        font: 10px sans-serif;
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

      text {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
      }

      svg, g, rect, line, circle, text {
        transform-origin: -10px -5px -5px;
      }

      .x g.tick {
        display: none;
      }

      .x g.tick text {
        display: block;
      }

      .ylabel {
        position: absolute;
        font-size: 14px;
        color: black;
      }

      #lowerbound {
          top: 470px;
        left: 90px;
      } 

      #centraltendency {
       top: 615px;
        left: 70px;
      } 

      #upperbound {
       top: 745px;
        left: 95px;
      }
      
  </style>

  </body>
</html>

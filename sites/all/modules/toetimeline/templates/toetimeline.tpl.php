<?php
	# Template for basic page displaying timeline.
	$path = drupal_get_path('module', 'toetimeline');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<script src="http://d3js.org/d3.v2.min.js?2.9.3"></script>-->
  <?php
  	drupal_add_css($path . '/css/timeline.css');
    drupal_add_js($path . '/js/d3.v2.js');
  ?>

</head>

<body>
<h4>Multi-Model Median Time of Emergence for King County under {RCP8.5} </h4>
    <div class='content'>
          <!-- chart -->
    </div>
    <input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />
    <script>
    	//test data
		var data = [[2000,0,"tooltip1","label1"], [2020,0,"tooltip2","label2"], [2085,0,"tooltip3","label3"], [2040,0,"tooltip4","label4"]];
		   
		var margin = {top: 20, right: 15, bottom: 60, left: 60}
		  , width = 960 - margin.left - margin.right
		  , height = 100 - margin.top - margin.bottom;

		var x = d3.scale.linear()
		          .domain([2000, 2100])
		          .range([ 0, width ]);

		var y = d3.scale.linear()
		        .domain([0, d3.max(data, function(d) { return d[1]; })])
		        .range([ height, 0 ]);

		var chart = d3.select('body')
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
		.orient('bottom');

		main.append('g')
		.attr('transform', 'translate(0,' + height + ')')
		.attr('class', 'main axis date')
		.call(xAxis);

		var g = main.append("svg:g"); 

		var node = g.selectAll("g")
                .data(data)
                .enter()
                .append("g");

		node.append("line")
		  .attr("class", "scatter-point")
		  //.attr("cx", function (d,i) { return x(d[0]); } )
		  //.attr("cy", function (d) { return y(d[1]); } )
		  //.attr("r", 8)
		  	.attr("class", "tick")
		  .attr("x1", function (d,i) { return 1 + x(d[0]); } )
			.attr("y1", -5)
			.attr("x2", function (d,i) { return 1 + x(d[0]); } )
			.attr("y2", 20)
			.attr("stroke-width", 1)
			.style("shape-rendering", "crispEdges")
			.attr("stroke", "black");

		node.append("line:text")
		  .attr("class", "point-label")
		  .attr("x", function (d,i) { return x(d[0]); } )
		  .attr("y", function (d) { return y(d[1]); } )
		  .attr("dy", -32)
		  .style("text-anchor", "middle")
		  .text(function(d) { return d[3]; })
		  .attr('title', function(d) { return d[2]; }); 

    </script>

    <style>
		.main text {
		    font: 10px sans-serif;	
		}
		.axis line, .axis path, line.scatter-point {
		    shape-rendering: crispEdges;
		    stroke: black;
		    fill: none;
		}
		h4 {
			text-align: center;
		}
		#main {
			background-color: #edeef1;
		}
  </style>
      	
  </body>
</html>
<?php
	# Template for basic page displaying timeline.
	$path = drupal_get_path('module', 'toetimeline');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://d3js.org/d3.v2.min.js?2.9.3"></script>
  <?php
    drupal_add_js($path . '/js/d3.parcoords.js');
    drupal_add_js($path . '/js/d3.v2.js');
  ?>

  <style>
	.main text {
	    font: 10px sans-serif;	
	}
	.axis line, .axis path {
	    shape-rendering: crispEdges;
	    stroke: black;
	    fill: none;
	}
	circle {
	    fill: steelblue;
	}
  </style>

</head>

<body>
    <div class='content'>
          <!-- chart -->
    </div>
    <input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />
    <script>
    	//test data
		var data = [[2000,0,"string1"], [2020,0,"string2"], [2085,0,"string3"], [2040,0,"string4"]];
		   
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

		g.selectAll("scatter-dots")
		  .data(data)
		  .enter().append("svg:circle")
		      .attr("cx", function (d,i) { return x(d[0]); } )
		      .attr("cy", function (d) { return y(d[1]); } )
		      .attr("r", 8)
		      .attr('class', 'scatter-point')
		      .attr('title', function(d) { return d[2]; });
		      /*.append("circle:a")
		        .attr("class", "tooltips")
		        .attr("href", "#")
		        .text(function(d) { return d[0]; })
		        .append("a:span")
		          .text(function(d) { return d[0]; });*/

    </script>
  </body>
</html>
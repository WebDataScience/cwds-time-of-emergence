<?php
# Template for basic page displaying choropleth map.
$path = drupal_get_path('module', 'toechoropleth');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://d3js.org/d3.v2.min.js?2.9.3"></script>
  <?php
    drupal_add_css($path . '/css/button.css');
    drupal_add_css($path . '/css/choropleth.css');
    drupal_add_css($path . '/css/chart.css');
    drupal_add_css($path . '/css/colorbrewer.css');
    drupal_add_js($path . '/js/d3.parcoords.js');
    drupal_add_js($path . '/js/d3.v2.js');
  ?>

</head>

<body>
    <div id="map" <!--style="width: 900px; height: 500px"--></div>
    <div id='chart'>
    </div>
    <input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />

    <script>
        var data; // loaded asynchronously
        var counties_features;
        var counties_data;
        var width = 515,
            height = 340;
        var module_path = document.getElementById('module_path').value;

        // The radius scale for the centroids.
        var r = d3.scale.sqrt()
            .domain([0, 1e6])
            .range([0, 10]);

        var projection = d3.geo.albersUsa()
            .scale([5500])
            .translate([1710,1280]);

        var path = d3.geo.path()
                    .projection(projection);

        var title = d3.select("#chart").append("div");
//          .attr("style", "text-align:center");

        var svg = d3.select("#chart")
          .append("svg")
          .attr("width", width)
          .attr("height", height)
          .style("margin", "0 auto");

        var counties = svg.append("g")
            .attr("id", "counties")
            .attr("class", "Bl_custom")
            .attr("transform", "rotate(-14 100 100)");
            
        var county_labels = svg.append("g")
            .attr("id", "county_labels")
            .attr("transform", "rotate(-14 100 100)");

        // Get county data
        d3.json(module_path + "/json/us-counties.json", function(json) {
          var centroids = new Array();
          counties_features = json.features;
          counties.selectAll("path")
              .data(json.features)
            .enter().append("path")
              .attr("class", data ? quantize : null)
              .attr("d", function(d, i) {centroids[i] = path.centroid(d); return path(d);});
              
          county_labels.selectAll("text")
              .data(json.features)
            .enter().append("text")
              .attr("transform", function(d, i) { var pos_x = centroids[i][0] - 10; var pos_y = centroids[i][1]; return "translate(" + pos_x + "," + pos_y + ")rotate(14)"; });
        });
        
        setTimeout(function (){ /* Helps ensure that JSON data loads; otherwise frequently fails */

          d3.json(module_path + "/json/counties-autism-outreach-sample.json", function(json) {
            // Choropleth
            data = json['#choropleth'];
            title.html("<h1>" + json['#title'] + "</h1>");
            counties_data = json['#choropleth'];
            counties.selectAll("path")
                .attr("class", quantize)
                .append("title")
                .text(function(d) {
                  if(json['#counties_list'][d.id] != undefined)
                    return json['#counties_list'][d.id] + ' County';
                });
            
            // Update percent labels
            county_labels.selectAll('text')
                .text(function(d, i) {
                  if(json['#percents'][d.id] > 0) { if(i != 136) return json['#counties_list'][d.id] + ' County'; } else return '';})
                .on("click", function(d) { 
                  //alert(json['#counties_list'][d.id] + ' County'); 
                  //$("#edit-submitted-region-1").prop("checked", true);
                  if(json['#counties_list'][d.id] == "King"){document.getElementById('edit-submitted-region-1').checked = true;}
                  else{document.getElementById('edit-submitted-region-2').checked = true;}
                })
                  .append("title")
                    .text(function(d, i) {
                            if(json['#counties_list'][d.id] != null) {
                              return json['#counties_list'][d.id] + ' County';
                            }
                            else
                              return '';
                          });
          });
        }, 50);

        function changeChoropleth(checked) {
          counties.selectAll("path")
              .data(counties_features)
              .attr("class", function(d) {
                if(checked)
                  return quantize(d);
                else {
                  // Null answers are out of state, and should be q0 (white),
                  // Otherwise return the lightest color of the spectrum
                  if(data[d.id] != null)
                    return 'q4';
                  else
                    return 'q0';
                }
              });
          county_labels.selectAll("text")
              .data(counties_features)
              .attr("class", function(d) {
              //  if(checked)
                  return '';
              //  else
              //    return 'hidden';
              });
        }

        function quantize(d) {
         if(data[d.id] == null) 
           return "q0";
         else
           // return "q" + data[d.id];

           return "q3";
        }

        function PrintElem(elem)
        {
          Popup(document.getElementById(elem).innerHTML);
        }
            
        function Popup(data) 
        {
          var style = "#chart { font: 10px sans-serif; }\n .axis { shape-rendering: crispEdges; }\n .axis path, .axis line { fill: none; stroke: #000;}\n";
          var mywindow = window.open('', '', 'height=400,width=600');
          mywindow.document.write('<html><head><title></title><style type="text/css">');
          mywindow.document.write('</style></head><body><center><div id="chart">');
          mywindow.document.write(data);
          mywindow.document.write('</div></center></body></html>');
          mywindow.document.close();
          mywindow.print();
          return true;
        }

      </script>
  </body>
</html>

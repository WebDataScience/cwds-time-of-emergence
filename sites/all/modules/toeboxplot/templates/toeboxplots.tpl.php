<?php
  /* Template for basic page displaying boxplots */
  $path = drupal_get_path('module', 'toeboxplot');
  drupal_add_js($path . '/js/canvg.js');
  drupal_add_js($path . '/js/rgbcolor.js');
  drupal_add_js($path . '/js/boxplots.js');
  drupal_add_css($path . '/cs/boxplot.css');
  drupal_set_title("All Results");
  $comparearray = isset($_SESSION['compare'])?$_SESSION['compare']:array();
  $variableid = $comparearray['variableid']
?>

<?php
  print($fourpanelintro);
?>
  
<input id="module_path" type="hidden" value="<?php echo base_path() . $path ?>" />
<div id="main-chart-area">
  <h1 id="top-y-title"></h1>
  <h1 id="top-x-title">
    Time of Emergence for <span id="variablename">N/A</span><br/>
    <span id="unbold" class="unbold">
      Location: <span id="location">N/A</span><br/>
      Climate dataset: <span id="dataset">N/A</span>
    </span>
  </h1>
  
  <div id="boxplot-key">
    <div class="legend">
      <div class="legend-left">
        <div id="key-table-text">Rate of Climate Change</div>
        <div id="lowerbound-key">
          <span class="key-text"><span class="swatch" id="lowerbound-key-swatch"></span>Fast</span>
        </div>      
        <div id="central-key">
          <span class="key-text"><span class="swatch" id="central-key-swatch"></span>Moderate</span>
        </div>
        <div id="upperbound-key">
          <span class="key-text"><span class="swatch" id="upperbound-key-swatch"></span>Slow</span>
        </div>
      </div>
      <div class="legend-right">
        <div class="symbol-title">Time of Emergence</div>
        <div class="symbol"><span class="smallsymbol">O</span> Model, emergence in the negative (decreasing) direction</div>
        <div class="symbol"><span class="largesymbol">O</span> Ensemble median, emergence in the negative (decreasing) direction</div>
        <div class="symbol"><span class="smallsymbolplus">+</span> Model, emergence in the positive (increasing) direction</div>
        <div class="symbol"><span class="largesymbolplus">+</span> Ensemble median, emergence in the positive (increasing) direction</div>
      </div>
    </div>
      
  </div>
  
  <div id="top-loading"></div>
  
  <div id="chart-area-3">
  </div>
  <div id="chart-area-4">
  </div>
  <div id="chart-area-1">
  </div>
  <div id="chart-area-2">
  </div>
    
</div>
<div>
  <a id="downloadtextanchor" href="<?php print($GLOBALS['base_url'] ); ?>/boxplotdata/<?php print($variableid); ?>/text" download="boxplotdata.csv">
    <input id="print-text-button" name="op" value="Export Boxplot Data" class="form-submit" type="submit">
  </a>  
</div>
<br/>

<script>
jQuery( document ).ready(function( $ ) {
  var baseurl = "<?php print($GLOBALS['base_url'] ); ?>";
  //Show the loading progress bar
  var loadingGif = $("#top-loading");
  // timelineChart.progressbar({value:400});
  loadingGif.html("<div style='padding:10px'><img src='/sites/all/modules/toewhiskers/images/ajax-loader.gif' alt='loading...' /></div>");
  
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
  var url = baseurl + "/boxplotdata/" + variableid;
  
  $.post( url, function( jsonobj ) {  
    $("#variablename").html(jsonobj.variablename);
    $("#location").html(jsonobj.regionname);
    $("#dataset").html(jsonobj.dataname);
    drawBoxplot("chart-area-3", "High Emissions (RCP 8.5 or A1B)",parse4data(jsonobj.emergencethreshold80.emissionscenariohigh),"Past Sensitivity High (to extreme 40% of 1950-1999 conditions)");
    drawBoxplot("chart-area-4", "Low Emissions (RCP 4.5 or B1)", parse4data(jsonobj.emergencethreshold80.emissionscenariolow),"");     
    drawBoxplot("chart-area-1", "High Emissions (RCP 8.5 or A1B)", parse4data(jsonobj.emergencethreshold95.emissionscenariohigh),"Past Sensitivity Low (to extreme 10% of 1950-1999 conditions)");
    drawBoxplot("chart-area-2", "Low Emissions (RCP 4.5 or B1)", parse4data(jsonobj.emergencethreshold95.emissionscenariolow),"");
    loadingGif.html("");
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
      //.attr("width", "700")
      .attr("width", "465")
      .attr("height", "430")
      .attr("transform", "translate(" + (margin.left - 10) + "," + margin.top + ")");
    
    //x-axis
    var x = d3.scale.ordinal()     
      .domain( data.map(function(d) { return d[0] } ) )     
      .rangeRoundBands([0 , width], 0.7, 0.3);    
    var xAxis = d3.svg.axis()
      .scale(x)
      .orient("bottom");

    //y-axis
    var y = d3.scale.linear().domain([2000, 2100]).range([height + margin.top, 0 + margin.top]);
    var yAxis = d3.svg.axis().scale(y).orient("right").ticks(4).tickFormat(d3.format("d"));
    // Count number of dots found for this boxplot. Then display 'No emergence prior to 2100' message if appropriate.
    var dotcount = data[0][3].length + data[0][4].length;
    if(dotcount > 0){
      //draw boxplots  
      svg.selectAll(".box")    
        .data(data)
        .enter().append("g")
        .attr("transform", function(d) { return "translate(" +  x(d[0])  + "," + margin.top + ")"; } )
        .call(chart.width(x.rangeBand()));
    } else {
      //Zero results text
      svg.append("text")
        .attr("y", 125)             
        .attr("x", (0 - width))
        .attr("text-anchor", "start")  
        .attr("transform", "rotate(-90)")
        .style("font-size", "18px")  
        .text("No emergence prior to 2100"); 
    }   
    // add a title
    svg.append("text")       
      .attr("y", 15)         
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
    //text label for x axis (Past sensitivity)
    svg.append("text")      
      .attr("x", -150 )
      .attr("y", -410 )
	    .attr("dx", "-2em")
	    .attr("dy", ".81em")
      .style("text-anchor", "middle")
      .style("font-size", "18px")
      .text(xtitle)
	    .call(wrap, 290)
      .attr("transform", function(d) {
        return "rotate(180)" 
      });                 
    //draw x axis  
    svg.append("g")
      .attr("class", "x axis")
      .append("text") 
      .attr("transform", "translate(0," + (height  + margin.top) + ")")
      .call(xAxis); 
                           
  }  // end drawboxplot
    
    
/**
 *http://bl.ocks.org/mbostock/7555321
 */
function wrap(text, width) {
  text.each(function() {
    var text = d3.select(this),
      words = text.text().split(/\s+/).reverse(),
      word,
      line = [],
      lineNumber = 0,
      lineHeight = 1.5, // ems
      y = text.attr("y"),
      dx = parseFloat(text.attr("dx")),
	  dy = parseFloat(text.attr("dy")),
      tspan = text.text(null)
	    .append("tspan")
	    .attr("x", -100)
	    .attr("y", y)
	    .attr("dx", dx + "em")
	    .attr("dy", dy + "em");
    while (word = words.pop()) {
      line.push(word);
      tspan.text(line.join(" "));
      if (tspan.node().getComputedTextLength() > width) {
        line.pop();
        tspan.text(line.join(" "));
        line = [word];
        tspan = text.append("tspan").attr("x", -100).attr("y", y)
		  .attr("dx", dx + "em")
		  .attr("dy", ++lineNumber * lineHeight + dy + "em")
		  .text(word);
      }
    }
  });
}
    
  function parse4data(obj){
    var data = [];
    data[0] = [];
    data[0][0] = "Faster";
    data[0][1] = [];
    data[0][2] = [];
    data[0][3] = [];
    if ("toema50" in obj.rateofchangefast){
      data[0][3] = [obj.rateofchangefast.toema50.toe,obj.rateofchangefast.toema50.dir];
    }
    data[0][4] = obj.rateofchangefast.toeandchangedir;
  
    data[1] = [];
    data[1][0] = "Central";
    data[1][1] = [];
    data[1][2] = [];
    data[1][3] = [];
    if ("toema50" in obj.rateofchangemoderate){
      data[1][3] = [obj.rateofchangemoderate.toema50.toe,obj.rateofchangemoderate.toema50.dir];
    }
    data[1][4] = obj.rateofchangemoderate.toeandchangedir;
        
    data[2] = [];
    data[2][0] = "Slower";
    data[2][1] = [];
    data[2][2] = [];
    data[2][3] = [];
    if ("toema50" in obj.rateofchangeslow){
      data[2][3] = [obj.rateofchangeslow.toema50.toe,obj.rateofchangeslow.toema50.dir];
    }
    data[2][4] = obj.rateofchangeslow.toeandchangedir;
        
    return data;
  }  // end parse4data()    
    
}); //end jquery
</script>
<style>
body, svg, h2 {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  color: black;
  font-weight: normal;
	overflow: visible;
}
body{
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
#boxplot-key{
  margin-left: auto;
  margin-right: auto;
  margin-top: 10px;
  margin-bottom: 50px;
  border: 1px solid black;
  width: 800px;  
}
div.legend{
  padding: 15px 15px 25px;
}
.key-text{
  margin-top: 8px;
}
#key-table, #upperbound-key, #central-key{
  margin-right: 30px;
  margin-top: 13px;
}
#lowerbound-key{
  margin-top: 3px;
}
#key-table-swatch{
  height: 15px;
  width: 15px;
  margin: 12px 10px 0;
}
.swatch{
  display:inline-block;
  height: 15px;
  width: 15px;
  margin: 10px 12px 0;
  border: 1px solid black;
}
#lowerbound-key-swatch{
  background-color: #a92a55;
}
#central-key-swatch {
  background-color: #01939a;
}
#upperbound-key-swatch {
  background-color: #ff6400;
}
.legend-left{
  float:left;
  margin-right: 40px;
}
.symbol-title{
  margin-bottom: 10px;
}
.symbol{
  height: 18px;
  margin-top: 8px;
}
.smallsymbol{
  font-size: 14px;
}
.largesymbol{
  vertical-align: middle;
  font-size: 22px;
}
.smallsymbolplus{
  font-size: 20px;
}
.largesymbolplus{
  vertical-align: middle;
  font-size: 30px;
}
#main-chart-area {
  background-color: white;
  width: 1000px;
  height: 1260px;
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
.box {
  font: 10px sans-serif;
}
svg.box{}
.box line,
.box rect,
.box circle {
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
.box .center {
  stroke-dasharray: 3,3;
}
.box .outlier {
  fill: #4682B4;
  stroke: #000;
  r: 2;
}
.box .toechangedir{
  fill: #4682B4;
  stroke: #000;
  font: 18px sans-serif;
}  
.box .toema50{
  fill: #4682B4;
  stroke: #000;
  font: 32px sans-serif;
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
#downloadtextanchor{
  margin:5px;
}
</style>

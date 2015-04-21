(function() {

d3.box = function() {
  var width = 1,
  height = 1,
  duration = 0,
  domain = null,
  value = Number,
  whiskers = boxWhiskers,
  quartiles = boxQuartiles,
  showLabels = false, // whether or not to show text labels
  numBars = 3,
  curBar = 1,
  tickFormat = null,
  displaybox = false;
  displaydots = false;

  // For each small multiple…
  function box(g) {
    g.each(function(data, i) {

      // data[1] is array of toe (the dots).
      var dots = data[1];
      // data[3] is array[toe,dir] for modelagreement50.
      var ma50 = data[3];
      // data[4] is array of objects with props toe,dir
      var toeandchangedir = data[4];
    
      var d = data[1].sort(d3.ascending);    
      var colors = ['#a92a55','#5ccccc','#ffb100'];
      var rectcolors = ['#a92a55','#01939a','#ff6400'];
    
      var g = d3.select(this),
          n = d.length,
          min = d[0],
          max = d[n - 1];

      // Compute quartiles. Must return exactly 3 elements.
      var quartileData = d.quartiles = quartiles(d);
      
      quartileData[0] = data[2][0];
      quartileData[1] = data[2][1];
      quartileData[2] = data[2][2];

      // Compute whiskers. Must return exactly 2 elements, or null.
      var whiskerIndices = null,//whiskers && whiskers.call(this, d, i),
          whiskerData = null;//whiskerIndices && whiskerIndices.map(function(i) { return d[i]; });

      // Compute outliers. If no whiskers are specified, all data are "outliers".
      // We compute the outliers as indices, so that we can join across transitions!
      var outlierIndices = whiskerIndices
          ? d3.range(0, whiskerIndices[0]).concat(d3.range(whiskerIndices[1] + 1, n))
          : d3.range(n);

      // Compute the new x-scale.
      var x1 = d3.scale.linear()
        .domain(domain && domain.call(this, d, i) || [min, max])
        .range([height, 0]);

      // Retrieve the old x-scale, if this is an update.
      var x0 = this.__chart__ || d3.scale.linear()
        .domain([0, Infinity])
        .range(x1.range());

      // Stash the new scale.
      this.__chart__ = x1;

      // Note: the box, median, and box tick elements are fixed in number,
      // so we only have to handle enter and update. In contrast, the outliers
      // and other elements are variable, so we need to exit them! Variable
      // elements also fade in and out.

      // Update center line: the vertical line spanning the whiskers.
      var center = g.selectAll("line.center")
        .data(whiskerData ? [whiskerData] : []);

      center.enter().insert("line", "rect")
        .attr("class", "center")
        .attr("x1", width / 2)
        .attr("y1", function(d) { return x0(d[0]); })
        .attr("x2", width / 2)
        .attr("y2", function(d) { return x0(d[1]); })
        .style("opacity", 1e-6);

      center.transition()
        .duration(duration)
        .style("opacity", 1)
        .attr("y1", function(d) { return x1(d[0]); })
        .attr("y2", function(d) { return x1(d[1]); });

      center.exit().transition()
        .duration(duration)
        .style("opacity", 1e-6)
        .attr("y1", function(d) { return x1(d[0]); })
        .attr("y2", function(d) { return x1(d[1]); })
        .remove();

      if(displaybox){
        // Update innerquartile box.
        var box = g.selectAll("rect.box")
          .data([quartileData]);
        box.enter().append("rect")
          .style("fill", rectcolors[i])
          .attr("class", "box")
          .attr("x", 0)
          .attr("y", function(d) { return x0(d[2]); })
          .attr("width", width)
          .attr("height", function(d) { return x0(d[0]) - x0(d[2]); })
          ;
        box.transition()
          .duration(duration)
          .attr("y", function(d) { return x1(d[2]); })
          .attr("height", function(d) { return x1(d[0]) - x1(d[2]); });
        // Update median line.
        var medianLine = g.selectAll("line.median")
          .data([quartileData[1]]);
        medianLine.enter().append("line")
          .attr("class", "median")
          .attr("x1", 0)
          .attr("y1", x0)
          .attr("x2", width)
          .attr("y2", x0)
          .transition()
          .duration(duration)
          .attr("y1", x1)
          .attr("y2", x1)
          ;
        medianLine.transition()
          .duration(duration)
          .attr("y1", x1)
          .attr("y2", x1);
      } //end if(displaybox)
      
      // Update whiskers.
      var whisker = g.selectAll("line.whisker")
        .data(whiskerData || []);

      whisker.enter().insert("line", "circle, text")
        .attr("class", "whisker")
        .attr("x1", 0)
        .attr("y1", x0)
        .attr("x2", 0 + width)
        .attr("y2", x0)
        .style("opacity", 1e-6)
        .transition()
        .duration(duration)
        .attr("y1", x1)
        .attr("y2", x1)
        .style("opacity", 1);

      whisker.transition()
        .duration(duration)
        .attr("y1", x1)
        .attr("y2", x1)
        .style("opacity", 1);

      whisker.exit().transition()
        .duration(duration)
        .attr("y1", x1)
        .attr("y2", x1)
        .style("opacity", 1e-6)
        .remove();
        
      // Insert one larger symbol for the TOE datapoint at modelagreement50.
      if(ma50[0] > 0 && ma50[0] <= 2100){
        var largesymbolsize = 20;
        if (ma50[1] > 0){ 
          // use 'rect's to draw a scaled '+' symbol.        
          g.insert("rect")
            .style("stroke", colors[i])
            .style("fill", colors[i])
            .attr("height", 2)
            .attr("width",largesymbolsize)
            .attr("x", width / 2 - largesymbolsize/2 )
            .attr("y", x1(ma50[0]) - 1)
            .style("opacity", 1);          
          g.insert("rect")
            .style("stroke", colors[i])
            .style("fill", colors[i])
            .attr("height", largesymbolsize)
            .attr("width",2)
            .attr("x", width / 2 - 1 )
            .attr("y", x1(ma50[0]) - largesymbolsize/2)
            .style("opacity", 1);
        }else {
          // draw a circle.
          g.insert("circle", "text")
            .attr("r", largesymbolsize/2)
            .style("stroke", colors[i])
            .style("fill", "none")
            .attr("cx", width / 2)
            .attr("cy", x1(ma50[0]))
            .style("opacity", 1); 
        }      
      }        
         
       
      // Write toeandchangedir data points.
      for (var dotcount = 0; dotcount < toeandchangedir.length; dotcount++) {
        var smallsymbolsize = 10;
        if(toeandchangedir[dotcount].dir > 0 ){
          // draw a '+' symbol if changedir > 0
          g.insert("rect")
            .style("stroke", colors[i])
            .style("fill", colors[i])
            .attr("height", smallsymbolsize)
            .attr("width",1)
            .attr("x", width / 2 - .5 )
            .attr("y", x1(toeandchangedir[dotcount].toe) - smallsymbolsize/2)
            .style("opacity", 1);
          g.insert("rect")
            .style("stroke", colors[i])
            .style("fill", colors[i])
            .attr("height", 1)
            .attr("width",smallsymbolsize)
            .attr("x", width / 2 - smallsymbolsize/2 )
            .attr("y", x1(toeandchangedir[dotcount].toe) - .5)
            .style("opacity", 1);
        } else {
          // draw a circle.
          g.insert("circle", "text")
            .attr("r", smallsymbolsize/2)
            .style("stroke", colors[i])
            .style("fill", "none")
            .attr("cx", width / 2)
            .attr("cy", x1(toeandchangedir[dotcount].toe))
            .style("opacity", 1); 
        }
      }
       
       
      // The original 'dots'
      if(displaydots){
        // Update outliers.
        var outlier = g.selectAll("circle.outlier")
            .data(outlierIndices, Number);
        outlier.enter().insert("circle", "text")
          .attr("r", 3)
          .style("stroke", '#000000')
          .style("fill", colors[i])
          .attr("cx", width / 2)
          .attr("cy", function(i) { return x0(d[i]); })
          .style("opacity", 1e-6);      
        outlier.transition()
            .duration(duration)
            .attr("cy", function(i) { return x1(d[i]); })
            .style("opacity", 1);
        outlier.exit().transition()
            .duration(duration)
            .attr("cy", function(i) { return x1(d[i]); })
            .style("opacity", 1e-6)
            .remove();   
      }
      
      
      // Compute the tick format.
      var format = tickFormat || x1.tickFormat(22);

      // Update box ticks.
      var boxTick = g.selectAll("text.box")
        .data(quartileData);
     
      boxTick.transition()
        .duration(duration)
        .text(format)
        .attr("y", x1);

      // Update whisker ticks. These are handled separately from the box
      // ticks because they may or may not exist, and we want don't want
      // to join box ticks pre-transition with whisker ticks post-.
      var whiskerTick = g.selectAll("text.whisker")
        .data(whiskerData || []);

      whiskerTick.transition()
        .duration(duration)
        .text(format)
        .attr("y", x1)
        .style("opacity", 1);

      whiskerTick.exit().transition()
        .duration(duration)
        .attr("y", x1)
        .style("opacity", 1e-6)
        .remove();
    });
    d3.timer.flush();
  }

  box.width = function(x) {
    if (!arguments.length) return width;
    width = x;
    return box;
  };

  box.height = function(x) {
    if (!arguments.length) return height;
    height = x;
    return box;
  };

  box.tickFormat = function(x) {
    if (!arguments.length) return tickFormat;
    tickFormat = x;
    return box;
  };

  box.duration = function(x) {
    if (!arguments.length) return duration;
    duration = x;
    return box;
  };

  box.domain = function(x) {
    if (!arguments.length) return domain;
    domain = x == null ? x : d3.functor(x);
    return box;
  };

  box.value = function(x) {
    if (!arguments.length) return value;
    value = x;
    return box;
  };

  box.whiskers = function(x) {
    if (!arguments.length) return whiskers;
    whiskers = x;
    return box;
  };
  
  box.showLabels = function(x) {
    if (!arguments.length) return showLabels;
    showLabels = false;
    return box;
  };

  box.quartiles = function(x) {
    if (!arguments.length) return quartiles;
    quartiles = x;
    return box;
  };

  return box;
};

function boxWhiskers(d) {
  return [0, d.length - 1];
}

function boxQuartiles(d) {
  return [
    d3.quantile(d, .25),
    d3.quantile(d, .5),
    d3.quantile(d, .75)
  ];
}

})();
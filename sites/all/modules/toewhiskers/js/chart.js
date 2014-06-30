

alert("ready to be starting on the charting...");

var cm = {
    CM_AIDS:"Acquired immune deficiency syndrome",
    CM_ALCOHOL:"Alcohol abuse",
    CM_ANEMDEF:"Deficiency anemias",
    CM_ARTH:"Rheumatoid arthritis/collagen vascular diseases",
    CM_BLDLOSS:" Chronic blood loss anemia",
    CM_CHF:"Congestive heart failure",
    CM_CHRNLUNG:"Chronic pulmonary disease",
    CM_COAG:"Coagulopathy",
    CM_DEPRESS:"Depression",
    CM_DM:"Diabetes, uncomplicated",
    CM_DMCX:"Diabetes with chronic complications",
    CM_DRUG:"Drug abuse",
    CM_HTN_C:"Hypertension (combine uncomplicated and complicated)",
    CM_HYPOTHY:"Hypothyroidism",
    CM_LIVER:"Liver disease",
    CM_LYMPH:"Lymphoma",
    CM_LYTES:"Fluid and electrolyte disorders",
    CM_METS:"Metastatic cancer",
    CM_NEURO:"Other neurological disorders",
    CM_OBESE:"Obesity",
    CM_PARA:"Paralysis",
    CM_PERIVASC:"Peripheral vascular disorders",
    CM_PSYCH:"Psychoses",
    CM_PULMCIRC:"Pulmonary circulation disorders",
    CM_RENLFAIL:"Renal failure",
    CM_TUMOR:"Solid tumor without metastasis",
    CM_ULCER:"Peptic ulcer disease excluding bleeding",
    CM_VALVE:"Valvular disease",
    CM_WGHTLOSS:"Weight loss",
 };

var hc = "Historical Average Cost";
hc = "SID Historical Average Cost";
var tc = "Current Year Average Cost";
tc = "Current Year Loaded Population Average Cost";
var pc = "Next Year Average Cost";
pc = "Next Year Loaded Population Average Cost";
   
 function currencyRound(currency){
    currency = String(Math.round(currency));
    var unchanged = currency;
    currency = currency.replace(/(\d)(\d\d\d)$/g, "$1,$2");
    while(currency != unchanged){
      unchanged = currency;
      currency = currency.replace(/(\d)(\d\d\d),/g, "$1,$2,");
    }
    return "$" + currency;
  }
  function currency(currency){
    return "$" + kommaRound(currency);
  }
  function kommaRound(currency){
    currency = String(Math.round(currency));
    var unchanged = currency;
    currency = currency.replace(/(\d)(\d\d\d)$/g, "$1,$2");
    while(currency != unchanged){
      unchanged = currency;
      currency = currency.replace(/(\d)(\d\d\d),/g, "$1,$2,");
    }
    return currency;
  }
  

  google.load("visualization", "1", {packages:["corechart"]});

  // http://stackoverflow.com/questions/7256672/can-google-charts-support-dual-y-axis-v-axis
  function drawVisualization(data,divid,haxistitle) {
    data = google.visualization.arrayToDataTable(data);
    // Create and draw the visualization.
    new google.visualization.ColumnChart(document.getElementById(divid)).draw(
      data, {
        curveType: "function", 
        width: 600, 
        height: 400,
        legend: { position: 'top', },
        vAxes: {0: {logScale: false},
                1: {logScale: false},
                },
        series:{
          0:{targetAxisIndex:0,color:'orange'},
          1:{targetAxisIndex:1,color:'blue'},
          2:{targetAxisIndex:1}
        },
        //title: 'Test Title One',
        hAxis: {title: haxistitle},
      }
    );
  } // end function   

  
  // Used by 'age'
  function drawBubbleVisualization(data,divid,title) {
    data = google.visualization.arrayToDataTable(data);
        data.setFormattedValue(0, 1, "Under 18");
        data.setFormattedValue(1, 1, "18-25");
        data.setFormattedValue(2, 1, "26-40");
        data.setFormattedValue(3, 1, "41-65");
        data.setFormattedValue(4, 1, "Over 65");
        data.setFormattedValue(5, 1, "Under 18");
        data.setFormattedValue(6, 1, "18-25");
        data.setFormattedValue(7, 1, "26-40");
        data.setFormattedValue(8, 1, "41-65");
        data.setFormattedValue(9, 1, "Over 65");
    // Create and draw the visualization.
    new google.visualization.BubbleChart(document.getElementById(divid)).draw(
      data, {
        title: title,
        hAxis: {title: 'Age', minValue: 0, maxValue: 6, ticks: [{v:1, f:'Under 18'}, {v:2, f:'18-25'}, {v:3, f:'26-40'}, {v:4, f:'41-65'}, {v:5, f:'Over 65'}] },
        vAxis: {title: 'Average Cost'},
        colors: ['blue', 'orange'],
        sizeAxis: {minSize: 10, maxSize: 60},
        bubble: {textStyle: {fontSize: 11}},
        height: 500,
      }
    );
  } // end function   
  
  
  // Used by Rural/Urban, Race, Chronic Conditions
  function drawVisualizationTripleComboChart(data,divid,haxistitle,title) {
    data = google.visualization.arrayToDataTable(data);
    // Create and draw the visualization.
    new google.visualization.ColumnChart(document.getElementById(divid)).draw(
      data, {
        title: title,
        curveType: "function", 
        width: 1100, 
        height: 500,
        legend: { position: 'top', },
        vAxes: {0: {title:'Average Cost', logScale: false, minSize: 0,viewWindowMode:'explicit',
              viewWindow:{
                min:0
              }},
                1: {logScale: false}},
        series:{
          0:{targetAxisIndex:0,color:'blue'},
          1:{targetAxisIndex:0,color:'#00FF00'},
          2:{targetAxisIndex:0,color:'orange'},
        },
        hAxis: {title: haxistitle},
      }
    );
  } // end function   
  

  // Used by Median Income, Comorbidities
  function drawBubbleVisualizationCostByCost(data,divid,title,min) {
    data = google.visualization.arrayToDataTable(data);
    // Create and draw the visualization.
    new google.visualization.BubbleChart(document.getElementById(divid)).draw(
      data, {
        title: title,
        //hAxis: {title: 'Age', minValue: 0, maxValue: 6, ticks: [{v:1, f:'Under 18'}, {v:2, f:'18-25'}, {v:3, f:'26-40'}, {v:4, f:'41-65'}, {v:5, f:'Over 65'}] },
        hAxis: {          
          title: tc,      
          viewWindowMode:'explicit',
          viewWindow:{
            min:min,
          }  
        },
        vAxis: {title: pc, viewWindowMode:'explicit',
          viewWindow:{
            min:min,
          }},
        colors: ['orange', 'blue','#00FF00'],
        sizeAxis: {minSize: 10, maxSize: 60},
        bubble: {textStyle: {fontSize: 11}},
        height: 500,
      }
    );
  } // end function  
  

// Used by Age/Time
function drawVisualizationLineChart(data,divid,title) {
  data = google.visualization.arrayToDataTable(data);
  var chart = new google.visualization.LineChart(document.getElementById(divid)).draw(
    data, {
      title: title,
      height: 500,
      vAxis: {title: 'Average Cost'},
      hAxis: {title: 'Year'},
    }
  );
} // end function 
  
  
// Used by Top Diagnosis, Costliest Procedures
function drawVisualizationTripleComboChartAxisLabel(data,divid,haxistitle,vaxistitle,title) {
  data = google.visualization.arrayToDataTable(data);
  new google.visualization.ColumnChart(document.getElementById(divid)).draw(
    data, {
      title: title,
      curveType: "function", 
      width: 1100, 
      height: 500,
      legend: { position: 'top', },
      vAxes: {0: {title:vaxistitle, logScale: false, minSize: 0,viewWindowMode:'explicit',
            viewWindow:{
              min:0
            }},
              1: {logScale: false}},
      series:{
        0:{targetAxisIndex:0,color:'#00FF00'},
        1:{targetAxisIndex:0,color:'orange'},
        2:{targetAxisIndex:0,color:'orange'},
      },
      hAxis: {title: haxistitle},
    }
  );
} // end function  
  
  
jQuery( document ).ready(function( $ ) {
  // Tipsy.css will  provide tooltip functionality.
  $(function() {
    $('a[rel=tipsy]').tipsy({fade: true, gravity: 'n'});
  });
  $('#pinterval').tipsy();
  $('#pinterval2').tipsy();
  
  // Enable this for testing only:.
  //$( "#clicksample" ).trigger( "click" );
  
  //$(".femaleImageContainer").css("width", 22);
  //.css("width", 100);
  
});

  /*
  function showHideSeries () {
        var sel = chart.getSelection();
        // if selection length is 0, we deselected an element
        if (sel.length > 0) {
            // if row is undefined, we clicked on the legend
            if (sel[0].row == null) {
                var col = sel[0].column;
                if (typeof(columns[col]) == 'number') {
                    var src = columns[col];
                    
                    // hide the data series
                    columns[col] = {
                        label: data.getColumnLabel(src),
                        type: data.getColumnType(src),
                        sourceColumn: src,
                        calc: function () {
                            return null;
                        }
                    };
                    
                    // grey out the legend entry
                    series[columnsMap[src]].color = '#CCCCCC';
                }
                else {
                    var src = columns[col].sourceColumn;
                    
                    // show the data series
                    columns[col] = src;
                    series[columnsMap[src]].color = null;
                }
                var view = new google.visualization.DataView(data);
                view.setColumns(columns);
                chart.draw(view, options);
            }
        }
    }
    */
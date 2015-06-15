<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    window.onresize = function(){
        startDrawingChart();
         startDrawingChart2();
    };
 
    window.onload = function(){
        startDrawingChart();
             startDrawingChart2();
    };
 
    var data_array = [
                      ['Year', 'Sales', 'Expenses'],
                      ['2004',  1000,      400],
                      ['2005',  1170,      460],
                      ['2006',  660,       1120],
                      ['2007',  1030,      540]
                    ];

                     
    startDrawingChart = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 
        function drawChart() {
            var data = google.visualization.arrayToDataTable(data_array);
 
            var options = {
              title: 'Company Performance',
              hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
            };
 
            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    };
    </script>

     <script type="text/javascript">
   
 
    var data_array2 = [
                      ['Year', 'Sales', 'Expenses'],
                      ['2004',  500,      20],
                      ['2005',  170,      560],
                      ['2006',  60,       3120],
                      ['2007',  2030,      140]
                    ];
                     
    startDrawingChart2 = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 
        function drawChart() {
            var data = google.visualization.arrayToDataTable(data_array2);
 
            var options = {
              title: '2',
              hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
            };
 
            var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }
    };
    </script>
  </head>
  <body>
    <div id="chart_div"></div>
    <div id="chart_div2"></div>
  </body>
</html>
<?php
require_once('../includes/queries.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>sticky option</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>



    <script type="text/javascript">

     window.onload = function(){
        
		     
		           startDrawingLinOrc();
		       };
		      
    var data_LinOrc = [
                                  ['Data Referência', 'Total'],
                                   <?php while ($row_lin_orcamento = $query_lin_orcamento2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_orcamento->dataref; ?>', <?php echo $row_lin_orcamento->total; ?> ],
                                 <?php }     ?>
                            ];

     startDrawingLinOrc = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinOrc);


        var options = {
          title: 'Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_orcamentos'));
        chart.draw(data, options);
      }
     };
    </script>

</head>
<body class="page">
  <div id="lin_orcamentos"></div>
</body>
</html>





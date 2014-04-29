<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>
    <body>
        <section class = "container-fluid">
            <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
            <section>
                <article>
                    <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
                    <div class = "row-fluid" >
                        <div class = "span12" >
                            <div class="">
                                <h4>Crescimento</h4>
                                <style>
                                    #yChart {
                                        width: 100% !important;
                                        /*max-width: 800px;*/
                                        height: auto !important;
                                    }
                                </style>
                                <canvas id="myChart" width="1000"  height="300"></canvas>
                                <table class = "table bordered-table table-striped" style="display:none"> <thead>
                                    <?php foreach($crescimento as $k => $valor) :?>
                                        <tr>
                                            <td><?php echo $k?></td>
                                            <td><?php echo $valor?></td>
                                        </tr>
                                    <?php endforeach?>
                                </table>
                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">
                                    <h4>Status</h4>
                                    <canvas id="status" width="1000"  height="300"></canvas>
                                    <?php $c =array('16,78,139','166,42,42','255,127,36','255,20,147','153,204,42','166,42,42'); $i=0?>
                                    <div class="span12">
                                    <?php foreach($status as $k => $s): ?>
                                        <p class="span2" style="color:rgb(<?php echo $c[$i++]?>)">
                                            <?php echo $k?>
                                        </p>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">
                                    <h4>Redes</h4>
                                    <canvas id="redes" width="1000"  height="300"></canvas>
                                    <?php  $i =0 ?>
                                    <?php foreach($redes as $k => $s): ?>
                                        <p class="span2" style="color:rgb(<?php echo $c[$i++]?>)">
                                            <?php echo $k?>
                                        </p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </section>
    <script>
    var defaults = {
	//Boolean - If we show the scale above the chart data
	scaleOverlay : false,
	//Boolean - If we want to override with a hard coded scale
	scaleOverride : true,
	//** Required if scaleOverride is true **
	//Number - The number of steps in a hard coded scale
    scaleSteps : <?php echo ($max-$min)/2?>,
	//Number - The value jump in the hard coded scale
	scaleStepWidth : 2,
	//Number - The scale starting value
    scaleStartValue : <?php echo $min?>,
	//String - Colour of the scale line
	scaleLineColor : "rgba(0,0,0,.1)",
	//Number - Pixel width of the scale line
	scaleLineWidth : 1,
	//Boolean - Whether to show labels on the scale
	scaleShowLabels : true,
	//Interpolated JS string - can access value
	scaleLabel : "<%=value%>",
	//scaleLabel : 1,
	//String - Scale label font declaration for the scale label
	scaleFontFamily : "'Arial'",
	//Number - Scale label font size in pixels
	scaleFontSize : 12,
	//String - Scale label font weight style
	scaleFontStyle : "normal",
	//String - Scale label font colour
	scaleFontColor : "#666",
	///Boolean - Whether grid lines are shown across the chart
	scaleShowGridLines : true,
	//String - Colour of the grid lines
	scaleGridLineColor : "rgba(0,0,0,.05)",
	//Number - Width of the grid lines
	scaleGridLineWidth : 1,
	//Boolean - Whether the line is curved between points
	bezierCurve : true,
	//Boolean - Whether to show a dot for each point
	pointDot : true,
	//Number - Radius of each point dot in pixels
	pointDotRadius : 3,
	//Number - Pixel width of point dot stroke
	pointDotStrokeWidth : 1,
	//Boolean - Whether to show a stroke for datasets
	datasetStroke : true,
	//Number - Pixel width of dataset stroke
	datasetStrokeWidth : 2,
	//Boolean - Whether to fill the dataset with a colour
	datasetFill : true,
	//Boolean - Whether to animate the chart
	animation : true,
	//Number - Number of animation steps
	animationSteps : 60,
	//String - Animation easing effect
	animationEasing : "easeOutQuart",
	//Function - Fires when the animation is complete
	onAnimationComplete : null
}
        var data = {
            labels : [
                        <?php echo '"'.implode('","',array_keys($crescimento)).'"'?>
                    ],
            datasets : [
                {
                    fillColor : "rgba(210,50,50,0.5)",
                    strokeColor : "rgba(220,220,220,1)",
                    pointColor : "rgba(220,220,220,1)",
                    pointStrokeColor : "#fff",
                    data : [
                        <?php echo implode(',',array_values($crescimento))?>
                        ]
                },
            ]
        }
        var myLine = new Chart(document.getElementById("myChart").getContext("2d")).Line(data, defaults);
    </script>

    <script>
var defaults = {
	//Boolean - If we show the scale above the chart data
	scaleOverlay : false,

	//Boolean - If we want to override with a hard coded scale
	scaleOverride : false,

	//** Required if scaleOverride is true **
	//Number - The number of steps in a hard coded scale
    scaleSteps : <?php echo $max-$min?>,
	//Number - The value jump in the hard coded scale
	scaleStepWidth : 1,
	//Number - The scale starting value
    scaleStartValue : <?php echo $min?>,

	//String - Colour of the scale line
	scaleLineColor : "rgba(0,0,0,.1)",

	//Number - Pixel width of the scale line
	scaleLineWidth : 1,

	//Boolean - Whether to show labels on the scale
	scaleShowLabels : true,

	//Interpolated JS string - can access value
	scaleLabel : "<%=value%>",
	//scaleLabel : 1,

	//String - Scale label font declaration for the scale label
	scaleFontFamily : "'Arial'",

	//Number - Scale label font size in pixels
	scaleFontSize : 12,

	//String - Scale label font weight style
	scaleFontStyle : "normal",

	//String - Scale label font colour
	scaleFontColor : "#666",

	///Boolean - Whether grid lines are shown across the chart
	scaleShowGridLines : true,

	//String - Colour of the grid lines
	scaleGridLineColor : "rgba(0,0,0,.05)",

	//Number - Width of the grid lines
	scaleGridLineWidth : 1,

	//Boolean - Whether the line is curved between points
	bezierCurve : false,

	//Boolean - Whether to show a dot for each point
	pointDot : true,

	//Number - Radius of each point dot in pixels
	pointDotRadius : 3,

	//Number - Pixel width of point dot stroke
	pointDotStrokeWidth : 1,

	//Boolean - Whether to show a stroke for datasets
	datasetStroke : true,

	//Number - Pixel width of dataset stroke
	datasetStrokeWidth : 2,

	//Boolean - Whether to fill the dataset with a colour
	datasetFill : true,

	//Boolean - Whether to animate the chart
	animation : true,

	//Number - Number of animation steps
	animationSteps : 60,

	//String - Animation easing effect
	animationEasing : "easeOutQuart",

	//Function - Fires when the animation is complete
	onAnimationComplete : null

}
        var data = {
            labels : [
                        <?php echo '"'.implode('","',array_keys($crescimento)).'"'?>
                    ],
            datasets : [
                <?php $i=0?>
                        <?php foreach($status as $s): ?>
                            {
                                fillColor : "rgba(<?php echo $c[$i] ?>,0.3)",
                                strokeColor : "rgba(<?php echo $c[$i] ?>,1)",
                                pointColor : "rgba((<?php echo $c[$i++] ?>,1)",
                                pointStrokeColor : "#fff",
                                data : [<?php echo implode(',',array_values($s))?>]
                            },
                        <?php endforeach; ?>
                        ]
                }
        var myLine = new Chart(document.getElementById("status").getContext("2d")).Line(data, defaults);
    </script>
    <!-- Redes-->
    <script>
        var data = {
            labels : [
                        <?php echo '"'.implode('","',array_values($range)).'"'; ?>
                    ],
            datasets : [
                        <?php $i=0?>
                        <?php foreach($redes as $r): ?>
                            {
                                fillColor : "rgba(<?php echo $c[$i] ?>,0.1)",
                                strokeColor : "rgba(<?php echo $c[$i] ?>,1)",
                                pointColor : "rgba((<?php echo $c[$i++] ?>,1)",
                                pointStrokeColor : "#fff",
                                data : [<?php echo implode(',',array_values($r) )?>]
                            },
                        <?php endforeach; ?>
                        ]
                }
        var myLine = new Chart(document.getElementById("redes").getContext("2d")).Line(data, defaults);
    </script>
    </body>
</html>

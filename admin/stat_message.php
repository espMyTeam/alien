<?php
session_start();
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
{ 

?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include_once("template/meta.php"); ?>
        <title>AlienTech</title>

        <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
        <style type="text/css">
        ${demo.css}
        </style>

        <?php
            //recuperation des données

                require_once("../scripts/base_connexion.php");
                require_once("../scripts/traitement.php");
                require_once("../scripts/requetes.php");

                $sms["recu"] = selectionneSMSrecus($base);
                $sms["envoye"] = selectionneSMSenvoyes($base);

                

        ?>

        <script type="text/javascript">
$(function () {
    // Create the chart
    var sms=[], sms_service=[];
    $('#graphe_container').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Browser market shares. January, 2015 to May, 2015'
        },
        subtitle: {
            text: 'Click the slices to view versions. Source: netmarketshare.com.'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
        series: [{
            name: "Brands",
            colorByPoint: true,
            data: [{
                name: "Microsoft Internet Explorer",
                y: 56.33,
                drilldown: "Microsoft Internet Explorer"
            }, {
                name: "Chrome",
                y: 24.030000000000005,
                drilldown: "Chrome"
            }, {
                name: "Firefox",
                y: 10.38,
                drilldown: "Firefox"
            }, {
                name: "Safari",
                y: 4.77,
                drilldown: "Safari"
            }, {
                name: "Opera",
                y: 0.9100000000000001,
                drilldown: "Opera"
            }, {
                name: "Proprietary or Undetectable",
                y: 0.2,
                drilldown: null
            }]
        }],
        drilldown: {
            series: [{
                name: "Microsoft Internet Explorer",
                id: "Microsoft Internet Explorer",
                data: [
                    ["v11.0", 24.13],
                    ["v8.0", 17.2],
                    ["v9.0", 8.11],
                    ["v10.0", 5.33],
                    ["v6.0", 1.06],
                    ["v7.0", 0.5]
                ]
            }, {
                name: "Chrome",
                id: "Chrome",
                data: [
                    ["v40.0", 5],
                    ["v41.0", 4.32],
                    ["v42.0", 3.68],
                    ["v39.0", 2.96],
                    ["v36.0", 2.53],
                    ["v43.0", 1.45],
                    ["v31.0", 1.24],
                    ["v35.0", 0.85],
                    ["v38.0", 0.6],
                    ["v32.0", 0.55],
                    ["v37.0", 0.38],
                    ["v33.0", 0.19],
                    ["v34.0", 0.14],
                    ["v30.0", 0.14]
                ]
            }, {
                name: "Firefox",
                id: "Firefox",
                data: [
                    ["v35", 2.76],
                    ["v36", 2.32],
                    ["v37", 2.31],
                    ["v34", 1.27],
                    ["v38", 1.02],
                    ["v31", 0.33],
                    ["v33", 0.22],
                    ["v32", 0.15]
                ]
            }, {
                name: "Safari",
                id: "Safari",
                data: [
                    ["v8.0", 2.56],
                    ["v7.1", 0.77],
                    ["v5.1", 0.42],
                    ["v5.0", 0.3],
                    ["v6.1", 0.29],
                    ["v7.0", 0.26],
                    ["v6.2", 0.17]
                ]
            }, {
                name: "Opera",
                id: "Opera",
                data: [
                    ["v12.x", 0.34],
                    ["v28", 0.24],
                    ["v27", 0.17],
                    ["v29", 0.16]
                ]
            }]
        }
    });
});
        </script>
    </head>
    <body role="document">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
        <!--Topbar-->
        <?php include_once('template/topbar.php');?>
     <!-- fin Topbar-->
        <?php } ?>


        <div class="ch-container">
            <div class="row">
                <?php if (!isset($no_visible_elements) || !$no_visible_elements) { 
                    include_once('template/menu.php');?>
                <div id="content" class="col-lg-9 col-sm-9">
                    <!-- Contenu: tout le contenu de notre site sera placé dans cette partie -->

            <?php } 
                include('template/header_file.php');
            ?>

            <script src="../lib/highcharts/js/highcharts.js"></script>
            <script src="../lib/highcharts/js/modules/data.js"></script>
            <script src="../lib/highcharts/js/modules/drilldown.js"></script>

            <script src="assets/js/simple.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/docs.min.js"></script>
            <script src='assets/js/jquery.dataTables.min.js'></script>
            <script src="assets/js/responsive-tables.js"></script>
            <script src="assets/js/bootstrap-tour.min.js"></script>
            <script src="assets/js/ie10-viewport-bug-workaround.js"></script>


            <div id="graphe_container" style="width: auto ; height: auto; margin: 0 auto"></div>

                    <?php 
                     include('template/footer_file.php');
                    if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
                 </div><!-- fin contenu -->
    
                    <?php } ?>
                </div><!--Fin row-->
            <div id='footer'>
            <hr/>
            <mask>copyrigth: </mask>
        </div>
    </body>
</html>

<?php
          //  include('template/footer_file.php');}
   }else{
                session_destroy();
                header("location: index.php");
}
          //  include("template/footer.php");
        ?>
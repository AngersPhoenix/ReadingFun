<?php

require_once '../Chunks/general.php';
require_once "../bootstrap.php";

spl_autoload_register('persistanceLoader');
spl_autoload_register('modelLoader');

session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Knowledge is fun !</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../Frameworks/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href='../CSS/homeAdmin.css' rel='stylesheet' type='text/css'>
<link href='../Frameworks/bootstrap-switch/css/bootstrap-switch.css'rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../CSS/Fonts.css" type="text/css"></link>
</head>
<body data-twttr-rendered="true">
	<div class="navbar" style="margin-bottom: 0%;">
		<?php $GLOBALS['resume']->getHeader('Admin');
			$odi = new OrderDaoImp($GLOBALS['entityManager']);
		?>
	</div>


	<div id="wrapper">

		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand"><a href="#"> <b><h3>Admin Tools</h3></b>
				</a></li>
				<li><a href="homeAdmin.php"><span
						class="stick-left glyphicon glyphicon-cog"></span> <i>Dashboard</i></a></li>
				<li><a href="adminOrders.php"><span
						class="glyphicon glyphicon-shopping-cart"></span> <i>Orders</i></a></li>
				<li><a href="adminClients.php"><span class="glyphicon glyphicon-euro"></span>
						<i>Clients</i></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-book"></span> <i>Books</i></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-education"></span>
						<i>About</i></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-comment"></span> <i>Contact</i></a></li>
			</ul>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3>
							<pan class="dancing-script">Dashboard</pan>
						</h3>
						<hr></hr>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-5">
										<img src="../images/chat.png" class="img-rounded" width='100'
											height='100'></img>
									</div>
									<div class="col-xs-7">
										<h1><?php echo count($odi->getAllOrders());?> Orders</h1>
									</div>
								</div>
							</div>
							<a href="adminOrders.php" class="simple">
								<div class="panel-footer">
									<span>Know more</span> <span
										class="pull-right glyphicon glyphicon-chevron-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-offset-1 col-md-3">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-5">
										<img src="../images/customer.png" class="img-rounded"
											width='100' height='100'></img>
									</div>
									<div class="col-xs-7">
										<h1 style="color: white;"><?php echo count($cdi->getAllClients ());?> Clients</h1>
									</div>
								</div>
							</div>
							<a href="adminClients.php" class="simple panel-green">
								<div class="panel-footer">
									<span>Know more</span> <span
										class="pull-right glyphicon glyphicon-chevron-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-offset-1 col-md-3">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-5">
										<img src="../images/books.png" class="img-rounded" width='100'
											height='100'></img>
									</div>
									<div class="col-xs-7">
										<h1 style="color: white;"><?php echo count ( $bdi->getAllBooks () );?> Books</h1>
									</div>
								</div>
							</div>
							<a href="adminBooks.php" class="simple panel-red">
								<div class="panel-footer">
									<span>Know more</span> <span
										class="pull-right glyphicon glyphicon-chevron-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-7">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="panel-title">
									<span class="glyphicon glyphicon-stats"></span><i> <b>Chart
											preview</b></i>
								</div>
							</div>
							<div class="panel-body">
								<div id="charts"></div>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="panel-title">
									<span class="glyphicon glyphicon-indent-left"></span> <i> <b>Chart
											preview</b></i>
								</div>
							</div>
							<div class="panel-body ">
								<div id="pies"></div>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div>
		<!-- /#page-content-wrapper -->
		<div class="navbar navbar-fixed-bottom">
			<input type="checkbox" name="my-checkbox" data-size="small"
				checked="checked">
		
		</div>
	</div>

	<div class="modal fade bs-example-modal-sm" id="logoutModal"
		tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" aria-label="Close" data-dismiss="modal"
						type="button"></button>
					<h4 id="lougoutTitle" class="modal-title">
						<span class="dancing-script"> ReadingFun</span>
					</h4>
				</div>
				<div class="modal-body">
					<p>
						We are so happy to have you with us, we will be waiting for you <span
							class="glyphicon glyphicon-thumbs-up"></span>
					</p>
				</div>
			</div>
		</div>
	</div>



</body>

<script type="text/javascript" src="../JS/jquery.min.js"></script>
<script src="../Frameworks/bootstrap-3.3.4/js/bootstrap.js"></script>
<script
	src="../Frameworks/formvalidation-master/dist/js/formValidation.js"></script>
<script src="../Frameworks/bootstrap-switch/js/bootstrap-switch.js"></script>

<script type="text/javascript" src="../JS/general.js"></script>
<script type="text/javascript" src="../JS/highcharts.js"></script>

<script>
// var chart;
function disconnect(){
	$.post(
			'../Controller/control_registration.php',
			{
				action: "logout"
			}
			,function(d){
					if(d.flag == 'yes'){
						$('#logoutModal').modal('show');
						setTimeout(function(){
							$('#logoutModal').modal('hide');
							window.location.href='index.php';
						},4000);		
					}
					else
						alert(d);
				}
			,'json');
};

$(document).ready(function(){
$("[name='my-checkbox']").bootstrapSwitch();
$("[name='my-checkbox']").on('switchChange.bootstrapSwitch', function (e, data) {
	$("#wrapper").toggleClass("toggled");
}); 

$("#menu-toggle").click(function(e) {
	e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});


	$.post(
		'../Controller/control_admin.php',
		{
			action:'chart'
		},
		function(data){
			var finaltab =[];
			if(data.flag === true){
			var mySeries = [];
		    for (var i = 0; i < data.data.length; i++) {
		        mySeries[i] = data.data[i];
		    }
			for(index in data.titles){
				var tmp = [data.titles[index],data.data[index]];
				finaltab[index] = tmp;
			}

				$('#charts').highcharts({
	    chart: {
		    animation:true
		},
		title:{
			text:'Books price',
			align:'center'
		},
	    plotOptions: {
	        series: {
	            allowPointSelect: true
	        }
	    },
	    series: [{
	        data: mySeries
	    }]
	});


		    $('#pies').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false
		        },
		        title: {
		            text: 'The repartition of Books,2015'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                    }
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'Browser share',
		            data: finaltab
		        }]
		    });

			}
		},'json'	
	);
	
	
	
});













</script>

</html>

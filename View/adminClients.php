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
<meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
<title>Knowledge is fun !</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../Frameworks/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href='../CSS/homeAdmin.css' rel='stylesheet'></link>
<link href='../Frameworks/bootstrap-switch/css/bootstrap-switch.css' rel='stylesheet' type='text/css'></link>
<link rel="stylesheet" type="text/css" href="../Frameworks/DataTables/css/jquery.dataTables.css"></link>
<link rel="stylesheet" type="text/css" href="../Frameworks/DataTables/css/dataTables.tableTools.css"></link>
<link rel="stylesheet" type="text/css" href="../Frameworks/DataTables/css/dataTables.editor.css"></link>
<link rel="stylesheet" href="../Frameworks/jquery-UI/css/jquery-ui.min.css"></link>
<link rel="stylesheet" href="../CSS/Fonts.css" type="text/css"></link>
<style type="text/css" class="init">

table.dataTable tr td:first-child {
        text-align: center;
    }
 
     table.dataTable tr td:first-child:before { 
         content: "\f096"; /* fa-square-o */ 
		 font-family: FontAwesome; 
     } 
 
     table.dataTable tr.selected td:first-child:before { 
         content: "\f046"; 
     } 
 
    table.dataTable tr td.dataTables_empty:first-child:before {
        content: " ";
    }
</style>
</head>
<body data-twttr-rendered="true">
	<div class="navbar" style="margin-bottom: 0%;">
		<?php 
			$GLOBALS['resume']->getHeader('Admin');
		?>
	</div>


	<div id="wrapper">

		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand"><a href="homeAdmin.php"> <b><h3>Admin
								Tools</h3></b>
				</a></li>
				<li><a href="homeAdmin.php"><span
						class="stick-left glyphicon glyphicon-cog"></span> <i>Dashboard</i></a></li>
				<li><a href="adminOrders.php"><span
						class="glyphicon glyphicon-shopping-cart"></span> <i>Orders</i></a></li>
				<li><a href="adminClients.php"><span class="glyphicon glyphicon-euro"></span>
						<i>Clients</i></a></li>
				<li><a href="adminBooks.php"><span class="glyphicon glyphicon-book"></span>
						<i>Books</i></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-education"></span>
						<i>About</i></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-comment"></span> <i>Contact</i></a></li>
			</ul>
		</div>
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row" style="margin-bottom: 2%;">
					<table id="clients" class="row-border hover order-column"
						width="100%" cellspacing="0">
						<thead>
							<tr>
								<th></th>
								<th>Client Name</th>
								<th>Client Age (ans)</th>
								<th>Client Email</th>
								<th>Client Password</th>
								<th>Client level</th>
							</tr>
						</thead>
						<tfoot>
							<th></th>
							<th>Client Name</th>
							<th>Client Age (ans)</th>
							<th>Client Email</th>
							<th>Client Password</th>
							<th>Client level</th>
						</tfoot>
					</table>
				</div>
				<!-- here if you want to add anything ! -->	
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
<script src="../Frameworks/bootstrap-switch/js/bootstrap-switch.js"></script>
<script src="../Frameworks/jquery-UI/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../JS/general.js"></script>
<script type="text/javascript" src="../Frameworks/DataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../Frameworks/DataTables/js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="../Frameworks/DataTables/js/dataTables.editor.js"></script>
<script src="../JS/md5.js"></script>

<script>

var table;
var row;
var editor;

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
							location.reload();
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

editor = new $.fn.dataTable.Editor( {
	ajax: "../Controller/fill_clients.php",
    table: "#clients",
    fields: [ {
            label: "Name:",
            name: "Client Name"
        }, {
            label: "Age:",
            name: "Client Age"
        }, {
            label: "Email:",
            name: "Client Email"
        }, {
            label: "Password:",
            name: "Client Password",
            type: "password"
        }, {
            label: "Level:",
            name: "Client Level"
        }
    ]
} );

$('#clients').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this );
} );

$('#clients').DataTable( {
    dom: "Tfrtip",
    ajax: "../Controller/fill_clients.php",
    columns: [
        { data: null, defaultContent: " ", orderable: false },
        { data: "Client Name" },
        { data: "Client Age" },
        { data: "Client Email" },
        { data: "Client Password" },
        { data: "Client Level" },
    ],
    order: [ 1, 'asc' ],
    tableTools: {
        sRowSelect: "os",
        sRowSelector: 'td:first-child',
        aButtons: [
            { sExtends: "editor_create", editor: editor },
            { sExtends: "editor_edit",   editor: editor },
            { sExtends: "editor_remove", editor: editor }
        ]
    }
} );


});

</script>

</html>

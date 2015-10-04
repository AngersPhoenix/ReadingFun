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
<link href="../CSS/Fonts.css" rel="stylesheet"></link>
<link href="../CSS/Cart.css" rel="stylesheet" type="text/css"></link>
</head>
<body data-twttr-rendered="true">
	<?php 
// 		global $cl;
// 		global $cdi;
// 		global $client;
	
		$GLOBALS['resume']->getHeader('User','connected');
// 		$cdi = new ClientDaoImp($GLOBALS['entityManager']);
		$orders = $client->getOrders();
	?>

	<div class="container"
		style="margin-top: 8%; box-shadow: 1px 1px 1px 2px #888888; border-radius: 3px;">
		<div class="container-fluid" style="margin-top: 1%;">
			<ol class="breadcrumb">
				<li class="active">
				<span class="glyphicon glyphicon-shopping-cart"></span> Cart
				</li>
				<li>
				<a href="#"><span class=" glyphicon glyphicon-eye-open"></span> Validation</a>
				</li>
			</ol>
		</div>
		<div class="container-fluid">
			<div class="table-responsive">
				<table id="thr" class="table table-hover">
					<thead>
					</thead>
					<tbody>
						<tr>
							<th width='20%' style="text-align: center;">Image</th>
							<th style="text-align: center;">Title</th>
							<th style="text-align: center;">Availability</th>
							<th style="text-align: center;width: 12%;">Quantity</th>
							<th style="text-align: center;">Price(PU) $</th>
						</tr>
						<?php 
							$total = 0;
							foreach($orders as $order)
								if(!$order->getValid())
									foreach($order->getOrderBook() as $orderbook){
						?>
							<tr>
								<td style="text-align: center;">
									<img class="img-rounded" width="100" height="100" src="<?php echo $orderbook->getBook()->getImg();?>" alt="<?php echo $orderbook->getBook()->getTitle();?>" />
								</td>
								<td style="text-align: center;">
									<?php echo $orderbook->getBook()->getTitle();?>
								</td>
								<td style="text-align: center;">
									<span class="glyphicon glyphicon-ok" style="color: green;"></span>
								</td style="text-align: center;">
								<td   style="text-align: center;" data='important'>
									<input style="width: 25%;" type="text" name="quantity<?php echo $orderbook->getId();?>" value="<?php echo $orderbook->getQuantity();?>"/>
									<a class="like-link" onclick="changeTotal(<?php echo $orderbook->getId();?>)" data-href="<?php echo $order->getId();?>">update?</a>
								</td>
								<td style="text-align: center;" data='price'>
									<?php echo $orderbook->getBook()->getPrice();?>
								</td>
							</tr>						
						
						<?php
							$total+=($orderbook->getQuantity()*$orderbook->getBook()->getPrice());
						}?>		
					</tbody>
					<tr>
						<td style="text-align: center;" scope="col" colspan="4">
							<b style="float: right;font-size: large;margin-right: 4%;">Total</b>												
						</td>
						<td id="total" style="text-align: center;">
							<b><?php echo $total;?></b>
						</td>
					</tr>
				</table>
			</div>
			<div class="container-fluid pull-right" style="margin-bottom: 2%;">
				<a class="btn btn-warning" id="validate">Validate</a>
			</div>
		</div>
		</div>
</body>
<?php 
echo "<div style=\"margin-top:2%;\">";
$GLOBALS['resume']->getFooter('User','connected');
echo "</div>";
?>
<!-- preserving the modals just over here not something special ! -->

	<!-- Login Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						<b>Login <span class="glyphicon glyphicon-user"></span></b>
					</h4>
				</div>
				<div class="modal-body">
					<!-- the body that should be filled  -->
					<div id="loginMessage"></div>
					<form class="form-horizontal" method="post" action=""
						enctype="multipart/form-data" id="loginForm">
						<div class="form-group ">
							<label for="fileN" class="col-xs-3 control-label">Email adress</label>
							<div class="col-xs-6">
								<input name="loginEmail" type="text" class="form-control"
									name="filetLabel" id="loginEmail"
									placeholder="test@test.com,fr...">
							</div>
						</div>
						<div class="form-group">
							<label for="psswd" class="col-xs-3 control-label">Password</label>
							<div class="col-xs-6">
								<input name="loginPassword" type="password" class="form-control"
									name="password" id="loginPassword">
							</div>
						</div>
						<div class="form-group">
							<img id="loading" src="../../images/loading.gif">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" id="loginBtn">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal -->

<!-- end of the modal -->
	
<!-- logout modal -->
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
	

<script type="text/javascript" src="../JS/jquery.min.js"></script>
<script src="../Frameworks/bootstrap-3.3.4/js/bootstrap.js"></script>
<script src="../Frameworks/formvalidation-master/dist/js/formValidation.js"></script>
<script type="text/javascript" src="../JS/general.js"></script>
<script type="text/javascript">

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

						
function changeTotal(number){
		
	$.post(
		'../Controller/control_Cart.php'
		,
		{
			action:'validation',
			value:$('input[name=quantity'+number+']').val(),
			id:number		
		}
		,
		function(data){
			alert('The Quantity was successufly updated');
			var quantities = [];
			var prices = [];
			var i=0,j=0;
			$('#thr td').each(function(){
				if( $(this).attr('data') !== undefined  )
				{
					if($(this).attr('data')==='price'){
						prices[j]=parseFloat($(this).text());
						j++;
					}
					$(this).children().each(function(){
						if($(this).is('input')) {
							quantities[i] = parseInt($(this).val());
							i++;
						}
					});
				}
			});		
			i=0;
			var total = 0;
			for(i in prices)
				total+=(prices[i]*quantities[i]);
			$('#total').html('<b>'+total+'</b>');
			
		}
		,
		'json'
	);	


}
$(document).ready(function(){

$('#logo').click(function(e){
	e.preventDefault();
	window.location.href='index.php';
});
	
$('#validate').click(function(){
	$('#loginModal').modal('show');
	
});

$("#loginBtn").click(function(e){
	e.preventDefault();
	$('#loading').show();
	$.post(
			'../Controller/control_Cart.php',
			{
				action : "login",
				email : $(
						'#loginEmail')
						.val(),
				password : $(
						'#loginPassword')
						.val()
			},
			function(d) {
				if(d.flag == 'EMAIL_NULL'){
						setTimeout(function(){
						$("#loading").hide();
						document.getElementById('loginMessage').innerHTML='<div class=\"alert alert-danger\" role=\"alert\"> <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span> The email entered does not exist, change a few things up and try submitting again.</div>';
						document.getElementById('loginForm').reset();
						$('#loginForm').data('formValidation').resetForm();
						setTimeout(function(){
						document.getElementById('loginMessage').innerHTML="";
						},4000);
						},3000);
				}else if(d.flag == 'PASSWD_NULL'){
					setTimeout(function(){
					$("#loading").hide();
					document.getElementById('loginMessage').innerHTML='<div class=\"alert alert-danger\" role=\"alert\"> <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span> Wrong password, change a few things up and try submitting again.</div>';
					document.getElementById('loginForm').reset();
					$('#loginForm').data('formValidation').resetForm();
					setTimeout(function(){
						document.getElementById('loginMessage').innerHTML="";
					},4000);
					},3000);
				}else{
					setTimeout(function(){
					$("#loading").hide();
					document.getElementById('loginMessage').innerHTML = "<div class=\"alert alert-success\" role=\"alert\"><strong>Well done ! welcome with us</strong></div>";
					$('.loginGround').html("<div class=\"dropdown btn navbar-btn pull-right\"><a id=\"dLabel\" class=\"simple\" data-target=\"#\" href=\"#\" data-toggle=\"dropdown\" style=\"color:white;text-decoration:none;\" aria-haspopup=\"true\" role=\"button\" aria-expanded=\"false\"><span class=\"marck-script\">&nbsp;<span class=\"glyphicon glyphicon-user\"></span> " + d.name + "</span> <span class=\"caret\"></span></a><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\"><li><a href=\"homeClient.php\"><span class=\"glyphicon glyphicon-book\"></span> <span class=\"marck-script\">Book Store</span></a></li><li><a href=\"\"><span class=\" glyphicon glyphicon-shopping-cart\"></span> <span class=\"marck-script\">Shoping cart</span></a></li><li><a href=\"\"><span class=\" glyphicon glyphicon-cog\"></span> <span class=\"marck-script\">Account settings</span></a></li><li role=\"presentation\" class=\"divider\"></li><li><a id=\"logOut\" onclick=\"disconnect()\"><span class=\"glyphicon glyphicon-share-alt\"></span> <span class=\"marck-script\">Logout</span></a></li></ul></div>");
					$('#loginModal').modal('toggle');	
					$('.breadcrumb').html('<li><a href=\"#\"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li><li class=\"active\"><span class=" glyphicon glyphicon-eye-open"></span> Validation</li>');
					alert('You will be redirected to the Book store again ');
					window.location.href='homeClient.php';	
					},3000);
				}
			}, 'json')
	});






	
});


		
</script>
</html>

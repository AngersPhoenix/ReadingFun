<?php

require_once '../Chunks/general.php';
require_once "../bootstrap.php";

spl_autoload_register('persistanceLoader');
spl_autoload_register('modelLoader');


session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8">
<title>Knowledge is fun !</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../Frameworks/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../Frameworks/formvalidation-master/dist/css/formValidation.min.css">
<link href='../CSS/index.css' rel='stylesheet' type='text/css'>
<link href="../CSS/Fonts.css" rel="stylesheet"></link>
<link href="../Frameworks/Lightbox/css/lightbox.css" rel="stylesheet"></link>
<style type="text/css">
.make-center{
	top: 35%;
	transform: translateY(-35%);
}
</style>
</head>

<body data-twttr-rendered="true">
<?php
$GLOBALS['resume']->getHeader('User','index');
?>
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
							<img id="loading" src="../images/loading.gif">
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

	<!-- Register Modal -->
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						<b>Register</b> <span class="glyphicon glyphicon-pencil"></span>
					</h4>
				</div>
				<div class="modal-body">
					<!-- the body that should be filled  -->
					<form class="form-horizontal" method="post" action=""
						enctype="multipart/form-data" id="registerForm">

						<div class="form-group">
							<label class="col-xs-3 control-label">Name</label>
							<div class="col-xs-6">
								<input name="registerName" type="text" class="form-control"
									id="registerName" placeholder="name : Jean ...">
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Age</label>
							<div class="col-xs-6">
								<input name="registerAge" type="number" class="form-control"
									id="registerAge" placeholder="age: 24 ..." min="20">
							</div>
						</div>

						<div class="form-group ">
							<label for="fileN" class="col-xs-3 control-label">Email adress</label>
							<div class="col-xs-6">
								<input name="registerEmail" type="email" class="form-control"
									id="registerEmail" placeholder="user@user.com,fr...">
							</div>
						</div>
						<div class="form-group">
							<label for="psswd" class="col-xs-3 control-label">Password</label>
							<div class="col-xs-6">
								<input name="registerPassword" type="password"
									class="form-control" name="password" id="registerPassword">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success" id="registerBtn">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal -->

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

	<div class="container" style="margin-bottom: 0px; margin-top: 5%;">
<!-- 		<div class="jumbotron text-center" id="jumbotron-container" style="margin-bottom: 0%;"> -->
<!-- 			<h1 class="dancing-script" -->
<!-- 				style="color: white; text-shadow: 3px 1px gray;">ReadingFun</h1> -->
<!--  			<div id="greeting-message" style="color: white;">-->
<!-- 				<p> -->
<!-- 					When was the last time you read a book, or a substantial magazine -->
<!-- 					article? Do your daily reading habits center around tweets, -->
<!-- 					Facebook updates, or the directions on your instant oatmeal packet? -->
<!-- 					If you’re one of countless people who don’t make a habit of reading -->
<!-- 					regularly, you might be missing out: reading has a significant -->
<!-- 					number of benefits,so don't miss the oportunity to take advantage -->
<!-- 					of <a href="#"><kbd> -->
<!-- 							<span data-toggle="tooltip" data-placement="right" -->
<!-- 								title="best website for books ^_^">ReadingFun</span> -->
<!-- 						</kbd></a>. -->
<!-- 				</p> -->
			<!-- this is the new area : -->
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img style="height: 400px;width: 100%;" src="../images/library.jpg"  alt="../images/jumbotron-background3.jpg" class="img-rounded">
			      <div class="carousel-caption make-center">
						<h1 class="dancing-script" style="color: white; text-shadow: 3px 1px gray;font-size: 80px;">
						ReadingFun</h1>
				      <p>
						<b><i>When was the last time you read a book, or a substantial magazine
						article? Do your daily reading habits center around tweets,
						Facebook updates, or the directions on your instant oatmeal packet?
						If you’re one of countless people who don’t make a habit of reading
						regularly, you might be missing out: reading has a significant
						number of benefits,so don't miss the oportunity to take advantage
						of &nbsp;</i></b><a href="#"><kbd>
								<span data-toggle="tooltip" data-placement="right"
									title="best website for books ^_^">ReadingFun</span>
							</kbd></a>.
					 </p>
			      </div>
			    </div>
			    <div class="item">
			      <img style="height: 400px;width: 100%;" src="../images/second.jpg"  alt="../images/jumbotron-background3.jpg" class="img-rounded">
			      <div class="carousel-caption make-center">
				      <h1 class="dancing-script" style="color: white; text-shadow: 3px 1px gray;font-size: 80px;">
						ReadingFun</h1>
				      <p>
						<b><i>When was the last time you read a book, or a substantial magazine
						article? Do your daily reading habits center around tweets,
						Facebook updates, or the directions on your instant oatmeal packet?
						If you’re one of countless people who don’t make a habit of reading
						regularly, you might be missing out: reading has a significant
						number of benefits,so don't miss the oportunity to take advantage
						of </i></b><a href="#"><kbd>
								<span data-toggle="tooltip" data-placement="right"
									title="best website for books ^_^">ReadingFun</span>
							</kbd></a>.
					 </p>
			      </div>
			    </div>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
<!-- 			</div> -->
<!-- 		</div> -->
		<!-- end jumbotron-->

		<section>
			<div class="container">
			<div class="page-header" id="feedback" style="margin-top: 2%;">
				<h2>
					Feedback<small><small><i>&nbsp;Know us better</i></small></small>
				</h2>
			</div>

			<div class="row col-lg-4">
				<blockquote>
					<p>
						Frankly saying ! it's an amazing website it has everything you
						need to know about a book.Thank <br />you&nbsp;<a href="#"><kbd>
								<span data-toggle="tooltip" data-placement="right"
									title="best website for books ^_^">ReadingFun</span>
							</kbd></a>.
					</p>
					<footer> Some Client </footer>
				</blockquote>
			</div>

			<div class="row col-lg-4">
				<blockquote>
					<p>
						i really apreciate the work done here. i have been wondering for a
						long time to get my hand on a website like this with such tools
						.Thank you <a href="#"><kbd>
								<span data-toggle="tooltip" data-placement="right"
									title="best website for books ^_^">ReadingFun</span>
							</kbd></a>.
					</p>
					<footer> Some client </footer>
				</blockquote>
			</div>
			<div class="row col-lg-4">
				<blockquote>
					<p>
						basicely a new idea like this makes our life a lot more easier
						.Thank<br />&nbsp; you <a href="#"><kbd>
								<span data-toggle="tooltip" data-placement="right"
									title="best website for books ^_^">ReadingFun</span>
							</kbd></a> .
					<p>
					<footer> Some client </footer>
				</blockquote>
			</div>
			</div>
		</section>
		<!-- end section -->
	</div>
	<!-- the end of the container section -->
	<div class="container" style="margin-bottom: 5%;">

		<section id="best">

			<div class="page-header" id="gallery" style="margin-top:2%;">
				<h2>
					Discover our best sellings<small> and try them</small>
				</h2>
			</div>

			<!-- thumbnails -->
			<div class="row">
				<div class="col-xs-6  col-md-3">
					<a href="../images/1.jpg" data-lightbox="image-1" data-title="R Machine Learning Essentials"  class="thumbnails media-left">
						<img class="img-rounded media-object" src="../images/1.jpg" alt="">
					</a>
					<div class="media-body">Build machine learning algorithms using the
						most powerful tools in R Identify business problems</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<a href="../images/2.jpg" data-lightbox="image-2" data-title="Angular JS"  class="thumbnails media-left">
						<img class="img-rounded media-object" src="../images/2.jpg" alt="">
					</a>
					<div class="media-body">AngularJS is one of the most popular
						frameworks in the world of web development today.</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<a href="../images/3.jpg" data-lightbox="image-3" data-title="Python Data Analysis"  class="thumbnails media-left">
					<img class="img-rounded media-object" src="../images/3.jpg" alt="">
					</a>
					<div class="media-body">Learn how to find, manipulate, and analyze
						data using Python Perform advanced.</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<a href="../images/4.jpg" data-lightbox="image-4" data-title="MEAN Web Development"  class="thumbnails media-left">
						<img class="img-rounded media-object" src="../images/4.jpg" alt="">
					</a>
					<div class="media-body">Learn how to construct a fully functional
						MEAN application by using its components along with the best
						third-party modules</div>
				</div>
			</div>

			<!-- end gallery -->
		</section>
		<!-- end 2 section -->
	</div>
	<!-- end 2 container -->
</body>
<?php
$GLOBALS['resume']->getFooter();

?>

<script src="../JS/jquery.min.js"></script>
<script src="../Frameworks/bootstrap-3.3.4/js/bootstrap.js"></script>
<script
	src="../Frameworks/formvalidation-master/dist/js/formValidation.min.js"></script>
<script	src="../Frameworks/formvalidation-master/dist/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="../JS/general.js"></script>
<script src="../Frameworks/Lightbox/js/lightbox.min.js"></script>
<script type="text/javascript">
//this function center's the modals each time :
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
	$(document)
			.ready(
					function() {




						$('#loginForm')
								.formValidation(
										{
											icon : {
												valid : 'glyphicon glyphicon-ok',
												invalid : 'glyphicon glyphicon-remove',
												validating : 'glyphicon glyphicon-refresh'
											},
											message : 'This value is not valid',
											fields : {
												loginEmail : {
													validators : {
														notEmpty : {
															message : 'The Login is required and cannot be empty'
														},
														stringLength : {
															min : 3,
															max : 30,
															message : 'The username must be more than 3 and less than 30 characters long'
														}
													}
												//end validators

												}//end loginEmail
												,
												loginPassword : {
													validators : {
														notEmpty : {
															message : 'The Password is brutal and cannot be empty'
														}
													}
												//end validators
												}

											}
										//end loginPassword
										//end field
										});//end formValidation

						$('#registerForm')
								.formValidation(
										{
											framework : 'bootstrap',
											icon : {
												valid : 'glyphicon glyphicon-ok',
												invalid : 'glyphicon glyphicon-remove',
												validating : 'glyphicon glyphicon-refresh'
											},
											message : 'This value is not valid',
											fields : {

												registerName : {

													validators : {

														notEmpty : {
															message : 'The name of the new client cannot be empty'
														}

													}

												},
												registerAge : {

													validators : {
														notEmpty : {
															message : 'The age of the new client cannot be empty'
														}
													}
												},
												registerEmail : {
													validators : {
														notEmpty : {
															message : 'The Email of the new client cannot be empty'
														}
													}

												},
												registerPassword : {
													validators : {
														notEmpty : {
															message : 'The password of the new client cannot be empty'
														}
													}
												}

											}

										});

						$('#loginModal').on('shown.bs.modal', function() {
							$('#loginForm').formValidation('resetForm', true);
						});

						$('#registerModal').on(
								'shown.bs.modal',
								function() {
									$('#registerForm').formValidation(
											'resetForm', true);
								});

					});//end ready function !
</script>

<script>
	$(document)
			.ready(
					function() {
						//redirecting to the control_registration page :
						$("#registerBtn")
								.click(
										function(e) {

											e.preventDefault();
											$
													.post(
															'../Controller/control_registration.php',
															{
																action : "register",
																name : $(
																		'#registerName')
																		.val(),
																age : $(
																		'#registerAge')
																		.val(),
																email : $(
																		'#registerEmail')
																		.val(),
																password : $(
																		'#registerPassword')
																		.val()
															},
															function(d) {
																if (window
																		.confirm('Dear,'
																				+ $(
																						'#registerName')
																						.val()
																				+ ' an email was sent to the following email '
																				+ $(
																						'#registerEmail')
																						.val()
																				+ ',please check your the verification code before its to late !'))
																	window.location = 'registration.html';
															}, 'text')
										});
					$("#loginBtn").click(function(e){
						e.preventDefault();
						$('#loading').show();
						$.post(
								'../Controller/control_registration.php',
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
										$('.loginGround').html("<div class=\"dropdown btn navbar-btn pull-right\"><a id=\"dLabel\" class=\"simple\" data-target=\"#\" href=\"#\" data-toggle=\"dropdown\" style=\"color:white;text-decoration:none;\" aria-haspopup=\"true\" role=\"button\" aria-expanded=\"false\"><span class=\"marck-script\">&nbsp;<span class=\"glyphicon glyphicon-user\"></span> " + d.name + "</span> <span class=\"caret\"></span></a><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\"><li><a href=\"homeClient.php\"><span class=\"glyphicon glyphicon-book\"></span> <span class=\"marck-script\">Book Store</span></a></li><li><a href=\"\"><span class=\" glyphicon glyphicon-shopping-cart\"></span> <span class=\"marck-script\">Shoping cart</span></a></li><li><a href=\"clientProfile.php\"><span class=\" glyphicon glyphicon-cog\"></span> <span class=\"marck-script\">Account settings</span></a></li><li role=\"presentation\" class=\"divider\"></li><li><a id=\"logOut\" onclick=\"disconnect()\"><span class=\"glyphicon glyphicon-share-alt\"></span> <span class=\"marck-script\">Logout</span></a></li></ul></div>");
										$('.loginGround').append("<div class=\"navbar-btn pull-right\"><a href=\"clientCart.php\" style=\"color:white;margin-right:5px;\">  <span class=\"badge navbar-btn\"><span class=\"glyphicon glyphicon-shopping-cart\"><span> " + d.orders + " </span></a></div>");
										$('#loginModal').modal('toggle');
										if(d.level===1)window.location.href="homeAdmin.php";
										},3000);
									}
								}, 'json')
						});

						});
</script>

</html>

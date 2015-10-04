<?php

require_once '../Chunks/general.php';
require_once "../bootstrap.php";

spl_autoload_register('persistanceLoader');
spl_autoload_register('modelLoader');


use Doctrine\Common\Collections\ArrayCollection;

$client = null;
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
<link rel="stylesheet" href="../Frameworks/formvalidation-master/dist/css/formValidation.min.css">
<link href="../CSS/Fonts.css" rel="stylesheet" type="text/css"></link>
<link href="../CSS/Profile.css" rel="stylesheet" type="text/css"></link>
</head>

<body data-twttr-rendered="true">
	<?php 
		$GLOBALS['resume']->getHeader('User','connected');
	?>

	<div class="container wrapper" style="margin-top: 7%;">
		<div class="container col-md-12"
			style="margin-top: 0px; box-shadow: 1px 1px 1px 2px #888888; border-radius: 3px; padding-top: 3%; padding-bottom: 3%; margin-bottom: 2%;">
			<!-- 			<div class="row"></div> -->

			<div class="col-md-7">

				<div role="tabpanel" style="margin-bottom: 5%;">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#overview"
							aria-controls="overview" role="tab" data-toggle="tab"><span
								style="font-size: medium;" class="dancing-script">Overview</span></a></li>
						<li role="presentation"><a href="#settings"
							aria-controls="settings" role="tab" data-toggle="tab"><span
								style="font-size: medium;" class="dancing-script">Settings</span></a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="overview">
							<div class="row" style="margin-top: 1%;">
								<div class="col-md-4">
									<img src="../images/Small/profile.png"
										class="img-responsive img-rounded" alt="">
								
								</div>

								<div class="col-md-8">
							   	<?php if($client!=null){?>
									<div class="row">
										<div class="col-md-3">
											<b>Name</b>
										</div>
										<div class="col-md-9" id="ch-name">
											<i><?php echo $client->getName();?></i>
										</div>
									</div>
									<hr style="margin: 3%"></hr>
									<div class="row">
										<div class="col-md-3">
											<b>Age</b>
										</div>
										<div class="col-md-9" id="ch-age">
											<i><?php echo $client->getAge();?> ans</i>
										</div>
									</div>
									<hr style="margin: 3%"></hr>
									<div class="row">
										<div class="col-md-3">
											<b>Email</b>
										</div>
										<div class="col-md-9" id="ch-email">
											<i><?php echo $client->getEmail();?></i>
										</div>
									</div>
									<hr style="margin: 3%"></hr>
									<div class="row">
										<div class="col-md-3">
											<b>Type</b>
										</div>
										<div class="col-md-9">
											<i><?php
												if ($client->getLevel () == 0)
													echo "User";
												else
													echo "Admin"?></i>
										</div>
									</div>
									<hr style="margin: 3%"></hr>
									<div class="row">
										<div class="col-md-3">
											<b>Orders</b>
										</div>
										<div class="col-md-9">
											<i><?php echo count($client->getOrders());?></i>
										</div>
									</div>	
									<?php }else{?>
										<div style="margin-bottom: 5%; margin-top: 5%;"
										class="alert alert-danger" role="alert">
										We are terribly sorry, it seems that their is a problem for
										the time being,Would you like to go back to the main page <a
											style="text-decoration: none; color: #A94442;"
											href="index.php"> <span
											class="glyphicon glyphicon-home"></span></a> ?
									</div>
										<?php }?>
						   	</div>
							</div>


						</div>
						<div role="tabpanel" class="tab-pane" id="settings">
							<div role="tabpanel" class="tab-pane active" id="overview">
								<div class="row" style="margin-top: 1%;">
									<form action="../../Controller/control_profile.php"
										method="post" id="profileModify">
										<div class="col-md-4">
											<img src="../images/Small/profile.png"
												class="img-responsive img-rounded" alt="">
											
											<div class="form-group">
												<button id="save" type="submit" style="margin-top: 1%;"
													class="btn btn-default btn-block">
													<b>Save</b>
												</button>
											</div>
											<div id="response"></div>
										</div>
										<div class="col-md-8">
									<?php if($client!=null){?>
									
									<div class="row">
												<div class="col-md-3">
													<b>Name</b>
												</div>
												<div class="col-md-9">
													<div class="form-group ">
														<input name="clientName" style="width: 90%;" type="text"
															placeholder="<?php echo $client->getName();?>......." />
													</div>
												</div>
											</div>
											<hr style="margin: 3%"></hr>
											<div class="row">
												<div class="col-md-3">
													<b>Age</b>
												</div>
												<div class="col-md-9">
													<div class="form-group ">
														<input name="clientAge" style="width: 90%;" type="number"
															min="18" max="80"
															placeholder="<?php echo $client->getAge();?>......." />
													</div>
												</div>
											</div>
											<hr style="margin: 3%"></hr>
											<div class="row">
												<div class="col-md-3">
													<b>Email</b>
												</div>
												<div class="col-md-9">
													<div class="form-group ">
														<input name="clientEmail" style="width: 90%;" type="text"
															placeholder="<?php echo $client->getEmail();?>......." />
													</div>
												</div>
											</div>
											<hr style="margin: 3%"></hr>
											<div class="row">
												<div class="col-md-3">
													<b>Old password</b>
												</div>
												<div class="col-md-9">
													<div class="form-group ">
														<input name="clientOld" style="width: 90%;"
															type="password" placeholder="****************" />
													</div>
												</div>
											</div>
											<hr style="margin: 3%"></hr>
											<div class="row">
												<div class="col-md-3">
													<b>New password</b>
												</div>
												<div class="col-md-9">
													<div class="form-group ">
														<input name="clientNew" style="width: 90%;"
															type="password" placeholder="****************" />
													</div>
												</div>
											</div>
											<hr style="margin: 3%"></hr>
											<div class="row">
												<div class="col-md-3">
													<b>Confirm password</b>
												</div>
												<div class="col-md-9">
													<div class="form-group ">
														<input name="clientRenew" style="width: 90%;"
															type="password" placeholder="****************" />
													</div>
												</div>
											</div>

											<hr style="margin: 3%"></hr>
									<?php }else{?>
										<div style="margin-bottom: 5%; margin-top: 5%;"
												class="alert alert-danger" role="alert">
												We are terribly sorry, it seems that their is a problem for
												the time being,Would you like to go back to the main page <a
													style="text-decoration: none; color: #A94442;"
													href="index.php"> <span
													class="glyphicon glyphicon-home"></span></a> ?
											</div>
										<?php }?>
								</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="well"
					style="padding-top: 2%; padding-bottom: 1%; margin-bottom: 1%;">
					<h3 style="text-align: center; margin-top: 0%;">
						<small><span style="color: black;"
							class="glyphicon glyphicon-book"></span></small> <span
							class="dancing-script">Reading Fun</span>
					</h3>
					</span>
				</div>
				<div class="well">
					<div class="row">
						<div class="col-md-4">
							<b>Managers</b>
						</div>
						<div class="col-md-8">
							<span class="glyphicon glyphicon-user"><i> ROUINEB Hamza</i></span>
							<span class="glyphicon glyphicon-user"><i> NABIH Ayman</i></span>
						</div>
					</div>
					<hr style="margin: 3%"></hr>
					<div class="row">
						<div class="col-md-4">
							<b>Office Phone</b>
						</div>
						<div class="col-md-8">
							<span class="glyphicon glyphicon-phone-alt"><i> 08 99 37 XX XX</i></span>
						</div>
					</div>
					<hr style="margin: 3%"></hr>
					<div class="row">
						<div class="col-md-4">
							<b>Cell Phone</b>
						</div>
						<div class="col-md-8">
							<span class=" glyphicon glyphicon-phone"><i> 07 85 08 75 23</i></span>
						</div>
					</div>
					<hr style="margin: 3%"></hr>
					<div class="row">
						<div class="col-md-4">
							<b>Email</b>
						</div>
						<div class="col-md-8">
							<i>readingfun.masterweb@gmail.com</i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="push"></div>

		</div>
	</div>
	<?php 
// 		echo "<div style=\"margin-top:2%;\">";
		$GLOBALS['resume']->getFooter();
// 		echo "</div>";
	?>
	
	
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
	
	
	
	<script type="text/javascript" src="../JS/jquery.min.js" />
	</script>
	<script src="../Frameworks/bootstrap-3.3.4/js/bootstrap.js"></script>
	<script
		src="../Frameworks/formvalidation-master/dist/js/formValidation.min.js"></script>
	<script
		src="../Frameworks/formvalidation-master/dist/js/framework/bootstrap.min.js"></script>
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

	
$(document).ready(function(){

	$('#logo').click(function(e){
		e.preventDefault();
		window.location.href='index.php';
	});
	    FormValidation.Validator.isSame = {
	        validate: function(validator, $field, options) {
	            if ($field.val()===$('input[name=clientNew]').val()) {
	                return true;
	            }else {
		            return{
	                valid: false,      
	                message: 'It should be exactely the same !'
		            }
	            }
	            return true;
	        }
	    };
	
	$('#profileModify').formValidation({
		framework: 'bootstrap',
		icon : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		message : 'This value is not valid',
		fields : {
			clientName : {
				validators : {
					notEmpty : {
						message : 'The client name is required and cannot be empty'
					},
					stringLength : {
						min : 3,
						max : 30,
						message : 'The client name must be more than 3 and less than 30 characters long'
					}
				}
			},
			clientAge:{
				validators:{
					notEmpty : {
						message : 'The client age is required and cannot be empty'
					},
					between: {
                        min: 18,
                        max: 80,
                        message: 'Please fill a valid age between 18 and 80 years'
                    }
				}
			},
			clientEmail:{
				validators:{
					 emailAddress: {
                         message: 'The value is not a valid email address'
                     },
                     regexp: {
                         regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                         message: 'The value is not a valid email address'
                     }
				}
			},
			clientOld:{
				validators:{
					notEmpty : {
						message : 'The client old password is required and cannot be empty'
					}
				}
			},
			clientNew:{
				validators:{
					notEmpty : {
						message : 'The client new password is required and cannot be empty'
					}
				}
			},
			clientRenew:{
				validators:{
					notEmpty : {
						message : 'The client new password confirmation is required and cannot be empty'
					},
					isSame:{
						message : 'The client new password confirmation is required and cannot be empty'
					}
				}
			}
		}
	}).on('success.field.fv', function(e, data) {
        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            data.fv.disableSubmitButtons(true);
        }
    });

	$('#save').click(function(e){
		e.preventDefault();
		$(this).addClass('m-progress');
		$.post(
			'../Controller/control_profile.php',
			{
				action:'save',
				clientName:$('input[name=clientName]').val(),
				clientAge:$('input[name=clientAge]').val(),
				clientEmail:$('input[name=clientEmail]').val(),
				clientOld:$('input[name=clientOld]').val(),
				clientNew:$('input[name=clientNew]').val()
			},
			function(data){
				
				if(data.flag === true){
					$('#response').html('<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The user was updated successuflly !</div>');
					$('#ch-name').html('<i>'+data.name+'</i>');
					$('#ch-age').html('<i>'+data.age+'</i> ans');
					$('#ch-email').html('<i>'+data.email+'</i>');
					setTimeout(function(){
						$('#response').html('');
					},5000);
				}else if(data.flag===false){
					if(data.cause ==='action was not set')
					{
						$('#response').html('<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>their is an internal error !</div>');
					}else{
						$('#response').html('<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The old password is wrong !</div>');
					}
				}
			},
			'json'
		);
		setTimeout(function(){
			$('#profileModify').formValidation('resetForm', true);
			$('#save').removeClass('m-progress');
		},3000);
	});
	
});





													
</script>
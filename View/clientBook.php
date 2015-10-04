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
<link href="../Frameworks/bootstrap-3.3.4/css/bootstrap.min.css"rel="stylesheet">
<link href="../CSS/Fonts.css" rel="stylesheet"></link>
<link href="../CSS/Book.css" rel="stylesheet"></link>
<link href="../Frameworks/Lightbox/css/lightbox.css" rel="stylesheet"></link>
</head>
<body data-twttr-rendered="true">
	<?php
	$GLOBALS ['resume']->getHeader ( 'User', 'connected' );
	?>


	<!-- the book description -->
	<div class="container"
		style="margin-top: 8%; box-shadow: 1px 1px 1px 2px #888888; border-radius: 3px;">
		<?php
		
		if (isset ( $_POST ['bookId'] )) {
			$bdi = new BookDaoImp ( $entityManager );
			$book = $bdi->getBookById ( intval ( $_POST ['bookId'] ) );
			if ($book != null) {
				$flag = true;
				?>
		<!-- image container -->
		<div class="container col-md-6" style="margin-bottom: 2%;">
			<div>
				<div data-toggle="tooltip" data-placement="bottom"
					title="<?php echo $book->getTitle();?>" class="thumbnail"
					style="margin-top: 5%;">
					<a href="<?php echo $book->getImg();?>" data-lightbox="image-1" data-title="<?php echo $book->getTitle();?>">
					<img width="200" height="200" src="<?php echo $book->getImg();?>" alt="<?php echo $book->getTitle();?>"></img>
					</a>
				</div>
				<div class="col-md-12">
					<a href="homeClient.php" data-toggle="tooltip"
						data-placement="bottom" title="Go to BookStore ? press me then"
						class="btn btn-default"><span class="glyphicon glyphicon-book"></span><b>
							Store</b></a> <a id="triggerCart"
						data-href="<?php echo $book->getId();?>" data-toggle="tooltip"
						data-placement="bottom" title="Press me & you will buy this book"
						class="btn btn-default pull-right"><span
						class=" glyphicon glyphicon-shopping-cart"></span><b> Buy</b></a>
				</div>
			</div>
		</div>
		<!-- description container -->
		<div class="container col-md-6">
			<div class="container-fluid">
				<h3 class="lead text-capitalize" style="margin-bottom: 0%;">
					<b><em>description <small><abbr title="ReadingFun">RF</abbr></small></em></b>
				</h3>

				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
						</thead>
						<tbody>
							<tr>
								<th width='20%'>Title:</th>
								<th><?php echo $book->getTitle();?></th>
							</tr>
							<tr>
								<th><b>Availability:</b></th>
								<th><span class=" glyphicon glyphicon-ok" style="color: green;"></span></th>
							</tr>
							<tr>
								<th>Categorie(s):</th>
								<th>
						<?php
				
				if ($book->getCategories () != null) {
					foreach ( $book->getCategories () as $category )
						echo $category->getName () . ' ';
					?>
							
						<?php }else?>
							None
						</th>
							</tr>
							<tr>
								<th>Author(s):</th>
								<th>
						<?php
				
				if ($book->getAuthors () != null) {
					foreach ( $book->getAuthors () as $author )
						echo $author->getName () . ' ';
					?>
							
						<?php }else?>
							No one 
						</th>
							</tr>
							<tr>
								<th>About:</th>
								<th>
						<?php echo $book->getRecap();?>
						</th>
							</tr>
							<tr>
								<th>Price:</th>
								<th>
						<?php echo $book->getPrice().' $';?>
						</th>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- container col-md-6 -->
		<?php
			
} else {
				$flag = false;
				?>
			<div style="margin-bottom: 5%; margin-top: 5%;"
			class="alert alert-danger" role="alert">
			We are terribly sorry, but the store is empty for the time being,
			Would you like to go back to the main page<a
				style="text-decoration: none; color: #A94442;"
				href="index.php"> <span
				class="glyphicon glyphicon-home"></span></a> ?
		</div>
		<?php
			}
		} else {
			$flag = false;
			?>
			
			<div style="margin-bottom: 5%; margin-top: 5%;"
			class="alert alert-danger" role="alert">
			We are terribly sorry, but you should go back to the book store and
			choose again, Would you like to go back to the Book Store <a
				style="text-decoration: none; color: #A94442;" href="homeClient.php">
				<span class="glyphicon glyphicon-home"></span>
			</a> ?
		</div>
			
		<?php
		}
		?>
	<!-- end of probleme -->
	</div>
	
	<?php
	if ($flag) {
		?>
		<footer class="bs-docs-footer"
		style="background-color: #373c40;margin-top:5%;">
	<?php
	} else {
		?>
		<footer class="bs-docs-footer navbar-fixed-bottom"
		style="background-color: #373c40;">
	<?php
	}
	?>
	<?php 
		$GLOBALS['resume']->getFooter();
	?>
	<div class="modal fade" id="cartModal" tabindex="-1" role="dialog"
		aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" aria-label="Close" data-dismiss="modal"
						type="button"></button>
					<h4 class="modal-title">
						<span class="dancing-script"> ReadingFun</span>
					</h4>
				</div>
				<div class="modal-body">

					<div id="addCart" class="alert alert-success alert-dismissible"
						role="alert" style="display: none;">
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<span class="glyphicon glyphicon-ok"></span> Your book was
						successufly added to the cart
					</div>
					<div class="container col-md-12">
						<div class="media col-md-6">
							<div class="media-left">
								<img width="80" height="80" class="media-object"
									src="<?php echo $book->getImg();?>"
									alt="<?php echo $book->getTitle();?>">
							
							</div>
							<div class="media-body">
								<h4 class="media-heading">
									<small>
								<?php
								
								if ($book->getCategories () != null)
									foreach ( $book->getCategories () as $category )
										echo $category->getName () . ' ';
								?></small>
								</h4>
							    <?php echo $book->getTitle();?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-5">
								<label style="color: green;"><?php echo $book->getPrice().' $';?></label>
							</div>
							<div class="col-md-7">
								<select class="form-control" id="quantity">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<a href="homeClient.php" type="button" class="btn btn-default"><span
						class="glyphicon glyphicon-chevron-left"></span>Continue shoping</a>
					<a id="shop" type="button" class="btn btn-primary">See your cart <span
						class="glyphicon glyphicon-chevron-right"></span></a>
				</div>
			</div>
		</div>
	</div>

</body>


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
<script src="../Frameworks/Lightbox/js/lightbox.min.js"></script>
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
	
	$('#shop').click(function(e){
		$.post(
				'../Controller/control_Cart.php',
				{
					action:'order',
					bookId:$('#triggerCart').attr('data-href'),
					quantity:$('#quantity option:selected').text()
				},
				function(data){
					if(data.flag==='ok'){
						$('#count').html(data.total);
						$('#addCart').css('display','block');
// 						$('#count').html(' '.data.count);
						document.location.href = 'homeClient.php';
					}		
				},
				'json'
			);
	});
	
	$('#triggerCart').click(function(e){
		e.preventDefault();
		$('#cartModal').modal('show');
	});

	//to initialize the tool tip 
	$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
	})
	
	function centerModal() {
	    $(this).css('display', 'block');
	    var $dialog = $(this).find(".modal-dialog");
	    var offset = ($(window).height() - $dialog.height()) / 2;
	    // Center modal vertically in window
	    $dialog.css("margin-top", offset);
	}
	$('.modal').on('show.bs.modal', centerModal);
	$(window).on("resize", function () {
	    $('.modal:visible').each(centerModal);
	});
	
	$(document).on('click','#logOut',function(e){
	$.post(
			'../Controller/control_Book.php',
			{
				action: "logout"
			}
			,function(d){
					if(d.flag == 'yes'){
						$('#logoutModal').modal('show');
						setTimeout(function(){
							$('#logoutModal').modal('hide');
							document.location.href="index.php"
						},4000);		
					}
					else
						alert(d);
				}
			,'json')
	});




});

</script>

</html>
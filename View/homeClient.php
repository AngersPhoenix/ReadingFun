<?php
	
require_once '../Chunks/general.php';
require_once "../bootstrap.php";

spl_autoload_register('persistanceLoader');
spl_autoload_register('modelLoader');

	
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
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
<link rel="stylesheet"href="../Frameworks/formvalidation-master/dist/css/formValidation.min.css">
<link href="../CSS/homeClient.css" rel="stylesheet" type="text/css"></link>
<link href="../CSS/Fonts.css" rel="stylesheet"></link>
<link href="../Frameworks/Lightbox/css/lightbox.css" rel="stylesheet"></link>
</head>

<body data-twttr-rendered="true">
	<?php 
		$GLOBALS['resume']->getHeader('User','connected');
// 		$bdi = new BookDaoImp ( $entityManager );
		$books = $bdi->getAllBooks ();
	?>

	<div class="container " style="margin-top: 5%;">
		<!-- help bar -->
		<div class="container col-md-12"
			style="margin-top: 0px; box-shadow: 1px 1px 1px 2px #888888; border-radius: 3px;">
			<div class="container col-md-3">
				<lable class="btn"> <b>Result(s): <b><?php echo sizeof($books);?></b></b></lable>
			</div>
			<div class="container col-md-8 col-md-offset-1">
				<div class=" form-inline form-group pull-right"
					style="margin-bottom: 2px; margin-top: 2px;">
					<label>Sort:</label> <select class="form-control" id="sortBox">
						<option>Lowest first</option>
						<option>Highest first</option>
					</select> <label>view: </label> <a class="btn view" id="square"><span
						class="glyphicon glyphicon-th-large"></span></a> <a class="btn"
						style="color: black;" id="list"><span
						class="glyphicon glyphicon-th-list"></span></a> <a></a>
				</div>
			</div>


		</div>

		<div class="col-md-2" role="complementary">

			<h4 class="dancing-script" style="text-align: center;">Search Tools</h4>

			<!-- the first option in search tools -->
			<div class="panel-group" id="accordion" role="tablist"
				aria-multiselectable="true">
				<div id="theme0" class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion"
								href="#collapseOne" aria-expanded="true"
								aria-controls="collapseOne" style="text-decoration: none"
								id="price"> Price </a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in"
						role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">

							<div class="form-group"
								style="margin-bottom: 0%; padding-bottom: 0%;">
								<input type="number" class="form-control" name="priceMin"
									min="5" max="100" placeholder="Min.."><input type="number"
									class="form-control" name="priceMax" min="5" max="100"
									placeholder="Max.."> <a class="btn" id="pricePicker"
										style="margin-left: 25%; padding-bottom: 0%;"><span
											class="glyphicon glyphicon-search"></span>
											</button></a>
							
							</div>
						</div>
					</div>
				</div>
				<!-- the second option in search tools -->
				<div id="theme1" class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion"
								href="#collapseTwo" aria-expanded="true"
								aria-controls="collapseOne" style="text-decoration: none"
								id='author'> Author </a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse in"
						role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body"></div>
					</div>
				</div>
				<!-- the third option in search tools -->
				<div id='theme2' class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion"
								href="#collapseThree" aria-expanded="true"
								aria-controls="collapseThree" style="text-decoration: none"
								id='category'> Category </a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse in"
						role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body"></div>
					</div>
				</div>


			</div>
		</div>


		<div id="books" class="col-md-10" role="main"
			style="border-radius: 3px; margin-top: 5px; padding-top: 1%; box-shadow: 1px 1px 1px 2px #888888;">
		
	<?php
	
	if (sizeof ( $books ) > 0) {
		?>
		<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Image</th>
							<th>Title</th>
							<th>Author(s)</th>
							<th>Small ideas</th>
							<th>Edition year</th>
							<th>Price(<b>$</b>)
							</th>
						</tr>
					</thead>
					<tbody>
				<?php
		$collections = new ArrayCollection ( $books );
		$criteria = Criteria::create ()->orderBy ( array (
				"price" => Criteria::ASC 
		) );
		$sortedBooks = $collections->matching ( $criteria );
		
		$j = 0;
		for($i = 0; $i < 6; $i ++) {
			?>		
					<a href="#">
							<tr class="clickabe-row"
								data-href="<?php echo $sortedBooks[$i]->getId();?>">
								<th>
									<a href="<?php echo $sortedBooks[$i]->getImg();?>" data-lightbox="image-1" data-title="<?php echo $sortedBooks[$i]->getTitle();?>">
									<img class="img-thumbnail img-responsive"
									src="<?php echo $sortedBooks[$i]->getImg();?>"
									data-zoom-image="../../images/Large/php.png" alt="book"></img>
									</a>
								</th>
								<td><?php echo $sortedBooks[$i]->getTitle();?></td>
								<td>
						<?php
			if ($sortedBooks [$i]->getAuthors () != null)
				foreach ( $sortedBooks [$i]->getAuthors () as $author )
					echo "<b>" . $author->getName () . "</b> ";
			?>
						</td>
								<td><?php echo $sortedBooks[$i]->getRecap();?></td>
								<td><?php echo $sortedBooks[$i]->getYear()->format('Y-m-d');?></td>
								<td><?php echo $sortedBooks[$i]->getPrice();?></td>
							</tr>
						</a>
				<?php
			if (++ $j == count ( $sortedBooks ))
				break;
		}
		?>
				</tbody>
				</table>
				<?php }else{?>			
						<div style="margin-bottom: 5%; margin-top: 5%;"
					class="alert alert-danger" role="alert">
					We are terribly sorry, but the store is empty for the time being,
					Would you like to go back to the main page<a
						style="text-decoration: none; color: #A94442;"
						href="index.php"> <span
						class="glyphicon glyphicon-home"></span></a> ?
				</div>	
				<?php }?>	
		</div>

		</div>

	</div>
	<div class="container" style="margin-bottom: 2%;">
		<div class="col-md-10 col-md-offset-2"
			style="border-radius: 3px; box-shadow: 1px 1px 1px 2px #888888; margin-top: 1%;">

			<nav>
			<div class="container" style="margin: 1% auto; width: 25%;">
				<ul class="pagination" style="margin: 1%; text-align: center;">
					<li class="disabled"><span> <span aria-hidden="true">&laquo;</span>
					</span></li>
				</ul>
			
			</nav>
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
<?php 
$GLOBALS['resume']->getFooter();
?>
<script type="text/javascript" src="../JS/jquery.min.js" />
</script>
<script src="../Frameworks/bootstrap-3.3.4/js/bootstrap.js"></script>
<script type="text/javascript" src="../JS/general.js"></script>
<script src="../Frameworks/Lightbox/js/lightbox.min.js"></script>
<script type="text/javascript">

$('#collapseOne').collapse('hide');
$('#collapseTwo').collapse('hide');
$('#collapseThree').collapse('hide');

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
function send(id){
	if(confirm('Good choice, you\'will be redirected to the Book page,is that ok ?')){
		post('clientBook.php',{bookId:id});
	}
	return false;
}

$(document).ready(function(e){
	$('#logo').click(function(e){
		e.preventDefault();
		window.location.href='index.php';
	});

	$(document).on('click','.clickabe-row',function(e){
		if(confirm('Good choice, you\'will be redirected to the Book page,is that ok ?')){
			post('clientBook.php',{bookId:$(this).attr('data-href')});
		}
	});
	
	$('#pricePicker').click(function(){
		var minprice = $("input[name$='priceMin']");
		var maxprice = $("input[name$='priceMax']");
		if(minprice.val().length >0 && isNaN(minprice)){
			if(maxprice.val().length >0 && isNaN(maxprice)){
				var type;
				if($('#list').css('color')==='rgb(0, 0, 0)')
					type='list';
				else
					type='square';
				$.post(
					'../Controller/control_BookStore.php',
					{
						action:type,
						page:$('li.active a.ChangePage').text(),
						min:minprice.val(),
						max:maxprice.val(),
					},
					function(data){
						$('#books').html(data);	
					}
				);
						
			}else{
				alert('The second input is not valid !');
			}
		}else{
			alert('The first input is not valid !');
		}
		
	});

	//pagination function
	$(document).on('click','.ChangePage',function(e){
		
		if($(this).parent().attr('class')==='active')
			alert('you are already in the page '+$(this).text());
		else{
			//first we should see which mode is enabled :
			$('li.active').removeClass('active');
			$(this).parent().addClass('active');
			var $mode;
			if($('#list').css('color')==='rgb(0, 0, 0)')
				$mode='list';
			else
				$mode='square';
			$.post(
					'../Controller/control_BookStore.php',
					{
						action:$mode,
						page:$(this).text()
					},
					function(data){
						$("#books").html(data);
					}
			);
		
		}
		
	});
	$.post(
			'../Controller/control_BookStore.php'
			,
			{
				action:'both'
			}
			,
			function(data){
				if(data!="error"){
					var index;
					for(index in data['Authors'])
						$('#theme1 .panel-body:first').append("<div class=\"radio\"><label><input name=\"same\" type=\"radio\" id=\"authorName"+index+"\"/><small>"+data['Authors'][index]+"</small></label></div>");

					for(index in data['Categories'])
						$('#theme2 .panel-body:first').append("<div class=\"radio\"><label><input name=\"same\" type=\"radio\" id=\"authorName"+index+"\"/><small>"+data['Categories'][index]+"</small></label></div>");

					//pagination generation:
					var i,p0=$('.pagination');
					
					for(i=0;i<data['Pages'];i++){
						if(i==0)p0.append('<li class=\'active\'><a class=\'ChangePage\'>'+(i+1)+'</a></li>');
						else p0.append('<li ><a class=\'ChangePage\'>'+(i+1)+'</a></li>');
					}
				}
			}
			,
			'json'
	);

	$('#square').click(function(e){
		e.preventDefault();
		if($(this).css('color')==='rgb(0, 0, 0)')alert('Sorry, but you are already in that mode');
		else{
		$(this).css('color','black');
		$('#list').css('color','gray');
		$('#books').html("<div class=\"progress\"  style=\"margin-bottom: 5%; margin-top: 5%;\"><div id =\"bar\" class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" style=\"width: 0%;\"><p></p></div></div>");
		for(i=0;i<100;i++){
			$('#bar').css('width', 1+'%');
			setTimeout(function(){
				$('#bar').css('width', i+'%');
				$('#bar p:first').html(i+'% Complete');
			},1000);
		}
		setTimeout(function(){$.post(
			'../Controller/control_BookStore.php'
			,
			{
				action:'square',
				page: $('.active .ChangePage').text()
			}
			,
			function(data){
					setTimeout(function(){
						if(data!="error")
							$("#books").html(data);
					},3000);
			}
			,
			'text'
			);},800);
		}
		});

	$('#list').click(function(e){

		e.preventDefault();
		if($(this).css('color')==='rgb(0, 0, 0)')alert('Sorry, but you are already in that mode');
		else{
		$(this).css('color','black');
		$('#square').css('color','gray');
		$('#books').html("<div class=\"progress\"  style=\"margin-bottom: 5%; margin-top: 5%;\"><div id =\"bar\" class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" style=\"width: 0%;\"><p></p></div></div>");
		for(i=0;i<100;i++){
			$('#bar').css('width', 1+'%');
			setTimeout(function(){
				$('#bar').css('width', i+'%');
				$('#bar p:first').html(i+'% Complete');
			},1000);
		}
		
		setTimeout(function(){$.post(
			'../Controller/control_BookStore.php'
			,
			{
				action:'list',
				page: $('.active .ChangePage').text()
			}
			,
			function(data){
					setTimeout(function(){
						if(data!="error")
							$("#books").html(data);
					},3000);
			}
			,
			'text'
			);},800);
		}
	});

	$('#price').click(function(e){
		var t0 = $("#theme0");
		t0.attr('class','panel panel-primary');	
		$('#collapseOne').on('hide.bs.collapse', function () {
			t0.attr('class','panel panel-default');	
		})	
	});
	$('#author').click(function(e){
		var t1 = $("#theme1");
		t1.attr('class','panel panel-primary');	
		
		$('#collapseTwo').on('hide.bs.collapse', function () {
			t1.attr('class','panel panel-default');	
		})	
	});
	$('#category').click(function(e){
		var t2 = $("#theme2");
		t2.attr('class','panel panel-primary');	
		$('#collapseThree').on('hide.bs.collapse', function () {
			t2.attr('class','panel panel-default');	
		})	
	});

	$('#sortBox').change(function(){

		var choice;
		if($('#list').css('color')==='rgb(0, 0, 0)') choice ='list';
		else choice ='square';
		var va;
		if($('#sortBox option:selected').text() === 'Highest first') va = 'high';
		else va='low';
		$.post(
				'../Controller/control_BookStore.php',
				{
					action:choice,
					sort:va,
					page:$('.active .ChangePage').text()
				},
				function(data){
					$("#books").html(data);
				}
		);
	});
});


</script>
</html>
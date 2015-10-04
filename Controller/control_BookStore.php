<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/BookDaoImp.php';
	require_once '../../vendor/autoload.php';
	require_once '../Model/Book.php';
	require_once '../Model/Author.php';
	require_once '../Model/Category.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/BookDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/Model/Author.php';
	require_once $root . '/phoenix/Project/Model/Category.php';
}
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
/**
 *
 * @param Integer $page        	
 * @param Integer $size        	
 * @return Integer
 */
function getNumberBooks($page, $size) {
	if($size<6) return $size;
	else{
	$a = round ( $size / 6 );
	$b = $size % 6;
	if ($b == 0)
		return 6;
	else if ($page == ($a + 1))
		return $b;
	else
		return 6;
	}
}

if (isset ( $_POST ['action'] )) {
	$bdi = new BookDaoImp ( $entityManager );
	$books = $bdi->getAllBooks ();
	$collections = new ArrayCollection($books);
	if(isset($_POST['sort'])){
		if(strcmp($_POST['sort'],'high')==0){
			$criteria = Criteria::create()
			->orderBy(array("price" => Criteria::DESC));
		}else if(strcmp($_POST['sort'],'low')==0){
			$criteria = Criteria::create()
			->orderBy(array("price" => Criteria::ASC));
		}
	}else{
		$criteria = Criteria::create()
		->orderBy(array("price" => Criteria::ASC));
	}
	$sortedBooks = $collections->matching($criteria);
	if (isset ( $_POST ['page'] ) && strcmp ( $_POST ['action'], 'square' ) == 0) {
		if (sizeof ( $books ) > 0) {
			$display = "";
			$j = 0;
			$np = intval ( $_POST ['page'] );
			$nbr = getNumberBooks ( $np, count ( $books ));
			
			if (isset ( $_POST ['min'] ) && isset ( $_POST ['max'] )) {
				$min = intval($_POST ['min'] );
				$max = intval($_POST ['max'] );
			}else{
				$min = 0;
				$max = 100000;
			}
				for($i = (6 * ($np - 1)); $i < (6 * $np); $i ++) {
					if ($sortedBooks [$i]->getPrice () <= $max && $sortedBooks [$i]->getPrice () >= $min) {
						$display = $display . "<div class=\"col-sm-6 col-md-4\">
						<div class=\"thumbnail\">
							<a href=".$sortedBooks[$i]->getImg()." data-lightbox=\"image-".$i."\" data-title=". $sortedBooks[$i]->getTitle().">	
							<img width=\"100\" height=\"100\" src=" . $sortedBooks [$i]->getImg () . " alt=" . $sortedBooks [$i]->getTitle () . ">
								<div class=\"caption\">
							</a>
									<h3>" . $sortedBooks [$i]->getTitle () . "</h3>
									<p>" . $sortedBooks [$i]->getRecap () . "</p>
									<p>
										<a onclick=\"send(".$sortedBooks[$i]->getId().")\" class=\"btn btn-primary like-link\" role=\"button\">View <span class=\"glyphicon glyphicon-eye-open\"></span></a>
										<span class=\"pull-right\"><b>".$sortedBooks[$i]->getPrice()." $</b></span>
									</p>
								</div>
						</div>
					</div>
				</div>";
						$j ++;
						if ($j == $nbr)
							break;
					}
				}

			echo $display;
		} else
			echo "error!";
	} else if (isset ( $_POST ['page'] ) && strcmp ( $_POST ['action'], 'list' ) == 0) {
		if (sizeof ( $books ) > 0) {
			$display = "
				<div class=\"table-responsive\">
				<table class=\"table table-hover\">
				<thead>
				<tr>
				<th>Image</th>
				<th>Title</th>
				<th>Authors</th>
				<th>Small ideas</th>
				<th>Edition year</th>
				<th>Price(<b>$</b>)
				</th>
				</tr>
				</thead>
				<tbody>
				";
			
			$np = intval ( $_POST ['page'] );
			$nbr = getNumberBooks ( $np, count ( $books ));
			$j = 0;
			if (isset ( $_POST ['min'] ) && isset ( $_POST ['max'] )) {
				$min = intval($_POST ['min'] );
				$max = intval($_POST ['max'] );
			}else{
				$min = 0;
				$max = 100000;
			}
			
				for($i = (6 * ($np - 1)); $i < (6 * $np); $i ++) {
					if ($sortedBooks [$i]->getPrice () <= $max && $sortedBooks [$i]->getPrice () >= $min) {
						$display = $display . "<a href=\"#\">
												<tr class=\"clickabe-row\" data-href=" . $sortedBooks [$i]->getId () . ">
													<th>
														<a href=". $sortedBooks[$i]->getImg() ." data-lightbox=\"image-1\" data-title=".$sortedBooks[$i]->getTitle().">
														<img class=\"img-thumbnail img-responsive\"
														src=" . $sortedBooks [$i]->getImg () . "
														alt=" . $sortedBooks [$i]->getTitle () . ">
														</a>
													</th>
													<td>  " . $sortedBooks [$i]->getTitle () . "</td>
													<td>";
						if ($sortedBooks [$i]->getAuthors () != null)
							foreach ( $sortedBooks [$i]->getAuthors () as $author )
								$display = $display . "<b>" . $author->getName () . "</b> ";
						$display = $display . "
													</td>
													<td>" . $sortedBooks [$i]->getRecap () . "</td>
													<td>" . $sortedBooks [$i]->getYear ()->format ( 'Y-m-d' ) . "</td>
													<td>" . $sortedBooks [$i]->getPrice () . "</td>
												</tr>
											</a>";
						$j ++;
						if ($j == $nbr)
							break;
					}
				}

			$display = $display . "
								</tbody>
							</table>";
		}
		echo $display;
	} else if (strcmp ( $_POST ['action'], 'both' ) == 0) {
		
		$array = array ();
		$categories = array ();
		$array [] = $books [0]->getAuthors ()[0]->getName ();
		
		$flag = false;
		foreach ( $books as $book )
			if (count ( $book->getCategories () ) != 0) {
				foreach ( $book->getCategories () as $category ) {
					if (count ( $categories ) != 0) {
						foreach ( $categories as $search ) {
							if (strcmp ( $search, $category->getName () ) == 0) {
								$flag = true;
								break;
							}
							if (! $flag)
								$categories [] = $category->getName ();
							else
								$flag = true;
						}
					} else {
						$categories [] = $category->getName ();
					}
				}
			}
		
		$flag = false;
		foreach ( $books as $book ) {
			if ($book->getAuthors () != null) {
				foreach ( $book->getAuthors () as $author ) {
					foreach ( $array as $cell )
						if (strcmp ( $author->getName (), $cell ) == 0) {
							$flag = true;
							break;
						}
					if (! $flag)
						$array [] = $author->getName ();
					else
						$flag = false;
				}
			}
		}
		
		
		if ((count ( $books ) % 6) == 0)
			$pages = count ( $books ) / 6;
		else
			if(count($books) < 6)
				$pages = (round ( count ( $books ) / 6 ));
			else 
				$pages = (round ( count ( $books ) / 6 ) + 1);
		
		echo json_encode ( array (
				"Authors" => $array,
				"Categories" => $categories,
				"Pages" => $pages 
		) );
	} else
		echo "error!";
}

?>
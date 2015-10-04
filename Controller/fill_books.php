<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/ClientDaoImp.php';
	require_once '../../vendor/autoload.php';
	require_once '../Model/Client.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
}

$bdi = new BookDaoImp ( $entityManager );
if (isset ( $_POST ['action'] )) {
	
	if (strcmp ( trim ( $_POST ['action'] ), 'edit' ) == 0) {
		$book = $bdi->getBookById ( intval ( trim ( $_POST ['id'] ) ) );
		if ($book !== null) {
			$array = array ();
			
			$book->setTitle ( trim ( $_POST ['data'] ['Book Title'] ) );
			$book->setYear ( new DateTime ( trim ( $_POST ['data'] ['Book Year'] ) ) );
			// $book->setImg(trim($_POST['data']['Book Img']));
			$book->setRecap ( trim ( $_POST ['data'] ['About'] ) );
			$book->setPrice ( floatval ( trim ( $_POST ['data'] ['Book Price'] ) ) );
			
			$entityManager->flush ();
			
			$array ['DT_RowId'] = $book->getId ();
			$array ['Book Title'] = $book->getTitle ();
			$array ['Book Year'] = $book->getYear ()->format ( 'd-m-Y' );
			$array ['Book Img'] = $book->getImg ();
			$array ['About'] = $book->getRecap ();
			$array ['Book Price'] = $book->getPrice ();
			
			echo json_encode ( array (
					'row' => $array 
			) );
		}
	} else if (strcmp ( trim ( $_POST ['action'] ), 'create' ) == 0) {
		
		$book = new Book ( trim ( $_POST ['data'] ['Book Title'] ), "", floatval ( trim ( $_POST ['data'] ['Book Price'] ) ) );
		// $book->setImg(trim($_POST['data']['Book Img']));
		$book->setRecap ( trim ( $_POST ['data'] ['About'] ) );
		$book->setYear(new DateTime ( trim ( $_POST ['data'] ['Book Year'] ) ));
		
		$bdi->saveBook ( $book );
		
		$array ['DT_RowId'] = $book->getId ();
		$array ['Book Title'] = $book->getTitle ();
		$array ['Book Year'] = $book->getYear ()->format ( 'd-m-Y' );
		$array ['Book Img'] = $book->getImg ();
		$array ['About'] = $book->getRecap ();
		$array ['Book Price'] = $book->getPrice ();
		
		echo json_encode ( array (
				'row' => $array 
		) );
	}else if(strcmp ( trim ( $_POST ['action'] ), 'remove' ) == 0){
		$ids = $_POST['id'];
		$book = $bdi->getBookById($ids[0]);
		if($book!=null)$bdi->removeBook($book);
		foreach ( $bdi->getAllBooks () as $book ) {
			$array ['DT_RowId'] = $book->getId ();
			$array ['Book Title'] = $book->getTitle ();
			$array ['Book Year'] = $book->getYear ()->format ( 'd-m-Y' );
			$array ['Book Img'] = $book->getImg ();
			$array ['About'] = $book->getRecap ();
			$array ['Book Price'] = $book->getPrice ();
			$final [] = $array;
		}
		echo json_encode ( array (
				'data' => $final
		) );
		
		
	}
} else {
	$array = array ();
	$final = array ();
	
	foreach ( $bdi->getAllBooks () as $book ) {
		$array ['DT_RowId'] = $book->getId ();
		$array ['Book Title'] = $book->getTitle ();
		$array ['Book Year'] = $book->getYear ()->format ( 'd-m-Y' );
		$array ['Book Img'] = $book->getImg ();
		$array ['About'] = $book->getRecap ();
		$array ['Book Price'] = $book->getPrice ();
		$final [] = $array;
	}
	echo json_encode ( array (
			'data' => $final 
	) );
}

?>
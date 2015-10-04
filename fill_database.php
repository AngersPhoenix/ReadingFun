<?php
if (php_sapi_name () == "cli") {
// 	require_once "bootstrap.php";
	require_once 'Model/Client.php';
	require_once 'Model/Order.php';
	require_once 'Model/Book.php';
	require_once 'Model/orderbook.php';
	require_once 'Model/Author.php';
	require_once 'Model/Category.php';
	require_once 'Persistance/BookDaoImp.php';
	require_once 'Persistance/ClientDaoImp.php';
	require_once 'Persistance/OrderDaoImp.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
// 	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
	require_once $root . '/phoenix/Project/Model/Order.php';
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/Model/orderbook.php';
	require_once $root . '/phoenix/Project/Model/Author.php';
	require_once $root . '/phoenix/Project/Model/Category.php';
	require_once $root . '/phoenix/Project/Persistance/BookDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/OrderDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	
	// require_once 'vendor/autoload.php';
}

// function fetchAll($class){

// }

// spl_autoload_register('fetchAll');

// $phoenix = new Client ( 'Phoenix', 22, 'phoneix@gmail.com', 'root', 1);
// $kayzen = new Client ( 'Kayzen', 23, 'Kayzen@gmail.com', 'prr');
// $ord = new Order ( "2015-12-05" );

// $cat = new Category ( 'Programmation' );
// $cat2 = new Category('Developpement');

// $python = new Book ( 'Python', "2012-07-08", 15.3 );
// $python->addCategory ( $cat );
// $python->addCategory ( $cat2 );
// $cat->addBook ( $python );
// $python->addAuthor ( new Author ( 'Phoenix' ) );

// $ord->setClient ( $phoenix );

// $ob = new orderbook ();
// $ob->setQuantity ( 15 );

// $ob->setBook ( $python );
// $ob->setOrder ( $ord );

// $obb = new orderbook ();
// $obb->setQuantity ( 200 );

// $obb->setBook ( $python );
// $obb->setOrder ( $ord );

// $ord->addOrderBook ( $ob );
// $ord->addOrderBook ( $obb );

// // $phoenix->getOrders()[0]->addOrderBook($ob);

// $phoenix->addOrder ( $ord );

// $entityManager->persist ( $phoenix );
// $entityManager->persist ( $kayzen );
// $entityManager->persist ( $python );

// $query = $entityManager->createQuery ( 'SELECT c FROM Client c WHERE c.name=\'Phoenix\'' );
// $users = $query->getResult();

// if ($users != null)
// echo "The name is : ".$users[0]->getName()."\n";

// $test = $entityManager->find("Client", 1);

// echo "The name of test is : ".(con Client)$test->getName()."\n";

// $climp = new clientImp($entityManager);

// $kl = $climp->getClientByEmail('phoneix@gmail.com');

// echo "the new one is here sir : ".$kl->getName();

// $entityManager->flush ();

// $bdi = new BookDaoImp($entityManager);

// foreach($bdi->getAllBooks() as $book)
// {
// echo "Recap: ".$book->getRecap()."\n";
// foreach ($book->getAuthors() as $author)
// echo "Author: ".$author->getName()."\n";
// echo "Price: ".$book->getPrice()."\n";
// // echo "Date: ".$book->getYear()."\n";
// }

// echo "tania\n";

// $bdi1 = new BookDaoImp($entityManager);

// foreach($bdi1->getAllBooks() as $book)
// {
// echo "Recap: ".$book->getRecap()."\n";
// foreach ($book->getAuthors() as $author)
// echo "Author: ".$author->getName()."\n";
// echo "Price: ".$book->getPrice()."\n";
// // echo "Date: ".$book->getYear()."\n";
// }

// $cdi = new ClientDaoImp($entityManager);

// $user = $cdi->getClientById(1);

// echo $user->orders[0]->getId();

// echo $user->getName()."\n";
// echo $user->getId();

// $book0 = new Book ( "WireShark", "1997-12-23", 9.75 );
// $book1 = new Book ( "WireShark", "1997-12-23", 9.75 );
// $book2 = new Book ( "WireShark", "1997-12-23", 9.75 );
// $book3 = new Book ( "WireShark", "1997-12-23", 9.75 );
// $book4 = new Book ( "Python", "1850-12-23", 15.73 );


// $author =  new Author("Wsilliam Anzkle");
// $cat = new Category ( 'Programmation' );

// $cat->addBook($book4);
// $author->addBook($book4);
// $book4->addAuthor($author);
// $book4->addCategory($cat);


// $book0->addAuthor($author);
// $book1->addAuthor($author);
// $book2->addAuthor($author);
// $book3->addAuthor($author);

// $book0->setRecap("Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all levels of Wireshark users. ");
// $book1->setRecap("Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all levels of Wireshark users. ");
// $book2->setRecap("Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all levels of Wireshark users. ");
// $book3->setRecap("Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all levels of Wireshark users. ");
// $book4->setRecap("Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all levels of Wireshark users. ");





// $entityManager->persist ( $book0 );
// $entityManager->persist ( $book1 );
// $entityManager->persist ( $book2 );
// $entityManager->persist ( $book3 );
// $entityManager->persist ( $book5);




// $entityManager->flush ();
// $bdi = new BookDaoImp ( $entityManager );
// $books = $bdi->getAllBooks ();
// $array = array();
// $array[] = $books[0]->getAuthors()[0]->getName();
// $flag = false;
// foreach($books as $book){
// 	if($book->getAuthors()!=null){
// 		foreach ($book->getAuthors() as $author)
// 		{
// 			foreach($array as $cell)
// 				if( strcmp($author->getName(),$cell)==0){$flag=true;break;}
// 			if(!$flag)$array[]=$author->getName();
// 			else $flag=false;
// 		}
// 	}
// }
// foreach($array as $name)
// echo $name."\n";
// $categories [] = $books [0]->getCategories()[0]->getName();
// if(count($books [0]->getCategories())==0) echo "null a l3chir\n";
// echo $books [6]->getCategories()[0]->getName();


// $categories = array ();

// $flag = false;
// foreach($books as $book)
// 	if(count($book->getCategories())!=0) {
// 		foreach($book->getCategories() as $category){
// 			if(count($categories)!=0){
// 			foreach($categories as $search){
// 			if(strcmp($search,$category->getName())==0) {$flag = true;break;}
// 			if(!$flag)$categories[] = $category->getName();
// 			else $flag=true;
// 		}
// 			}else{
// 				$categories[] = $category->getName();
// 			}
// 			}
// 	}
// foreach($categories as $name)
// echo $name."\n";	

// if( (count($books)%6)== 0 )echo "Result1".count($books/6)."\n";
// else echo "Result2".(round(count($books)/6)+1)."\n";

// function getNumberBooks($page,$size){
// 	$a = round($size/6);
// 	$b = $size%6;
// 	if($b==0)return 6;
// 	else if($page ==($a+1))return $b;
// 	else return 6;
// }


// echo "Pages: ".getNumberBooks(2, count($books));
// $book = $bdi->getBookById(8);

$cdi = new ClientDaoImp($entityManager);
$client = $cdi->getClientById(3);

// $order = new Order('12/02/2001');
// $ob = new orderbook();
// $ob->setBook($book);
// $ob->setQuantity(2);
// $ob->setOrder($order);
// $order->addOrderBook($ob);
// $order->setClient($client);
// $client->addOrder($order);

// $entityManager->persist($order);
// $entityManager->flush();
// echo $client->getOrders()[0]->getOrderBook()[0]->getBook()->getTitle();

// echo "number: ".count($client->getOrders()[0]->getOrderBook());

// foreach($client->getOrders() as $order)
// 	if(!$order->getValid())
// 		foreach($order->getOrderBook() as $orderbook)
// 			echo $orderbook->getBook()->getTitle();
// 	else echo "true";
	
// echo count($client->getOrders()[1]->getOrderBook());
$order = new OrderDaoImp($entityManager);
$orders = $order->getOrdersByClient($client);

echo $orders[1]->getOrderBook()[0]->getQuantity()."\n";






?>
<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../Frameworks/PHPMailer-master/PHPMailerAutoload.php';
	require_once '../Model/Client.php';
	require_once '../bootstrap.php';
	require_once '../Persistance/ClientDaoImp.php';
	require_once '../Persistance/ClientDao.php';
	require_once '../Persistance/Dao.php';
	require_once '../vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Frameworks/PHPMailer-master/PHPMailerAutoload.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDao.php';
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

if (isset ( $_POST ['action'] )) {
	
	if (strcmp ( $_POST ['action'], 'register' ) == 0) {
		if (isset ( $_POST ['name'] ) && isset ( $_POST ['age'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['password'] )) {
			
			$name = trim ( $_POST ['name'] );
			$age = trim ( $_POST ['age'] );
			$email = trim ( $_POST ['email'] );
			$password = trim ( $_POST ['password'] );
			// registration code:
			$random = rand ( 10, 100000 );
			$client = new Client ( trim ( $_POST ['name'] ), intval ( trim ( $_POST ['age'] ) ), $email = trim ( $_POST ['email'] ), $password = trim ( $_POST ['password'] ), $random );
			$entityManager->persist ( $client );
			
			// sending email using PHPMailer library from localhost:
			$mail = new PHPMailer ();
			$mail->isSMTP ();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'readingfun.masterweb@gmail.com';
			$mail->Password = 'readingfun';
			$mail->SMTPSecure = 'tls';
			$mail->From = 'readingfun.masterweb@gmail.com';
			$mail->FromName = 'Webmaster';
			$mail->addAddress ( $email, $name );
			$mail->addReplyTo ( 'readingfun.masterweb@gmail.com', 'ReadingFun' );
			$mail->WordWrap = 50;
			$mail->Port = 587;
			$mail->isHTML ( true );
			$mail->Subject = 'ReadingFun Registration';
			$mail->Body = 'We\'re so excited you joined us. Now see what\'s next.' . "\r\n" . 'this is the registration code for your account : <b>' . $random . '</b>' . "\r\n" . 'Please respond the fastest possible';
			
			if (! $mail->send ()) {
// 				echo 'Message could not be sent.';
// 				echo 'Mailer Error: ' . $mail->ErrorInfo;
// 				echo 'no-msg';
				exit ();
			}
// 			echo ' Message has been sent';
			$entityManager->flush ();
			echo 'yes';
		} else
			echo "no";
	} else if (strcmp ( $_POST ['action'], "confirm" ) == 0) {
		if (isset ( $_POST ['email'] ) && isset ( $_POST ['password'] )) {
			$email = $_POST ['email'];
			$rc = $_POST ['password'];
			$cdi = new ClientDaoImp ( $entityManager );
			$tmp = $cdi->getClientByEmail ( $email );
			
			if ($tmp->getLevel () == intval ( $rc )) {
				$tmp->setLevel ( 0 );
// 				$cdi->updateClient ( $tmp );
				$entityManager->flush ();
				
				session_start ();
// 				$client = new Client ( $tmp->getName (), $tmp->getAge (), $tmp->getEmail (), $tmp->getPassword (), $tmp->getLevel () );
// 				$client->setId($tmp->getId());
				$_SESSION ['client'] = $tmp;
				
				echo json_encode ( array (
						'success' => true 
				) );
				// echo json_encode ( array (
				// 'success' => true,
				// 'name' => $tmp->getName (),
				// 'age' => $tmp->getAge (),
				// 'email' => $tmp->getEmail (),
				// 'password' => $tmp->getPassword (),
				// 'level' => $tmp->getLevel ()
				// ) );
			} else
				echo json_encode ( array (
						'success' => false 
				) );
		}
	} else if (strcmp ( $_POST ['action'], 'login' ) == 0) {
		
		$email = $_POST ['email'];
		$password = $_POST ['password'];
		$cdi = new ClientDaoImp ( $entityManager );
		$client = $cdi->getClientByEmail ( $email );
		if ($client == null)
			echo json_encode ( array (
					'flag' => 'EMAIL_NULL' 
			) );
		else {
			if (strcmp ( $client->getPassword (), md5 ( $password ) ) == 0) {
				session_start ();
				$_SESSION ['client'] = $client;
				echo json_encode ( array (
						'flag' => 'PASSWD_OK',
						'name' => $client->getName (),
						'orders'=>$client->getNumberOrders(),
						'level'=>$client->getLevel()
				) );
			} else
				echo json_encode ( array (
						'flag' => 'PASSWD_NULL' 
				) );
		}
	} else if (strcmp ( $_POST ['action'], 'logout' ) == 0) {
		try {
			session_start ();
			$_SESSION = array ();
			session_destroy ();
			echo json_encode ( array (
					'flag' => 'yes' 
			) );
		} catch ( Exception $ex ) {
			echo json_encode ( array (
					'flag' => "control_registration(page): " . $ex->getTrace () 
			) );
		}
	}
}
?>






<?php
// create_product.php
require_once "bootstrap.php";
require_once 'src/product.php';
require_once 'src/client.php';

// $newProductName = $argv[1];

$product0 = new Product();
$product1 = new Product();
$product2 = new Product();

$product0->setName($argv[1]);
$product1->setName($argv[2]);
$product2->setName($argv[3]);

$client0 = new Client();
$client1 = new Client();
$client2 = new Client();

$client0->setName("Phoenix");
$client1->setName("Kayzen");
$client2->setName("SuperNova");

$client0->setAge(23);
$client1->setAge(21);
$client2->setAge(25);

$client0->products[] = $product0;
$client0->products[] = $product1;
$client0->products[] = $product2;

// $client0->add($product0);
// $client0->add($product1);
// $client0->add($product2);

$client0->products[] = $product0;
$client0->products[] = $product1;
$client0->products[] = $product2;

// $product0->add($client0);
// $product0->add($client1);
// $product0->add($client2);

$entityManager->persist($product0);
$entityManager->persist($client0);

$entityManager->flush();

// echo "Created Product with ID " . $product->getId() . "\n";
// echo "Created Client with ID " . $client->getId() . "\n";

?>
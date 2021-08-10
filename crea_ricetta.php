<?php

$data_ricetta = [
  'name' => $_POST['nome'],
  'ingradients' => $_POST['ingradienti'],
  'description' => $_POST['descrizione'],
  'author' => $_POST['autore'],
];

echo '<hr>';
var_dump($data_ricetta);

$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'prova_php';
$mysqli = new mysqli($host, $user, $password, $database);

$mysqli->query("INSERT INTO `ricette` (`id`, `name`, `ingradients`, `description`, `author`)
VALUES (NULL, '{$data_ricetta['name']}', '{$data_ricetta['ingradients']}', '{$data_ricetta['description']}', '{$data_ricetta['author']}')");

header('Location: ricette.php');

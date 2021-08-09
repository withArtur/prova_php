<?php

/**
 * Restituisce tutti i dati di tutti i campi dal database per al tabella passata come valore del parametro
 * 
 * @param $tabella Nome tabella da cui selezionare
 * 
 * @return array Dati dal database
 */
function getDataFromDb($tabella) {
	$host = '127.0.0.1';
	$user = 'root';
	$password = '';
	$database = 'prova_php';
	$mysqli = new mysqli($host, $user, $password, $database);
	
	$result = $mysqli->query("SELECT * FROM `{$tabella}`");
	$vettore = $result->fetch_all(MYSQLI_ASSOC);
	
	return $vettore;
}



//$result = $mysqli->query('SELECT * FROM `ricette`');
//$vettore = $result->fetch_all(MYSQLI_ASSOC);
$vettore = getDataFromDb('ricette');
//$vettore = (object) $result->fetch_all(MYSQLI_ASSOC); // array -> typ hinting -> object



$menu = getDataFromDb('menu');

//echo '<pre>';
//var_dump($menu);
//echo '</pre>';
//exit;


// foreach - per i dati che arrivano dal database e che vanno iterati finche contengono elementi array/oggetti 

// POST - corpo della richiesta (tanta roba)
// GET - tramite url
if (isset($_POST['nome'])) {
	$dato = $_POST['nome'];
} else {
	$dato = 'nessun dato';
}

$titolo_pagina = 'Le nostre ricette - '. count($vettore); // stringa
?>


<!doctype>
<html>
<head>

<title><?php echo $titolo_pagina; ?></title>
<meta type="description" content="Descrizione del sito" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
	
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<?php foreach($menu as $item): ?>	
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $item['slug']; ?>"><?php echo $item['nome']; ?></a>
        </li>
		<?php endforeach; ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<section class="container">
<h1><?php echo $titolo_pagina; ?></h1>


<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="list-group">
			<?php foreach($vettore as $ricetta): ?>	
				
			  <a href="#" class="list-group-item list-group-item-action" aria-current="true">
				<div class="d-flex w-100 justify-content-between">
				  <h5 class="mb-1"><?php echo $ricetta['name']; ?></h5>
				  <small><?php echo $ricetta['author']; ?></small>
				</div>
				<p class="mb-1"><?php echo $ricetta['description']; ?></p>
				<small><?php echo $ricetta['ingradients']; ?></small>
			  </a>
				
			<?php endforeach; ?>
		</div>
	</div>
</div>

<form method="POST" class="form-inline">
	<input type="text" name="nome" class="form-control" />
	<input type="text" name="password" class="form-control"/>
	<input type="text" name="cognome" class="form-control"/>

	<button>Invia</button>
</form>

</div>
</body>
</html>
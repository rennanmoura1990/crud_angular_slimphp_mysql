<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');
//===============================================================
$app->get('/Consoles', 'getConsoles');
$app->get('/Consoles/:id', 'getConsole');
$app->post('/Add_Consoles', 'addConsole');
$app->put('/Consoles/:id', 'updateConsole');
$app->delete('/Consoles/:id', 'deleteConsole');
//===============================================================
$app->get('/Jogos', 'getJogos');
$app->get('/Jogos/:id', 'getJogo');
$app->post('/Add_Jogos', 'addJogo');
$app->put('/Jogos/:id', 'updateJogo');
$app->delete('/Jogos/:id', 'deleteJogo');
$app->get('/Jogando','jogandoJogo');
$app->get('/Jogados','jogadoJogo');
$app->get('/aJogar','ajogarJogo');
//===============================================================
$app->run();

function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="";
	$dbname="vgs";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

//Lista todos Consoles
function getConsoles(){
	$sql = "select id,nome,fabricante from consoles";
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
// Pega Consoles por ID
function getConsole($id){
	$sql = "select id,nome,fabricante from consoles WHERE id=".$id;
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
//Adiciona Consoles
function addConsole() {
	$request = \Slim\Slim::getInstance()->request();
	$cons = json_decode($request->getBody());
	$sql = "INSERT INTO consoles (nome,fabricante) VALUES (:nome, :fabricante)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nome", $cons->nome);
		$stmt->bindParam("fabricante", $cons->fabricante);
		$stmt->execute();
		$cons->id = $db->lastInsertId();
		$db = null;
		echo json_encode($cons); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//Altera Consoles
function updateConsole($id){
	$request = \Slim\Slim::getInstance()->request();
	$cons = json_decode($request->getBody());
	$sql = "UPDATE consoles SET nome=:nome, fabricante=:fabricante WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nome", $cons->nome);
		$stmt->bindParam("fabricante", $cons->fabricante);
		$stmt->bindParam("id",$id);
		$stmt->execute();
		$db = null;
		echo json_encode($cons); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//Deleta Consoles
function deleteConsole($id) {
	$sql = "DELETE FROM consoles WHERE id=".$id;
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//Lista todos Jogos
function getJogos(){
	$sql = "select id,nome,status,console from jogos";
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
// Pega Jogos por ID
function getJogo($id){
	$sql = "select id,nome,status,console from jogos WHERE id=".$id;
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
//Adiciona Jogos
function addJogo() {
	$request = \Slim\Slim::getInstance()->request();
	$jogo = json_decode($request->getBody());
	$sql = "INSERT INTO jogos (nome,status,console) VALUES (:nome, :status ,:console)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nome", $jogo->nome);
		$stmt->bindParam("status", $jogo->status);
		$stmt->bindParam("console", $jogo->console);
		$stmt->execute();
		$jogo->id = $db->lastInsertId();
		$db = null;
		echo json_encode($jogo); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//Altera Jogos
function updateJogo($id) {
	$request = \Slim\Slim::getInstance()->request();
	$jogo = json_decode($request->getBody());
	$sql = "UPDATE jogos SET Nome =:nome, Status =:status, Console =:console WHERE id = :id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nome", $jogo->nome);
		$stmt->bindParam("status", $jogo->status);
		$stmt->bindParam("console", $jogo->console);
		$stmt->bindParam("id",$id);
		$stmt->execute();
		$db = null;
		echo json_encode($jogo); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//Deleta Jogo
function deleteJogo($id) {
	$sql = "DELETE FROM jogos WHERE id=".$id;
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//===========================================Status de Jogos=================================================
function jogandoJogo(){
	$sql = "select jogos.nome,status.nome as status,consoles.nome as console from jogos inner join status on jogos.status = status.id inner join consoles on jogos.console = consoles.id where status.id = 1";
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
function jogadoJogo(){
	$sql = "select jogos.nome,status.nome as status,consoles.nome as console from jogos inner join status on jogos.status = status.id inner join consoles on jogos.console = consoles.id where status.id = 2";
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
function ajogarJogo(){
	$sql = "select jogos.nome,status.nome as status,consoles.nome as console from jogos inner join status on jogos.status = status.id inner join consoles on jogos.console = consoles.id where status.id = 3";
	try{
		$db = getConnection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list); 
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	    }
}
//=================================THE END===================================================================
?>
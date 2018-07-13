<?php
/**
 * Bulk Mailer
 *
 * @author  Peter Ramokone
 * @package DB
 */
class XCustomDB extends PDO
{
	
	public function updateRecord($table, $data, $wh){
		
	}
	
	public function deleteRecord(){
	
	}
	
	public function getRecord($table){
	
	}
	
	
	public function getRecords(){
	
	}
}
	
	
	
	
	

/*

$db = new MyPDO();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$t1 = isset($_GET["t1"])?$_GET["t1"]:1; // need to be securised for injonction
$t2 = isset($_GET["t2"])?$_GET["t2"]:2; // need to be securised for injonction
$t3 = isset($_GET["t3"])?$_GET["t3"]:3; // need to be securised for injonction

$ret = $db->query("SELECT * FROM table_test WHERE t1=? AND t2=? AND t3=?",$t1,$t2,$t3);
//$ret = $db->insecureQuery("SELECT * FROM table_test WHERE t1=".$db->quote($t1));

while ($o = $ret->fetch())
{
	echo $o->nom.PHP_EOL;
}

	
	
	
	
	
	
	
	// PDO, prepared statement
	$pdo->prepare('SELECT * FROM users WHERE username = :username');
	$pdo->execute(array(':username' => $_GET['username']));
	
	*/
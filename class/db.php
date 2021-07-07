<?php
class Db
{
	public function connect()
	{
		// on test la presence d'erreurs
		$user = 'root';
		$password = '';
		try
		{   // on établie la connexion à la bdd colyseum
			$db = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}
		return $db;
	}
}

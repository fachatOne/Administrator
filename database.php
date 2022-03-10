<?php
/**
 * Information about your purpose application
 */
	class Connect{
	    public function DBConnect(){
			$dbhost = 'localhost';	// host default 'localhost' atau 127.0.0.1
			$dbuser = 'root'; 		// user default 'root'
			$dbpass = '';   		// password server
			$dbname = 'fachatmauPortofolio'; 	// your database

			try {
				$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
				$dbConnection->exec("set names utf8");
				$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return  $dbConnection;
			}
			catch (PDOException $e) {
				return 'Connection failed: ' . $e->getMessage();
			}
	    }
	}

?>

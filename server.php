<?php
	require_once('nusoap/lib/nusoap.php');
	require_once('adodb/adodb/adodb.inc.php');
	$server = new nusoap_server;
	$server->configureWSDL('server', 'urn:server');
	$server->wsdl->schemaTargetNamespace = 'urn:server';
	
	$server->register('login_ws', array('username' => 'xsd:string', 'password'=>'xsd:string'), array('return' => 'xsd: string'), 'urn:server', 'urn:server#LoginServer', 'rpc', 'encoded', 'login');
	
	function login_ws($username, $password) {
		$password = md5($password);
		$db = newADOConnection('mysql');
		$db -> Connect('localhost', 'root', '', 'data_mahasiswa');
		
		$sql = $db -> Execute("SELECT * FROM user where username='$username' AND password='$password'");
		
		if ($sql->RecordCount() >= 1)
		{
			return "Login Berhasil";
		} else {
				return "Login gagal";
		}
	}

		$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
		$server->service($HTTP_RAW_POST_DATA);
?>
<?php
	/*
	 * Funncions d'accés a LDAP 
	 *
	 * @autor: Artur Juvé
	 * created on 2015/03/27
	 * updated on 2020/12/15
	 */
	
	/*
	 * Connecta a un servidor ldap
	 *
	 * @param $host Cadena de connexió => "ldap://192.168.56.101"
	 * @param $port Port de la connexió amb el servidor. Per defecte és el 389 (ldap). Utilitzar el port 636 per ldaps.
	 * @return $conn Enllaç de connexió amb el servidor
	 */
	function connectar($host, $port=389){

		error_reporting(0);		
		$conn = ldap_connect($host,$port) or die("Could not connect!");         
		ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3) or die("Could not set ldap protocol");
		ldap_set_option($conn, LDAP_OPT_REFERRALS, 0) or die("Could not set ldap protocol");        
		return $conn;
	}

	/*
	 * Valida un usuari del servidor ldap
	 *
	 * @param $conn Enllaç de connexió amb el servidor
	 * @param $dnuser Nom distringit de l'usuari. Per exemple, "cn=admin,dc=ncognom,dc=net"
	 * @param $pass Password de l'usuari
	 * @return bool Retorna cert en cas de validar i fals en cas de no validar
	 */
	function validar($conn, $dnuser,$pass){
		if ($bd = ldap_bind($conn, $dnuser, $pass) ) return true;
		return false;
	}
	
	/*
	 * Consulta a una basa de dades ldap
	 *
	 * @param $conn Enllaç de connexió amb el servidor
	 * @param $basedn Nom distringit de l'usuari. Per exemple, "cn=admin,dc=ncognom,dc=net"
	 * @param $filter Filtre de la consulta. Per exemple, "cn=*"
	 * @param $attr arry Filtre de la consulta. Per exemple, ["uid","mail","sn"]. En cas d'estar buit retorna tots els atributs.
	 * @return $res Retorna el resultat de la consulta en forma d'array
	 */	
	function query($conn, $basedn, $filter, $attr=[]){
		$sr = ldap_list($conn, $basedn, $filter,$attr);
		$res = ldap_get_entries($conn, $sr);
		return $res;
	}

?>




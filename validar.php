<?php

include "ldaplib.php";

$conn = connectar("192.168.1.54");

if(validar($conn,"cn=admin,dc=ajuve,dc=edu","12345"))
	echo "Usuari vàlid";
else
	echo "Usuari no vàlid";

?>

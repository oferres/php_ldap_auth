<?php

include "ldaplib.php";

$conn = connectar("192.168.1.54");

?>

<!DOCTYPE>
<html>
<head>
<title></title>
</head>
<body>

	<form action="#" method="get">
		<select name="usuari">			
			<?php
				$info = query($conn, "ou=users,dc=ajuve,dc=edu", "cn=*", ["uid"]);
				
				
				for ($i=0; $i < $info[count]; $i++) { 
					$uid = $info[$i]["uid"][0]; 
					echo "<option value='" . $uid . "'>" . $uid . "</option>";
				}				
			?>
			<input type="submit" value="Mostar"/>
		</select>
		
		<p>
			<?php
				if($_GET["usuari"]){
						$usuari = query($conn, "ou=users,dc=ajuve,dc=edu","uid=" . $_GET['usuari'],["uid","sn","mail"]);
						
						echo "<ul>";
						echo "<li> uid = " . $usuari[0]["uid"][0]  . "</li>";
						echo "<li> sn = " . $usuari[0]["sn"][0]  . "</li>";
						echo "<li> mail = " . $usuari[0]["mail"][0]  . "</li>";
						echo "</ul>";
					
				}
				
			?>
		<p>
		
	</form>


</body>	
</html>

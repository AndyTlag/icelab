<?php

if(isset($_SESSION['success-cad-prod'])){
	echo $_SESSION['success-cad-prod'];
	unset($_SESSION['success-cad-prod']);
}

if(isset($_SESSION['danger-cad-prod'])){
	echo $_SESSION['danger-cad-prod'];
	unset($_SESSION['danger-cad-prod']);
}




if(isset($_SESSION['success-del-prod'])){
	echo $_SESSION['success-del-prod'];
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
	unset($_SESSION['success-del-prod']);
}

if(isset($_SESSION['danger-del-prod'])){
	echo $_SESSION['danger-del-prod'];
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
	unset($_SESSION['danger-del-prod']);
}



if(isset($_SESSION['success-upd-prod'])){
	echo $_SESSION['success-upd-prod'];
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
	unset($_SESSION['success-upd-prod']);
}

if(isset($_SESSION['danger-upd-prod'])){
	echo $_SESSION['danger-upd-prod'];
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
	unset($_SESSION['danger-upd-prod']);
}


?>
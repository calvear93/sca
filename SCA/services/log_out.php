<?php
	setcookie( 'session_type', '', time(), '/' );
    header ("Location: ../views/sign_in.php");
	exit;
?>
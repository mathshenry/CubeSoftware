<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: contclass.php"); // Redirecting To Home Page
}
?>

<?php

if (session_status() === PHP_SESSION_NONE)
	session_start();

if (empty(Session::get("username")))
	echo "<script>window.location = '/login';</script>";

?>
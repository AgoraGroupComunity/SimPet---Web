<?php
	if (session_status() === PHP_SESSION_NONE)
		session_start();

	if (empty(Session::get("username")))
	{
		if (!isset($_GET["nologin"]) || (isset($_GET["nologin"]) && ($_GET["nologin"] !== "true")))
		{
			Session::flush();

			echo "<script>window.location = '/login';</script>";
		}
	}
	else
	{
		if (isset($_GET["nologin"]) && ($_GET["nologin"] === "true"))
		{
			Session::flush();

			echo "<script>window.location = '/?nologin=true';</script>";
		}
	}
?>
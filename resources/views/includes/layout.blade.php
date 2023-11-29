@section("session-type")
@show

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{csrf_token()}}">
		<title>@yield("page-title")</title>
		<link rel="icon" href="/favicon.ico" type="image/x-icon">

		<!-- CSS Styles -->
		<link rel="stylesheet" href="/css/commons.css">
		<link rel="stylesheet" href="/css/aimessage.css">
		<link rel="stylesheet" href="/css/aboutus.css">
		<link rel="stylesheet" href="/css/cart.css">
		<link rel="stylesheet" href="/css/catalog-details.css">
		<link rel="stylesheet" href="/css/catalogs.css">
		<link rel="stylesheet" href="/css/footer.css">
		<link rel="stylesheet" href="/css/home.css">
		<link rel="stylesheet" href="/css/login.css">
		<link rel="stylesheet" href="/css/manual.css">
		<link rel="stylesheet" href="/css/monitor.css">
		<link rel="stylesheet" href="/css/navigation-bar.css">
		<link rel="stylesheet" href="/css/payment.css">
		<link rel="stylesheet" href="/css/profile.css">
		<link rel="stylesheet" href="/css/recommendation.css">

		<!-- Box Icons -->
		<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	</head>
	
	<body>
		@section("page-contents")
			<p>Tidak ada konten yang tersedia.</p>
		@show

		@section("page-footer")
		@show

		<script type="text/javascript" src="/js/externals/vanilla-tilt.js"></script>
		<?php include public_path("/js/script.js.php"); ?>
	</body>
</html>
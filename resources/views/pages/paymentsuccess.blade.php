@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Pembayaran Sukes | SimPet")

@section("page-contents")

	<section class="payment-success">
		<div class="contents">
			<img src="/graphics/animations/success.gif" alt="icon_success">
			<h1>Pembayaran Diproses</h1>
		</div>
	</section>

	<script>
		$(document).ready(function()
		{
			function redirectToHomePage()
			{
				window.location.href = "/";
			}

			setTimeout(redirectToHomePage, 5000);
		});
	</script>

@endsection
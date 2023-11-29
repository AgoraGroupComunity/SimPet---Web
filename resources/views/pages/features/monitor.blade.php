@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Monitoring Kandang | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="monitor">
		<div class="contents">
			<img src='/graphics/icons/icon_logo.png' alt='icon_logo'>
			<h2>Maaf, fitur yang Anda cari akan segera hadir</h2>
		</div>
	</section>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
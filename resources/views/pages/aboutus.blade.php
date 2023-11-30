@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start_nologin")
@endsection

@section("page-title", "Tentang Kami Agora-Group | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="aboutus">
		<div class="contents">
			<div class="agora">
				<div class="icon">
					<img src="/graphics/icons/icon_logo_agora.png" alt="icon_logo_agora">
				</div>
				<div class="descriptions">
					<h5>Siapa Kami?</h5>
					<h1>Agora</h1>
					<p>Agora Group adalah nama dari kelompok kami, yang merupakan singkatan dari Aplikasi Goresan Anak Muda. Kami adalah sebuah kelompok yang berisi mahasiswa-mahasiswa yang gemar mengembangkan aplikasi-aplikasi dengan menggunakan teknologi VR dan AI. Kami berdiri sejak tahun 2023, dengan misi untuk menciptakan aplikasi-aplikasi yang dapat mengatasi masalah-masalah sosial, lingkungan, dan ekonomi di dunia nyata, serta memberikan hiburan dan edukasi bagi pengguna.</p>
				</div>
			</div>

			<div class="members">
				<h2>Tim Kami</h2>
				<div class="container">
					<div class="item" title="Fadly Kurniawan">
						<img src="/graphics/members/member_fadly.png" alt="member_fadly">
						<h5>Fadly Kurniawan</h5>
						<span>J0403221007</span>
					</div>
					<div class="item" title="Fauzi Adi Saputra">
						<img src="/graphics/members/member_fauzi.png" alt="member_fauzi">
						<h5>Fauzi Adi Saputra</h5>
						<span>J0403221107</span>
					</div>
					<div class="item" title="Fatih Kawakib Kartono">
						<img src="/graphics/members/member_fatih.png" alt="member_fatih">
						<h5>Fatih Kawakib Kartono</h5>
						<span>J0403221073</span>
					</div>
					<div class="item" title="Jonser Steven Rajali M.">
						<img src="/graphics/members/member_jonser.png" alt="member_jonser">
						<h5>Jonser Steven Rajali M.</h5>
						<span>J0403221163</span>
					</div>
					<div class="item" title="Rayhan Ananda Hafiz P.">
						<img src="/graphics/members/member_rayhan.png" alt="member_rayhan">
						<h5>Rayhan Ananda Hafiz P.</h5>
						<span>J0403221010</span>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
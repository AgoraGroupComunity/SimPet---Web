@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start_nologin")
@endsection

@section("page-title", "Tentang Kami Agora-Group | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section id="home">
		<div class="home-left">
			<img src="/graphics/icons/icon_logo_agora.png" alt="icon_logo_agora">
		</div>
		<div class="home-right">
			<a href="" class="btn"> Siapa kami?</a>
			<h2 class="home-heading"> Agora </h2>
			<p class="home-para">Agora Group adalah nama dari kelompok kami, yang merupakan singkatan dari Aplikasi Goresan Anak Muda. Kami adalah sebuah kelompok yang berisi mahasiswa-mahasiswa yang gemar mengembangkan aplikasi-aplikasi dengan menggunakan teknologi VR dan AI. Kami berdiri sejak tahun 2023, dengan misi untuk menciptakan aplikasi-aplikasi yang dapat mengatasi masalah-masalah sosial, lingkungan, dan ekonomi di dunia nyata, serta memberikan hiburan dan edukasi bagi pengguna.</p>
		</div>
	</section>
	<section id="our-Team">
		<h2>Our Member</h2>
		<div class="teamContainer">
			<div class="team-item">
				<img src="graphics/members/member_not_found.png" alt="members_fadly">
				<h5 class="member-name">Fadly Kurniawan</h5>
				<span class="role">J0403221007</span>
			</div>
			<div class="team-item">
				<img src="graphics/members/member_not_found.png" alt="members_fauzi">
				<h5 class="member-name">Fauzi Adi Saputra</h5>
				<span class="role">J0403221107</span>
			</div>
			<div class="team-item">
				<img src="graphics/members/member_not_found.png" alt="members_fatih">
				<h5 class="member-name">Fatih Kawakib Kartono</h5>
				<span class="role">J0403221073</span>
			</div>
			<div class="team-item">
				<img src="graphics/members/member_not_found.png" alt="members_jonser">
				<h5 class="member-name">Jonser Steven Rajali M.</h5>
				<span class="role">J0403221163</span>
			</div>
			<div class="team-item">
				<img src="graphics/members/member_not_found.png" alt="members_rayhan">
				<h5 class="member-name">Rayhan Ananda Hafidz P.</h5>
				<span class="role">J0403221010</span>
			</div>
		</div>
	</section>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
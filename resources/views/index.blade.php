@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start_nologin")
@endsection

@section("page-title", "SimPet | Situs Simulasi Peternakan")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="home" id="home">
		<div class="contents">
			<div class="lolipop">
				<div class="head"></div>
				<div class="stick"></div>
			</div>

			<div class="text">
				<h1>Halo,
					<?php

					if (empty(Session::get("username")))
						echo "Pengguna!";
					else
						echo Session::get("username") . "!";
					
					?>
				<br>Aku adalah <img src="/graphics/logo - transparent.png" alt="simpet_logo" title="SimPet"></h1>
				<button title="Apa itu SimPet?" onclick="window.location.href='#about'">Apa itu SimPet?</button>
			</div>
		</div>
	</section>

	<section class="about" id="about">
		<div class="contents">
			<h1>Tentang SimPet</h1>
			<p>
				SimPet (Simulasi Peternakan) adalah website yang dapat membantu mengembangkan usaha peternakan yang sedang Anda kerjakan. Tak hanya itu, kami sangat bersedia untuk membantu bagi Anda yang baru saja atau ingin memulai bisnis pada bidang ini. Secara garis besar, website kami bekerja dengan menggunakan sistem dasar “Machine Learning” yang dipadukan dengan algorima-algoritma tertentu, data-data yang valid, dan menjalin kerja sama dengan ahli peternakan yang membuat data hasil akhir siap untuk Anda gunakan.
			</p>
		</div>
	</section>

	<section class="features" id="features">
		<div class="contents">
			<h1>Fitur</h1>

			<div class="row">
				<div class="col">
					<div class="card card-features" title="Ayo buat dan akan kami berikan rekomendasi terbaik untuk kebutuhan Anda" onclick="window.location.href = '/recommendation'">
						<div class="icon">
							<img src="/graphics/icons/icon_recommendations.png" alt="icon_recommendations">
						</div>
						<div class="descriptions">
							<h2>AyoBuat</h2>
							<p>Hanya membutuhkan sedikit data dan kami bantu hitung agar mendapatkan hasil yang terbaik untuk Anda.</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card card-features" title="Ayo cek dan seberapa jauh yang dapat Anda capai" onclick="window.location.href = '/manual'">
						<div class="icon">
							<img src="/graphics/icons/icon_pen.png" alt="icon_pen">
						</div>
						<div class="descriptions">
							<h2>AyoCek</h2>
							<p>Kami membutuhkan lebih banyak data dari Anda agar kami bisa memproses dan mendapatkan hasil yang lebih optimal.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="card card-features" title="Pantau hewan ternak Anda" onclick="window.location.href = '/monitor'">
						<div class="icon">
							<img src="/graphics/icons/icon_data.png" alt="icon_data">
						</div>
						<div class="descriptions">
							<h2>KandangKu</h2>
							<p>Pantau hewan ternak di kandang dengan mudah dengan akses kapanpun dan dimanapun Anda berada secara <span class="italic">real-time</span>.</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card card-features" title="Ayo tanyakan seputar ternak kepada ahli" onclick="window.location.href = '/aimessage'">
						<div class="icon">
							<img src="/graphics/icons/icon_messages.png" alt="icon_messages">
						</div>
						<div class="descriptions">
							<h2>Tanya Ternak</h2>
							<p>Tanyakan segala pertanyaan Anda seputar hewan ternak dengan AI <span class="italic">(Artificial Intelligence)</span>.</p>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="articles" id="articles">
		<div class="contents">
			<div class="card">
				<div class="descriptions">
					<div class="icon-addon">
						<img src="https://images.bisnis.com/posts/2023/10/20/1706322/WhatsApp_Image_2023-10-20_at_15.50.07.jpeg" alt="Ilustrasi inseminasi ternak./Pemkab OKI" title="Ilustrasi inseminasi ternak./Pemkab OKI [ Sumber: sumatra.bisnis.com ]">
					</div>
					<h2>Tingkatkan Kualitas Bibit Ternak Sapi, OKI Dorong Transfer Embrio</h2>
					<p>Kepala Dinas Perkebunan dan Peternakan Kabupaten OKI, Dedy Kurniawan menjelaskan TE merupakan metode dalam bidang bioteknologi reproduksi dengan memasukkan embrio pada alat reproduksi ternak betina resepien menggunakan alat tertentu untuk mendapatkan anakkan yang berkualitas....</p>
					
					<a href="https://sumatra.bisnis.com/read/20231020/533/1706322/tingkatkan-kualitas-bibit-ternak-sapi-oki-dorong-transfer-embrio" title="Baca selengkapnya di sumatra.bisnis.com" target="_blank">Baca Selengkapnya</a>
				</div>
				<div class="icon">
					<img src="https://images.bisnis.com/posts/2023/10/20/1706322/WhatsApp_Image_2023-10-20_at_15.50.07.jpeg" alt="Ilustrasi inseminasi ternak./Pemkab OKI" title="Ilustrasi inseminasi ternak./Pemkab OKI [ Sumber: sumatra.bisnis.com ]">
				</div>
			</div>
			
			<div class="card">
				<div class="descriptions">
					<div class="icon-addon">
						<img src="https://akcdn.detik.net.id/community/media/visual/2023/09/22/menteri-pertanian-syahrul-yasin-limpo-bersama-pj-gubernur-jateng-nana-sudjana-melihat-hasil-peternakan-dalam-puncak-peringatan-1_169.jpeg?w=700&q=90" alt="Ilustrasi inseminasi ternak./Pemkab OKI" title="Menteri Pertanian Syahrul Yasin Limpo bersama Pj Gubernur Jateng Nana Sudjana melihat hasil peternakan dalam puncak peringatan Bulan Bakti Peternak dan Kesehatan Hewan ke-187 di Boyolali, Jumat (22/9/2023). [ Sumber: detik.com ]">
					</div>
					<h2>Mentan Syahrul Dorong Peternak Serap Kredit Usaha Rakyat</h2>
					<p>Menteri Pertanian (Mentan) Syahrul Yasin Limpo mengajak para peternak Indonesia untuk memperkuat hilirisasi pangan asal ternak sebagai kekuatan utama masa depan bangsa. Peternakan tak hanya untuk makan saja, tetapi sekaligus menjadi lapangan kerja.......</p>
					
					<a href="https://www.detik.com/jateng/bisnis/d-6945793/mentan-syahrul-dorong-peternak-serap-kredit-usaha-rakyat" title="Baca selengkapnya di detik.com" target="_blank">Baca Selengkapnya</a>
				</div>
				<div class="icon">
					<img src="https://akcdn.detik.net.id/community/media/visual/2023/09/22/menteri-pertanian-syahrul-yasin-limpo-bersama-pj-gubernur-jateng-nana-sudjana-melihat-hasil-peternakan-dalam-puncak-peringatan-1_169.jpeg?w=700&q=90" alt="Ilustrasi inseminasi ternak./Pemkab OKI" title="Menteri Pertanian Syahrul Yasin Limpo bersama Pj Gubernur Jateng Nana Sudjana melihat hasil peternakan dalam puncak peringatan Bulan Bakti Peternak dan Kesehatan Hewan ke-187 di Boyolali, Jumat (22/9/2023). [ Sumber: detik.com ]">
				</div>
			</div>
		</div>
	</section>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
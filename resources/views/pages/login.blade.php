@extends("includes.layout")

<?php

if (session_status() === PHP_SESSION_NONE)
	session_start();
else
	Session::flush();

if (isset($_GET["userexists"]) && $_GET["userexists"] === "true")
{
	echo "<script>alert('Username telah dipakai!\\nGunakan username lain untuk melanjutkan proses registrasi.'); window.location = '/login';</script>";
}
else if (isset($_GET["baduserdata"]) && $_GET["baduserdata"] === "true")
{
	echo "<script>alert('Username atau Password salah!\\nSilakan cek kembali data Anda.'); window.location = '/login';</script>";
}

?>

@section("page-title", "Masuk / Daftar | SimPet")

@section("page-contents")

	<section class="login">
		<div class="contents">
			<div class="left">
				<div id="form-login" class="container active">
					<form action="signin" id="form-login">
						<h2>Masuk</h2>
						<input type="text" title="Masukkan username Anda" name="username" id="username" placeholder="Username" required>
						<input type="password" title="Masukkan password Anda" name="password" placeholder="Password" required>
						<button type="submit" class="submit" title="Masuk dan lanjutkan ke halaman SimPet">MASUK</button>
						<p>Belum memiliki akun?<br>Daftar <a title="Daftarkan diri Anda untuk mendapatkan fitur-fitur dari kami">di sini.</a></p>
						<button class="link link2" title="Masuk ke halaman SimPet tanpa akun" onclick="window.location='/?nologin=true'">
							Lanjutkan tanpa akun
							<i class="fa-solid fa-arrow-right"></i>
						</button>
					</form>
				</div>
				<div id="form-register" class="container">
					<form action="register" id="form-register">
						<h2>Daftar</h2>
						<input type="text" title="Masukkan nama Anda" name="name" id="name-register" placeholder="Nama" required>
						<input type="text" title="Masukkan username Anda&#10;[ Proses registrasi akan gagal jika terdapat pengguna lain yang sudah menggunakan username yang sama ]" name="username" id="username-register" placeholder="Username" required>
						<input type="email" title="Masukkan email Anda&#10;[ Pastikan akun email Anda sesuai ]" name="email" id="email-register" placeholder="Email" required>
						<input type="number" title="Masukkan nomor telepon Anda&#10;[ Pastikan nomor telepon Anda sesuai ]" name="phone" id="phone-register" placeholder="Nomor Telepon" required>
						<input type="text" title="Masukkan alamat Anda" name="address" id="address-register" placeholder="Alamat" required>
						<input type="password" title="Masukkan password Anda&#10;[ Pastikan password tidak memiliki spasi di awal ]" name="password" id="password-register" placeholder="Password" required>
						<input type="password" title="Masukkan konfimasi password Anda" name="confirm_password" id="confirm-password-register" placeholder="Konfirmasi Password" required>
						<button type="submit" class="submit" title="Daftar dan lanjutkan ke halaman SimPet">DAFTAR</button>
						<p>Sudah memiliki akun?<br>Masuk <a title="Masuk dengan menggunakan akun Anda">di sini.</a></p>
						<button class="link link2" title="Masuk ke halaman SimPet tanpa akun" onclick="window.location='/?nologin=true'">
							Lanjutkan tanpa akun
							<i class="fa-solid fa-arrow-right"></i>
						</button>
					</form>
				</div>
			</div>

			<div class="right">
				<div class="text">
				<img src="/graphics/logo - transparent [white].png" alt="simpet_logo" class="logo" title="SimPet">
					<h5>Website Simulasi Peternakan</h5>
				</div>
				<button class="link" title="Masuk ke halaman SimPet tanpa akun" onclick="window.location='/?nologin=true'">
					Lanjutkan tanpa akun
					<i class="fa-solid fa-arrow-right"></i>
				</button>
			</div>
		</div>
	</section>

	<script>
		$(document).ready(function()
		{
			var regex = /^\s+/;

			$("#username").on("change", function()
			{
				if ($(this).val().includes(" "))
				{
					alert("Username tidak boleh terdapat spasi.");
					$(this).val("")
				}

				if ($(this).val().length > 15)
				{
					alert("Username tidak boleh melebihi dari 15 karakter.");
					$(this).val("")
				}
			});

			$("#name-register").on("change", function()
			{
				if ($(this).val().length > 50)
				{
					alert("Nama tidak boleh melebihi dari 50 karakter.");
					$(this).val("")
				}
			});

			$("#username-register").on("change", function()
			{
				if ($(this).val().includes(" "))
				{
					alert("Username tidak boleh terdapat spasi.");
					$(this).val("")
				}

				if ($(this).val().length > 15)
				{
					alert("Username tidak boleh melebihi dari 15 karakter.");
					$(this).val("")
				}
			});

			$("#password-register").on("change", function()
			{
				if (regex.test($("#password-register").val()))
				{
					alert("Password tidak boleh diawali dengan spasi.");
					$(this).val("")
				}
			});

			$("#confirm-password-register").on("change", function()
			{
				if ($("#password-register").val() !== $("#confirm-password-register").val())
				{
					alert("Password dan Konfirmasi Password harus sama.");
					$(this).val("")
				}
			});

			$(".login .contents .left .container#form-login a").on("click", function()
			{
				$(".login .contents .left .container#form-login").toggleClass("active");
				$(".login .contents .left .container#form-register").toggleClass("active");
			});

			$(".login .contents .left .container#form-register a").on("click", function()
			{
				$(".login .contents .left .container#form-login").toggleClass("active");
				$(".login .contents .left .container#form-register").toggleClass("active");
			});
		});
	</script>

@endsection
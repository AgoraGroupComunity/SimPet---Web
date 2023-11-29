@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

<?php

$generalButton = "class='active'";
$generalDisplay = "style='display: block;'";
$changePasswordButton = "class=''";
$changePasswordDisplay = "style='display: none;'";

if (isset($_GET["mod"]) && $_GET["mod"] === "general")
{
	$generalButton = "class='active'";
	$generalDisplay = "style='display: block;'";
	$changePasswordButton = "class=''";
	$changePasswordDisplay = "style='display: none;'";
?>

	@section("page-title", "Profil Pengguna | SimPet")
<?php
}
else if (isset($_GET["mod"]) && $_GET["mod"] === "changepassword")
{
	$generalButton = "class=''";
	$generalDisplay = "style='display: none;'";
	$changePasswordButton = "class='active'";
	$changePasswordDisplay = "style='display: block;'";
?>

	@section("page-title", "Ubah Password | SimPet")
<?php
}
else if (isset($_GET["refresh"]) && $_GET["refresh"] === "true")
{
	echo "<script>window.location = '/signin?username=" . Session::get("username") . "&password_resume=" . Session::get("password") . "&pagecallback=" . "profile?mod=general" . "';</script>";
}
else
{
	echo "<script>window.location = '/login';</script>";
}

?>


@section("page-contents")

	<body class="profile-background">
		<section class="profile">
			<div class="container">
				<h3>Profil Pengguna</h3>
				<div class="profile-box">
					<div class="left">
						<div class="container">
							<a href="?mod=general" class="general" title="Profil Umum" <?php echo $generalButton; ?>>Umum</a>
							<a href="?mod=changepassword" class="changepassword" title="Profil Ubah Password" <?php echo $changePasswordButton; ?>>Ubah Password</a>
						</div>
					</div>

					<div class="right">
						<div class="user-data">
							<form action="update" id="form-update">
								<div <?php echo $generalDisplay; ?>>
									<input type="text" id="user-id" style="display: none;" value="<?php echo (!empty(Session::get("id"))) ? Session::get("id") : ""; ?>">
									<div class="avatar">
										<img src='<?php echo Session::get("avatar"); ?>' alt='avatar' title='Foto Anda' id='avatar-preview'>
										<a id="search-avatar" title="Unggah dan perbarui foto Anda">Unggah foto baru</a>
										<input type="file" id="avatar-input" style="display: none;" accept="image/png, image/jpeg">
									</div>
									<div>
										<div class="group">
											<label for="name_update" class="form-label">Nama</label>
											<input type="text" title="Perbarui nama Anda" class="form-control" id="name_update" name="name" required value="<?php echo Session::get("name"); ?>">
										</div>
										<div class="group">
											<label for="username_update" class="form-label">Username</label>
											<input type="text" title="Perbarui username Anda&#10;[ Username akan gagal diperbarui jika terdapat pengguna lain yang sudah menggunakannya ]" class="form-control" id="username_update" name="username" required value="<?php echo Session::get("username"); ?>">
										</div>
										<div class="group">
											<label for="email_update" class="form-label">Email</label>
											<input type="email" title="Perbarui akun email Anda&#10;[ Pastikan akun email Anda sesuai ]" class="form-control" id="email_update" name="email" required value="<?php echo Session::get("email"); ?>">
										</div>
										<div class="group">
											<label for="phone_update" class="form-label">Nomor Telepon</label>
											<input type="number" title="Perbarui nomor telepon Anda&#10;[ Pastikan nomor telepon Anda sesuai ]" class="form-control" id="phone_update" name="phone" required value="<?php echo Session::get("phone"); ?>">
										</div>
										<div class="group">
											<label for="address_update" class="form-label">Alamat</label>
											<textarea title="Perbarui alamat Anda" id="address_update" name="address" rows="5" required><?php echo Session::get("address"); ?></textarea>
										</div>
									</div>
								</div>
								<div <?php echo $changePasswordDisplay; ?>>
									<div class="group">
										<label for="confirm_password" class="form-label">Konfirmasi Password Saat Ini</label>
										<input type="password" title="Konfirmasi password Anda saat ini&#10;[ Pastikan password Anda isi dengan benar ]" class="form-control" id="confirm_password" name="confirm_password">
									</div>
									<div class="group">
										<label for="password_update" class="form-label">Password Baru</label>
										<input type="password" title="Perbarui password Anda&#10;[ Pastikan password baru tidak memiliki spasi di awal ]" class="form-control" id="password_update" name="password_update">
									</div>
									<div class="group">
										<label for="confirm_password_update" class="form-label">Konfirmasi Password Baru</label>
										<input type="password" title="Masukkan konfirmasi password baru Anda" class="form-control" id="confirm_password_update">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="button-action">
					<button form="form-update" type="submit" class="save" title="Simpan dan lanjutkan ke halaman SimPet">SIMPAN PERUBAHAN</button>
					<button id="cancel-update" class="cancel" title="Kembali ke halaman utama">KEMBALI</button>
				</div>
			</div>
		</section>

	</body>

@endsection
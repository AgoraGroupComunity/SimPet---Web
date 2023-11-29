<?php

$requestURI = $_SERVER["REQUEST_URI"];

if (strpos($requestURI, "catalogs"))
{
	$classHome = "class=''";
	$classCatalogs = "class='active'";
	$classAboutUs = "class=''";
	$classCart = "class=''";
}
else if (strpos($requestURI, "product"))
{
	$classHome = "class=''";
	$classCatalogs = "class='active'";
	$classAboutUs = "class=''";
	$classCart = "class=''";
}
else if (strpos($requestURI, "aboutus"))
{
	$classHome = "class=''";
	$classCatalogs = "class=''";
	$classAboutUs = "class='active'";
	$classCart = "class=''";
}
else if (strpos($requestURI, "cart") || strpos($requestURI, "payment"))
{
	$classHome = "class=''";
	$classCatalogs = "class=''";
	$classAboutUs = "class=''";
	$classCart = "class='active'";
}
else
{
	$classHome = "class='active'";
	$classCatalogs = "class=''";
	$classAboutUs = "class=''";
	$classCart = "class=''";
}

if (empty(Session::get("username")))
{
	$hrefHome = "href='/?nologin=true#home'";
	$hrefCatalogs = "href='/catalogs?nologin=true'";
	$hrefAboutUs = "href='/aboutus?nologin=true'";
	$titleCart = "title='Keranjang (Tidak Tersedia)\n[ Anda harus mendaftarkan diri terlebih dahulu ]'";
	$classIconCart = "class='fa-solid fa-cart-shopping not-available'";
	$hrefProfile = "href='/login'";
	$titleProfile = "title='Profil Pengguna (Tidak Tersedia)\n[ Anda harus mendaftarkan diri terlebih dahulu ]'";
	$classIconProfile = "class='fa-solid fa-user not-available'";
	$hrefLogin = "href='/login'";
	$titleLogin = "title='Masuk\n[ Masuk menggunakan akun SimPet Anda ]'";
	$classIconLogin = "class='fa-solid fa-right-to-bracket'";
	$titleLoginSpan = "Masuk";
}
else
{
	$hrefHome = "href='/#home'";
	$hrefCatalogs = "href='/catalogs'";
	$hrefAboutUs = "href='/aboutus'";
	$titleCart = "title='Keranjang'";
	$classIconCart = "class='fa-solid fa-cart-shopping'";
	$hrefProfile = "href='/profile?mod=general'";
	$titleProfile = "title='Profil Pengguna'";
	$classIconProfile = "class='fa-solid fa-user'";
	$hrefLogin = "href='/signout'";
	$titleLogin = "title='Keluar'";
	$classIconLogin = "class='fa-solid fa-sign-out'";
	$titleLoginSpan = "Keluar";
}

?>

<header>
	<div class="navigation-bar">
		<img class="logo" src="/graphics/logo - transparent [white].png" alt="simpet_logo" title="SimPet">
		<ul class="buttons">
			<li>
				<a <?php echo $hrefHome . $classHome; ?> title="Beranda">Beranda</a>
			</li>
			<li>
				<a <?php echo $hrefCatalogs . $classCatalogs; ?> title="Katalog">Katalog</a>
			</li>
			<li>
				<a <?php echo $hrefAboutUs . $classAboutUs; ?> title="Tentang Kami">Tentang Kami</a>
			</li>
			<li>
				<a href="/cart" <?php echo $titleCart . $classCart; ?>>
					<i <?php echo $classIconCart; ?>></i>
					<span class="title-addon">Keranjang</span>
				</a>
			</li>
			<li>
				<a <?php echo $hrefProfile . $titleProfile; ?>>
					<i <?php echo $classIconProfile; ?>></i>
					<span class="title-addon">Profil Pengguna</span>
				</a>
			</li>
			<li>
				<a <?php echo $hrefLogin . $titleLogin; ?>>
					<i <?php echo $classIconLogin; ?>></i>
					<span class="title-addon"><?php echo $titleLoginSpan; ?></span>
				</a>
			</li>
		</ul>
		<i class="bx bx-menu" title="Tampilkan menu"></i>
	</div>
</header>
@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start_blank")
@endsection

<?php

if (isset($dataProducts) && is_array($dataProducts) && !empty($dataProducts))
{
	$productDB = $dataProducts;

	foreach ($productDB as $value)
	{
		$productId = $value->_id;
		$productName = $value->name;
		$productPrice = $value->price;
		$productDescriptions = $value->descriptions;
		$productImages = $value->images;
	}
}
else
{
	$productDB = 0;
}

?>

@section("page-title")
	<?php echo ($productDB > 0) ? "Jual produk " . $productName : "Produk tidak ditemukan"; ?> | SimPet
@endsection

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="catalog-details">
		<div class="contents">
			
			<?php
			
			if ($productDB > 0)
			{
				echo
					"<div class='col'>
						<div class='card-details-image' title='Gambar " . $productName . "'>
							<img src='" . $productImages->image0 . "' alt='product_preview'>
						</div>
						<div class='card-details-image-list'>
							<div class='container active' title='Gambar 1'>
								<img src='" . $productImages->image0 . "' alt='product_preview'>
							</div>";
				
							if (!empty($productImages->image1))
								echo
								"<div class='container' title='Gambar 2'>
									<img src='" . $productImages->image1 . "' alt='product_preview'>
								</div>";

							if (!empty($productImages->image2))
								echo
								"<div class='container' title='Gambar 3'>
									<img src='" . $productImages->image2 . "' alt='product_preview'>
								</div>";

							if (!empty($productImages->image3))
								echo
								"<div class='container' title='Gambar 4'>
									<img src='" . $productImages->image3 . "' alt='product_preview'>
								</div>";
					
				echo
						"</div>
					</div>

					<div class='col descriptions'>
						<h1>" . $productName . "</h1>
						<h2>Rp" . number_format($productPrice, 0, ',', '.') . "</h2>
						<p class='product-id' style='display:none;'>" . $productId . "</p>
						<p>" . nl2br($productDescriptions) . "</p>
				
						<div class='container'>
							<div class='quantity'>
								<button id='quantity-decrease' title='Kurangi jumlah'>-</button>
								<input type='number' id='quantity-input' value='1' title='Total jumlah yang ingin Anda pesan'>
								<button id='quantity-increase' title='Tambah jumlah'>+</button>
							</div>";

							if (empty(Session::get("username")))
								echo "<a href='/login' title='Masukkan ke keranjang Anda (Tidak Tersedia)\n[ Anda harus mendaftarkan diri terlebih dahulu ]'>Masukkan ke Keranjang</a>";
							else
								echo "<a id='add-cart-button' class='active' title='Masukkan ke keranjang Anda'>Masukkan ke Keranjang</a>";

				echo
						"</div>
					</div>";
			}
			else
			{
				echo
					"<div class='no-data'>
						<img src='/graphics/icons/icon_logo.png' alt='icon_logo'>
						<h2>Maaf, produk yang Anda cari tidak dapat kami temukan</h2>
					</div>";
			}
			
			?>

			<a href=<?php echo (empty(Session::get("username"))) ? "/catalogs?nologin=true" : "/catalogs"; ?> class="back-button" title="Kembali ke halaman katalog"><i class='fa-solid fa-arrow-left'></i> Kembali</a>

		</div>
	</section>

@endsection
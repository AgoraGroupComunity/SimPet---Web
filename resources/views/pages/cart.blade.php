@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Keranjang | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="cart">
		<div class="contents">
			<h2>Keranjang</h2>

			<?php

			use App\Http\Controllers\Cart;
			use App\Http\Controllers\Products;

			$productDB = new Products();
			
			if (isset($dataCart) && is_array($dataCart) && !empty($dataCart))
				$cartDB = $dataCart;
			else
				$cartDB = 0;

			$currentProduct = [];
			$cartSubTotalPrice = (int) 0;
			$cartTotalAmounts = (int) 0;
			$cartTotalPrice = (int) 0;

			if ($cartDB > 0)
			{
				echo
				"<div class='col'>
					<div class='list'>";

					foreach ($cartDB as $value)
					{
						$currentProduct = $productDB->getProducts("?id=" . $value->product_id . "&cartdisplay");

						if (empty($currentProduct))
						{
							$cartClass = new Cart();
							$cartClass->deleteCart($value->product_id);
						}

						foreach ($currentProduct as $valCurrentProduct)
						{
							$cartSubTotalPrice += intval($valCurrentProduct->price) * $value->amounts;
							$cartTotalAmounts += $value->amounts;
							
							echo
							"<div class='card' title='Klik untuk melihat detail produk " . $valCurrentProduct->name . "'"; ?> onclick="window.location.href = '/product/<?php echo $value->product_id; ?>/details'" >
					
					<?php	echo
								"<div class='group'>
									<div class='image'>
										<img src='" . $valCurrentProduct->images->image0 . "' alt=''>
									</div>
									<div class='info-product'>
										<p>" . $valCurrentProduct->name . "</p>
										<p>Rp" . number_format($valCurrentProduct->price, 0, ',', '.') . "</p>
									</div>
								</div>
								<div class='action'>
									<p class='product-id' style='display:none;'>" . $value->product_id . "</p>
									<button class='quantity-decrease-cart' title='Kurangi jumlah'"; ?> onclick="window.location.href = '/cart/addcart/<?php echo $value->product_id; ?>/<?php echo intval($value->amounts - 1); ?>/1'" <?php echo ">-</button>
									<input type='number' class='quantity-input-cart' value='" . $value->amounts . "' title='Total jumlah yang ingin Anda pesan'>
									<button class='quantity-increase-cart' title='Tambah jumlah'"; ?> onclick="window.location.href = '/cart/addcart/<?php echo $value->product_id; ?>/<?php echo intval($value->amounts + 1); ?>/1'" <?php echo ">+</button>
									<div class='delete'>
										<i class='far fa-trash-alt quantity-remove' title='Hapus produk dari keranjang Anda'></i>
									</div>
								</div>
							</div>";
						}
					}

					echo
					"</div>";

					if (is_array($currentProduct) && !empty($currentProduct))
					{
						echo
						"<div class='card info'>
							<div class='subinfo'>
								<p>Subtotal harga</p>
								<p class='subtotal-price'>Rp" . number_format($cartSubTotalPrice, 0, ',', '.') . "</p>
							</div>
							<div class='subinfo'>
								<p>Total barang</p>
								<p class='total-amounts'>" . $cartTotalAmounts . "</p>
							</div>
							<div class='subinfo'>
								<p>Kurir</p>
								<select id='courier-selection'>
									<option value='JNE'>JNE</option>
									<option value='J&T Express'>J&T Express</option>
									<option value='SiCepat'>SiCepat</option>
								</select>
							</div>
							<div class='subinfo'>
								<p>Biaya kirim</p>
								<p class='deliver-price'></p>
							</div>
							<div class='subinfo sum'>
								<p>Total harga</p>
								<p class='total-price'></p>
							</div>
							<a class='pay-button' title='Bayar barang Anda sekarang'>BAYAR</a>
						</div>";
					}
					
					echo
					"</div>";
			}
			else
			{

			}
			
			?>
			
		</div>
	</section>

	<script>
		$(document).ready(function()
		{
			var courier = "JNE";
			var subTotalPrice = parseInt($(".subtotal-price").text().replace(/[^\d]/g, ""), 10);
			$(".deliver-price").text("Rp" + (0.1 * subTotalPrice).toLocaleString("id-ID"));
			var deliverPrice = parseInt($(".deliver-price").text().replace(/[^\d]/g, ""), 10);
			var totalPrice = parseInt(subTotalPrice + deliverPrice);

			$(".total-price").text("Rp" + totalPrice.toLocaleString("id-ID"));

			$("#courier-selection").on("change", function()
			{
				var selectedOption = $(this).val();
				courier = selectedOption;

				switch (selectedOption)
				{
					case "JNE":
					{
						deliverPrice = (0.1 * subTotalPrice);
						break;
					}
					case "J&T Express":
					{
						deliverPrice = (0.12 * subTotalPrice);
						break;
					}
					case "SiCepat":
					{
						deliverPrice = (0.13 * subTotalPrice);
						break;
					}
				}

				$(".deliver-price").text("Rp" + deliverPrice.toLocaleString("id-ID"));

				var deliverPriceFinal = parseInt(deliverPrice, 10);
				var totalPriceFinal = parseInt(subTotalPrice + deliverPriceFinal);

				$(".total-price").text("Rp" + totalPriceFinal.toLocaleString("id-ID"));
			});

			$(".pay-button").on("click", function()
			{
				return window.location.href = "/payment/" +  encodeURIComponent(btoa($(".subtotal-price").text())) + "/" + encodeURIComponent(btoa($(".total-amounts").text())) + "/" + encodeURIComponent(btoa($(".deliver-price").text())) + "/" + encodeURIComponent(btoa($(".total-price").text())) + "/" + encodeURIComponent(btoa(<?php echo sprintf("%03d", random_int(0, 999)); ?>)) + "/" + encodeURIComponent(btoa(courier));
			});
		});
	</script>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
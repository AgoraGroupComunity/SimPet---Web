@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Pembayaran | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="payment">
		<div class="contents">
			<h1>Pembayaran</h1>

			<?php
			
			if (isset($dataPayment) && is_array($dataPayment) && !empty($dataPayment))
				$paymentDB = $dataPayment;
			else
				$paymentDB = 0;

			if ($paymentDB > 0)
			{
				echo
				"<div class='card'>
					<div class='col'>
						<h3>Pembayaran dengan transfer melalui:</h3>
						<div class='bank'>
							<img src='/graphics/icons/icon_bank.png' alt='icon_bank'>
							<p>Bank Central Asia</p>
						</div>
						<div class='bank-info'>
							<p>
								Nomor Rekening:
								<i class='fa-regular fa-clone bank-number-copy-button' title='Salin nomor rekening'></i>
							</p>
							<p class='bank-number'>8029 9012 9031 2291</p>
							<p>a/n PT. Agora Group</p>
						</div>
						<div class='timer'>
							<p>Segera lakukan pembayaran dalam waktu:</p>
							<span id='hours'>00</span>:<span id='minutes'>00</span>:<span id='seconds'>00</span>
							<p>Jam\tMenit\tDetik</p>
						</div>
					</div>
					<div class='col info'>
						<div class='card info'>
							<div class='subinfo'>
								<p>Subtotal harga</p>
								<p class='subtotal-price'>" . $paymentDB["subtotal_price"] . "</p>
							</div>
							<div class='subinfo'>
								<p>Total barang</p>
								<p class='total-amounts'>" . $paymentDB["amounts"] . "</p>
							</div>
							<div class='subinfo'>
								<p>Biaya kirim</p>
								<p class='deliver-price'>" . $paymentDB["deliver_price"] . "</p>
							</div>
							<div class='subinfo'>
								<p>Kode unik transaksi</p>
								<p class='unique-code'>" . $paymentDB["unique_code"] . "</p>
							</div>
							<div class='subinfo sum'>
								<p>Total harga</p>
								<p class='total-price'></p>
							</div>
						</div>

						<button class='finish-payment-button' title='Pesan barang dan selesaikan pembayaran Anda sekarang'>PESAN</button>
					</div>
				</div>";
			}
			
			?>

			<a href="/cart" class="back-button" title="Kembali ke halaman keranjang"><i class='fa-solid fa-arrow-left'></i> Kembali</a>

		</div>
	</section>

	<script>
		$(document).ready(function()
		{
			var endDate;
			var uniqueCode = <?php echo $paymentDB["unique_code"]; ?>;
			var storedEndDate = localStorage.getItem("endDate");
			var storedUniqueCode = localStorage.getItem("uniqueCode");

			if (storedEndDate && (storedUniqueCode === String(uniqueCode)))
			{
				endDate = parseInt(storedEndDate, 10);
			}
			else
			{
				var currentDate = new Date();
				currentDate.setHours(currentDate.getHours() + 24);
				endDate = currentDate.getTime();
				localStorage.setItem("endDate", endDate);
				localStorage.setItem("uniqueCode", uniqueCode);
			}

			function updateTimer()
			{
				var currentTime = new Date().getTime();
				var distance = endDate - currentTime;

				var hours = Math.floor(distance / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				$("#hours").text(String(hours).padStart(2, "0"));
				$("#minutes").text(String(minutes).padStart(2, "0"));
				$("#seconds").text(String(seconds).padStart(2, "0"));

				if (distance < 0)
				{
					clearInterval(countdownInterval);
					alert("Waktu pembayaran telah habis!");

					localStorage.removeItem("endDate");
					localStorage.removeItem("uniqueCode");

					return window.location.href = "/cart";
				}
			}

			updateTimer();

			var countdownInterval = setInterval(updateTimer, 1000);

			var subTotalPrice = parseInt($(".subtotal-price").text().replace(/[^\d]/g, ""), 10);
			var deliverPrice = parseInt($(".deliver-price").text().replace(/[^\d]/g, ""), 10);
			var uniqueCode = parseInt($(".unique-code").text(), 10);
			var totalPrice = parseInt(subTotalPrice + deliverPrice + uniqueCode);

			$(".total-price").text("Rp" + totalPrice.toLocaleString("id-ID"));

			$(".finish-payment-button").on("click", function()
			{
				var courier = <?php echo json_encode($paymentDB["courier"]); ?>;

				return window.location.href = "/payment/payproducts/" + encodeURIComponent(btoa(parseInt(subTotalPrice + deliverPrice))) + "/" + encodeURIComponent(btoa(uniqueCode)) + "/" + encodeURIComponent(btoa(courier));
			});
		});
	</script>

@endsection
@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Ayo Cek | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="manual active">
		<div class="contents">
			<h2>AyoCek</h2>
			<p>Lengkapi semua data di bawah ini</p>
			<h3>Pilih jenis hewan ternak Anda</h3>
			<div class="choose-animal">
				<img src="/graphics/icons/icon_beef_cattle.png" alt="icon_beef_cattle" title="Sapi Potong">
				<img src="/graphics/icons/icon_dairy_cow.png" alt="icon_dairy_cow" title="Sapi Perah">
				<img src="/graphics/icons/icon_goat.png" alt="icon_goat" title="Kambing">
				<img src="/graphics/icons/icon_buffalo.png" alt="icon_buffalo" title="Kerbau">
			</div>
			<div class="input-area">
				<div class="col">
					<p>Jenis Pakan</p>
					<input class="feed" type="text" title="Masukkan jenis pakan ternak yang Anda inginkan" placeholder="-">
				</div>
				<div class="col">
					<p>Vitamin</p>
					<input class="vitamine" type="text" title="Masukkan vitamin untuk ternak yang Anda inginkan" placeholder="-">
				</div>
				<div class="col">
					<p>Vaksin</p>
					<input class="vaccine" type="text" title="Masukkan vaksin untuk ternak yang Anda inginkan" placeholder="-">
				</div>
			</div>
			<div class="input-area">
				<div class="col">
					<p>Jumlah Hewan</p>
					<input class="amounts-animal" type="number" title="Masukkan jumlah hewan ternak yang Anda inginkan" placeholder="0">
				</div>
				<div class="col">
					<p>Durasi Ternak (Bulan)</p>
					<input class="durations-farm" type="number" title="Masukkan durasi ternak yang Anda inginkan" placeholder="0">
				</div>
				<div class="col">
					<p>Panjang Kandang (m)</p>
					<input class="length" type="number" title="Masukkan panjang kandang ternak yang Anda inginkan" placeholder="0">
				</div>
				<div class="col">
					<p>Lebar Kandang (m)</p>
					<input class="width" type="number" title="Masukkan lebar kandang ternak yang Anda inginkan" placeholder="0">
				</div>
				<div class="col">
					<p>Debit Air Bersih (Liter/hari)</p>
					<input class="clean-water" type="number" title="Masukkan debit air bersih yang Anda inginkan" placeholder="0">
				</div>
			</div>
			<button class="manual-start-calculation" title="Mulai cek rancangan peternakan Anda sekarang">Cek Peternakan</button>
			<p>Rekomendasi berdasarkan sistem SimPet</p>
		</div>
	</section>

	<section class="manual result">
		<div class="contents">
			<div class="header">
				<h2>AyoBuat</h2>
				<div class="choose-animal">
					<p>Nama Hewan</p>
					<img src="/graphics/icons/icon_logo.png" alt="icon_logo" title="Nama Hewan">
				</div>
				<div class="output">
					<div class="row">
						<p>Jenis Pakan:</p>
						<p class="feed-result"></p>
					</div>
					<div class="row">
						<p>Panjang Kandang:</p>
						<p class="length-result"></p>
					</div>
					<div class="row">
						<p>Lebar Kandang:</p>
						<p class="width-result"></p>
					</div>
					<div class="row">
						<p>Tinggi Kandang:</p>
						<p class="height-result"></p>
					</div>
					<div class="row">
						<p>Vitamin:</p>
						<p class="vitamine-result"></p>
					</div>
					<div class="row">
						<p>Vaksin:</p>
						<p class="vaccine-result"></p>
					</div>
					<div class="row">
						<p>Debit Air Bersih:</p>
						<p class="clean-water-result"></p>
					</div>
					<div class="row">
						<p>Jumlah SDM:</p>
						<p class="human-resource-result"></p>
					</div>
				</div>
			</div>
			<div class="footer-manual">
				<p>Harga dan data dapat berubah sesuai kondisi</p>
			</div>
		</div>

		<a href="/manual" class="back-button" title="Kembali ke halaman AyoBuat"><i class='fa-solid fa-arrow-left'></i> Kembali</a>
	</section>

	<script>
		$(document).ready(function()
		{
			var chosenAnimal;
			var chosenAnimalImg;
			
			$(".manual .contents .choose-animal img").on("click", function()
			{
				var index = $(".manual .contents .choose-animal img").index(this);

				chosenAnimal = $(this).attr("title");
				chosenAnimalImg = $(this).attr("src");

				$(".manual .contents .choose-animal img").each(function(i)
				{
					if (i !== index)
						$(this).removeClass("active");
				});

				$(this).addClass("active");
			});

			$(".manual-start-calculation").on("click", function()
			{
				if (($(".feed").val() != "") && ($(".vitamine").val() != "") && ($(".vaccine").val() != "") && ($(".amounts-animal").val() != 0) && ($(".durations-farm").val() != 0) && ($(".length").val() != 0) && ($(".width").val() != 0) && ($(".clean-water").val() != 0))
				{
					$.ajax(
					{
						url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getAnimal?hewan=" + chosenAnimal,
						type: "GET",
						success: function(res)
						{
							res.forEach(element =>
							{
								if ($(".feed").val() == element.pakan.jenis_pakan)
									$(".feed-result").html(element.pakan.jenis_pakan);
								else
									$(".feed-result").html("Ganti pakan ternak Anda dengan " + element.pakan.jenis_pakan);
								
								if ($(".vitamine").val() == element.vitamin.jenis_vitamin)
									$(".vitamine-result").html(element.vitamin.jenis_vitamin + " cocok untuk hewan ternak Anda");
								else
									$(".vitamine-result").html("Ganti jenis vaksin ternak Anda dengan " + element.vitamin.jenis_vitamin);

								if ($(".vaccine").val() == element.vaksin.jenis_vaksin)
									$(".vaccine-result").html(element.vaksin.jenis_vaksin + " cocok untuk hewan ternak Anda");
								else
									$(".vaccine-result").html("Ganti jenis vitamin ternak Anda dengan " + element.vaksin.jenis_vaksin);
								
								if ($(".length").val() == element.kandang.minPanjang)
									$(".length-result").html("Panjang " + element.kandang.minPanjang + "m sudah sesuai");
								else
									$(".length-result").html("Panjang kandang ternak minimal " + element.kandang.minPanjang + "m");
								
								if ($(".width").val() == element.kandang.minLebar)
									$(".width-result").html("Lebar " + element.kandang.minLebar + "m sudah sesuai");
								else
									$(".width-result").html("Lebar kandang ternak minimal " + element.kandang.minLebar + "m");
								
								if ($(".clean-water").val() == element.air_bersih)
									$(".clean-water-result").html(element.air_bersih + "Liter/hari sudah mencukupi");
								else
									$(".clean-water-result").html("Sediakan air bersih minimal " + element.air_bersih + "Liter/hari");

								$(".height-result").html("Tinggi kandang ternak minimal " + element.kandang.minTinggi + "m");
								$(".human-resource-result").html(Math.ceil(parseInt($(".amounts-animal").val()) * element.SDM) + " orang");
							});

							$(".manual").removeClass("active");
							$(".manual.result").addClass("active");
							$(".manual.result .choose-animal p").html(chosenAnimal);
							$(".manual.result .choose-animal img").attr("src", chosenAnimalImg);
							$(".manual.result .choose-animal img").attr("title", chosenAnimal);
						},
						error: function(err)
						{
							alert("Terjadi kesalahan data!\n Silakan cek kembali data yang Anda masukan.");
						}
					});
				}
				else
				{
					alert("Data ternak harus diisi semua!");
				}
			});
		});
	</script>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
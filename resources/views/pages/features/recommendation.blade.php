@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Ayo Buat | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="recommendation active">
		<div class="contents">
			<h2>AyoBuat</h2>
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
					<p>Jumlah Hewan</p>
					<input class="amounts-animal" type="number" title="Masukkan jumlah hewan ternak yang Anda inginkan" placeholder="0">
				</div>
				<div class="col">
					<p>Durasi Ternak (Bulan)</p>
					<input class="durations-farm" type="number" title="Masukkan durasi ternak yang Anda inginkan" placeholder="0">
				</div>
			</div>
			<button class="recommendation-start-calculation" title="Mulai hitung rancangan Anda sekarang">Hitung Rancangan</button>
			<p>Rekomendasi berdasarkan sistem SimPet</p>
		</div>
	</section>

	<section class="recommendation result">
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
						<p class="feed">null</p>
					</div>
					<div class="row">
						<p>Panjang Kandang:</p>
						<p class="length">null</p>
					</div>
					<div class="row">
						<p>Lebar Kandang:</p>
						<p class="width">null</p>
					</div>
					<div class="row">
						<p>Tinggi Kandang:</p>
						<p class="height">null</p>
					</div>
					<div class="row">
						<p>Vitamin:</p>
						<p class="vitamine">null</p>
					</div>
					<div class="row">
						<p>Vaksin:</p>
						<p class="vaccine">null</p>
					</div>
					<div class="row">
						<p>Debit Air Bersih:</p>
						<p class="clean-water">null</p>
					</div>
					<div class="row">
						<p>Jumlah SDM:</p>
						<p class="human-resource">null</p>
					</div>
				</div>
				<div class="cost">
					<p>Estimasi Biaya:</p>
					<p>Rpnull</p>
				</div>
			</div>
			<div class="footer-recommendation">
				<p>Harga dan data dapat berubah sesuai kondisi</p>
			</div>
		</div>

		<a href="/recommendation" class="back-button" title="Kembali ke halaman AyoBuat"><i class='fa-solid fa-arrow-left'></i> Kembali</a>
	</section>

	<script>
		$(document).ready(function()
		{
			var chosenAnimal;
			var chosenAnimalImg;
			
			$(".recommendation .contents .choose-animal img").on("click", function()
			{
				var index = $(".recommendation .contents .choose-animal img").index(this);

				chosenAnimal = $(this).attr("title");
				chosenAnimalImg = $(this).attr("src");

				$(".recommendation .contents .choose-animal img").each(function(i)
				{
					if (i !== index)
						$(this).removeClass("active");
				});

				$(this).addClass("active");
			});

			$(".recommendation-start-calculation").on("click", function()
			{
				if (($(".amounts-animal").val() != 0) && ($(".durations-farm").val() != 0))
				{
					$.ajax(
					{
						url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getAnimal?hewan=" + chosenAnimal,
						type: "GET",
						success: function(res)
						{
							res.forEach(element =>
							{
								var minWidth = parseInt(element.kandang.minLebar);
								var minLength = parseInt(element.kandang.minPanjang);
								var animalAmounts = parseInt($(".amounts-animal").val());
								var farmDuration = parseInt($(".durations-farm").val());
								var animalPrice = parseInt(element.harga_hewan);
								var vaccinePrice = parseInt(element.vaksin.harga_vaksin);
								var vitaminePrice = parseInt(element.vitamin.harga_vitamin);
								var feedPrice = parseInt(element.pakan.harga_pakan);
								var totalCost = ((minWidth * minLength * 350000) + (animalAmounts * animalPrice) + (animalAmounts * vaccinePrice) + (animalAmounts * vitaminePrice) + (animalAmounts * feedPrice * farmDuration));

								$(".feed").html(element.pakan.jenis_pakan);
								$(".length").html(element.kandang.minPanjang + "m");
								$(".width").html(element.kandang.minLebar + "m");
								$(".height").html(element.kandang.minTinggi + "m");
								$(".vitamine").html(element.vitamin.jenis_vitamin);
								$(".vaccine").html(element.vaksin.jenis_vaksin);
								$(".clean-water").html(animalAmounts + parseInt(element.air_bersih) + "Liter/hari");
								$(".human-resource").html(Math.ceil(animalAmounts * parseFloat(element.SDM)) + " orang");
								$(".recommendation.result .cost p:last-child").html("Rp" + totalCost.toLocaleString("id-ID"));
							});

							$(".recommendation").removeClass("active");
							$(".recommendation.result").addClass("active");
							$(".recommendation.result .choose-animal p").html(chosenAnimal);
							$(".recommendation.result .choose-animal img").attr("src", chosenAnimalImg);
							$(".recommendation.result .choose-animal img").attr("title", chosenAnimal);
						},
						error: function(err)
						{
							alert("Terjadi kesalahan data!\n Silakan cek kembali data yang Anda masukan.");
						}
					});
				}
				else
				{
					alert("Jumlah Hewan dan Durasi Ternak harus diisi!");
				}
			});
		});
	</script>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection
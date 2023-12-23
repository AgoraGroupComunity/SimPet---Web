@extends("includes.layout")

@section("page-title", "Admin | SimPet")

@section("page-contents")
<section class="menuadmin">
		<nav class="menuAdmin">
			<ul class="admin">
				<li><a href="#" class="judulAdmin">
					<span class="nav-item">SimPet</span>
				</a></li>
				<li><a href="/admin">
					<i class="fas fa-box"></i>
					<span class="nav-item">Product</span>
				</a></li>
				<li><a href="/admin/user">
					<i class="fas fa-user"></i>
					<span class="nav-item">Pengguna</span>
				</a></li>
				<li><a href="#">
					<i class="fas fa-list"></i>
					<span class="nav-item">Pesanan</span>
				<li><a href="#" class="logout">
					<i class="fas fa-sign-out-alt"></i>
					<span class="nav-item">Log out</span>
				</a></li>
			</ul>
		</nav>

	 
<section class="main">
			<div class="users">
				<div class="card">
					<h4>Total Pesanan</h4>
					<p id="totalPesanan" >0</p>
				</div>
				<div class="cardselesai">
					<h4>Selesai</h4>
					<p  id="totalSelesai">0</p>
				</div>
				<div class="cardproses">  
					<h4>Diproses</h4>
					<p  id="totalDiproses">0</p>
				</div>
				<div class="cardbatal">
					<h4>Dibatalkan</h4>
					<p  id="totalDibatalkan">0</p>
				</div>
			</div>
			<section class="attendance">
				<div class="attendance-list">
					<h1>Daftar Pesanan</h1>
					<table class="table" id="tableHistory">
						<thead>
							<tr>
								<th>Pemesan</th>
								<th>Kode Transaksi</th>
								<th>Alamat</th>
								<th>Total  </th>
								<th>Status  </th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							{{-- <tr>
								<td>Putra Wahyu</td>
								<td>Vitamin C</td>
								<td>jl. lodaya 2 no.12</td>
								<td>8.000.000</td>
								<td><button class="hapus">tolak</button>
								<button class="terima">Terima</button></td>
							</tr> --}}
							
							
						</tbody>
					</table>
				</div>
			</section>
</section>
</section>

<script>
	$(document).ready(function(){
		function loadHistory(){
			$.ajax({
				url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getHistory",
				dataType: "json",
				type: "GET",
				success:function(res){
					console.log(res);
					
					var view ="";
					var totalPesanan=0;
					var totalSelesai=0;
					var totalDiproses=0;
					var totalDibatalkan=0;

					res.forEach(element => {
						totalPesanan+=1;

						console.log(element.name)
						// console.log(element.descriptions)
						// console.log(element.price

						if(element.status==="Diproses"){
							totalDiproses+=1;
						}
						if (element.status==="Diterima"){
							totalSelesai+=1;

						} if  (element.status==="Ditolak"){
							totalDibatalkan+=1;

						}
						
						view += "<tr>"+
								"<td>"+element.name+"</td>"+
								"<td>"+((element.receipt_number ? ((element.receipt_number)) :""))+"</td>"+
								"<td>"+(element.address ? element.address:"")+"</td>"+
								"<td>"+(element.total_price ? element.total_price:"")+"</td>"+
								"<td>"+(element.status ? element.status:"")+"</td>"+
								"<td>"+ 
									"<button class='terima' data-id='"+element._id+"' id='edit'>Selesai</button>\t"+
									"<button class='hapus tolak' data-id='"+element._id+"' id='edit'>Tolak</button>"+
								"</td>"
							"</tr>";
							
					});
					 $("#tableHistory tbody").html(view);
					 $("#totalPesanan").html(totalPesanan);
					$("#totalSelesai").html(totalSelesai);
					$("#totalDiproses").html(totalDiproses);
					$("#totalDibatalkan").html(totalDibatalkan);
			 
				},
			})
		}

		loadHistory();

		$("#tableHistory").on("click", ".terima", function () {
		var id = $(this).data("id");
		// alert (id);
		$.ajax({
				url:
					"https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/updateShop?id=" + id + "&status=Diterima",
				type: "PUT",
				success: function () {
					loadHistory();
				},
				error: function (err) {
					console.log(err);
				},
			});
		});

		$("#tableHistory").on("click", ".tolak", function () {
		var id = $(this).data("id");
		// alert (id);
		$.ajax({
				url:
					"https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/updateShop?id=" + id + "&status=Ditolak",
				type: "PUT",
				success: function () {
					loadHistory();
				},
				error: function (err) {
					console.log(err);
				},
			});
		});

	})



</script>

@endsection
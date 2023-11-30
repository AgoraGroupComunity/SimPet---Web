@extends("includes.layout")

@section("page-title", "Admin | SimPet")

@section("page-contents")
<section class="menuadmin">
    <nav class="menuAdmin">
      <ul class="admin">
        <li><a href="#" class="judulAdmin">
          <span class="nav-item">SimPet</span>
        </a></li>
        <li><a href="#">
          <i class="fas fa-box"></i>
          <span class="nav-item">Product</span>
        </a></li>
        <li><a href="/admin/user">
          <i class="fas fa-user"></i>
          <span class="nav-item">Pengguna</span>
        </a></li>
        <li><a href="/admin/pesanan">
          <i class="fas fa-list"></i>
          <span class="nav-item">Pesanan</span>
        <li><a href="#" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

   
  <section class="main" >
      
        <div class="users">
          <div class="card">
            <h4>Total Barang</h4>
            <p id="totalProduct">0</p>
          </div>
        </div>
        <section class="attendance" id="mainTable">
          <div class="attendance-list">
            <h1>Daftar Produk</h1>
            <button class="btn_tambahproduk">tambah</button>
            <table class="table" id="tableProducts">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama</th>
                  <th>Deskripsi</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="">
                <!-- <tr>
                  <td>01</td>
                  <td>sapi jantan</td>
                  <td>susu sapi jantan perisa apel ditambah keju </td>
                  <td>8.000.000</td>
                  <td><button class="edit">Edit</button>
                  <button class="hapus">Hapus</button></td>
                </tr> -->
                

              </tbody>
            </table>
          </div>
        </section>

        <div class="container" id="modalEdit">
          <h1>Edit Produk</h1>
          <form action="" id="formEdit">

            <div class="viewImage">
              <div class="fotoedit">
                <div>
                  <a id="search-image1" title="Unggah dan perbarui foto Anda">Foto 1</a>
                  <input type="file" id="image-input1" style="display: none;" accept="image/png, image/jpeg">
                </div>
                <div>
                  <img id="image-preview-product1" class="previewProductImage" src="/graphics/icons/icon_logo.png" alt="image_product1">
                </div>
              </div>
              <div class="fotoedit">
                <div>
                  <a id="search-image2" title="Unggah dan perbarui foto Anda">Foto 2</a>
                  <input type="file" id="image-input2" style="display: none;" accept="image/png, image/jpeg">
                </div>
                <div>
                  <img id="image-preview-product2" class="previewProductImage" src="/graphics/icons/icon_logo.png" alt="image_product2">
                </div>
              </div>
              <div class="fotoedit">
                <div>
                  <a id="search-image3" title="Unggah dan perbarui foto Anda">Foto 3</a>
                  <input type="file" id="image-input3" style="display: none;" accept="image/png, image/jpeg">
                </div>
                <div>
                  <img id="image-preview-product3" class="previewProductImage" src="/graphics/icons/icon_logo.png" alt="image_product3">
                </div>
              </div>
              <div class="fotoedit">
                <div>
                  <a id="search-image4" title="Unggah dan perbarui foto Anda">Foto 4</a>
                  <input type="file" id="image-input4" style="display: none;" accept="image/png, image/jpeg">
                </div>
                <div>
                  <img id="image-preview-product4" class="previewProductImage" src="/graphics/icons/icon_logo.png" alt="image_product4">
                </div>
              </div>
            </div>
              

            

              <div class="form-container">
                <input type="hidden" class="form-control" id="idProduct" placeholder="Id produk" value="" readonly>
                
                
                <div class="mb-3">
                    <label for="nameProduct" class="labelProduct">Nama</label>
                    <input type="text" class="form-control" id="nameProduct" placeholder="Nama produk" required>
                </div>
                
                <div class="mb-3">
                    <label for="priceProduct" class="labelProduct">Harga</label>
                    <input type="number" class="form-control" id="priceProduct" placeholder="Harga Product" required>
                </div>

                <div class="mb-3">
                    <label for="descProduct" class="labelProduct ">Deskripsi</label>
                    <textarea class="form-control descArea" id="descProduct" placeholder="Deskripsi Produk" required></textarea>
                </div>
                <input type="submit" class="cancelButton brownColor" value="Simpan" form="formEdit" id="save">
                <input type="button" class="cancelButton" value="Batal" id="cancel">
              </div>

              
          </form>
        </div>

        
  </section>
  
</section>
<script>
  $(document).ready(function(){
    $('#modalEdit').hide();
    function loadProduct(){
      $.ajax({
        url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getProducts",
        dataType: "json",
        type: "GET",
        success:function(res){
          console.log(res.name);
          
          var view ="";
          var no = 0;
          var totalProduct=0;

          res.forEach(element => {
            
            no+=1;
            view += "<tr>"+
                "<td>"+no+"</td>"+
                "<td>"+element.name+"</td>"+
                "<td>"+((element.descriptions ? ((element.descriptions).substring(0,65))+"..." :""))+"</td>"+
                "<td>"+(element.price ? "Rp" + (element.price).toLocaleString("id-ID"):"")+"</td>"+
                "<td>"+ 
                  "<button class='edit ' data-id='"+element._id+"' id='edit'>Ubah</button>  "+
                  "<button class='hapus ' data-id='"+element._id+"' id='delete'>Hapus</button>"+
                "</td>"
              "</tr>"
              
          });
           $("#tableProducts tbody").html(view);
           $('#totalProduct').html(totalProduct);
        },
      })
    }

    loadProduct();

  $("#tableProducts").on("click", ".hapus", function () {
    var id = $(this).data("id");
    // alert (id);
    $.ajax({
      url:
        "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/deleteProducts?id=" +
        id,
      type: "DELETE",
      beforeSend: function () {
        return confirm("Apakah Anda yakin anda akan menghapus data?");
      },
      success: function () {
        loadProduct();
      },
      error: function (err) {
        console.log(err);
      },
    });
  
  });

  
  $("#tableProducts").on("click", ".edit", function () {
    $('#modalEdit').show();
    $('#mainTable').hide();
    


    var id = $(this).data("id");
    // alert (id);
    $.ajax({
      url:
        "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getProducts?id=" +
        id,
      type: "GET",
      beforeSend: function () {
      },
      success: function (res) {
        var data= res[0];
        console.log(data);
        
        $('#idProduct').val(id);
        $('#nameProduct').val(data.name);
        $('#priceProduct').val(data.price);
        $('#descProduct').val(data.descriptions);
        $("#image-preview-product1").attr("src", (data.images.image0 ? data.images.image0 : "/graphics/icons/icon_logo.png" ));
        $("#image-preview-product2").attr("src", (data.images.image1 ? data.images.image1 : "/graphics/icons/icon_logo.png" ));
        $("#image-preview-product3").attr("src", (data.images.image2 ? data.images.image2 : "/graphics/icons/icon_logo.png" ));
        $("#image-preview-product4").attr("src",(data.images.image3 ? data.images.image3 : "/graphics/icons/icon_logo.png" ));
        

      },
      error: function (err) {
        console.log(err);
      },
    });
  
  });

  //update product
  $("#save").click( function () {

    var id= $('#idProduct').val();
    // console.log("klik" + id);

    $.ajax({
      url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/updateProductsWeb?id=" + id,
      type: "PUT",
      async: false,
      data:
      {
        name : $('#nameProduct').val(),
        price : $('#priceProduct').val(),
        descriptions: $('#descProduct').val(),
        image0: $("#image-preview-product1").attr("src"),
        image1: $("#image-preview-product2").attr("src"),
        image2: $("#image-preview-product3").attr("src"),
        image3: $("#image-preview-product4").attr("src"),
      },
      success: function () {
        // console.log("sukses");
        // console.log( $('#nameProduct').val());
        
        

      },
      error: function (err) {
        console.log(err);
      },
    });
  
  }); //end update
		
		$("#search-image1").on("click", function()
		{
			$("#image-input1").click();
		});

		$("#image-input1").on("change", function()
		{
			const selectedImage = $(this).prop("files")[0];

			if (selectedImage)
			{
				var reader = new FileReader();

				reader.onload = function(e)
				{
					var image = new Image();
					image.src = e.target.result;

					// Check image resolutions
					image.onload = function()
					{
             var width = this.width;
             var height = this.height;

						if (width > 1080 || height > 720)
						{
							return alert("Resolusi atau ukuran gambar yang Anda pilih terlalu besar dari 720pixels. Silakan pilih gambar yang lebih kecil.\n\n[ Resolusi maksimal 1280x720pixels ]");
						}
						else
						{
							var base64String = e.target.result;

							$("#image-preview-product1").attr("src", base64String);
						}
					}
				}

				reader.readAsDataURL(selectedImage);
			}
		});
		
		$("#search-image2").on("click", function()
		{
			$("#image-input2").click();
		});

		$("#image-input2").on("change", function()
		{
			const selectedImage = $(this).prop("files")[0];

			if (selectedImage)
			{
				var reader = new FileReader();

				reader.onload = function(e)
				{
					var image = new Image();
					image.src = e.target.result;

					// Check image resolutions
					image.onload = function()
					{
             var width = this.width;
             var height = this.height;

						if (width > 1080 || height > 720)
						{
							return alert("Resolusi atau ukuran gambar yang Anda pilih terlalu besar dari 720pixels. Silakan pilih gambar yang lebih kecil.\n\n[ Resolusi maksimal 1280x720pixels ]");
						}
						else
						{
							var base64String = e.target.result;

							$("#image-preview-product2").attr("src", base64String);
						}
					}
				}

				reader.readAsDataURL(selectedImage);
			}
		});
		
		$("#search-image3").on("click", function()
		{
			$("#image-input3").click();
		});

		$("#image-input3").on("change", function()
		{
			const selectedImage = $(this).prop("files")[0];

			if (selectedImage)
			{
				var reader = new FileReader();

				reader.onload = function(e)
				{
					var image = new Image();
					image.src = e.target.result;

					// Check image resolutions
					image.onload = function()
					{
             var width = this.width;
             var height = this.height;

						if (width > 1080 || height > 720)
						{
							return alert("Resolusi atau ukuran gambar yang Anda pilih terlalu besar dari 720pixels. Silakan pilih gambar yang lebih kecil.\n\n[ Resolusi maksimal 1280x720pixels ]");
						}
						else
						{
							var base64String = e.target.result;

							$("#image-preview-product3").attr("src", base64String);
						}
					}
				}

				reader.readAsDataURL(selectedImage);
			}
		});
		
		$("#search-image4").on("click", function()
		{
			$("#image-input4").click();
		});

		$("#image-input4").on("change", function()
		{
			const selectedImage = $(this).prop("files")[0];

			if (selectedImage)
			{
				var reader = new FileReader();

				reader.onload = function(e)
				{
					var image = new Image();
					image.src = e.target.result;

					// Check image resolutions
					image.onload = function()
					{
             var width = this.width;
             var height = this.height;

						if (width > 1080 || height > 720)
						{
							return alert("Resolusi atau ukuran gambar yang Anda pilih terlalu besar dari 720pixels. Silakan pilih gambar yang lebih kecil.\n\n[ Resolusi maksimal 1280x720pixels ]");
						}
						else
						{
							var base64String = e.target.result;

							$("#image-preview-product4").attr("src", base64String);
						}
					}
				}

				reader.readAsDataURL(selectedImage);
			}
		});

  })



</script>
@endsection
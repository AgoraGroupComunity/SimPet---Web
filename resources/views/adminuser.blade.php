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
        <li><a href="#">
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

   
<section class="main">
    
      <div class="users">
        <div class="card">
          <h4>Total Pengguna</h4>
          <p id="totalUser">0</p>
        </div>
      </div>
      <section class="attendance">
        <div class="attendance-list">
          <h1>Daftar Pengguna</h1>
          {{-- <button class="btn_tambahproduk">tambah</button> --}}
          <table class="table" id="tableUser">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{-- <tr>
                <td>Budi</td>
                <td>Budi01</td>
                <td>budi01@gmail.com</td>
                <td>0856231549</td>
                <td>jl. sancang</td>
                <td><button class="hapus">Hapus</button></td>
              </tr> --}}
              
              

            </tbody>
          </table>
        </div>
      </section>
</section>
</section>

<script>
  $(document).ready(function(){
    function loadUser(){
      $.ajax({
        url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getUser",
        dataType: "json",
        type: "GET",
        success:function(res){
          console.log(res.name);
          
          var view ="";
          var totalUser = 0;
          res.forEach(element => {
            // console.log(element.username)
            // console.log(element.email)
            // console.log(element.address)
            
            totalUser+=1
            view += "<tr>"+
                "<td>"+((element.name ? ((element.name)) :""))+"</td>"+
                "<td>"+((element.username ? ((element.username)) :""))+"</td>"+
                "<td>"+((element.email ? ((element.email)) :""))+"</td>"+
                "<td>"+(element.phone ? element.phone:"")+"</td>"+
                "<td>"+(element.address ? element.address:"")+"</td>"+
                "<td>"+ 
                  "<button class='hapus ' data-id='"+element._id+"' id='delete'>Hapus</button>"+
                "</td>"
              "</tr>"
              
          });
           $("#tableUser tbody").html(view);
           $('#totalUser').html(totalUser)
        },
      })
    }

    loadUser();

    $("#tableUser").on("click", ".hapus", function () {
    var id = $(this).data("id");
    // alert (id);
    $.ajax({
      url:
        "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/deleteUser?id=" +
        id,
      type: "DELETE",
      beforeSend: function () {
        return confirm("Apakah Anda yakin anda akan menghapus data?");
      },
      success: function () {
        loadUser();
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  })



</script>

@endsection

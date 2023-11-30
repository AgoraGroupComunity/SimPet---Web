<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <br>
      <div class="container">
        <h1>Edit Produk</h1>

        <form action="" id="modaleddit">
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="" placeholder="Nama produk" value="" required>
            </div>


            <div class="mb-3">
                <label for="usia" class="form-label">Deskripsi</label>
                <input type="number" class="form-control" id="" placeholder="Deskripsi Produk" required>
            </div>

            <div class="mb-3">
                <label for="kode_prodi" class="form-label">Harga</label>
                <input type="text" class="form-control" id="" placeholder="Harga Product" required>
            </div>

            <input type="submit" class="btn btn-success btn-sm" value="Simpan" form="modaledit" id="save">
            <input type="button" class="btn btn-light btn-sm" value="Batal" id="cancel">
            <input type="hidden" id="id" name="id">
        </form>
      </div>
    
      </body>
</html>
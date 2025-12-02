<!DOCTYPE html>
<html lang="en">
<head>
    <title>List Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3>Buku Tamu</h3>
        <form method="POST" action="gbprosesmh.php">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nim</label>
                <input type="text" name="nim" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="name_mhs" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="name_mhs" class="form-control" id="name_mhs" required>
            </div>
            <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <button type="reset" name="reset" class="btn btn-primary">Reset</button>
            <a href="indexmh.php"><button type="button" name="index" class="btn btn-primary">Data Mahasiswa</button></a>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
<?php
$host       = "localhost";
$user       = "postgres";
$pass       = "postgres";
$db         = "sbdtugas";

$koneksi = pg_connect("host=$host dbname=$db user=$user password=$pass");
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nim        = "";
$nama       = "";
$semester   = "";
$nidn = "";
$dosen = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $nim         = $_GET['nim'];
    $pg         = "DELETE FROM mahasiswa WHERE nim = '$nim'";
    $q1         = pg_query($koneksi,$pg);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $nim         = $_GET['nim'];
    $pg          = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $q1         = pg_query($koneksi, $pg);
    $r1         = pg_fetch_array($q1);
    $nim        = $r1['nim'];
    $nama       = $r1['nama'];
    $semester     = $r1['semester'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $semester     = $_POST['semester'];

    if ($nim && $nama && $semester) {
        if ($op == 'edit') { //untuk update
            $pg       = "UPDATE mahasiswa SET nim = '$nim',nama='$nama',semester = '$semester' WHERE nim = '$nim'";
            $q1         = pg_query($koneksi, $pg);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $pg   = "insert into mahasiswa(nim,nama,semester) values ('$nim','$nama','$semester')";
            $q1     = pg_query($koneksi, $pg);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styleH.css">
    <style>
    .mx-auto {
	    width: 800px
    }

    .card {
	    margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="semester" name="semester" value="<?php echo $semester ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mahasiswa";
                        $q2     = pg_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = pg_fetch_array($q2)) {
                            $nim        = $r2['nim'];
                            $nama       = $r2['nama'];
                            $semester     = $r2['semester'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $semester ?></td>
                                <td scope="row">
            <a href="index.php?op=edit&nim=<?php echo $nim ?>"><button type="button" class="btn btn-warning">Edit</button></a>
            <a href="index.php?op=delete&nim=<?php echo $nim ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
        </td>
    </tr>
<?php
}
                        ?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data Dosen
            </div>
            <div class="card-body">
                <?php if ($error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php } ?>
                <?php if ($sukses) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nidn" class="col-sm-2 col-form-label">NIDN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nidn" name="nidn" value="<?php echo $nidn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="dosen" class="col-sm-2 col-form-label">Dosen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="dosen" name="dosen" value="<?php echo $dosen ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Dosen
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIDN</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from Dosen";
                        $q2     = pg_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = pg_fetch_array($q2)) {
                            $nidn        = $r2['nidn'];
                            $dosen       = $r2['dosen'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nidn ?></td>
                                <td scope="row"><?php echo $dosen ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</body>
</html>
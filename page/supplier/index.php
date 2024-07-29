<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
       <div class="d-flex justify-content-between mb-3">
            <h3>Supplier</h3>
            <a href="index.php?page=supplier&act=tambah" class="btn btn-secondary ">Tambah Supplier</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>No Rekening</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pdo = koneksi::connect();
                    $sql = 'SELECT * FROM supplier';
                    foreach ($pdo->query($sql) as $row){
                    ?>
                        <tr>
                            <td><?php echo ($row['nama']); ?></td>
                            <td><?php echo ($row['alamat']); ?></td>
                            <td><?php echo ($row['email']); ?></td>
                            <td><?php echo ($row['no_telp']); ?></td>
                            <td><?php echo ($row['no_rekening']); ?></td>
                            <td>
                                <a href="index.php?page=supplier&act=edit&id_supplier=<?php echo $row['id_supplier'] ?>" class="btn btn-warning btn-sm">
                                   <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="index.php?page=supplier&act=hapus&id_supplier=<?php echo $row['id_supplier'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    koneksi::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

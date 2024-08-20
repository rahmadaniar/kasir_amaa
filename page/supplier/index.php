<?php
// Redirection untuk user dengan role "Kasir"
if ($_SESSION['user']['role'] == "Kasir") {
    echo "<script>window.location.href = 'index.php'</script>";
    exit(); 
}

// Tampilkan alert sukses jika supplier berhasil diedit
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Supplier berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Supplier</h3>
        <a href="index.php?page=supplier&act=tambah" class="btn btn-secondary">Tambah Supplier</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
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
                // Koneksi ke database dan ambil data supplier
                $pdo = koneksi::connect();
                $supplier = Supplier::getInstance($pdo);
                $dataSupplier = $supplier->getAll();
                $no = 1;
                foreach ($dataSupplier as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_rekening']); ?></td>
                        <td>
                            <a href="index.php?page=supplier&act=edit&id_supplier=<?php echo htmlspecialchars($row['id_supplier']); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_supplier']); ?>'); return false;">
                                <i class="fas fa-trash"></i>
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

<script>
    function hapus(id_supplier) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL hapus setelah konfirmasi
                window.location.href = `index.php?page=supplier&act=hapus&id_supplier=${id_supplier}`;
            }
        });
    }
</script>

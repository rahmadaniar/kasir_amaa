<?php
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Member berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Member</h3>
        <a href="index.php?page=member&act=tambah" class="btn btn-secondary">Tambah Member</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Total Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $member = Member::getInstance($pdo);
                $dataMember = $member->getAll();
                $no = 1;
                foreach ($dataMember as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_poin']); ?></td>
                        <td>
                            <a href="index.php?page=member&act=edit&id_member=<?php echo htmlspecialchars($row['id_member']); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_member']); ?>'); return false;">
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
    function hapus(id_member) {
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
                window.location.href = `index.php?page=member&act=hapus&id_member=${id_member}`;
            }
        });
    }
</script>

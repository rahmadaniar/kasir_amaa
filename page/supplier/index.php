<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Supplier</h3>
        <a href="index.php?page=supplier&act=tambah" class="btn btn-secondary ">Tambah Supplier</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered ">
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
                $pdo = koneksi::connect();
                $supplier = supplier::getInstance($pdo);
                $dataSupplier = $supplier->getAll();
                $no = 1;
                foreach ($dataSupplier as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo ($row['nama_supplier']); ?></td>
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



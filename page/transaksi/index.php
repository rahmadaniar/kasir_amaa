<?php
include_once "database/class/transaksi.php";
include_once "database/class/member.php";
include_once "database/class/barang.php";
$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$member = Member::getInstance($pdo);
$barang = Barang::getInstance($pdo);

$kodeNota = $transaksi->generateKodeNota();
$memberUmum = $member->getUmum();
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaksi</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container-fluid">
        <!-- BARISAN PERTAMA -->
        <div class="row">
            <!-- BAGIAN PERTAMA: Input tanggal, kasir, dan member -->
            <div class="col-lg-4">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="tanggal" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-9">
                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="kasir" class="col-sm-3 col-form-label">Kasir</label>
                        <div class="col-9">
                            <input type="text" name="kasir" class="form-control" value="<?= $_SESSION['user']['nama'] ?>" id="kasir" data-kasirid="<?= $_SESSION['user']['id_user'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="member" class="col-sm-3 col-form-label">Member</label>
                        <div class="col-9">
                            <select name="member" id="member" class="form-control">
                                <option value="<?= $memberUmum ?>">Umum</option>
                                <?php foreach ($member->getAll() as $row): ?>
                                    <?php if ($row['nama'] != 'Umum'): ?>
                                        <option value="<?= $row['id_member'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KEDUA: Input barang dan kuantitas -->
            <div class="col-lg-4">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="barang" class="col-sm-3 col-form-label">Barang</label>
                        <div class="col-9">
                            <select name="barang" id="barang" class="form-control">
                                <option value="">-Pilih Barang-</option>
                                <?php foreach ($barang->getAll() as $row): ?>
                                    <option data-harga="<?= $row['harga'] ?>" value="<?= $row['id_barang'] ?>"><?= $row['nama'] ?>    Rp. <?= $row['harga'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="qty" class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-9">
                            <input type="number" name="qty" class="form-control" id="qty">
                        </div>
                    </div>
                    <!-- Tombol untuk menambahkan barang ke daftar transaksi -->
                    <div class="form-group row">
                        <label for="btnTambahBarang" class="col-sm-3 col-form-label"></label>
                        <div class="col-9">
                            <button id="btnTambahBarang" class="btn btn-info"> Tambahkan </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KETIGA: Menampilkan subtotal dan invoice -->
            <div class="col-lg-4">
                <div class="card card-outline card-warning p-3">
                    <div class="text-right">
                        <p>Invoice <span><b><?= $kodeNota ?></b></span></p>
                        <h3 class="display-1" id="subtotalDisplay"><b>0</b></h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR BARISAN PERTAMA -->

        <!-- BARISAN KEDUA: Tabel transaksi -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR BARISAN KEDUA -->

        <!-- BARISAN KETIGA: Detail transaksi -->
        <div class="row mt-2">
            <!-- BAGIAN PERTAMA: Input subtotal, diskon, dan PPN -->
            <div class="col-lg-3">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="subtotal" class="col-sm-5 col-form-label">Subtotal</label>
                        <div class="col-7">
                            <input type="number" name="subtotal" class="form-control" id="subtotal" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="total_diskon" class="col-sm-5 col-form-label">Diskon</label>
                        <div class="col-7">
                            <input type="number" name="total_diskon" class="form-control" id="total_diskon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ppn" class="col-sm-5 col-form-label">PPN %</label>
                        <div class="col-7">
                            <input type="number" name="ppn" class="form-control" id="ppn">
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KEDUA: Input total transaksi dan tunai -->
            <div class="col-lg-3">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row">
                        <label for="total_transaksi" class="col-sm-5 col-form-label">Total Transaksi</label>
                        <div class="col-7">
                            <input type="number" name="total_transaksi" class="form-control" id="total_transaksi" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="nominal_tunai" class="col-sm-5 col-form-label">Nominal</label>
                        <div class="col-7">
                            <input type="number" oninput="hitungTotal()" name="nominal_tunai" class="form-control" id="nominal_tunai">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="kembalian" class="col-sm-5 col-form-label">Kembalian</label>
                        <div class="col-7">
                            <input type="number" name="kembalian" class="form-control" id="kembalian" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KETIGA: Input catatan atau pesan -->
            <div class="col-lg-3">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="catatan" class="col-sm-4 col-form-label">Pesan</label>
                        <div class="col-8">
                            <textarea name="pesan" id="pesan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KEEMPAT: Tombol simpan transaksi -->
            <div class="col-lg-3">
                <div class="form-group row mb-3">
                    <div class="d-flex flex-column col-12">
                        <button class="btn btn-danger mb-2 col-5" id="btnBatalkan">
                            Batalkan
                        </button>
                        <button class="btn btn-primary mb-2 col-5" id="btnProses">
                            Proses
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR BARISAN KETIGA -->
    </div>
</section>

<script>

    document.getElementById('btnTambahBarang').addEventListener('click', function(event) {
        event.preventDefault();

        var barangSelect = document.getElementById('barang');
        var selectedBarangText = barangSelect.options[barangSelect.selectedIndex].text.split(' - ')[0];
        var selectedBarangValue = barangSelect.value;
        var selectedBarangHarga = barangSelect.options[barangSelect.selectedIndex].dataset.harga;
        var qty = document.getElementById('qty').value;

        if (selectedBarangValue === "" || qty === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Barang dan quantity harus diisi.',
                confirmButtonText: 'OK'
            });
            return;
        }

        var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
        var existingRow = null;
        for (var i = 0, row; row = table.rows[i]; i++) {
            if (row.cells[1].dataset.barangId === selectedBarangValue) {
                existingRow = row;
                break;
            }
        }

        if (existingRow) {
            var newQty = parseInt(existingRow.cells[3].innerText) + parseInt(qty);
            existingRow.cells[3].innerText = newQty;
            existingRow.cells[4].innerText = calculateTotal(selectedBarangHarga, newQty);
        } else {
            var total = calculateTotal(selectedBarangHarga, qty);
            var newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${table.rows.length + 1}</td>
                <td data-barang-id="${selectedBarangValue}">${selectedBarangText}</td>
                <td>Rp. ${selectedBarangHarga}</td>
                <td>${qty}</td>
                <td>Rp. ${total}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm btnEditQty">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm btnHapusBarang">Hapus</button>
                </td>
            `;
        }

        table.querySelectorAll('.btnHapusBarang').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
                hitungTotal(); // Panggil fungsi hitungTotal setelah baris dihapus
            });
        });

        table.querySelectorAll('.btnEditQty').forEach(function(button) {
            button.addEventListener('click', function() {
                var row = this.closest('tr');
                var currentQty = row.cells[3].innerText;
                barangSelect.value = row.cells[1].dataset.barangId;
                document.getElementById('qty').value = currentQty;
                row.remove();
                hitungTotal(); // Panggil fungsi hitungTotal setelah baris dihapus
            });
        });

        barangSelect.value = "";
        document.getElementById('qty').value = "";
        hitungTotal(); // Panggil fungsi hitungTotal setelah barang ditambahkan
    });

    function calculateTotal(harga, qty) {
        return harga * qty;
    }

    function hitungTotal() {
    var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
    var subtotal = 0;

    for (var i = 0, row; row = table.rows[i]; i++) {
        var total = parseInt(row.cells[4].innerText.replace('Rp. ', '').replace(/,/g, ''));
        subtotal += total;
    }

    var total_diskon = document.getElementById('total_diskon').value ? parseInt(document.getElementById('total_diskon').value) : 0;
    var subtotalAfterDiskon = subtotal - total_diskon;
    var ppn = document.getElementById('ppn').value ? parseInt(document.getElementById('ppn').value) : 0;
    var ppnValue = (ppn / 100) * subtotalAfterDiskon;
    var totalTransaksi = subtotalAfterDiskon + ppnValue;

    document.getElementById('subtotal').value = subtotal;
    document.getElementById('total_transaksi').value = totalTransaksi;

    // Update nilai yang ditampilkan pada layar
    document.getElementById('subtotalDisplay').innerText = `Rp. ${subtotal.toLocaleString()}`;

    let nominal_tunai = document.getElementById('nominal_tunai').value;
    
    // Logika untuk menghitung kembalian, bisa negatif jika nominal tunai kurang dari total transaksi
    let kembalian = nominal_tunai - totalTransaksi;
    document.getElementById('kembalian').value = kembalian;

    // Jika ingin menampilkan kembalian di dalam elemen lain (misalnya elemen display di UI), bisa ditambahkan seperti ini:
    document.getElementById('kembalianDisplay').innerText = `Rp. ${kembalian.toLocaleString()}`;
}


    document.getElementById('total_diskon').addEventListener('input', hitungTotal);
    document.getElementById('ppn').addEventListener('input', hitungTotal);

    document.getElementById('btnProses').addEventListener('click', function(event) {
    event.preventDefault();

    let kembalian = document.getElementById('kembalian').value;

    if (kembalian < 0) {
        Swal.fire({
            icon: 'error',
            title: 'Transaksi Gagal',
            text: 'Uang anda tidak cukup. Jangan ngutang disini!.',
            confirmButtonText: 'OK'
        });
        return;
    }

        const kasirElem = document.getElementById('kasir');
        const totalTransaksiElem = document.getElementById('total_transaksi');
        const totalDiskonElem = document.getElementById('total_diskon');
        const nominalTunaiElem = document.getElementById('nominal_tunai');
        const ppnElem = document.getElementById('ppn');
        const kembalianElem = document.getElementById('kembalian');
        const tanggalElem = document.getElementById('tanggal');
        const pesanElem = document.getElementById('pesan');
        const idMemberElem = document.getElementById('member');
        const subtotalElem = document.getElementById('subtotal');

        const transaksi = {
            id_user: kasirElem.dataset.kasirid,
            total_transaksi: totalTransaksiElem.value,
            total_diskon: totalDiskonElem.value,
            nominal_tunai: nominalTunaiElem.value,
            ppn: ppnElem.value,
            kembalian: kembalianElem.value,
            tanggal: tanggalElem.value,
            invoice: "<?= $kodeNota ?>",
            pesan: pesanElem.value,
            id_member: idMemberElem.value,
            subtotal: subtotalElem.value
        };

        const transaksiDetails = [];
        const tableRows = document.querySelectorAll('#myTable tbody tr');
        tableRows.forEach(row => {
            const detail = {
                id_barang: row.cells[1].dataset.barangId,
                qty: row.cells[3].innerText,
                harga: row.cells[2].innerText.replace('Rp. ', '').replace(/\./g, ''),
                subtotal: row.cells[4].innerText.replace('Rp. ', '').replace(/\./g, '')
            };
            transaksiDetails.push(detail);
        });

        const data = {
            transaksi: transaksi,
            transaksiDetails: transaksiDetails
        };

        fetch('page/transaksi/tambah.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Transaksi berhasil disimpan!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menyimpan transaksi: ' + result.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan pada server.',
                    confirmButtonText: 'OK'
                });
            });
    });

    document.getElementById('btnBatalkan').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin membatalkan transaksi?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak'
        }).then(result => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    });
</script>

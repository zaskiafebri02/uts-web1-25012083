<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/data/menu.php";

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$info_total = hitungTotal($_SESSION['keranjang']);
?>

<h2>🛒 Keranjang Pesanan</h2>
<?php tampilFlashMessage(); ?>

<?php if (empty($_SESSION['keranjang'])): ?>
    <div class="alert alert-info">
        🛒 Keranjang Anda masih kosong. Silakan pilih menu di 
        <a href="index.php" style="color:#0c5460; font-weight:bold;">Daftar Menu</a>.
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($_SESSION['keranjang'] as $kode => $item): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($item['nama']); ?></td>
                <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($item['jumlah']); ?></td>
                <td>Rp <?php echo number_format(hitungSubtotal($item['harga'], $item['jumlah']), 0, ',', '.'); ?></td>
                <td>
                    <form action="proses.php" method="post">
                        <input type="hidden" name="kode" value="<?php echo htmlspecialchars($kode); ?>">
                        <button type="submit" name="hapus" style="background:#dc3545;">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Kotak Total & Diskon -->
    <div style="background:#f8f9fa; padding:20px; border-radius:8px; margin-top:20px; text-align:right;">
        <p>Subtotal Pesanan: <strong>Rp <?php echo number_format($info_total['subtotal'], 0, ',', '.'); ?></strong></p>
        <p>Diskon (≥ Rp50.000 → 10%): <strong>Rp <?php echo number_format($info_total['diskon'], 0, ',', '.'); ?></strong></p>
        <p style="font-size:1.4rem; font-weight:bold; color:#28a745; border-top:2px dashed #ddd; padding-top:10px; margin-top:10px;">
            Total Pembayaran: Rp <?php echo number_format($info_total['total_akhir'], 0, ',', '.'); ?>
        </p>
        <small style="color:#6c757d;">* Diskon 10% berlaku jika pesanan minimal Rp50.000</small>
    </div>

    <div style="margin-top:20px;">
        <form action="proses.php" method="post" style="display:inline;">
            <button type="submit" name="kosongkan" style="background:#ffc107; color:#212529;">🧹 Kosongkan Keranjang</button>
        </form>
        <a href="index.php" style="display:inline-block; padding:10px 15px; background:#6c757d; color:white; border-radius:6px; text-decoration:none; margin-left:10px;">
            ← Kembali Pilih Menu
        </a>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
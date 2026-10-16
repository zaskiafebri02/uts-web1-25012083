<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/data/menu.php";

// === KATEGORI FAVORIT — COOKIE ===
$kategori_pilih = "Semua";

if (isset($_GET['kategori']) && in_array($_GET['kategori'], $daftar_kategori)) {
    $kategori_pilih = $_GET['kategori'];
    setcookie("kategori_favorit", $kategori_pilih, time() + (86400 * 7), "/");
} elseif (isset($_COOKIE['kategori_favorit']) && in_array($_COOKIE['kategori_favorit'], $daftar_kategori)) {
    $kategori_pilih = $_COOKIE['kategori_favorit'];
}

// === PENCARIAN ===
$kata_kunci = "";
$hasil_menu = $daftar_menu;

if (!empty($_GET['cari'])) {
    $kata_kunci = trim($_GET['cari']);
    $hasil_menu = [];
    foreach ($daftar_menu as $m) {
        if (stripos($m['nama'], $kata_kunci) !== false) {
            $hasil_menu[$m['kode']] = $m;
        }
    }
}

// Filter kategori
if ($kategori_pilih !== "Semua") {
    $filtered = [];
    foreach ($hasil_menu as $m) {
        if ($m['kategori'] === $kategori_pilih) {
            $filtered[$m['kode']] = $m;
        }
    }
    $hasil_menu = $filtered;
}
?>

<h2>📋 Daftar Menu Kantin</h2>

<!-- Pilihan Kategori -->
<div class="kategori-box">
    <strong>Kategori:</strong>
    <?php foreach ($daftar_kategori as $kat): ?>
        <a href="index.php?kategori=<?php echo urlencode($kat); ?>"
           style="background:<?php echo ($kat === $kategori_pilih) ? '#28a745; color:white' : '#e9ecef; color:#333'; ?>">
            <?php echo htmlspecialchars($kat); ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Form Pencarian -->
<form method="get" action="index.php" class="cari-box">
    <input type="text" name="cari" placeholder="Cari nama menu..."
           value="<?php echo htmlspecialchars($kata_kunci); ?>">
    <?php if ($kategori_pilih !== "Semua"): ?>
        <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($kategori_pilih); ?>">
    <?php endif; ?>
    <button type="submit">🔍 Cari</button>
</form>

<?php tampilFlashMessage(); ?>

<?php if (!empty($kata_kunci)): ?>
    <p>Hasil pencarian: <strong><?php echo htmlspecialchars($kata_kunci); ?></strong></p>
<?php endif; ?>

<?php if (empty($hasil_menu)): ?>
    <div class="alert alert-info">❌ Menu yang Anda cari tidak ditemukan.</div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil_menu as $menu): ?>
            <tr>
                <td><?php echo htmlspecialchars($menu['kode']); ?></td>
                <td><?php echo htmlspecialchars($menu['nama']); ?></td>
                <td><?php echo htmlspecialchars($menu['kategori']); ?></td>
                <td>Rp <?php echo number_format($menu['harga'], 0, ',', '.'); ?></td>
                <td>
                    <form action="proses.php" method="post">
                        <input type="hidden" name="kode" value="<?php echo htmlspecialchars($menu['kode']); ?>">
                        <input type="text" name="jumlah"  value="1" style="width:60px">
                        <button type="submit" name="tambah">➕</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
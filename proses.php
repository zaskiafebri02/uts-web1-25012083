<?php
require_once __DIR__ . "/includes/fungsi.php";
require_once __DIR__ . "/data/menu.php";

// Inisialisasi Keranjang
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

// === TAMBAH PESANAN ===
if (isset($_POST['tambah'])) {
    $kode = isset($_POST['kode']) ? trim($_POST['kode']) : '';
    $jumlah = isset($_POST['jumlah']) ? trim($_POST['jumlah']) : '';
    $jumlah_valid = true;
    $pesan_error = '';

    // Validasi Kode Menu
    if (!isset($daftar_menu[$kode])) {
        $pesan_error = "❌ Kode menu tidak terdaftar!";
        $jumlah_valid = false;
    }

    // Validasi Jumlah
    if ($jumlah_valid) {
        if ($jumlah === '') {
            $pesan_error = "❌ Jumlah tidak boleh kosong!";
            $jumlah_valid = false;
        } elseif (!is_numeric($jumlah)) {
            $pesan_error = "❌ Jumlah harus berupa angka!";
            $jumlah_valid = false;
        } else {
            $jml_float = (float)$jumlah;
            if ($jml_float <= 0) {
                $pesan_error = "❌ Jumlah harus lebih dari 0!";
                $jumlah_valid = false;
            } elseif ($jml_float > 10) {
                $pesan_error = "❌ Maksimal pembelian 10 item!";
                $jumlah_valid = false;
            } elseif ($jml_float != (int)$jml_float) {
                $pesan_error = "❌ Jumlah harus bilangan bulat!";
                $jumlah_valid = false;
            }
        }
    }

    // Jika ada error → kembali ke halaman sebelumnya dengan pesan
    if (!$jumlah_valid) {
        setFlashMessage($pesan_error, "error");
        header("Location: index.php");
        exit;
    }

    // Ambil data menu dari server saja
    $menu = $daftar_menu[$kode];
    $jml_int = (int)$jumlah;

    // Cek apakah sudah ada di keranjang → gabung jumlahnya
    if (isset($_SESSION['keranjang'][$kode])) {
        $total_baru = $_SESSION['keranjang'][$kode]['jumlah'] + $jml_int;
        if ($total_baru > 10) {
            setFlashMessage("⚠️ Jumlah '" . $menu['nama'] . "' sudah 10! Tidak boleh melebihi batas.", "error");
            header("Location: keranjang.php");
            exit;
        }
        $_SESSION['keranjang'][$kode]['jumlah'] = $total_baru;
    } else {
        $_SESSION['keranjang'][$kode] = array(
            'nama' => $menu['nama'],
            'harga' => $menu['harga'],
            'jumlah' => $jml_int
        );
    }

    setFlashMessage("✅ " . $menu['nama'] . " — " . $jml_int . "x berhasil ditambahkan ke keranjang!", "sukses");
    header("Location: keranjang.php");
    exit;
}

// === HAPUS SATU ITEM ===
if (isset($_POST['hapus'])) {
    $kode = isset($_POST['kode']) ? trim($_POST['kode']) : '';
    if (isset($_SESSION['keranjang'][$kode])) {
        $nama = $_SESSION['keranjang'][$kode]['nama'];
        unset($_SESSION['keranjang'][$kode]);
        setFlashMessage("🗑️ Item '$nama' telah dihapus dari keranjang.", "sukses");
    }
    header("Location: keranjang.php");
    exit;
}

// === KOSONGKAN KERANJANG ===
if (isset($_POST['kosongkan'])) {
    $_SESSION['keranjang'] = array();
    setFlashMessage("🧹 Keranjang telah dikosongkan.", "info");
    header("Location: keranjang.php");
    exit;
}

// Jika akses tidak sah → kembali ke halaman utama
header("Location: index.php");
exit;
?>
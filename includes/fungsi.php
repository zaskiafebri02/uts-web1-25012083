<?php
session_start();

// Hitung subtotal per item
function hitungSubtotal($harga, $jumlah) {
    return $harga * $jumlah;
}

// Hitung total, diskon & akhir
function hitungTotal($keranjang) {
    $subtotal_semua = 0;
    foreach ($keranjang as $item) {
        $subtotal_semua += $item['harga'] * $item['jumlah'];
    }
    
    $diskon = 0;
    if ($subtotal_semua >= 50000) {
        $diskon = $subtotal_semua * 0.10; // 10%
    }
    
    $total_akhir = $subtotal_semua - $diskon;
    
    return [
        'subtotal' => $subtotal_semua,
        'diskon' => $diskon,
        'total_akhir' => $total_akhir
    ];
}

// Pesan flash (tampil 1 kali saja)
function setFlashMessage($pesan, $tipe = "sukses") {
    $_SESSION['flash'] = [
        'pesan' => $pesan,
        'tipe' => $tipe
    ];
}

function tampilFlashMessage() {
    if (isset($_SESSION['flash'])) {
        $html = '<div class="alert alert-' . $_SESSION['flash']['tipe'] . '">';
        $html .= htmlspecialchars($_SESSION['flash']['pesan']);
        $html .= '</div>';
        echo $html;
        unset($_SESSION['flash']);
    }
}
?>
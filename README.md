# UTS Web I — Aplikasi Pemesanan Kantin Kampus

## 📋 Identitas Mahasiswa
- Nama: Zaskia Febriani Noer
- NIM: 25012083 
- Kelas: 25M31
- Mata Kuliah: Pemrograman Web I
- Program Studi: D3 Manajemen Informatika
- Institusi: Politeknik Ganesha Medan

---

## 📝 Deskripsi Aplikasi
Aplikasi pemesanan menu kantin kampus berbasis web menggunakan **PHP Native** tanpa framework dan tanpa database. Pengguna dapat melihat daftar menu, mencari menu berdasarkan nama, memfilter berdasarkan kategori, menambahkan pesanan ke keranjang belanja, melihat total pembayaran dengan sistem diskon, serta menyimpan kategori favorit. Keranjang belanja disimpan menggunakan **Session PHP**, dan preferensi kategori disimpan menggunakan **Cookie**.

---

## 💻 Kebutuhan Sistem
- **Web Server:** Apache (XAMPP 3.2.1 atau versi lebih baru)
- **PHP:** Versi 7.0 atau lebih baru
- **Browser Web:** Google Chrome, Mozilla Firefox, Microsoft Edge, atau Safari
- **Database:** Tidak diperlukan — data disimpan dalam Array PHP

---

## 📁 Struktur Folder Project
---

## ✅ Daftar Fitur yang Telah Dikerjakan

### Tahap 1 — Inisialisasi Project
- ✅ Membuat struktur folder sesuai ketentuan
- ✅ Membuat file README.md berisi identitas dan dokumentasi

### Tahap 2 — Daftar Menu dan Pencarian Selesai
- ✅ Menyediakan minimal 5 menu dalam bentuk array asosiatif
- ✅ Setiap menu berisi: kode unik, nama, kategori, dan harga
- ✅ Menampilkan seluruh menu menggunakan perulangan `foreach`
- ✅ Fitur pencarian nama menu menggunakan metode **GET**
- ✅ Menampilkan pesan informatif ketika hasil pencarian tidak ditemukan
- ✅ Filter menu berdasarkan kategori

### Tahap 3 — Form Pemesanan dan Validasi Input Selesai
- ✅ Form penambahan pesanan menggunakan metode **POST**
- ✅ Validasi di sisi server:
- Kode menu harus terdaftar dalam daftar menu
- Jumlah pembelian tidak boleh kosong, negatif, nol, atau bilangan pecahan
- Jumlah pembelian harus dalam rentang **1–10**
- ✅ Harga diambil langsung dari data menu di server
- ✅ Input yang tidak valid menampilkan pesan kesalahan tanpa mengubah isi keranjang
- ✅ Penerapan `htmlspecialchars()` untuk mencegah eksekusi kode berbahaya saat menampilkan input pengguna

### Tahap 4 — Keranjang Belanja dengan Session Selesai
- ✅ Keranjang disimpan dalam variabel superglobal `$_SESSION`
- ✅ Menampilkan nama menu, harga satuan, jumlah, dan subtotal per item
- ✅ Jika menu yang sama ditambahkan kembali, jumlah akan digabungkan
- ✅ Batas maksimal jumlah per item adalah **10**
- ✅ Fitur hapus satu item dan kosongkan seluruh keranjang
- ✅ Menampilkan pesan ketika keranjang masih kosong
- ✅ Isi keranjang tetap tersedia meskipun pengguna berpindah halaman atau me-refresh browser

### Tahap 5 — Fungsi Perhitungan dan Diskon
- ✅ Membuat dan menggunakan fungsi khusus untuk perhitungan:
- `hitungSubtotal($harga, $jumlah)` — menghitung harga × jumlah
- `hitungTotal($keranjang)` — menghitung subtotal seluruh pesanan, diskon, dan total akhir
- ✅ Pemberian diskon **10%** apabila subtotal pesanan minimal **Rp50.000**
- Subtotal **Rp49.000** → Diskon Rp0 → Total akhir Rp49.000
- Subtotal **Rp50.000** → Diskon Rp5.000 → Total akhir Rp45.000

### Tahap 6 — Pemisahan File dan Post/Redirect/Get
- ✅ Memisahkan komponen ke dalam file terpisah menggunakan `include` dan `require`
- ✅ Setelah pemrosesan POST berhasil, halaman dialihkan menggunakan `header()`
- ✅ Pesan notifikasi (flash message) hanya ditampilkan satu kali
- ✅ Melakukan refresh halaman tidak akan mengulangi penambahan pesanan

### Tahap 7 — Preferensi Kategori dengan Cookie
- ✅ Menyimpan kategori yang dipilih ke dalam **Cookie** selama **7 hari**
- ✅ Saat halaman dibuka kembali, kategori yang dipilih sebelumnya otomatis aktif dari Cookie
- ✅ Jika ada parameter `?kategori=` melalui URL, nilai tersebut yang digunakan (prioritas: **GET > Cookie**)
- ✅ Validasi kategori agar sesuai dengan daftar kategori yang tersedia

---

## 📋 Ringkasan Skenario Pengujian
Seluruh skenario pengujian tercatat lengkap beserta bukti screenshot di folder: `dokumentasi/pengujian/README.md`

| ID | Skenario Pengujian | Status |
|----|---------------------|--------|
| U01 | Menampilkan daftar menu | ✅ Lulus |
| U02 | Pencarian menu — ditemukan & tidak ditemukan | ✅ Lulus |
| U03 | Validasi input jumlah (kosong, negatif, pecahan, 0, >10) | ✅ Lulus |
| U04 | Validasi kode menu tidak terdaftar | ✅ Lulus |
| U05 | Penggabungan jumlah & batas maksimal 10 | ✅ Lulus |
| U06 | Session keranjang tetap ada saat pindah halaman & refresh | ✅ Lulus |
| U07 | Redirect setelah POST & flash message satu kali | ✅ Lulus |
| U08 | Perhitungan diskon Rp49.000 vs Rp50.000 | ✅ Lulus |
| U09 | Hapus satu item & kosongkan keranjang | ✅ Lulus |
| U10 | Penyimpanan kategori favorit dengan Cookie | ✅ Lulus |
| U11 | Keamanan tampilan input pengguna (escaping) | ✅ Lulus |

---

## 🛠 Teknologi yang Digunakan
| Teknologi | Keterangan |
|-----------|------------|
| PHP 7+ | Bahasa pemrograman sisi server — Native, tanpa framework |
| Session PHP | Menyimpan data keranjang selama sesi aktif |
| Cookie PHP | Menyimpan preferensi kategori selama 7 hari |
| HTML5 | Struktur halaman web |
| CSS3 | Desain dan tampilan halaman |
| XAMPP 3.2.1 | Paket web server lokal |

---

## 📌 Catatan Penting
- ❌ **Tidak menggunakan database** — semua data menu disimpan dalam array PHP
- ❌ **Tidak menggunakan framework PHP** — murni kode PHP Native
- ✅ Validasi dilakukan di sisi server, bukan hanya di browser
- ✅ Semua input pengguna dibersihkan saat ditampilkan ke halaman HTML
- ✅ Repository GitHub bersifat publik/dapat diakses dosen
- ✅ Terdapat minimal 7 commit bertahap sesuai ketentuan soal

---

> Terima kasih kepada Bapak/Ibu Dosen Pengampu Mata Kuliah Web I. Semoga aplikasi ini memenuhi ketentuan Ujian Tengah Semester. Semangat dan sehat selalu! 😊


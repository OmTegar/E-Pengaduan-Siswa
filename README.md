# Pengaduan Siswa

## Deskripsi

Aplikasi Pengaduan Siswa adalah sebuah platform yang memungkinkan siswa untuk melaporkan masalah atau keluhan yang mereka hadapi di sekolah. Aplikasi ini bertujuan untuk memudahkan siswa dalam menyampaikan pengaduan mereka kepada pihak sekolah.

## Fitur

- Formulir pengaduan: Siswa dapat mengisi formulir pengaduan dengan detail masalah yang mereka alami.
- Lampiran: Siswa dapat melampirkan bukti atau dokumen pendukung terkait pengaduan mereka.
- Status pengaduan: Siswa dapat melihat status pengaduan mereka, apakah sudah diproses atau belum.
- Notifikasi: Siswa akan menerima notifikasi melalui email atau aplikasi ketika pengaduan mereka telah diproses.

## Instalasi

1. Clone repositori ini ke dalam direktori lokal:

    ```bash
    git clone https://github.com/OmTegar/E-Pengaduan-Siswa.git
    ```

2. Masuk ke direktori pengaduan-siswa:

    ```bash
    cd pengaduan-siswa
    ```

3. Install dependensi yang diperlukan:

    ```bash
    npm install
    ```

4. Konfigurasi file `.env` dengan mengisi nilai-nilai berikut:

    ```plaintext
    PORT=3000
    DB_HOST=localhost
    DB_PORT=5432
    DB_NAME=pengaduan_siswa
    DB_USER=username
    DB_PASSWORD=password
    ```

5. Jalankan aplikasi:

    ```bash
    npm run build
    ```

## Kontribusi

Kami sangat terbuka untuk kontribusi dari siapa saja. Jika Anda ingin berkontribusi pada proyek ini, silakan ikuti langkah-langkah berikut:

1. Fork repositori ini.
2. Buat branch baru:

    ```bash
    git checkout -b fitur-baru
    ```

3. Lakukan perubahan yang diperlukan.
4. Commit perubahan Anda:

    ```bash
    git commit -m "Menambahkan fitur baru"
    ```

5. Push ke branch Anda:

    ```bash
    git push origin fitur-baru
    ```

6. Buat pull request ke repositori utama.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

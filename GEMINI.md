# Connetic E-Modul: Dokumentasi Proyek & Panduan Pengembangan

E-Modul interaktif berbasis web untuk pembelajaran siswa dengan alur terstruktur, sistem penguncian sekuensial (Sequential Locking), dan pendekatan Contextual Teaching and Learning (CTL).

## 1. Alur Global (Global Workflow)

Sistem mengikuti alur linier yang ketat untuk memastikan integritas proses pembelajaran:

1.  **Entry Phase:**
    *   **Welcome Screen:** Informasi umum modul.
    *   **Login/Register:** Autentikasi siswa.
2.  **Global Pretest:**
    *   **Wajib:** Harus diselesaikan satu kali di awal sebelum Dashboard Utama terbuka.
3.  **Core Learning (Pertemuan 1-4):**
    *   **In-Meeting Pretest:** Membuka akses ke 7 Aktivitas di dalam pertemuan tersebut.
    *   **7 Activities (CTL):**
        1.  Konstruktivisme (Constructivism)
        2.  Inkuiri (Inquiry)
        3.  Bertanya (Questioning)
        4.  Masyarakat Belajar (Learning Community)
        5.  Pemodelan (Modeling)
        6.  Refleksi (Reflection)
        7.  Asesmen Otentik (Authentic Assessment) - *LKPD Terintegrasi*
    *   **In-Meeting Posttest:** Syarat kelulusan pertemuan. Harus mencapai KKM untuk membuka pertemuan berikutnya.
4.  **Global Posttest:**
    *   Terbuka secara otomatis setelah Pertemuan 4 dinyatakan lulus.
5.  **Exit Phase:**
    *   Tampilan Hasil Akhir (Grafik peningkatan nilai).
    *   Logout.

## 2. Fitur Utama & Visual Standar

### Sequential Locking (Sistem Gembok)
*   **Mekanisme:** Aktivitas `n` hanya bisa diakses jika aktivitas `n-1` sudah berstatus "Selesai".
*   **Dashboard:** Menampilkan status pertemuan (Terkunci/Terbuka).

### Interactive Cards (Visual Feedback)
Visualisasi kartu aktivitas menggunakan kode warna berikut:
*   🔵 **Biru (Aktif):** Aktivitas yang sedang berlangsung atau siap dikerjakan.
*   ⚪ **Abu-abu (Terkunci):** Aktivitas yang belum memenuhi syarat akses.
*   🟢 **Hijau + Checkmark (Selesai):** Aktivitas yang telah berhasil diselesaikan.

### Real-time Scoring & Remedial
*   **Instant Result:** Nilai Posttest muncul segera setelah submit.
*   **Logic:**
    *   `Nilai >= KKM`: Tombol "Lanjut ke Pertemuan Berikutnya" muncul.
    *   `Nilai < KKM`: Tombol "Remedial" muncul (mengulang Posttest/Materi).

### Direct Input (Paperless)
*   Form LKPD (Lembar Kerja Peserta Didik) dan kolom refleksi diintegrasikan langsung dalam aplikasi.
*   Input disimpan ke database secara real-time.

## 3. Struktur Database (Ringkasan)

*   `users`: Data autentikasi siswa.
*   `pertemuans`: Data pertemuan (1-4).
*   `aktivitas`: Master data 7 tipe aktivitas CTL.
*   `activity_progress`: Tracking status penyelesaian aktivitas per siswa.
*   `lkpds` & `lkpd_submissions`: Data soal dan jawaban tugas mandiri.
*   `scores`: Penyimpanan nilai Pretest dan Posttest.

## 4. Standar Pengembangan

*   **Frontend:** Tailwind CSS untuk styling, Blade Template untuk rendering.
*   **Backend:** Laravel 11.
*   **Komponen UI:** Manfaatkan komponen di `resources/views/components` untuk konsistensi kartu dan tombol.
*   **Prinsip UI/UX:** Modern, bersih, dan ramah anak (font terbaca jelas, ikon intuitif).

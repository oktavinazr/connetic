<?php

namespace Database\Seeders;

use App\Models\Pertemuan;
use App\Models\Aktivitas;
use App\Models\Materi;
use Illuminate\Database\Seeder;

class PertemuanSeeder extends Seeder
{
    public function run(): void
    {
        $aktivitasTemplate = [
            [
                'nomor' => 1, 'nama' => 'Constructivism', 'emoji' => '🏗️',
                'deskripsi' => 'Membangun pengetahuan melalui pengalaman dan refleksi',
                'color' => '#ec4899',
            ],
            [
                'nomor' => 2, 'nama' => 'Inquiry', 'emoji' => '🔍',
                'deskripsi' => 'Mengembangkan kemampuan berpikir kritis melalui investigasi',
                'color' => '#8b5cf6',
            ],
            [
                'nomor' => 3, 'nama' => 'Questioning', 'emoji' => '❓',
                'deskripsi' => 'Merangsang pemikiran melalui pertanyaan-pertanyaan bermakna',
                'color' => '#f59e0b',
            ],
            [
                'nomor' => 4, 'nama' => 'Learning Community', 'emoji' => '👥',
                'deskripsi' => 'Belajar bersama dalam kelompok untuk berbagi pengetahuan',
                'color' => '#10b981',
            ],
            [
                'nomor' => 5, 'nama' => 'Modeling', 'emoji' => '📐',
                'deskripsi' => 'Memberikan contoh konkret untuk memahami konsep',
                'color' => '#3b82f6',
            ],
            [
                'nomor' => 6, 'nama' => 'Reflection', 'emoji' => '🤔',
                'deskripsi' => 'Merefleksikan pembelajaran untuk penguatan pemahaman',
                'color' => '#ef4444',
            ],
            [
                'nomor' => 7, 'nama' => 'Authentic Assessment', 'emoji' => '📊',
                'deskripsi' => 'Penilaian autentik untuk mengukur pemahaman nyata',
                'color' => '#06b6d4',
            ],
        ];

        // ============================================
        // PERTEMUAN 1: TCP/IP
        // ============================================
        $p1 = Pertemuan::create([
            'nomor' => 1,
            'judul' => 'TCP/IP',
            'deskripsi' => 'Memahami konsep dasar TCP/IP dan layer-layer dalam model TCP/IP',
        ]);

        $materiP1 = [
            1 => [
                'konten_teks' => '
                    <h3>Apa yang Kamu Ketahui tentang Komunikasi Data?</h3>
                    <p>Sebelum kita mempelajari TCP/IP, mari kita mulai dari pengalaman sehari-hari. Pernahkah kamu mengirim pesan melalui WhatsApp atau membuka website? Semua itu menggunakan <strong>protokol komunikasi data</strong>.</p>
                    <p>Bayangkan kamu mengirim surat ke teman. Surat itu perlu:</p>
                    <p>1. <strong>Ditulis</strong> (data dibuat oleh aplikasi)<br>
                    2. <strong>Dimasukkan amplop</strong> (data dikemas/encapsulation)<br>
                    3. <strong>Diberi alamat</strong> (ditambahkan alamat IP tujuan)<br>
                    4. <strong>Dikirim lewat pos</strong> (ditransmisikan melalui jaringan fisik)</p>
                    <p>Proses inilah yang terjadi di dalam model <strong>TCP/IP</strong> — sebuah aturan standar agar komputer di seluruh dunia bisa saling berkomunikasi.</p>
                    <p>Pada aktivitas ini, coba tuliskan apa yang sudah kamu ketahui tentang bagaimana komputer saling berkomunikasi di LKPD.</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=PpsEaqJV_A0',
            ],
            2 => [
                'konten_teks' => '
                    <h3>Investigasi: Layer-Layer TCP/IP</h3>
                    <p>Model TCP/IP terdiri dari <strong>4 layer</strong> yang masing-masing memiliki fungsi spesifik:</p>
                    <p><strong>1. Application Layer</strong><br>
                    Layer teratas yang berinteraksi langsung dengan pengguna. Contoh protokol: HTTP, FTP, SMTP, DNS. Saat kamu membuka browser dan mengetik URL, layer ini yang bekerja pertama kali.</p>
                    <p><strong>2. Transport Layer</strong><br>
                    Bertanggung jawab memastikan data sampai dengan benar. Dua protokol utama: <strong>TCP</strong> (reliable, connection-oriented) dan <strong>UDP</strong> (fast, connectionless). TCP seperti mengirim paket dengan resi, UDP seperti menyebar brosur.</p>
                    <p><strong>3. Internet Layer</strong><br>
                    Menangani pengalamatan dan routing. Protokol utama: <strong>IP (Internet Protocol)</strong>. Layer ini menentukan jalur terbaik agar data sampai ke tujuan.</p>
                    <p><strong>4. Network Access Layer</strong><br>
                    Layer paling bawah yang berhubungan dengan perangkat keras — kabel, Wi-Fi, Ethernet. Data diubah menjadi sinyal fisik untuk ditransmisikan.</p>
                    <p>Pada LKPD, kamu akan menginvestigasi fungsi setiap layer dan mengidentifikasi protokol yang bekerja di masing-masing layer.</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=2QGgEk20RXM',
            ],
            3 => [
                'konten_teks' => '
                    <h3>Pertanyaan Kritis: Mengapa TCP/IP?</h3>
                    <p>Sekarang kamu sudah mengenal layer-layer TCP/IP. Saatnya berpikir lebih dalam dengan menjawab pertanyaan-pertanyaan berikut:</p>
                    <p><strong>Pertanyaan 1:</strong> Mengapa internet membutuhkan model berlapis (layered model)? Apa yang terjadi jika semua fungsi digabung dalam satu layer saja?</p>
                    <p><strong>Pertanyaan 2:</strong> Apa perbedaan utama antara model TCP/IP dan model OSI? Mengapa TCP/IP lebih banyak digunakan dalam praktik?</p>
                    <p><strong>Pertanyaan 3:</strong> Saat kamu membuka sebuah website, data melewati keempat layer TCP/IP. Bisakah kamu menjelaskan urutan prosesnya dari Application hingga Network Access?</p>
                    <p><strong>Pertanyaan 4:</strong> Kapan sebaiknya menggunakan TCP dan kapan menggunakan UDP? Berikan contoh aplikasi nyata untuk masing-masing.</p>
                    <p>Tuliskan jawaban dan analisismu di LKPD. Tidak ada jawaban yang salah — yang penting adalah proses berpikirmu!</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=PpsEaqJV_A0',
            ],
            4 => [
                'konten_teks' => '
                    <h3>Diskusi Kelompok: Studi Kasus Jaringan</h3>
                    <p>Pembelajaran akan lebih bermakna jika dilakukan bersama. Pada aktivitas ini, kamu akan berdiskusi dalam kelompok untuk menyelesaikan studi kasus.</p>
                    <p><strong>Studi Kasus:</strong></p>
                    <p>Sebuah sekolah memiliki jaringan komputer yang menghubungkan 3 lab. Suatu hari, komputer di Lab 1 tidak bisa mengakses internet, padahal komputer di Lab 2 dan Lab 3 bisa. Teknisi memeriksa dan menemukan bahwa kabel jaringan di Lab 1 baik-baik saja.</p>
                    <p><strong>Tugas Kelompok:</strong></p>
                    <p>1. Identifikasi di layer mana kemungkinan masalah terjadi<br>
                    2. Jelaskan langkah-langkah troubleshooting yang akan kalian lakukan<br>
                    3. Hubungkan setiap langkah dengan layer TCP/IP yang relevan</p>
                    <p>Diskusikan dengan teman kelompokmu, lalu dokumentasikan hasil diskusi di LKPD. Setiap anggota kelompok wajib berkontribusi!</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=3b_TAYtzuho',
            ],
            5 => [
                'konten_teks' => '
                    <h3>Contoh Nyata: Perjalanan Data dalam TCP/IP</h3>
                    <p>Mari kita lihat contoh konkret bagaimana data bergerak dalam jaringan TCP/IP saat kamu mengakses <strong>www.google.com</strong>:</p>
                    <p><strong>Langkah 1 — Application Layer:</strong><br>
                    Browser mengirim HTTP request ke server Google. DNS menerjemahkan "www.google.com" menjadi alamat IP (misalnya 142.250.185.206).</p>
                    <p><strong>Langkah 2 — Transport Layer:</strong><br>
                    Data dipecah menjadi segmen-segmen. TCP membuat koneksi (3-way handshake: SYN → SYN-ACK → ACK) untuk memastikan pengiriman reliable.</p>
                    <p><strong>Langkah 3 — Internet Layer:</strong><br>
                    Setiap segmen dibungkus menjadi paket dengan header IP yang berisi alamat sumber dan tujuan. Router menentukan jalur terbaik.</p>
                    <p><strong>Langkah 4 — Network Access Layer:</strong><br>
                    Paket diubah menjadi frame dan ditransmisikan sebagai sinyal listrik/cahaya melalui kabel atau gelombang radio (Wi-Fi).</p>
                    <p>Proses ini disebut <strong>encapsulation</strong>. Saat data sampai di tujuan, prosesnya dibalik (<strong>de-encapsulation</strong>).</p>
                    <p>Di LKPD, kamu akan membuat diagram encapsulation sendiri berdasarkan skenario yang diberikan.</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=JQDXEN3Y_bw',
            ],
            6 => [
                'konten_teks' => '
                    <h3>Refleksi Pembelajaran</h3>
                    <p>Setelah mempelajari TCP/IP melalui berbagai aktivitas, saatnya merefleksikan apa yang telah kamu pelajari.</p>
                    <p>Renungkan dan jawab pertanyaan berikut:</p>
                    <p><strong>1. Apa konsep baru yang paling menarik menurutmu?</strong><br>
                    Mungkin tentang bagaimana data dipecah jadi segmen, atau bagaimana router menentukan jalur terbaik?</p>
                    <p><strong>2. Apa yang masih membingungkan?</strong><br>
                    Tidak apa-apa jika ada bagian yang belum sepenuhnya dipahami. Tulis agar bisa didiskusikan lagi.</p>
                    <p><strong>3. Bagaimana kamu bisa menerapkan pengetahuan TCP/IP dalam kehidupan sehari-hari?</strong><br>
                    Misalnya saat troubleshooting koneksi internet di rumah.</p>
                    <p><strong>4. Apa hubungan antara materi ini dengan materi sebelumnya yang pernah kamu pelajari?</strong></p>
                    <p>Tuliskan refleksimu secara jujur di LKPD. Refleksi yang baik akan membantumu mengingat materi lebih lama.</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=PpsEaqJV_A0',
            ],
            7 => [
                'konten_teks' => '
                    <h3>Penilaian Autentik: TCP/IP</h3>
                    <p>Saatnya menunjukkan pemahamanmu secara menyeluruh! Pada aktivitas terakhir ini, kamu akan mengerjakan tugas penilaian autentik.</p>
                    <p><strong>Tugas:</strong></p>
                    <p>Buatlah sebuah <strong>infografis atau diagram</strong> yang menjelaskan:</p>
                    <p>1. Keempat layer TCP/IP beserta fungsinya<br>
                    2. Minimal 2 protokol di setiap layer<br>
                    3. Proses encapsulation dari Application ke Network Access<br>
                    4. Satu contoh nyata perjalanan data (misalnya mengirim email)</p>
                    <p><strong>Kriteria Penilaian:</strong></p>
                    <p>• Kelengkapan informasi (25%)<br>
                    • Kebenaran konsep (30%)<br>
                    • Kreativitas penyajian (20%)<br>
                    • Kemampuan menjelaskan dengan bahasa sendiri (25%)</p>
                    <p>Kamu boleh menggunakan aplikasi desain apapun (Canva, PowerPoint, atau bahkan gambar tangan yang di-foto). Upload hasil kerjamu di LKPD.</p>
                ',
                'video_url' => 'https://www.youtube.com/watch?v=3b_TAYtzuho',
            ],
        ];

        foreach ($aktivitasTemplate as $at) {
            $aktivitas = Aktivitas::create([
                'pertemuan_id' => $p1->id,
                ...$at,
            ]);

            Materi::create([
                'aktivitas_id' => $aktivitas->id,
                'konten_teks' => $materiP1[$at['nomor']]['konten_teks'],
                'video_url' => $materiP1[$at['nomor']]['video_url'],
            ]);
        }

        // ============================================
        // PERTEMUAN 2: IP Address
        // ============================================
        $p2 = Pertemuan::create([
            'nomor' => 2,
            'judul' => 'IP Address',
            'deskripsi' => 'Mempelajari pengalamatan IP, subnet mask, dan kelas-kelas IP',
        ]);

        $materiP2 = [
            1 => [
                'konten_teks' => '<h3>Constructivism — IP Address</h3><p>Setiap perangkat yang terhubung ke jaringan memiliki alamat unik yang disebut <strong>IP Address</strong>. Bayangkan IP Address seperti alamat rumah — tanpa alamat, paket tidak bisa sampai ke tujuan.</p><p>Apa yang kamu ketahui tentang IP Address? Pernahkah kamu melihat angka seperti <strong>192.168.1.1</strong>? Tuliskan pengalamanmu di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
            2 => [
                'konten_teks' => '<h3>Inquiry — Struktur IP Address</h3><p>IP Address versi 4 (IPv4) terdiri dari <strong>32 bit</strong> yang dibagi menjadi 4 oktet. Setiap oktet memiliki nilai 0-255.</p><p>Contoh: <strong>192.168.1.100</strong></p><p>IP Address dibagi menjadi 2 bagian: <strong>Network ID</strong> (identitas jaringan) dan <strong>Host ID</strong> (identitas perangkat). Pembagian ini ditentukan oleh <strong>Subnet Mask</strong>.</p><p>Investigasi kelas-kelas IP (A, B, C, D, E) dan subnet mask default-nya di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
            3 => [
                'konten_teks' => '<h3>Questioning — Mengapa Ada Kelas IP?</h3><p>Pikirkan pertanyaan ini:</p><p>1. Mengapa IP Address dibagi menjadi beberapa kelas?<br>2. Apa yang terjadi jika dua perangkat memiliki IP yang sama?<br>3. Apa bedanya IP Public dan IP Private?<br>4. Mengapa alamat 127.0.0.1 disebut localhost?</p><p>Jawab di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
            4 => [
                'konten_teks' => '<h3>Learning Community — Praktik Subnetting</h3><p>Bersama kelompokmu, selesaikan tantangan subnetting berikut:</p><p>Sebuah perusahaan memiliki network <strong>192.168.10.0/24</strong> dan membutuhkan 4 subnet untuk 4 departemen. Tentukan:</p><p>1. Subnet mask baru<br>2. Range IP setiap subnet<br>3. Broadcast address setiap subnet</p><p>Diskusikan dan dokumentasikan di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
            5 => [
                'konten_teks' => '<h3>Modeling — Contoh Konfigurasi IP</h3><p>Berikut contoh konfigurasi IP pada sebuah jaringan sederhana:</p><p><strong>Router:</strong> 192.168.1.1/24<br><strong>PC 1:</strong> 192.168.1.10/24 (Gateway: 192.168.1.1)<br><strong>PC 2:</strong> 192.168.1.20/24 (Gateway: 192.168.1.1)<br><strong>Server:</strong> 192.168.1.100/24 (Gateway: 192.168.1.1)</p><p>Semua perangkat berada di network yang sama (192.168.1.0/24) sehingga bisa saling berkomunikasi. Di LKPD, buatlah diagram konfigurasi IP untuk skenario yang diberikan.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
            6 => [
                'konten_teks' => '<h3>Reflection — IP Address</h3><p>Refleksikan pembelajaranmu:</p><p>1. Konsep apa yang paling mudah dipahami?<br>2. Bagian mana yang masih membingungkan?<br>3. Bagaimana subnetting berguna di dunia nyata?<br>4. Apa yang ingin kamu pelajari lebih lanjut?</p><p>Tulis refleksimu di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
            7 => [
                'konten_teks' => '<h3>Authentic Assessment — IP Address</h3><p><strong>Tugas:</strong> Rancanglah skema pengalamatan IP untuk jaringan sekolah dengan ketentuan:</p><p>• 3 Lab komputer (masing-masing 30 PC)<br>• 1 Ruang guru (10 PC)<br>• 1 Server room (5 server)</p><p>Tentukan: Network address, subnet mask, range IP, broadcast address, dan gateway untuk setiap subnet. Upload di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=LIzTo6e4FgY',
            ],
        ];

        foreach ($aktivitasTemplate as $at) {
            $aktivitas = Aktivitas::create([
                'pertemuan_id' => $p2->id,
                ...$at,
            ]);

            Materi::create([
                'aktivitas_id' => $aktivitas->id,
                'konten_teks' => $materiP2[$at['nomor']]['konten_teks'],
                'video_url' => $materiP2[$at['nomor']]['video_url'],
            ]);
        }

        // ============================================
        // PERTEMUAN 3: IPv4
        // ============================================
        $p3 = Pertemuan::create([
            'nomor' => 3,
            'judul' => 'IPv4',
            'deskripsi' => 'Memahami struktur dan karakteristik IPv4',
        ]);

        $materiP3 = [
            1 => [
                'konten_teks' => '<h3>Constructivism — IPv4</h3><p>IPv4 adalah versi IP yang paling banyak digunakan saat ini. Dengan <strong>32 bit</strong>, IPv4 mampu menyediakan sekitar 4,3 miliar alamat unik. Tapi apakah itu cukup?</p><p>Pikirkan berapa banyak perangkat yang terhubung ke internet hari ini — smartphone, laptop, IoT, server. Tuliskan pendapatmu di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
            2 => [
                'konten_teks' => '<h3>Inquiry — Struktur Header IPv4</h3><p>Setiap paket IPv4 memiliki <strong>header</strong> yang berisi informasi penting:</p><p>• <strong>Version</strong> (4 bit): Selalu bernilai 4<br>• <strong>TTL</strong> (8 bit): Batas hop agar paket tidak berputar selamanya<br>• <strong>Source IP</strong> (32 bit): Alamat pengirim<br>• <strong>Destination IP</strong> (32 bit): Alamat tujuan<br>• <strong>Checksum</strong>: Untuk deteksi error</p><p>Investigasi setiap field header dan fungsinya di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
            3 => [
                'konten_teks' => '<h3>Questioning — IPv4</h3><p>Jawab pertanyaan berikut:</p><p>1. Mengapa IPv4 memiliki keterbatasan jumlah alamat?<br>2. Apa itu NAT dan bagaimana ia membantu mengatasi keterbatasan IPv4?<br>3. Apa perbedaan antara IPv4 dan IPv6?<br>4. Mengapa migrasi ke IPv6 berjalan lambat?</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
            4 => [
                'konten_teks' => '<h3>Learning Community — Analisis Paket IPv4</h3><p>Bersama kelompokmu, analisis contoh paket IPv4 berikut dan identifikasi setiap field:</p><p><code>45 00 00 3c 1c 46 40 00 40 06 b1 e6 c0 a8 00 68 c0 a8 00 01</code></p><p>Dokumentasikan hasil analisis di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
            5 => [
                'konten_teks' => '<h3>Modeling — Fragmentasi IPv4</h3><p>Ketika paket terlalu besar untuk dikirim melalui jaringan (melebihi MTU), IPv4 melakukan <strong>fragmentasi</strong> — memecah paket menjadi bagian-bagian kecil.</p><p>Contoh: Paket 4000 bytes dengan MTU 1500 bytes akan dipecah menjadi 3 fragmen. Setiap fragmen memiliki offset yang menunjukkan posisinya.</p><p>Di LKPD, hitung fragmentasi untuk skenario yang diberikan.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
            6 => [
                'konten_teks' => '<h3>Reflection — IPv4</h3><p>Refleksikan:</p><p>1. Bagian mana dari IPv4 yang paling menarik?<br>2. Apa hubungan IPv4 dengan materi TCP/IP dan IP Address sebelumnya?<br>3. Menurutmu, apakah IPv4 masih relevan di masa depan?<br>4. Apa yang akan kamu lakukan berbeda jika mengulang pembelajaran ini?</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
            7 => [
                'konten_teks' => '<h3>Authentic Assessment — IPv4</h3><p><strong>Tugas:</strong> Buatlah presentasi atau dokumen yang menjelaskan:</p><p>1. Struktur lengkap header IPv4 dengan penjelasan setiap field<br>2. Proses fragmentasi dengan contoh perhitungan<br>3. Perbandingan IPv4 vs IPv6 (minimal 5 aspek)<br>4. Pendapatmu tentang masa depan IPv4</p><p>Upload di LKPD.</p>',
                'video_url' => 'https://www.youtube.com/watch?v=aor29pGhlFg',
            ],
        ];

        foreach ($aktivitasTemplate as $at) {
            $aktivitas = Aktivitas::create([
                'pertemuan_id' => $p3->id,
                ...$at,
            ]);

            Materi::create([
                'aktivitas_id' => $aktivitas->id,
                'konten_teks' => $materiP3[$at['nomor']]['konten_teks'],
                'video_url' => $materiP3[$at['nomor']]['video_url'],
            ]);
        }
    }
}
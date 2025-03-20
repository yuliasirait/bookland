<?php
 // Inisialisasi variabel untuk menyimpan nilai input dan error
 $nama = $email = $nomor = $jenisBuku = $alamat = $pembayaran = $jumlahBuku = "";
 $namaErr = $emailErr = $nomorErr = $alamatErr = $jumlahBukuErr= "";
 
 $buku = [
     "Fiksi" => [
         ["judul" => "2,578.0Km", "harga" => 87999],
         ["judul" => "Dear J", "harga" => 89999],
         ["judul" => "Alaia II", "harga" => 99999],
         ["judul" => "Bumit", "harga" => 67999],
         ["judul" => "Lumpur", "harga" => 77999],
         ["judul" => "Leiden", "harga" => 89999],
         ["judul" => "Gadis Kretek", "harga" => 79999]
     ],
     "Non-Fiksi" => [
         ["judul" => "Lima Cerita: Kisah-kisah Menjadi Dewasa", "harga" => 95000],
         ["judul" => "What`S So Wrong About Your Life", "harga" => 84500],
         ["judul" => "Autobiografi Tan Malaka: Dari Penjara Ke Penjara", "harga" => 140000]
     ]
 ];
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Validasi Nama
     $nama = $_POST["nama"];
     if (empty($nama)) {
         $namaErr = "Nama wajib diisi";
     }
 
     // Validasi Email
     $email = $_POST["email"];
     if (empty($email)) {
         $emailErr = "Email wajib diisi";
     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $emailErr = "Format email tidak valid";
     }
 
     // Validasi Nomor Telepon
     $nomor = $_POST["nomor"];
     if (empty($nomor)) {
         $nomorErr = "Nomor Telepon wajib diisi";
     } elseif (!ctype_digit($nomor)) {
         $nomorErr = "Nomor Telepon harus berupa angka";
     } elseif (strlen($nomor) < 11 || strlen($nomor) > 12) {
         $nomorErr = "Nomor Telepon harus memiliki 11-12 digit";
     }
 
     // Validasi Alamat
     $alamat = $_POST["alamat"];
     if (empty($alamat)) {
         $alamatErr = "Alamat wajib diisi";
     }
     $jumlahBuku = $_POST["jumlahBuku"];
     if (empty($jumlahBuku)) {
         $jumlahBukuErr = "Jumlah buku wajib diisi";
     }
 
     // Menyimpan pilihan mobil tanpa validasi khusus
     $jenisBuku = $_POST["jenisBuku"];
     $pembayaran = $_POST["pembayaran"];
 }
 
 
 
 ?>
 
 <!DOCTYPE html>
 <html lang="id">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Form Pembelian Buku</title>
     <link rel="stylesheet" href="style.css">
 </head>
 
 <body>
     <div class="container">
         <h2>Form Pembelian Buku</h2>
         <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
             <div class="form-group">
                 <label for="nama">Nama:</label>
                 <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                 <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
             </div>
 
             <div class="form-group">
                 <label for="email">Email:</label>
                 <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                 <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
             </div>
 
             <div class="form-group">
                 <label for="nomor">Nomor Telepon:</label>
                 <input type="text" id="nomor" name="nomor" value="<?php echo $nomor; ?>">
                 <span class="error"><?php echo $nomorErr ? "* $nomorErr" : ""; ?></span>
             </div>
 
             <div class="form-group">
                 <label for="alamat">Alamat Pengiriman:</label>
                 <textarea id="alamat" name="alamat"><?php echo $alamat; ?></textarea>
                 <span class="error"><?php echo $alamatErr ? "* $alamatErr" : ""; ?></span>
             </div>
 
             <div class="form-group">
                 <label for="jenisBuku">Pilih Buku:</label>
                 <select id="jenisBuku" name="jenisBuku">
                     <option value="">-- Pilih Jenis Buku --</option>
                     <option value="Dear J" <?php echo ($jenisBuku == "Dear J") ? "selected" : ""; ?>>Dear J</option>
                     <option value="Alaia II" <?php echo ($jenisBuku == "Alaia II") ? "selected" : ""; ?>>Alaia II
                     </option>
                 </select>
             </div>
 
             <div class="form-group">
                 <label for="nomor">Jumlah Buku:</label>
                 <input type="text" id="jumlahBuku" name="jumlahBuku" value="<?php echo $jumlahBuku; ?>">
                 <span class="error"><?php echo $jumlahBukuErr ? "* $jumlahBukuErr" : ""; ?></span>
             </div>
 
             <div class="form-group">
                 <label for="pembayaran">Pilih Cara Pembayaran:</label>
                 <select id="pembayaran" name="pembayaran">
                     <option value="">-- Pilih Cara Pembayaran --</option>
                     <option value="COD" <?php echo ($pembayaran == "COD") ? "selected" : ""; ?>>COD</option>
                     <option value="Transfer Bank" <?php echo ($jenisBuku == "Transfer Bank") ? "selected" : ""; ?>>
                         Transfer Bank</option>
                 </select>
             </div>
 
             <div class="button-container">
                 <button type="submit">Pesan</button>
             </div>
         </form>
     </div>
 
     <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$alamatErr) { ?>
         <div class="container">
             <h3>Data Pembelian:</h3>
             <div class="table-container">
                 <table>
                     <thead>
                         <tr>
                             <th width="20%">Nama</th>
                             <th width="20%">Email</th>
                             <th width="15%">Nomor Telepon</th>
                             <th width="15%">Judul Buku</th>
                             <th width="15%">Jumlah Buku</th>
                             <th width="15%">Cara Pembayaran</th>
                             <th width="30%">Alamat Pengiriman</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td><?php echo $nama; ?></td>
                             <td><?php echo $email; ?></td>
                             <td><?php echo $nomor; ?></td>
                             <td><?php echo $jenisBuku; ?></td>
                             <td><?php echo $jumlahBuku; ?></td>
                             <td><?php echo $pembayaran; ?></td>
                             <td><?php echo $alamat; ?></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     <?php } ?>
 </body>
 
 </html>

<?php
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
require_once '../database.php';
$daftar=admin();
?>

<div class="pendaftar">
    <div>
        <h2>Calon Siswa</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>status</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($daftar as $row): ?>
            <tr>
                <td><?=$row['NAMA_AKUN_SISWA']?></td>
                <td><?=$row['NAMA_JURUSAN']?></td>
                <td><?=$row['JENIS_STATUS_SISWA']?></td>
                <td><button name="lulus">lulus</button><button name="tidak_lulus">Tidak lulus</button></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
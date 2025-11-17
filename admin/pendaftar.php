<?php
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
require_once '../database.php';
$daftar=pendaftar();
?>
<div class="pendaftar">
    <div>
        <h2>Calon Siswa</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Kebutuhan</th>
                <th>status</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($daftar as $row): ?>
            <tr>
                <td><?=$row['NAMA_AKUN_SISWA']?></td>
                <td><?=$row['NAMA_JURUSAN']?></td>
                <td><?=$row['NAMA_KEBUTUHAN']?></td>
                <td><?=$row['JENIS_STATUS_SISWA']?></td>
                <td><button name="lulus"><a href="edit_status.php?ID_PENDAFTARAN=<?=$row['ID_PENDAFTAR_SISWA']?>&kondisi=lulus">lulus</a></button><button name="gagal"><a href="edit_status.php?ID_PENDAFTARAN=<?=$row['ID_PENDAFTAR_SISWA']?>&kondisi=gagal">Tidak Lulus</a></button></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<?php
    require_once '../database.php';
    // if (isset($_POST['submit'])) {
        $stmnt=$pdo->prepare("SELECT NAMA_JURUSAN FROM jurusan");
        $stmnt->execute();
        $jurusan=$stmnt->fetchAll();
    // }
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
?>
<div>
    <table>
        <tr>
            <th>Nama Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($jurusan as $data):?>
        <tr>
            <td><?php echo $data['NAMA_JURUSAN']?></td>
            <td>
                <button>hapus</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <button>tambah jurusan</button>
</div>
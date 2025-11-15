<?php
$host='localhost';
$user='root';
$password='';
$db='ppdb';
try {
    $pdo=new PDO("mysql:host=$host;dbname=$db",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo 'Koneksi Berhasil';
} catch (PDOException $e) {
    echo 'koneksi gagal'.$e->getMessage();
};

function register(array $data){   
    global $pdo; 
    $stmnt=$pdo->prepare("INSERT INTO akun_siswa (`NAMA_AKUN_SISWA`,`PASSWORD_AKUN_SISWA`,`EMAIL_AKUN_SISWA`)VALUES (:NAMA_SISWA,:PASSWORD,:EMAIL)");
    $stmnt->execute([
        ':NAMA_SISWA'=>$data['nama'],
        ':PASSWORD'=>md5($data['pass']),
        ':EMAIL'=>$data['email']
    ]);
}

function admin(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT akun_siswa.NAMA_AKUN_SISWA,jurusan.NAMA_JURUSAN,status_siswa.JENIS_STATUS_SISWA FROM pendaftaran,akun_siswa,status_siswa,jurusan WHERE pendaftaran.ID_AKUN_SISWA=akun_siswa.ID_AKUN_SISWA AND pendaftaran.ID_STATUS_SISWA=status_siswa.ID_STATUS_SISWA AND pendaftaran.ID_JURUSAN=jurusan.ID_JURUSAN ");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function status(array $data,$id){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE pendafaran SET status= :status WHERE ID_PENDAFTARAN = :ID");
    $stmnt->execute([
        ':status'=>$data['status'],
        ':ID'=>$id
    ]);
}
// function register(array $data){

//     $stmnt=$pdo
// }
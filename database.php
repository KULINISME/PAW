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

function pendaftar(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT pendaftaran.ID_PENDAFTAR_SISWA,akun_siswa.NAMA_AKUN_SISWA,jurusan.NAMA_JURUSAN,status_siswa.JENIS_STATUS_SISWA ,kebutuhan_siswa.NAMA_KEBUTUHAN
    FROM pendaftaran,akun_siswa,status_siswa,jurusan ,kebutuhan_siswa,pendaftaran_kebutuhan
    WHERE pendaftaran.ID_AKUN_SISWA=akun_siswa.ID_AKUN_SISWA 
    AND pendaftaran.ID_STATUS_SISWA=status_siswa.ID_STATUS_SISWA 
    AND pendaftaran.ID_JURUSAN=jurusan.ID_JURUSAN 
    AND pendaftaran_kebutuhan.ID_KEBUTUHAN=kebutuhan_siswa.ID_KEBUTUHAN
    AND pendaftaran_kebutuhan.ID_PENDAFTAR_SISWA=pendaftaran.ID_PENDAFTAR_SISWA
    AND status_siswa.ID_STATUS_SISWA = 1");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function lulus(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT pendaftaran.ID_PENDAFTAR_SISWA,akun_siswa.NAMA_AKUN_SISWA,jurusan.NAMA_JURUSAN,status_siswa.JENIS_STATUS_SISWA ,kebutuhan_siswa.NAMA_KEBUTUHAN
    FROM pendaftaran,akun_siswa,status_siswa,jurusan ,kebutuhan_siswa,pendaftaran_kebutuhan
    WHERE pendaftaran.ID_AKUN_SISWA=akun_siswa.ID_AKUN_SISWA 
    AND pendaftaran.ID_STATUS_SISWA=status_siswa.ID_STATUS_SISWA 
    AND pendaftaran.ID_JURUSAN=jurusan.ID_JURUSAN 
    AND pendaftaran_kebutuhan.ID_KEBUTUHAN=kebutuhan_siswa.ID_KEBUTUHAN
    AND pendaftaran_kebutuhan.ID_PENDAFTAR_SISWA=pendaftaran.ID_PENDAFTAR_SISWA 
    AND JENIS_STATUS_SISWA = 'Lolos'");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function gagal(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT pendaftaran.ID_PENDAFTAR_SISWA,akun_siswa.NAMA_AKUN_SISWA,jurusan.NAMA_JURUSAN,status_siswa.JENIS_STATUS_SISWA ,kebutuhan_siswa.NAMA_KEBUTUHAN
    FROM pendaftaran,akun_siswa,status_siswa,jurusan ,kebutuhan_siswa,pendaftaran_kebutuhan
    WHERE pendaftaran.ID_AKUN_SISWA=akun_siswa.ID_AKUN_SISWA 
    AND pendaftaran.ID_STATUS_SISWA=status_siswa.ID_STATUS_SISWA 
    AND pendaftaran.ID_JURUSAN=jurusan.ID_JURUSAN 
    AND pendaftaran_kebutuhan.ID_KEBUTUHAN=kebutuhan_siswa.ID_KEBUTUHAN
    AND pendaftaran_kebutuhan.ID_PENDAFTAR_SISWA=pendaftaran.ID_PENDAFTAR_SISWA 
    AND JENIS_STATUS_SISWA = 'Tidak Lolos'");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function edit_kuota($id){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE jurusan SET KUOTA_JURUSAN = :KUOTA_JURUSAN WHERE ID_JURUSAN = :id");
    $stmnt->execute([
        ":KUOTA_JURUSAN"=>$_POST["KUOTA_JURUSAN"],
        ":id"=>$id
    ]);
    header("Location:jurusan.php");
}
function jurusan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM jurusan");
    $stmnt->execute();
    $jurusan=$stmnt->fetchAll();
    return $jurusan;
}
// function register(array $data){

//     $stmnt=$pdo
// }
<?php
include 'db.php';

// Ambil semua data tol
function getAllTol() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM tol");
}

// Ambil data tol berdasarkan ID
function getTolById($id) {
    global $conn;
    $id = (int) $id;
    return mysqli_query($conn, "SELECT * FROM tol WHERE id = $id");
}

// Upload gambar dengan validasi
function uploadGambar($file, $folder = 'uploads') {
    $namaFile = basename($file['name']);
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($ekstensi, $allowed)) {
        return null;
    }

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $targetPath = "$folder/" . time() . "_" . $namaFile;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return basename($targetPath);
    } else {
        return null;
    }
}

// Tambah data tol
function addTol($asal, $gambarAsalFile, $tujuan, $gambarTujuanFile, $harga) {
    global $conn;

    $asal = mysqli_real_escape_string($conn, $asal);
    $tujuan = mysqli_real_escape_string($conn, $tujuan);
    $harga = (int)$harga;

    $gambar_asal = uploadGambar($gambarAsalFile);
    $gambar_tujuan = uploadGambar($gambarTujuanFile);

    if ($gambar_asal && $gambar_tujuan) {
        return mysqli_query($conn, "INSERT INTO tol (tol_asal, gambar_asal, tol_tujuan, gambar_tujuan, harga)
            VALUES ('$asal', '$gambar_asal', '$tujuan', '$gambar_tujuan', $harga)");
    } else {
        return false;
    }
}

// Update data tol
function updateTol($id, $asal, $gambarAsalFile, $tujuan, $gambarTujuanFile, $harga) {
    global $conn;

    $id = (int)$id;
    $asal = mysqli_real_escape_string($conn, $asal);
    $tujuan = mysqli_real_escape_string($conn, $tujuan);
    $harga = (int)$harga;

    $dataLama = mysqli_fetch_assoc(getTolById($id));
    $gambar_asal = $dataLama['gambar_asal'];
    $gambar_tujuan = $dataLama['gambar_tujuan'];

    // Jika ada gambar baru diupload
    if (!empty($gambarAsalFile['name'])) {
        if (file_exists("uploads/$gambar_asal")) {
            unlink("uploads/$gambar_asal");
        }
        $gambar_asal = uploadGambar($gambarAsalFile);
    }

    if (!empty($gambarTujuanFile['name'])) {
        if (file_exists("uploads/$gambar_tujuan")) {
            unlink("uploads/$gambar_tujuan");
        }
        $gambar_tujuan = uploadGambar($gambarTujuanFile);
    }

    return mysqli_query($conn, "UPDATE tol SET tol_asal='$asal', gambar_asal='$gambar_asal',
        tol_tujuan='$tujuan', gambar_tujuan='$gambar_tujuan', harga=$harga WHERE id=$id");
}

// Hapus data tol
function deleteTol($id) {
    global $conn;
    $id = (int)$id;
    $data = mysqli_fetch_assoc(getTolById($id));

    if ($data) {
        if (file_exists("uploads/{$data['gambar_asal']}")) {
            unlink("uploads/{$data['gambar_asal']}");
        }
        if (file_exists("uploads/{$data['gambar_tujuan']}")) {
            unlink("uploads/{$data['gambar_tujuan']}");
        }
    }

    return mysqli_query($conn, "DELETE FROM tol WHERE id=$id");
}

// Filter pencarian tol
function getFilteredTol($asal, $tujuan) {
    global $conn;
    $query = "SELECT * FROM tol WHERE 1";

    if (!empty($asal)) {
        $asal = mysqli_real_escape_string($conn, $asal);
        $query .= " AND tol_asal LIKE '%$asal%'";
    }

    if (!empty($tujuan)) {
        $tujuan = mysqli_real_escape_string($conn, $tujuan);
        $query .= " AND tol_tujuan LIKE '%$tujuan%'";
    }

    return mysqli_query($conn, $query);
}
?>

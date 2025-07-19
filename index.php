<?php
// session_start();
include 'db.php';
// include 'auth.php';
include 'functions.php';

// Ambil filter pencarian jika ada
$asal = isset($_GET['asal']) ? $_GET['asal'] : '';
$tujuan = isset($_GET['tujuan']) ? $_GET['tujuan'] : '';
$tols = getFilteredTol($asal, $tujuan);

// // Header
// echo "Halo, " . $_SESSION['username'] . "!";
// echo " | <a href='logout.php'>Logout</a> | <a href='tambah.php'>Tambah Data</a>";
// ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jalan Tol</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #efeff0;" class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container">
        <div class="bg-white rounded-4 d-flex align-items-center p-4  ">
            <form method="get" class="col-12">

                <div class="row">
                    <div class="col-6">
                        <h1>Data Jalan Tol </h1>
                    </div>
                    <div class="col-6">
                        <div class="col-12 d-flex justify-content-end ">
                            <a href="logout.php" class="btn button2 rounded-5 me-3 "><i class="bi bi-box-arrow-right"></i></a>
                        </div>
                    </div>

                </div>



                <div class="">
                    <div class="row mt-4 col-12 ">
                        <div class="col-3 pb-3">
                            <p for="asal" class="form-label fs-6">Asal Gerbang Tol</small>
                                <input type="text" class="form-control pe-5" id="asal" name="asal"
                                    placeholder="Masukan Tol Asal" value="<?= $asal ?>">
                        </div>
                        <div class="col-3 ">
                            <p for="tujuan" class="form-label fs-6">Tujuan Gerbang Tol</small>
                                <input type="text" class="form-control pe-5" id="tujuan" name="tujuan"
                                    placeholder="Masukan Tol Tujuan" value="<?= $tujuan ?>">
                        </div>

                        <div class="col-3 align-self-center">
                            <button type="submit" class="btn button1 px-4 py-1 "><i
                                    class="bi bi-search me-2"></i>Cari</button>
                            <a href="index.php" class="btn button2 px-3 py-1 ms-2"><i
                                    class="bi bi-x-circle me-2 "></i>Reset</a>
                        </div>

                        <div class="col-3 align-self-center d-flex justify-content-end">
                            <a href="tambah.php" class="btn btn-success px-3 py-1"><i class="bi bi-plus"></i>Tambah Data</a>
                        </div>
                    </div>


                    <table class="table">
                        <thead>
                            <tr>
                                <th class="fs-5 fw-semibold">GT Asal</th>
                                <th class="fs-5 fw-semibold">Gambar GT Asal</th>
                                <th class="fs-5 fw-semibold">GT Tujuan</th>
                                <th class="fs-5 fw-semibold">Gambar GT Asal</th>
                                <th class="fs-5 fw-semibold">Tarif</th>
                                <th class="fs-5 fw-semibold"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fs-6 fw-light"><?= $data['tol_asal'] ?></td>
                                <td class="fs-6 fw-light"><?= $data['gambar_asal'] ?></td>
                                <td class="fs-6 fw-light"><?= $data['tol_tujuan'] ?></td>
                                <td class="fs-6 fw-light"><?= $data['gambar_tujuan'] ?></td>
                                <td class="fs-6 fw-light"><?= $data['harga'] ?></td>
                                <td class="align-content-center">
                                    <div class="">
                                        <button type="button" class="btn button1 text-white px-4 py-1">Edit</button>
                                        <!-- belum ada php -->
                                        <button type="button" class="btn btn-danger py-1 mt-2">Hapus</button>
                                        <!-- belum ada php -->
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>





            </form>
        </div>
    </div>
</body>

</html>

<?php
class Matkul
{
    private $idMatkul;
    private $namaMatkul;
    private $waktu;

    public function __construct($idMatkul, $namaMatkul, $waktu)
    {
        $this->idMatkul = $idMatkul;
        $this->namaMatkul = $namaMatkul;
        $this->waktu = $waktu;
    }

    public function getIdMatkul()
    {
        return $this->idMatkul;
    }
    public function getNamaMatkul()
    {
        return $this->namaMatkul;
    }
    public function getWaktu()
    {
        return $this->waktu;
    }
}

class KRS
{
    private $matkul = [];

    public function isiKRS(array $matkul)
    {
        $this->matkul = $matkul;
    }

    public function getKRS()
    {
        return $this->matkul;
    }

    public function showKRS()
    {
        for ($i = 0; $i < count($this->matkul); $i++) {
            echo $this->matkul[$i];
        }
    }

}

class Dosen
{
    protected $nama;
    protected $NID;
    protected $notelp;
}

interface SistemPerwalian
{
    public function message();
}

class KRSDiterima implements SistemPerwalian
{
    public function message()
    {
        return 'KRS diterima perwalian berhasil';
    }
}

class KRSDitolak implements SistemPerwalian
{
    public function message()
    {
        return 'KRS ditolak silahkan ulang perwalian anda';
    }
}


class Perwalian extends Dosen
{
    public function setData($nama, $NID, $notelp)
    {
        $this->nama = $nama;
        $this->NID = $NID;
        $this->notelp = $notelp;
    }

    public function cekKRS($data)
    {
        // Cek Jumlah Matkul
        if (count($data) < 3) {
            $sistem = new KRSDitolak();
            return '<div class="alert alert-danger" role="alert">' . $sistem->message() .
                '</div>';
        } else {
            $sistem = new KRSDiterima();

            return '<div class="alert alert-success" role="alert">' . $sistem->message() .
                '</div>';
        }
    }
}


class Mahasiswa extends KRS
{
    private $NIM;
    private $nama;
    private $notelp;
    private $jurusan;


    public function __construct($NIM, $nama, $notelp, $jurusan)
    {
        $this->NIM = $NIM;
        $this->nama = $nama;
        $this->notelp = $notelp;
        $this->jurusan = $jurusan;
    }

    public function getNama()
    {
        return $this->nama;
    }
    public function getNoTelp()
    {
        return $this->notelp;
    }
    public function getNIM()
    {
        return $this->NIM;
    }

    public function getJurusan()
    {
        return $this->jurusan;
    }

    public function perwalian()
    {
        $dosen = new Dosen();
    }
}



$mahasiswa = new Mahasiswa('1462100146', 'Danara Dhasa Caesa', '081234463364', 'Teknik Informatika');
if (isset($_POST['submit'])) {
    // echo '<script>alert("terpenceet")</script>';

    $matkul1 = isset($_POST['matkul1']) ? $_POST['matkul1'] : null;
    $matkul2 = isset($_POST['matkul2']) ? $_POST['matkul2'] : null;
    $matkul3 = isset($_POST['matkul3']) ? $_POST['matkul3'] : null;
    $matkul4 = isset($_POST['matkul4']) ? $_POST['matkul4'] : null;
    $matkul5 = isset($_POST['matkul5']) ? $_POST['matkul5'] : null;

    $data = array($matkul1, $matkul2, $matkul3, $matkul4, $matkul5);

    $mahasiswa->isiKRS($data);
    // $mahasiswa->showKRS();

}


// Data Matkul
$matkul_datamining = new Matkul(14620313, 'Data Mining', 'Selasa');
$matkul_web = new Matkul(14620183, 'Pengembangan Aplikasi Web', 'Senin');
$matkul_robotika = new Matkul(14620283, 'Robotika', 'Jumat');
$matkul_rppl = new Matkul(14620164, 'Rekayasa Perangkat Lunak', 'Kamis');
$matkul_grafika = new Matkul(14620204, 'Grafika Komputer', 'Rabu');

// Data Mahasiswa



// $matkul = ['Robotika', 'Pengembangan Aplikasi Web', 'Sistem Benam', 'Deep Learning', 'IOT', 'KKN'];

// $mahasiswa->isiKRS($matkul);
// print_r($mahasiswa->getKRS());

// echo '<br><br><hr><br>';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simulasi Perwalian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar bg-danger navbar-dark">
        <div class="container align-items-center">
            <a class="navbar-brand" href="#">
                <img src="asset/Logo_Untag_Surabaya-removebg-preview (2).png" alt="Logo" width="25" height="25"
                    class="d-inline-block align-text-top">
                Sistem KRS
            </a>
            <p class="text-white m-0">
                <?= $mahasiswa->getNIM() . ' - ' . $mahasiswa->getNama() . ' - ' . $mahasiswa->getJurusan() ?>
            </p>
        </div>
    </nav>


    <!-- Table Matkul -->
    <div class="container mt-3">
        <?php
        if (isset($_POST['wali'])) {
            $data = [];
            $matkul1 = isset($_POST['matkul1']) ? $_POST['matkul1'] : null;
            $matkul2 = isset($_POST['matkul2']) ? $_POST['matkul2'] : null;
            $matkul3 = isset($_POST['matkul3']) ? $_POST['matkul3'] : null;
            $matkul4 = isset($_POST['matkul4']) ? $_POST['matkul4'] : null;
            $matkul5 = isset($_POST['matkul5']) ? $_POST['matkul5'] : null;


            if (!empty($matkul1)) {
                array_push($data, $matkul1);
            }
            if (!empty($matkul2)) {
                array_push($data, $matkul2);
            }
            if (!empty($matkul3)) {
                array_push($data, $matkul3);
            }
            if (!empty($matkul4)) {
                array_push($data, $matkul4);
            }
            if (!empty($matkul4)) {
                array_push($data, $matkul4);
            }
            if (!empty($matkul5)) {
                array_push($data, $matkul5);
            }

            $perwalian = new Perwalian();
            echo $perwalian->cekKRS($data);

        }
        ?>
        <div class="d-flex justify-content-between mb-3">
            <h4 class="">Data MataKuliah</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success rounded-0" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Lihat KRS Saya
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">KRS Saya</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <?php
                                if (!empty($mahasiswa->getKRS())) {
                                    foreach ($mahasiswa->getKRS() as $key) {
                                        if ($key == null) {
                                            continue;
                                        }
                                        echo '<li>' . $key . '</li>';
                                    }
                                } else {
                                    echo '<h5 class="text-secondary">Data Kosong</h5>';
                                }
                                ?>

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-0"
                                data-bs-dismiss="modal">Close</button>
                            <form action="" method="post">
                                <?php
                                for ($i = 0; $i < count($mahasiswa->getKRS()); $i++) {
                                    if ($mahasiswa->getKRS()[$i] == null) {
                                        continue;
                                    }
                                    echo '<input type="text" name="matkul' . $i . '" value="' . $mahasiswa->getKRS()[$i] . '" hidden>';
                                }
                                ?>

                                <button type="submit" class="btn btn-success rounded-0" name="wali"
                                    value="perwalian">Pergi ke Perwalian</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table text-center border">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">Jadwal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <?= $matkul_datamining->getIdMatkul() ?>
                    </th>
                    <td>
                        <?= $matkul_datamining->getNamaMatkul() ?>
                    </td>
                    <td>
                        <?= $matkul_datamining->getWaktu() ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?= $matkul_robotika->getIdMatkul() ?>
                    </th>
                    <td>
                        <?= $matkul_robotika->getNamaMatkul() ?>
                    </td>
                    <td>
                        <?= $matkul_robotika->getWaktu() ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?= $matkul_rppl->getIdMatkul() ?>
                    </th>
                    <td>
                        <?= $matkul_rppl->getNamaMatkul() ?>
                    </td>
                    <td>
                        <?= $matkul_rppl->getWaktu() ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?= $matkul_web->getIdMatkul() ?>
                    </th>
                    <td>
                        <?= $matkul_web->getNamaMatkul() ?>
                    </td>
                    <td>
                        <?= $matkul_web->getWaktu() ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?= $matkul_grafika->getIdMatkul() ?>
                    </th>
                    <td>
                        <?= $matkul_grafika->getNamaMatkul() ?>
                    </td>
                    <td>
                        <?= $matkul_grafika->getWaktu() ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr class="hr">

        <h4 class="mt-5">Ambil Matkul</h4>
        <form action="" method="post">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="matkul1"
                    value="<?= $matkul_datamining->getNamaMatkul() ?? 'fak' ?>" id="checkbox1">
                <label class="form-check-label" for="checkbox1">
                    <?= $matkul_datamining->getNamaMatkul() ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="matkul2"
                    value="<?= $matkul_grafika->getNamaMatkul() ?? 'fak' ?>" id="checkbox2">
                <label class="form-check-label" for="checkbox2">
                    <?= $matkul_grafika->getNamaMatkul() ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="matkul3"
                    value="<?= $matkul_robotika->getNamaMatkul() ?>" id="checkbox3">
                <label class="form-check-label" for="checkbox3">
                    <?= $matkul_robotika->getNamaMatkul() ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="matkul4"
                    value="<?= $matkul_rppl->getNamaMatkul() ?>" id="checkbox4">
                <label class="form-check-label" for="checkbox4">
                    <?= $matkul_rppl->getNamaMatkul() ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="matkul5"
                    value="<?= $matkul_web->getNamaMatkul() ?>" id="checkbox5">
                <label class="form-check-label" for="checkbox5">
                    <?= $matkul_web->getNamaMatkul() ?>
                </label>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger rounded-0" name="submit" value="SIMPAN">War KRS
                    !!!</button>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
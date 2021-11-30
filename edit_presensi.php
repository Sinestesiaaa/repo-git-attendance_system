<?php
session_start();
require_once("logic/koneksi.php");
if (empty($_SESSION['login_user']))
    header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/presensi-alt_style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-calendar-check icon'></i>
            <div class="logo_name">Presensi</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">

            <li>
                <a href="index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <div class="sidebar-file">
                <li>
                    <?php if ($_SESSION['level_user'] == "Admin") { ?>
                        <a href="user.php">
                        <?php } ?>
                        <?php if ($_SESSION['level_user'] == "Dosen") { ?>
                            <a href="profil_dosen.php">
                            <?php } ?>
                            <?php if ($_SESSION['level_user'] == "Mahasiswa") { ?>
                                <a href="profil_mahasiswa.php">
                                <?php } ?>
                                <i class='bx bx-user'></i>
                                <span class="links_name">User</span>
                                </a>
                                <span class="tooltip">User</span>
                </li>
            </div>
            <li>
                <?php if ($_SESSION['level_user'] == "Admin") { ?>
                    <a href="edit_password_admin.php">
                    <?php } ?>
                    <?php if ($_SESSION['level_user'] == "Dosen") { ?>
                        <a href="edit_password_dosen.php">
                        <?php } ?>
                        <?php if ($_SESSION['level_user'] == "Mahasiswa") { ?>
                            <a href="edit_password_mahasiswa.php">
                            <?php } ?>
                            <i class='bx bx-cog'></i>
                            <span class="links_name">Setting</span>
                            </a>
                            <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <div class="name_job">
                        <div class="name"><?php echo "$_SESSION[login_user]"; ?></div>
                        <div class="job"><?php echo "$_SESSION[level_user]"; ?></div>
                    </div>
                </div>
                <a href="logic/logout.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>

    <?php
    $data = $pdo_conn->prepare("SELECT nama_kelas FROM kelas WHERE kode_kelas = :kode_kelas"); //query untuk mengambil data tabel
    $data->execute(array(
        ':kode_kelas' => $_GET['id']
    ));
    $result = $data->fetchAll();
    $data_presensi = $pdo_conn->prepare("SELECT * FROM presensi WHERE kode_presensi = :kode_presensi");
    $data_presensi->execute(array(
        ':kode_presensi' => $_GET['presensi']
    ));
    $result_presensi = $data_presensi->fetchAll();
    ?>

    <section class="home-section">
        <div class="uppertittle-section">Tambah Presensi</div>
        <div class="form-body" id="daftar">
            <form action="logic/edit_presensi_query.php" class="form-block" method="post">
                <div class="full-width">
                    <div class="title">Tambah Presensi Baru - <?php echo $result[0]['nama_kelas'] ?></div>
                    <div class="col-full">
                        <label for="tanggal">Pertemuan Ke</label>
                        <input type="number" name="pertemuan" placeholder="" class="input-field" value="<?php echo $result_presensi[0]['pertemuan'] ?>" required />
                    </div>
                    <div class="col-full">
                        <label for="tanggal">Mulai Presensi</label>
                        <input type="datetime-local" name="waktu_mulai" placeholder="" class="input-field" value="<?php echo date('Y-m-d\TH:i', strtotime($result_presensi[0]['waktu_mulai'])); ?>" required />
                    </div>
                    <div class="col-full">
                        <label for="tanggal">Akhir Presensi</label>
                        <input type="datetime-local" name="waktu_akhir" placeholder="" class="input-field" value="<?php echo date('Y-m-d\TH:i', strtotime($result_presensi[0]['waktu_akhir'])); ?>" required />
                    </div>
                    <input type="text" name="kode_kelas" placeholder="" class="input-field" value="<?php echo $_GET['id'] ?>" hidden />
                    <input type="text" name="kode_presensi" placeholder="" class="input-field" value="<?php echo $_GET['presensi'] ?>" hidden />
                    <div class="box-mid">
                        <input type="button" class="btn-batal" value="Batal" onclick="location.href='presensi.php?id=<?php echo $_GET['id'] ?>';">
                        <input type="submit" class="btn-buat" name="save_update" value="Edit">
                    </div>
            </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }
    </script>
</body>

</html>
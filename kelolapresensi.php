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
    <link rel="stylesheet" href="style/presensi_style.css">
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
            <div class="sidebar-file">
                <li>
                    <a href="index.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
            </div>
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
    $data = $pdo_conn->prepare("SELECT * FROM status_presensi JOIN mahasiswa USING (nim_mahasiswa) 
    WHERE kode_presensi = :kode_presensi
    ORDER BY nama_mahasiswa DESC"); //query untuk mengambil data tabel
    $data->execute(array(
        ':kode_presensi' => $_GET['presensi']
    ));
    $result = $data->fetchAll();

    $pertemuan = $pdo_conn->prepare("SELECT pertemuan FROM presensi WHERE kode_presensi = :kode_presensi");
    $pertemuan->execute(array(
        ':kode_presensi' => $_GET['presensi']
    ));
    $row_pertemuan = $pertemuan->fetchAll();
    ?>

    <section class="home-section">
        <div class="uppertittle-section">Pertemuan ke-<?php echo $row_pertemuan[0]['pertemuan'] ?><a href="presensi.php?id=<?php echo $_GET['id'] ?>" class="btn-add">Kembali</a></div>
        <table id="customers">
            <tr>
                <td colspan="4" class="title">Daftar Pertemuan</td>
            </tr>
            <tr>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php
            //perulangan untuk menampilkan data 
            if (!empty($result)) {
                foreach ($result as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['nim_mahasiswa'] ?></td>
                        <td><?php echo $row['nama_mahasiswa'] ?></td>
                        <td><?php echo $row['status_presensi'] ?></td>
                        <td>
                            <input type="button" onclick="location.href='edit_kelolapresensi.php?id=<?php echo $_GET['id'] ?>&presensi=<?php echo $row['kode_presensi'] ?>&kode_status=<?php echo $row['kode_status_presensi'] ?>';" class="btn-edit" value="Edit">
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
            <?php } ?>
        </table>
    </section>

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
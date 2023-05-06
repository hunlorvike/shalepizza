<?php
session_start();
include "config/config.php";
if (strlen($_SESSION['adminlogin']) == 0) {
    header('location:login.php');
    exit(); // Thêm câu lệnh exit để dừng chương trình khi chuyển hướng đến trang đăng nhập
} else {
    $member = $_SESSION['member'];
    // Viet code o duoi nay
    if (isset($_POST['submit'])) {
        $page = $_POST['addresspage'];
        $hinhanhpart = basename($_FILES['photo']['name']);
        $link = "./assets/img/uploads/";
        $link_file = $link . $hinhanhpart;
        // echo $link_file;
        // move_uploaded_file($_FILES['photo']['tmp_name'], $link_file);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $link_file)) {
            $query = mysqli_query($con, "INSERT INTO tbl_slider(slider_img, slider_on_page) VALUES('$link_file', '$page')");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
    <link rel="shortcut icon" href="../assets/img/logo/logo1.png" type="image/x-icon">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="./assets/library/bootstrap/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Swiper JS -->
    <link rel="stylesheet" href="./assets/library/swiperjs/swiper-bundle.min.css">

    <!-- Icon CDN -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/icons/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CK EDITOR -->
    <script src="./assets/library/ckeditor5/ckeditorjs"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <!-- <script src="./assets/library/nicedit/nicEdit.js"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> -->

    <!-- Customer CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body class="over-flow-x">
    <?php include "includes/footer.php"; ?>
    <!-- END HEADER -->
    <main class="change-password mt20">
        <div class="row">
            <?php include 'includes/aside.php' ?>

            <!-- END Side Bar -->
            <section class="insert-slider_container col-md-10">
                <div class="insert-slider_head mb20">
                    <p class="text fs16 fw-bolder px10-py20 w100pt bg-default m-0">Add Slider</p>
                </div>
                <div class="insert-slider_body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="control-group mb20 row text-end">
                            <label class="col-md-3 col-sm-3" for="">Trang</label>
                            <select name="addresspage" id="" class="col-sm-9 w400 col-md-9">
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM tbl_page_slider");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo htmlentities($row['page_id']); ?>"><?php echo htmlentities($row['page_name']) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="control-group mb20 row text-end">
                            <label class="col-md-3 col-sm-3" for="">Photo</label>
                            <input type="file" name="photo" class="col-sm-9 w400 col-md-9 p-0" required>
                        </div>
                        <div class="control-group mb20 row text-end">
                            <div class="col-md-3 col-sm-3"></div>
                            <button type="submit" name="submit" class="col-sm-9 w400 col-md-9 border-0 px10-py20 rounded-3 bg-default hover-bg-orange">Thêm
                                slider</button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Content Change Password-->
        </div>
    </main>
    <!-- CK Editor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#ck-product-description'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>
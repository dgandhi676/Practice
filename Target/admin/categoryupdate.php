<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['adminRandomString'])) {
    header("Location: login.php");
    exit();
}
$id = $_GET['id'];
// print_r($id);
$sql = "SELECT * FROM category_master WHERE cat_id = " . $id;
$result = mysqli_query($conn, $sql);
$fet = $result->fetch_array();
if (isset($_POST['update'])) {
    // echo "<pre>";
    // print_r($_POST);
    // die();
    $catname = $_POST['catname'];

    if (!empty($_FILES['catimg']['name'])) {
        $catimgname = $_FILES['catimg']['name'];
        $cattempname = $_FILES['catimg']['tmp_name'];
        $catfolder1 = "../catimg/" . $catimgname;
        move_uploaded_file($cattempname, $catfolder1);
        if (file_exists($catfolder1)) {
            $path_parts = pathinfo($catfolder1);
            if (isset($path_parts['extension'])) {
                $timestamp = time();
                $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
                $new_folder1 = "../catimg/" . $new_filename;
                if (rename($catfolder1, $new_folder1)) {
                    $catfolder1 = $new_folder1;
                }
            }
        }
    } else {
        $catfolder1 = $_POST['hiddencatimg'];
    }
    $catoption = $_POST['catoption'];


    $sql = "UPDATE category_master SET cat_name=?, cat_image=?, cat_active=? WHERE cat_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $catname, $catfolder1, $catoption, $id);

    if ($stmt->execute()) {
        echo "Category Updated";
        header('Location: http://localhost/Dev/target/admin/category.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
        file_put_contents('error.log', $stmt->error, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Update</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasWithBothOptions"><i class="bi bi-stack" style="font-size: 25px;"></i></button>
            <div class="mx-auto">
                <a class="navbar-brand" href="home.php">
                    <img src="../img/logo.png" alt="Target logo" width="45px" height="65px">
                </a>
            </div>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0" onclick="window.location.href='logout.php'">
                <i class="bi bi-door-closed" style="font-size: 25px;"></i> Logout
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebar">
        <div class="offcanvas-header ">
            <button type="button" class="btn-close text-reset float-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh;">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link" aria-current="page">
                            <i class="bi bi-house-door"></i>
                            HOME
                        </a>
                    </li>
                    <li>
                        <a href="category.php" class="nav-link">
                            <i class="bi bi-ui-checks-grid"></i>
                            CATEGORIES
                        </a>
                    </li>
                    <li>
                        <a href="products.php" class="nav-link">
                            <i class="bi bi-basket"></i>
                            PRODUCTS
                        </a>
                    </li>
                    <li>
                        <a href="adorder.php" class="nav-link">
                            <i class="bi bi-box2"></i>
                            ORDERS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Update Category
                        <a href="category.php" class="btn btn-outline-primary float-end ">Category List</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="categoryform" enctype="multipart/form-data" onsubmit="return validateform()" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="catname" class="form-label">Category Name:</label>
                                <input type="text" class="form-control" id="catname" name="catname" aria-describedby="catnameHelp" value="<?php echo $fet['cat_name']; ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="catimg" class="form-label">Upload Image:</label>
                                <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg, image/jpg" id="catimg" name="catimg" onchange="validateImageSize(this)" value="<?php echo $fet['cat_image']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preview:</label>
                                <img src="<?php echo $fet['cat_image']; ?>" class="img-thumbnail" alt="Image Preview" style="max-height: 125px; max-width: 125px;">
                            </div>
                            <input type="hidden" name="hiddencatimg" id="hiddencatimg" value="<?php echo $fet['cat_image']; ?>">
                            <br>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label class="input-group-text" for="catoption" id="catoption" name="catoption">Available</label>
                                    <select class="form-select" id="catoption" name="catoption">
                                        <option value="" name="" value="">Choose...</option>
                                        <option value="Active" name="catoption" <?php if ($fet['cat_active'] == "Active") {echo "selected";} ?>>Active</option>
                                        <option value="InActive" name="catoption" <?php if ($fet['cat_active'] == "InActive") {echo "selected";} ?>>InActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" name="update" value="update" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom Script -->
    <script type="text/javascript">
        const nameRegex = /^[A-Za-z ]+$/;

        function validateform() {
            const catname = document.forms["categoryform"]["catname"].value;
            if (catname === "" || !nameRegex.test(catname)) {
                showTooltip(
                    "catname",
                    "Employee First Name should contain alphabets and spaces only!"
                );
                return false;
            }
            let fileInput = document.getElementById("catimg");
            let file = fileInput.files[0];
            const allowedMimeTypes = [
                "image/jpeg",
                "image/png",
                "image/gif",
                "image/jpg",
            ];
            if (imagehidden) {
                return true;
            } else if (!file || file.size > 100000 || !allowedMimeTypes.includes(file.type)) {
                showTooltip(
                    "catimg",
                    "Please Upload Image (maximum size: 100KB, allowed file types: JPEG, PNG, GIF)."
                );
                return false;
            }
            let catoption = document.forms["categoryform"]["catoption"].value;
            if (catoption === "") {
                showTooltip("catoption", "Option must be selected");
                return false;
            }
            return true;
        }

        function validateImageSize(input) {
            const file = input.files[0];
            if (file && file.size > 100000) {
                showTooltip("catimg", "Image size exceeds 100KB.");
                input.value = "";
            }
        }

        function showTooltip(elementId, message) {
            const element = document.getElementById(elementId);
            const tooltip = new bootstrap.Tooltip(element, {
                title: message,
                trigger: "manual",
                placement: "bottom",
            });

            tooltip.show();
            setTimeout(() => {
                tooltip.hide();
            }, 2000);
        }

        document
            .getElementById("categoryform")
            .addEventListener("submit", function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });

        document
            .getElementById("catname")
            .addEventListener("keypress", function(event) {
                const regex = /^[A-Za-z\s]+$/;
                const key = String.fromCharCode(event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                }
            });
    </script>
</body>

</html>
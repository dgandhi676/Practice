<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['randomString'])) {
    header("Location: login.php");
    exit();
}
$activeCategoriesQuery = "SELECT * FROM category_master WHERE cat_active = 'Active'";
$result = $conn->query($activeCategoriesQuery);

if ($result->num_rows > 0) {
    $activeCategories = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $activeCategories = [];
}
if (isset($_POST['submit'])) {
    // echo "<pre>";
    $proname = $_POST['proname'];
    $proimgname = $_FILES['proimg']['name'];
    // print_r($_FILES);
    // die();
    $protempname = $_FILES['proimg']['tmp_name'];
    $profolder1 = "proimg/" . $proimgname;
    move_uploaded_file($protempname, $profolder1);
    if (file_exists($profolder1)) {
        $path_parts = pathinfo($profolder1);
        if (isset($path_parts['extension'])) {
            $timestamp = time();
            $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
            $new_folder1 = "proimg/" . $new_filename;
            if (rename($profolder1, $new_folder1)) {
                $profolder1 = $new_folder1;
            }
        }
    }
    $prooption = $_POST['prooption'];
    $prodes = $_POST['prodes'];
    $activein = $_POST['activein'];
    $prosell = $_POST['prosell'];
    $prodis =  mysqli_real_escape_string($conn, $_POST['prodis']);
    $dicena = $_POST['dicena'];
    if (!empty($dicena)) {
        $dicena1 = implode(",", $dicena);
    }


    $stmt = $conn->prepare("INSERT INTO product_master (pro_name, pro_image, pro_category, pro_des, pro_inactive, pro_sellprice, pro_discprice, pro_disco) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $proname, $profolder1, $prooption, $prodes, $activein, $prosell, $prodis, $dicena1);


    if ($stmt->execute()) {
        echo "Product Added";
        header('Location: http://localhost/Dev/target/products.php');
    } else {
        echo "error: " . $stmt->error;
        file_put_contents('error.log', $stmt->error, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
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
                    <img src="img/logo.png" alt="Target logo" width="45px" height="65px">
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
                    <h2 class="text-center">Add Products
                        <a href="products.php" class="btn btn-outline-primary float-end ">Products List</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="productform" enctype="multipart/form-data" onsubmit="return validateform()" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="proname" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" id="proname" name="proname" aria-describedby="pronameHelp" placeholder="Enter your Product Name">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="proimg" class="form-label">Upload Image: </label>
                                <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg, image/jpg" id="proimg" name="proimg" onchange="validateImageSize(this)">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="prooption" class="form-label">Select Category:</label>
                                <select class="form-select" id="prooption" name="prooption">
                                    <option value="" name="choose" value="choose">Choose...</option>
                                    <?php foreach ($activeCategories as $category) {
                                        echo '<option value="' . $category['cat_name'] . '">' . $category['cat_name'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="prodes" class="form-label">Description:</label>
                                <textarea class="form-control form-control-md" name="prodes" id="prodes" placeholder="Enter Product Description"></textarea>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="activein" class="form-label" value="activein" id="activein">Active: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="activein" id="Yes" value="Yes">
                                    <label for="form-check-label" for="Yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="activein" id="No" value="No">
                                    <label for="form-check-label" for="No">
                                        No
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="prosell" class="form-label">Selling Price: </label>
                                <input type="number" name="prosell" id="prosell" class="form-control" placeholder="Enter your Product Sell Price">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="prodis" class="form-label">Discount Price: </label>
                                <input type="number" name="prodis" id="prodis" class="form-control" placeholder="Enter your Product Discount Price">
                            </div>
                            <br>
                            <div class="col-mb-3">
                                <label class="form-label" name="dicena" value="dicena" id="dicena">Discount Enabled:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dicena[]" value="Yes" id="Yes" required>
                                    <label class="form-check-label" for="Yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dicena[]" value="No" id="No" required>
                                    <label class="form-check-label" for="No">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" name="submit" value="submit" class="btn btn-outline-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
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
            function validateform() {
                const proname = document.forms["productform"]["proname"].value;
                const prooption = document.getElementById("prooption").value;
                const prodes = document.getElementById("prodes").value;
                const activein = document.querySelector('input[name="activein"]:checked');
                const prosell = document.getElementById("prosell").value;
                const prodis = document.getElementById("prodis").value;
                
                if (proname === "") {
                    showTooltip("proname","Employee First Name should contain alphabets and spaces only!");
                    return false;
                }
                let fileInput = document.getElementById("proimg");
                let file = fileInput.files[0];
                const allowedMimeTypes = [
                    "image/jpeg",
                    "image/png",
                    "image/gif",
                    "image/jpg",
                ];
                if (!file || file.size > 100000 || !allowedMimeTypes.includes(file.type)) {
                    showTooltip("proimg","Please Upload Image (maximum size: 100KB, allowed file types: JPEG, PNG, GIF).");
                    return false;
                }
                if (prooption === "") {
                    showTooltip("prooption", "Category must be selected.");
                    return false;
                }

                if (prodes === "") {
                    showTooltip("prodes", "Description is required.");
                    return false;
                }

                if (!activein) {
                    showTooltip("activein", "Please select Active status.");
                    return false;
                }

                if (prosell === "") {
                    showTooltip("prosell", "Selling Price is required.");
                    return false;
                }

                if (prodis === "") {
                    showTooltip("prodis", "Discount Price is required.");
                    return false;
                }
                const dicena = document.querySelectorAll('input[name="dicena[]"]:checked');
                if (dicena.length === 0) {
                    showTooltip("dicena", "Select at least one option.");
                    return false;
                }

                return true;
            }

            function validateImageSize(input) {
                const file = input.files[0];
                if (file && file.size > 100000) {
                    showTooltip("proimg", "Image size exceeds 100KB.");
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
                .getElementById("productform")
                .addEventListener("submit", function(event) {
                    if (!validateform()) {
                        event.preventDefault();
                    }
                });
        </script>
</body>

</html>
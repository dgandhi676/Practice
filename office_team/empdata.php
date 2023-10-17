<?php
session_start();
include 'db_connect.php';
// echo $_SESSION['randomString'];
if (isset($_SESSION["user"])) {
    if (time() - $_SESSION["login_time_stamp"] > 600) {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}
if (!isset($_SESSION['randomString'])) {
    header("Location: login.php");
    exit();
}
$records_per_page = 5;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $records_per_page;
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM employee WHERE 
            ot_firstname LIKE '%$searchTerm%' OR 
            ot_lastname LIKE '%$searchTerm%' OR 
            ot_phoneno LIKE '%$searchTerm%' OR 
            ot_dob LIKE '%$searchTerm%' OR 
            ot_gender = '$searchTerm' OR
            ot_country LIKE '%$searchTerm%' OR 
            ot_state LIKE '%$searchTerm%' OR 
            ot_city LIKE '%$searchTerm%' OR 
            ot_completed_5_years LIKE '%$searchTerm%' OR 
            ot_profile LIKE '%$searchTerm%' 
            ORDER BY ot_id ASC LIMIT $offset, $records_per_page";
} else {

    $sql = "SELECT * FROM employee ORDER BY ot_id ASC LIMIT $offset, $records_per_page";
}
$run1 = mysqli_query($conn, $sql);
$total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM employee"));
$total_pages = ceil($total_records / $records_per_page);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Database</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body style="text-align:center;" class="bg-body-secondary">
    <h4 class="float-start py-4 px-3 text-white"> Welcome, <?php echo $_SESSION['fullname']; ?> </h4>
    <h1 class="bg-primary text-light py-3 px-5">
        Employee Records 
        <button type="button" class="btn btn-outline-danger btn float-end mx-2 mt-1 col-1" onclick="window.location.href='logout.php'">
        Logout
    </button>
    </h1>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-10">
                <form method="GET" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...." name="search">
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-2 col-1">Search</button>
                    <button type="button" class="btn btn-outline-danger mt-2 mx-3 col-1" onclick="window.location.href='empdata.php'">Reset</button>
                </form>
            </div>
            <div class="col-2">
                <a href="index.php" class="btn btn-outline-primary">Add Employee</a>
            </div>
        </div>

        <div class="table-responsive text-center bg-secondary-subtle">
            <table class="table table-bordered table-hover rounded-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>BirthDate</th>
                        <th>Image</th>
                        <th>E-Mail</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Completed 5 Years</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                </tr>
                <tr colspan="9">
                    <?php
                    if ($num1 = mysqli_num_rows($run1) > 0) {
                    } else {
                        echo "Sorry No Records Found!!!!";
                    }
                    ?>
                </tr>
                <?php
                $i = 1;
                if ($num1 = mysqli_num_rows($run1) > 0) {
                    while ($result = mysqli_fetch_assoc($run1)) {
                        echo "
                        <tr>
                        <td>" . $result['ot_id'] . "</td>
                        <td>" . $result['ot_firstname'] . "</td>
                        <td>" . $result['ot_lastname'] . "</td>
                        <td>" . $result['ot_phoneno'] . "</td>
                        <td>" . date('d M Y', strtotime($result['ot_dob'])) . "</td>
                        <td><img src='" . $result['ot_image'] . "' height='75px' width='75px'></td>
                        <td>" . $result['ot_email'] . "</td>
                        <td>" . $result['ot_gender'] . "</td>
                        <td>" . $result['ot_country'] . "</td>
                        <td>" . $result['ot_state'] . "</td>
                        <td>" . $result['ot_city'] . "</td>
                        <td>" . $result['ot_completed_5_years'] . "</td>
        
                        <td><a href='update.php?id=" . $result['ot_id'] . "' class='btn btn-outline-warning btn-sm'>Update</a></td>
                        <td><a href='delete.php?id=" . $result['ot_id'] . "' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>DELETE</a></td>
                        </tr>";
                    }
                }
                ?>

            </table>
            <div class="pagination justify-content-center">
                <ul class="pagination">
                    <?php
                    if ($current_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($current_page < $total_pages && $total_records > $records_per_page) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Bootstrap Pooper JS -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
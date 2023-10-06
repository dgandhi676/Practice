<?php
include 'db_connect.php';
// $sql = "SELECT * FROM employee ORDER BY ot_id ASC";
// $run1 = mysqli_query($conn, $sql);

// Define how many records to display per page
$records_per_page = 5;

// Get the current page number from the query string
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}

// Calculate the offset for the query based on the current page number
$offset = ($current_page - 1) * $records_per_page;

// Query to retrieve records with pagination
$sql = "SELECT * FROM employee ORDER BY ot_id ASC LIMIT $offset, $records_per_page";
$run1 = mysqli_query($conn, $sql);

// Count total number of records
$total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM employee"));

// Calculate total number of pages
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
</head>

<body style="text-align:center;">
    <div class="container" style="margin-top: 50px;">
        <h2>Employee Records</h2>
        <a href="index.php" class="btn btn-primary mb-2">Add Employee</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover rounded-4">
                <thead class="thead-dark">
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
                        <th>Profile Description</th>
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
            <td>" . $result['ot_profile'] . "</td>
            
            <td><a href='update.php?id=" . $result['ot_id'] . "' class='btn btn-primary btn-sm'>Update</a></td>
            <td><a href='delete.php?id=" . $result['ot_id'] . "' class='btn btn-danger btn-sm'>DELETE</a>
            </td>
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

                    if ($current_page < $total_pages) {
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
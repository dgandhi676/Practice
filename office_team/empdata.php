<?php
include 'db_connect.php';
$sql = "SELECT * FROM employee ORDER BY ot_id ASC";
$run1 = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Database</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <th>Image</th>
                        <th>E-Mail</th>
                        <th>Gender</th>
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
            <td><img src='" . $result['ot_image'] . "' height='75px' width='75px'></td>
            <td>" . $result['ot_email'] . "</td>
            <td>" . $result['ot_gender'] . "</td>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
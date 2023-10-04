<?php
include 'db_connect.php';
if (isset($_POST['submit'])) {
    // print_r($_POST);
    $fname = $_POST['fname'];
    //    echo "First Name : ".$empfname;
    $lname = $_POST['lname'];
    $monumber = $_POST['monumber'];
    $dob = $_POST['dob'];

    $imgname = $_FILES['empimg']['name'];
    $tempname = $_FILES['empimg']['tmp_name'];
    $folder1 = "emp-image/" . $imgname;
    move_uploaded_file($tempname, $folder1);

    if (file_exists($folder1)) {
        $path_parts = pathinfo($folder1);
        if (isset($path_parts['extension'])) {
            $timestamp = time();
            $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
            $new_folder1 = "emp-image/" . $new_filename;
            if (rename($folder1, $new_folder1)) {
                $folder1 = $new_folder1;
            }
        }
    }


    $email = $_POST['email'];
    $gender = $_POST['gender'];
    //    print_r ($gender);
    //    die;
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $complete = $_POST['complete'];
    if (!empty($complete)) {
        $complete5 = implode(",", $complete);
    }
    // echo $empcomplete5;
    // die;

    $profiledes = $_POST['profiledes'];

    $sqli = "INSERT INTO employee (ot_firstname, ot_lastname, ot_phoneno, ot_dob, ot_image, ot_email, ot_gender, ot_country, ot_state, ot_city, ot_completed_5_years, ot_profile) values ('$fname', '$lname', '$monumber', '$dob', '$folder1', '$email', '$gender', '$country', '$state', '$city', '$complete5', '$profiledes')";

    if (mysqli_query($conn, $sqli)) {
        echo "ADDED EMPLOYEE RECORD";
        header('Location: http://localhost/Dev/office_team/empdata.php');
        die();
    } else {
        echo "error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-start">Add Team Member
                        <a href="empdata.php" class="btn btn-primary float-end ">Employee List</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="teamform" enctype="multipart/form-data" onsubmit="return validateform()">

                        <div class="row">
                            <div class="col">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp">
                                <div id="fnameHelp" class="form-text">Enter your first name.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp">
                                <div id="lnameHelp" class="form-text">Enter your last name.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="monumber" class="form-label">Mobile Number:</label>
                                <input type="tel" id="monumber" class="form-control" name="monumber" aria-describedby="monumberHelp">
                                <div id="monumberHelp" class="form-text">Enter Your Phone Number.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-auto">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" aria-describedby="dobHelp">
                                <div id="dobHelp" class="form-text">Select Your Birth Date.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="empimg" class="form-label">Upload Image:</label>
                                <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg, image/jpg" id="empimg" name="empimg" aria-describedby="empimgHelp">
                                <div id="empimgHelp" class="form-text">Choose an image to upload.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                                <label class="form-check-label" for="Male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                                <label class="form-check-label" for="Female">
                                    Female
                                </label>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="country">Select Country:</label>
                                <select class="form-select country" id="country" aria-label="Default select" onchange="loadStates()">
                                    <option selected>Select Country</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="state">Select State:</label>
                                <select class="form-select state" id="state" aria-label="Default select" onchange="loadCities()">
                                    <option selected>Select State</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="city">Select City:</label>
                                <select class="form-select city" id="city" aria-label="Default select">
                                    <option selected>Select City</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <label class="form-label">5 Years Completed:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="complete[]" value="Yes" id="Yes">
                                <label class="form-check-label" for="Yes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="complete[]" value="No" id="No">
                                <label class="form-check-label" for="No">
                                    No
                                </label>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-lg" name="profiledes" id="profiledes" style="height: 100px;"></textarea>
                                    <label for="profiledes">Profile Description:</label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit
                            Details</button>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let config = {
            cUrl: 'https://api.countrystatecity.in/v1/countries',
            ckey: 'Q29WMVZCQktWWnJoY0s4Z3pqcnlMUTJub0ZEYnl1U1RuNng4V1ZzMQ=='
        }


        let countrySelect = document.getElementById('country'),
            stateSelect = document.getElementById('state'),
            citySelect = document.getElementById('city')



        function loadCountries() {

            let apiEndPoint = config.cUrl

            fetch(apiEndPoint, {
                    headers: {
                        "X-CSCAPI-KEY": config.ckey
                    }
                })
                .then(Response => Response.json())
                .then(data => {
                    // console.log(data);

                    data.forEach(country => {
                        const option = document.createElement('option')
                        option.value = country.iso2
                        option.textContent = country.name
                        countrySelect.appendChild(option)
                    })
                })
                .catch(error => console.error('Error loading countries:', error))


            stateSelect.disabled = true
            citySelect.disabled = true
            stateSelect.style.pointerEvents = 'none'
            citySelect.style.pointerEvents = 'none'
        }


        function loadStates() {
            stateSelect.disabled = false
            citySelect.disabled = true
            stateSelect.style.pointerEvents = 'auto'
            citySelect.style.pointerEvents = 'none'




            const selectedCountryCode = countrySelect.value
            // console.log(selectedCountryCode);
            stateSelect.innerHTML = '<option value="">Select State</option>'

            fetch(`${config.cUrl}/${selectedCountryCode}/states`, {
                    headers: {
                        "X-CSCAPI-KEY": config.ckey
                    }
                })
                .then(Response => Response.json())
                .then(data => {
                    // console.log(data);

                    data.forEach(state => {
                        const option = document.createElement('option')
                        option.value = state.iso2
                        option.textContent = state.name
                        stateSelect.appendChild(option)
                    })
                })
                .catch(error => console.error('Error loading states:', error))
        }


        function loadCities() {
            citySelect.disabled = false
            citySelect.style.pointerEvents = 'auto'



            const selectedCountryCode = countrySelect.value
            const selectedStateCode = stateSelect.value
            // console.log(selectedCountryCode, selectedStateCode);



            citySelect.innerHTML = '<option value="">Select City</option>'

            fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {
                    headers: {
                        "X-CSCAPI-KEY": config.ckey
                    }
                })
                .then(Response => Response.json())
                .then(data => {
                    // console.log(data);

                    data.forEach(city => {
                        const option = document.createElement('option')
                        option.value = city.iso2
                        option.textContent = city.name
                        citySelect.appendChild(option)
                    })
                })
                .catch(error => console.error('Error loading cities:', error))
        }

        window.onload = loadCountries
    </script>
    <script>
        function validateform() {

            let a = document.forms['teamform']['fname'].value;
            let nameRegex = /^[A-Za-z ]+$/;
            if (a === "") {
                alert("Employee First Name is Empty!!");
                return false;
            } else if (!nameRegex.test(a)) {
                alert("Employee First Name should contain alphabets and spaces only!");
                return false;
            }

            let b = document.forms['teamform']['lname'].value;
            let nameRegex1 = /^[A-Za-z ]+$/;
            if (b === "") {
                alert("Employee Last Name is Empty!!");
                return false;
            } else if (!nameRegex1.test(b)) {
                alert("Employee Last Name should contain alphabets and spaces only!");
                return false;
            }

            let number = document.getElementById("monumber").value;
            if (number.length != 10) {
                alert("Enter 10 digit number");
                return false;
            }

            const dobInput = document.getElementById("dob");
            const selectedDate = dobInput.value;
            if (selectedDate === "") {
                alert("Please select a date before submitting.");
                return false;
            } else {
                const currentDate = new Date();
                const inputDate = new Date(selectedDate);
                currentDate.setHours(0, 0, 0, 0);
                inputDate.setHours(0, 0, 0, 0);
                if (inputDate > currentDate) {
                    alert("You cannot select a future date.");
                    dobInput.value = "";
                    return false;
                }
            }

            let c = document.getElementById("empimg");
            let j = c.files[0];
            if (!j) {
                alert("Please Upload Image.");
                return false;
            }
            let allowedexten = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedexten.test(j.name)) {
                alert("Please Upload File with .jpg, .jpeg, .png, .gif Only.");
                c.value = '';
                return false;
            }
            let maxSize = 100000;
            if (j.size > maxSize) {
                alert("File Should not exceed 100kb. ");
                c.value = '';
                return false;

            }

            let emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
            let d = document.forms['teamform']['email'].value;
            if (!emailRegex.test(d)) {
                alert("Please enter a valid email address.");
                return false;
            }

            let e = document.getElementById("Male").checked;
            let f = document.getElementById("Female").checked;
            if (!e && !f) {
                alert("Select a Gender");
                return false;
            }

            const selectedCountry = countrySelect.value;
            const selectedState = stateSelect.value;
            const selectedCity = citySelect.value;

            if (selectedCountry === " "  || selectedState === " " || selectedCity === " ") {
                alert("Please select a country, state, and city.");
                return false;
            }

            let g = document.querySelectorAll('input[name="complete[]"]:checked');
            if (g.length === 0) {
                alert("Select Atleast One Option");
                return false;
            }

            let h = document.forms["teamform"]["profiledes"].value;
            if (h == "") {
                alert("Please Enter Profile Description!!!");
                return false;
            }
        }
    </script>
</body>

</html>
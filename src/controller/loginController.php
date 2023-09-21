<?php

session_start();
$login = false ;
// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: template.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $username = $_POST['username'];
    $password = $_POST['psw'];

    // Include the database configuration file
    require_once "config.php";

    // Create a database connection
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Check for connection errors
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Prepare the query
    $query = "SELECT password FROM users WHERE username=?";
    $statement = mysqli_prepare($connection, $query);

    // Bind the username parameter
    mysqli_stmt_bind_param($statement, "s", $username);

    // Execute the query
    mysqli_stmt_execute($statement);

    // Bind the result
    mysqli_stmt_bind_result($statement, $storedHash);

    // Fetch the result
    mysqli_stmt_fetch($statement);

    // Hash the user-provided password
    $hashedPassword = md5($password);

    // Compare the hashed passwords
    if ($hashedPassword === $storedHash) {
        // Authentication successful
        $_SESSION['username'] = $username;
        $login = true;
        mysqli_stmt_close($statement);
        mysqli_close($connection);
        $successMessage = "Authentication successful. Redirecting to the index page...";

        echo '
        <style>
        .loader-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Adjust this value to match your layout */
            position: relative;
        }

        .loader-shade {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity and color as desired */
            z-index: 1;
        }

        .loader {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            z-index: 2;
        }

        .loader-progress {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #3498db; /* Adjust the fill color as desired */
            transform-origin: top center;
            transition: transform 0.3s ease-in-out;
        }

        .load-percentage {
            font-size: 24px;
            margin-top: 16px;
            text-align: center;
            z-index: 2;
            color: white; /* Adjust the text color as desired */
        }
        </style>

        <div class="loader-container">
            <div class="loader-shade"></div>
            <div class="loader" id="loader">
                <div class="loader-progress" id="loader-progress"></div>
            </div>
            <div class="load-percentage" id="load-percentage">0%</div>
        </div>

        <script>
        var loaderProgress = document.getElementById("loader-progress");
        var loadPercentage = document.getElementById("load-percentage");

        var percentage = 0;
        var interval = setInterval(function() {
            percentage += 10;
            loadPercentage.textContent = percentage + "%";
            loaderProgress.style.transform = "scaleY(" + (percentage / 100) + ")";

            if (percentage >= 100) {
                clearInterval(interval);
                loaderProgress.style.transition = "none"; // Remove transition for immediate completion
                loaderProgress.style.transform = "scaleY(1)";
                loadPercentage.textContent = "Loading complete!";
                window.location.href = "index.php";
            }
        }, 300); // Adjust the interval time as per your requirements
        </script>';
        exit();
    } else {
        // Authentication failed
        $error = "Invalid username or password, Please Try again";

        // Display error message using a popup alert
        echo '
            <div class="alert alert-danger d-flex align-items-center p-5 mb-10" id="pop-alert">
                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger">Login Interrupted</h4>
                    <span>' . $error . '</span>
                </div>
            </div>
            <script>
                var popupAlert = document.querySelector("#pop-alert");
                    var closeButton = popupAlert.querySelector(".close");

                    popupAlert.style.display = "block";

                    setTimeout(function() {
                        popupAlert.style.opacity = "0";
                        setTimeout(function() {
                            popupAlert.style.display = "none";
                        }, 500); // Hide after 0.5 seconds (after opacity transition)
                    }, 3000); // Hide after 3 seconds

                    closeButton.addEventListener("click", function() {
                        popupAlert.style.display = "none";
                    });
            </script>
    ';
    }

    // Close the statement
    mysqli_stmt_close($statement);

    // Close the database connection
    mysqli_close($connection);
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center ;
        min-height: 100vh;
        height: 100vh;
        gap: 10px;
    }
    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 300px;
        max-width: 100%;
        text-align: center;
    }
    h2 {
        color: #333;
        margin-bottom: 20px;
    }
    .detail {
        font-size: 16px;
        margin-bottom: 10px;
        color: #555;
        text-align: left;
    }
    .data {
        font-weight: bold;
        color: #333;
    }
    .success {
        color: #28a745;
    }
    .error {
        color: #dc3545;
    }
    .ok-button {
        background-color: rgba(0, 0, 0, 0.927);
            color: #ffffff;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            display: block;
            margin: auto;
            font-weight: 500;
            transition: 0.3s;
            border: 1px solid white;
    }
    .ok-button:hover {
            background-color: #000000;
        }
        .ok-button:focus {
            background-color: transparent;
            color: rgb(0, 0, 0);
            border-color: #000000;
            font-weight: 600;
        }
</style>

</style>

<body>
<?php
// Function to generate a random string for file names
function generateRandomString($length = 20) {
    return bin2hex(random_bytes($length));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$name || !$email) {
        echo "<div class='container'><p class='error'>Invalid input.</p></div>";
        echo "<form action='index.php' method='get'>";
        echo "<input type='submit' class='ok-button' value='BACK' />";
        echo "</form>";
        exit;
    }

    // Handle PDF upload
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $pdfTmpName = $_FILES['pdf']['tmp_name'];
        $pdfExtension = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
        $pdfName = generateRandomString() . '.' . $pdfExtension;
        $pdfPath = 'uploads/pdf/' . $pdfName;

        // Validate file type and size
        $allowedTypes = ['application/pdf'];
        if (!in_array($_FILES['pdf']['type'], $allowedTypes)) {
            echo "<div class='container'><p class='error'>Invalid PDF file type.</p></div>";
            exit;
        }

        if ($_FILES['pdf']['size'] > 5 * 1024 * 1024) { // Limit size to 5MB
            echo "<div class='container'><p class='error'>PDF file is too large.</p></div>";
            exit;
        }

        // Move uploaded file
        if (move_uploaded_file($pdfTmpName, $pdfPath)) {
            echo "<div class='container'><p class='success'>PDF uploaded successfully.</p></div>";
        } else {
            echo "<div class='container'><p class='error'>Failed to upload PDF.</p></div>";
        }
    } else {
        echo "<div class='container'><p class='error'>No PDF file uploaded or error in upload.</p></div>";
    }

    // Handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photoTmpName = $_FILES['photo']['tmp_name'];
        $photoExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = generateRandomString() . '.' . $photoExtension;
        $photoPath = 'uploads/photos/' . $photoName;

        // Validate file type and size
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['photo']['type'], $allowedTypes)) {
            echo "<div class='container'><p class='error'>Invalid photo file type.</p></div>";
            exit;
        }

        if ($_FILES['photo']['size'] > 2 * 1024 * 1024) { // Limit size to 2MB
            echo "<div class='container'><p class='error'>Photo file is too large.</p></div>";
            exit;
        }

        // Move uploaded file
        if (move_uploaded_file($photoTmpName, $photoPath)) {
            echo "<div class='container'><p class='success'>Photo uploaded successfully.</p></div>";
        } else {
            echo "<div class='container'><p class='error'>Failed to upload photo.</p></div>";
        }
    } else {
        echo "<div class='container'><p class='error'>No photo file uploaded or error in upload.</p></div>";
    }

    // Display submitted data with CSS styling
    echo "<div class='container'>";
    echo "<h2>Submission Details</h2>";
    echo "<p class='detail'>Name: <span class='data'>" . htmlspecialchars($name) . "</span></p>";
    echo "<p class='detail'>Email: <span class='data'>" . htmlspecialchars($email) . "</span></p>";
    echo "<form action='index.php' method='get'>";
    echo "<input type='submit' class='ok-button' value='BACK' />";
    echo "</form>";
    echo "</div>";
}
?>

</body>
</html>
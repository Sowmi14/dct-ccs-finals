<?php 
include('../partials/header.php'); 
include('../partials/side-bar.php'); 
include('../../functions.php'); // Include the functions.php for database operations

// Check if subject_code or subject_id is passed in the URL
if (isset($_GET['subject_code'])) {
    $subjectCode = $_GET['subject_code'];

    // Fetch the subject data using the subject_code
    $subject = getSubjectByCode($subjectCode); // Function to fetch subject by code
} else {
    // If no subject_code is found in the URL, redirect back to the subject list page
    header("Location: add.php");
    exit;
}

// Handle form submission for updating subject
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectId = $_POST['subject_id']; // Get subject ID
    $subjectName = $_POST['subject_name']; // Get new subject name

    // Update the subject name in the database
    if (updateSubjectName($subjectId, $subjectName)) {
        // Redirect back to the subject list page after successful update
        header("Location: add.php");
        exit;
    } else {
        $error_message = "Error updating the subject. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Subject</h1>
        <div class="breadcrumb">
            <a href="#">Dashboard</a> / <a href="#">Add Subject</a> / Edit Subject
        </div>

        <!-- Display error message if there is any -->
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if ($subject): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="subject-id">Subject Code</label>
                    <input type="text" id="subject-id" name="subject_code" value="<?= htmlspecialchars($subject['subject_code']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="subject-name">Subject Name</label>
                    <input type="text" id="subject-name" name="subject_name" value="<?= htmlspecialchars($subject['subject_name']) ?>" required>
                </div>
                <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">

                <button type="submit" class="btn">Update Subject</button>
            </form>
        <?php else: ?>
            <p>Subject not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

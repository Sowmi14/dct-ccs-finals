<?php 
include('../partials/header.php'); 
include('../partials/side-bar.php'); 
include('../../functions.php'); // Include your functions.php for database operations

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_subject'])) {
    // Get form data
    $subject_code = $_POST['subject-code'];
    $subject_name = $_POST['subject-name'];

    // Call function to add subject to the database
    $result = addSubject($subject_code, $subject_name);
    if ($result) {
        // Redirect back to the same page after successful addition
        header("Location: add.php");
        exit;
    } else {
        $error_message = "Error adding the subject. Please try again.";
    }
}

// Get all subjects
$subjects = getSubjects();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add a New Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .breadcrumb {
            margin-bottom: 20px;
        }
        .breadcrumb a {
            text-decoration: none;
            color: #007bff;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .form-container, .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .btn-edit {
            background-color: #17a2b8;
            margin-right: 5px;
        }
        .btn-edit:hover {
            background-color: #138496;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add a New Subject</h1>
        <div class="breadcrumb">
            <a href="#">Dashboard</a> / Add Subject
        </div>

        <!-- Display error message if there is any -->
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="subject-code">Subject Code</label>
                    <input type="text" id="subject-code" name="subject-code" required>
                </div>
                <div class="form-group">
                    <label for="subject-name">Subject Name</label>
                    <input type="text" id="subject-name" name="subject-name" required>
                </div>
                <button type="submit" name="add_subject" class="btn">Add Subject</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Subject List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subjects as $subject): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                            <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                            <td>
                                <a href="edit.php?subject_code=<?php echo urlencode($subject['subject_code']); ?>&subject_name=<?php echo urlencode($subject['subject_name']); ?>" class="btn btn-edit">Edit</a>
                                <a href="delete.php?subject_code=<?php echo urlencode($subject['subject_code']); ?>&subject_name=<?php echo urlencode($subject['subject_name']); ?>" class="btn btn-delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

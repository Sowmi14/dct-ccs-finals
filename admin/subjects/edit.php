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
    </style>
</head>
<body>
    <div class="container">
        <h1>Add a New Subject</h1>
        <div class="breadcrumb">
            <a href="#">Dashboard</a> / Add Subject
        </div>
        <div class="form-container">
            <div class="form-group">
                <label for="subject-code">Subject Code</label>
                <input type="text" id="subject-code" name="subject-code">
            </div>
            <div class="form-group">
                <label for="subject-name">Subject Name</label>
                <input type="text" id="subject-name" name="subject-name">
            </div>
            <button class="btn">Add Subject</button>
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
                    <tr>
                        <td>1001</td>
                        <td>English</td>
                        <td>
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1002</td>
                        <td>Mathematics</td>
                        <td>
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1003</td>
                        <td>Science</td>
                        <td>
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
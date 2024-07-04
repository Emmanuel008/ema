<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "ibuahubdatastore";
$port = 3306;

$conn = new mysqli($host, $username, $password, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['upload']) || isset($_POST['update'])) {
    $photo = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "./images/" . basename($photo);

    if (move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Image uploaded successfully.');</script>";
    } else {
        echo "<script>alert('Image upload failed.');</script>";
        exit();
    }

    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';
    $link = isset($_POST['link']) ? htmlspecialchars($_POST['link']) : '';

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("UPDATE news SET photo = ?, title = ?, content = ?, link = ? WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssssi", $photo, $title, $content, $link, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Record updated successfully.');</script>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }

        $stmt->close();
    } else {
        $stmt = $conn->prepare("INSERT INTO news (photo, title, content, link) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssss", $photo, $title, $content, $link);

        if ($stmt->execute()) {
            echo "<script>alert('New record created successfully.');</script>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }

        $stmt->close();
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully.');</script>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM news");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: white;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
            margin-bottom: 20px;
        }
        .table-container {
            margin-top: 20px;
            max-width: 100%;
            overflow-x: auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 40px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        .form-control-file {
            padding: 10px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #337ab7;
            color: #fff;
        }
        .btn-warning {
            background-color: #f0ad4e;
            color: #fff;
        }
        .btn-danger {
            background-color: #d9534f;
            color: #fff;
        }
        body {
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #333;
            padding: 1rem;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
        }
        .navbar-brand span {
            color: #ff6347; /* Tomato color */
        }
        .nav-link {
            color: #fff !important;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #ff6347 !important;
        }
        .navbar-toggler {
            border-color: #ff6347;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%288, 8, 8, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .custom-icon {
            color: #fff;
            font-size: 1.2rem;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        .custom-icon:hover {
            color: #ff6347;
        }
        .navbar-collapse {
            justify-content: flex-end;
        }
        .nav-item {
            position: relative;
        }
        .nav-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: #ff6347;
            left: 50%;
            bottom: -5px;
            transition: all 0.3s ease;
        }
        .nav-item:hover::after {
            width: 100%;
            left: 0;
        }
        .was-validated .form-control:invalid, .was-validated .form-control-file:invalid, .was-validated .form-control-textarea:invalid {
            border-color: #dc3545;
        }
        .was-validated .form-control:invalid:focus, .was-validated .form-control-file:invalid:focus, .was-validated .form-control-textarea:invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .table-container {
            overflow-x: auto;
        }
        .table-container .table {
            width: 100%;
            min-width: 1000px; /* Adjust this to fit your content */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="index.php">
            <strong><span>iBUA</span> Hub</strong>
        </a>

        <div class="d-lg-none">
            <a href="sign-in.html" class="bi-person custom-icon me-3"><i class="fas fa-user"></i></a>
            <a href="product-detail.html" class="bi-bag custom-icon"><i class="fas fa-shopping-bag"></i></a>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="News.php">News</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="faq.php">FAQs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>

            <div class="d-none d-lg-flex">
                <a href="sign-in.html" class="custom-icon me-3"><i class="fas fa-user"></i></a>
                <a href="product-detail.html" class="custom-icon"><i class="fas fa-shopping-bag"></i></a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="form-container">
                <img src="images/news.png" alt="Homepage">
                <form id="uploadForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="photo"><strong>Image:</strong></label>
                        <input type="file" name="photo" class="form-control-file" required>
                        <div class="invalid-feedback">Please select a photo.</div>
                    </div>
                    <div class="form-group">
                        <label for="title"><strong>Title:</strong></label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Content:</strong></label>
                        <textarea name="content" rows="5" class="form-control" required></textarea>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="link"><strong>Link:</strong></label>
                        <input type="url" class="form-control" id="link" placeholder="Enter Link" name="link" required>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="upload"><strong>Submit</strong></button>
                        <button type="submit" class="btn btn-warning ml-2" name="update" style="display:none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-md-7">
            <br><br>
            <h2><strong>NEWS📰</strong></h2>
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()):?>
                            <tr>
                                <td><img src="images/<?php echo $row['photo'];?>" alt="<?php echo $row['title'];?>" width="50"></td>
                                <td><?php echo $row['title'];?></td>
                                <td><?php echo $row['content'];?></td>
                                <td><a href="<?php echo $row['link'];?>" target="_blank"><?php echo $row['link'];?></a></td>
                                <td>
                                    <form method="post" style="display: inline-block;">
                                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-warning btn-sm" style="width:57px;" onclick="editRecord(<?php echo $row['id'];?>, '<?php echo $row['title'];?>', '<?php echo $row['content'];?>', '<?php echo $row['link'];?>')">Edit</button>
                                </td>
                            </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function editRecord(id, title, content, link) {
        $('input[name="id"]').val(id);
        $('input[name="title"]').val(title);
        $('textarea[name="content"]').val(content);
        $('input[name="link"]').val(link);
        $('button[name="upload"]').hide();
        $('button[name="update"]').show();
    }
    window.history.pushState(null, "", window.location.href);        
    window.onpopstate = function() {
        window.history.pushState(null, "", window.location.href);
    };
</script>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.getElementById('uploadForm');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>

</body>
</html>

<?php
$conn->close();
?>

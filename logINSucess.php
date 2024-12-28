<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Blog</title>
    <link rel="stylesheet" href="loginSucess.css">
</head>
<body>
    <form action="logINSucess.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <nav>
                <div><a href="logINSucess.php">POST BLOG</a></div>
                <div><a href="blogs.php">BLOGS</a></div>
            </nav>
            <div>
                <label for="blogTitle">Blog Title :</label>
                <input type="text" name="blogTitle" id="blogTitle">

                <label for="blogContent">Blog Content</label>
                <textarea name="blogContent" id="blogContent">Write your content</textarea>

                <label for="image">Image :</label>
                <input type="file" name="image">

                <button type="submit" name="submit">POST</button>
            </div>
        </fieldset>
    </form>

    <?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "loginsystem";

    $conn = new mysqli($server, $username, $password, $db_name);
    if ($conn->connect_error) {
        die("Failed to connect to database: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $blogTitle = $conn->real_escape_string($_POST['blogTitle']);
        $blogContent = $conn->real_escape_string($_POST['blogContent']);
        $user_id = $_SESSION['id']; 
        
        $imagePath = null; 
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = uniqid() . "_" . $_FILES['image']['name'];  
            $imageTempName = $_FILES['image']['tmp_name'];
            $imageFolder = 'uploads/' . $imageName;
            if (move_uploaded_file($imageTempName, $imageFolder)) {
                $imagePath = $imageFolder;
            } else {
                echo "Failed to upload image.";
                exit;
            }
        }

        $sql = "INSERT INTO blogdesc (blogTitle, blogContent, image, user_id) 
                VALUES ('$blogTitle', '$blogContent', '$imagePath', '$user_id')";

        if ($conn->query($sql) === TRUE) {
            header('Location: blogs.php');
            exit;
        } else {
            echo "Unable to post your blog: " . $conn->error;
        }
    }
    $conn->close();
    ?> 
</body>
</html>

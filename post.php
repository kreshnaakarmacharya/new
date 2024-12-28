<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <?php
            $server="localhost";
            $username="root";
            $password="";
            $db_name="loginsystem";
            $conn=new mysqli($server,$username,$password,$db_name);
            if($conn->connect_error){
                echo "Failed to connect database".$conn->connect_error();
            }
        $sql="SELECT blogDesc.blogTitle,blogDesc.blogContent,blogDesc.image
            FROM blogDesc INNER JOIN information ON blogDesc.id=information.id
            WHERE blogDesc.blogID=BlogDesc.id";
        
     ?>
      <form action="update_blog.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Blog Details</legend>
            
            <label for="blogTitle">Blog Title:</label>
            <input type="text" name="blogTitle" id="blogTitle" value="<?php echo htmlspecialchars($blogTitle); ?>" required>

            <label for="blogContent">Blog Content:</label>
            <textarea name="blogContent" id="blogContent" required><?php echo htmlspecialchars($blogContent); ?></textarea>

            <label for="image">Blog Image:</label>
            <?php if ($image): ?>
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Blog Image" width="150">
            <?php endif; ?>
            <input type="file" name="image">

            <button type="submit">Update Blog</button>
        </fieldset>
    </form>
</body>
</html>
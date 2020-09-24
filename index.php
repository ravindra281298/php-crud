<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP CRUD</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
        crossorigin="anonymous">
    </head>
    <body>
        <?php require_once 'process.php' ?>

        <?php 
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']); 
            ?>
        </div>
        <?php endif ?>
        <?php
            $mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        ?>

        <div class="container">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th colspan="2">Action</th>
                </thead>
            <?php
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row["id"]; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="container">
        <form action="process.php" method="post">
        <input type="hidden" name="id", value=<?php echo $id; ?>>
            <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo $name; ?>" placeholder="Enter your name">
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" autocomplete="off" value="<?php echo $email; ?>"placeholder="Enter your email">
            </div>
            <div class="form-group">
            <?php if($update == true): ?>
                <button type="submit" name="update" class="btn btn-primary" >Update</button>
            <?php else: ?>    
                <button type="submit" name="save" class="btn btn-primary" >Save</button>
            <?php endif ?>
            </div>
        </form>
        </div>
    </body>
</html>
<?php require_once("include/connectDB.php");  ?>
<?php require_once("include/session.php");  ?>
<?php require_once("include/functions.php");  ?>
<?php
$Admin = "Ani Verzivolli";// to be changed into dynamic later
if (isset($_POST["Submit"])) {
    $Title = mysqli_real_escape_string($link, $_POST["Title"]);
    $Category = mysqli_real_escape_string($link, $_POST["Category"]);
    $Post = mysqli_real_escape_string($link, $_POST["Post"]);
    date_default_timezone_set("Europe/Rome");
    $CurrentTime = time();
    $DateTime = strftime("%d-%B-%Y %H:%M:%S" , $CurrentTime);
    $Image = $_FILES["Image"]["name"];
    $Target = "Upload/".basename($_FILES["Image"]["name"]);
    if (empty($Title)) {
        $_SESSION["ErrorMessage"] = "Title should not be empty";
        Redirect("AddNewPost.php");
    } elseif (strlen($Title) < 4) {//
        $_SESSION["ErrorMessage"] = "Title should be at least 4 characters long";
        Redirect("AddNewPost.php");
    }  elseif (strlen($Title) > 200) {//
        $_SESSION["ErrorMessage"] = "Title should not be more than 200 characters";
        Redirect("AddNewPost.php");
    } else {
        global $link;
        global $db_selected;
        $TableName = "admin_panel";
        $Query = "INSERT INTO {$TableName} (datetime, title , category, author, image, post)
                VALUES ('{$DateTime}','{$Category}','{$Category}','{$Admin}','{$Image}','{$Post}')";
        if (move_uploaded_file($_FILES["Image"]["tmp_name"],"$Target")) {
            //$_SESSION["SuccessMessage"] = "file successfuly uploaded.";
            continue;
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong uploading file";
            Redirect("AddNewPost.php");
        }
        if ($link->query($Query) === TRUE) {
            $_SESSION["SuccessMessage"] = "Post successfuly inserted into database.";
            Redirect("AddNewPost.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong";
            Redirect("AddNewPost.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="PLearning PHP">
    <meta name="author" content="Ani Verzivolli">
	<title>New Post Dashboard</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/admin.css">
</head>
<body> 
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1>Admin</h1>
            <ul id="side-menu" class="nav nav-pills nav-stacked">
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                <li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live blog</a></li>
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>
            </ul>
        </div> <!-- Ending of side area -->
        <div class="col-sm-10">
            <h1>Add Now Post</h1>
            <div><?php echo ErrorMessage(); ?></div>
            <div><?php echo SucessMessage(); ?></div>
            <div>
                <form action="AddNewPost.php" method="post" enctype="multipart/form-data" >
                    <fieldset>
                            <div class="form-group">
                                <label for="title"><span class="field-info">Title:</span></label>
                                <input class="form-control" type="text" name="Title" id="title" placeholder="Title" />
                            </div>
                            <div class="form-group">
                                <label for="categoryselect"><span class="field-info">Category:</span></label>
                                <select name="Category" id="categoryselect" class="form-control">
                                <?php
                                global $db_selected;
                                $TableName = "category";
                                $ViewQuery = "SELECT * FROM {$TableName} ORDER BY datetime desc";
                                $result = $link->query($ViewQuery);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($DataRows = $result->fetch_assoc()) {
                                        $id = $DataRows['id'];
                                        $Name = $DataRows['name'];
                                ?><option value=""><?php echo $Name; ?></option><?php }} ?></select>
                            </div>
                            <div class="form-group">
                                <label for="imageselect"><span class="field-info">Select image:</span></label>
                                <input class="form-control" type="file" name="Image" id="imageselect" placeholder="Title" />
                            </div>
                            <div class="form-group">
                                <label for="postarea"><span class="field-info">Post:</span></label>
                                <textarea class="form-control" id="postarea" name="Post"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-block" type="submit" name="Submit" Value="Add new post" />
                            </div>
                    </fieldset>
                </form>
            </div>
        </div> <!-- Ending of main area -->
    </div> <!-- Ending of row -->
</div> <!-- Ending of cintainer-fluid -->
<div id="footer">
    <hr><p>Theme By Php Tutorial &copy; --- All rights reserved</p>
    <a style="color: white; text-decoration:none; cursor:pointer; font-weight:bold;"
    href="#"><p>This site is only used for study purposes. No one is allowed to copy its content other than
    <br>&trade; Ani Verzivolli; Users that have permision from admin;</p></a>
    
</div>
</body>
</html>
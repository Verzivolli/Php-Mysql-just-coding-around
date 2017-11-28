<?php require_once("include/connectDB.php");  ?>
<?php require_once("include/session.php");  ?>
<?php require_once("include/functions.php");  ?>
<?php
$Admin = "Ani Verzivolli";// to be changed into dynamic later
if (isset($_POST["Submit"])) {
    $Category = mysqli_real_escape_string($link, $_POST["Category"]);
    date_default_timezone_set("Europe/Rome");
    $CurrentTime = time();
    $DateTime = strftime("%d-%B-%Y %H:%M:%S" , $CurrentTime);
    if (empty($Category)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect("categories.php");
    } elseif (strlen($Category) > 100) {// because category name is declared as varchar 100
        $_SESSION["ErrorMessage"] = "Too long name";
        Redirect("categories.php");
    } else {
        global $link;
        global $db_selected;
        $TableName = "category";
        $Query = "INSERT INTO {$TableName} (datetime, name , creator)
                VALUES ('{$DateTime}','{$Category}','{$Admin}')";
        if ($link->query($Query) === TRUE) {
            $_SESSION["SuccessMessage"] = "Record successfuly inserted into database.";
        } else {
            $_SESSION["ErrorMessage"] = $link->error;
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
	<title>Categories Dashboard</title>
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
            <h1>Manage categories</h1>
            <div><?php echo ErrorMessage(); ?></div>
            <div><?php echo SucessMessage(); ?></div>
            <div>
                <form action="categories.php" method="post">
                    <fieldset>
                            <div class="form-group">
                                <label for="categoryname"><span class="field-info">Name:</span></label>
                                <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name" />
                                
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-block" type="submit" name="Submit" Value="Add new category" />
                            </div>
                    </fieldset>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr No.</th>
                        <th>Created</th>
                        <th>Category Name</th>
                        <th>Creator Name</th>
                    </tr>
                    <?php
                        global $db_selected;
                        $TableName = "category";
                        $ViewQuery = "SELECT * FROM {$TableName} ORDER BY datetime desc";
                        $result = $link->query($ViewQuery);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            $SrNo = 0;
                            while($DataRows = $result->fetch_assoc()) {
                                $id = $DataRows['id'];
                                $DateTime = $DataRows['datetime'];
                                $Name = $DataRows['name'];
                                $Creator = $DataRows['creator'];
                                $SrNo ++
                                ?>
                                <tr>
                                    <td><?php echo $SrNo; ?></td>
                                    <td><?php echo $DateTime; ?></td>
                                    <td><?php echo $Name; ?></td>
                                    <td><?php echo $Creator; ?></td>
                                </tr>
                                <?php
                            }
                        }// end of view query
                    ?>
                </table>
            </div><!-- Ending of table-responsive -->
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
<?php require_once("include/session.php");  ?>
<?php require_once("include/functions.php");  ?>
<?php require_once("include/globals.php");  ?>
<?php require_once("include/connectDB.php");  ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="PLearning PHP">
    <meta name="author" content="Ani Verzivolli">
	<title>Admin Dashboard</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/admin.css">
</head>
<body> 
<div style="height:10px; background:#27aae1;"></div>
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="header">
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" >
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a href="blog.php" class="navbar-brand"><img style="margin-top:-5px;" src="<?php echo $GLOBALS['uts_logo_image'] ?>" height="30"></img></a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="blog.php" target="_blank">Blog</a></li>
                <li class="active"><a href="blog.php">Blog</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Feature</a></li>
            </ul>
            <form action="blog.php" class="navbar-form navbar-right" method="GET">
                <div class="form-group">
                    <input type="text" name="Search" placeholder="Search" class="form-control" />
                    <input type="submit" value="Submit" class="btn btn-default" name="SearchButton" />
                </div>
            </form>
        </div>
    </div>
</div><!-- end of navbar -->
<div class="line" style="height:10px; background:#27aae1;"></div><!-- end of navbar including lines -->

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <br><br>
            <ul id="side-menu" class="nav nav-pills nav-stacked">
                <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                <li><a href="Dashboard.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                <li><a href="Dashboard.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                <li><a href="Dashboard.php"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live blog</a></li>
                <li><a href="Dashboard.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>
            </ul>
        </div> <!-- Ending of side area -->
        <div class="col-sm-10">
            <div><?php echo ErrorMessage(); ?></div>
            <div><?php echo SucessMessage(); ?></div>
            <h1>Dashboard</h1>
            <div class="table-responsive">
                <table class="table stripped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Post Title</th>
                        <th>DateTime</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                    <?php
                    global $db_selected;
                    $TableName = "admin_panel";
                    $ViewQuery = "SELECT * FROM {$TableName} ORDER BY datetime desc";
                    $result = $link->query($ViewQuery);
                    if ($result->num_rows > 0) {
                        while($DataRows = $result->fetch_assoc()) {
                            $id = $DataRows['id'];
                            $DateTime = $DataRows['datetime'];
                            $Title = $DataRows['title'];
                            $Category = $DataRows['category'];
                            $Author = $DataRows['author'];
                            $Image = $DataRows['image'];
                            $Post = $DataRows['post'];
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td style="color:#5e5eff;"><?php
                        if (strlen($Title)>20) {
                            $Title = substr($Title,0,20);
                        }
                        echo $Title; 
                        ?></td>
                        <td><?php echo $DateTime; ?></td>
                        <td><?php echo $Author; ?></td>
                        <td><?php echo $Category; ?></td>
                        <td><img src="Upload/<?php echo $Image; ?>" alt="" width="100px" height="100px"></td>
                        <td>Processing</td>
                        <td><a class="btn btn-warning btn-sm" href="EditPost.php?edit=<?php echo $id; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="DeletePost.php?id=<?php echo $id; ?>">Delete</a></td>
                        <td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $id; ?>">Live Preview</a></td>
                    </tr>
                    <?php }} ?>
                </table>
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
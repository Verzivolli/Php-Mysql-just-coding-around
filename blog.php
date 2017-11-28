<?php require_once("include/globals.php");  ?>
<?php require_once("include/connectDB.php");  ?>
<?php require_once("include/session.php");  ?>
<?php require_once("include/functions.php");  ?>
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
	<link rel="stylesheet" href="css/publicmain.css">
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
                <li><a href="#">About</a></li>
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
<div class="container">
    <div class="dms-header">
    <h1>Complete responsive template</h1><p class="lead">Php learning blog test site</p>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?php
                global $db_selected;
                $TableName = "admin_panel";
                if (isset($_GET["SearchButton"])) {
                    $Search = $_GET["Search"];
                    $ViewQuery = "SELECT * FROM {$TableName}
                                WHERE datetime LIKE '%{$Search}%'
                                OR title LIKE '%{$Search}%'
                                OR post LIKE '%{$Search}%'";
                } else {
                    $ViewQuery = "SELECT * FROM {$TableName} ORDER BY datetime desc";
                }
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
            <div class="blogpost thumbnail">
                <img src="Upload/<?php echo $Image; ?>" class="img-responsive img-rounded"></img>
                <div class="caption"><h1 class="title-heading"><?php echo htmlentities($Title); ?></h1></div>
                <p class="description">category:<?php echo htmlentities($Category); ?> <br>Published on:<?php echo htmlentities($DateTime); ?></p>
                <p><?php 
                if (strlen($Post)>150) {
                    $Post=substr($Post,0,150)."...";
                }
                echo htmlentities($Post); ?></p>
                <a href="FullPost.php?id=<?php echo $id; ?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
            </div>
            <?php }} ?>
        </div><!-- end of main -->
        <div class="col-sm-offset-1 col-sm-3">
            <h2>test</h2><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
            
        </div>
    </div><!-- end of sidebar -->
</div><!-- end of container -->
<div id="footer">
    <hr><p>UTS-01 &copy; --- All rights reserved</p>
    
    <!--<a style="color: white; text-decoration:none; cursor:pointer; font-weight:bold;"
    href="#"><p>This site is only used for informational purposes. No one is allowed to copy its content other than
    <br>&trade; Ani Verzivolli; Users that have permision from admin;</p></a>-->
    <hr>
</div>
<div style="height:10px; background:#27aae1"></div>
</body>
</html>
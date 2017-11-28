<?php

$hostname="mysql4.gear.host";
$database="phpcms";
$username="phpcms";
$password="Iu8EV6-!DL4r";

?>

<?php

$link = mysqli_connect($hostname, $username, $password);
if (!$link) {
die('Connection failed: ' . mysql_error());
}
else{
     echo "Connection to MySQL server " .$hostname . " successful!
" . PHP_EOL;
}

$db_selected = mysqli_select_db($link, $database);
if (!$db_selected) {
    die ('Can\'t select database: ' . mysqli_error());
}
else {
    echo 'Database ' . $database . ' successfully selected!';
}

/*
//*********************************
// admin_panel table cration
//********************************
$val = mysqli_query($link, 'select 1 from `admin_panel` LIMIT 1');

if($val !== FALSE) {
   echo "Table admin_panel already exist!";
} else {
    //I can't find it...
    // sql to create table
    $sql = "CREATE TABLE admin_panel (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    datetime VARCHAR(50) NOT NULL,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    image VARCHAR(200) NOT NULL,
    post VARCHAR(10000) NOT NULL
    )";
    if ($link->query($sql) === TRUE) {
        echo "Table admin_panel created successfully";
    } else {
        echo "Error creating table: " . $link->error;
    }
}
//*/

/*
//***********************************
// category table
//**********************************
// Select 1 from table_name will return false if the table does not exist.
$val = mysqli_query($link, 'select 1 from `category` LIMIT 1');

if($val !== FALSE) {
   echo "Table category already exist!";
} else {
    //I can't find it...
    // sql to create table
    $sql = "CREATE TABLE category (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    datetime VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    creator VARCHAR(200)
    )";
    if ($link->query($sql) === TRUE) {
        echo "Table category created successfully";
    } else {
        echo "Error creating table: " . $link->error;
    }
}
*/

/*
//***********************************
// users table (UTS)
//**********************************
$val = mysqli_query($link, 'select 1 from `users` LIMIT 1');

if($val !== FALSE) {
   echo "Table users already exist!";
} else {
    //I can't find it...
    // sql to create table
    $sql = "CREATE TABLE users (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    datetime VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    projekte tinyint(1) NOT NULL,
    kategori tinyint(1) NOT NULL,
    users tinyint(1) NOT NULL,
    fjalori tinyint(1) NOT NULL,
    punetore tinyint(1) NOT NULL,
    stafi tinyint(1) NOT NULL,
    tjeter tinyint(2) DEFAULT NULL
    )";
    if ($link->query($sql) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $link->error;
    }
}
*/
/*
//***********************************
// kategori table (UTS)
//**********************************
$Tablename = "kategori";
$val = mysqli_query($link, "select 1 from `{$Tablename}` LIMIT 1");

if($val !== FALSE) {
   echo "Table {$Tablename} already exist!";
} else {
    //I can't find it...
    // sql to create table
    $sql = "CREATE TABLE {$Tablename} (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    datetime VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL
    )";
    if ($link->query($sql) === TRUE) {
        echo "Table {$Tablename} created successfully";
    } else {
        echo "Error creating table: " . $link->error;
    }
}
*/
/*
//***********************************
// users table (UTS) ALTER
//**********************************
$Tablename = "users";
$val = mysqli_query($link, 'select 1 from `{$Tablename}` LIMIT 1');

if($val !== FALSE) {
   echo "Table {$Tablename} already exist!";
} else {
    //I can't find it...
    // sql to create table
    $sql = "ALTER TABLE {$Tablename} ADD 
    password VARCHAR(20) NOT NULL";// alse added username
    if ($link->query($sql) === TRUE) {
        echo "SQL statement executed successfuly successfully";
    } else {
        echo "Error creating table: " . $link->error;
    }
}
*/

mysqli_close($link);

?>
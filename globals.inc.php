<?php
/*
 * globals.inc.php
 * Global variables and settings
 */
// Base directories
// Automatic, taken from CGI variables.
$baseDir = dirname($_SERVER['SCRIPT_FILENAME']);
#$baseDir = '/home/gelpi/DEVEL/WWW/DBW/PDBBrowser';
$baseURL = dirname($_SERVER['SCRIPT_NAME']);

// Temporal dir, create if not exists, however Web server 
// may not have the appropriate permission to do so
$tmpDir = "$baseDir/tmp";
// if (!file_exists($tmpDir)) {
//     mkdir($tmpDir);
// }

// Include directory
$incDir = "$baseDir/include";

// Load predefined arrays
// Fulltext search fields
$textFields = ['e.header', 'e.compound', 'a.author', 's.source', 'sq.header'];

// Compounds
$rs = mysqli_query($mysqli, "SELECT * from comptype") or print mysqli_error($mysqli);
while ($rsF = mysqli_fetch_assoc($rs)) {
    $compTypeArray[$rsF['idCompType']] = $rsF['type'];
}

//expTypes
$rs = mysqli_query($mysqli,"SELECT * from expType") or print mysqli_error($mysqli);
while ($rsF = mysqli_fetch_assoc($rs)) {
    $expTypeArray[$rsF['idExpType']] = $rsF;
}
//expClasses
$rs = mysqli_query($mysqli,"SELECT * from expClasse") or print mysqli_error($mysqli);
while ($rsF = mysqli_fetch_assoc($rs)) {
    $expClasseArray[$rsF['idExpClasse']] = $rsF['expClasse'];
}

// Variables needed to connect to the DB

$host = "localhost";
$user = "AdminPHP";
$pass = "1234_dcBA";
$dbname = "mydb";

// Start session to store queries
session_start();

?>

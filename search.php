<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

$name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LabManagementSystem</title>

            <style>
            table {
            border-collapse: collapse;
            width: 100%;
            }
            
            th, td {
            text-align: left;
            padding: 8px;
            }
            
            th {
            background-color: #ddd;
            }
            
            tr:nth-child(even) {
            background-color: #f2f2f2;
            }
            
            .table-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            }
        </style>

    <!-- Bootstrap styles -->
    <link href="css/styles.css" rel="stylesheet" />
  
    <!-- IE 8 Support-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
        <script type="text/javascript" src="DataTable/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="DataTable/jquery.dataTables.min.js"></script>
</head>
<body id="page-top">
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">LabManagementSystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Welcome, <?php echo $name; ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log out </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Options-->
    <header class="options">
    <form name="MainForm" action="search.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
            </div>
                <div class="col-lg-4">
                <div class="priviledge-option_read ">
                    <h4>Search for a reagent</h4>
                </div>
                <div class= "container">
                    <div class="square">
                            <div class="row">
                                    <div class="form-group">

                                        <label>What are you looking for?</label>

                                        <select name="search">

                                            <option value ="Name">Name</option>
                                            <option value ="Label">Label</option>
                                            <option value ="Reference">Reference</option>

                                        </select>   
                                        <input type="text" name="value" size="5">  
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p>
                        <button type='submit' class="btn btn-primary">Submit</button>
                        <button type='reset' class="btn btn-primary">Reset</button>
                    </p>
                </div>
            </div>
        </div>  
        </form>
        <?php if (isset($_SESSION['message_ok'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['message_ok']; ?></div>
    <?php unset($_SESSION['message_ok']); ?>
<?php elseif (isset($_SESSION['message_error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['message_error']; ?></div>
    <?php unset($_SESSION['message_error']); ?>
<?php endif; ?>
        
    </header>
    <!-- Footer-->
    <footer class="footer py-4">

        <div class="row">
            <div class="text-center">
                <a href="index.html#contact"><button type='contact' class="btn btn-primary">Contact</button></a>
            </div> 
        </div>
    </footer>

    <div class="table-container">

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $search = $_REQUEST['search'];
            $value = $_REQUEST['value'];
            
            $host = "localhost";
            $user = "AdminPHP";
            $pass = "1234_dcBA";
            $dbname = "mydb";

            $conn = mysqli_connect($host, $user, $pass, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query the database
            $sql = "SELECT Name, Label, Reference, Link, idReagents FROM Reagents WHERE " . $search . " = '$value'";
            $result = mysqli_query($conn, $sql);

            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {

                echo "<table><tr><th>Name</th><th>Label</th><th>Reference</th><th>Manufacturer's Link</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><a href=\"output.php?id=" . $row["idReagents"] . "\">". $row["Name"] . "</a></td><td>" . $row["Label"] . "</td><td>" . $row["Reference"] . "</td><td><a href='" . $row["Link"] . "'>" . $row["Link"] . "</a></td></tr>";
                }
                echo "</table>";

            } else {
            echo "<script>alert('No results found!');</script>";
            }

            // Close the database connection
            mysqli_close($conn);

        }

        ?>

    </div>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>

<?php

    session_start();
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
    }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $type = $_REQUEST['Container_Type'];
    $number = $_REQUEST['Container_Number'];
    $shelf = $_REQUEST['shelf'];
    $box = $_REQUEST['box'];
    $name = $_REQUEST['name'];
    $label = $_REQUEST['label'];
    $reference = $_REQUEST['reference'];
    $stock = $_REQUEST['stock'];
    $link = $_REQUEST['link'];
    

    $host = "localhost";
    $user = "AdminPHP";
    $pass = "1234_dcBA";
    $dbname = "mydb";

    $conn = mysqli_connect($host, $user, $pass, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the Placement Number already exists in the database

    $sql = "SELECT * FROM Placement WHERE Number='$number' AND Type='$type'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        // Check if the Placement has that number of shelfs and containers

        // Retrieve Placement ID
        $sql = "SELECT idPlacement FROM Placement WHERE Number='$number' AND Type='$type'";
        $id_placement = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($id_placement);
        $id_placement = $row["idPlacement"];
        
        // Determine the Partition ID from that Placement
        $sql = "SELECT Partition_type_idPartition_type FROM Placement_has_Partition_type WHERE Placement_idPlacement='$id_placement'";
        $id_partition = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($id_partition);
        $id_partition = $row["Partition_type_idPartition_type"];

        // Retrieve shelf and box number

        $sql = "SELECT Shelves FROM Partition_type WHERE idPartition_type ='$id_partition'";
        $shelf_check = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($shelf_check);
        $shelf_check = $row["Shelves"];


        $sql = "SELECT Box FROM Partition_type WHERE idPartition_type ='$id_partition'";
        $box_check = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($box_check);
        $box_check = $row["Box"];


        if (($shelf <= $shelf_check) and ($box <= $box_check)) {

            // Unique ID for the reagent
            $id_reagents = uniqid('reagent');

            $sql = "INSERT INTO Reagents (idReagents, Name, Label, Reference, Stock, Shelf, Box, Link, User_Email, Placement_idPlacement) VALUES ('$id_reagents','$name', '$label','$reference','$stock','$shelf','$box','$link', 'example@gmail.com','$id_placement')";
            
            if (mysqli_query($conn, $sql)) {

            echo "<script>alert('The addition was successful!');</script>";

        }

        mysqli_close($conn);


        } else {
            echo "<script>alert('The number of the shelf/box cannot be bigger than the one it has');</script>";
        }

    
    } else {
        echo "<script>alert('The selected Placement does not exist');</script>";
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LabManagementSystem</title>
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
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log out </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Options-->
    <header class="options">
        <div class="text-center">
            <h2 class="options-heading text-uppercase">Options</h2>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="priviledge-option">
                    <h4>Add a Reagent</h4>
                </div>
                <div class= "container">
                    <div class="square">
                    <form name="MainForm" action="add_search.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label><b>Select the container type</b></label>
                                    <select name="Container_Type">
                                        <option value ="Fridge">Fridge</option>
                                        <option value ="Freezer">Freezer</option>
                                        <option value ="Shelf">Shelf</option>
                                    </select> 
                                </div>
                            </div>
                        </div>                          
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Container Number</label>                  
                                    <input type="text" name="Container_Number" size="5" >
                                    <label>Shelf Number</label>                  
                                    <input type="text" name="shelf" size="5" >
                                    <label>Box Number</label>                  
                                    <input type="text" name="box" size="5" >
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Name</label>                  
                                    <input type="text" id="inputbox1" name="name" style="width:100%" size="5" value="e.g CD3 Antibody" onclick="clearInput(this)">
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Label</label>                  
                                    <input type="text" id="inputbox2" name="label" style="width:100%" size="5" value="e.g antibody" onclick="clearInput(this)">
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Reference</label>                  
                                    <input type="text" id="inputbox3" name="reference" style="width:100%" size="5" value="e.g # 11-0032-82" onclick="clearInput(this)">
                                </div>
                            </div>
                        </div>                    
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Stock</label>                  
                                    <input type="text" id="inputbox4" name="stock" style="width:100%" size="5" value="e.g # 2" onclick="clearInput(this)">
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Link to Manufacturer's Website</label>                  
                                    <input type="text" id="inputbox5" name="link" style="width:100%" size="5" value="e.g https://www.thermofisher.com/antibody/product/CD3-Antibody-clone-17A2-Monoclonal/11-0032-82" onclick="clearInput(this)">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="text-center">
                                    <p>
                                    <button type='submit' class="btn btn-primary">Submit</button>
                                    <button type='reset' class="btn btn-primary">Reset</button>
                                    </p>
                                </div>
                        </div> 
                     </form>
                     </div> 
                </div>
            </div>
        </div> 
    </header>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="row">
            <div class="text-center">
                <a href="index.html#contact"><button type='contact' class="btn btn-primary">Contact</button></a>
            </div>          
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    
    <script>
        function clearInput(input) {
        input.value = "";
        }
    </script>

</body>
</html>

<?php  echo @file_get_contents('header.php'); ?>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['admin'] == false && $_SESSION['loggedin'] == true) {
  
} else {
  header("Location:choose_login.php");
}
?>

<div class="h-100" style="background-image: url('rental004.jpg');background-size: cover;">

<div class="pt-5"></div>
<div class="container rounded bg-white ">
    <div class="row">
    <?php
        $servername = "localhost";
        $root_username = "root";
        $password = "";
        $dbname = "rental management system";
        
        try{
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $root_username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        $id_number = $_SESSION['id_number'];

        $house_number = "";
        
        $sql="SELECT * FROM `tenant` WHERE `ID Number`=$id_number";
        $result = $pdo->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $house_number = $row["House Number"];
            echo '<div class="col-md-3 border-right"><div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">'.$row["First Name"].' '.$row["Last Name"].'</span><span class="text-black-50">'.$row["Phone Number"].'</span><span> </span></div></div>';
            echo '<div class="col-md-5 border-right"><div class="p-3 py-5"><div class="d-flex justify-content-between align-items-center mb-3"><h4 class="text-right">My Profile</h4></div><div class="row mt-2"><div class="col-md-6"><label class="labels">First Name:</label><input type="text" class="form-control" value=" '.$row["First Name"].'" readonly></div><div class="col-md-6"><label class="labels">Last Name:</label><input type="text" class="form-control" value="'.$row["Last Name"].'" readonly></div></div><div class="row mt-3"><div class="col-md-12 mb-2"><label class="labels">Phone Number</label><input type="text" class="form-control" placeholder="enter phone number" value="'.$row["Phone Number"].'" readonly></div><div class="col-md-12 mb-2"><label class="labels">ID Number</label><input type="text" class="form-control" value="'.$row["ID Number"].'" readonly></div></div></div></div>';
        }

        $sql2="SELECT * FROM `house` WHERE `House Number`='$house_number'";
        $result2 = $pdo->query($sql2);
        while($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-4"><div class="p-3 py-5"><div class="col-md-12"><label class="labels">House Number</label><input type="text" class="form-control"  value="'.$row["House Number"].'" readonly></div> <br><div class="col-md-12"><label class="labels">Vacant</label><input type="text" class="form-control" value="'.$row["Vacant"].'" readonly></div> <br><div class="col-md-12"><label class="labels">Rent Balance</label><input type="text" class="form-control" value="'.$row["Rent Balance"].'" readonly></div> <br><div class="mt-5 text-center"><a href="logout.php"><button class="btn gradient-custom-3 profile-button py-2 px-5 text-light" type="button">Logout</button></a></div></div></div> ';
        }
        ?>
    </div>
</div>

</div>

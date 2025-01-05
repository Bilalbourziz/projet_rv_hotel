<?php 
session_start();
require __DIR__ . '/../database/db.php';
$sql1 = $conn->prepare("SELECT * FROM Users WHERE Role='client' ORDER BY id DESC");
$sql1->execute();
$result1 = $sql1->get_result();

$clients = [];
while ($row = $result1->fetch_assoc()) {
    $clients[] = $row;
}
$sql2 = $conn->prepare("SELECT 
    r.id AS reservation_id, 
    u.name AS user_name, 
    h.name AS hotel_name, 
    rm.room_type AS type_room, 
    r.check_in_date AS check_in, 
    r.check_out_date AS check_out, 
    r.adults_count AS adult, 
    r.children_count AS children, 
    c.chambre_number AS num_room 
FROM Reservations r 
JOIN Users u ON r.user_id = u.id 
JOIN Rooms rm ON r.room_id = rm.id 
JOIN chambre c ON r.chambre_id = c.chambre_id 
JOIN Hotels h ON r.hotel_id = h.id
where etat_reserve='termine';

");
$sql2->execute();
$result2 = $sql2->get_result();

$Reserve = [];
while ($row = $result2->fetch_assoc()) {
    $Reserve[] = $row;
}

$sql3=$conn->prepare("SELECT * FROM Hotels order by id desc");
$sql3-> execute();
$result3 = $sql3->get_result();

$Hotel = [];
while ($row = $result3->fetch_assoc()) {
    $Hotel[] = $row;
}
$sql4=$conn->prepare("SELECT * FROM Rooms order by id desc");
$sql4-> execute();
$result4 = $sql4->get_result();

$Room = [];
while ($row = $result4->fetch_assoc()) {
    $Room[] = $row;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin page</title>
    <!--<link rel="stylesheet"
        href="style.css">-->    
    <link rel="stylesheet"
        href="../styles/admin_page.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
 function confirmDeletion(deleteUrl) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action will remove your data permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the delete URL
            window.location.href = deleteUrl;
        }
    });
}

    </script>
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">ADMIN</div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
                class="icn menuicn"
                id="menuicn"
                alt="menu-icon">
        </div>

        <div class="searchbar">
            <input type="text"
                placeholder="Search">
            <div class="searchbtn">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                    class="icn srchicn"
                    alt="search-icon">
            </div>
        </div>

        <div class="message">
            <div class="circle"></div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png"
                class="icn"
                alt="">
            <div class="dp">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn"
                    alt="dp">
            </div>
        </div>

    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <a href="#" class="a" id="showclient" style="color: black;text-decoration:none;"><div class="nav-option option1">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4qod-zw-FaqKsUKfb5NxZLGkC2XoLJZeBeQ&s"
                            class="nav-img"
                            alt="dashboard">
                        <h3> Client</h3>
                    </div></a>

                    <a href="#" class="a" id="showhotel"  style="color: black;text-decoration:none;"><div class="option2 nav-option">
                        <img src="https://icon-library.com/images/hotel-icon-png/hotel-icon-png-3.jpg"
                            class="nav-img"
                            alt="articles">
                        <h3> Hotels</h3>
                    </div></a>

                    <a href="#" class="a" id="showroom" style="color: black;text-decoration:none;"><div class="nav-option option3">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqCQdmbWLnU_QAu4sLhgm0GLo9gzZXC4h9uQ&s"
                            class="nav-img"
                            alt="report">
                        <h3> Rooms</h3>
                    </div></a>

                    <a href="#" class="a" id="showReserve" style="color: black;text-decoration:none;"><div class="nav-option option4">
                        <img src="https://icon-library.com/images/reservation-icon-png/reservation-icon-png-29.jpg"
                            class="nav-img"
                            alt="institution">
                        <h3> reservations</h3>
                    </div></a>


                    <a href="../sing_in.php" id="logout" style="color: black;text-decoration:none;"><div class="nav-option logout">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png"
                            class="nav-img"
                            alt="logout">
                        <h3>Logout</h3>
                    </div></a>

                </div>
            </nav>
        </div>
        <div class="main">

            <div class="searchbar2">
                <input type="text"
                    name=""
                    id=""
                    placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn"
                        alt="search-button">
                </div>
            </div>
<div id="display" >
            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading">15</h2>
                        <h2 class="topic">membress</h2>
                    </div>

                    <img src="https://cdn-icons-png.flaticon.com/512/1370/1370267.png"
                        alt="Views">
                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">3</h2>
                        <h2 class="topic">hotels</h2>
                    </div>

                    <img src="https://cdn-icons-png.flaticon.com/512/3009/3009710.png"
                        alt="likes">
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">4500$</h2>
                        <h2 class="topic">salary/month</h2>
                    </div>

                    <img src="https://cdn-icons-png.flaticon.com/512/1194/1194711.png"
                        alt="comments">
                </div>

                <div class="box box4">
                       <div class="text">
                         <h2 class="topic-heading">50</h2>
                            <h2 class="topic">reservation effecetue</h2>
                    </div>

                    <img src="https://cdn-icons-png.flaticon.com/512/25/25404.png" alt="published">
                </div>
            </div>
<!--here i put the table--->


<table class="b" id="client" style="width: 90%; margin: auto; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 25px;" >
    <thead>
        <tr style="background-color:rgb(31, 2, 138); color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
            <th style="padding: 10px; border: 1px solid #ddd;">email</th>
            <th style="padding: 10px; border: 1px solid #ddd;">password</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Role</th>
            
            

            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client): ?>
            <tr style="background-color: #f9f9f9; text-align: center;">
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $client['id'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $client['name'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $client['email'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">  <?= $client['password'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $client['Role'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                   <a href="editClient.php?id=<?= $client['id'] ?>" 
                       style="display: inline-block; padding: 5px 15px; background-color:rgb(0, 160, 85); color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                       edit
                    </a>

                   <a href="javascript:void(0);" onclick="confirmDeletion('deleteClient.php?id=<?= $client['id'] ?>') "
                       style="display: inline-block; padding: 5px 15px; background-color:none; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;border:solid 2px rgb(81, 1, 112);color:rgb(81, 1, 112); ">
                       delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!----->


<!----->


<table class="b" id="reserve" style="width: 90%; margin: auto; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 25px;" >
    <thead>
        <tr style="background-color:rgb(31, 2, 138); color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Client</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Hotel</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Type room</th>
            <th style="padding: 10px; border: 1px solid #ddd;">number room</th>
            <th style="padding: 10px; border: 1px solid #ddd;">check in</th>
            <th style="padding: 10px; border: 1px solid #ddd;">check out</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Children</th>

            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Reserve  as $Reserves ): ?>
            <tr style="background-color: #f9f9f9; text-align: center;">
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Reserves ['reservation_id'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Reserves ['user_name'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Reserves ['hotel_name'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">  <?= $Reserves ['type_room'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">  <?= $Reserves ['num_room'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Reserves ['check_in'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Reserves ['check_out'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Reserves ['children'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                   <a href="editReserve.php?id=<?= $Reserves ['reservation_id'] ?>" 
                       style="display: inline-block; padding: 5px 15px; background-color:rgb(0, 160, 85); color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                       edit
                    </a>

                   <a href="javascript:void(0);"  onclick="confirmDeletion('deleteReserve.php?id=<?= $Reserves['reservation_id'] ?>')" 
                       style="display: inline-block; padding: 5px 15px; background-color:none; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;border:solid 2px rgb(81, 1, 112);color:rgb(81, 1, 112); ">
                       delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!----->
<!----->
<table class="b" id="hotel" style="width: 90%; margin: auto; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 25px;" >
    <thead>
        <tr style="background-color:rgb(31, 2, 138); color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Adress</th>
            <th style="padding: 10px; border: 1px solid #ddd;">contact_info</th>
       
            
            

            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Hotel as $Hotels): ?>
            <tr style="background-color: #f9f9f9; text-align: center;">
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Hotels['id'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Hotels['name'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Hotels['address'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">  <?= $Hotels['contact_info'] ?></td>
                
                <td style="padding: 10px; border: 1px solid #ddd;">
                   <a href="editHotels.php?id=<?= $Hotels['id'] ?>" 
                       style="display: inline-block; padding: 5px 15px; background-color:rgb(0, 160, 85); color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                       edit
                    </a>

                   <a href="javascript:void(0);"  onclick="confirmDeletion('deleteHotel.php?id=<?= $Hotels['id'] ?>')" 
                       style="display: inline-block; padding: 5px 15px; background-color:none; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;border:solid 2px rgb(81, 1, 112);color:rgb(81, 1, 112); ">
                       delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!----->


<!----->

<table class="b" id="room" style="width: 90%; margin: auto; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 25px;" >
    <thead>
        <tr style="background-color:rgb(31, 2, 138); color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Room type</th>
            <th style="padding: 10px; border: 1px solid #ddd;">price</th>
        
       
            
            

            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Room as $Rooms): ?>
            <tr style="background-color: #f9f9f9; text-align: center;">
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Rooms['id'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Rooms['room_type'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= $Rooms['prices'] ?></td>

                
                <td style="padding: 10px; border: 1px solid #ddd;">
                   <a href="editRooms.php?id=<?= $Rooms['id'] ?>" 
                       style="display: inline-block; padding: 5px 15px; background-color:rgb(0, 160, 85); color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                       edit
                    </a>

                   <a href="javascript:void(0);" onclick="confirmDeletion('deleteRoom.php?id=<?= $Rooms['id'] ?>')" 
                       style="display: inline-block; padding: 5px 15px; background-color:none; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;border:solid 2px rgb(81, 1, 112);color:rgb(81, 1, 112); ">
                       delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!----->


 </div>
        </div>
    </div>

    <script src="../styles/admin_page.js"></script>
</body>

</html>

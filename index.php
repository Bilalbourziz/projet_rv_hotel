

<?php
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: sing_in.php"); 
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
 
    
    <link rel="stylesheet" href="styles/style.css">
</head>
<div class="page">
<body>
    <header class="header-area">
        <!-- site-navbar start -->
        <div class="navbar-area">
          <div class="container">
            <nav class="site-navbar">
              <!-- site logo -->
              <a href=""><img src="images/imageedit_6_4031431126 1.png"><span class="ff"> hotel-b.com |</span></a>
      
              <!-- site menu/nav -->
              <ul>
                <li><a href="#">home</a></li>
                <li><a href="#" class="about" address="true">about</a></li>
                <li><a href="rapport.php">Reservation</a></li>
                <li><a href="#" class="contact">contact</a></li>
                <li><a href="sing_in.php" class="a">se connecter</a></li>
               
         

               

              </ul>
      
              <!-- nav-toggler for mobile version only -->
              <button class="nav-toggler">
                <span></span>
              </button>
            </nav>
          </div>
        </div>
        <div class="intro-area">
          <div class="container">
            <h2 class="title"><strong align="center">Hôtels à Rabat</strong></h2>
            <p align="center" class="element">Les meilleurs hôtels pas chers</p>
          </div>
          <div class="wrapper">
             <a href="" class="scroll-down" address="true"><i class="fa-solid fa-angle-down"></i></a>
          </div>
        </div>

      </header>
      <!----->

      <main class="ok">
        <div>
          <h1>Trouvez votre prochain séjour</h1>
          <h3>Recherchez des prix bas sur les hôtels, maisons et bien plus encore...</h3>
        </div>
      </main>
      <section class="cc">
      <div class="custom-card ">
        <div class="custom-card-img" style="background-image:url(https://cdn.kiwicollection.com/media/room_images/PR006117/xl/006117-lasuiteshangri-la-1488972.jpg);">
            <div class="custom-overlay">
                <div class="custom-overlay-content">
                <a href="reserve.php?hotel_id=1" class="view-project" data-hotel-id="1">Book</a>
                </div>
            </div>
        </div>
        <div class="custom-card-content">
           <div class="card-hotel">
                <h2>Hotel Hilton</h2>
                <div class="stars">
               <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               
            </div>
           
            </div>
                <p>Un havre prestigieux dans une ville d’élite, où luxe et distinction redéfinissent l’hospitalité.</p>
                <p> <i class="fa-solid fa-bath"></i> |
                <i class="fa-solid fa-bed"></i> |
                <i class="fa-solid fa-wifi"></i> |
                <i class="fa-solid fa-utensils"></i>
            </p>
       
        </div>
    </div>
    
    <div class="custom-card">
        <div class="custom-card-img" style="background-image:url(https://image-tc.galaxy.tf/wijpeg-co0dei3e4rwfz24s8ewkwbuq0/ec-exterior-night.jpg);">
            <div class="custom-overlay">
                <div class="custom-overlay-content">
                <a href="reserve.php?hotel_id=2" class="view-project" data-hotel-id="2">Book</a>
                </div>
            </div>
        </div>
        <div class="custom-card-content">
           <div class="card-hotel">
                <h2>Hotel Friends</h2>
                <div class="stars">
               <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
            </div>
           
            </div>
                <p>Un refuge d'élégance au cœur du centre-ville, où confort et raffinement s'unissent pour une escapade urbaine mémorable.</p>
                <p> <i class="fa-solid fa-bath"></i> |
                <i class="fa-solid fa-bed"></i> |
                <i class="fa-solid fa-wifi"></i> | 
                <i class="fa-solid fa-utensils"></i>
            </p>
       
        </div>
    </div>
    
    <div class="custom-card">
        <div class="custom-card-img" style="background-image:url(https://static.barcelo.com/content/dam/bhg/master/es/hoteles/spain/canarias/tenerife/barcelo-santiago/main-photos/hotel/BSANTI_VIEW_01.jpg);">
            <div class="custom-overlay">
                <div class="custom-overlay-content">
                <a href="reserve.php?hotel_id=3" class="view-project" data-hotel-id="3">Book</a>
                </div>
            </div>
        </div>
        <div class="custom-card-content">
           <div class="card-hotel">
                <h2>Hotel Kings</h2>
                <div class="stars">
               <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
            </div>
           
            </div>
                <p>Un havre de paix au bord de la mer, où luxe et sérénité se rencontrent pour une expérience inoubliable.</p>
                <p> <i class="fa-solid fa-bath"></i> |
                <i class="fa-solid fa-bed"></i> |
                <i class="fa-solid fa-wifi"></i> | 
                <i class="fa-solid fa-utensils"></i> |
                <i class="fa-solid fa-person-swimming"></i>

            </p>
       
        </div>
    </div>
    </section>
    <!----->
    <div id="reservation-form">
    <h3>Reservation Form</h3>
    <form action="reserve.php" method="post"> <!-- Ensure this points to reserve.php -->
        <input type="hidden" name="hotel_id" value="1"> <!-- Set this dynamically based on selected hotel -->

        <div class="form-group">
            <label for="check-in">Check-in Date <span>*</span></label>
            <input type="date" id="check-in" name="check-in" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="check-out">Check-out Date<span>*</span></label>
            <input type="date" id="check-out" name="check-out" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="adults">Number of Adults<span>*</span></label>
            <select id="adults" name="adults" class="form-control">
                <option value="1">1 Adult</option>
                <option value="2">2 Adults</option>
                <option value="3">3 Adults</option>
                <option value="4">4 Adults</option>
            </select>
        </div>
        <div class="form-group">
            <label for="children">Number of Children<span>*</span></label>
            <select id="children" name="children" class="form-control">
                <option value="0">No Children</option>
                <option value="1">1 Child</option>
                <option value="2">2 Children</option>
                <option value="3">3 Children</option>
            </select>
        </div>
        <div class="form-group">
            <label for="room">Type of Room<span>*</span></label>
            <select id="room" name="room" class="form-control"> <!-- Ensure this matches your PHP code -->
                <option value="1">Single Room</option> <!-- Adjust values according to your Rooms table -->
                <option value="2">Double Room</option>
                <option value="3">Deluxe Room</option>
            </select>

        </div>
        <div class="form-group " >
    <label for="chambre_number">Room Number (Click to the icon to check aviability of room)<span>*</span></label>
    <div id="fa-hotel" class="roomss">
    <input type="number" id="chambre_number" name="chambre_number" class="form-control" required>
   
    <button type="button"  id="checkAvailability" class="icon-button btn btn-outline-dark" title="Check aviability of rooms">
        <i class="fas fa-hotel"> </i>check Availability
    </button>
    <div id="availableRooms"></div>
</div>
</div>



        <button type="submit" class="btn btn-outline-warning" name="button1">Reserve</button> 
        <button type="button" class="btn btn-outline-primary close" name="button2" >Cancel</button>
 
        <!-- Button to submit the form -->
    </form>
</div>


 <!-- about section -->
 

 <div class="about_section layout_padding">
    <div class="containe">
        <main class="ok">
        <div>
          <h1>About Us
          </h1>
          <h3>Welcome to Hotelier</h3>
        </div>
      </main>
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img_container">
            <div class="img-box">
              <img src="images/Leonardo_Phoenix_10_A_highly_detailed_and_realistic_image_of_t_1.jpg" alt="" />
            </div>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="detail-box">
            <div class="heading_container ">
              <h2>
              Qui Sommes-Nous ?
              </h2>
            </div>
            <p>
            Notre hôtel se distingue par son élégance et son service personnalisé.
             Contrairement aux autres établissements, nous offrons une expérience unique alliant
              confort moderne, attention aux moindres détails et une atmosphère chaleureuse. 
              Chaque client est accueilli comme un invité spécial, <span style="color: #feaf39;">avec des prestations sur 
              mesure pour rendre chaque séjour inoubliable.</span>
            </p>
            <div class="btn-box">
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

  <!-- end about section -->

    <!----->

    
    <div class="hi">
    <h1 class="our">Our place</h1>
    
  </div>
  <main class="mp">
    <!-- Map Section -->
    <div id="map-container">
        <div id="map"></div> <!-- Map will load here -->
    </div>
</main>




    
  <footer class="footer-area">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> Tanger, Morocco</li>
                    <li><i class="fa-solid fa-phone"></i> +212 604 722 261</li>
                    <li><i class="fa-solid fa-envelope"></i> bourzizbilal3@gmail.com</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="https://web.facebook.com/bilal.bourziz?locale=ar_AR"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/bilal_bo808/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/bilal-bourziz/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/Bilalbourziz/"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 hotel-b.com. All Rights Reserved.</p>
    </div>
</footer>

   

</div>
 

    
      
      <script src="styles/scripte.js"></script>
      <script src="styles/map.js"></script>
      
</body>
</html>

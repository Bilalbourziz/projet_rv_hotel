// define all UI variable
const navToggler = document.querySelector('.nav-toggler');
const navMenu = document.querySelector('.site-navbar ul');
const navLinks = document.querySelectorAll('.site-navbar a');


allEventListners();

// functions of all event listners
function allEventListners() {
  // toggler icon click event
  navToggler.addEventListener('click', togglerClick);
  // nav links click event
  navLinks.forEach( elem => elem.addEventListener('click', navLinkClick));
}

// togglerClick function
function togglerClick() {
  navToggler.classList.toggle('toggler-open');
  navMenu.classList.toggle('open');
}

// navLinkClick function
function navLinkClick() {
  if(navMenu.classList.contains('open')) {
    navToggler.click();
  }
}

$(function() {
  $('.scroll-down').click (function() {
    $('html, body').animate({scrollTop: $('main div').offset().top }, 'slow');
    return false;
  });
});

$(function() {
  $('.contact').click (function() {
    $('html, body').animate({scrollTop: $('footer.footer-area').offset().top }, 'slow');
    return false;
  });
});
$(function() {
  $('.about').click (function() {
    $('html, body').animate({scrollTop: $('.about_section ').offset().top }, 'slow');
    return false;
  });
});

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.view-project').forEach(button => {
      button.addEventListener('click', () => {
          const form = document.getElementById('reservation-form');
          form.style.display = form.style.display === 'block' ? 'none' : 'block';
      });
  });
});



    document.getElementById('check-in').min = new Date().toISOString().split('T')[0];
    document.getElementById('check-out').min = new Date().toISOString().split('T')[0];
   
    function displaynone() {
      const form = document.getElementsByClassName("reservation-form");
      form.style.display = form.style.display === 'block' ? 'none' : 'block';
    }

  
    $(document).ready(function () {
      $('.view-project').on('click', function (event) {
          event.preventDefault(); // Prevent the default link behavior
          const hotelId = $(this).data('hotel-id'); // Get the hotel ID from data attribute
          
          // Populate the reservation form with the hotel ID
          $('#reservation-form input[name="hotel_id"]').val(hotelId);
          
          // Show the reservation form (you can use any preferred animation or style here)
          $('#reservation-form').fadeIn();
      });
  });






    $(document).ready(function () {
      $("#checkAvailability").on("click", function () {
          const hotelId = $('input[name="hotel_id"]').val(); // Dynamic hotel ID
          const roomId = $('select[name="room"]').val(); // Room type
  
          // Send AJAX request to fetch room availability
          $.ajax({
              url: "check_rooms.php",
              method: "POST",
              contentType: "application/json",
              data: JSON.stringify({ hotel_id: hotelId, room_id: roomId }),
              success: function (data) {
                  const availabilityBlock = $("<div></div>", { id: "availabilityBlock" })
                      .css({
                          position: "fixed",
                          top: "3%",
                          left: "50%",
                          transform: "translateX(-50%)",
                          zIndex: "1000",
                          padding: "20px",
                          backgroundColor: "#f9f9f9",
                          border: "1px solid #ccc",
                          borderRadius: "30px",
                          boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)",
                          width: "40%"
                      });
  
                  // Close button
                  const closeButton = $("<button'><i class='fa-solid fa-square-xmark'></i></button>")
                      
                      .css({
                          float: "right",
                          backgroundColor: "none",
                          color: "black",
                          cursor: "pointer",
                          borderRadius: "10px",
                          width:'20px',
                          height:'auto'
                          
                      })
                      .on("click", function () {
                          $("#availabilityBlock").remove(); // Remove the availability block
                      });
  
                  availabilityBlock.append(closeButton);
  
                  // Legend
                  const legend = `
                      <p><strong>Legend:</strong></p>
                      <p style="color: green;">Green: Available</p>
                      <p style="color: red;">Red: Unavailable</p>
                  `;
                  availabilityBlock.append(legend);
  
                  // Rooms
                  const roomsDiv = $("<div></div>", { id: "availableRooms" });
                  if (data.rooms && data.rooms.length > 0) {
                      data.rooms.forEach(function (room) {
                          const roomDiv = $("<div></div>")
                              .text(`Room ${room.number}`)
                              .css({
                                  margin: "5px 0",
                                  padding: "6px",
                                  borderRadius: "5px",
                                  color: "white",
                                  backgroundColor: room.is_available ? "green" : "red",
                                  textAlign:"center"
                              });
                          roomsDiv.append(roomDiv);
                      });
                  } else {
                      roomsDiv.html("<p>No rooms available.</p>");
                  }
                  availabilityBlock.append(roomsDiv);
  
                  $("body").append(availabilityBlock);
              },
              error: function (xhr, status, error) {
                  console.error("Error:", error);
              }
          });
      });
  });
  

    $(".close").on("click", function () {
        

        // Or remove it entirely from the DOM
         $("#reservation-form").hide();
    });


    

   
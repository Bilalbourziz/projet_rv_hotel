     // Initialize map
     const map = L.map('map').setView([35.67205370190727, -5.793833981352699], 12);

     // Add OpenStreetMap tiles
     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         maxZoom: 19,
     }).addTo(map);

     // Add markers
     const locations = [
         [35.742950107924976, -5.936717130077933, "hotel-friends"],
         [35.78042180583559, -5.92790770868049, "hotel-hilton"],
         [35.79932390011632, -5.906026243002848,"hotel-kings"]
     ];

     locations.forEach((location) => {
         L.marker([location[0], location[1]])
             .addTo(map)
             .bindPopup(location[2])
             .openPopup();
     });
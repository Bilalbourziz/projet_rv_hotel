let menuicn = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicn.addEventListener("click", () => {
    nav.classList.toggle("navclose");
})

const links = document.querySelectorAll('.nav a');
const tables = document.querySelectorAll('.b');

links.forEach(link => {
    link.addEventListener('click', (e) => {
        // Skip if the clicked link has id "logout"
        if (link.id === 'logout') {
            return; // Don't perform any actions if the link is "logout"
        }
        e.preventDefault();

        // Hide all tables
        tables.forEach(table => table.classList.remove('active'));

        // Show the clicked table
        const targetId = link.id.replace('show', '').toLowerCase();
        document.getElementById(targetId).classList.add('active');
    });
});

// Show the first table by default
document.getElementById('client').classList.add('active');

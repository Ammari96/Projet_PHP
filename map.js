let map = L.map('map').setView([46.603354, 1.888334], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

L.marker([48.8566, 2.3522]).addTo(map)
    .bindPopup('<b>KYUFI <br> Paris</b>')
    .openPopup();

L.marker([43.2965, 5.3698]).addTo(map)
    .bindPopup('<b>KYUFI <br> Marseille</b>')
    .openPopup();

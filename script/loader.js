document.addEventListener("DOMContentLoaded", () => {
    // Charger le header
    fetch('template/header.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header-container').innerHTML = data;
        })
        .catch(error => {
            console.error('Erreur lors du chargement du header:', error);
        });

    // Charger le footer
    fetch('template/footer.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer-container').innerHTML = data;
        })
        .catch(error => {
            console.error('Erreur lors du chargement du footer:', error);
        });
});

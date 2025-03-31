document.addEventListener('DOMContentLoaded', () => {
    // MENU BURGER
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu");

    burger.addEventListener("click", () => {
        menu.classList.toggle("active");
    });

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

document.addEventListener("DOMContentLoaded", function () {
    const loginPanel = document.getElementById("login-panel");
    const loginButton = document.querySelector(".nav-links li:nth-child(3) a");
    const closeLogin = document.getElementById("close-login");

    // Ouvrir le panneau au clic sur "Connexion"
    loginButton.addEventListener("click", function () {
        loginPanel.classList.remove("hidden");
    });

    // Fermer le panneau au clic sur la croix
    closeLogin.addEventListener("click", function () {
        loginPanel.classList.add("hidden");
    });

    // Fermer en cliquant en dehors du panneau
    window.addEventListener("click", function (e) {
        if (e.target === loginPanel) {
            loginPanel.classList.add("hidden");
        }
    });
});

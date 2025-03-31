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
    const loginButton = document.querySelector(".login-trigger");
    const closeLogin = document.getElementById("close-login");

    // Ouvrir / Fermer le panneau au clic sur "Connexion"
    loginButton.addEventListener("click", function (e) {
        e.preventDefault(); // Empêche le saut en haut de page
        loginPanel.classList.toggle("show");
    });

    // Fermer le panneau au clic sur la croix
    closeLogin.addEventListener("click", function () {
        loginPanel.classList.remove("show");
    });

    // Fermer si on clique en dehors
    document.addEventListener("click", function (e) {
        if (!loginPanel.contains(e.target) && e.target !== loginButton) {
            loginPanel.classList.remove("show");
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const settingsTrigger = document.querySelector(".settings-trigger");
    const settingsPanel = document.getElementById("settings-panel");
    const closeSettings = document.getElementById("close-settings");

    settingsTrigger.addEventListener("click", (e) => {
        e.preventDefault();
        settingsPanel.classList.toggle("show");
    });

    closeSettings.addEventListener("click", () => {
        settingsPanel.classList.remove("show");
    });

    document.addEventListener("click", (e) => {
        if (!settingsPanel.contains(e.target) && !settingsTrigger.contains(e.target)) {
            settingsPanel.classList.remove("show");
        }
    });
});



document.addEventListener("DOMContentLoaded", () => {
    const loginPanel = document.getElementById("login-panel");
    const loginButton = document.querySelector(".login-trigger");
    const closeLogin = document.getElementById("close-login");
    const loginForm = document.getElementById("login-form"); // Formulaire de connexion
    const loginError = document.getElementById("login-error"); // Zone d'erreur de connexion


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

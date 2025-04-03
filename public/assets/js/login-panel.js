document.addEventListener("DOMContentLoaded", () => {
    const loginPanel = document.getElementById("login-panel");
    const loginButton = document.querySelector(".login-trigger");
    const closeLogin = document.getElementById("close-login");
    const loginForm = document.getElementById("login-form");
    const loginError = document.getElementById("login-error");

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

    // Lorsque le formulaire de connexion est soumis
    loginForm.addEventListener("submit", async function (e) {
        e.preventDefault(); // Empêche la soumission normale du formulaire

        // Réinitialise le message d'erreur
        loginError.textContent = "";
        loginError.style.color = "red";

        const formData = new FormData(this);
        try {
            const response = await fetch(this.action, {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.status === "success") {
                // Connexion réussie
                loginButton.textContent = result.name;
                loginButton.classList.add("logged-in");
                loginPanel.classList.remove("show"); // Cache le panel de connexion
            } else {
                // Affiche l'erreur sous le formulaire
                loginError.textContent = result.message;
            }
        } catch (error) {
            // Si une erreur se produit, on affiche un message générique
            loginError.textContent = "Erreur lors de la connexion.";
        }
    });
});

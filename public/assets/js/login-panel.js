document.addEventListener("DOMContentLoaded", () => {
    const loginPanel = document.getElementById("login-panel");
    const loginButton = document.querySelector(".login-trigger");
    const closeLogin = document.getElementById("close-login");
    const loginForm = document.getElementById("login-form");
    const loginError = document.getElementById("login-error");
    const logoutButton = document.createElement("button");

    logoutButton.textContent = "Déconnexion";
    logoutButton.id = "logout-button";
    logoutButton.style.display = "none"; // Caché par défaut
    logoutButton.addEventListener("click", logout);

    loginButton.parentNode.appendChild(logoutButton); // Ajouter le bouton à côté de "Connexion"



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



    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + "; path=/";
    }

    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(";");
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == " ") c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    async function checkSession() {
        try {
            const response = await fetch("/SuperStage/app/controllers/CheckSession.php");
            const result = await response.json();

            if (result.status === "connected") {
                loginButton.textContent = result.name;
                loginButton.classList.add("logged-in");
                logoutButton.style.display = "inline-block"; // Affiche le bouton déconnexion
            } else {
                let token = getCookie("session_token");
                if (token) {
                    loginButton.textContent = "Utilisateur (cookie)";
                    loginButton.classList.add("logged-in");
                    logoutButton.style.display = "inline-block";
                }
            }
        } catch (error) {
            console.error("Erreur de vérification de session :", error);
        }
    }


    function logout() {
        document.cookie = "session_token=; Max-Age=0; path=/"; // Supprime le cookie
        loginButton.textContent = "Connexion";
        loginButton.classList.remove("logged-in");
        logoutButton.style.display = "none";
    }

    checkSession();
});

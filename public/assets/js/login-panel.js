document.addEventListener("DOMContentLoaded", () => {
    const loginPanel = document.getElementById("login-panel");
    const loginButton = document.querySelector(".login-trigger");
    const closeLogin = document.getElementById("close-login");
    const loginForm = document.getElementById("login-form");
    const loginError = document.getElementById("login-error");

    // Création du menu profil après connexion
    const profileMenu = document.createElement("div");
    profileMenu.id = "profile-menu";
    profileMenu.classList.add("hidden");
    profileMenu.innerHTML = `
        <ul>
            <li><a href="/SuperStage/compte.php">Compte</a></li>
            <li><button id="logout-button">Déconnexion</button></li>
        </ul>
    `;
    loginButton.parentNode.insertBefore(profileMenu, loginButton.nextSibling);

    // Ouvrir / Fermer le panneau de connexion
    loginButton.addEventListener("click", function (e) {
        e.preventDefault();
        if (loginButton.classList.contains("logged-in")) {
            profileMenu.classList.toggle("show"); // Afficher/Masquer le menu si connecté
        } else {
            loginPanel.classList.toggle("show");
        }
    });

    // Fermer le menu si on clique en dehors
    document.addEventListener("click", function (e) {
        if (!profileMenu.contains(e.target) && e.target !== loginButton) {
            profileMenu.classList.remove("show");
        }
    });

    // Fermeture de la fenêtre de connexion
    closeLogin.addEventListener("click", function () {
        loginPanel.classList.remove("show");
    });

    // Gestion du formulaire de connexion
    loginForm.addEventListener("submit", async function (e) {
        e.preventDefault();
        loginError.textContent = "";

        const formData = new FormData(this);
        try {
            const response = await fetch(this.action, {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.status === "success") {
                setCookie("session_token", result.token, 7);
                updateUIAfterLogin(result.name);
                loginPanel.classList.remove("show");
            } else {
                loginError.textContent = result.message;
            }
        } catch (error) {
            loginError.textContent = "Erreur lors de la connexion.";
        }
    });

    // Gestion des cookies
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
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Vérifie si une session est active
    async function checkSession() {
        try {
            const response = await fetch("/SuperStage/app/controllers/CheckSession.php");
            const result = await response.json();

            if (result.status === "connected") {
                updateUIAfterLogin(result.name);
            }
        } catch (error) {
            console.error("Erreur de vérification de session :", error);
        }
    }

    // Mise à jour de l'UI après connexion
    function updateUIAfterLogin(username) {
        loginButton.textContent = username;
        loginButton.classList.add("logged-in");
    }

    // Déconnexion
    function logout() {
        document.cookie = "session_token=; Max-Age=0; path=/";
        loginButton.textContent = "Connexion";
        loginButton.classList.remove("logged-in");
        profileMenu.classList.add("hidden");
    }

    // Événement de déconnexion
    document.addEventListener("click", (e) => {
        if (e.target.id === "logout-button") {
            logout();
        }
    });

    // Vérification initiale de la session
    checkSession();
});

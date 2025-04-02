document.addEventListener("DOMContentLoaded", () => {
    const loginTrigger = document.querySelector(".login-trigger");
    const loginPanel = document.getElementById("login-panel");
    const closeLogin = document.getElementById("close-login");
    const loginForm = document.getElementById("login-form");
    const loginError = document.getElementById("login-error");

    // Afficher ou masquer le panneau de connexion
    if (loginTrigger) {
        loginTrigger.addEventListener("click", (e) => {
            e.preventDefault();
            loginPanel.classList.toggle("show");
        });
    }

    // Fermer le panneau de connexion
    if (closeLogin) {
        closeLogin.addEventListener("click", () => {
            loginPanel.classList.remove("show");
        });
    }

    // Fermer le panneau si on clique en dehors du panneau de connexion
    document.addEventListener("click", (e) => {
        if (!loginPanel.contains(e.target) && !loginTrigger.contains(e.target)) {
            loginPanel.classList.remove("show");
        }
    });

    // Soumettre le formulaire de connexion
    if (loginForm) {
        loginForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const formData = new FormData(loginForm);

            console.log("Tentative de connexion avec :", Object.fromEntries(formData));

            try {
                const response = await fetch("/SuperStage/src/login/login.php", {
                    method: "POST",
                    body: formData,
                });

                console.log("Statut de la réponse HTTP :", response.status);

                const text = await response.text();  // Récupère la réponse brute
                console.log("Réponse brute du serveur :", text);

                try {
                    const data = JSON.parse(text); // Tente de parser en JSON
                    console.log("Réponse JSON parsée :", data);

                    if (data.success) {
                        console.log("Connexion réussie !");
                        location.reload();
                    } else {
                        console.warn("Erreur de connexion :", data.message);
                        loginError.textContent = data.message;
                    }
                } catch (jsonError) {
                    console.error("Erreur de parsing JSON :", jsonError);
                    console.error("Contenu reçu (non JSON) :", text);
                }

            } catch (error) {
                console.error("Erreur lors de la requête :", error);
            }
        });
    }
});

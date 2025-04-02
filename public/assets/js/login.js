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


    // Soumission du formulaire de connexion
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Empêcher l'envoi traditionnel du formulaire

            const email = document.querySelector('input[name="email"]').value; // Récupérer l'email
            const password = document.querySelector('input[name="password"]').value; // Récupérer le mot de passe

            const data = new FormData(); // Créer un objet FormData pour envoyer les données
            data.append('email', email);
            data.append('password', password);
            data.append('login', 'true'); // Indiquer qu'il s'agit d'une tentative de connexion

            // Faire la requête AJAX vers le fichier PHP qui gère l'authentification
            fetch('/views/auth.php', {
                method: 'POST',
                body: data
            })
                .then(response => response.json()) // Réponse en JSON
                .then(data => {
                    if (data.success) {
                        // Si la connexion réussit, rediriger l'utilisateur
                        window.location.href = '../index.php';
                    } else {
                        // Afficher un message d'erreur si la connexion échoue
                        loginError.textContent = data.message;
                        loginError.style.color = "red"; // Afficher en rouge l'erreur
                    }
                })
                .catch(error => {
                    // En cas d'erreur lors de la requête AJAX
                    console.error('Erreur de connexion:', error);
                    loginError.textContent = 'Une erreur est survenue, veuillez réessayer plus tard.';
                    loginError.style.color = "red";
                });
        });
    }
});

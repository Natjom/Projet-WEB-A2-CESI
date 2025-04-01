document.addEventListener("DOMContentLoaded", function () {
    const loginPanel = document.getElementById("login-panel");
    const loginButton = document.querySelector(".login-trigger");
    const closeLogin = document.getElementById("close-login");
    const loginForm = document.getElementById("login-form");
    const loginError = document.getElementById("login-error");
    const logoutButton = document.getElementById("logout");

    if (loginButton) {
        loginButton.addEventListener("click", function (e) {
            e.preventDefault();
            loginPanel.classList.toggle("show");
        });

        closeLogin.addEventListener("click", function () {
            loginPanel.classList.remove("show");
        });
    }

    // Vérification en BDD et connexion
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(loginForm);

        fetch("login.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Recharge la page si succès
                } else {
                    loginError.textContent = data.message;
                }
            })
            .catch(error => console.error("Erreur:", error));
    });

    // Déconnexion
    if (logoutButton) {
        logoutButton.addEventListener("click", function () {
            fetch("logout.php")
                .then(response => response.json())
                .then(() => location.reload()); // Recharge la page après déconnexion
        });
    }
});

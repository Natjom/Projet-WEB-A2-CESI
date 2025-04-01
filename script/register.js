document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("register-form");
    const registerError = document.getElementById("register-error");

    registerForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(registerForm);

        fetch("register.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Recharge la page après inscription
                } else {
                    registerError.textContent = data.message;
                }
            })
            .catch(error => console.error("Erreur:", error));
    });
});

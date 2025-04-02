document.addEventListener("DOMContentLoaded", () => {
    const settingsTrigger = document.querySelector(".settings-trigger");
    const settingsPanel = document.getElementById("settings-panel");
    const closeSettings = document.getElementById("close-settings");
    const saveSettingsButton = document.getElementById("save-settings");
    const themeSelect = document.getElementById("theme");
    const roleSelect = document.getElementById("role");

    if (settingsTrigger) {
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

        saveSettingsButton.addEventListener("click", async () => {
            const selectedTheme = themeSelect.value;
            const selectedRole = roleSelect.value;

            try {
                const response = await fetch('/../../app/controllers/update-settings.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `theme=${selectedTheme}&role=${selectedRole}`
                });

                if (response.ok) {
                    alert("Paramètres sauvegardés !");
                    // Si tu veux appliquer immédiatement le thème, tu peux le gérer ici
                    // Par exemple, en appliquant une classe au body
                    document.body.classList.toggle('dark-theme', selectedTheme === 'dark');
                } else {
                    alert("Erreur lors de la sauvegarde des paramètres.");
                }
            } catch (error) {
                console.error('Erreur lors de la requête:', error);
                alert("Erreur de connexion.");
            }
        });
    }
});

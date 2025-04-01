document.addEventListener("DOMContentLoaded", () => {
    const settingsTrigger = document.querySelector(".settings-trigger");
    const settingsPanel = document.getElementById("settings-panel");
    const closeSettings = document.getElementById("close-settings");

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
    }
});

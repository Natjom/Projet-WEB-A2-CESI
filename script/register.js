document.getElementById('register-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const nom = document.querySelector('input[name="nom"]').value;
    const prenom = document.querySelector('input[name="prenom"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;
    const date_naissance = document.querySelector('input[name="date_naissance"]').value;
    const id_adresse = document.querySelector('input[name="id_adresse"]').value;

    const data = new FormData();
    data.append('nom', nom);
    data.append('prenom', prenom);
    data.append('email', email);
    data.append('password', password);
    data.append('date_naissance', date_naissance);
    data.append('id_adresse', id_adresse);
    data.append('register', 'true');

    fetch('/views/auth.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/SuperStage/login.php';
            } else {
                alert(data.message);
            }
        });
});

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase 26</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="register">
            <h2>Registro</h2>

            <form id="form-register">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
        <br>
        <hr>
        <br>
        <div class="login">
            <h2>login</h2>
            <form id="form-login">
                <div class="mb-3">
                    <label for="username_login" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username_login" name="username" aria-describedby="usernameHelp">
                </div>
                <div class="mb-3">
                    <label for="password_login" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password_login">
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
            </form>
        </div>


    </div>
    <script>
        document.querySelector("#form-register").addEventListener("submit", (e) => {
            e.preventDefault()
            const data = Object.fromEntries(new FormData(e.target));

            fetch("./api/registrar.php", {
                    method: "POST",
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message)
                })
        })

        document.querySelector("#form-login").addEventListener("submit", (e) => {
            e.preventDefault()
            const data = Object.fromEntries(new FormData(e.target));

            fetch("./api/login.php", {
                    method: "POST",
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(data => {
                    const token = JSON.parse(data).token;
                    if (token) {
                        alert(`Iniciaste sesion correctamente! Tu token es: ${token}`)
                    }
                })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
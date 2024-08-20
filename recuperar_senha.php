<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="card-detalhes">
        <div class="form-box">
            <div class="card-form">
                <h2>Recuperar Senha</h2>
                <form action="processa_recuparacao.php" method="POST">
                    <div class="container">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu email" required>
                    </div>
                    <div class="btn">
                        <button type="submit">Enviar link de redefinição</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

<body>
    <section class="login-register">
        <form method="post" action="?user/login">
            <label for="username">Email:</label>
            <input type="text" id="username" name="username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <?php echo isset($missatgeOK) ? htmlspecialchars($missatgeOK) : ''; ?>
            <br>
            <input type="submit" name="submit" value="Iniciar Sesión">
        </form>

        <span>¿No tienes cuenta?</span><a href="?user/showForm">Registrate</a>
    </section>
</body>

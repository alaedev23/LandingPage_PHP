<body>
    <section class="login-register">
        <form method="post" action="?user/register" enctype="multipart/form-data">

            <label for="username">Email*:</label> 
            <input type="text" id="username" name="username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required> 
            <span class="error"><?php echo isset($errors['username']) ? htmlspecialchars($errors['username']) : ''; ?></span>
            <br>

            <label for="password">Contraseña*:</label> 
            <input type="password" id="password" name="password" required> 
            <span class="error"><?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : ''; ?></span>
            <br>

            <label for="tipusIdent">Tipo Identificación*:</label> 
            <select id="tipusIdent" name="tipusIdent" required>
                <option value="DNI" <?php echo (isset($_POST['tipusIdent']) && $_POST['tipusIdent']=="DNI" ) ? "selected" : "" ; ?>>DNI</option>
                <option value="NIE" <?php echo (isset($_POST['tipusIdent']) && $_POST['tipusIdent']=="NIE" ) ? "selected" : "" ; ?>>NIE</option>
                <option value="Passport" <?php echo (isset($_POST['tipusIdent']) && $_POST['tipusIdent']=="Passport" ) ? "selected" : "" ; ?>>Passport</option>
            </select>
            <span class="error"><?php echo isset($errors['tipusIdent']) ? htmlspecialchars($errors['tipusIdent']) : ''; ?></span>
            <br>

            <label for="dni">Identificación*:</label> 
            <input type="text" id="dni" name="dni" value="<?= isset($_POST['dni']) ? htmlspecialchars($_POST['dni']) : ''; ?>" required> 
            <span class="error"><?php echo isset($errors['dni']) ? htmlspecialchars($errors['dni']) : ''; ?></span>
            <br>

            <label for="nom">Nombre*:</label> 
            <input type="text" id="nom" name="nom" value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required> 
            <span class="error"><?php echo isset($errors['nom']) ? htmlspecialchars($errors['nom']) : ''; ?></span>
            <br>

            <label for="cognoms">Apellidos*:</label> 
            <input type="text" id="cognoms" name="cognoms" value="<?= isset($_POST['cognoms']) ? htmlspecialchars($_POST['cognoms']) : ''; ?>" required> 
            <span class="error"><?php echo isset($errors['cognoms']) ? htmlspecialchars($errors['cognoms']) : ''; ?></span>
            <br>

            <label for="dataNaixement">Fecha de Nacimiento*:</label>
            <input type="date" id="dataNaixement" name="dataNaixement" value="<?= isset($_POST['dataNaixement']) ? htmlspecialchars($_POST['dataNaixement']) : ''; ?>" required> 
            <span class="error"><?php echo isset($errors['dataNaixement']) ? htmlspecialchars($errors['dataNaixement']) : ''; ?></span>
            <br>

            <label for="sexe">Sexo*:</label> 
            <select id="sexe" name="sexe" required>
                <option value="Masc" <?php echo (isset($_POST['sexe']) && $_POST['sexe']=="Masc" ) ? "selected" : "" ; ?>>Masc</option>
                <option value="Feme" <?php echo (isset($_POST['sexe']) && $_POST['sexe']=="Feme" ) ? "selected" : "" ; ?>>Feme</option>
                <option value="Otro" <?php echo (isset($_POST['sexe']) && $_POST['sexe']=="Otro" ) ? "selected" : "" ; ?>>Otro</option>
            </select> 
            <span class="error"><?php echo isset($errors['sexe']) ? htmlspecialchars($errors['sexe']) : ''; ?></span>
            <br>

            <!-- (opcionales) -->
            <label for="adreca">Dirección:</label> 
            <input type="text" id="adreca" name="adreca" value="<?= isset($_POST['adreca']) ? htmlspecialchars($_POST['adreca']) : ''; ?>">
            <span class="error"><?php echo isset($errors['adreca']) ? htmlspecialchars($errors['adreca']) : ''; ?></span>
            <br>

            <label for="codiPostal">Código Postal:</label> 
            <input type="text" id="codiPostal" name="codiPostal" value="<?= isset($_POST['codiPostal']) ? htmlspecialchars($_POST['codiPostal']) : ''; ?>">
            <span class="error"><?php echo isset($errors['codiPostal']) ? htmlspecialchars($errors['codiPostal']) : ''; ?></span>
            <br>

            <label for="poblacio">Población:</label> 
            <input type="text" id="poblacio" name="poblacio" value="<?= isset($_POST['poblacio']) ? htmlspecialchars($_POST['poblacio']) : ''; ?>">
            <span class="error"><?php echo isset($errors['poblacio']) ? htmlspecialchars($errors['poblacio']) : ''; ?></span>
            <br>

            <label for="provincia">Provincia:</label> 
            <input type="text" id="provincia" name="provincia" value="<?= isset($_POST['provincia']) ? htmlspecialchars($_POST['provincia']) : ''; ?>">
            <span class="error"><?php echo isset($errors['provincia']) ? htmlspecialchars($errors['provincia']) : ''; ?></span>
            <br>

            <label for="telefon">Teléfono:</label> 
            <input type="text" id="telefon" name="telefon" value="<?= isset($_POST['telefon']) ? htmlspecialchars($_POST['telefon']) : ''; ?>">
            <span class="error"><?php echo isset($errors['telefon']) ? htmlspecialchars($errors['telefon']) : ''; ?></span>
            <br>

            <label for="imatge">Imagen del Usuario:</label>
            <input type="file" id="imatge" name="imatge">
            <span class="error"><?php echo isset($errors['imatge']) ? htmlspecialchars($errors['imatge']) : ''; ?></span>
            <br>

            <span class="errors"> <?php echo isset($missatgeOK) ? htmlspecialchars($missatgeOK) : '' ?></span>

            <input type="submit" name="submit" accept="image/*" value="Registrar">
        </form>
    </section>
</body>

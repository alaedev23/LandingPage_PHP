<section id="contact-form">
	<form action="?contact/validate" method="post">
		<label for="nombre">Nombre:</label> <input type="text" id="nombre"
			name="nombre" required> <br> <span class="error"><?= $errors["nombre"] ?></span>

		<label for="nombre">Apellidos:</label> <input type="text" id="apellido"
			name="apellido" required> <br> <span class="error"><?= $errors["apellido"] ?></span>

		<label for="email">Correo Electrónico:</label> <input type="email"
			id="email" name="email" required> <br> <span class="error"><?= $errors["email"] ?></span>

		<label for="mensaje">Mensaje:</label><br>
		<textarea id="mensaje" name="mensaje" rows="4" required></textarea>
		<span class="error"><?= $errors["mensaje"] ?></span> <br>
		<span id="result"><?= $missatgeOK ?></span> <br>
		<button type="submit" name="submit" value="Enviar">Enviar</button>
	</form>
</section>
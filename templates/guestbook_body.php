<form id="guestbook" method="post" action="?guestbook/form">
		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Email</th>
					<th>Mensaje</th>
					<th>Calificación</th>
					<th>Enviar</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" name="nombre" placeholder="Nombre"
						value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
						<span class="error"><?= $errors["nombre"] ?></span></td>
					<td><input type="text" name="email" placeholder="Email"
						value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
						<span class="error"><?= $errors["email"] ?></span></td>
					<td><textarea name="mensaje" placeholder="Escribe tu mensaje"><?= isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '' ?></textarea>
						<span class="error"><?= $errors["mensaje"] ?></span></td>
					<td><select name="valoracion">
							<option value="1"
								<?= (isset($_POST['valoracion']) && $_POST['valoracion'] == 'MM') ? 'selected' : '' ?>>Muy Mala</option>
							<option value="2"
								<?= (isset($_POST['valoracion']) && $_POST['valoracion'] == 'M') ? 'selected' : '' ?>>Mala</option>
							<option value="3"
								<?= (isset($_POST['valoracion']) && $_POST['valoracion'] == 'N') ? 'selected' : '' ?>>Normal</option>
							<option value="4"
								<?= (isset($_POST['valoracion']) && $_POST['valoracion'] == 'B') ? 'selected' : '' ?>>Buena</option>
							<option value="5"
								<?= (isset($_POST['valoracion']) && $_POST['valoracion'] == 'MB') ? 'selected' : '' ?>>Muy Buena</option>
					</select> <span class="error"><?= $errors["valoracion"] ?></span></td>
					<td><input type="submit" value="Enviar"></td>
				</tr>
                <?php echo $items ?>
            </tbody>
		</table>
	</form>
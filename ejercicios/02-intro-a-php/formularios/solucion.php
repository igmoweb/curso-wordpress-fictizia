<!DOCTYPE html>
<html>
<head>
	<title>Envio de formularios</title>
</head>
<body>
	<?php if ( isset( $_POST['submit'] ) ): ?>
		<?php echo strlen( $_POST['nombre'] ) ?><br/>
		<?php echo ( $_POST['sexo'] == 'h' ) ? 'Hombre' : 'Mujer'; ?>
	<?php endif; ?>

	<form action="" method="POST">
		Nombre: <input type="text" name="nombre" value="" /><br/>
		Sexo: <br/>
			<input type="radio" name="sexo" value="h" />Hombre<br/>
			<input type="radio" name="sexo" value="m" />Mujer<br/>
		<input type="submit" name="submit" value="Enviar" />
	</form>
</body>
</html>


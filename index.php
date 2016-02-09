<html>

	<head>
		<title>Triangle</title>
		<style>
			html { background: white; font-family: sans-serif; }
			body { background: #F0F0F0; width: 800px; margin: 1em auto; padding: 1em; border: #D0D0D0 1px solid; box-shadow: 0 .1em .4em #E0E0E0; }
			h1 { font-weight: normal; }
		</style>
	</head>

	<body>

		<h1>Triangle&nbsp;&nbsp;&nbsp;&#8420;</h1>
		<form method="post" action="?">
			A = <input name="a" value="<?= isset($_POST["a"]) ? $_POST["a"] : "" ?>"/><br/>
			B = <input name="b" value="<?= isset($_POST["b"]) ? $_POST["b"] : "" ?>"/><br/>
			C = <input name="c" value="<?= isset($_POST["c"]) ? $_POST["c"] : "" ?>"/><br/>
			<br/>
			<input type="submit"/>
		</form>

		<?php if (isset($_POST["a"]) and isset($_POST["b"]) and isset($_POST["c"])): ?>
			<?php
				require "model/Triangle.php";
				$t = new Triangle($_POST["a"], $_POST["b"], $_POST["c"]);
			?>
			<ul>
				<li>Perimeter = <?= $t->getPerimeter() ?></li>
				<li>Area = <?= $t->getArea() ?></li>
			</ul>
		<?php endif ?>

	</body>

</html>
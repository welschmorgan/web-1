<?php
	session_start();
	require_once("config.php");
	require_once("menus.php");
	require_once("content.php");

	$scripts = array('scripting.js');
	$styles = array('content.css', 'alert.css', 'helpers.css', 'input.css', 'menus.css', 'navbar.css');
	$module['name'] = isset($_GET['module']) ? $_GET['module'] : 'catalogue';
	$module['index'] = generate_content_index($module['name']);
	$module['header'] = generate_content_header($module['name']);
	$module['footer'] = generate_content_footer($module['name']);
	$module['styles'] = generate_content_styles($module['name']);
	$module['scripts'] = generate_content_scripts($module['name']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="fr-FR" />
	<title><?php echo $_GLOBALS['config']['site']['title']; ?></title>
	<meta name="language" content="fr-FR" />
	<meta name="robots" content="all" />
	<meta name="description" content="Les META informations importantes en HTML" />
	<meta name="keywords" content="HTML,META,codage,langue,ISO" />
	<?php
		foreach ($scripts as $script)
			echo "<script type='text/javascript' src='scripting/$script'>\n</script>\n";
		foreach ($styles as $style)
				echo "<link rel='stylesheet' type='text/css' href='styling/$style' />\n";
		if (isset($module['scripts']))
		{
			foreach ($module['scripts'] as $script)
				echo "<script type='text/javascript' src='modules/" . $module['name'] . "/$script'>\n</script>\n";
		}
		if (isset($module['styles']))
		{
			foreach ($module['styles'] as $script)
				echo "<link rel='stylesheet' type='text/css' href='modules/" . $module['name'] . "/$script' />\n";
		}
	?>
</head>
<body>
	<header class="block">Pneu Shop</header>
	<nav class="block navbar">
		<ul>
			<li role="menu item">
				<a href='?' title="Revenir a l'acceuil">Home</a>
			</li> |
			<li onmouseover="toggle_submenu('products_submenu');"
				onmouseout="toggle_submenu('products_submenu');" role="menu item">
				<a href='?module=catalogue' title="Revenir a l'acceuil">Produits</a>
				<ul role="menu item submenu" id="products_submenu">
					<li><a href="?module=catalogue&action=show" title="Pneus Normaux">Pneus normaux</a></li> |
					<li><a href="?module=catalogue&action=show&filter=neige" title="Pneus neige">Pneus neige</a></li> |
					<li><a href="?module=catalogue&action=show&filter=pluie" title="Pneus pluie">Pneus pluie</a></li> |
					<li><a href="?module=catalogue&action=show&filter=occasion" title="Pneus d'occasion">Pneus d'occasion</a></li>
				</ul>
			</li> |
			<li onmouseover="toggle_submenu('contact_submenu');"
				onmouseout="toggle_submenu('contact_submenu');" role="menu item">
				<a href='?module=home' title="Revenir a l'acceuil">Contact</a>
				<ul role="menu item submenu" id="contact_submenu">
					<li><a href="?module=contact&action=mail" title="Nous envoyer un mail">Mail</a></li>
					<li><a href="?module=contact&action=tel" title="Nous téléphoner">Tèl</a></li>
					<li><a href="http://google.fr/?#q=achat+pigeon+voyageur" title="Acheter pigeon">Pigeon Voyageur</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<div class="content">
		<table style="width: 100%; height: 100%;">
			<tbody>
				<tr><td></td><td></td><td></td></tr>
				<tr>
					<td rowspan="1" class="block menu center">
						<?php echo generate_left_menu() ?>
					</td>
					<td rowspan="3" class="block content">
						<?php echo $module['index']; ?>
					</td>
					<td rowspan="1" class="block menu center">
					<?php echo generate_right_menu() ?>
					</td>
				</tr>
				<tr><td></td><td></td><td></td></tr>
			</tbody>
		</table>
	</div>
	<footer class="block">footer</footer>
</body>
</html>

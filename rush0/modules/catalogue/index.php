<?php
	$action = get_post_get("action", "show");
	$filter = get_post_get("filter", "");
	$header = "";
	$footer = "";
	$index = "";
	$db = mysqli_connect($_GLOBALS['config']['mysql']['host'],
		$_GLOBALS['config']['mysql']['user'],
		$_GLOBALS['config']['mysql']['pass'],
		$_GLOBALS['config']['mysql']['db']) or die("Couldn't connect to db.");
	if (isset($_SESSION['level']) && $_SESSION['level'] > 0)
	{
		$index .= "<form method='GET' onsubmit='return validate_product(this);'>";
		$index .= "<input type=hidden name=module value=catalogue />";
		$index .= "<input type=hidden name=action value=add />";
		$index .= "<input type=hidden name=ok value=1 />";
		$index .= "<input type=text id=name name=name placeholder='Nom du produit.' />";
		$index .= "<input type=text id=color name=color placeholder='Couleur du produit.' />";
		$index .= "<input type=text id=categ name=categ placeholder='Catégories du produit.' />";
		$index .= "<input type=text id=desc name=desc placeholder='Description du produit.' />";
		$index .= "<input type=text id=pic name=pic placeholder='Image du produit.' />";
		$index .= "<button>Add</button>";
		$index .= "</form><hr />";
	}
	$index .= "<form class='inline'>";
	$index .= "<input type=hidden name=module value=catalogue />";
	$index .= "<input type=hidden name=action value=show />";
	$index .= "<input type=hidden name=ok value=1 />";
	$index .= "<input type=text name=filter value='' placeholder='Recherchez un produit:' />";
	$index .= "<button type=submit class='block center'>Cherche!</button>";
	$index .= "</form>";
	switch($action)
	{
		case "add":
		{
			$name = mysqli_real_escape_string($db, get_post_get('name', ''));
			$col = mysqli_real_escape_string($db, get_post_get('color', ''));;
			$categ = mysqli_real_escape_string($db, get_post_get('categ', ''));;
			$desc = mysqli_real_escape_string($db, get_post_get('desc', ''));;
			$pic = mysqli_real_escape_string($db, get_post_get('pic', ''));;

			if (empty($name) || empty($col) || empty($categ) || empty($desc) || empty($pic))
				$index .= "<span class='alert alert-error'>Invalid product declaration, aborting.</span><br />";
			else
			{
				$res = mysqli_query($db, "INSERT INTO `products` (`id`, `name`, `color`, `description`, `category`, `picture`) VALUES (NULL, '$name', '$col', '$desc', '$categ', '$pic');");
				if ($res)
				{
					$index .= "<span class='alert alert-success'>Successfully inserted '$name'.</span><br />";
						header("refresh: 1; url=index.php?module=catalogue");
				}
				else
					$index .= "<span class='alert alert-error'>Cannot insert '$name':<br/>".mysqli_error($db)."</span><br />";
			}
			break;
		}
		case 'remove':
		{
			$id = mysqli_real_escape_string($db, get_post_get("id", ""));
			if (empty($id))
				$index = "Invalid id !";
			else
			{
				$res = mysqli_query($db, "DELETE FROM `products` WHERE `id` = $id");
				if ($res)
				{
					$index = "<span class='alert alert-success'>Successfully deleted $id !</span><br/>";
					header("refresh: 1; url=index.php?module=catalogue");
				}
				else
					$index = "<span class='alert alert-error'>Cannot delete $i: ".mysqli_error($db)."</span><br/>";
			}
			break ;
		}
		case "show":
		{
			$res = mysqli_query($db, "SELECT * FROM products");
			$categ = get_post_get('filter', '');
			if ($res)
			{
				$index .= "<table class='product_table' style='width: 100%;'>";
				$index .= "	<thead><tr class='product_header'><td>Actions</td><td>Nom</td><td>Couleur</td><td>Catégorie</td><td>Image</td></tr><thead>";
				$index .= "	<tbody>";
				while ($row = mysqli_fetch_array($res))
				{
					if (isset($categ) && empty($categ)
						|| (strpos($row['category'], $categ) !== false)
						|| (strpos($row['name'], $categ) !== false)
						|| (strpos($row['description'], $categ) !== false))
					{
						$index .= "	<tr class='product_row'><td>";

						if (isset($_SESSION['level']) && $_SESSION['level'] > 0)
							$index .= "<button class='block' onclick=\"window.location = '?module=catalogue&action=remove&id=".$row['id']."';\">Delete</button>";
						$index .= "<button class='block' onclick=\"window.location = '?module=basket&action=add&id=".$row['id']."';\">Ajouter au panier</button>";

						$index .= "</td><td onclick=\"window.location = '?module=catalogue&action=show_id&id=".$row['id']."';\"><a href='?module=catalogue&action=show_id&id=".$row['id']."'>".
								$row['name']."</a></td><td>".$row['color']."</td><td>".$row['category']."</td><td>".
								"<img class='product_image' src='".$row['picture']."' title='Image du produit' alt='Image du produit'>".
								"</td>";
						$index .= "	</tr>";
					}
				}
				$index .= "	</tbody>";
				$index .= "</table>";
				mysqli_free_result($res);
			}
			break;
		}
		case "show_id":
		{
			$index = "Product:";
			$id = isset($_GET['id']) ? $_GET['id'] : "";
			$id = mysqli_real_escape_string($db, $id);
			$res = mysqli_query($db, "SELECT * FROM products WHERE id = $id");
			if ($res)
			{
				$row = mysqli_fetch_array($res);
				if ($row)
					$index = "<div class='product_info'><h5>".$row['name']." (".$row['color']." / ".$row['category'].")</h5><hr />".
								"<blockquote>".$row['description']."</blockquote><hr />".
								"<button onclick=\"window.location = '?module=basket&action=add&id=".$row['id']."';\">Ajouter au panier</button>".
								"</div>";
				else
					$index = "could not fetch array ...";
				mysqli_free_result($res);
			}
			else
				$index = "Unknown product !";
			break;
		}
		default:
			$index = "unknown action '$action'";
	}
	$_GLOBALS['modules']['catalogue']['header'] = $header;
	$_GLOBALS['modules']['catalogue']['index'] = $index;
	$_GLOBALS['modules']['catalogue']['footer'] = $footer;
	$_GLOBALS['modules']['catalogue']['scripts'] = array("validator.js");
	$_GLOBALS['modules']['catalogue']['styles'] = array("style.css");
?>

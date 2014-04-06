<?php
	$action = isset($_GET['action']) ? $_GET['action'] : "show";
	$index = "";
	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	if (isset($_SESSION['username']) && isset($_SESSION['basket']))
	{
		switch ($action)
		{
			case 'show':
			{
				$index .= "<table class='basket'>";
					$index .= "<tr class='basket_header'><td>Actions</td><td>Name</td><td>Quantité</td></tr>";
				$i = 0;
				foreach($_SESSION['basket'] as $item)
				{
					$index .= "<tr class='basket_row'><td><a href='?module=basket&action=remove&id=$i' title='Supprimer'>Supprimer</a></td><td>"
							.$item['name']."</td><td>".$item['quantity']."<button onclick=\"window.location = '?module=basket&action=inc&id=$i';\" title='Augmenter'>+</button>".
							"<button onclick=\"window.location = '?module=basket&action=dec&id=$i';\" title='Réduire'>-</button></td></tr>";
					$i++;
				}
				$index .= "</table><br/>";
				break ;
			}
			case 'inc':
			{
				$_SESSION['basket'][$id]['quantity'] = intval($_SESSION['basket'][$id]['quantity']) + 1;
				$index = "Redirection en cours...";
				header("refresh: 2; url=index.php?module=basket");
				break ;
			}
			case 'dec':
			{
				$_SESSION['basket'][$id]['quantity'] = intval($_SESSION['basket'][$id]['quantity']) - 1;
				if ($_SESSION['basket'][$id]['quantity']<= 0)
					unset($_SESSION['basket'][$id]);
				$index = "Redirection en cours...";
				header("refresh: 2; url=index.php?module=basket");
				break ;
			}
			case 'clear':
				unset($_SESSION['basket']);
				$index = "Redirection en cours...";
				header("refresh: 2; url=index.php?module=basket");
			break ;
			case 'add':
			{
				$id = isset($_GET['id']) ? $_GET['id'] : "";
				$db = mysqli_connect($_GLOBALS['config']['mysql']['host'],
					$_GLOBALS['config']['mysql']['user'],
					$_GLOBALS['config']['mysql']['pass'],
					$_GLOBALS['config']['mysql']['db']) or die("Couldn't connect to db.");
				$id = mysqli_real_escape_string($db, $id);
				$res = mysqli_query($db, "SELECT * FROM products WHERE id = $id");
				if ($res)
				{
					$row = mysqli_fetch_array($res);
					if ($row)
					{
						$index .= "Adding ".$row['name']."<br/>";
						$row['quantity'] = 1;
						$_SESSION['basket'][] = $row;

					}
					else
						$index .= "could not fetch array ...";
					mysqli_free_result($res);
				}
				else
					$index .= "Unknown product !";
				$index .= "Redirection en cours...";
				header("refresh: 2; url=index.php?module=basket");
			}
			break;
			case 'remove';
			{
				$found = false;
				$id = isset($_GET['id']) ? $_GET['id'] : "";
				if ($id < count($_SESSION['basket']))
				{
					unset($_SESSION['basket'][$id]);
					$index .= "Successfully removed $id.";
					$index .= "<br />Redirection en cours...";
					header("refresh: 2; url=index.php?module=basket");
				}
				else
					$index .= "Unknown id '$id' !";
			}
			break;
			default:
				$index = "unknown action";
		}
	}
	else
	{
		$index .= "<span class='alert alert-error'>Vous devez etre connecté pour voir le panier</span><br />";
	}
	$_GLOBALS['modules']['basket']['index'] = $index;
	$_GLOBALS['modules']['basket']['scripts'] = array();
	$_GLOBALS['modules']['basket']['styles'] = array("style.css");
?>

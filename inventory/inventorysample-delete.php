<?php require 'library.php';
$items = array();
$idErr = "";
$id = "";

// only run when user has submitted a form
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// validate inputs
	if (empty($_POST['id']) && $_POST['id'] != 0) {
		$idErr = "ID is Required";
	} else {
		$id = $_POST['id'];
	}

	// load backend
	if(isset($_POST['listSize']) ) {
		for ($i = 0; $i < $_POST['listSize']; $i++) {
			$idC = $_POST['itemList'][$i]['id'];
			$itemNameC = convert_uudecode($_POST['itemList'][$i]['name']);
			$sponsorC = convert_uudecode($_POST['itemList'][$i]['sponsor']);
			$quantityC = $_POST['itemList'][$i]['quantity'];
			$unitPriceC = $_POST['itemList'][$i]['unitPrice'];
			$dateC = $_POST['itemList'][$i]['date'];

			# create objects and save to array
			createItem($idC, $itemNameC, $sponsorC, $quantityC, $unitPriceC, $dateC);
		}
	}

	// submit form, create item
	if ($idErr == "") {
		echo deleteItem($id);
	}
} else { // run at startup
	// generate sample item data
	createItem(0, "Crayola Coloring Book XL", 'National Bookstore', 5, 15.15, "05/24/2024");
	createItem(1, "Nike Air Force One", "Nike", 15, 1000.55, "03/27/2024");
}
?>

<html>
<head>
	<style>
		.error {color: #FF0000;}

		table {
			text-align: center;
		}

		th, td {
			padding: 5px;
		}

		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}

		tr:first-child {
			background-color: #5B9BD5;
		}

		tr:nth-child(even) {
			background-color: #DDEBF7;
		}
	</style>
</head>
	<body>
		<div style="border: 2px outset black; text-align: center; width: 650px; height:200px;">
  			<h2>Delete Item</h2>

	 		<form action="inventorysample-delete.php" method="post" enctype="multipart/form-data" style="text-align:left">
				<span style="margin-left:60px;">ID:</span> <input type="text" name="id" size="30" style="margin-bottom:15px" value="<?php echo $id; ?>"> <span class="error">* <?php echo $idErr ?></span>
				<br />
				<?php # save current item list
					echo "<input type='hidden' name='listSize' value='" . sizeof($items) . nl2br("'\n");

					for ($i = 0; $i < sizeof($items); $i++) {
						$item = $items[$i]; // get item
						$values = readItem($item);

						echo "<input type='hidden' name='itemList[$i][id]' value='" . $values['id'] . nl2br("'\n");
						echo "<input type='hidden' name='itemList[$i][name]' value='" . convert_uuencode($values['name'] ). nl2br("'\n");
						echo "<input type='hidden' name='itemList[$i][sponsor]' value='" .  convert_uuencode($values['sponsor'] ) . nl2br("'\n");
						echo "<input type='hidden' name='itemList[$i][quantity]' value='" . $values['quantity'] . nl2br("'\n");
						echo "<input type='hidden' name='itemList[$i][unitPrice]' value='" . $values['unitPrice']  . nl2br("'\n");
						echo "<input type='hidden' name='itemList[$i][date]' value='". $values['date'] . nl2br("'\n");
					}
				?>
				<br />			
				<br />
				<input type="submit" value="Send" style="display:block; margin: 0 auto; font-size:15px;">
			</form>
		</div>

		<h3>Item Catalogue</h3>
		<table>
			<tr>
				<th>ID</th>
				<th>Item Name</th>
				<th>Sponsor</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Date</th>
			</tr>
 			<?php 
			foreach ($items as $item) {
				$values = readItem($item);
				echo "<tr>";
				echo "<td>" . $values["id"] . "</td>";
				echo "<td>" . $values["name"] . "</td>";
				echo "<td>" . $values["sponsor"] . "</td>";
				echo "<td>" . $values["quantity"] . "</td>";
				echo "<td>" . $values["unitPrice"] . "</td>";
				echo "<td>" . $values["date"] . "</td>";
				echo "</tr>";
			}
			?>
		</table>
	</body>
</html>
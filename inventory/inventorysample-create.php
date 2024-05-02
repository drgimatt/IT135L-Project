<?php require 'library.php';
$items = array();
$idErr = $itemNameErr = $sponsorErr = $quantityErr = $unitPriceErr = $dateErr = "";
$id = $itemName = $sponsor = $quantity = $unitPrice = $date = "";

// only run when user has submitted a form
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// validate inputs
	if (empty($_POST['id']) && $_POST['id'] != 0) {
		$idErr = "ID is Required";
	} else {
		$id = $_POST['id'];
	}

	if (empty($_POST['itemName'])) {
		$itemNameErr = "Item Name is Required";
	} else {
		$itemName = $_POST['itemName'];
	}

	if (empty($_POST['sponsor'])) {
		$sponsorErr = "Sponsor is Required";
	} else {
		$sponsor = $_POST['sponsor'];
	}

	if (empty($_POST['quantity'])) {
		$quantityErr = "Quantity is Required";
	} else {
		$quantity = $_POST['quantity'];
	}

	if (empty($_POST['emailAddress'])) {
		$emailAddressErr = "Email Address is Required";
	} else {
		$emailAddress = $_POST['emailAddress'];
	}

	if (empty($_POST['unitPrice'])) {
		$unitPriceErr = "Unit Price is Required";
	} else {
		$unitPrice = $_POST['unitPrice'];
	}

	if (empty($_POST['date'])) {
		$dateErr = "Date is Required";
	} else {
		$date = $_POST['date'];
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
	#echo "<span>" . $items[0]->getID() . "</span>";
	#echo $_POST['listSize'] . nl2br("\n");
	#echo $_POST['itemList'][1]['id'] . nl2br("\n");
	#echo convert_uudecode($_POST['itemList'][1]['name']) . nl2br("\n");
	#echo convert_uudecode($_POST['itemList'][1]['sponsor']) . nl2br("\n");
	#echo $_POST['itemList'][1]['quantity'] . nl2br("\n");
	#echo $_POST['itemList'][1]['unitPrice'] . nl2br("\n");
	#echo $_POST['itemList'][1]['date'] . nl2br("\n");

	// submit form, create item
	if ($idErr == "" && $itemNameErr == "" && $sponsorErr == "" && $quantityErr == "" && $unitPriceErr == "" && $dateErr == "") {
		createItem($id, $itemName, $sponsor, $quantity, $unitPrice, $date);
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
		<div style="border: 2px outset black; text-align: center; width: 650px; height:370px;">
  			<h2>Create Item</h2>

	 		<form action="inventorysample-create.php" method="post" enctype="multipart/form-data" style="text-align:left">	
				<span style="margin-left:60px;">ID:</span> <input type="text" name="id" size="30" style="margin-bottom:15px" value="<?php echo $id; ?>"> <span class="error">* <?php echo $idErr ?></span>
				<br />
				<span style="margin-left:5px;">Item Name:</span> <input type="text" name="itemName" id="itemName" size="30" style="margin-bottom:15px;" value="<?php echo $itemName; ?>"> <span class="error">* <?php echo $itemNameErr ?></span>
				<br />
				<span style="margin-left:23px;">Sponsor:</span> <input type="text" name="sponsor" size="30" style="margin-bottom:15px" value="<?php echo $sponsor; ?>"> <span class="error">* <?php echo $sponsorErr ?></span>
				<br />
				<span style="margin-left:20px;">Quantity:</span> <input type="text" name="quantity" size="30" style="margin-bottom:15px" value="<?php echo $quantity; ?>"> <span class="error">* <?php echo $quantityErr ?></span>
				<br />	
				<span style="margin-left:12px;">Unit Price:</span> <input type="text" name="unitPrice" size="30" style="margin-bottom:15px" value="<?php echo $unitPrice; ?>"> <span class="error">* <?php echo $unitPriceErr ?></span>
				<br />	
				<span style="margin-left:48px;">Date:</span> <input type="text" name="date" size="30" style="margin-bottom:15px" value="<?php echo $date; ?>"> <span class="error">* <?php echo $dateErr ?></span>
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
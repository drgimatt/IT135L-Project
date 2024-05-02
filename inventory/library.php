<?php

// Item class
class Item {
	private $id = false;
	private $name = false;
	private $sponsor = false;
	private $quantity = false;
	private $unitPrice = false;
	private $date = false;

	function __construct($id, $name, $sponsor, $quantity, $unitPrice, $date) {
		$this->id = $id;
		$this->name = $name;
		$this->sponsor = $sponsor;
		$this->quantity = $quantity;
		$this->unitPrice = $unitPrice;
		$this->date = $date;
	}

	function getID() {
		if ($this->id !== false)
			return $this->id;
	} 

	function getName() {
		if ($this->name !== false)
			return $this->name;
	} 
	function setName($name) {
			$this->name = $name;
	} 

	function getSponsor() {
		if ($this->sponsor !== false)
			return $this->sponsor;
	}
	function setSponsor($sponsor) {
			$this->sponsor = $sponsor;
	} 

	function getQuantity() {
		if ($this->quantity !== false)
			return $this->quantity;
	} 
	function setQuantity($quantity) {
			$this->quantity = $quantity;
	} 

	function getUnitPrice() {
		if ($this->unitPrice !== false)
			return $this->unitPrice;
	} 
	function setUnitPrice($unitPrice) {
			$this->unitPrice = $unitPrice;
	} 

	function getDate() {
		if ($this->date !== false)
			return $this->date;
	} 
	function setDate($date) {
			$this->date = $date;
	} 
}


// CRUD code
function createItem($id, $name, $sponsor, $quantity, $unitPrice, $date) {
	global $items;

	// create item
	$item = new Item($id, $name, $sponsor, $quantity, $unitPrice, $date);

	// save to backend
	$items[] = $item;

	// return item
	return $item;
}

function readItem($item) {
	// create array
	$values = array("id" => $item->getID(), "name" => $item->getName(), 
					"sponsor" => $item->getSponsor(), "quantity" => $item->getQuantity(), 
					"unitPrice" => $item->getUnitPrice(), "date" => $item->getDate() );

	// return array of values[field]
	return $values;
}

function updateItem($id, $field, $val) {
	// 0 - update succesful 
	// 1 - update failed
	$result = 0;

	global $items;

	// get item index
	$index = -1;
	for ($i = 0; $i < sizeof($items); $i++) {
		if ($items[$i]->getID() == $id) {
			$index = $i;
			break;
		}
	}

	// if index not found, return error
	if ($index == -1) {
		$result = 1;
		return $result;
	}

	$item = $items[$index];
	switch (strtolower($field) ) {
		case "name":
			$item->setName($val);
		break;
		case "sponsor":
			$item->setSponsor($val);
		break;
		case "quantity":
			$item->setQuantity($val);
		break;
		case "unit price":
			$item->setUnitPrice($val);
		break;
		case "date":
			$item->setDate($val);
		break;
		default:
			$result = 1;
	} 

	// return result
	return $result;
}

function deleteItem($id) {
	// 0 - delete succesful / 1 - delete failed

	global $items;

	$index = -1;
	for ($i = 0; $i < sizeof($items); $i++) {
		if ($items[$i]->getID() == $id) {
			$index = $i;
			break; // item index to delete 
		}
	}

	// delete item
	if ($index != -1) {
		array_splice($items, $index, 1);
	} else {
		return 1;
	}

	// return success
	return 0;
}
?>
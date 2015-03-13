<?php

//Class declaration

	class Contact 
	{
		private $name;
		private $phone_number;
		private $address;
	}

//Constructor

	function __construct($name, $phone_number, $address)
	{
		$this->name = $name;
		$this->phone_number = $phone_number;
		$this->address = $address;
	}


//Getters n' setters

	function setName($new_name)
	{

		$this->name = $new_name;	
	}

	function getName()
	{

		return $this->name;
	}

	function setPhone_Number($new_phone_number)
	{

		$this->phone_number = $new_phone_number;
	}

	function getPhone_Number()
	{

		return $this->phone_number;
	}

	function setAddress($new_address)
	{
		$this->address = $new_address;

	}

	function getAddress()
	{
		return $this->address;

	}

//Save function

	function save()
	{

		array_push($_SESSION['list_of_contacts'], $this);
	}

//Static functions

	static function getAll()
    {
        return $_SESSION['list_of_contacts'];
    }

	static function deleteAll()
	{
	
		return	$_SESSION['list_of_contacts'] = array();

	}
?>
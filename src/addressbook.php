<?php

//Class declaration

	class Contact 
	{
		private $name;
		private $phone_number;
		private $address;
	}

//Constructors

	function __construct($name)
	{
		$this->name = $name;
	}

	function __construct($phone_number)
	{
		$this->phone_number = $phone_number;
	}

	function __construct($address)
	{
		$this->address = $address;
	}

//Setters

	function setName($name)
	{

		$this->name = (string) $name;	
	}

	function setPhone_Number($phone_number)
	{

		$this->phone_number = (string) $phone_number;
	}

	function setAddress($address)
	{
		$this->address = (string) $address;

	}

//Getters

	function getName($name)
	{

		return $this->name;
	}

	function getPhone_Number($phone_number)
	{

		return $this->phone_number;
	}

	function getAddress($address)
	{
		return $this->address;

	}












	}

?>
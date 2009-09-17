<?php
class Slugger {
	
	public $propertyName;
	
	function __construct($propertyName) {
		$this->propertyName = $propertyName;
	}
	
	// $object is the object the attached slugging method was called on
	function slug($object) {
		$property = $this->propertyName;
		return preg_replace('/[^a-zA-Z]/', '-', $object->$property); // Terrible slugging!
	}
	
}
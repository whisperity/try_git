<?php

/**
 * Example exception to be used in the test.
 */
class InvalidKeyException extends Exception {
	// noope
}

class KeyAlreadyExistsException extends Exception {
	// nope.php
}

/**
 * Sample class to be tested.
 */

class Sample {
	/**
	 * Contains attributes.
	 * 
	 * @var array
	 */
	public $attributes = array();

	/**
	 * Updates internal attribute to the set value.
	 * 
	 * @param	string	$k	Attribute key
	 * @param	string	$v	New value
	 * @throws InvalidKeyException()
	 * @access public
	 */
	public function update_attribute($k, $v) {
		if ( array_key_exists($k, $this->attributes) ) {
			$this->attributes[$k] = $v;
		} else
			throw new InvalidKeyException();
	}

	/**
	 * Sets up an empty attribute in the internal stack.
	 * 
	 * @param	string	$k	Attribute key
	 * @throws	KeyAlreadyExistsException()
	 * @access public
	 */
	public function create_attribute($k) {
		if ( array_key_exists($k, $this->attributes) ) {
			throw new KeyAlreadyExistsException();
		} else {
			$this->attributes[$k] = "";
		}
	}
}

// NOTE: Real testing begins here. //

/**
 * This class tests the Sample class.
 */
class SampleTest extends PHPUnit_Framework_TestCase {

	/**
	 * @expectedException InvalidKeyException()
	 */
	public function testInvalidAttributeUpdate() {
		$sample = new Sample();
		$sample->update_attribute("an invalid key", "value");
	}

	/**
	 * @covers Sample::create_attribute()
	 */
	public function testAttributeCreation() {
		$sample = new Sample();
		$sample->create_attribute("key");
	}

	/**
	 * @expectedException KeyAlreadyExistsException()
	 */
	public function testKeyRewrite() {
		$sample = new Sample();

		$sample->create_attribute("something");

		// This test shall purposely fail because the exception is
		// not thrown.
	}
}
?>

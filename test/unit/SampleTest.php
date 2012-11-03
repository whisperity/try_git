<?php

/**
 * This example exception is thrown if the key for Sample is invalid.
 */
class InvalidKeyException extends Exception {
	// Do nothing. We all have everything we want, inherited from Exception.
}

/**
 * Thrown if a key already exists. (Hurr... why do I even documentate this?)
 */
class KeyAlreadyExistsException extends Exception {
	// Do nothing here either.
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
	 * @param   string  $k  Attribute key
	 * @param   string  $v  New value
	 * @throws  InvalidKeyException
	 * @access  public
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
	 * @param   string  $k  Attribute key
	 * @throws  KeyAlreadyExistsException
	 * @access  public
	 */
	public function create_attribute($k) {
		if ( array_key_exists($k, $this->attributes) ) {
			throw new KeyAlreadyExistsException();
		} else {
			$this->attributes[$k] = "";
		}
	}
    
    /**
     * Retrieves a value for an attribute.
     * 
     * @param   string  $k  Attribute key
     * @return  string
     * @throws  InvalidKeyException
     * @access  public
     */
    public function get_value($k) {
        if ( array_key_exists($k, $this->attributes) ) {
            return $this->attributes[$k];
        } else
            throw new InvalidKeyException();
    }
}

// NOTE: Real testing begins here. //

/**
 * This class tests the Sample class.
 */
class SampleTest extends PHPUnit_Framework_TestCase {

	/**
     * Test whether updating a nonexistant value throws the demanded Exception.
     * 
	 * @expectedException InvalidKeyException
     * @covers Sample::update_attribute
	 */
	public function testInvalidAttributeUpdate() {
		$sample = new Sample();
		$sample->update_attribute("an invalid key", "value");
	}

	/**
     * Test whether attribute creation is successful.
     * 
	 * @covers Sample::create_attribute
	 */
	public function testAttributeCreation() {
		$sample = new Sample();
		$sample->create_attribute("key");
	}

	/**
     * Test whether trying to create an already existing attribute throws
     * the demanded Exception.
     * 
	 * @expectedException KeyAlreadyExistsException
     * @covers Sample::create_attribute
     * @covers Sample::update_attribute
	 */
	public function testKeyRecreate() {
		$sample = new Sample();
		$sample->create_attribute("something");
        $sample->update_attribute("something", "Foobar");
        
        $sample->create_attribute("something");
	}
    
    /**
     * Test the thrown Exception on attempt to access undefined key.
     * 
     * @expectedException InvalidKeyException
     * @covers Sample::get_value
     */
    public function testAttributeRetrievalOnNonexistantKey() {
        $sample = new Sample();
        $sample->get_value("a nonexistant key");
    }
    
    /**
     * Test whether creating an attributes creates it with the proper default value.
     * 
     * @covers Sample::get_value
     */
    public function testAttributeRetrievalDefault() {
        $sample = new Sample();
        $sample->create_attribute("test");
        
        $expected = "";
        $value = $sample->get_value("test");
        
        $this->assertEquals($expected, $value);
    }
    
    /**
     * Test whether attribute setting and retrieving works as expected.
     * 
     * @covers Sample::get_value
     */
    public function testAttributeRetrieval() {
        $sample = new Sample();
        
        $expected = "a value";
        
        $sample->create_attribute("test");
        $sample->update_attribute("test", $expected);
        
        $value = $sample->get_value("test");
        
        $this->assertEquals($expected, $value);
    }
}
?>

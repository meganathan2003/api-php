<?php
// Below the code for creating the class

class Fruits
{

    private $name; // this is call properties 
    // Methods
    public function kewi()
    {
        echo "This fruit is very tasty";
    }

    // Another example is set the name and get the name

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
}

// Below the code for creating the constructor 
$fruits = new Fruits();
$fruits->kewi(); // Access the method from the fruits class

$fruits->setName("Orange");
echo $fruits->getName();
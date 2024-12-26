<!-- => PHP OOP - Constructor -->

<?php
class Fruit{
  public $name;
  function __construct($na)
  {
    $this->name = $na;

    
  }
  function get_name() {
    return $this->name;
  }
}
$Fr = new Fruit('kkkkk');
echo $Fr->get_name();
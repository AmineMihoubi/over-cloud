<?php

// Singleton to connect db.
class ConnectDb extends mysqli{
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
  private $host = 'localhost';
  private $user = 'root';
  private $pass = '';
  private $name = 'overcloud';
   
  // The db connection is established in the private constructor.
  private function __construct() {
    parent::__construct($this->host, $this->user, $this->pass, $this->name);
    if (mysqli_connect_error()) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    } 
    mysqli_set_charset($this, "utf8");
}

public static function getInstance() {
  if (!self::$instance instanceof self) {
      self::$instance = new self;
  }
  return self::$instance;
}

  public function getConnection()
  {
    return $this->conn;
  }
}

?>

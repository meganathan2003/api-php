<?php
// Below the code for creating the class  name product

class Product
{
    // Establish the db connection
    private $conn;
    private $table_name = "products";

    // Create the properites
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    /*
    Below the code for creating the db connection using __construct function
    */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM " . $this->table_name . " p  LEFT JOIN categories c ON p.category_id = c.id ORDER BY
            p.created DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    // create product
    function create()
    {
         // query to insert record
    $query = "INSERT INTO " . $this->table_name . " SET name=:name, price=:price, description=:description, category_id=:category_id, created=:created";

    // prepare query
    $stmt = $this->conn->prepare($query);

        // sanitize
        /*
        in this context htmlspecialchars for change the content into the
        char like < - tag conver &lt like this so when it comes from the server
        it wont allow it it the best practice and strip tag is used for aviod the script 
        tag and php tag like if user enter the value if he give the <script> like this
        it wont allowed that strip_tags it will remove 
        */

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->created = htmlspecialchars(strip_tags($this->created));

        // bind values
        /*
        Here we use bind parameter that means one of the most 
        reason we use for sql injectioin so that other can't insert or update 
        the values direclty that's why we are using placeholders and after the we 
        did prepare and set the values to that placeholder and excute the sql query
        */
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Below the code for read One product from the DB
    function readOne(){

        // Query to read a single product
        $query = "SELECT c.name as category_name, p.id,p.name,p.description,p.price,p.category_id,p.created FROM " .$this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id  WHERE p.id = ? LIMIT 0,1";

        // Now prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind id so it will set that is properly
        $stmt->bindParam(1,$this->id);

        // now excute the query
        $stmt->execute();

        return $stmt;
    }
}
?>

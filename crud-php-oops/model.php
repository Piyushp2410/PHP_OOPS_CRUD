<?php
// Database connection
class model
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'crud-php-oops';
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            echo 'Connection Failed';
        } else {
            //echo 'Connection Successfuly';
            return $this->conn;
        }
    } //constructor close

    //function define for insert data
    public function insetRecord($POST)
    {
        $name = $POST['name'];
        $email = $POST['email'];
        $sql = "INSERT INTO users(name,email) VALUES ('$name','$email')";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:index.php?msg=ins');
        } else {
            echo "Error" . $sql . "<br>" . $this->conn->error;
        }
    } //insert record function close

    //function define for update data
    public function updateRecord($POST)
    {
        $name = $POST['name'];
        $email = $POST['email'];
        $editid = $POST['hid'];
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id='$editid'";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:index.php?msg=ups');
        } else {
            echo "Error" . $sql . "<br>" . $this->conn->error;
        }
    } //update record function close

    //delete record function
    public function deleteRecordById($deleteid)
    {
        $sql = "DELETE FROM users WHERE id= '$deleteid'";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:index.php?msg=del');
        } else {
            echo "Error" . $sql . "<br>" . $this->conn->error;
        }
    } //delete record function close 

    public function displayRecord()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            } //while close
            return $data;
        } //if close
    } //display record finction close

    public function displayRecordById($editid)
    {
        $sql = "SELECT * FROM users WHERE id = '$editid'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } //if close
    } //edit data close
} //class close

<?php

require_once 'class_configuration.php';
$connection = new Database();

        class Functions extends Database {
                        // Insert User Into Database
                public function insert($email, $firstname, $lastname, $address) {
                    $sql = 'INSERT INTO employees (email, firstname, lastname, address) VALUES (:email, :firstname,
                    :lastname, :address)';
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                    $stmt->execute();
                    return true;
                }


                   // Fetch All Users From Database
            public function fetchall() {
                $sql = 'SELECT * FROM employees ORDER BY id DESC';
                $stmt = $this->conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            }

               // Fetch Single Users From Database

                        // Fetch Single User From Database
            public function readOne($id) {
                $sql = 'SELECT * FROM employees WHERE id = :id';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }


            // Edit data 
              // Update Single User
    public function update($id, $email, $firstname, $lastname,$address) {
        $sql = 'UPDATE employees SET email = :email, firstname = :firstname, 
        lastname = :lastname, address = :address WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->execute();
        return true;
      }
//    // Delete User From Database
    public function delete($id) {
        $sql = 'DELETE FROM employees WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->fetch();
        return true;
      }
  
        }

?>
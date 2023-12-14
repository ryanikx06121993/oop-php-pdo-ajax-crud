<?php
    // echo json_encode($_POST);
    require_once 'class_functions.php';
    require_once 'class_utilities.php';
    $connection= new Functions();
    $util = new Utilities;
        // CONVERTED FROM STRINGIFY TO JSON FORMAT
    // set for reqiest by stringify javascript
    $data = json_decode(file_get_contents('php://input'), true);
    // echo json_encode($data);

  // Handle Add New User Ajax Request
  if (isset($_POST['insert'])) {
        // echo json_encode($_POST);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // echo json_encode($_POST);
            $email = $util->test_input($_POST['email']);
            $firstname = $util->test_input($_POST['firstname']);
            $lastname = $util->test_input($_POST['lastname']);
            $address = $util->test_input($_POST['address']);
            // OOP INITIALIZATION
                // OOP FUNCTIONSS
            if ($connection->insert($email, $firstname, $lastname, $address)) {
                // echo $util->showMessage('success', 'User inserted successfully!');
                header('Content-Type: application/json');
                echo json_encode(array( 
                  "status" => "success", 
                  "message" => 'success insert data'
              ), JSON_PRETTY_PRINT);
              } else {
                // echo $util->showMessage('danger', 'Something went wrong!');
                header('Content-Type: application/json');
                echo json_encode(array( 
                  "status" => "error", 
                  "message" => 'insert error'
              ), JSON_PRETTY_PRINT);
              }
              

        }else {
            header('Content-Type: application/json');
            echo json_encode(array( 
              "status" => "error", 
              "message" => 'post error'
          ), JSON_PRETTY_PRINT);
        }

    }
     // FETCH ALL DATA
// -----------------------------------------------------------------------------------------
    elseif(isset($_GET['fetchall'])){
         
            // echo json_encode($_GET);   
            // OOP FUNCTIONS
           $result = $connection->fetchall();
            // EMPTY ARRAY
            $json = array();
            // EXTRACT DATA INTO ARRAY 
            foreach ($result as $row) {
                // ARRAY CONVERTED TO JSON
            $json[] = $row;
            }
            echo json_encode($json);
        } 
        
        // ----------------------------------------------------------
        elseif(isset($_GET['fetsingle'])){
            // echo json_encode($_GET);
            $id = $_GET['id'];
             // OOP FUNCTIONS
            $result = $connection->readOne($id);
            echo json_encode($result);
        }
        elseif(isset($data['editform'])){
            // // check first post recived from ajax request information
            // echo json_encode($_POST);
  
             $id = $util->test_input($data['id']);
            $email = $util->test_input($data['email']);
            $firstname = $util->test_input($data['firstname']);
            $lastname = $util->test_input($data['lastname']);
            $address = $util->test_input($data['address']);
        
            if ($connection->update($id, $email, $firstname, $lastname,$address)) {
                        header('Content-Type: application/json');
                        echo json_encode(array( 
                        "status" => "success", 
                        "message" => 'success update data'
                    ), JSON_PRETTY_PRINT);
              } else {
                            // echo $util->showMessage('danger', 'Something went wrong!');
                            header('Content-Type: application/json');
                            echo json_encode(array( 
                            "status" => "error", 
                            "message" => 'update error'
                        ), JSON_PRETTY_PRINT);
              }
        }elseif(isset($_GET['deletesingle'])){
            // echo json_encode($_GET);
            $id = $_GET['deletesingle'];
            if ($connection->delete($id)) {
                        header('Content-Type: application/json');
                        echo json_encode(array( 
                        "status" => "success", 
                        "message" => 'success delete data'
                    ), JSON_PRETTY_PRINT);
                } else {
                                // echo $util->showMessage('danger', 'Something went wrong!');
                                header('Content-Type: application/json');
                                echo json_encode(array( 
                                "status" => "error", 
                                "message" => 'delete error'
                            ), JSON_PRETTY_PRINT);
                }
        }
        else {
        header('Content-Type: application/json');
        echo json_encode(array( 
          "status" => "error", 
          "message" => 'insert error'
      ), JSON_PRETTY_PRINT);
    }
?>
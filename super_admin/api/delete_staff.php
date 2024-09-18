<?php
// delete_user.php
require_once '../db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($user_id) {
        // Prepare the SQL delete statement
        $sql = "DELETE FROM user_roles WHERE id = ?";
        
        // Initialize the statement
        $stmt = $link->prepare($sql);
        
        // Bind the user ID to the statement
        $stmt->bind_param("i", $user_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "User role deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete user role."]);
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid user ID."]);
    }
    
    // Close the database connection
   
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>

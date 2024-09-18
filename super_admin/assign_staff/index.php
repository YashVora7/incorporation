<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';

$id = 1; // Assuming a fixed ID for setting default staff. You can change this as needed.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $secretary_id = $_POST['secretary_id'];
    $compliance_id = $_POST['compliance_id'];
    $incorporator_id = $_POST['incorporator_id'];

    // Validate input to ensure that at least one staff member is selected
    if (empty($secretary_id) && empty($compliance_id) && empty($incorporator_id)) {
        echo "Please assign at least one staff member.";
    } else {
        // Update query
        $sql = "UPDATE set_default_staff SET secretary_id = ?, compliance_id = ?, incorporator_id = ? WHERE id = ?";
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("iiii", $secretary_id, $compliance_id, $incorporator_id, $id);
            if ($stmt->execute()) {
                echo "<script>alert('Staff assignments updated successfully');</script>";
            } else {
                echo "<script>alert('Staff assignments not updated successfully');</script>";
            }
            $stmt->close();
        } else {
            echo "Error: Could not prepare the query: " . $link->error;
        }
    }
}

// Fetch all staff members for the dropdowns
$staff_query = "SELECT id, name FROM user_roles WHERE isAdmin = 3";
$staff_result = mysqli_query($link, $staff_query);
$staff_array = mysqli_fetch_all($staff_result, MYSQLI_ASSOC);

// Fetch current default staff assignments to pre-select options in the dropdowns
$default_staff_query = "SELECT id,secretary_id, compliance_id, incorporator_id FROM set_default_staff";
$default_stmt = $link->prepare($default_staff_query);
$default_stmt->execute();
$default_result = $default_stmt->get_result()->fetch_assoc();
$default_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Set Default Staff | Admin - Tianlong Services Pte Ltd</title>
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
    <style>
        .text_limit1 {
            display: block;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .formm {
            box-shadow: 1px 2px 5px #00000017 !important;
            border-radius: .25rem !important;
            padding: 1.5rem !important;
            margin-top: .5rem !important;
            margin-bottom: 1.5rem !important;
            background: white;
        }

    </style>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <!-- Header + sidebar  -->
        <?php
        require_once '../header.php';
        require_once '../sidebar.php';
        ?>

        <!-- Main Content -->
        <div class="main-content">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item">Staff Management</li>
                        <li class="breadcrumb-item">Defaults Staff Assign</li>
                      </ol>
                </nav>
            <section class="section">
                    <div class="container mt-4 formm">  
                     <h5 id="welcome_msg">Set Default Staff</h5>   
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="id" value="<?php echo $default_result['id'];?>">
                            <div class="form-group">
                                <label for="modal_secretary">Assign Secretary</label>
                                <select class="form-select" id="modal_secretary" name="secretary_id">
                                    <option value="">Select Secretary</option>
                                    <?php foreach ($staff_array as $staff): ?>
                                        <option value="<?= $staff['id'] ?>" <?= $staff['id'] == $default_result['secretary_id'] ? 'selected' : '' ?>><?= $staff['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="modal_compliance">Assign Compliance Person</label>
                                <select class="form-select" id="modal_compliance" name="compliance_id">
                                    <option value="">Select Compliance Person</option>
                                    <?php foreach ($staff_array as $staff): ?>
                                        <option value="<?= $staff['id'] ?>" <?= $staff['id'] == $default_result['compliance_id'] ? 'selected' : '' ?>><?= $staff['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="modal_incorporator">Assign Incorporator</label>
                                <select class="form-select" id="modal_incorporator" name="incorporator_id">
                                    <option value="">Select Incorporator</option>
                                    <?php foreach ($staff_array as $staff): ?>
                                        <option value="<?= $staff['id'] ?>" <?= $staff['id'] == $default_result['incorporator_id'] ? 'selected' : '' ?>><?= $staff['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit"class="btn btn-primary">Set Default Staff</button>
                            </div>
                        </form>
                    </div>
            </section>
        </div>
        <!-- Footer -->
        <?php
        require_once '../footer.php';
        ?>
    </div>
</div>

<script src="../assets/js/app.min.js"></script>
<script src="../assets/js/scripts.js"></script>

</body>
</html>

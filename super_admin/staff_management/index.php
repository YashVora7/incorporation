<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>List of Companies | Admin - Tianlong Services Pte Ltd</title>
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <link rel="stylesheet" href="../assets/bundles/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/bundles/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="../assets/bundles/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="icon" type="image/png" href="../assets/img/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/bundles/footable-bootstrap/css/footable.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bundles/footable-bootstrap/css/footable.standalone.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
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
        .dataTables_filter{
          margin-bottom: 0.5rem;
        }
    </style>

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <!-- Header + sidebar  -->
            <?php
            require_once '../header.php';
            require_once '../sidebar.php';
            ?>

            <!-- Main Content -->
            <?php

                // Fetch user_role data from the database
                $sql = "SELECT * FROM user_roles WHERE isAdmin = 3";
                $result = $link->query($sql);
                ?>

                <div class="main-content ">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item">Settings</li>
                             <li class="breadcrumb-item">Staff Management</li>
                             <li class="breadcrumb-item">Staffs </li>
                          </ol>
                    </nav>
                    <section class="section formm">
                        <div class=" d-flex justify-content-between m-0 w-100">
                            <div class="header">
                                <h3 id="welcome_msg">Add Staff</h3>
                            </div>
                            <div class="add_button">
                                <a href="<?php echo $baseUrl; ?>/super_admin/staff_management/add_staff.php" class='btn btn-success' >Add Staff</a>
                            </div>
                        </div>
                        
                        <!-- User Role Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatable mb-2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['contact'] . "</td>";
                                            echo "<td><a href='".$baseUrl."/super_admin/staff_management/update_staff.php?staff_id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                                      <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}'>Delete</button>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    <script src="../assets/bundles/echart/echarts.js"></script>
    <script src="../assets/bundles/chartjs/chart.min.js"></script>
    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/page/footable-data.js"></script>
    <script src="../assets/bundles/footable-bootstrap/js/footable.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script>
            $('.datatable').DataTable({
                paging: true,
                searching: true,
                pageLength: 10,
                lengthChange: true,
                order: [
                    [0, 'asc']
                ],
                language: {
                    searchPlaceholder: "Search records",
                    lengthMenu: "Show _MENU_ entries"
                },
                dom: 'Bfrtip', // Top search box (f), bottom pagination (lp)
                buttons: [
                    'excel'
                ],
                columnDefs: [{
                        targets: 0,
                        className: 'text-left'
                    }, // Left-align the first column
                    {
                        targets: '_all',
                        className: 'text-center'
                    } // Center-align all other columns
                ]
            });
       

    // Delete button click event
    $(document).on('click', '.delete-btn', function() {
        var userId = $(this).data('id');

        if (confirm("Are you sure you want to delete this user role?")) {
            $.ajax({
                url: '../api/delete_staff.php',
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    var result = JSON.parse(response);

                    if (result.success) {
                        alert(result.message);
                        location.reload(); // Reload the page to reflect the changes
                    } else {
                        alert(result.message);
                    }
                },
                error: function() {
                    alert("An error occurred while trying to delete the user role.");
                }
            });
        }
    });
</script>

</body>
</html>


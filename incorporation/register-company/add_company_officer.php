<?php

// require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
require_once '../session.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$logged_user_id = $_SESSION['user_id'];

$sql = 'SELECT * FROM register_company WHERE user_id = ' . $logged_user_id . '';

$result = mysqli_query($link, $sql);
$numrows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$share_capital_currency = $row['share_capital_currency'];

$total_number_of_shares = $row['number_of_shares'];
$total_shares_value  = $row['issued_share_capital'];
$company_id = $row['id'];



$sql_officers = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . '';
$total_alloted_shares_percentage = 0;
$total_directors = 0;
$total_shareholders = 0;
$total_singapore_director = 0;
$result_officers = mysqli_query($link, $sql_officers);
while ($row_officers = mysqli_fetch_assoc($result_officers)) {
    $total_alloted_shares_percentage = $total_alloted_shares_percentage + $row_officers['percentage_of_shares'];
    if ($row_officers['officer_designation'] == 'director') {
        $total_directors++;
    }
    if ($row_officers['officer_designation'] == 'shareholder') {
        $total_shareholders++;
    }
    if ($row_officers['officer_designation'] == 'director' && $row_officers['is_singapore_citizen'] == 'Yes') {
        $total_singapore_director++;
    }
}

$shares_allocation_left = 100 - $total_alloted_shares_percentage;
 
?>

<script>
    var baseUrl = '<?php echo $baseUrl ?>';
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register Company - Tianlong Services Pte Ltd</title>
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
    <link rel="stylesheet" href="../assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
    <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .text_limit1 {
            display: block;
            width: 100%;
            text-align: right;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .heading {
            background-color: aliceblue;
            padding: 8px 3px;
        }

        @media(min-width: 768px) {
            .side_line {
                border-right: 1px solid #b6b5b5ba;
            }
        }

        @media(min-width: 576px) {
            .modal-dialog {
                max-width: 1000px;
            }
        }



        textarea {
            border-color: #ced4da !important;
            padding: .5rem !important;
            width: 100%;
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
            <input style="display: none;" type="text" name="" id="logged_in_user_id">
            <input style="display: none;" type="text" name="" id="total_number_of_shares" value="<?= $total_number_of_shares ?>">
            <input style="display: none;" type="text" name="" id="total_shares_value" value="<?= $total_shares_value ?>">
            <input style="display: none;" type="text" name="" id="total_directors" value="<?= $total_directors ?>">
            <input style="display: none;" type="text" name="" id="total_share_holders" value="<?= $total_shareholders ?>">
            <input style="display: none;" type="text" name="" id="total_singapore_directors" value="<?= $total_singapore_director ?>">
            <input style="display: none;" type="text" name="" id="allocation_left" value="<?= $shares_allocation_left  ?>">
            <input style="display: none;" type="text" name="" id="share_currency" value="<?php echo $share_capital_currency; ?>">
            <div class="main-content">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Home</a></li>
                    <li class="breadcrumb-item">Register Company</li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Officer</li>
                  </ol>
                </nav>
                <section class="section">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-sm-6">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Alloted Officers</span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Directors</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_name"> <?= $total_directors; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Shareholders</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"> <?= $total_shareholders; ?></p>
                                            </div>
                                        </div>
                                        <!--<div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Directors of Singapore</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"> <?= $total_singapore_director; ?></p>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Allotted Shares</p>
                                            </div>
                                            <div class="col-7"> 
                                                <!-- Bootstrap 5 Progress Bar -->
                                                <div class="progress mt-2">
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $total_alloted_shares_percentage; ?>%;" aria-valuenow="<?= $total_alloted_shares_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                                        <?= $total_alloted_shares_percentage; ?>%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Share Price</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"> <?= $share_capital_currency . ' ' . (int) $total_shares_value / (int) $total_number_of_shares; ?>/- </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $sql = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . '';
                        $total_share_percent = 0;
                        $result_company_data = mysqli_query($link, $sql);
                        while ($row_company_data = mysqli_fetch_assoc($result_company_data)) {
                            $total_share_percent = $total_share_percent +  (int) $row_company_data['percentage_of_shares'];
                            echo '    <div class="col-xl-4 col-md-4 col-sm-6">
                                  <div class="card c2">
                                         <div class="card-bg">
                                             <div class="col p-3">
                                               
                                                 <div class="d-flex justify-content-between">
                                                     <span class="mb-0 text-uppercase text-black fw-bold text-sm">Officer Info</span>
                                                 </div>
                                                 <hr style="margin: .7rem 0;">
                                                 <div class="row">
                                                     <div class="col-5">
                                                         <p class="fw-bold mb-2 font-15 text-black">Officer name</p>
                                                     </div>
                                                     <div class="col-7">
                                                         <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_name"> ' . $row_company_data['officer_name'] . '</p>
                                                     </div>
                                                 </div>
                                                 <div class="row">
                                                     <div class="col-5">
                                                         <p class="fw-bold mb-2 font-15 text-black">Designation</p>
                                                     </div>
                                                     <div class="col-7">
                                                         <p class="fw-normal mb-2 font-15 text-black-50 text_limit1">' . $row_company_data['officer_designation'] . '</p>
                                                     </div>
                                                 </div>
                                                 <div class="row">
                                                     <div class="col-5">
                                                         <p class="fw-bold mb-2 font-15 text-black">Shares Percentage</p>
                                                     </div>
                                                     <div class="col-7">
                                                         <p class="fw-normal mb-2 font-15 text-black-50 text_limit1">' . (int) $row_company_data['percentage_of_shares'] . '%</p>
                                                     </div>
                                                 </div>                                                
                                             </div>
                                         </div>
                            </div>
                        </div>';
                        }
                        ?>



                    </div>
                    <h3>Add Company Officer</h3>
                    <div class="section-body">
                        <form id="addOfficerForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <div class="row">
                                <?php
                                // Assuming you have already established a database connection

                                // SQL query to fetch id and name from register_company table
                                $sql = "SELECT id, company_name FROM register_company";

                                // Execute query
                                $result = $link->query($sql);

                                // Check if there are results
                                if ($result->num_rows > 0) {
                                    echo '<div class="row">';
                                    echo '<div class="col-12">';
                                    echo '<div class="form-group">';

                                    // Variable to hold the last company ID
                                    $lastCompanyId = null;

                                    // Output data of each row and save the last company ID
                                    while ($row = $result->fetch_assoc()) {
                                        $lastCompanyId = $row["id"];
                                        $name = $row["company_name"];
                                        // Display the company name (optional)
                                    }

                                    // Set the last company ID in a hidden input
                                    if ($lastCompanyId !== null) {
                                        echo "<input type='hidden' id='select_company' name='last_cr_id' value='$company_id'>";
                                    }

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    echo "0 results";
                                }

                                // Close connection
                                $link->close();
                                ?>
                                <!-- First Name -->
                                <div class="col-12">
                                    <label class="form-label"> Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="officer_name" id="officer_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Officer Type</label>
                                    <div class="form-group">
                                        <select class="form-control" id="officer_type" name="officer_type">
                                            <option value="individual">Individual</option>
                                            <option value="corporate">Corporate</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Officer Designation</label>
                                    <div class="form-group">
                                        <select class="form-control" name="officer_designation" id="officer_designation">
                                            <option value="employee">Employee</option>
                                            <option value="director">Director</option>
                                            <option value="shareholder">Shareholder</option>
                                            <option value="agent">Agent of the Company</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Nominee Director Checkbox -->
                                <div class="col-4" id="nominee_director_container" style="display: none;">
                                    <div class="form-group">
                                        <div style="display: flex;">
                                            <label class="form-label">Nominee Director <span style="color: red;">*</span></label>  
                                            <div class="info-icon" style="margin-left: 5px; margin-top: 5px;">
                                                <i class="fas fa-info-circle"></i>
                                                <div class="tooltip">State the total value of the shares of the company</div>
                                            </div>
                                        </div>
                                        <input type="checkbox"  name="nominee_director" id="nominee_director" value="yes">
                                    </div>
                                    <div class="tooltip">State the total value of the shares of the company</div>
                                </div>
                                <div class="row" id="corporate_director">
                                    <div class="col-12 ">
                                        <label class="form-label">Entity Number</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="entity_number" id="entity_number">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <label class="form-label">Entity country of incorporation</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="entity_country_of_incorporation" id="entity_country_of_incorporation">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <label class="form-label">Entity Address</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="corporate_entity_address" id="corporate_entity_address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <label class="form-label">Upload business registration certificate of entity</label>
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="business_registration_certificate_of_entity" name="business_registration_certificate_of_entity">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label"> Name of ultimate beneficial owner of the Corporate</label>
                                        <div class="form-group">
                                            <input type="text" name="name_of_ultimate_beneficial_owner" class="form-control" id="name_of_ultimate_beneficial_owner">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="individual_director">
                                    <div class="col-12">
                                        <label class="form-label">Singapore citizen/PR?</label>
                                        <div class="form-group">
                                            <select class="form-control" id="is_singapore_citizen" name="is_singapore_citizen">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="share_box" style="display: none;">
                                    <div class="col-6">
                                        <label class="form-label">Percentage (%) of shares</label>
                                        <div class="form-group">
                                            <input type="number" name="percentage_of_shares" class="form-control" id="officer_percentage_of_shares">
                                            <p class="danger_text">Maximum Allocation Left: <?= $shares_allocation_left ?>%</p>
                                            <p class="danger_text" style="color: red;" id="percent_error"> </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Issued share capital allocation</label>
                                        <div class="form-group">
                                            <input disabled type="text" name="issued_share_capital_allocation" class="form-control" id="issued_share_capital_allocation">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Number of shares allocation</label>
                                        <div class="form-group">
                                            <input disabled type="number" name="number_of_shares_allocation" class="form-control" id="number_of_shares_allocation">
                                        </div>
                                    </div>
                                </div>
                                 <br>
                                <!-- Last Name -->
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label"> Gender</label>
                                        <div class="form-group">
                                            <select name="gendar" class="form-control" id="officer_gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label"> Residential Address</label>
                                        <div class="form-group">
                                            <textarea name="residential_address" class="form-control" id="officer_residential_address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> Residential Address Country</label>
                                        <div class="form-group">
                                            <input type="text" name="residential_address_country" class="form-control" id="residential_address_country">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> Residential Address Postal code</label>
                                        <div class="form-group">
                                            <input type="text" name="residential_address_postal_code" id="residential_address_postol_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label"> NRIC / ID number</label>
                                        <div class="form-group">
                                            <input type="text" name="nric_id" class="form-control" id="nric_or_id_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="no_singapore" style="display: none;">
                                    <div class="col-12">
                                        <label class="form-label">Passport number</label>
                                        <div class="form-group">
                                            <input type="text" name="officer_passport_number" class="form-control" id="officer_passport_number">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Passport expiration</label>
                                        <div class="form-group">
                                            <input type="date" name="officer_passport_expiration" class="form-control" id="officer_passport_expiration">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label"> Upload Passport</label>
                                        <div class="form-group">

                                            <input type="file" name="upload_passport" class="form-control" id="passport_image">
                                            <p style="color: red" id="passport_image_error"></p>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label"> Upload Proof of address</label>
                                        <div class="form-group">

                                            <input type="file" name="upload_proof_of_address" class="form-control" id="proof_of_address_image">
                                            <p style="color: red" id="proof_of_address_image_error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="divi"></div> <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label"> Nationality</label>
                                        <div class="form-group">

                                            <input type="text" name="" class="form-control" id="officer_passport_nationality">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> Country of birth</label>
                                        <div class="form-group">

                                            <select class="form-select" name="secondary_company_activity" id="officer_country_of_birth">
                                                <option selected hidden disabled>Select country</option>
                                               <?php
                                                require_once 'db.php';

                                                // Fetch currency names alphabetically in a case-insensitive manner
                                                $sql = mysqli_query($link, 'SELECT * FROM currency ORDER BY LOWER(cure_name) ASC');

                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    echo '<option value="' . $row['cure_name'] . '">' . $row['cure_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> Phone contact number with country code</label>
                                        <div class="form-group">

                                            <input type="text" name="phone_number" class="form-control" id="officer_contact">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> Email address</label>
                                        <div class="form-group">

                                            <input type="email" name="officer_email_address" class="form-control" id="officer_email_address">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> Upload NRIC / ID card, front and back</label>
                                        <div class="form-group">

                                            <input type="file" name=" upload_nric_id_card" class="form-control" id="officer_nric_image">
                                            <p style="color:red" id="officer_nric_image_id"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->

                            </div>

                    </div>
                    </form>
                    <button type="submit" id="add_officer" name="add_officer" class="btn btn-outline-danger px-5">Submit </button>
                    <button type="submit" id="add_another_officer" name="add_more_officer" class="btn btn-outline-success px-5">Add More Officer</button>
            </div>
            </section>
        </div>

        <!-- Add New Director Modal -->


        <!-- Add New Shareholder Modal -->


        <!-- Footer -->
        <?php
        require_once '../footer.php';
        ?>  

    </div>
    </div>

    <script>
    $(document).ready(function() {
        var total_allot_share = parseFloat('<?php echo $total_alloted_shares_percentage; ?>');
        var total_singapore_director = parseInt('<?php echo $total_singapore_director; ?>', 10); 
        var enter_percentageOfShare = 0;

        // Display initial values for debugging purposes
        var total = total_allot_share;

        // Initial validation check
        if (total_singapore_director >= 1 && total >= 100) {
            $("#add_officer").prop("disabled", false);
        } else {
            $("#add_officer").prop("disabled", true);
        }

        // Listen for changes in the officer percentage of shares input field
        $("#officer_percentage_of_shares").on('change keyup', function() {
            // Get the value from the input and parse it as a float
            enter_percentageOfShare = parseFloat($("#officer_percentage_of_shares").val()) || 0;

            // Update the total percentage of shares
            total = total_allot_share + enter_percentageOfShare;

            // Validation check based on updated values
            if (total_singapore_director >= 1 && total >= 100) {
                $("#add_officer").prop("disabled", false);
            } else {
                $("#add_officer").prop("disabled", true);
            }
        });

        // Trigger validation on change or enter key in the input field
    });



        $(document).ready(function() {

        
            function addOfficer(){
                // Company ID
                var lastCrId = $("#select_company").val();

                // Officer Name
                var officerName = $("#officer_name").val();

                // Officer Type
                var officerType = $("#officer_type").val();

                // Officer Designation
                var officerDesignation = $("#officer_designation").val();
                var nomineeDirector = $("#nominee_director").val();

                // Corporate Director Fields
                var entityNumber = $("#entity_number").val();
                var entityCountryOfIncorporation = $("#entity_country_of_incorporation").val();
                var corporateEntityAddress = $("#corporate_entity_address").val();
                var businessRegistrationCertificateOfEntity = $("#business_registration_certificate_of_entity").val();
                var nameOfUltimateBeneficialOwner = $("#name_of_ultimate_beneficial_owner").val();

                // Individual Director Fields
                var isSingaporeCitizen = $("#is_singapore_citizen").val();

                // Share Box Fields
                var percentageOfShares = $("#officer_percentage_of_shares").val();
                var issuedShareCapitalAllocation = $("#issued_share_capital_allocation").val();
                var numberOfSharesAllocation = $("#number_of_shares_allocation").val();

                // Officer Gender
                var officerGender = $("#officer_gender").val();

                // Residential Address Fields
                var residentialAddress = $("#officer_residential_address").val();
                var residentialAddressCountry = $("#residential_address_country").val();
                var residentialAddressPostalCode = $("#residential_address_postol_code").val();

                // NRIC / ID Number
                var nricOrIdNumber = $("#nric_or_id_number").val();

                // No Singapore Citizen Fields
                var officerPassportNumber = $("#officer_passport_number").val();
                var officerPassportExpiration = $("#officer_passport_expiration").val();
                var passportImage = $("#passport_image").val();
                var proofOfAddressImage = $("#proof_of_address_image").val();

                // Nationality and Birth Country Fields
                var officerPassportNationality = $("#officer_passport_nationality").val();
                var officerCountryOfBirth = $("#officer_country_of_birth").val();

                // Contact Information Fields
                var officerContact = $("#officer_contact").val();
                var officerEmailAddress = $("#officer_email_address").val();

                // NRIC / ID Card Image

                let officer_designation = $('#officer_designation').val();
                let percentage_of_shares;
                let total_number_of_shares;
                let total_share_value;
                let share_currency;
                let allocation_left;
                let nric_result;
                percentage_of_shares = $('#officer_percentage_of_shares').val();
                allocation_left = 100 - parseInt($('#allocation_left').val());

                let officer_type = $('#officer_type').val();
                let is_singapore_citizen = $('#is_singapore_citizen').val();
                if ($('#officer_nric_image').val() != '') {
                    var formData = new FormData();
                    var fileInput = $('#officer_nric_image')[0].files[0];

                    if (fileInput) {
                        formData.append('file', fileInput);

                        $.ajax({
                            url: '../api/upload_img.php', // The path to your PHP script
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                nric_result = JSON.parse(response);
                                if (nric_result.message == 'File uploaded successfully') {

                                    if (officer_type == 'corporate') {
                                        if ($('#business_registration_certificate_of_entity').val() != '') {
                                            var formData = new FormData();
                                            var fileInput = $('#business_registration_certificate_of_entity')[0].files[0];

                                            if (fileInput) {
                                                formData.append('file', fileInput);

                                                $.ajax({
                                                    url: '../api/upload_img.php', // The path to your PHP script
                                                    type: 'POST',
                                                    data: formData,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(response) {

                                                        let business_registration_certificate_of_entity_result = JSON.parse(response);

                                                        if (business_registration_certificate_of_entity_result.message == 'File uploaded successfully') {
                                                            if (officer_designation == 'shareholder') {
                                                                if (parseInt(allocation_left) + parseInt(percentage_of_shares) <= 100) {
                                                                    $.ajax({
                                                                        url: '../api/add_company_officer.php',
                                                                        type: 'POST', // Adjust method type (GET, POST, etc.) based on your API requirements
                                                                        data: {
                                                                            last_cr_id: lastCrId,
                                                                            officer_name: officerName,
                                                                            officer_type: officerType,
                                                                            officer_designation: officerDesignation,
                                                                            nominee_director:nomineeDirector,

                                                                            entity_country_of_incorporation: entityCountryOfIncorporation,
                                                                            corporate_entity_address: corporateEntityAddress,
                                                                            business_registration_certificate_of_entity: business_registration_certificate_of_entity_result.file_name,
                                                                            name_of_ultimate_beneficial_owner: nameOfUltimateBeneficialOwner,
                                                                            is_singapore_citizen: is_singapore_citizen,
                                                                            percentage_of_shares: percentageOfShares,
                                                                            issued_share_capital_allocation: issuedShareCapitalAllocation,
                                                                            number_of_shares_allocation: numberOfSharesAllocation,
                                                                            officer_gender: officerGender,
                                                                            officer_residential_address: residentialAddress,
                                                                            residential_address_country: residentialAddressCountry,
                                                                            residential_address_postal_code: residentialAddressPostalCode,
                                                                            nric_or_id_number: nricOrIdNumber,
                                                                            officer_passport_number: officerPassportNumber,
                                                                            officer_passport_expiration: officerPassportExpiration,
                                                                            upload_passport_name: 'NA',
                                                                            upload_proof_of_address: 'NA',
                                                                            officer_passport_nationality: 'NA',
                                                                            officer_country_of_birth: officerCountryOfBirth,
                                                                            officer_contact: officerContact,
                                                                            officer_email_address: officerEmailAddress,
                                                                            officer_nric_image: nric_result.file_name
                                                                        },
                                                                        success: function(response) {
                                                                            // Handle success response from the server
                                                                            
                                                                             window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                            
                                                                        },
                                                                        error: function(xhr, status, error) {
                                                                            // Handle error response
                                                                            alert('API call error', error);
                                                                            // You can handle errors or display messages to the user
                                                                             window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                        }
                                                                    });
                                                                } else {
                                                                    swal.fire({
                                                                        text: 'Entered Shares percentage is not valid1!',
                                                                        message: 'Total share percentage exceeded 100%',
                                                                        type: 'Alert',
                                                                        icon: 'Alert',
                                                                        confirmButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Okay'
                                                                    }).then(function(isConfirm) {

                                                                    });
                                                                }
                                                            } else {
                                                                $.ajax({
                                                                    url: '../api/add_company_officer.php',
                                                                    type: 'POST', // Adjust method type (GET, POST, etc.) based on your API requirements
                                                                    data: {
                                                                        last_cr_id: lastCrId,
                                                                        officer_name: officerName,
                                                                        officer_type: officerType,
                                                                        officer_designation: officerDesignation,
                                                                        nominee_director:nomineeDirector,

                                                                        entity_country_of_incorporation: entityCountryOfIncorporation,
                                                                        corporate_entity_address: corporateEntityAddress,
                                                                        business_registration_certificate_of_entity: business_registration_certificate_of_entity_result.file_name,
                                                                        name_of_ultimate_beneficial_owner: nameOfUltimateBeneficialOwner,
                                                                        is_singapore_citizen: is_singapore_citizen,
                                                                        percentage_of_shares: percentageOfShares,
                                                                        issued_share_capital_allocation: issuedShareCapitalAllocation,
                                                                        number_of_shares_allocation: numberOfSharesAllocation,
                                                                        officer_gender: officerGender,
                                                                        officer_residential_address: residentialAddress,
                                                                        residential_address_country: residentialAddressCountry,
                                                                        residential_address_postal_code: residentialAddressPostalCode,
                                                                        nric_or_id_number: nricOrIdNumber,
                                                                        officer_passport_number: officerPassportNumber,
                                                                        officer_passport_expiration: officerPassportExpiration,
                                                                        upload_passport_name: 'NA',
                                                                        upload_proof_of_address: 'NA',
                                                                        officer_passport_nationality: 'NA',
                                                                        officer_country_of_birth: officerCountryOfBirth,
                                                                        officer_contact: officerContact,
                                                                        officer_email_address: officerEmailAddress,
                                                                        officer_nric_image: nric_result.file_name
                                                                    },
                                                                    success: function(response) {
                                                                        // Handle success response from the server
                                                                            
                                                                             window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                    },
                                                                    error: function(xhr, status, error) {
                                                                        // Handle error response
                                                                       alert('Try Again');
                                                                        window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                        // You can handle errors or display messages to the user
                                                                    }
                                                                });
                                                            }

                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        alert(response)

                                                    }
                                                });
                                            } else {
                                                $('#response').html('No file selected');
                                            }
                                        } else {
                                            $('#officer_nric_image_id').html('Please select NRIC Image');

                                        }
                                    }
                                    if (officer_type == 'individual' && is_singapore_citizen == 'No') {
                                        if ($('#passport_image').val() != '') {
                                            var formData = new FormData();
                                            var fileInput = $('#passport_image')[0].files[0];

                                            if (fileInput) {
                                                formData.append('file', fileInput);

                                                $.ajax({
                                                    url: '../api/upload_img.php', // The path to your PHP script
                                                    type: 'POST',
                                                    data: formData,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(response) {
                                                        let passport_result = JSON.parse(response);
                                                        if (passport_result.message == 'File uploaded successfully') {

                                                            if ($('#proof_of_address_image').val() != '') {
                                                                var formData = new FormData();
                                                                var fileInput = $('#proof_of_address_image')[0].files[0];

                                                                if (fileInput) {
                                                                    formData.append('file', fileInput);

                                                                    $.ajax({
                                                                        url: '../api/upload_img.php', // The path to your PHP script
                                                                        type: 'POST',
                                                                        data: formData,
                                                                        contentType: false,
                                                                        processData: false,
                                                                        success: function(response) {
                                                                            let proof_of_address_image_result = JSON.parse(response);
                                                                            if (proof_of_address_image_result.message == 'File uploaded successfully') {
                                                                                console.log('images checked');
                                                                                if (officer_designation == 'shareholder') {
                                                                                    if (parseInt(allocation_left) + parseInt(percentage_of_shares) <= 100) {
                                                                                        $.ajax({
                                                                                            url: '../api/add_company_officer.php',
                                                                                            type: 'POST', // Adjust method type (GET, POST, etc.) based on your API requirements
                                                                                            data: {
                                                                                                last_cr_id: lastCrId,
                                                                                                officer_name: officerName,
                                                                                                officer_type: officerType,
                                                                                                officer_designation: officerDesignation,
                                                                                                nominee_director:nomineeDirector,

                                                                                                entity_country_of_incorporation: entityCountryOfIncorporation,
                                                                                                corporate_entity_address: corporateEntityAddress,
                                                                                                business_registration_certificate_of_entity: 'NA',
                                                                                                name_of_ultimate_beneficial_owner: nameOfUltimateBeneficialOwner,
                                                                                                is_singapore_citizen: is_singapore_citizen,
                                                                                                percentage_of_shares: percentageOfShares,
                                                                                                issued_share_capital_allocation: issuedShareCapitalAllocation,
                                                                                                number_of_shares_allocation: numberOfSharesAllocation,
                                                                                                officer_gender: officerGender,
                                                                                                officer_residential_address: residentialAddress,
                                                                                                residential_address_country: residentialAddressCountry,
                                                                                                residential_address_postal_code: residentialAddressPostalCode,
                                                                                                nric_or_id_number: nricOrIdNumber,
                                                                                                officer_passport_number: officerPassportNumber,
                                                                                                officer_passport_expiration: officerPassportExpiration,
                                                                                                upload_passport_name: passport_result.file_name,
                                                                                                upload_proof_of_address: proof_of_address_image_result.file_name,
                                                                                                officer_passport_nationality: officerPassportNationality,
                                                                                                officer_country_of_birth: officerCountryOfBirth,
                                                                                                officer_contact: officerContact,
                                                                                                officer_email_address: officerEmailAddress,
                                                                                                officer_nric_image: nric_result.file_name
                                                                                            },
                                                                                            success: function(response) {
                                                                                                // Handle success response from the server
                                                                                                
                                                                                                 window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                // Handle error response
                                                                                               
                                                                                                alert('Try Again');
                                                                                                window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                                                // You can handle errors or display messages to the user
                                                                                            }
                                                                                        });
                                                                                    } else {
                                                                                        swal.fire({
                                                                                            text: 'Entered Shares percentage is not valid2!',
                                                                                            message: 'Total share percentage exceeded 100%',
                                                                                            type: 'Alert',
                                                                                            icon: 'Alert',
                                                                                            confirmButtonColor: '#3085d6',
                                                                                            confirmButtonText: 'Okay'
                                                                                        }).then(function(isConfirm) {

                                                                                        });
                                                                                    }
                                                                                } else {
                                                                                    $.ajax({
                                                                                        url: '../api/add_company_officer.php',
                                                                                        type: 'POST', // Adjust method type (GET, POST, etc.) based on your API requirements
                                                                                        data: {
                                                                                            last_cr_id: lastCrId,
                                                                                            officer_name: officerName,
                                                                                            officer_type: officerType,
                                                                                            officer_designation: officerDesignation,
                                                                                            nominee_director:nomineeDirector,

                                                                                            entity_country_of_incorporation: entityCountryOfIncorporation,
                                                                                            corporate_entity_address: corporateEntityAddress,
                                                                                            business_registration_certificate_of_entity: 'NA',
                                                                                            name_of_ultimate_beneficial_owner: nameOfUltimateBeneficialOwner,
                                                                                            is_singapore_citizen: is_singapore_citizen,
                                                                                            percentage_of_shares: percentageOfShares,
                                                                                            issued_share_capital_allocation: issuedShareCapitalAllocation,
                                                                                            number_of_shares_allocation: numberOfSharesAllocation,
                                                                                            officer_gender: officerGender,
                                                                                            officer_residential_address: residentialAddress,
                                                                                            residential_address_country: residentialAddressCountry,
                                                                                            residential_address_postal_code: residentialAddressPostalCode,
                                                                                            nric_or_id_number: nricOrIdNumber,
                                                                                            officer_passport_number: officerPassportNumber,
                                                                                            officer_passport_expiration: officerPassportExpiration,
                                                                                            upload_passport_name: passport_result.file_name,
                                                                                            upload_proof_of_address: proof_of_address_image_result.file_name,
                                                                                            officer_passport_nationality: officerPassportNationality,
                                                                                            officer_country_of_birth: officerCountryOfBirth,
                                                                                            officer_contact: officerContact,
                                                                                            officer_email_address: officerEmailAddress,
                                                                                            officer_nric_image: nric_result.file_name
                                                                                        },
                                                                                        success: function(response) {
                                                                                           // Handle success response from the server
                                                                                            
                                                                                             window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                                        },
                                                                                        error: function(xhr, status, error) {
                                                                                            // Handle error response
                                                                                           
                                                                                            alert('Try Again');
                                                                                            window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                                                            // You can handle errors or display messages to the user
                                                                                        }
                                                                                    });

                                                                                }

                                                                            }
                                                                        },
                                                                        error: function(jqXHR, textStatus, errorThrown) {
                                                                            alert(response)

                                                                        }
                                                                    });
                                                                } else {
                                                                    $('#response').html('No file selected');
                                                                }
                                                            } else {
                                                                $('#proof_of_address_image_error').html('Please upload proof of address');

                                                            }
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        alert(response)

                                                    }
                                                });
                                            } else {
                                                $('#response').html('No file selected');
                                            }
                                        } else {
                                            $('#passport_image_error').html('Please upload passport');

                                        }
                                    }

                                    if (officer_type == 'individual' && is_singapore_citizen == 'Yes') {

                                        if (officer_designation == 'shareholder') {
                                            if (parseInt(allocation_left) + parseInt(percentage_of_shares) <= 100) {
                                                $.ajax({
                                                    url: '../api/add_company_officer.php',
                                                    type: 'POST', // Adjust method type (GET, POST, etc.) based on your API requirements
                                                    data: {
                                                        last_cr_id: lastCrId,
                                                        officer_name: officerName,
                                                        officer_type: officerType,
                                                        officer_designation: officerDesignation,
                                                        nominee_director:nomineeDirector,

                                                        entity_country_of_incorporation: entityCountryOfIncorporation,
                                                        corporate_entity_address: corporateEntityAddress,
                                                        business_registration_certificate_of_entity: 'NA',
                                                        name_of_ultimate_beneficial_owner: nameOfUltimateBeneficialOwner,
                                                        is_singapore_citizen: is_singapore_citizen,
                                                        percentage_of_shares: percentageOfShares,
                                                        issued_share_capital_allocation: issuedShareCapitalAllocation,
                                                        number_of_shares_allocation: numberOfSharesAllocation,
                                                        officer_gender: officerGender,
                                                        officer_residential_address: residentialAddress,
                                                        residential_address_country: residentialAddressCountry,
                                                        residential_address_postal_code: residentialAddressPostalCode,
                                                        nric_or_id_number: nricOrIdNumber,
                                                        officer_passport_number: officerPassportNumber,
                                                        officer_passport_expiration: officerPassportExpiration,
                                                        upload_passport_name: 'NA',
                                                        upload_proof_of_address: 'NA',
                                                        officer_passport_nationality: officerPassportNationality,
                                                        officer_country_of_birth: officerCountryOfBirth,
                                                        officer_contact: officerContact,
                                                        officer_email_address: officerEmailAddress,
                                                        officer_nric_image: nric_result.file_name
                                                    },
                                                    success: function(response) {
                                                        // Handle success response from the server
                                                        
                                                         window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                    },
                                                    error: function(xhr, status, error) {
                                                        // Handle error response
                                                       
                                                        alert('Try Again');
                                                        window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                        // You can handle errors or display messages to the user
                                                    }
                                                });
                                            } else {
                                                swal.fire({
                                                    text: 'Entered Shares percentage is not valid3!',
                                                    message: 'Total share percentage exceeded 100%',
                                                    type: 'Alert',
                                                    icon: 'Alert',
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonText: 'Okay'
                                                }).then(function(isConfirm) {

                                                });
                                            }
                                        } else {
                                            $.ajax({
                                                    url: '../api/add_company_officer.php',
                                                    type: 'POST', // Adjust method type (GET, POST, etc.) based on your API requirements
                                                    data: {
                                                        last_cr_id: lastCrId,
                                                        officer_name: officerName,
                                                        officer_type: officerType,
                                                        officer_designation: officerDesignation,
                                                        nominee_director:nomineeDirector,

                                                        entity_country_of_incorporation: entityCountryOfIncorporation,
                                                        corporate_entity_address: corporateEntityAddress,
                                                        business_registration_certificate_of_entity: 'NA',
                                                        name_of_ultimate_beneficial_owner: nameOfUltimateBeneficialOwner,
                                                        is_singapore_citizen: is_singapore_citizen,
                                                        percentage_of_shares: percentageOfShares,
                                                        issued_share_capital_allocation: issuedShareCapitalAllocation,
                                                        number_of_shares_allocation: numberOfSharesAllocation,
                                                        officer_gender: officerGender,
                                                        officer_residential_address: residentialAddress,
                                                        residential_address_country: residentialAddressCountry,
                                                        residential_address_postal_code: residentialAddressPostalCode,
                                                        nric_or_id_number: nricOrIdNumber,
                                                        officer_passport_number: officerPassportNumber,
                                                        officer_passport_expiration: officerPassportExpiration,
                                                        upload_passport_name: 'NA',
                                                        upload_proof_of_address: 'NA',
                                                        officer_passport_nationality: officerPassportNationality,
                                                        officer_country_of_birth: officerCountryOfBirth,
                                                        officer_contact: officerContact,
                                                        officer_email_address: officerEmailAddress,
                                                        officer_nric_image: nric_result.file_name
                                                    },
                                                    success: function(response) {
                                                        // Handle success response from the server
                                                         
                                                         window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                    },
                                                    error: function(xhr, status, error) {
                                                        // Handle error response
                                                       
                                                        alert('Try Again');
                                                        window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';
                                                        // You can handle errors or display messages to the user
                                                    }
                                                });
                                        }
                                    }
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(response)

                            }
                        });
                    } else {
                        $('#response').html('No file selected');
                    }
                } else {
                    $('#officer_nric_image_id').html('Please select NRIC Image');

                }

            }

             $('#add_another_officer').click(function() {
                addOfficer();

             })
             $('#add_officer').click(function() {
                addOfficer();
             })

            $('#officer_percentage_of_shares').keyup(function() {
                percentage_of_shares = $('#officer_percentage_of_shares').val();
                total_number_of_shares = $('#total_number_of_shares').val();
                total_share_value = $('#total_shares_value').val();
                share_currency = $('#share_currency').val();
                allocation_left = 100 - parseInt($('#allocation_left').val());
                console.log(allocation_left);
                console.log(percentage_of_shares);
                if (percentage_of_shares != '') {
                    let total = parseInt(allocation_left) + parseInt(percentage_of_shares);

                    if (parseInt(allocation_left) + parseInt(percentage_of_shares) <= 100) {
                        $('#percent_error').html('');

                        let officer_total_shares = (percentage_of_shares / 100) * total_number_of_shares;
                        let officer_share_value = (percentage_of_shares / 100) * total_share_value;



                        $('#number_of_shares_allocation').val(officer_total_shares);
                        $('#issued_share_capital_allocation').val(officer_share_value);
                    } else {
                        $('#percent_error').html('Maximum value exceeded!!');
                        $('#number_of_shares_allocation').val(0);
                        $('#issued_share_capital_allocation').val(0);
                    }

                } else {

                    $('#percent_error').html('');
                    $('#number_of_shares_allocation').val(0);
                    $('#issued_share_capital_allocation').val(0);
                }
            });

        })
    </script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <script src="../assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>
    <!-- JavaScript to toggle visibility -->
    <script>
        document.getElementById('officer_designation').addEventListener('change', function() {
            var nomineeDirectorContainer = document.getElementById('nominee_director_container');
            if (this.value === 'director') {
                nomineeDirectorContainer.style.display = 'block'; // Show checkbox
            } else {
                nomineeDirectorContainer.style.display = 'none';  // Hide checkbox
            }
        });
    </script>
    <script type="text/javascript">
        document.getElementById('officer_type').addEventListener('change', function () {
            var officerType = this.value;
            var officerDesignation = document.getElementById('officer_designation');
             var shareBoxDiv = document.getElementById("share_box");


            // Remove all options first
            officerDesignation.innerHTML = '';

            if (officerType === 'corporate') {
                // Add only "Shareholder" option if "Corporate" is selected
                var option = document.createElement('option');
                option.value = 'shareholder';
                option.text = 'Shareholder';
                officerDesignation.appendChild(option);
                 shareBoxDiv.style.display = "block";
            } else {
                // Add all options if "Individual" is selected
                var options = [
                    { value: 'employee', text: 'Employee' },
                    { value: 'director', text: 'Director' },
                    { value: 'shareholder', text: 'Shareholder' },
                    { value: 'agent', text: 'Agent of the Company' }
                ];
                options.forEach(function (opt) {
                    var option = document.createElement('option');
                    option.value = opt.value;
                    option.text = opt.text;
                    officerDesignation.appendChild(option);
                    shareBoxDiv.style.display = "none";
                });
            }
        });
    </script>
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get references to necessary elements
            var officerTypeSelect = document.getElementById("officer_type");
            var individualDirectorDiv = document.getElementById("individual_director");
            var corporateDirectorDiv = document.getElementById("corporate_director");

            // Function to show/hide sections based on officer type selection
            function toggleOfficerType() {
                var selectedType = officerTypeSelect.value;

                if (selectedType === "individual") {
                    individualDirectorDiv.style.display = "block";
                    corporateDirectorDiv.style.display = "none";
                } else if (selectedType === "corporate") {
                    individualDirectorDiv.style.display = "none";
                    corporateDirectorDiv.style.display = "block";
                }
            }

            // Initial call to set the correct visibility based on the default selection
            toggleOfficerType();

            // Add event listener to officer type select to toggle visibility on change
            officerTypeSelect.addEventListener("change", toggleOfficerType);
        });

        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get references to necessary elements
            var officerDesignationSelect = document.getElementById("officer_designation");
            var shareBoxDiv = document.getElementById("share_box");

            // Function to show/hide share box based on officer designation selection
            function toggleShareBox() {
                var selectedDesignation = officerDesignationSelect.value;

                if (selectedDesignation === "shareholder") {
                    shareBoxDiv.style.display = "block";
                } else {
                    shareBoxDiv.style.display = "none";
                }
            }

            // Initial call to set the correct visibility based on the default selection
            toggleShareBox();

            // Add event listener to officer designation select to toggle visibility on change
            officerDesignationSelect.addEventListener("change", toggleShareBox);
        });

        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get references to necessary elements
            var isSingaporeCitizenSelect = document.getElementById("is_singapore_citizen");
            var noSingaporeDiv = document.getElementById("no_singapore");

            // Function to show/hide no_singapore section based on Singapore citizen/PR? selection
            function toggleNoSingaporeSection() {
                var selectedOption = isSingaporeCitizenSelect.value;

                if (selectedOption === "No") {
                    noSingaporeDiv.style.display = "block";
                } else {
                    noSingaporeDiv.style.display = "none";
                }
            }

            // Initial call to set the correct visibility based on the default selection
            toggleNoSingaporeSection();

            // Add event listener to is_singapore_citizen select to toggle visibility on change
            isSingaporeCitizenSelect.addEventListener("change", toggleNoSingaporeSection);
        });
    </script>
</body>

</html>

<?php

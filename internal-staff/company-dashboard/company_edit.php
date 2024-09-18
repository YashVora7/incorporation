<?php
require_once '../db.php';
require_once '../baseUrl.php';
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];
$company_id=$_GET['company_eid'];

?>

<script>
    var baseUrl = '<?php echo $baseUrl ?>';
</script>

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
    <link rel="stylesheet" href="../assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
    <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>

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

        #wizard_with_validation-t-0,
        #wizard_with_validation-t-1,
        #wizard_with_validation-t-2 {
            display: grid;
            justify-items: center;
            text-align: center;
            gap: 10px;
            color: #000;
            font-size: 14px;
        }

        #wizard_with_validation-t-0 .number,
        #wizard_with_validation-t-1 .number,
        #wizard_with_validation-t-2 .number {
            background-color: #fa1800;
            padding: 13px;
            width: fit-content;
            border-radius: 50%;
            color: #fff;
            font-size: 22px;
        }

        .wizard>.steps .disabled a {
            background-color: #fff !important;
        }

        .wizard>.steps .disabled a .number {
            background-color: #eee !important;
        }

        .form-group>label.error {
            color: #fa1800 !important;
        }

        .steps.clearfix,
        fieldset .formm {
            background-color: #fff !important;
        }

        .wizard>.content {
            border: unset !important;
        }

        .wizard .content .body {
            padding: 0 !important;
        }

        fieldset .formm {
            box-shadow: 1px 2px 5px #00000017 !important;
            border-radius: .25rem !important;
            padding: 1.5rem !important;
            margin-top: .5rem !important;
            margin-bottom: 1.5rem !important;
        }

        textarea {
            border-color: #ced4da !important;
            padding: .5rem !important;
            width: 100%;
        }

        .step2_3 .formm {
            border: 1px solid transparent !important;
        }

        .step2_3 .formm.selected {
            border: 1px solid #fa1800 !important;
        }

        .step2_3 .formm {
            cursor: pointer !important;
            height: 8rem !important;
            overflow: auto !important;
        }

        .step2_3 .pretty.p-curve .state label:after,
        .step2_3 .pretty.p-curve .state label:before {
            border-radius: 50% !important;
        }
    </style>

</head>

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
                    <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="../company-dashboard">Companies</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Company</li>
                  </ol>
                </nav>
                <section class="section">
                    <div class="section-body">

                        <div class="row clearfix">
                            <div class="col-12">
                                <h5>UPDATE COMPANY DETAILS</h5>
                                <form id="wizard_with_validation" method="POST">

                                    <!-- Steps -->
                                    <h3>Company Info</h3>
                                    <h3>Company address</h3>
                                    <h3>Finish Company Register</h3>

                                    <!-- Form - Step 1 -->
                                    <fieldset>
                                        <!-- Let's get started & Good to Know -->
                                        <p class="fw-bold mb-0 font-18 text-black" style="padding: 1.5rem .5rem 0rem .5rem;">Let's get started</p>
                                        <div class="p-4 rounded mt-2 mb-4" style="background-color: #fee2e2;">
                                            <h6 class="mb-0">Good to know</h6>
                                            <p class="mb-0">Enter different variations of your company name in order of preference. Tianlong will help you obtain final confirmation prior to incorporation.</p>
                                        </div>

                                        <!-- Company Name Checker -->
                                        <div class="formm">
                                            <div class="form-line">
                                                <h6 class="mb-0">Company name checker</h6>
                                                <label class="form-label">Company name <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-sm-7 col-9">
                                                        <div class="form-group form-float">
                                                            <input type="text" class="form-control" name="company_name" id="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-3">
                                                       <select class="form-control" name="company_suffix" id="company_suffix">
                                                            <option selected disabled hidden>Company Suffix</option>
                                                            <option value="Pte. Ltd.">Pte. Ltd.</option>
                                                            <option value="Private Limited">Private Limited</option>
                                                            <option value="Law Corporation">Law Corporation</option>
                                                            <option value="LLC">LLC</option>
                                                            <option value="PAC">PAC</option>
                                                            <option value="Private Ltd.">Private Ltd.</option>
                                                            <option value="Pte. Limited">Pte. Limited</option>
                                                            <option value="Public Accounting Corporation">Public Accounting Corporation</option>
                                                            <option value="Sdn. Berhad">Sdn. Berhad</option>
                                                            <option value="Sdn. Bhd.">Sdn. Bhd.</option>
                                                            <option value="Sendirian Berhad">Sendirian Berhad</option>
                                                            <option value="Sendirian Bhd.">Sendirian Bhd.</option>
                                                            <option value="(Law Corporation)">(Law Corporation)</option>
                                                            <option value="(LLC)">(LLC)</option>
                                                            <option value="(PAC)">(PAC)</option>
                                                            <option value="(Private Limited)">(Private Limited)</option>
                                                            <option value="(Private Ltd.)">(Private Ltd.)</option>
                                                            <option value="(Private) Limited">(Private) Limited</option>
                                                            <option value="(Private) Ltd.">(Private) Ltd.</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 col-12">
                                                        <a href="#" style="background-color: #fa1800;" class="btn btn-primary d-flex justify-content-center">Check</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tell us more about your company -->
                                        <div class="formm">
                                            <div class="form-line">
                                                <h6 class="mb-0">Tell us more about your company</h6>
                                                <p>To incorporate in Singapore, you need to select a Singapore Standard Industrial Classification (SSIC) code for your business.</p>

                                                <!-- Company activity -->
                                                <div class="row form-group pb-3">
                                                    <!-- <div class="col-md-12 col-6">
                                                        <label class="form-label">UEN</label>

                                                        <div class="form-group form-float">
                                                            <input type="text" name="uen" class="form-control" id="">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-6 col-6">
                                                        <label class="form-label">Company type</label>
                                                        <div class="form-group form-float">
                                                            <select class="form-select" name="company_type" id="company_type">
                                                                <option selected disabled>Select Company Type</option>
                                                                <option> Exempt private company limited by shares</option>
                                                                <option> Private company limited by shares</option>
                                                                <option> Public company limited by guarantee</option>
                                                                <option> Public company limited by shares</option>
                                                                <option> Unlimited exempt private company</option>
                                                                <option> Unlimited private company</option>
                                                                <option> Unlimited public company</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div style="display: flex;">
                                                            <label class="form-label">Company Registered Address</label>
                                                            <div class="info-icon" style="margin-left: 5px; margin-top: 5px;">
                                                                <i class="fas fa-info-circle"></i>
                                                                <div class="tooltip">Our registered address is at 240/year</div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-float">

                                                            <input type="text" name="our_registered_address_is_at_240/year" class="form-control" id="our_registered_address_is_at_240">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <!-- Company activity -->
                                                        <label class="form-label">Primary Company activity</label>
                                                        <div class="form-group form-float">
                                                            <select class="form-select" name="primary_company_activity" id="primary_company_activity">
                                                                <option selected hidden disabled>Select activity</option>
                                                                <?php
                                                               
                                                                $sql = mysqli_query($link, 'SELECT * FROM activity');
                                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                                    echo '<option value="' . $row['code'] . '">' . $row['code'] . ' - ' . $row['name'] . '</option>';
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">

                                                        <!-- Company activity -->
                                                        <label class="form-label">Describe Company activity</label>
                                                        <div class="form-group form-float">
                                                            <textarea name="describe_company_activity" class="form-control" id="describe_company_activity"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- Secondary Company activity -->
                                                    <div class="col-md-12 col-12">

                                                        <label class="form-label">Secondary Company activity</label>
                                                        <div class="form-group form-float">
                                                            <select class="form-select" name="secondary_company_activity" id="secondary_company_activity">
                                                                <option selected hidden disabled>Select activity</option>
                                                                <?php
                                                               
                                                                $sql1 = mysqli_query($link, 'SELECT * FROM activity');
                                                                while ($row1 = mysqli_fetch_assoc($sql1)) {
                                                                    echo '<option value="' . $row1['code'] . '">' . $row1['code'] . ' - ' . $row1['name'] . '</option>';
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">

                                                        <!-- Company activity -->
                                                        <label class="form-label">Describe Company activity</label>
                                                        <div class="form-group form-float">
                                                        <textarea name="business_description" id="business_description" rows="3" placeholder="Write here..."></textarea>

                                                        </div>
                                                    </div>
                                                    <!-- Please describe your business -->
                                           
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label">Share capital currency</label>
                                                    <div class="form-group form-float">
                                                        <select class="form-select" name="share_capital_currency" id="share_capital_currency">
                                                            <option selected hidden disabled>Select currency</option>
                                                            <?php
                                                           
                                                            $sql2 = mysqli_query($link, 'SELECT * FROM currency');
                                                            while ($row2 = mysqli_fetch_assoc($sql2)) {
                                                                echo '<option value="' . $row2['cur_code'] . '">' . $row2['cur_code'] . ' - ' . $row2['cure_name'] . ' - ' . $row2['cur_country'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="director_name" class="form-label">Director's Name:</label>
                                                    <input type="text" class="form-control" id="director_name" name="director_name" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="director_email" class="form-label">Director's Email:</label>
                                                    <input type="email" class="form-control" id="director_email" name="director_email" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="director_country" class="form-label">Director's Country:</label>
                                                    <input type="text" class="form-control" id="director_country" name="director_country" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="director_address" class="form-label">Director's Address:</label>
                                                    <input type="text" class="form-control" id="director_address" name="director_address" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="director_postal_code" class="form-label">Director's Postal Code:</label>
                                                    <input type="text" class="form-control" id="director_postal_code" name="director_postal_code" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="director_activity" class="form-label">Director's Activity:</label>
                                                    <input type="text" class="form-control" id="director_activity" name="director_activity" >
                                                </div>

                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="director_has_store" name="director_has_store" >
                                                    <label class="form-check-label" for="director_has_store">Does Director Have a Store?</label>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="shareholder_name" class="form-label">Shareholder's Name:</label>
                                                    <input type="text" class="form-control" id="shareholder_name" name="shareholder_name" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="shareholder_email" class="form-label">Shareholder's Email:</label>
                                                    <input type="email" class="form-control" id="shareholder_email" name="shareholder_email" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="shareholder_country" class="form-label">Shareholder's Country:</label>
                                                    <input type="text" class="form-control" id="shareholder_country" name="shareholder_country" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="nominee_duration" class="form-label">Nominee Duration:</label>
                                                    <input type="text" class="form-control" id="nominee_duration" name="nominee_duration" >
                                                </div>

                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="with_accounting_plan" name="with_accounting_plan">
                                                    <label class="form-check-label" for="with_accounting_plan">With Accounting Plan</label>
                                                </div>

                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="with_security_deposit" name="with_security_deposit" >
                                                    <label class="form-check-label" for="with_security_deposit">With Security Deposit</label>
                                                </div> -->
                                                <div class="col-md-12 col-12" hidden>
                                                    <label class="form-label">Shares payable</label>
                                                    <div class="form-group form-float">

                                                        <input type="text" name="share_payable" class="form-control" id="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label">Issued share capital</label>
                                                    <div class="form-group form-float">

                                                        <input type="number" name="issued_share_capital" class="form-control" id="issued_share_capital">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label">Number of shares</label>
                                                    <div class="form-group form-float">

                                                        <input type="number" name="number_of_shares" class="form-control" id="number_of_shares">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label">Paid up</label>
                                                    <div class="form-group form-float">

                                                        <input disabled type="number" name="paid_up" class="form-control" id="paid_up" value="0">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        <label class="form-label">Financial Year end</label>
                                                        <div class="form-group form-float">

                                                            <input type="date" name="financial_year_end" class="form-control" id="financial_year_end">
                                                        </div>
                                                    </div>
                                               <div class="col-md-6 col-6">
                                                        <label class="form-label">Transaction number (Name application)</label>
                                                        <div class="form-group form-float">
                                                            <input type="text" name="transaction_number" class="form-control" id="transaction_number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Cryptocurrency Declaration -->
                                                <div class="row">
                                                    <!-- Radio -->
                                                    <div class="form-group mb-4 pb-3" id="crypto-declaration">
                                                        <h6 class="mb-0">Cryptocurrency Declaration</h6>
                                                        <p style="margin-bottom: 2px;">Is your business involved in cryptocurrency?</p>
                                                        <div class="d-flex gap-3">
                                                            <div class="pretty p-default p-curve">
                                                                <input type="radio" name="cryptocurrency_declaration" id="cryptocurrency_declaration" value="No" />
                                                                <div class="state p-danger-o">
                                                                    <label>No</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default p-curve">
                                                                <input type="radio" name="cryptocurrency_declaration" id="cryptocurrency_declaration" value="Yes" />
                                                                <div class="state p-success-o">
                                                                    <label>Yes</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Additional Questions -->
                                                    <div id="additional-questions" style="display: none;">
                                                        <!-- Checkbox -->
                                                        <div class="form-group mb-4 pb-3" style="overflow-y: hidden; overflow-x: auto;">
                                                            <h6>How is your business involved in cryptocurrency? (Select all that apply)</h6>
                                                            <div class="d-grid gap-3">
                                                                <div class="pretty p-default">
                                                                    <input type="checkbox" name="accepts_payments" />
                                                                    <div class="state p-primary">
                                                                        <label>The business accepts payments in cryptocurrency</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default">
                                                                    <input type="checkbox" name="provides_services" />
                                                                    <div class="state p-primary">
                                                                        <label>The business provides services to cryptocurrency companies (further information will be collected)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default">
                                                                    <input type="checkbox" name="manages_coins" />
                                                                    <div class="state p-primary">
                                                                        <label>The business manages cryptocurrency coins (further information will be collected)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Radio -->
                                                        <div class="form-group mb-4 pb-3">
                                                            <h6>Are you licensed by, or will you be seeking a license from, the Monetary Authority of Singapore (MAS) for cryptocurrency services or digital payment token services?</h6>
                                                            <div class="d-flex gap-3">
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="mas_license" value="No" />
                                                                    <div class="state p-danger-o">
                                                                        <label>No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="mas_license" value="Yes" />
                                                                    <div class="state p-success-o">
                                                                        <label>Yes</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Radio -->
                                                        <div class="form-group">
                                                            <h6>Is your business related to any existing local and/or foreign entities in the cryptocurrency or blockchain industry?</h6>
                                                            <div class="d-flex gap-3">
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="related_entities" value="No" />
                                                                    <div class="state p-danger-o">
                                                                        <label>No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="related_entities" value="Yes" />
                                                                    <div class="state p-success-o">
                                                                        <label>Yes</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('input[name="cryptocurrency_declaration"]').change(function() {
                                                            if ($(this).val() === 'Yes') {
                                                                $('#additional-questions').show(); // Show the additional questions section
                                                            } else {
                                                                $('#additional-questions').hide(); // Hide the additional questions section
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>

                                        <!-- Source of funds -->
                                        <div class="formm">
                                            <div class="form-line">
                                                <h6 class="mb-0">Source of funds</h6>
                                                <p>Your inputs are an important part of compliance checks.</p>

                                                <div class="row">
                                                    <!-- Checkbox -->
                                                    <div class="form-group mb-2 pb-3" style="overflow-y: hidden; overflow-x: auto;">
                                                        <h6 class="text-black-50">1. Why are you interested in incorporating your business in Singapore?</h6>
                                                        <div class="d-grid gap-3">
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="reside-in-singapore" name="interest_reason[]" value="reside_in_singapore">
                                                                <div class="state p-primary">
                                                                    <label for="reside-in-singapore">I reside in Singapore</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="expand-existing-business" name="interest_reason[]" value="expand_existing_business">
                                                                <div class="state p-primary">
                                                                    <label for="expand-existing-business">Expansion of existing business</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="enter-asia" name="interest_reason[]" value="enter_asia">
                                                                <div class="state p-primary">
                                                                    <label for="enter-asia">Entering into Asia</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="requested-by-parties" name="interest_reason[]" value="requested_by_parties">
                                                                <div class="state p-primary">
                                                                    <label for="requested-by-parties">Requested by parties we work with</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="recognized-hub" name="interest_reason[]" value="recognized_hub">
                                                                <div class="state p-primary">
                                                                    <label for="recognized-hub">Singapore is an internationally recognized hub</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="other-interest-reason" name="interest_reason[]" value="other">
                                                                <div class="state p-primary">
                                                                    <label for="other-interest-reason">Others, please specify</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="w-50" id="other-interest-reason-text" name="interest_in_incorporate_other_description" rows="5" placeholder="Write here..."></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- Checkbox -->
                                                    <div class="form-group pb-3" style="overflow-y: hidden; overflow-x: auto;">
                                                        <h6 class="text-black-50">2. Please select all sources for your company's fund</h6>
                                                        <div class="d-grid gap-3">
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="savings-from-employment" name="sources[]" value="savings_from_employment">
                                                                <div class="state p-primary">
                                                                    <label for="savings-from-employment">Savings from employment</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="profits-from-business" name="sources[]" value="profits_from_business">
                                                                <div class="state p-primary">
                                                                    <label for="profits-from-business">Profits generated from business</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="investment-gain" name="sources[]" value="investment_gain">
                                                                <div class="state p-primary">
                                                                    <label for="investment-gain">Investment gain</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="loans-banks-financial-institutions" name="sources[]" value="loans_banks_financial_institutions">
                                                                <div class="state p-primary">
                                                                    <label for="loans-banks-financial-institutions">Loans (e.g., Banks or Financial Institutions)</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="loans-family-friends" name="sources[]" value="loans_family_friends">
                                                                <div class="state p-primary">
                                                                    <label for="loans-family-friends">Loans from family and friends</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="personal-savings" name="sources[]" value="personal_savings">
                                                                <div class="state p-primary">
                                                                    <label for="personal-savings">Personal savings</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="inheritance" name="sources[]" value="inheritance">
                                                                <div class="state p-primary">
                                                                    <label for="inheritance">Inheritance</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="investors" name="sources[]" value="investors">
                                                                <div class="state p-primary">
                                                                    <label for="investors">Investors</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="other-sources" name="sources[]" value="other">
                                                                <div class="state p-primary">
                                                                    <label for="other-sources">Others, please specify</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="w-50" id="other-sources-description" name="source_of_company_fund_other_description" rows="5" placeholder="Write here..."></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- Multi Select Dropdown -->
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <h6 class="text-black-50">3 Please list up to 3 countries where your business will take place.</h6>
                                                            <div class="col-md-5">
                                                                <select class="form-select" id="source_of_funds_three_countries" name="three_countries" multiple>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('#source_of_funds_three_countries').siblings().remove();
                                                                            let countries = ['One', 'Two', 'Three'];
                                                                            let selectCountries = $('#source_of_funds_three_countries');
                                                                            selectCountries.empty();
                                                                            selectCountries.append('<option selected disabled>Select Option</option>');
                                                                            countries.forEach(country => {
                                                                                selectCountries.append(`<option value="${country}">${country}</option>`);
                                                                            });
                                                                            new MultiSelectTag('three_countries');
                                                                        });
                                                                    </script>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- More about you -->
                                        <div class="formm">
                                            <div class="form-line">
                                                <h6 class="mb-0">More about you</h6>
                                                <p>This helps us serve you better</p>

                                                <div class="row">
                                                    <!-- Checkbox group for objectives -->
                                                    <div class="form-group mb-2 pb-3" style="overflow-y: hidden; overflow-x: auto;">
                                                        <h6 class="text-black-50">1. What are the next steps/objectives for you?</h6>
                                                        <div class="d-grid gap-3">
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="holding-assets" name="objectives[]" value="create_holding_assets">
                                                                <div class="state p-primary">
                                                                    <label for="holding-assets">Create a holding and hold assets/shares</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="employ-myself" name="objectives[]" value="employ_myself">
                                                                <div class="state p-primary">
                                                                    <label for="employ-myself">Employ myself (applying for a workpass/EP/Entrepass if necessary)</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="move-to-singapore" name="objectives[]" value="move_to_singapore">
                                                                <div class="state p-primary">
                                                                    <label for="move-to-singapore">Move to Singapore</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="raise-funds" name="objectives[]" value="raise_funds">
                                                                <div class="state p-primary">
                                                                    <label for="raise-funds">Raise funds quickly from VCs or Angels</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="start-business" name="objectives[]" value="start_business">
                                                                <div class="state p-primary">
                                                                    <label for="start-business">Start my own business, grow steadily and profitably</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="startup-project" name="objectives[]" value="startup_project">
                                                                <div class="state p-primary">
                                                                    <label for="startup-project">Startup project, we want to grow fast</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="other-objectives" name="objectives[]" value="other">
                                                                <div class="state p-primary">
                                                                    <label for="other-objectives">Others, please specify</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="w-50" id="other-objectives-description" name="next_step_other_description" rows="5" placeholder="Write here..."></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Checkbox group for how user heard about you -->
                                                    <div class="form-group pb-3" style="overflow-y: hidden; overflow-x: auto;">
                                                        <h6 class="text-black-50">2. How did you hear about us?</h6>
                                                        <div class="d-grid gap-3">
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="search-engine" name="hear_about_us[]" value="search_engine">
                                                                <div class="state p-primary">
                                                                    <label for="search-engine">Search engine</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="social-media" name="hear_about_us[]" value="social_media">
                                                                <div class="state p-primary">
                                                                    <label for="social-media">Social media</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="referral-client" name="hear_about_us[]" value="referral_client">
                                                                <div class="state p-primary">
                                                                    <label for="referral-client">Referral from an existing client</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="referral-friend-staff" name="hear_about_us[]" value="referral_friend_staff">
                                                                <div class="state p-primary">
                                                                    <label for="referral-friend-staff">Referral from a friend/Tianlong staff</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="other-hear-about-us" name="hear_about_us[]" value="other">
                                                                <div class="state p-primary">
                                                                    <label for="other-hear-about-us">Others, please specify</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="w-50" id="other-hear-about-us-description" name="hear_about_us_other_description" rows="5" placeholder="Write here..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Form - Step 2 -->
                                    <fieldset>
                                        <script>
                                            function selectOption1_2(optionId) {
                                                document.getElementById(optionId).checked = true;
                                                if (optionId === 'option1') {
                                                    document.getElementById('option1Form').style.display = 'block';
                                                    document.getElementById('option2Form').style.display = 'none';
                                                    document.getElementById('formm1').classList.add('selected');
                                                    document.getElementById('formm2').classList.remove('selected');
                                                } else if (optionId === 'option2') {
                                                    document.getElementById('option1Form').style.display = 'none';
                                                    document.getElementById('option2Form').style.display = 'block';
                                                    document.getElementById('formm1').classList.remove('selected');
                                                    document.getElementById('formm2').classList.add('selected');
                                                }
                                            }

                                            document.getElementById('formm1').addEventListener('click', function() {
                                                selectOption1_2('option1');
                                            });

                                            document.getElementById('formm2').addEventListener('click', function() {
                                                selectOption1_2('option2');
                                            });
                                        </script>

                                        <!-- Two Options -->
                                        <div class="row mt-4 justify-content-center step2_3">
                                            <div class="col-md-4">
                                                <div class="formm selected" id="formm1" onclick="selectOption1_2('option1')">
                                                    <div class="form-line">
                                                        <div class="pretty p-default p-curve">
                                                            <input type="radio" name="step_2_options" id="option1" value="option1" checked />
                                                            <div class="state p-danger-o">
                                                                <label class="font-15 fw-bold">Use Tianlong's registered address & Digital Mailroom Service</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label class="py-1 px-3 rounded-pill mt-2" style="background-color: #fee2e2;">$ 240/year</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="formm" id="formm2" onclick="selectOption1_2('option2')">
                                                    <div class="form-line">
                                                        <div class="pretty p-default p-curve">
                                                            <input type="radio" name="step_2_options" id="option2" value="option2" />
                                                            <div class="state p-danger-o">
                                                                <label class="font-15 fw-bold">Use your own company address</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label class="mt-2 text-decoration-underline" style="color: #fa1800;">Eligibility criteria ></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Option 1 Content -->
                                        <div class="content" id="option1Form">
                                            <!-- Registered office address -->
                                            <div class="formm">
                                                <div class="form-line">
                                                    <!-- Registered office address -->
                                                    <div class="form-group">
                                                        <h6 class="mb-0">Registered office address</h6>
                                                        <p class="mb-1">We will scan your mails, upload them to your account every week, and notify you.</p>
                                                        <label class="py-1 px-3 rounded-pill" style="background-color: #fee2e2; color: #fa1800; font-size: 14px; font-weight: 400;">This is your TSL registered address</label>
                                                    </div>

                                                     <!-- Address Line 1 -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label mb-0" for="address-line-1" style="font-size: 14px; font-weight: 400; color: #a5a9ad !important;">Address line 1</label>
                                                                <input type="hidden" id="address-line-1" name="tdr_address-line-1" value="10 Ubi Crescent">
                                                                <p class="text-dark">10 Ubi Crescent</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mb-0" for="postal-code" style="font-size: 14px; font-weight: 400; color: #a5a9ad !important;">Postal Code</label>
                                                                <input type="hidden" id="postal-code" name="tdr_postal-code" value="408564">
                                                                <p class="text-dark">408564</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label mb-0" for="address-line-2" style="font-size: 14px; font-weight: 400; color: #a5a9ad !important;">Address line 2</label>
                                                                <input type="hidden" id="address-line-2" name="tdr_address-line-2" value="#05-96 Ubi Techpark">
                                                                <p class="text-dark">#05-96 Ubi Techpark</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mb-0" for="country" style="font-size: 14px; font-weight: 400; color: #a5a9ad !important;">Country</label>
                                                                <input type="hidden" id="country" name="tdr_country" value="Singapore">
                                                                <p class="text-dark">Singapore</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Business operations address -->
                                            <div class="formm">
                                                <div class="form-line">
                                                    <div class="form-group">
                                                        <h6 class="mb-0">Business operations address</h6>
                                                        <p>A physical location that you are conducting business activities from. You won't be able to use Tianlong's registered address as your business address.</p>
                                                    </div>

                                                    <!-- Company activity -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- Company activity -->
                                                            <label class="form-label">Company activity</label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="company_activity" id="company_activity">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                            </div>
                                                            <!-- Postal Code -->
                                                            <label class="form-label">Postal Code</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="postal_code">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <!-- Address Line 1 -->
                                                            <label class="form-label">Address Line 1</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="address_line_1">
                                                            </div>
                                                            <!-- Country -->
                                                            <label class="form-label">Country</label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="country">
                                                                    <option selected disabled>Select Option</option>
                                                                    <?php
                                                                        $sql = mysqli_query($link, 'SELECT * FROM currency');
                                                                        while ($row = mysqli_fetch_assoc($sql)) {
                                                                            echo '<option value="' . $row['cur_country'] . '">' . $row['cur_code'] .' - ' . $row['cur_country'] . '</option>';
                                                                        }

                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Radio -->
                                                        <div class="form-group mt-3">
                                                            <h6>Do you operate a physical store?</h6>
                                                            <div class="d-flex gap-3">
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store" value="Yes" />
                                                                    <div class="state p-success-o">
                                                                        <label>Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store" value="No" />
                                                                    <div class="state p-danger-o">
                                                                        <label>No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="agree_terms_conditions">Agree to Terms & Conditions:</label>
                                                                <input class="form-checkbox" type="checkbox" id="agree_terms_conditions" name="agree_terms_conditions" class="form-control">
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Option 2 Content -->
                                        <div class="content" id="option2Form" style="display:none;">
                                            <!-- Registered office address -->
                                            <div class="formm">
                                                <div class="form-line">
                                                    <div class="form-group">
                                                        <h6 class="mb-0">Registered office address</h6>
                                                        <p>Incorporating a company in Singapore requires a physical office address, P.O. box addresses are not allowed. This address will appear in your company's business profile.</p>
                                                    </div>

                                                    <!-- Company activity -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- Company activity -->
                                                            <label class="form-label">Company activity</label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="company_activity1" id="company_activity1">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                            </div>
                                                            <!-- Postal Code -->
                                                            <label class="form-label">Postal Code</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="postal_code2">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <!-- Address Line 1 -->
                                                            <label class="form-label">Address Line 2</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="address_line_2">
                                                            </div>
                                                            <!-- Country -->
                                                            <label class="form-label">Country</label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="country1">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Singapore">Singapore</option>
                                                                    <option value="India">India</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Checkbox -->
                                                        <div class="form-group">
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" />
                                                                <div class="state p-danger">
                                                                    <label>This is also my business operations address</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Business operations address -->
                                            <div class="formm">
                                                <div class="form-line">
                                                    <div class="form-group">
                                                        <h6 class="mb-0">Business operations address</h6>
                                                        <p>A physical location that you are conducting business activities from. You won't be able to use Tianlong's registered address as your business address.</p>
                                                    </div>

                                                    <!-- Company activity -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- Company activity -->
                                                            <label class="form-label">Company activity</label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="company_activity2" id="company_activity2">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                            </div>
                                                            <!-- Postal Code -->
                                                            <label class="form-label">Postal Code</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="postal_code3">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <!-- Address Line 1 -->
                                                            <label class="form-label">Address Line Other</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="address_line_other">
                                                            </div>
                                                            <!-- Country -->
                                                            <label class="form-label">Country</label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="country2">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Singapore">Singapore</option>
                                                                    <option value="India">India</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Radio -->
                                                        <div class="form-group mt-3">
                                                            <h6>Do you operate a physical store?</h6>
                                                            <div class="d-flex gap-3">
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store_boa" value="Yes" />
                                                                    <div class="state p-success-o">
                                                                        <label>Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store_boa" value="No" />
                                                                    <div class="state p-danger-o">
                                                                        <label>No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Form - Step 3 -->
                                    <fieldset>
                                        <script>
                                            function selectOption3_4(optionId) {
                                                document.getElementById(optionId).checked = true;
                                                if (optionId === 'option3') {
                                                    document.getElementById('option3Form').style.display = 'block';
                                                    document.getElementById('option4Form').style.display = 'none';
                                                    document.getElementById('formm3').classList.add('selected');
                                                    document.getElementById('formm4').classList.remove('selected');
                                                } else if (optionId === 'option4') {
                                                    document.getElementById('option3Form').style.display = 'none';
                                                    document.getElementById('option4Form').style.display = 'block';
                                                    document.getElementById('formm3').classList.remove('selected');
                                                    document.getElementById('formm4').classList.add('selected');
                                                }
                                            }

                                            document.getElementById('formm3').addEventListener('click', function() {
                                                selectOption3_4('option3');
                                            });

                                            document.getElementById('formm4').addEventListener('click', function() {
                                                selectOption3_4('option4');
                                            });
                                        </script>
                                        <!-- Two Options -->
                                        <div class="row mt-4 justify-content-center step2_3 bg-light">
                                            <div class="d-flex justify-content-center">
                                                <h1>Click Finish To Register Company</h1>
                                            </div>
                                        </div>
                                    </fieldset>

                                </form>
                            </div>
                        </div>

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
    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/page/form-wizard.js"></script>
    <script src="../assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <script src="../assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Use the existing attributes to select the "Finish" button
            $('a[href="#finish"][role="menuitem"].waves-effect').on('click', function(event) {
                // Prevent the default link behavior
                event.preventDefault();

                // Check if the checkbox is checked
                if (!$('#agree_terms_conditions').is(':checked')) {
                    alert("You must agree to the Terms & Conditions before submitting.");
                    return false; // Stop further execution
                }
                
                // If the checkbox is checked, submit the form
                $('#wizard_with_validation').submit();
            });
        });
    </script>
    <script>
         $(document).ready(function() {
            var company_id = '<?php echo $company_id; ?>';
                $.ajax({
                url: '../api/get_company_by_id.php', // Update this to the correct path of your PHP script
                type: 'POST',
                data: {
                    company_id: company_id // Replace with the actual company_id you want to fetch data for
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.error_flag === 0) {
                         // Text inputs
                            $('#company_name').val(data.data.company_name);
                            $('#company_type').val(data.data.company_type);
                            $('#uen').val(data.data.uen);
                            $('#our_registered_address_is_at_240').val(data.data.registered_address);
                            $('#describe_company_activity').val(data.data.describe_company_activity);
                            $('#business_description').val(data.data.business_description);
                            $('#share_payable').val(data.data.share_payable);
                            $('#issued_share_capital').val(data.data.issued_share_capital);
                            $('#number_of_shares').val(data.data.number_of_shares);
                            $('#paid_up').val(data.data.paid_up);
                            $('#financial_year_end').val(data.data.financial_year_end);
                            $('#transaction_number').val(data.data.transaction_number);
                            $('#related_entities').val(data.data.related_entities);
                            $('#more_about_you_objectives').val(data.data.more_about_you_objectives);
                            $('#more_about_you_hear_about_us').val(data.data.more_about_you_hear_about_us);
                            $('#registered_office_address_line_1').val(data.data.registered_office_address_line_1);
                            $('#registered_office_address_line_2').val(data.data.registered_office_address_line_2);
                            $('#registered_office_postal_code').val(data.data.registered_office_postal_code);
                            $('#registered_office_country').val(data.data.registered_office_country);
                            $('#business_operations_address_line_1').val(data.data.business_operations_address_line_1);
                            $('#business_operations_postal_code').val(data.data.business_operations_postal_code);
                            $('#business_operations_country').val(data.data.business_operations_country);
                            $('#nominee_duration').val(data.data.nominee_duration);

                            // Selected dropdowns
                            $('#company_suffix').val(data.data.company_suffix);
                            $('#primary_company_activity').val(data.data.primary_company_activity);
                            $('#secondary_company_activity').val(data.data.secondary_company_activity);
                            $('#share_capital_currency').val(data.data.share_capital_currency);
                            $('#company_activity').val(data.data.company_activity); // Assuming this exists
                            $('#country').val(data.data.country); // Assuming this exists

                            // Multiselect field
                            if (data.data.source_of_funds_three_countries) {
                                $('#source_of_funds_three_countries').val(data.data.source_of_funds_three_countries.split(','));
                            }

                            // Checkboxes
                            $('#cryptocurrency_declaration').prop('checked', data.data.cryptocurrency_declaration === 'Yes');
                            $('#accepts_payments').prop('checked', data.data.accepts_payments === 'Yes');
                            $('#provides_services').prop('checked', data.data.provides_services === 'Yes');
                            $('#manages_coins').prop('checked', data.data.manages_coins === 'Yes');
                            $('#agree_terms_conditions').prop('checked', data.data.agree_terms_conditions === '1');

                            // Multiselect checkboxes
                            if (data.data.source_of_funds_interest_reason) {
                                let interestReasonArray = data.data.source_of_funds_interest_reason.split(',');
                                interestReasonArray.forEach(function(value) {
                                    $('input[name="interest_reason[]"][value="' + value.trim() + '"]').prop('checked', true);
                                });
                            }

                            if (data.data.more_about_you_hear_about_us) {
                                let aboutasArray = data.data.more_about_you_hear_about_us.split(',');
                                aboutasArray.forEach(function(value) {
                                    $('input[name="hear_about_us[]"][value="' + value.trim() + '"]').prop('checked', true);
                                });
                            }

                            if (data.data.more_about_you_objectives) {
                                let aboutobjectiveArray = data.data.more_about_you_objectives.split(',');
                                aboutobjectiveArray.forEach(function(value) {
                                    $('input[name="objectives[]"][value="' + value.trim() + '"]').prop('checked', true);
                                });
                            }


                            if (data.data.source_of_funds_sources) {
                                let sourcesArray = data.data.source_of_funds_sources.split(',');
                                sourcesArray.forEach(function(value) {
                                    $('input[name="sources[]"][value="' + value.trim() + '"]').prop('checked', true);
                                });
                            }

                            // Radio inputs
                            $('input[name="cryptocurrency_declaration"][value="' + data.data.cryptocurrency_declaration + '"]').prop('checked', true);
                            $('input[name="mas_license"][value="' + data.data.mas_license + '"]').prop('checked', true);
                            $('input[name="option1"][value="' + data.data.option_selected + '"]').prop('checked', true);
                            $('input[name="option2"][value="' + data.data.option_selected + '"]').prop('checked', true);
                    } else {
                        console.log('Error:', data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                }
            });
        });
    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST
    print_r($_POST);

        $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
        $company_suffix = isset($_POST['company_suffix']) ? $_POST['company_suffix'] : '';
        $uen =  '';
        $company_type = isset($_POST['company_type']) ? $_POST['company_type'] : '';
        $registered_address = isset($_POST['our_registered_address_is_at_240/year']) ? $_POST['our_registered_address_is_at_240/year'] : '';
        $describe_company_activity = isset($_POST['describe_company_activity']) ? $_POST['describe_company_activity'] : '';
        $primary_company_activity = isset($_POST['primary_company_activity']) ? $_POST['primary_company_activity'] : '';
        $secondary_company_activity = isset($_POST['secondary_company_activity']) ? $_POST['secondary_company_activity'] : '';
        $business_description = isset($_POST['business_description']) ? $_POST['business_description'] : '';
        $share_capital_currency = isset($_POST['share_capital_currency']) ? $_POST['share_capital_currency'] : '';
        $share_payable = 'In cash';
        $issued_share_capital = isset($_POST['issued_share_capital']) ? (int) $_POST['issued_share_capital'] : 0;
        $number_of_shares = isset($_POST['number_of_shares']) ? (int) $_POST['number_of_shares'] : 0;
        $paid_up = 0;
        $financial_year_end = isset($_POST['financial_year_end']) ? $_POST['financial_year_end'] : '';
        $transaction_number = '';
        $cryptocurrency_declaration = isset($_POST['cryptocurrency_declaration']) ? $_POST['cryptocurrency_declaration'] : '';
        $accepts_payments = isset($_POST['accepts_payments']) ? $_POST['accepts_payments'] : '';
        $provides_services = isset($_POST['provides_services']) ? $_POST['provides_services'] : '';
        $manages_coins = isset($_POST['manages_coins']) ? $_POST['manages_coins'] : '';
        $mas_license = isset($_POST['mas_license']) ? $_POST['mas_license'] : '';
        $related_entities = isset($_POST['related_entities']) ? $_POST['related_entities'] : '';
        $source_of_funds_interest_reason = isset($_POST['interest_reason']) ? implode(',', $_POST['interest_reason']) : '';
        $source_of_funds_sources = isset($_POST['sources']) ? implode(',', $_POST['sources']) : '';
        $source_of_funds_three_countries = isset($_POST['   ']) ? $_POST['three_countries'] : '';
        $more_about_you_objectives = isset($_POST['objectives']) ? implode(',', $_POST['objectives']) : '';
        $more_about_you_hear_about_us = isset($_POST['hear_about_us']) ? implode(',', $_POST['hear_about_us']) : '';
        $registered_office_address_line_1 = isset($_POST['address_line_1']) ? $_POST['address_line_1'] : '';
        $registered_office_address_line_2 = isset($_POST['address_line_2']) ? $_POST['address_line_2'] : '';
        //$registered_office_address_line_other = isset($_POST['address_line_other']) ? $_POST['address_line_other'] : '';
        $registered_office_postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
        $registered_office_country = isset($_POST['country']) ? $_POST['country'] : '';
        $business_operations_address_line_1 = isset($_POST['business_operations_address_line_1']) ? $_POST['business_operations_address_line_1'] : '';
        $business_operations_postal_code = isset($_POST['business_operations_postal_code']) ? $_POST['business_operations_postal_code'] : '';
        $business_operations_country = isset($_POST['business_operations_country']) ? $_POST['business_operations_country'] : '';
        $operates_physical_store = isset($_POST['operates_physical_store']) ? $_POST['operates_physical_store'] : '';
        $option_selected = isset($_POST['step_2_options']) ? $_POST['step_2_options'] : '';
        $director_name = isset($_POST['director_name']) ? $_POST['director_name'] : '';
        $director_email = isset($_POST['director_email']) ? $_POST['director_email'] : '';
        $director_country = isset($_POST['director_country']) ? $_POST['director_country'] : '';
        $director_address = isset($_POST['director_address']) ? $_POST['director_address'] : '';
        $director_postal_code = isset($_POST['director_postal_code']) ? $_POST['director_postal_code'] : '';
        $director_activity = isset($_POST['director_activity']) ? $_POST['director_activity'] : '';
        $director_has_store = isset($_POST['director_has_store']) ? $_POST['director_has_store'] : '';
        $shareholder_name = isset($_POST['shareholder_name']) ? $_POST['shareholder_name'] : '';
        $shareholder_email = isset($_POST['shareholder_email']) ? $_POST['shareholder_email'] : '';
        $shareholder_country = isset($_POST['shareholder_country']) ? $_POST['shareholder_country'] : '';
        $nominee_duration = isset($_POST['nominee_duration']) ? $_POST['nominee_duration'] : '';
        $with_accounting_plan = isset($_POST['with_accounting_plan']) ? 1 : 0;
        $with_security_deposit = isset($_POST['with_security_deposit']) ? 1 : 0;
        $agree_terms_conditions = isset($_POST['agree_terms_conditions']) ? 1 : 0;


    // Example of a simple query to update the company information
    $sql = "UPDATE register_company SET
            company_name = '$company_name',
            user_id = '$logged_user_id',
            company_suffix = '$company_suffix',
            uen = '$uen',
            company_type = '$company_type',
            registered_address = '$registered_address',
            describe_company_activity = '$describe_company_activity',
            primary_company_activity = '$primary_company_activity',
            secondary_company_activity = '$secondary_company_activity',
            business_description = '$business_description',
            share_capital_currency = '$share_capital_currency',
            share_payable = '$share_payable',
            issued_share_capital = '$issued_share_capital',
            number_of_shares = '$number_of_shares',
            paid_up = '$paid_up',
            financial_year_end = '$financial_year_end',
            transaction_number = '$transaction_number',
            cryptocurrency_declaration = '$cryptocurrency_declaration',
            accepts_payments = '$accepts_payments',
            provides_services = '$provides_services',
            manages_coins = '$manages_coins',
            mas_license = '$mas_license',
            related_entities = '$related_entities',
            source_of_funds_interest_reason = '$source_of_funds_interest_reason',
            source_of_funds_sources = '$source_of_funds_sources',
            source_of_funds_three_countries = '$source_of_funds_three_countries',
            more_about_you_objectives = '$more_about_you_objectives',
            more_about_you_hear_about_us = '$more_about_you_hear_about_us',
            registered_office_address_line_1 = '$registered_office_address_line_1',
            registered_office_address_line_2 = '$registered_office_address_line_2',
            registered_office_postal_code = '$registered_office_postal_code',
            registered_office_country = '$registered_office_country',
            business_operations_address_line_1 = '$business_operations_address_line_1',
            business_operations_postal_code = '$business_operations_postal_code',
            business_operations_country = '$business_operations_country',
            operates_physical_store = '$operates_physical_store',
            option_selected = '$option_selected',
            nominee_duration = '$nominee_duration',
            with_accounting_plan = '$with_accounting_plan',
            with_security_deposit = '$with_security_deposit'
        WHERE id = '$company_id'";

    if (mysqli_query($link, $sql)) {
        echo "<script>
                    swal.fire({
                        text: 'Company register Data Not Add Successfully!',
                        type: 'Alert',
                        icon: 'Alert',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Okay'
                    }).then(function(isConfirm) {
                     window.location.href = baseUrl + 'internal-staff';
                    });
                  </script>";
    } else {
        echo "<script>
                    swal.fire({
                        text: 'Company register Data Not Add Successfully!',
                        type: 'Alert',
                        icon: 'Alert',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Okay'
                    }).then(function(isConfirm) {
                
                    });
                  </script>";
    }
}

?>

<?php
// require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Select2 CSS -->



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
    <div class="loader"></div>
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
                    <li class="breadcrumb-item"><a href="../">Home</a></li>
                    <li class="breadcrumb-item">Register Company</li>
                    <li class="breadcrumb-item active" aria-current="page">New Company Registration</li>
                  </ol>
                </nav>
                <section class="section">
                    <div class="section-body">

                        <div class="row clearfix">
                            <div class="col-12">
                                <h5>REGISTER COMPANY</h5>

                                <form id="wizard_with_validation" method="POST" action="payment_start.php">

                                    <!-- Steps -->
                                    <h3>Company Info</h3>


                                    <!-- Form - Step 1 -->
                                    <fieldset>
                                        <!-- Let's get started & Good to Know -->
                                        <p class="fw-bold mb-0 font-18 text-black" style="padding: 1.5rem .5rem 0rem .5rem;">Let's get started</p>


                                        <!-- Company Name Checker -->
                                        <div class="formm">
                                            <div class="form-line">
                                                <h6 class="mb-0">Company name checker</h6>
                                                <label class="form-label">Company name <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-sm-7 col-9">
                                                        <div class="form-group form-float">
                                                            <input type="text" class="form-control" name="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-3">
                                                        <select class="form-select" name="company_suffix" id="company_suffix">
                                                            <option selected disabled hidden>Company Suffix</option>
                                                            <option> Pte. Ltd.</option>
                                                            <option> Private Limited</option>
                                                            <option> Law Corporation</option>
                                                            <option> LLC</option>
                                                            <option> PAC</option>
                                                            <option> Private Ltd.</option>
                                                            <option> Pte. Limited</option>
                                                            <option> Public Accounting Corporation</option>
                                                            <option> Sdn. Berhad</option>
                                                            <option> Sdn. Bhd.</option>
                                                            <option> Sendirian Berhad</option>
                                                            <option> Sendirian Bhd.</option>
                                                            <option> (Law Corporation)</option>
                                                            <option> (LLC)</option>
                                                            <option> (PAC)</option>
                                                            <option> (Private Limited)</option>
                                                            <option> (Private Ltd.)</option>
                                                            <option> (Private) Limited</option>
                                                            <option> (Private) Ltd.</option>
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
                                                    <div class="col-md-12 col-6">
                                                        <label class="form-label">Company type <span style="color: red;">*</span></label>

                                                        <div class="form-group form-float">
                                                            <select class="form-select select2" name="company_type">
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


                                                    <div class="col-md-12 col-12">

                                                        <!-- Company activity -->
                                                        <label class="form-label">Primary Company activity <span style="color: red;">*</span></label>
                                                        <div class="form-group form-float">
                                                            <select class="form-select select2" name="primary_company_activity" id="primary_company_activity">
                                                                <option selected hidden disabled>Select activity</option>
                                                                <?php
                                                                require_once 'db.php';
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
                                                            <select class="form-select select2" name="secondary_company_activity" id="secondary_company_activity">
                                                                <option selected hidden disabled>Select activity</option>
                                                                <?php
                                                                require_once 'db.php';
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
                                                            <textarea name="business_description" id="business_description" rows="3" placeholder="Write here..."></textarea>

                                                        </div>
                                                    </div>
                                                    <!-- Please describe your business -->

                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label">Share capital currency <span style="color: red;">*</span></label>
                                                    <div class="form-group form-float">
                                                        <select class="form-select select2" name="share_capital_currency">
                                                            <option selected hidden disabled>Select currency</option>
                                                            <?php
                                                            require_once 'db.php';

                                                            // Modify the SQL query to order the results by the country name
                                                            $sql = mysqli_query($link, 'SELECT * FROM currency ORDER BY cur_code ASC');

                                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                                echo '<option value="' . $row['cur_code'] . '">' . $row['cur_code'] . ' - ' . $row['cure_name'] . '</option>';
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12" hidden>
                                                    <label class="form-label">Shares payable</label>
                                                    <div class="form-group form-float">

                                                        <input type="text" name="share_payable" class="form-control" id="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div style="display: flex;">

                                                        <label class="form-label">Issued share capital <span style="color: red;">*</span></label>
                                                        <div class="info-icon" style="margin-left: 5px; margin-top: 5px;">
                                                            <i class="fas fa-info-circle"></i>
                                                            <div class="tooltip">State the total value of the shares of the company</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">

                                                        <input type="number" name="issued_share_capital" class="form-control" id="issued_share_capital">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label">Number of shares <span style="color: red;">*</span></label>
                                                    <div class="form-group form-float">

                                                        <input type="number" name="number_of_shares" class="form-control" id="number_of_shares">
                                                    </div>
                                                </div>
                                                <div style="display: none;" class="col-md-12 col-12">
                                                    <label class="form-label">Paid up</label>
                                                    <div class="form-group form-float">

                                                        <input disabled type="number" name="paid_up" class="form-control" id="paid_up" value="0">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        <label for="financial_year_end" class="form-label">Financial Year End <span style="color: red;">*</span></label>
                                                        <div class="form-group form-float">
                                                            <input type="date" name="financial_year_end" class="form-control" id="financial_year_end" require>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Radio -->
                                                    <div class="form-group mb-4 pb-3" id="crypto-declaration">
                                                        <h6 class="mb-0">Cryptocurrency Declaration<span style="color: red;">*</span></h6>
                                                        <p style="margin-bottom: 2px;">Is your business involved in cryptocurrency?</p>
                                                        <div class="d-flex gap-3">
                                                            <div class="pretty p-default p-curve">
                                                                <input type="radio" name="cryptocurrency_declaration" value="No" />
                                                                <div class="state p-danger-o">
                                                                    <label>No</label>
                                                                </div>
                                                            </div>
                                                            <div class="pretty p-default p-curve">
                                                                <input type="radio" name="cryptocurrency_declaration" value="Yes" />
                                                                <div class="state p-success-o">
                                                                    <label>Yes</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="additional-questions" style="display: none;">
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
                                            </div>
                                        </div>

                                        <!-- Source of funds -->
                                        <div class="formm">
                                            <div class="form-line">
                                                <h6 class="mb-0">Source of funds<span style="color: red;">*</span></h6>
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

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <h6 class="text-black-50">3 Please list up to 3 countries where your business will take place.<span style="color: red;">*</span></h6>
                                                            <div class="col-md-5">
                                                                <select class="form-select countries" id="three_countries" name="three_countries" multiple>
                                                                    <!-- select come from js below -->
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
                                                <h6 class="mb-0">More about you<span style="color: red;">*</span></h6>
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
                                                            <label class="form-label">Address Type<span style="color: red;">*</span></label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" name="address_type_td">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                            </div>
                                                            <!-- Postal Code -->
                                                            <label class="form-label">Postal Code<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="postal_code_td">
                                                            </div>
                                                            <label class="form-label">Country<span style="color: red;">*</span></label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select countries" name="country_td">
                                                                    <!--countries-->
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <!-- Address Line 1 -->
                                                            <label class="form-label">Address Line 1<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="td_address_line_1">
                                                            </div>
                                                            <label class="form-label">Address Line 2<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="td_address_line_2">
                                                            </div>
                                                            <!-- Country -->

                                                        </div>

                                                        <!-- Radio -->
                                                        <div class="form-group mt-3">
                                                            <h6>Do you operate a physical store?<span style="color: red;">*</span></h6>
                                                            <div class="d-flex gap-3">
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store_td" value="Yes" />
                                                                    <div class="state p-success-o">
                                                                        <label>Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store_td" value="No" />
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

                                        <!-- Option 2 Content -->
                                        <!-- Option 2 Content -->
                                        <div class="content" id="option2Form" style="display:none;">
                                            <!-- Registered office address -->
                                            <div class="formm">
                                                <div class="form-line">
                                                    <div class="form-group">
                                                        <h6 class="mb-0">Registered office address</h6>
                                                        <p>Incorporating a company in Singapore requires a physical office address, P.O. box addresses are not allowed. This address will appear in your company's business profile.</p>
                                                    </div>

                                                    <!-- Registered Office Address Fields -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Address Type<span style="color: red;">*</span></label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" id="registered_address_type" name="address_type_owa">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                            </div>
                                                            <label class="form-label">Postal Code<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="registered_postal_code" name="postal_code_owa">
                                                            </div>
                                                            <label class="form-label">Country<span style="color: red;">*</span></label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select countries" id="registered_country" name="country_owa">

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Address Line 1<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="registered_address_line_1" name="owa_address_line_1">
                                                            </div>
                                                            <label class="form-label">Address Line 2<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="registered_address_line_2" name="owa_address_line_2">
                                                            </div>

                                                        </div>

                                                        <!-- Checkbox -->
                                                        <div class="form-group">
                                                            <div class="pretty p-default">
                                                                <input type="checkbox" id="business_operations_address" />
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

                                                    <!-- Business Operations Address Fields -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Address Type<span style="color: red;">*</span></label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select" id="business_address_type" name="address_type_owa1">
                                                                    <option selected disabled>Select Option</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                            </div>
                                                            <label class="form-label">Postal Code<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="business_postal_code" name="postal_code_owa1">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Address Line 1<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="business_address_line_1" name="owa1_address_line_1">
                                                            </div>
                                                            <label class="form-label">Address Line 2<span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="business_address_line_2" name="owa1_address_line_2">
                                                            </div>
                                                            <label class="form-label">Country<span style="color: red;">*</span></label>
                                                            <div class="form-group form-float">
                                                                <select class="form-select countries" id="business_country" name="country_owa1">

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Radio -->
                                                        <div class="form-group mt-3">
                                                            <h6>Do you operate a physical store?<span style="color: red;">*</span></h6>
                                                            <div class="d-flex gap-3">
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store_own1" value="Yes" />
                                                                    <div class="state p-success-o">
                                                                        <label>Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="pretty p-default p-curve">
                                                                    <input type="radio" name="physical_store_own1" value="No" />
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
                                        <div class="form-group">
                                            <label class="form-label" for="agree_terms_conditions">Agree to Terms & Conditions:</label>
                                            <input class="form-checkbox" type="checkbox" id="agree_terms_conditions" name="agree_terms_conditions" class="form-control">
                                            <br>
                                        </div>
                                    </fieldset>
                                    <a href="#finish" role="finish" class="btn btn-outline-primary finish"> Finish</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('.select2').select2({
                placeholder: "Select Company Type",
                allowClear: false
            });
        });
    </script>


    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/page/form-wizard.js"></script>
    <script src="../assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <script src="../assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>
    <script>
        $(document).ready(function() {
            $('.countries').siblings().remove();

            // List of countries with corresponding SSIC codes (example codes provided)
            let countries = [{
                    name: 'Afghanistan',
                    ssic: 'A001'
                },
                {
                    name: 'Albania',
                    ssic: 'A002'
                },
                {
                    name: 'Algeria',
                    ssic: 'A003'
                },
                {
                    name: 'Andorra',
                    ssic: 'A004'
                },
                {
                    name: 'Angola',
                    ssic: 'A005'
                },
                {
                    name: 'Antigua and Barbuda',
                    ssic: 'A006'
                },
                {
                    name: 'Argentina',
                    ssic: 'A007'
                },
                {
                    name: 'Armenia',
                    ssic: 'A008'
                },
                {
                    name: 'Australia',
                    ssic: 'A009'
                },
                {
                    name: 'Austria',
                    ssic: 'A010'
                },
                {
                    name: 'Azerbaijan',
                    ssic: 'A011'
                },
                {
                    name: 'Bahamas',
                    ssic: 'A012'
                },
                {
                    name: 'Bahrain',
                    ssic: 'A013'
                },
                {
                    name: 'Bangladesh',
                    ssic: 'A014'
                },
                {
                    name: 'Barbados',
                    ssic: 'A015'
                },
                {
                    name: 'Belarus',
                    ssic: 'A016'
                },
                {
                    name: 'Belgium',
                    ssic: 'A017'
                },
                {
                    name: 'Belize',
                    ssic: 'A018'
                },
                {
                    name: 'Benin',
                    ssic: 'A019'
                },
                {
                    name: 'Bhutan',
                    ssic: 'A020'
                },
                {
                    name: 'Bolivia',
                    ssic: 'A021'
                },
                {
                    name: 'Bosnia and Herzegovina',
                    ssic: 'A022'
                },
                {
                    name: 'Botswana',
                    ssic: 'A023'
                },
                {
                    name: 'Brazil',
                    ssic: 'A024'
                },
                {
                    name: 'Brunei',
                    ssic: 'A025'
                },
                {
                    name: 'Bulgaria',
                    ssic: 'A026'
                },
                {
                    name: 'Burkina Faso',
                    ssic: 'A027'
                },
                {
                    name: 'Burundi',
                    ssic: 'A028'
                },
                {
                    name: 'Cabo Verde',
                    ssic: 'A029'
                },
                {
                    name: 'Cambodia',
                    ssic: 'A030'
                },
                {
                    name: 'Cameroon',
                    ssic: 'A031'
                },
                {
                    name: 'Canada',
                    ssic: 'A032'
                },
                {
                    name: 'Central African Republic',
                    ssic: 'A033'
                },
                {
                    name: 'Chad',
                    ssic: 'A034'
                },
                {
                    name: 'Chile',
                    ssic: 'A035'
                },
                {
                    name: 'China',
                    ssic: 'A036'
                },
                {
                    name: 'Colombia',
                    ssic: 'A037'
                },
                {
                    name: 'Comoros',
                    ssic: 'A038'
                },
                {
                    name: 'Congo, Democratic Republic of the',
                    ssic: 'A039'
                },
                {
                    name: 'Congo, Republic of the',
                    ssic: 'A040'
                },
                {
                    name: 'Costa Rica',
                    ssic: 'A041'
                },
                {
                    name: 'Cote d\'Ivoire',
                    ssic: 'A042'
                },
                {
                    name: 'Croatia',
                    ssic: 'A043'
                },
                {
                    name: 'Cuba',
                    ssic: 'A044'
                },
                {
                    name: 'Cyprus',
                    ssic: 'A045'
                },
                {
                    name: 'Czech Republic',
                    ssic: 'A046'
                },
                {
                    name: 'Denmark',
                    ssic: 'A047'
                },
                {
                    name: 'Djibouti',
                    ssic: 'A048'
                },
                {
                    name: 'Dominica',
                    ssic: 'A049'
                },
                {
                    name: 'Dominican Republic',
                    ssic: 'A050'
                },
                {
                    name: 'Ecuador',
                    ssic: 'A051'
                },
                {
                    name: 'Egypt',
                    ssic: 'A052'
                },
                {
                    name: 'El Salvador',
                    ssic: 'A053'
                },
                {
                    name: 'Equatorial Guinea',
                    ssic: 'A054'
                },
                {
                    name: 'Eritrea',
                    ssic: 'A055'
                },
                {
                    name: 'Estonia',
                    ssic: 'A056'
                },
                {
                    name: 'Eswatini',
                    ssic: 'A057'
                },
                {
                    name: 'Ethiopia',
                    ssic: 'A058'
                },
                {
                    name: 'Fiji',
                    ssic: 'A059'
                },
                {
                    name: 'Finland',
                    ssic: 'A060'
                },
                {
                    name: 'France',
                    ssic: 'A061'
                },
                {
                    name: 'Gabon',
                    ssic: 'A062'
                },
                {
                    name: 'Gambia',
                    ssic: 'A063'
                },
                {
                    name: 'Georgia',
                    ssic: 'A064'
                },
                {
                    name: 'Germany',
                    ssic: 'A065'
                },
                {
                    name: 'Ghana',
                    ssic: 'A066'
                },
                {
                    name: 'Greece',
                    ssic: 'A067'
                },
                {
                    name: 'Grenada',
                    ssic: 'A068'
                },
                {
                    name: 'Guatemala',
                    ssic: 'A069'
                },
                {
                    name: 'Guinea',
                    ssic: 'A070'
                },
                {
                    name: 'Guinea-Bissau',
                    ssic: 'A071'
                },
                {
                    name: 'Guyana',
                    ssic: 'A072'
                },
                {
                    name: 'Haiti',
                    ssic: 'A073'
                },
                {
                    name: 'Honduras',
                    ssic: 'A074'
                },
                {
                    name: 'Hungary',
                    ssic: 'A075'
                },
                {
                    name: 'Iceland',
                    ssic: 'A076'
                },
                {
                    name: 'India',
                    ssic: 'A077'
                },
                {
                    name: 'Indonesia',
                    ssic: 'A078'
                },
                {
                    name: 'Iran',
                    ssic: 'A079'
                },
                {
                    name: 'Iraq',
                    ssic: 'A080'
                },
                {
                    name: 'Ireland',
                    ssic: 'A081'
                },
                {
                    name: 'Israel',
                    ssic: 'A082'
                },
                {
                    name: 'Italy',
                    ssic: 'A083'
                },
                {
                    name: 'Jamaica',
                    ssic: 'A084'
                },
                {
                    name: 'Japan',
                    ssic: 'A085'
                },
                {
                    name: 'Jordan',
                    ssic: 'A086'
                },
                {
                    name: 'Kazakhstan',
                    ssic: 'A087'
                },
                {
                    name: 'Kenya',
                    ssic: 'A088'
                },
                {
                    name: 'Kiribati',
                    ssic: 'A089'
                },
                {
                    name: 'Kuwait',
                    ssic: 'A090'
                },
                {
                    name: 'Kyrgyzstan',
                    ssic: 'A091'
                },
                {
                    name: 'Laos',
                    ssic: 'A092'
                },
                {
                    name: 'Latvia',
                    ssic: 'A093'
                },
                {
                    name: 'Lebanon',
                    ssic: 'A094'
                },
                {
                    name: 'Lesotho',
                    ssic: 'A095'
                },
                {
                    name: 'Liberia',
                    ssic: 'A096'
                },
                {
                    name: 'Libya',
                    ssic: 'A097'
                },
                {
                    name: 'Liechtenstein',
                    ssic: 'A098'
                },
                {
                    name: 'Lithuania',
                    ssic: 'A099'
                },
                {
                    name: 'Luxembourg',
                    ssic: 'A100'
                },
                {
                    name: 'Madagascar',
                    ssic: 'A101'
                },
                {
                    name: 'Malawi',
                    ssic: 'A102'
                },
                {
                    name: 'Malaysia',
                    ssic: 'A103'
                },
                {
                    name: 'Maldives',
                    ssic: 'A104'
                },
                {
                    name: 'Mali',
                    ssic: 'A105'
                },
                {
                    name: 'Malta',
                    ssic: 'A106'
                },
                {
                    name: 'Marshall Islands',
                    ssic: 'A107'
                },
                {
                    name: 'Mauritania',
                    ssic: 'A108'
                },
                {
                    name: 'Mauritius',
                    ssic: 'A109'
                },
                {
                    name: 'Mexico',
                    ssic: 'A110'
                },
                {
                    name: 'Micronesia',
                    ssic: 'A111'
                },
                {
                    name: 'Moldova',
                    ssic: 'A112'
                },
                {
                    name: 'Monaco',
                    ssic: 'A113'
                },
                {
                    name: 'Mongolia',
                    ssic: 'A114'
                },
                {
                    name: 'Montenegro',
                    ssic: 'A115'
                },
                {
                    name: 'Morocco',
                    ssic: 'A116'
                },
                {
                    name: 'Mozambique',
                    ssic: 'A117'
                },
                {
                    name: 'Myanmar',
                    ssic: 'A118'
                },
                {
                    name: 'Namibia',
                    ssic: 'A119'
                },
                {
                    name: 'Nauru',
                    ssic: 'A120'
                },
                {
                    name: 'Nepal',
                    ssic: 'A121'
                },
                {
                    name: 'Netherlands',
                    ssic: 'A122'
                },
                {
                    name: 'New Zealand',
                    ssic: 'A123'
                },
                {
                    name: 'Nicaragua',
                    ssic: 'A124'
                },
                {
                    name: 'Niger',
                    ssic: 'A125'
                },
                {
                    name: 'Nigeria',
                    ssic: 'A126'
                },
                {
                    name: 'North Korea',
                    ssic: 'A127'
                },
                {
                    name: 'North Macedonia',
                    ssic: 'A128'
                },
                {
                    name: 'Norway',
                    ssic: 'A129'
                },
                {
                    name: 'Oman',
                    ssic: 'A130'
                },
                {
                    name: 'Pakistan',
                    ssic: 'A131'
                },
                {
                    name: 'Palau',
                    ssic: 'A132'
                },
                {
                    name: 'Panama',
                    ssic: 'A133'
                },
                {
                    name: 'Papua New Guinea',
                    ssic: 'A134'
                },
                {
                    name: 'Paraguay',
                    ssic: 'A135'
                },
                {
                    name: 'Peru',
                    ssic: 'A136'
                },
                {
                    name: 'Philippines',
                    ssic: 'A137'
                },
                {
                    name: 'Poland',
                    ssic: 'A138'
                },
                {
                    name: 'Portugal',
                    ssic: 'A139'
                },
                {
                    name: 'Qatar',
                    ssic: 'A140'
                },
                {
                    name: 'Romania',
                    ssic: 'A141'
                },
                {
                    name: 'Russia',
                    ssic: 'A142'
                },
                {
                    name: 'Rwanda',
                    ssic: 'A143'
                },
                {
                    name: 'Saint Kitts and Nevis',
                    ssic: 'A144'
                },
                {
                    name: 'Saint Lucia',
                    ssic: 'A145'
                },
                {
                    name: 'Saint Vincent and the Grenadines',
                    ssic: 'A146'
                },
                {
                    name: 'Samoa',
                    ssic: 'A147'
                },
                {
                    name: 'San Marino',
                    ssic: 'A148'
                },
                {
                    name: 'Sao Tome and Principe',
                    ssic: 'A149'
                },
                {
                    name: 'Saudi Arabia',
                    ssic: 'A150'
                },
                {
                    name: 'Senegal',
                    ssic: 'A151'
                },
                {
                    name: 'Serbia',
                    ssic: 'A152'
                },
                {
                    name: 'Seychelles',
                    ssic: 'A153'
                },
                {
                    name: 'Sierra Leone',
                    ssic: 'A154'
                },
                {
                    name: 'Singapore',
                    ssic: 'A155'
                },
                {
                    name: 'Slovakia',
                    ssic: 'A156'
                },
                {
                    name: 'Slovenia',
                    ssic: 'A157'
                },
                {
                    name: 'Solomon Islands',
                    ssic: 'A158'
                },
                {
                    name: 'Somalia',
                    ssic: 'A159'
                },
                {
                    name: 'South Africa',
                    ssic: 'A160'
                },
                {
                    name: 'South Korea',
                    ssic: 'A161'
                },
                {
                    name: 'South Sudan',
                    ssic: 'A162'
                },
                {
                    name: 'Spain',
                    ssic: 'A163'
                },
                {
                    name: 'Sri Lanka',
                    ssic: 'A164'
                },
                {
                    name: 'Sudan',
                    ssic: 'A165'
                },
                {
                    name: 'Suriname',
                    ssic: 'A166'
                },
                {
                    name: 'Sweden',
                    ssic: 'A167'
                },
                {
                    name: 'Switzerland',
                    ssic: 'A168'
                },
                {
                    name: 'Syria',
                    ssic: 'A169'
                },
                {
                    name: 'Taiwan',
                    ssic: 'A170'
                },
                {
                    name: 'Tajikistan',
                    ssic: 'A171'
                },
                {
                    name: 'Tanzania',
                    ssic: 'A172'
                },
                {
                    name: 'Thailand',
                    ssic: 'A173'
                },
                {
                    name: 'Timor-Leste',
                    ssic: 'A174'
                },
                {
                    name: 'Togo',
                    ssic: 'A175'
                },
                {
                    name: 'Tonga',
                    ssic: 'A176'
                },
                {
                    name: 'Trinidad and Tobago',
                    ssic: 'A177'
                },
                {
                    name: 'Tunisia',
                    ssic: 'A178'
                },
                {
                    name: 'Turkey',
                    ssic: 'A179'
                },
                {
                    name: 'Turkmenistan',
                    ssic: 'A180'
                },
                {
                    name: 'Tuvalu',
                    ssic: 'A181'
                },
                {
                    name: 'Uganda',
                    ssic: 'A182'
                },
                {
                    name: 'Ukraine',
                    ssic: 'A183'
                },
                {
                    name: 'United Arab Emirates',
                    ssic: 'A184'
                },
                {
                    name: 'United Kingdom',
                    ssic: 'A185'
                },
                {
                    name: 'United States',
                    ssic: 'A186'
                },
                {
                    name: 'Uruguay',
                    ssic: 'A187'
                },
                {
                    name: 'Uzbekistan',
                    ssic: 'A188'
                },
                {
                    name: 'Vanuatu',
                    ssic: 'A189'
                },
                {
                    name: 'Vatican City',
                    ssic: 'A190'
                },
                {
                    name: 'Venezuela',
                    ssic: 'A191'
                },
                {
                    name: 'Vietnam',
                    ssic: 'A192'
                },
                {
                    name: 'Yemen',
                    ssic: 'A193'
                },
                {
                    name: 'Zambia',
                    ssic: 'A194'
                },
                {
                    name: 'Zimbabwe',
                    ssic: 'A195'
                }
            ];


            let selectCountries = $('.countries');
            selectCountries.empty();
            selectCountries.append('<option selected disabled>Select Option</option>');

            countries.forEach(country => {
                selectCountries.append(`<option value="${country.ssic}">${country.name}</option>`);
            });

            new MultiSelectTag('three_countries');
        });
    </script>
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
    <script type="text/javascript">
    $(document).ready(function() {
        // Handle the click event for the "Finish" button
        $('a[href="#finish"].finish').on('click', function(event) {
            // Prevent default behavior
            event.preventDefault();

            let isValid = true;

            // Validation function for checkbox groups
            function validateCheckboxGroup(name, errorMessage) {
                const checkboxes = document.querySelectorAll(`input[name='${name}[]']`);
                if (!Array.from(checkboxes).some(checkbox => checkbox.checked)) {
                    alert(errorMessage);
                    return false;
                }
                return true;
            }

            // Validate objectives checkboxes
            isValid = validateCheckboxGroup('objectives', 'Please select at least one objective.') && isValid;

            // Check if 'Other' in objectives is selected and validate its textarea
            const otherObjectivesCheckbox = document.getElementById('other-objectives');
            const otherObjectivesDescription = document.getElementById('other-objectives-description');
            if (otherObjectivesCheckbox.checked && otherObjectivesDescription.value.trim() === '') {
                alert('Please specify your other objective.');
                isValid = false;
            }

            // Validate 'hear about us' checkboxes
            isValid = validateCheckboxGroup('hear_about_us', 'Please select at least one source for how you heard about us.') && isValid;

            // Check if 'Other' in 'hear about us' is selected and validate its textarea
            const otherHearAboutUsCheckbox = document.getElementById('other-hear-about-us');
            const otherHearAboutUsDescription = document.getElementById('other-hear-about-us-description');
            if (otherHearAboutUsCheckbox.checked && otherHearAboutUsDescription.value.trim() === '') {
                alert('Please specify how you heard about us.');
                isValid = false;
            }

            // Validate interest reason checkboxes
            isValid = validateCheckboxGroup('interest_reason', 'Please select at least one reason for interest in incorporating your business in Singapore.') && isValid;

            // Validate source of funds checkboxes
            isValid = validateCheckboxGroup('sources', 'Please select at least one source of funds.') && isValid;

            // Check if at least one country is selected
            const countriesSelect = document.getElementById('three_countries');
            if (countriesSelect.selectedOptions.length < 1) {
                alert('Please select at least one country where your business will take place.');
                isValid = false;
            }

            // Validate cryptocurrency declaration and related options
            const cryptoDeclarationRadios = document.getElementsByName('cryptocurrency_declaration');
            const masLicenseRadios = document.getElementsByName('mas_license');
            const relatedEntitiesRadios = document.getElementsByName('related_entities');

            if (![...cryptoDeclarationRadios].some(radio => radio.checked)) {
                alert('Please select if your business is involved in cryptocurrency.');
                isValid = false;
            } else if (document.querySelector('input[name="cryptocurrency_declaration"]:checked').value === 'Yes') {
                const checkboxes = ['accepts_payments', 'provides_services', 'manages_coins'];
                let isChecked = checkboxes.some(id => document.querySelector(`input[name="${id}"]`).checked);
                if (!isChecked) {
                    alert('Please select how your business is involved in cryptocurrency.');
                    isValid = false;
                }
            }

            if (![...masLicenseRadios].some(radio => radio.checked)) {
                alert('Please select if you are licensed or seeking a license from MAS.');
                isValid = false;
            }

            if (![...relatedEntitiesRadios].some(radio => radio.checked)) {
                alert('Please select if your business is related to any entities in the cryptocurrency industry.');
                isValid = false;
            }

            // Validate company details
            const requiredFields = [
                { name: 'company_name', type: 'input', message: 'Company name is required.' },
                { name: 'company_type', type: 'select', message: 'Company type is required.' },
                { name: 'primary_company_activity', type: 'select', message: 'Primary company activity is required.' },
                { name: 'share_capital_currency', type: 'select', message: 'Share capital currency is required.' },
                { name: 'issued_share_capital', type: 'input', message: 'Issued share capital is required.' },
                { name: 'number_of_shares', type: 'input', message: 'Number of shares is required.' },
                { name: 'financial_year_end', type: 'input', message: 'Financial year end is required.' }
            ];

            for (let field of requiredFields) {
                const element = $(`${field.type}[name="${field.name}"]`);
                if (element.val().trim() === '') {
                    element.addClass('is-invalid');
                    alert(field.message);
                    isValid = false;
                } else {
                    element.removeClass('is-invalid');
                }
            }

            // Validate address fields based on option selection
            if (document.getElementById('option2').checked) {
                const registeredAddressLine1 = document.getElementById('registered_address_line_1').value;
                const registeredAddressLine2 = document.getElementById('registered_address_line_2').value;
                const businessAddressLine1 = document.getElementById('business_address_line_1').value;
                const businessAddressLine2 = document.getElementById('business_address_line_2').value;

                if (!registeredAddressLine1 || !registeredAddressLine2 || !businessAddressLine1 || !businessAddressLine2) {
                    alert('Please fill in all the required registered office address fields before proceeding.');
                    isValid = false;
                }
            }
            
            if (document.getElementById('option1').checked) {
                const tdAddressline_1 = document.getElementById('td_address_line_1').value;
                const tdAddressline_2 = document.getElementById('td_address_line_2').value;

                 var addressType = document.getElementById('addressType').value;
                 var postalCode = document.getElementById('postalCode').value;
                 var country = document.getElementById('country').value;

                 // Check if any field is empty or not selected
                 if (addressType === 'Select Option' || !postalCode || country === '') {
                                event.preventDefault(); // Prevent form submission
                     alert('Please fill in all mandatory fields.');
                 }
                if (!tdAddressline_1 || !tdAddressline_2) {
                    alert('Please fill in all the required registered office address fields before proceeding.');
                    checkbox.checked = false; // Uncheck the checkbox if validation fails
                    return false;
                }
            }

            // If validation passes, submit the form
            if (isValid && $('#agree_terms_co').is(':checked')) {
                $('#wizard_with_validation').submit();
            } else if (!$('#agree_terms_conditions').is(':checked')) {
                alert('You must agree to the Terms & Conditions before submitting.');
            }
        });
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('business_operations_address');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Fetch values from registered office address fields
                    const registeredAddressType = document.getElementById('registered_address_type').value;
                    const registeredPostalCode = document.getElementById('registered_postal_code').value;
                    const registeredAddressLine1 = document.getElementById('registered_address_line_1').value;
                    const registeredAddressLine2 = document.getElementById('registered_address_line_2').value;
                    const registeredCountry = document.getElementById('registered_country').value;

                    // Check if any of the address fields are empty
                    if (!registeredAddressType || !registeredPostalCode || !registeredAddressLine1 || !registeredCountry) {
                        alert('Please fill in all the required registered office address fields before proceeding.');
                        checkbox.checked = false; // Uncheck the checkbox if validation fails
                        return;
                    }
                    // Set values to business operations address fields
                    document.getElementById('business_address_type').value = registeredAddressType;
                    document.getElementById('business_postal_code').value = registeredPostalCode;
                    document.getElementById('business_address_line_1').value = registeredAddressLine1;
                    document.getElementById('business_address_line_2').value = registeredAddressLine2;
                    document.getElementById('business_country').value = registeredCountry;
                }
            });
        });
    </script>


</body>

</html>

<?php

// Assuming form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST
    print_r($_POST);
    die();
    // Process $_POST data and set default values where necessary
    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
    $logged_user_id = $_SESSION['user_id'];

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
    $source_of_funds_three_countries = isset($_POST['three_countries']) ? $_POST['three_countries'] : '';
    $more_about_you_objectives = isset($_POST['objectives']) ? implode(',', $_POST['objectives']) : '';
    $more_about_you_hear_about_us = isset($_POST['hear_about_us']) ? implode(',', $_POST['hear_about_us']) : '';

    // For option1Form
    $address_line_1 = $_POST['tdr_address-line-1'] ?? '';
    $postal_code = $_POST['tdr_postal-code'] ?? '';
    $address_line_2 = $_POST['tdr_address-line-2'] ?? '';
    $country = $_POST['tdr_country'] ?? '';
    $address_type_td = $_POST['address_type_td'] ?? '';
    $postal_code_td = $_POST['postal_code_td'] ?? '';
    $td_address_line_1 = $_POST['td_address_line_1'] ?? '';
    $td_address_line_2 = $_POST['td_address_line_2'] ?? '';
    $country_td = $_POST['country_td'] ?? '';
    $physical_store_td = $_POST['physical_store_td'] ?? '';

    // For option2Form
    $address_type_owa = $_POST['address_type_owa'] ?? '';
    $postal_code_owa = $_POST['postal_code_owa'] ?? '';
    $owa_address_line_1 = $_POST['owa_address_line_1'] ?? '';
    $owa_address_line_2 = $_POST['owa_address_line_2'] ?? '';
    $country_owa = $_POST['country_owa'] ?? '';
    //$this_is_also_business_operations_address = $_POST['this_is_also_business_operations_address'] ?? '';
    $address_type_owa1 = $_POST['address_type_owa1'] ?? '';
    $postal_code_owa1 = $_POST['postal_code_owa1'] ?? '';
    $owa1_address_line_1 = $_POST['owa1_address_line_1'] ?? '';
    $owa1_address_line_2 = $_POST['owa1_address_line_2'] ?? '';
    $country_owa1 = $_POST['country_owa1'] ?? '';
    $physical_store_own1 = $_POST['physical_store_own1'] ?? '';


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


    // SQL query to insert data into register_company table
    $sql = "INSERT INTO register_company (
            company_name, user_id, company_suffix, uen, company_type, registered_address,
            describe_company_activity, primary_company_activity, secondary_company_activity, business_description,
            share_capital_currency, share_payable, issued_share_capital, number_of_shares, paid_up, financial_year_end,
            transaction_number, cryptocurrency_declaration, accepts_payments, provides_services, manages_coins,
            mas_license, related_entities, source_of_funds_interest_reason, source_of_funds_sources,
            source_of_funds_three_countries, more_about_you_objectives, more_about_you_hear_about_us, option_selected, nominee_duration, with_accounting_plan,
            with_security_deposit, company_current_status, agree_terms_conditions,
            address_line_1, postal_code, address_line_2, country, address_type_td, postal_code_td,
            td_address_line_1, td_address_line_2, country_td, physical_store_td,
            address_type_owa, postal_code_owa, owa_address_line_1, owa_address_line_2, country_owa,
            address_type_owa1, postal_code_owa1, owa1_address_line_1, owa1_address_line_2, country_owa1,
            physical_store_own1
        ) VALUES (
            '$company_name', '$logged_user_id', '$company_suffix', '$uen', '$company_type', '$registered_address',
            '$describe_company_activity', '$primary_company_activity', '$secondary_company_activity', '$business_description',
            '$share_capital_currency', '$share_payable', '$issued_share_capital', '$number_of_shares', '$paid_up', '$financial_year_end',
            '$transaction_number', '$cryptocurrency_declaration', '$accepts_payments', '$provides_services', '$manages_coins',
            '$mas_license', '$related_entities', '$source_of_funds_interest_reason', '$source_of_funds_sources',
            '$source_of_funds_three_countries', '$more_about_you_objectives', '$more_about_you_hear_about_us', '$option_selected', '$nominee_duration', '$with_accounting_plan',
            '$with_security_deposit', 'only_company_registered', '$agree_terms_conditions',
            '$address_line_1', '$postal_code', '$address_line_2', '$country', '$address_type_td', '$postal_code_td',
            '$td_address_line_1', '$td_address_line_2', '$country_td', '$physical_store_td',
            '$address_type_owa', '$postal_code_owa', '$owa_address_line_1', '$owa_address_line_2', '$country_owa',
            '$address_type_owa1', '$postal_code_owa1', '$owa1_address_line_1', '$owa1_address_line_2', '$country_owa1',
            '$physical_store_own1'
        )";




    if (mysqli_query($link, $sql)) {

        echo "<script>
                     window.location.href = baseUrl + 'incorporation/register-company/add_company_officer.php';
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


// Close connection
$link->close();
?>
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
    <title>Company Details - Tianlong Services Pte Ltd</title>
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

                <section class="section">
                    <div class="container mt-5">
                    <h2 class="mb-4">Company Registration Details</h2>

                    <?php if ($result->num_rows > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Company Name</th>
                                        <th>Company Suffix</th>
                                        <th>UEN</th>
                                        <th>Company Type</th>
                                        <th>Registered Address</th>
                                        <th>Describe Company Activity</th>
                                        <th>Primary Activity</th>
                                        <th>Secondary Activity</th>
                                        <th>Business Description</th>
                                        <th>Share Capital Currency</th>
                                        <th>Share Payable</th>
                                        <th>Issued Share Capital</th>
                                        <th>Number of Shares</th>
                                        <th>Paid Up</th>
                                        <th>Financial Year End</th>
                                        <th>Transaction Number</th>
                                        <th>Cryptocurrency Declaration</th>
                                        <th>Accepts Payments</th>
                                        <th>Provides Services</th>
                                        <th>Manages Coins</th>
                                        <th>MAS License</th>
                                        <th>Related Entities</th>
                                        <th>Source of Funds Interest Reason</th>
                                        <th>Source of Funds Sources</th>
                                        <th>Source of Funds Three Countries</th>
                                        <th>Objectives</th>
                                        <th>Hear About Us</th>
                                        <th>Option Selected</th>
                                        <th>Nominee Duration</th>
                                        <th>With Accounting Plan</th>
                                        <th>With Security Deposit</th>
                                        <th>Company Current Status</th>
                                        <th>Agree to Terms & Conditions</th>
                                        <th>All CDD KYC Sign Done</th>
                                        <th>Created At</th>
                                        <th>Address Line 1</th>
                                        <th>Postal Code</th>
                                        <th>Address Line 2</th>
                                        <th>Country</th>
                                        <!-- More fields here -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']); ?></td>
                                            <td><?= htmlspecialchars($row['user_id']); ?></td>
                                            <td><?= htmlspecialchars($row['company_name']); ?></td>
                                            <td><?= htmlspecialchars($row['company_suffix']); ?></td>
                                            <td><?= htmlspecialchars($row['uen']); ?></td>
                                            <td><?= htmlspecialchars($row['company_type']); ?></td>
                                            <td><?= htmlspecialchars($row['registered_address']); ?></td>
                                            <td><?= htmlspecialchars($row['describe_company_activity']); ?></td>
                                            <td><?= htmlspecialchars($row['primary_company_activity']); ?></td>
                                            <td><?= htmlspecialchars($row['secondary_company_activity']); ?></td>
                                            <td><?= htmlspecialchars($row['business_description']); ?></td>
                                            <td><?= htmlspecialchars($row['share_capital_currency']); ?></td>
                                            <td><?= htmlspecialchars($row['share_payable']); ?></td>
                                            <td><?= htmlspecialchars($row['issued_share_capital']); ?></td>
                                            <td><?= htmlspecialchars($row['number_of_shares']); ?></td>
                                            <td><?= htmlspecialchars($row['paid_up']); ?></td>
                                            <td><?= htmlspecialchars($row['financial_year_end']); ?></td>
                                            <td><?= htmlspecialchars($row['transaction_number']); ?></td>
                                            <td><?= htmlspecialchars($row['cryptocurrency_declaration']); ?></td>
                                            <td><?= htmlspecialchars($row['accepts_payments']); ?></td>
                                            <td><?= htmlspecialchars($row['provides_services']); ?></td>
                                            <td><?= htmlspecialchars($row['manages_coins']); ?></td>
                                            <td><?= htmlspecialchars($row['mas_license']); ?></td>
                                            <td><?= htmlspecialchars($row['related_entities']); ?></td>
                                            <td><?= htmlspecialchars($row['source_of_funds_interest_reason']); ?></td>
                                            <td><?= htmlspecialchars($row['source_of_funds_sources']); ?></td>
                                            <td><?= htmlspecialchars($row['source_of_funds_three_countries']); ?></td>
                                            <td><?= htmlspecialchars($row['more_about_you_objectives']); ?></td>
                                            <td><?= htmlspecialchars($row['more_about_you_hear_about_us']); ?></td>
                                            <td><?= htmlspecialchars($row['option_selected']); ?></td>
                                            <td><?= htmlspecialchars($row['nominee_duration']); ?></td>
                                            <td><?= htmlspecialchars($row['with_accounting_plan']); ?></td>
                                            <td><?= htmlspecialchars($row['with_security_deposit']); ?></td>
                                            <td><?= htmlspecialchars($row['company_current_status']); ?></td>
                                            <td><?= htmlspecialchars($row['agree_terms_conditions']); ?></td>
                                            <td><?= htmlspecialchars($row['all_cddkyc_sign_done']); ?></td>
                                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                                            <td><?= htmlspecialchars($row['address_line_1']); ?></td>
                                            <td><?= htmlspecialchars($row['postal_code']); ?></td>
                                            <td><?= htmlspecialchars($row['address_line_2']); ?></td>
                                            <td><?= htmlspecialchars($row['country']); ?></td>
                                            <!-- Add more fields here if needed -->
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-danger">No records found.</p>
                    <?php endif; ?>

                    <?php $link->close(); ?>
                </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="d-md-flex gap-3">
                                            <p class="fw-bold mb-2 font-20 text-black">Company:
                                                <span class="fw-normal mb-2 font-20 text-black-50">Tianlong Services Pte Ltd</span>
                                            </p>
                                            <div>
                                                <h5 class="badge btn-warning shadow-none font-15 mb-0">Directors Sign Pending</h5>
                                                <!-- <h5 class="badge btn-warning shadow-none font-15">Shareholders Sign Pending</h5>
                                                <h5 class="badge btn-warning shadow-none font-15">Secretary Sign Pending</h5>
                                                <h5 class="badge btn-warning shadow-none font-15">CCD KYC Pending</h5>
                                                <h5 class="badge btn-warning shadow-none font-15">Pending</h5>
                                                <h5 class="badge btn-success shadow-none font-15">Completed</h5> -->
                                            </div>
                                        </div>

                                        <hr style="margin: .7rem 0;">

                                        <div class="row">
                                            <div class="form-group" style="margin-top: 15px;">
                                                <p class="fw-bold mb-0 font-20 text-black">DOCUMENT SIGN</p>
                                            </div>
                                            <br>
                                            <!-- Directors -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="text-center heading">
                                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Directors</span>
                                                            </div>
                                                            <hr style="margin: .7rem 0;">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-warning shadow-none">Pending</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Shareholders -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="text-center heading">
                                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Shareholders</span>
                                                            </div>
                                                            <hr style="margin: .7rem 0;">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Secretary -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="text-center heading">
                                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Secretary</span>
                                                            </div>
                                                            <hr style="margin: .7rem 0;">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45B</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45B</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="text-end">
                                                                    <a href="#" class="btn btn-primary">Sign Now</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="row">
                                            <!-- CDD KYC -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-0 font-20 text-black">CDD KYC</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Completed</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Incorporation -->
                                            <div class="col-md-4">
                                                <!-- <div class="form-group"> -->
                                                <div class="row">
                                                    <div class="col-md-10 side_line">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <p class="fw-bold mb-0 font-20 text-black">INCORPORATION</p>
                                                            </div>
                                                            <div class="col-5 text-end">
                                                                <span class="badge btn-warning shadow-none">Pending</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
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
    <script src="../assets/bundles/echart/echarts.js"></script>
    <script src="../assets/bundles/chartjs/chart.min.js"></script>
    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/page/footable-data.js"></script>
    <script src="../assets/bundles/footable-bootstrap/js/footable.js"></script>
</body>

</html>
<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
?>
<?php

if (isset($_POST['customer'])) {
    $_SESSION['customer_assessment_data'] = $_POST; // Correct key
}


$company_id_exist = $_SESSION['customer_assessment_data']['company_id'];
$officer_id_exist = $_SESSION['customer_assessment_data']['officer_id'];

$sql_edd_exist = "SELECT * FROM edd_form_conduct WHERE company_id = ? AND officer_id = ?";
$stmt = $link->prepare($sql_edd_exist);
$stmt->bind_param("ii", $company_id_exist, $officer_id_exist);
$stmt->execute();
$execute_edd_exist = $stmt->get_result();

$sql_officer = "SELECT * FROM officer WHERE id = '$officer_id_exist '";
$execute_officer = mysqli_query($link,$sql_officer);
$result_officer = mysqli_fetch_assoc($execute_officer);

if ($execute_edd_exist) {
    $edd_row_exist = $execute_edd_exist->num_rows;
} else {
    // Handle the query error
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    /* Center the form container */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
       
    }

    /* Button styles */
    .submit-btn {
        background-color: #3498db; /* Blue background */
        color: white; /* White text */
        border: none; /* Remove default border */
        border-radius: 5px; /* Rounded corners */
        padding: 15px 30px; /* Padding */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer cursor on hover */
        position: relative;
        overflow: hidden; /* Hide overflow for animation */
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition for color and scale */
    }

    /* Button hover effect */
    .submit-btn:hover {
        background-color: #2980b9; /* Darker blue on hover */
        transform: scale(1.05); /* Slightly increase size */
    }

    /* Button focus effect */
    .submit-btn:focus {
        outline: none; /* Remove default outline */
    }

    /* Animated underline effect */
    .submit-btn::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2px;
        width: 100%;
        background: #fff;
        transform: translateX(-100%);
        transition: transform 0.3s;
    }

    .submit-btn:hover::after {
        transform: translateX(0);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        word-wrap: break-word; /* Ensures text wraps in narrow columns */
    }
    th {
        background-color: #f4f4f4;
        color: #333;
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
   tr,td:nth-child(3){
        width: 600px;
    }
    /* Custom width for the third column */
    tr:hover {
        background-color: #f1f1f1;
    }
    select, input {
        width: 50%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Ensures padding and border are included in width */
    }
    caption {
        font-size: 1.5em;
        margin: 10px 0;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        table {
            font-size: 14px; /* Slightly smaller font for smaller screens */
        }
        th, td {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        tr {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }
        td {
            text-align: right;
            border: none; /* Remove border for better readability on small screens */
        }
        td::before {
            content: attr(data-label); /* Use data-label attribute to display label before content */
            font-weight: bold;
            text-transform: uppercase;
            display: block;
            margin-bottom: 5px;
        }
    }

</style>
 <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
 <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
 <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>
</head>
<body>

<div class="d-flex align-items-center">
   <img src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="image-fluid" style="width: 5%;">
   <h1 class="mx-auto">Risk Assessment Form</h1>
</div>
<table>
    <thead>
        <tr>
            <th>Section 2: Risk Assessment</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <tbody>
        <tr>
            <td>Services</td>
            <td></td>
            <td>Yes/No</td>
        </tr>
        <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">Section A: Nature of Services Required by Customer/Client</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Forming of corporations or other legal persons</td>
            <td>
                <select name="forming_of_corporations" id="forming_of_corporations">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Acting, or arranging for another person to act <br>i) as a director or secretary of a corporation; ii) partner of a partnership; or iii) a position similar to the above in relation to other legal persons</td>
            <td>
                <select name="acting_as_director_or_secretary" id="acting_as_director_or_secretary">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Acting, or arranging for another person to act as a shareholder on behalf of any corporation other than one whose securities are listed on a securities exchange under section 2(1) or recognised securities exchange under section 283(1) of the Securities and Futures Act</td>
            <td>
                <select name="acting_as_shareholder" id="acting_as_shareholder">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Providing a registered office, business address or correspondence or administrative address or other related services</td>
            <td>
                <select name="providing_registered_office" id="providing_registered_office">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Buying and selling of real estates</td>
            <td>
                <select name="buying_and_selling_real_estates" id="buying_and_selling_real_estates">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Managing of client money, securities or other assets</td>
            <td>
                <select name="managing_client_money" id="managing_client_money">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Management of bank, savings or securities accounts</td>
            <td>
                <select name="management_of_accounts" id="management_of_accounts">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Organisation of contributions for the creation, operation or management of companies</td>
            <td>
                <select name="organisation_of_contributions" id="organisation_of_contributions">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td>Buying and selling of business entities</td>
            <td>
                <select name="buying_and_selling_business_entities" id="buying_and_selling_business_entities">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>10</td>
            <td>Statutory audit services</td>
            <td>
                <select name="statutory_audit_services" id="statutory_audit_services">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Indicate the type of service rendered: <br>Providing other services (e.g. Annual Return filing, etc.)</td>
            <td>
                <select name="providing_other_services" id="providing_other_services">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">Section B1: Customer&#39;s/Client Risk Factors</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Is this a new customer/client?</td>
            <td>
                <select name="new_customer" id="new_customer" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Is the customer/client a public company listed on any stock exchange not subjected to disclosure requirements?</td>
            <td>
                <select name="public_company" id="public_company" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Is the customer/client a legal person or an entity that can hold assets in its own name?</td>
            <td>
                <select name="legal_person" id="legal_person" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>4a</td>
            <td>Does the customer/client use nominee director(s) or shareholder(s)?</td>
            <td>
                <select name="nominee_director" id="nominee_director" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>4b</td>
            <td>Where applicable, do the nominee shareholders represent majority ownership?</td>
            <td>
                <select name="nominee_shareholders" id="nominee_shareholders" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Does the ownership structure of the customer/client appear unusual or excessively complex given the nature of its business?</td>
            <td>
                <select name="ownership_structure" id="ownership_structure" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Is the customer/client’s business cash-intensive?</td>
            <td>
                <select name="cash_intensive" id="cash_intensive" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Does the customer/client frequently make unaccounted cash transactions to similar recipient(s)?</td>
            <td>
                <select name="unaccounted_cash" id="unaccounted_cash" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Do the proposed directors/partners/shareholders have prior criminal convictions involving fraud or dishonesty?</td>
            <td>
                <select name="criminal_convictions" id="criminal_convictions" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td>Is any of the customer/client, beneficial owner or its agent a politically exposed person?</td>
            <td>
                <select name="politically_exposed" id="politically_exposed" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>10</td>
            <td>Are the customer/client’s company accounts outdated?</td>
            <td>
                <select name="outdated_accounts" id="outdated_accounts" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>11</td>
            <td>Do the customer/client’s shareholders and/or directors frequently change, and the changes are within reason?</td>
            <td>
                <select name="frequent_changes" id="frequent_changes" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>12</td>
            <td>Is there any problem obtaining the required information in the relevant form?</td>
            <td>
                <select name="problem_obtaining_info" id="problem_obtaining_info" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>13</td>
            <td>Can the information obtained be verified by independent and reliable sources?</td>
            <td>
                <select name="info_verified" id="info_verified" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>14</td>
            <td>Is the customer/client a charitable or non-profit organisation that is not registered in Singapore?</td>
            <td>
                <select name="non_profit" id="non_profit" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>15</td>
            <td>Does the client appear to be a shell company?</td>
            <td>
                <select name="shell_company" id="shell_company" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>16</td>
            <td>Is the client in a high-risk industry?</td>
            <td>
                <select name="high_risk_industry" id="high_risk_industry" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>17</td>
            <td>Are there adverse news or information arising?</td>
            <td>
                <select name="adverse_news" id="adverse_news" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>18</td>
            <td>Exceptions noted cannot be disposed of satisfactorily.</td>
            <td>
                <select name="exceptions_noted" id="exceptions_noted" class="risk-assessment">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Count of "Yes"</td>
            <td>If “Yes” has been selected for the majority of the 18 questions above, you are advised to adopt a risk-sensitive approach and perform enhanced CDD measures before establishing a business relationship with the customer/client.</td>
             <td ><span id="yes-count">0</span> <input type="text" name="customers_client_risk_factors" value="" id="customers_client_risk_factors"></td>
        </tr>
        <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">B2 Country/Territory Risk Factors</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that is identified as not having adequate antimoney laundering or counter financing terrorism measures?</td>
            <td>
                <select name="aml_measures" id="aml_measures" class="risk-factor">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that has dealings with high-risk jurisdiction?</td>
            <td>
                <select name="high_risk_jurisdiction" id="high_risk_jurisdiction" class="risk-factor">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that is sanctioned by a regulatory body, such as the United Nations (UN)?</td>
            <td>
                <select name="sanctioned_country" id="sanctioned_country" class="risk-factor">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that is identified to be funding or supporting terrorist activities or that have designated terrorist organizations operating within their territories?</td>
            <td>
                <select name="terrorist_support" id="terrorist_support" class="risk-factor">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Is the customer/client connected to or transacting with a country or a territory in relation to which the FATF has called for countermeasures?</td>
            <td>
                <select name="fatf_countermeasures" id="fatf_countermeasures" class="risk-factor">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Count of "Yes"</td>
            <td>Is “Yes” selected for any of the questions under B2 Country/Terrority Risk Factors?<br>If it has been selected for any of the questions above, you are advised to adopt a risk-sensitive approach and perform enhanced CDD measures before establishing a business relationship with the customer/client.</td>
            <td ><span id="yes1_count">0</span> <input type="text" name="country_territory_risk_factors" id="country_territory_risk_factors" value=""></td>
        </tr>
         <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">B3 Services/Transactions Risk Factors</th>
        </tr>
      <tr>
            <td>1</td>
            <td>Has the customer/client given any instruction to perform a transaction (which may include cash) anonymously?</td>
            <td>
                <select name="anonymous_transaction" id="anonymous_transaction" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Has the customer/client transferred any funds without the provision of underlying services or transactions?</td>
            <td>
                <select name="funds_transfer_without_service" id="funds_transfer_without_service" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Are there unusual patterns of transactions that have no apparent economic purpose or cash payments that are large in amount, in which disbursement would have been normally made by other modes of payment (such as cheque, bank drafts, etc.)?</td>
            <td>
                <select name="unusual_transaction_patterns" id="unusual_transaction_patterns" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Are there unaccounted payments received from unknown or unassociated third parties for services and/or transactions provided by the customer/client?</td>
            <td>
                <select name="unaccounted_payments" id="unaccounted_payments" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Is there instruction from the customer/client to incorporate shell companies with nominee shareholder(s) and/or director(s)?</td>
            <td>
                <select name="shell_companies_incorporation" id="shell_companies_incorporation" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Does the customer/client purchase companies or business entities that have no obvious commercial purpose?<br>This would include: <br>- Multi-layer, multi-country and complex group structures. <br>- Setting up entities in Singapore where there is no obvious commercial purpose, or any other personal or economic connection to the client.</td>
            <td>
                <select name="purchase_no_commercial_purpose" id="purchase_no_commercial_purpose" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Is this business relationship being established without any physical meeting?</td>
            <td>
                <select name="no_physical_meeting_relationship" id="no_physical_meeting_relationship" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Are there any transactions being performed without any physical meeting?</td>
            <td>
                <select name="no_physical_meeting_transactions" id="no_physical_meeting_transactions" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td>Are the transactions required by the customer/client inconsistent with the professional intermediaries’ knowledge on the customer/client’s risk profile and nature of business?</td>
            <td>
                <select name="inconsistent_transactions" id="inconsistent_transactions" class="risk-factor1">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Count of "Yes"</td>
            <td>If “Yes” has been selected for the majority of the 9 questions above, you are advised to adopt a risk-sensitive approach and perform enhanced CDD measures before establishing a business relationship with the customer/client.</td>
            <td ><span id="yes2_count">0</span> <input type="text" name="services_transactions_risk_factors" id="services_transactions_risk_factors" value=""></td>
        </tr>    
    </tbody>
</table>
    <div class="container">        
            <button type="submit" name="submit" class="submit-btn">Submit</button>        
    </div>
</form>
 <script>
        document.querySelectorAll('.risk-assessment').forEach(function(select) {
            select.addEventListener('change', updateYesCount);
            select.addEventListener('change', updateRiskFactor);
        });

        function updateYesCount() {
            let yesCount = 0;
            document.querySelectorAll('.risk-assessment').forEach(function(select) {
                if (select.value === '1') {
                    yesCount++;
                }
            });
            document.getElementById('yes-count').textContent = yesCount;
        }

        // Initial count on page load
        updateYesCount();

        document.querySelectorAll('.risk-factor').forEach(select => {
            select.addEventListener('change', updateYesCount1);
            select.addEventListener('change', updateRiskFactor1);
        });

        function updateYesCount1() {
            let count = 0;
            document.querySelectorAll('.risk-factor').forEach(select => {
                if (select.value === '1') {
                    count++;
                }
            });
            document.getElementById('yes1_count').textContent = count;
        }
        // Initialize count on page load
        updateYesCount1();


        document.querySelectorAll('.risk-factor1').forEach(select => {
            select.addEventListener('change', updateYesCount2);
            select.addEventListener('change', updateRiskFactor2);
        });

        function updateYesCount2() {
            let count = 0;
            document.querySelectorAll('.risk-factor1').forEach(select => {
                if (select.value === '1') {
                    count++;
                }
            });
            document.getElementById('yes2_count').textContent = count;
        }

        // Initialize count on page load
        updateYesCount2();

       function updateRiskFactor() {
            // Get the count from the span element
            var count = parseInt(document.getElementById('yes-count').textContent.trim());

            // Get the input field
            var riskFactorInput = document.querySelector('input[name="customers_client_risk_factors"]');

            // Set the value based on the count
            if (count < 4) {
                riskFactorInput.value = 'Low';
            } else if (count >= 4 && count <=8) {
                riskFactorInput.value = 'Medium';
            } else {
                riskFactorInput.value = 'High (EDD Required)';
            }

        }

        // Run the update function when the page loads
        updateRiskFactor();

       function updateRiskFactor1() {
            // Get the count from the span getElementById
            var count = parseInt(document.getElementById('yes1_count').textContent.trim());

            // Get the input field
            var riskFactorInput = document.querySelector('input[name="country_territory_risk_factors"]');

            // Set the value based on the count
            if (count == 0) {
                riskFactorInput.value = 'Low';
            } else {
                riskFactorInput.value = 'High (EDD Required)';
            }
        }

        // Run the update function when the page loads
        updateRiskFactor1();

        function updateRiskFactor2() {
            // Get the count from the span getElementById
            var count = parseInt(document.getElementById('yes2_count').textContent.trim());

            // Get the input field
            var riskFactorInput = document.querySelector('input[name="services_transactions_risk_factors"]');

            // Set the value based on the count
            if (count >=0 && count < 3) {
                riskFactorInput.value = 'Low';
            } else if(count >=3 && count < 5){
                riskFactorInput.value = 'Medium';
            } else {
                riskFactorInput.value = 'High (EDD Required)';
            }
        }

        // Run the update function when the page loads
        updateRiskFactor2();

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <?php require_once 'modal.php'; ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to the select elements
            var customerClientRisk = document.getElementById('customers_client_risk_factors');
            var countryRisk = document.getElementById('country_territory_risk_factors');
            var serviceRisk = document.getElementById('services_transactions_risk_factors');
            var edd_row_exist = '<?php echo $edd_row_exist; ?>';

            // Function to show the modal
            function showModal() {
                var myModal = new bootstrap.Modal(document.getElementById('edd_form'));
                myModal.show();
            }

            // Function to check the current value of a select element
            function checkSelectValue(selectElement) {
                if (selectElement.value === 'High (EDD Required)' && edd_row_exist == 0) {
                    showModal();
                }
            }

            // Event listeners for the select elements
            customerClientRisk.addEventListener('change', function() {
                checkSelectValue(this);
            });

            countryRisk.addEventListener('change', function() {
                checkSelectValue(this);
            });

            serviceRisk.addEventListener('change', function() {
                checkSelectValue(this);
            });

            // Check the initial values on page load
            checkSelectValue(customerClientRisk);
            checkSelectValue(countryRisk);
            checkSelectValue(serviceRisk);
        });
    </script>

</body>
</html>
<?php
 if (isset($_POST['submit'])) {
     $customer_assessment_data = $_SESSION['customer_assessment_data']; // Correct key

    $company_id = isset($customer_assessment_data['company_id']) ? $customer_assessment_data['company_id'] : null;
    $officer_id = isset($customer_assessment_data['officer_id']) ? $customer_assessment_data['officer_id'] : null;
    $envelope_id_remark = isset($customer_assessment_data['envelope_id_remark']) ? $customer_assessment_data['envelope_id_remark'] : null;
    $account_id_remark = isset($customer_assessment_data['account_id_remark']) ? $customer_assessment_data['account_id_remark'] : null;
    $capacity_customer_remark = isset($customer_assessment_data['capacity_customer_remark']) ? $customer_assessment_data['capacity_customer_remark'] : null;
    $capacity_cp_remark = isset($customer_assessment_data['capacity_cp_remark']) ? $customer_assessment_data['capacity_cp_remark'] : null;
    $capacity_agent_remark = isset($_POST['capacity_agent_remark']) ? $customer_assessment_data['capacity_agent_remark'] : null;
    $bo_company_remark = isset($customer_assessment_data['bo_company_remark']) ? $customer_assessment_data['bo_company_remark'] : null;
    $not_bo_company_remark = isset($customer_assessment_data['not_bo_company_remark']) ? $customer_assessment_data['not_bo_company_remark'] : null;
    $beneficial_ownership = isset($customer_assessment_data['beneficial_ownership']) ? $customer_assessment_data['beneficial_ownership'] : null;
    $beneficial_ownership_remark = isset($customer_assessment_data['beneficial_ownership_remark']) ? $customer_assessment_data['beneficial_ownership_remark'] : null;
    $full_name_hits = isset($customer_assessment_data['full_name_hits']) ? $customer_assessment_data['full_name_hits'] : null;
    $full_name_remark = isset($customer_assessment_data['full_name_remark']) ? $customer_assessment_data['full_name_remark'] : null;
    $full_name_risk = isset($customer_assessment_data['full_name_risk']) ? $customer_assessment_data['full_name_risk'] : null;
    $residential_address_remark = isset($customer_assessment_data['residential_address_remark']) ? $customer_assessment_data['residential_address_remark'] : null;
    $id_type = isset($customer_assessment_data['id_type']) ? $customer_assessment_data['id_type'] : null;
    $id_other_remark = isset($customer_assessment_data['id_other_remark']) ? $customer_assessment_data['id_other_remark'] : null;
    $expiry_date_id = isset($customer_assessment_data['expiry_date_id']) ? $customer_assessment_data['expiry_date_id'] : null;
    $expiry_date_id_other_remark = isset($customer_assessment_data['expiry_date_id_other_remark']) ? $customer_assessment_data['expiry_date_id_other_remark'] : null;
    $date_of_birth = isset($customer_assessment_data['date_of_birth']) ? $customer_assessment_data['date_of_birth'] : null;
    $date_of_birth_other_remark = isset($customer_assessment_data['date_of_birth_other_remark']) ? $customer_assessment_data['date_of_birth_other_remark'] : null;
    $gender_male = isset($customer_assessment_data['gender_male']) ? $customer_assessment_data['gender_male'] : null;
    $gender_male_other_remark = isset($customer_assessment_data['gender_male_other_remark']) ? $customer_assessment_data['gender_male_other_remark'] : null;
    $gender_female = isset($customer_assessment_data['gender_female']) ? $customer_assessment_data['gender_female'] : null;
    $gender_female_other_remark = isset($customer_assessment_data['gender_female_other_remark']) ? $customer_assessment_data['gender_female_other_remark'] : null;
    $nationality = isset($customer_assessment_data['nationality']) ? $customer_assessment_data['nationality'] : null;
    $nationality_other_remark = isset($customer_assessment_data['nationality_other_remark']) ? $customer_assessment_data['nationality_other_remark'] : null;
    $business_relationship = isset($customer_assessment_data['business_relationship']) ? $customer_assessment_data['business_relationship'] : null;
    $business_relationship_other_remark = isset($customer_assessment_data['business_relationship_other_remark']) ? $customer_assessment_data['business_relationship_other_remark'] : null;
    $is_pep = isset($customer_assessment_data['is_pep']) ? $customer_assessment_data['is_pep'] : null;
    $is_pep_other_remark = isset($customer_assessment_data['is_pep_other_remark']) ? $customer_assessment_data['is_pep_other_remark'] : null;
    $not_pep = isset($customer_assessment_data ['not_pep']) ? $customer_assessment_data ['not_pep'] : null;
    $not_pep_other_remark = isset($customer_assessment_data ['not_pep_other_remark']) ? $customer_assessment_data ['not_pep_other_remark'] : null;
    $singapore_pep = isset($customer_assessment_data ['singapore_pep']) ? $customer_assessment_data ['singapore_pep'] : null;
    $singapore_pep_other_remark = isset($customer_assessment_data ['singapore_pep_other_remark']) ? $customer_assessment_data ['singapore_pep_other_remark'] : null;
    $foreign_pep = isset($customer_assessment_data ['foreign_pep']) ? $customer_assessment_data ['foreign_pep'] : null;
    $foreign_pep_any_hit = isset($customer_assessment_data ['foreign_pep_any_hit']) ? $customer_assessment_data ['foreign_pep_any_hit'] : null;
    $foreign_pep_other_remark = isset($customer_assessment_data ['foreign_pep_other_remark']) ? $customer_assessment_data ['foreign_pep_other_remark'] : null;
    $foreign_pep_risk_score = isset($customer_assessment_data ['foreign_pep_risk_score']) ? $customer_assessment_data ['foreign_pep_risk_score'] : null;
    $international_organisation_pep = isset($customer_assessment_data ['international_organisation_pep']) ? $customer_assessment_data ['international_organisation_pep'] : null;
    $international_organisation_pep_other_remark = isset($customer_assessment_data ['international_organisation_pep_other_remark']) ? $customer_assessment_data ['international_organisation_pep_other_remark'] : null;
    $family_member_pep = isset($customer_assessment_data ['family_member_pep']) ? $customer_assessment_data ['family_member_pep'] : null;
    $family_member_pep_other_remark = isset($customer_assessment_data ['family_member_pep_other_remark']) ? $customer_assessment_data ['family_member_pep_other_remark'] : null;
    $close_associate_pep = isset($customer_assessment_data ['close_associate_pep']) ? $customer_assessment_data ['close_associate_pep'] : null;
    $close_associate_pep_other_remark = isset($customer_assessment_data ['close_associate_pep_other_remark']) ? $customer_assessment_data ['close_associate_pep_other_remark'] : null;
    $relationship_family_member_pep = isset($customer_assessment_data ['relationship_family_member_pep']) ? $customer_assessment_data ['relationship_family_member_pep'] : null;
    $relationship_family_member_pep_other_remark = isset($customer_assessment_data ['relationship_family_member_pep_other_remark']) ? $customer_assessment_data ['relationship_family_member_pep_other_remark'] : null;
    $relationship_close_associate_pep = isset($customer_assessment_data ['relationship_close_associate_pep']) ? $customer_assessment_data ['relationship_close_associate_pep'] : null;
    $relationship_close_associate_pep_other_remark = isset($customer_assessment_data ['relationship_close_associate_pep_other_remark']) ? $customer_assessment_data ['relationship_close_associate_pep_other_remark'] : null;
    $name_of_pep = isset($customer_assessment_data ['name_of_pep']) ? $customer_assessment_data ['name_of_pep'] : null;
    $name_of_pep_other_remark = isset($customer_assessment_data ['name_of_pep_other_remark']) ? $customer_assessment_data ['name_of_pep_other_remark'] : null;
    $country_international_org_pep = isset($customer_assessment_data ['country_international_org_pep']) ? $customer_assessment_data ['country_international_org_pep'] : null;
    $country_international_org_pep_other_remark = isset($customer_assessment_data ['country_international_org_pep_other_remark']) ? $customer_assessment_data ['country_international_org_pep_other_remark'] : null;
    $nature_of_public_function = isset($_POST['nature_of_public_function']) ? $customer_assessment_data ['nature_of_public_function'] : null;
    $nature_of_public_function_other_remark = isset($customer_assessment_data ['nature_of_public_function_other_remark']) ? $customer_assessment_data ['nature_of_public_function_other_remark'] : null;
    $period_as_pep = isset($customer_assessment_data ['period_as_pep']) ? $customer_assessment_data ['period_as_pep'] : null;
    $period_as_pep_other_remark = isset($customer_assessment_data ['period_as_pep_other_remark']) ? $customer_assessment_data ['period_as_pep_other_remark'] : null;
    $entity_name_other_remark = isset($customer_assessment_data ['entity_name_other_remark']) ? $customer_assessment_data ['entity_name_other_remark'] : null;
    $former_name_other_remark = isset($customer_assessment_data ['former_name_other_remark']) ? $customer_assessment_data ['former_name_other_remark'] : null;
    $trading_name_other_remark = isset($customer_assessment_data ['trading_name_other_remark']) ? $customer_assessment_data ['trading_name_other_remark'] : null;
    $address_registered_office = isset($customer_assessment_data ['address_registered_office']) ? $customer_assessment_data ['address_registered_office'] : null;
    $address_registered_office_other_remark = isset($customer_assessment_data ['address_registered_office_other_remark']) ? $customer_assessment_data ['address_registered_office_other_remark'] : null;
    $address_principal_place_business = isset($customer_assessment_data ['address_principal_place_business']) ? $customer_assessment_data ['address_principal_place_business'] : null;
    $address_principal_place_business_other_remark = isset($customer_assessment_data ['address_principal_place_business_other_remark']) ? $customer_assessment_data ['address_principal_place_business_other_remark'] : null;
    $country_registration = isset($customer_assessment_data ['country_registration']) ? $customer_assessment_data ['country_registration'] : null;
    $country_registration_other_remark = isset($customer_assessment_data ['country_registration_other_remark']) ? $customer_assessment_data ['country_registration_other_remark'] : null;
    $nature_of_business = isset($customer_assessment_data ['nature_of_business']) ? $customer_assessment_data ['nature_of_business'] : null;
    $nature_of_business_other_remark = isset($customer_assessment_data ['nature_of_business_other_remark']) ? $customer_assessment_data ['nature_of_business_other_remark'] : null;
    $transaction_countries = isset($customer_assessment_data ['transaction_countries']) ? $customer_assessment_data ['transaction_countries'] : null;
    $transaction_countries_other_remark = isset($customer_assessment_data ['transaction_countries_other_remark']) ? $customer_assessment_data ['transaction_countries_other_remark'] : null;
    $info_person_wealth_other_remark = isset($customer_assessment_data ['info_person_wealth_other_remark']) ? $customer_assessment_data ['info_person_wealth_other_remark'] : null;
    $info_person_fund_other_remark = isset($customer_assessment_data ['info_person_fund_other_remark']) ? $customer_assessment_data ['info_person_fund_other_remark'] : null;
    $other_info_other_remark = isset($customer_assessment_data ['other_info_other_remark']) ? $customer_assessment_data ['other_info_other_remark'] : null;

    $sql_customer = "INSERT INTO customer_due_diligence (
            company_id, officer_id, envelope_id_remark, account_id_remark, capacity_customer_remark, 
            capacity_cp_remark, capacity_agent_remark, bo_company_remark, not_bo_company_remark, 
            beneficial_ownership, beneficial_ownership_remark, full_name_hits, full_name_remark, 
            full_name_risk, residential_address_remark, id_type, id_other_remark, expiry_date_id, 
            expiry_date_id_other_remark, date_of_birth, date_of_birth_other_remark, gender_male, 
            gender_male_other_remark, gender_female, gender_female_other_remark, nationality, 
            nationality_other_remark, business_relationship, business_relationship_other_remark, 
            is_pep, is_pep_other_remark, not_pep, not_pep_other_remark, singapore_pep, 
            singapore_pep_other_remark, foreign_pep, foreign_pep_any_hit, foreign_pep_other_remark, 
            foreign_pep_risk_score, international_organisation_pep, international_organisation_pep_other_remark, 
            family_member_pep, family_member_pep_other_remark, close_associate_pep, 
            close_associate_pep_other_remark, relationship_family_member_pep, relationship_family_member_pep_other_remark, 
            relationship_close_associate_pep, relationship_close_associate_pep_other_remark, name_of_pep, 
            name_of_pep_other_remark, country_international_org_pep, country_international_org_pep_other_remark, 
            nature_of_public_function, nature_of_public_function_other_remark, period_as_pep, 
            period_as_pep_other_remark, entity_name_other_remark, former_name_other_remark, 
            trading_name_other_remark, address_registered_office, address_registered_office_other_remark, 
            address_principal_place_business, address_principal_place_business_other_remark, 
            country_registration, country_registration_other_remark, nature_of_business, 
            nature_of_business_other_remark, transaction_countries, transaction_countries_other_remark, 
            info_person_wealth_other_remark, info_person_fund_other_remark, other_info_other_remark
        ) VALUES (
            '$company_id', '$officer_id', '$envelope_id_remark', '$account_id_remark', '$capacity_customer_remark', 
            '$capacity_cp_remark', '$capacity_agent_remark', '$bo_company_remark', '$not_bo_company_remark', 
            '$beneficial_ownership', '$beneficial_ownership_remark', '$full_name_hits', '$full_name_remark', 
            '$full_name_risk', '$residential_address_remark', '$id_type', '$id_other_remark', '$expiry_date_id', 
            '$expiry_date_id_other_remark', '$date_of_birth', '$date_of_birth_other_remark', '$gender_male', 
            '$gender_male_other_remark', '$gender_female', '$gender_female_other_remark', '$nationality', 
            '$nationality_other_remark', '$business_relationship', '$business_relationship_other_remark', 
            '$is_pep', '$is_pep_other_remark', '$not_pep', '$not_pep_other_remark', '$singapore_pep', 
            '$singapore_pep_other_remark', '$foreign_pep', '$foreign_pep_any_hit', '$foreign_pep_other_remark', 
            '$foreign_pep_risk_score', '$international_organisation_pep', '$international_organisation_pep_other_remark', 
            '$family_member_pep', '$family_member_pep_other_remark', '$close_associate_pep', 
            '$close_associate_pep_other_remark', '$relationship_family_member_pep', '$relationship_family_member_pep_other_remark', 
            '$relationship_close_associate_pep', '$relationship_close_associate_pep_other_remark', '$name_of_pep', 
            '$name_of_pep_other_remark', '$country_international_org_pep', '$country_international_org_pep_other_remark', 
            '$nature_of_public_function', '$nature_of_public_function_other_remark', '$period_as_pep', 
            '$period_as_pep_other_remark', '$entity_name_other_remark', '$former_name_other_remark', 
            '$trading_name_other_remark', '$address_registered_office', '$address_registered_office_other_remark', 
            '$address_principal_place_business', '$address_principal_place_business_other_remark', 
            '$country_registration', '$country_registration_other_remark', '$nature_of_business', 
            '$nature_of_business_other_remark', '$transaction_countries', '$transaction_countries_other_remark', 
            '$info_person_wealth_other_remark', '$info_person_fund_other_remark', '$other_info_other_remark'
        )";

   if (mysqli_query($link,$sql_customer)) {
       $forming_of_corporations = isset($_POST['forming_of_corporations']) ? intval($_POST['forming_of_corporations']) : 0;
        $acting_as_director_or_secretary = isset($_POST['acting_as_director_or_secretary']) ? intval($_POST['acting_as_director_or_secretary']) : 0;
        $acting_as_shareholder = isset($_POST['acting_as_shareholder']) ? intval($_POST['acting_as_shareholder']) : 0;
        $providing_registered_office = isset($_POST['providing_registered_office']) ? intval($_POST['providing_registered_office']) : 0;
        $buying_and_selling_real_estates = isset($_POST['buying_and_selling_real_estates']) ? intval($_POST['buying_and_selling_real_estates']) : 0;
        $managing_client_money = isset($_POST['managing_client_money']) ? intval($_POST['managing_client_money']) : 0;
        $management_of_accounts = isset($_POST['management_of_accounts']) ? intval($_POST['management_of_accounts']) : 0;
        $organisation_of_contributions = isset($_POST['organisation_of_contributions']) ? intval($_POST['organisation_of_contributions']) : 0;
        $buying_and_selling_business_entities = isset($_POST['buying_and_selling_business_entities']) ? intval($_POST['buying_and_selling_business_entities']) : 0;
        $statutory_audit_services = isset($_POST['statutory_audit_services']) ? intval($_POST['statutory_audit_services']) : 0;
        $providing_other_services = isset($_POST['providing_other_services']) ? intval($_POST['providing_other_services']) : 0;
        $new_customer = isset($_POST['new_customer']) ? intval($_POST['new_customer']) : 0;
        $public_company = isset($_POST['public_company']) ? intval($_POST['public_company']) : 0;
        $legal_person = isset($_POST['legal_person']) ? intval($_POST['legal_person']) : 0;
        $nominee_director = isset($_POST['nominee_director']) ? intval($_POST['nominee_director']) : 0;
        $nominee_shareholders = isset($_POST['nominee_shareholders']) ? intval($_POST['nominee_shareholders']) : 0;
        $ownership_structure = isset($_POST['ownership_structure']) ? intval($_POST['ownership_structure']) : 0;
        $cash_intensive = isset($_POST['cash_intensive']) ? intval($_POST['cash_intensive']) : 0;
        $unaccounted_cash = isset($_POST['unaccounted_cash']) ? intval($_POST['unaccounted_cash']) : 0;
        $criminal_convictions = isset($_POST['criminal_convictions']) ? intval($_POST['criminal_convictions']) : 0;
        $politically_exposed = isset($_POST['politically_exposed']) ? intval($_POST['politically_exposed']) : 0;
        $outdated_accounts = isset($_POST['outdated_accounts']) ? intval($_POST['outdated_accounts']) : 0;
        $frequent_changes = isset($_POST['frequent_changes']) ? intval($_POST['frequent_changes']) : 0;
        $problem_obtaining_info = isset($_POST['problem_obtaining_info']) ? intval($_POST['problem_obtaining_info']) : 0;
        $info_verified = isset($_POST['info_verified']) ? intval($_POST['info_verified']) : 0;
        $non_profit = isset($_POST['non_profit']) ? intval($_POST['non_profit']) : 0;
        $shell_company = isset($_POST['shell_company']) ? intval($_POST['shell_company']) : 0;
        $high_risk_industry = isset($_POST['high_risk_industry']) ? intval($_POST['high_risk_industry']) : 0;
        $adverse_news = isset($_POST['adverse_news']) ? intval($_POST['adverse_news']) : 0;
        $exceptions_noted = isset($_POST['exceptions_noted']) ? intval($_POST['exceptions_noted']) : 0;
        $aml_measures = isset($_POST['aml_measures']) ? intval($_POST['aml_measures']) : 0;
        $high_risk_jurisdiction = isset($_POST['high_risk_jurisdiction']) ? intval($_POST['high_risk_jurisdiction']) : 0;
        $sanctioned_country = isset($_POST['sanctioned_country']) ? intval($_POST['sanctioned_country']) : 0;
        $terrorist_support = isset($_POST['terrorist_support']) ? intval($_POST['terrorist_support']) : 0;
        $fatf_countermeasures = isset($_POST['fatf_countermeasures']) ? intval($_POST['fatf_countermeasures']) : 0;
        $anonymous_transaction = isset($_POST['anonymous_transaction']) ? intval($_POST['anonymous_transaction']) : 0;
        $funds_transfer_without_service = isset($_POST['funds_transfer_without_service']) ? intval($_POST['funds_transfer_without_service']) : 0;
        $unusual_transaction_patterns = isset($_POST['unusual_transaction_patterns']) ? intval($_POST['unusual_transaction_patterns']) : 0;
        $unaccounted_payments = isset($_POST['unaccounted_payments']) ? intval($_POST['unaccounted_payments']) : 0;
        $shell_companies_incorporation = isset($_POST['shell_companies_incorporation']) ? intval($_POST['shell_companies_incorporation']) : 0;
        $purchase_no_commercial_purpose = isset($_POST['purchase_no_commercial_purpose']) ? intval($_POST['purchase_no_commercial_purpose']) : 0;
        $no_physical_meeting_relationship = isset($_POST['no_physical_meeting_relationship']) ? intval($_POST['no_physical_meeting_relationship']) : 0;
        $no_physical_meeting_transactions = isset($_POST['no_physical_meeting_transactions']) ? intval($_POST['no_physical_meeting_transactions']) : 0;
        $inconsistent_transactions = isset($_POST['inconsistent_transactions']) ? intval($_POST['inconsistent_transactions']) : 0;
        $country_territory_risk_factors = isset($_POST['country_territory_risk_factors']) ? $_POST['country_territory_risk_factors'] : '';
        $services_transactions_risk_factors = isset($_POST['services_transactions_risk_factors']) ? $_POST['services_transactions_risk_factors'] : '';
        $customers_client_risk_factors = isset($_POST['customers_client_risk_factors']) ? $_POST['customers_client_risk_factors'] : '';


        $sql = "INSERT INTO risk_assessment (
          officer_id, company_id, forming_of_corporations, acting_as_director_or_secretary,
          acting_as_shareholder, providing_registered_office, buying_and_selling_real_estates,
          managing_client_money, management_of_accounts, organisation_of_contributions,
          buying_and_selling_business_entities, statutory_audit_services, providing_other_services,
          new_customer, public_company, legal_person, nominee_director, nominee_shareholders,
          ownership_structure, cash_intensive, unaccounted_cash, criminal_convictions, politically_exposed,
          outdated_accounts, frequent_changes, problem_obtaining_info, info_verified, non_profit, shell_company,
          high_risk_industry, adverse_news, exceptions_noted, aml_measures, high_risk_jurisdiction,
          sanctioned_country, terrorist_support, fatf_countermeasures, anonymous_transaction,
          funds_transfer_without_service, unusual_transaction_patterns, unaccounted_payments,
          shell_companies_incorporation, purchase_no_commercial_purpose, no_physical_meeting_relationship,
          no_physical_meeting_transactions, inconsistent_transactions, country_territory_risk_factors,customers_client_risk_factors,
          services_transactions_risk_factors
        ) VALUES (
          '$officer_id', '$company_id', '$forming_of_corporations', '$acting_as_director_or_secretary',
          '$acting_as_shareholder', '$providing_registered_office', '$buying_and_selling_real_estates',
          '$managing_client_money', '$management_of_accounts', '$organisation_of_contributions',
          '$buying_and_selling_business_entities', '$statutory_audit_services', '$providing_other_services',
          '$new_customer', '$public_company', '$legal_person', '$nominee_director', '$nominee_shareholders',
          '$ownership_structure', '$cash_intensive', '$unaccounted_cash', '$criminal_convictions', '$politically_exposed',
          '$outdated_accounts', '$frequent_changes', '$problem_obtaining_info', '$info_verified', '$non_profit', '$shell_company',
          '$high_risk_industry', '$adverse_news', '$exceptions_noted', '$aml_measures', '$high_risk_jurisdiction',
          '$sanctioned_country', '$terrorist_support', '$fatf_countermeasures', '$anonymous_transaction',
          '$funds_transfer_without_service', '$unusual_transaction_patterns', '$unaccounted_payments',
          '$shell_companies_incorporation', '$purchase_no_commercial_purpose', '$no_physical_meeting_relationship',
          '$no_physical_meeting_transactions', '$inconsistent_transactions', '$country_territory_risk_factors','$customers_client_risk_factors',
          '$services_transactions_risk_factors'
        )";
    if (mysqli_query($link, $sql)) {

        $cddkyc_flag = mysqli_query($link,"UPDATE officer SET cddkyc_form = 1 WHERE id ='$officer_id' AND cr_id ='$company_id'");
        echo "<script>
                Swal.fire({
                    title: 'Risk Assessment Submitted Successfully',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                }).then(function(isConfirm) {
                        var company_id = '".$company_id."';
                        var officer_id = '".$officer_id."'; 
                        
                        // First AJAX request
                        $.ajax({
                            url: '../api/customer.php', // Replace with the path to your API
                            type: 'POST',
                            data: {
                                company_id: company_id,
                                officer_id: officer_id
                            },
                            success: function(response) {
                                let result = JSON.parse(response);
                                if (result.status === 'success') {
                                    Swal.fire(
                                        'Success!',
                                        result.message, 
                                        'success'
                                    ).then(function() {
                                        var myModal = bootstrap.Modal.getInstance(document.getElementById('edd_form'));
                                        myModal.hide();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        result.message, 
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred: ' + error,
                                    'error'
                                );
                            }
                        });
                        // Redirect to the specified URL
                        window.location = '" . $baseUrl . "/internal-staff/company-dashboard/cddkyc.php?company_id=' + company_id;
                    
                });
            </script>";

        } else {
            echo "<script>
            swal.fire({
                title: 'Risk Assessment Not Submitted Successfully',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay'
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                   window.location = '" . $baseUrl . "/internal-staff/company-dashboard/cddkyc.php?company_id=' + " . $company_id . ";
                }
            });
            </script>";
        }
   }
   unset($_SESSION['customer_assissment_data']);
 }


?>
<?php
require_once '../session.php';
require_once '../plugins/vendor/autoload.php';
use Dompdf\Dompdf;
?>
<?php
// require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
?>
<?php
$officer_id = $_GET['officer_id'] ?? null;
$company_id = $_GET['company_id'] ?? null;

?>
<?php $html ='
<style>
            /* General table styling */
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px; /* Smaller font size for better fitting */
            }

            /* Table header styling */
            th {
                background-color: #f4f4f4;
                color: #333;
                padding: 6px;
                text-align: center;
                border: 1px solid #ddd;
                font-weight: bold;
            }

            /* Table data cell styling */
            td {
                padding: 6px;
                text-align: left;
                border: 1px solid #ddd;
                word-wrap: break-word; /* Ensures text wraps in narrow columns */
            }

            /* Alternating row colors */
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            /* Optional: Hover effect for rows */
            tr:hover {
                background-color: #f1f1f1;
            }
        </style>
<table>
    <thead>
        <tr>
            <th>Section 2: Risk Assessment</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
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
             <td ><input type="text" name="customers_client_risk_factors" value=""></td>
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
            <td><input type="text" name="country_territory_risk_factors" value=""></td>
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
            <td><input type="text" name="services_transactions_risk_factors" value=""></td>
        </tr>    
    </tbody>
</table>
<h2 style="padding:50px;">Date .....................................</h2>
<h2 style="padding:50px;">Signature .................................</h2> ';
 ?>
<?php
   

    $dompdf = new Dompdf();

    // Define HTML content for the PDF
   

    // Load HTML content
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper("legal", "landscape");

    // Enable remote content (to allow images to be fetched)
    $dompdf->set_option('isRemoteEnabled', true);

    // Render the PDF
    $dompdf->render();
    $pdfOutput = $dompdf->output();

    // Create a unique filename using timestamp
    $filename = 'risk_assessment_' . date('Ymd_His') . '.pdf';

    // Define the path where you want to save the PDF
    $uploadDir = __DIR__ . '/../uploads/risk_assessment/';
    $path = $uploadDir . $filename;

    // Save the PDF to a file
    if (file_put_contents($path, $pdfOutput)) {
        $return['message'] = 'Success';
        $return['error_flag'] = 0;
        } else {
            $return['message'] = 'Fail';
            $return['error_flag'] = 1;
        }
       echo json_encode($return);
?>

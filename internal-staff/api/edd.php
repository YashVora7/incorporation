<?php
require_once '../plugins/vendor/autoload.php';
use Dompdf\Dompdf;
?>
<?php
// require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
?>
<?php
$officer_id =26;
$company_id = 31;

$sql_edd = "SELECT * FROM edd_form_conduct WHERE officer_id = '$officer_id' AND company_id ='$company_id'";
$execute_edd = mysqli_query($link,$sql_edd);
$result_edd = mysqli_fetch_assoc($execute_edd);

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
<h1 style="text-align:center;">EDD Form</h2>
        <table>
                <thead>
                    <tr>
                        <th>Ongoing Monitoring</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center"><b>A. Last Review Status</b></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Entity Name</td>
                        <td>'.$result_edd['entity_name'].'</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Customer Name</td>
                        <td>'.$result_edd['customer_name'].'</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Overall Customer Risk Rating of Last Review</td>
                        <td>'.$result_edd['customer_risk_rating_last_review'].'</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Date of Approved Review</td>
                        <td>'.$result_edd['date_of_approved_review'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><b>B. Type of Review</b></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Review Type</td>
                        <td>'.$result_edd['review_type'].'</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Reasons for review if the review is triggered by events</td>
                        <td>'.$result_edd['reasons_for_review'].'</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Actions (pre populated for review triggered by events)</td>
                        <td>'.$result_edd['actions_for_review'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><b>C. Transaction Monitoring</b></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Does Customer exhibit the following transaction patterns?<br>- Transactions as ‘donations’ or ‘contributions to humanitarian aid’ (in particular to non-profit or religious organisations in a conflict zone)<br>- Transactions linked to the purchase of items that may be used for terrorism activities, where the declared purpose of the transaction does not match the profile of the parties involved <br>- Transactions with entities located in conflict zones (where terrorism-related activities or entities are present), and where the declared purpose for the transaction does not match the profile of the parties involved <br>- Accounts with minimal activity before 2014 now showing inflows from unknown origins, followed by fund transfers to beneficiaries or ATM withdrawals in conflict zones. <br>- Client suddenly procuring and/or shipping oil equipment to conflict zones, where the activity is not consistent with the customer’s line of business or occupation.<br>- Client suddenly procuring and/or shipping oil equipment to conflict zones, where the activity is not consistent with the customer’s line of business or occupation. <br>- Clients who have frequent cash deposits and withdrawals <br>- Counterparties of clients who make frequent cash deposits into client’s accounts <br>- Transactions typically involve PEP<br>- Movement of funds unusual/uneconomic</td>
                        <td>'.$result_edd['transaction_patterns'].'</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Are transactions conducted consistent with TS "s knowledge of the customer and his business and risk profile?</td>
                        <td>'.$result_edd['transactions_consistency'].'</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Is anticipated level, frequency and nature of transaction in line with business activities?</td>
                        <td>'.$result_edd['transaction_level_frequency'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><b>D. Assessment of Changes in Circumstances</b></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Does customer have unrealistic turnovers in their Financial Statement?</td>
                        <td>'.$result_edd['unrealistic_turnovers'].'</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Does the customer conduct business inconsistently with their business or transaction profile?</td>
                        <td>'.$result_edd['business_inconsistency'].'</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Is there a change in shareholding or control structure?</td>
                        <td>'.$result_edd['shareholding_change'].'</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Is there a change in the purpose and intended nature of the business?</td>
                        <td>'.$result_edd['purpose_change'].'</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>If there is a change in the nature of business/industry, what is the current industry rating?</td>
                        <td>'.$result_edd['industry_rating'].'</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Is there a change in the business name?</td>
                        <td>'.$result_edd['business_name_change'].'</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>Is there a change in the director?</td>
                        <td>'.$result_edd['director_change'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><b>E. Name Screening</b></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Sanctions List Checks Results</td>
                        <td>'.$result_edd['sanctions_list_checks'].'</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>Google Search Results</td>
                        <td>'.$result_edd['google_search_results'].'</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>World Checks Results</td>
                        <td>'.$result_edd['world_checks_results'].'</td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>PEP Checks Results</td>
                        <td>'.$result_edd['pep_checks_results'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><b>F. Country / Territory Risk Factors</b></td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>Refer to all the Residencies / Nationalities / Countries. Did they remain unchanged?</td>
                        <td>'.$result_edd['residencies_unchanged'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><strong>Overall Customer Risk Assessment</strong></td>
                    </tr>
                    <tr>
                        <td>Document results of the assessment based on the questions above</td>
                        <td></td>
                        <td>'.$result_edd['assessment_results'].'</td>
                    </tr>
                    <tr>
                        <td>Did the risk rating of customer change?</td>
                        <td></td>
                        <td>'.$result_edd['risk_rating_change'].'</td>
                    </tr>
                    <tr>
                        <td>Overall Customer Risk Rating of Review</td>
                        <td></td>
                        <td>'.$result_edd['customer_risk_rating_review'].'</td>
                    </tr>
                    <tr>
                        <td>Date of Review</td>
                        <td></td>
                        <td>'.$result_edd['date_of_review'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><strong>For cases upgraded to Enhanced Due Diligence only</strong></td>
                    </tr>
                    <tr>
                        <td>&lt;Source of Funds Corroboration&gt;</td>
                        <td></td>
                        <td>'.$result_edd['source_of_funds_corroboration'].'</td>
                    </tr>
                    <tr>
                        <td>&lt;Source of Wealth Corroboration&gt;</td>
                        <td></td>
                        <td>'.$result_edd['source_of_wealth_corroboration'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><strong>Reviewer Comments</strong></td>
                    </tr>
                    <tr>
                        <td>I confirm that this internal risk assessment has passed the relevant checks above and documented my actions as appropriate.</td>
                        <td></td>
                        <td>'.$result_edd['internal_risk_assessment_confirmation'].'</td>
                    </tr>
                    <tr>
                        <td>Name of Reviewer</td>
                        <td></td>
                        <td>'.$result_edd['reviewer_name'].'</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td></td>
                        <td>'.$result_edd['review_date'].'</td>
                    </tr>
                    <tr>
                        <td>Other comments (i.e. You should consider escalating to the compliance officer or senior management and/or filing a Suspicious Transaction Report where necessary.)</td>
                        <td></td>
                        <td>'.$result_edd['reviewer_comments'].'</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><strong>Approver Comments</strong></td>
                    </tr>
                    <tr>
                        <td>Name of Approver</td>
                        <td></td>
                        <td>'.$result_edd['approver_name'].'</td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td></td>
                        <td>'.$result_edd['approver_position'].'</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td></td>
                        <td>'.$result_edd['approver_date'].'</td>
                    </tr>
                    <tr>
                        <td>Other comments (i.e. Please attach documentation of the reasons where approval is contrary to the recommendation.)</td>
                        <td></td>
                        <td>'.$result_edd['approver_comments'].'</td>
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
    $cddkyc_flag = mysqli_query($link,"UPDATE officer SET cddkyc_risk_assessment_pdf = '$filename' WHERE id ='$officer_id' AND cr_id ='$company_id'");
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

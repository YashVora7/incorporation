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
$officer_id = isset($_POST['officer_id'])? $_POST['officer_id']:'';
$company_id = isset($_POST['company_id'])? $_POST['company_id']:'';

$sql_officer = "SELECT * FROM officer WHERE id = '$officer_id'";
$execute_officer = mysqli_query($link,$sql_officer);
$result_officer = mysqli_fetch_assoc($execute_officer);

$sql_customer = "SELECT * FROM customer_due_diligence WHERE officer_id = '$officer_id' AND company_id ='$company_id'";
$execute_customer = mysqli_query($link,$sql_customer);
$result_customer = mysqli_fetch_assoc($execute_customer);

$sql_risk = "SELECT * FROM risk_assessment WHERE officer_id = '$officer_id' AND company_id ='$company_id'";
$execute_risk = mysqli_query($link,$sql_risk);
$result_risk = mysqli_fetch_assoc($execute_risk);

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
        <style>
        .container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .section {
            text-align: center;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 8px;
            width: 45%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .section h2 {
            margin: 20px 0;
            font-size: 18px;
            color: #333;
        }
        .section h1 {
            margin-top: 20px;
            font-size: 24px;
            color: #555;
        }
    </style>
        <h1 style="text-align:center;" >Customer Acceptance Form</h1>
    <table>
    <thead class="sticky-header">
        <tr>
            <th>Sr.No</th>
            <th>Customer Info</th>
            <th>Customer Data</th>
            <th>Action Required</th>
            <th>Verified?</th>
            <th>Any hits?</th>
            <th>Other Remark</th>
            <th>Risk Score</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="8" style="text-align:center; font-size: 20px;">Section A Individual Info</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Envelope ID</td>
           <td>'.$result_officer['id'].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$result_customer['envelope_id_remark'].'</td>
            <td></td>
        </tr>
        <tr>';

            $html.='<td>2</td>
            <td>Account ID</td>
            <td>'.$result_officer['id'].'</td>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>'.$result_customer['account_id_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Capacity of Customer</td>
            <td>on</td>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>'.$result_customer['capacity_customer_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Capacity of CP</td>
            <td>off</td>
            <td></td>
            <td></td>
            <td>
                
            </td>
            <td>'.$result_customer['capacity_cp_remark'].'</td>
            <td>
                
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Capacity of Agent</td>
            <td>off</td>
            <td></td>
            <td></td>
            <td>   
            </td>
            <td>'.$result_customer['capacity_agent_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Individual is BO of the Company</td>
            <td>on</td>
            <td></td>
            <td></td>
            <td>  
            </td>
            <td>'.$result_customer['bo_company_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Individual is not a BO of the Company</td>
            <td>off</td>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>'.$result_customer['not_bo_company_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Provide information on the nature of beneficial ownership (e.g. more than 25% of ownership of the company) or person having executive authority</td>
             <td>Owns 50%</td>
            <td>1. Verify against any company doc (no. of shares) &amp; shareholding structured provided to validate the inputs provided<br>2. Ensure that all BO information has been submitted</td>
            <td>
            </td>
            <td>
            </td>
            <td>'.$result_customer['beneficial_ownership_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td>Full Name (including any aliases)*</td> 
            <td>'.$result_officer['officer_name'].'</td>
            <td>1. Verify Identity against the identification documents provided<br>2. Refer to the Procedures Section of the Name Screening Guide (SentroWeb, Google Search &amp; Sanction List) to conduct name screenings &amp; Guidance - Assessment inputs tab to document results.<br>3. Input Risk Score based on assessment</td>
           
            <td>
            </td>
            <td>
            '.$result_customer['full_name_hits'].'
            </td>
            <td>'.$result_customer['full_name_remark'].'</td>
            <td>
            '.$result_customer['full_name_risk'].'
            </td>
        </tr>
        <tr>
            <td>10</td>
            <td>Residential Address*</td>
            <td>'.$result_officer['residential_address_country'].'</td>
            <td>1. Verify identity against the identification documents provided<br>2. Update Country of Residence based on the Residential Address under Manual Overrides.</td>
            
            <td>
            </td>
            <td>
            </td>
            <td>'.$result_customer['residential_address_remark'].'</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>11</td>
            <td>ID</td>
            <td>'.$result_officer['nric_or_id_number'].'</td>
            <td>1. Verify identity against the identification documents provided</td>
            <td>';
            $html .= ($result_customer['id'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['id_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>12</td>
            <td>Expiry date of ID</td>
            <td>'.$result_officer['officer_passport_expiration'].'</td>
            <td>1. Verify identity against the identification documents provided<br>2. Track the expiry date of the ID and obtain an update 3 months before expiry for enhanced cases or during periodic review for normal and simplified cases. (Refer to tracker)</td>
            <td>';
            $html .= ($result_customer['expiry_date_id'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['expiry_date_id_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>13</td>
            <td>Date of Birth</td>
            <td>NA</td>
            <td>1. Verify identity against the identification documents provided<br>2. Match against name screening results to validate the inputs where applicable to clear the hits</td>
            <td>';
            $html .= ($result_customer['date_of_birth'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
             </td>             
             <td>
                '.$result_customer['date_of_birth_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>14</td>
            <td>Gender Male</td>
            <td>off</td>
            <td>1. Match against name screening results to validate the inputs where applicable to clear the hits</td>
            <td>';
            $html .= ($result_customer['gender_male'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['gender_male_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>15</td>
            <td>Gender Female</td>
            <td>on</td>
            <td>1. Match against name screening results to validate the inputs where applicable to clear the hits</td>
            <td>';
            $html .= ($result_customer['gender_female'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['gender_female_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>16</td>
            <td>Nationality/Nationalities (where applicable)*</td>
            <td>'.$result_officer['officer_passport_nationality'].'</td>
            <td>1. Verify Identity against the identification documents provided<br>2. If the individual has more than 1 nationality, insert rows below this row and manually input the nationalities under the manual overrides to obtain the Risk Score based on the Country Risk Rating tab</td>
            <td>';
            $html .= ($result_customer['nationality'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['nationality_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>17</td>
            <td>Intended nature and purpose of business relationship</td>
            <td>Both</td>
            <td></td>
            
            <td>';
            $html .= ($result_customer['business_relationship'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['business_relationship_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>18</td>
            <td>Individual is a PEP</td>
            <td>On</td>
            <td>1. Match against name screening results to validate the inputs</td>
            <td>';
            $html .= ($result_customer['is_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['is_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>19</td>
            <td>Individual is not a PEP</td>
            <td>Off</td>
            <td>1. Match against name screening results to validate the inputs</td>
            <td>';
            $html .= ($result_customer['not_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['not_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>20</td>
            <td>Singapore PEP</td>
            <td>Off</td>
            <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['singapore_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['singapore_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>21</td>
            <td>Foreign PEP</td>
            <td>On</td>
            <td>1. If this field is selected, conduct enhanced due diligence.</td>
            <td>';
            $html .= ($result_customer['foreign_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            '.$result_customer['foreign_pep_any_hit'].'
            </td>
            <td>
                '.$result_customer['foreign_pep_other_remark'].'
            </td>
            <td>
                '.$result_customer['foreign_pep_risk_score'].'
            </td>
        </tr>
        <tr>
            <td>22</td>
            <td>International Organisation PEP</td>
            <td>Off</td>
            <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['international_organisation_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['international_organisation_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>23</td>
            <td>Family member of PEP</td>
            <td>Off</td>
            <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['family_member_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['family_member_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>24</td>
            <td>Close associate of PEP</td>
            <td>Off</td>
            <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['close_associate_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['close_associate_pep_other_remark'].'
            </td>
            <td>
                
            </td>
        </tr>
        <tr>
            <td>25</td>
            <td>Relationship with Family member of PEP</td>
            <td>0</td>
            <td>1. Assess the relationship of customer with PEP<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['relationship_family_member_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['relationship_family_member_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>26</td>
            <td>Relationship with Close associate of PEP</td>
            <td>0</td>
            <td>1. Assess the relationship of customer with PEP<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['relationship_close_associate_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
                <
            </td>
            <td>
                '.$result_customer['relationship_close_associate_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>27</td>
            <td>Name of PEP</td>
            <td>dummy name</td>
            <td>1. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results if the name has not been screened</td>
            <td>';
            $html .= ($result_customer['name_of_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['name_of_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>28</td>
            <td>Country/ international organisation which PEP holds prominent public function</td>
            <td>'.$result_officer['residential_address_country'].'</td>
            <td>1. Verify against the screening results</td>
            <td>';
            $html .= ($result_customer['country_international_org_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['country_international_org_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>29</td>
            <td>Describe nature of prominent public function that the person is or has been entrusted with</td>
            <td>Dummy Association</td>
            <td>1. Assess the function of the PEP and the degree of risks.<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['nature_of_public_function'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['nature_of_public_function_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>

            <td>Period of time in which the person is/was a PEP</td>
            <td>NA</td>
            <td>1. Assess the function of the duration the individual is a PEP and the degree of risks. The handling of a client who is no longer entrusted with a prominent public function should be based on an assessment of risk and not on prescribed time limits<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
            <td>';
            $html .= ($result_customer['period_as_pep'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['period_as_pep_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <th colspan="8" style="text-align:center; font-size: 20px;">Section B: Info on Business Entity</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Entity Name</td>
            <td>'.$result_officer['officer_name'].'</td>
            <td>1. Verify Entity Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
            <td>
            </td>
            <td>
                '.$result_customer['former_name_any_hit'].'
            </td>
            <td>
                '.$result_customer['entity_name_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Former Name</td>
            <td>NA</td>
            <td>1. Verify Former Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
            <td>
            </td>
           <td>
                '.$result_customer['former_name_any_hit'].'
            </td>
            <td>
                '.$result_customer['former_name_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Trading Name</td>
            <td>NA</td>
            <td>1. Verify Trading Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
            <td>
            </td>
            <td>
            '.$result_customer['trading_name_any_hit'].'
            </td>
            <td>
                '.$result_customer['trading_name_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Address or intended address of the registered office*</td>
            <td>NA</td>
            <td>1. Verify address against the documents of incorporation (if any).<br>2. Assess if it is using the Tianlong digital mailbox or a PO box address. This is one of the indicators of a shell company, however, assessment needs to be done holistically with other factors to determine if the company is a shell company. Input "High" under the Risk Score column.<br>3. Otherwise, input the country of registered office under the manual overrides and the Risk Score based on the Country Risk Rating tab.</td>
            <td>';
            $html .= ($result_customer['address_registered_office'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['address_registered_office_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Address of principal place of business (if different from above)</td>
            <td>NA</td>
            <td>Same as above if address is different</td>
            <td>';
            $html .= ($result_customer['address_principal_place_business'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['address_principal_place_business_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Place/Country or Proposed Place/Country of registration*</td>
            <td>NA</td>
            <td>1. Verify Country of registration against the documents of incorporation (if any).</td>
            <td>';
            $html .= ($result_customer['country_registration'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['country_registration_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Nature of business</td>
            <td>NA</td>
            <td>1. Verify Nature of business against the documents of incorporation (if any)<br>2. Refer to the Industry Risk Rating and assign a Risk Rating under Risk Score.</td>
            <td>';
            $html .= ($result_customer['nature_of_business'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['nature_of_business_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Countries that the customer’s/client’s business mostly is transacting with</td>
            <td>NA</td>
            <td>1. Verify against any company documents / bank statement provided (if any)<br>2. If the Entity transacts with more than 1 nationality, insert rows below this row and manually input the countries under the manual overrides to obtain the Risk Score based on the Country Risk Rating tab.</td>
            <td>';
            $html .= ($result_customer['transaction_countries'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
            <td>
            </td>
            <td>
                '.$result_customer['transaction_countries_other_remark'].'
            </td>
            <td>
            </td>
        </tr>


        <tr>
            <th colspan="8" style="text-align:center; font-size: 20px;">Section C: Applicable for Enhanced Due Diligence</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Information on the person’s source of wealth </td> 
            <td>NA</td>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>
                '.$result_customer['info_person_wealth_other_remark'].'
            </td>
            <td>
                
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Information on the person’s source of funds in the establishment of the business relationship or in the proposed business relationship </td>
            <td>NA</td>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>
                '.$result_customer['info_person_fund_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Other Information</td>
            <td>NA</td>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>
                '.$result_customer['other_info_other_remark'].'
            </td>
            <td>
            </td>
        </tr>
    </tbody>
</table>
<h1 style="text-align:center;"> Risk Assessment Form</h1>
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
            <td>';
            $html .= ($result_risk['forming_of_corporations'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Acting, or arranging for another person to act <br>i) as a director or secretary of a corporation; ii) partner of a partnership; or iii) a position similar to the above in relation to other legal persons</td>
            <td>';
            $html .= ($result_risk['acting_as_director_or_secretary'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Acting, or arranging for another person to act as a shareholder on behalf of any corporation other than one whose securities are listed on a securities exchange under section 2(1) or recognised securities exchange under section 283(1) of the Securities and Futures Act</td>
             <td>';
            $html .= ($result_risk['acting_as_shareholder'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Providing a registered office, business address or correspondence or administrative address or other related services</td>
             <td>';
            $html .= ($result_risk['providing_registered_office'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Buying and selling of real estates</td>
             <td>';
            $html .= ($result_risk['buying_and_selling_real_estates'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Managing of client money, securities or other assets</td>
             <td>';
            $html .= ($result_risk['managing_client_money'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Management of bank, savings or securities accounts</td>
            <td>';
            $html .= ($result_risk['management_of_accounts'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>8</td>
            <td>Organisation of contributions for the creation, operation or management of companies</td>
            <td>';
            $html .= ($result_risk['organisation_of_contributions'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Buying and selling of business entities</td>
            <td>';
            $html .= ($result_risk['buying_and_selling_business_entities'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>10</td>
            <td>Statutory audit services</td>
            <td>';
            $html .= ($result_risk['statutory_audit_services'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td></td>
            <td>Indicate the type of service rendered: <br>Providing other services (e.g. Annual Return filing, etc.)</td>
            <td>';
            $html .= ($result_risk['providing_other_services'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">Section B1: Customer&#39;s/Client Risk Factors</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Is this a new customer/client?</td>
            <td>';
            $html .= ($result_risk['new_customer"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Is the customer/client a public company listed on any stock exchange not subjected to disclosure requirements?</td>
            <td>';
            $html .= ($result_risk['public_company"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Is the customer/client a legal person or an entity that can hold assets in its own name?</td>
            <td>';
            $html .= ($result_risk['legal_person"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>4a</td>
            <td>Does the customer/client use nominee director(s) or shareholder(s)?</td>
            <td>';
            $html .= ($result_risk['nominee_director"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>4b</td>
            <td>Where applicable, do the nominee shareholders represent majority ownership?</td>
            <td>';
            $html .= ($result_risk['nominee_shareholders"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Does the ownership structure of the customer/client appear unusual or excessively complex given the nature of its business?</td>
            <td>';
            $html .= ($result_risk['ownership_structure"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Is the customer/client’s business cash-intensive?</td>
            <td>';
            $html .= ($result_risk['cash_intensive"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Does the customer/client frequently make unaccounted cash transactions to similar recipient(s)?</td>
            <td>';
            $html .= ($result_risk['unaccounted_cash"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>8</td>
            <td>Do the proposed directors/partners/shareholders have prior criminal convictions involving fraud or dishonesty?</td>
            <td>';
            $html .= ($result_risk['criminal_convictions"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Is any of the customer/client, beneficial owner or its agent a politically exposed person?</td>
            <td>';
            $html .= ($result_risk['politically_exposed"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>10</td>
            <td>Are the customer/client’s company accounts outdated?</td>
            <td>';
            $html .= ($result_risk['outdated_accounts"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>11</td>
            <td>Do the customer/client’s shareholders and/or directors frequently change, and the changes are within reason?</td>
            <td>';
            $html .= ($result_risk['frequent_changes"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Is there any problem obtaining the required information in the relevant form?</td>
            <td>';
            $html .= ($result_risk['problem_obtaining_info"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>13</td>
            <td>Can the information obtained be verified by independent and reliable sources?</td>
            <td>';
            $html .= ($result_risk['info_verified"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>14</td>
            <td>Is the customer/client a charitable or non-profit organisation that is not registered in Singapore?</td>
            <td>';
            $html .= ($result_risk['non_profit"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>15</td>
            <td>Does the client appear to be a shell company?</td>
            <td>';
            $html .= ($result_risk['shell_company"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>16</td>
            <td>Is the client in a high-risk industry?</td>
            <td>';
            $html .= ($result_risk['high_risk_industry"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>17</td>
            <td>Are there adverse news or information arising?</td>
            <td>';
            $html .= ($result_risk['adverse_news"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>18</td>
            <td>Exceptions noted cannot be disposed of satisfactorily.</td>
            <td>';
            $html .= ($result_risk['exceptions_noted"'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>Count of "Yes"</td>
            <td>If “Yes” has been selected for the majority of the 18 questions above, you are advised to adopt a risk-sensitive approach and perform enhanced CDD measures before establishing a business relationship with the customer/client.</td>
             <td >'.$result_risk['customers_client_risk_factors'].'</td>
        </tr>
        <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">B2 Country/Territory Risk Factors</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that is identified as not having adequate antimoney laundering or counter financing terrorism measures?</td>
            <td>';
            $html .= ($result_risk['aml_measures'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that has dealings with high-risk jurisdiction?</td>
            <td>';
            $html .= ($result_risk['high_risk_jurisdiction'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that is sanctioned by a regulatory body, such as the United Nations (UN)?</td>
            <td>';
            $html .= ($result_risk['sanctioned_country'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Is the customer/client connected to or transacting with a country or a territory that is identified to be funding or supporting terrorist activities or that have designated terrorist organizations operating within their territories?</td>
            <td>';
            $html .= ($result_risk['terrorist_support'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Is the customer/client connected to or transacting with a country or a territory in relation to which the FATF has called for countermeasures?</td>
            <td>';
            $html .= ($result_risk['fatf_countermeasures'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>Count of "Yes"</td>
            <td>Is “Yes” selected for any of the questions under B2 Country/Terrority Risk Factors?<br>If it has been selected for any of the questions above, you are advised to adopt a risk-sensitive approach and perform enhanced CDD measures before establishing a business relationship with the customer/client.</td>
            <td>'.$result_risk['country_territory_risk_factors'].'</td>
        </tr>
         <tr>
            <th colspan="3" style="text-align:center; font-size: 20px;">B3 Services/Transactions Risk Factors</th>
        </tr>
      <tr>
            <td>1</td>
            <td>Has the customer/client given any instruction to perform a transaction (which may include cash) anonymously?</td>
            <td>';
            $html .= ($result_risk['anonymous_transaction'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Has the customer/client transferred any funds without the provision of underlying services or transactions?</td>
            <td>';
            $html .= ($result_risk['funds_transfer_without_service'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Are there unusual patterns of transactions that have no apparent economic purpose or cash payments that are large in amount, in which disbursement would have been normally made by other modes of payment (such as cheque, bank drafts, etc.)?</td>
            <td>';
            $html .= ($result_risk['unusual_transaction_patterns'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Are there unaccounted payments received from unknown or unassociated third parties for services and/or transactions provided by the customer/client?</td>
            <td>';
            $html .= ($result_risk['unaccounted_payments'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Is there instruction from the customer/client to incorporate shell companies with nominee shareholder(s) and/or director(s)?</td>
            <td>';
            $html .= ($result_risk['shell_companies_incorporation'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Does the customer/client purchase companies or business entities that have no obvious commercial purpose?<br>This would include: <br>- Multi-layer, multi-country and complex group structures. <br>- Setting up entities in Singapore where there is no obvious commercial purpose, or any other personal or economic connection to the client.</td>
            <td>';
            $html .= ($result_risk['purchase_no_commercial_purpose'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Is this business relationship being established without any physical meeting?</td>
            <td>';
            $html .= ($result_risk['no_physical_meeting_relationship'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>8</td>
            <td>Are there any transactions being performed without any physical meeting?</td>
            <td>';
            $html .= ($result_risk['no_physical_meeting_transactions'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Are the transactions required by the customer/client inconsistent with the professional intermediaries’ knowledge on the customer/client’s risk profile and nature of business?</td>
            <td>';
            $html .= ($result_risk['inconsistent_transactions'] == 1) ? 'Yes' : 'No';
            $html .= '</td>
        </tr>
        <tr>
            <td>Count of "Yes"</td>
            <td>If “Yes” has been selected for the majority of the 9 questions above, you are advised to adopt a risk-sensitive approach and perform enhanced CDD measures before establishing a business relationship with the customer/client.</td>
            <td>'.$result_risk['services_transactions_risk_factors'].'</td>
        </tr>    
    </tbody>
</table>
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
        <div class="container">
            <div class="section">
                <h2>Date .....................................</h2>
                <h2>Signature .................................</h2>
                <h1>(Sign By Compliance)</h1>
            </div>

            <div class="section">
                <h2>Date .....................................</h2>
                <h2>Signature .................................</h2>
                <h1>(Sign By Super Admin)</h1>
            </div>
        </div>';
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
    $filename = 'customer_' . date('Ymd_His') . '.pdf';

    // Define the path where you want to save the PDF
    $uploadDir = __DIR__ . '/../uploads/customer_acceptance_form/';
    $path = $uploadDir . $filename;
    $cddkyc_flag = mysqli_query($link,"UPDATE officer SET cddkyc_customer_pdf = '$filename' WHERE id ='$officer_id' AND cr_id ='$company_id'");
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

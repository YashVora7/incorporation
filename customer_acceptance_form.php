<?php
// require_once '../session.php';
 require_once '../db.php';
require_once '../baseUrl.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }
        th, td {
            padding: full_name
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        caption {
            font-size: 1.5em;
            margin: 10px 0;
        }
    </style>
</head>
<body>
	<h1 style="text-align: center;">Customer Acceptance Form</h1>
<table>
    <thead>
	    <tr>
	        <th>Sr.No</th>
	        <th>Customer Info</th>
	        <th>Action Required</th>
	        <th>Verified?</th>
	        <th>Any hits?</th>
	        <th>Other Remark</th>
	        <th>Risk Score</th>
	    </tr>
	</thead>
	<tbody>
	    <tr>
	        <td colspan="7" style="text-align:center;">Section A Individual Info</td>
	    </tr>
	    <tr>
	        <td>1</td>
	        <td>Envelope ID</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="envelope_id_hits" id="envelope_id_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="envelope_id_remark" id="envelope_id_remark"></textarea></td>
	        <td>
	            <select name="envelope_id_risk" id="envelope_id_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>2</td>
	        <td>Account ID</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="account_id_hits" id="account_id_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="account_id_remark" id="account_id_remark"></textarea></td>
	        <td>
	            <select name="account_id_risk" id="account_id_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>3</td>
	        <td>Capacity of Customer</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="capacity_customer_hits" id="capacity_customer_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="capacity_customer_remark" id="capacity_customer_remark"></textarea></td>
	        <td>
	            <select name="capacity_customer_risk" id="capacity_customer_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>4</td>
	        <td>Capacity of CP</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="capacity_cp_hits" id="capacity_cp_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="capacity_cp_remark" id="capacity_cp_remark"></textarea></td>
	        <td>
	            <select name="capacity_cp_risk" id="capacity_cp_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>5</td>
	        <td>Capacity of Agent</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="capacity_agent_hits" id="capacity_agent_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="capacity_agent_remark" id="capacity_agent_remark"></textarea></td>
	        <td>
	            <select name="capacity_agent_risk" id="capacity_agent_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>6</td>
	        <td>Individual is BO of the Company</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="bo_company_hits" id="bo_company_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="bo_company_remark" id="bo_company_remark"></textarea></td>
	        <td>
	            <select name="bo_company_risk" id="bo_company_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>7</td>
	        <td>Individual is not a BO of the Company</td>
	        <td></td>
	        <td></td>
	        <td>
	            <select name="not_bo_company_hits" id="not_bo_company_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="not_bo_company_remark" id="not_bo_company_remark"></textarea></td>
	        <td>
	            <select name="not_bo_company_risk" id="not_bo_company_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
	    <tr>
	        <td>8</td>
	        <td>Provide information on the nature of beneficial ownership (e.g. more than 25% of ownership of the company) or person having executive authority</td>
	        <td>1. Verify against any company doc (no. of shares) &amp; shareholding structured provided to validate the inputs provided<br>2. Ensure that all BO information has been submitted</td>
	        <td>
	            <select name="beneficial_ownership" id="beneficial_ownership">
	                <option value="1">Yes</option>
	                <option value="0">No</option>
	            </select>
	        </td>
	        <td>
	            <select name="beneficial_ownership_hits" id="beneficial_ownership_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="beneficial_ownership_remark" id="beneficial_ownership_remark"></textarea></td>
	        <td>
	            <select name="beneficial_ownership_risk" id="beneficial_ownership_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
	    </tr>
		<tr>
		    <td>9</td>
		    <td>Full Name (including any aliases)*</td>
		    <td>1. Verify Identity against the identification documents provided<br>2. Refer to the Procedures Section of the Name Screening Guide (SentroWeb, Google Search &amp; Sanction List) to conduct name screenings &amp; Guidance - Assessment inputs tab to document results.<br>3. Input Risk Score based on assessment</td>
		    <td>
		        <select name="full_name" id="full_name">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
	            <select name="full_name_hits" id="full_name_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="full_name_remark" id="full_name_remark"></textarea></td>
	        <td>
	            <select name="full_name_risk" id="full_name_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
		</tr>
		<tr>
		    <td>10</td>
		    <td>Residential Address*</td>
		    <td>1. Verify identity against the identification documents provided<br>2. Update Country of Residence based on the Residential Address under Manual Overrides.</td>
		    <td>
		        <select name="residential_address" id="residential_address">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
	            <select name="residential_address_hits" id="residential_address_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><textarea name="residential_address_remark" id="residential_address_remark"></textarea></td>
	        <td>
	            <select name="residential_address_risk" id="residential_address_risk">
	                <option value="na">NA</option>
	                <option value="low">Low</option>
	                <option value="med">Med</option>
	                <option value="high">High</option>
	                <option value="high_edd">High (EDD required)</option>
	            </select>
	        </td>
		</tr>
		<tr>
		    <td>11</td>
		    <td>ID</td>
		    <td>1. Verify identity against the identification documents provided</td>
		    <td>
		        <select name="id" id="id">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="id_any_hit" id="id_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="id_other_remark" id="id_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="id_risk_score" id="id_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>12</td>
		    <td>Expiry date of ID</td>
		    <td>1. Verify identity against the identification documents provided<br>2. Track the expiry date of the ID and obtain an update 3 months before expiry for enhanced cases or during periodic review for normal and simplified cases. (Refer to tracker)</td>
		    <td>
		        <select name="expiry_date_id" id="expiry_date_id">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="expiry_date_id_any_hit" id="expiry_date_id_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="expiry_date_id_other_remark" id="expiry_date_id_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="expiry_date_id_risk_score" id="expiry_date_id_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>13</td>
		    <td>Date of Birth</td>
		    <td>1. Verify identity against the identification documents provided<br>2. Match against name screening results to validate the inputs where applicable to clear the hits</td>
		    <td>
		        <select name="date_of_birth" id="date_of_birth">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="date_of_birth_any_hit" id="date_of_birth_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="date_of_birth_other_remark" id="date_of_birth_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="date_of_birth_risk_score" id="date_of_birth_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>14</td>
		    <td>Gender Male</td>
		    <td>1. Match against name screening results to validate the inputs where applicable to clear the hits</td>
		    <td>
		        <select name="gender_male" id="gender_male">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="gender_male_any_hit" id="gender_male_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="gender_male_other_remark" id="gender_male_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="gender_male_risk_score" id="gender_male_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>15</td>
		    <td>Gender Female</td>
		    <td>1. Match against name screening results to validate the inputs where applicable to clear the hits</td>
		    <td>
		        <select name="gender_female" id="gender_female">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="gender_female_any_hit" id="gender_female_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="gender_female_other_remark" id="gender_female_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="gender_female_risk_score" id="gender_female_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>16</td>
		    <td>Nationality/Nationalities (where applicable)*</td>
		    <td>1. Verify Identity against the identification documents provided<br>2. If the individual has more than 1 nationality, insert rows below this row and manually input the nationalities under the manual overrides to obtain the Risk Score based on the Country Risk Rating tab</td>
		    <td>
		        <select name="nationality" id="nationality">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="nationality_any_hit" id="nationality_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="nationality_other_remark" id="nationality_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="nationality_risk_score" id="nationality_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>17</td>
		    <td>Intended nature and purpose of business relationship</td>
		    <td></td>
		    <td>
		        <select name="business_relationship" id="business_relationship">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="business_relationship_any_hit" id="business_relationship_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="business_relationship_other_remark" id="business_relationship_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="business_relationship_risk_score" id="business_relationship_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>18</td>
		    <td>Individual is a PEP</td>
		    <td>1. Match against name screening results to validate the inputs</td>
		    <td>
		        <select name="is_pep" id="is_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="is_pep_any_hit" id="is_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="is_pep_other_remark" id="is_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="is_pep_risk_score" id="is_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>19</td>
		    <td>Individual is not a PEP</td>
		    <td>1. Match against name screening results to validate the inputs</td>
		    <td>
		        <select name="not_pep" id="not_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="not_pep_any_hit" id="not_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="not_pep_other_remark" id="not_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="not_pep_risk_score" id="not_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>20</td>
		    <td>Singapore PEP</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="singapore_pep" id="singapore_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="singapore_pep_any_hit" id="singapore_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="singapore_pep_other_remark" id="singapore_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="singapore_pep_risk_score" id="singapore_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>21</td>
		    <td>Foreign PEP</td>
		    <td>1. If this field is selected, conduct enhanced due diligence.</td>
		    <td>
		        <select name="foreign_pep" id="foreign_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="foreign_pep_any_hit" id="foreign_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="foreign_pep_other_remark" id="foreign_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="foreign_pep_risk_score" id="foreign_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>22</td>
		    <td>International Organisation PEP</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="international_organisation_pep" id="international_organisation_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="international_organisation_pep_any_hit" id="international_organisation_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="international_organisation_pep_other_remark" id="international_organisation_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="international_organisation_pep_risk_score" id="international_organisation_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>23</td>
		    <td>Family member of PEP</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="family_member_pep" id="family_member_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="family_member_pep_any_hit" id="family_member_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="family_member_pep_other_remark" id="family_member_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="family_member_pep_risk_score" id="family_member_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>24</td>
		    <td>Close associate of PEP</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="close_associate_pep" id="close_associate_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="close_associate_pep_any_hit" id="close_associate_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="close_associate_pep_other_remark" id="close_associate_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="close_associate_pep_risk_score" id="close_associate_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>25</td>
		    <td>Relationship with Family member of PEP</td>
		    <td>1. Assess the relationship of customer with PEP<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="relationship_family_member_pep" id="relationship_family_member_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="relationship_family_member_pep_any_hit" id="relationship_family_member_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="relationship_family_member_pep_other_remark" id="relationship_family_member_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="relationship_family_member_pep_risk_score" id="relationship_family_member_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>26</td>
		    <td>Relationship with Close associate of PEP</td>
		    <td>1. Assess the relationship of customer with PEP<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="relationship_close_associate_pep" id="relationship_close_associate_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="relationship_close_associate_pep_any_hit" id="relationship_close_associate_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="relationship_close_associate_pep_other_remark" id="relationship_close_associate_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="relationship_close_associate_pep_risk_score" id="relationship_close_associate_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>27</td>
		    <td>Name of PEP</td>
		    <td>1. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results if the name has not been screened</td>
		    <td>
		        <select name="name_of_pep" id="name_of_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="name_of_pep_any_hit" id="name_of_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="name_of_pep_other_remark" id="name_of_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="name_of_pep_risk_score" id="name_of_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>28</td>
		    <td>Country/ international organisation which PEP holds prominent public function</td>
		    <td>1. Verify against the screening results</td>
		    <td>
		        <select name="country_international_org_pep" id="country_international_org_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="country_international_org_pep_any_hit" id="country_international_org_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="country_international_org_pep_other_remark" id="country_international_org_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="country_international_org_pep_risk_score" id="country_international_org_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>29</td>
		    <td>Describe nature of prominent public function that the person is or has been entrusted with</td>
		    <td>1. Assess the function of the PEP and the degree of risks.<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="nature_of_public_function" id="nature_of_public_function">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="nature_of_public_function_any_hit" id="nature_of_public_function_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="nature_of_public_function_other_remark" id="nature_of_public_function_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="nature_of_public_function_risk_score" id="nature_of_public_function_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>30</td>
		    <td>Period of time in which the person is/was a PEP</td>
		    <td>1. Assess the function of the duration the individual is a PEP and the degree of risks. The handling of a client who is no longer entrusted with a prominent public function should be based on an assessment of risk and not on prescribed time limits<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="period_as_pep" id="period_as_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="period_as_pep_any_hit" id="period_as_pep_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="period_as_pep_other_remark" id="period_as_pep_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="period_as_pep_risk_score" id="period_as_pep_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
        <tr>
            <td colspan="4" style="text-align:center;">Section B: Info on Business Entity</td>
        </tr>
        <tr>
		    <td>1</td>
		    <td>Entity Name</td>
		    <td>1. Verify Entity Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
		    <td>
		        <select name="entity_name" id="entity_name">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="entity_name_any_hit" id="entity_name_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="entity_name_other_remark" id="entity_name_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="entity_name_risk_score" id="entity_name_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>2</td>
		    <td>Former Name</td>
		    <td>1. Verify Former Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
		    <td>
		        <select name="former_name" id="former_name">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="former_name_any_hit" id="former_name_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="former_name_other_remark" id="former_name_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="former_name_risk_score" id="former_name_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>3</td>
		    <td>Trading Name</td>
		    <td>1. Verify Trading Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
		    <td>
		        <select name="trading_name" id="trading_name">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="trading_name_any_hit" id="trading_name_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="trading_name_other_remark" id="trading_name_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="trading_name_risk_score" id="trading_name_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>4</td>
		    <td>Address or intended address of the registered office*</td>
		    <td>1. Verify address against the documents of incorporation (if any).<br>2. Assess if it is using the Tianlong digital mailbox or a PO box address. This is one of the indicators of a shell company, however, assessment needs to be done holistically with other factors to determine if the company is a shell company. Input "High" under the Risk Score column.<br>3. Otherwise, input the country of registered office under the manual overrides and the Risk Score based on the Country Risk Rating tab.</td>
		    <td>
		        <select name="address_registered_office" id="address_registered_office">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="address_registered_office_any_hit" id="address_registered_office_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="address_registered_office_other_remark" id="address_registered_office_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="address_registered_office_risk_score" id="address_registered_office_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>5</td>
		    <td>Address of principal place of business (if different from above)</td>
		    <td>Same as above if address is different</td>
		    <td>
		        <select name="address_principal_place_business" id="address_principal_place_business">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="address_principal_place_business_any_hit" id="address_principal_place_business_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="address_principal_place_business_other_remark" id="address_principal_place_business_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="address_principal_place_business_risk_score" id="address_principal_place_business_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>6</td>
		    <td>Place/Country or Proposed Place/Country of registration*</td>
		    <td>1. Verify Country of registration against the documents of incorporation (if any).</td>
		    <td>
		        <select name="country_registration" id="country_registration">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="country_registration_any_hit" id="country_registration_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="country_registration_other_remark" id="country_registration_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="country_registration_risk_score" id="country_registration_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>7</td>
		    <td>Nature of business</td>
		    <td>1. Verify Nature of business against the documents of incorporation (if any)<br>2. Refer to the Industry Risk Rating and assign a Risk Rating under Risk Score.</td>
		    <td>
		        <select name="nature_of_business" id="nature_of_business">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="nature_of_business_any_hit" id="nature_of_business_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="nature_of_business_other_remark" id="nature_of_business_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="nature_of_business_risk_score" id="nature_of_business_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>
		<tr>
		    <td>8</td>
		    <td>Countries that the customer’s/client’s business mostly is transacting with</td>
		    <td>1. Verify against any company documents / bank statement provided (if any)<br>2. If the Entity transacts with more than 1 nationality, insert rows below this row and manually input the countries under the manual overrides to obtain the Risk Score based on the Country Risk Rating tab.</td>
		    <td>
		        <select name="transaction_countries" id="transaction_countries">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <select name="transaction_countries_any_hit" id="transaction_countries_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <textarea name="transaction_countries_other_remark" id="transaction_countries_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="transaction_countries_risk_score" id="transaction_countries_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
		</tr>


        <tr>
            <td colspan="4" style="text-align:center;">Section C: Applicable for Enhanced Due Diligence</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Information on the person’s source of wealth </td>
            <td></td>
            <td></td>
            <td>
		    </td>
		    <td>
		        <textarea name="info_person_wealth_other_remark" id="info_person_wealth_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="info_person_wealth_risk_score" id="info_person_wealth_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Information on the person’s source of funds in the establishment of the business relationship or in the proposed business relationship </td>
            <td></td>
            <td></td>
            <td>
		    </td>
		    <td>
		        <textarea name="info_person_fund_other_remark" id="info_person_fund_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="info_person_fund_risk_score" id="info_person_fund_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Other Information</td>
            <td></td>
            <td></td>
            <td>
		    </td>
		    <td>
		        <textarea name="other_info_other_remark" id="other_info_other_remark"></textarea>
		    </td>
		    <td>
		        <select name="other_info_risk_score" id="other_info_risk_score">
		            <option value="na">NA</option>
		            <option value="low">Low</option>
		            <option value="med">Med</option>
		            <option value="high">High</option>
		            <option value="high_edd">High (EDD required)</option>
		        </select>
		    </td>
        </tr>
    </tbody>
</table>
</body>
</html>

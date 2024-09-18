<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
?>
<?php
$officer_id = $_GET['officer_id'] ?? null;
$company_id = $_GET['company_id'] ?? null;

$sql_officer = "SELECT * FROM officer WHERE id = '$officer_id '";
$execute_officer = mysqli_query($link,$sql_officer);
$result_officer = mysqli_fetch_assoc($execute_officer);

$sql_edd_exist = "SELECT * FROM edd_form_conduct WHERE company_id = '$company_id' AND officer_id = '$officer_id'";
$execute_edd_exist = mysqli_query($link, $sql_edd_exist);

if ($execute_edd_exist) {
   $edd_row_exist = mysqli_num_rows($execute_edd_exist);
} else {
    // Handle the query error
    echo "Error: " . mysqli_error($link);
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
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
    tr:nth-child(3) td{
    	width: 600px;
    }
    /* Custom width for the third column */
    tr:hover {
        background-color: #f1f1f1;
    }
    select, input {
        width: 100%;
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
    /* Container for the table with a fixed height and overflow for scrolling */
	.table-container {
	    max-height: 800px; /* Adjust this as needed */
	    overflow-y: auto;
	    scroll-behavior: smooth; /* Enables smooth scrolling */
	  margin-bottom: 20px;
	}

	/* Sticky header styling */
	.sticky-header th {
	    position: sticky;
	    top: 0;
	    background-color: #ffffff; /* Background color for the sticky header */
	    z-index: 1;
	    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4); /* Optional: shadow for a floating effect */
	    padding: 10px; /* Padding for the table headers */
	}
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>
</head>
<body>
<div class="d-flex align-items-center">
	   <img src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="image-fluid" style="width: 5%;">
	   <h1 class="mx-auto">Customer Acceptance Form</h1>
</div>

<div class="table-container">
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
	<form method="post" action="risk_assessment.php">
		<input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id;?>">
		<input type="hidden" name="officer_id" id="officer_id" value="<?php echo $officer_id;?>">

	<tbody>
	    <tr>
	        <th colspan="8" style="text-align:center; font-size: 20px;">Section A Individual Info</th>
	    </tr>
	    <tr>
	        <td>1</td>
	        <td>Envelope ID</td>
	        <td><?php echo $result_officer['id'];?></td>
	        <td></td>
	        <td></td>
	        <td>
	           
	        </td>
	        <td><input type="text" name="envelope_id_remark" id="envelope_id_remark"></td>
	        <td>
	            
	        </td>
	    </tr>
	    <tr>
	        <td>2</td>
	        <td>Account ID</td>
	        <td><?php echo $result_officer['id'];?></td>
	        <td></td>
	        <td></td>
	        <td>
	        </td>
	        <td><input type="text" name="account_id_remark" id="account_id_remark"></td>
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
	        <td><input type="text" name="capacity_customer_remark" id="capacity_customer_remark"></td>
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
	        <td><input type="text" name="capacity_cp_remark" id="capacity_cp_remark"></td>
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
	        <td><input type="text" name="capacity_agent_remark" id="capacity_agent_remark"></td>
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
	        <td><input type="text" name="bo_company_remark" id="bo_company_remark"></td>
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
	        <td><input type="text" name="not_bo_company_remark" id="not_bo_company_remark"></td>
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
	        <td><input type="text" name="beneficial_ownership_remark" id="beneficial_ownership_remark"></td>
	        <td>
	        </td>
	    </tr>
		<tr>
		    <td>9</td>
		    <td>Full Name (including any aliases)*</td> 
		    <td><?php echo $result_officer['officer_name'];?></td>
		    <td>1. Verify Identity against the identification documents provided<br>2. Refer to the Procedures Section of the Name Screening Guide (SentroWeb, Google Search &amp; Sanction List) to conduct name screenings &amp; Guidance - Assessment inputs tab to document results.<br>3. Input Risk Score based on assessment</td>
		   
		    <td>
		    </td>
		    <td>
	            <select name="full_name_hits" id="full_name_hits">
	                <option value="no_hits">No hits</option>
	                <option value="false_hits">False hits</option>
	                <option value="true_hits">True hits</option>
	            </select>
	        </td>
	        <td><input type="text" name="full_name_remark" id="full_name_remark"></td>
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
		    <td><?php echo $result_officer['residential_address_country'];?></td>
		    <td>1. Verify identity against the identification documents provided<br>2. Update Country of Residence based on the Residential Address under Manual Overrides.</td>
		    
		    <td>
		    </td>
		    <td>
	        </td>
	        <td><input type="text" name="residential_address_remark" id="residential_address_remark"></td>
	        <td>
	        </td>
		</tr>
		<tr>
		    <td>11</td>
		    <td>ID</td>
		    <td><?php echo $result_officer['nric_or_id_number'];?></td>
		    <td>1. Verify identity against the identification documents provided</td>
		    <td>
		        <select name="id" id="id">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="id_other_remark" id="id_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>12</td>
		    <td>Expiry date of ID</td>
		    <td><?php echo $result_officer['officer_passport_expiration'];?></td>
		    <td>1. Verify identity against the identification documents provided<br>2. Track the expiry date of the ID and obtain an update 3 months before expiry for enhanced cases or during periodic review for normal and simplified cases. (Refer to tracker)</td>
		    <td>
		    	<select name="expiry_date_id" id="expiry_date_id">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="expiry_date_id_other_remark" id="expiry_date_id_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>13</td>
		    <td>Date of Birth</td>
		    <td>NA</td>
		    <td>1. Verify identity against the identification documents provided<br>2. Match against name screening results to validate the inputs where applicable to clear the hits</td>
		    <td>
		        <select name="date_of_birth" id="date_of_birth">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		     </td>
		     <td>
		        <input type="text" name="date_of_birth_other_remark" id="date_of_birth_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>14</td>
		    <td>Gender Male</td>
		    <td>off</td>
		    <td>1. Match against name screening results to validate the inputs where applicable to clear the hits</td>
		    <td>
		        <select name="gender_male" id="gender_male">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="gender_male_other_remark" id="gender_male_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>15</td>
		    <td>Gender Female</td>
		    <td>on</td>
		    <td>1. Match against name screening results to validate the inputs where applicable to clear the hits</td>
		    <td>
		        <select name="gender_female" id="gender_female">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="gender_female_other_remark" id="gender_female_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>16</td>
		    <td>Nationality/Nationalities (where applicable)*</td>
		    <td><?php echo $result_officer['officer_passport_nationality'];?></td>
		    <td>1. Verify Identity against the identification documents provided<br>2. If the individual has more than 1 nationality, insert rows below this row and manually input the nationalities under the manual overrides to obtain the Risk Score based on the Country Risk Rating tab</td>
		    <td>
		        <select name="nationality" id="nationality">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="nationality_other_remark" id="nationality_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>17</td>
		    <td>Intended nature and purpose of business relationship</td>
		    <td>Both</td>
		    <td></td>
		    <td>
		        <select name="business_relationship" id="business_relationship">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="business_relationship_other_remark" id="business_relationship_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>18</td>
		    <td>Individual is a PEP</td>
		    <td>On</td>
		    <td>1. Match against name screening results to validate the inputs</td>
		    <td>
		        <select name="is_pep" id="is_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="is_pep_other_remark" id="is_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>19</td>
		    <td>Individual is not a PEP</td>
		    <td>Off/td>
		    <td>1. Match against name screening results to validate the inputs</td>
		    <td>
		        <select name="not_pep" id="not_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="not_pep_other_remark" id="not_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>20</td>
		    <td>Singapore PEP</td>
		    <td>Off</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="singapore_pep" id="singapore_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="singapore_pep_other_remark" id="singapore_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>21</td>
		    <td>Foreign PEP</td>
		    <td>On</td>
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
		        <input type="text" name="foreign_pep_other_remark" id="foreign_pep_other_remark">
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
		    <td>Off</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="international_organisation_pep" id="international_organisation_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="international_organisation_pep_other_remark" id="international_organisation_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>23</td>
		    <td>Family member of PEP</td>
		    <td>Off</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="family_member_pep" id="family_member_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="family_member_pep_other_remark" id="family_member_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>24</td>
		    <td>Close associate of PEP</td>
		    <td>Off</td>
		    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="close_associate_pep" id="close_associate_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="close_associate_pep_other_remark" id="close_associate_pep_other_remark">
		    </td>
		    <td>
		        
		    </td>
		</tr>
		<tr>
		    <td>25</td>
		    <td>Relationship with Family member of PEP</td>
		    <td>0</td>
		    <td>1. Assess the relationship of customer with PEP<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="relationship_family_member_pep" id="relationship_family_member_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="relationship_family_member_pep_other_remark" id="relationship_family_member_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>26</td>
		    <td>Relationship with Close associate of PEP</td>
		    <td>0</td>
		    <td>1. Assess the relationship of customer with PEP<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="relationship_close_associate_pep" id="relationship_close_associate_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		        <
		    </td>
		    <td>
		        <input type="text" name="relationship_close_associate_pep_other_remark" id="relationship_close_associate_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>27</td>
		    <td>Name of PEP</td>
		    <td>dummy name</td>
		    <td>1. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results if the name has not been screened</td>
		    <td>
		        <select name="name_of_pep" id="name_of_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="name_of_pep_other_remark" id="name_of_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>28</td>
		    <td>Country/ international organisation which PEP holds prominent public function</td>
		    <td><?php echo $result_officer['residential_address_country'];?></td>
		    <td>1. Verify against the screening results</td>
		    <td>
		        <select name="country_international_org_pep" id="country_international_org_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="country_international_org_pep_other_remark" id="country_international_org_pep_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>29</td>
		    <td>Describe nature of prominent public function that the person is or has been entrusted with</td>
		    <td>Dummy Association</td>
		    <td>1. Assess the function of the PEP and the degree of risks.<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="nature_of_public_function" id="nature_of_public_function">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="nature_of_public_function_other_remark" id="nature_of_public_function_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>30</td>
		    <td>Period of time in which the person is/was a PEP</td>
		    <td>NA</td>
		    <td>1. Assess the function of the duration the individual is a PEP and the degree of risks. The handling of a client who is no longer entrusted with a prominent public function should be based on an assessment of risk and not on prescribed time limits<br>2. Document under “Other Remarks” the reasons for the decision of the extent of the due diligence.</td>
		    <td>
		        <select name="period_as_pep" id="period_as_pep">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="period_as_pep_other_remark" id="period_as_pep_other_remark">
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
		    <td><?php echo $result_officer['officer_name'];?></td>
		    <td>1. Verify Entity Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings & Assessment inputs tab to document results.</td>
		    <td>
		    </td>
		    <td>
		        <select name="former_name_any_hit" id="former_name_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <input type="text" name="entity_name_other_remark" id="entity_name_other_remark">
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
		        <select name="former_name_any_hit" id="former_name_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <input type="text" name="former_name_other_remark" id="former_name_other_remark">
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
		        <select name="trading_name_any_hit" id="trading_name_any_hit">
		            <option value="no_hits">No hits</option>
		            <option value="false_hits">False hits</option>
		            <option value="true_hits">True hits</option>
		        </select>
		    </td>
		    <td>
		        <input type="text" name="trading_name_other_remark" id="trading_name_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>4</td>
		    <td>Address or intended address of the registered office*</td>
		    <td>NA</td>
		    <td>1. Verify address against the documents of incorporation (if any).<br>2. Assess if it is using the Tianlong digital mailbox or a PO box address. This is one of the indicators of a shell company, however, assessment needs to be done holistically with other factors to determine if the company is a shell company. Input "High" under the Risk Score column.<br>3. Otherwise, input the country of registered office under the manual overrides and the Risk Score based on the Country Risk Rating tab.</td>
		    <td>
		        <select name="address_registered_office" id="address_registered_office">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="address_registered_office_other_remark" id="address_registered_office_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>5</td>
		    <td>Address of principal place of business (if different from above)</td>
		    <td>NA</td>
		    <td>Same as above if address is different</td>
		    <td>
		        <select name="address_principal_place_business" id="address_principal_place_business">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="address_principal_place_business_other_remark" id="address_principal_place_business_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>6</td>
		    <td>Place/Country or Proposed Place/Country of registration*</td>
		    <td>NA</td>
		    <td>1. Verify Country of registration against the documents of incorporation (if any).</td>
		    <td>
		        <select name="country_registration" id="country_registration">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="country_registration_other_remark" id="country_registration_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>7</td>
		    <td>Nature of business</td>
		    <td>NA</td>
		    <td>1. Verify Nature of business against the documents of incorporation (if any)<br>2. Refer to the Industry Risk Rating and assign a Risk Rating under Risk Score.</td>
		    <td>
		        <select name="nature_of_business" id="nature_of_business">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="nature_of_business_other_remark" id="nature_of_business_other_remark">
		    </td>
		    <td>
		    </td>
		</tr>
		<tr>
		    <td>8</td>
		    <td>Countries that the customer’s/client’s business mostly is transacting with</td>
		    <td>NA</td>
		    <td>1. Verify against any company documents / bank statement provided (if any)<br>2. If the Entity transacts with more than 1 nationality, insert rows below this row and manually input the countries under the manual overrides to obtain the Risk Score based on the Country Risk Rating tab.</td>
		    <td>
		        <select name="transaction_countries" id="transaction_countries">
		            <option value="1">Yes</option>
		            <option value="0">No</option>
		        </select>
		    </td>
		    <td>
		    </td>
		    <td>
		        <input type="text" name="transaction_countries_other_remark" id="transaction_countries_other_remark">
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
		        <input type="text" name="info_person_wealth_other_remark" id="info_person_wealth_other_remark">
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
		        <input type="text" name="info_person_fund_other_remark" id="info_person_fund_other_remark">
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
		        <input type="text" name="other_info_other_remark" id="other_info_other_remark">
		    </td>
		    <td>
		    </td>
        </tr>
    </tbody>
</table>
</div>
   <div class="container">
            <button type="submit" name="customer" class="submit-btn">Submit</button>
    </div>
</form>


<!--end modal-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
		    // Get references to the select elements
		    var fullNameRisk = document.getElementById('full_name_risk');
		    var foreignPepRiskScore = document.getElementById('foreign_pep_risk_score');
		    var edd_row_exist = '<?php echo $edd_row_exist; ?>';
		    var is_edd_submit = '<?php echo isset($_SESSION['edd_submit']) ? addslashes($_SESSION['edd_submit']) : ''; ?>';
		   
		    // Function to show the modal
		    function showModal() {
		        var myModal = new bootstrap.Modal(document.getElementById('edd_form'));
		        myModal.show();
		    }

		    // Event listeners for the select elements

		   fullNameRisk.addEventListener('change', function() {
			    if (this.value === 'high_edd' && (edd_row_exist == 0 || is_edd_submit !== 1)) {
			        showModal();
			    }
			});

			foreignPepRiskScore.addEventListener('change', function() {
			    if (this.value === 'high_edd' && (edd_row_exist == 0 || is_edd_submit !== 1)) {
			        showModal();
			    }
			});

		});	
    </script>

<!-- Modal -->
<?php require_once 'modal.php'; ?>

<!--Edd modal-->
   



</body>
</html>

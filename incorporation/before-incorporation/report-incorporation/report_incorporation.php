<?php
require_once '../../session.php';
require_once '../../db.php';
require_once '../../baseUrl.php';

$sql = "SELECT o.*, c.*
        FROM officer o
        JOIN register_company c ON o.cr_id = c.id
        WHERE o.id = 33
        ORDER BY o.id DESC";

$execute = mysqli_query($link, $sql);
$result = mysqli_fetch_assoc($execute);

// Function to handle null values

function getValue($value) {
    // If the value is null or 'N/A', return the styled placeholder text
    if (is_null($value) || strtoupper($value) === 'NA') {
        return '<span style="color: black;"></span>';
    }
    // Otherwise, return the sanitized value
    return htmlspecialchars($value);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <table style="margin:auto;">
        <thead>
            <tr>
                <th colspan="2" style="text-align: center;">Company Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name of company</td>
                <td><?php echo getValue($result['company_name']); ?></td>
            </tr>
            <tr>
                <td>Suffix</td>
                <td><?php echo getValue($result['company_suffix']); ?></td>
            </tr>
            <tr>
                <td>Company type</td>
                <td><?php echo getValue($result['company_type']); ?></td>
            </tr>
            <tr>
                <td>Registered address</td>
                <td><?php echo getValue($result['registered_address']); ?></td>
            </tr>
            <tr>
                <td>Principal place of business address</td>
                <td><?php echo getValue($result['business_description']); ?></td>
            </tr>
            <tr>
                <td>Principal SSIC</td>
                <td><?php echo getValue($result['primary_company_activity']); ?></td>
            </tr>
            <tr>
                <td>Description of the principal activity of the company</td>
                <td><?php echo getValue($result['describe_company_activity']); ?></td>
            </tr>
            <tr>
                <td>Secondary SSIC</td>
                <td><?php echo getValue($result['secondary_company_activity']); ?></td>
            </tr>
            <tr>
                <td>Description of the secondary activity of the company</td>
                <td><?php echo getValue($result['secondary_company_activity']); ?></td>
            </tr>
            <tr>
                <td>Share capital currency</td>
                <td><?php echo getValue($result['share_capital_currency']); ?></td>
            </tr>
            <tr>
                <td>Shares payable</td>
                <td><?php echo getValue($result['share_payable']); ?></td>
            </tr>
            <tr>
                <td>Issued share capital</td>
                <td><?php echo getValue($result['issued_share_capital']); ?></td>
            </tr>
            <tr>
                <td>Number of shares</td>
                <td><?php echo getValue($result['number_of_shares']); ?></td>
            </tr>
            <tr>
                <td>Paid up</td>
                <td><?php echo getValue($result['paid_up']); ?></td>
            </tr>
            <tr>
                <td>Financial year end</td>
                <td><?php echo getValue($result['financial_year_end']); ?></td>
            </tr>
            <tr>
                <td>Required nominee director?</td>
                <td>N/A</td>
            </tr>
            <thead>
            <tr>
                <th colspan="2" style="text-align: center;">Officer 1</th>
            </tr>
            </thead>
            <tr>
                <td>Name</td>
                <td><?php echo getValue($result['officer_name']); ?></td>
            </tr>
            <tr>
                <td>Officer type</td>
                <td><?php echo getValue($result['officer_type']); ?></td>
            </tr>
            <tr>
                <td>Entity number</td>
                <td><?php echo getValue($result['entity_number']); ?></td>
            </tr>
            <tr>
                <td>Entity country of incorporation</td>
                <td><?php echo getValue($result['entity_country_of_incorporation']); ?></td>
            </tr>
            <tr>
                <td>Entity address</td>
                <td><?php echo getValue($result['corporate_entity_address']); ?></td>
            </tr>
            <tr>
                <td>Singapore citizen/PR?</td>
                <td><?php echo getValue($result['is_singapore_citizen']); ?></td>
            </tr>
            <tr>
                <td>Officer designation</td>
                <td><?php echo getValue($result['officer_designation']); ?></td>
            </tr>
            <tr>
                <td>If shareholder, how many % shares?</td>
                <td><?php echo getValue($result['percentage_of_shares']); ?></td>
            </tr>
            <tr>
                <td>Issued share capital allocation</td>
                <td><?php echo getValue($result['issued_share_capital_allocation']); ?></td>
            </tr>
            <tr>
                <td>Number of shares allocation</td>
                <td><?php echo getValue($result['number_of_shares_allocation']); ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?php echo getValue($result['officer_gender']); ?></td>
            </tr>
            <tr>
                <td>Residential address</td>
                <td><?php echo getValue($result['officer_residential_address']); ?></td>
            </tr>
            <tr>
                <td>Residential address country</td>
                <td><?php echo getValue($result['residential_address_country']); ?></td>
            </tr>
            <tr>
                <td>Residential postal code</td>
                <td><?php echo getValue($result['residential_address_postal_code']); ?></td>
            </tr>
            <tr>
                <td>NRIC / ID number</td>
                <td><?php echo getValue($result['nric_or_id_number']); ?></td>
            </tr>
            <tr>
                <td>Passport number (For foreigners only)</td>
                <td><?php echo getValue($result['officer_passport_number']); ?></td>
            </tr>
            <tr>
                <td>Passport expiration (For foreigners only)</td>
                <td><?php echo getValue($result['officer_passport_expiration']); ?></td>
            </tr>
            <tr>
                <td>Nationality</td>
                <td><?php echo getValue($result['officer_passport_nationality']); ?></td>
            </tr>
            <tr>
                <td>Country of birth</td>
                <td><?php echo getValue($result['officer_country_of_birth']); ?></td>
            </tr>
            <tr>
                <td>Date of birth</td>
                <td></td>
            </tr>
            <tr>
                <td>Phone contact number with country code</td>
                <td><?php echo getValue($result['officer_contact']); ?></td>
            </tr>
            <tr>
                <td>Email address</td>
                <td><?php echo getValue($result['officer_email_address']); ?></td>
            </tr>
        </tbody>
    </table>
  
    <?php if ($result['business_registration_certificate_of_entity'] != 'NA'): ?>  
    <div class="section">
        <h1>Uploaded business registration certificate of entity</h1>
            <img src="../../uploads/<?php echo htmlspecialchars($result['business_registration_certificate_of_entity']); ?>" alt="Business Registration Certificate">
    </div>
    <?php endif; ?>
    <?php if ($result['officer_nric_id_image'] != 'NA'): ?>
    <div class="section">
        <h1>Uploaded NRIC / ID card, front and back</h1>
            <img src="../../uploads/<?php echo htmlspecialchars($result['officer_nric_id_image']); ?>" alt="NRIC/ID Card">
    </div>
   <?php endif; ?>
   <?php if ($result['passport_image'] != 'NA'): ?>
    <div class="section">
        <h1>Uploaded Passport</h1>
            <img src="../../uploads/<?php echo htmlspecialchars($result['passport_image']); ?>" alt="Passport">
    </div>
  <?php endif; ?>
  <?php if ($result['proof_of_address_image'] != 'NA'): ?>
    <div class="section">
        <h1>Uploaded Proof of address</h1>
            <img src="../../uploads/<?php echo htmlspecialchars($result['proof_of_address_image']); ?>" alt="Proof of Address">
    </div> 
   <?php endif; ?>
</body>
</html>

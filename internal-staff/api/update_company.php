<?php
require_once '../db.php';
$return['message'] = '';
$return['result'] = print_r($_POST);
// Collect POST data
$company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
$company_suffix = isset($_POST['company_suffix']) ? $_POST['company_suffix'] : '';
$company_type = isset($_POST['company_type']) ? $_POST['company_type'] : '';
$registered_address = isset($_POST['registered_address']) ? $_POST['registered_address'] : '';
$describe_company_activity = isset($_POST['describe_company_activity']) ? $_POST['describe_company_activity'] : '';
$primary_company_activity = isset($_POST['primary_company_activity']) ? $_POST['primary_company_activity'] : '';
$secondary_company_activity = isset($_POST['secondary_company_activity']) ? $_POST['secondary_company_activity'] : '';
$business_description = isset($_POST['business_description']) ? $_POST['business_description'] : '';
$share_capital_currency = isset($_POST['share_capital_currency']) ? $_POST['share_capital_currency'] : '';
$issued_share_capital = isset($_POST['issued_share_capital']) ? (int)$_POST['issued_share_capital'] : 0;
$number_of_shares = isset($_POST['number_of_shares']) ? (int)$_POST['number_of_shares'] : 0;
$financial_year_end = isset($_POST['financial_year_end']) ? $_POST['financial_year_end'] : '';
$cryptocurrency_declaration = isset($_POST['cryptocurrency_declaration']) ? $_POST['cryptocurrency_declaration'] : '';
$accepts_payments = isset($_POST['accepts_payments']) ? $_POST['accepts_payments'] : '';
$provides_services = isset($_POST['provides_services']) ? $_POST['provides_services'] : '';
$manages_coins = isset($_POST['manages_coins']) ? $_POST['manages_coins'] : '';
$mas_license = isset($_POST['mas_license']) ? $_POST['mas_license'] : '';
$related_entities = isset($_POST['related_entities']) ? $_POST['related_entities'] : '';
$source_of_funds_interest_reason = isset($_POST['interest_reason']) ? implode(',', $_POST['interest_reason']) : '';
$source_of_funds_sources = isset($_POST['sources']) ? implode(',', $_POST['sources']) : '';
$source_of_funds_three_countries = isset($_POST['three_countries']) ? implode(',', $_POST['three_countries']) : '';
$more_about_you_objectives = isset($_POST['objectives']) ? implode(',', $_POST['objectives']) : '';
$more_about_you_hear_about_us = isset($_POST['hear_about_us']) ? implode(',', $_POST['hear_about_us']) : '';
$registered_office_address_line_1 = isset($_POST['address_line_1']) ? $_POST['address_line_1'] : '';
$registered_office_address_line_2 = isset($_POST['address_line_2']) ? $_POST['address_line_2'] : '';
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
$sql = "UPDATE companies SET 
    company_name = ?, company_suffix = ?, company_type = ?, registered_address = ?, 
    describe_company_activity = ?, primary_company_activity = ?, secondary_company_activity = ?,
    business_description = ?, share_capital_currency = ?, issued_share_capital = ?, 
    number_of_shares = ?, financial_year_end = ?, cryptocurrency_declaration = ?, 
    accepts_payments = ?, provides_services = ?, manages_coins = ?, mas_license = ?, 
    related_entities = ?, source_of_funds_interest_reason = ?, source_of_funds_sources = ?, 
    source_of_funds_three_countries = ?, more_about_you_objectives = ?, more_about_you_hear_about_us = ?, 
    registered_office_address_line_1 = ?, registered_office_address_line_2 = ?, 
    registered_office_postal_code = ?, registered_office_country = ?, 
    business_operations_address_line_1 = ?, business_operations_postal_code = ?, 
    business_operations_country = ?, operates_physical_store = ?, option_selected = ?, 
    director_name = ?, director_email = ?, director_country = ?, director_address = ?, 
    director_postal_code = ?, director_activity = ?, director_has_store = ?, 
    shareholder_name = ?, shareholder_email = ?, shareholder_country = ?, 
    nominee_duration = ?, with_accounting_plan = ?, with_security_deposit = ?, 
    agree_terms_conditions = ?
    WHERE user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssi", 
    $company_name, $company_suffix, $company_type, $registered_address, 
    $describe_company_activity, $primary_company_activity, $secondary_company_activity, 
    $business_description, $share_capital_currency, $issued_share_capital, 
    $number_of_shares, $financial_year_end, $cryptocurrency_declaration, 
    $accepts_payments, $provides_services, $manages_coins, $mas_license, 
    $related_entities, $source_of_funds_interest_reason, $source_of_funds_sources, 
    $source_of_funds_three_countries, $more_about_you_objectives, $more_about_you_hear_about_us, 
    $registered_office_address_line_1, $registered_office_address_line_2, 
    $registered_office_postal_code, $registered_office_country, 
    $business_operations_address_line_1, $business_operations_postal_code, 
    $business_operations_country, $operates_physical_store, $option_selected, 
    $director_name, $director_email, $director_country, $director_address, 
    $director_postal_code, $director_activity, $director_has_store, 
    $shareholder_name, $shareholder_email, $shareholder_country, 
    $nominee_duration, $with_accounting_plan, $with_security_deposit, 
    $agree_terms_conditions, $logged_user_id);

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Company information updated successfully.';
} else {
    $response['message'] = 'Failed to update company information.';
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>

<?php
require_once '../db.php';
// Prepare data for insertion
$return['message'] = '';
$last_cr_id = $_POST['last_cr_id'];
$officer_name = $_POST['officer_name'];
$officer_type = $_POST['officer_type'];
$officer_designation = $_POST['officer_designation'];
$nominee_director = $_POST['nominee_director'];
$entity_number = $_POST['entity_number'] ?? 'NA';
$entity_country_of_incorporation = $_POST['entity_country_of_incorporation'] == ''?'NA':$_POST['entity_country_of_incorporation'];
$corporate_entity_address = $_POST['corporate_entity_address'] == ''?'NA':$_POST['corporate_entity_address'];
//$business_registration_certificate_of_entity = $_POST['business_registration_certificate_of_entity'] ?? 'NA';
$name_of_ultimate_beneficial_owner = $_POST['name_of_ultimate_beneficial_owner'] == ''?'NA':$_POST['name_of_ultimate_beneficial_owner'];
$is_singapore_citizen = $_POST['is_singapore_citizen'] == ''?'NA':$_POST['is_singapore_citizen'];
$percentage_of_shares = $_POST['percentage_of_shares'] == ''?'NA':$_POST['percentage_of_shares'];
$issued_share_capital_allocation = $_POST['issued_share_capital_allocation'] == ''?'NA':$_POST['issued_share_capital_allocation'];
$number_of_shares_allocation = $_POST['number_of_shares_allocation'] == ''?'NA':$_POST['number_of_shares_allocation'];
$officer_gender = $_POST['officer_gender'] == ''?'NA':$_POST['officer_gender'];
$officer_residential_address = $_POST['officer_residential_address'] == ''?'NA':$_POST['officer_residential_address'];
$residential_address_country = $_POST['residential_address_country'] == ''?'NA':$_POST['residential_address_country'];
$residential_address_postal_code = $_POST['residential_address_postal_code'] == ''?'NA':$_POST['residential_address_postal_code'];
$nric_or_id_number = $_POST['nric_or_id_number'] == ''?'NA':$_POST['nric_or_id_number'];
$officer_passport_number = $_POST['officer_passport_number'] == ''?'NA':$_POST['officer_passport_number'];
$officer_passport_expiration = $_POST['officer_passport_expiration'] == ''?'NA':$_POST['officer_passport_expiration'];
$officer_passport_nationality = $_POST['officer_passport_nationality'] == ''?'NA':$_POST['officer_passport_nationality'];
$officer_country_of_birth = $_POST['officer_country_of_birth'] == ''?'NA':$_POST['officer_country_of_birth'];
$officer_contact = $_POST['officer_contact'] == ''?'NA':$_POST['officer_contact'];
$officer_email_address = $_POST['officer_email_address'] == ''?'NA':$_POST['officer_email_address'];
$upload_passport_name = $_POST['upload_passport_name'] == ''?'NA':$_POST['upload_passport_name'];
$upload_proof_of_address_name = $_POST['upload_proof_of_address'] == ''?'NA':$_POST['upload_proof_of_address'];
$upload_nric_id_card_name = $_POST['officer_nric_image'] == ''?'NA':$_POST['officer_nric_image'];
$business_registration_certificate_of_entity_name = $_POST['business_registration_certificate_of_entity'] == ''?'NA':$_POST['business_registration_certificate_of_entity'];


 

// SQL insert statement
$sql = "INSERT INTO officer (cr_id,officer_name, officer_type, officer_designation,nominee_director, entity_number, entity_country_of_incorporation, 
            corporate_entity_address, business_registration_certificate_of_entity, name_of_ultimate_beneficial_owner, 
            is_singapore_citizen, percentage_of_shares, issued_share_capital_allocation, number_of_shares_allocation, 
            officer_gender, officer_residential_address, residential_address_country, residential_address_postal_code, 
            nric_or_id_number, officer_passport_number, officer_passport_expiration, passport_image, proof_of_address_image, 
            officer_passport_nationality, officer_country_of_birth, officer_contact, officer_email_address, officer_nric_id_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)";

// Prepare and bind parameters
$stmt = $link->prepare($sql);
$stmt->bind_param(
    "ssssssssssssssssssssssssssss",
    $last_cr_id,
    $officer_name,
    $officer_type,
    $officer_designation,
    $nominee_director,
    $entity_number,
    $entity_country_of_incorporation,
    $corporate_entity_address,
    $business_registration_certificate_of_entity_name,
    $name_of_ultimate_beneficial_owner,
    $is_singapore_citizen,
    $percentage_of_shares,
    $issued_share_capital_allocation,
    $number_of_shares_allocation,
    $officer_gender,
    $officer_residential_address,
    $residential_address_country,
    $residential_address_postal_code,
    $nric_or_id_number,
    $officer_passport_number,
    $officer_passport_expiration,
    $upload_passport_name,
    $upload_proof_of_address_name,
    $officer_passport_nationality,
    $officer_country_of_birth,
    $officer_contact,
    $officer_email_address,
    $upload_nric_id_card_name
);

if ($stmt->execute()) {
    $return['message'] = 'Officer added successfully';
    $return['error_flag'] = 0;
} else {
    $return['message'] = 'There is an error while adding the officer';
    $return['error_flag'] = 1;
    $return['error'] = $link->error;
}
echo json_encode($return);
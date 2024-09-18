<?php
session_start();
// Include your database connection file
require_once '../db.php';

// Initialize response array
$response = array();
$_SESSION['edd_submit']=1;
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize inputs
        $company_id = filter_var($_POST['company_id'], FILTER_SANITIZE_STRING);
        $officer_id = filter_var($_POST['officer_id'], FILTER_SANITIZE_STRING);
        $entityName = filter_var($_POST['entityName'], FILTER_SANITIZE_STRING);
        $customerName = filter_var($_POST['customerName'], FILTER_SANITIZE_STRING);
        $customerRiskRatingLastReview = filter_var($_POST['customerRiskRatingLastReview'], FILTER_SANITIZE_STRING);
        $dateOfApprovedReview = filter_var($_POST['dateOfApprovedReview'], FILTER_SANITIZE_STRING);
        $reviewType = filter_var($_POST['reviewType'], FILTER_SANITIZE_STRING);
        $reasonsForReview = filter_var($_POST['reasonsForReview'], FILTER_SANITIZE_STRING);
        $actionsForReview = filter_var($_POST['actionsForReview'], FILTER_SANITIZE_STRING);
        $transactionPatterns = filter_var($_POST['transactionPatterns'], FILTER_SANITIZE_STRING);
        $transactionsConsistency = filter_var($_POST['transactionsConsistency'], FILTER_SANITIZE_STRING);
        $transactionLevelFrequency = filter_var($_POST['transactionLevelFrequency'], FILTER_SANITIZE_STRING);
        $unrealisticTurnovers = filter_var($_POST['unrealisticTurnovers'], FILTER_SANITIZE_STRING);
        $businessInconsistency = filter_var($_POST['businessInconsistency'], FILTER_SANITIZE_STRING);
        $shareholdingChange = filter_var($_POST['shareholdingChange'], FILTER_SANITIZE_STRING);
        $purposeChange = filter_var($_POST['purposeChange'], FILTER_SANITIZE_STRING);
        $industryRating = filter_var($_POST['industryRating'], FILTER_SANITIZE_STRING);
        $businessNameChange = filter_var($_POST['businessNameChange'], FILTER_SANITIZE_STRING);
        $directorChange = filter_var($_POST['directorChange'], FILTER_SANITIZE_STRING);
        $sanctionsListChecks = filter_var($_POST['sanctionsListChecks'], FILTER_SANITIZE_STRING);
        $googleSearchResults = filter_var($_POST['googleSearchResults'], FILTER_SANITIZE_STRING);
        $worldChecksResults = filter_var($_POST['worldChecksResults'], FILTER_SANITIZE_STRING);
        $pepChecksResults = filter_var($_POST['pepChecksResults'], FILTER_SANITIZE_STRING);
        $residenciesUnchanged = filter_var($_POST['residenciesUnchanged'], FILTER_SANITIZE_STRING);
        $assessmentResults = filter_var($_POST['assessmentResults'], FILTER_SANITIZE_STRING);
        $riskRatingChange = filter_var($_POST['riskRatingChange'], FILTER_SANITIZE_STRING);
        $customerRiskRatingReview = filter_var($_POST['customerRiskRatingReview'], FILTER_SANITIZE_STRING);
        $dateOfReview = filter_var($_POST['dateOfReview'], FILTER_SANITIZE_STRING);
        $sourceOfFundsCorroboration = filter_var($_POST['sourceOfFundsCorroboration'], FILTER_SANITIZE_STRING);
        $sourceOfWealthCorroboration = filter_var($_POST['sourceOfWealthCorroboration'], FILTER_SANITIZE_STRING);
        $internalRiskAssessmentConfirmation = filter_var($_POST['internalRiskAssessmentConfirmation'], FILTER_SANITIZE_STRING);
        $reviewerName = filter_var($_POST['reviewerName'], FILTER_SANITIZE_STRING);
        $reviewDate = filter_var($_POST['reviewDate'], FILTER_SANITIZE_STRING);
        $reviewerComments = filter_var($_POST['reviewerComments'], FILTER_SANITIZE_STRING);
        $approverName = filter_var($_POST['approverName'], FILTER_SANITIZE_STRING);
        $approverPosition = filter_var($_POST['approverPosition'], FILTER_SANITIZE_STRING);
        $approverDate = filter_var($_POST['approverDate'], FILTER_SANITIZE_STRING);
        $approverComments = filter_var($_POST['approverComments'], FILTER_SANITIZE_STRING);

        // Check if required fields are empty
        if (empty($entityName) || empty($customerName) || empty($reviewType)) {
            throw new Exception('Required fields are missing.');
        }

        // Prepare SQL statement
        $stmt = "INSERT INTO edd_form_conduct (company_id,officer_id,
            entity_name, customer_name, customer_risk_rating_last_review, date_of_approved_review, review_type,
            reasons_for_review, actions_for_review, transaction_patterns, transactions_consistency, transaction_level_frequency,
            unrealistic_turnovers, business_inconsistency, shareholding_change, purpose_change, industry_rating,
            business_name_change, director_change, sanctions_list_checks, google_search_results, world_checks_results,
            pep_checks_results, residencies_unchanged, assessment_results, risk_rating_change, customer_risk_rating_review,
            date_of_review, source_of_funds_corroboration, source_of_wealth_corroboration, internal_risk_assessment_confirmation,
            reviewer_name, review_date, reviewer_comments, approver_name, approver_position, approver_date, approver_comments
        ) VALUES ('$company_id','$officer_id','$entityName', '$customerName', '$customerRiskRatingLastReview', '$dateOfApprovedReview', '$reviewType',
            '$reasonsForReview', '$actionsForReview', '$transactionPatterns', '$transactionsConsistency', '$transactionLevelFrequency',
            '$unrealisticTurnovers', '$businessInconsistency', '$shareholdingChange', '$purposeChange', '$industryRating',
            '$businessNameChange', '$directorChange', '$sanctionsListChecks', '$googleSearchResults', '$worldChecksResults',
            '$pepChecksResults', '$residenciesUnchanged', '$assessmentResults', '$riskRatingChange', '$customerRiskRatingReview',
            '$dateOfReview', '$sourceOfFundsCorroboration', '$sourceOfWealthCorroboration', '$internalRiskAssessmentConfirmation',
            '$reviewerName', '$reviewDate', '$reviewerComments', '$approverName', '$approverPosition', '$approverDate', '$approverComments')";

        // Execute statement
        if (mysqli_query($link,$stmt)) {
            $response['status'] = 'success';
            $response['message'] = 'Data has been successfully submitted.';
        } else {
            throw new Exception('Failed to execute the SQL statement: ' . $stmt->error);
        }

    } else {
        throw new Exception('Invalid request method.');
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}


// Return the response as JSON
echo json_encode($response);
?>

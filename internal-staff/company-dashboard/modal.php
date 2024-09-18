<!--modal for edd fill form-->
<div class="modal fade" id="edd_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDD Form(Please fill this form for next step)</h5>
      </div>
      <div class="modal-body"> 
	     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
				        <td><input type="text" id="entityName" name="entityName" value="<?php echo $result_officer['officer_name'];?>"></td>
				    </tr>
				    <tr>
				        <td>2</td>
				        <td>Customer Name</td>
				        <td><input type="text" id="customerName" name="customerName" value="<?php echo $result_officer['officer_name'];?>"></td>
				    </tr>
				    <tr>
				        <td>3</td>
				        <td>Overall Customer Risk Rating of Last Review</td>
				        <td><input type="text" id="customerRiskRatingLastReview" name="customerRiskRatingLastReview" value="High (EDD required)"></td>
				    </tr>
				    <tr>
				        <td>4</td>
				        <td>Date of Approved Review</td>
				        <td><input type="date" id="dateOfApprovedReview" name="dateOfApprovedReview" value="2023-06-04"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><b>B. Type of Review</b></td>
				    </tr>
				    <tr>
				        <td>5</td>
				        <td>Review Type</td>
				        <td><input type="text" id="reviewType" name="reviewType" value="Event Triggered Review"></td>
				    </tr>
				    <tr>
				        <td>6</td>
				        <td>Reasons for review if the review is triggered by events</td>
				        <td><input type="text" id="reasonsForReview" name="reasonsForReview"></td>
				    </tr>
				    <tr>
				        <td>7</td>
				        <td>Actions (pre populated for review triggered by events)</td>
				        <td><input type="text" id="actionsForReview" name="actionsForReview"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><b>C. Transaction Monitoring</b></td>
				    </tr>
				    <tr>
				        <td>8</td>
				        <td>Does Customer exhibit the following transaction patterns?<br>- Transactions as ‘donations’ or ‘contributions to humanitarian aid’ (in particular to non-profit or religious organisations in a conflict zone)<br>- Transactions linked to the purchase of items that may be used for terrorism activities, where the declared purpose of the transaction does not match the profile of the parties involved <br>- Transactions with entities located in conflict zones (where terrorism-related activities or entities are present), and where the declared purpose for the transaction does not match the profile of the parties involved <br>- Accounts with minimal activity before 2014 now showing inflows from unknown origins, followed by fund transfers to beneficiaries or ATM withdrawals in conflict zones. <br>- Client suddenly procuring and/or shipping oil equipment to conflict zones, where the activity is not consistent with the customer’s line of business or occupation.<br>- Client suddenly procuring and/or shipping oil equipment to conflict zones, where the activity is not consistent with the customer’s line of business or occupation. <br>- Clients who have frequent cash deposits and withdrawals <br>- Counterparties of clients who make frequent cash deposits into client’s accounts <br>- Transactions typically involve PEP<br>- Movement of funds unusual/uneconomic</td>
				        <td><input type="text" id="transactionPatterns" name="transactionPatterns"></td>
				    </tr>
				    <tr>
				        <td>9</td>
				        <td>Are transactions conducted consistent with TS's knowledge of the customer and his business and risk profile?</td>
				        <td><input type="text" id="transactionsConsistency" name="transactionsConsistency"></td>
				    </tr>
				    <tr>
				        <td>10</td>
				        <td>Is anticipated level, frequency and nature of transaction in line with business activities?</td>
				        <td><input type="text" id="transactionLevelFrequency" name="transactionLevelFrequency"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><b>D. Assessment of Changes in Circumstances</b></td>
				    </tr>
				    <tr>
				        <td>11</td>
				        <td>Does customer have unrealistic turnovers in their Financial Statement?</td>
				        <td><input type="text" id="unrealisticTurnovers" name="unrealisticTurnovers"></td>
				    </tr>
				    <tr>
				        <td>12</td>
				        <td>Does the customer conduct business inconsistently with their business or transaction profile?</td>
				        <td><input type="text" id="businessInconsistency" name="businessInconsistency"></td>
				    </tr>
				    <tr>
				        <td>13</td>
				        <td>Is there a change in shareholding or control structure?</td>
				        <td><input type="text" id="shareholdingChange" name="shareholdingChange"></td>
				    </tr>
				    <tr>
				        <td>14</td>
				        <td>Is there a change in the purpose and intended nature of the business?</td>
				        <td><input type="text" id="purposeChange" name="purposeChange"></td>
				    </tr>
				    <tr>
				        <td>15</td>
				        <td>If there is a change in the nature of business/industry, what is the current industry rating?</td>
				        <td><input type="text" id="industryRating" name="industryRating"></td>
				    </tr>
				    <tr>
				        <td>16</td>
				        <td>Is there a change in the business name?</td>
				        <td><input type="text" id="businessNameChange" name="businessNameChange"></td>
				    </tr>
				    <tr>
				        <td>17</td>
				        <td>Is there a change in the director?</td>
				        <td><input type="text" id="directorChange" name="directorChange"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><b>E. Name Screening</b></td>
				    </tr>
				    <tr>
				        <td>16</td>
				        <td>Sanctions List Checks Results</td>
				        <td><input type="text" id="sanctionsListChecks" name="sanctionsListChecks"></td>
				    </tr>
				    <tr>
				        <td>17</td>
				        <td>Google Search Results</td>
				        <td><input type="text" id="googleSearchResults" name="googleSearchResults"></td>
				    </tr>
				    <tr>
				        <td>18</td>
				        <td>World Checks Results</td>
				        <td><input type="text" id="worldChecksResults" name="worldChecksResults"></td>
				    </tr>
				    <tr>
				        <td>19</td>
				        <td>PEP Checks Results</td>
				        <td><input type="text" id="pepChecksResults" name="pepChecksResults"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><b>F. Country / Territory Risk Factors</b></td>
				    </tr>
				    <tr>
				        <td>20</td>
				        <td>Refer to all the Residencies / Nationalities / Countries. Did they remain unchanged?</td>
				        <td><input type="text" id="residenciesUnchanged" name="residenciesUnchanged"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><strong>Overall Customer Risk Assessment</strong></td>
				    </tr>
				    <tr>
				        <td>Document results of the assessment based on the questions above</td>
				        <td></td>
				        <td><input type="text" id="assessmentResults" name="assessmentResults"></td>
				    </tr>
				    <tr>
				        <td>Did the risk rating of customer change?</td>
				        <td></td>
				        <td><input type="text" id="riskRatingChange" name="riskRatingChange"></td>
				    </tr>
				    <tr>
				        <td>Overall Customer Risk Rating of Review</td>
				        <td></td>
				        <td><input type="text" id="customerRiskRatingReview" name="customerRiskRatingReview"></td>
				    </tr>
				    <tr>
				        <td>Date of Review</td>
				        <td></td>
				        <td><input type="date" id="dateOfReview" name="dateOfReview"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><strong>For cases upgraded to Enhanced Due Diligence only</strong></td>
				    </tr>
				    <tr>
				        <td>&lt;Source of Funds Corroboration&gt;</td>
				        <td></td>
				        <td><input type="text" id="sourceOfFundsCorroboration" name="sourceOfFundsCorroboration"></td>
				    </tr>
				    <tr>
				        <td>&lt;Source of Wealth Corroboration&gt;</td>
				        <td></td>
				        <td><input type="text" id="sourceOfWealthCorroboration" name="sourceOfWealthCorroboration"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><strong>Reviewer Comments</strong></td>
				    </tr>
				    <tr>
				        <td>I confirm that this internal risk assessment has passed the relevant checks above and documented my actions as appropriate.</td>
				        <td></td>
				        <td><input type="text" id="internalRiskAssessmentConfirmation" name="internalRiskAssessmentConfirmation"></td>
				    </tr>
				    <tr>
				        <td>Name of Reviewer</td>
				        <td></td>
				        <td><input type="text" id="reviewerName" name="reviewerName"></td>
				    </tr>
				    <tr>
				        <td>Date</td>
				        <td></td>
				        <td><input type="date" id="reviewDate" name="reviewDate"></td>
				    </tr>
				    <tr>
				        <td>Other comments (i.e. You should consider escalating to the compliance officer or senior management and/or filing a Suspicious Transaction Report where necessary.)</td>
				        <td></td>
				        <td><input type="text" id="reviewerComments" name="reviewerComments"></td>
				    </tr>
				    <tr>
				        <td colspan="3" class="text-center"><strong>Approver Comments</strong></td>
				    </tr>
				    <tr>
				        <td>Name of Approver</td>
				        <td></td>
				        <td><input type="text" id="approverName" name="approverName"></td>
				    </tr>
				    <tr>
				        <td>Position</td>
				        <td></td>
				        <td><input type="text" id="approverPosition" name="approverPosition"></td>
				    </tr>
				    <tr>
				        <td>Date</td>
				        <td></td>
				        <td><input type="date" id="approverDate" name="approverDate"></td>
				    </tr>
				    <tr>
				        <td>Other comments (i.e. Please attach documentation of the reasons where approval is contrary to the recommendation.)</td>
				        <td></td>
				        <td><input type="text" id="approverComments" name="approverComments"></td>
				    </tr>
				  </tbody>
			</table>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" name="edd_submit" id="edd_submit" class="btn btn-primary">Save</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<!--modal for edd fill form end-->
<!--script to save edd form -->
 <script type="text/javascript">
    $('#edd_submit').click(function(event) {
        event.preventDefault(); 
        var company_id = '<?php echo $company_id; ?>';
        var officer_id  = '<?php echo $officer_id; ?>';
        $.ajax({
            url: '../api/save_edd_form.php', // Replace with the path to your API
            type: 'POST',
            data: {
            	company_id:company_id,
            	officer_id:officer_id,
			    entityName: $('#entityName').val(),
			    customerName: $('#customerName').val(),
			    customerRiskRatingLastReview: $('#customerRiskRatingLastReview').val(),
			    dateOfApprovedReview: $('#dateOfApprovedReview').val(),
			    reviewType: $('#reviewType').val(),
			    reasonsForReview: $('#reasonsForReview').val(),
			    actionsForReview: $('#actionsForReview').val(),
			    transactionPatterns: $('#transactionPatterns').val(),
			    transactionsConsistency: $('#transactionsConsistency').val(),
			    transactionLevelFrequency: $('#transactionLevelFrequency').val(),
			    unrealisticTurnovers: $('#unrealisticTurnovers').val(),
			    businessInconsistency: $('#businessInconsistency').val(),
			    shareholdingChange: $('#shareholdingChange').val(),
			    purposeChange: $('#purposeChange').val(),
			    industryRating: $('#industryRating').val(),
			    businessNameChange: $('#businessNameChange').val(),
			    directorChange: $('#directorChange').val(),
			    sanctionsListChecks: $('#sanctionsListChecks').val(),
			    googleSearchResults: $('#googleSearchResults').val(),
			    worldChecksResults: $('#worldChecksResults').val(),
			    pepChecksResults: $('#pepChecksResults').val(),
			    residenciesUnchanged: $('#residenciesUnchanged').val(),
			    assessmentResults: $('#assessmentResults').val(),
			    riskRatingChange: $('#riskRatingChange').val(),
			    customerRiskRatingReview: $('#customerRiskRatingReview').val(),
			    dateOfReview: $('#dateOfReview').val(),
			    sourceOfFundsCorroboration: $('#sourceOfFundsCorroboration').val(),
			    sourceOfWealthCorroboration: $('#sourceOfWealthCorroboration').val(),
			    internalRiskAssessmentConfirmation: $('#internalRiskAssessmentConfirmation').val(),
			    reviewerName: $('#reviewerName').val(),
			    reviewDate: $('#reviewDate').val(),
			    reviewerComments: $('#reviewerComments').val(),
			    approverName: $('#approverName').val(),
			    approverPosition: $('#approverPosition').val(),
			    approverDate: $('#approverDate').val(),
			    approverComments: $('#approverComments').val()
			},
            success: function(response) {
				    let result = JSON.parse(response);
				    if (result.status === 'success') {  // Use === for comparison
				        Swal.fire(
						    'Success!',
						    result.message,  // Ensure you use result.message instead of response.message
						    'success'
						).then(function() {
						    var myModal = bootstrap.Modal.getInstance(document.getElementById('edd_form'));
						    myModal.hide();  // Correctly hide the modal
						});
				    } else {
				        Swal.fire(
				            'Error!',
				            result.message,  // Ensure you use result.message instead of response.message
				            'error'
				        );
				    }
			},
            error: function(xhr, status, error) {
                // Handle error
                Swal.fire(
                    'Error!',
                    'An error occurred: ' + error,
                    'error'
                );
            }
        });
    });
</script>
<!--end of script to save edd form -->
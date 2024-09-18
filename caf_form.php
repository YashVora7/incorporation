<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th, td {
            border: solid 1px black;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer Info</th>
                    <th></th>
                    <th>Action Required</th>
                    <th>Verified?</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Section A Individual Info</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Envelope ID</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Account ID</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Capacity of Customer</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Capacity of CP</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Capacity of Agent</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Individual is BO of the Company</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Individual is not a BO of the Company</td>
                    <td></td>
                    <td></td>
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
                </tr>
                <tr>
                    <td>20</td>
                    <td>Singapore PEP</td>
                    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="singapore_pep" id="singapore_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
                </tr>
                <tr>
                    <td>22</td>
                    <td>International Organisation PEP</td>
                    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="international_organisation_pep" id="international_organisation_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>23</td>
                    <td>Family member of PEP</td>
                    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="family_member_pep" id="family_member_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>24</td>
                    <td>Close associate of PEP</td>
                    <td>1. If this field is selected, assess whether individual presents a high risk.<br>2. If individual presents a high risk, conduct enhanced due diligence.<br>3. Document under “Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="close_associate_pep" id="close_associate_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>25</td>
                    <td>Relationship with Family member of PEP</td>
                    <td>1. Assess the relationship of customer with PEP<br>2. Document under &quot;&quot;Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="relationship_family_member_pep" id="relationship_family_member_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>26</td>
                    <td>Relationship with Close associate of PEP</td>
                    <td>1. Assess the relationship of customer with PEP<br>2. Document under &quot;&quot;Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="relationship_close_associate_pep" id="relationship_close_associate_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>27</td>
                    <td>Name of PEP</td>
                    <td>1. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings &amp; Assessment inputs tab to document results if the name has not been screened</td>
                    <td>
                        <select name="name_of_pep" id="name_of_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
                </tr>
                <tr>
                    <td>29</td>
                    <td>Describe nature of prominent public function that the person is or has been entrusted with</td>
                    <td>1. Assess the function of the PEP and the degree of risks.<br>2. Document under &quot;&quot;Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="nature_of_public_function" id="nature_of_public_function">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>30</td>
                    <td>Period of time in which the person is/was a PEP</td>
                    <td>1. Assess the function of the duration the individual is a PEP and the degree of risks. The handling of a client who is no longer entrusted with a prominent public function should be based on an assessment of risk and not on prescribed time limits<br>2. Document under &quot;&quot;Other Remarks&quot;&quot; the reasons for the decision of the extent of the due diligence.</td>
                    <td>
                        <select name="period_as_pep" id="period_as_pep">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Section B: Info on Business Entity</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Entity Name</td>
                    <td>1. Verify Entity Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings &amp; Assessment inputs tab to document results.</td>
                    <td>
                        <select name="entity_name" id="entity_name">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Former Name</td>
                    <td>1. Verify Former Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings &amp; Assessment inputs tab to document results.</td>
                    <td>
                        <select name="former_name" id="former_name">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Trading Name</td>
                    <td>1. Verify Trading Name against the documents of incorporation (if any)<br>2. Refer to the Procedures Section of the Name Screening Guide to conduct name screenings &amp; Assessment inputs tab to document results.</td>
                    <td>
                        <select name="trading_name" id="trading_name">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Address or intended address of the registered office*</td>
                    <td>1. Verify address against the documents of incorporation (if any).<br>2. Assess if it is using the Tianlong digital mailbox or a PO box address. This is one of the indicators of a shell company, however, assessment needs to be done holistically with other factors to determine if the company is a shell company. Input &quot;High&quot; under the Risk Score column.<br>3. Otherwise, input the country of registered office under the manual overrides and the Risk Score based on the Country Risk Rating tab.</td>
                    <td>
                        <select name="address_registered_office" id="address_registered_office">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
                </tr>

                <tr>
                    <td>Section C: Applicable for Enhanced Due Diligence</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Information on the person’s source of wealth </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Information on the person’s source of funds in the establishment of the business relationship or in the proposed business relationship </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Other Information</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>

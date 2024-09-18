<?php
require_once '../db.php';
require_once '../baseUrl.php';
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];
?>
<?php
//echo "<pre>";
//print_r($_POST);
//echo "<pre>";

// Assuming form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve data from POST;

  // Process $_POST data and set default values where necessary
    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
    $logged_user_id = $_SESSION['user_id'];

    $company_suffix = isset($_POST['company_suffix']) ? $_POST['company_suffix'] : '';
    $uen =  '';
    $company_type = isset($_POST['company_type']) ? $_POST['company_type'] : '';
    $registered_address = isset($_POST['our_registered_address_is_at_240/year']) ? $_POST['our_registered_address_is_at_240/year'] : '';
    $describe_company_activity = isset($_POST['describe_company_activity']) ? $_POST['describe_company_activity'] : '';
    $primary_company_activity = isset($_POST['primary_company_activity']) ? $_POST['primary_company_activity'] : '';
    $secondary_company_activity = isset($_POST['secondary_company_activity']) ? $_POST['secondary_company_activity'] : '';
    $business_description = isset($_POST['business_description']) ? $_POST['business_description'] : '';
    $share_capital_currency = isset($_POST['share_capital_currency']) ? $_POST['share_capital_currency'] : '';
    $share_payable = 'In cash';
    $issued_share_capital = isset($_POST['issued_share_capital']) ? (int) $_POST['issued_share_capital'] : 0;
    $number_of_shares = isset($_POST['number_of_shares']) ? (int) $_POST['number_of_shares'] : 0;
    $paid_up = 0;
    $financial_year_end = isset($_POST['financial_year_end']) ? $_POST['financial_year_end'] : '';
    $transaction_number = '';
    $cryptocurrency_declaration = isset($_POST['cryptocurrency_declaration']) ? $_POST['cryptocurrency_declaration'] : '';
    $accepts_payments = isset($_POST['accepts_payments']) ? $_POST['accepts_payments'] : '';
    $provides_services = isset($_POST['provides_services']) ? $_POST['provides_services'] : '';
    $manages_coins = isset($_POST['manages_coins']) ? $_POST['manages_coins'] : '';
    $mas_license = isset($_POST['mas_license']) ? $_POST['mas_license'] : '';
    $related_entities = isset($_POST['related_entities']) ? $_POST['related_entities'] : '';
    $source_of_funds_interest_reason = isset($_POST['interest_reason']) ? implode(',', $_POST['interest_reason']) : '';
    $source_of_funds_sources = isset($_POST['sources']) ? implode(',', $_POST['sources']) : '';
    $source_of_funds_three_countries = isset($_POST['three_countries']) ? $_POST['three_countries'] : '';
    $more_about_you_objectives = isset($_POST['objectives']) ? implode(',', $_POST['objectives']) : '';
    $more_about_you_hear_about_us = isset($_POST['hear_about_us']) ? implode(',', $_POST['hear_about_us']) : '';

    // For option1Form
    $address_line_1 = $_POST['tdr_address-line-1'] ?? '';
    $postal_code = $_POST['tdr_postal-code'] ?? '';
    $address_line_2 = $_POST['tdr_address-line-2'] ?? '';
    $country = $_POST['tdr_country'] ?? '';
    $address_type_td = $_POST['address_type_td'] ?? '';
    $postal_code_td = $_POST['postal_code_td'] ?? '';
    $td_address_line_1 = $_POST['td_address_line_1'] ?? '';
    $td_address_line_2 = $_POST['td_address_line_2'] ?? '';
    $country_td = $_POST['country_td'] ?? '';
    $physical_store_td = $_POST['physical_store_td'] ?? '';

    // For option2Form
    $address_type_owa = $_POST['address_type_owa'] ?? '';
    $postal_code_owa = $_POST['postal_code_owa'] ?? '';
    $owa_address_line_1 = $_POST['owa_address_line_1'] ?? '';
    $owa_address_line_2 = $_POST['owa_address_line_2'] ?? '';
    $country_owa = $_POST['country_owa'] ?? '';
    //$this_is_also_business_operations_address = $_POST['this_is_also_business_operations_address'] ?? '';
    $address_type_owa1 = $_POST['address_type_owa1'] ?? '';
    $postal_code_owa1 = $_POST['postal_code_owa1'] ?? '';
    $owa1_address_line_1 = $_POST['owa1_address_line_1'] ?? '';
    $owa1_address_line_2 = $_POST['owa1_address_line_2'] ?? '';
    $country_owa1 = $_POST['country_owa1'] ?? '';
    $physical_store_own1 = $_POST['physical_store_own1'] ?? '';


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


  
        $sql = "INSERT INTO register_company (
            company_name, user_id, company_suffix, uen, company_type, registered_address,
            describe_company_activity, primary_company_activity, secondary_company_activity, business_description,
            share_capital_currency, share_payable, issued_share_capital, number_of_shares, paid_up, financial_year_end,
            transaction_number, cryptocurrency_declaration, accepts_payments, provides_services, manages_coins,
            mas_license, related_entities, source_of_funds_interest_reason, source_of_funds_sources,
            source_of_funds_three_countries, more_about_you_objectives, more_about_you_hear_about_us, option_selected, nominee_duration, with_accounting_plan,
            with_security_deposit, company_current_status, agree_terms_conditions,
            address_line_1, postal_code, address_line_2, country, address_type_td, postal_code_td,
            td_address_line_1, td_address_line_2, country_td, physical_store_td,
            address_type_owa, postal_code_owa, owa_address_line_1, owa_address_line_2, country_owa,
            address_type_owa1, postal_code_owa1, owa1_address_line_1, owa1_address_line_2, country_owa1,
            physical_store_own1
        ) VALUES (
            '$company_name', '$logged_user_id', '$company_suffix', '$uen', '$company_type', '$registered_address',
            '$describe_company_activity', '$primary_company_activity', '$secondary_company_activity', '$business_description',
            '$share_capital_currency', '$share_payable', '$issued_share_capital', '$number_of_shares', '$paid_up', '$financial_year_end',
            '$transaction_number', '$cryptocurrency_declaration', '$accepts_payments', '$provides_services', '$manages_coins',
            '$mas_license', '$related_entities', '$source_of_funds_interest_reason', '$source_of_funds_sources',
            '$source_of_funds_three_countries', '$more_about_you_objectives', '$more_about_you_hear_about_us', '$option_selected', '$nominee_duration', '$with_accounting_plan',
            '$with_security_deposit', 'only_company_registered', '$agree_terms_conditions',
            '$address_line_1', '$postal_code', '$address_line_2', '$country', '$address_type_td', '$postal_code_td',
            '$td_address_line_1', '$td_address_line_2', '$country_td', '$physical_store_td',
            '$address_type_owa', '$postal_code_owa', '$owa_address_line_1', '$owa_address_line_2', '$country_owa',
            '$address_type_owa1', '$postal_code_owa1', '$owa1_address_line_1', '$owa1_address_line_2', '$country_owa1',
            '$physical_store_own1'
        )";

  $execute = mysqli_query($link, $sql);
  $last_id = $link->insert_id;
}


// Close connection
$link->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stripe Payment Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
  <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
  <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>
  <style>
    #payment-form {
      padding: 30px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      background: white;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    #card-element {
      margin-bottom: 20px;
    }

    .StripeElement {
      box-sizing: border-box;
      height: 44px;
      padding: 12px;
      border: 1px solid #ced4da;
      border-radius: 6px;
      background-color: white;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      transition: box-shadow 150ms ease;
      width: 100%;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .StripeElement--invalid {
      border-color: #dc3545;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }

    .btn-pay {
      width: 100%;
      padding: 12px;
      font-size: 18px;
      font-weight: bold;
      background-color: #007bff;
      border: none;
      color: white;
      border-radius: 6px;
      transition: background-color 0.3s;
    }

    .btn-pay:hover {
      background-color: #0056b3;
    }

    .form-group input[readonly] {
      background-color: #e9ecef;
      cursor: not-allowed;
    }

    .logo-container img {
      width: 120px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <h2 class="m-4">
    <img style="width:60px;" src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="img-fluid">
  </h2>

  <div class="container">

    <form id="payment-form">
      <div class="logo-container text-center mb-4 d-flex justify-content-center">
        <h2 class="mt-1">Powered by </h2>
        <img src="data:image/png;base64,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" alt="Stripe Logo" class="img-fluid">
      </div>
      <div class="row">
        <div class="col-4 border-right">

          <h4 class="text-muted mb-4"> Credit / Debit Card</h4>
          <div class="card p-3">
            <h5 class="text-muted mb-3">Payment Breakdown</h5>
            <?php if ($option_selected == "option1") {
            ?>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Fees</th>
                    <th scope="col">SGD</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Incorporation</td>
                    <td>35.00</td>

                  </tr>
                  <tr>
                    <td>Reimbursement government fees</td>
                    <td>375.00</td>

                  </tr>
                  <tr>
                    <td>Corporate secretary</td>
                    <td>220.00</td>

                  </tr>
                  <tr>
                    <td>Virtual address</td>
                    <td>240.00</td>

                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>870.00</strong></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            <?php
            } else {
            ?>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Fees</th>
                    <th scope="col">SGD</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Incorporation</td>
                    <td>35.00</td>

                  </tr>
                  <tr>
                    <td>Reimbursement government fees</td>
                    <td>375.00</td>

                  </tr>
                  <tr>
                    <td>Corporate secretary</td>
                    <td>220.00</td>

                  </tr>
                  
                  <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>630.00</strong></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            <?php
            }


            ?>

          </div>
        </div>
        <div class="col-4 border-right">
          <div class="d-flex justify-content-start my-2">
            <h5 class="text-muted">Enter Card Details :</h5>
          </div>
          <div id="card-element" class="form-control mb-4"></div>
        </div>
        <div class="col-4">
          <div class="d-flex justify-content-start my-2">
            <h5 class="text-muted"><?php echo $company_name . " " . $company_suffix; ?></h5>
          </div>
          <table class="table">
            <tr>
              <td>
                <lab class="m-1" el class="form-label" for="amount">Amount</label>
              </td>
              <td>
                <input type="number" id="amount" class="form-control" value="<?php if ($option_selected == "option1") {
                                                                                echo "870";
                                                                              } else {
                                                                                echo "630";
                                                                              } ?>" readonly>
              </td>
            </tr>
            <tr>
              <td>
                <label class="form-label" for="currency">Currency</label>
              </td>
              <td>
                <input type="text" id="currency" class="form-control" value="SGD" readonly>
              </td>
            </tr>
            <tr>
              <td>
                <label class="form-label" for="description">Description</label>
              </td>
              <td>
                <input type="text" id="description" class="form-control">
              </td>
            </tr>
          </table>
        </div>
        <button type="submit" class="btn btn-pay mx-auto my-5 w-50">Pay Now</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    var stripe = Stripe('pk_test_51PlEneRpC1dMDr0azT3OuaE7dAnYFVJTRG1usHurSFDMQVOKdRxYY16wWNuzCPWkn8qVbkRqEpWjRRRjeYcTJH7m00pFMHUnMg');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var baseUrl = "<?php echo $baseUrl; ?>";
      var amount = document.getElementById('amount').value;
      var currency = document.getElementById('currency').value;
      var description = document.getElementById('description').value;

      fetch(baseUrl + 'incorporation/register-company/payment_test.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            amount: amount,
            currency: currency,
            description: description
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error:', data.error);
            return;
          }

          var clientSecret = data.clientSecret;

          stripe.confirmCardPayment(clientSecret, {
            payment_method: {
              card: card,
              billing_details: {
                name: 'Vimash Prajapati'
              }
            }
          }).then(function(result) {
            if (result.error) {
              console.log(result.error.message);
            } else {
              if (result.paymentIntent.status === 'succeeded') {
                // Call the API to save payment details
                var company_id = "<?php echo $last_id; ?>";
                var user_id = "<?php echo $logged_user_id; ?>";
                fetch(baseUrl + 'incorporation/api/accept_payment.php', {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                      company_id: company_id,
                      user_id: user_id,
                      amount: amount,
                      currency: currency,
                      description: description,
                      stripe_payment_intent_id: result.paymentIntent.id,
                      status: result.paymentIntent.status
                    })
                  })
                  .then(response => response.json())
                  .then(data => {
                    if (data.success) {
                      swal.fire({
                        title: 'Payment Confirm & Company Details Save',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                      }).then(function(isConfirm) {
                        if (isConfirm.value) {
                          window.location = '<?php echo $baseUrl; ?>/incorporation/register-company/add_company_officer.php';

                        } else {

                        }

                      });
                    } else {
                      console.error('Error saving payment details:', data.error);
                      Swal.fire({
                        text: 'Failed to add company registration data.',
                        type: 'error', // Changed to 'error' for a failure
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Okay'
                      });
                    }
                  })
                  .catch(error => {
                    console.error('Fetch error:', error);
                  });
              }
            }
          });
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    });
  </script>
</body>

</html>
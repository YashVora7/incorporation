<?php
require_once '../session.php';
require_once '../baseUrl.php';
$company_id = isset($_GET['company_id'])?$_GET['company_id'] : '';

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
      <div class="logo-container text-center mb-4 d-flex justify-content-center"> <h2 class="mt-1">Powered by </h2>
        <img src="data:image/png;base64,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" alt="Stripe Logo" class="img-fluid">
      </div>
      <div  class="row">
        <div class="col-3 border-right">
          <div class="d-flex justify-content-start my-2">
            <h5 class="text-muted">Payment Option :</h5>
          </div>
          <h4 class="text-muted mb-4">  Credit / Debit Card</h4>
        </div>
        <div class="col-4 border-right"> 
          <div class="d-flex justify-content-start my-2">
            <h5 class="text-muted">Enter Card Details :</h5>
          </div>
          <div id="card-element" class="form-control mb-4"></div>
        </div>
        <div class="col-5">
           <div class="d-flex justify-content-start my-2">
            <h5 class="text-muted">Company : Vimash LTD</h5>
          </div>
          <table class="table">
            <tr>
              <td>
                <lab class="m-1"el class="form-label" for="amount">Amount</label>
              </td>
              <td>
                <input type="number" id="amount" class="form-control" value="200" readonly>
              </td>
            </tr>
            <tr>
              <td>
                <label class="form-label" for="currency">Currency</label>
              </td>
              <td>
                <input type="text" id="currency" class="form-control" value="USD" readonly>
              </td>
            </tr>
            <tr>
              <td>
                <label class="form-label" for="description">Description</label>
              </td>
              <td>
                <input type="text" id="description" class="form-control" required>
              </td>
            </tr>
          </table>
        </div>
        <button  type="submit" class="btn btn-pay mx-auto my-5 w-50">Pay Now</button>
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

      fetch(baseUrl + 'internal-staff/company-dashboard/payment_test.php', {
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
              	var company_id ="<?php echo $company_id; ?>";
                  $.ajax({
                        url: '../api/update_company_status.php',
                        type: 'POST',
                        data: {
                            company_id: company_id,
                            new_status: 'Payment_and_data_verified'

                        },
                        success: function(response) {
                            let result = JSON.parse(response);
                            if (result.error_flag == 0) {
                                swal.fire({
                                    title: 'Data verified & Company Documents generated',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Okay'
                                }).then(function(isConfirm) {
                                    if (isConfirm.value) {
                                        window.location = '<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_details.php?company_id=' + company_id;

                                    } else {

                                    }

                                });
                            }
                        }
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

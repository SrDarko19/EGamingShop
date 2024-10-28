<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
<script src="https://www.paypal.com/sdk/js?client-id=AR2f1zkaoOnaYqJWlh-9ZsEbgnq0zUV3jAdBtg6j2QJA3y-pBD0DsM2qG37eAeDhOkV3zqlHo12GwxlZ=YOUR_COMPONENTS"></script>

<script src="https://www.paypal.com/sdk/js?client-id=AR2f1zkaoOnaYqJWlh-9ZsEbgnq0zUV3jAdBtg6j2QJA3y-pBD0DsM2qG37eAeDhOkV3zqlHo12GwxlZ&components=buttons"></script>

</head>
<body>
  <div id="paypal-button-container"></div>
  <script>
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'blue',
        label: 'pay',
      },
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: 100
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Transaction completed by ' + details.payer.name.given_name);
          window.location.href = 'complete.php';
        });
      },
      
      onCancel: function (data) {
        alert('Payment Cancelled');
        console.log(data);
      },
    }).render('#paypal-button-container');
  </script>
</body>
</html>
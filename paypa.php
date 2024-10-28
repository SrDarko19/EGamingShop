<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://www.paypal.com/sdk/js?client-id=AaIQ9y97v3FnEfn0l3a8epKZSi0M-nPXnxe3wcVBSxLPuZHKMFmug48fsfMw-2qn52VQYOp32TFwpGwo&currency=USD"></script>
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
              value: <?php echo $total; ?>
            }
          }]
        });
      },

       onApprove: function (data, actions) {
        let URL = 'clases/captura.php'
        actions.order.capture().then(function (detalles){

          console.log(detalles)


          return fetch(url, {
            method: 'post',
            headers: {
              'content-type': 'application/json'
            },
            body: JSON.stringify({
              detalles: detalles
            })
          })
            
        });
      }, 
    

      onCancel: function (data) {
        alert('Pago Cancelado');
        console.log(data);
      },
    }).render('#paypal-button-container');
  </script>
</body>
</html>

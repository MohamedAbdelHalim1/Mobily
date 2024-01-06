<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h1>Welcome! {{$data['username']}}</h1>
  <h2>Thank you for buying from Mobily , Keep this Invoice If You want to return (Only in 14 days)</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Order NO</th>
        <th>City</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$data['order_id']}}</td>
        <td>{{$data['city']}}</td>
        <td>{{$data['address']}}</td>
        <td>{{$data['phone']}}</td>
        <td>{{$data['quantity']}}</td>
        <td>{{$data['total_price']}}</td>

      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
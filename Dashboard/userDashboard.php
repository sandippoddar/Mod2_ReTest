<?php
require './Dashboard/userDashboardProcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
  <header>
    <?php include_once './Dashboard/navbarUser.php' ?>
  </header>
  <section class="healthy">
  <?php if (!$resultHealthy): ?>
  <h1>No Product Available Add Some Unhealthy Product!!</h1>
  <?php else: ?>
    <h2>Healthy Products</h2>
    <table class="table">
      <tr>
        <th>Product Name</th>
        <th>Product Price</th>
      </tr>
      <?php foreach ($resultHealthy as $row) : ?>
        <tr>
          <td class="name"><?php echo $row['Name']?></td>
          <td class="price"><?php echo $row['Price']?></td>
          <td class="add"><button class="btn btn-primary cartHealthy" data-product-id="<?php echo $row['Id'] ?>">Add to Cart</button></td>
          <td class="q"><input type="text" placeholder="Enter Quantity" class="quantity"> <button class="btn btn-primary submit" data-product-id="<?php echo $row['Id'] ?>">submit</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif;?>
  </section>

  <section class="unhealthy">
  <?php if (!$resultUnhealthy): ?>
  <h1>No Product Available Add Some Unhealthy Product!!</h1>
  <?php else: ?>
    <h2>Unhealthy Products</h2>
    <table class="table">
      <tr>
        <th>Product Name</th>
        <th>Product Price</th>
      </tr>
      <?php foreach ($resultUnhealthy as $row) : ?>
        <tr>
          <td class="name"><?php echo $row['Name']?></td>
          <td class="price"><?php echo $row['Price']?></td>
          <td xlass="add"><button class="btn btn-primary cartUnhealthy" data-product-id="<?php echo $row['Id'] ?>">Add to Cart</button></td>
          <td class="q"><input type="text" placeholder="Enter Quantity" class="quantity"> <button class="btn btn-primary submit" data-product-id="<?php echo $row['Id'] ?>">submit</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif;?>
  </section>
  <button class="btn btn-primary showForm">Submit</button>
  <section class="cartForm">
  <div class="container" style="width: 600px;">
      <h1 class="mb-3">User Buy Details</h1>
      <form action="/user" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Customer Email: </label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Product Name">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">All Item Price: </label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="price" value = "<?php echo $sum;?>">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Customer Phone:</label>
        <input type="text" name="phone" placeholder="Phone Number">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./JS/user.js"></script>
</html>

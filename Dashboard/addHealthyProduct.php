<?php
require './Dashboard/addHealthyProductProcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Add Healthy Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <header>
    <?php include_once './Dashboard/navbar.php' ?>
  </header>
  <section>
    <div class="container" style="width: 600px;">
      <h1 class="mb-3">Add Healthy Product</h1>
      <form action="/addHealthyProduct" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter Item Name: </label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Product Name">
      </div>
      <div class="error">
      <?php if (isset($_POST['submit']) && count($errorName)) : ?>
        <?php foreach( $errorName as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Enter Item Price: </label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Product Price">
      </div>
      <div class="error">
      <?php if (isset($_POST['submit']) && count($errorPrice)) : ?>
        <?php foreach( $errorPrice as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

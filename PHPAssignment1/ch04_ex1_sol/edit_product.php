<?php 
require_once('database.php');

// get product id from the get request
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);

// validate product ID
if ($product_id == null || $product_id == false) {
  $error = "Invalid product ID.";
  include('error.php');
  exit();
}

// get product details from database
$query = 'SELECT * FROM products WHERE productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetchAll();
$statement->closeCursor();

// get all categories
$queryCategory = 'SELECT * FROM categories ORDER BY categoryID';
$statement = $db->prepare($queryCategories);
$statement-> execute();
$category = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <title>Edit Product</title>

  <main>
    <h1>Edit Product</h1>
    <form action="update_product.php" method="post" id="edit_product_form">
      <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">

      <label>Category:</label>
      <select name="category_id">
        <?php foreach ($category as $category): ?>
          <option value="<?php echo $category['categoryID']; ?>"
          <?php if ($category['categoryID'] == $product['categoryID']) echo 'selected'; ?>>
          <?php echo $category['categoryName']; ?>
          </option>
          <?php endforeach; ?>
      </select><br>
      <label>Code:</label>
      <input type="text" name="code" value="<?php echo htmlspecialchars($product['productCode']); ?>"><br>

      <label>Name:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($product['productName']); ?>"><br>

      <label>List Price:</label>
      <input type="text" name="price" value="<?php echo htmlspecialchars($product['listPrice']); ?>"><br>
      
      <label>&nbsp;</label>
      <input type="submit" value="Update Product"><br>
    </form>
    <p><a href="index.php">View Product List</a></p>
  </main>
</head>
<body>
  
</body>
</html>
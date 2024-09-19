<?php
    $product_description = isset($_POST['product_description']) ? trim($_POST['product_description']) :'';
    $list_price = isset($_POST['list_price']) ? floatval($_POST['list_price']) : 0;
    $discount_percent = isset($_POST['discount_percent']) ? floatval($_POST['discount_percent']) : 0;
	
    // initialize errors message and formatt the outputs
    $errors = [];
    $list_price = $discount_price = $discount_f = $discount_price_f = $sales_tax_f = $sales_total_f = "";

    // tax rate
    $sales_tax_rate = 8;

    // validiation 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($product_description)) {
            $errors[] = "Product description required.";
        }
        if ($list_price <= 0) {
            $errors[] = "List price must be greater than 0";
        }
        if ($discount_percent < 0 || $discount_percent > 100) {
            $errors[] = "Discount must be between 0 and 100 percent";
    }

    if (empty($errors)) {

        $discount = $list_price * ($discount_percent / 100);
        $discount_price = $list_price - $discount;
        $sales_tax = $discount_price * ($sales_tax_rate / 100);
        $sales_total = $discount_price + $sales_tax;
        
        $list_price_f = "$".number_format($list_price, 2);
        $discount_percent_f = number_format($discount_percent, 2) . "%";
        $discount_f = "$".number_format($discount, 2);
        $discount_price_f = "$".number_format($discount_price, 2);
        $sales_tax_f = "$".number_format($sales_total, 2);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo $list_price_f; ?></span><br>

        <label>Discount Percent:</label>
        <span><?php echo $discount_percent_f; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_f; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br>
    </main>
</body>
</html>
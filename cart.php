<?php
  session_start();
  $pids = array();
  // session_destroy();

  if(filter_input(INPUT_POST, 'add_to_cart')) {
    if(isset($_SESSION['shopping_cart'])) {
        $count = count($_SESSION['shopping_cart']);

        $pids = array_column($_SESSION['shopping_cart'], 'id');

        if (!in_array(filter_input(INPUT_GET, 'id'), $pids)) {
          $_SESSION['shopping_cart'][$count] = array (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity'),
          );
        }
        else {
          for ($i = 0; $i < count($pids); $i++) {
            if ($pids[$i] == filter_input(INPUT_GET, 'id')) {
              $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
            }
          }
        }
    }
    else {
      $_SESSION['shopping_cart'][0] = array (
        'id' => filter_input(INPUT_GET, 'id'),
        'name' => filter_input(INPUT_POST, 'name'),
        'price' => filter_input(INPUT_POST, 'price'),
        'quantity' => filter_input(INPUT_POST, 'quantity'),
      );
    }
  }
  print_r($_SESSION);
 ?>

<html>
  <head>
    <title>Cart</title>
  </head>
  <body>
    <?php
      // session_start();
      include('connect.php');
      $query = 'SELECT * FROM products ORDER by product_id ASC';
      $result = mysqli_query($db, $query);

      if ($result) {
        if(mysqli_num_rows($result) > 0) {
          while($product = mysqli_fetch_assoc($result)) {
            ?>
              <div>
                <form method="post" action="home.php?action=add&id=<?php echo $product['id'] ?>">
                  <div style="border: 1px solid #333;background-color:#f1f1f1;">
                    <img src="/artmart/<?php echo $product['image']; ?>" />
                    <h3><?php echo $product['name'];?></h3>
                    <h4>$<?php echo $product['price'];?></h4>
                    <input type="text" name="quantity" value="1" />
                    <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                    <input type="submit" name="add_to_cart" value="Add to Cart"/>
                  </div>
                </form>
              </div>
            <?php
          }
        }
      }

    ?>
  </body>
</html>

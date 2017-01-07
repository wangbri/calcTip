<!DOCTYPE html>
<html>

<?php
$billamt = 0;
$tipamt = 0;
$total = 0;

function checkBill()
{
 global $billamt; 

 if (isset($_POST['bill'])) {
  if (is_numeric($_POST['bill']) && $_POST['bill'] < 0) {
   $billamt = $_POST['bill'];
   return false;
  } else if (!is_numeric($_POST['bill'])) {
   $billamt = 0;
   return false;
  } else {
   $billamt = $_POST['bill'];
   return true;
  }
 }
}

function checkTip()
{
 global $tipamt;

 if (isset($_POST['tip'])) {
  $tipamt = $_POST['tip'];
  if ($tipamt > 0 && is_numeric($tipamt)) {
   return true;
  }
 }

 return false;
}
?>

<head>
 <title>Tip Calculator</title>
</head>

<head>
<style>
form {
 margin: 0 auto;
 width: 400px;
 text-align: center;
 border: 1px solid #CCC;
 border-radius: 10px;
 background-color: lightyellow;
}

div.h1 {
 padding: 10px 50px 5px;
}

div.bill {
 <?php
 if (!checkBill() && $_SERVER['REQUEST_METHOD'] == 'POST') {
 ?>
 color: red;
 font-weight: bold;
 <?php
 }
 ?>
 
 padding: 5px 50px;
}

div.tip {
 <?php
 if (!checkTip() && $_SERVER['REQUEST_METHOD'] == 'POST') {
 ?>
  color: red;
  font-weight: bold;
 <?php
 }
 ?>

 padding: 5px 50px 75px;
}

div.result {
 border: 1px solid #CCC;
 border-radius: 5px;
 background-color: lightgreen;
} 

</style>
</head>
<body>

<form action="/form.php" method="post">
 <div class="h1">
  <h1>Tip Calculator</h1>
 </div>

 <div class="bill">
  <label for="bill">Bill subtotal: $</label>
  <input type="text" id="bill" name="bill" value="<?php echo $billamt ?>">
 </div>

 <div class="tip">
  <label for="tip">Tip percentage:</label><br>
  <?php
  for ($i = 10; $i <= 20; $i+= 5) {
  ?> 
   <input type="radio" name="tip" value="<?php echo $i; ?>"
  <?php
  if (($i == 15 && $_SERVER['REQUEST_METHOD'] != 'POST') || ($i == $tipamt)) {
  ?>
   checked="checked">
  <?php 
  } else {
  ?>
   >
  <?php
  }
  ?> 

  <?php echo $i; ?>%
  <?php
  }
  ?>

  <input type='submit' value='Submit'>
 </div>

<?php 
if (checkBill() && checkTip() && $_SERVER['REQUEST_METHOD'] == 'POST') {
 $total = $billamt + ($tipamt/100 * $billamt);
?>
 <div class="result">
  <label for="tipamt"> Tip:</label> $<?php echo number_format($tipamt/100 * $billamt, 2); ?><br>
  <label for="total"> Total:</label> $<?php echo number_format($total, 2); ?><br>
 </div>
<?php
}
?>

</form>
</body>
</html>

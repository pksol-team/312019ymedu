<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
body{width:320px;
    height:400px;
    margin-left:auto;
    margin-right:auto;
}
</style>
<body>

<h3>Enter Your Details</h3>

<div>
    
    <?php
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
 $unique = $today . $rand; ?>
  <form action="https://acbfoods.com/payments/dataFrom.php">
    <label for="uname">User Name</label>
    <input type="text" id="uname" name="uname" placeholder="User name ">
    <input type="hidden" id="oid" name="oid" value="<?php echo $unique; ?>">
    <input type="hidden" id="amount" name="amount" value="2000">

    <label for="mobile">Mobile</label>
    <input type="text" id="mobile" name="mobile" placeholder="Enter Your Mobie Number">

    <label for="country">Patment Method</label>
    <select id="country" name="country">
      <option value="OPTCRDC">Credit Card</option>
      <option value="OPTDBCRD">Debit Card</option>
      <option value="OPTNBK">NetBanking</option>
      <option value="OPTWLT">Wallet or Paytm</option>
    </select>
  
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>

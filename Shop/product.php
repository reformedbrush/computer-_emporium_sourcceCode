<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product page</title>
    <style>
        body{
            text-align:center;
        }
        </style>
</head>
<body>
    <h1>Product Page</h1>
    

<table width="200" border="1">
      <tr>
        <td>Product</td>
        <td><form name="form2" method="post" action="">
          <input type="text" name="txt_product" id="txt_product">
        </form></td>
      </tr>
      <tr>
        <td>Description</td>
        <td><form name="form3" method="post" action="">
          <label for="txt_description"></label>
          <textarea name="txt_description" id="txt_description"></textarea>
        </form></td>
      </tr>
      <tr>
        <td>Catagory</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Sub Catagory </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Price</td>
        <td><form name="form4" method="post" action="">
          <label for="txt_price"></label>
          <input type="text" name="txt_price" id="txt_price">
        </form></td>
      </tr>
      <tr>
        <td>Photo</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><form name="form1" method="post" action=""> 
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
        </form></td>
      </tr>
</table>
</body>
</html>
<?php 
if($_GET['num']>0) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="tbl_result">
  <tr>
    <td>Stock Number</td>
    <td>Lot Number</td>
    <td>Land Price</td>            
    <td>House Price</td>
    <td>Package Price</td>
    <td>Rent Range From $</td>
    <td>Rent Range To $</td>
    <td>Rent Return From %</td>
    <td>Rent Return To %</td>              
  </tr>
<? }

for($i=0; $i<$_GET['num']; $i++) {
	//echo "test-".$i."<br/>";
?>
    <tr>
        <td><input type="text" id="stock_number_<?php echo $i; ?>" name="stock_number[<?php echo $i; ?>]" size="10" /></td>
        <td><input type="text" id="lot_number_<?php echo $i; ?>" name="lot_number[<?php echo $i; ?>]" size="5" /></td>
        <td><input type="text" id="land_price_<?php echo $i; ?>" name="land_price[<?php echo $i; ?>]" size="10" /></td>
        <td><input type="text" id="house_price_<?php echo $i; ?>" name="house_price[<?php echo $i; ?>]" size="10" /></td>
        <td><input type="text" id="package_price_<?php echo $i; ?>" name="package_price[<?php echo $i; ?>]" size="10" /></td>
        <td><input type="text" id="rent_range_from_<?php echo $i; ?>" name="rent_range_from[<?php echo $i; ?>]" size="4" /></td>
        <td><input type="text" id="rent_range_to_<?php echo $i; ?>" name="rent_range_to[<?php echo $i; ?>]" size="4" /></td>
        <td><input type="text" id="rent_return_from_<?php echo $i; ?>" name="rent_return_from[<?php echo $i; ?>]" size="5" /></td>
        <td><input type="text" id="rent_return_to_<?php echo $i; ?>" name="rent_return_to[<?php echo $i; ?>]" size="5" /></td>            
    </tr>   
<?
}
?>
</table> 
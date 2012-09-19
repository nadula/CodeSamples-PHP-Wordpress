<?php 
if(($_GET['num']>0) && (is_numeric($_GET['num']))) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td class="orange"><br />PRICING & RETURNS<br /><br /></td></tr>
  <tr>
    <td colspan="2">    
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="tbl_result">
  <tr>
    <td></td>
    <td>Stock Number</td>
    <td>Lot Number</td>
    <td>Display Home</td>
    <td>Land Price</td>            
    <td>House Price</td>
    <td>Package Price</td>
    <td>Rent Range From $</td>
    <td>Rent Range To $</td>
    <td>Rent Return From %</td>
    <td>Rent Return To %</td>              
  </tr>
<?

for($i=0; $i<$_GET['num']; $i++) {
	//echo "test-".$i."<br/>";
?>
    <tr>
        
        <td><?php echo $i+1; ?></td>
        <td><input type="text" id="stock_number_<?php echo $i; ?>" name="stock_number[]" size="10" /></td>
        <td><input type="text" id="lot_number_<?php echo $i; ?>" name="lot_number[]" size="5" /></td>
        <td align="center"><input type="checkbox" id="display_home_<?php echo $i; ?>" name="display_home[]" /></td>
        <td><input type="text" id="land_price_<?php echo $i; ?>" name="land_price[]" size="10" /></td>
        <td><input type="text" id="house_price_<?php echo $i; ?>" name="house_price[]" size="10" /></td>
        <td><input type="text" id="package_price_<?php echo $i; ?>" name="package_price[]" size="10" /></td>
        <td><input type="text" id="rent_range_from_<?php echo $i; ?>" name="rent_range_from[]" size="4" /></td>
        <td><input type="text" id="rent_range_to_<?php echo $i; ?>" name="rent_range_to[]" size="4" /></td>
        <td><input type="text" id="rent_return_from_<?php echo $i; ?>" name="rent_return_from[]" size="5" /></td>
        <td><input type="text" id="rent_return_to_<?php echo $i; ?>" name="rent_return_to[]" size="5" /></td>            
    </tr>   
<?
}
?>
</table> 
   	
    </td>
  </tr>
  <tr><td class="orange"><br /><hr/><br /></td></tr>
  <tr><td colspan="2" align="center">
	PROFILE NUMBER: &nbsp;&nbsp; <input type="text" id="profile_number" name="profile_number" size="10" />  	
  </td></tr>  
  <tr><td class="orange"><br /><hr/><br />DEVELOPMENT DESCRIPTION<br /><br /></td></tr>
  <tr>
    <td colspan="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td>Suburb: <input type="text" id="suburb" name="suburb" size="30" /></td>
            <td colspan="2">Surrounding Area: <input type="text" id="surrounding_area" name="surrounding_area" size="50" /></td>
          </tr>
          <tr>
            <td colspan="3">
            Services: <br/>
            <textarea class="ckeditor" name="services" id="services" style="width:98%"></textarea>
            </td>
          </tr> 
          <tr>
            <td colspan="3">
            Lot Type: <br/>
            <textarea class="ckeditor" name="lot_type" id="lot_type" style="width:98%"></textarea>
            </td>
          </tr>                     
          <tr>
            <td>Topography: <input type="text" id="topography" name="topography" size="20" /></td>
            <td>Lots in Development: <input type="text" id="lots_in_dev" name="lots_in_dev" size="30" /></td>
            <td>Council Rates per annum: <input type="text" id="council_rates" name="council_rates" size="30" /></td>
          </tr>
          <tr>
            <td colspan="3">
            Distance from CBD: <br/>
            <textarea class="ckeditor" name="distance_from_cbd" id="distance_from_cbd" style="width:98%"></textarea>
            </td>
          </tr>            
        </table>    	
    </td>
  </tr>
  <tr><td class="orange"><br /><hr/><br />DEVELOPMENT FEATURES<br /><br /></td></tr>
  <tr>
    <td colspan="2">
        <textarea class="ckeditor" name="dev_features" id="dev_features" style="width:98%"></textarea>
    </td>    
  </tr>
  <tr><td class="orange"><br /><hr/><br />LOCAL FACILITIES<br /><br /></td></tr>
  <tr>
    <td colspan="2">
        Schools: <br />
        <textarea class="ckeditor" name="local_schools" id="local_schools" style="width:98%"></textarea>
    </td>  
  </tr>
  <tr>
    <td colspan="2">
        Public Transport: <br />
        <textarea class="ckeditor" name="local_transport" id="local_transport" style="width:98%"></textarea>
    </td>  
  </tr>
  <tr>
    <td colspan="2">
        Shopping: <br />
        <textarea class="ckeditor" name="local_shopping" id="local_shopping" style="width:98%"></textarea>
    </td>  
  </tr>
  <tr>
    <td colspan="2">
        Medical Centers / Hospitals: <br />
        <textarea class="ckeditor" name="local_medical" id="local_medical" style="width:98%"></textarea>
    </td>  
  </tr>
  <tr>
    <td colspan="2">
        Sports and Recreation: <br />
        <textarea class="ckeditor" name="local_sports" id="local_sports" style="width:98%"></textarea> 
    </td>  
  </tr>
  <tr><td class="orange"><br /><hr/><br />CONSTRUCTION APPRAISAL<br /><br /></td></tr>
  <tr>
    <td colspan="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td>Construction: <input type="text" id="construction" name="construction" size="20" /></td>
            <td>Bedrooms: <input type="text" id="bedrooms" name="bedrooms" size="10" /></td>
            <td>Bathrooms: <input type="text" id="bathrooms" name="bathrooms" size="10" /></td>            
            <td>Garage: <input type="text" id="garage" name="garage" size="10" /></td>
          </tr>
          <tr>
            <td colspan="4">
                Roof Cladding: <br/>
                <input type="text" name="roof_cladding" id="roof_cladding" style="width:98%" />
            </td>
          </tr> 
          <tr>
            <td colspan="4">
                Expected Title Release: <br/>
                <input type="text" name="title_release_date" id="title_release_date" style="width:98%" />
            </td>
          </tr>
          <tr>
            <td colspan="4">
                Start Date: <br/>
                <input type="text" name="start_date" id="start_date" style="width:98%" />
            </td>
          </tr>
          <tr>
            <td colspan="4">
                Completion Date: <br/>
                <input type="text" name="finish_date" id="finish_date" style="width:98%" />
            </td>
          </tr>                      
        </table>    
    </td>
  </tr>
  <tr><td colspan="2" class="orange"><br /><hr/><br />SCHEDULE OF FINISHES<br /><br /></td></tr>
  <tr>
    <td colspan="2">
        Pre-construction: <br />
        <textarea class="ckeditor" name="pre_construction" id="pre_construction" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        External Fittings/Fixtures: <br />
        <textarea class="ckeditor" name="external_fittings" id="external_fittings" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Outdoor Living (design specific): <br />
        <textarea class="ckeditor" name="outdoor_living" id="outdoor_living" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Garage Construction: <br />
        <textarea class="ckeditor" name="garage_construction" id="garage_construction" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        5 Star Energy Efficiency: <br />
        <textarea class="ckeditor" name="energy_efficiency" id="energy_efficiency" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Internal Fixtures/Finishes: <br />
        <textarea class="ckeditor" name="internal_fixtures" id="internal_fixtures" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Kitchen Fittings: <br />
        <textarea class="ckeditor" name="kitchen_fittings" id="kitchen_fittings" style="width:98%"></textarea>
    </td>  
  </tr>              
  <tr>
    <td colspan="2">
        Bathrooms & Laundry: <br />
        <textarea class="ckeditor" name="bathroom_laundry" id="bathroom_laundry" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Electrical: <br />
        <textarea class="ckeditor" name="electrical" id="electrical" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Internal Services: <br />
        <textarea class="ckeditor" name="internal_services" id="internal_services" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        Tiling & Carpet: <br />
        <textarea class="ckeditor" name="tiling_carpet" id="tiling_carpet" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        External Landscaping: <br />
        <textarea class="ckeditor" name="external_landscaping" id="external_landscaping" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr>
    <td colspan="2">
        General: <br />
        <textarea class="ckeditor" name="general" id="general" style="width:98%"></textarea>
    </td>  
  </tr> 
  <tr><td colspan="2" class="orange"><br /><hr/><br />UPLOAD IMAGES<br /><br /></td></tr>
  <tr>
    <td colspan="2" id="red">Note: Wait till one image finish uploading before selecting another image to upload. 
    <br/>Images should be in 800x600 pixels (at least in this ratio) and less than 2MB in size.<br/><br/>
		<iframe src="uploadhtml.php" scrolling="no" width="690" height="1150" frameborder="0" border="0" cellspacing="0" ><p>Your browser does not support iframes.</p></iframe>    </td>  
  </tr>   
</table>
<br /><br /><div align="center"><input type="reset" class="btn_style" />&nbsp;&nbsp;<input type="submit" value="Add Property" class="btn_style" /></form></div>
<?php } else { echo "Please enter a valid number"; }?>
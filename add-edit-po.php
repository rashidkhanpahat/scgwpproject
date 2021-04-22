<?php
include('codelibrary/inc/main-include.inc.php');
include('codelibrary/inc/session-check.inc.php');
include('codelibrary/inc/region-check.inc.php');

if($_POST["txtAction"]=="")
{
	unset($_SESSION["poOrder"]);
	$poNumber=getPoNumber();
}

$action="add";
$recordExists=false;

include('add-edit-po-submit.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory Control System : <?php echo ucfirst($action); ?> Product</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<link href="css/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="codelibrary/js/lib.js"></script>
<script type="text/javascript" src="codelibrary/js/bsn.AutoSuggest_c_2.0.js"></script>
<script language="javascript" type="text/javascript" src="codelibrary/js/functions.js"></script>
<script language="javascript" type="text/javascript" src="codelibrary/js/jquery-1.3.2.js"></script>
<script language="javascript" type="text/javascript" src="codelibrary/js/ui.core.js"></script>
<script language="javascript" type="text/javascript" src="codelibrary/js/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$('#txtPoDate').datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" valign="top"><?php include_once('header.inc.php');?></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="main-mid-line"></td>
  </tr>
  <tr>
    <td height="7" align="center" valign="top"></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="maincontenor">
      <tr>
        <td height="140" align="right" valign="top"><?php include_once('left-navigation.inc.php'); ?></td><td width="769" height="140" align="left" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="750"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="main-section-top-mid">
              <tr>
                <td width="2%" align="left"><img src="images/main-sectiontop-left.GIF" width="34" height="32" /></td>
                <td width="96%"><?php echo strtoupper($action); ?> PO </td>
                <td width="2%" align="right"><img src="images/main-sectiontop-right.GIF" width="32" height="32" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="218" background="images/main-section-bg.GIF">
			<?php
			if($_POST["action"]=="add" || $_SESSION["poNumber"]=='')
			{
			?>
			<table border="0" cellpadding="5" cellspacing="0" width="100%"><form method="post" name="frm" onsubmit="javascript: return validateForm(this);">

			  <?php if(!empty($errorMsg)) { ?>
			  <tr>
			    <td colspan="4" align="center" ><table border="0" cellpadding="2" cellspacing="2" class="errormsg">
			      <tr>
			        <td align="center"><?php echo $errorMsg; ?></td>
			    </tr>
			      </table></td>
			    </tr>
			  <?php } ?>
              <tr>
                <td width="15%" align="right" valign="top" nowrap="nowrap"><span class="mandatory">*</span> PO Number:&nbsp;</td>
                  <td width="35%" align="left" valign="top">
                    <input name="txtPoNumber" type="text" class="txt-input" id="txtPoNumber" title="Product Name" lang="MUST" value="<?php echo $poNumber; ?>" size="30" readonly="true" /></td>
                  <td width="15%" align="left" valign="top"><span class="mandatory">*</span> PO date</td>
                  <td width="35%" align="left" valign="top"><input name="txtPoDate" type="text" class="txt-input" id="txtPoDate" value="<?php echo date("Y-m-d"); ?>" readonly="true" /></td>
              </tr>
              
              <tr>
                <td align="right" valign="top"><span class="mandatory">* </span>Vendor Name :&nbsp;</td>
                  <td align="left" valign="top"><input name="txtVendorName" type="text" class="txt-input" id="txtVendorName" title="Vendor Name" lang="MUST" value="<?php echo $vendorName; ?>"  size="30" />
                    <input type="hidden" id="txtVendorID" name="txtVendorID" value="" /></td>
                  <td align="left" valign="top">Vendor Address :</td>
                  <td align="left" valign="top"><textarea name="txtVendorAddress" class="txt-input" id="txtVendorAddress"></textarea></td>
              </tr>
              
              <tr>
                <td align="left" nowrap="nowrap">Vendor Invoice No</td>
                <td align="left" nowrap="nowrap"><input name="txtVendorInvoice" type="text" class="txt-input" id="txtVendorInvoice" /></td>
                <td align="left" nowrap="nowrap">Pick up Info :</td>
                <td align="left" nowrap="nowrap"><input name="txtContainerNumber" type="text" class="txt-input" id="txtContainerNumber" /></td>
              </tr>
              <tr>
                <td colspan="4" align="right" nowrap="nowrap">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" align="center" valign="top" nowrap="nowrap">
				<!-- PRODUCT LIST STARTS-->
				<table width="100%" border="0" cellpadding="2" cellspacing="2">
                  <tr>
                    <td width="25%"><strong>Product </strong></td>
                    <td width="17%"><strong>Make</strong></td>
                    <td width="22%"><strong>Model</strong></td>
                    <td width="21%"><strong>Serial No. </strong></td>
                    <td width="4%"><strong>Qty
                      
                    </strong></td>
                    <td width="11%"><strong>Price</strong></td>
                    </tr>
                  <tr>
                    <td><div id="divProducts" name="divProducts"><select name="txtProducts" id="txtProducts">
                    </select></div></td>
                    <td><div id="divMake" name="divMake"><select name="txtMake" id="txtMake">
                    </select></div>                    </td>
                    <td><div id="divModel" name="divModel"><select name="txtModel" id="txtModel">
                    </select></div>                    </td>
                    <td><input name="txtMachSerialNo" type="text" class="txt-input" id="txtMachSerialNo" size="22" /></td>
                    <td align="center"><input name="txtQuantity" type="text" class="txt-input" id="txtQuantity" size="4" value="1" /></td>
                    <td><input name="txtPrice" type="text" class="txt-input" id="txtPrice" value="0" size="4" /></td>
                    </tr>
                  <tr>
                    <td height="2" colspan="6"></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center" valign="bottom">&nbsp;</td>
                    <td align="center" valign="bottom">&nbsp;</td>
                    <td align="center" valign="baseline"><input name="nextBut" type="button" class="otherbutton" id="nextBut" value="Next" onclick="javascript: updatePo('add');" /></td>
                    </tr>
                  <tr>
                    <td height="4" colspan="6"></td>
                    </tr>
                  <tr>
                    <td colspan="6" align="center" valign="top"><div id="poDiv"></div></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center" valign="bottom">&nbsp;</td>
                    <td align="center" valign="bottom">&nbsp;</td>
                    <td align="center" valign="baseline">&nbsp;</td>
                  </tr>
                </table>
				<!-- PRODUCT LIST ENDS -->				</td>
              </tr>
              <tr>
                <td colspan="4" align="right" nowrap="nowrap">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" align="right" nowrap="nowrap"><hr size="1" noshade="noshade" /></td>
              </tr>
              <tr>
                <td align="right" nowrap="nowrap"><input name="txtAction" type="hidden" id="txtAction" value="<?php echo $action; ?>" /></td>
                  <td colspan="3" align="left"><input name="Submit" type="submit" class="submitbt" value="Continue" />
                    <input name="Submit22" type="button" class="submitbt" value="Cancel" onclick="javascript: window.location.href='cancel-po.php';" /></td>
              </tr>
            </form>
        </table>
		<script type="text/javascript">
			var options = {
				script:"vendors.inc.php?json=true&",
				varname:"input",
				json:true,
				callback: function (obj) { document.getElementById('txtVendorID').value = obj.id; document.getElementById('txtVendorAddress').value = obj.info; }
			};
			var as_json = new AutoSuggest('txtVendorName', options);
		</script>
		<script language="javascript" type="text/javascript">getProducts('getProducts2.inc.php',0,'divProducts',0,0);
		//updatePo('get');
		</script>
		<script language="javascript" type="text/javascript">pageFocus('txtVendorName');</script>
		<?php
		}
		?>
		</td>
          </tr>
          <tr>
            <td><img src="images/main-section-bottom.GIF" width="750" height="15" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="7" align="center" valign="top"></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="main-mid-line"></td>
  </tr>
  <tr>
    <td height="42" align="center" valign="middle"><?php include('footer.inc.php'); ?></td>
  </tr>
</table>
</body>
</html>

<?php
	defined('_JEXEC') or die('Restricted access');
	$siteURL = JURI::base();
	$rootURL = JURI::root();
	$document =& JFactory::getDocument();

	// include css files
	$custom_css = $siteURL."components/com_property/css/custom.css";
	$editor_css = $siteURL."components/com_property/css/jquery.cleditor.css";
	$theme_css = $siteURL."components/com_property/css/jquery.ui.theme.css";
	$tab_css = $siteURL."components/com_property/css/jquery.ui.tabs.css";

	$document->addStyleSheet($custom_css);
	$document->addStyleSheet($editor_css);
	$document->addStyleSheet($theme_css);
	$document->addStyleSheet($tab_css);

	//include js files
	$validate_js = $siteURL."components/com_property/js/jquery.validate.js";
	$metadata_js = $siteURL."components/com_property/js/jquery.metadata.js";
	$mask_js = $siteURL."components/com_property/js/jquery.maskedinput-1.2.2.js";
	$property_js = $siteURL."components/com_property/js/property.js";
	$editor_js = $siteURL."components/com_property/js/jquery.cleditor.js";
	$form_js = $siteURL."components/com_property/js/jquery.form.js";
	$widget_js = $siteURL."components/com_property/js/jquery.ui.widget.js";
	$tab_js = $siteURL."components/com_property/js/jquery.ui.tabs.js";

	$document->addScript($validate_js);
	$document->addScript($metadata_js);
	$document->addScript($mask_js);
	$document->addScript($property_js);
	$document->addScript($editor_js);
	$document->addScript($form_js);
	$document->addScript($widget_js);
	$document->addScript($tab_js);

?>
<style type="text/css">
.ui-tabs .ui-tabs-hide { display: none; }
</style>
<div align="right" style="float:right">
	<a href="<?php echo $siteURL;?>index.php?option=com_property" rel="canonical" ><strong>Back</strong></a>
</div><br/>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Basic</a></li>
		<li><a href="?option=com_property&view=xtrafeatures&format=raw">Features</a></li>
		<li><a href="?option=com_property&view=contact_detail&format=raw">Contact</a></li>
		<li><a href="?option=com_property&view=upload_images&format=raw">Images</a></li>
	</ul>
	<div id="tabs-1">
	<fieldset >
		<form name="addPropertyForm" id="addPropertyForm" action="" method="POST" >
			<label style="margin:3px;font:bold 14px verdna;color:#5F6F7F">Basic</label>
			<table border="0" width="100%" cellpadding="5" cellspacing="5">
				<tr>
					<td width="15%" align="right"><label for="propTitle"><sup>*</sup>Property Title:</label></td>
					<td width="85%" align="left" valign="top" >
						<input type="text" name="propTitle" id ="propTitle"  size="47"
						value="<?php if(isset($this->prop_data['property_name'])) { echo $this->prop_data['property_name']; }?>" >
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="prop_type_id"><sup>*</sup>Property Type:</label></td>
					<td align="left" valign="top">
						<select name="prop_type_id" id="prop_type_id" class="selectbox" title="Please select Type" validate="required:true" >
							<option value="">-Select-</option>
							<?php foreach($this->type_list as $tkey => $tval) { ?>
							<option value="<?php echo $tval['type_id']; ?>"<?php if ($tval['type_id'] == $this->prop_data['property_type_id']) { ?>
							selected="selected" <?php } ?> > <?php echo $tval['type_name']; ?> </option>
							<?php } // end of foreach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><label for="property_description">Short Description:</label></td>
					<td align="left" valign="top">
						<textarea id="property_description" name="property_description"><?php echo $this->prop_data['property_description'];?></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="prop_country"><sup>*</sup>Country:</label></td>
					<td align="left" valign="top">
						<select name="prop_country" id="prop_country" class="selectbox" title="Please select Country" validate="required:true" >
							<option value="">-Select-</option>
							<option value="Cyprus" <?php if ($this->prop_data['property_country'] == 'Cyprus'){ ?> selected="selected" <?php } ?> >Cyprus</option>
							<option value="Greece" <?php if ($this->prop_data['property_country'] == 'Greece'){ ?> selected="selected" <?php } ?> >Greece</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="prop_province_id"><sup>*</sup>Province:</label></td>
					<td align="left" valign="top">
						<select name="prop_province_id" id="prop_province_id"  class="selectbox" title="Please select Province" validate="required:true" >
							<option value="" >-Select-</option>
							<?php foreach($this->province_list as $pkey => $pval) { ?>
							<option value="<?php echo $pval['province_id']; ?>"<?php if ($pval['province_id'] == $this->prop_data['property_province_id']) { ?>
							selected="selected" <?php } ?> > <?php echo $pval['province_name']; ?> </option>
							<?php } // end of foreach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="prop_district_id"><sup>*</sup>District:</label></td>
					<td align="left" valign="top">
						<select name="prop_district_id" id="prop_district_id"  class="selectbox" title="Please select District"
								validate="required:true" <?php if(empty($this->prop_data['property_district_id'])) { ?> disabled="disabled" <?php } ?> >
							<option value="" >-Select-</option>
							<?php foreach($this->district_list as $dkey => $dval) { ?>
							<option value="<?php echo $dval['district_id']; ?>"<?php if ($dval['district_id'] == $this->prop_data['property_district_id']) { ?>
							selected="selected" <?php } ?> > <?php echo $dval['district_name']; ?> </option>
							<?php } // end of foreach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="prop_district_id"><sup>*</sup>City:</label></td>
					<td align="left" valign="top">
						<select name="prop_city_id" id="prop_city_id"  class="selectbox" title="Please select City" validate="required:true"
							<?php if(empty($this->prop_data['property_city_id'])) { ?> disabled="disabled" <?php } ?> >
							<option value="" >-Select-</option>
							<?php foreach($this->city_list as $ckey => $cval) { ?>
							<option value="<?php echo $cval['city_id']; ?>"<?php if ($cval['city_id'] == $this->prop_data['property_city_id']) { ?>
							selected="selected" <?php } ?> > <?php echo $cval['city_name']; ?> </option>
							<?php } // end of foreach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="address1"><sup>*</sup>Address line 1:</label></td>
					<td align="left" valign="top">
						<input type="text" name="address1" id="address1" size="47"
						value="<?php if(isset($this->prop_data['property_address_line1'])) echo $this->prop_data['property_address_line1']; ?>" >
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="address2">Address line 2:</label></td>
					<td align="left" valign="top">
						<input type="text" name="address2" id="address2" size="47"
						value="<?php if(isset($this->prop_data['property_address_line2'])) echo $this->prop_data['property_address_line2']; ?>" >
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="zip">Zip:</label></td>
					<td align="left" valign="top">
						<input type="text" name="zip" id="zip" size="10" maxlength="8"
						value="<?php if(isset($this->prop_data['property_zip'])) echo $this->prop_data['property_zip']; ?>" >
					</td>
				</tr>
				<tr>
					<td align="right" ><label for="price"><sup>*</sup>Price :</td>
					<td align="left" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" >
							<tr>
								<td>
									<input type="text" name="price" id="price" size="47"
									value="<?php if(isset($this->prop_data['property_price'])) echo $this->prop_data['property_price']; ?>" >
								</td>
								<td valign="middle">
									<input type="checkbox" name="with_vat" id="with_vat"  value="t">
										<label for="with_vat" style="float:right;margin:4px 2px;font:bold 11px arial;cursor:pointer;" >VAT included </label>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<input type='hidden' value='com_property' name='option' />
						<input type='hidden' value='property' name='controller' />
						<input type='hidden' value='storeProperty' name='task' />
						<input type='hidden' value='<?php echo $this->property_id; ?>' name='property_id' />
						<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
					</td>
					<td align="left">
						<input type="submit" value="<?php echo $this->title_text; ?>" name="doAction" class="submit"  />
					<?php if(empty($this->property_id)) : ?>
						<input type="reset" value="Clear" name="Clear" class="submit" id="clear"/>
					<?php endif; ?>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
	</div> <!--end of tab 1-->
</div>
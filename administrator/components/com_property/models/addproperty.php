<?php
/**
 * Joomla! 1.5.7 component advertise
 *
 * @author Keshav mohta
 * @package Joomla
 * @subpackage advertise
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class PropertyModelAddproperty extends JModel
{
   /**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct();
		//Selecting Database
		$this->db =& JFactory::getDBO();
		$this->user =& JFactory::getUser();
	}
	public function __toString() {
		$statement = "this is<b>".__CLASS__."</b> Class.<br/>Defined in <i>".__FILE__."</i>";
		return $statement;
 	}
	public function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_property', $msg );
	}

	public function save()
	{
		try
		{
			$post_data = JRequest::get('POST');
			// here DESCRIPRION  field should be same as user write using tinymce
			$post_data['description'] = JRequest::getVar('property_description', '', 'POST', 'string', JREQUEST_ALLOWRAW);
			//JRequest::watch($post_data,1,0);
			$sql  = (intval($post_data['property_id']) !== 0) ? "UPDATE " : "INSERT INTO ";
			$sql .= " #__property SET
												property_name='%s',
												property_type_id=%d,
												property_country='%s',
												property_province_id=%d,
												property_district_id=%d,
												property_city_id=%d,
												property_address_line1='%s',
												property_address_line2='%s',
												property_zip=%d,
												property_price='%s',
												property_description='%s',";
			$sql .= (intval($post_data['property_id']) !== 0) ? " property_updated_by=%d WHERE property_id=%d "
															: " property_added_by=%d,property_added_date=NOW() ";
			$property_value = array ( addslashes($post_data['propTitle']), $post_data['prop_type_id'],$post_data['prop_country'],
			$post_data['prop_province_id'], $post_data['prop_district_id'], $post_data['prop_city_id'], addslashes($post_data['address1']),
			addslashes($post_data['address2']), $post_data['zip'], $post_data['price'], $post_data['description'],$this->user->id,
			$post_data['property_id'] );
			//print vsprintf( $sql,$property_value ) ;
			$this->db->setQuery(vsprintf($sql,$property_value));
			return $this->db->query();
		}
		catch(Exception $e){
				//who cares!
		}
	}

	public function storeContact()
	{
		try
		{
			$post_data = JRequest::get('POST');
			// here DESCRIPRION  field should be same as user write using tinymce
			JRequest::watch($post_data,1,0);
			$sql  = (intval($post_data['property_contact_id']) !== 0) ? "UPDATE " : "INSERT INTO ";
			$sql .= " #__property_contact SET
												property_id=%d,
												contact_office_name='%s',
												contact_number='%s',
												alternate_number='%s',
												contact_person_name='%s',
												contact_address='%s',
												display_address='%s',
												contact_email='%s',";
			$sql .= (intval($post_data['property_contact_id']) !== 0) ? " contact_updated_by=%d WHERE contact_id=%d "
															: " contact_added_by=%d,contact_added_date=NOW() ";
			$contact_value = array(($post_data['property_id']), addslashes($post_data['contact_office']),$post_data['contact_number'],
			$post_data['alt_number'], addslashes($post_data['contact_person']), addslashes($post_data['contact_address']), $post_data['show_address'],
			$post_data['contact_email'],$this->user->id,$post_data['property_contact_id'] );
			// print vsprintf( $sql,$contact_value ) ; jexit();
			$this->db->setQuery(vsprintf($sql,$contact_value));
			return $this->db->query();
		}
		catch(Exception $e){
				//who cares!
		}
	}


	public function storeDetails()
	{
		try
		{
			$post_data = JRequest::get('POST');
			// here DESCRIPRION  field should be same as user write using tinymce
			$post_data['detail'] = JRequest::getVar('more_detail', '', 'POST', 'string', JREQUEST_ALLOWRAW);
			JRequest::watch($post_data,1,0);
			$sql  = (intval($post_data['property_detail_id']) !== 0) ? "UPDATE " : "INSERT INTO ";
			$sql .= " #__property_detail SET
												property_id=%d,
												total_bedroom=%d,
												total_bathroom=%d,
												total_kitchen=%d,
												total_covered_area=%01.3f,
												total_covered_veranda=%01.3f,
												swiming_pool='%s',
												lift_available='%s',
												parking_type='%s',
												property_condition_id=%d,
												property_full_description='%s',
												built_year=%d,
												video_link='%s',
												sea_distance=%01.2f,
												airport_distance=%01.2f,
												railway_distance=%01.2f,
												highway_distance=%01.2f, ";
			$sql .= (intval($post_data['property_detail_id']) !== 0) ? " updated_by=%d WHERE property_detail_id=%d "
															         : " added_by=%d,added_date=NOW() ";
			$detail_value = array ( $post_data['property_id'], $post_data['bedroom'], $post_data['bathroom'], $post_data['kitchen'],
            $post_data['cover_area'], $post_data['cover_veranda'], $post_data['swiming_pool'], $post_data['lift'], $post_data['parking_type'],
			$post_data['p_cond'], addslashes($post_data['detail']), $post_data['built_year'], addslashes($post_data['video_link']), $post_data['sea_d'],
			$post_data['air_d'], $post_data['stn_d'], $post_data['hiw_d'],$this->user->id, $post_data['property_detail_id'] );
// 			print vsprintf( $sql,$detail_value ) ; jexit();
			$this->db->setQuery(vsprintf($sql,$detail_value));
			return $this->db->query();
		}
		catch(Exception $e){
				//who cares!
		}

	}

	/**
	* Function to save origianl image and thumbail image on destination folder
	* modified by keshav mohta
	*/
	public function imageResize($image)
	{
		try
		{
			$dim = array();
			//Making filename unique by appending timestamp
			$image_original_name = $image['name'];
  			$imageinfo = pathinfo($image_original_name);
			//image name changed to image_timestamp
			$image_rename =  basename($image_original_name,".".$imageinfo['extension'])."_".time().'.'. $imageinfo['extension'];
			// spaces are changed to '_' and this is the final name of image
			$image_title = preg_replace('/\s+/','_', $image_rename);
			//Fetch width and height from the _config table
			$query = 'SELECT
							max_thumb_width AS width,
							max_thumb_height AS height,
							image_store_path AS path,
							image_thumb_path AS thumb_path
					  FROM #__config';
			$this->db->setQuery($query);

			// Store image standards in dimenstion array
			$dim = $this->db->loadAssoc();
			$thumb_height = $dim['height'] ? $dim['height'] : 150;
			$thumb_width = $dim['width'] ? $dim['width'] : 100;
			$allowed_types = array( 'image/pjpeg','image/gif','image/png','image/jpeg');

			if ( in_array($image['type'], $allowed_types ) )
			{
				if (!copy($image['tmp_name'], JPATH_SITE . DS . $dim['path'] . $image_title)) {
 				    die("failed to copy" .  $image['tmp_name'] . "...\n");
				}

				//name of saved image width full path
				$image_save = JPATH_SITE . DS .$dim['path'] . $image_title;
				//get the height & width of original image saved
				list($width, $height) = getimagesize($image_save);
				//let's create thumb image
				$thumb_image= imagecreatetruecolor($thumb_width, $thumb_height);

				switch ($image['type']) {

						case "image/png" :// alight different action when image is png( to remain transparency)
											$black = imagecolorallocate($thumb_image, 0, 0, 0);
											// Make the background transparent
											imagecolortransparent($thumb_image, $black);
											$tmpimage = imagecreatefrompng($image_save);
											// $thumb_image is now developed as a 150*100 width image
											imagecopyresampled($thumb_image, $tmpimage, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
											$thumbname = $image_title;
											//filename remain same but path of thumbnail is different
											$location = JPATH_SITE . DS . $dim['thumb_path'] . $thumbname;
											// Save the image
											imagepng($thumb_image,$location,0,100); // NOTE=>4 arguments
											// free up the memory
											imagedestroy($thumb_image);
											break;
					// gif is not allowed right now
						case "image/gif" :
											$tmpimage = imagecreatefromgif($image_save);
											imagecopyresampled($thumb_image, $tmpimage, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
											$thumbname = $image_title;
											$location = JPATH_SITE . DS . $dim['thumb_path'] . $thumbname;
											imagegif($thumb_image, $location);// NOTE=>2 arguments
											imagedestroy($thumb_image);
											break;
						case ($image['type']=="image/jpeg" || $image['type']=="image/pjpeg"):
											$tmpimage = imagecreatefromjpeg($image_save);
											imagecopyresampled($thumb_image, $tmpimage, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
											$thumbname = $image_title;
											$location = JPATH_SITE . DS . $dim['thumb_path'] . $thumbname;
											imagejpeg($thumb_image,$location,100); //NOTE=>3 arguments
											imagedestroy($thumb_image);
											break;
						default :
											imagedestroy($thumb_image);
											break;
						}
				$paths['image_title'] = $image_title;
				$paths['image_path']  = $dim['path'] . $image_title;
				$paths['thumb_path']  = $dim['thumb_path'] . $image_title;
				return $paths;
			}
		}
		catch (Exception $e)
		{
			return 0;
		}
	}


	public function insertImageData($image_query, $image_info, $id, $about=NULL)
	{
// 		JRequest::watch(func_get_args(),1,0);
// 		echo "<br/>".__LINE__."image query:";
// 		print sprintf($image_query,$image_info['type'],addslashes($image_info['title']),$image_info['path'],$image_info['size'],$id);

		//Inserting data into Images table
	    $this->db->setQuery(sprintf($image_query,$image_info['type'],addslashes($image_info['title']),$image_info['path'],$image_info['size'],$id));
		echo "<br/>".__LINE__." Image Added:".$this->db->query();
		echo "<br/>".__LINE__." Last insert ID:".$insert_id = $this->db->insertid();
		echo "<br/>".__LINE__." Affected Rows:".$this->db->getAffectedRows();
		// insert image id and ad id in imagead table
		if (!empty($about))
		{
			$imagead_query = " INSERT INTO #__imagead (image_id, ad_id) VALUES (%d, %d)";

			echo "<br/>".__LINE__."image Ad Query:";
			print sprintf($imagead_query, $insert_id, $id);

			$this->db->setQuery(sprintf($imagead_query, $insert_id, $id));

			echo "<br/>".__LINE__."Image AD table added:".$this->db->query();
			echo "<br/>".__LINE__." Affected Rows:".$this->db->getAffectedRows();
		}
	}



}
?>
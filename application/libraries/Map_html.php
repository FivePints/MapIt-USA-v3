<?php
class Map_html {
	function __construct() {
		$this->ci =& get_instance();
		$this->ci->load->model('map_userfields', 'mapUserFields');
		$this->ci->load->library('parser');
   }
	

	public function compileHtml($fields = '', $pointId = ''){
		foreach ($fields as $fieldsKey => $fieldsValue) {
			if ($fieldsValue['uservalue'] != ''){
				$userFields[$fieldsValue['fieldname']] = $fieldsValue['uservalue'];
			}else{
				$userFields[$fieldsValue['fieldname']] = '';
			}
			$string[$fieldsKey] = array(
				'html' => $this->ci->parser->parse_string($fieldsValue['html'], $userFields, TRUE),
				'fieldId' => $fieldsValue['fieldid'],
				'pointId' => $pointId,
				'fieldValue' => $fieldsValue['uservalue']
			);
		}
		return $string;
	}

	public function compileBatchHtml($field, $fieldvalue){
		$string = $this->ci->parser->parse_string($field, $fieldvalue, TRUE);
		return $string;
	}

	public function compileLogo($value){
		$logo = '<img src="<?php echo $value; ?>" class="popup-company-logo">';
	
		return $logo;	
	}

	public function compileTitle($value){
		$title = '<h3 class="popup-company-name">'.$value.'</h3>';
		return $title;
	}

	public function compileName($value){
		$name = '<p class="popup-contact-name"><strong>'.$value.'</strong></p>';
		return $name;
	}
	public function compileAddress($value){
		$address = '<address class="popup-company-address">'.$value->address1.'<br>';
		#echo $value->address2;
		if ($value->address2 != 'NULL' || $value->address2 != ' '){
			$address .= $value->address2.'address2<br>';
		}else{
			$address .= '';
		}

		$address .= $value->city.', ';
		$address .= $value->state.' ';
		$address .= $value->zip;
		$address .= '</address><br>';

		return $address;
	}

	public function compilePhone($value){
		$phone = '<p class="popup-company-telephone"><strong>Tel:</strong> '.$value.'</p>';
		return $phone;
	}

	public function compileEmail($value){
		$email = '<p class="popup-company-email"><strong>Email:</strong> '.$value.'</p>';
		return $email;
	}

	public function compileWebsite($value){
		$website = '<p class="popup-company-website"><strong>Website:</strong> <a href="'.$value.'" target="_blank">'.$value.'</a></p>';
		return $website;
	}
	public function compileSocialMedia($value){
		if (isset($value->facebook)){
			$socialMedia = '<a href="http://www.facebook.com/'.$value->facebook.'" target="_blank" class="social-media-icon" class="popup-company-sociamedia"><img src="http://placehold.it/60x60"></a>';
		}
		if (isset($value->linkedin)){
			$socialMedia .= '<a href="http://www.linkedin.com/'.$value->linkedin.'" target="_blank"  class="social-media-icon" class="popup-company-sociamedia"><img src="http://placehold.it/60x60"></a>';
		}
		if (isset($value->twitter)){
			$socialMedia .= '<a href="http://www.twitter.com/'.$value->twitter.'" target="_blank"  class="social-media-icon" class="popup-company-sociamedia"><img src="http://placehold.it/60x60"></a>';
		}
		if (isset($value->googleplus)){
			$socialMedia .= '<a href="http://#/'.$value->googleplus.'" target="_blank"  class="social-media-icon" class="popup-company-sociamedia"><img src="http://placehold.it/60x60"></a>';
		}
		return $socialMedia;
	}
}
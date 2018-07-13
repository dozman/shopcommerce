<?php
/**
 * XCustom Http
 *
 * @author  Peter Ramokone
 * @package Http Request & Response Handler
 */
class XCustomGeneric{
	/**
	 * get an array of hours for meeting
	 *
	 * @return array
	 */
	public static function getHoursArray(){
		$arrHours = array();
		$arrHours['01'] = '01';
		$arrHours['02'] = '02';
		$arrHours['03'] = '03';
		$arrHours['04'] = '04';
		$arrHours['05'] = '05';
		$arrHours['06'] = '06';
		$arrHours['07'] = '07';
		$arrHours['08'] = '08';
		$arrHours['09'] = '09';
		$arrHours['10'] = '10';
		$arrHours['11'] = '11';
		$arrHours['12'] = '12';
	
		return $arrHours;
	}
	
	/**
	 * get an array of minutes for meeting
	 *
	 * @return array
	 */
	public static function getMinutesArray(){
		$arrMinutes = array();
		$arrMinutes['00'] = '00';
		$arrMinutes['15'] = '15';
		$arrMinutes['30'] = '30';
		$arrMinutes['45'] = '45';
		return $arrMinutes;
	}
	
	/**
	 * get an array of years array
	 *
	 * @return array
	 */
	public static function getYearsArray($start_year = null,$stop_at = 10){
		$arrYears = array();
	
		$this_year = date('Y');
		$start_year = (!empty($start_year) && is_numeric($start_year) && $start_year <= $this_year)?$start_year:1970;
		$addition = $this_year - $start_year;
	
		$year_cnt = $start_year + $addition + (int) $stop_at; // always go 10 years ahead
		for($x=$start_year; $x <= $year_cnt; $x++){
			$arrYears[$x]=$x;
		}
	
		return $arrYears;
	}
	
	/**
	 * remove matching tokens from array - remove element that have values maching the token list
	 * 
	 * @param array search values array(orange, banana)
	 * @param array $from - array(1 => apple, 2 => orange, 3 => banana)
	 * 
	 * @return array;
	 * 
	 * @note using the example params array of index 2 and 3 will be removed 
	 */
	public static function removeMatchedValues($tokens, $from){
		$new_list = $from;
		foreach($from as $index => $character){
			if(in_array($character, $tokens)){
				unset($new_list[$index]);
			}
		}
		return $new_list;
	}	
	
	/**
	 * get a list of country dialing codes
	 * 
	 * @return array - e.g. array(27 => 'South Africa (+27)') 
	 */
	public static function getCountryDialingCodes(){
		$arrInternationalCountryDialingCode = array();
		$arrInternationalCountryDialingCode['93']	= "Afghanistan (+93)";
		$arrInternationalCountryDialingCode['355']	= "Albania (+355)";
		$arrInternationalCountryDialingCode['213']	= "Algeria (+213)";
		$arrInternationalCountryDialingCode['1']	= "American Samoa (+1)";
		$arrInternationalCountryDialingCode['376']	= "Andorra (+376)";
		$arrInternationalCountryDialingCode['244']	= "Angola (+244)";
		$arrInternationalCountryDialingCode['1']	= "Anguilla (+1)";
		$arrInternationalCountryDialingCode['1']	= "Antigua (+1)";
		$arrInternationalCountryDialingCode['54']	= "Argentina (+54)";
		$arrInternationalCountryDialingCode['374']	= "Armenia (+374)";
		$arrInternationalCountryDialingCode['297']	= "Aruba (+297)";
		$arrInternationalCountryDialingCode['61']	= "Australia (+61)";
		$arrInternationalCountryDialingCode['43']	= "Austria (+43)";
		$arrInternationalCountryDialingCode['994']	= "Azerbaijan (+994)";
		$arrInternationalCountryDialingCode['973']	= "Bahrain (+973)";
		$arrInternationalCountryDialingCode['880']	= "Bangladesh (+880)";
		$arrInternationalCountryDialingCode['1']	= "Barbados (+1)";
		$arrInternationalCountryDialingCode['375']	= "Belarus (+375)";
		$arrInternationalCountryDialingCode['32']	= "Belgium (+32)";
		$arrInternationalCountryDialingCode['501']	= "Belize (+501)";
		$arrInternationalCountryDialingCode['229']	= "Benin (+229)";
		$arrInternationalCountryDialingCode['1']	= "Bermuda (+1)";
		$arrInternationalCountryDialingCode['975']	= "Bhutan (+975)";
		$arrInternationalCountryDialingCode['591']	= "Bolivia (+591)";
		$arrInternationalCountryDialingCode['599']	= "Bonaire, Sint Eustatius and Saba (+599)";
		$arrInternationalCountryDialingCode['387']	= "Bosnia and Herzegovina (+387)";
		$arrInternationalCountryDialingCode['267']	= "Botswana (+267)";
		$arrInternationalCountryDialingCode['55']	= "Brazil (+55)";
		$arrInternationalCountryDialingCode['246']	= "British Indian Ocean Territory (+246)";
		$arrInternationalCountryDialingCode['1']	= "British Virgin Islands (+1)";
		$arrInternationalCountryDialingCode['673']	= "Brunei (+673)";
		$arrInternationalCountryDialingCode['359']	= "Bulgaria (+359)";
		$arrInternationalCountryDialingCode['226']	= "Burkina Faso (+226)";
		$arrInternationalCountryDialingCode['257']	= "Burundi (+257)";
		$arrInternationalCountryDialingCode['855']	= "Cambodia (+855)";
		$arrInternationalCountryDialingCode['237']	= "Cameroon (+237)";
		$arrInternationalCountryDialingCode['1']	= "Canada (+1)";
		$arrInternationalCountryDialingCode['238']	= "Cape Verde (+238)";
		$arrInternationalCountryDialingCode['1']	= "Cayman Islands (+1)";
		$arrInternationalCountryDialingCode['236']	= "Central African Republic (+236)";
		$arrInternationalCountryDialingCode['235']	= "Chad (+235)";
		$arrInternationalCountryDialingCode['56']	= "Chile (+56)";
		$arrInternationalCountryDialingCode['86']	= "China (+86)";
		$arrInternationalCountryDialingCode['57']	= "Colombia (+57)";
		$arrInternationalCountryDialingCode['269']	= "Comoros (+269)";
		$arrInternationalCountryDialingCode['682']	= "Cook Islands (+682)";
		$arrInternationalCountryDialingCode['506']	= "Costa Rica (+506)";
		$arrInternationalCountryDialingCode['225']	= "Côte d'Ivoire (+225)";
		$arrInternationalCountryDialingCode['385']	= "Croatia (+385)";
		$arrInternationalCountryDialingCode['53']	= "Cuba (+53)";
		$arrInternationalCountryDialingCode['599']	= "Curaçao (+599)";
		$arrInternationalCountryDialingCode['357']	= "Cyprus (+357)";
		$arrInternationalCountryDialingCode['420']	= "Czech Republic (+420)";
		$arrInternationalCountryDialingCode['243']	= "Democratic Republic of the Congo (+243)";
		$arrInternationalCountryDialingCode['45']	= "Denmark (+45)";
		$arrInternationalCountryDialingCode['253']	= "Djibouti (+253)";
		$arrInternationalCountryDialingCode['1']	= "Dominica (+1)";
		$arrInternationalCountryDialingCode['1']	= "Dominican Republic (+1)";
		$arrInternationalCountryDialingCode['593']	= "Ecuador (+593)";
		$arrInternationalCountryDialingCode['20']	= "Egypt (+20)";
		$arrInternationalCountryDialingCode['503']	= "El Salvador (+503)";
		$arrInternationalCountryDialingCode['240']	= "Equatorial Guinea (+240)";
		$arrInternationalCountryDialingCode['291']	= "Eritrea (+291)";
		$arrInternationalCountryDialingCode['372']	= "Estonia (+372)";
		$arrInternationalCountryDialingCode['251']	= "Ethiopia (+251)";
		$arrInternationalCountryDialingCode['500']	= "Falkland Islands (+500)";
		$arrInternationalCountryDialingCode['298']	= "Faroe Islands (+298)";
		$arrInternationalCountryDialingCode['691']	= "Federated States of Micronesia (+691)";
		$arrInternationalCountryDialingCode['679']	= "Fiji (+679)";
		$arrInternationalCountryDialingCode['358']	= "Finland (+358)";
		$arrInternationalCountryDialingCode['33']	= "France (+33)";
		$arrInternationalCountryDialingCode['594']	= "French Guiana (+594)";
		$arrInternationalCountryDialingCode['689']	= "French Polynesia (+689)";
		$arrInternationalCountryDialingCode['241']	= "Gabon (+241)";
		$arrInternationalCountryDialingCode['995']	= "Georgia (+995)";
		$arrInternationalCountryDialingCode['49']	= "Germany (+49)";
		$arrInternationalCountryDialingCode['233']	= "Ghana (+233)";
		$arrInternationalCountryDialingCode['350']	= "Gibraltar (+350)";
		$arrInternationalCountryDialingCode['30']	= "Greece (+30)";
		$arrInternationalCountryDialingCode['299']	= "Greenland (+299)";
		$arrInternationalCountryDialingCode['1']	= "Grenada (+1)";
		$arrInternationalCountryDialingCode['590']	= "Guadeloupe (+590)";
		$arrInternationalCountryDialingCode['1']	= "Guam (+1)";
		$arrInternationalCountryDialingCode['502']	= "Guatemala (+502)";
		$arrInternationalCountryDialingCode['44']	= "Guernsey (+44)";
		$arrInternationalCountryDialingCode['224']	= "Guinea (+224)";
		$arrInternationalCountryDialingCode['245']	= "Guinea-Bissau (+245)";
		$arrInternationalCountryDialingCode['592']	= "Guyana (+592)";
		$arrInternationalCountryDialingCode['509']	= "Haiti (+509)";
		$arrInternationalCountryDialingCode['504']	= "Honduras (+504)";
		$arrInternationalCountryDialingCode['852']	= "Hong Kong (+852)";
		$arrInternationalCountryDialingCode['36']	= "Hungary (+36)";
		$arrInternationalCountryDialingCode['354']	= "Iceland (+354)";
		$arrInternationalCountryDialingCode['91']	= "India (+91)";
		$arrInternationalCountryDialingCode['62']	= "Indonesia (+62)";
		$arrInternationalCountryDialingCode['98']	= "Iran (+98)";
		$arrInternationalCountryDialingCode['964']	= "Iraq (+964)";
		$arrInternationalCountryDialingCode['353']	= "Ireland (+353)";
		$arrInternationalCountryDialingCode['44']	= "Isle Of Man (+44)";
		$arrInternationalCountryDialingCode['972']	= "Israel (+972)";
		$arrInternationalCountryDialingCode['39']	= "Italy (+39)";
		$arrInternationalCountryDialingCode['1']	= "Jamaica (+1)";
		$arrInternationalCountryDialingCode['81']	= "Japan (+81)";
		$arrInternationalCountryDialingCode['44']	= "Jersey (+44)";
		$arrInternationalCountryDialingCode['962']	= "Jordan (+962)";
		$arrInternationalCountryDialingCode['7']	= "Kazakhstan (+7)";
		$arrInternationalCountryDialingCode['254']	= "Kenya (+254)";
		$arrInternationalCountryDialingCode['686']	= "Kiribati (+686)";
		$arrInternationalCountryDialingCode['381']	= "Kosovo (+381)";
		$arrInternationalCountryDialingCode['965']	= "Kuwait (+965)";
		$arrInternationalCountryDialingCode['996']	= "Kyrgyzstan (+996)";
		$arrInternationalCountryDialingCode['856']	= "Laos (+856)";
		$arrInternationalCountryDialingCode['371']	= "Latvia (+371)";
		$arrInternationalCountryDialingCode['961']	= "Lebanon (+961)";
		$arrInternationalCountryDialingCode['266']	= "Lesotho (+266)";
		$arrInternationalCountryDialingCode['231']	= "Liberia (+231)";
		$arrInternationalCountryDialingCode['218']	= "Libya (+218)";
		$arrInternationalCountryDialingCode['423']	= "Liechtenstein (+423)";
		$arrInternationalCountryDialingCode['370']	= "Lithuania (+370)";
		$arrInternationalCountryDialingCode['352']	= "Luxembourg (+352)";
		$arrInternationalCountryDialingCode['853']	= "Macau (+853)";
		$arrInternationalCountryDialingCode['389']	= "Macedonia (+389)";
		$arrInternationalCountryDialingCode['261']	= "Madagascar (+261)";
		$arrInternationalCountryDialingCode['265']	= "Malawi (+265)";
		$arrInternationalCountryDialingCode['60']	= "Malaysia (+60)";
		$arrInternationalCountryDialingCode['960']	= "Maldives (+960)";
		$arrInternationalCountryDialingCode['223']	= "Mali (+223)";
		$arrInternationalCountryDialingCode['356']	= "Malta (+356)";
		$arrInternationalCountryDialingCode['692']	= "Marshall Islands (+692)";
		$arrInternationalCountryDialingCode['596']	= "Martinique (+596)";
		$arrInternationalCountryDialingCode['222']	= "Mauritania (+222)";
		$arrInternationalCountryDialingCode['230']	= "Mauritius (+230)";
		$arrInternationalCountryDialingCode['262']	= "Mayotte (+262)";
		$arrInternationalCountryDialingCode['52']	= "Mexico (+52)";
		$arrInternationalCountryDialingCode['373']	= "Moldova (+373)";
		$arrInternationalCountryDialingCode['377']	= "Monaco (+377)";
		$arrInternationalCountryDialingCode['976']	= "Mongolia (+976)";
		$arrInternationalCountryDialingCode['382']	= "Montenegro (+382)";
		$arrInternationalCountryDialingCode['1']	= "Montserrat (+1)";
		$arrInternationalCountryDialingCode['212']	= "Morocco (+212)";
		$arrInternationalCountryDialingCode['258']	= "Mozambique (+258)";
		$arrInternationalCountryDialingCode['95']	= "Myanmar (+95)";
		$arrInternationalCountryDialingCode['264']	= "Namibia (+264)";
		$arrInternationalCountryDialingCode['674']	= "Nauru (+674)";
		$arrInternationalCountryDialingCode['977']	= "Nepal (+977)";
		$arrInternationalCountryDialingCode['31']	= "Netherlands (+31)";
		$arrInternationalCountryDialingCode['687']	= "New Caledonia (+687)";
		$arrInternationalCountryDialingCode['64']	= "New Zealand (+64)";
		$arrInternationalCountryDialingCode['505']	= "Nicaragua (+505)";
		$arrInternationalCountryDialingCode['227']	= "Niger (+227)";
		$arrInternationalCountryDialingCode['234']	= "Nigeria (+234)";
		$arrInternationalCountryDialingCode['683']	= "Niue (+683)";
		$arrInternationalCountryDialingCode['672']	= "Norfolk Island (+672)";
		$arrInternationalCountryDialingCode['850']	= "North Korea (+850)";
		$arrInternationalCountryDialingCode['1']	= "Northern Mariana Islands (+1)";
		$arrInternationalCountryDialingCode['47']	= "Norway (+47)";
		$arrInternationalCountryDialingCode['968']	= "Oman (+968)";
		$arrInternationalCountryDialingCode['92']	= "Pakistan (+92)";
		$arrInternationalCountryDialingCode['680']	= "Palau (+680)";
		$arrInternationalCountryDialingCode['970']	= "Palestine (+970)";
		$arrInternationalCountryDialingCode['507']	= "Panama (+507)";
		$arrInternationalCountryDialingCode['675']	= "Papua New Guinea (+675)";
		$arrInternationalCountryDialingCode['595']	= "Paraguay (+595)";
		$arrInternationalCountryDialingCode['51']	= "Peru (+51)";
		$arrInternationalCountryDialingCode['63']	= "Philippines (+63)";
		$arrInternationalCountryDialingCode['48']	= "Poland (+48)";
		$arrInternationalCountryDialingCode['351']	= "Portugal (+351)";
		$arrInternationalCountryDialingCode['1']	= "Puerto Rico (+1)";
		$arrInternationalCountryDialingCode['974']	= "Qatar (+974)";
		$arrInternationalCountryDialingCode['242']	= "Republic of the Congo (+242)";
		$arrInternationalCountryDialingCode['262']	= "Réunion (+262)";
		$arrInternationalCountryDialingCode['40']	= "Romania (+40)";
		$arrInternationalCountryDialingCode['7']	= "Russia (+7)";
		$arrInternationalCountryDialingCode['250']	= "Rwanda (+250)";
		$arrInternationalCountryDialingCode['590']	= "Saint Barthélemy (+590)";
		$arrInternationalCountryDialingCode['290']	= "Saint Helena (+290)";
		$arrInternationalCountryDialingCode['1']	= "Saint Kitts and Nevis (+1)";
		$arrInternationalCountryDialingCode['590']	= "Saint Martin (+590)";
		$arrInternationalCountryDialingCode['508']	= "Saint Pierre and Miquelon (+508)";
		$arrInternationalCountryDialingCode['1']	= "Saint Vincent and the Grenadines (+1)";
		$arrInternationalCountryDialingCode['685']	= "Samoa (+685)";
		$arrInternationalCountryDialingCode['378']	= "San Marino (+378)";
		$arrInternationalCountryDialingCode['239']	= "Sao Tome and Principe (+239)";
		$arrInternationalCountryDialingCode['966']	= "Saudi Arabia (+966)";
		$arrInternationalCountryDialingCode['221) ']	= "Senegal (+221) ";
		$arrInternationalCountryDialingCode['381']	= "Serbia (+381)";
		$arrInternationalCountryDialingCode['248']	= "Seychelles (+248)";
		$arrInternationalCountryDialingCode['232']	= "Sierra Leone (+232)";
		$arrInternationalCountryDialingCode['65']	= "Singapore (+65)";
		$arrInternationalCountryDialingCode['599']	= "Sint Maarten (+599)";
		$arrInternationalCountryDialingCode['421']	= "Slovakia (+421)";
		$arrInternationalCountryDialingCode['386']	= "Slovenia (+386)";
		$arrInternationalCountryDialingCode['677']	= "Solomon Islands (+677)";
		$arrInternationalCountryDialingCode['252']	= "Somalia (+252)";
		$arrInternationalCountryDialingCode['27']	= "South Africa (+27)";
		$arrInternationalCountryDialingCode['82']	= "South Korea (+82)";
		$arrInternationalCountryDialingCode['211']	= "South Sudan (+211)";
		$arrInternationalCountryDialingCode['34']	= "Spain (+34)";
		$arrInternationalCountryDialingCode['94']	= "Sri Lanka (+94)";
		$arrInternationalCountryDialingCode['1']	= "St. Lucia (+1)";
		$arrInternationalCountryDialingCode['249']	= "Sudan (+249)";
		$arrInternationalCountryDialingCode['597']	= "Suriname (+597)";
		$arrInternationalCountryDialingCode['268']	= "Swaziland (+268)";
		$arrInternationalCountryDialingCode['46']	= "Sweden (+46)";
		$arrInternationalCountryDialingCode['41']	= "Switzerland (+41)";
		$arrInternationalCountryDialingCode['963']	= "Syria (+963)";
		$arrInternationalCountryDialingCode['886']	= "Taiwan (+886)";
		$arrInternationalCountryDialingCode['992']	= "Tajikistan (+992)";
		$arrInternationalCountryDialingCode['255']	= "Tanzania (+255)";
		$arrInternationalCountryDialingCode['66']	= "Thailand (+66)";
		$arrInternationalCountryDialingCode['1']	= "The Bahamas (+1)";
		$arrInternationalCountryDialingCode['220']	= "The Gambia (+220)";
		$arrInternationalCountryDialingCode['670']	= "Timor-Leste (+670)";
		$arrInternationalCountryDialingCode['228']	= "Togo (+228)";
		$arrInternationalCountryDialingCode['690']	= "Tokelau (+690)";
		$arrInternationalCountryDialingCode['676']	= "Tonga (+676)";
		$arrInternationalCountryDialingCode['1']	= "Trinidad and Tobago (+1)";
		$arrInternationalCountryDialingCode['216']	= "Tunisia (+216)";
		$arrInternationalCountryDialingCode['90']	= "Turkey (+90)";
		$arrInternationalCountryDialingCode['993']	= "Turkmenistan (+993)";
		$arrInternationalCountryDialingCode['1']	= "Turks and Caicos Islands (+1)";
		$arrInternationalCountryDialingCode['688']	= "Tuvalu (+688)";
		$arrInternationalCountryDialingCode['256']	= "Uganda (+256)";
		$arrInternationalCountryDialingCode['380']	= "Ukraine (+380)";
		$arrInternationalCountryDialingCode['971']	= "United Arab Emirates (+971)";
		$arrInternationalCountryDialingCode['44']	= "United Kingdom (+44)";
		$arrInternationalCountryDialingCode['1']	= "United States (+1)";
		$arrInternationalCountryDialingCode['598']	= "Uruguay (+598)";
		$arrInternationalCountryDialingCode['1']	= "US Virgin Islands (+1)";
		$arrInternationalCountryDialingCode['998']	= "Uzbekistan (+998)";
		$arrInternationalCountryDialingCode['678']	= "Vanuatu (+678)";
		$arrInternationalCountryDialingCode['39']	= "Vatican City (+39)";
		$arrInternationalCountryDialingCode['58']	= "Venezuela (+58)";
		$arrInternationalCountryDialingCode['84']	= "Vietnam (+84)";
		$arrInternationalCountryDialingCode['681']	= "Wallis and Futuna (+681)";
		$arrInternationalCountryDialingCode['212']	= "Western Sahara (+212)";
		$arrInternationalCountryDialingCode['967']	= "Yemen (+967)";
		$arrInternationalCountryDialingCode['260']	= "Zambia (+260)";
		$arrInternationalCountryDialingCode['263']	= "Zimbabwe (+263)";
		return $arrInternationalCountryDialingCode;
	}
	
	/**
	 * This function helps with binding/replaces tags into content
	 *  - manippulate an array send as $replace_tags, then add a prefix "$opening_tag" and a suffix "$closing_tag:
	 *    then do a string replace on $content	
	 *
	 * @param string $content
	 * @param array $replace_tags
	 * @param string $opening_tag - "the left char for wrap" optional : default is {
	 * @param string $closing_tag - "the right char for wrap" optional : default is }
	 * @param string $default_null - optional: a default value that should be used if data is null
	 * 
	 * @return string
	 * 
	 * @example if you have a text "my name is myname" and want to replace it with a dynamix value, this is what u do
	 * 			- $replace_tags =  array('myname' => Peter Ramokone)
	 * 			- $content = "my name is {myname}"
	 * 			- finally call this: XCustomGeneric::replaceTags($content,$replace_tags)
	 */
	public static function replaceTags($content, $replace_tags, $opening_tag = '{', $closing_tag = '}', $default_null = ''){		
		if($content && is_array($replace_tags)){
			foreach ($replace_tags as $tag_name => $tag_data){
				if(is_null($tag_data) || $tag_data == ''){
					$content = str_replace("{$opening_tag}{$tag_name}{$closing_tag}","{$default_null}",$content);
				}
				else{
					$content = str_replace("{$opening_tag}{$tag_name}{$closing_tag}","{$tag_data}",$content);
				}				
			}
		}				
		return $content;				
	}
	/**
	 * convert a given amount to cents
	 *
	 * @param string $amount
	 * 
	 * @return int
	 */
	public static function moneyToCents($amount){
		/**
		 * check if the decimal comman exists
		 */
		if(strstr($amount, '.')){
			/**
			 * split the amount in chunks using dot(.)
			 */
			$amount_array = explode('.',$amount);
			
			/**
			 * get cents
			 */
			$cents = (string) end($amount_array);
			
			/**
			 * get rands
			 */
			$rands = (int) $amount_array[0];
			
			/**
			 * cents has only 1 digit
			 */
			if(strlen($cents) == 1){
				
				/**
				 * no rands
				 */
				if($rands == 0){
					return $cents.'0';
				}
				else{
					return $rands.$cents.'0';
				}
			}
			else {
				/**
				 * no rands
				 */
				if($rands == 0){
					/**
					 * have 2 digit cents
					 */				
					if(strlen($cents) == 2){
	                   return $cents;
					}
	                else{
	                    return substr($cents,0,2);
	                }
				}
				else{
					if(strlen($cents) == 2){
	                   return str_replace('.','',$amount);
					}
	                else{
	                   return $rands.substr($cents,0,2);
	                }
				}
			}
		}
		else{
			/**
			 * append extra zeros for cents in the amount
			 */
			return (int) $amount.'00';
		}
	}
	
	
	/**
	 * convert a given cents to monetary value
	 * 
	 *
	 * @param string $amount - 1.00 as 100
	 * 
	 * @return double
	 */
	public static function centsToMoney($amount){
		
		/**
		 * check if the amount has decimal
		 */
		if(strstr('.',$amount)){
			// return as formated money
			return XCustomFormat::getMoney($amount);
			
		}
		// the cents is already there: 000 will be 0.00
		else if(strlen($amount) >= 3){
			return substr($amount, 0, -2) . '.' . substr($amount, -2);			
		}
		else{
			return XCustomFormat::getMoney($amount);
		}
	}
	
	/**
	 * Converts an array of RGB data to CMYK data.
	 *
	 * @param array $rgb -  an array of color information where
     * 				$rgb[0] == red
     * 				$rgb[1] == green
     * 				$rgb[2] == blue
     *               
	 * @return array containing CMYK color information:
	 * 							$array[0] == cyan
	 * 							$array[1] == magenta
	 * 							$array[2] == yellow
	 * 							$array[3] == black
	 */
	public static function rgbToCmyk($rgb){
	    $cyan = 1 - ($rgb[0] / 255);
	    $magenta = 1 - ($rgb[1] / 255);
	    $yellow = 1 - ($rgb[2] / 255);
	
	    $min = min($cyan, $magenta, $yellow);
	   
	    if ($min == 1){
	        return array(0,0,0,1);
	    }
	
	    $K = $min;
	    $black = 1 - $K;
	
	    return array
	    (
	        ($cyan - $K) / $black,
	        ($magenta- $K) / $black,
	        ($yellow - $K) / $black,
	        $K
	    );
	}

	/**
	 * covert size to bytes
	 * 
	 * @param string $size - e.g. 10m = 10 megabytes
	 * 
	 * @return float
	 */
	public static function sizeToBytes($size){
	    $size = trim($size);
	    $last = strtolower($str[strlen($size)-1]);
	    switch($last) {
	    	// gigabytes
	        case 'g': 
	        	$size *= 1024;
			break;
			
			// megabytes
	        case 'm': 
	        	$size *= 1024;
			break;
			
			// kilobytes
	        case 'k': 
	        	$size *= 1024;  
			break;      
	    }
	    return $size;
	}
	/**
	 * covert hex to dexcimal
	 * 
	 * @param string $hex - e.g. #336699
	 * 
	 * @return float
	 */
	public static function hexTodec($hex){
		// red code
	    $R = substr($hex, 1, 2);
	    $rouge = hexdec($R);
		
	    // green code
	    $V = substr($hex, 3, 2);
	    $vert = hexdec($V);
		
	    // blue code
	    $B = substr($hex, 5, 2);
	    $bleu = hexdec($B);
		
	    $tbl_couleur = array();
	    $tbl_couleur['R']	= $rouge;
	    $tbl_couleur['G']	= $vert;
	    $tbl_couleur['B']	= $bleu;
	    return $tbl_couleur;
	}
	
	/**
	 * convert to digits
	 * 
	 * @param string
	 * 
	 * @return int
	 */
	public static function numbersOnly($name){
		$range 	= range('a', 'z');
		$range 	= array_flip($range);
		$name	= strtolower($name);
		
		$number = '';
		
		$name = str_split($name);
		
		foreach($name as $char){
			$number .= (array_key_exists($char, $range)) ? $range[$char]  : $char;
		}
		
		return XCustomGeneric::digits($number);
	}
	
	
	/**
	 * convert alphanumeric string to Roman alphabet system
	 * 	- 
	 * 
	 * @param string $string
	 * 
	 * @param int - converted string
	 */
	public static function stringToRas($string){
		// list of chars
		$arrRomanAlphas = range('a', 'z');
		$arrRomanAlphas = array_flip($arrRomanAlphas);
		
		// convert to alphanumeric
		$string = self::alphanumeric($string, false);
		
		// convert to lower case to accomodate roman alpha list
		$string = self::lowercase($string);
		
		// length of the srring
		$str_length = strlen((string) $string);
		
		// converted striing
		$str_converted = '';
		
		for($counter = 0; $counter < $str_length; $counter++){
			// add 10 to the string index to make sure that the romace system starts at 10 where a = 10, b = 11 etc
			$str_converted .= (array_key_exists($string[$counter], $arrRomanAlphas)) ? 10 + (int)$arrRomanAlphas[$string[$counter]] : $string[$counter];
		}
		return $str_converted;
	}/**
	 * remove all but disgits from a string
	 * 
	 * @param string $string
	 * 
	 * @return numeric
	 */	
	public static function digits($string){
		// check if unicode is enabled
		$bolUnicode = (@preg_match('/\pL/u', 'a')) ? true : false;	
	
		// unicode not enabled, use 0-9 match
		 if (!$bolUnicode) {
           $strPattern = '/[^0-9]/';
        } 
		 // check for mbstring extension
        else if (extension_loaded('mbstring')) {
           $strPattern = '/[^[:digit:]]/';
        }
		// no mbstring filtering
		else {
           $strPattern = '/[\p{^N}]/';
        }

		// replace all unwanted chars with nothing(none)
        return preg_replace($strPattern, '', (string) $string);
	}
	
	/**
	 * remove away all characters from a string that are not letters and numbers

	 * @note you can also include spaces by setting the $include_spacing parameter to true
	 * 
	 * @param string $string
	 * @param boolean $include_spacing - optional: default false
	 * 
	 * @return string
	 */
	public static function alphanumeric($string, $include_spacing = false){
		
		// filter all but : letters, numbers and spaces
		if($include_spacing){
			return preg_replace("/[^A-Za-z0-9[:space:]]/",'',$string);
		}
		else{
			// filter all but : letters and numbers
			return preg_replace("/[^A-Za-z0-9]/",'',$string);
		}        
	}
	
	/**
	 * convert characters to lowercase
	 * 
	 * @param string $string
	 * @param boolean $encode - optional: default null -usage : utf-8
	 * 
	 * @note - if you don't set the encoding, then all characters with 'alphabetic' property will be converted - locale settings independent
	 * 
	 * @return string
	 */
	public static function lowercase($string, $encoding = null){
		
		// encoding has been provided
		if($encoding){
			return mb_strtolower((string) $string, $encoding);
		}
		else{
			// convert all - locale settings independent
			return strtolower((string) $string);
		}     
	}
	
	/**
	 * convert characters to uppercase
	 * 
	 * @param string $string
	 * @param boolean $encode - optional: default null -usage : utf-8
	 * 
	 * @note - if you don't set the encoding, then all characters with 'alphabetic' property will be converted - locale settings independent
	 * 
	 * @return string
	 */
	public static function uppercase($string, $encoding = null){
		
		// encoding has been provided
		if($encoding){
			return mb_strtoupper((string) $string, $encoding);
		}
		else{
			// convert all - locale settings independent
			return strtoupper((string) $string);
		}     
	}
	
	

    /**
     * convert array to parameters
     * 
     * @param array - array(name => value, name2 => value)
     * 
     * @return string - /name/value/name2/value/
     * 
     */
    public static function arrayToParams($params){
        if(empty($params) || !is_array($params)){
        	return;
        }
        
        $strParams = '/';
               
        
        foreach($params as $name => $value){
        	$strParams .= "{$name}/{$value}/";
        }
        return $strParams;
    }
	
	/**
	 * convert widget string to param
	 * 
	 * @param string $string_param - /var1/value/var2/value/
	 * 
	 * @return array - array(name => value)
	 */
	public static function  converStringToParam($string_param){
		// check if we have sring
		$string_param = trim($string_param);
		if(!$string_param){
			return;
		}
		
		// set parameters list based on slashes
		$string_param = trim($string_param, '/');
		
		$params = explode('/', $string_param);
		
		// total params after filters
		$total_params = count($params);
		
		// create sequencial keys are set valus
		$final_params = array_combine(range(0, $total_params-1), array_values($params));
			
		// ignore double or more slahes
		$params = array_filter($params);
		
		// skip rule to help with param setup
		$skip_rule = false;		
		
		// total params after filters
		$total_params = count($params);
		
		// the handle for params found
		$found_params = array();
			
		for($param_count = 0; $param_count <= $total_params; $param_count++){
			// param has value
			if( isset($final_params[$param_count+1]) ){
				
				// check if we need to skip the rule
				if($skip_rule){
					// do not skip the next one
					$skip_rule = false;
				}
				else{
					$found_params[$final_params[$param_count]] = $final_params[$param_count+1];
					$skip_rule = true;
				}
			}
		}
		return $found_params;
	}
	
}
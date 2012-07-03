<?php
/**
 * Helper class for calculating CityLink Delivery Zones by postcode.
 * This can be useful when calculating shipping costs on ecommerce
 * projects where the goods will be shipped via CityLink.
 *
 * @author     Matt Oakley @ Creative Intent (matt@creativeintent.co.uk)
 * @copyright  (c) 2010-2012 Creative Intent
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */
class CityLink_Delivery_Zone
{
	private static $_citylink_zone_postcodes = array(
		// Scottish Highlands
		'2' => array(
			'G83 7', 'G83 8', 'G84 0', 'IV10 8', 'IV11 8', 'IV12 4', 'IV12 5',
			'IV12 9', 'IV13 7', 'IV14 9', 'IV15 0', 'IV15 9', 'IV16 9', 'IV17 0',
			'IV18 0', 'IV18 9', 'IV19 1', 'IV19 9', 'IV2 6', 'IV20 1', 'IV21 2',
			'IV22 2', 'IV23 2', 'IV24 3', 'IV25 3', 'IV26 2', 'IV27 4', 'IV27 9',
			'IV28 3', 'IV30 1', 'IV30 4', 'IV30 5', 'IV30 6', 'IV30 8', 'IV30 9',
			'IV31 6', 'IV32 7', 'IV36 1', 'IV36 2', 'IV36 3', 'IV36 9', 'IV4 7',
			'IV40 8', 'IV5 7', 'IV52 8', 'IV53 8', 'IV54 8', 'IV6 7', 'IV63 6',
			'IV63 7', 'IV7 8', 'IV8 8', 'IV9 8', 'KW1 4', 'KW1 5', 'KW10 6',
			'KW11 6','KW12 6', 'KW13 6', 'KW14 7', 'KW14 8', 'KW14 9', 'KW2 6',
			'KW3 6', 'KW5 6', 'KW6 6', 'KW7 6', 'KW8 6', 'KW9 6', 'PA21 2',
			'PA22 3', 'PA23 7', 'PA23 8', 'PA23 9', 'PA24 8', 'PA25 8', 'PA26 8',
			'PA27 8', 'PA28 6', 'PA28 9', 'PA29 6', 'PA30 8', 'PA31 8', 'PA31 9',
			'PA32 8', 'PA33 1', 'PA34 4', 'PA34 5', 'PA34 9', 'PA35 1', 'PA36 4',
			'PA37 1', 'PA38 4', 'PH17 2', 'PH19 1', 'PH20 1', 'PH21 1', 'PH22 1', 
			'PH23 3', 'PH24 3', 'PH25 3', 'PH26 3', 'PH26 9', 'PH30 4', 'PH31 4',
			'PH32 4', 'PH33 6', 'PH33 7', 'PH33 9', 'PH34 4', 'PH35 4', 'PH36 4',
			'PH37 4', 'PH38 4', 'PH39 4', 'PH40 4', 'PH41 4', 'PH49 4', 'PH50 4',
		),
		// Hebrides, Orkney Islands & Shetland Islands
		'3' => array(
			'HS1 2', 'HS1 9', 'HS2 0', 'HS2 9', 'HS3 3', 'HS4 3', 'HS5 3', 'HS6 5',
			'HS7 5', 'HS8 5', 'HS9 5', 'IV41 8', 'IV42 8', 'IV43 8', 'IV44 8',
			'IV45 8', 'IV46 8', 'IV47 8', 'IV48 8', 'IV49 9', 'IV51 0', 'IV51 9',
			'IV55 8', 'IV56 8', 'KA27 8', 'KA28 0', 'KW15 1', 'KW15 9', 'KW16 3',
			'KW16 9', 'KW17 2', 'PA20 0', 'PA20 9', 'PA41 7', 'PA42 7', 'PA43 7',
			'PA44 7', 'PA45 7', 'PA46 7', 'PA47 7', 'PA48 7', 'PA49 7', 'PA60 7',
			'PA61 7', 'PA62 6', 'PA63 6', 'PA64 6', 'PA65 6', 'PA66 6', 'PA67 6',
			'PA68 6', 'PA69 6', 'PA70 6', 'PA71 6', 'PA72 6', 'PA73 6', 'PA74 6',
			'PA75 6', 'PA76 6', 'PA77 6', 'PA78 6', 'PH41 2', 'PH42 4', 'PH43 4',
			'PH44 4', 'ZE1 0', 'ZE1 9', 'ZE2 9', 'ZE3 9',
		),
		// Nortehern Ireland (all BT postcodes)
		'4' => array(
			'BT',
		),
		// Repulic Ireland (no postcode system)
		'5' => NULL,
		// Isle of Man, Channel Islands, Guernsey, Alderney, Sark & Jersey
		'6' => array(
			'IM', 'GY', 'JE',
		),
		// Lodon Congestion Charge Zone
		'7' => array(
			'E1 6', 'E1 7', 'EC1A 1', 'EC1A 2', 'EC1A 4', 'EC1A 7', 'EC1A 9',
			'EC1B 1', 'EC1M 3', 'EC1M 4', 'EC1M 5', 'EC1M 6', 'EC1M 7', 'EC1N 2',
			'EC1N 6', 'EC1N 7', 'EC1N 8', 'EC1P 1', 'EC1R 0', 'EC1R 1', 'EC1R 3',
			'EC1R 4', 'EC1R 5', 'EC1V 0', 'EC1V 1', 'EC1V 2', 'EC1V 3', 'EC1V 4',
			'EC1V 7', 'EC1V 8', 'EC1V 9', 'EC1Y 0', 'EC1Y 1', 'EC1Y 2', 'EC1Y 4',
			'EC1Y 8', 'EC2A 1', 'EC2A 2', 'EC2A 3', 'EC2A 4', 'EC2B 0', 'EC2B 2',
			'EC2M 1', 'EC2M 2', 'EC2M 3', 'EC2M 4', 'EC2M 5', 'EC2M 6', 'EC2M 7',
			'EC2N 1', 'EC2N 2', 'EC2N 3', 'EC2N 4', 'EC2P 2', 'EC2R 5', 'EC2R 6',
			'EC2R 7', 'EC2R 8', 'EC2V 5', 'EC2V 6', 'EC2V 7', 'EC2V 8', 'EC2Y 5',
			'EC2Y 8', 'EC2Y 9', 'EC3A 1', 'EC3A 2', 'EC3A 3', 'EC3A 4', 'EC3A 5',
			'EC3A 6', 'EC3A 7', 'EC3A 8', 'EC3B 3', 'EC3M 1', 'EC3M 2', 'EC3M 3',
			'EC3M 4', 'EC3M 5', 'EC3M 6', 'EC3M 7', 'EC3M 8', 'EC3N 1', 'EC3N 2',
			'EC3N 3', 'EC3N 4', 'EC3P 3', 'EC3R 5', 'EC3R 6', 'EC3R 7', 'EC3R 8', 
			'EC3V 0', 'EC3V 1', 'EC3V 3', 'EC3V 4', 'EC3V 9', 'EC4A 1', 'EC4A 2',
			'EC4A 3', 'EC4A 4', 'EC4B 0', 'EC4B 4', 'EC4M 5', 'EC4M 6', 'EC4M 7',
			'EC4M 8', 'EC4M 9', 'EC4N 1', 'EC4N 4', 'EC4N 5', 'EC4N 6', 'EC4N 7',
			'EC4N 8', 'EC4P 4', 'EC4R 0', 'EC4R 1', 'EC4R 2', 'EC4R 3', 'EC4R 9',
			'EC4V 2', 'EC4V 3', 'EC4V 4', 'EC4V 5', 'EC4V 6', 'EC4Y 0', 'EC4Y 1',
			'EC4Y 7', 'EC4Y 8', 'EC4Y 9', 'EC50 1', 'EC50 3', 'EC50 4', 'EC50 9',
			'SE1 0', 'SE1 1', 'SE1 2', 'SE1 3', 'SE1 4', 'SE1 6', 'SE1 7', 'SE1 8',
			'SE1 9', 'SE11 4', 'SE11 5', 'SE11 6', 'SW10 0', 'SW10 9', 'SW1A 0',
			'SW1A 1', 'SW1A 2', 'SW1E 5', 'SW1E 6', 'SW1H 0', 'SW1H 9', 'SW1P 1',
			'SW1P 2', 'SW1P 3', 'SW1P 4', 'SW1P 9', 'SW1V 1', 'SW1V 2', 'SW1V 3',
			'SW1V 4', 'SW1W 0', 'SW1W 8', 'SW1W 9', 'SW1X 0', 'SW1X 7', 'SW1X 8',
			'SW1X 9', 'SW1Y 4', 'SW1Y 5', 'SW1Y 6', 'SW3 1', 'SW3 2', 'SW3 3',
			'SW3 4', 'SW3 5', 'SW3 6', 'SW5 0', 'SW7 1', 'SW7 2', 'SW7 3', 'SW7 4',
			'SW7 5', 'W10 5', 'W10 6', 'W11 1', 'W11 2', 'W11 3', 'W11 4', 'W14 8',
			'W1A 0', 'W1A 1', 'W1A 2', 'W1A 3', 'W1A 4', 'W1A 5', 'W1A 6', 'W1A 7',
			'W1A 8', 'W1A 9', 'W1B 1', 'W1B 2', 'W1B 3', 'W1B 4', 'W1B 5', 'W1C 1',
			'W1C 2', 'W1D 1', 'W1D 2', 'W1D 3', 'W1D 4', 'W1D 5', 'W1D 6', 'W1D 7',
			'W1E 0', 'W1E 1', 'W1E 2', 'W1E 3', 'W1E 4', 'W1E 5', 'W1E 6', 'W1E 7',
			'W1E 8', 'W1E 9', 'W1F 0', 'W1F 7', 'W1F 8', 'W1F 9', 'W1G 0', 'W1G 6',
			'W1G 7', 'W1G 8', 'W1G 9', 'W1H 1', 'W1H 2', 'W1H 4', 'W1H 5', 'W1H 6',
			'W1H 7', 'W1J 0', 'W1J 5', 'W1J 6', 'W1J 7', 'W1J 8', 'W1J 9', 'W1K 1',
			'W1K 2', 'W1K 3', 'W1K 4', 'W1K 5', 'W1K 6', 'W1K 7', 'W1S 1', 'W1S 2',
			'W1S 3', 'W1S 4', 'W1T 1', 'W1T 2', 'W1T 3', 'W1T 4', 'W1T 5', 'W1T 6',
			'W1T 7', 'W1U 1', 'W1U 2', 'W1U 3', 'W1U 4', 'W1U 5', 'W1U 6', 'W1U 7',
			'W1U 8', 'W1W 5', 'W1W 6', 'W1W 7',	'W1W 8', 'W2 1', 'W2 2', 'W2 3',
			'W2 4', 'W2 5', 'W2 6',	'W2 7',	'W8 4', 'W8 5', 'W8 6', 'W8 7', 'W8 9',
			'WC1A 1', 'WC1A 2', 'WC1A 9', 'WC1B 3', 'WC1B 4', 'WC1B 5', 'WC1E 6',
			'WC1E 7', 'WC1H 0', 'WC1H 8', 'WC1H 9', 'WC1N 1', 'WC1N 2', 'WC1N 3',
			'WC1R 4', 'WC1R 5', 'WC1V 6', 'WC1V 7', 'WC1X 0', 'WC1X 8', 'WC1X 9',
			'WC2A 1', 'WC2A 2', 'WC2A 3', 'WC2B 4', 'WC2B 5', 'WC2B 6', 'WC2E 7',
			'WC2E 8', 'WC2E 9', 'WC2H 0', 'WC2H 7', 'WC2H 8', 'WC2H 9', 'WC2N 4',
			'WC2N 5', 'WC2N 6', 'WC2R 0', 'WC2R 1', 'WC2R 2', 'WC2R 3',
		),
	);
	
	/**
	 * Loop through each of the postcode patterns held in the static 
	 * $_citylink_zone_postcodes array and return the Zone that matches.
	 *
	 *     $zone = CityLinkDeliveryZone::find_by_postcode($postcode);
	 *
	 * @param   string  postcode in any reasonable format
	 * @return  int  		CityLink zone
	 */
	public static function find_by_postcode($postcode)
  {
	  // Format postcode for searching
	  $postcode = self::prepare_postcode($postcode);

		// Loop through each zone and look for postcode until we find a match	 	
	 	foreach (self::$_citylink_zone_postcodes as $zone => $postcode_patterns)
	 	{
		 	foreach ($postcode_patterns as $postcode_pattern)
		 	{
		 		// Format pattern and compare to postcode, return the current zone if match is found
		 		$postcode_pattern = self::prepare_postcode($postcode_pattern);
			 	if (substr($postcode, 0, count($postcode_pattern)) === $postcode_pattern)
			 	{
				 	return (int)$zone;
			 	}
		 	}
	 	}
	 
	  // If no match has been found then assume
	  // Zone 1 (rest of UK)
	 	return 1;
	}
	
	private static function prepare_postcode($postcode)
	{
		return strtolower(str_replace(' ', '', $postcode));	
	}
}
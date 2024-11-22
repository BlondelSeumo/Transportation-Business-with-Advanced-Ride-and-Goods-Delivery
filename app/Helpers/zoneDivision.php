<?php

function numberFormat($value) {
	return number_format($value, 7, '.', '');
}

$longitude = array(); //longitude points of polygon
$jsonToArrLongitude = array();

function zoneLongitudeArrays($longitudeArr) {

	$jsonToArrLongitude = json_decode($longitudeArr, true);
	$longitudes = array_column($jsonToArrLongitude, 'lng');
	$longitude = array_map("numberFormat", $longitudes);

	return $longitude;

}

$latitude = array(); //latitude points of polygon
$jsonToArrLatitude = array();

function zoneLatitudeArrays($latitudeArr) {

	$jsonToArrLatitude = json_decode($latitudeArr, true);
	$latitudes = array_column($jsonToArrLatitude, 'lat');
	$latitude = array_map("numberFormat", $latitudes);
	return $latitude;

}

function getAllZoneList() {

	$zoneRecs = DB::table('zone')->whereNull('deleted_at')->get();

	return $zoneRecs;

}

$c = false;

function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y) {

	$i = $j = $c = 0;

	for ($i = 0, $j = $points_polygon - 1; $i < $points_polygon; $j = $i++) {
		if (($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i])) {
			$c = !$c;
		}
	}

	return $c;

}

function zoneTypeResponse($types) {

	$settunit = Settings::where('key', 'default_distance_unit')->first();
	$unit = $settunit->value;
	if ($unit == 0) {
		$unit_set = 'kms';
	} elseif ($unit == 1) {
		$unit_set = 'miles';
	}

	$type_array = array();

	foreach ($types as $type) {

		$data = array();
		$data['id'] = $type->id;
		$data['name'] = (!empty($type->zone_name) ? $type->zone_name : "");
		$data['min_fare'] = number_format(currency_converted($type->base_price), 2, '.', '');
		$data['max_size'] = intval($type->max_size);
		$data['icon'] = (!empty($type->icon) ? $type->icon : "");
		$data['is_default'] = (!empty($type->is_default) ? true : false);
		$data['price_per_unit_time'] = number_format(currency_converted($type->price_per_unit_time), 2, '.', '');
		$data['price_per_unit_distance'] = number_format(currency_converted($type->price_per_unit_distance), 2, '.', '');
		$data['base_price'] = number_format(currency_converted($type->base_price), 2, '.', '');
		$data['base_distance'] = number_format(currency_converted($type->base_distance), 2, '.', '');

		$data['currency'] = Config::get('app.generic_keywords.Currency');
		$data['unit'] = $unit_set;
		array_push($type_array, $data);
	}

	return $type_array;
}

function typeResponse() {

	$settunit = Settings::where('key', 'default_distance_unit')->first();
	$unit = $settunit->value;
	if ($unit == 0) {
		$unit_set = 'kms';
	} elseif ($unit == 1) {
		$unit_set = 'miles';
	}

	$type_array = array();
	$types = ProviderType::where('is_visible', '=', 1)->get();

	foreach ($types as $type) {
		$data = array();
		$data['id'] = $type->id;
		$data['name'] = $type->name;
		$data['min_fare'] = number_format(currency_converted($type->base_price), 2, '.', '');
		$data['max_size'] = intval($type->max_size);
		$data['icon'] = $type->icon;
		$data['is_default'] = $type->is_default ? true : false;
		$data['price_per_unit_time'] = number_format(currency_converted($type->price_per_unit_time), 2, '.', '');
		$data['price_per_unit_distance'] = number_format(currency_converted($type->price_per_unit_distance), 2, '.', '');
		$data['base_price'] = number_format(currency_converted($type->base_price), 2, '.', '');
		$data['base_distance'] = number_format(currency_converted($type->base_distance), 2, '.', '');
		$data['currency'] = Config::get('app.generic_keywords.Currency');
		$data['unit'] = $unit_set;
		array_push($type_array, $data);
	}

	return $type_array;
}

function isCheckZoneDivisionFound($zoneRecLists, $latitude, $longitude) {

	$results = array();

	foreach ($zoneRecLists as $key => $zoneList) {

		$zones = false;

		$longitudeZoneArray = array();
		$latitudeZoneArray = array();

		$longitudeZoneArray = zoneLongitudeArrays($zoneList->zone_json);
		$latitudeZoneArray = zoneLatitudeArrays($zoneList->zone_json);

		/*echo "<pre>";
			        print_r($longitudeZoneArray);
			        print_r($latitudeZoneArray);
		*/

		$points_polygon = count($longitudeZoneArray);

		if (is_in_polygon($points_polygon, $longitudeZoneArray, $latitudeZoneArray, $longitude, $latitude)) {

			//$results['result'] = "Is in polygon";
			$results['id'] = $zoneList->id;
			$zones = true;
			break;

		}
	}

	return $results;
}

function walkerTripCompletedUpdateRecords($reqServices, $zone_id, $distance, $time, $tripWaitingtime = 0) {

	$actual_total = 0;
	$price_per_unit_distance = 0;
	$price_per_unit_time = 0;
	$base_price = 0;

	foreach ($reqServices as $reqService) {

		$zoneTypeRecords = ZoneType::where('zone_id', $zone_id)->where('type', $reqService->type)->first();

		$base_price = $zoneTypeRecords->base_price;
		$reqService->base_price = $base_price;

		$is_multiple_service = Settings::where('key', 'allow_multiple_service')->first();
		if ($is_multiple_service->value == 0) {

			if ($distance <= $zoneTypeRecords->base_distance) {
				$price_per_unit_distance = 0;
			} else {
				$price_per_unit_distance = $zoneTypeRecords->price_per_unit_distance * ($distance - $zoneTypeRecords->base_distance);
			}

			$reqService->distance_cost = $price_per_unit_distance;

			$price_per_unit_time = $zoneTypeRecords->price_per_unit_time * (($time - $tripWaitingtime) > -1 ? ($time - $tripWaitingtime) : 0);

			$reqService->time_cost = $price_per_unit_time;

		}
		$reqService->total = $base_price + $price_per_unit_distance + $price_per_unit_time;

		$reqService->save();

		$actual_total = $actual_total + $base_price + $price_per_unit_distance + $price_per_unit_time;
	}

	return compact('actual_total', 'price_per_unit_time', 'price_per_unit_distance');
}

function walkerTripCompletedTotCalculation($request_id) {

	$reqServicesCalcs = RequestServices::where('request_id', $request_id)->get();

	$total = 0;
	foreach ($reqServicesCalcs as $reqServicesCalc) {

		$total = $total + $reqServicesCalc->total;
	}

	return $total;

}

function getTypeBesedZoneTyeRecords($typeId, $zoneId) {
	$zoneTypeRecords = DB::table('zone_type as zt')
		->where('zt.type', $typeId)
		->where('zt.zone_id', $zoneId)
		->Join('zone as z', 'zt.zone_id', '=', 'z.id')
		->select('zt.*', 'z.*')
		->Where('zt.is_visible', '=', 1)
		->whereNull('zt.deleted_at')
		->whereNull('z.deleted_at')
		->get();

	return $zoneTypeRecords;
}

function isCheckAllZonesTypesFindZoneId($longitude, $latitude) {

	/*   if(isset($walkLocatons) && !empty($walkLocatons)){
		           //$walkLocation = WalkLocation::where('request_id', $data->id)->orderBy('id', 'DESC')->first();
		           //$points = $walkLocation->longitude . " " . $walkLocation->latitude;
		           $points = $longitude . " " . $latitude;
		       } else {
		           $points = $longitude . " " . $latitude;
	*/

	$points = $longitude . " " . $latitude;
	$zoneRecords = array();
	$result = array();
	$zoneRecords = getAllZoneList();

	/*echo "<pre>";
		    print_r($zoneRecords);
	*/

	if (empty($zoneRecords)) {

		$response_array = array('success' => false, 'error' => 'Tipo de Servicio no encontrado', 'error_messages' => 'No Service for this Area', 'error_code' => 416);

		$response_code = 200;

		return Response::json($response_array, $response_code);

	} else {

		$zone = false;

		foreach ($zoneRecords as $key => $zoneList) {
			$results['id'] = '';
			$longitudeZoneArray = array();
			$latitudeZoneArray = array();

			$longitudeZoneArray = zoneLongitudeArrays($zoneList->zone_json);
			$latitudeZoneArray = zoneLatitudeArrays($zoneList->zone_json);

			$zoneCoordinates = array_map("zoneCoordinates", $longitudeZoneArray, $latitudeZoneArray);
			$pointLocation = new pointLocation();

			// The last point's coordinates must be the same as the first one's, to "close the loop"
			if ($pointLocation->pointInPolygon($points, $zoneCoordinates)) {
				$result['id'] = $zoneList->id;
				$zones = true;
				break;

			}

		}
	}

	return (!empty($result['id']) ? $result['id'] : '');
}

?>
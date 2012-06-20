<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map_library {

	function __construct(){
		$this->ci =& get_instance();
		$this->ci->config->load('map_config');
		#load the map config model to get the site title and other information
		$this->ci->load->model('Map_config', 'mapConfig');
		#the config data is passed in a class object, referenced via $mapConfig->columname;
		$this->mapConfig = $this->ci->mapConfig->getConfig();

	}#end constructor function
	
	public function createMap(){
		$lat = $this->mapConfig->default_lat;
		$lng = $this->mapConfig->default_lng;
		$default_map_id = $this->mapConfig->default_map_id;
		$default_zoom = $this->mapConfig->default_zoom;
		$default_map_type = $this->mapConfig->default_map_type;
		if ($default_zoom == '' || $default_zoom == '0'){ $default_zoom = $this->ci->config->item('defaultZoom'); }
		if ($default_map_id == '' || $default_map_id == '0'){ $default_map_id = $this->ci->config->item('defaultMapId'); }
		if ($default_map_type == '' || $default_map_type == '0'){ $default_map_type = $this->ci->config->item('defaultMapType'); }

		$createMap = 'var mapCenter = new google.maps.LatLng('.$lat.', '.$lng.');';
		$createMap .= "
			var map = new google.maps.Map(document.getElementById('".$default_map_id."'), {
				zoom: ".$default_zoom.",
				center: mapCenter,
				mapTypeId: google.maps.MapTypeId.".$default_map_type."
        	});
		";
		return $createMap;
	}#end createMap() function

	public function createMarker($lat, $lng, $markerIcon, $pointId){
		$createMarker = "var image_".$pointId." = '$markerIcon'";
		$createMarker .= '
		var marker_'.$pointId.' = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng('.$lat.', '.$lng.'),
			draggable: false,
			icon: image_'.$pointId.'
			});
		';
		return $createMarker;
	}#end createMarker() function
	
	public function createInfoBubble($lat = '', $lng = '', $html = '', $pointId = '', $level){
		$level = $level[0];

		/**
		 * if the width/heights are empty or set to 0 then default back to the flat file configs
		 */
		if ($level->min_width == '' || $level->min_width == '0'){ $level->min_width = $this->ci->config->item('bubbleMinWidth'); }
		if ($level->max_width == '' || $level->max_width == '0'){ $level->max_width = $this->ci->config->item('bubbleMaxWidth'); }
		if ($level->min_height == '' || $level->min_height == '0'){ $level->min_height = $this->ci->config->item('bubbleMinHeight'); }
		if ($level->max_height == '' || $level->max_height == '0'){ $level->max_height = $this->ci->config->item('bubbleMaxHeight'); }

		$createInfoBubble = "var contentString_".$pointId." = '".$html."';";
		$createInfoBubble .= '
			var infoBubble_'.$pointId.' = new InfoBubble({
			maxWidth: '.$level->max_width.',
			minWidth: '.$level->min_width.',
			minHeight: '.$level->min_height.',
			maxHeight: '.$level->max_height.', 
			});
		';
		$createInfoBubble .= "
			infoBubble_".$pointId.".addTab('".$this->mapConfig->tab_title."', contentString_".$pointId.");
		";
		return $createInfoBubble;
	}#end createInfoBubble() function
	public function createSidebarListener($pointId){
		$createSidebarListener = "
			google.maps.event.addDomListener(document.getElementById('point_".$pointId."'),'click', function(){
				infoBubble_".$pointId.".open();
			});
			";
		return $createSidebarListener;
	}
	public function createListener($pointId){
		$createListener = '
			google.maps.event.addListener(marker_'.$pointId.', \'click\', function() {
	          if (!infoBubble_'.$pointId.'.isOpen()) {
	            infoBubble_'.$pointId.'.open(map, marker_'.$pointId.');
	          }
          	});
		';
		return $createListener;
	}#end createListener() function
	public function CreateMapJs($lat, $lng, $markerIcon, $pointId, $html, $level){
		$map = $this->createMarker($lat, $lng, $markerIcon, $pointId);
		$map .= $this->createInfoBubble($lat, $lng, $html, $pointId, $level);
		$map .= $this->createListener($pointId);
		#$map .= $this->createSidebarListener($pointId);

		return $map;
	}
}#end Map class
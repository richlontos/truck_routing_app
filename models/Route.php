<?php

class Route
{
    public function calculateRoute($start, $end, $truckSize, $loadType)
    {
        $config = include 'config.php';
        $apiKey = $config['google_maps_api_key'];

        // Prepare the API request URL
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . urlencode($start) . "&destination=" . urlencode($end) . "&key=" . $apiKey;

        // Use cURL to make the API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Extract the route data
        if (isset($data['routes'][0])) {
            $route = $data['routes'][0];
            $distance = $route['legs'][0]['distance']['text'];
            $duration = $route['legs'][0]['duration']['text'];

            // Return the route data
            return array(
                "start" => $start,
                "end" => $end,
                "distance" => $distance,
                "duration" => $duration
            );
        } else {
            return array("No route found");
        }
    }
}

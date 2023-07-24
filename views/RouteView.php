<?php

class RouteView
{
    public function displayForm()
    {
        $html = '
            <div class="container">
                <form method="post" action="">
                    <label for="start">Start:</label><br>
                    <input type="text" id="start" name="start"><br>
                    <label for="end">End:</label><br>
                    <input type="text" id="end" name="end"><br>
                    <label for="truckSize">Truck Size:</label><br>
                    <input type="text" id="truckSize" name="truckSize"><br>
                    <label for="loadType">Load Type:</label><br>
                    <input type="text" id="loadType" name="loadType"><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        ';
        return $html;
    }

    public function displayRoute($route)
    {
        $config = include 'config.php';
        $apiKey = $config['google_maps_api_key'];

        $html = '<div class="container"><div class="route">';
        foreach ($route as $instruction) {
            $html .= $instruction . "<br>";
        }
        $html .= '</div>';

        // Extract the start and end points from the route data
        $start = $route["start"];
        $end = $route["end"];
        $distance = $route["distance"];
        $duration = $route["duration"];

        // Add the map container
        $html .= '<div id="map" style="height: 400px; width: 100%;" ';
        $html .= 'data-start="' . $start . '" data-end="' . $end . '" data-api-key="' . $apiKey . '"></div>';
        $html .= '</div>';

        return $html;
    }
}

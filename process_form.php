<?php
// process_form.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$config = include 'config.php';
$apiKey = $config['google_maps_api_key'];

// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $start = $_POST['start'];
    $end = $_POST['end'];
    $truckSize = $_POST['truckSize'];
    $loadType = $_POST['loadType'];

    // Include the necessary files
    include_once 'controllers/RouteController.php';
    include_once 'views/RouteView.php';
    include_once 'models/Route.php';

    // Instantiate the MVC components
    $model = new Route();
    $view = new RouteView();
    $controller = new RouteController($model, $view);

    // Get the route and prepare the response
    $route = $controller->getRoute($start, $end, $truckSize, $loadType);
    $route_html = $view->displayRoute($route);
    $response = array(
        'route_html' => $route_html,
        'api_key' => $apiKey // Replace with your Google Maps API key
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If the form data is not submitted, return an error response
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Form data not submitted'));
    exit(); // Add this line to stop execution here

}

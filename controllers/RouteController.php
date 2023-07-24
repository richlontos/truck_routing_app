<?php

include_once 'models/Route.php';
include_once 'views/RouteView.php';

class RouteController {
    private $model;
    private $view;

    public function __construct() {
        // Initialize the Model and the View
        $this->model = new Route();
        $this->view = new RouteView();
    }

    public function getRoute($start, $end, $truckSize, $loadType) {
        // We get the route from the model
        $route = $this->model->calculateRoute($start, $end, $truckSize, $loadType);
        // Return the route data
        return $route;
    }
    
}

?>

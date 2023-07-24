<!DOCTYPE html>
<html>

<head>
    <title>Truck Routing App</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
    <div id="routeForm">
        <?php
        include_once 'controllers/RouteController.php';
        include_once 'views/RouteView.php';
        include_once 'models/Route.php';

        // Instantiate the MVC components
        $model = new Route();
        $view = new RouteView();
        $controller = new RouteController($model, $view);

        // Display the form
        echo $view->displayForm();
        ?>
    </div>

    <div id="routeResults">
        <!-- Route instructions and map will be displayed here -->
    </div>

    <script src="map.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Function to handle form submission using AJAX
        function submitForm() {
            var form_data = $('#routeForm form').serialize();
            $.ajax({
                type: 'POST',
                url: 'process_form.php',
                data: form_data,
                dataType: 'json', 
                success: function(response) {
                    $('#routeResults').html(response.route_html);
                    var script = document.createElement('script');
                    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + response.api_key + '&callback=initMap';
                    document.body.appendChild(script);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error submitting form');
                }
            });
        }

        // Listen for form submission event
        $('#routeForm form').submit(function(e) {
            e.preventDefault();
            submitForm();
        });
    </script>
</body>
</html>
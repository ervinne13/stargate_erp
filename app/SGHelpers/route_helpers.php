<?php

/**
 * Converts a route to controller name. Ex. sample-route will be converted to
 * SampleRouteController
 * @param type $route
 * @return type
 */
function routeToControllerName($route) {
    $controller = "";

    if (strpos($route, "-") === FALSE) {
        $controller .= ucfirst($route);
    } else {
        $routePieces = explode('-', $route);
        foreach ($routePieces AS $routePiece) {
            $controller .= ucfirst($routePiece);
        }
    }

    return $controller . "Controller";
}

function assignRoutes($routes, $controllerPrefix) {

    foreach ($routes AS $route) {
        $controllerName = routeToControllerName($route);
        Route::get("{$route}/datatable", $controllerPrefix . "\\" . $controllerName . "@datatable");
        Route::resource($route, $controllerPrefix . "\\" . $controllerName);
    }
}

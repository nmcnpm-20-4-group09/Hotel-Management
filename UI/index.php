<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("VIEW_PATH", ROOT . "/views/");
define("COMPONENT_PATH", ROOT . "/components/");
define("TABLE_PATH", COMPONENT_PATH . "/tables/");
define("FORM_PATH", COMPONENT_PATH . "/forms/");

include_once "View.php";

$routes = [];

route("/", function () {
    View::renderView("home");
});

route("/room", function () {
    View::renderView("room");
});

route("/room-booking", function () {
    View::renderView("booking");
});

route("/customer", function () {
    View::renderView("customer");
});

route("/bill", function () {
    View::renderView("bill");
});

route("/report", function () {
    View::renderView("report");
});

route("/form", function () {
    if ($_GET['type'] == 'report') {
        View::renderForm("revenue-report", [
            "month" => $_GET['month'] ?? ""
        ]);
        View::renderForm("room-report", [
            "month" => $_GET['month'] ?? ""
        ]);
    } else {
        View::renderForm($_GET['type']);

        if (isset($_POST['username'])) {
            View::redirect("home");            
        }
    }
});

run();

// Hàm thêm route
function route(string $path, callable $callback)
{
    global $routes;
    $routes[$path] = $callback;
}

// Hàm chạy route dựa trên request uri
function run()
{
    global $routes;

    $uri = $_SERVER['REQUEST_URI'];
    $route = explode('?', $uri)[0];

    if (array_key_exists($route, $routes)) {
        $routes[$route]();
    } else {
        echo "[404] Not found 😔";
    }
}

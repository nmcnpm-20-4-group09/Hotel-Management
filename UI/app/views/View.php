<?php

namespace App\Views;

// ! Move to form view
use App\Components\Forms\SignInForm;
use App\Components\Forms\SignUpForm;
use App\Components\Forms\RevenueReportForm;
use App\Components\Forms\RoomReportForm;

use App\Views\RoomView;


class View
{
    static private $views = [
        "home" => HomeView::class,
        "room" => RoomView::class,
        "booking" => BookingView::class,
        "customer" => CustomerView::class,
        "bill" => BillView::class,
        "report" => ReportView::class,
        "form" => FormView::class
    ];

    static function render($component)
    {
        return $component->render();
    }

    static function renderView($viewName, $props = [])
    {
        // Render the preset
        include_once __DIR__ . "/../components/Preset.php";

        // Render the view
        $view = new View::$views[$viewName]($props);

        echo $view->render();
    }

    // TODO: implement this
    static function redirect($view)
    {
    }
}

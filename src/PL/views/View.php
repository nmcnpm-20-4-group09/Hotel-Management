<?php
namespace Views;

class View
{
    static private $views = [
        "home" => HomeView::class,
        "room" => RoomView::class,
        "booking" => BookingView::class,
        "booking-detail" => BookingDetailView::class,
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
}

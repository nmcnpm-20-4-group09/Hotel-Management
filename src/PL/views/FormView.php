<?php
namespace Views;

use Components\Forms\SignInForm;
use Components\Forms\SignUpForm;
use Components\Forms\RevenueReportForm;
use Components\Forms\RoomReportForm;

class FormView
{
    private $forms = [
        "signin" => SignInForm::class,
        "signup" => SignUpForm::class,
        "revenue-report" => RevenueReportForm::class,
        "room-report" => RoomReportForm::class
    ];

    public function __construct(public $props = [])
    {
        $this->props = $props;
        $this->type = $props["type"];
    }

    public function render()
    {
        $formComponent = new $this->forms[$this->type]($this->props);
        $form = $formComponent->render();

        $view =  <<<EOT
        <body>
            <div class="container">
                $form
            </div>
        </body>
        </html>
        EOT;

        return $view;
    }
}

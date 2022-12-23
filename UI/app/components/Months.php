<?php
namespace App\Components;

class Months extends Component
{
    private function renderMonths()
    {
        $monthElements = '';
        for ($month = 1; $month <= 12; $month++) {
            $monthElements .= <<<EOT
                <a class="month" href="/form?type=report&month=$month">
                    <p>$month</p>
                </a>
            EOT;
        }
        return $monthElements;
    }

    public function render()
    {
        $monthElements = $this->renderMonths();

        return <<<EOT
            <div class="months">
                $monthElements
            </div>
            EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Months.css">

<?php
namespace Components;

class Overview extends Component
{
    public function __construct()
    {
        $this->stats = [
            [
                'image' =>  "./images/icons/total_sales.png",
                'text' => 'Doanh thu',
                'amount' => '100 triệu VNĐ'
            ],
            [
                'image' =>  "./images/icons/expense.png",
                'text' => 'Chi trả',
                'amount' => '50 triệu VNĐ'
            ],
            [
                'image' =>  "./images/icons/revenue.png",
                'text' => 'Lợi nhuận',
                'amount' => '50 triệu VNĐ'
            ],
            [
                'image' =>  "./images/icons/month_sales.png",
                'text' => 'Doanh thu tháng 12',
                'amount' => '100 triệu VNĐ'
            ],
        ];
    }

    private function renderStats()
    {
        $statElements = '';
        $index = 0;

        foreach ($this->stats as $stat) {
            if ($index++ < count($this->stats) - 1) {
                $statElements .= <<<EOT
                <div class="stat">
                    <div class="image-wrapper">
                        <img src="{$stat['image']}" alt="" />
                    </div>
                    <p>{$stat['text']}</p>
                    <b>{$stat['amount']}</b>
                </div>
            EOT;
            } else {
                $statElements .= <<<EOT
                <div class="stat">
                    <div class="image-wrapper">
                        <img src="{$stat['image']}" alt="" />
                    </div>
                    <div>
                        <p>{$stat['text']}</p>
                        <b>{$stat['amount']}</b>
                    </div>
                </div>
            EOT;
            }
        }

        return $statElements;
    }

    public function render()
    {
        $statElements = $this->renderStats();

        return <<< EOT
        <div class="overview">
            <div class="stats">
                <h3>Tổng quan</h3>
                <div>
                    $statElements
                </div>
            </div>
            <div class="banner"></div>
            <div class="banner"></div>
            <div class="overview-banner"></div>
        </div>
        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Overview.css" />


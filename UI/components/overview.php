<?php
require "../components/View.php";

class Overview extends Component
{
    public function __construct()
    {
        $this->stats = [
            [
                'image' => '../assets/icons/total_sales.png',
                'text' => 'Doanh thu',
                'amount' => '100 triệu VNĐ'
            ],
            [
                'image' => '../assets/icons/expense.png',
                'text' => 'Chi trả',
                'amount' => '50 triệu VNĐ'
            ],
            [
                'image' => '../assets/icons/revenue.png',
                'text' => 'Lợi nhuận',
                'amount' => '50 triệu VNĐ'
            ],
        ];
    }

    private function renderStats()
    {
        $statElements = '';
        $count = count($this->stats);

        foreach ($this->stats as $stat) {
            $statElements .= <<<EOT
                <div class="stat">
                    <div class="image-wrapper">
                        <img src="{$stat['image']}" alt="" />
                    </div>
                    <p>{$stat['text']}</p>
                    <b>{$stat['amount']}</b>
                </div>
            EOT;
        }

        return $statElements;
    }
    
    public function render()
    {
        $statElements = $this->renderStats();
        return <<< EOT
        <link rel="stylesheet" href="../css/index.css" />
        <div class="overview">
            <div class="stats">
                <h3>Tổng quan</h3>
                <div>
                    $statElements
                    <div class="stat">
                        <div class="image-wrapper">
                            <img src="../assets/icons/month_sales.png" alt="" />
                        </div>
                        <div>
                            <p>Doanh thu tháng 12</p>
                            <b>100 triệu VNĐ</b>
                        </div>
                    </div>
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
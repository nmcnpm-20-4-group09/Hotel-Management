<?php
require_once("../components/View.php");

class Sidebar extends Component
{
    private $buttons = [
        [
            'link' => './room.php',
            'icon' => 'bed',
            'text' => 'Danh sách phòng'
        ],
        [
            'link' => './customer.php',
            'icon' => 'person',
            'text' => 'Danh sách khách',
        ],
        [
            'link' => './bill.php',
            'icon' => 'receipt',
            'text' => 'Danh sách hóa đơn'
        ],
        [
            'link' => './report.php',
            'icon' => 'chart-simple',
            'text' => 'Báo cáo'
        ]
    ];

    private function renderButtons()
    {
        $buttonElements = '';
        foreach ($this->buttons as $button) {
            $buttonElements .= <<<EOT
                <li>
                    <a href="{$button['link']}">
                        <i class="fa-solid fa-{$button['icon']}"></i>
                        <span>{$button['text']}</span>
                    </a>
                </li>
            EOT;
        }

        return $buttonElements;
    }

    public function render()
    {
        $buttonElements = $this->renderButtons();
        
        return <<<EOT
            <div class="sidebar">
                <a class="home-icon" href="./index.php">
                    <img src="../assets/icons/home.png" alt="Home page" />
                </a>
                <ul class="sidebar-buttons">
                    $buttonElements
                </ul>
            </div>  
            EOT;
    }
}

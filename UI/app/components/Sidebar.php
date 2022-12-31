<?php

namespace App\Components;

class Sidebar extends Component
{
    public function __construct()
    {
        $this->homeIcon = './images/icons/home.png';
        $this->buttons = [
            [
                'link' => './room',
                'icon' => 'bed',
                'text' => 'Danh sách phòng'
            ],
            [
                'link' => './customer',
                'icon' => 'person',
                'text' => 'Danh sách khách',
            ],
            [
                'link' => './bill',
                'icon' => 'receipt',
                'text' => 'Danh sách hóa đơn'
            ],
            [
                'link' => './report',
                'icon' => 'chart-simple',
                'text' => 'Báo cáo theo tháng'
            ]
        ];
    }

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
            <a class="home" href="./">
                <img class="home-icon" src="$this->homeIcon" alt="Home page" />
                <p class="home-text hidden"> Về trang chủ </p>
            </a>
            <ul class="sidebar-buttons">
                $buttonElements
            </ul>
        </div>

        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Sidebar.css">
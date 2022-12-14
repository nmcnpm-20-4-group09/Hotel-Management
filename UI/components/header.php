<?php
require_once("../View.php");

class Header extends Component
{
    private $buttons = [
        [
            'link' => '#',
            'icon' => 'info',
            'text' => 'Thông tin chi tiết'
        ],
        [
            'link' => '#',
            'icon' => 'lock',
            'text' => 'Đổi mật khẩu',
        ],
        [
            'link' => '#',
            'icon' => 'user',
            'text' => 'Chuyển tài khoản'
        ],
        [
            'link' => '#',
            'icon' => 'right-from-bracket',
            'text' => 'Đăng xuất'
        ]
    ];
    private $homeIcon = "../assets/icons/profile.png";

    private function renderButtons()
    {
        $buttonElements = '';
        foreach ($this->buttons as $button) {
            $buttonElements .= <<<EOT
                <li>
                    <a href="{$button['link']}">
                        <i class="fa-solid fa-{$button['icon']}"></i>
                        <p>{$button['text']}</p>
                    </a>
                </li>
            EOT;
        }

        return $buttonElements;
    }

    public function render()
    {
        $buttonElements = $this->renderButtons();
        $homeIcon = $this->homeIcon;

        return <<< EOT
        <header class="header">
        <h1 class="feature-title">Trang chủ</h1>
        <div class="account">
            <span class="account-name">Tên người dùng</span>
            <img class="account-avatar" src="$homeIcon" alt="Profile" />
            <div class="account-expand-icon">
                <i class="fa-solid fa-angle-down"> </i>
                <ul class="account-settings">
                    $buttonElements
                </ul>
            </div>
        </div>
        </header>
        EOT;
    }
}

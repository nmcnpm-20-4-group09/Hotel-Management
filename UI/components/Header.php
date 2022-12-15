<link rel="stylesheet" href="./css/Header.css">

<?php
class Header extends Component
{
    public function __construct($props = ['title' => ""])
    {
        $this->profileIcon = "./assets/icons/profile.png";
        $this->title = $props['title'];
        $this->buttons = [
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
                'link' => '/form?type=signin',
                'icon' => 'user',
                'text' => 'Chuyển tài khoản'
            ],
            [
                'link' => '/form?type=signin',
                'icon' => 'right-from-bracket',
                'text' => 'Đăng xuất'
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

        return <<< EOT
        <header class="header">
        <h1 class="feature-title">$this->title</h1>
        <div class="account">
            <span class="account-name">Tên người dùng</span>
            <img class="account-avatar" src="$this->profileIcon" alt="Profile" />
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

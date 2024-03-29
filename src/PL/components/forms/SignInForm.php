<?php
namespace Components\Forms;
use Components\FormComponent;

class SignInForm extends FormComponent
{
    protected $groups = [
        [
            'id' => 'signin-username',
            'name' => 'username',
            'label' => 'Tên tài khoản',
            'placeholder' => 'Nhập tên tài khoản',
            'type' => 'text',
            'text' => 'Lỗi (nếu có)',
        ],
        [
            'id' => 'signin-password',
            'name' => 'password',
            'label' => 'Mật khẩu',
            'placeholder' => 'Nhập password',
            'type' => 'password',
            'text' => 'Lỗi (nếu có)',
        ]
    ];

    public function render()
    {
        $groupElements = $this->renderGroups();

        return <<< EOT
        <form action="./?action=signin" class="signin-form" method="POST">
            <h2 class="form-title">Đăng nhập</h2>
        
            $groupElements
        
            <div class="form-refs">
                <a href="#" class="forget-password">Quên mật khẩu</a>
                <a href="./form?type=signup" class="signup">Đăng ký</a>
            </div>
        
            <div class="form-buttons">
                <button type="submit" class="form-button">Đăng nhập</button>
            </div>
        </form>
        EOT;
    }
}
?>

<!-- Icon -->
<link rel="icon" type="image/x-icon" href="https://img.icons8.com/fluency/96/null/circled-up-2.png" />
<!-- CSS -->
<link rel="stylesheet" href="./css/Form.css" />

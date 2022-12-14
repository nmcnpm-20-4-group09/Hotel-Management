<!-- Icon -->
<link rel="icon" type="image/x-icon" href="https://img.
icons8.com/fluency/96/null/circled-up-2.png" />

<!-- Style -->
<link rel="stylesheet" href="../css/form.css" />

<?php
require_once("../View.php");

class SignUpForm extends FormComponent
{

    protected $groups = [
        [
            'id' => 'signup-username',
            'name' => 'username',
            'label' => 'Tên tài khoản',
            'placeholder' => 'Nhập tên tài khoản',
            'type' => 'text',
            'text' => 'Lỗi (nếu có)',
        ],
        [
            'id' => 'signup-password',
            'name' => 'password',
            'label' => 'Mật khẩu',
            'placeholder' => 'Nhập password',
            'type' => 'password',
            'text' => 'Lỗi (nếu có)',
            'classes' => ['valid']
        ],
        [
            'id' => 'signup-re-password',
            'name' => 're-password',
            'label' => 'Nhập lại mật khẩu',
            'placeholder' => 'Nhập lại mật khẩu',
            'type' => 'password',
            'text' => 'Lỗi (nếu có)',
            'classes' => ['invalid']
        ],
    ];

    public function render()
    {
        $groupElements = $this->renderGroups();
        return <<< EOT
        <form class="signup-form" method="PUT">
        <h2 class="form-title">Đăng ký</h2>

        $groupElements

        <div class="form-buttons">
            <button type="button" class="form-button back-button">
                <a href="#">Đăng nhập</a>
            </button>
            <button type="submit" class="form-button">Tiếp theo</button>
        </div>
        </form>
        EOT;
    }
}
?>
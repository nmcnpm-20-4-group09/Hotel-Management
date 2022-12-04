<form class="signup-form" method="PUT">
    <h2 class="form-title">Đăng ký</h2>

    <!-- Username -->
    <label for="username" class="form-label">Tên tài khoản</label>
    <input type="text" class="form-control valid" name="username" id="username" placeholder="Nhập tài tên tài khoản" />
    <p class="form-text invisible">Lỗi (nếu có)</p>

    <!-- Password -->
    <label for="password" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control invalid" name="password" id="password" placeholder="Nhập mật khẩu" />
    <p class="form-text invalid">Lỗi (nếu có)</p>

    <!-- Re-enter Password -->
    <label for="re-password" class="form-label">Nhập lại mật khẩu</label>
    <input type="password" class="form-control" name="re-password" id="re-password" placeholder="Nhập lại mật khẩu" />
    <p class="form-text invisible">Lỗi (nếu có)</p>

    <div class="form-buttons">
        <button type="button" class="form-button back-button">
            <a href="./signin.html">Đăng nhập</a>
        </button>
        <button type="submit" class="form-button">Tiếp theo</button>
    </div>
</form>

<!-- Icon -->
<link rel="icon" type="image/x-icon" href="https://img.
icons8.com/fluency/96/null/circled-up-2.png" />

<!-- Style -->
<link rel="stylesheet" href="../css/authen.css" />
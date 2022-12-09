<!-- Icon -->
<link rel="icon" type="image/x-icon" href="https://img.
icons8.com/fluency/96/null/circled-up-2.png" />

<!-- Style -->
<link rel="stylesheet" href="../css/form.css" />

<form class="signin-form hidden" method="PUT">
    <h2 class="form-title">Đăng nhập</h2>

    <!-- Username -->
    <label for="sigin-username" class="form-label">Tên tài khoản</label>
    <input type="text" class="form-control" name="username" id="signin-username" placeholder="Nhập tài tên tài khoản" />
    <p class="form-text invisible">Lỗi (nếu có)</p>

    <!-- Password -->
    <label for="sigin-password" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control" name="password" id="signin-password" placeholder="Nhập mật khẩu" />
    <p class="form-text">Lỗi (nếu có)</p>

    <div class="form-refs">
        <a href="#" class="forget-password">Quên mật khẩu</a>
        <a href="#" class="signup">Đăng ký</a>
    </div>

    <div class="form-buttons">
        <button type="submit" class="form-button">Đăng nhập</button>
    </div>
</form>
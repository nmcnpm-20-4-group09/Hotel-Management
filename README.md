- Môn: Nhập môn Công nghệ Phần mềm 
- Lớp: 20_4
- Nhóm: nhóm 09
- Thành viên:
    - 20120356 - Lê Minh Quân
    - 20120389 - Nguyễn Thị Bích Trâm
    - 20120399 - Đặng Võ Hoàng Kim Tuyền
    - 20120406 - Phạm Quốc Vương
    - 20120408 - Đỗ Tấn Tài

# Hotel Management

## Giới thiệu project
- Tên project: Phần mềm Quản lý Khách sạn trên nền web 
- Kiến trúc: 3 layers

## Cách cấu hình để chạy project
- Cài đặt XAMPP phiên bản 8.0.x (x là số nguyên) do [apachefriends.org](https://www.apachefriends.org/download.html) cung cấp.
- Đảm bảo đã thêm Environment Variables cho php do XAMPP cung cấp. Có thể tham khảo [link này](https://dinocajic.medium.com/add-xampp-php-to-environment-variables-in-windows-10-af20a765b0ce).
- Cài đặt composer theo hướng dẫn tại https://getcomposer.org/download/ và đảm bảo gọi được composer từ terminal/cmd.
- Mở cmd cd đến thư mục **htdocs** của XAMPP:
    - Clone project này về với lệnh **git clone https://github.com/nmcnpm-20-4-group09/Hotel-Management.git**
    - Đổi tên thư mục **Hotel-Management** vừa clone về thành **Hotel_Management**.
- Vào thư mục src/PL và mở terminal tại đường dẫn đó, sau đó:
    - Gọi lệnh **composer install** để cài các gói phụ thuộc;
    - Tiếp tục gọi **composer dump-autoload** để cài đặt autoload.

### Chạy trên localhost:
- Mở XAMPP (mở bằng quyền admin giúp tránh lỗi khi muốn thoát XAMPP) để start module **Apache** và **MySQL**.
- Vào http://localhost/phpmyadmin/ và tạo database với tên hotel_management.
- Lần lượt import các file sau vào database vừa tạo:
    - hotel_management.sql
    - query-v1.sql
    - query-v2.sql
- Bây giờ, ta đã có các các thứ cần thiết để chạy phần mềm.
- Xét http://localhost tương ứng với thư mục htdocs đã nêu, điền link theo dạng sau vào trình duyệt để mở phần mềm:
    - http://localhost/Hotel_Management/src/PL/public/home

### Host web bằng máy cá nhân:
- Đăng kí tài khoản và cài ngrok tại https://ngrok.com/.
- Thực hiện tạo đường hầm kết nối giữa máy cá nhân và internet theo hướng dẫn của ngrok.
- Thực hiện các bước như khi chạy trên localhost (kể cả start các module của XAMPP).
- Ở bước truy cập phần mềm, thay vì nhập http://localhost/Hotel_Management/src/PL/public/home, ta nhập:
    - fordwarding-link-do-ngrok-cung-cấp/Hotel_Management/src/PL/public/home

## Current Status
- Giao diện hoàn chỉnh.
- Một số chức năng chưa hoàn thiện xem tại [link file đánh giá](https://docs.google.com/spreadsheets/d/12x2jVoTfIan2ozjRgwk22vGxmOonJRAv/edit#gid=1861759264)
## Future Work
- Thiết kế cơ sở dữ liệu để lưu tài khoản và mật khẩu.
- Thiết kế thuật toán mã hóa mật khẩu.
- Hoàn thiện chức năng đăng nhập/đăng kí.
- Quản lý phiên đăng nhập.
- Triển khai chức năng gửi mail khôi phục mật khẩu.
- Hoàn thiện các API còn thiếu.
# 💻 TECHMART – Hệ thống thương mại điện tử chuyên ngành công nghệ


📖 **Môn học:** Kỹ thuật Phần mềm

🌐 **Tên dự án:** `TechMart` – Hệ thống thương mại điện tử chuyên ngành công nghệ

👨‍💻 **Nhóm thực hiện:** Nhóm [4] – Lớp [Kĩ thuật phần mềm - N06]

### 👥 **Danh sách thành viên**
<div align="center">

| 🆔 **STT** | 👤 **Họ và Tên**  | 📧 **Email** |
|:-:|:-----------------------|:--------------------------------------------------------------------------|
| 1 | **Lê Mạnh Hùng**       | [23010123@st.phenikaa-uni.edu.vn](mailto:23010123@st.phenikaa-uni.edu.vn) |
| 2 | **Lê Quốc Trình**      | [23010149@st.phenikaa-uni.edu.vn](mailto:23010149@st.phenikaa-uni.edu.vn) |
| 3 | **Nguyễn Văn Mạnh**    | [23010599@st.phenikaa-uni.edu.vn](mailto:23010599@st.phenikaa-uni.edu.vn) |
| 4 | **Nguyễn Kiêm Mạnh**   | [23010909@st.phenikaa-uni.edu.vn](mailto:23010909@st.phenikaa-uni.edu.vn) |

</div>

# 📝 KẾ HOẠCH DỰ ÁN – TECHMART

## 1. 🎯 Mục tiêu dự án

- **Xây dựng một hệ thống thương mại điện tử cho phép người dùng:**

	- *Xem và tìm kiếm các sản phẩm công nghệ.*
	- *Thêm sản phẩm vào giỏ hàng, thanh toán đơn hàng.*
	- *Quản lý tài khoản cá nhân (đăng ký, đăng nhập).*
   
- **Cho phép quản trị viên:**
  
	- *Quản lý danh mục sản phẩm, đơn hàng và người dùng.*
  	- *Hướng đến một giao diện thân thiện, hiện đại và dễ sử dụng.*

## 2. 📦 Phạm vi dự án
### Chức năng chính:
- ✅ **Người dùng:**

	- *Đăng ký, đăng nhập.*
	- *Tìm kiếm, lọc và xem chi tiết sản phẩm.*
	- *Thêm sản phẩm vào giỏ hàng, đặt hàng, thanh toán.*
	- *Xem lịch sử mua hàng.*

- ✅ **Quản trị viên:**

	- *Thêm/xóa/sửa sản phẩm.*
	- *Quản lý danh mục sản phẩm.*
	- *Xem đơn hàng và trạng thái thanh toán.*
	- *Quản lý tài khoản người dùng.*

### Công nghệ sử dụng:

- ***Frontend:** 🌐`HTML`, 🎨`CSS`, ⚙️`JavaScript`, 💠`Bootstrap`.*
- ***Backend:** 🐘🔴`PHP/Laravel`.*
- ***Cơ sở dữ liệu:** 🐬`MySQL`.*
- ***Công cụ quản lý mã nguồn:** 🐙`GitHub`.*


## 3. 🗓️ Tiến độ dự án (Dự kiến)
## 4. 👨‍💻 Phân công công việc
## 5. 🧪 Chiến lược kiểm thử

- Kiểm thử đơn vị (Unit test): Kiểm tra các chức năng nhỏ riêng biệt.
- Kiểm thử tích hợp (Integration test): Kiểm tra tương tác giữa các module.
- Kiểm thử hệ thống (System test): Kiểm tra toàn bộ hệ thống.
- Kiểm thử chấp nhận (User Acceptance Test): Kiểm tra theo tình huống người dùng.

# 📄 SRS (Software Requirements Specification) – Phân tích yêu cầu và đặc tả

## 1. 💡 Giới thiệu
### 1.1 Mục đích
Tài liệu này mô tả chi tiết các yêu cầu chức năng và phi chức năng của hệ thống TechMart – một website thương mại điện tử chuyên bán các sản phẩm công nghệ như laptop, điện thoại, phụ kiện,... Mục tiêu là xây dựng hệ thống hỗ trợ mua bán trực tuyến, quản lý sản phẩm và đơn hàng hiệu quả.

### 1.2 Phạm vi hệ thống
Người dùng có thể xem sản phẩm, tìm kiếm, đặt hàng, thanh toán và theo dõi đơn hàng.

Quản trị viên có thể thêm, sửa, xóa sản phẩm và quản lý đơn hàng.

Hệ thống bao gồm các chức năng: đăng ký, đăng nhập, giỏ hàng, đặt hàng, thống kê.

### 1.3 Đối tượng đọc
Giảng viên/giáo vụ

Các thành viên trong nhóm phát triển

Bên kiểm thử (tester)

### 1.4 Phạm vi sản phẩm
Hệ thống sẽ được triển khai dưới dạng một web app. Giao diện trực quan, dễ dùng, tương thích với các trình duyệt phổ biến.

## 2. 📚 Mô tả tổng quan
### 2.1 Giả định và phụ thuộc
Người dùng có kết nối internet và sử dụng trình duyệt hiện đại.

Dữ liệu sẽ được lưu trữ bằng MySQL.

Hệ thống chỉ hoạt động với tài khoản đã đăng ký.

### 2.2 Hạn chế
Hệ thống không hỗ trợ thanh toán online thực tế (mô phỏng).

Không hỗ trợ phiên bản di động (mobile app).

## 3. 🧩 Chức năng hệ thống
### 3.1 Đối với Người dùng
#### UC01 – Đăng ký tài khoản
Nhập thông tin cá nhân: tên, email, mật khẩu.

Kiểm tra tính hợp lệ và lưu thông tin vào hệ thống.

#### UC02 – Đăng nhập / Đăng xuất
Cho phép người dùng truy cập bằng tài khoản đã đăng ký.

#### UC03 – Tìm kiếm & xem sản phẩm
Tìm kiếm theo tên, loại, mức giá.

Xem chi tiết sản phẩm (mô tả, hình ảnh, giá, đánh giá).

#### UC04 – Quản lý giỏ hàng
Thêm, sửa, xóa sản phẩm trong giỏ.

Tính tổng tiền tự động.

#### UC05 – Đặt hàng
Xác nhận đơn hàng từ giỏ hàng.

Lưu đơn hàng vào hệ thống.

#### UC06 – Xem lịch sử đơn hàng
Người dùng có thể xem lại các đơn hàng đã đặt.

### 3.2 Đối với Quản trị viên
#### UC07 – Quản lý sản phẩm
Thêm/sửa/xoá sản phẩm.

Nhập thông tin: tên, mô tả, giá, hình ảnh, số lượng, loại sản phẩm.

#### UC08 – Quản lý danh mục
Thêm/sửa/xoá các loại sản phẩm (laptop, điện thoại...).

#### UC09 – Quản lý người dùng
Xem danh sách người dùng, khoá/mở tài khoản.

#### UC10 – Quản lý đơn hàng
Xem danh sách đơn hàng.

Cập nhật trạng thái đơn hàng (chờ xác nhận, đã giao...).

## 4. 🧪 Yêu cầu phi chức năng

| Tên yêu cầu          | Mô tả                                                                                          |
| -------------------- | ---------------------------------------------------------------------------------------------- |
| Bảo mật              | Mật khẩu được mã hóa trước khi lưu trữ. Chỉ người có quyền mới được truy cập khu vực quản trị. |
| Hiệu năng            | Hệ thống xử lý tìm kiếm và đặt hàng trong vòng < 3 giây.                                       |
| Khả năng mở rộng     | Có thể mở rộng để thêm tính năng thanh toán online, đánh giá sản phẩm.                         |
| Giao diện người dùng | Giao diện thân thiện, dễ sử dụng cho người không chuyên.                                       |
| Tương thích          | Hoạt động tốt trên Chrome, Firefox, Edge.                                                      |

## 5. 🧠 Mô hình và sơ đồ (tóm tắt)
### Sơ đồ Use Case

### Sơ đồ ERD

### Sơ đồ luồng dữ liệu (DFD)

# 🏗️ THIẾT KẾ CHƯƠNG TRÌNH

## 1. Kiến trúc hệ thống (Architecture)
### 1.1 Mô hình kiến trúc: MVC (Model – View – Controller)
Model: Xử lý dữ liệu và tương tác với CSDL (MySQL).

View: Giao diện người dùng (HTML, CSS, JavaScript).

Controller: Xử lý logic, điều hướng yêu cầu giữa Model và View (Laravel/PHP hoặc bất kỳ framework nào nhóm chọn).

### 1.2 Mô hình triển khai (Deployment)
Client (browser): Truy cập giao diện website.

Web Server (Laravel/PHP): Xử lý logic và điều phối request.

Database Server (MySQL): Lưu trữ dữ liệu sản phẩm, người dùng, đơn hàng, v.v.

## 2. Thiết kế chức năng
### 2.1 Chức năng Người dùng

| STT | Tên chức năng         | Mô tả                                                           |
| :-: | --------------------- | --------------------------------------------------------------- |
| 1   | Đăng ký/Đăng nhập     | Cho phép người dùng tạo tài khoản và đăng nhập                  |
| 2   | Xem sản phẩm          | Hiển thị danh sách sản phẩm theo danh mục hoặc từ khóa tìm kiếm |
| 3   | Xem chi tiết sản phẩm | Hiển thị thông tin chi tiết sản phẩm đã chọn                    |
| 4   | Thêm vào giỏ hàng     | Lưu sản phẩm vào giỏ hàng của người dùng                        |
| 5   | Thanh toán/Đặt hàng   | Tạo đơn hàng mới từ các sản phẩm trong giỏ hàng                 |
| 6   | Xem lịch sử đơn hàng  | Người dùng có thể xem lại các đơn hàng đã mua                   |

### 2.2 Chức năng Quản trị viên

| STT | Tên chức năng        | Mô tả                                                      |
| :-: | -------------------- | ---------------------------------------------------------- |
| 1   | Quản lý sản phẩm     | Thêm, sửa, xóa sản phẩm (tên, giá, ảnh, mô tả, tồn kho...) |
| 2   | Quản lý danh mục     | Thêm, sửa, xóa danh mục sản phẩm                           |
| 3   | Quản lý đơn hàng     | Xem danh sách đơn hàng, cập nhật trạng thái đơn hàng       |
| 4   | Quản lý người dùng   | Quản lý tài khoản người dùng, khóa hoặc cấp quyền (nếu có) |
| 5   | Xem báo cáo thống kê | Thống kê doanh thu, đơn hàng theo ngày/tháng               |

## 3. Thiết kế dữ liệu và CSDL
### 3.1 Mô hình ERD (Entity Relationship Diagram) – Tóm tắt các bảng chính:

| Tên bảng         | Mô tả                                                            |
| ---------------- | ---------------------------------------------------------------- |
| **users**        | Lưu thông tin người dùng (tên, email, mật khẩu, vai trò...)      |
| **products**     | Lưu thông tin sản phẩm (tên, mô tả, giá, hình ảnh, tồn kho...)   |
| **categories**   | Lưu danh mục sản phẩm (tên, mô tả)                               |
| **orders**       | Lưu thông tin đơn hàng (user\_id, thời gian đặt, tổng tiền...)   |
| **order\_items** | Chi tiết đơn hàng: mỗi dòng là 1 sản phẩm trong đơn hàng         |
| **cart\_items**  | Sản phẩm người dùng đã thêm vào giỏ hàng (nếu dùng giỏ tạm thời) |

### 3.2 Chi tiết các bảng

#### Bảng `users`
| Tên cột     | Kiểu dữ liệu      | Mô tả           |
| ----------- | ----------------- | --------------- |
| id          | INT (PK)          | Mã người dùng   |
| name        | VARCHAR(100)      | Tên             |
| email       | VARCHAR(100)      | Email           |
| password    | VARCHAR(255)      | Mật khẩu (hash) |
| role        | ENUM(User, Admin) | Vai trò         |
| created\_at | DATETIME          | Ngày tạo        |

#### Bảng `products`
| Tên cột      | Kiểu dữ liệu  | Mô tả                          |
| ------------ | ------------- | ------------------------------ |
| id           | INT (PK)      | Mã sản phẩm                    |
| name         | VARCHAR(100)  | Tên sản phẩm                   |
| price        | DECIMAL(10,2) | Giá bán                        |
| description  | TEXT          | Mô tả                          |
| image        | VARCHAR(255)  | Link ảnh                       |
| category\_id | INT (FK)      | Liên kết với bảng `categories` |
| quantity     | INT           | Số lượng tồn kho               |



#### Bảng `categories`
| Tên cột | Kiểu dữ liệu | Mô tả        |
| ------- | ------------ | ------------ |
| id      | INT (PK)     | Mã danh mục  |
| name    | VARCHAR(100) | Tên danh mục |

#### Bảng `orders`
| Tên cột      | Kiểu dữ liệu                                            | Mô tả                  |
| ------------ | ------------------------------------------------------- | ---------------------- |
| id           | INT (PK)                                                | Mã đơn hàng            |
| user\_id     | INT (FK)                                                | Người đặt đơn          |
| total\_price | DECIMAL(10,2)                                           | Tổng tiền              |
| status       | ENUM(Pending, Confirmed, Shipped, Delivered, Cancelled) | Trạng thái đơn hàng    |
| created\_at  | DATETIME                                                | Thời gian tạo đơn hàng |


#### Bảng `order_items`
| Tên cột     | Kiểu dữ liệu  | Mô tả                      |
| ----------- | ------------- | -------------------------- |
| id          | INT (PK)      | ID                         |
| order\_id   | INT (FK)      | Liên kết đến đơn hàng      |
| product\_id | INT (FK)      | Liên kết đến sản phẩm      |
| quantity    | INT           | Số lượng                   |
| unit\_price | DECIMAL(10,2) | Giá tại thời điểm đặt hàng |

### 3.3 Mối quan hệ giữa các bảng
- `users` –< `orders` –< `order_items` >– `products`

- `products` >– `categories`

- `users` –< `cart_items` >– `products`



























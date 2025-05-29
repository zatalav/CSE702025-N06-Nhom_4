//Đăng ký

// function signup() {
//   const name = document.getElementById("register-name")?.value.trim();
//   const phone = document.getElementById("register-phone")?.value.trim();
//   const email = document.getElementById("register-email")?.value.trim();
//   const pass = document.getElementById("register-pass")?.value;
//   const repass = document.getElementById("register-repass")?.value;

//   if (!name || !phone || !pass || !repass) {
//     return alert("Vui lòng nhập đầy đủ thông tin bắt buộc.");
//   }
//   if (pass !== repass) {
//     return alert("Mật khẩu không khớp.");
//   }

//   const users = JSON.parse(localStorage.getItem("users")) || [];

//   // Kiểm tra trùng số điện thoại
//   if (users.find((u) => u.phone === phone)) {
//     return alert("Số điện thoại đã được đăng ký!");
//   }

//   const user = { name, phone, email, pass };
//   users.push(user);
//   localStorage.setItem("users", JSON.stringify(users));

//   alert("Đăng ký thành công!");
//   showLogin();
// }

async function signup() {
  const name = document.getElementById("register-name")?.value.trim();
  const phone = document.getElementById("register-phone")?.value.trim();
  const email = document.getElementById("register-email")?.value.trim();
  const pass = document.getElementById("register-pass")?.value;
  const repass = document.getElementById("register-repass")?.value;

  if (!name || !phone || !pass || !repass) return alert("Nhập đủ thông tin!");
  if (pass !== repass) return alert("Mật khẩu không khớp!");

  const newUser = { name, phone, email, pass, role: "user" };

  try {
    const res = await fetch("http://localhost:3000/register", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(newUser),
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.error);
    alert("Đăng ký thành công!");
    showLogin();
  } catch (err) {
    alert(err.message);
  }
}
//Đăng nhập

async function login() {
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value;

  try {
    const res = await fetch("users.json");
    const users = await res.json();

    const user = users.find(
      (u) =>
        (u.phone === username || u.email === username) && u.pass === password
    );

    if (user) {
      localStorage.setItem("currentUser", JSON.stringify(user));
      alert(`Đăng nhập thành công! Xin chào, ${user.name}`);
      const loginActions = document.getElementById("user-actions");
      loginActions.innerHTML = `
        <div class="user-menu">
          Xin chào, ${user.name}
          <div class="dropdown">
            <button onclick="logout()">Đăng xuất</button>
          </div>
        </div>
      `;
      closeModal();

      if (user.role === "admin") {
        window.location.href = "admin.html";
      }
      //
    } else {
      alert("Sai thông tin đăng nhập!");
    }
  } catch (err) {
    console.error("Lỗi khi đọc users.json:", err);
    alert("Không thể đăng nhập. Lỗi đọc dữ liệu.");
  }
}
// đăng xuất
function logout() {
  localStorage.removeItem("currentUser");
  location.reload();
}

// Chuyển form
function showRegister() {
  document.getElementById("login-form").style.display = "none";
  document.getElementById("register-form").style.display = "block";
}
function showLogin() {
  document.getElementById("register-form").style.display = "none";
  document.getElementById("login-form").style.display = "block";
}
function closeModal() {
  document.getElementById("login-modal").style.display = "none";
}
// Đóng modal khi click ra ngoài
document.addEventListener("click", (e) => {
  const modal = document.getElementById("login-modal");
  if (e.target === modal) {
    modal.style.display = "none";
  }
});

//Đọc sản phẩm từ json
let products = [];

fetch("./pro.json")
  .then((response) => response.json())
  .then((data) => {
    products = data;
    renderProducts("iphone", "iphone-grid");
    renderProducts("mac", "mac-grid");
    renderProducts("samsung", "samsung-grid");
    renderProducts("phukien", "phukien-grid");

    renderCart();
  })
  .catch((error) => {
    console.error("Lỗi khi tải dữ liệu sản phẩm:", error);
  });
// Hàm render sản phẩm theo category
function renderProducts(category, containerId) {
  const container = document.getElementById(containerId);
  container.innerHTML = ""; // Xóa cũ

  const filtered = products.filter((p) => p.category === category);
  filtered.forEach((p) => {
    const div = document.createElement("div");
    div.className = "product-item";
    div.setAttribute("data-id", p.id);
    div.innerHTML = `
        <img src="${p.image}" alt="${p.name}" />
        <h3 class="product-name">${p.name}</h3>
        <p>${p.price.toLocaleString("vi-VN")} VND</p>
        <button class="btn-buy">Mua hàng</button>
      `;
    container.appendChild(div);
  });
}

// Render cả 2 loại
renderProducts("iphone", "iphone-grid");
renderProducts("mac", "mac-grid");
renderProducts("samsung", "samsung-grid");
renderProducts("phukien", "phukien-grid");

// Modal elements
const modal = document.getElementById("product-modal");
const modalName = document.getElementById("modal-name");
const modalImg = document.getElementById("modal-img");
const modalPrice = document.getElementById("modal-price");
const modalDescription = document.getElementById("modal-description");
const modalBuyBtn = document.getElementById("modal-buy");
const modalCloseBtn = document.getElementById("modal-close");

// Giỏ hàng DOM
const cartItemsContainer = document.getElementById("cart-items");
const cartTotalContainer = document.getElementById("cart-total");

// Giỏ hàng (lưu localStorage)
function getCart() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}
function saveCart(cart) {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function renderCart() {
  let cart = getCart();
  if (cart.length === 0) {
    cartItemsContainer.textContent = "Chưa có sản phẩm nào.";
    cartTotalContainer.textContent = "";
    return;
  }
  cartItemsContainer.innerHTML = "";
  let total = 0;

  //Hiện + Thêm + Sửa + Xoá

  cart.forEach((item) => {
    const div = document.createElement("div");
    div.className = "cart-item";
    div.innerHTML = `
    <span>${item.name}</span>
    <span>Số lượng: <input type="number" min="1" value="${
      item.quantity
    }" data-id="${item.id}" class="qty-input" style="width:50px;"></span>
    <span>${(item.price * item.quantity).toLocaleString("vi-VN")} VND</span>
    <button data-id="${item.id}" class="btn-delete">Xoá</button>
  `;

    cartItemsContainer.appendChild(div);
  });

  //

  cartTotalContainer.textContent = `Tổng tiền: ${total.toLocaleString(
    "vi-VN"
  )} VND`;

  //Thanh toán

  if (cart.length > 0) {
    const checkoutBtn = document.createElement("button");
    checkoutBtn.textContent = "Thanh toán";
    checkoutBtn.className = "btn-buy";
    checkoutBtn.onclick = () => {
      alert("Cảm ơn bạn đã mua hàng!");
      localStorage.removeItem("cart");
      renderCart();
    };
    cartItemsContainer.appendChild(checkoutBtn);
  }
}

//Lắng nghe sự kiện

document.body.addEventListener("input", (e) => {
  if (e.target.matches(".qty-input")) {
    const id = parseInt(e.target.getAttribute("data-id"));
    const cart = getCart();
    const index = cart.findIndex((item) => item.id === id);
    if (index !== -1) {
      cart[index].quantity = parseInt(e.target.value);
      saveCart(cart);
      renderCart();
    }
  }
});

document.body.addEventListener("click", (e) => {
  if (e.target.matches(".btn-delete")) {
    const id = parseInt(e.target.getAttribute("data-id"));
    let cart = getCart();
    cart = cart.filter((item) => item.id !== id);
    saveCart(cart);
    renderCart();
  }
});

// Thêm sản phẩm vào giỏ
function addToCart(productId) {
  let cart = getCart();
  const index = cart.findIndex((item) => item.id === productId);
  if (index > -1) {
    cart[index].quantity += 1;
  } else {
    const product = products.find((p) => p.id === productId);
    cart.push({ ...product, quantity: 1 });
  }
  saveCart(cart);
  renderCart();
}

// Mở modal với thông tin sản phẩm
function openModal(productId) {
  const product = products.find((p) => p.id === productId);
  if (!product) return;
  modalName.textContent = product.name;
  modalImg.src = product.image;
  modalPrice.textContent = `Giá: ${product.price.toLocaleString("vi-VN")} VND`;
  modalDescription.textContent = product.description;
  modal.style.display = "flex";

  modalBuyBtn.onclick = () => {
    addToCart(productId);
    modal.style.display = "none";
    alert("Đã thêm vào giỏ hàng!");
  };
}

// Đóng modal
modalCloseBtn.onclick = () => {
  modal.style.display = "none";
};
// Click ra ngoài modal-content cũng đóng modal
modal.onclick = (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
};

// Bắt sự kiện bấm vào ảnh và tên để mở modal
document.body.addEventListener("click", (e) => {
  if (
    e.target.matches(".product-item img") ||
    e.target.matches(".product-item .product-name")
  ) {
    const productId = parseInt(
      e.target.closest(".product-item").getAttribute("data-id")
    );
    // openModal(productId);
    window.location.href = `product.html?id=${productId}`;
  }
  if (e.target.matches(".product-item .btn-buy")) {
    const productId = parseInt(
      e.target.closest(".product-item").getAttribute("data-id")
    );
    addToCart(productId);
    alert("Đã thêm vào giỏ hàng!");
  }
});

// Khởi tạo render giỏ hàng
renderCart();

function toggleLogin() {
  const modal = document.getElementById("login-modal");
  modal.classList.add("show");
}
function closeModal() {
  const modal = document.getElementById("login-modal");
  modal.classList.remove("show");
}

// Đóng modal đăng nhập khi click ra ngoài
document.body.addEventListener("click", (e) => {
  const modal = document.getElementById("login-modal");
  if (e.target === modal) {
    modal.style.display = "none";
  }
});

function toggleCart() {
  window.location.href = "cart.html";
}
function openAuthModal() {
  const modal = document.getElementById("login-modal");
  modal.classList.add("show");
}
function closeModal() {
  const modal = document.getElementById("login-modal");
  modal.classList.remove("show");
}

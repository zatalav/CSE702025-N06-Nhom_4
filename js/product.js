let products = JSON.parse(localStorage.getItem("products"));
if (!products || products.length === 0) {
  localStorage.setItem("products", JSON.stringify(defaultProducts));
  products = defaultProducts;
}

// Lấy ID sản phẩm từ URL
const urlParams = new URLSearchParams(window.location.search);
const productId = parseInt(urlParams.get("id"));
const product = products.find((p) => p.id === productId);

const detailDiv = document.getElementById("product-detail");

if (!product) {
  detailDiv.textContent = "Không tìm thấy sản phẩm.";
} else {
  detailDiv.innerHTML = `
        <img src="${product.image}" alt="${product.name}">
        <div class="product-info">
          <h2>${product.name}</h2>
          <p><strong>Giá:</strong> ${product.price.toLocaleString(
            "vi-VN"
          )} VND</p>
          <p><strong>Mô tả:</strong> ${product.description}</p>
          <button class="btn-buy" onclick="addToCart(${
            product.id
          })">Thêm vào giỏ hàng</button>
        </div>
      `;
}

function getCart() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}

function saveCart(cart) {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function addToCart(id) {
  const cart = getCart();
  const index = cart.findIndex((item) => item.id === id);
  if (index > -1) {
    cart[index].quantity += 1;
  } else {
    cart.push({ ...product, quantity: 1 });
  }
  saveCart(cart);
  alert("Đã thêm vào giỏ hàng!");
}

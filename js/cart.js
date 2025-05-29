async function loadProducts() {
  const response = await fetch("./pro.json");
  const data = await response.json();
  localStorage.setItem("products", JSON.stringify(data));
}

async function init() {
  if (!localStorage.getItem("products")) {
    await loadProducts();
  }
  renderCart();
}

function getCart() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}

function saveCart(cart) {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function renderCart() {
  const cartItemsContainer = document.getElementById("cart-items");
  const cartTotalContainer = document.getElementById("cart-total");
  const cart = getCart();

  if (cart.length === 0) {
    cartItemsContainer.textContent = "Chưa có sản phẩm nào.";
    cartTotalContainer.textContent = "";
    return;
  }

  let total = 0;
  cartItemsContainer.innerHTML = "";

  cart.forEach((item) => {
    const div = document.createElement("div");
    div.className = "cart-item";
    total += item.price * item.quantity;
    div.innerHTML = `
        <span>${item.name}</span>
        <span>Số lượng: <input type="number" min="1" value="${
          item.quantity
        }" data-id="${item.id}" class="qty-input" style="width:50px;"></span>
        <span>${(item.price * item.quantity).toLocaleString("vi-VN")} VND</span>
        <button data-id="${item.id}" class="btn-delete">Xoá</button>
      `;
    cartItemsContainer.appendChild(div);
    div.querySelector(".btn-delete").addEventListener("click", () => {
      const updatedCart = getCart().filter(p => p.id !== item.id);
      saveCart(updatedCart);
      renderCart();
    });
  });

  //Sự kiện thay đổi số lượng
  document.querySelectorAll(".qty-input").forEach((input) => {
    input.addEventListener("change", (e) => {
      const id = parseInt(e.target.dataset.id);
      const newQty = parseInt(e.target.value);
      const cart = getCart();
      const index = cart.findIndex((item) => item.id === id);
      if (index !== -1) {
        cart[index].quantity = newQty > 0 ? newQty : 1;
        saveCart(cart);
        renderCart(); // cập nhật lại giao diện và tổng tiền
      }
    });
  });

  cartTotalContainer.textContent = `Tổng tiền: ${total.toLocaleString(
    "vi-VN"
  )} VND`;

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

init();

const express = require("express");
const fs = require("fs");
const cors = require("cors");
const app = express();

app.use(cors());
app.use(express.json());

// Ghi thêm user vào users.json
app.post("/register", (req, res) => {
  const newUser = req.body;
  const users = JSON.parse(fs.readFileSync("users.json", "utf-8"));

  const exists = users.some((u) => u.phone === newUser.phone);
  if (exists)
    return res.status(400).json({ error: "Số điện thoại đã được đăng ký!" });

  users.push(newUser);
  fs.writeFileSync("users.json", JSON.stringify(users, null, 2));
  res.json({ message: "Đăng ký thành công!" });
});

// Đọc danh sách user
app.get("/users", (req, res) => {
  const users = JSON.parse(fs.readFileSync("users.json", "utf-8"));
  res.json(users);
});

app.listen(3000, () => {
  console.log("Server đang chạy tại http://localhost:3000");
});

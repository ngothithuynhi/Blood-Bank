import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ position: "top-right" });

export default function (to, from, next) {
  const token = localStorage.getItem("auth_token");
  console.log("Token đang check:", localStorage.getItem("auth_token"));

  if (!token) {
    toaster.error("Bạn cần đăng nhập");
    return next("/dang-nhap");
  }

  axios
    .get("http://127.0.0.1:8000/api/check-token", {
      headers: { Authorization: "Bearer " + token },

    })

    .then((res) => {
      if (res.data.status) {
        // Cập nhật user mới nhất
        // if (res.data.user) {
        //   localStorage.setItem("auth_user", JSON.stringify(res.data.user));

        // }

        // Phân quyền route
        const role = res.data.user.id_chuc_vu;
        const path = to.path;

        // id_chuc_vu: 1 = Admin, 2 = Staff, 3 = Customer
        if ((role === 1 || role === 2) && path.startsWith("/admin")) {
          next();
        } else if (role == 3 && path.startsWith("/")) {
          next();
        } else {
          toaster.error("Bạn không có quyền truy cập trang này");
          localStorage.removeItem("auth_token");
          localStorage.removeItem("auth_user");
          next("/dang-nhap");
        }
      } else {
        toaster.error("Phiên đăng nhập đã hết hạn");
        localStorage.removeItem("auth_token");
        localStorage.removeItem("auth_user");
        next("/dang-nhap");
      }
    })
    .catch((err) => {
      toaster.error("Lỗi kiểm tra phiên đăng nhập");
      localStorage.removeItem("auth_token");
      localStorage.removeItem("auth_user");
      next("/dang-nhap");
    });
}

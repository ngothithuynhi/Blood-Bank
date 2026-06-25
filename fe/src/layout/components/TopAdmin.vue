<template>
    <div class="topbar d-flex align-items-center" >
        <nav class="navbar navbar-expand" style="justify-content: space-between;">

            <!-- Logo -->
            <div class="topbar-logo-header">
                <img src="../../assets/images/anh/logoNHTravel.jpg" class="logo-icon" alt="logo icon"
                    style="width: 60px; height: 40px;">
                <h4 class="logo-text" style="font-size: 2.1rem;"><b><i>TravelGo</i></b></h4>
            </div>

            <!-- Mobile toggle -->
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>

            <!-- User Box -->
            <div class="user-box dropdown" style="margin-right: 2cm;">
                <!-- Nếu admin đã login -->
                <template v-if="isAdmin">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img :src="user.avatar ?? defaultAvatar" class="user-img" alt="avatar">
                        <div class="user-info ps-3">
                            <p class="user-name mb-0"><b>{{ user.ho_ten }}</b></p>
                            <p class="designattion mb-0">Admin</p>
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <router-link to="/">
                            <li><a class="dropdown-item"><i class="bx bx-user"></i> Profile</a></li>
                        </router-link>
                        <li>
                            <a class="dropdown-item" href="javascript:;" @click="dangXuat">
                                <i class='bx bx-log-out-circle'></i> Logout
                            </a>
                        </li>
                    </ul>
                </template>

                <!-- Nếu chưa login hoặc không phải admin -->
                <template v-else>
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#">
                        <i class='bx bx-user' style="font-size: 31px; color: #000"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <router-link to="/dang-nhap">
                            <li><a class="dropdown-item">Đăng nhập</a></li>
                        </router-link>
                    </ul>
                </template>
            </div>
        </nav>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: null,
            defaultAvatar: "https://cdn-icons-png.flaticon.com/512/9187/9187604.png"
        };
    },
    computed: {
        isAdmin() {
            return this.user && this.user.id_chuc_vu === 1;
        }
    },
    mounted() {
        this.checkLogin();
    },
    methods: {
        checkLogin() {
            const token = localStorage.getItem("auth_token");
            if (!token) return;

            axios.get("http://127.0.0.1:8000/api/check-token", {
                headers: { Authorization: "Bearer " + token }
            }).then(res => {
                if (res.data.status) {
                    this.user = res.data.user;
                    localStorage.setItem("auth_user", JSON.stringify(this.user));
                } else {
                    this.user = null;
                    localStorage.removeItem("auth_token");
                    localStorage.removeItem("auth_user");
                }
            }).catch(() => {
                this.user = null;
                localStorage.removeItem("auth_token");
                localStorage.removeItem("auth_user");
            });
        },

        dangXuat() {
            const token = localStorage.getItem("auth_token");
            if (!token) return;

            axios.post("http://127.0.0.1:8000/api/dang-xuat", {}, {
                headers: { Authorization: "Bearer " + token }
            }).finally(() => {
                localStorage.removeItem("auth_token");
                localStorage.removeItem("auth_user");
                this.user = null;
                this.$router.replace("/");
            });
        }
    }
};
</script>

<style scoped>
.user-img {
    height: 35px;
    width: 35px;
    border-radius: 50%;
    object-fit: cover;
}
.topbar {
  position: fixed;       /* ✅ Dùng fixed thay cho sticky */
  top: 0;
  left: 0;
  right: 0;
  height: 70px;
  background: #fff;
  z-index: 999;           /* ✅ Đảm bảo nằm trên sidebar và các phần khác */
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}


</style>

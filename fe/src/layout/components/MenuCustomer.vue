<template>
    <header>
        <!-- Navbar sử dụng Gradient và Shadow mạnh -->
        <nav class="navbar navbar-expand-lg bd-navbar sticky-top shadow-xl" 
             style="background-image: linear-gradient(to right, #004080, #0056b3); border-bottom: 2px solid #ffc107; transition: background 0.3s;">
            <div class="container">

                <!-- Logo (Thêm glow nhẹ) -->
                <router-link to="/" class="navbar-brand fs-4 fw-bolder" 
                    style="color: #fff; text-shadow: 0 0 5px #ffc107, 0 0 10px #ffc107; transition: text-shadow 0.3s;"
                    onmouseover="this.style.textShadow='0 0 8px #fff, 0 0 15px #fff'"
                    onmouseout="this.style.textShadow='0 0 5px #ffc107, 0 0 10px #ffc107'">
                    <img src="../../assets/images/homecustomer/logo.png" class="logo-icon" alt="logo icon"
                        style="width: 60px; height: 50px;">
                    Travel<span style="color: #ffc107; font-style: italic;">Go</span>
                </router-link>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent1">
                    <i class="fa-solid fa-bars" style="color: #ffc107;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent1">

                    <!-- MENU LINKS (Căn giữa) -->
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <!-- Lặp qua các link không phải dropdown (Trang Chủ, Giới Thiệu, Bài Viết, Faqs, Liên Hệ) -->
                        <li class="nav-item" v-for="link in navigationLinks.filter(l => !l.children)" :key="link.path">
                            <router-link :to="link.path" class="nav-link text-white fw-bold me-2 position-relative"
                                style="font-size: 0.95rem; transition: all 0.2s; border-bottom: 2px solid transparent; padding-bottom: 0.25rem;"
                                onmouseover="this.style.color='#ffc107'; this.style.borderBottomColor='#ffc107'"
                                onmouseout="this.style.color='white'; this.style.borderBottomColor='transparent'">
                                <i :class="link.icon" class="me-1"></i> {{ link.label }}
                            </router-link>
                        </li>

                        <!-- Dropdown TOUR DU LỊCH (Render thủ công để FIX LỖI DROPDOWN) -->
                        <li class="nav-item dropdown" id="tourDropdownTrigger">
                            <a class="nav-link dropdown-toggle text-white fw-bold me-2 position-relative" 
                                href="#" role="button" data-bs-toggle="dropdown"
                                style="font-size: 0.95rem; transition: all 0.2s; border-bottom: 2px solid transparent; padding-bottom: 0.25rem;"
                                onmouseover="this.style.color='#ffc107'; this.style.borderBottomColor='#ffc107'"
                                onmouseout="this.style.color='white'; this.style.borderBottomColor='transparent'">
                                <i class="fa-solid fa-map-marked-alt me-1"></i> Tour Du Lịch
                            </a>
                            <ul class="dropdown-menu shadow border-0" style="border-radius: 8px;">
                                <li v-for="child in navigationLinks.find(l => l.id === 'tourDropdownTrigger').children" :key="child.path">
                                    <router-link :to="child.path" class="dropdown-item">
                                        <i :class="child.icon" class="me-2" :style="{ color: child.color }"></i> {{ child.label }}
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                    </ul>

                    <!-- ICONS & USER ACTIONS (Căn phải) -->
                    <div class="d-flex align-items-center gap-3">

                        <!-- Icon Search & Cart (Nổi bật) -->
                        <div class="d-flex gap-2">
                             <router-link :to="`/lich-su-don-hang`" class="nav-link icon-action" title="Lịch sử đơn hàng"
                                style="padding: 0.5rem; border-radius: 50%; transition: background-color 0.2s;" 
                                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'" onmouseout="this.style.backgroundColor='transparent'">
                                <i class="fa-solid fa-shopping-bag" style="font-size: 1.2rem; color: #fff;"></i>
                             </router-link>
                        </div>
                        
                        <!-- Đường phân cách -->
                        <div style="height: 30px; width: 1px; background-color: rgba(255, 255, 255, 0.3);"></div>


                        <!-- USER DROPDOWN (Button nổi bật) -->
                        <div class="dropdown">

                            <!-- Nếu đã đăng nhập -->
                            <template v-if="user">
                                <a class="nav-link dropdown-toggle d-flex align-items-center user-pill" href="#" data-bs-toggle="dropdown"
                                   style="padding: 0.4rem 0.75rem; border: 2px solid #ffc107; background-color: transparent; border-radius: 50rem; transition: all 0.3s; box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);"
                                   onmouseover="this.style.backgroundColor='#ffc107'; this.style.borderColor='white'; this.style.color='#004080'"
                                   onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#ffc107'; this.style.color='white'">
                                    <img :src="user.avatar ?? defaultAvatar"
                                        style="height:30px; width: 30px; border-radius:50%;object-fit:cover; transition: border 0.3s;">
                                    <span class="ms-2 fw-bold d-none d-lg-inline-block text-white" style="transition: color 0.3s;">{{ user.ho_ten.split(' ')[0] }}</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 8px;">
                                    <li><router-link to="/thong-tin-ca-nhan" class="dropdown-item"><i class="fa-solid fa-user-circle me-2 text-primary"></i> Thông tin cá nhân</router-link>
                                    </li>
                                    <li><router-link to="/lich-su-dat-tour" class="dropdown-item"><i class="fa-solid fa-history me-2" style="color: #004080;"></i> Lịch sử đặt tour</router-link></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger fw-bold" @click="dangXuat" style="cursor: pointer;"><i class="fa-solid fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                                </ul>
                            </template>

                            <!-- Nếu chưa đăng nhập -->
                            <template v-else>
                                <a class="nav-link dropdown-toggle d-flex align-items-center user-pill" href="#" data-bs-toggle="dropdown"
                                   style="padding: 0.4rem 0.75rem; border: 2px solid #ffc107; background-color: transparent; border-radius: 50rem; transition: all 0.3s; box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);"
                                   onmouseover="this.style.backgroundColor='#ffc107'; this.style.borderColor='white'; this.style.color='#004080'"
                                   onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#ffc107'; this.style.color='white'">
                                    <i class="fa-solid fa-user" style="font-size: 1.2rem; color: #fff; transition: color 0.3s;"></i>
                                    <span class="ms-2 text-white fw-bold d-none d-lg-inline-block" style="transition: color 0.3s;">Tài khoản</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 8px;">
                                    <li><router-link to="/dang-nhap" class="dropdown-item fw-bold text-primary"><i class="fa-solid fa-sign-in-alt me-2"></i> Đăng nhập</router-link></li>
                                    <li><router-link to="/dang-ky" class="dropdown-item"><i class="fa-solid fa-user-plus me-2 text-secondary"></i> Đăng ký</router-link></li>
                                </ul>
                            </template>

                        </div>

                        <!-- Hotline (Call-to-Action) -->
                        <a class="nav-link d-flex align-items-center fw-bolder px-3 py-2" href="tel:0190019000"
                           style="color: #004080; font-size: 1rem; border-radius: 50rem; background-color: #ffc107; transition: background-color 0.2s, box-shadow 0.2s;"
                           onmouseover="this.style.backgroundColor='#fff'; this.style.boxShadow='0 0 10px #ffc107'" 
                           onmouseout="this.style.backgroundColor='#ffc107'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-phone-volume me-2" style="font-size: 1.2rem;"></i>
                            <span style="color: #004080;">01900 19000</span>
                        </a>
                    </div>

                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: null,
            defaultAvatar: "https://cdn-icons-png.flaticon.com/512/9187/9187604.png",
            // Dữ liệu tĩnh cho menu
            navigationLinks: [
                { path: '/', label: 'Trang Chủ', icon: 'fa-solid fa-home' },
                { path: '/gioi-thieu', label: 'Giới Thiệu', icon: 'fa-solid fa-info-circle' },
                { path: '/bai-viet', label: 'Bài Viết', icon: 'fa-solid fa-newspaper' },
                { path: '/faqs', label: 'Faqs', icon: 'fa-solid fa-question-circle' },
                { path: '/lien-he', label: 'Liên Hệ', icon: 'fa-solid fa-headset' },
                { path: '#', label: 'Tour Du Lịch', icon: 'fa-solid fa-map-marked-alt', id: 'tourDropdownTrigger', children: [
                    { path: '/tour-bac', label: 'Tour Miền Bắc', icon: 'fa-solid fa-mountain', color: '#17a2b8' },
                    { path: '/tour-trung', label: 'Tour Miền Trung', icon: 'fa-solid fa-sun', color: '#ffc107' },
                    { path: '/tour-nam', label: 'Tour Miền Nam', icon: 'fa-solid fa-ship', color: '#007bff' },
                ]},
            ]
        };
    },

    mounted() {
        this.checkLogin();
        // ⭐ FIX DROPDOWN: Khởi tạo Dropdown của Bootstrap sau khi Vue mount
        // Lỗi này xảy ra vì Vue Router chặn Bootstrap JS.
        if (typeof bootstrap !== 'undefined' && document.getElementById('tourDropdownTrigger')) {
             new bootstrap.Dropdown(document.getElementById('tourDropdownTrigger'));
        }
        // Khởi tạo Dropdown User cũng cần thiết nếu nó không tự động hoạt động
        if (typeof bootstrap !== 'undefined' && document.querySelector('.user-pill')) {
             new bootstrap.Dropdown(document.querySelector('.user-pill'));
        }
    },

    methods: {
        checkLogin() {
            const token = localStorage.getItem("auth_token");
            if (!token) return;

            axios.get("http://127.0.0.1:8000/api/thong-tin", {
                headers: { Authorization: "Bearer " + token }
            })
                .then(res => {
                    this.user = res.data.data;
                })
                .catch(() => {
                    this.user = null;
                    localStorage.removeItem("auth_token");
                });
        },

        dangXuat() {
            const token = localStorage.getItem("auth_token");
            if (!token) return;

            axios.post("http://127.0.0.1:8000/api/dang-xuat", {}, {
                headers: { Authorization: "Bearer " + token }
            })
                .then(() => {
                    localStorage.removeItem("auth_token");
                    this.user = null;
                    this.$router.replace("/");
                })
                .catch(err => {
                    console.log(err);
                    this.$toast.error("Đăng xuất thất bại");
                });
        }

    }
};
</script>
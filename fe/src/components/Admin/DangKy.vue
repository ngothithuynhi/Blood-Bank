<template>

    <div class="position-relative">
        <img src="../../../assets/images/homecustomer/Poster.png"
            style="max-width: 100%; height: auto; display: block;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <h1 style="color: #f1f2d9;">Hello!
                <br>
                We are glad to see you :)
            </h1>

            <!-- Đăng nhập gg -->
            <div class="d-flex flex-row mb-3">
                <div class="p-2"><button class="btn"
                        style="background-color: #f1f2d9; border-radius: 100px; color: #21857f;"><i
                            class="fa-brands fa-google" style="color: #21857f;"></i><b>Đăng ký với Google</b></button>
                </div>
                <div class="p-2"><button class="btn text-center btn-outline-white" style="border-radius: 100px;"><i
                            class="fa-brands fa-facebook-f text-white"></i></button></div>
                <div class="p-2"><button class="btn text-center btn-outline-white" style="border-radius: 100px;"><i
                            class="fa-brands fa-twitter text-white"></i></button></div>
            </div>
            <span style="color: #f1f2d9;">────────────── Or ──────────────</span>

            <!-- Tự nhập thông tin -->
            <div class="row mt-3">
                <div class="col-lg-6">
                    <label style="color: #f1f2d9; font-size: 17px;" class="mb-2 ms-3"><b>Họ và tên</b></label>
                    <input v-model="form_dang_ky.ho_ten" type="text" class="text-white form-control"
                        style="background: rgba(255, 255, 255, 0.1); border-radius: 100px;">
                </div>
                <div class="col-lg-6">
                    <label style="color: #f1f2d9; font-size: 17px;" class="mb-2 ms-3"><b>Tên đăng nhập</b></label>
                    <input v-model="form_dang_ky.ten_dang_nhap" type="text" class="text-white form-control"
                        style="background: rgba(255, 255, 255, 0.1); border-radius: 100px;">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6">
                    <label style="color: #f1f2d9; font-size: 17px;" class="mb-2 ms-3"><b>Email</b></label>
                    <input v-model="form_dang_ky.email" type="email" class="text-white form-control"
                        style="background: rgba(255, 255, 255, 0.1); border-radius: 100px;">
                </div>
                <div class="col-lg-6">
                    <label style="color: #f1f2d9; font-size: 17px;" class="mb-2 ms-3"><b>Số điện thoại</b></label>
                    <input v-model="form_dang_ky.so_dien_thoai" type="text" class="text-white form-control"
                        style="background: rgba(255, 255, 255, 0.1); border-radius: 100px;">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6">
                    <label style="color: #f1f2d9; font-size: 17px;" class="mb-2 ms-3"><b>Mật khẩu</b></label>
                    <input v-model="form_dang_ky.mat_khau" type="password" class="text-white form-control"
                        style="background: rgba(255, 255, 255, 0.1); border-radius: 100px;">
                </div>
                <div class="col-lg-6">
                    <label style="color: #f1f2d9; font-size: 17px;" class="mb-2 ms-3"><b>Nhập lại Mật khẩu</b></label>
                    <input v-model="form_dang_ky.re_mat_khau" type="password" class="text-white form-control"
                        style="background: rgba(255, 255, 255, 0.1); border-radius: 100px;">
                </div>
            </div>

            <!-- Xác nhận -->
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    <span class="text-white">Tôi đồng ý với các</span> <a href="/dieu-khoan-su-dung"
                        style="color: #f1f2d9; text-decoration: underline;"><b><u>Điều khoản sử dụng</u></b></a> <span
                        class="text-white">và</span> <a href="/chinh-sach-bao-mat"
                        style="color: #f1f2d9; text-decoration: underline;"><b><u>Chính sách bảo
                                mật</u></b></a>
                </label>
            </div>

            <!-- Nút -->
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-lg" type="button" @click="dangKyTaiKhoan()"
                    style="background-color: #f1f2d9; border-radius: 100px; color: #21857f;"
                    onmouseover="this.style.backgroundColor='#ffffff'"
                    onmouseout="this.style.backgroundColor='#f1f2d9'">
                    <b>Đăng ký</b>
                </button>
                <!-- <button class="btn btn-lg" type="button" v-if="isLoading"
                    style="background-color: #f1f2d9; border-radius: 100px; color: #21857f;"
                    onmouseover="this.style.backgroundColor='#ffffff'"
                    onmouseout="this.style.backgroundColor='#f1f2d9'">
                    <b>Đang xử lý...</b>
                </button> -->
            </div>

            <!-- Đã có acc -->
            <div class="text-center mt-3">
                <span class="text-white">Đã có tài khoản: </span>
                <a href="/dang-nhap" style="color: #f1f2d9; text-decoration: underline;"><b><u>Đăng nhập</u></b></a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            form_dang_ky: {},
            // isLoading: false
        }
    },
    mounted() {


    },
    methods: {
        dangKyTaiKhoan() {
            // 1. Check password có trùng nhau không
            if (this.form_dang_ky.mat_khau !== this.form_dang_ky.re_mat_khau) {
                this.$toast.error("Mật khẩu và nhập lại mật khẩu không khớp!");
                return; // dừng hàm không gửi request
            }

            //this.isLoading = true;

            axios.post('http://127.0.0.1:8000/api/dang-ky', this.form_dang_ky)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        //this.$router.replace("/");
                        this.$toast.success("Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.");
                    } else {
                        this.$toast.error('Đăng ký tài khoản thất bại');
                    }
                    this.isLoading = false;
                })
                .catch(() => {
                    this.$toast.error("Lỗi kết nối tới server.");
                    this.isLoading = false;
                });
        }
    },
}
</script>
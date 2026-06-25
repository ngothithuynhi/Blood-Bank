<template>
    <div class="register-page">
        <div class="register-card">
            <div class="register-left">
                <h1>Hello!</h1>
                <h2>We are glad to see you :)</h2>
            </div>

            <div class="register-form">
                <h3>Đăng ký tài khoản</h3>

                <div class="social-group">
                    <button class="social-btn">
                        <i class="fa-brands fa-google"></i>
                        Đăng ký với Google
                    </button>
                    <button class="circle-btn">
                        <i class="fa-brands fa-facebook-f"></i>
                    </button>
                    <button class="circle-btn">
                        <i class="fa-brands fa-twitter"></i>
                    </button>
                </div>

                <div class="divider">
                    <span></span>
                    <p>Or</p>
                    <span></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Họ và tên</label>
                        <input v-model="form_dang_ky.ho_ten" type="text" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label>Tên đăng nhập</label>
                        <input v-model="form_dang_ky.ten_dang_nhap" type="text" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input v-model="form_dang_ky.email" type="email" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label>Số điện thoại</label>
                        <input v-model="form_dang_ky.so_dien_thoai" type="text" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label>Mật khẩu</label>
                        <input v-model="form_dang_ky.password" type="password" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label>Nhập lại mật khẩu</label>
                        <input v-model="form_dang_ky.re_password" type="password" class="form-control" />
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Tôi đồng ý với
                        <a href="/dieu-khoan-su-dung">Điều khoản sử dụng</a>
                        và
                        <a href="/chinh-sach-bao-mat">Chính sách bảo mật</a>
                    </label>
                </div>

                <button class="register-btn" type="button" @click="dangKyTaiKhoan">
                    Đăng ký
                </button>

                <div class="login-link">
                    Đã có tài khoản?
                    <a href="/dang-nhap">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            form_dang_ky: {
                ho_ten: '',
                ten_dang_nhap: '',
                email: '',
                so_dien_thoai: '',
                password: '',
                re_password: ''
            }
        }
    },

    methods: {
        dangKyTaiKhoan() {
            console.log(this.form_dang_ky)
            if (!this.form_dang_ky.ho_ten || !this.form_dang_ky.ten_dang_nhap || !this.form_dang_ky.email) {
                this.$toast.error('Vui lòng nhập đầy đủ thông tin!')
                return
            }

            if (this.form_dang_ky.password !== this.form_dang_ky.re_password) {
                this.$toast.error('Mật khẩu nhập lại không khớp!')
                return
            }

            axios.post('http://127.0.0.1:8000/api/dang-ky', this.form_dang_ky)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message)
                    } else {
                        this.$toast.error(res.data.message)
                    }
                })
                .catch((err) => {
                    console.log(err.response?.data)
                    this.$toast.error('Lỗi kết nối tới server.')
                })
        }
    }
}
</script>

<style scoped>
.register-page {
    min-height: 100vh;
    background: #f4f6f8;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 16px;
}

.register-card {
    width: 1050px;
    min-height: 620px;
    display: grid;
    grid-template-columns: 42% 58%;
    border-radius: 28px;
    overflow: hidden;
    background: white;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.register-left {
    background:
        linear-gradient(rgba(183, 28, 28, 0.25), rgba(183, 28, 28, 0.25)),
        url("https://i.pinimg.com/736x/dc/ae/31/dcae315ac8dfa894d8bb4643a02cdae0.jpg");
    background-size: cover;
    background-position: center;
    color: #fff;
    padding: 50px 35px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.register-left h1 {
    font-size: 46px;
    font-weight: 800;
}

.register-left h2 {
    font-size: 30px;
    font-weight: 700;
}

.register-form {
    padding: 42px 50px;
}

.register-form h3 {
    color: #b71c1c;
    font-weight: 800;
    margin-bottom: 20px;
}

.social-group {
    display: flex;
    gap: 12px;
    margin-bottom: 18px;
}

.social-btn,
.circle-btn {
    border: none;
    background: #fbe9e7;
    color: #b71c1c;
    font-weight: 700;
    height: 44px;
    border-radius: 30px;
}

.social-btn {
    padding: 0 24px;
}

.circle-btn {
    width: 44px;
}

.divider {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #999;
    margin-bottom: 18px;
}

.divider span {
    flex: 1;
    height: 1px;
    background: #ddd;
}

.divider p {
    margin: 0;
}

label {
    color: #444;
    font-weight: 700;
    margin-bottom: 6px;
}

.form-control {
    height: 44px;
    border-radius: 30px;
    padding: 0 18px;
}

.form-control:focus {
    border-color: #d32f2f;
    box-shadow: 0 0 0 0.15rem rgba(211, 47, 47, 0.2);
}

.form-check-label {
    color: #555;
}

.form-check-label a {
    color: #b71c1c;
    font-weight: 700;
}

.register-btn {
    width: 100%;
    height: 48px;
    margin-top: 22px;
    border: none;
    border-radius: 30px;
    background: #d32f2f;
    color: white;
    font-size: 18px;
    font-weight: 800;
}

.register-btn:hover {
    background: #b71c1c;
}

.login-link {
    margin-top: 18px;
    text-align: center;
    color: #555;
}

.login-link a {
    color: #b71c1c;
    font-weight: 800;
}

@media (max-width: 900px) {
    .register-card {
        grid-template-columns: 1fr;
    }

    .register-left {
        min-height: 230px;
    }

    .register-form {
        padding: 32px 24px;
    }
}
</style>
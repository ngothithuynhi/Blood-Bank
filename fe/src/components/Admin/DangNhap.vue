<template>

    <div class="position-relative">
        <img src="../../../assets/images/homecustomer/Poster4.png"
            style="max-width: 100%; height: auto; display: block;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card" style="width: 500px;;border-radius: 15px;">
                <div class="card-body">
                    <h2 class="text-center"><b>Đăng nhập</b></h2>

                    <!-- Thông tin nhập vào -->
                    <label style="font-size: 17px;" class="mb-2 ms-3 mt-3">Tên đăng nhập</label>
                    <input v-model="thong_tin_dang_nhap.ten_dang_nhap" type="text" class="form-control mt-1"
                        style="border-radius: 90px; width: 465px;">
                    <label style="font-size: 17px;" class="mb-2 ms-3 mt-3">Mật khẩu</label>
                    <input v-model="thong_tin_dang_nhap.mat_khau" @keydown.enter="dangNhap()" type="password" class="form-control mt-1"
                        style="border-radius: 90px; width: 465px;">

                    <!-- Nút -->
                    <div class="d-grid gap-2 mt-4 mb-4">
                        <button @click="dangNhap()" class="btn btn-lg" type="button"
                            style="background-color: #3b5998; border-radius: 100px; color: #ffffff;"
                            onmouseover="this.style.backgroundColor='#5c76ab'" onmouseout="this.style.backgroundColor='#3b5998'">
                            <b>Đăng nhập</b>
                        </button>
                    </div>

                    <div class="text-center">───────────
                        <span class="ms-3 me-3">Đăng nhập với</span>
                        ───────────
                    </div>

                    <!-- Đăng nhập với -->
                    <div class="d-flex flex-row mb-3 text-center justify-content-center mt-3">
                        <div class="p-2"><button class="btn" style="background-color: cornflowerblue; border-radius: 100px;"><i
                                    class="fa-brands fa-google" style="color: #ffffff;"></i><b class="text-white ms-2">Google</b></button>
                        </div>
                        <div class="p-2"><button class="btn text-center btn-outline-white" style="border-radius: 100px;"><i
                                    class="fa-brands fa-facebook-f" style="color: cornflowerblue;"></i></button></div>
                        <div class="p-2"><button class="btn text-center btn-outline-white" style="border-radius: 100px;"><i
                                    class="fa-brands fa-twitter" style="color: cornflowerblue;"></i></button></div>
                    </div>

                    <div class="text-center">
                        <a href="/quen-mat-khau" style="color: cornflowerblue; text-decoration: underline;"><b><u>Quên
                                    mật khẩu?</u></b></a>
                    </div>
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
            thong_tin_dang_nhap: {}
        }
    },
    methods: {
        dangNhap() {
            axios.post('http://127.0.0.1:8000/api/dang-nhap', this.thong_tin_dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        localStorage.setItem('auth_token', res.data.token)
                        this.$router.push('/admin/nguoi-dung')
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(() => {
                    this.$toast.error("Lỗi kết nối tới server.");
                });
        }
    },
}
</script>
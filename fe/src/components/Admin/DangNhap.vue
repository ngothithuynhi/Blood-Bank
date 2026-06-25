<template>
  <div class="login-page">
    <div class="login-card">
      <div class="login-left">
        <div>
          <h1>Blood Bank</h1>
          <p>Kết nối người cần máu với người hiến máu nhanh chóng.</p>
        </div>
      </div>

      <div class="login-form">
        <h2>Đăng nhập</h2>

        <label>Tên đăng nhập</label>
        <input
          v-model="thong_tin_dang_nhap.ten_dang_nhap"
          type="text"
          class="form-control"
          placeholder="Nhập tên đăng nhập"
        />

        <label>Mật khẩu</label>
        <input
          v-model="thong_tin_dang_nhap.mat_khau"
          @keydown.enter="dangNhap"
          type="password"
          class="form-control"
          placeholder="Nhập mật khẩu"
        />

        <button @click="dangNhap" class="login-btn" type="button">
          Đăng nhập
        </button>

        <div class="divider">
          <span></span>
          <p>Đăng nhập với</p>
          <span></span>
        </div>

        <div class="social-group">
          <button class="google-btn">
            <i class="fa-brands fa-google"></i>
            Google
          </button>

          <button class="circle-btn">
            <i class="fa-brands fa-facebook-f"></i>
          </button>

          <button class="circle-btn">
            <i class="fa-brands fa-twitter"></i>
          </button>
        </div>

        <div class="forgot">
          <a href="/quen-mat-khau">Quên mật khẩu?</a>
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
      thong_tin_dang_nhap: {
        ten_dang_nhap: '',
        mat_khau: ''
      }
    }
  },

  methods: {
    dangNhap() {
      axios.post('http://127.0.0.1:8000/api/dang-nhap', this.thong_tin_dang_nhap)
        .then((res) => {
          if (res.data.status) {
            this.$toast.success(res.data.message)
            localStorage.setItem('auth_token', res.data.token)
            this.$router.push('/admin/nguoi-dung')
          } else {
            this.$toast.error(res.data.message)
          }
        })
        .catch(() => {
          this.$toast.error('Lỗi kết nối tới server.')
        })
    }
  }
}
</script>

<style scoped>
.login-page {
  min-height: 100vh;
  background: #f4f6f8;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 16px;
}

.login-card {
  width: 950px;
  min-height: 560px;
  display: grid;
  grid-template-columns: 45% 55%;
  background: #fff;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 20px 55px rgba(0, 0, 0, 0.15);
}

.login-left {
  background:
    linear-gradient(rgba(183, 28, 28, 0.2), rgba(183, 28, 28, 0.35)),
    url("https://i.pinimg.com/736x/dc/ae/31/dcae315ac8dfa894d8bb4643a02cdae0.jpg");
  background-size: cover;
  background-position: center;
  color: white;
  padding: 45px 35px;
  display: flex;
  align-items: flex-end;
}

.login-left h1 {
  font-size: 44px;
  font-weight: 900;
}

.login-left p {
  font-size: 18px;
  font-weight: 600;
}

.login-form {
  padding: 60px 55px;
}

.login-form h2 {
  color: #b71c1c;
  font-weight: 900;
  text-align: center;
  margin-bottom: 30px;
}

.login-form label {
  display: block;
  color: #444;
  font-weight: 700;
  margin: 16px 0 7px;
}

.form-control {
  height: 46px;
  border-radius: 30px;
  padding: 0 18px;
}

.form-control:focus {
  border-color: #d32f2f;
  box-shadow: 0 0 0 0.15rem rgba(211, 47, 47, 0.2);
}

.login-btn {
  width: 100%;
  height: 50px;
  margin-top: 26px;
  border: none;
  border-radius: 30px;
  background: #d32f2f;
  color: white;
  font-size: 18px;
  font-weight: 800;
}

.login-btn:hover {
  background: #b71c1c;
}

.divider {
  display: flex;
  align-items: center;
  gap: 12px;
  margin: 28px 0 18px;
  color: #777;
}

.divider span {
  flex: 1;
  height: 1px;
  background: #ddd;
}

.divider p {
  margin: 0;
}

.social-group {
  display: flex;
  justify-content: center;
  gap: 12px;
}

.google-btn,
.circle-btn {
  border: none;
  background: #fbe9e7;
  color: #b71c1c;
  font-weight: 800;
  height: 44px;
  border-radius: 30px;
}

.google-btn {
  padding: 0 24px;
}

.circle-btn {
  width: 44px;
}

.forgot {
  text-align: center;
  margin-top: 24px;
}

.forgot a {
  color: #b71c1c;
  font-weight: 800;
  text-decoration: underline;
}

@media (max-width: 850px) {
  .login-card {
    grid-template-columns: 1fr;
  }

  .login-left {
    min-height: 220px;
  }

  .login-form {
    padding: 35px 24px;
  }
}
</style>
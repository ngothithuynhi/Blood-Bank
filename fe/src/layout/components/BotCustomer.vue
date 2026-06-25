<template>
  <footer class="text-white text-center" style="background-color: #004080;">
    <div class="container py-5">
      
      <section class="mb-4">
        <a class="btn btn-outline-light btn-floating m-1 social-btn-custom" href="https://facebook.com" role="button"
          target="_blank">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a class="btn btn-outline-light btn-floating m-1 social-btn-custom" href="https://twitter.com" role="button"
          target="_blank">
          <i class="fab fa-twitter"></i>
        </a>
        <a class="btn btn-outline-light btn-floating m-1 social-btn-custom" href="https://instagram.com" role="button"
          target="_blank">
          <i class="fab fa-instagram"></i>
        </a>
        <a class="btn btn-outline-light btn-floating m-1 social-btn-custom" href="https://linkedin.com" role="button"
          target="_blank">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </section>

      <section class="mb-5">
        <form>
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-auto">
              <p class="mb-0 fw-bold fs-5">Đăng ký nhận thông tin mới</p>
            </div>
            <div class="col-md-5 col-12 my-3 my-md-0">
              <div class="form-outline form-white">
                <input type="email" class="form-control" placeholder="Nhập email của bạn" 
                       style="border-radius: 50rem; border: none;"/>
              </div>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-warning fw-bold text-dark signup-btn-custom">
                Đăng ký ngay
              </button>
            </div>
          </div>
        </form>
      </section>

      <section class="text-start">
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase fw-bolder mb-3" style="color: #ffc107;">TravelGo</h5>
            <p style="font-size: 0.95rem;">
              Đặt vé du lịch dễ dàng, nhanh chóng với trải nghiệm tuyệt vời!
            </p>
          </div>

          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h6 class="fw-bold mb-3 text-uppercase" style="color: #ffc107;">Điều hướng</h6>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="/" class="text-white text-decoration-none footer-link-hover">Trang chủ</a>
              </li>
              <li class="mb-2">
                <a href="/" class="text-white text-decoration-none footer-link-hover">Tour nổi bật</a>
              </li>
              <li class="mb-2">
                <a href="/" class="text-white text-decoration-none footer-link-hover">Tin tức</a>
              </li>
              <li>
                <a href="/" class="text-white text-decoration-none footer-link-hover">Khuyến mãi</a>
              </li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h6 class="fw-bold mb-3 text-uppercase" style="color: #ffc107;">Hỗ trợ</h6>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="/contact" class="text-white text-decoration-none footer-link-hover">Liên hệ</a>
              </li>
              <li class="mb-2">
                <a href="/about" class="text-white text-decoration-none footer-link-hover">Về chúng tôi</a>
              </li>
              <li>
                <a href="/privacy" class="text-white text-decoration-none footer-link-hover">Chính sách bảo mật</a>
              </li>
            </ul>
          </div>

          <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
            <h6 class="fw-bold mb-3 text-uppercase" style="color: #ffc107;">Thông tin công ty</h6>
            <p style="font-size: 0.95rem;">
              CÔNG TY TNHH TravelGo<br>
              Nơi cấp: Sở Kế hoạch và Đầu tư Tp. Hồ Chí Minh<br>
              Ngày đăng ký: 15/06/2021<br>
              Địa chỉ: Điện Biên Phủ, Q. Thanh Khê, Tp. Đà Nẵng
            </p>
          </div>
        </div>
      </section>
    </div>

    <div class="text-center p-3" style="background-color: #363636; font-size: 0.9rem;">
      © {{ new Date().getFullYear() }} TravelGo. All rights reserved.
    </div>
  </footer>
</template>

<script>
export default {};
</script>

<style scoped>
/* Định nghĩa các biến để dễ dàng thay đổi */
:root {
  --primary-blue-dark: #004080; 
  --accent-yellow: #ffc107;
}

/* Hiệu ứng Hover cho các nút Social Media */
.social-btn-custom {
  transition: all 0.3s;
  color: #fff !important; /* Đảm bảo icon luôn trắng */
  border-color: rgba(255, 255, 255, 0.4);
}
.social-btn-custom:hover {
  background-color: #fff;
  color: var(--primary-blue-dark) !important;
  border-color: var(--accent-yellow);
  transform: translateY(-3px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
}

/* Hiệu ứng Hover cho các link trong Footer */
.footer-link-hover {
    position: relative;
    padding-bottom: 2px;
    transition: color 0.2s, border-color 0.2s;
}
.footer-link-hover:hover {
    color: var(--accent-yellow) !important;
    text-shadow: 0 0 5px rgba(255, 193, 7, 0.5); /* Thêm glow nhẹ */
}

/* Nút Đăng ký */
.signup-btn-custom {
    transition: all 0.3s;
}
.signup-btn-custom:hover {
    background-color: #fff !important;
    box-shadow: 0 0 10px var(--accent-yellow);
    color: var(--primary-blue-dark) !important;
}

/* Cải thiện padding của Copyright */
.text-center.p-3 {
    padding-top: 0.75rem !important;
    padding-bottom: 0.75rem !important;
}
</style>
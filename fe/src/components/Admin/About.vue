<template>
  <div class="container py-4">
    <!-- Header banner -->
    <div class="banner p-5 mb-4 rounded-4 text-white">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold d-flex align-items-center">
          <i class="fa-solid fa-hospital me-3 animate-pulse"></i>
          {{ hospitalInfo.name }}
        </h1>
        <p class="col-md-9 fs-5 lead mt-3 opacity-90">{{ hospitalInfo.description }}</p>
        <button 
          class="btn btn-light btn-lg px-4 mt-4 edit-btn shadow-sm" 
          data-bs-toggle="modal" 
          data-bs-target="#editAboutModal" 
          @click="syncTempInfo"
        >
          <i class="fa-solid fa-pen-to-square me-2 text-danger"></i>
          <span class="text-danger fw-bold">Chỉnh sửa thông tin</span>
        </button>
      </div>
    </div>

    <!-- Info & Stats Row -->
    <div class="row g-4 mb-4">
      <!-- Quick Info Card -->
      <div class="col-lg-7">
        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-header bg-danger text-white py-3">
            <h5 class="mb-0 fw-bold d-flex align-items-center">
              <i class="fa-solid fa-circle-info me-2"></i>
              Thông Tin Liên Hệ & Hoạt Động
            </h5>
          </div>
          <div class="card-body p-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item py-3 d-flex align-items-start border-0 border-bottom">
                <i class="fa-solid fa-location-dot text-danger fs-4 me-3 mt-1"></i>
                <div>
                  <strong class="d-block mb-1 text-dark">Địa chỉ bệnh viện</strong>
                  <span class="text-muted">{{ hospitalInfo.address }}</span>
                </div>
              </li>
              <li class="list-group-item py-3 d-flex align-items-start border-0 border-bottom">
                <i class="fa-solid fa-phone text-success fs-4 me-3 mt-1"></i>
                <div>
                  <strong class="d-block mb-1 text-dark">Hotline hỗ trợ & cấp cứu</strong>
                  <span class="text-muted fw-bold text-success">{{ hospitalInfo.phone }}</span>
                </div>
              </li>
              <li class="list-group-item py-3 d-flex align-items-start border-0 border-bottom">
                <i class="fa-solid fa-envelope text-primary fs-4 me-3 mt-1"></i>
                <div>
                  <strong class="d-block mb-1 text-dark">Hòm thư điện tử (Email)</strong>
                  <span class="text-muted">{{ hospitalInfo.email }}</span>
                </div>
              </li>
              <li class="list-group-item py-3 d-flex align-items-start border-0">
                <i class="fa-solid fa-clock text-warning fs-4 me-3 mt-1"></i>
                <div>
                  <strong class="d-block mb-1 text-dark">Giờ tiếp nhận hiến máu</strong>
                  <span class="text-muted">{{ hospitalInfo.workingHours }}</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Stats Columns -->
      <div class="col-lg-5">
        <div class="row g-3 h-100">
          <div class="col-6">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-gradient-red text-white text-center h-100 d-flex flex-column justify-content-center">
              <i class="fa-solid fa-droplet fs-1 mb-2 animate-bounce-custom"></i>
              <h2 class="fw-bold mb-0">15,480+</h2>
              <p class="small mb-0 text-white-50 mt-1">Đơn vị máu thu nhận</p>
            </div>
          </div>
          <div class="col-6">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-gradient-blue text-white text-center h-100 d-flex flex-column justify-content-center">
              <i class="fa-solid fa-users fs-1 mb-2"></i>
              <h2 class="fw-bold mb-0">9,850+</h2>
              <p class="small mb-0 text-white-50 mt-1">Tài khoản hiến máu</p>
            </div>
          </div>
          <div class="col-6">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-gradient-green text-white text-center h-100 d-flex flex-column justify-content-center">
              <i class="fa-solid fa-heart-pulse fs-1 mb-2"></i>
              <h2 class="fw-bold mb-0">42,600+</h2>
              <p class="small mb-0 text-white-50 mt-1">Bệnh nhân được cứu trợ</p>
            </div>
          </div>
          <div class="col-6">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-gradient-purple text-white text-center h-100 d-flex flex-column justify-content-center">
              <i class="fa-solid fa-star fs-1 mb-2"></i>
              <h2 class="fw-bold mb-0">4.95 / 5.0</h2>
              <p class="small mb-0 text-white-50 mt-1">Đánh giá dịch vụ</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Map & Directions -->
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold d-flex align-items-center">
              <i class="fa-solid fa-map-location-dot me-2 text-danger"></i>
              Vị Trí Bản Đồ Bệnh Viện (Google Maps API)
            </h5>
            <span class="badge bg-danger px-3 py-2">LIVE MAP</span>
          </div>
          <div class="card-body p-0">
            <!-- Map Container -->
            <div class="map-container position-relative">
              <iframe
                :src="hospitalInfo.mapUrl"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editAboutModal" tabindex="-1" aria-labelledby="editAboutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header bg-danger text-white py-3">
            <h5 class="modal-title fw-bold" id="editAboutModalLabel">
              <i class="fa-solid fa-pen-to-square me-2"></i>Cập Nhật Thông Tin Bệnh Viện
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="closeEditModalBtn"></button>
          </div>
          <form @submit.prevent="saveInfo">
            <div class="modal-body p-4">
              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label fw-bold">Tên bệnh viện / trung tâm</label>
                  <input type="text" class="form-control" v-model="tempInfo.name" required>
                </div>
                <div class="col-md-12">
                  <label class="form-label fw-bold">Sứ mệnh / Mô tả ngắn</label>
                  <textarea class="form-control" rows="3" v-model="tempInfo.description" required></textarea>
                </div>
                <div class="col-md-12">
                  <label class="form-label fw-bold">Địa chỉ chi tiết</label>
                  <input type="text" class="form-control" v-model="tempInfo.address" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Hotline liên hệ</label>
                  <input type="text" class="form-control" v-model="tempInfo.phone" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Email</label>
                  <input type="email" class="form-control" v-model="tempInfo.email" required>
                </div>
                <div class="col-md-12">
                  <label class="form-label fw-bold">Giờ mở cửa / làm việc</label>
                  <input type="text" class="form-control" v-model="tempInfo.workingHours" required>
                </div>
                <div class="col-md-12">
                  <label class="form-label fw-bold">Link Nhúng Google Maps (Iframe Src)</label>
                  <input type="text" class="form-control" v-model="tempInfo.mapUrl" required>
                  <div class="form-text text-muted mt-2">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Vào <b>Google Maps</b> &rarr; Tìm bệnh viện &rarr; Chọn <b>Chia sẻ</b> &rarr; Chọn tab <b>Nhúng bản đồ</b> &rarr; Sao chép liên kết nằm trong thuộc tính <code>src="..."</code> của thẻ <code>iframe</code> để dán vào đây.
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer bg-light p-3 rounded-bottom-4">
              <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Hủy bỏ</button>
              <button type="submit" class="btn btn-danger px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-save me-1"></i> Lưu thay đổi
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const defaultInfo = {
  name: "Bệnh viện Truyền máu Huyết học TP.HCM",
  description: "Trung tâm hàng đầu tiếp nhận, sàng lọc, điều chế và cung ứng máu cùng các chế phẩm máu an toàn cho điều trị người bệnh tại TP.HCM và các tỉnh lân cận. Chúng tôi luôn đồng hành với thông điệp: Hiến giọt máu đào - Trao đời sự sống.",
  address: "118 Hồng Bàng, Phường 12, Quận 5, Thành phố Hồ Chí Minh",
  phone: "028.3957.1342 - 09.3895.7134",
  email: "truyenmauhuyethoc@tphcm.gov.vn",
  workingHours: "Thứ 2 - Chủ nhật: 7:00 - 19:00 (Làm việc xuyên trưa và ngày lễ)",
  mapUrl: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6972237890734!2d106.66014497573617!3d10.757803359537024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eed7b3014a9%3A0xe10433297a7e3ab8!2zQuG7h25oIHZp4buHbiBUcnV54buBbiBtw6F1IEh1eeG6v3QgaOG7!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s"
};

const hospitalInfo = ref({ ...defaultInfo });
const tempInfo = ref({ ...defaultInfo });

onMounted(() => {
  const saved = localStorage.getItem('hospital_info');
  if (saved) {
    try {
      hospitalInfo.value = JSON.parse(saved);
    } catch (e) {
      console.error("Lỗi khôi phục thông tin bệnh viện từ localStorage:", e);
    }
  }
});

const syncTempInfo = () => {
  tempInfo.value = { ...hospitalInfo.value };
};

const saveInfo = () => {
  hospitalInfo.value = { ...tempInfo.value };
  localStorage.setItem('hospital_info', JSON.stringify(hospitalInfo.value));
  
  // Close the modal
  const closeBtn = document.getElementById('closeEditModalBtn');
  if (closeBtn) {
    closeBtn.click();
  }
};
</script>

<style scoped>
.banner {
  background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
  box-shadow: 0 10px 30px rgba(211, 47, 47, 0.2);
}

.edit-btn {
  transition: all 0.3s ease;
}

.edit-btn:hover {
  transform: scale(1.05);
}

.bg-gradient-red {
  background: linear-gradient(135deg, #ff5252 0%, #d50000 100%);
}

.bg-gradient-blue {
  background: linear-gradient(135deg, #448aff 0%, #2979ff 100%);
}

.bg-gradient-green {
  background: linear-gradient(135deg, #69f0ae 0%, #00e676 100%);
}

.bg-gradient-purple {
  background: linear-gradient(135deg, #e040fb 0%, #d500f9 100%);
}

.stat-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.animate-pulse {
  animation: pulse-animation 2s infinite;
}

@keyframes pulse-animation {
  0% { transform: scale(1); }
  50% { transform: scale(1.08); }
  100% { transform: scale(1); }
}

.animate-bounce-custom {
  animation: bounce-animation 2.5s infinite;
}

@keyframes bounce-animation {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-8px); }
}

.map-container {
  overflow: hidden;
  border-bottom-left-radius: inherit;
  border-bottom-right-radius: inherit;
}

.map-container iframe {
  display: block;
}

.card {
  transition: all 0.3s ease;
}
.card:hover {
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
}

.opacity-90 {
  opacity: 0.90;
}
</style>

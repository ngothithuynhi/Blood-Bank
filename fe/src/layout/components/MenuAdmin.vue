<template>
  <div class="sidebar">

    <nav class="menu" style="margin-top: 100px;">

      <!-- Dashboard -->
      <router-link to="/admin" class="menu-item" active-class="active">
        <i class="fa-solid fa-house icon"></i>
        <span>Dashboard</span>
      </router-link>

      <!-- Quản lý tài khoản -->
      <router-link to="/admin/nguoi-dung" class="menu-item" active-class="active">
        <i class="fa-solid fa-user-group icon"></i>
        <span>Quản lý Tài Khoản</span>
      </router-link>

      <!-- QUẢN LÝ TOUR -->
      <div class="menu-group">
        <div class="menu-item dropdown" @click="toggleTour">
          <i class="fa-solid fa-plane-departure icon"></i>
          <span>Quản Lý Tour</span>
          <i class="fa-solid fa-chevron-right arrow" :class="{ rotate: showTour }"></i>
        </div>

        <transition name="slide">
          <div v-if="showTour" class="submenu">
            <router-link to="/admin/them-tour" class="submenu-item">Thêm Tour</router-link>
            <router-link to="/admin/danh-sach-tour" class="submenu-item">Danh Sách Tour</router-link>
            <router-link to="/admin/danh-muc-tour" class="submenu-item">Danh Mục Tour</router-link>
          </div>
        </transition>
      </div>

      <!-- Booking -->
      <router-link to="/admin/quan-ly-booking" class="menu-item" active-class="active">
        <i class="fa-solid fa-passport icon"></i>
        <span>Quản Lý Booking</span>
      </router-link>

      <!-- QUẢN LÝ DỊCH VỤ -->
      <div class="menu-group">
        <div class="menu-item dropdown" @click="toggleService">
          <i class="fa-brands fa-servicestack icon"></i>
          <span>Quản Lý Dịch Vụ</span>
          <i class="fa-solid fa-chevron-right arrow" :class="{ rotate: showService }"></i>
        </div>

        <transition name="slide">
          <div v-if="showService" class="submenu">
            <router-link to="/admin/voucher" class="submenu-item">Voucher</router-link>
            <router-link to="/admin/phuong-tien" class="submenu-item">Phương tiện</router-link>
          </div>
        </transition>
      </div>

      <!-- Phân quyền -->
      <router-link to="/admin/phan-quyen" class="menu-item" active-class="active">
        <i class="fa-solid fa-user-shield icon"></i>
        <span>Phân Quyền</span>
      </router-link>

      <!-- Tương tác -->
      <div class="menu-group">
        <div class="menu-item dropdown" @click="toggleInteract">
          <i class="fa-regular fa-comments icon"></i>
          <span>Tương Tác</span>
          <i class="fa-solid fa-chevron-right arrow" :class="{ rotate: showInteract }"></i>
        </div>

        <transition name="slide">
          <div v-if="showInteract" class="submenu">
            <router-link to="/admin/binh-luan" class="submenu-item">Bình Luận</router-link>
            <router-link to="/admin/lien-he" class="submenu-item">Quản Lý Liên Hệ</router-link>
          </div>
        </transition>
      </div>

    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showTour: false,
      showService: false,
      showInteract: false,
    };
  },
  methods: {
    toggleTour() { this.showTour = !this.showTour },
    toggleService() { this.showService = !this.showService },
    toggleInteract() { this.showInteract = !this.showInteract },
  }
};
</script>

<style scoped>
.sidebar {
  width: 260px;
  height: 100vh;
  background: #1e293b;
  padding: 25px 0;
  position: fixed;      /* ✅ Sửa từ sticky → fixed */
  top: 0;
  left: 0;
  z-index: 10;
  display: flex;
  flex-direction: column;
  overflow-y: auto;     /* ✅ Cho phép cuộn nếu menu dài */
}


/* MENU WRAPPER */
.menu {
  display: flex;
  flex-direction: column;
  gap: 14px; /* ⬅ Tăng khoảng cách đều giữa từng menu */
  padding: 0 22px;
}

/* ITEM CHÍNH */
.menu-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 13px 15px;
  font-size: 15px;
  color: #cbd5e1;
  cursor: pointer;
  border-radius: 8px;
  transition: 0.25s;
}

.menu-item:hover {
  background: #334155;
}

.menu-item.active {
  background: #0ea5e9;
  color: white !important;
}

/* ICON */
.icon {
  font-size: 18px;
}

/* SUBMENU */
.submenu {
  display: flex;
  flex-direction: column;
  gap: 10px;                   /* ⬅ tăng spacing submenu */
  padding-left: 22px;          /* ⬅ căn lề submenu đẹp hơn */
  margin-top: 6px;
  border-left: 2px solid #334155;
}

.submenu-item {
  padding: 6px 0;
  font-size: 14px;
  color: #cbd5e1;
  transition: 0.25s;
}

.submenu-item:hover {
  color: #38bdf8;
}

/* ARROW */
.arrow {
  margin-left: auto;
  font-size: 12px;
  transition: 0.3s;
}
.rotate {
  transform: rotate(90deg);
}

/* THÊM LINE NHẸ GIỮA CÁC GROUP */
.menu-group {
  display: flex;
  flex-direction: column;
  gap: 10px; /* khoảng cách đều */
  padding-bottom: 6px;
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
.menu-group:last-child {
  border-bottom: none;
}


</style>

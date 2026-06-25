<template>
  <div class="admin-layout">
    <aside class="sidebar">
      <h2>Blood Bank</h2>

      <a class="active">Quản lý người dùng</a>
      <a>Kho máu</a>
      <a>Người hiến máu</a>
      <a>Yêu cầu máu</a>
      <a>Đăng xuất</a>
    </aside>

    <main class="content">
      <div class="header">
        <h1>Quản lý người dùng</h1>
        <button class="btn primary" @click="openModal">+ Thêm tài khoản</button>
      </div>

      <div class="filter-box">
        <input
          v-model="keyword"
          type="text"
          placeholder="Tìm theo tên, email, số điện thoại..."
        />

        <select v-model="selectedRole">
          <option value="">Tất cả vai trò</option>
          <option value="Admin">Admin</option>
          <option value="Donor">Donor</option>
          <option value="Procurer">Procurer</option>
        </select>

        <select v-model="selectedStatus">
          <option value="">Tất cả trạng thái</option>
          <option value="Hoạt động">Hoạt động</option>
          <option value="Đã khóa">Đã khóa</option>
        </select>
      </div>

      <table>
        <thead>
          <tr>
            <th>Mã TK</th>
            <th>Tên đăng nhập</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="user in filteredUsers" :key="user.ma_tai_khoan">
            <td>{{ user.ma_tai_khoan }}</td>
            <td>{{ user.ten_dang_nhap }}</td>
            <td>{{ user.ho_ten }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.so_dien_thoai }}</td>

            <td>
              <span class="badge" :class="roleClass(user.vai_tro)">
                {{ user.vai_tro }}
              </span>
            </td>

            <td>
              <span class="status" :class="statusClass(user.trang_thai)">
                {{ user.trang_thai }}
              </span>
            </td>

            <td class="actions">
              <button class="btn view" @click="viewUser(user)">Xem</button>
              <button class="btn edit" @click="editUser(user)">Sửa</button>
              <button
                class="btn lock"
                v-if="user.trang_thai === 'Hoạt động'"
              >
                Khóa
              </button>
              <button class="btn unlock" v-else>Mở khóa</button>
            </td>
          </tr>
        </tbody>
      </table>
    </main>

    <div class="modal" v-if="showModal">
      <div class="modal-content">
        <h2>{{ isEdit ? 'Sửa tài khoản' : 'Thêm tài khoản' }}</h2>

        <form @submit.prevent="saveUser">
          <label>Mã tài khoản</label>
          <input v-model="form.ma_tai_khoan" type="text" />

          <label>Tên đăng nhập</label>
          <input v-model="form.ten_dang_nhap" type="text" />

          <label>Mật khẩu</label>
          <input v-model="form.mat_khau" type="password" />

          <label>Họ tên</label>
          <input v-model="form.ho_ten" type="text" />

          <label>Email</label>
          <input v-model="form.email" type="email" />

          <label>Số điện thoại</label>
          <input v-model="form.so_dien_thoai" type="text" />

          <label>Vai trò</label>
          <select v-model="form.vai_tro">
            <option value="Admin">Admin</option>
            <option value="Donor">Donor</option>
            <option value="Procurer">Procurer</option>
          </select>

          <label>Trạng thái</label>
          <select v-model="form.trang_thai">
            <option value="Hoạt động">Hoạt động</option>
            <option value="Đã khóa">Đã khóa</option>
          </select>

          <div class="modal-actions">
            <button type="button" class="btn cancel" @click="closeModal">
              Hủy
            </button>
            <button type="submit" class="btn primary">Lưu</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, reactive, ref } from 'vue'

const keyword = ref('')
const selectedRole = ref('')
const selectedStatus = ref('')
const showModal = ref(false)
const isEdit = ref(false)

const users = ref([
  {
    ma_tai_khoan: 'TK001',
    ten_dang_nhap: 'admin01',
    mat_khau: '123456',
    ho_ten: 'Nguyễn Văn A',
    email: 'admin@gmail.com',
    so_dien_thoai: '0901234567',
    vai_tro: 'Admin',
    trang_thai: 'Hoạt động'
  },
  {
    ma_tai_khoan: 'TK002',
    ten_dang_nhap: 'donor01',
    mat_khau: '123456',
    ho_ten: 'Trần Thị B',
    email: 'donor@gmail.com',
    so_dien_thoai: '0912345678',
    vai_tro: 'Donor',
    trang_thai: 'Hoạt động'
  },
  {
    ma_tai_khoan: 'TK003',
    ten_dang_nhap: 'user01',
    mat_khau: '123456',
    ho_ten: 'Lê Văn C',
    email: 'user@gmail.com',
    so_dien_thoai: '0987654321',
    vai_tro: 'Procurer',
    trang_thai: 'Đã khóa'
  }
])

const form = reactive({
  ma_tai_khoan: '',
  ten_dang_nhap: '',
  mat_khau: '',
  ho_ten: '',
  email: '',
  so_dien_thoai: '',
  vai_tro: 'Donor',
  trang_thai: 'Hoạt động'
})

const filteredUsers = computed(() => {
  return users.value.filter(user => {
    const text = keyword.value.toLowerCase()

    const matchKeyword =
      user.ho_ten.toLowerCase().includes(text) ||
      user.email.toLowerCase().includes(text) ||
      user.so_dien_thoai.includes(text)

    const matchRole =
      selectedRole.value === '' || user.vai_tro === selectedRole.value

    const matchStatus =
      selectedStatus.value === '' || user.trang_thai === selectedStatus.value

    return matchKeyword && matchRole && matchStatus
  })
})

function openModal() {
  isEdit.value = false
  resetForm()
  showModal.value = true
}

function closeModal() {
  showModal.value = false
}

function editUser(user) {
  isEdit.value = true
  Object.assign(form, user)
  showModal.value = true
}

function viewUser(user) {
  alert(`Thông tin người dùng: ${user.ho_ten}`)
}

function saveUser() {
  if (isEdit.value) {
    const index = users.value.findIndex(
      user => user.ma_tai_khoan === form.ma_tai_khoan
    )

    if (index !== -1) {
      users.value[index] = { ...form }
    }
  } else {
    users.value.push({ ...form })
  }

  closeModal()
}

function resetForm() {
  Object.assign(form, {
    ma_tai_khoan: '',
    ten_dang_nhap: '',
    mat_khau: '',
    ho_ten: '',
    email: '',
    so_dien_thoai: '',
    vai_tro: 'Donor',
    trang_thai: 'Hoạt động'
  })
}

function roleClass(role) {
  return {
    admin: role === 'Admin',
    donor: role === 'Donor',
    procurer: role === 'Procurer'
  }
}

function statusClass(status) {
  return {
    active: status === 'Hoạt động',
    locked: status === 'Đã khóa'
  }
}
</script>

<style scoped>
.admin-layout {
  display: flex;
  min-height: 100vh;
  background: #f5f6fa;
  color: #333;
}

.sidebar {
  width: 240px;
  background: #b71c1c;
  color: white;
  padding: 24px 18px;
}

.sidebar h2 {
  text-align: center;
  margin-bottom: 28px;
}

.sidebar a {
  display: block;
  padding: 13px 15px;
  margin-bottom: 8px;
  color: white;
  border-radius: 8px;
  cursor: pointer;
}

.sidebar a.active,
.sidebar a:hover {
  background: #8e0000;
}

.content {
  flex: 1;
  padding: 30px;
  overflow-x: auto;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.header h1 {
  color: #b71c1c;
}

.filter-box {
  display: flex;
  gap: 14px;
  background: white;
  padding: 18px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.filter-box input,
.filter-box select,
.modal-content input,
.modal-content select {
  padding: 11px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.filter-box input {
  width: 340px;
}

table {
  width: 100%;
  border-collapse: collapse;
  background: white;
  border-radius: 10px;
  overflow: hidden;
}

th {
  background: #d32f2f;
  color: white;
  padding: 14px;
  text-align: left;
}

td {
  padding: 13px;
  border-bottom: 1px solid #eee;
}

tr:hover {
  background: #fff5f5;
}

.btn {
  border: none;
  padding: 8px 12px;
  border-radius: 6px;
  cursor: pointer;
  color: white;
}

.primary {
  background: #d32f2f;
}

.view {
  background: #1976d2;
}

.edit {
  background: #f9a825;
}

.lock {
  background: #c62828;
}

.unlock {
  background: #2e7d32;
}

.cancel {
  background: #777;
}

.actions {
  display: flex;
  gap: 6px;
}

.badge,
.status {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 13px;
}

.badge.admin {
  background: #ede7f6;
  color: #5e35b1;
}

.badge.donor {
  background: #ffebee;
  color: #c62828;
}

.badge.procurer {
  background: #e3f2fd;
  color: #1565c0;
}

.status.active {
  background: #e8f5e9;
  color: #2e7d32;
}

.status.locked {
  background: #eeeeee;
  color: #555;
}

.modal {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.45);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  width: 520px;
  background: white;
  padding: 25px;
  border-radius: 12px;
}

.modal-content h2 {
  color: #b71c1c;
  margin-bottom: 18px;
}

.modal-content label {
  display: block;
  margin-top: 12px;
  margin-bottom: 5px;
}

.modal-content input,
.modal-content select {
  width: 100%;
}

.modal-actions {
  margin-top: 20px;
  text-align: right;
}
</style>
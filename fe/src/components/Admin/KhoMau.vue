<template>
    <div class="container">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <!-- An SVG icon representing blood donation or inventory -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-droplet-fill text-danger me-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 16a6 6 0 0 0 6-6c0-1.667-1-3-1.5-4-.5-.667-1.25-1.5-2-2.5a55.8 55.8 0 0 0-2.5-3c-.125-.125-.25-.25-.375-.375-.125.125-.25.25-.375.375a55.9 55.9 0 0 0-2.5 3c-.75 1-1.5 1.833-2 2.5C2.5 7 1.5 8.333 1.5 10a6 6 0 0 0 6 6m0-13.066c.866 1.054 1.882 2.223 2.76 3.32.769.96 1.24 1.66 1.24 2.246a4 4 0 0 1-8 0c0-.586.47-1.286 1.24-2.246.878-1.097 1.894-2.266 2.76-3.32"/>
                </svg>
                <h3 class="m-0" style="font-family: Verdana, sans-serif; font-size: 25px; font-weight: bold;">Quản Lý Kho Máu</h3>
            </div>
            <button data-bs-toggle="modal" data-bs-target="#themmoiModal" class="btn btn-danger" style="border-radius: 50px; padding: 10px 20px; font-weight: bold; font-size: 14px; 
            border: none; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
            transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'">
                <i class="fa-solid fa-plus text-white"></i> Thêm mới kho máu
            </button>
        </div>

        <!-- Breadcrumbs & Stats Alerts -->
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="/admin" class="text-secondary">Dashboard</a>
                &gt; Kho máu
            </div>
        </div>

        <!-- Search Bar and Warning Levels -->
        <div class="row align-items-center mb-4">
            <div class="col-lg-5">
                <div class="input-group">
                    <input v-model="tim_kiem.tim_kho_mau" type="text" class="form-control"
                        placeholder="Tìm nhóm máu, mã kho, vị trí lưu trữ..." @keyup="timKiem()">
                    <button @click="timKiem()" class="btn btn-danger text-white">Tìm kiếm</button>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="d-flex justify-content-end gap-3 align-items-center">
                    <div class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 p-2 rounded">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> Cảnh báo: Số lượng &le; Mức cảnh báo
                    </div>
                    <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 p-2 rounded">
                        <i class="fa-solid fa-circle-check me-1"></i> Bình thường: Số lượng &gt; Mức cảnh báo
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-danger">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Mã kho máu</th>
                                        <th>Nhóm máu</th>
                                        <th>Số lượng (ml)</th>
                                        <th>Mức cảnh báo (ml)</th>
                                        <th>Vị trí lưu trữ</th>
                                        <th>Hạn sử dụng</th>
                                        <th>Quản lý bởi</th>
                                        <th>Trạng thái</th>
                                        <th class="pe-3">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, index) in list_kho_mau" :key="value.ma_kho_mau" 
                                        :class="{'table-warning-row': value.so_luong <= value.muc_canh_bao}">
                                        <td class="ps-3">{{ index + 1 }}</td>
                                        <td><strong>{{ value.ma_kho_mau }}</strong></td>
                                        <td>
                                            <span class="blood-badge" :data-blood="value.nhom_mau">
                                                {{ value.nhom_mau }}
                                            </span>
                                        </td>
                                        <td>
                                            <span :class="value.so_luong <= value.muc_canh_bao ? 'text-danger fw-bold' : 'text-dark'">
                                                {{ value.so_luong }} ml
                                            </span>
                                            <div v-if="value.so_luong <= value.muc_canh_bao" class="small text-danger">
                                                <i class="fa-solid fa-triangle-exclamation"></i> Sắp hết!
                                            </div>
                                        </td>
                                        <td>{{ value.muc_canh_bao }} ml</td>
                                        <td>{{ value.vi_tri_luu_tru || 'Chưa xếp' }}</td>
                                        <td>
                                            <span :class="isExpired(value.han_su_dung) ? 'text-danger fw-bold' : ''">
                                                {{ formatDate(value.han_su_dung) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary small">{{ getAccountName(value.ma_tai_khoan) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge" :class="getStatusBadgeClass(value.trang_thai)">
                                                {{ value.trang_thai }}
                                            </span>
                                        </td>
                                        <!-- Actions -->
                                        <td class="pe-3">
                                            <button @click="openEditModal(value)" data-bs-toggle="modal"
                                                data-bs-target="#capnhatModal" class="btn btn-sm btn-outline-secondary me-2 rounded-circle-btn" title="Sửa">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button @click="Object.assign(xoa_kho_mau, value)" data-bs-toggle="modal"
                                                data-bs-target="#xoaModal" class="btn btn-sm btn-outline-danger me-2 rounded-circle-btn" title="Xóa">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                            <button @click="Object.assign(chi_tiet_kho_mau, value)" data-bs-toggle="modal"
                                                data-bs-target="#chitietModal" class="btn btn-sm btn-outline-info rounded-circle-btn" title="Chi tiết">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="list_kho_mau.length === 0">
                                        <td colspan="10" class="text-center py-4 text-muted">
                                            Không tìm thấy dữ liệu kho máu nào.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm mới -->
    <div class="modal fade" id="themmoiModal" tabindex="-1" aria-labelledby="themmoiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="themmoiModalLabel"><i class="fa-solid fa-droplet me-2"></i> Thêm mới Kho Máu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Left inputs -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mã kho máu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="them_kho_mau.ma_kho_mau" placeholder="Ví dụ: KM001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nhóm máu <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="them_kho_mau.nhom_mau">
                                <option value="" disabled>-- Chọn nhóm máu --</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số lượng (ml) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model.number="them_kho_mau.so_luong" min="0" placeholder="Ví dụ: 350">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mức cảnh báo tối thiểu (ml) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model.number="them_kho_mau.muc_canh_bao" min="0" placeholder="Ví dụ: 100">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Vị trí lưu trữ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="them_kho_mau.vi_tri_luu_tru" placeholder="Ví dụ: Tủ A - Ngăn 1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Hạn sử dụng <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" v-model="them_kho_mau.han_su_dung">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tài khoản quản lý <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="them_kho_mau.ma_tai_khoan">
                                <option value="" disabled>-- Chọn tài khoản quản lý --</option>
                                <option v-for="user in list_tai_khoan" :key="user.ma_tai_khoan" :value="user.ma_tai_khoan">
                                    {{ user.ho_ten }} ({{ user.ten_dang_nhap }})
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="them_kho_mau.trang_thai">
                                <option value="" disabled>-- Chọn trạng thái --</option>
                                <option value="Bình thường">Bình thường</option>
                                <option value="Cảnh báo">Cảnh báo</option>
                                <option value="Hết hạn">Hết hạn</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Ghi chú</label>
                            <textarea class="form-control" v-model="them_kho_mau.ghi_chu" rows="3" placeholder="Nhập ghi chú hoặc mô tả thêm..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" @click="themKhoMau()" class="btn btn-danger px-4" data-bs-dismiss="modal">Thêm mới</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cập nhật -->
    <div class="modal fade" id="capnhatModal" tabindex="-1" aria-labelledby="capnhatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="capnhatModalLabel"><i class="fa-solid fa-pen-to-square me-2"></i> Cập nhật thông tin Kho Máu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mã kho máu</label>
                            <input type="text" class="form-control" v-model="sua_kho_mau.ma_kho_mau" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nhóm máu <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="sua_kho_mau.nhom_mau">
                                <option value="" disabled>-- Chọn nhóm máu --</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số lượng (ml) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model.number="sua_kho_mau.so_luong" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mức cảnh báo tối thiểu (ml) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model.number="sua_kho_mau.muc_canh_bao" min="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Vị trí lưu trữ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="sua_kho_mau.vi_tri_luu_tru">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Hạn sử dụng <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" v-model="sua_kho_mau.han_su_dung">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tài khoản quản lý <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="sua_kho_mau.ma_tai_khoan">
                                <option value="" disabled>-- Chọn tài khoản quản lý --</option>
                                <option v-for="user in list_tai_khoan" :key="user.ma_tai_khoan" :value="user.ma_tai_khoan">
                                    {{ user.ho_ten }} ({{ user.ten_dang_nhap }})
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="sua_kho_mau.trang_thai">
                                <option value="" disabled>-- Chọn trạng thái --</option>
                                <option value="Bình thường">Bình thường</option>
                                <option value="Cảnh báo">Cảnh báo</option>
                                <option value="Hết hạn">Hết hạn</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Ghi chú</label>
                            <textarea class="form-control" v-model="sua_kho_mau.ghi_chu" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" @click="suaKhoMau()" class="btn btn-primary px-4" data-bs-dismiss="modal">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa -->
    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="xoaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pb-4">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-circle"
                        style="width: 85px; height: 85px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                        </svg>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Xác nhận xóa túi máu?</h4>
                    <p class="text-muted mb-0">
                        Bạn có chắc chắn muốn xóa túi máu có mã <strong class="text-dark">{{ xoa_kho_mau.ma_kho_mau }}</strong>?
                        <br>
                        <span class="small text-danger">Hành động này không thể hoàn tác.</span>
                    </p>
                </div>
                <div class="modal-footer justify-content-center border-top-0 pt-0 pb-4">
                    <button type="button" class="btn btn-light px-4 me-2 border" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="button" @click="xoaKhoMau()" class="btn btn-danger px-4" data-bs-dismiss="modal">Xóa bỏ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Chi tiết -->
    <div class="modal fade" id="chitietModal" tabindex="-1" aria-labelledby="chitietModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="fa-solid fa-circle-info"></i> Chi tiết túi máu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Block: Blood Type Badge -->
                        <div class="col-md-4 text-center border-end d-flex flex-column justify-content-center align-items-center py-3 bg-light rounded-start">
                            <span class="detail-blood-group">
                                {{ chi_tiet_kho_mau.nhom_mau }}
                            </span>
                            <h4 class="mt-3 fw-bold text-dark">Nhóm máu {{ chi_tiet_kho_mau.nhom_mau }}</h4>
                            <span class="badge" :class="getStatusBadgeClass(chi_tiet_kho_mau.trang_thai)">
                                {{ chi_tiet_kho_mau.trang_thai }}
                            </span>
                        </div>

                        <!-- Right Block: Key Stats -->
                        <div class="col-md-8 p-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small">Thông tin lưu trữ</h6>
                            
                            <div class="row mb-3 border-bottom pb-2">
                                <div class="col-6">
                                    <small class="text-muted d-block">Mã túi máu</small>
                                    <span class="fw-semibold text-dark">{{ chi_tiet_kho_mau.ma_kho_mau }}</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Vị trí lưu trữ</small>
                                    <span class="fw-semibold text-dark">{{ chi_tiet_kho_mau.vi_tri_luu_tru }}</span>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom pb-2">
                                <div class="col-6">
                                    <small class="text-muted d-block">Số lượng</small>
                                    <span class="fw-semibold text-danger">{{ chi_tiet_kho_mau.so_luong }} ml</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Mức cảnh báo tối thiểu</small>
                                    <span class="fw-semibold">{{ chi_tiet_kho_mau.muc_canh_bao }} ml</span>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom pb-2">
                                <div class="col-6">
                                    <small class="text-muted d-block">Hạn sử dụng</small>
                                    <span class="fw-semibold" :class="isExpired(chi_tiet_kho_mau.han_su_dung) ? 'text-danger fw-bold' : 'text-dark'">
                                        {{ formatDate(chi_tiet_kho_mau.han_su_dung) }} 
                                        <span v-if="isExpired(chi_tiet_kho_mau.han_su_dung)" class="small d-block text-danger">(Hết hạn!)</span>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Người tạo/Quản lý</small>
                                    <span class="fw-semibold text-dark">{{ getAccountName(chi_tiet_kho_mau.ma_tai_khoan) }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted d-block">Ghi chú</small>
                                    <p class="mb-0 bg-light p-2 rounded text-secondary italic-text">{{ chi_tiet_kho_mau.ghi_chu || 'Không có ghi chú nào' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            list_kho_mau: [],
            list_tai_khoan: [],
            them_kho_mau: {
                ma_kho_mau: "",
                nhom_mau: "",
                so_luong: null,
                muc_canh_bao: null,
                trang_thai: "Bình thường",
                vi_tri_luu_tru: "",
                han_su_dung: "",
                ghi_chu: "",
                ma_tai_khoan: ""
            },
            sua_kho_mau: {},
            xoa_kho_mau: {},
            chi_tiet_kho_mau: {},
            tim_kiem: {
                tim_kho_mau: ""
            }
        };
    },
    mounted() {
        this.getKhoMau();
        this.getTaiKhoan();
    },
    methods: {
        getKhoMau() {
            axios.get("http://localhost:8000/api/admin/kho-mau", {
                headers: { Authorization: "Bearer " + localStorage.getItem("auth_token") }
            })
            .then(res => {
                if (res.data.status) {
                    this.list_kho_mau = res.data.data;
                } else {
                    this.$toast.error(res.data.message);
                }
            })
            .catch(() => {
                this.$toast.error("Không thể kết nối lấy dữ liệu kho máu.");
            });
        },
        getTaiKhoan() {
            // Lấy danh sách tài khoản để gán cho kho máu
            axios.get("http://localhost:8000/api/admin/nguoi-dung", {
                headers: { Authorization: "Bearer " + localStorage.getItem("auth_token") }
            })
            .then(res => {
                if (res.data.status) {
                    this.list_tai_khoan = res.data.data;
                }
            })
            .catch(() => {
                console.error("Không thể tải danh sách tài khoản để liên kết.");
            });
        },
        themKhoMau() {
            axios.post("http://localhost:8000/api/admin/kho-mau/them-kho-mau", this.them_kho_mau, {
                headers: { Authorization: "Bearer " + localStorage.getItem("auth_token") }
            })
            .then(res => {
                if (res.data.status) {
                    this.$toast.success(res.data.message || "Thêm kho máu thành công.");
                    this.getKhoMau();
                    this.resetForm();
                } else {
                    this.$toast.error(res.data.message || "Thêm kho máu thất bại.");
                }
            })
            .catch(() => {
                this.$toast.error("Thêm kho máu thất bại.");
            });
        },
        openEditModal(item) {
            this.sua_kho_mau = Object.assign({}, item);
        },
        suaKhoMau() {
            axios.post("http://localhost:8000/api/admin/kho-mau/sua-kho-mau", this.sua_kho_mau, {
                headers: { Authorization: "Bearer " + localStorage.getItem("auth_token") }
            })
            .then(res => {
                if (res.data.status) {
                    this.$toast.success(res.data.message || "Cập nhật kho máu thành công.");
                    this.getKhoMau();
                } else {
                    this.$toast.error(res.data.message || "Cập nhật kho máu thất bại.");
                }
            })
            .catch(() => {
                this.$toast.error("Cập nhật kho máu thất bại.");
            });
        },
        xoaKhoMau() {
            axios.post("http://localhost:8000/api/admin/kho-mau/xoa-kho-mau", this.xoa_kho_mau, {
                headers: { Authorization: "Bearer " + localStorage.getItem("auth_token") }
            })
            .then(res => {
                if (res.data.status) {
                    this.$toast.success(res.data.message || "Xóa túi máu thành công.");
                    this.getKhoMau();
                } else {
                    this.$toast.error(res.data.message || "Xóa thất bại.");
                }
            })
            .catch(() => {
                this.$toast.error("Xóa kho máu thất bại.");
            });
        },
        timKiem() {
            axios.post("http://localhost:8000/api/admin/kho-mau/tim-kiem", this.tim_kiem, {
                headers: { Authorization: "Bearer " + localStorage.getItem("auth_token") }
            })
            .then(res => {
                if (res.data.status) {
                    this.list_kho_mau = res.data.data;
                }
            })
            .catch(() => {
                this.$toast.error("Tìm kiếm kho máu thất bại.");
            });
        },
        resetForm() {
            this.them_kho_mau = {
                ma_kho_mau: "",
                nhom_mau: "",
                so_luong: null,
                muc_canh_bao: null,
                trang_thai: "Bình thường",
                vi_tri_luu_tru: "",
                han_su_dung: "",
                ghi_chu: "",
                ma_tai_khoan: ""
            };
        },
        // Helpers
        getAccountName(ma_tai_khoan) {
            const user = this.list_tai_khoan.find(u => u.ma_tai_khoan === ma_tai_khoan);
            return user ? user.ho_ten : ma_tai_khoan || 'Chưa phân công';
        },
        formatDate(dateStr) {
            if (!dateStr) return 'N/A';
            const date = new Date(dateStr);
            if (isNaN(date.getTime())) return dateStr;
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        },
        isExpired(dateStr) {
            if (!dateStr) return false;
            const expiry = new Date(dateStr);
            const now = new Date();
            // Reset hours for fair date-only comparison
            expiry.setHours(0,0,0,0);
            now.setHours(0,0,0,0);
            return expiry < now;
        },
        getStatusBadgeClass(status) {
            switch(status) {
                case 'Bình thường': return 'bg-success text-white';
                case 'Cảnh báo': return 'bg-warning text-dark';
                case 'Hết hạn': return 'bg-danger text-white';
                default: return 'bg-secondary text-white';
            }
        }
    }
};
</script>

<style scoped>
/* Rounded actions buttons */
.rounded-circle-btn {
    width: 32px;
    height: 32px;
    padding: 0;
    line-height: 32px;
    text-align: center;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Row warning highlight if quantity is below critical warning limits */
.table-warning-row {
    background-color: rgba(220, 53, 69, 0.05) !important;
}

/* Custom design for blood type badges */
.blood-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: bold;
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-size: 14px;
}

.blood-badge[data-blood^="A"] {
    background-color: #e63946;
}

.blood-badge[data-blood^="B"] {
    background-color: #457b9d;
}

.blood-badge[data-blood^="AB"] {
    background-color: #8338ec;
}

.blood-badge[data-blood^="O"] {
    background-color: #2a9d8f;
}

/* Big blood badge in detail modal */
.detail-blood-group {
    font-size: 40px;
    font-weight: 800;
    color: white;
    background-color: #dc3545;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
}

.italic-text {
    font-style: italic;
}
</style>

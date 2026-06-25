import { createRouter, createWebHistory } from "vue-router"; // cài vue-router: npm install vue-router@next --save
import checkToken from "./checkToken";
const routes = [
  // {
  //     path : '/',
  //     component: ()=>import('../layout/wrapper/index.vue')
  // },

  // ============= Admin ==================
  {
    path: "/admin/nguoi-dung",
    component: () => import("../components/Admin/NguoiDung.vue"),
    // beforeEnter: checkToken,
    meta: { layout: "index" },
    
  },
  {
    path: "/admin/kho-mau",
    component: () => import("../components/Admin/KhoMau.vue"),
    // beforeEnter: checkToken,
    meta: { layout: "index" },
  },
  {
    path: "/dang-nhap",
    component: () => import("../components/Admin/DangNhap.vue"),
    meta: { layout: "index" },
  },
  {
    path: "/dang-ky",
    component: () => import("../components/Admin/DangKy.vue"),
    meta: { layout: "index" },
  },
  // {
  //   path: "/admin/phan-quyen",
  //   component: () => import("../components/Admin/PhanQuyen/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/lien-he",
  //   component: () => import("../components/Admin/LienHe/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/binh-luan",
  //   component: () => import("../components/Admin/BinhLuan/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/dang-nhap",
  //   component: () => import("../components/Admin/DangNhap/index.vue"),
  //   meta: { layout: "blank" },
  // },
  // {
  //   path: "/admin/phuong-tien",
  //   component: () => import("../components/Admin/PhuongTien/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/voucher",
  //   component: () => import("../components/Admin/Voucher/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/thong-ke/khach-hang-dang-ky",
  //   component: () =>
  //     import("../components/Admin/ThongKe/TKKhachHangDangKy/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/nguoi-dung",
  //   component: () => import("../components/Admin/NguoiDung/index.vue"),
  //   beforeEnter: checkToken,
  // },
  // {
  //   path: "/admin/danh-muc-tour",
  //   component: () => import("../components/Admin/QLTour/DanhMucTour/index.vue"),
  //   beforeEnter: checkToken,
  // },

  //Staff
  // {
  //     path : '/staff/trang-chu',
  //     component: ()=>import('../components/Staff/TrangChu.vue'),
  //     meta: { layout: "staff" },
  // },

  //============= Customer ==================
  // {
  //   path: "/",
  //   component: () => import("../components/Customer/TrangChu/TrangChu.vue"),
  //   meta: { layout: "customer" },
  //   //beforeEnter: checkToken, // them guard
  // },
  // {
  //   path: "/lien-he",
  //   component: () => import("../components/Customer/LienHe/LienHe.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/gioi-thieu",
  //   component: () => import("../components/Customer/GioiThieu/GioiThieu.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/faqs",
  //   component: () => import("../components/Customer/Faqs/Faqs.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/chi-tiet-bai-viet/:id",
  //   component: () =>
  //     import("../components/Customer/ChiTietBV/ChiTietBaiViet.vue"),
  //   meta: { layout: "customer" },
  //   props: true,
  // },
  // {
  //   path: "/bai-viet",
  //   component: () => import("../components/Customer/BaiViet/BaiViet.vue"),
  //   meta: { layout: "customer" },
  //   props: true,
  // },
  // {
  //   path: "/tour-bac",
  //   component: () => import("../components/Customer/Tour/TourBac.vue"),
  //   meta: { layout: "customer" },
  //   //beforeEnter: checkToken,
  // },
  // {
  //   path: "/tour-nam",
  //   component: () => import("../components/Customer/Tour/TourNam.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/tour-trung",
  //   component: () => import("../components/Customer/Tour/TourTrung.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/tour-all",
  //   component: () => import("../components/Customer/Tour/AllTour.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/chi-tiet-tour/:id_tour",
  //   component: () =>
  //     import("../components/Customer/ChiTietTour/ChiTietTour.vue"),
  //   meta: { layout: "customer" },
  //   props: true,
  // },
  // {
  //   path: "/dat-tour/:id_tour",
  //   component: () => import("../components/Customer/Dattour/Dattour.vue"),
  //   meta: { layout: "customer" },
  //   props: true,
  // },
  // {
  //   path: "/lich-su-don-hang",
  //   component: () => import("../components/Customer/LichSuDonHang/LSDH.vue"),
  //   meta: { layout: "customer" },
  //   props: true,
  // },
  // {
  //   path: "/vnpay_return",
  //   component: () => import("../components/Customer/ThanhToan/index.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/chinh-sach-bao-mat",
  //   component: () =>
  //     import("../components/Customer/ChinhSachBaoMat/ChinhSachBaoMat.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/dieu-khoan-su-dung",
  //   component: () =>
  //     import("../components/Customer/DieuKhoanSD/DieuKhoanSD.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/dang-ky",
  //   component: () => import("../components/Customer/DangKy/index.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/kich-hoat/:hash_active",
  //   component: () => import("../components/Customer//KichHoat/index.vue"),
  //   meta: { layout: "blank" },
  //   props: true,
  // },

  // {
  //   path: "/dang-nhap",
  //   component: () => import("../components/Customer/DangNhap/index.vue"),
  //   meta: { layout: "customer" },
  // },
  // {
  //   path: "/quen-mat-khau",
  //   component: () => import("../components/Customer/QuenMatKhau/index.vue"),
  //   meta: { layout: "customer" },
  // },
  {
    path: "/staff",
    redirect: "/admin", // hoặc "/admin/trang-chu"
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
  scrollBehavior(to, from, savedPosition) {
    // Luôn cuộn lên đầu trang
    return { top: 0 };
  },
});

export default router;

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
});
// import { defineConfig } from "vite";
// import vue from "@vitejs/plugin-vue";

// // https://vitejs.dev/config/
// export default defineConfig({
//   plugins: [vue()],
//   server: {
//     // Cấu hình proxy để tránh CORS
//     proxy: {
//       "/api": {
//         target: "http://127.0.0.1:8000", // backend Laravel
//         changeOrigin: true,
//         secure: false, // nếu backend không dùng HTTPS
//       },
//     },
//   },
// });

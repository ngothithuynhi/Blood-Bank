<template>
    <div class="admin-layout">

        <!-- SIDEBAR -->
        <MenuAdmin class="sidebar" />

        <div class="main-area">

            <!-- HEADER -->
            <TopAdmin />

            <!-- CONTENT -->
            <div class="page-content content-wrapper" style="margin-top: 70px;">
                <router-view></router-view>
            </div>

            <!-- FOOTER -->
            <BotAdmin />
        </div>

    </div>
</template>

<script>
import TopAdmin from "../components/TopAdmin.vue";
import MenuAdmin from "../components/MenuAdmin.vue";
import BotAdmin from "../components/BotAdmin.vue";

// assets
import "../../assets/js/bootstrap.bundle.min.js";
import "../../assets/js/jquery.min.js";
import "../../assets/plugins/simplebar/js/simplebar.min.js";
import "../../assets/plugins/metismenu/js/metisMenu.min.js";
import "../../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js";
import "../../assets/js/index.js";
import "../../assets/js/app.js";
import "../../assets/js/pace.min.js";

export default {
    name: "App",
    components: { TopAdmin, MenuAdmin, BotAdmin }
}
</script>

<style>
/* import CSS như bạn đã làm ở trên */
</style>

<style>
.admin-layout {
    display: flex;
    width: 100%;
    min-height: 100vh;
    overflow: hidden;
    background: #f8fafc;
}

/* Sidebar cố định */
.sidebar {
    width: 250px;
    height: 100vh;
    background: #1e293b;
    flex-shrink: 0;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 99;
}

/* Vùng chính */
.main-area {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Nội dung trang */
.page-content {
    flex: 1;
    padding: 25px 35px;
    animation: fade .25s ease;
}

/* Animation mượt */
@keyframes fade {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

.content-wrapper {
  margin-left: 260px;
  padding: 20px;
  width: calc(100% - 260px); /* giữ cho nội dung không tràn */
}


</style>

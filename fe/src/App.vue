<template>
  <component :is="layout">
    <router-view></router-view>
  </component>

  <div
    v-if="!isAdminPage"
    id="button-contact-vr"
    style="position: fixed; bottom: 20px; left: 20px; z-index: 9999;"
  >
    <div class="phone-vr">
      <div class="pulse facebook"></div>
      <div class="icon-box">
        <a target="_blank" href="https://www.facebook.com/thuynhi.1205">
          <img
            alt="Fanpage"
            src="https://logos-world.net/wp-content/uploads/2023/08/Facebook-Logo.png"
          />
        </a>
      </div>
    </div>

    <div class="phone-vr">
      <div class="pulse zalo"></div>
      <div class="icon-box">
        <a target="_blank" href="https://zalo.me/0369636310">
          <img
            alt="Zalo"
            src="https://cdn.freebiesupply.com/logos/large/2x/zalo-1-logo-png-transparent.png"
          />
        </a>
      </div>
    </div>

    <div class="phone-vr">
      <div class="pulse phone"></div>
      <div class="icon-box">
        <a href="tel:0369636310">
          <img
            alt="Phone"
            src="https://media.istockphoto.com/id/971654072/vector/red-call-icon.jpg?s=612x612&w=0&k=20&c=bwlNm0pnNs98evZv4x8N3Cq3XQAWIKLEzJPmQpbMgWY="
          />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
const default_layout = 'default'

export default {
  computed: {
    layout() {
      return (this.$route.meta.layout || default_layout) + '-layout'
    },

    isAdminPage() {
      return (
        this.$route.meta.layout === 'admin' ||
        this.$route.path.startsWith('/admin')
      )
    }
  }
}
</script>

<style>
@keyframes pulse {
  0% {
    transform: scale(0.9);
    opacity: 0.7;
  }

  70% {
    transform: scale(1.1);
    opacity: 0.3;
  }

  100% {
    transform: scale(0.9);
    opacity: 0.7;
  }
}

a {
  text-decoration: none !important;
}

.phone-vr {
  position: relative;
  width: 70px;
  height: 70px;
  margin-bottom: 15px;
  cursor: pointer;
}

.pulse {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  position: absolute;
  inset: 0;
  animation: pulse 1.5s infinite;
}

.pulse.facebook {
  background-color: rgba(59, 89, 152, 0.3);
}

.pulse.zalo {
  background-color: rgba(0, 120, 255, 0.3);
}

.pulse.phone {
  background-color: rgba(255, 0, 0, 0.3);
}

.icon-box {
  width: 50px;
  height: 50px;
  background: #fff;
  border-radius: 50%;
  position: absolute;
  top: 10px;
  left: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.icon-box img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
</style>
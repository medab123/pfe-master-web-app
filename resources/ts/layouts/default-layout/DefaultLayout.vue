<template>
  <!--begin::App-->
  <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
      <KTHeader />
      <!--begin::Wrapper-->
      <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
        <KTSidebar />
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
          <!--begin::Content wrapper-->
          <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <slot />
            </div>
          </div>
          <!--end::Content wrapper-->
          <KTFooter />
        </div>
        <!--end:::Main-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::App-->

  <KTDrawers />
  <KTScrollTop />
  <KTModals />
  <KTCustomize />
</template>

<script lang="ts">
import {
  defineComponent,
  nextTick,
  onBeforeMount,
  onMounted,
  watch,
} from "vue";
import KTHeader from "@/layouts/default-layout/components/header/Header.vue";
import KTSidebar from "@/layouts/default-layout/components/sidebar/Sidebar.vue";
import KTContent from "@/layouts/default-layout/components/content/Content.vue";
import KTToolbar from "@/layouts/default-layout/components/toolbar/Toolbar.vue";
import KTFooter from "@/layouts/default-layout/components/footer/Footer.vue";
import KTDrawers from "@/layouts/default-layout/components/drawers/Drawers.vue";
import KTModals from "@/layouts/default-layout/components/modals/Modals.vue";
import KTScrollTop from "@/layouts/default-layout/components/extras/ScrollTop.vue";
import KTCustomize from "@/layouts/default-layout/components/extras/Customize.vue";
import { useRoute } from "vue-router";
import { reinitializeComponents } from "@/core/plugins/keenthemes";
import LayoutService from "@/core/services/LayoutService";

export default defineComponent({
  name: "default-layout",
  components: {
    KTHeader,
    KTSidebar,
    KTContent,
    KTToolbar,
    KTFooter,
    KTDrawers,
    KTScrollTop,
    KTModals,
    KTCustomize,
  },
  setup() {
    const route = useRoute();

    onBeforeMount(() => {
      LayoutService.init();
    });

    onMounted(() => {
      nextTick(() => {
        reinitializeComponents();
      });
    });
  },
});
</script>


<style lang="scss">
@import "bootstrap-icons/font/bootstrap-icons.css";
@import "apexcharts/dist/apexcharts.css";
@import "quill/dist/quill.snow.css";
@import "animate.css";
@import "sweetalert2/dist/sweetalert2.css";
@import "nouislider/dist/nouislider.css";
@import "@fortawesome/fontawesome-free/css/all.min.css";
@import "socicon/css/socicon.css";
@import "line-awesome/dist/line-awesome/css/line-awesome.css";
@import "dropzone/dist/dropzone.css";
@import "@vueform/multiselect/themes/default.css";
@import "prism-themes/themes/prism-shades-of-purple.css";
@import "element-plus/dist/index.css";

// Main demo style scss
@import "@/assets/keenicons/duotone/style.css";
@import "@/assets/keenicons/outline/style.css";
@import "@/assets/keenicons/solid/style.css";
@import "@/assets/sass/element-ui.dark";
@import "@/assets/sass/plugins";
@import "@/assets/sass/style";

#app {
    display: contents;
}
</style>

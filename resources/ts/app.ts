import {createApp, h} from "vue";
import {createPinia} from "pinia";
import {Tooltip} from "bootstrap";
import App from "./App.vue";

/*
TIP: To get started with clean router change path to @/router/clean.ts.
 */
import router from "./router";
import ElementPlus from "element-plus";
import i18n from "@/core/plugins/i18n";

//imports for app initialization
import ApiService from "@/core/services/ApiService";
import {initApexCharts} from "@/core/plugins/apexcharts";
import {initInlineSvg} from "@/core/plugins/inline-svg";
import {initVeeValidate} from "@/core/plugins/vee-validate";
import {initKtIcon} from "@/core/plugins/keenthemes";
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import "@/core/plugins/prismjs";
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';


createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue', {eager: true})),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)});

        app.use(plugin);
        app.use(createPinia());
        app.use(ElementPlus);
        app.use(ZiggyVue);
        app.use(i18n);

        ApiService.init(app);
        initApexCharts(app);
        initInlineSvg(app);
        initKtIcon(app);
        initVeeValidate();

        app.directive('tooltip', (el) => {
            new Tooltip(el);
        });

        app.mount(el);

    },
});

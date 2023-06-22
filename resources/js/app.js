import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import { Ziggy, ZiggyVue, route } from 'ziggy';
import 'flowbite';

InertiaProgress.init();

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueTailwindDatepicker)
            .mount(el);
    },
});

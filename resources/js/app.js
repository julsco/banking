import './bootstrap';
import 'quasar/dist/quasar.css'
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import {Quasar, Notify, Loading} from 'quasar'
import quasarIconSet from 'quasar/icon-set/fontawesome-v6'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Quasar, {
                    iconSet: quasarIconSet,
                    plugins: {
                        Notify,
                        Loading,
                    },
                }
            )
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

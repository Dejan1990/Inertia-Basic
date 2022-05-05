import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Layout from "./Shared/Layout";

InertiaProgress.init({
  showSpinner: true,
})

createInertiaApp({
  resolve: async name => {
    let page = (await import(`./Pages/${name}`)).default;

    /*if (!page.layout) {
      page.layout = Layout
    }*/

    page.layout ??= Layout;

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .mount(el)
  },
})



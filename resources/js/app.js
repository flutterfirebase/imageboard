import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Vue from 'vue'
import PortalVue from 'portal-vue'

window._ = require('lodash')

Vue.mixin({ methods: { route } })
Vue.use(plugin)
Vue.use(PortalVue)

InertiaProgress.init()

const el = document.getElementById('app')

new Vue({
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)
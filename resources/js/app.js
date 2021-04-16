import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Vue from 'vue'
import PortalVue from 'portal-vue'
import Meta from 'vue-meta'

window._ = require('lodash')
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

Vue.mixin({ methods: { route } })
Vue.use(plugin)
Vue.use(PortalVue)
Vue.use(Meta, {
    keyName: 'meta',
})

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

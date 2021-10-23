import Vue from 'vue'
import { ToastPlugin, ModalPlugin } from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'
import Cookies from 'js-cookie'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

import i18n from '@/libs/i18n'
import router from './router'
import store from './store'
import App from './App.vue'

// Global Components
import './global-components'

// 3rd party plugins
// import '@axios'
import '@/libs/acl'
import '@/libs/portal-vue'
import '@/libs/clipboard'
import '@/libs/toastification'
import '@/libs/sweet-alerts'
import '@/libs/vue-select'
import '@/libs/tour'

//app global config
import appConfig from './appConfig'

// BSV Plugin Registration
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)

// Composition API
Vue.use(VueCompositionAPI)

// Feather font icon - For form-wizard
// * Shall remove it if not using font-icons of feather-icons - For form-wizard
require('@core/assets/fonts/feather/iconfont.css') // For form-wizard

// import core styles
require('@core/scss/core.scss')

// import assets styles
require('@/assets/scss/style.scss')

Vue.config.productionTip = false

new Vue({
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app')

window.axios = require('axios')
window.axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

Pusher.logToConsole = true;

let authorizer = (channel, options) => {
  return {
    authorize: (socketId, callback) => {
      window.axios.post(appConfig.apiBaseUrl + 'auth/get_auth', {
        socket_id: socketId,
        channel_name: channel.name
      }, {
        headers: {
          Authorization: Cookies.get('token') ? `Bearer ${Cookies.get('token')}` : null,
          'Content-Type': 'application/json'
        }
      })
        .then(res => {
          callback(null, JSON.parse(res.data))
        })
        .catch(err => {
          callback(null, null);
        });
    }
  }
}

window.Echo = new Echo({
  broadcaster: appConfig.BROADCAST_DRIVER,
  key: appConfig.PUSHER_APP_KEY,
  cluster: appConfig.PUSHER_APP_CLUSTER,
  useTLS: false,
  encrypted: false,
  enabledTransports: ['ws'],
  authorizer: authorizer
});

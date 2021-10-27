import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'

//wbc main
import auth from './auth'
import common from './common'
import qa from './qa'
Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    app,
    appConfig,
    verticalMenu,
    auth,
    common,
    qa
  },
  strict: process.env.DEV,
})

import axios from 'axios'
import * as types from '../mutation-types'
import Cookies from 'js-cookie'
import appConfig from '@/appConfig'
import router from '@/router'

const {apiBaseUrl} = appConfig

export default {
  namespaced: true,
  state: {
    departments: []
  },
  getters: {
    departments: state => state.departments
  },
  mutations: {
    [types.SET_DEPARTMENTS] (state, {departments}) {
      state.departments = departments
    }
  },
  actions: {
    async getDepartments ({commit, state}) {
      try {
        const {data} = await axios.get(apiBaseUrl + 'departments', {headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}})
        console.log(data)
        if (data.success) {
          commit(types.SET_DEPARTMENTS, {departments: data.msg.departments})
        } else {

        }
      } catch (error) {
        commit('auth/'+ types.LOGOUT)
      }
    }
  }
}
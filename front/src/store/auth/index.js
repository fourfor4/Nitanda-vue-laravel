import axios from 'axios'
import * as types from '../mutation-types'
import Cookies from 'js-cookie'
import appConfig from '@/appConfig'

import router from '@/router'
import Toast from '@/Modules/common-layouts/toast/Toast'

const {apiBaseUrl} = appConfig

export default {
  namespaced: true,
  state: {
    current_user: null,
    token: Cookies.get('token'),
    logged: false,
    newUser: {
      avatar_url: '',
      employee_name: '',
      employee_id: '',
      login_id: '',
      password: '',
      hire_date: '',
      leave_date: '',
      department_id: 0,
      role: 0,
      grade: '',
      note: '',
      mygoal: '',
      affiliation: ''
    }
  },
  getters: {
    current_user: state => state.current_user,
    token: state => state.token,
    check: state => state.user !== null,
    newUser: state => state.newUser
  },
  mutations: {
    [types.SAVE_TOKEN] (state, { token }) {
      state.token = token
      state.logged = true
      localStorage.setItem('token', token)
      localStorage.setItem('logged', true)
    },
  
    [types.SET_CURRENT_USER] (state, { user }) {
      state.current_user = user
    },
  
    [types.LOGOUT] (state) {
      state.user = null
      state.token = null
      localStorage.removeItem('token')
      localStorage.removeItem('logged')
      router.push('/login')
    },

    [types.SET_NEW_USER] (state) {
      console.log('setnewuser')
      state.newUser = {
        avatar_url: '',
        employee_name: '',
        employee_id: '',
        login_id: '',
        password: '',
        hire_date: '',
        leave_date: '',
        department_id: 0,
        role: 0,
        grade: '',
        note: '',
        mygoal: '',
        affiliation: ''
      }
    }
  },
  actions: {
    async getUser ({ commit, state }) {
      try {
        const { data } = await axios.get(apiBaseUrl + 'auth/get_user', {headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}})
        console.log(data)
        if (data.success) {
          console.log(data.msg.token)
          commit(types.SET_CURRENT_USER, { user: data.msg.user })
        } else {
          commit(types.LOGOUT)
        }
      } catch (e) {
        commit(types.LOGOUT)
      }
    },

    async logout ({ commit }) {
      try {
        const { data } = await axios.post(apiBaseUrl + 'auth/logout')
        console.log(data)
      } catch (e) { 
      }
      commit(types.LOGOUT)
    },

    async registerUser ({commit, state}, payload){
      try {
        let formData = new FormData()
        Object.keys(state.newUser).forEach(key => {
          formData.append(key, state.newUser[key])
        })
        const { data } = await axios.post(apiBaseUrl + "auth/register", formData, {
          headers: {
            'Content-Type': "multipart/form-data"
          }
        })
        if(data.success){
          console.log(data)
          commit(types.SET_NEW_USER)
        } else {

        }
      } catch (error) {
        commit(types.LOGOUT)
      }
    },

    async loginUser ({commit}, payload){
      try {
        const res = await axios.post(apiBaseUrl + "auth/login", payload);
        if (res.data.success) {
          commit(types.SAVE_TOKEN, {token:res.data.msg.access_token, remember:true});
          commit(types.SET_CURRENT_USER, {user:res.data.msg.user});
          router.push('/')
          Toast()
        }
      } catch (error) {
        
      }
    }
  }
}
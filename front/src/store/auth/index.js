import axios from 'axios'
import * as types from '../mutation-types'
import Cookies from 'js-cookie'
import appConfig from '@/appConfig'

import router from '@/router'
import store from '@/store'
import Vue from 'vue'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

const {apiBaseUrl} = appConfig

export default {
  namespaced: true,
  state: {
    current_user: null,
    token: localStorage.getItem('token'),
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
      role_id: null,
      grade: '',
      note: '',
      mygoal: '',
      affiliation: '',
      preview: null
    },
    userList: [],
    editUser: {
      avatar_url: '',
      employee_name: '',
      employee_id: '',
      login_id: '',
      password: '',
      hire_date: '',
      leave_date: '',
      department_id: 0,
      role_id: null,
      grade: '',
      note: '',
      mygoal: '',
      affiliation: '',
      preview: null
    }
  },
  getters: {
    current_user: state => state.current_user,
    token: state => state.token,
    check: state => state.user !== null,
    newUser: state => state.newUser,
    userList: state => state.userList,
    editUser: state => state.editUser
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
        affiliation: '',
        preview: null
      }
    },
    
    [types.SET_USER_LIST] (state, {userList}) {
      state.userList = userList
    },

    [types.SET_EDIT_USER] (state, {editUser}) {
      console.log(editUser)
      Object.keys(editUser).forEach(key => {
        if (editUser[key] == null) {
          editUser[key] = ''
        }
      })
      state.editUser = { ...editUser, preview: null, newPassword: '', confirmPassword: ''}
    }
  },
  
  actions: {
    async retrieveUser ({ commit, state }) {
      try {
        const { data } = await axios.get(apiBaseUrl + 'auth/retrieve_user', {headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}})
        if (data.success) {
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
      } catch (e) { 
      }
      commit(types.LOGOUT)
    },

    async retrieveUserList({ commit, state }) {
      try {
        const { data } = await axios.get(apiBaseUrl + 'auth/retrieve_user_list', {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
        })
        if (data.success) {
          commit(types.SET_USER_LIST, { userList: data.msg.userList })
        } else {

        }
      } catch (error) {
        commit(types.LOGOUT)
      }
    },

    async retrieveUserById({ commit, state }, payload) {
      console.log(payload)
      try {
        const { data } = await axios.post(apiBaseUrl + 'auth/retrieve_user_byid', {
          userid: payload
        }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
        })
        if (data.success) {
          commit(types.SET_EDIT_USER, { editUser: data.msg.user })
        } else {

        }
      } catch (error) {
        commit(types.LOGOUT)
      }
    },

    async registerUser ({commit, state}){
      try {
        let formData = new FormData()
        Object.keys(state.newUser).forEach(key => {
          formData.append(key, state.newUser[key])
        })
        const { data } = await axios.post(apiBaseUrl + "auth/register", formData, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': "multipart/form-data"
          }
        })
        if(data.success){
          commit(types.SET_NEW_USER)
          Vue.$toast({
            component: ToastificationContent,
            position: 'top-right',
            props: {
              title: `成功`,
              icon: 'CoffeeIcon',
              variant: 'success',
              text: `ユーザー登録は成功です。`,
            },
          })
          if (router.history.current.path == '/user/list') {
            store.dispatch('auth/retrieveUserList')
          }
        } else {
          var error = JSON.parse(data.error[0])
          if (error.employee_id) {
            Vue.$toast({
              component: ToastificationContent,
              position: 'top-right',
              props: {
                title: 'The user with same employee_id is exsited already!',
                icon: 'CoffeeIcon',
                variant: 'warning',
              },
            })
          }
          if (error.login_id) {
            Vue.$toast({
              component: ToastificationContent,
              position: 'top-right',
              props: {
                title: 'The user with same login_id is exsited already!',
                icon: 'CoffeeIcon',
                variant: 'warning',
              },
            })
          }
        }
      } catch (error) {
        commit(types.LOGOUT)
      }
    },

    async updateUser ({commit, state}){
      try {
        let formData = new FormData()
        Object.keys(state.editUser).forEach(key => {
          formData.append(key, state.editUser[key])
        })
        const { data } = await axios.post(apiBaseUrl + "auth/update_user", formData, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': "multipart/form-data"
          }
        })
        if(data.success){
          router.push('/user/list')
          Vue.$toast({
            component: ToastificationContent,
            position: 'top-right',
            props: {
              title: `成功`,
              icon: 'CoffeeIcon',
              variant: 'success',
              text: `ユーザーが正常に更新されました。`,
            },
          })
        } else {
          var error = data.error
          if (error.employee_id) {
            Vue.$toast({
              component: ToastificationContent,
              position: 'top-right',
              props: {
                title: 'The user with same employee_id is exsited already!',
                icon: 'CoffeeIcon',
                variant: 'warning',
              },
            })
          }
          if (error.login_id) {
            Vue.$toast({
              component: ToastificationContent,
              position: 'top-right',
              props: {
                title: 'The user with same login_id is exsited already!',
                icon: 'CoffeeIcon',
                variant: 'warning',
              },
            })
          }
        }
      } catch (error) {
        commit(types.LOGOUT)
      }
    },

    async deleteUser({commit, state}, payload) {
      try {
        const { data } = await axios.post(apiBaseUrl + "auth/delete_user", {
          userid: payload
        }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
        })
        console.log(data)
        if (data.success) {
          store.dispatch('auth/retrieveUserList')
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
          Vue.$toast({
            component: ToastificationContent,
            position: 'top-right',
            props: {
              title: `いらっしゃいませ`,
              icon: 'CoffeeIcon',
              variant: 'success',
              text: `正常にログインしました。`,
            },
          })
          router.push('/')
        } else {
          Vue.$toast({
            component: ToastificationContent,
            position: 'top-right',
            props: {
              title: `いらっしゃいませ`,
              icon: 'CoffeeIcon',
              variant: 'danger',
              text: `ログインに失敗しました。`,
            },
          })
        }
      } catch (error) {
        Vue.$toast({
          component: ToastificationContent,
          position: 'top-right',
          props: {
            title: `いらっしゃいませ`,
            icon: 'CoffeeIcon',
            variant: 'danger',
            text: `ログインに失敗しました。`,
          },
        })
      }
    }
  }
}
<template>
  <b-sidebar
    id="add-new-user-sidebar"
    :visible="isAddNewUserSidebarActive"
    bg-variant="white"
    sidebar-class="sidebar-lg"
    shadow
    backdrop
    no-header
    right
    @hidden="resetForm"
    @change="(val) => $emit('update:is-add-new-user-sidebar-active', val)"
  >
    <template #default="{ hide }">
      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center content-sidebar-header px-2 py-1">
        <h5 class="mb-0">
          新しいユーザーを追加
        </h5>
        <feather-icon
          class="ml-1 cursor-pointer"
          icon="XIcon"
          size="16"
          @click="hide"
        />
      </div>
      <div class="p-2">
        <b-form @submit.prevent>
          <b-row>
            <b-col md="12">
              <b-form-group
                label="社員ID"
                label-for="employee_id"
              >
                <b-form-input
                  id="employee_id"
                  placeholder="社員ID"
                  v-model="newUser.employee_id"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="ユーザ名"
                label-for="employee_name"
              >
                <b-form-input
                  id="employee_name"
                  placeholder="ユーザ名"
                  v-model="newUser.employee_name"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="ログインID"
                label-for="login_id"
              >
                <b-form-input
                  id="login_id"
                  placeholder="ログインID"
                  v-model="newUser.login_id"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
            </b-col>
            <b-col md="12">
              <b-form-group
                label="パスワード"
                label-for="password"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="password"
                    :type="passwordFieldType"
                    placeholder="パスワード"
                    v-model="newUser.password"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIcon"
                      class="cursor-pointer"
                      @click="togglePasswordVisibility"
                    />
                  </b-input-group-append>
                </b-input-group>
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="パスワードを認証する"
                label-for="confirmPassword"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="confirmPassword"
                    :type="passwordFieldType"
                    placeholder="パスワードを認証する"
                    v-model="newUser.confirmPassword"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIcon"
                      class="cursor-pointer"
                      @click="togglePasswordVisibility"
                    />
                  </b-input-group-append>
                </b-input-group>
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="入社日"
                label-for="hire_date"
              >
                <b-form-datepicker
                  id="hire_date"
                  placeholder="入社日"
                  :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                  locale="ja"
                  v-model="newUser.hire_date"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="退社日"
                label-for="leave_date"
              >
                <b-form-datepicker
                  id="leave_date"
                  placeholder="退社日"
                  :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                  locale="ja"
                  v-model="newUser.leave_date"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="所属部署"
                label-for="department"
              >
                <b-form-select
                  id="department"
                  placeholder="所属部署"
                  v-model="newUser.department_id"
                >
                  <option value="0"></option>
                  <option
                    v-for="department in common_states.departments"
                    :key="department.id"
                    :value="department.id"
                  >
                    {{department.department_name}}
                  </option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="役職"
                label-for="role_id"
              >
                <b-form-select
                  id="role_id"
                  v-model="newUser.role_id"
                  placeholder="所属部署"
                >
                  <option
                    v-for="role in common_states.roles"
                    :key="role.id"
                    :value="role.id"
                  >
                    {{role.role_name}}
                  </option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="等級"
                label-for="grade"
              >
                <b-form-input
                  id="grade"
                  placeholder="等級"
                  v-model="newUser.grade"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="所属サークル"
                label-for="affiliation"
              >
                <b-form-input
                  id="affiliation"
                  placeholder="所属サークル"
                  v-model="newUser.affiliation"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="備考"
                label-for="note"
              >
                <b-form-textarea
                  id="note"
                  placeholder="備考"
                  rows="10"
                  v-model="newUser.note"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group
                label="自分の目標"
                label-for="mygoal"
              >
                <b-form-textarea
                  id="mygoal"
                  placeholder="自分の目標"
                  rows="10"
                  v-model="newUser.mygoal"
                />
              </b-form-group>
            </b-col>
            <b-col cols="12" class="mt-1">
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                type="submit"
                variant="primary"
                class="mr-1"
                @click="register"
              >
                登録
              </b-button>
              <b-button
                v-ripple.400="'rgba(186, 191, 199, 0.15)'"
                type="reset"
                variant="outline-secondary"
              >
                破棄
              </b-button>
            </b-col>
          </b-row>
        </b-form>
      </div>
    </template>
  </b-sidebar>
</template>

<script>
import {
  BSidebar,
  BForm,
  BFormGroup,
  BFormInput,
  BButton,
  BFormSelect, 
  BInputGroup,
  BInputGroupAppend,
  BFormTextarea,
  BFormDatepicker,
  BRow,
  BCol
} from 'bootstrap-vue'
import { ref } from '@vue/composition-api'
import Ripple from 'vue-ripple-directive'
import ToastificationContentVue from '@/@core/components/toastification/ToastificationContent.vue'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import { mapGetters } from 'vuex'

export default {
  components: {
    BSidebar,
    BForm,
    BFormGroup,
    BFormInput,
    BButton,
    BFormSelect, 
    BInputGroup,
    BInputGroupAppend,
    BFormTextarea,
    BFormDatepicker,
    BRow,
    BCol
  },
  mixins: [togglePasswordVisibility],
  directives: {
    Ripple,
  },
  model: {
    prop: 'isAddNewUserSidebarActive',
    event: 'update:is-add-new-user-sidebar-active',
  },
  props: {
    isAddNewUserSidebarActive: {
      type: Boolean,
      required: true,
    },
  },
  computed: {
    ...mapGetters({
      common_states: 'common/common_states',
      newUser: 'auth/newUser'
    }),
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  data() {
    return {
    }
  },
  setup() {
    const passwordFieldType = 'password'
    return {
      passwordFieldType
    }
  },
  mounted() {
    this.$store.commit('auth/SET_NEW_USER')
  },
  methods: {
    resetForm() {
      this.$store.commit('auth/SET_NEW_USER')
    },
    validateUserRegister(user) {
      var validateMsg = ''
      var returnVal = false
      if (user.employee_id == '') {
        validateMsg = '従業員IDフィールドに入力する必要があります。'
      } else if (user.login_id == '') {
        validateMsg = 'ログインIDフィールドに入力する必要があります。'
      } else if (user.employee_name == '') {
        validateMsg = '従業員名フィールドに入力する必要があります。'
      } else if (user.password == '') {
        validateMsg = 'パスワードフィールドに入力する必要があります。'
      } else if (user.role_id == null) {
        validateMsg = 'ロールIDフィールドに入力する必要があります。'
      } else if (user.password != user.confirmPassword) {
        validateMsg = 'パスワードを確認する必要があります。'
      } else {
        returnVal = true
      }
      return {
        msg: validateMsg,
        validate: returnVal
      }
    },
    register: function() {
      if (this.validateUserRegister(this.newUser).validate == true) {
        this.$swal({
          title: '本当にユーザーを作成しますか？',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'はい、そうです。',
          cancelButtonText: 'いいえ。',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1',
          },
          buttonsStyling: false,
        }).then(result => {
          if (result.value) {
            this.$store.dispatch('auth/registerUser')
          }
        })
      } else {
        this.$toast({
          component: ToastificationContentVue,
          position: 'top-right',
          props: {
            title: this.validateUserRegister(this.newUser).msg,
            icon: 'CoffeeIcon',
            variant: 'danger',
          },
        })
      }
    },
  }
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';

#add-new-user-sidebar {
  .vs__dropdown-menu {
    max-height: 200px !important;
  }
}
</style>

<template>
  <section id="wbc-register">
    <b-row>
      <b-col cols="12">
        <b-card no-body>
          <b-card-header class="border-bottom">
            <div class="w-100 d-flex align-items-center justify-content-between">
              <b-card-title>
                新規ユーザ登録
              </b-card-title>
              <b-button
                variant="primary"
                to="/user/list"
              >
                ユーザーリストへ
              </b-button>
            </div>
          </b-card-header >
          <b-card-body class="mt-2">
            <b-row class="mb-2">
              <b-col sm="6" md="3">
                <b-img v-if="editUser.avatar_url" :src="appConfig.serverUrl + editUser.avatar_url" rounded class="w-100" />
                <b-img v-if="!editUser.avatar_url && !editUser.preview" :src="require('@/assets/images/avatars/default.png')" rounded class="w-100" />
                <b-img v-if="editUser.preview" :src="editUser.preview" rounded class="w-100" />
              </b-col>
              <b-col sm="6" md="3" class="d-flex align-items-end mt-75 ms-1">
                <div>
                  <label for="user-avatar-upload" class="btn btn-sm btn-primary mb-75 mr-1">アップロード</label>
                  <input type="file" @change="previewImage" id="user-avatar-upload" hidden accept="image/*" />
                  <b-button
                    variant="outline-primary"
                    size="sm"
                    class="mb-75"
                    @click="resetImage"
                  >
                    リセット
                  </b-button>
                  <p class="mb-0">許可されるファイルタイプ: png, jpg, jpeg.</p>
                </div>
              </b-col>
            </b-row>
            <b-form @submit.prevent>
              <b-row>
                <b-col md="6">
                  <b-form-group
                    label="社員ID"
                    label-for="employee_id"
                  >
                    <b-form-input
                      id="employee_id"
                      placeholder="社員ID"
                      v-model="editUser.employee_id"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="ユーザ名"
                    label-for="employee_name"
                  >
                    <b-form-input
                      id="employee_name"
                      placeholder="ユーザ名"
                      v-model="editUser.employee_name"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="ログインID"
                    label-for="login_id"
                  >
                    <b-form-input
                      id="login_id"
                      placeholder="ログインID"
                      v-model="editUser.login_id"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="新しいパスワード"
                    label-for="newPassword"
                  >
                    <b-input-group class="input-group-merge">
                      <b-form-input
                        id="newPassword"
                        :type="passwordFieldType"
                        placeholder="新しいパスワード"
                        v-model="editUser.newPassword"
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
                <b-col md="6">
                  <b-form-group
                    label="パスワードを認証する"
                    label-for="confirmPassword"
                  >
                    <b-input-group class="input-group-merge">
                      <b-form-input
                        id="confirmPassword"
                        :type="passwordFieldType"
                        placeholder="パスワードを認証する"
                        v-model="editUser.confirmPassword"
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
                <b-col md="6">
                  <b-form-group
                    label="入社日"
                    label-for="hire_date"
                  >
                    <b-form-datepicker
                      id="hire_date"
                      placeholder="入社日"
                      :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                      locale="ja"
                      v-model="editUser.hire_date"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="退社日"
                    label-for="leave_date"
                  >
                    <b-form-datepicker
                      id="leave_date"
                      placeholder="退社日"
                      :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                      locale="ja"
                      v-model="editUser.leave_date"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="所属部署"
                    label-for="department"
                  >
                    <b-form-select
                      id="department"
                      placeholder="所属部署"
                      v-model="editUser.department_id"
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
                <b-col md="6">
                  <b-form-group
                    label="役職"
                    label-for="role_id"
                  >
                    <b-form-select
                      id="role_id"
                      v-model="editUser.role_id"
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
                <b-col md="6">
                  <b-form-group
                    label="等級"
                    label-for="grade"
                  >
                    <b-form-input
                      id="grade"
                      placeholder="等級"
                      v-model="editUser.grade"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="所属サークル"
                    label-for="affiliation"
                  >
                    <b-form-input
                      id="affiliation"
                      placeholder="所属サークル"
                      v-model="editUser.affiliation"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="備考"
                    label-for="note"
                  >
                    <b-form-textarea
                      id="note"
                      placeholder="備考"
                      rows="10"
                      v-model="editUser.note"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="自分の目標"
                    label-for="mygoal"
                  >
                    <b-form-textarea
                      id="mygoal"
                      placeholder="自分の目標"
                      rows="10"
                      v-model="editUser.mygoal"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="12" class="mt-1">
                  <b-button
                    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                    type="submit"
                    variant="primary"
                    class="mr-1"
                    @click="update"
                  >
                    アップデート
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
          </b-card-body>
        </b-card>
      </b-col>
    </b-row>
  </section>
</template>

<script>
import { 
  BRow, 
  BCol, 
  BCard, 
  BCardHeader, 
  BCardBody, 
  BCardTitle, 
  BButton, 
  BFormInput, 
  BInputGroup,
  BInputGroupAppend,
  BFormGroup, 
  BFormSelect, 
  BForm, 
  BFormTextarea,
  BImg,
  BFormDatepicker,
  BAvatar
} from 'bootstrap-vue'

import Ripple from 'vue-ripple-directive'
import { mapGetters } from 'vuex'
import ToastificationContentVue from '@/@core/components/toastification/ToastificationContent.vue'
import appConfig from '@/appConfig'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'

export default {
  components: {
    BRow,
    BCol,
    BCard,
    BCardHeader,
    BCardBody,
    BCardTitle,
    BButton,
    BFormInput,
    BFormGroup,
    BInputGroup,
    BInputGroupAppend,
    BFormSelect,
    BFormTextarea,
    BForm,
    BImg,
    BFormDatepicker,
    BAvatar
  },
  mixins: [togglePasswordVisibility],
  directives: {
    Ripple
  },
  computed: {
    ...mapGetters({
      common_states: 'common/common_states',
      editUser: 'auth/editUser',
    }),
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  setup() {
    return {
      appConfig
    }
  },
  methods: {
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
      } else if (user.newPassword != '' && user.newPassword != user.confirmPassword) {
        validateMsg = 'パスワードを確認する必要があります。'
      } else {
        returnVal = true
      }
      return {
        msg: validateMsg,
        validate: returnVal
      }
    },
    update: function() {
      if (this.validateUserRegister(this.editUser).validate == true) {
        this.$swal({
          title: '本当にユーザーを更新しますか？',
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
            this.$store.dispatch('auth/updateUser')
          }
        })
      } else {
        this.$toast({
          component: ToastificationContentVue,
          position: 'top-right',
          props: {
            title: this.validateUserRegister(this.editUser).msg,
            icon: 'CoffeeIcon',
            variant: 'danger',
          },
        })
      }
    },
    previewImage: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.editUser.preview = e.target.result;
        }
        this.editUser.avatar_url = ''
        this.editUser.avatar=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
    resetImage: function() {
      console.log(this.editUser)
      this.editUser.preview = null
      this.editUser.avatar = null
      this.editUser.avatar_url = ''
    }
  },
  mounted() {
    const userId = this.$route.params.userId
    this.$store.dispatch('auth/retrieveUserById', userId)
  }
}
</script>

<style lang="scss">
</style>

<template>
  <section id="wbc-register">
    <b-row>
      <b-col cols="12">
        <b-card no-body>
          <b-card-header class="border-bottom">
            <b-card-title>
              新規ユーザ登録
            </b-card-title>
          </b-card-header >
          <b-card-body class="mt-2">
            <div class="d-flex mb-2">
              <b-img v-if="!preview" :src="require('@/assets/images/avatars/9.png')" rounded class="mr-2" width="300" height="300" />
              <b-img v-if="preview" :src="preview" rounded class="mr-2" width="300" height="300" />
              <div class="d-flex align-items-end mt-75 ms-1">
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
              </div>
            </div>
            <b-form @submit.prevent>
              <b-row>
                <b-col md="6">
                  <b-form-group
                    label="社員ID（ログインID）"
                    label-for="employee_id"
                  >
                    <b-form-input
                      id="employee_id"
                      placeholder="社員ID"
                      v-model="newUser.employee_id"
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
                      v-model="newUser.employee_name"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="メールアドレス"
                    label-for="login_id"
                  >
                    <b-form-input
                      id="login_id"
                      placeholder="メールアドレス"
                      v-model="newUser.login_id"
                    />
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group
                    label="パスワード"
                    label-for="password"
                  >
                    <b-form-input
                      id="password"
                      placeholder="パスワード"
                      v-model="newUser.password"
                    />
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
                      v-model="newUser.hire_date"
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
                      v-model="newUser.leave_date"
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
                      v-model="newUser.department_id"
                    >
                      <option value="0"></option>
                      <option
                        v-for="department in departments"
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
                    label-for="director"
                  >
                    <b-form-select
                      id="director"
                      v-model="newUser.role"
                      placeholder="所属部署"
                      :options="roleOptions"
                    >
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
                      v-model="newUser.grade"
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
                      v-model="newUser.affiliation"
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
                      v-model="newUser.note"
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
  BFormGroup, 
  BFormSelect, 
  BForm, 
  BFormTextarea,
  BImg,
  BFormDatepicker
} from 'bootstrap-vue'
import vSelect from 'vue-select'
import Ripple from 'vue-ripple-directive'
import { mapGetters } from 'vuex'

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
    BFormSelect,
    BFormTextarea,
    BForm,
    BImg,
    BFormDatepicker,

    vSelect
  },
  directives: {
    Ripple
  },
  computed: {
    ...mapGetters({
      departments: 'common/departments',
      newUser: 'auth/newUser'
    }),
  },
  methods: {
    register() {
      this.$store.dispatch('auth/registerUser')
    },
    previewImage: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.preview = e.target.result;
        }
        this.newUser.avatar=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
    resetImage: function() {
      this.preview = null
      this.newUser.avatar = null
    }
  },
  setup() {
    const roleOptions = [
      {
        value: 0,
        text: 'admin'
      },
      {
        value: 1,
        text: 'user'
      },
      {
        value: 2,
        text: 'guest'
      }
    ]
    
    const preview = null
    return {
      roleOptions,
      preview
    }
  }
}
</script>

<style lang="scss">
</style>

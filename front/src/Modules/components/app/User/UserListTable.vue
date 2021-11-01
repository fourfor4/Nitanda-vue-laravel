<template>
  <section id="user-list-table">
    <user-list-add-new
      :is-add-new-user-sidebar-active.sync="isAddNewUserSidebarActive"
    />
    <b-card no-body>
      <b-card-header>
        <b-card-title>
          検索とフィルター
        </b-card-title>
      </b-card-header>
      <hr class="m-0">
      <b-card-body class="p-0">
        <div class="p-2">
          <b-row>
            <b-col sm="12" md="5" class="mb-1">
              <label>見せる</label>
              <v-select
                v-model="perPage"
                :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                :options="perPageOptions"
                :clearable="false"
                class="per-page-selector d-inline-block mx-50"
              >
                <span slot="no-options">
                  データなし
                </span>
              </v-select>
              <label>エントリ</label>
            </b-col>
            <b-col sm="12" md="7">
              <b-row>
                <b-col sm="12" md="4" class="mb-1">
                  <b-form-input 
                    v-model="searchQuery"
                    placeholder="従業員名..."
                  />
                </b-col>
                <b-col sm="12" md="4" class="mb-1">
                  <!-- <v-select
                    v-model="exportVal"
                    :options="exportOptions"
                    class="w-100"
                    label="title"
                  >
                    <template #option="{title, icon}">
                      <feather-icon 
                        :icon="icon"
                        size="16"
                        class="align-middle mr-50"
                      />
                      <span>{{title}}</span>
                    </template>
                  </v-select> -->
                </b-col>
                <b-col sm="12" md="4" class="mb-1">
                  <b-button
                    variant="primary"
                    @click="isAddNewUserSidebarActive = true"
                    class="w-100"
                  >
                    ユーザーを追加する
                  </b-button>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </div>
        <b-table
          ref="userListTable"
          class="position-relative"
          :items="filterUserList"
          responsive
          :fields="tableColumns"
          primary-key="id"
          :sort-by.sync="sortBy"
          show-empty
          empty-text="データなし"
          :sort-desc.sync="isSortDirDesc"
          :per-page="perPage"
          :current-page="currentPage"
        >
          <template #cell(id)="data">
            {{data.index + 1}}
          </template>
          <template #cell(avatar_url)="data">
            <b-avatar
              class="q_user_avatar"
              :src="data.value && appConfig.serverUrl + data.value"
              size="lg"
            />
          </template>
          <template #cell(department_id)="data">
            {{
              commonStates.departments.filter(item => item.id == data.value).length > 0 
                ? commonStates.departments.filter(item => item.id == data.value)[0].department_name
                : ''
            }}
          </template>
          <template #cell(role_id)="data">
            {{
              commonStates.roles.filter(item => item.id == data.value).length > 0 
                ? commonStates.roles.filter(item => item.id == data.value)[0].role_name
                : ''
            }}
          </template>
          <template #cell(action)="data">
            <b-button 
              variant="flat-primary"
              class="btn-icon"
              :to="'/user/list/'+data.item.id"
            >
              <feather-icon
                icon="EditIcon"
                class="mr-0 cursor-pointer"
                :to="'/register'"
              >
              </feather-icon>
            </b-button>
            <b-button
              variant="flat-danger"
              class="btn-icon"
              @click="deleteUser(data.item.id)"
            >
              <feather-icon
                icon="Trash2Icon"
                class="cursor-pointer"
              >
              </feather-icon>
            </b-button>
          </template>
        </b-table>
        <div class="d-flex mt-1 pr-1">
          <b-pagination
            class="ml-auto"
            v-model="currentPage"
            :total-rows="filterUserList.length"
            :per-page="perPage"
          />
        </div>
      </b-card-body>
    </b-card>
  </section>
</template>

<script>

import appConfig from '@/appConfig'
import { defineComponent, ref } from '@vue/composition-api'
import {
  BCard,
  BCardHeader,
  BCardBody,
  BCardTitle,
  BTable,
  BRow,
  BCol,
  BFormInput,
  BButton,
  BAvatar,
  BPagination
} from 'bootstrap-vue'
import vSelect from 'vue-select'
import { mapGetters } from 'vuex'
import UserListAddNew from './UserListAddNew.vue'

export default defineComponent({
  components: {
    BCard,
    BCardHeader,
    BCardBody,
    BCardTitle,
    BTable,
    BRow,
    BCol,
    BFormInput,
    BButton,
    BAvatar,
    BPagination,

    vSelect,
    //add new user component
    UserListAddNew
  },
  computed: {
    ...mapGetters({
      userList: 'auth/userList',
      commonStates: 'common/common_states',
    }),
    filterUserList: function() {
      return this.userList.filter(item => {
        if (item.employee_name.indexOf(this.searchQuery) > -1) {
          return item
        }
      })
    },
  },
  setup() {
    //show add new user sidebar (sync)
    const isAddNewUserSidebarActive = ref(false)

    const searchQuery = ''
    const perPage = 2
    const perPageOptions = [1, 2, 10, 30]
    const currentPage = 1
    const exportOptions = [
      {
        title:'印刷',
        icon:'PrinterIcon'
      },
      {
        title:'Csv',
        icon:'FileTextIcon'
      },
      {
        title:'Excel',
        icon:'FileIcon'
      },
      {
        title:'Pdf',
        icon:'ClipboardIcon'
      },
      {
        title:'コピー',
        icon:'CopyIcon'
      },
    ]

    //user list table columns
    const tableColumns = [
      {
        key: 'id',
        label: 'No',
        sortable: true
      },
      {
        key: 'avatar_url',
        label: 'アバター'
      },
      { 
        key: 'employee_id', 
        label: '従業員ID', 
        sortable: true 
      },
      { 
        key: 'login_id', 
        label: 'ログインID', 
        sortable: true 
      },
      { 
        key: 'employee_name', 
        label: '従業員名', 
        sortable: true 
      },
      { 
        key: 'department_id', 
        label: 'デパートメント', 
        sortable: true 
      },
      { 
        key: 'role_id', 
        label: '役割', 
        sortable: true 
      },
      { 
        key: 'action',
        label: 'アクション' 
      },
    ]
    //sortBy
    const sortBy = ref('id')
    const isSortDirDesc = ref(false)
    return {
      isAddNewUserSidebarActive,
      //filter
      searchQuery,
      perPage,
      perPageOptions,
      currentPage,
      exportOptions,
      //table
      tableColumns,
      sortBy,
      isSortDirDesc,
      appConfig
    }
  },
  data() {
    return {
      exportVal:[{
        title:'印刷',
        icon:'PrinterIcon'
      }]
    }
  },
  mounted() {
    this.$store.dispatch('auth/retrieveUserList')
  },
  methods: {
    deleteUser: function (userId) {
      this.$swal({
        title: '本当にユーザーを削除しますか？',
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
          this.$store.dispatch('auth/deleteUser', userId)
        }
      })
    }
  }
})
</script>
<style>
.per-page-selector {
  width: 90px;
}
</style>
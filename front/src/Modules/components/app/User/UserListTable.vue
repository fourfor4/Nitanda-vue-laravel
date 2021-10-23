<template>
  <section id="user-list-table">
    <user-list-add-new
      :is-add-new-user-sidebar-active.sync="isAddNewUserSidebarActive"
      :role-options="[]"
      :plan-options="[]"
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
                    placeholder="検索..."
                  />
                </b-col>
                <b-col sm="12" md="4" class="mb-1">
                  <v-select
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
                  </v-select>
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
          :items="[]"
          responsive
          :fields="tableColumns"
          primary-key="id"
          :sort-by.sync="sortBy"
          show-empty
          empty-text="データなし"
          :sort-desc.sync="isSortDirDesc"
        >

        </b-table>
      </b-card-body>
    </b-card>
  </section>
</template>
<script>
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
  BButton
} from 'bootstrap-vue'
import vSelect from 'vue-select'
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
    vSelect,
    //add new user component
    UserListAddNew
  },
  setup() {
    //show add new user sidebar (sync)
    const isAddNewUserSidebarActive = ref(false)

    const searchQuery = ''
    const perPage = 10
    const perPageOptions = [10, 25, 50, 100]
   
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
      { key: '社員番号', sortable: true },
      { key: 'メール', sortable: true },
      { key: '社員名', sortable: true },
      { key: '部署', sortable: true },
      { key: '役職', sortable: true },    
      { key: 'アクション' },
    ]
    //sortBy
    const sortBy = ref('id')
    const isSortDirDesc = ref(true)
    return {
      isAddNewUserSidebarActive,
      //filter
      searchQuery,
      perPage,
      perPageOptions,
      exportOptions,
      //table
      tableColumns,
      sortBy,
      isSortDirDesc
    }
  },
  data() {
    return {
      exportVal:[{
        title:'印刷',
        icon:'PrinterIcon'
      }]
    }
  }
})
</script>
<style>
.per-page-selector {
  width: 90px;
}
</style>
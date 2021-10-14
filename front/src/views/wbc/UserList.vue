<template>
  <section id="wbc-user-list">
    <section class="app-user-list">
        <div class="row">
          <div class="col-lg-2 col-sm-4">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">55</h3>
                  <span>社員数</span>
                </div>
                <div class="avatar bg-light-primary p-50">
                  <span class="avatar-content">
                    <feather-icon icon="UserIcon" class="font-medium-4"/>
                  </span>
                </div>
              </div>
            </div>
          </div>
            <div class="col-lg-2 col-sm-4">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">5</h3>
                    <span>企画開発</span>
                  </div>
                  <div class="avatar bg-light-danger p-50">
                    <span class="avatar-content">
                      <feather-icon icon="UserPlusIcon" class="font-medium-4"/>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">6</h3>
                    <span>営業部</span>
                  </div>
                  <div class="avatar bg-light-success p-50">
                    <span class="avatar-content">
                        <feather-icon icon="UserCheckIcon" class="font-medium-4"/>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">6</h3>
                    <span>管理部</span>
                  </div>
                  <div class="avatar bg-light-warning p-50">
                    <span class="avatar-content">
                        <feather-icon icon="UserXIcon" class="font-medium-4"/>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">25</h3>
                    <span>医療システム部</span>
                  </div>
                  <div class="avatar bg-light-warning p-50">
                    <span class="avatar-content">
                      <feather-icon icon="UserXIcon" class="font-medium-4"/>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-lg-2 col-sm-4">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">3</h3>
                  <span>システム管理</span>
                </div>
                <div class="avatar bg-light-warning p-50">
                  <span class="avatar-content">
                    <feather-icon icon="UserXIcon" class="font-medium-4"/>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <user-list-add-new
      :is-add-new-user-sidebar-active.sync="isAddNewUserSidebarActive"
      :role-options="roleOptions"
      :plan-options="planOptions"
      @refetch-data="refetchData"
    />
    <!-- Filters -->
    <!-- Table Container Card -->
    <b-card
      no-body
      class="mb-0"
    >
    <div class="m-1">
      <h4 class="card-title">検索 & フィルター</h4>
    </div>
    <hr>
    <div class="m-1">
      <!-- Table Top -->
      <b-row>
        <!-- Per Page -->
        <b-col
          sm="12"
          md="5"
          class="mb-1"
        >
          <label>見せる</label>
          <v-select
            v-model="perPage"
            :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
            :options="perPageOptions"
            :clearable="false"
            class="per-page-selector d-inline-block mx-50"
          />
          <label>エントリ</label>
        </b-col>
        <!-- Search -->
        <b-col
          sm="12"
          md="7"
          class="mb-1"
        >
        <b-row>
          <b-col sm="12" md="4" lg="4" xl="4" class="mb-1" >
            <b-form-input
            v-model="searchQuery"
            class="d-inline-block mr-1"
            placeholder="検索..."
          />
          </b-col>
          <b-col sm="6" md="4" lg="4" xl="4" class="mb-1">
            <v-select
              v-model="selected1"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              :options="books"
              label="title"
            >
              <template #option="{title, icon}">
                <feather-icon
                  :icon="icon"
                  size="16"
                  class="align-middle mr-50"/>
                  <span>{{title}}</span>
              </template>
            </v-select>
          </b-col>
          <b-col sm="6" md="4" lg="4" xl="4" class="mb-1">
            <b-button
              variant="primary"
              @click="isAddNewUserSidebarActive = true"
            >
              <span class="text-nowrap">ユーザーを追加する</span>
            </b-button>
          </b-col>
        </b-row>
        </b-col>
      </b-row>
    </div>
      <b-table
        ref="refUserListTable"
        class="position-relative"
        :items="fetchUsers"
        responsive
        :fields="tableColumns"
        primary-key="id"
        :sort-by.sync="sortBy"
        show-empty
        empty-text="No matching records found"
        :sort-desc.sync="isSortDirDesc"
      >
        <!-- Column: User -->
        <template #cell(社員番号)="data">
          <b-media vertical-align="center">
            <template #aside>
              <b-avatar
                size="32"
                :src="data.item.avatar"
                :text="avatarText(data.item.fullName)"
                :variant="`light-${resolveUserRoleVariant(data.item.role)}`"
                :to="{ name: 'apps-users-view', params: { id: data.item.id } }"
              />
            </template>
            <b-link
              :to="{ name: 'apps-users-view', params: { id: data.item.id } }"
              class="font-weight-bold d-block text-nowrap"
            >
              {{ data.item.fullName }}
            </b-link>
            <small class="text-muted">@{{ data.item.username }}</small>
          </b-media>
        </template>
        <!-- Column: Role -->
        <template #cell(role)="data">
          <div class="text-nowrap">
            <feather-icon
              :icon="resolveUserRoleIcon(data.item.role)"
              size="18"
              class="mr-50"
              :class="`text-${resolveUserRoleVariant(data.item.role)}`"
            />
            <span class="align-text-top text-capitalize">{{ data.item.role }}</span>
          </div>
        </template>
        <!-- Column: Status -->
        <template #cell(status)="data">
          <b-badge
            pill
            :variant="`light-${resolveUserStatusVariant(data.item.status)}`"
            class="text-capitalize"
          >
            {{ data.item.status }}
          </b-badge>
        </template>
        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <b-dropdown
            variant="link"
            no-caret
            :right="$store.state.appConfig.isRTL"
          >
            <template #button-content>
              <feather-icon
                icon="MoreVerticalIcon"
                size="16"
                class="align-middle text-body"
              />
            </template>
            <b-dropdown-item :to="{ name: 'apps-users-view', params: { id: data.item.id } }">
              <feather-icon icon="FileTextIcon" />
              <span class="align-middle ml-50">Details</span>
            </b-dropdown-item>
            <b-dropdown-item :to="{ name: 'apps-users-edit', params: { id: data.item.id } }">
              <feather-icon icon="EditIcon" />
              <span class="align-middle ml-50">Edit</span>
            </b-dropdown-item>
            <b-dropdown-item>
              <feather-icon icon="TrashIcon" />
              <span class="align-middle ml-50">Delete</span>
            </b-dropdown-item>
          </b-dropdown>
        </template>
      </b-table>
      <div class="mx-2 mb-2">
        <b-row>
          <b-col
            cols="12"
            sm="6"
            class="d-flex align-items-center justify-content-center justify-content-sm-start"
          >
            <span class="text-muted">Showing {{ dataMeta.from }} to {{ dataMeta.to }} of {{ dataMeta.of }} entries</span>
          </b-col>
          <!-- Pagination -->
          <b-col
            cols="12"
            sm="6"
            class="d-flex align-items-center justify-content-center justify-content-sm-end"
          >
            <b-pagination
              v-model="currentPage"
              :total-rows="totalUsers"
              :per-page="perPage"
              first-number
              last-number
              class="mb-0 mt-1 mt-sm-0"
              prev-class="prev-item"
              next-class="next-item"
            >
              <template #prev-text>
                <feather-icon
                  icon="ChevronLeftIcon"
                  size="18"
                />
              </template>
              <template #next-text>
                <feather-icon
                  icon="ChevronRightIcon"
                  size="18"
                />
              </template>
            </b-pagination>
          </b-col>
        </b-row>
      </div>
    </b-card>
  </section>
</template>

<script>
import { BRow, BCol } from 'bootstrap-vue'

import {
  BCard, BFormInput, BButton, BTable, BMedia, BAvatar, BLink,
  BBadge, BDropdown, BDropdownItem, BPagination, BFormGroup
} from 'bootstrap-vue'
import vSelect from 'vue-select'
import store from '@/store'
import { ref, onUnmounted } from '@vue/composition-api'
import { avatarText } from '@core/utils/filter'
import useUsersList from './users-list/useUsersList'
import userStoreModule from './users-list/userStoreModule'
import UserListAddNew from './users-list/UserListAddNew.vue'

export default {
  components: {
    UserListAddNew,
    BCard,
    BRow,
    BCol,
    BFormInput,
    BButton,
    BTable,
    BMedia,
    BAvatar,
    BLink,
    BBadge,
    BDropdown,
    BDropdownItem,
    BPagination,
    BFormGroup,
    vSelect,
  },
  setup() {
    const USER_APP_STORE_MODULE_NAME = 'app-user'

    // Register module
    if (!store.hasModule(USER_APP_STORE_MODULE_NAME)) store.registerModule(USER_APP_STORE_MODULE_NAME, userStoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(USER_APP_STORE_MODULE_NAME)) store.unregisterModule(USER_APP_STORE_MODULE_NAME)
    })

    const isAddNewUserSidebarActive = ref(false)

    const roleOptions = [
      { label: 'Admin', value: 'admin' },
      { label: 'Author', value: 'author' },
      { label: 'Editor', value: 'editor' },
      { label: 'Maintainer', value: 'maintainer' },
      { label: 'Subscriber', value: 'subscriber' },
    ]

    const planOptions = [
      { label: 'Basic', value: 'basic' },
      { label: 'Company', value: 'company' },
      { label: 'Enterprise', value: 'enterprise' },
      { label: 'Team', value: 'team' },
    ]

    const statusOptions = [
      { label: 'Pending', value: 'pending' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' },
    ]

    const {
      fetchUsers,
      tableColumns,
      perPage,
      currentPage,
      totalUsers,
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refUserListTable,
      refetchData,

      // UI
      resolveUserRoleVariant,
      resolveUserRoleIcon,
      resolveUserStatusVariant,

      // Extra Filters
      roleFilter,
      planFilter,
      statusFilter,
    } = useUsersList()

    return {
      //select1
      
      // Sidebar
      isAddNewUserSidebarActive,

      fetchUsers,
      tableColumns,
      perPage,
      currentPage,
      totalUsers,
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refUserListTable,
      refetchData,

      // Filter
      avatarText,

      // UI
      resolveUserRoleVariant,
      resolveUserRoleIcon,
      resolveUserStatusVariant,

      roleOptions,
      planOptions,
      statusOptions,

      // Extra Filters
      roleFilter,
      planFilter,
      statusFilter,
    }
  },
  data(){
    return{
      selected1:[{
          title:'書き出す',
          icon:'ExternalLinkIcon',
        }
      ],
      books:[
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
      ],
    }
  }
}
</script>

<style lang="scss" scoped>
.per-page-selector {
  width: 90px;
}
</style>

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
</style>

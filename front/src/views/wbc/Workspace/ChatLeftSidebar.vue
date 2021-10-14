<template>
  <div class="sidebar-left">
    <div class="sidebar">

      <!-- Logged In User Profile Sidebar -->
      <user-profile-sidebar
        :shall-show-user-profile-sidebar="shallShowUserProfileSidebar"
        :profile-user-data="profileUserData"
        @close-sidebar="$emit('update:shall-show-user-profile-sidebar', false)"
      />

      <!-- Sidebar Content -->
      <div
        class="sidebar-content"
        :class="{'show': mqShallShowLeftSidebar}"
      >

        <!-- Sidebar close icon -->
        <span class="sidebar-close-icon">
          <feather-icon
            icon="XIcon"
            size="16"
            @click="$emit('update:mq-shall-show-left-sidebar', false)"
          />
        </span>
        <div class="d-flex h-100">
          <div class="workspace-items h-100">
            <b-tabs
              vertical
              nav-wrapper-class="nav-vertical"
            >
              <b-tab class="workspace-item" title="LR" />
              <b-tab class="workspace-item" title="CR" />
              <b-tab class="workspace-item" title="BC" />
            </b-tabs>
            <div class="d-flex justify-content-center">
            <b-button
              v-ripple.400="'rgba(113, 102, 240, 0.15)'"
              variant="outline-primary"
              class="btn-icon rounded-circle"
            >
              <feather-icon icon="PlusIcon" />
            </b-button>
            </div>
          </div>
          <div>
            <!-- Header -->
            <div class="chat-fixed-search">
              <div class="d-flex align-items-center w-100">
                <div class="sidebar-profile-toggle">
                  <b-avatar
                    size="42"
                    class="cursor-pointer badge-minimal avatar-border-2"
                    :src="profileUserMinimalData.avatar"
                    variant="transparent"
                    badge
                    badge-variant="success"
                  />
                    <!-- @click.native="$emit('show-user-profile')" -->
                </div>
                <!-- Search -->
                <b-input-group class="input-group-merge ml-1 w-100 round">
                  <b-input-group-prepend is-text>
                    <feather-icon
                      icon="SearchIcon"
                      class="text-muted"
                    />
                  </b-input-group-prepend>
                  <b-form-input
                    v-model="searchQuery"
                    placeholder="検索..."
                  />
                </b-input-group>
              </div>
            </div>

            <!-- ScrollArea: Chat & Contacts -->
            <vue-perfect-scrollbar
              :settings="perfectScrollbarSettings"
              class="chat-user-list-wrapper list-group scroll-area"
            >

              <!-- Chats Title -->
              <h4 class="chat-list-title">
                部署名
              </h4>

              <ul class="chat-users-list contact-list media-list">
                <department-contact
                  v-for="contact in filteredDepartmentContact"
                  :key="contact.id"            
                  :department="contact"
                  tag="li"
                  :class="{'active': activeDepartmentContactId === contact.id}"
                  v-on:click="setDepartmentContactId(contact)"
                />
              </ul>

              <!-- Contacts Title -->
              <h4 class="chat-list-title">
                部署会員
              </h4>

              <!-- Contacts -->
              <ul class="chat-users-list contact-list media-list">
                <chat-contact
                  v-for="contact in filteredContacts"
                  :key="contact.id"
                  :user="contact"
                  :class="{'active': activeChatContactId === contact.id}"
                  tag="li"
                  @click="$emit('open-chat', contact.id)"
                />
              </ul>
            </vue-perfect-scrollbar>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import {
  BAvatar, BInputGroup, BInputGroupPrepend, BFormInput, BTabs, BTab, BButton
} from 'bootstrap-vue'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import { ref, computed } from '@vue/composition-api'
import ChatContact from './ChatContact.vue'
import UserProfileSidebar from './UserProfileSidebar.vue'
import DepartmentContact from './DepartmentContact.vue'
import Ripple from 'vue-ripple-directive'

export default {
  components: {

    // BSV
    BAvatar,
    BInputGroup,
    BInputGroupPrepend,
    BFormInput,
    BTabs,
    BTab,
    BButton,
    // 3rd party
    VuePerfectScrollbar,

    // SFC
    ChatContact,
    UserProfileSidebar,
    DepartmentContact
  },
  directives: {
    Ripple,
  },
  props: {
    chatsContacts: {
      type: Array,
      required: true,
    },
    contacts: {
      type: Array,
      required: true,
    },
    shallShowUserProfileSidebar: {
      type: Boolean,
      required: true,
    },
    profileUserData: {
      type: Object,
      required: true,
    },
    profileUserMinimalData: {
      type: Object,
      required: true,
    },
    activeChatContactId: {
      type: Number,
      default: null,
    },
    mqShallShowLeftSidebar: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      filteredDepartmentContact: [
        {
          name: '#HTML',
          id: 1
        }, {
          name: '#JAVASCRIPT',
          id: 2
        }, {
          name: '#Vue',
          id: 3
        }
      ],
      activeDepartmentContactId: 1
    }
  },
  methods: {
    setDepartmentContactId(department) {
      this.activeDepartmentContactId = department.id
      this.$emit('setdepartment', department.name)
    }
  },
  setup(props) {
    const perfectScrollbarSettings = {
      maxScrollbarLength: 150,
    }

    const resolveChatContact = userId => props.contacts.find(contact => contact.id === userId)

    // Search Query
    const searchQuery = ref('')

    const searchFilterFunction = contact => contact.fullName.toLowerCase().includes(searchQuery.value.toLowerCase())
    const filteredChatsContacts = computed(() => props.chatsContacts.filter(searchFilterFunction))
    const filteredContacts = computed(() => props.contacts.filter(searchFilterFunction))

    return {
      // Search Query
      searchQuery,
      filteredChatsContacts,
      filteredContacts,

      // UI
      resolveChatContact,
      perfectScrollbarSettings,
    }
  },
}
</script>

<style>
  .sidebar-content {
    width: 430px !important;
  }
  .workspace-items {
    padding-top: 10px;
    padding-right: 10px;
    background: #ebe9f1;
    overflow-y: auto;
  }
  .workspace-items li {
    font-size: 16px !important;
    margin-top: 5px;
    margin-bottom: 5px;
  }
  .dark-layout .workspace-items {
    border-right: 1px solid #3b4253;
    padding-top: 10px;
    padding-right: 10px;
    background: #283046;
    overflow-y: auto;
  }
  .workspace-items::-webkit-scrollbar {
    width: 5px;
    height: 0px;
  }
  .workspace-items::-webkit-scrollbar-track {
    background: transparent;
  }
  .workspace-items::-webkit-scrollbar-thumb {
    border-radius: 2px;
    background: rgba(228, 211, 211, 0.548);
  }
  .feather-plus-circle {
    width: 16px;
  }
</style>
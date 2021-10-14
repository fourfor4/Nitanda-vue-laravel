<template>
  <!-- Need to add height inherit because Vue 2 don't support multiple root ele -->
  <div style="height: inherit">
    <div
      class="body-content-overlay"
      :class="{'show': shallShowUserProfileSidebar || shallShowActiveChatContactSidebar || mqShallShowLeftSidebar}"
      @click="mqShallShowLeftSidebar=shallShowActiveChatContactSidebar=shallShowUserProfileSidebar=false"
    />

    <!-- Main Area -->
    <section class="chat-app-window">

      <!-- Start Chat Logo -->
      <div
        v-if="!activeChat.contact"
        class="start-chat-area"
      >
        <div class="mb-1 start-chat-icon">
          <feather-icon
            icon="MessageSquareIcon"
            size="56"
          />
        </div>
        <h4
          class="sidebar-toggle start-chat-text"
          @click="startConversation"
        >
          会話を開始
        </h4>
      </div>

      <!-- Chat Content -->
      <div
        v-else
        class="active-chat"
      >
        <!-- Chat Navbar -->
        <div class="chat-navbar">
          <header class="chat-header">

            <!-- Avatar & Name -->
            <div class="d-flex align-items-center w-100">

              <!-- Toggle Icon -->
              <div class="sidebar-toggle d-block d-lg-none mr-1">
                <feather-icon
                  icon="MenuIcon"
                  class="cursor-pointer"
                  size="21"
                  @click="mqShallShowLeftSidebar = true"
                />
              </div>
              <div class="d-flex w-100">
                <div class="d-flex align-items-center">
                  {{departmentName}}
                </div>
                <div class=" ml-auto d-flex align-items-center">
                  <b-avatar-group size="32px">
                    <b-avatar
                      v-b-tooltip.hover
                      class="pull-up"
                      title="Jenny Looper"
                      :src="require('@/assets/images/portrait/small/avatar-s-5.jpg')"
                    />
                    <b-avatar
                      v-b-tooltip.hover
                      class="pull-up"
                      title="Darcey Nooner"
                      variant="primary"
                      :src="require('@/assets/images/portrait/small/avatar-s-7.jpg')"
                    />
                    <b-avatar
                      v-b-tooltip.hover
                      class="pull-up"
                      title="Julee Rossignol"
                      :src="require('@/assets/images/portrait/small/avatar-s-10.jpg')"
                    />
                    <b-avatar
                      v-b-tooltip.hover
                      class="pull-up"
                      title="Elicia Rieske"
                      variant="danger"
                      :src="require('@/assets/images/portrait/small/avatar-s-8.jpg')"
                    />
                    <b-avatar
                      v-b-tooltip.hover
                      class="pull-up"
                      title="Vinnie Mostowy"
                      :src="require('@/assets/images/portrait/small/avatar-s-20.jpg')"
                      badge="5"
                      badge-top
                      badge-variant="success"
                      badge-offset="-0.5em"
                    />
                  </b-avatar-group>
                </div>
              </div>
            </div>
          </header>
        </div>

        <!-- User Chat Area -->
        <vue-perfect-scrollbar
          ref="refChatLogPS"
          :settings="perfectScrollbarSettings"
          class="user-chats scroll-area"
        >
          <chat-log
            :chat-data="activeChat"
            :profile-user-avatar="profileUserDataMinimal.avatar"
          />
        </vue-perfect-scrollbar>

        <!-- Message Input -->
        <b-form
          class="chat-app-form"
          @submit.prevent="sendMessage"
        >
          <b-input-group class="input-group-merge mr-1">
            <b-form-input
              v-model="chatInputMessage"
              placeholder="メッセージを入力"
            />
            <b-input-group-append is-text>
              <feather-icon
                icon="ImageIcon"
                class="cursor-pointer"
                v-on:click="attachmentFile"
              />
              <input type="file" id="attachment-file" hidden />
            </b-input-group-append>
          </b-input-group>
          <b-button
            variant="primary"
            type="submit"
            style="width: 80px"
          >
            送 信
          </b-button>
        </b-form>
      </div>
    </section>

    <!-- Active Chat Contact Details Sidebar -->
    <chat-active-chat-content-details-sidedbar
      :shall-show-active-chat-contact-sidebar.sync="shallShowActiveChatContactSidebar"
      :contact="activeChat.contact || {}"
    />

    <!-- Sidebar -->
    <portal to="content-renderer-sidebar-left">
      <chat-left-sidebar
        :chats-contacts="chatsContacts"
        :contacts="contacts"
        :active-chat-contact-id="activeChat.contact ? activeChat.contact.id : null"
        :shall-show-user-profile-sidebar.sync="shallShowUserProfileSidebar"
        :profile-user-data="profileUserData"
        :profile-user-minimal-data="profileUserDataMinimal"
        :mq-shall-show-left-sidebar.sync="mqShallShowLeftSidebar"
        @show-user-profile="showUserProfileSidebar"
        @open-chat="openChatOfContact"
        @setdepartment="setdepartment"
      />
    </portal>
  </div>
</template>

<script>
import store from '@/store'
import {
  ref, onUnmounted, nextTick,
} from '@vue/composition-api'
import {
  BAvatar, BDropdown, BDropdownItem, BForm, BInputGroup, BFormInput, BButton, BAvatarGroup, BInputGroupAppend, BFormGroup,BFormFile, VBTooltip 
} from 'bootstrap-vue'

import Ripple from 'vue-ripple-directive'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
// import { formatDate } from '@core/utils/filter'
import { $themeBreakpoints } from '@themeConfig'
import { useResponsiveAppLeftSidebarVisibility } from '@core/comp-functions/ui/app'
import ChatLeftSidebar from './ChatLeftSidebar.vue'
import chatStoreModule from './chatStoreModule'
import ChatActiveChatContentDetailsSidedbar from './ChatActiveChatContentDetailsSidedbar.vue'
import ChatLog from './ChatLog.vue'
import useChat from './useChat'

export default {
  components: {

    // BSV
    BAvatar,
    BDropdown,
    BDropdownItem,
    BForm,
    BInputGroup,
    BFormInput,
    BButton,
    BAvatarGroup,
    BInputGroupAppend,
    BFormGroup,
    BFormFile,
    // 3rd Party
    VuePerfectScrollbar,

    // SFC
    ChatLeftSidebar,
    ChatActiveChatContentDetailsSidedbar,
    ChatLog,
  },
  directives: {
    'b-tooltip': VBTooltip, 
    Ripple
  },
  data() {
    return {
      departmentName: '#HTML'
    }
  },
  methods : {
    attachmentFile() {
      document.getElementById("attachment-file").click()
    },
    setdepartment(departmentName) {
      this.departmentName = departmentName
    }
  },
  setup() {
    const CHAT_APP_STORE_MODULE_NAME = 'app-chat'

    // Register module
    if (!store.hasModule(CHAT_APP_STORE_MODULE_NAME)) store.registerModule(CHAT_APP_STORE_MODULE_NAME, chatStoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(CHAT_APP_STORE_MODULE_NAME)) store.unregisterModule(CHAT_APP_STORE_MODULE_NAME)
    })

    const { resolveAvatarBadgeVariant } = useChat()

    // Scroll to Bottom ChatLog
    const refChatLogPS = ref(null)
    const scrollToBottomInChatLog = () => {
      const scrollEl = refChatLogPS.value.$el || refChatLogPS.value
      scrollEl.scrollTop = scrollEl.scrollHeight
    }

    // ------------------------------------------------
    // Chats & Contacts
    // ------------------------------------------------
    const chatsContacts = ref([])
    const contacts = ref([])

    const fetchChatAndContacts = () => {
      store.dispatch('app-chat/fetchChatsAndContacts')
        .then(response => {
          chatsContacts.value = response.data.chatsContacts
          contacts.value = response.data.contacts
          // eslint-disable-next-line no-use-before-define
          profileUserDataMinimal.value = response.data.profileUser
        })
    }

    fetchChatAndContacts()

    // ------------------------------------------------
    // Single Chat
    // ------------------------------------------------
    const activeChat = ref({})
    const chatInputMessage = ref('')
    const openChatOfContact = userId => {
      // Reset send message input value
      chatInputMessage.value = ''

      store.dispatch('app-chat/getChat', { userId })
        .then(response => {
          activeChat.value = response.data

          // Set unseenMsgs to 0
          const contact = chatsContacts.value.find(c => c.id === userId)
          if (contact) contact.chat.unseenMsgs = 0

          // Scroll to bottom
          nextTick(() => { scrollToBottomInChatLog() })
        })

      // if SM device =>  Close Chat & Contacts left sidebar
      // eslint-disable-next-line no-use-before-define
      mqShallShowLeftSidebar.value = false
    }
    const sendMessage = () => {
      if (!chatInputMessage.value) return
      const payload = {
        contactId: activeChat.value.contact.id,
        // eslint-disable-next-line no-use-before-define
        senderId: profileUserDataMinimal.value.id,
        message: chatInputMessage.value,
      }
      store.dispatch('app-chat/sendMessage', payload)
        .then(response => {
          const { newMessageData, chat } = response.data

          // ? If it's not undefined => New chat is created (Contact is not in list of chats)
          if (chat !== undefined) {
            activeChat.value = { chat, contact: activeChat.value.contact }
            chatsContacts.value.push({
              ...activeChat.value.contact,
              chat: {
                id: chat.id,
                lastMessage: newMessageData,
                unseenMsgs: 0,
              },
            })
          } else {
            // Add message to log
            activeChat.value.chat.chat.push(newMessageData)
          }

          // Reset send message input value
          chatInputMessage.value = ''

          // Set Last Message for active contact
          const contact = chatsContacts.value.find(c => c.id === activeChat.value.contact.id)
          contact.chat.lastMessage = newMessageData

          // Scroll to bottom
          nextTick(() => { scrollToBottomInChatLog() })
        })
    }

    const perfectScrollbarSettings = {
      maxScrollbarLength: 150,
    }

    // User Profile Sidebar
    // ? Will contain all details of profile user (e.g. settings, about etc.)
    const profileUserData = ref({})
    // ? Will contain id, name and avatar & status
    const profileUserDataMinimal = ref({})

    const shallShowUserProfileSidebar = ref(false)
    const showUserProfileSidebar = () => {
      store.dispatch('app-chat/getProfileUser')
        .then(response => {
          profileUserData.value = response.data
          shallShowUserProfileSidebar.value = true
        })
    }

    // Active Chat Contact Details
    const shallShowActiveChatContactSidebar = ref(false)

    // UI + SM Devices
    // Left Sidebar Responsiveness
    const { mqShallShowLeftSidebar } = useResponsiveAppLeftSidebarVisibility()
    const startConversation = () => {
      if (store.state.app.windowWidth < $themeBreakpoints.lg) {
        mqShallShowLeftSidebar.value = true
      }
    }

    return {
      // Filters
      // formatDate,

      // useChat
      resolveAvatarBadgeVariant,

      // Chat & Contacts
      chatsContacts,
      contacts,

      // Single Chat
      refChatLogPS,
      activeChat,
      chatInputMessage,
      openChatOfContact,
      sendMessage,

      // Profile User Minimal Data
      profileUserDataMinimal,

      // User Profile Sidebar
      profileUserData,
      shallShowUserProfileSidebar,
      showUserProfileSidebar,

      // Active Chat Contact Details
      shallShowActiveChatContactSidebar,

      // UI
      perfectScrollbarSettings,

      // UI + SM Devices
      startConversation,
      mqShallShowLeftSidebar,
    }
  },
}
</script>

<style lang="scss" scoped>

</style>

<style lang="scss">
@import "~@core/scss/base/pages/app-workspace.scss";
@import "~@core/scss/base/pages/app-chat-list.scss";

</style>

<template>
  <div class="pl-1">

    <!-- project-card -->
    <b-navbar-nav v-if="$route.path === '/project-card'" class="nav">
      <b-nav-item
        :id="`project-card-1`"
        :to="`/project-card`"
        class="mr-1"
      >
        <feather-icon
          icon="CreditCardIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          カードリスト
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-1`"
          :title="`カードリスト`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item
        :id="`project-card-2`"
        :to="`/project-card`"
        class="mr-1"
      >
        <feather-icon
          icon="ListIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          一覧
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-2`"
          :title="`一覧`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item-dropdown class="mr-1">
        <template #button-content>
          <feather-icon
            slot="button-content"
            icon="HeartIcon"
            size="21"
            class="mr-20"
          />
          <span class="fs-16">
            お気に入り
            <b-badge variant="light-primary" class="fs-12" pill>6</b-badge>
          </span>
        </template>
        <b-dropdown-group class="nav-item-dropdown">
          <b-dropdown-header>
            <div class="w-100 d-flex justify-content-between align-items-center">
              <h4>プロジェクト</h4>
              <b-badge variant="light-primary" size="sm">3 プロジェクト</b-badge>
            </div>
          </b-dropdown-header>
          <hr class="m-0 mt-50">
          <b-dropdown-item>
            <h4>テストプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>サンプルプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>Pマーク</h4>
          </b-dropdown-item>
        </b-dropdown-group>
      </b-nav-item-dropdown>
      <b-nav-item-dropdown>
        <template #button-content>
          <feather-icon
            slot="button-content"
            icon="MenuIcon"
            size="21"
            class="mr-20"
          />
          <span class="fs-16">
            お気に入り
          </span>
        </template>
        <b-dropdown-group class="nav-item-dropdown">
          <b-dropdown-header>
            <div class="w-100 d-flex justify-content-between align-items-center">
              <h4>カテゴリー</h4>
            </div>
          </b-dropdown-header>
          <hr class="m-0 mt-50">
          <b-dropdown-item>
            <h4>導入作業</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>社内プロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>個人</h4>
          </b-dropdown-item>
        </b-dropdown-group>
      </b-nav-item-dropdown>
    </b-navbar-nav>

    <!-- project-management -->
    <b-navbar-nav v-if="$route.path === '/project-management'" class="nav">
      <b-nav-item
        :id="`project-card-1`"
        :to="`/project-management`"
        class="mr-1"
      >
        <feather-icon
          icon="GridIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          かんばん
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-1`"
          :title="`ユーザ登録`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item
        :id="`project-card-2`"
        :to="`/project-management`"
        class="mr-1"
      >
        <feather-icon
          icon="ListIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          一覧
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-2`"
          :title="`一覧`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item-dropdown class="mr-1">
        <template #button-content>
          <feather-icon
            slot="button-content"
            icon="HeartIcon"
            size="21"
            class="mr-20"
          />
          <span class="fs-16">
            マイプロジェクト
            <b-badge pill variant="light-success" class="fs-12">4</b-badge>
          </span>
        </template>
        <b-dropdown-group class="nav-item-dropdown">
          <b-dropdown-item>
            <h4>全てのプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>テストプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>サンプルプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>Pマーク</h4>
          </b-dropdown-item>
        </b-dropdown-group>
      </b-nav-item-dropdown>
    </b-navbar-nav>

    <!-- Q&A dashboard || list -->
    <b-navbar-nav v-if="$route.path === '/qa-dashboard' || $route.path === '/qa-list'" class="nav">
      <b-nav-item
        :id="`project-card-1`"
        :to="`/qa-dashboard`"
        class="mr-1"
      >
        <feather-icon
          icon="AwardIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          Q&A
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-1`"
          :title="`Q&A`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item
        :id="`project-card-2`"
        :to="`/qa-list`"
        class="mr-1"
      >
        <feather-icon
          icon="ListIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          一覧
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-2`"
          :title="`一覧`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
    </b-navbar-nav>

    <!-- user list || user register -->
    <b-navbar-nav v-if="$route.path === '/user-list' || $route.path === '/wbc-register'" class="nav">
      <b-nav-item
        :id="`project-card-1`"
        :to="`/wbc-register`"
        class="mr-1"
      >
        <feather-icon
          icon="UserPlusIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          ユーザ登録
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-1`"
          :title="`ユーザ登録`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item
        :id="`project-card-2`"
        :to="`/user-list`"
        class="mr-1"
      >
        <feather-icon
          icon="CreditCardIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          カード
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-2`"
          :title="`カード`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item
        :id="`project-card-3`"
        :to="`/user-list`"
        class="mr-1"
      >
        <feather-icon
          icon="ListIcon"
          size="21"
          class="mr-20"
        />
        <span class="fs-16">
          一覧
        </span>
        <b-tooltip
          triggers="hover"
          :target="`project-card-3`"
          :title="`一覧`"
          :delay="{ show: 200, hide: 50 }"
        />
      </b-nav-item>
      <b-nav-item-dropdown class="mr-1">
        <template #button-content>
          <feather-icon
            slot="button-content"
            icon="HeartIcon"
            size="21"
            class="mr-20"
          />
          <span class="fs-16">
            お気に入り
            <b-badge variant="light-primary" class="fs-12" pill>3</b-badge>
          </span>
        </template>
        <b-dropdown-group class="nav-item-dropdown">
          <b-dropdown-header>
            <div class="w-100 d-flex justify-content-between align-items-center">
              <h4>プロジェクト</h4>
              <b-badge variant="light-primary" size="sm">3 プロジェクト</b-badge>
            </div>
          </b-dropdown-header>
          <hr class="m-0 mt-50">
          <b-dropdown-item>
            <h4>テストプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>サンプルプロジェクト</h4>
          </b-dropdown-item>
          <hr class="m-0">
          <b-dropdown-item>
            <h4>Pマーク</h4>
          </b-dropdown-item>
        </b-dropdown-group>
      </b-nav-item-dropdown>
    </b-navbar-nav>

  </div>
</template>

<script>
import {
  BNavbarNav, BNavItem, BTooltip, BNavItemDropdown, BFormInput, BDropdownItem, BDropdown, BBadge, BDropdownGroup, BDropdownHeader
} from 'bootstrap-vue'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'

export default {
  components: {
    BNavbarNav, BNavItem, BTooltip, BNavItemDropdown, BFormInput, VuePerfectScrollbar, BDropdownItem, BDropdown, BBadge, BDropdownGroup, BDropdownHeader
  },
  data() {
    return {
    }
  },
}
</script>

<style lang="scss" scoped>
@import '~@core/scss/base/bootstrap-extended/include';

ul
{
  list-style: none;
  padding: 0;
  margin: 0;
}
p {
  margin: 0;
}

.nav-bookmar-content-overlay {
    position: fixed;
    opacity: 0;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    -webkit-transition: all 0.7s;
    transition: all 0.7s;
    z-index: -1;

    &:not(.show) {
      pointer-events: none;
    }

    &.show {
      cursor: pointer;
      z-index: 10;
      opacity: 1;
    }
}
.nav-item-dropdown {
  min-width: 300px;
}
.navbar-container .fs-16 {
  font-size: 16px;
}
.navbar-container .fs-14 {
  font-size: 14px;
}
.navbar-container .fs-12 {
  font-size: 12px;
}
</style>

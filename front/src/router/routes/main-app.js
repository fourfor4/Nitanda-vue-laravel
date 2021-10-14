export default [
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/error/Error404.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      action: 'read',
    },
  },
  {
    path: '/login',
    name: 'auth-login',
    component: () => import('@/views/wbc/auth/Login.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('@/views/wbc/Dashboard.vue'),
  },
  {
    path: '/dashboard-ranking',
    name: 'dashboard-ranking',
    component: () => import('@/views/wbc/DashboardRanking.vue'),
  },
  {
    path: '/project-card',
    name: 'project-card',
    component: () => import('@/views/wbc/ProjectCard.vue'),
    meta: {
      contentClass: 'project-card',
      pageTitle: 'プロジェクト',
      breadcrumb: [
        {
          text: 'プロジェクト',
        },
      ],
    },
  },
  {
    path: '/project-management',
    name: 'project-management',
    component: () => import('@/views/wbc/ProjectManagement.vue'),
    meta: {
      contentClass: 'project-management',
      pageTitle: 'タスク管理',
      breadcrumb: [
        {
          text: 'テストプロジェクト',
        },
        {
          text: 'かんばん',
        },
      ],
    },
  },
  {
    path: '/qa-dashboard',
    name: 'qa-dashboard',
    component: () => import('@/views/wbc/QAdashboard.vue'),
    meta: {
      contentClass: 'qa-dashboard',
      pageTitle: 'Q&A',
      breadcrumb: [
        {
          text: 'Q&A',
        },
      ],
    },
  },
  {
    path: '/qa-list',
    name: 'qa-list',
    component: () => import('@/views/wbc/QAlist.vue'),
    meta: {
      contentClass: 'qa-list',
      pageTitle: 'Q&A',
      breadcrumb: [
        {
          text: 'Q&A',
        },
      ],
    },
  },
  {
    path: '/wbc-register',
    name: 'wbc-register',
    component: () => import('@/views/wbc/WBCregister.vue'),
    meta: {
      contentClass: 'wbc-register',
      pageTitle: 'ユーザ',
      breadcrumb: [
        {
          text: '新規登録',
        },
      ],
    },
  },
  {
    path: '/user-list',
    name: 'user-list',
    component: () => import('@/views/wbc/UserList.vue'),
  },
  {
    path: '/workspace',
    name: 'workspace',
    component: () => import('@/views/wbc/Workspace/Workspace.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'workspace-application',
    },
  }
]
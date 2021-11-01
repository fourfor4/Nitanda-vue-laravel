export default [
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/Modules/views/error/Error404.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      action: 'read',
    },
  },
  {
    path: '/dashboard/',
    name: 'dashboard',
    component: () => import('@/Modules/views/app/Dashboard/index.vue'),
  },
  {
    path: '/dashboard/:label',
    name: 'dashboard-label',
    component: () => import('@/Modules/views/app/Dashboard/index.vue'),
    meta: {
      navActiveLink: 'dashboard',
    },
    beforeEnter(to, _, next) {
      if (['ranking', 'post', 'bookmark', 'teamtask'].includes(to.params.label)) next()
      else next({ name: 'error-404' })
    },
  },
  {
    path: '/qa',
    name: 'qa',
    component: () => import('@/Modules/views/app/Q&A/index.vue'),
    meta: {
      contentClass: 'qa',
      pageTitle: 'Q&A',
      breadcrumb: [
        {
          text: 'Q&A'
        }
      ]
    }
  },
  {
    path: '/qa/list',
    name: 'qa-list',
    component: () => import('@/Modules/views/app/Q&A/List.vue'),
    meta: {
      contentClass: 'qa-list',
      pageTitle: 'Q&A',
      breadcrumb: [
        {
          text: 'List'
        }
      ]
    }
  },
  {
    path: '/user/register',
    name: 'user-register',
    component: () => import('@/Modules/views/app/User/Register.vue'),
  },
  {
    path: '/user/list',
    name: 'user-list',
    component: () => import('@/Modules/views/app/User/List.vue'),
  },
  {
    path: '/user/list/:userId',
    name: 'user-edit',
    component: () => import('@/Modules/views/app/User/Edit.vue')
  }
]
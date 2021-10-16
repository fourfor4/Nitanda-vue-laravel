export default [
  {
    path: '/login',
    name: 'auth-login',
    component: () => import('@/Modules/views/auth/Login.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
]
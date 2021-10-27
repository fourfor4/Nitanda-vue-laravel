export default {
  apiBaseUrl: 'http://localhost:8000/api/',
  serverUrl: 'http://localhost:8000/',
  
  BROADCAST_DRIVER: 'pusher',
  PUSHER_APP_ID: '1285305',
  PUSHER_APP_KEY: 'd32d72e2aa98c153b7ad',
  PUSHER_APP_SECRET: '266fe295498a161fafd9',
  PUSHER_APP_CLUSTER: 'ap3',

  message: {
    auth: {
      success: {
        login_success: '',
        register_success: ''      
      },
      warning: {
        employee_id_exsited: '',
        login_id_exsited: ''
      },
      error: {
        login_failed: '',
      }
    },
    qa: {

    }
  }
}
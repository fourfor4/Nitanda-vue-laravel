import mock from '@/@fake-db/mock'
import { paginateArray, sortCompare } from '@/@fake-db/utils'

/* eslint-disable global-require */
const data = {
  users: [
    
  ],
}
/* eslint-enable */

// ------------------------------------------------
// GET: Return Users
// ------------------------------------------------
mock.onGet('/apps/user/users').reply(config => {
  // eslint-disable-next-line object-curly-newline
  const {
    q = '',
    perPage = 10,
    page = 1,
    sortBy = 'id',
    sortDesc = false,
    role = null,
    plan = null,
    status = null,
  } = config.params
  /* eslint-enable */

  const queryLowered = q.toLowerCase()
  const filteredData = data.users.filter(
    user =>
      /* eslint-disable operator-linebreak, implicit-arrow-linebreak */
      (user.username.toLowerCase().includes(queryLowered) || user.fullName.toLowerCase().includes(queryLowered)) &&
      user.role === (role || user.role) &&
      user.currentPlan === (plan || user.currentPlan) &&
      user.status === (status || user.status),
  )
  /* eslint-enable  */

  const sortedData = filteredData.sort(sortCompare(sortBy))
  if (sortDesc) sortedData.reverse()

  return [
    200,
    {
      users: paginateArray(sortedData, perPage, page),
      total: filteredData.length,
    },
  ]
})

// ------------------------------------------------
// POST: Add new user
// ------------------------------------------------
mock.onPost('/apps/user/users').reply(config => {
  // Get event from post data
  const { user } = JSON.parse(config.data)

  // Assign Status
  user.status = 'active'

  const { length } = data.users
  let lastIndex = 0
  if (length) {
    lastIndex = data.users[length - 1].id
  }
  user.id = lastIndex + 1

  data.users.push(user)

  return [201, { user }]
})

// ------------------------------------------------
// GET: Return Single User
// ------------------------------------------------
mock.onGet(/\/apps\/user\/users\/\d+/).reply(config => {
  // Get event id from URL
  let userId = config.url.substring(config.url.lastIndexOf('/') + 1)

  // Convert Id to number
  userId = Number(userId)

  const userIndex = data.users.findIndex(e => e.id === userId)
  const user = data.users[userIndex]

  if (user) return [200, user]
  return [404]
})

import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({

  routes: [
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    {
      path: '/animizz',
      component: Home,
      children: [
        { path: 'mine', component: Home.components.mine },
        { path: 'group', component: Home.components.group },
        { path: 'explore', component: Home.components.explore }
      ]
    }
  ]
})

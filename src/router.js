import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({

  routes: [
    { path: '/', redirect: '/login' },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    {
      path: '/animizz',
      component: Home,
      children: [
        { path: 'mine', component: Home.components.mine },
        { path: 'setting', component: Home.components.setting },
        { path: 'explore', component: Home.components.explore },
        { path: 'animes', component: Home.components.animes },
        { path: 'timeline', component: Home.components.timeline }
      ]
    }
  ]
})

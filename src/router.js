import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login.vue'
import animation from './components/Anime.vue'
import Register from './views/Register.vue'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({

  routes: [
    { path: '/', redirect: '/login' },
    { path: '/login', component: Login },
    { path: '/animation', component: animation },
    { path: '/register', component: Register },
    {
      path: '/animizz',
      component: Home,
      children: [
        { path: 'mine', component: Home.components.mine },
        { path: 'setting', component: Home.components.setting },
        { path: 'explore', component: Home.components.explore }
      ]
    }
  ]
})

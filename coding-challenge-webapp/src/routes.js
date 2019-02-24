import Vue from 'vue'
import Router from 'vue-router'

import index from './pages/index'
import schools from './pages/schools'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [{
    path: '',
    component: index
  }, {
    path: '/schools',
    component: schools
  }]
})

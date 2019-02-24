// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'

Vue.config.productionTip = false


const NotFound = {
    template: '<p>Page not found</p>'
}
const Home = {
    template: '<p>home page</p>'
}
const About = {
    template: '<p>about page</p>'
}

const routes = {
    '/': Home,
    '/about': About
}

/* eslint-disable no-new */
new Vue({
    el: '#app',
    data: {
        currentRoute: window.location.pathname
    },
    computed: {
        ViewComponent() {
            return routes[this.currentRoute] || NotFound
        }
    },
    render(h) {
        return h(this.ViewComponent)
    }
})

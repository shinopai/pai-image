import { createRouter, createWebHistory } from 'vue-router'
import ImageList from './components/pages/ImageList.vue'
import ImageDetail from './components/pages/ImageDetail.vue'

const routes = [
  { path: '/',
    component: ImageList,
    props: route => {
      const page = route.query.page
      return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1}
  }},
  { path: '/images/:id',
    name: 'detail',
    component: ImageDetail,
    props: true
  }
]

const router = createRouter({
  history: createWebHistory(),
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes
})

export default router
import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import EditorTable from '@/components/EditorTable'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path: '/table',
      name: 'Table',
      component: EditorTable
    }
  ]
})

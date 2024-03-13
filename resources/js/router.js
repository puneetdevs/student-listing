import { createRouter, createWebHistory } from 'vue-router';
import List from './Pages/Student/List.vue';

const routes = [
  { path: '/student', component: List },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
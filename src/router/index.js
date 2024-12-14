// import vue router
import { createRouter, createWebHistory } from "vue-router";

// define routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
  },
  // Route for Products
  {
    path: "/produks",
    name: "produks.index",
    component: () =>
      import(
        /* webpackChunkName: "produk-index" */ "../views/produks/index.vue"
      ),
  },
  {
    path: "/produks/create", // Ensuring plural naming consistency here
    name: "produks.create",
    component: () =>
      import(
        /* webpackChunkName: "produk-create" */ "../views/produks/create.vue"
      ),
  },
  {
    path: "/produks/edit/:id", // Plural path consistency
    name: "produks.edit",
    component: () =>
      import(/* webpackChunkName: "produk-edit" */ "../views/produks/edit.vue"),
  },
  // Route for Contacts
  {
    path: "/kontaks",
    name: "kontaks.index",
    component: () =>
      import(
        /* webpackChunkName: "kontak-index" */ "../views/kontaks/index.vue"
      ),
  },
  {
    path: "/kontaks/create",
    name: "kontaks.create",
    component: () =>
      import(
        /* webpackChunkName: "kontak-create" */ "../views/kontaks/create.vue"
      ),
  },
  {
    path: "/kontaks/edit/:id",
    name: "kontaks.edit",
    component: () =>
      import(/* webpackChunkName: "kontak-edit" */ "../views/kontaks/edit.vue"),
  },
];

// create router
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

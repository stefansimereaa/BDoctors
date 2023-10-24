import { createApp } from "vue";
import chart from "./js/chart";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";

import Main from "./components/Main.vue";
import ProfilePage from "./pages/ProfilePage.vue";
import FilterPage from "./pages/FilterPage.vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faStar as faSolidStar } from "@fortawesome/free-solid-svg-icons";
import { faStar as faRegularStar } from "@fortawesome/free-regular-svg-icons";
library.add(faSolidStar);
library.add(faRegularStar);

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", name: "main", component: Main },
    { path: "/ginecologo", name: "ginecologo", component: FilterPage },
    { path: "/ortopedico", name: "ortopedico", component: FilterPage },
    { path: "/dermatologo", name: "dermatologo", component: FilterPage },
    { path: "/nutrizionista", name: "nutrizionista", component: FilterPage },
    { path: "/psicologo", name: "psicologo", component: FilterPage },
    { path: "/oculista", name: "oculista", component: FilterPage },
    { path: "/urologo", name: "urologo", component: FilterPage },
    { path: "/otorino", name: "otorino", component: FilterPage },
    { path: "/cardiologo", name: "cardiologo", component: FilterPage },
    { path: "/dentista", name: "dentista", component: FilterPage },
    { path: "/profiles/:id", name: "profile", component: ProfilePage },
    { path: "/filters", name: "filter", component: FilterPage },

    // { path: '/about', component: About },
  ], //provides routes options in an array
});

createApp(App)
  .use(router)
  .component("font-awesome-icon", FontAwesomeIcon)
  .mount("#app");

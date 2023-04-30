import {createRouter, createWebHistory} from 'vue-router';

const routes = [
    {
        name: 'news.show',
        path: '/news/show/:id',
        component: () => import('../components/news/Show.vue'),
    },
    {
        name: 'news.create',
        path: '/news/create',
        component: () => import('../components/news/Create.vue'),
    },
    {
        name: 'news.update',
        path: '/news/update/:id',
        component: () => import('../components/news/Update.vue'),
    },
    {
        name: 'news.all',
        path: '/all',
        component: () => import('../components/news/All.vue'),
    },
    {
        name: 'user.register',
        path: '/user/register',
        component: () => import('../components/user/Registration.vue'),
    },
    {
        name: 'user.login',
        path: '/user/login',
        component: () => import('../components/user/Login.vue'),
    },
    {
        name: 'user.personal',
        path: '/user/personal',
        component: () => import('../components/user/Personal.vue'),
    },
    {
        path: '/page/404',
        name: '404',
        component: () => import('../components/misc/NotFound.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    const admin = localStorage.getItem('x_secret') === "yes";
    if (!token) {
        if (to.name === 'user.login' || to.name === 'news.all'|| to.name === 'news.show' || to.name === 'user.register') {
            return next();
        } else {
            return next({
                name: 'user.login',
            });
        }
    }


    if ((to.name === 'user.login' || to.name === 'user.register') && token) {
        return next({
            name: 'user.personal',
        });
    }
    if(!token || !admin){
        if(to.name === 'news.update' || to.name === 'news.create'){
            return next({
                name: 'news.all',
            });
        }
    }

    return next();
});

export default router;

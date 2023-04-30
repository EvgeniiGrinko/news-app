<template>

        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand m-1 p-2">News</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link :to="{ name: 'news.all'}" class="nav-link">All News</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="admin" :to="{ name: 'news.create'}" class="nav-link">Create News</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="!token" :to="{ name: 'user.login'}" class="nav-link">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="!token" :to="{ name: 'user.register'}" class="nav-link">Register</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="token" :to="{ name: 'user.personal'}" class="nav-link">Personal</router-link>
                        </li>
                        <li class="nav-item">
                            <a  v-if="token" @click.prevent="logout" href="#"  class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <br>
        <br>
        <br>
        <br>
        <main role="main" class="container m-4">
            <router-view @updatetoken="updatetoken" ></router-view>
        </main>
</template>

<script>

export default {

    name: "Index",
    data() {
        return {
            token: null,
            admin: false
        }
    },
    mounted(){
        this.getToken()
    },
    updated(){
        this.getToken()
    },
    methods: {
        getToken(){
            this.token = localStorage.getItem("x_xsrf_token")
            this.admin = localStorage.getItem('x_secret') === "yes"

        },
        updatetoken(value){
            this.token = value
            this.admin = localStorage.getItem('x_secret') === "yes"
        },
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem("x_xsrf_token");
                    localStorage.removeItem("token");
                    localStorage.removeItem("x_secret");
                    this.token = null
                    this.admin = false
                    this.$router.push({
                        name: 'user.login'
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>

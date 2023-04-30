<template>
    <main class="form-login w-25 m-auto">
        <form>
            <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>
            <div class="form-floating">
                <input v-model="email" type="email" class="form-control mt-3 mb-3" id="floatingInput"
                       placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input v-model="password" type="password" class="form-control mb-3" id="floatingPassword"
                       placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <input @click.prevent="login" class="w-100 btn btn-lg btn-primary mt-1" value="Login" type="submit"
                   :disabled="disabled">
        </form>
    </main>
</template>

<script>

export default {
    emits: ['updatetoken'],
    name: "Login",
    data() {
        return {
            email: null,
            password: null,
            disabled: false,
            errors: [],
            token: null

        }
    },
    updated() {

    },
    methods: {
        login() {
            this.errors = [];

            if (!this.email) {
                this.errors.push('Email is required.');
            }
            if (!this.password) {
                this.errors.push('Password is required.');
            }
            this.disabled = true
            setTimeout(() => {
                this.disabled = false
                this.errors = []
            }, 7000)
            if (this.email && this.password) {
                axios.get('/sanctum/csrf-cookie')
                    .then(response => {
                        axios.post('/login', {
                            email: this.email,
                            password: this.password,
                        }).then(respon => {
                            axios.get('/api/token/create')
                                .then(response => {
                                    localStorage.setItem("x_xsrf_token", response.config.headers["X-XSRF-TOKEN"]);
                                    localStorage.setItem("token", response.data.token);
                                    localStorage.setItem("x_secret", response.data.admin);
                                    this.$emit('updatetoken', response.config.headers["X-XSRF-TOKEN"])
                                    this.$router.push({name: 'user.personal'})
                                });
                        });

                    });
            }
        }
    }
}
</script>

<style scoped>

</style>


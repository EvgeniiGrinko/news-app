<template>
    <main class="form-signin w-25 m-auto">
        <form>
            <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1>
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>
            <div class="form-floating">
                <input v-model="name" type="text" class="form-control mt-3 mb-3" id="floatingInputName"
                       placeholder="name" required :disabled="disabled">
                <label for="floatingInputName">Name</label>
            </div>
            <div class="form-floating">
                <input v-model="email" type="email" class="form-control mb-3" id="floatingInputEmail"
                       placeholder="name@example.com" required>
                <label for="floatingInputEmail">Email address</label>
            </div>
            <div class="form-floating">
                <input v-model="password" type="password" class="form-control mb-3" id="floatingPassword"
                       placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input v-model="password_confirmation" type="password" class="form-control mb-3"
                       id="floatingConfirmPassword"
                       placeholder="Confirm Password" required>
                <label for="floatingConfirmPassword">Confirm Password</label>
            </div>

            <input @click.prevent="register" class="w-100 btn btn-lg btn-primary mt-1" value="Register" type="submit"
                   :disabled="disabled">
        </form>
    </main>
</template>

<script>

export default {
    name: "Registration",
    emits: ['updatetoken'],

    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            disabled: false,
            errors: [],
        }
    },
    updated() {

    },
    methods: {
        register() {
            this.errors = [];

            if (!this.name) {
                this.errors.push('Name is required.');
            }
            if (!this.email) {
                this.errors.push('Email is required.');
            }
            if (!this.password) {
                this.errors.push('Password is required.');
            }
            if (!this.password_confirmation) {
                this.errors.push('Password confirmation is required.');
            }
            this.disabled = true
            setTimeout(() => {
                this.disabled = false
                this.errors = []
            }, 2000)
            if (this.name && this.email && this.password && this.password_confirmation) {
                axios.get('/sanctum/csrf-cookie')
                    .then(response => {
                        axios.post('/register', {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.password_confirmation,
                        })
                            .then(r => {
                                axios.get('api/tokens/create').then(response => {
                                    localStorage.setItem("x_xsrf_token", response.config.headers["X-XSRF-TOKEN"]);
                                    localStorage.setItem("x_secret", 'no');
                                    this.$emit('updatetoken', response.config.headers["X-XSRF-TOKEN"])
                                    this.$router.push({name: 'user.personal'})
                                })
                            });
                    });
            }
        }
    }
}
</script>

<style scoped>

</style>


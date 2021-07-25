<template>
    <AuthWrap>
        <Card v-if="mustVerifyEmail">
            <h4 class="title text-center mt-4">
                Register
            </h4>
            <div class="alert alert-success" role="alert">
                We sent you an email with an the verification link.
            </div>
        </Card>
        <form v-else @submit.prevent="signUp" class="form-box px-3">
            <h4 class="title text-center mt-4">
                Register
            </h4>

            <div class="mt-3" v-if="error">
                <b-alert variant="danger" show>{{ error }}</b-alert>
            </div>

            <div class="form-group">
                <label for="email" class="label">Email Address</label>
                <b-form-input
                    :state="null"
                    placeholder="Enter your email"
                    type="email"
                    class="form-control"
                    required
                    v-model="user.email"
                />
            </div>
            <div class="form-group">
                <label for="password" class="label">Password</label>
                <b-form-input
                    :state="null"
                    placeholder="Enter a password"
                    class="form-control"
                    type="password"
                    required
                    v-model="user.password"
                />
            </div>
            <div class="form-group">
                <label for="password" class="label">Confirm password</label>
                <b-form-input
                    :state="null"
                    placeholder="Enter password again"
                    class="form-control"
                    type="password"
                    required
                    v-model="user.password_confirmation"
                />
            </div>

            <div class="mt-3">
                <b-button :disabled="loading" type="submit" class="btn btn-block">
                    Register
                </b-button>
            </div>

            <div class="row pt-3">
                <h2 class="alternative"><span>OR</span></h2>
            </div>

            <div class="mt-3">
                <router-link :to="{name: 'register'}" class="btn btn-block btn-social">
                    <span class="pr-2"><i class="fa fa-google"></i></span>
                    Sign up with Google
                </router-link>
            </div>

            <br class="my-4">

            <div class="text-center mb-2 register">
                Don't have an account?
                <router-link :to="{name: 'login'}" class="register-link">
                    Sign In
                </router-link>
            </div>
        </form>
    </AuthWrap>
</template>
<script>
    import Auth from "@/services/auth";
    export default {
    name: "Register",
    data() {
        return {
            user: {},
            error: null,
            mustVerifyEmail: false,
            loading: false,
            access_token: null,
        };
    },
    methods: {
        async signUp() {
            this.loading = true;
            this.error = null;
            const { data, success, message, errors=null } = await Auth.register(this.user);
            if (message) {
                this.loading = false;
            }

            if (success) {

                await this.$store.dispatch("auth/saveToken", {
                token: data.token,
                });

                // Fetch the user.
                await this.$store.dispatch("auth/fetchUser");

                // Redirect home.
                this.loading = false;

                this.$router.push({ name: "home" });
                // }
            } else {
                this.error = message+' : '+errors;
            }
        },
    },
    };
</script>

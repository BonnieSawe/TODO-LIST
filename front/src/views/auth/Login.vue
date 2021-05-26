<template>
  <AuthWrap>
    <form @submit.prevent="login" class="form-box px-3">
      
      <h4 class="title text-center mt-4">
          Sign In
      </h4>
      <div class="form-group">
          <label for="email" class="label">Email Address</label>
          <b-form-input
            :state="null"
            placeholder="Email"
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
            placeholder="Password"
            class="form-control"
            type="password"
            required
            v-model="user.password"
          />
      </div>
      
      <div class="mt-3" v-if="error">
        <b-alert variant="danger" show>{{ error }}</b-alert>
      </div>

      <div class="text-right">
          <router-link :to="{name: 'forgot-password'}" class="forget-link">
              Forgot Password?
          </router-link>
      </div>

      <div class="mt-3">
          <b-button :disabled="loading" type="submit" class="btn btn-block">
              Sign In
          </b-button>
      </div>

      <div class="row pt-3">
            <h2 class="alternative"><span>OR</span></h2>
        </div>

        <div class="mt-3">
<<<<<<< HEAD
            <router-link :to="{name: 'register'}" class="btn btn-block btn-social">
                <span class="pr-2"><i class="fa fa-google"></i></span>
                Sign In with Google
            </router-link>
=======
            <b-button @click="socialLogin" class="btn btn-block btn-social">
                <span class="pr-2"><i class="fa fa-google"></i></span>
                Sign In with Google
            </b-button>
>>>>>>> develop
        </div>

        <br class="my-4">

        <div class="text-center mb-2 register">
            Don't have an account?
            <router-link :to="{name: 'register'}" class="register-link">
                Register here
            </router-link>
        </div>
    </form>
  </AuthWrap>
</template>
<script>
import Auth from "@/services/auth";
export default {
  name: "Login",
  data() {
    return {
      user: {
<<<<<<< HEAD
        email: "bonnie@syntax.com",
        password: "secret",
=======
        email: "badboneye@gmail.com",
        password: "123456",
>>>>>>> develop
      },
      error: null,
      loading: false,
    };
  },
  methods: {
<<<<<<< HEAD
=======
    async socialLogin(){
      const data = await Auth.socialLogin('google');
      console.log(data);
    },
>>>>>>> develop
    async login() {
      this.loading = true;
      const { data, success, message } = await Auth.login(this.user);

      if (message) {
        this.loading = false;
      }
<<<<<<< HEAD

      if (success) {
        await this.$store.dispatch("auth/saveToken", {
          token: data.access_token,
          remember: this.rememberMe,
=======
      if (success) {
        await this.$store.dispatch("auth/saveToken", {
          token: data.token,
>>>>>>> develop
        });

        // Fetch the user.
        await this.$store.dispatch("auth/fetchUser");

        // Redirect home.
        this.loading = false;

        this.$router.push({ name: "home" });
      } else {
        this.error = message;
      }
    },
  },
};
</script>

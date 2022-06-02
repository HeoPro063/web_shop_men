<template>
  <main class="d-flex w-100">
    <div class="container d-flex flex-column">
      <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">
            <div class="card">
              <div class="card-body">
                <div class="m-sm-4">
                  <div class="w-100 mb-3"></div>
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                      class="form-control form-control-lg"
                      :class="{'is-invalid' : errors.has('email')}"
                      type="text"
                      v-model="formData.email"
                      v-validate="'required'"
                      name="email"
                      placeholder="Enter your email"
                    />
                    <span class="text text-danger">{{ errors.first('email') }}</span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                      class="form-control form-control-lg"
                      :class="{'is-invalid' : errors.has('password')}"
                      type="password"
                      v-model="formData.password"
                      v-validate="'required'"
                      name="password"
                      placeholder="Enter your password"
                    />
                    <span class="text text-danger">{{ errors.first('password') }}</span>
                  </div>
                  <div>
                    <label class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        v-model="formData.remember"
                        name="remember"
                      />
                      <span class="form-check-label">Remember me next time</span>
                    </label>
                  </div>
                  <div class="text-center mt-3">
                    <button
                      type="button"
                      @click="submitLogin"
                      class="btn btn-lg btn-primary"
                    >Sign in</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import httpStore from "@core/config/httpStore";
export default {
  data() {
    return {
      formData: {
        email: null,
        password: null,
        remember: null
      }
    };
  },
  methods: {
    submitLogin() {
      let scop = this;
      scop.$validator.validate().then(valid => {
        if (valid) {
          this.$loading(true);
          httpStore
            .dispatch("post", {
              url: scop.baseUrl("post-login-admin"),
              data: scop.formData
            })
            .then(response => {
              if (response.status === 200) {
                window.location.href = scop.baseUrl("/dashboard");
              } else {
                this.$toast.open({
                  message: response.message,
                  type: "error",
                  duration: 2000,
                  dismissible: true,
                  position: "top"
                });
              }
            })
            .catch(error => {
              this.$toast.open({
                message: "Error login",
                type: "error",
                duration: 2000,
                dismissible: true,
                position: "top"
              });
            }).finally(() => {
              this.$loading(false);
            });
        }
      });
    }
  }
};
</script>

<style>
</style>
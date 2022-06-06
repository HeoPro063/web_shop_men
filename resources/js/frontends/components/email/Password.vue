<template>
  <div class="container-lg">
    <div class="row">
      <div class="confirm-steps">
        <div class="confirm-steps-content d-flex justify-content-center">
          <div class="registration_steps d-flex justify-content-center align-items-center">
            <ul class="nav nav-tabs justify-content-around w-100" id="myTab" role="tablist">
              <li
                class="nav-item flex-fill steps-number"
                role="presentation"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
              >
                <a
                  class="nav-link  rounded-circle me-3 d-flex align-items-center justify-content-center"
                  href="#step1"
                  id="step1-tab"
                  data-bs-toggle="tab"
                  role="tab"
                  aria-controls="step1"
                  aria-selected="true"
                >
                  <i class="fas fa-folder-open"></i>
                </a>
                <p class="steps-text">Xác minh email</p>

                <div class="steps-border"></div>
              </li>
              <li
                class="nav-item flex-fill steps-number"
                role="presentation"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
              >
                <a
                  class="nav-link active rounded-circle me-3 d-flex align-items-center justify-content-center"
                  href="#step2"
                  id="step2-tab"
                  data-bs-toggle="tab"
                  role="tab"
                  aria-controls="step2"
                  aria-selected="false"
                >
                  <i class="fas fa-briefcase"></i>
                </a>
                <p class="steps-text">Tạo mật khẩu</p>

                <div class="steps-border"></div>
              </li>
              <li
                class="nav-item flex-fill steps-number"
                role="presentation"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
              >
                <a
                  class="nav-link rounded-circle d-flex align-items-center justify-content-center"
                  href="#step3"
                  id="step3-tab"
                  data-bs-toggle="tab"
                  ata-bs-toggle="tab"
                  role="tab"
                  aria-controls="step3"
                  aria-selected="false"
                >
                  <i class="fas fa-star"></i>
                </a>
                <p class="steps-text">Hoàn thành</p>
              </li>
            </ul>
            <div class="tab-content pt-5" id="myTabContent">
             
              <div
                class="form-confirm  p-4"
                role="tabpanel"
                id="step2"
                aria-labelledby="step2-tab"
              >
                <form>
                  <div class="back-register d-flex justify-content-between align-items-center">
                    <a  :href="baseUrl(`email/confirm?email=${emailUser}`)" class="link-back previous met-may-qua">&larr;</a>
                    <h2 v-if="checkaccountpassword" class="form-confirm-title text-center" style="padding-right: 159px">Tạo mật khẩu</h2>
                    <h2 v-else class="form-confirm-title text-center" style="padding-right: 159px">Tài khoản đã được đăng kí</h2>
                    <a class="link-back previous met-may-qua">&rarr;</a>
                  </div>
                  <div v-if="checkaccountpassword" class="ps-5 pe-5">
                    <div class="form-group-confirm pb-5">
                      <label for="password" class="pb-3" >Mật Khẩu</label>
                      <input v-model="password" v-validate="'required|min:6'" name="password" type="password"  class="form-confirm-number" placeholder="Password" ref="password">
                      <span class="text text-danger">{{ errors.first('password') }}</span>

                    </div>
                    <div class="form-group-confirm pb-5">
                      <label for="enterthepassword" class="pb-3" >Nhập Lại Mật Khẩu</label>
                      <input  v-model="re_password" v-validate="'required|confirmed:password'" name="password_confirmation" type="password"  class="form-confirm-number" placeholder="Password, Again" data-vv-as="password">
                      <span class="text text-danger">{{ errors.first('password_confirmation') }}</span>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="button" @click="submitPassword()" class="next">Xác nhận</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import httpStore from "@core/config/httpStore";

export default {
  props: {
    email: {
      type: String,
      default: () => {
        return '';
      }
    }
  },
  created() {
    this.checkAccoutPassword();
  },
  data() {
    return {
      emailUser: this.email,
      textTitle: "Vui lòng lòng nhấn 'Lấy mã xác nhận'",
      statusCheck: true,
      checkemail: true,
      token: null,
      checkaccountpassword: true,
      password:null,
      re_password: null
    }
  },
  methods: {
    checkEmail() {
        let scop = this;
        scop.checkemail = false;
        scop.textTitle = "Vui lòng chờ, đang kiểm tra email của bạn..."
        let formData = {
          email: scop.emailUser
        }
        httpStore
          .dispatch("post", {
              url: scop.baseUrl("check-email"),
              data: formData,
          })
          .then(response => {
              if(response.status === 200) {
                scop.textTitle = "Kiểm tra tin nhắn email đển nhận mã xác minh";
                scop.checkemail = true;
                cop.$toast.open({
                  message: "Success",
                  type: "Success",
                  duration: 4000,
                  dismissible: true,
                  position: "top"
                });
              }else{
                scop.textTitle = "Email của bạn không tồn tại!";
                scop.statusCheck = false;
                cop.$toast.open({
                  message: "Error",
                  type: "error",
                  duration: 4000,
                  dismissible: true,
                  position: "top"
                });
              }
          })
          .catch(error => {
              scop.$toast.open({
                  message: "Error",
                  type: "error",
                  duration: 2000,
                  dismissible: true,
                  position: "top"
              });
          }).finally(() => {
          });

    },
    submitPassword() {
      let scop = this;
      let formData = {
        email: scop.emailUser,
        password: scop.password,
        password_confirmation: scop.re_password,
      }
      scop.$validator.validate().then(valid => {
          if(valid) {
            httpStore
              .dispatch("post", {
                  url: scop.baseUrl(`register-password`),
                  data: formData
              })
              .then(response => {
                  if(response.status === 200) {
                    this.$loading(true);
                    window.location.href = scop.baseUrl(`register-done`);
                  }else{
                       scop.$toast.open({
                          message: "Erro password",
                          type: "error",
                          duration: 2000,
                          dismissible: true,
                          position: "top"
                      });
                  }
              })
              .catch(error => {
                  scop.$toast.open({
                      message: "Error",
                      type: "error",
                      duration: 2000,
                      dismissible: true,
                      position: "top"
                  });
              }).finally(() => {
              });
          }
        });

    },
    checkAccoutPassword() {
      let scop = this;
      this.$loading(true);
       httpStore
              .dispatch("get", {
                  url: scop.baseUrl(`check-accout-view-passowrd?email=${scop.emailUser}`),
              })
              .then(response => {
                  if(response.status === 201) {
                      this.checkaccountpassword = false
                  }else if(response.status === 400){
                     window.location.href = scop.baseUrl(
                      `register`
                    );
                  }else{
                    
                  }
              })
              .catch(error => {
                  scop.$toast.open({
                      message: "Error",
                      type: "error",
                      duration: 2000,
                      dismissible: true,
                      position: "top"
                  });
              }).finally(() => {
                this.$loading(false);
              });
    },
    
  }

};
</script>

<style lang="scss" scoped>
.dorp-no{
  cursor: no-drop;
}
.span-format-a{
  cursor: pointer;
}
.met-may-qua{
  text-decoration: none;
}
</style>
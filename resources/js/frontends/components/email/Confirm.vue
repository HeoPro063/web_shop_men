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
                  class="nav-link active rounded-circle me-3 d-flex align-items-center justify-content-center"
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
                  class="nav-link rounded-circle me-3 d-flex align-items-center justify-content-center"
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
                class="form-confirm tab-pane fade show active p-4"
                role="tabpanel"
                id="step1"
                aria-labelledby="step1-tab"
              >
                <form>
                  <div class="back-register d-flex justify-content-between align-items-center">
                    <a :href="baseUrl('register')" class="link-back text-decoration-none">&larr;</a>
                    <h2 class="form-confirm-title" v-if="checkaccount">Vui lòng nhập mã xác minh</h2>
                    <h2
                      style="display: flex;
                        justify-content: center;
                        font-size: 22px;
                        font-weight: 400;"
                      v-else
                    >Tài khoản của bạn đã được xác minh rồi</h2>
                    <a v-if="!checkaccount" :href="baseUrl(`email/password?email=${emailUser}`)" class="link-back text-decoration-none">&rarr;</a>
                  </div>
                  <div v-if="checkaccount" class="ps-5 pe-5">
                    <div class="form-description text-center pt-5 pb-5">
                      <p class="description-text">{{textTitle}}</p>
                      <p class="description-text pt-4">{{emailUser}}</p>
                    </div>
                    <div class="form-group-confirm pb-5">
                      <input
                        name="token"
                        v-validate="'required'"
                        type="text"
                        v-model="token"
                        class="form-confirm-number"
                        :class="{'dorp-no': !statusCheck}"
                        :disabled="!statusCheck"
                      />
                      <span class="text text-danger">{{ errors.first('token') }}</span>
                      <br />
                      <span
                        class="text text-danger span-format-a"
                        v-if="checkemail"
                        @click="checkEmail"
                      >Lấy mã xác nhận</span>
                      <span class="text span-format-a dorp-no" v-else>Vui lòng chờ</span>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button
                        type="button"
                        v-if="statusCheck"
                        @click="submitRegister"
                        class="next"
                      >Xác nhận</button>
                      <a
                        v-else
                        class="next text-danger"
                        :href="baseUrl('register')"
                      >Quay lại trang đăng kí</a>
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
        return "";
      }
    }
  },
  created() {
    this.checkAccount();
  },
  data() {
    return {
      emailUser: this.email,
      textTitle: "Vui lòng lòng nhấn 'Lấy mã xác nhận'",
      statusCheck: true,
      checkemail: true,
      token: null,
      checkaccount: true
    };
  },
  methods: {
    checkEmail() {
      let scop = this;
      scop.checkemail = false;
      scop.textTitle = "Vui lòng chờ, đang kiểm tra email của bạn...";
      let formData = {
        email: scop.emailUser
      };
      httpStore
        .dispatch("post", {
          url: scop.baseUrl("check-email"),
          data: formData
        })
        .then(response => {
          if (response.status === 200) {
            scop.textTitle = "Kiểm tra tin nhắn email đển nhận mã xác minh";
            scop.checkemail = true;
            cop.$toast.open({
              message: "Success",
              type: "success",
              duration: 4000,
              dismissible: true,
              position: "top"
            });
          } else {
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
        })
        .finally(() => {});
    },
    submitRegister() {
      let scop = this;
      let formData = {
        email: scop.emailUser,
        token: scop.token
      };
      scop.$validator.validate().then(valid => {
        if (valid) {
          httpStore
            .dispatch("post", {
              url: scop.baseUrl(`check-token`),
              data: formData
            })
            .then(response => {
              if (response.status === 200) {
                scop.$toast.open({
                  message: "Success",
                  type: "success",
                  duration: 2000,
                  dismissible: true,
                  position: "top"
                });
                window.location.href = scop.baseUrl(
                  `email/password?email=${response.datas.email}`
                );
              } else {
                scop.$toast.open({
                  message: response.datas,
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
            })
            .finally(() => {});
        }
      });
    },
    checkAccount() {
      let scop = this;
      this.$loading(true);

      httpStore
        .dispatch("get", {
          url: scop.baseUrl(
            `check-accoutn-view-comfirm?email=${scop.emailUser}`
          )
        })
        .then(response => {
          if (response.status === 200) {
            this.checkaccount = false;
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
        })
        .finally(() => {
          this.$loading(false);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.dorp-no {
  cursor: no-drop;
}
.span-format-a {
  cursor: pointer;
}
</style>
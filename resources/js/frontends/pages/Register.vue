<template>
    <div class="content-form">
        <form class="form-horizontal" autocomplete="off">
            <h3 class="form-title">Đăng ký</h3>
            <div class="form-banner-group pt-3">
                <input v-model="formData.email" :class="{'is-invalid' : errors.has('email')}" v-validate="'required|email'" type="text" name="email" class="form-banner-control" placeholder="Enter your email">
                <span class="text text-danger">{{ errors.first('email') }}</span>
            </div>
            <div class="bnt-register">
                <button type="button" @click="submitRegister" class="btn-banner">Đăng Ký</button>
            </div>
        </form>
        <hr>
        <div class="content-banner-group">
            <div class="forgot_password d-flex justify-content-center ps-3 pe-3">
                Bạn đã có tài khoản ? 
                <a :href="baseUrl('login')" class="link-forgot_password text-dark ps-1"> Đăng Nhập</a>
            </div>
        </div>
    </div>
</template>

<script>
import httpStore from "@core/config/httpStore";

export default {
    data() {
        return {
            formData: {
                email: null
            }
        }
    },
    methods: {
        submitRegister() {
            let scop = this;
             scop.$validator.validate().then(valid => {
                if (valid) {
                    this.$loading(true);
                     httpStore
                        .dispatch("post", {
                            url: scop.baseUrl("post-register"),
                            data: this.formData,
                        })
                        .then(response => {
                            if(response.status === 200) {
                                window.location.href = scop.baseUrl(`email/confirm?email=${response.datas}`);
                            }else{
                                 this.$toast.open({
                                    message: response.message,
                                    type: "error",
                                    duration: 4000,
                                    dismissible: true,
                                    position: "top"
                                });
                            }
                        })
                        .catch(error => {
                            this.$toast.open({
                                message: "Error",
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
}
</script>

<style>
    .is-invalid{
        border: 1px solid red;
    }
</style>
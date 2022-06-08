<template>
    <div class="modal fade mt-5" id="change-password" tabindex="-1" aria-labelledby="change-password" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: 20px;">
                    <h5 class="modal-title" id="change-password">Đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pass-group pt-4 pb-4">
                        <label for="password">
                            Mật khẩu hiện
                            tại
                        </label>
                        <input v-validate="'required'" v-model="formData.password_old" type="password" name="password" class="email" id="password" />
                    </div>
                    <span class="text text-danger">{{ errors.first('password') }}</span>
                    <span class="text text-danger" v-if="messagePas != null" >{{messagePas}}</span>
                    <div class="pass-group pt-4 pb-4">
                        <label for="password-new" class="pe-4">
                            Mật
                            khẩu mới
                        </label>
                        <input  v-validate="'required|min:6'"  v-model="formData.password_new" type="password" name="password_new"  ref="password" class="email" id="password-new" />
                    </div>
                    <span class="text text-danger">{{ errors.first('password_new') }}</span>
                    <div class="pass-group pt-4 pb-4">
                        <label for="password-enter">
                            Nhập lại mật
                            khẩu
                        </label>
                        <input  v-validate="'required|confirmed:password'" name="password_confirmation" v-model="formData.password_re" type="password" data-vv-as="password" class="email" id="password-enter" />
                    </div>
                    <span class="text text-danger">{{ errors.first('password_confirmation') }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" @click="savePassword()"  class="btn-update">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import httpStore from "@core/config/httpStore";

export default {
    props: {
        id: Number
    },
    data() {
        return {
            formData: {
                id: this.id,
                password_old: null,
                password_new: null,
                password_re: null
            },
            messagePas: ''
        }
    },
    methods: {
        savePassword() {
            let scop = this;
            scop.$validator.validate().then(valid => {
                if(valid) {
                    this.$loading(true);
                    httpStore
                    .dispatch("post", {
                        url: scop.baseUrl(`my-profile/change-password`),
                        data: scop.formData
                    })
                    .then(response => {
                        if(response.status === 200) {
                            location.reload()

                        }else{
                            this.messagePas = 'Mật khẩu không chính xác'
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
                }
            });
        }
    }
}
</script>

<style>

</style>
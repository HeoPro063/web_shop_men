<template>
<div class="tab-pane fade show active bg-transparent" id="account-information" role="tabpanel" aria-labelledby="account-information-tab">
    <p class="tabs-title">Thông tin tài khoản</p>
    <div class="bg-white pages-content-info">
        <p class="information">Thông tin cá nhân</p>
        <form  autocomplete="off">
            <div class="container p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="info-groups d-flex align-items-center">
                            <div class="info-photo">
                                <img :src="formatImage(dataMyprofile.avatar)" alt class="info-avartar" data-bs-toggle="modal" data-bs-target="#info-avartar" />
                                <div class="modal fade" id="info-avartar" tabindex="-1" aria-labelledby="info-avartar" aria-hidden="true">
                                    <div class="modal-dialog" style="margin-top:100px">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="info-avartar">
                                                    Thay
                                                    ảnh đại diện
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="upaload-img">
                                                    <label for="file-avatar" class="upaload-file">tải ảnh lên</label>
                                                    <input type="file" @change="changeAvatar" name="file-avatar" class="file-avatar" id="file-avatar" />
                                                </div>
                                                <div class="text-center show-avatar">
                                                    <img class="img-show-avatar" alt />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <button type="button" @click="saveAvatar" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Lưu ảnh mới</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-name-avartar ps-5 d-flex align-items-center">
                                <label for="name" class="pe-4">Họ và Tên</label>
                                <input type="text" v-model="dataForm.name" name="name" class="info-name-edit" id="name" placeholder="Họ và tên" />
                            </div>
                        </div>
                        <div class="info-groups d-flex align-items-center pt-3">
                            <div class="pe-5">Ngày sinh</div>
                            <div class="info-name-avartar d-flex justify-content-center align-items-center">
                                <select v-model="dataForm.birthday.day" class="form-select me-3" aria-label="Default select example">
                                    <option v-for="(item, index) in 31" :key="index" :value="item">{{item}}</option>
                                </select>
                                <select v-model="dataForm.birthday.month" class="form-select me-3" aria-label="Default select example">
                                    <option v-for="(item, index) in 12" :key="index" :value="item">{{item}}</option>
                                </select>
                                <select v-model="dataForm.birthday.year" class="form-select" aria-label="Default select example">
                                    <option v-for="(item, index) in 70" :key="index" :value="item + 1950">{{item + 1950}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="info-groups d-flex align-items-center pt-3">
                            <div class="w-25">Giới tính</div>
                            <div class="info-name-avartar d-flex w-100 align-items-center pe-5">
                                <div class="male-gender pe-4 d-flex align-items-center">
                                    <input type="radio" name="gender" class="male gender" v-model="dataForm.gender" value="1" id="male" />
                                    <label for="male">Nam</label>
                                </div>
                                <div class="female-gender pe-4 d-flex align-items-center">
                                    <input type="radio" name="gender" class="female gender" v-model="dataForm.gender" value="2" id="female" />
                                    <label for="female" class="me-3">Nữ</label>
                                </div>
                                <div class="male-gender d-flex align-items-center">
                                    <input type="radio" name="gender" class="other gender" v-model="dataForm.gender" value="3" id="other" />
                                    <label for="other">khác</label>
                                </div>
                            </div>
                        </div>
                        <div class="info-groups d-flex align-items-center pt-3">
                            <div class="pe-5">Email</div>
                            <div class="info-name-avartar d-flex w-100 align-items-center ps-4">
                                <div class="emails d-flex align-items-center">
                                    <input :disabled="true" v-model="dataForm.email" type="text" name="email" class="email email-dropno"  />
                                </div>
                            </div>
                        </div>
                        <div class="info-groups d-flex align-items-center pt-3">
                            <div class="number-phones">Số điện thoại</div>
                            <div class="info-name-avartar d-flex w-100 align-items-center ps-2">
                                <div class="emails d-flex align-items-center">
                                    <input @change="ChangeNumber" v-model="dataForm.number_phone" type="number" name="number" class="email"  />
                                </div>
                                <br>
                            </div>

                        </div>
                        <span style="margin-left:130px" v-if="!checkNumber" class="text-danger">Số không hợp lệ</span>

                        <div class="info-groups d-flex align-items-center pt-3">
                            <div class="pe-4 w-25">Mậ khẩu</div>
                            <div class="info-name-avartar d-flex w-100 align-items-center ps-5 pe-5">
                                <button type="button" class="link--forgot-password" data-bs-toggle="modal" data-bs-target="#change-password">Đổi mật khẩu</button>
                                <password :id="dataMyprofile.id"></password>
                            </div>
                        </div>
                        <div class="text-center pt-5">
                            <button @click="saveDataUser" type="button" class="btn btn-secondary">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import httpStore from "@core/config/httpStore";
import Password from "@/frontends/components/user/Password.vue";
import {
    mapGetters,
    mapMutations
} from "vuex";

export default {
    props: {
        datauser: {
            type: Object,
            default: () => {
                return [];
            }
        }
    },
    data() {
        return {
            avatar: null,
            dataMyprofile: {},
            dataForm: {
                name: null,
                birthday: {
                    day: null,
                    month: null,
                    year: null
                },
                gender: null,
                email: null,
                number_phone: null,
            },
            checkNumber: true

        }
    },
    methods: {
        changeAvatar(e) {
            this.avatar = e.target.files[0];
        },
        saveAvatar() {
            let scop = this;
            let formData = new FormData();
            formData.append('file', scop.avatar);
            scop.$loading(true);
            httpStore
                .dispatch("post", {
                    url: scop.baseUrl("my-profile/add-avatar"),
                    data: formData
                })
                .then(response => {
                    if (response.status == 200) {
                        this.getDataUser();
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
                    scop.$loading(false);
                });
        },
        getDataUser() {
            httpStore
                .dispatch("get", {
                    url: this.baseUrl("my-profile/get-data-user"),
                })
                .then(response => {
                    if (response.status === 200) {
                        this.dataMyprofile = response.datas;
                        this.dataForm = {
                            id: this.dataMyprofile.id,
                            name: this.dataMyprofile.username,
                            birthday: {
                                day: this.dataMyprofile.day,
                                month: this.dataMyprofile.month,
                                year: this.dataMyprofile.year
                            },
                            gender: this.dataMyprofile.gender,
                            email: this.dataMyprofile.email,
                            number_phone: this.dataMyprofile.number
                        }
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
                });
        },
        formatImage(img) {
            var avartar;
            if (img) {
                avartar = img;
            } else {
                avartar = 'dafaultUser.png';
            }
            return `uploads/avatars/${avartar}`;
        },
        validPhoneNumber(phoneNumber) {
            let re = /((09|03|07|08|05)+([0-9]{8})\b)/g;

            return re.test(phoneNumber);
        },
        ChangeNumber() {
            let check = this.validPhoneNumber(this.dataForm.number_phone);
            if (check || this.dataForm.number === '') {
                this.checkNumber = true;
            } else {
                this.checkNumber = false;
            }
        },
        saveDataUser() {
            if(this.checkNumber) {
                this.$loading(true);
                httpStore
                    .dispatch("post", {
                        url: this.baseUrl("my-profile/save-data-user"),
                        data: this.dataForm
                    })
                    .then(response => {
                        if (response.status === 200) {
                            this.$toast.open({
                                message: "Success",
                                type: "success",
                                duration: 2000,
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
                    })
                    .finally(() => {
                        this.$loading(false);
                    });
            }else{
                this.$toast.open({
                    message: "Erorr number phone",
                    type: "error",
                    duration: 2000,
                    dismissible: true,
                    position: "top"
                });
            }
          
        }
    },
    created() {
        this.getDataUser();
    },
    components: {
        Password
    }
};
</script>

<style scoped>
.email-dropno {
    cursor: no-drop;
}
</style>

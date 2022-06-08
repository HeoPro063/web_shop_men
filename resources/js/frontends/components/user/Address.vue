<template>
<div class="tab-pane fade bg-transparent with-dmm" id="address" role="tabpanel" aria-labelledby="address-tab">
    <p class="tabs-title">Sổ địa chỉ</p>
    <!-- Button trigger modal -->
    <button type="button" class="bg-white w-100 add-address" data-bs-toggle="modal" data-bs-target="#add-new-address">
        <i class="text-dark fa fa-plus pe-5"></i> Thêm địa chỉ mới
    </button>
    <add-address :id="dataMyprofile.id"></add-address>

    <div v-for="(item, index) in dataAddressUse" :key="index" class="mt-4 w-100 bg-white show-address d-flex p-3 justify-content-between w-100">
        <div class="show-address-info w-75">
            <h6 class="show-add-name">
                {{item.name}}
                <span v-if="item.active" class="show-add-default">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z" />
                    </svg>Địa chỉ mặc địch
                </span>
            </h6>
            <div class="specifically">
                <span>Địa chỉ:</span>
                {{item.address_user}}
            </div>
            <div class="number-phone specifically">
                <span>Điện thoại:</span>
                {{item.phone}}
            </div>
        </div>
        <div class="edit-address w-25">
            <button @click="changeDataDelete(item.id)" type="button" class="btn btn-danger mt-5" data-bs-toggle="modal" data-bs-target="#delete">Xóa</button>
        </div>
    </div>
    <delete-address :iddelete="idDelete"></delete-address>
</div>
</template>

<script>
import httpStore from "@core/config/httpStore";
import AddAddress from "@/frontends/components/user/AddAddress";
import DeleteAddress from "@/frontends/components/user/DeleteAddress";
export default {
    data() {
        return {
            dataMyprofile: {},
            dataAddressUse: [],
            idDelete: null
        };
    },
    methods: {
        getDataUser() {
            httpStore
                .dispatch("get", {
                    url: this.baseUrl("my-profile/get-data-user")
                })
                .then(response => {
                    this.dataMyprofile = response.datas;
                })
                .catch(error => {
                    
                });
        },
        getAddressUser() {
            httpStore
                .dispatch("get", {
                    url: this.baseUrl("my-profile/get-data-address-user")
                })
                .then(response => {
                    if (response.status === 200) {
                        this.dataAddressUse = response.datas;
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
        changeDataDelete(id) {
            this.idDelete = { 'id': id}; 
        }
    },
    components: {
        AddAddress,
        DeleteAddress
    },
    created() {
        this.getDataUser();
        this.getAddressUser();
    }
};
</script>

<style>
.with-dmm {
    height: 600px;
    overflow-x: auto;
}
</style>

<template>
  
    <!-- Modal -->
    <div
      class="modal fade mt-5"
      id="add-new-address"
      tabindex="-1"
      aria-labelledby="add-new-address"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="add-new-address">Tạo địa chỉ mới</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="form">
            <div class="modal-body">
              <div class="add-address-modal d-flex justify-content-start align-items-center">
                <label  class="pe-5">Họ và Tên:</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Họ và tên"
                  v-model="formData.name"
                  v-validate="'required'"
                  name="name"
                />
              </div>
              <span class="text text-danger more-ml-css">{{ errors.first('name') }}</span>
              <div class="add-address-modal d-flex justify-content-start align-items-center pt-4">
                <label  class="pe-4">Số điện thoại:</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Số điện thoại"
                  v-model="formData.phone"
                  v-validate="'required'"
                  name="number"
                />
              </div>
              <span class="text text-danger more-ml-css">{{ errors.first('number') }}</span>
              <div class="add-address-modal d-flex justify-content-start align-items-center pt-4">
                <label class="pe-2">Tỉnh thành phố:</label>
                <select
                  v-model="formData.province_id"
                  @change="changeProvince"
                  class="form-control"
                  aria-label="Default select example"
                  v-validate="'required'"
                  name="province"
                >
                  <option :value="null" selected>Chọn tỉnh/thành phố</option>
                  <option v-for="(item, index) in dataAddresses.province" :key="index" :value="item.id">{{item.name}}</option>
                </select>
              </div>
              <span class="text text-danger more-ml-css">{{ errors.first('province') }}</span>
              <div class="add-address-modal d-flex justify-content-start align-items-center pt-4">
                <label class="add-address-city">Quận huyện:</label>
                <select
                :disabled="activeAddress.districts"
                  class="form-control"
                  aria-label="Default select example"
                  v-model="formData.districts_id"
                  @change="changeDistricts"
                  v-validate="'required'"
                  name="districts"
                >
                  <option :value="null" selected>Chọn Quận huyện</option>
                  <option v-for="(item, index) in dataAddresses.districts" :key="index" :value="item.id">{{item.name}}</option>
                </select>
              </div>
              <span class="text text-danger more-ml-css">{{ errors.first('districts') }}</span>
              <div class="add-address-modal d-flex justify-content-start align-items-center pt-4">
                <label  class="add-address-wards">Phường xã:</label>
                <select
                :disabled="activeAddress.wards"
                  class="form-control"
                  aria-label="Default select example"
                  v-model="formData.wards_id"
                  v-validate="'required'"
                  name="wards"
                >
                  <option :value="null" selected>Chọn Phường xã</option>
                  <option v-for="(item, index) in dataAddresses.wards" :key="index" :value="item.id">{{item.name}}</option>
                </select>
              </div>
              <span class="text text-danger more-ml-css">{{ errors.first('wards') }}</span>
              <div class="add-address-modal d-flex justify-content-start align-items-center pt-5">
                <label  class="add-address-specifically">Địa chỉ:</label>
                <textarea
                  class="border outlined"
                  cols="45"
                  rows="5"
                  placeholder="Địa chỉ cụ thể"
                  v-model="formData.specific_address"
                  v-validate="'required'"
                  name="specific_address"
                ></textarea>
              </div>
              <span class="text text-danger more-ml-css">{{ errors.first('specific_address') }}</span>
              <div class="add-address-modal d-flex justify-content-certer align-items-center pt-5">
                <input style="margin-left:200px" type="checkbox" v-model="formData.address_default" name="address_default" id="address_default">
                <label for="address_default"  class="text m-2">Chọn là địa chỉ mặc định:</label>
              </div>
              <span class="text text-success text-center" v-if="textMessage != ''">{{textMessage}}</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" @click="saveAddress" class="btn btn-primary" >Save changes</button>
            </div>
          </form>
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
              user_id: null,
              province_id: null,
              districts_id: null,
              wards_id: null,
              name: null,
              phone: null,
              specific_address: null,
              address_default: null
            },
            dataAddresses: {
              province: [],
              districts:[],
              wards: []
            },
            activeAddress: {
              districts: true,
              wards: true,
            },
            textMessage: ''
        }
    },
    methods: {
        saveAddress() {
            let scop = this;
            scop.$validator.validate().then(valid => {
                if(valid) {
                  this.formData.user_id = this.id;
                    httpStore
                    .dispatch("post", {
                        url: scop.baseUrl(`my-profile/add-more-address`),
                        data: scop.formData
                    })
                    .then(response => {
                        this.textMessage = 'Thêm thành công';
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
        getAddressAddress() {
            httpStore
                .dispatch("get", {
                  url: this.baseUrl(`my-profile/get-address-province`),
                })
                .then(response => {
                  this.dataAddresses.province = response.datas;
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
                });
        },
        changeProvince() {
          if(this.formData.province_id !== null) {
              httpStore
                  .dispatch("get", {
                      url: this.baseUrl(`my-profile/get-address-districts?province_id=${this.formData.province_id}`),
                  })
                  .then(response => {
                        this.dataAddresses.districts = response.datas;
                        this.activeAddress.districts = false;
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
                  });
          }else{
            this.dataAddresses.districts = [];
            this.activeAddress.districts = true;
          }
        },
        changeDistricts() {
            if(this.formData.districts_id !== null) {
              httpStore
                  .dispatch("get", {
                      url: this.baseUrl(`my-profile/get-address-wards?districts_id=${this.formData.districts_id}`),
                  })
                  .then(response => {
                        this.dataAddresses.wards = response.datas;
                        this.activeAddress.wards = false;
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
                  });
          }else{
            this.dataAddresses.wards = [];
            this.activeAddress.wards = true;
          }
        }
    },
    created() {
      this.getAddressAddress();
    }
}
</script>

<style lang="scss" scoped>
  .more-ml-css{
    margin-left: 150px;
  }
</style>
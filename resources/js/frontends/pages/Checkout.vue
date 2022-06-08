<template>
  <div class="content-cart ps-0 pe-0">
    <div class="w-100 menu--title d-flex align-items-center">
        <ul class="nav align-items-center ps-5 pe-5 ms-5 me-5">
            <li class="list-unstyled ">
                <a href="#" class="link--product text-uppercase text-decoration-none text-dark">
                    4MEN</a>
            </li>
            <li class="list-unstyled pe-1 ps-1">
                /
            </li>
            <li class="list-unstyled">
                <a href="#" class="link--product text-capitalize text-decoration-none text-dark"> áo
                    nam </a>
            </li>
        </ul>
    </div>
    <div class="content-cart-detail">
        <form>
            <div class="row">
                <div class="col-6">
                    <div class="contacts">
                        <div class="delivery_contact_information">
                            <h1 class="form-title">Thông tin liên hệ giao hàng</h1>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="username"
                                        class="username-label pe-3 text-end col-lg-4">Họ và tên *
                                    </label>
                                    <input type="text" name="username"
                                        class="username box-input col-lg-8" placeholder="Họ và tên"
                                        v-model="formData.name"
                                        id="username">
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="numberphone"
                                        class="numberphone-label pe-3 text-end col-lg-4">Số điện thoạt
                                        *</label>
                                    <input type="text" name="numberphone"
                                        class="numberphone box-input col-lg-8" placeholder="Họ và tên"
                                        v-model="formData.phone"
                                        id="numberphone">
                                </div>
                            </div>
                        </div>
                        <div class="delivery_contact_information">
                            <h1 class="form-title">Địa chỉ giao hàng</h1>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="city-province"
                                        class="city-province-label pe-3 text-end col-lg-4">Chọn tỉnh
                                        thành phố * </label>
                                    <select class="box-input col-lg-8"
                                        aria-label="Default select example"
                                        v-model="formData.province_id"
                                        @change="changeProvince"
                                        >
                                        <option v-for="(item, index) in fomrDatavt.province" :key="index" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="city-province"
                                        class="city-province-label pe-3 text-end col-lg-4">Chọn quận
                                        huyện * </label>
                                    <select class="box-input col-lg-8"
                                        aria-label="Default select example"
                                        v-model="formData.district_id"
                                        :disabled="dataActive.district"
                                        @change="changeDistricts"
                                        >
                                        <option v-for="(item, index) in fomrDatavt.district" :key="index" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="wards" class="wards-label pe-3 text-end col-lg-4">Tên
                                        phường xã *</label>
                                    <select class="box-input col-lg-8"
                                        aria-label="Default select example"
                                        v-model="formData.ward_id"
                                        :disabled="dataActive.ward"
                                        >
                                        <option v-for="(item, index) in fomrDatavt.ward" :key="index" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="streetname"
                                        class="street-name-label pe-3 text-end col-lg-4">Số nhà tên
                                        đường *</label>
                                    <input type="text" name="streetname"
                                        class="street-name col-lg-8 box-input" placeholder="Họ và tên"
                                        v-model="formData.specific_address"
                                        id="streetname">
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="note" class="note-label pe-3 text-end col-lg-4">Ghi chú
                                        *</label>
                                    <textarea name="note" id="note" class="note col-lg-8" cols="20"
                                    v-model="formData.node"
                                        rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="cart-informations">
                        <h1 class="form-title">Giỏ hàng của bạn</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="table-text text-center">Hình</th>
                                    <th scope="col" class="table-text text-center">Thông tin sản phẩm
                                    </th>
                                    <th scope="col" class="table-text text-center">SL</th>
                                    <th scope="col" class="table-text text-center">Tổng</th>
                                    <th scope="col" class="table-text text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody v-for="(item, index) in datacart.items" :key="index">
                                <tr>
                                    <th rowspan="2">
                                        <img :src="formatImage(item.image)"
                                            class="img-cart" alt="">
                                    </th>
                                    <td class="overflow-hidden">
                                        <a :href="`detail/${item.id}`" class="product-links">{{item.name}}</a>
                                    </td>
                                    <td class="text-center text-products">{{item.qty}}</td>
                                    <td class="text-center text-products">{{formatPrice(item.price)}}</td>
                                    <td class="text-center text-products"></td>

                                </tr>
                                <tr>
                                    <td align="right" class="text-size">Size: {{item.size}}</td>
                                    <td colspan="3" class="d-flex border-0">
                                    </td>
                                    <td colspan="3" class="text-end">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h1 class="form-title">Tổng</h1>
                        <table class="w-100 table">
                            <tbody>
                                <tr>
                                    <td class="w-50 text-products">Số tiền mua hàng</td>
                                    <td class="w-50 text-products">{{datacart.totalQty}}</td>
                                </tr>
                                <tr>
                                    <td class="w-75 text-end text-products">Tổng tiền: </td>
                                    <td class="w-25 text-products">{{formatPrice(datacart.totalPrice)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="btn-submit text-center mt-5">
                <button type="button" @click="submitCheckout" class="btn btn-danger w-25 btn-to">Gửi đơn hàng</button>
            </div>

        </form>
    </div>
</div>
</template>

<script>
import httpStore from "@core/config/httpStore";

export default {
    props: {
        address: {
            type: Object,
        },
        datacart: {
            type: Object,
        },
        datavt: {
            type: Object,
        }
    },
    data() {
        return {
            formData: {
                name: null,
                phone: null,
                province_id: null,
                district_id: null,
                ward_id: null,
                specific_address: null,
                node: null,
            },
            fomrDatavt: {
                province: [],
                district: [],
                ward: [],
            },
            dataActive: {
                district: true,
                ward: true,
            }
        }
    },
    created() {
        this.formData = {
            name: this.address.name,
            phone: this.address.phone,
            province_id: this.address.province_id,
            district_id: this.address.districts_id,
            ward_id: this.address.wards_id,
            specific_address: this.address.specific_address,
        }
        this.fomrDatavt = {
            province: this.datavt.province,
            district: this.datavt.district,
            ward: this.datavt.ward,
        }
    },
    methods: {
         changeProvince() {
          if(this.formData.province_id !== null) {
              httpStore
                  .dispatch("get", {
                      url: this.baseUrl(`my-profile/get-address-districts?province_id=${this.formData.province_id}`),
                  })
                  .then(response => {
                        this.fomrDatavt.district = response.datas;
                        this.dataActive.district = false;
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
            this.fomrDatavt.district = [];
            this.dataActive.district = true;
          }
        },
        changeDistricts() {
            if(this.formData.districts_id !== null) {
              httpStore
                  .dispatch("get", {
                      url: this.baseUrl(`my-profile/get-address-wards?districts_id=${this.formData.district_id}`),
                  })
                  .then(response => {
                        this.fomrDatavt.ward = response.datas;
                        this.dataActive.ward = false;
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
            this.fomrDatavt.ward = [];
            this.dataActive.ward = true;
          }
        },
          formatImage(img) {
            return `uploads/${img}`;
        },
        formatPrice(price) {
            var formatter = new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND"
            });
            return formatter.format(price);
        },
        submitCheckout() {
            let dataform = {
                name : this.formData.name,
                phone : this.formData.phone,
                province_id : this.formData.province_id,
                district_id : this.formData.district_id,
                ward_id : this.formData.ward_id,
                specific_address : this.formData.specific_address,
                node : this.formData.node,
                carts : this.datacart,
            }

             httpStore
                  .dispatch("post", {
                      url: this.baseUrl(`my-profile/post-checkout`),
                      data: dataform
                  })
                  .then(response => {
                      if(response.status === 200) {
                            window.location.href = this.baseUrl(`/`);
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
                  });
        }
    }
}
</script>

<style>

</style>
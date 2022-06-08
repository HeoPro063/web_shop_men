<template>
  <div>
    <div class="bg-dark header__top d-flex fixed-top">
      <div class="col-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="header__top__phone_number">
          <p class="text-center text-white">
            <span class="header__top__phone__text">Hotline:</span>
            <a href="te:0966493975" class="text-white text-decoration-none">0966493975</a>
          </p>
        </div>
      </div>
      <div class="col-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="header__top__text__right">
          <ul class="sub__menu d-flex justify-content-end m-0 me-5 p-0">
            <li v-if="dataUser" class="sub__menu__chill list-unstyled me-4 border-end">
              <a href="#" class="sub__link text-decoration-none">
                <div class="login">
                  <a
                    :href="baseUrl('my-profile')"
                    class="login__link text-white text-decoration-none"
                  >
                    <i class="fa fa-user"></i> Tài khoản
                  </a>
                </div>
              </a>
            </li>
            <li v-if="dataUser" class="sub__menu__chill list-unstyled me-4 border-end">
              <a href="#" class="sub__link text-decoration-none">
                <div class="login">
                  <a
                    :href="baseUrl('logout')"
                    class="login__link text-white text-decoration-none"
                  >Đăng xuất</a>
                </div>
              </a>
            </li>
            <li v-if="!dataUser" class="sub__menu__chill list-unstyled me-4 border-end">
              <a href="#" class="sub__link text-decoration-none">
                <div class="login">
                  <a
                    :href="baseUrl('login')"
                    class="login__link text-white text-decoration-none"
                  >Đăng nhập</a>
                </div>
              </a>
            </li>
            <li class="sub__menu__chill list-unstyled me-4 border-end">
              <a href="#" class="sub__link text-decoration-none">Chính sách khách vip</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div
      class="header__bottom bg-white d-flex d-flex justify-content-around align-items-center fixed-top"
    >
      <div class="header__bottom__logo">
        <a href class="header__bottom__logo_link">
          <img src="frontend/images/logo.png" class="logo" alt="logo" />
        </a>
      </div>
      <div class="header__bottom__list">
        <ul class="header__bottom__nav d-flex m-0">
          <li class="header__bottom__menu list-unstyled">
            <a href class="header__bottom__link text-decoration-none">
              <span class="hot">Hot</span>
              Hàng
              mới
            </a>
          </li>
          <div>
            <li class="header__bottom__menu list-unstyled ps-4">
              <a class="header__bottom__link text-decoration-none">Danh mục</a>
              <ul class="header__bottom__sub__menu p-0">
                <li
                  v-for="(item2, index2) in dataHeader"
                  :key="index2"
                  class="menu__chill list-unstyled border-bottom"
                >
                  <a :href="`category?category_home_id=${item2.id}`" class="link__chill text-decoration-none">{{item2.name}}</a>
                </li>
              </ul>
            </li>
          </div>

          <li class="header__bottom__menu list-unstyled ps-4">
            <a :href="baseUrl('promotion')" class="header__bottom__link text-decoration-none">
              <span class="hot">Hot</span>
              Khuyến
              mãi
            </a>
          </li>

           <li class="header__bottom__menu list-unstyled ps-4">
            <a v-if="dataUser" href="checkout" class="header__bottom__link text-decoration-none">
              Giỏ hàng
            </a>
          </li>
          <li class="header__bottom__menu list-unstyled ps-4">
            <a href="about" class="header__bottom__link text-decoration-none">
              Giới thiệu
            </a>
          </li>
        </ul>
      </div>
      <div class="header__bottom__cart__search d-flex">
        <div class="header__bottom__cart position-relative">
          <div class="cart">
            <i class="fa fa-shopping-cart cart-search"></i>
            <div class="cart__product">
              <p class="d-flex pb-3 border-bottom cart__titile align-items-center">
                Có
                <span class="cart__number">{{getCart.totalQty}}</span>
                <span class="cart__product__color">
                  Sản
                  phẩm
                </span> trong giỏ hàng
              </p>

              <div class="cart__show">
                <div v-for="(item, index) in getCart.items" :key="index" class="cart__list border-bottom mt-3 mb-3 pb-3">
                  <div class="cart__photo pe-2">
                    <img
                      :src="formatImage(item.image)"
                      class="photo"
                      alt
                    />
                  </div>
                  <div class="cart__description">
                    <a :href="`detail/${item.item.id}`" class="link__product">
                      {{item.name}}
                    </a>
                    <p class="price">{{item.qty}} X {{formatPrice(item.price)}}</p>
                    <div @click="deleteItemCart(index)" class="delete">
                      <i class="fa fa-trash"></i>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="total">Tổng: {{formatPrice(getCart.totalPrice)}}</div>
              <div v-if="dataUser" class="send__order">
                <a :href="baseUrl('checkout')" class="btn btn-secondary">Thanh toán giỏ hàng</a>
              </div>
            </div>
          </div>
        </div>
        <div class="header__bottom__search position-relative">
          <div class="search cart-search">
            <i class="fa fa-search"></i>
            <form class="search__product position-absolute" autocomplete="off">
              <input type="text" name="search" class="search__input" placeholder="Tìm kiếm" id />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import httpStore from "@core/config/httpStore";

export default {
  props: {
    user: Object,
    datacart: {
      type: Object,
      default: () => {
        return [];
      }
    }
  },
  data() {
    return {
      dataUser: this.user,
      dataHeader: []
    };
  },
  computed: {
    ...mapGetters(["getCart"])
  },
  created() {
    this.updatedDataCartVx();
    this.getDataHeader();
  },
  methods: {
    ...mapMutations(["UPDATE_DATA_CART"]),
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
    updatedDataCartVx() {
      this.UPDATE_DATA_CART(this.datacart);
    },
    deleteItemCart(index) {
          httpStore
            .dispatch("get", {
              url: this.baseUrl(`get-delete-cart?id=${index}`),
              data: this.dataAddCart
            })
            .then(response => {
              this.UPDATE_DATA_CART(response.datas)
                  scop.$toast.open({
                  message: "Success",
                  type: "success",
                  duration: 2000,
                  dismissible: true,
                  position: "top"
                });
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
    },
    getDataHeader() {
      httpStore
        .dispatch("get", {
        url: this.baseUrl("get-data-header"),
        })
        .then(response => {
          this.dataHeader = response.datas
        })
        .catch(error => {
      
        }).finally(() => {
        });
    }
  }
};
</script>

<style>
</style>
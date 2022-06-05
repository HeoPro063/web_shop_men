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
                    :href="baseUrl('user/my-profile')"
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
            <li class="sub__menu__chill list-unstyled me-4 border-end">
              <a href="#" class="sub__link text-decoration-none">Giới thiệu</a>
            </li>
          </ul>
        </div>
      </div>
    </div> 
    <div
      class="header__bottom bg-white d-flex d-flex justify-content-around align-items-center fixed-top"
    >
      <div class="header__bottom__logo">
        <a :href="baseUrl('')" class="header__bottom__logo_link">
          <img src="frontend/images/logo.png" class="logo" alt="logo" />
        </a>
      </div>
      <div class="header__bottom__list">
        <ul class="header__bottom__nav d-flex m-0">
          <li class="header__bottom__menu list-unstyled">
            <a :href="baseUrl('')" class="header__bottom__link text-decoration-none">
              <span class="hot">Hot</span>
              Hàng
              mới
            </a>
          </li>
          <div v-for="(item, index)  in dataHeader" :key="index">
            <li class="header__bottom__menu list-unstyled ps-4">
              <a class="header__bottom__link text-decoration-none">{{item.titleCategory}}</a>
              <ul class="header__bottom__sub__menu p-0">
                <li
                  v-for="(item2, index2) in item.dataCategory"
                  :key="index2"
                  class="menu__chill list-unstyled border-bottom"
                >
                  <a href="#" class="link__chill text-decoration-none">{{item2.name}}</a>
                </li>
              </ul>
            </li>
          </div>

          <li class="header__bottom__menu list-unstyled ps-4">
            <a href="#" class="header__bottom__link text-decoration-none">
              <span class="hot">Hot</span>
              Khuyến
              mãi
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
                <span class="cart__number">1</span>
                <span class="cart__product__color">
                  Sản
                  phẩm
                </span> trong giỏ hàng
              </p>

              <div class="cart__show">
                <div class="cart__list border-bottom mt-3 mb-3 pb-3">
                  <div class="cart__photo pe-2">
                    <img
                      src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                      class="photo"
                      alt
                    />
                  </div>
                  <div class="cart__description">
                    <a href="#" class="link__product">
                      Áo Sơ Mi Oxford Tay Ngắn ASM017
                      Màu
                      Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf
                    </a>
                    <p class="price">1 X 245.000</p>
                    <div class="delete">
                      <i class="fa fa-trash"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="total">Tổng: 245,000</div>
              <div class="send__order">
                <button class="btns">Gửi đơn hàng</button>
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
export default {
  props: {
    user: Object
  },
  data() {
    return {
      dataUser: this.user,
      dataHeader: [
        {
          titleCategory: "QUẦN NAM",
          dataCategory: [
            {
              name: "Quần da"
            },
            {
              name: "Quần jei"
            },
            {
              name: "Quần bò"
            }
          ]
        },
        {
          titleCategory: "ÁO NAM",
          dataCategory: [
            {
              name: "Quần da"
            },
            {
              name: "Quần jei"
            },
            {
              name: "Quần bò"
            }
          ]
        },
        {
          titleCategory: "PHỤ KIỆN",
          dataCategory: [
            {
              name: "Quần da"
            },
            {
              name: "Quần jei"
            },
            {
              name: "Quần bò"
            }
          ]
        },
        {
          titleCategory: "GIÀY DÉP",
          dataCategory: [
            {
              name: "Quần da"
            },
            {
              name: "Quần jei"
            },
            {
              name: "Quần bò"
            }
          ]
        }
      ]
    };
  },
  created() {},
  methods: {
    baseUrl(url) {
      return window.location.href + url;
    }
  }
};
</script>

<style>
</style>
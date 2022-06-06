<template>
  <div class="detail p-0 pt-5 mt-5">
    <div class="detail pt-3">
      <div class="detail__top">
        <ul class="nav">
          <li class="sub-chill list-unstyled">
            <a href="#" class="text-decoration-none text-dark text-uppercase">4men</a>
          </li>
          <li class="sub-chill list-unstyled ps-1 pe-1">/</li>
          <li class="sub-chill list-unstyled">
            <a href="#" class="text-decoration-none text-dark text-capitalize">áo sơ mi nam</a>
          </li>
          <li class="sub-chill list-unstyled ps-1 pe-1">/</li>
          <li class="sub-chill list-unstyled">
            <a href="#" class="text-decoration-none text-dark text-capitalize">
              Áo Sơ Mi Oxford
              Tay Ngắn ASM017
              Màu Xanh
            </a>
          </li>
        </ul>
      </div>
      <div class="detail__center pt-4">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="detail__photo">
              <div class="representatives d-flex justify-content-center">
                <img :src="formatImage(dataDetail.avatar_product)" alt class="representatives-img" />
              </div>
              <div class="description_photo p-3 d-flex justify-content-center">
                <div
                  class="description_photos-img"
                  v-for="(item, index) in dataDetail.data_images"
                  :key="index"
                >
                  <img :src="formatImage(item.name)" class="description_img ps-2" alt />
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6">
            <div class="detail__product_description ps-3">
              <h2
                class="product_description__title"
                style="text-transform: uppercase;"
              >{{dataDetail.name}}</h2>
              <div class="evaluate">
                <div class="evaluate-star">
                  <span class="act fa fa-star" aria-hidden="true"></span>
                  <span class="act fa fa-star" aria-hidden="true"></span>
                  <span class="act fa fa-star" aria-hidden="true"></span>
                  <span class="act fa fa-star" aria-hidden="true"></span>
                  <span class="act fa fa-star" aria-hidden="true"></span>
                  <em class="evaluate-text ps-2">(20 đánh giá/ {{dataDetail.purchases}} lượt mua)</em>
                </div>
              </div>
              <div class="detail__product__price d-flex pt-3">
                <div class="product__price__text">
                  <u>Giá bán:</u>
                </div>
                <div
                  v-if="dataDetail.status_promotion === 0"
                  class="product__price__number ps-2"
                >{{formatPrice(dataDetail.price)}}</div>
                <div v-else class="product__price__number ps-2">
                  {{formatPrice(dataDetail.price_promotion)}}
                  <span
                    class="price_promotion"
                  >{{formatPrice(dataDetail.price)}}</span>
                  &ensp;({{dataDetail.percent}}%)
                </div>
              </div>
              <div class="detail__product__color pt-3 d-flex">
                <div class="detail__product__color__text">Chọn màu*</div>
                <div class="detail__product__color__photo ps-5 d-flex">
                  <button
                    v-for="(item, index) in dataDetail.data_colors"
                    :key="index"
                    class="btn--choose me-3"
                    @click="chooseColor(item.id)"
                    :class="{'text-danger':item.id === dataAddCart.color_id}"
                  >{{item.name}}</button>
                </div>
              </div>
              <div class="mockup__oder pb-2 pt-4">
                <ul class="nav-node p-0 m-0">
                  <li class="list-unstyled me-4 d-flex">
                    Size*
                    <div class="detail__product__color__photo ps-5 d-flex">
                      <button
                        v-for="(item, index) in dataDetail.data_sizes"
                        :key="index"
                        class="btn--choose--size me-3"
                        @click="chooseSize(item.id)"
                        :class="{'text-danger':item.id === dataAddCart.size_id}"
                      >{{item.name}}</button>
                    </div>
                  </li>
                  <li class="list-unstyled mt-3 d-flex">
                    Số lượng *
                    <input
                      type="number"
                      name="number"
                      min="1"
                      v-model="dataAddCart.quantity"
                      :max="dataDetail.quantity"
                    />
                    <span
                      v-if="dataAddCart.quantity > dataDetail.quantity"
                      class="text-danger"
                    >Sản phẩm hiện tại không đủ</span>
                  </li>
                </ul>
              </div>
              <div v-if="dataDetail.quantity === 0" class="mockup__buying d-flex pt-5">
                <button class="btn btn-secondary text-center w-25">Hết hàng</button>
              </div>
              <div v-else class="mockup__buying d-flex pt-5">
                <button class="btn btn-danger text-center w-25">
                  <i class="fa fa-shopping-cart"></i>
                  Đăng ký mua
                </button>
                <button
                  @click="addSubmitCart"
                  :disabled="dataAddCart.color_id === null || dataAddCart.size_id === null"
                  class="btn text-danger text-center"
                >
                  <i class="fa fa-plus"></i>
                  Thêm
                  vào
                  giỏ hàng
                </button>
              </div>
              <div class="detail w-100">
                <a
                  href="#"
                  class="detail-link d-block text-center text-decoration-none text-white w-100"
                >
                  xem
                  chi tiết sản
                  phẩm
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="content">
            <div class="hottest_fashion">
              <h1 class="titile__fashios text-center pt-5 pb-3">thời trang bán chạy</h1>
              <div class="container text-center my-3">
                <div class="row mx-auto my-auto justify-content-center">
                  <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active">
                        <div class="col-md-3">
                          <div class="card">
                            <div class="product-item pt-2 pe-2 me-2 mt-2">
                              <div class="product__img position-relative">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product"
                                  alt
                                />
                                <span class="product__cart position-absolute">
                                  <i class="fa fa-shopping-cart"></i>
                                </span>
                              </div>
                              <div class="product__img__item mt-1 mb-1">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product-items"
                                  alt
                                />
                              </div>
                              <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">
                                  Áo Sơ
                                  Mi Oxford Tay Ngắn ASM017 Màu Xanh
                                </a>
                              </div>
                              <div class="product__price">245.000</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="col-md-3">
                          <div class="card">
                            <div class="product-item pt-2 pe-2 me-2 mt-2">
                              <div class="product__img position-relative">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product"
                                  alt
                                />
                                <span class="product__cart position-absolute">
                                  <i class="fa fa-shopping-cart"></i>
                                </span>
                              </div>
                              <div class="product__img__item mt-1 mb-1">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product-items"
                                  alt
                                />
                              </div>
                              <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">
                                  Áo Sơ
                                  Mi Oxford Tay Ngắn ASM017 Màu Xanh
                                </a>
                              </div>
                              <div class="product__price">245.000</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="col-md-3">
                          <div class="card">
                            <div class="product-item pt-2 pe-2 me-2 mt-2">
                              <div class="product__img position-relative">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product"
                                  alt
                                />
                                <span class="product__cart position-absolute">
                                  <i class="fa fa-shopping-cart"></i>
                                </span>
                              </div>
                              <div class="product__img__item mt-1 mb-1">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product-items"
                                  alt
                                />
                              </div>
                              <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">
                                  Áo Sơ
                                  Mi Oxford Tay Ngắn ASM017 Màu Xanh
                                </a>
                              </div>
                              <div class="product__price">245.000</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="col-md-3">
                          <div class="card">
                            <div class="product-item pt-2 pe-2 me-2 mt-2">
                              <div class="product__img position-relative">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product"
                                  alt
                                />
                                <span class="product__cart position-absolute">
                                  <i class="fa fa-shopping-cart"></i>
                                </span>
                              </div>
                              <div class="product__img__item mt-1 mb-1">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product-items"
                                  alt
                                />
                              </div>
                              <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">
                                  Áo Sơ
                                  Mi Oxford Tay Ngắn ASM017 Màu Xanh
                                </a>
                              </div>
                              <div class="product__price">245.000</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="col-md-3">
                          <div class="card">
                            <div class="product-item pt-2 pe-2 me-2 mt-2">
                              <div class="product__img position-relative">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product"
                                  alt
                                />
                                <span class="product__cart position-absolute">
                                  <i class="fa fa-shopping-cart"></i>
                                </span>
                              </div>
                              <div class="product__img__item mt-1 mb-1">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product-items"
                                  alt
                                />
                              </div>
                              <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">
                                  Áo Sơ
                                  Mi Oxford Tay Ngắn ASM017 Màu Xanh
                                </a>
                              </div>
                              <div class="product__price">245.000</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="col-md-3">
                          <div class="card">
                            <div class="product-item pt-2 pe-2 me-2 mt-2">
                              <div class="product__img position-relative">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product"
                                  alt
                                />
                                <span class="product__cart position-absolute">
                                  <i class="fa fa-shopping-cart"></i>
                                </span>
                              </div>
                              <div class="product__img__item mt-1 mb-1">
                                <img
                                  src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                  class="product-items"
                                  alt
                                />
                              </div>
                              <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">
                                  Áo Sơ
                                  Mi Oxford Tay Ngắn ASM017 Màu Xanh
                                </a>
                              </div>
                              <div class="product__price">245.000</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a
                      class="carousel-control-prev bg-transparent w-aut"
                      href="#recipeCarousel"
                      role="button"
                      data-bs-slide="prev"
                    >
                      <span class="carousel-control-prev-icon" aria-hidden="true">
                        <i class="fa fa-angle-left"></i>
                      </span>
                    </a>
                    <a
                      class="carousel-control-next bg-transparent w-aut"
                      href="#recipeCarousel"
                      role="button"
                      data-bs-slide="next"
                    >
                      <span class="carousel-control-next-icon" aria-hidden="true">
                        <i class="fa fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="detail__footer mt-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link border active"
              id="home-tab"
              data-bs-toggle="tab"
              data-bs-target="#home"
              type="button"
              role="tab"
              aria-controls="home"
              aria-selected="true"
            >Đánh giá</button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link border"
              id="contact-tab"
              data-bs-toggle="tab"
              data-bs-target="#contact"
              type="button"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
            >Bình luận</button>
          </li>
        </ul>
        <div class="tab-content border p-4" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <form action="#" method="post" class="form">
              <div class="detail__post text-center">Đánh giá cảu bạn:</div>
              <div class="star text-center">
                <label for="radio1" class="d-block">
                  <input type="radio" name="ratingstar" id="radio1" />
                  <i class="fa fa-star star-raodio"></i>
                </label>
                <label for="radio2" class="d-block">
                  <input type="radio" name="ratingstar" id="radio2" />
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                </label>
                <label for="radio3" class="d-block">
                  <input type="radio" name="ratingstar" id="radio3" />
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                </label>
                <label for="radio4" class="d-block">
                  <input type="radio" name="ratingstar" id="radio4" />
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                </label>
                <label for="radio5" class="d-block">
                  <input type="radio" name="ratingstar" checked id="radio5" />
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                  <i class="fa fa-star star-raodio"></i>
                </label>
              </div>
            </form>
            <hr />
            <form action="#" method="post">
              <h5>Gửi đánh giá của bạn</h5>
              <div class="form_group">
                <label for="last-name" class="text-capitalize d-block">Họ và tên *</label>
                <input type="text" name="lastname" class="lastname" id />
              </div>
              <div class="form_group">
                <label for="content-footer" class="text-capitalize d-block">Nội dung đánh giá *</label>
                <textarea name="contents" class="contents" id="content-footer" cols="80" rows="10"></textarea>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import httpStore from "@core/config/httpStore";
import { mapGetters, mapMutations } from "vuex";

export default {
  props: {
    datadetail: {
      type: Object,
      default: () => {
        return [];
      }
    }
  },
  computed: {
    ...mapGetters(["getCart"])
  },
  data() {
    return {
      dataDetail: this.datadetail,
      dataAddCart: {
        id: this.datadetail.id,
        size_id: null,
        color_id: null,
        quantity: 1,
        status_promotion: this.datadetail.status_promotion
      }
    };
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
    chooseColor(id) {
      this.dataAddCart.color_id = id;
    },
    chooseSize(id) {
      this.dataAddCart.size_id = id;
    },
    addSubmitCart() {
      let scop = this;
      scop.$loading(true);
      httpStore
        .dispatch("post", {
          url: scop.baseUrl("post-add-cart"),
          data: scop.dataAddCart
        })
        .then(response => {
          this.UPDATE_DATA_CART(response.datas);
          scop.$toast.open({
            message: "Success",
            type: "success",
            duration: 2000,
            dismissible: true,
            position: "top"
          });
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
    }
  }
};
</script>

<style>
.price_promotion {
  font-size: 14px;
  color: gray;
  text-decoration: line-through;
}
.border-number {
  border: 1px solid red;
}
img.product {
    height: 376px;
}
</style>
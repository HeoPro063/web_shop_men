<template>
    <div class="content">
        <div class="hottest_fashion">
            <h1 class="titile__fashios text-center pb-3">THỜI TRANG HOT NHẤT</h1>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
            </div>
        </div>
        <div class="content__banner d-flex justify-content-center align-items-start pt-4">
            <div class="banner__left me-4">
                <img src="frontend/images/slide-1-trang-chu-slide-1.jpg" class="img-res" alt="">
            </div>
            <div class="banner__center">
                <div class="banner__top">
                    <img src="frontend/images/slide-2-trang-chu-slide-2.png" class="img-top" alt="">
                </div>
                <div class="banner__bottom">
                    <img src="frontend/images/slide-3-trang-chu-slide-3.jpg" class="img-bottom" alt="">
                </div>
            </div>
            <div class="banner__right ms-4">
                <img src="frontend/images/slide-4-trang-chu-slide-4.jpg" class="img-right" alt="">
            </div>
        </div>
        <div class="hottest_fashion">
            <h1 class="titile__fashios text-center pt-5 pb-3">thời trang mới nhất</h1>
            <div class="d-flex flex-wrap justify-content-center">
                <div v-for="(item, index) in dataProductNew" :key="index" class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img :src="formatImage(item.image)"
                            class="product" alt="">
                        <span type="button" @click="modalEditData(item)" data-bs-toggle="modal" data-bs-target="#exampleModal" class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img :src="formatImage(item.image)"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">{{item.name}}</a>
                    </div>
                    <div class="product__price">{{formatPrice(item.price)}}</div>
                </div>
                 <div class="text-center w-100 pt-3 pb-3">
                    <button class="btn-see-more" @click="getDataNew(8)">
                        Xem them
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div class="hottest_fashion">
            <h1 class="titile__fashios text-center pt-5 pb-3">thời trang bán chạy</h1>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                 <div class="product-item pt-2 pe-2 me-2 mt-2">
                    <div class="product__img position-relative">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product" alt="">
                        <span class="product__cart position-absolute"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                    <div class="product__img__item mt-1 mb-1">
                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh-15391.png"
                            class="product-items" alt="">
                    </div>
                    <div class="product__title">
                        <a href="#" class="link-title text-decoration-none text-dark">Áo Sơ Mi Oxford Tay Ngắn ASM017 Màu Xanh</a>
                    </div>
                    <div class="product__price">245.000</div>
                </div>
                
            </div>
        </div>

        <detail-modal :dataDetailModal="DataDetailModal"></detail-modal>
    </div>
</template>

<script>
import httpStore from "@core/config/httpStore";
import DetailModal from "@/frontends/components/modal/DetailModal.vue"
export default {
    data() {
        return {
            dataProductNew: [],
            limitdatanew: 8,
            DataDetailModal: {}
        }
    },
    methods: {
        getDataNew(limit) {
            this.limitdatanew += limit
            httpStore
                .dispatch("get", {
                    url: this.baseUrl(`home/get-data-new?limit=${this.limitdatanew}`),
                })
                .then(response => {
                    this.dataProductNew = response.datas
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
            return `uploads/${img}`;
        },
        formatPrice(price) {
            var formatter = new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND"
            });
            return formatter.format(price);
        }
        ,
        modalEditData(item) {
            this.DataDetailModal = item;
        }
    },
    created() {
        this.getDataNew(0);
    },
    components: {
        DetailModal
    }
}
</script>

<style>

</style>
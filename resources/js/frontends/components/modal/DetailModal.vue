<template>
    <div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" aria-label="Close">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="mockup-content m-0 m-auto d-flex p-2">
                            <div class="mockup__left">
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators m-0 p-0">

                                        <div v-for="(item, index) in dataDetailModal.data_images" :key="index" data-bs-target="#carouselExampleIndicators" :data-bs-slide-to="index"
                                                :class="{'active': index === 0}" aria-current="true" :aria-label="`Slide ${index + 1}`">
                                            <img :src="formatImage(item.name)" class="img-chill" alt="">
                                        </div>

                                    </div>
                                    <div class="carousel-inner">
                                        <div v-for="(item, index) in dataDetailModal.data_images" :key="index" class="carousel-item " :class="{'active': index === 0}">
                                            <img :src="formatImage(item.name)" class="d-block carousel-img"
                                                alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"> <i
                                                class="fa fa-angle-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"><i
                                                class="fa fa-angle-right"></i></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="mockup__right ps-5">
                                <h3 class="mockup__title">{{dataDetailModal.name}}</h3>
                                <div v-if="dataDetailModal.status_promotion == 0" class="mockup_price"><u>Giá bán: </u> <span class="price__number"> {{formatPrice(dataDetailModal.price)}}
                                    </span> </div>
                                <div v-else class="mockup_price"><u>Giá bán: </u> <span class="price__number"> {{formatPrice(dataDetailModal.promotion)}} (-{{dataDetailModal.percent_promotion}}%)
                                    </span> </div>
                                <div class="mockup__status">tình trạng: còn hàng</div>
                                <hr />
                                <div class="mockup__describe">
                                    <ul class="nav-menus m-0 p-0">
                                        <li class="list-unstyled cart__description">{{dataDetailModal.description}}</li>
                                    </ul>
                                </div>
                                <hr />
                                <div class="mockup__oder">
                                    <ul class="nav">
                                        <li class="list-unstyled me-4">
                                            Size*
                                            <select v-model="size_id" class="form-select" aria-label="Default select example">
                                                <option :value="null" selected>Open this select menu</option>
                                                <option v-for="(item, index) in dataDetailModal.data_sizes" :key="index" :value="item.id">{{item.name}}</option>
                                            </select>
                                        </li>
                                        <li class="list-unstyled me-4">
                                            Màu *
                                            <select v-model="color_id" class="form-select" aria-label="Default select example">
                                                <option :value="null" selected>Open this select menu</option>
                                                <option v-for="(item, index) in dataDetailModal.data_colors" :key="index" :value="item.id">{{item.name}}</option>
                                            </select>
                                        </li>
                                    </ul>
                                </div>
                                <hr />
                                <div class="mockup__buying d-flex">
                                    <button :disabled="color_id == null || size_id == null" @click="addMoreCart" class="btn text-danger text-center"><i class="fa fa-plus"></i> Thêm
                                        vào
                                        giỏ hàng</button>
                                </div>
                                <hr />
                                <div class="detail w-100"><a :href="baseUrl(`detail/${dataDetailModal.id}`)"
                                        class="detail-link d-block text-center text-decoration-none text-white w-100">xem
                                        chi tiết sản
                                        phẩm</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
        dataDetailModal:{
            type: Object, 
        }
    },
    data() {
        return {
            size_id: null,
            color_id: null,
        }
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
        addMoreCart() {
            let dataAddCart = {
                id: this.dataDetailModal.id, 
                size_id: this.size_id,
                color_id: this.color_id,
                quantity: 1,
                status_promotion: this.dataDetailModal.status_promotion,
            }
            let scop = this;
            scop.$loading(true);
            httpStore
                .dispatch("post", {
                url: scop.baseUrl("post-add-cart"),
                data: dataAddCart
                })
                .then(response => {
                    scop.UPDATE_DATA_CART(response.datas)
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
                }).finally(() => {
                scop.$loading(false);
                });
        }
    }
}
</script>

<style>

</style>
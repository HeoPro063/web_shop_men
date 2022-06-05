<template>
    <div class="product p-0 pt-5 mt-5">
        <div class="product__title pt-4">
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
        </div>
        <div class="product__content">
            <div class="product__top">
                <h1 class="top__title m-0 text-uppercase">Áo nam</h1>
                <div style="display: flex;">
                    <ul class="nav-menu-chill m-0">
                        <li class="chill-item list-unstyled position-relative">
                            Sắp xếp
                            <i class="fa fa-angle-down"></i>
                            <ul class="sub-menu position-absolute p-0">
                                <li @click="selectSort('price_min')" class="menu-item list-unstyled">Theo giá tăng dần</li>
                                <li @click="selectSort('price_max')" class="menu-item list-unstyled">Theo giá giảm dần</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav-menu-chill m-0">
                        <li class="chill-item list-unstyled position-relative">
                            Phân loại
                            <i class="fa fa-angle-down"></i>
                            <ul class="sub-menu position-absolute p-0">
                                <li class="menu-item list-unstyled">Mua nhiều nhất</li>
                                <li class="menu-item list-unstyled">Đánh tốt nhất</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav-menu-chill m-0">
                        <li class="chill-item list-unstyled position-relative">
                            Lọc danh mục
                            <i class="fa fa-angle-down"></i>
                            <ul class="sub-menu position-absolute p-0" >
                                <li class="menu-item list-unstyled" v-for="(item, index) in dataCategory" :key="index" @click="selectCate(item.id)">{{item.name}}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="guys"></div>
            <div class="row">
                <div class="col-md-9 col-sm-8 p-0">
                    <div class="d-flex flex-wrap">
                        <a style="text-decoration: none" v-for="(item, index) in datasDefault" :key="index" class="product-item" :href="baseUrl(`detail/${item.id}`)">
                            <div class="product__img position-relative image-more-block">
                                <img :src="formatImage(item.image)"
                                    class="product" alt="">
                                <span class="product__cart position-absolute"><i
                                        class="fa fa-shopping-cart"></i></span>
                            </div>
                            <div class="product__img__item mt-1 mb-1">
                                <img :src="formatImage(item.image)"
                                    class="product-items" alt="">
                            </div>
                            <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">{{item.name}}</a>
                            </div>
                            <div v-if="item.status_promotion == 0" class="product__price">{{formatNumber(item.price)}}</div>
                            <div v-else class="product__price">{{responPromotion(item.promotion, item.percent_promotion)}}</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 p-0">
                    <div class="p-3 content-left">
                        <form action="#" method="post" autocomplete="off">
                            <h4 class="form--title">Tìm kiếm</h4>
                            <div class="form--group">
                                <label for="search" class="form--search">Sản phẩm tại 4 men</label>
                                <input type="search" name="search" id="search" class="search-product"
                                    placeholder="Từ khóa tìm kiếm">
                            </div>
                        </form>
                        <div class="hot_products pt-5">
                            <h4 class="form--title">Sản phẩm hot</h4>
                            <div class="products-left d-flex pt-3">
                                <div class="products-photo me-2">
                                    <a href="#">
                                        <img src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                        class="img" alt="">
                                    </a>
                                </div>
                                <div class="information">
                                    <a href="#" class="information-link text-decoration-none text-dark">Quần Jeans Slimfit Faded
                                        Ripped-Effect QJ044 Màu Xanh</a>
                                    <div class="information-price">525.000</div>
                                </div>
                            </div>
                            <div class="products-left d-flex pt-3">
                                <div class="products-photo me-2">
                                    <a href="#">
                                        <img src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                        class="img" alt="">
                                    </a>
                                </div>
                                <div class="information">
                                    <a href="#" class="information-link text-decoration-none text-dark">Quần Jeans Slimfit Faded
                                        Ripped-Effect QJ044 Màu Xanh</a>
                                    <div class="information-price">525.000</div>
                                </div>
                            </div>
                            <div class="products-left d-flex pt-3">
                                <div class="products-photo me-2">
                                    <a href="#">
                                        <img src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                        class="img" alt="">
                                    </a>
                                </div>
                                <div class="information">
                                    <a href="#" class="information-link text-decoration-none text-dark">Quần Jeans Slimfit Faded
                                        Ripped-Effect QJ044 Màu Xanh</a>
                                    <div class="information-price">525.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 content-left">
                        <div class="hot_products pt-5">
                            <h4 class="form--title">Sản phẩm đã xem</h4>
                            <div class="products-left d-flex pt-3">
                                <div class="products-photo me-2">
                                    <a href="#">
                                        <img src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                        class="img" alt="">
                                    </a>
                                </div>
                                <div class="information">
                                    <a href="#" class="information-link text-decoration-none text-dark">Quần Jeans Slimfit Faded
                                        Ripped-Effect QJ044 Màu Xanh</a>
                                    <div class="information-price">525.000</div>
                                </div>
                            </div>
                            <div class="products-left d-flex pt-3">
                                <div class="products-photo me-2">
                                    <a href="#">
                                        <img src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                        class="img" alt="">
                                    </a>
                                </div>
                                <div class="information">
                                    <a href="#" class="information-link text-decoration-none text-dark">Quần Jeans Slimfit Faded
                                        Ripped-Effect QJ044 Màu Xanh</a>
                                    <div class="information-price">525.000</div>
                                </div>
                            </div>
                            <div class="products-left d-flex pt-3">
                                <div class="products-photo me-2">
                                    <a href="#">
                                        <img src="frontend/images/quan-tay-phoi-day-soc-qt023-mau-den-15964.png"
                                        class="img" alt="">
                                    </a>
                                </div>
                                <div class="information">
                                    <a href="#" class="information-link text-decoration-none text-dark">Quần Jeans Slimfit Faded
                                        Ripped-Effect QJ044 Màu Xanh</a>
                                    <div class="information-price">525.000</div>
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
export default {
    props: {
        datadefault: {
            type: Array,
            default: () => {
                return [];
            }
        },
        datacategory: {
            type: Array,
            default: () => {
                return [];
            }
        },
    },
    data() {
        return {
            datasDefault: this.datadefault,
            dataCategory: this.datacategory,
            dataSearch:{
                sort: null,
                category: null
            }
        }
    },
    methods: {
        formatImage(img) {
            return `uploads/${img}`;
        },
        responPromotion(precent, percent_promotion){
            let price = this.formatNumber(precent);
            return `${price} (${percent_promotion}%)` 
        },
        formatNumber(price) {
            var formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            });
            return formatter.format(price); 
        },
        selectData() {
            let scop = this
            this.$loading(true);
            httpStore
                    .dispatch("get", {
                        url: scop.baseUrl(`category-search?sort=${scop.dataSearch.sort}&category=${scop.dataSearch.category}`),
                    })
                    .then(response => {
                        this.datasDefault = response.datas
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
                        this.$loading(false);
                    });;
        },
        selectSort(sort) {
            this.dataSearch.sort = sort;
            this.selectData();
        },
        selectCate(cate) {
            this.dataSearch.category = cate;
            this.selectData();
        }
    }
}
</script>

<style scoped>
.image-more-block{
    width: 250px;
    height: 350px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-more-block>img{
    width: 100%;
    height: 100%;
}

</style>
<template>
  <div class="p-0 pt-5">
    <div class="promotions">
        <div class="promotions-center">
            <div v-for="(item, index) in datas" :key="index" class="promotions-content">
                <div class="hottest_fashion p-0">
                    <h1 class="titile__fashios text-start ps-5 pb-3">Sự kiện nổi {{item.name}} cực mạnh ({{item.percent}}%) <br/>
                    Bắt đầu từ {{item.start_date}} / {{item.end_date}}</h1>
                    <div class="d-flex flex-wrap flex-row product__shows">
                        <div v-for="(item2, index2) in item.product" :key="index2" class="product-item pt-2 pe-2 me-2 mt-2">
                            <div class="product__img position-relative">
                                <img :src="formatImage(item2.image)" class="product"
                                    alt="">
                                <a style="text-decoration: none" :href="baseUrl(`detail/${item2.id}`)" class="product__cart position-absolute"><i
                                        class="fa fa-shopping-cart"></i></a>
                            </div>
                            <div class="product__img__item mt-1 mb-1">
                                <img :src="formatImage(item2.image)" class="product-items"
                                    alt="">
                            </div>
                            <div class="product__title">
                                <a href="#" class="link-title text-decoration-none text-dark">{{item2.name}}</a>
                            </div>
                            <div class="product__price">{{formatPrice(item2.price)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        datas: {
            type: Array,
            default: () => {
                return [];
            }
        },
    },
    methods: {
        formatPrice(price) {
            var formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            });
            return formatter.format(price); 
        },
        formatImage(img) {
            return `uploads/${img}`;
        }
    }
}
</script>

<style>

</style>
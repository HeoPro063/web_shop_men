<template>
  <div>
    <div class="bg-dark header__top d-flex fixed-top">
        <div class="col-6 col-lg-6 col-xl-6 col-xxl-6">
            <div class="header__top__phone_number">
                <p class="text-center text-white">
                    <span class="header__top__phone__text "> Hotline: </span>
                    <a href="te:0966493975" class="text-white text-decoration-none">0966493975</a>
                </p>
            </div>
        </div>
        <div class="col-6 col-lg-6 col-xl-6 col-xxl-6">
            <div class="header__top__text__right">
                <ul class="sub__menu d-flex justify-content-end m-0 me-5 p-0">
                    <li class="sub__menu__chill list-unstyled me-4 border-end "><a href="#"
                            class="sub__link text-decoration-none">Cách chọn size</a></li>
                    <li class="sub__menu__chill list-unstyled me-4 border-end "><a href="#"
                            class="sub__link text-decoration-none">Chính sách khách vip</a></li>
                    <li class="sub__menu__chill list-unstyled me-4 border-end "><a href="#"
                            class="sub__link text-decoration-none">Giới thiệu</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div
        class="header__bottom bg-white d-flex d-flex justify-content-around align-items-center fixed-top ">
        <div class="header__bottom__logo">
            <a href="#" class="header__bottom__logo_link">
                <img src="frontend/images/logo.png" class="logo" alt="logo">
            </a>
        </div>
        <div class="header__bottom__list ">
            <ul class="header__bottom__nav d-flex m-0">
                <li class="header__bottom__menu list-unstyled"> <a href="#"
                        class="header__bottom__link text-decoration-none">
                        <span class="hot">Hot</span>
                        Hàng
                        mới</a> </li>
                <li class="header__bottom__menu list-unstyled ps-4"> <a href="#"
                        class="header__bottom__link text-decoration-none">
                        Áo
                        nam</a>
                    <ul class="header__bottom__sub__menu p-0">
                        <li class="menu__chill list-unstyled border-bottom"><a href="#"
                            class="link__chill text-decoration-none">Áo sơ mi</a></li>
                    </ul>
                </li>
                <li class="header__bottom__menu list-unstyled ps-4"> <a href="#"
                        class="header__bottom__link text-decoration-none">Quần
                        nam</a>
                    <ul class="header__bottom__sub__menu p-0">
                        <li class="menu__chill list-unstyled border-bottom"><a href="#"
                            class="link__chill text-decoration-none">Quần jeans</a></li>
                    </ul>
                </li>
                <li class="header__bottom__menu list-unstyled ps-4"> <a href="#"
                        class="header__bottom__link text-decoration-none">Phụ
                        kiện</a>
                    <ul class="header__bottom__sub__menu p-0">
                        <li class="menu__chill list-unstyled border-bottom"><a href="#"
                            class="link__chill text-decoration-none">Thắt lưng</a></li>
                    </ul>
                </li>
                <li class="header__bottom__menu list-unstyled ps-4"> <a href="#"
                        class="header__bottom__link text-decoration-none">Giày
                        dép</a>
                    <ul class="header__bottom__sub__menu p-0">
                        <li class="menu__chill list-unstyled border-bottom"><a href="#"
                                class="link__chill text-decoration-none">Giày</a></li>
                        <li class="menu__chill list-unstyled border-bottom"><a href="#"
                                class="link__chill text-decoration-none">sandal</a></li>
                        <li class="menu__chill list-unstyled"><a href="#"
                                class="link__chill text-decoration-none">Dép nam</a></li>
                    </ul>
                </li>
                <li class="header__bottom__menu list-unstyled ps-4"> <a href="#"
                        class="header__bottom__link text-decoration-none">
                        <span class="hot">Hot</span>
                        Khuyến
                        mãi</a> </li>
            </ul>
        </div>
        <div class="header__bottom__cart__search d-flex">
                <div v-if="dataUser" class="d-flex">
                    <div class="login"><a :href="baseUrl('user/my-profile')" class="login__link text-dark text-decoration-none">Tài khoản</a></div>
                    <div class="login"><a :href="baseUrl('user/logout')" class="login__link text-dark text-decoration-none">Đăng xuất</a></div>
                </div>
                <div v-else>
                    <div class="login"><a :href="baseUrl('user/login')" class="login__link text-dark text-decoration-none">Đăng nhập</a></div>
                </div>
            <div class="header__bottom__cart position-relative">
                <div class="cart">
                    <i class="fa fa-shopping-cart cart-search"></i>
                    <div class="cart__product">
                        <p class="d-flex pb-3 border-bottom cart__titile">Có <span
                                class="cart__number">1</span> <span class="cart__product__color">Sản
                                phẩm
                            </span> trong giỏ hàng </p>

                        <div class="cart__show ">
                            <div class="cart__list border-bottom mt-3 mb-3 pb-3">
                                <div class="cart__photo pe-2">
                                    <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                        class="photo" alt="">
                                </div>
                                <div class="cart__description">
                                    <a href="#" class="link__product">Áo Sơ Mi Oxford Tay Ngắn ASM017
                                        Màu
                                        Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf</a>
                                    <p class="price">1 X 245.000</p>
                                    <div class="delete"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                            <div class="cart__list border-bottom mt-3 mb-3">
                                <div class="cart__photo pe-2">
                                    <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                        class="photo" alt="">
                                </div>
                                <div class="cart__description">
                                    <a href="#" class="link__product">Áo Sơ Mi Oxford Tay Ngắn ASM017
                                        Màu
                                        Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf</a>
                                    <p class="price">1 X 245.000</p>
                                    <div class="delete"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                            <div class="cart__list border-bottom mt-3 mb-3">
                                <div class="cart__photo pe-2">
                                    <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                        class="photo" alt="">
                                </div>
                                <div class="cart__description">
                                    <a href="#" class="link__product">Áo Sơ Mi Oxford Tay Ngắn ASM017
                                        Màu
                                        Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf</a>
                                    <p class="price">1 X 245.000</p>
                                    <div class="delete"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                            <div class="cart__list border-bottom mt-3 mb-3">
                                <div class="cart__photo pe-2">
                                    <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                        class="photo" alt="">
                                </div>
                                <div class="cart__description">
                                    <a href="#" class="link__product">Áo Sơ Mi Oxford Tay Ngắn ASM017
                                        Màu
                                        Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf</a>
                                    <p class="price">1 X 245.000</p>
                                    <div class="delete"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                            <div class="cart__list border-bottom mt-3 mb-3">
                                <div class="cart__photo pe-2">
                                    <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                        class="photo" alt="">
                                </div>
                                <div class="cart__description">
                                    <a href="#" class="link__product">Áo Sơ Mi Oxford Tay Ngắn ASM017
                                        Màu
                                        Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf</a>
                                    <p class="price">1 X 245.000</p>
                                    <div class="delete"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                            <div class="cart__list border-bottom mt-3 mb-3">
                                <div class="cart__photo pe-2">
                                    <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                        class="photo" alt="">
                                </div>
                                <div class="cart__description">
                                    <a href="#" class="link__product">Áo Sơ Mi Oxford Tay Ngắn ASM017
                                        Màu
                                        Xanh ádfasdfasdfadsfasd fadksjfhajklsdfgkjadsdsf</a>
                                    <p class="price">1 X 245.000</p>
                                    <div class="delete"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="total">Tổng: 245,000</div>
                        <div class="send__order"><button class="btns"> Gửi đơn hàng </button></div>
                    </div>
                </div>
            </div>
            <div class="header__bottom__search position-relative">
                <div class="search cart-search">
                    <i class="fa fa-search"></i>
                    <form action="#" method="post" class="search__product position-absolute"
                        autocomplete="off">
                        <input type="text" name="search" class="search__input" placeholder="Tìm kiếm"
                            id="">
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
            dataUser: this.user
        }
    },
    created() {
        console.log(this.dataUser)
        console.log(window.location.href)
    },
    methods: {
        baseUrl(url) {
            return window.location.href + url;
        }
    }
}
</script>

<style>

</style>
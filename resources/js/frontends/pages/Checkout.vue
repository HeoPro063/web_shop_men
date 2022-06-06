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
        <form action="#" method="post">
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
                                        id="username">
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="email" class="email-label text-end col-lg-4">Email
                                        *</label>
                                    <input type="text" name="email" class="email box-input col-lg-8"
                                        placeholder="Họ và tên" id="email">
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="numberphone"
                                        class="numberphone-label pe-3 text-end col-lg-4">Số điện thoạt
                                        *</label>
                                    <input type="text" name="numberphone"
                                        class="numberphone box-input col-lg-8" placeholder="Họ và tên"
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
                                        aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="city-province"
                                        class="city-province-label pe-3 text-end col-lg-4">Chọn quận
                                        huyện * </label>
                                    <select class="box-input col-lg-8"
                                        aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="wards" class="wards-label pe-3 text-end col-lg-4">Tên
                                        phường xã *</label>
                                    <input type="text" name="wards" class="wards col-lg-8 box-input"
                                        placeholder="Họ và tên" id="wards">
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="streetname"
                                        class="street-name-label pe-3 text-end col-lg-4">Số nhà tên
                                        đường *</label>
                                    <input type="text" name="streetname"
                                        class="street-name col-lg-8 box-input" placeholder="Họ và tên"
                                        id="streetname">
                                </div>
                            </div>
                            <div class="form-group-conacts pt-4">
                                <div class="row">
                                    <label for="note" class="note-label pe-3 text-end col-lg-4">Ghi chú
                                        *</label>
                                    <textarea name="note" id="note" class="note col-lg-8" cols="20"
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
                                    <th scope="col" class="table-text text-center">Đơn giá</th>
                                    <th scope="col" class="table-text text-center">Tổng</th>
                                    <th scope="col" class="table-text text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th rowspan="2">
                                        <img src="frontend/images/ao-so-mi-oxford-tay-ngan-asm017-mau-xanh_2_small-15391.png"
                                            class="img-cart" alt="">
                                    </th>
                                    <td class="overflow-hidden">
                                        <a href="#" class="product-links">Áo Faded Ripped-Effect QJ044
                                            Màu Xanh</a>
                                    </td>
                                    <td class="text-center text-products">1</td>
                                    <td class="text-center text-products">525.000</td>
                                    <td class="text-center text-products">525.000</td>
                                    <td class="text-center text-products">525.000</td>

                                </tr>
                                <tr>
                                    <td align="right" class="text-size">Size: 28</td>
                                    <td colspan="3" class="d-flex border-0">
                                        <div class="data-number number-wrapper">
                                            <button class="apartfrom border-end" id="apartfrom">-</button>
                                            <input type="number" name="number" value="1" class="form-number btn-number" step="1" min="1" id="form-number">
                                            <button class="addfrom border-start" id="addfrom">+</button>
                                        </div>
                                    </td>
                                    <td colspan="3" class="text-end">
                                        <button class="btn-delete">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"> <a class="btn-home text-dark" style="float:right;"
                                            href="#">Quay về</a>
                                        <div class="clr"></div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <h1 class="form-title">Tổng</h1>
                        <table class="w-100 table">
                            <tbody>
                                <tr>
                                    <td class="w-50 text-products">Số tiền mua hàng</td>
                                    <td class="w-50 text-products">525,000</td>
                                </tr>
                                <tr>
                                    <td class="w-50 text-products">Tổng trọng lượng sản phẩm:</td>
                                    <td class="w-50 text-products"> 620 Gram</td>
                                </tr>
                                <tr>
                                    <td class="w-75 text-end text-products">Tổng tiền: </td>
                                    <td class="w-25 text-products">525,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="btn-submit text-center mt-5">
                <button type="button" class="btn btn-danger w-25 btn-to">Gửi đơn hàng</button>
            </div>

        </form>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style>

</style>
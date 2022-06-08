<template>
<div class="tab-pane fade bg-transparent" id="still-follow" role="tabpanel" aria-labelledby="still-follow-tab">
    <p class="tabs-title">Đơn hàng của tôi</p>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-center" id="all-orders-tab" data-bs-toggle="tab" data-bs-target="#all-orders" type="button" role="tab" aria-controls="all-orders" aria-selected="true">Tất cả đơn hàng</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-center" id="waiting-for-payment-tab" data-bs-toggle="tab" data-bs-target="#waiting-for-payment" type="button" role="tab" aria-controls="waiting-for-payment" aria-selected="false">
                Chờ thành
                toán
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-center" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing" type="button" role="tab" aria-controls="processing" aria-selected="false">Đang xử lý</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-center" id="being-transported-tab" data-bs-toggle="tab" data-bs-target="#being-transported" type="button" role="tab" aria-controls="being-transported" aria-selected="false">Đang vận chuyển</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-center" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered" type="button" role="tab" aria-controls="delivered" aria-selected="false">Đã giao</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-center" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Đã hủy</button>
        </li>
    </ul>
    <div class="tab-content mt-5" id="myTabContent">
        <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
            <div class="bg-white p-3">
                <div class="status pb-4">Giao hang thành công</div>
                <div class="goods d-flex pt-3 border-top border-bottom pb-4 justify-content-between">
                    <div class="goods-img-product-information d-flex">
                        <div class="goods-img border border-dark">
                            <img src="user/img/4a775aa4226fffd577beb5d8e88c0db9.jfif" class="goods-photo" alt />
                        </div>
                        <div class="goods-product-information ps-5">
                            <div class="goods-product-information-name">
                                Lorem, ipsum dolor
                                sit amet consectetur adipisicing elit. Cupiditate, facilis?
                            </div>
                            <div class="goods-product-information-size">
                                Kích thước:
                                <span>L</span>
                            </div>
                            <div class="goods-product-information-numbers">
                                Số lượng:
                                <span>X2</span>
                            </div>
                        </div>
                    </div>
                    <div class="goods-price">185.000 ₫</div>
                </div>
                <div class="price d-flex justify-content-end">
                    <div class="price-bottom">
                        <div class="price-totol text-end pb-4">
                            Tổng tiền:
                            <span>190.000</span>
                        </div>
                        <button class="see-details btn-price">Xem chi tiết</button>
                        <button class="btn-price" data-bs-toggle="modal" data-bs-target="#delete-product">Xóa</button>
                        <button class="repurchase btn-price">Mua lại</button>
                        <button class="evaluate btn-price">Đánh giá</button>
                    </div>
                </div>
                <div class="modal fade" id="delete-product" tabindex="-1" aria-labelledby="delete-product" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-product">Xóa sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Bạn có chắc muốn xóa không</div>
                            <div class="modal-footer">
                                <form action method="post">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="button" class="btn btn-primary">Có</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              
        </div>
        <div class="tab-pane fade" id="waiting-for-payment" role="tabpanel" aria-labelledby="waiting-for-payment-tab">
            <div class="bg-white p-3">
                <div class="status pb-4">Xác nhận đơn hàng</div>
                <div class="goods d-flex pt-3 border-top border-bottom pb-4 justify-content-between">
                    <div class="goods-img-product-information d-flex">
                        <div class="goods-img border border-dark">
                            <img src="user/img/4a775aa4226fffd577beb5d8e88c0db9.jfif" class="goods-photo" alt />
                        </div>
                        <div class="goods-product-information ps-5">
                            <div class="goods-product-information-name">
                                Lorem, ipsum dolor
                                sit amet consectetur adipisicing elit. Cupiditate, facilis?
                            </div>
                            <div class="goods-product-information-size">
                                Kích thước:
                                <span>L</span>
                            </div>
                            <div class="goods-product-information-numbers">
                                Số lượng:
                                <span>X2</span>
                            </div>
                        </div>
                    </div>
                    <div class="goods-price">185.000 ₫</div>
                </div>
                <div class="price d-flex justify-content-end">
                    <div class="price-bottom">
                        <div class="price-totol text-end pb-4">
                            Tổng tiền:
                            <span>190.000</span>
                        </div>
                        <button class="delete btn-price">Hủy đơn hàng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
            <div class="bg-white p-3">
                <div class="status pb-4">Đang xử lí</div>
                <div class="goods d-flex pt-3 border-top border-bottom pb-4 justify-content-between">
                    <div class="goods-img-product-information d-flex">
                        <div class="goods-img border border-dark">
                            <img src="user/img/4a775aa4226fffd577beb5d8e88c0db9.jfif" class="goods-photo" alt />
                        </div>
                        <div class="goods-product-information ps-5">
                            <div class="goods-product-information-name">
                                Lorem, ipsum dolor
                                sit amet consectetur adipisicing elit. Cupiditate, facilis?
                            </div>
                            <div class="goods-product-information-size">
                                Kích thước:
                                <span>L</span>
                            </div>
                            <div class="goods-product-information-numbers">
                                Số lượng:
                                <span>X2</span>
                            </div>
                        </div>
                    </div>
                    <div class="goods-price">185.000 ₫</div>
                </div>
                <div class="price d-flex justify-content-end">
                    <div class="price-bottom">
                        <div class="price-totol text-end pb-4">
                            Tổng tiền:
                            <span>190.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="being-transported" role="tabpanel" aria-labelledby="being-transported-tab">
            <div class="bg-white p-3">
                <div class="status pb-4">Đang vận chuyển</div>
                <div class="goods d-flex pt-3 border-top border-bottom pb-4 justify-content-between">
                    <div class="goods-img-product-information d-flex">
                        <div class="goods-img border border-dark">
                            <img src="user/img/4a775aa4226fffd577beb5d8e88c0db9.jfif" class="goods-photo" alt />
                        </div>
                        <div class="goods-product-information ps-5">
                            <div class="goods-product-information-name">
                                Lorem, ipsum dolor
                                sit amet consectetur adipisicing elit. Cupiditate, facilis?
                            </div>
                            <div class="goods-product-information-size">
                                Kích thước:
                                <span>L</span>
                            </div>
                            <div class="goods-product-information-numbers">
                                Số lượng:
                                <span>X2</span>
                            </div>
                        </div>
                    </div>
                    <div class="goods-price">185.000 ₫</div>
                </div>
                <div class="price d-flex justify-content-end">
                    <div class="price-bottom">
                        <div class="price-totol text-end pb-4">
                            Tổng tiền:
                            <span>190.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
            <div class="bg-white p-3">
                <div class="status pb-4">Giao hang thành công: Đã giao</div>
                <div class="goods d-flex pt-3 border-top border-bottom pb-4 justify-content-between">
                    <div class="goods-img-product-information d-flex">
                        <div class="goods-img border border-dark">
                            <img src="user/img/4a775aa4226fffd577beb5d8e88c0db9.jfif" class="goods-photo" alt />
                        </div>
                        <div class="goods-product-information ps-5">
                            <div class="goods-product-information-name">
                                Lorem, ipsum dolor
                                sit amet consectetur adipisicing elit. Cupiditate, facilis?
                            </div>
                            <div class="goods-product-information-size">
                                Kích thước:
                                <span>L</span>
                            </div>
                            <div class="goods-product-information-numbers">
                                Số lượng:
                                <span>X2</span>
                            </div>
                        </div>
                    </div>
                    <div class="goods-price">185.000 ₫</div>
                </div>
                <div class="price d-flex justify-content-end">
                    <div class="price-bottom">
                        <div class="price-totol text-end pb-4">
                            Tổng tiền:
                            <span>190.000</span>
                        </div>
                        <button class="delete btn-price">Xóa</button>
                        <button class="repurchase btn-price">Mua lại</button>
                        <button class="evaluate btn-price">Đánh giá</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
            <div class="bg-white p-3">
                <div class="status pb-4">Giao hang không thành công: Đã hủy</div>
                <div class="goods d-flex pt-3 border-top border-bottom pb-4 justify-content-between">
                    <div class="goods-img-product-information d-flex">
                        <div class="goods-img border border-dark">
                            <img src="user/img/4a775aa4226fffd577beb5d8e88c0db9.jfif" class="goods-photo" alt />
                        </div>
                        <div class="goods-product-information ps-5">
                            <div class="goods-product-information-name">
                                Lorem, ipsum dolor
                                sit amet consectetur adipisicing elit. Cupiditate, facilis?
                            </div>
                            <div class="goods-product-information-size">
                                Kích thước:
                                <span>L</span>
                            </div>
                            <div class="goods-product-information-numbers">
                                Số lượng:
                                <span>X2</span>
                            </div>
                        </div>
                    </div>
                    <div class="goods-price">185.000 ₫</div>
                </div>
                <div class="price d-flex justify-content-end">
                    <div class="price-bottom">
                        <div class="price-totol text-end pb-4">
                            Tổng tiền:
                            <span>190.000</span>
                        </div>
                        <button class="delete btn-price">Xóa</button>
                        <button class="repurchase btn-price">Mua lại</button>
                        <button class="evaluate btn-price">Đánh giá</button>
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
  data() {
    return {
      dataOrder: []
    }
  },
  methods:{
  },
  created() {
    this.getDataOrder();
  }
};
</script>

<style>
</style>

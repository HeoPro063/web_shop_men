<template>
  <div class="container-fluid" style="height:627px; overflow-x: hidden;
    display: block;">
      <div class="row mt-3">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Products</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Name</th>
                            <th>Price origin</th>
                            <th>Promotion price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataProducts" :key="index">
                            <td>{{stt(index)}}</td>
                            <td>{{item.name}}</td>
                            <td>{{formatPrice(item.price)}}</td>
                            <td>{{responPromotion(item.promotion, item.percent_promotion)}}</td>
                            <td>{{item.quantity}}</td>
                            <td>
                                <a class="m-2" :href="baseUrl(`product/${item.id}/edit`)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="m-text-danger">
                                    <i class="fa-solid fa-trash" @click="deleteProduct(item.id)"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="row mt-3">
          <div class="col-12">
            <div class="pagination d-flex justify-content-end" v-if="paginationData.links">
                <a @click="linkProduct(paginationData.prev_page_url)">&laquo;</a>   
                <div v-for="(item, index) in paginationData.links" :key="index">
                    <a v-if="index != 0 && index < paginationData.links.length - 1" :class="{'active' : item.active}" @click="linkProduct(item.url)" class="btn btn-secondary" style="color: #fff">
                    {{item.label}}
                    </a>
                </div>
                <a @click="linkProduct(paginationData.next_page_url)" class="disabled">&raquo;</a> 
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
            dataProducts: [],
            paginationData: [],
        }
    },
    created() {
        this.getProduct(1);
    },
    methods: {
        stt(index) {
            return index + 1;
        },
        linkProduct(url) {
            if(url != null) {
                httpStore
                    .dispatch("get", {
                    url: url,
                    })
                    .then(response => {
                        this.dataProducts = response.datas.products;
                        this.paginationData = response.datas.paginate;
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
            }
        },
        getProduct(page) {
            let scop = this
            httpStore
                .dispatch("get", {
                url: scop.baseUrl(`product?page=${page}`),
                })
                .then(response => {
                    if(response.status === 200) {
                        scop.dataProducts = response.datas.products;
                        scop.paginationData = response.datas.paginate;
                    }
                })
                .catch(error => {
                    scop.$toast.open({
                        message: "Error",
                        type: "error",
                        duration: 2000,
                        dismissible: true,
                        position: "top"
                    });
                });
        },
        deleteProduct(id) {
                Swal.fire({
                    title: 'Delete?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.value) {
                    let scop = this
                        httpStore
                            .dispatch("delete", {
                                url: scop.baseUrl(`product/${id}`),
                            })
                            .then(response => {
                                if(response.status === 200) {
                                    this.getProduct(this.paginationData.current_page);
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                }else {
                                    Swal.fire(
                                    'Erorr!',
                                    'Error delete.',
                                    'error'
                                    )
                                }
                              
                            })
                            .catch(error => {
                                Swal.fire(
                                'Erorr!',
                                'Can not delete because there are still products.',
                                'erorr'
                                )
                            });
                        
                    }
                })
        },
        responPromotion(promotion, percent) {
            if(promotion === null) {
                return 'Không có khuyến mãi';
            }else{
                if(promotion === 0){
                    return 'Khuyến mãi hết hạn';
                }else{

                    return this.formatPrice(promotion) + ` - (${percent}%)` 
                }
            }
        },
        formatPrice(price) {
            var formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            });
            return formatter.format(price); 
        }
    }
}
</script>

<style>
    .pagination {
        display: inline-block;
        }

        .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        margin: 2px;
        }

        .active{
            background: rgb(66, 65, 65);
        }

</style>
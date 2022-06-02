<template>
  <div class="container-fluid" style="height:627px; overflow-x: hidden;
    display: block;">
      <div class="row mt-3">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Promotions</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Name</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Percent promotion</th>
                            <th>Current days </th>
                            <th>Action</th>
                            <th>Total days</th>
                            <th>Total product using</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataPromotions" :key="index" :class="{'bg-dange-more': item.effective === 0}">
                            <td>{{stt(index)}}</td>
                            <td>{{item.name}}</td>
                            <td>{{formatDate(item.start_date)}}</td>
                            <td>{{formatDate(item.end_date)}}</td>
                            <td>{{item.percent}}%</td>
                            <td>{{item.total_days_promotion}}</td>
                            <td>
                                <a class="m-2 " :href="baseUrl(`promotion/${item.id}/edit/`)" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="m-2" @click="activeStatus(item.id)" :class="{'text-success': item.status == 0}">
                                    <i class="fa-solid fa-check-to-slot"></i>
                                </a>
                                <button @click="deletePromotion(item.id)" type="button" class="text-secondary m-2 more-botton" :disabled="item.status == 1" :class="{'text-danger': item.status == 0}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                            <td>{{item.effective > 0 ? item.effective : 'Hết hạn'}}</td>
                            <td>{{item.total_products}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>

      <div class="row mt-3">
          <div class="col-12">
            <div class="pagination d-flex justify-content-end" v-if="paginationData.links">
                <a @click="linkPromotion(paginationData.prev_page_url)">&laquo;</a>   
                <div v-for="(item, index) in paginationData.links" :key="index">
                    <a v-if="index != 0 && index < paginationData.links.length - 1" :class="{'active' : item.active}" @click="linkPromotion(item.url)" class="btn btn-secondary" style="color: #fff">
                    {{item.label}}
                    </a>
                </div>
                <a @click="linkPromotion(paginationData.next_page_url)" class="disabled">&raquo;</a> 
            </div>
          </div>
      </div>
  </div>
</template>

<script>
import httpStore from "@core/config/httpStore";
import moment from 'moment';
export default {
    data() {
        return {
            dataPromotions: [],
            paginationData: [],
        }
    },
    created() {
        this.getPromotions(1);
    },
    methods: {
        stt(index) {
            return index + 1;
        },
        formatDate(value) {
            return moment(String(value)).format('DD-MM-YYYY')
        },
        linkPromotion(url) {
            if(url != null) {
                httpStore
                    .dispatch("get", {
                    url: url,
                    })
                    .then(response => {
                        this.dataPromotions = response.datas.promotions;
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
        getPromotions(page) {
            let scop = this
            httpStore
                .dispatch("get", {
                url: scop.baseUrl(`promotion?page=${page}`),
                })
                .then(response => {
                    if(response.status === 200) {
                        this.dataPromotions = response.datas.promotions;
                        this.paginationData = response.datas.paginate;
                    }
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
        deletePromotion(id) {
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
                                url: scop.baseUrl(`promotion/${id}`),
                            })
                            .then(response => {
                                this.getPromotions(this.paginationData.current_page);
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
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
        activeStatus(id) {
              this.$loading(true);
              httpStore
                    .dispatch("get", {
                    url: this.baseUrl(`active-promotion/${id}`),
                    })
                    .then(response => {
                        this.getPromotions(this.paginationData.current_page);
                        this.$toast.open({
                            message: "Success",
                            type: "success",
                            duration: 2000,
                            dismissible: true,
                            position: "top"
                        });
                    })
                    .catch(error => {
                        this.$toast.open({
                            message: "Error",
                            type: "error",
                            duration: 2000,
                            dismissible: true,
                            position: "top"
                        });
                    })
                    .finally(() => {
                        this.$loading(false);
                    });

        }
    }
}
</script>
<style scoped>
.bg-dange-more{
    background: rgba(255, 0, 0, 0.349);
}
.more-botton{
    border: none;
    background:none;
    outline: none;
}




</style>

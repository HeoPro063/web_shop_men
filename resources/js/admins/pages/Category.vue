<template>
  <div class="container-fluid" style="height:627px; overflow-x: hidden;
    display: block;">
      <div class="row mt-3">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-left">
                            <h5 class="card-title mb-0">List Categories</h5>
                        </div>
                        <div class="card-right">
                            <div class="mb-3">
                                <label for="search-category" class="form-label">Tìm kiếm</label>
                                <div class="d-flex">
                                    <input type="search" class="form-control search" v-model="searchText" id="search-category" placeholder="Tìm kiếm">
                                    <button class="search-btn" @click="searchTexts"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Name</th>
                            <th>Total product</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataCategories" :key="index">
                            <td>{{stt(index)}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.total_products}}</td>
                            <td>
                                <a :href="baseUrl(`category/${item.id}/edit/`)" class="m-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a @click="deleteCategory(item.id)" class="m-text-danger">
                                    <i class="fa-solid fa-trash"></i>
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
                <a @click="linkCategory(paginationData.prev_page_url)">&laquo;</a>   
                <div v-for="(item, index) in paginationData.links" :key="index">
                    <a v-if="index != 0 && index < paginationData.links.length - 1" :class="{'active' : item.active}" @click="linkCategory(item.url)" class="btn btn-secondary" style="color: #fff">
                    {{item.label}}
                    </a>
                </div>
                <a @click="linkCategory(paginationData.next_page_url)" class="disabled">&raquo;</a> 
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
            dataCategories: [],
            paginationData: [],
            searchText: ""
        }
    },
    created() {
        this.getCategories(1);
    },
    methods: {
        stt(index) {
            return index + 1;
        },
        linkCategory(url) {
            if(url != null) {
                httpStore
                    .dispatch("get", {
                    url: url,
                    })
                    .then(response => {
                        this.dataCategories = response.datas.categories;
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
        getCategories(page) {
            let scop = this
            httpStore
                .dispatch("get", {
                url: scop.baseUrl(`category?page=${page}`),
                })
                .then(response => {
                    if(response.status === 200) {
                        this.dataCategories = response.datas.categories;
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
        deleteCategory(id) {
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
                                url: scop.baseUrl(`category/${id}`),
                            })
                            .then(response => {
                                this.getCategories(this.paginationData.current_page);
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
        searchTexts() {
            let page = this.paginationData.current_page

            this.$loading(true);
            let scop = this
            httpStore
                .dispatch("get", {
                    url: scop.baseUrl(`category?search=${scop.searchText}&page=${page}`),
                })
                .then(response => {
                    if (response.status === 200) {
                        this.dataCategories = response.datas.categories;
                        this.paginationData = response.datas.paginate;
                    }
                    this.$toast.open({
                        message: 'Kết quả tìm kiếm',
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
        },
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
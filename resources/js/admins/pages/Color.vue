<template>
  <div class="container-fluid" style="height:627px; overflow-x: hidden;
    display: block;">
      <div class="row mt-3">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-left">
                            <h5 class="card-title mb-0">List Colors</h5>
                        </div>
                        <div class="card-right">
                            <div class="mb-3">
                                <label for="search-category" class="form-label">Tìm kiếm</label>
                                <div class="d-flex">
                                    <input type="search" class="form-control search" v-model="searchText" id="search-category" placeholder="Tìm kiếm">
                                    <button class="search-btn" @click="searchTextsColor"><i class="fa fa-search"></i></button>
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
                            <th>Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in dataColors" :key="index">
                            <td>{{stt(index)}}</td>
                            <td>{{item.name}} </td>
                            <td> <div class="p-2" :style="`background:${item.favcolor}`"></div> {{item.favcolor}} </td>
                            <td>
                                <a :href="baseUrl(`color/${item.id}/edit/`)" class="m-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a @click="deleteColor(item.id)" class="m-text-danger">
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
                <a @click="linkColor(paginationData.prev_page_url)">&laquo;</a>   
                <div v-for="(item, index) in paginationData.links" :key="index">
                    <a v-if="index != 0 && index < paginationData.links.length - 1" :class="{'active' : item.active}" @click="linkColor(item.url)" class="btn btn-secondary" style="color: #fff">
                    {{item.label}}
                    </a>
                </div>
                <a @click="linkColor(paginationData.next_page_url)" class="disabled">&raquo;</a> 
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
            dataColors: [],
            paginationData: [],
            searchText: ""
        }
    },
    methods: {
        stt(index) {
            return index + 1;
        },
        getColor(page) {
            let scop = this
            httpStore
                .dispatch("get", {
                url: scop.baseUrl(`color?page=${page}`),
                })
                .then(response => {
                    if(response.status === 200) {
                        this.dataColors = response.datas.colors;
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
        linkColor(url) {
            if(url != null) {
                httpStore
                    .dispatch("get", {
                    url: url,
                    })
                    .then(response => {
                        this.dataColors = response.datas.colors;
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
        deleteColor(id) {
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
                                url: scop.baseUrl(`color/${id}`),
                            })
                            .then(response => {
                                this.getColor(this.paginationData.current_page);
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
        searchTextsColor() {
            let page = this.paginationData.current_page

            this.$loading(true);
            let scop = this
            httpStore
                .dispatch("get", {
                    url: scop.baseUrl(`color?search=${scop.searchText}&page=${page}`),
                })
                .then(response => {
                    if (response.status === 200) {
                         this.dataColors = response.datas.colors;
                        this.paginationData = response.datas.paginate;
                    }
                    this.$toast.open({
                        message: 'Màu đã tìm kiếm',
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
    },
    created() {
        this.getColor(1);
    }
}
</script>

<style>

</style>
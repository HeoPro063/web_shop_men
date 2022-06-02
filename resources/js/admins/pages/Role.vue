<template>
  <div class="container-fluid" style="height:627px; overflow-x: hidden;
    display: block;">
      <div class="row mt-3">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Roles</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Name</th>
                            <th>User use</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in dataRoles" :key="index">
                            <td>{{stt(index)}}</td>
                            <td>{{item.name}} </td>
                            <td>{{item.total_user}}</td>
                            <td>
                                <a :href="baseUrl(`role/${item.id}/edit/`)" class="m-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a @click="deleteRole(item.id)" class="m-text-danger">
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
                <a @click="linkRole(paginationData.prev_page_url)">&laquo;</a>   
                <div v-for="(item, index) in paginationData.links" :key="index">
                    <a v-if="index != 0 && index < paginationData.links.length - 1" :class="{'active' : item.active}" @click="linkRole(item.url)" class="btn btn-secondary" style="color: #fff">
                    {{item.label}}
                    </a>
                </div>
                <a @click="linkRole(paginationData.next_page_url)" class="disabled">&raquo;</a> 
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
            dataRoles: [],
            paginationData: [],
        }
    },
    methods: {
        stt(index) {
            return index + 1;
        },
        getRole() {
            let scop = this
            httpStore
                .dispatch("get", {
                url: scop.baseUrl('role'),
                })
                .then(response => {
                    if(response.status === 200) {
                        this.dataRoles = response.datas.roles;
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
        linkRole(url) {
            if(url != null) {
                httpStore
                    .dispatch("get", {
                    url: url,
                    })
                    .then(response => {
                        this.dataRoles = response.datas.roles;
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
        deleteRole(id) {
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
                                url: scop.baseUrl(`role/${id}`),
                            })
                            .then(response => {
                                this.getRole();
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
        }
    },
    created() {
        this.getRole();
    }
}
</script>

<style>

</style>
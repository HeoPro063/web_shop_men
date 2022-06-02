<template>
   <div class="container-fluid" style="height:627px; overflow-x: hidden; display: block;">
       <div class="row">
           <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Product</h5>
                    </div>
                    <form method="post" >
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Category<span class="text-danger">*</span></label>
                                        <select  name="category" v-validate="'required'" class="form-select" aria-label="Default select example" v-model="formData.category_id" :disabled="DataCategories.length == 0" :class="{'dops-status': DataCategories.length == 0, 'is-invalid' : errors.has('category')}">
                                            <option :value="null" selected>Choose category</option>
                                            <option v-for="(item, index) in DataCategories" :value="item.id" :key="index">{{item.name}}</option>
                                        </select>
                                        <span class="text text-danger">{{ errors.first('category') }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Quantity<span class="text-danger">*</span></label>
                                        <input v-model="formData.quantity" :class="{'is-invalid' : errors.has('quantity')}" v-validate="'required'" type="number"  class="form-control" name="quantity" placeholder="Quantity enter">
                                        <span class="text text-danger">{{ errors.first('quantity') }}</span>
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Name product <span class="text-danger">*</span></label>
                                        <input v-model="formData.name" :class="{'is-invalid' : errors.has('name')}" v-validate="'required'" type="text"  class="form-control " name="name" placeholder="Name enter">
                                        <span class="text text-danger">{{ errors.first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Price <span class="text-danger">*</span></label>
                                        <input v-model="formData.price" :class="{'is-invalid' : errors.has('price')}" v-validate="'required'" type="number"  class="form-control " name="price" placeholder="Price enter">
                                        <span class="text text-danger">{{ errors.first('price') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Color<span class="text-danger">*</span></label>
                                        <select  class="form-select" v-validate="'required'"  v-model="formData.color_id" aria-label="Default select example" :disabled="DataColors.length == 0" :class="{'dops-status': DataColors.length == 0, 'is-invalid' : errors.has('color')}" name="color">
                                            <option :value="null" selected>Choose color</option>
                                            <option v-for="(item, index) in DataColors" :value="item.id" :key="index">{{item.name}}</option>
                                        </select>
                                        <span class="text text-danger">{{ errors.first('color') }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Size<span class="text-danger">*</span></label>
                                        <select class="form-select" v-validate="'required'" v-model="formData.size_id"  aria-label="Default select example" :disabled="DataSizes.length == 0" :class="{'dops-status': DataSizes.length == 0, 'is-invalid' : errors.has('size')}" name="size">
                                            <option :value="null" selected>Choose size</option>
                                            <option v-for="(item, index) in DataSizes" :value="item.id" :key="index">{{item.name}}</option>
                                        </select>
                                        <span class="text text-danger">{{ errors.first('size') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <textarea class="form-control" placeholder="Description enter" id="floatingTextarea" v-model="formData.description"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3 p-3">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary" @click="saveProduct">
                                    Save
                                </button>
                            </div>
                            <div class="col-6 d-flex justify-content-around ">
                                <select class="form-select w-50" v-model="formData.promotion_id"  aria-label="Default select example"  :disabled="!formPromotion.status" :class="{'dops-status': !formPromotion.status}" name="promotion">
                                    <option :value="null" selected>Choose promotion</option>
                                    <option v-for="(item, index) in DataPromotions" :value="item.id" :key="index">{{item.name}}</option>
                                </select>
                                <button type="button" :disabled="DataPromotions.length == 0" class="btn" :class="formPromotion.class" @click="promotionChange">
                                    {{ DataPromotions.length > 0 ? formPromotion.title : 'No promotions'}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
       </div>
        <div class="row mt-3 mb-5">
          <div class="col-12">
             <div class="custom-file">
                  <label class="custom-file-label" for="inputGroupFile01">Add more image  </label>
                  <input type="file" multiple @change="uploadImage" name="imagesProduct">
                  <button class="btn btn-primary" @click="saveImage">Add image</button>
              </div>
          </div>
          <div class="col-2 p-2" v-for="(item, index) in imagesProduct" :key="index">
              <img  :src="formatImage(item.name)"  class="img-thumbnail more-image-css">
              <div class="group- p-2">
                <button class="btn btn-danger" @click="deleteImage(item.id, index)">Xóa</button>
              </div>
          </div>
        </div>

   </div>
</template>

<script>
import httpStore from "@core/config/httpStore";
export default {
    props: {
        product: {
            type: Object,
            default: () => {
                return [];
            },
        },
        images: {
            type: Array,
            default: () => {
                return [];
            },
        },
        categories: {
            type: Array,
            default: () => {
                return [];
            },
        },
        sizes: {
            type: Array,
            default: () => {
                return [];
            },
        },  
        colors: {
            type: Array,
            default: () => {
                return [];
            },
        },
        promotions: {
            type: Array,
            default: () => {
                return [];
            },
        },
    },
    data() {
        return {
            formData: {
                id: null,
                category_id: null,
                size_id: null,
                color_id: null,
                promotion_id: null,
                name: null,
                quantity: null,
                price: null,
                description: null,
            },
            formPromotion: {
                status: false,
                title: 'Add More promotion',
                class: 'btn-warning'
            },
            DataCategories: this.categories,
            DataSizes: this.sizes,
            DataColors: this.colors,
            DataPromotions: this.promotions,
            DataProduct: this.product,
            imagesProduct: [],
            addMoreImage: []
        }
    }, 
    methods: {
        promotionChange() {
            this.formPromotion.status = !this.formPromotion.status;
            if(this.formPromotion.status) {
                this.formPromotion.title = 'Canceled promotion',
                this.formPromotion.class = 'btn-success'
            }else {
                this.formPromotion.title = 'Add more promotion',
                this.formPromotion.class = 'btn-warning'
            }
        },
        saveProduct() {
            let scop = this;

            scop.$validator.validate().then(valid => {
                if (valid) {
                     httpStore
                        .dispatch("put", {
                            url: scop.baseUrl(`product/${scop.formData.id}`),
                            data: scop.formData,
                        })
                        .then(response => {
                          if(response.status === 200) {
                              this.$toast.open({
                                message: "Success",
                                type: "success",
                                duration: 2000,
                                dismissible: true,
                                position: "top"
                              });
                          }else{
                              this.$toast.open({
                                message: response.message,
                                type: "error",
                                duration: 2000,
                                dismissible: true,
                                position: "top"
                              });
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
                }
            });
        },
        uploadImage(event) {
            this.addMoreImage = [];
            for (let i = 0; i < event.target.files.length; i++) {
                this.addMoreImage.push(event.target.files[i]);
            }
        },
        getDataEdit() {
          this.formData.id = this.product.id,
          this.formData.category_id = this.product.category_id,
          this.formData.size_id = this.product.size_id,
          this.formData.color_id = this.product.color_id,
          this.formData.promotion_id = this.product.promotion_id,
          this.formData.name = this.product.name,
          this.formData.quantity = this.product.quantity,
          this.formData.price = this.product.price,
          this.formData.description = this.product.description,
          this.imagesProduct = this.images
        },
        formatImage(image) {
          return `uploads/${image}`;
        },
        deleteImage(id, index) {
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
                                url: scop.baseUrl(`image-product/${id}`),
                            })
                            .then(response => {
                                if(response.status === 200) {
                                this.imagesProduct.splice(index, 1);
                                  Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                  )
                                }else{
                                Swal.fire(
                                    'Erorr!',
                                    'Can not delete.',
                                    'erorr'
                                  )
                                }
                               
                            })
                            .catch(error => {
                                Swal.fire(
                                'Erorr!',
                                'Can not delete .',
                                'erorr'
                                )
                            });
                        
                    }
                })
        },
        saveImage() {
            let scop = this;
          
            if(scop.addMoreImage.length > 0) {
              let formData = new FormData();
              formData.append('product_id', this.formData.id);
              for (let i = 0; i < scop.addMoreImage.length; i++) {
                  let file =  scop.addMoreImage[i];
                  formData.append('files['+i+']', file);
              }
              httpStore
                .dispatch("post", {
                    url: scop.baseUrl("image-product"),
                    data: formData,
                })
                .then(response => {
                    if(response.status === 200) {
                      this.imagesProduct = response.datas;
                      this.addMoreImage = [];
                      this.$toast.open({
                        message: "Success",
                            type: "success",
                            duration: 2000,
                            dismissible: true,
                            position: "top"
                        });
                    }else{
                      this.$toast.open({
                        message: "Erors",
                            type: "error",
                            duration: 2000,
                            dismissible: true,
                            position: "top"
                        });
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

            
            }else{
              this.$toast.open({
                  message: "Image not found",
                  type: "error",
                  duration: 2000,
                  dismissible: true,
                  position: "top"
              });
            }
        }
    },
    created() {
       this.getDataEdit();
    }
}
</script>
<style scoped>
    .dops-status{
        cursor: no-drop;
    }
    .more-image-css {
      width: 200px;
      height: 200px;
        object-fit: cover;
      margin: 10px;
    }
</style>
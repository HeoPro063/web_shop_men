<template>
   <div class="container-fluid" style="height:627px; overflow-x: hidden; display: block;">
       <div class="row">
           <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create Product</h5>
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
                                <div class="col-6">
                                     <div class="custom-file">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" :class="{'is-invalid' : errors.has('imagesProduct')}" v-validate="'required|image'"  id="inputGroupFile01" multiple @change="uploadImage" name="imagesProduct">
                                        <span class="text text-danger">{{ errors.first('imagesProduct') }}</span>
                                    </div>
                                    
                                </div>
                                <div class="col-6">
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
   </div>
</template>

<script>
import httpStore from "@core/config/httpStore";
export default {
    props: {
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
                category_id: null,
                size_id: null,
                color_id: null,
                promotion_id: null,
                name: null,
                quantity: null,
                price: null,
                description: null,
                imagesProduct: []
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
            let formData = new FormData();
            formData.append('category_id', scop.formData.category_id);
            formData.append('size_id', scop.formData.size_id);
            formData.append('color_id', scop.formData.color_id);
            formData.append('promotion_id', scop.formData.promotion_id);
            formData.append('name', scop.formData.name);
            formData.append('quantity', scop.formData.quantity);
            formData.append('price', scop.formData.price);
            formData.append('description', scop.formData.description);

            for (let i = 0; i < scop.formData.imagesProduct.length; i++) {
                let file =  scop.formData.imagesProduct[i];
                formData.append('files['+i+']', file);
            }

            scop.$validator.validate().then(valid => {
                if (valid) {
                     httpStore
                        .dispatch("post", {
                            url: scop.baseUrl("product"),
                            data: formData,
                        })
                        .then(response => {
                            console.log(response)
                            // window.location.href = scop.baseUrl(`/product/${response.datas.id}/edit`);
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
            this.formData.imagesProduct = [];
            for (let i = 0; i < event.target.files.length; i++) {
                this.formData.imagesProduct.push(event.target.files[i]);
            }
        }
    }
}
</script>
<style scoped>
    .dops-status{
        cursor: no-drop;
    }
</style>
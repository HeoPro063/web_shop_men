<template>
  <div class="container-fluid" style="height:627px; overflow-x: hidden; display: block;">
    <div class="row">
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Create size</h5>
          </div>
          <form method="post">
            <div class="row p-3">
              <div class="col-6">
                <label for>Name:</label>
                <input
                  type="text"
                  v-model="formData.name"
                  class="form-control"
                  name="name"
                  placeholder="Name..."
                  :class="{'is-invalid' : errors.has('name')}"
                  v-validate="'required'"
                />
                <span class="text text-danger">{{ errors.first('name') }}</span>
              </div>
              <div class="col-6">
                <label for>Discount (%):</label>
                <input
                  type="number"
                  v-model="formData.percent"
                  name="discount"
                  class="form-control"
                  placeholder="Discount..."
                  :class="{'is-invalid' : errors.has('discount')}"
                  v-validate="'required|between:1,100'"
                />
                <span class="text text-danger">{{ errors.first('discount') }}</span>
              </div>
            </div>
            <div class="row p-3">
              <div class="col-12">
                <label for>Select start and end date:</label>
                <date-picker
                  v-model="formData.dataStartEnd"
                  range
                  placeholder="Select date range"
                  class="border-danger"
                  value-type="format"
                  format="YYYY-MM-DD"
                ></date-picker>
              </div>
            </div>
            <div class="row p-3">
              <div class="col-12">
                <button type="button" class="btn btn-primary" @click="submitRole()">Save</button>
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
    promotion: Object
  },
  data() {
    return {
      formData: {
        name: null,
        percent: null,
        dataStartEnd: []
      }
    };
  },
  methods: {
    submitRole() {
      let scop = this;
      scop.$validator.validate().then(valid => {
        if (valid && this.formData.dataStartEnd) {
          httpStore
            .dispatch("put", {
              url: scop.baseUrl(`promotion/${this.promotion.id}`),
              data: scop.formData
            })
            .then(response => {
              if (response.status === 200) {
                this.$toast.open({
                  message: "Success",
                  type: "success",
                  duration: 2000,
                  dismissible: true,
                  position: "top"
                });
              } else {
                this.$toast.open({
                  message: "Error",
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
        } else {
          this.$toast.open({
            message: "You don't enter date of promotion",
            type: "error",
            duration: 2000,
            dismissible: true,
            position: "top"
          });
        }
      });
    },
    responseData() {
      this.formData.name = this.promotion.name;
      this.formData.percent = this.promotion.percent;
      this.formData.dataStartEnd.push(this.promotion.start_date);
      this.formData.dataStartEnd.push(this.promotion.end_date);
    }
  },
  created() {
    this.responseData();
  }
};
</script>

<style>
</style>
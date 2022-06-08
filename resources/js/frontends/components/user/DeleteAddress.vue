<template>
  <div
        class="modal fade"
        id="delete"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="delete"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Xóa địa chỉ</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <p>Bạn muốn xóa địa chỉ này chứ</p>
            </div>
            <div class="modal-footer">
              <form action method="post">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                <button type="button" class="btn btn-primary">Có</button>
              </form>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
import { cloneDeep, uniqueId ,clone} from 'lodash';
export default {
  props: {
    iddelete: Object,
  }
}
</script>

<style scoped>

</style>
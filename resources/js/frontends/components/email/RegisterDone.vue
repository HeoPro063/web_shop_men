<template>
    <div class="container-lg">
                <div class="row">
                    <div class="confirm-steps">
                        <div class="confirm-steps-content d-flex justify-content-center">
                            <div class="registration_steps d-flex justify-content-center align-items-center">
                                <ul class="nav nav-tabs justify-content-around w-100" id="myTab" role="tablist">
                                    <li class="nav-item flex-fill steps-number" role="presentation"
                                        data-bs-toggle="tooltip" data-bs-placement="top" >
                                        
                                            <a class="nav-link active rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                href="#step1" id="step1-tab" data-bs-toggle="tab" role="tab"
                                                aria-controls="step1" aria-selected="true">
                                                <i class="fas fa-folder-open"></i>
                                            </a>
                                            <p class="steps-text">Xác minh email</p>
                                        
                                        <div class="steps-border"></div>
                                    </li>
                                    <li class="nav-item flex-fill steps-number" role="presentation"
                                        data-bs-toggle="tooltip" data-bs-placement="top" >
                                        
                                            <a class="nav-link rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                href="#step2" id="step2-tab" data-bs-toggle="tab" role="tab"
                                                aria-controls="step2" aria-selected="false" >
                                                <i class="fas fa-briefcase"></i>
                                            </a>
                                            <p class="steps-text">Tạo mật khẩu</p>
                                        
                                        <div class="steps-border"></div>
                                    </li>
                                    <li class="nav-item flex-fill steps-number" role="presentation"
                                        data-bs-toggle="tooltip" data-bs-placement="top" >
                                        
                                            <a class="nav-link rounded-circle d-flex align-items-center justify-content-center"
                                                href="#step3" id="step3-tab" data-bs-toggle="tab" ata-bs-toggle="tab"
                                                role="tab" aria-controls="step3" aria-selected="false" >
                                                <i class="fas fa-star"></i>
                                            </a>
                                            <p class="steps-text">Hoàn thành</p>
                                        
                                    </li>
                                </ul>
                                <div class="tab-content pt-5" id="myTabContent">
                                    <div class="form-confirm " role="tabpanel" id="step3" aria-labelledby="step3-tab">
                                        <div class="complete">
                                            <h3 class="form-complete-title">Hoàn Thành đăng ký</h3>
                                            <a :href="baseUrl('login')" class="link-login text-decoration-none text-dark">Quay về trang đăng nhập</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
    created() {
      this.$loading(false);

    }
}
</script>

<style>

</style>
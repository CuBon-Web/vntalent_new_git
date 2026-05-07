<template>
  <div>
    <div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Tên khách hàng</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên khách hàng"
                  class="w-100"
                  v-model="objData.name"
                  :class="{ 'is-invalid': submitted && $v.objData.name.$error }"
                />
              </div>
              <div class="form-group">
                <label>Email (đăng nhập website)</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Email"
                  class="w-100"
                  v-model="objData.email"
                />
              </div>
              <div class="form-group">
                <label>Mật khẩu</label>
                <vs-input
                  type="password"
                  size="default"
                  placeholder="Tối thiểu 8 ký tự"
                  class="w-100"
                  v-model="objData.password"
                />
              </div>
              <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <vs-input
                  type="password"
                  size="default"
                  placeholder="Nhập lại mật khẩu"
                  class="w-100"
                  v-model="objData.password_confirmation"
                />
              </div>
              <div class="form-group">
                <label>Số điện thoại</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="phone"
                  class="w-100"
                  v-model="objData.phone"
                />
              </div>
              <div class="form-group">
                <label>Địa chỉ</label>
                <vs-textarea v-model="objData.address" class="w-100" height="200px" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <vs-button color="primary" @click="addCustomers" :disabled="$v.$invalid">Thêm mới</vs-button>
    </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import { required } from "vuelidate/lib/validators";
export default {
  name: "customer",
  data() {
    return {
      submitted: false,
      objData: {
        name: "",
        email: "",
        address: "",
        phone: "",
        note: "",
        password: "",
        password_confirmation: "",
      }
    };
  },
  validations: {
    objData: {
      name: { required },
      email:{required}
    }
  },
  components: {
    TinyMce
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["addCustomer", "loadings",]),
    addCustomers() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      if (!this.objData.password || this.objData.password !== this.objData.password_confirmation) {
        this.$error('Mật khẩu và nhập lại mật khẩu phải khớp, tối thiểu 8 ký tự');
        return;
      }
      this.loadings(true);
      this.addCustomer(this.objData)
        .then(() => {
          this.loadings(false);
          this.$success('Tạo tài khoản thành công. Khách có thể đăng nhập website bằng email và mật khẩu vừa đặt.');
          this.$router.push({ name: 'customer' });
        })
        .catch((error) => {
          this.loadings(false);
          const err = error.response && error.response.data && error.response.data.errors;
          if (err) {
            const first = Object.keys(err)[0];
            this.$error(err[first][0]);
          } else {
            this.$error('Thêm thất bại');
          }
        });
    }
  },
  mounted() {
  }
};
</script>
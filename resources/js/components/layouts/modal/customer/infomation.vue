<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="form-group">
        <vs-input
          class="w-100"
          v-model="objData.name"
          font-size="40px"
          label-placeholder="Họ và tên"
        />
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          v-model="objData.phone"
          font-size="40px"
          label-placeholder="Số điện thoại"
        />
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          v-model="objData.email"
          font-size="40px"
          label-placeholder="Email"
        />
      </div>
      <div class="form-group">
       <vs-textarea aria-placeholder="Địa chỉ" v-model="objData.address"/>
      </div>
      <div class="form-group">
        <label>Đổi mật khẩu (để trống nếu giữ nguyên)</label>
        <vs-input class="w-100" type="password" v-model="objData.password" label-placeholder="Mật khẩu mới" />
      </div>
      <div class="form-group">
        <vs-input class="w-100" type="password" v-model="objData.password_confirmation" label-placeholder="Nhập lại mật khẩu mới" />
      </div>
      <div class="form-group">
        <vs-button
          color="success"
          type="gradient"
          class="mr-left-45"
          @click="handleSubmit()"
        >Lưu lại</vs-button>
      </div>
    </form>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      objData: {
        id: '',
        name: '',
        phone: '',
        address: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      submitted: false,
    };
  },
  props: ['customer'],
  validations: {},
  watch: {
    customer: {
      handler(c) {
        if (!c) return;
        this.objData = {
          id: c.id,
          name: c.name,
          phone: c.phone,
          address: c.address || '',
          email: c.email,
          password: '',
          password_confirmation: '',
        };
      },
      immediate: true,
      deep: true,
    },
  },
  methods: {
    ...mapActions(["EditProfile", "loadings"]),
    handleSubmit() {
      if (this.objData.password && this.objData.password !== this.objData.password_confirmation) {
        this.$error('Mật khẩu mới và nhập lại không khớp');
        return;
      }
      const payload = { ...this.objData };
      if (!payload.password) {
        delete payload.password;
        delete payload.password_confirmation;
      }
      this.EditProfile(payload)
        .then(() => {
          this.$success('Sửa thành công');
          this.$emit('closePopup', false);
        })
        .catch((error) => {
          const errs = error.response && error.response.data && error.response.data.errors;
          if (errs) {
            const k = Object.keys(errs)[0];
            this.$error(errs[k][0]);
          } else {
            this.$error('Cập nhật thất bại');
          }
          this.$emit('closePopup', false);
        });
    },
  },
};
</script>
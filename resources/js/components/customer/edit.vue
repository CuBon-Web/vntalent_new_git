<template>
  <div>
    <div class="row">
        <div class="col-md-2 grid-margin stretch-card"></div>
        <div class="col-md-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <h1>{{objData.name}}</h1>
                <label v-if="objData.status == 1">
                  <vs-button color="primary" type="border" icon="record_voice_over" @click="popupActivo=true" v-if="objData.email != null">Kích hoạt tài khoản</vs-button>
                </label>
                <label v-if="objData.status == 0">
                  <vs-button @click="confirm()" color="primary" type="border" icon="voice_over_off" v-if="objData.email != null" style="margin-right:5px;">Vô hiệu hóa tài khoản</vs-button>
                  <vs-button color="primary" type="border" icon="cached" @click="popupReset=true" v-if="objData.email != null">Đặt lại mật khẩu</vs-button>
                </label>
              <div class="form-group">
                <label>Ghi chú</label>
                <vs-textarea v-model="objData.note" class="w-100" height="100" placeholder="Nhập ghi chú về khách hàng" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <a href="javascript:;" style="float:right;" @click="popupBasicInfo = true" >Sửa</a>
                <h4>Liên hệ</h4>
                <label >Email:  {{objData.email}}</label><br>
                <label >Tên:  {{objData.name}}</label><br>
                <label >SĐT:  {{objData.phone}}</label><br>
                <label >Địa chỉ:  {{objData.address}}</label><br>
                <label>Đăng nhập website: {{ objData.status == 0 ? 'Đang bật' : 'Đang khóa' }}</label><br>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 grid-margin stretch-card"></div>
      </div>

    <vs-popup style="width:100%;" title="Kích hoạt tài khoản" :active.sync="popupActivo" v-if="popupActivo">
        <ActiveAcc @closePopup="closePop($event)" :email="objData.email" :customer-id="objData.id" />
    </vs-popup>
    <vs-popup style="width:100%;" title="Đặt lại mật khẩu" :active.sync="popupReset" v-if="popupReset">
        <ActiveAcc @closePopup="closePop($event)" :email="objData.email" :customer-id="objData.id" />
    </vs-popup>
    <vs-popup style="width:100%;" title="Sửa thông tin khách hàng" :active.sync="popupBasicInfo" v-if="popupBasicInfo">
        <BasicInfo @closePopup="closePop($event)" :customer.sync="objData"/>
    </vs-popup>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import ActiveAcc from "../layouts/modal/customer/active_account"
import BasicInfo from "../layouts/modal/customer/infomation"
export default {
  name: "customer",
  data() {
    return {
      popupActivo: false,
      popupReset: false,
      popupBasicInfo: false,
      objData: {
        id:this.$route.params.id_customer,
        name: "",
        email: "",
        address: "",
        phone: "",
        note: "",
        status: ""
      },
    };
  },
  validations: {},
  components: {
    TinyMce,ActiveAcc,BasicInfo
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(['getEditCustomer', 'loadings', 'disableAccount']),
    closePop(event) {
      this.getEditCustomers();
      this.popupActivo = event;
      this.popupReset = event;
      this.popupBasicInfo = event;
    },
    confirm(){
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Vô hiệu hóa tài khoản`,
        text: 'Bạn có chắc muốn vô hiệu hóa tài khoản của khách hàng này không? Khách hàng bị khóa sẽ không thể đăng nhập vào tài khoản của họ nữa!',
        accept:this.disableAccs
      })
    },
    disableAccs() {
      this.disableAccount({ id: this.objData.id, email: this.objData.email }).then(() => {
        this.getEditCustomers();
        this.$success('Đã khóa đăng nhập website');
      });
    },
    getEditCustomers() {
      this.loadings(true);
      this.getEditCustomer(this.objData.id)
        .then((response) => {
          this.loadings(false);
          this.objData = response.data;
        })
        .catch(() => {
          this.loadings(false);
        });
    },
  },
  mounted() {
      this.getEditCustomers();
  }
};
</script>
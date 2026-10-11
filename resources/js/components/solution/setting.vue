<template>
  <div>
    <h3 class="page-title">Trang chủ — Tiêu đề phần "Chương trình tuyển sinh"</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Dòng tagline nhỏ</label>
              <vs-input type="text" size="default" class="w-100" placeholder="Services" v-model="objData.tagline" />
            </div>
            <div class="form-group">
              <label>Tiêu đề</label>
              <vs-input type="text" size="default" class="w-100" placeholder="Cách chương trình tuyển sinh" v-model="objData.title" />
            </div>
            <div class="form-group">
              <label>Đoạn mô tả</label>
              <vs-textarea v-model="objData.description" height="140px" />
            </div>
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Chữ trên nút (để trống sẽ ẩn nút)</label>
                <vs-input type="text" size="default" class="w-100" placeholder="Tất Cả" v-model="objData.button_text" />
              </div>
              <div class="col-md-8 form-group">
                <label>Link của nút</label>
                <vs-input type="text" size="default" class="w-100" placeholder="https://... hoặc /duong-dan" v-model="objData.button_link" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="save">Lưu</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      objData: {
        tagline: '',
        title: '',
        description: '',
        button_text: '',
        button_link: '',
      },
    };
  },
  methods: {
    ...mapActions(['getHomeServiceSetting', 'saveHomeServiceSetting', 'loadings']),
    load() {
      this.loadings(true);
      this.getHomeServiceSetting()
        .then((response) => {
          this.loadings(false);
          const d = response.data || {};
          Object.keys(this.objData).forEach((key) => {
            this.objData[key] = d[key] || '';
          });
        })
        .catch(() => {
          this.loadings(false);
          this.$error('Không tải được dữ liệu');
        });
    },
    save() {
      if (!this.objData.title) {
        this.$error('Tiêu đề không được để trống');
        return;
      }
      this.loadings(true);
      this.saveHomeServiceSetting(this.objData)
        .then(() => {
          this.loadings(false);
          this.$success('Lưu thành công');
        })
        .catch(() => {
          this.loadings(false);
          this.$error('Lưu thất bại');
        });
    },
  },
  mounted() {
    this.load();
  },
};
</script>

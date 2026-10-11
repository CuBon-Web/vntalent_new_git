<template>
  <div>
    <h3 class="page-title">Trang chủ — Nội dung phần "Tại sao chọn chúng tôi"</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Dòng tagline nhỏ</label>
              <vs-input type="text" size="default" class="w-100" placeholder="Why Choose Us" v-model="objData.tagline" />
            </div>
            <div class="row">
              <div class="col-md-7 form-group">
                <label>Tiêu đề</label>
                <vs-input type="text" size="default" class="w-100" placeholder="Tại sao nên chọn" v-model="objData.title" />
              </div>
              <div class="col-md-5 form-group">
                <label>Chữ nổi bật (màu nhấn, sau tiêu đề)</label>
                <vs-input type="text" size="default" class="w-100" placeholder="VNTALENTHUB" v-model="objData.title_highlight" />
              </div>
            </div>
            <div class="form-group">
              <label>Đoạn mô tả</label>
              <vs-textarea v-model="objData.description" height="140px" />
            </div>

            <h5 class="mt-3">Ảnh bên phải (để trống sẽ dùng ảnh mặc định)</h5>
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Ảnh lớn</label>
                <image-upload v-model="objData.image_1" type="avatar" :title="'home-choose-1'"></image-upload>
              </div>
              <div class="col-md-4 form-group">
                <label>Ảnh nhỏ</label>
                <image-upload v-model="objData.image_2" type="avatar" :title="'home-choose-2'"></image-upload>
              </div>
              <div class="col-md-4 form-group">
                <label>Ảnh hoạ tiết (shape)</label>
                <image-upload v-model="objData.image_shape" type="avatar" :title="'home-choose-shape'"></image-upload>
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
        title_highlight: '',
        description: '',
        image_1: '',
        image_2: '',
        image_shape: '',
      },
    };
  },
  methods: {
    ...mapActions(['getHomeChooseSetting', 'saveHomeChooseSetting', 'loadings']),
    load() {
      this.loadings(true);
      this.getHomeChooseSetting()
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
      if (!this.objData.title && !this.objData.title_highlight) {
        this.$error('Tiêu đề không được để trống');
        return;
      }
      this.loadings(true);
      this.saveHomeChooseSetting(this.objData)
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

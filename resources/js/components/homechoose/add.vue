<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Icon (ảnh / SVG đã upload)</label>
              <image-upload v-model="objData.icon" type="avatar" :title="'home-choose-'"></image-upload>
            </div>
            <div class="form-group">
              <label>Tiêu đề</label>
              <vs-input type="text" size="default" placeholder="VD: Tư vấn miễn phí" class="w-100" v-model="objData.title" />
            </div>
            <div class="form-group">
              <label>Mô tả ngắn</label>
              <vs-textarea v-model="objData.description" height="100px" placeholder="Nội dung hiển thị dưới tiêu đề" />
            </div>
            <div class="form-group">
              <label>Thứ tự hiển thị</label>
              <vs-input type="number" v-model="objData.sort_order" class="w-100" />
            </div>
            <div class="form-group">
              <label>Trạng thái</label>
              <vs-select v-model="objData.status">
                <vs-select-item value="1" text="Hiện" />
                <vs-select-item value="0" text="Ẩn" />
              </vs-select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="save">Thêm mới</vs-button>
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
      errors: [],
      objData: {
        title: '',
        description: '',
        sort_order: 0,
        status: '1',
        icon: '',
      },
    };
  },
  methods: {
    ...mapActions(['addHomeChoose', 'loadings']),
    save() {
      this.errors = [];
      if (!this.objData.title) this.errors.push('Tiêu đề không được để trống');
      if (!this.objData.icon) this.errors.push('Vui lòng chọn icon');
      if (this.errors.length) {
        this.errors.forEach((m) => this.$error(m));
        return;
      }
      this.loadings(true);
      this.addHomeChoose(this.objData)
        .then(() => {
          this.loadings(false);
          this.$router.push({ name: 'listHomeChoose' });
          this.$success('Thêm thành công');
        })
        .catch(() => {
          this.loadings(false);
          this.$error('Thêm thất bại');
        });
    },
  },
};
</script>

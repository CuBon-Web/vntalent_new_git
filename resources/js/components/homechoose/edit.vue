<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Icon</label>
              <image-upload v-model="objData.icon" type="avatar" :title="'home-choose-'"></image-upload>
            </div>
            <div class="form-group">
              <label>Tiêu đề</label>
              <vs-input type="text" size="default" class="w-100" v-model="objData.title" />
            </div>
            <div class="form-group">
              <label>Mô tả ngắn</label>
              <vs-textarea v-model="objData.description" height="100px" />
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
          <vs-button color="primary" @click="save">Cập nhật</vs-button>
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
        id: this.$route.params.id,
        title: '',
        description: '',
        sort_order: 0,
        status: '1',
        icon: '',
      },
    };
  },
  methods: {
    ...mapActions(['addHomeChoose', 'loadings', 'detailHomeChoose']),
    loadDetail() {
      this.loadings(true);
      this.detailHomeChoose({ id: this.objData.id })
        .then((response) => {
          this.loadings(false);
          if (response.data) {
            const d = response.data;
            this.objData.title = d.title || '';
            this.objData.description = d.description || '';
            this.objData.icon = d.icon || '';
            this.objData.sort_order = d.sort_order != null ? d.sort_order : 0;
            this.objData.status = d.status != null ? String(d.status) : '1';
          }
        })
        .catch(() => {
          this.loadings(false);
          this.$error('Không tải được dữ liệu');
        });
    },
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
          this.$success('Cập nhật thành công');
        })
        .catch(() => {
          this.loadings(false);
          this.$error('Cập nhật thất bại');
        });
    },
  },
  mounted() {
    this.loadDetail();
  },
};
</script>

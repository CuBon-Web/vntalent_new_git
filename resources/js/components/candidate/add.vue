<template>
  <div class="candidate-form-page">
    <h3 class="page-title">Thêm ứng viên</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body form-body">
            <h5 class="section-title">Thông tin cơ bản</h5>
            <div class="row">
              <div class="col-md-8 form-group">
                <label>Tên ứng viên</label>
                <vs-input type="text" size="default" placeholder="Nhập tên ứng viên" class="w-100" v-model="objData.name" />
              </div>
              <div class="col-md-4 form-group">
                <label>Level tiếng Đức</label>
                <vs-input type="text" size="default" placeholder="B1 / B2 / C1" class="w-100" v-model="objData.german_level" />
              </div>
            </div>
            <div class="form-group">
              <label>Ngành nghề</label>
              <vs-select v-model="objData.candidate_category_id">
                <vs-select-item
                  v-for="item in categoryOptions"
                  :key="item.id"
                  :value="item.id"
                  :text="item.name"
                />
              </vs-select>
            </div>
            <div class="form-group">
              <label>Trạng thái</label>
              <vs-select v-model="objData.status">
                <vs-select-item value="1" text="Hiện" />
                <vs-select-item value="0" text="Ẩn" />
              </vs-select>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Tuổi</label>
                <vs-input type="number" size="default" placeholder="Ví dụ: 20" class="w-100" v-model="objData.age" />
              </div>
              <div class="col-md-6 form-group">
                <label>Ngày sinh</label>
                <input type="date" class="w-100 inputlang" v-model="objData.birth_date" />
              </div>
            </div>

            <h5 class="section-title mt-3">Hồ sơ ứng viên</h5>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Ảnh ứng viên</label>
                <image-upload v-model="objData.avatar" type="avatar" :title="objData.name"></image-upload>
              </div>
              <div class="col-md-6 form-group">
                <label>Bằng tốt nghiệp (ảnh)</label>
                <image-upload v-model="objData.graduation_image" type="avatar" :title="objData.name"></image-upload>
              </div>
            </div>

            <div class="form-group">
              <label>Short BIO</label>
              <TinyMce v-model="objData.short_bio" />
            </div>

            <div class="form-group">
              <label>Video (link)</label>
              <vs-input type="text" size="default" placeholder="https://youtube.com/..." class="w-100" v-model="objData.video_url" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="addCandidates">Thêm mới</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
export default {
  data() {
    return {
      errors: [],
      objData: {
        name: "",
        candidate_category_id: "",
        age: "",
        birth_date: "",
        german_level: "",
        avatar: "",
        graduation_image: "",
        short_bio: "",
        video_url: "",
        status: 1,
      },
      categoryOptions: [],
    };
  },
  components: {
    TinyMce,
  },
  methods: {
    ...mapActions(["addCandidate", "loadings", "listCandidateCategory"]),
    fetchCategories() {
      this.listCandidateCategory({ keyword: "" }).then((response) => {
        this.categoryOptions = response.data.filter((item) => Number(item.status) === 1);
      });
    },
    validateData() {
      this.errors = [];
      if (this.objData.name == "") this.errors.push("Tên ứng viên không được để trống");
      if (this.objData.candidate_category_id == "") this.errors.push("Vui lòng chọn ngành nghề");
      if (this.objData.german_level == "") this.errors.push("Level tiếng Đức không được để trống");
      if (this.objData.avatar == "") this.errors.push("Vui lòng chọn ảnh ứng viên");
      if (this.objData.graduation_image == "") this.errors.push("Vui lòng chọn ảnh bằng tốt nghiệp");
      if (this.objData.short_bio == "") this.errors.push("Short BIO không được để trống");
      if (this.objData.video_url == "") this.errors.push("Link video không được để trống");
      return this.errors.length === 0;
    },
    addCandidates() {
      if (!this.validateData()) {
        this.errors.forEach((value) => {
          this.$error(value);
        });
        return;
      }
      this.loadings(true);
      this.addCandidate(this.objData)
        .then(() => {
          this.loadings(false);
          this.$router.push({ name: "listCandidate" });
          this.$success("Thêm ứng viên thành công");
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Thêm ứng viên thất bại");
        });
    },
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>

<style scoped>
.candidate-form-page .page-title {
  margin-bottom: 16px;
}
.form-body {
  padding-bottom: 8px;
}
.section-title {
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 12px;
}
.mt-3 {
  margin-top: 12px;
}
</style>

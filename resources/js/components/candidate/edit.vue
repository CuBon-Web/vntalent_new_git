<template>
  <div class="candidate-form-page">
    <h3 class="page-title">Cập nhật ứng viên</h3>
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
                <vs-select v-model="objData.german_level" class="w-100">
                  <vs-select-item value="" text="-- Chọn mức --" />
                  <vs-select-item v-for="lvl in germanLevels" :key="lvl" :value="lvl" :text="lvl" />
                </vs-select>
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
              <div class="col-md-4 form-group">
                <label>Tuổi</label>
                <vs-input type="number" size="default" placeholder="Ví dụ: 20" class="w-100" v-model="objData.age" />
              </div>
              <div class="col-md-4 form-group">
                <label>Ngày sinh</label>
                <input type="date" class="w-100 inputlang" v-model="objData.birth_date" />
              </div>
              <div class="col-md-4 form-group">
                <label>Giới tính</label>
                <vs-select v-model="objData.gender" class="w-100">
                  <vs-select-item value="" text="-- Chọn --" />
                  <vs-select-item value="1" text="Nam" />
                  <vs-select-item value="2" text="Nữ" />
                </vs-select>
              </div>
            </div>

            <h5 class="section-title mt-3">Hồ sơ ứng viên</h5>
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Ảnh ứng viên</label>
                <image-upload v-model="objData.avatar" type="avatar" :title="objData.name"></image-upload>
              </div>
              <div class="col-md-4 form-group">
                <label>Chứng chỉ - bằng cấp</label>
                <image-upload v-model="objData.graduation_image" type="avatar" :title="objData.name"></image-upload>
              </div>
              <div class="col-md-4 form-group">
                <label>Giấy tờ khác (ảnh, có thể chọn nhiều)</label>
                <ImageMulti v-model="objData.other_documents" :title="objData.name || 'ung-vien'" />
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
          <vs-button color="primary" @click="saveCandidateData">Cập nhật</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import ImageMulti from "../_common/upload_image_multi";
export default {
  data() {
    return {
      errors: [],
      objData: {
        id: this.$route.params.id,
        name: "",
        candidate_category_id: "",
        age: "",
        birth_date: "",
        german_level: "",
        gender: "",
        avatar: "",
        graduation_image: "",
        other_documents: [],
        short_bio: "",
        video_url: "",
        status: 1,
      },
      categoryOptions: [],
      germanLevels: ["Keine Deutschkenntnisse","A1", "A2", "B1", "B2", "C1", "C2"],
    };
  },
  components: {
    TinyMce,
    ImageMulti,
  },
  methods: {
    ...mapActions(["addCandidate", "detailCandidate", "listCandidateCategory", "loadings"]),
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
      if (this.objData.gender === "" || this.objData.gender === null) this.errors.push("Vui lòng chọn giới tính");
      // if (this.objData.avatar == "") this.errors.push("Vui lòng chọn ảnh ứng viên");
      if (this.objData.graduation_image == "") this.errors.push("Vui lòng chọn ảnh bằng tốt nghiệp");
      if (this.objData.short_bio == "") this.errors.push("Short BIO không được để trống");
      // if (this.objData.video_url == "") this.errors.push("Link video không được để trống");
      return this.errors.length === 0;
    },
    saveCandidateData() {
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
          this.$success("Cập nhật ứng viên thành công");
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Cập nhật ứng viên thất bại");
        });
    },
    loadDetail() {
      this.loadings(true);
      this.detailCandidate({ id: this.objData.id })
        .then((response) => {
          this.loadings(false);
          if (response.data) {
            this.objData = response.data;
            if (this.objData.gender != null && this.objData.gender !== "") {
              this.objData.gender = String(this.objData.gender);
            }
            const od = this.objData.other_documents;
            if (od == null || od === "") {
              this.objData.other_documents = [];
            } else if (typeof od === "string") {
              try {
                const parsed = JSON.parse(od);
                this.objData.other_documents = Array.isArray(parsed) ? parsed : [];
              } catch (e) {
                this.objData.other_documents = [];
              }
            } else if (!Array.isArray(od)) {
              this.objData.other_documents = [];
            }
          }
        })
        .catch(() => {
          this.loadings(false);
        });
    },
  },
  mounted() {
    this.fetchCategories();
    this.loadDetail();
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

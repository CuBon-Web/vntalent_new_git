<template>
  <div>
    <h3 class="page-title">Cập nhật ngành nghề ứng viên</h3>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Tên ngành nghề</label>
              <vs-input class="w-100" v-model="objData.name" placeholder="VD: Điều dưỡng, Cơ khí..." />
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
          <vs-button color="primary" @click="saveData">Cập nhật</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      objData: {
        id: this.$route.params.id,
        name: "",
        status: 1,
      },
      errors: [],
    };
  },
  methods: {
    ...mapActions(["addCandidateCategory", "detailCandidateCategory", "loadings"]),
    fetchDetail() {
      this.loadings(true);
      this.detailCandidateCategory({ id: this.objData.id })
        .then((response) => {
          this.loadings(false);
          if (response.data) this.objData = response.data;
        })
        .catch(() => {
          this.loadings(false);
        });
    },
    saveData() {
      this.errors = [];
      if (this.objData.name == "") this.errors.push("Tên ngành nghề không được để trống");
      if (this.errors.length > 0) {
        this.errors.forEach((value) => {
          this.$error(value);
        });
        return;
      }
      this.loadings(true);
      this.addCandidateCategory(this.objData)
        .then(() => {
          this.loadings(false);
          this.$router.push({ name: "listCandidateCategory" });
          this.$success("Cập nhật ngành nghề thành công");
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Cập nhật ngành nghề thất bại");
        });
    },
  },
  mounted() {
    this.fetchDetail();
  },
};
</script>

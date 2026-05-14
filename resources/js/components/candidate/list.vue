<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách ứng viên</h4>
            <router-link class="nav-link" :to="{ name: 'addCandidate' }">
              <vs-button type="gradient" style="float: right;">Thêm mới</vs-button>
            </router-link>
            <div class="row mb-3" style="margin-top: 12px;">
              <div class="col-md-3 col-sm-6 mb-2">
                <label class="small d-block text-muted mb-1">Tìm theo tên</label>
                <vs-input icon="search" placeholder="Tên ứng viên" v-model="keyword" @keyup="searchCandidate" />
              </div>
              <div class="col-md-2 col-sm-6 mb-2">
                <label class="small d-block text-muted mb-1">Ngành nghề</label>
                <vs-select v-model="filterCategory" class="w-100" @change="onFilterChange">
                  <vs-select-item value="" text="Tất cả" />
                  <vs-select-item v-for="c in categoryOptions" :key="c.id" :value="String(c.id)" :text="c.name" />
                </vs-select>
              </div>
              <div class="col-md-2 col-sm-6 mb-2">
                <label class="small d-block text-muted mb-1">Độ tuổi</label>
                <vs-select v-model="filterAge" class="w-100" @change="onFilterChange">
                  <vs-select-item value="" text="Tất cả" />
                  <vs-select-item value="18-22" text="18–22" />
                  <vs-select-item value="23-27" text="23–27" />
                  <vs-select-item value="28-32" text="28–32" />
                  <vs-select-item value="32-36" text="32–36" />
                  <vs-select-item value="37+" text="37+" />
                </vs-select>
              </div>
              <div class="col-md-2 col-sm-6 mb-2">
                <label class="small d-block text-muted mb-1">Tiếng Đức</label>
                <vs-select v-model="filterGerman" class="w-100" @change="onFilterChange">
                  <vs-select-item value="" text="Tất cả" />
                  <vs-select-item v-for="lvl in germanLevels" :key="lvl" :value="lvl" :text="lvl" />
                </vs-select>
              </div>
              <div class="col-md-2 col-sm-6 mb-2">
                <label class="small d-block text-muted mb-1">Giới tính</label>
                <vs-select v-model="filterGender" class="w-100" @change="onFilterChange">
                  <vs-select-item value="" text="Tất cả" />
                  <vs-select-item value="1" text="Nam" />
                  <vs-select-item value="2" text="Nữ" />
                </vs-select>
              </div>
              <div class="col-md-1 col-sm-6 mb-2 d-flex align-items-end">
                <vs-button type="border" size="small" @click="clearFilters">Xóa lọc</vs-button>
              </div>
            </div>
            <vs-table stripe :data="list" max-items="10" pagination>
              <template slot="thead">
                <vs-th>Ảnh</vs-th>
                <vs-th>Tên</vs-th>
                <vs-th>Ngành nghề</vs-th>
                <vs-th>Giới tính</vs-th>
                <vs-th>Tuổi / Ngày sinh</vs-th>
                <vs-th>Level tiếng Đức</vs-th>
                <vs-th>Hành động</vs-th>
              </template>
              <template slot-scope="{ data }">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td>
                    <vs-avatar size="55px" :src="tr.avatar" />
                  </vs-td>
                  <vs-td>{{ tr.name }}</vs-td>
                  <vs-td>{{ tr.category_name }}</vs-td>
                  <vs-td>{{ genderLabel(tr.gender) }}</vs-td>
                  <vs-td>{{ renderAgeBirth(tr) }}</vs-td>
                  <vs-td>{{ tr.german_level }}</vs-td>
                  <vs-td>
                    <router-link :to="{ name: 'editCandidate', params: { id: tr.id } }">
                      <vs-button vs-type="gradient" size="lagre" color="success" icon="edit"></vs-button>
                    </router-link>
                    <vs-button
                      vs-type="gradient"
                      size="lagre"
                      color="red"
                      icon="delete_forever"
                      @click="confirmDestroy(tr.id)"
                    ></vs-button>
                  </vs-td>
                </vs-tr>
              </template>
            </vs-table>
          </div>
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
      list: [],
      keyword: "",
      id_item: "",
      timer: null,
      categoryOptions: [],
      germanLevels: ["Keine Deutschkenntnisse","A1", "A2", "B1", "B2", "C1", "C2"],
      filterCategory: "",
      filterAge: "",
      filterGerman: "",
      filterGender: "",
    };
  },
  methods: {
    ...mapActions(["listCandidate", "listCandidateCategory", "loadings", "deleteCandidate"]),
    listPayload() {
      const p = { keyword: this.keyword || "" };
      if (this.filterCategory) {
        p.candidate_category_id = this.filterCategory;
      }
      if (this.filterAge) {
        p.age_range = this.filterAge;
      }
      if (this.filterGerman) {
        p.german_level = this.filterGerman;
      }
      if (this.filterGender) {
        p.gender = this.filterGender;
      }
      return p;
    },
    listCandidates() {
      this.listCandidate(this.listPayload())
        .then((response) => {
          this.loadings(false);
          this.list = response.data;
        })
        .catch((err) => {
          this.loadings(false);
          this.list = err.data || [];
        });
    },
    genderLabel(g) {
      if (g == 1 || g === "1") return "Nam";
      if (g == 2 || g === "2") return "Nữ";
      return "—";
    },
    onFilterChange() {
      this.listCandidates();
    },
    clearFilters() {
      this.filterCategory = "";
      this.filterAge = "";
      this.filterGerman = "";
      this.filterGender = "";
      this.listCandidates();
    },
    loadCategories() {
      this.listCandidateCategory({ keyword: "" })
        .then((res) => {
          this.categoryOptions = res.data || [];
        })
        .catch(() => {
          this.categoryOptions = [];
        });
    },
    renderAgeBirth(item) {
      const parts = [];
      if (item.age) {
        parts.push(item.age + " tuổi");
      }
      if (item.birth_date) {
        parts.push(item.birth_date);
      }
      return parts.join(" / ");
    },
    confirmDestroy(id) {
      this.id_item = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: "Bạn có chắc chắn",
        text: "Xóa ứng viên này",
        accept: this.destroy,
      });
    },
    searchCandidate() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
        this.listCandidate(this.listPayload())
          .then((response) => {
            this.list = response.data;
          })
          .catch((err) => {
            this.list = err.data || [];
          });
      }, 500);
    },
    destroy() {
      this.deleteCandidate({ id: this.id_item }).then(() => {
        this.listCandidates();
        this.loadings(false);
        this.$success("Xóa thành công");
      });
    },
  },
  mounted() {
    this.loadCategories();
    this.listCandidates();
  },
};
</script>

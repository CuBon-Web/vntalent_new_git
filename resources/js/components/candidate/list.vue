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
            <vs-input icon="search" placeholder="Search" v-model="keyword" @keyup="searchCandidate" />
            <vs-table stripe :data="list" max-items="10" pagination>
              <template slot="thead">
                <vs-th>Ảnh</vs-th>
                <vs-th>Tên</vs-th>
                <vs-th>Ngành nghề</vs-th>
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
    };
  },
  methods: {
    ...mapActions(["listCandidate", "loadings", "deleteCandidate"]),
    listCandidates() {
      this.listCandidate({ keyword: this.keyword })
        .then((response) => {
          this.loadings(false);
          this.list = response.data;
        })
        .catch((err) => {
          this.loadings(false);
          this.list = err.data;
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
        this.listCandidate({ keyword: this.keyword })
          .then((response) => {
            this.list = response.data;
          })
          .catch((err) => {
            this.list = err.data;
          });
      }, 800);
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
    this.listCandidates();
  },
};
</script>

<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách ngành nghề ứng viên</h4>
            <router-link class="nav-link" :to="{ name: 'addCandidateCategory' }">
              <vs-button type="gradient" style="float: right;">Thêm mới</vs-button>
            </router-link>
            <vs-table max-items="10" pagination :data="list">
              <template slot="thead">
                <vs-th>ID</vs-th>
                <vs-th>Tên ngành nghề</vs-th>
                <vs-th>Trạng thái</vs-th>
                <vs-th>Hành động</vs-th>
              </template>
              <template slot-scope="{ data }">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td>{{ tr.id }}</vs-td>
                  <vs-td>{{ tr.name }}</vs-td>
                  <vs-td>{{ Number(tr.status) === 1 ? "Hiện" : "Ẩn" }}</vs-td>
                  <vs-td>
                    <router-link :to="{ name: 'editCandidateCategory', params: { id: tr.id } }">
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
      id_item: "",
    };
  },
  methods: {
    ...mapActions(["listCandidateCategory", "deleteCandidateCategory", "loadings"]),
    fetchList() {
      this.loadings(true);
      this.listCandidateCategory({ keyword: "" })
        .then((response) => {
          this.loadings(false);
          this.list = response.data;
        })
        .catch(() => {
          this.loadings(false);
        });
    },
    confirmDestroy(id) {
      this.id_item = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: "Bạn có chắc chắn",
        text: "Xóa ngành nghề này",
        accept: this.destroy,
      });
    },
    destroy() {
      this.loadings(true);
      this.deleteCandidateCategory({ id: this.id_item }).then(() => {
        this.fetchList();
        this.loadings(false);
        this.$success("Xóa ngành nghề thành công");
      });
    },
  },
  mounted() {
    this.fetchList();
  },
};
</script>

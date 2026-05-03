<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Trang chủ — Tại sao chọn chúng tôi</h4>
            <router-link class="nav-link" :to="{ name: 'addHomeChoose' }">
              <vs-button type="gradient" style="float: right">Thêm mới</vs-button>
            </router-link>
            <vs-input icon="search" placeholder="Tìm theo tiêu đề" v-model="keyword" @keyup="onSearch" />
            <vs-table stripe :data="list" max-items="15" pagination>
              <template slot="thead">
                <vs-th>Thứ tự</vs-th>
                <vs-th>Icon</vs-th>
                <vs-th>Tiêu đề</vs-th>
                <vs-th>Trạng thái</vs-th>
                <vs-th>Hành động</vs-th>
              </template>
              <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="tr.sort_order">{{ tr.sort_order }}</vs-td>
                  <vs-td :data="tr.id">
                    <vs-avatar v-if="tr.icon" size="50px" :src="tr.icon" />
                    <span v-else class="text-muted">—</span>
                  </vs-td>
                  <vs-td :data="tr.title">{{ tr.title }}</vs-td>
                  <vs-td>{{ tr.status == 1 ? 'Hiện' : 'Ẩn' }}</vs-td>
                  <vs-td>
                    <router-link :to="{ name: 'editHomeChoose', params: { id: tr.id } }">
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
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      list: [],
      keyword: '',
      id_item: '',
      timer: null,
    };
  },
  methods: {
    ...mapActions(['listHomeChoose', 'loadings', 'deleteHomeChoose']),
    fetchList() {
      this.listHomeChoose({ keyword: this.keyword })
        .then((response) => {
          this.loadings(false);
          this.list = response.data;
        })
        .catch(() => {
          this.loadings(false);
          this.list = [];
        });
    },
    confirmDestroy(id) {
      this.id_item = id;
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: 'Bạn có chắc chắn',
        text: 'Xóa mục này?',
        accept: this.destroy,
      });
    },
    onSearch() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
        this.fetchList();
      }, 500);
    },
    destroy() {
      this.deleteHomeChoose({ id: this.id_item }).then(() => {
        this.fetchList();
        this.loadings(false);
        this.$success('Xóa thành công');
      });
    },
  },
  mounted() {
    this.fetchList();
  },
};
</script>

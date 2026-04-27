<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách khách hàng yêu cầu</h4>
            <vs-button
              type="gradient"
              color="success"
              style="float: right; margin-bottom: 12px;"
              icon="file_download"
              @click="exportExcel"
            >
              Xuất Excel
            </vs-button>
            <vs-input
              icon="search"
              placeholder="Tìm kiếm theo họ và tên, số điện thoại, email, tỉnh/thành phố"
              v-model="keyword"
              @keyup="searchCustomerLeads"
            />
            <vs-table stripe max-items="10" pagination :data="list">
              <template slot="thead">
                <vs-th>ID</vs-th>
                <vs-th>Họ và tên</vs-th>
                <vs-th>Số điện thoại</vs-th>
                <vs-th>Email</vs-th>
                <vs-th>Chương trình</vs-th>
                <vs-th>Ngày yêu cầu</vs-th>
                <vs-th>Hành động</vs-th>
              </template>
              <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td>{{ tr.id }}</vs-td>
                  <vs-td>{{ tr.full_name }}</vs-td>
                  <vs-td>{{ tr.phone }}</vs-td>
                  <vs-td>{{ tr.email || "--" }}</vs-td>
                  <vs-td>{{ tr.program_interest || "--" }}</vs-td>
                  <vs-td>{{ formatDate(tr.created_at) }}</vs-td>
                  <vs-td>
                    <vs-button
                      vs-type="gradient"
                      size="lagre"
                      color="primary"
                      icon="visibility"
                      @click="openDetail(tr.id)"
                    ></vs-button>
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

    <vs-popup title="Chi tiet khach hang yeu cau" :active.sync="popupDetail">
      <DetailCustomerLead :lead="selectedLead" />
    </vs-popup>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import DetailCustomerLead from "./detail.vue";

export default {
  components: {
    DetailCustomerLead,
  },
  data() {
    return {
      keyword: "",
      list: [],
      timer: 0,
      id_item: "",
      popupDetail: false,
      selectedLead: null,
    };
  },
  methods: {
    ...mapActions([
      "listCustomerLeads",
      "detailCustomerLead",
      "deleteCustomerLead",
      "loadings",
    ]),
    fetchCustomerLeads() {
      this.loadings(true);
      this.listCustomerLeads({ keyword: this.keyword })
        .then((response) => {
          this.list = response.data || [];
          this.loadings(false);
        })
        .catch(() => {
          this.loadings(false);
          this.list = [];
        });
    },
    searchCustomerLeads() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
        this.fetchCustomerLeads();
      }, 500);
    },
    openDetail(id) {
      this.loadings(true);
      this.detailCustomerLead({ id: id })
        .then((response) => {
          this.selectedLead = response.data;
          this.popupDetail = true;
          this.loadings(false);
        })
        .catch(() => {
          this.loadings(false);
          this.selectedLead = null;
        });
    },
    confirmDestroy(id) {
      this.id_item = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: "Ban co chac chan",
        text: "Xoa thong tin khach hang nay",
        accept: this.destroy,
      });
    },
    destroy() {
      this.loadings(true);
      this.deleteCustomerLead({ id: this.id_item }).then(() => {
        this.loadings(false);
        this.fetchCustomerLeads();
        this.$success("Xoa thanh cong");
      });
    },
    formatDate(date) {
      if (!date) {
        return "--";
      }
      return String(date).replace("T", " ").slice(0, 16);
    },
    toCsvValue(value) {
      if (value === null || value === undefined) {
        return "";
      }
      const stringValue = String(value).replace(/"/g, '""');
      return `"${stringValue}"`;
    },
    exportExcel() {
      if (!this.list || this.list.length === 0) {
        this.$vs.notify({
          color: "warning",
          title: "Thong bao",
          text: "Khong co du lieu de xuat",
        });
        return;
      }

      const headers = [
        "ID",
        "Ho va ten",
        "Ngay sinh",
        "Gioi tinh",
        "So dien thoai",
        "Email",
        "Tinh/Thanh pho",
        "Trinh do hoc van",
        "Chuyen nganh",
        "Nam tot nghiep",
        "Da hoc tieng Duc",
        "Trinh do tieng Duc",
        "San sang hoc tieng Duc",
        "Quan tam chuong trinh",
        "Nganh nghe mong muon",
        "Thoi gian du kien di Duc",
        "Kha nang tai chinh",
        "Kinh nghiem lam viec",
        "Cong viec hien tai",
        "Ban la ai",
        "SDT phu huynh",
        "Nguon biet den cong ty",
        "Noi dung can tu van",
        "Ngay tao",
      ];

      const rows = this.list.map((item) => [
        item.id,
        item.full_name,
        item.birth_date,
        item.gender,
        item.phone,
        item.email,
        item.province,
        item.education_level,
        item.major,
        item.graduation_year,
        item.learned_german,
        item.german_level,
        item.ready_to_learn_german,
        item.program_interest,
        item.desired_job,
        item.planned_departure_time,
        item.financial_capacity,
        item.work_experience,
        item.current_job,
        item.registrant_type,
        item.parent_phone,
        item.marketing_source,
        item.consultation_content,
        this.formatDate(item.created_at),
      ]);

      const csvContent = [headers, ...rows]
        .map((row) => row.map((col) => this.toCsvValue(col)).join(","))
        .join("\n");

      const blob = new Blob(["\uFEFF" + csvContent], {
        type: "text/csv;charset=utf-8;",
      });

      const link = document.createElement("a");
      const url = URL.createObjectURL(blob);
      const now = new Date();
      const timestamp = `${now.getFullYear()}${String(now.getMonth() + 1).padStart(2, "0")}${String(now.getDate()).padStart(2, "0")}_${String(now.getHours()).padStart(2, "0")}${String(now.getMinutes()).padStart(2, "0")}`;

      link.setAttribute("href", url);
      link.setAttribute("download", `customer-leads-${timestamp}.csv`);
      link.style.visibility = "hidden";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);
    },
  },
  mounted() {
    this.fetchCustomerLeads();
  },
};
</script>

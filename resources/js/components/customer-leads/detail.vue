<template>
  <div class="customer-lead-detail" v-if="lead">
    <div class="row">
      <div class="col-md-6" v-for="(item, index) in detailItems" :key="index">
        <p class="mb-2">
          <strong>{{ item.label }}:</strong>
          <span>{{ item.value }}</span>
        </p>
      </div>
      <div class="col-12">
        <p class="mb-0">
          <strong>Nội dung cần tư vấn:</strong>
          <span>{{ lead.consultation_content || "--" }}</span>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    lead: {
      type: Object,
      default: null,
    },
  },
  computed: {
    detailItems() {
      if (!this.lead) {
        return [];
      }

      return [
        { label: "Họ va tên", value: this.lead.full_name || "--" },
        { label: "Ngày sinh", value: this.lead.birth_date || "--" },
        { label: "Giới tính", value: this.lead.gender || "--" },
        { label: "Số điện thoại", value: this.lead.phone || "--" },
        { label: "Email", value: this.lead.email || "--" },
        { label: "Tỉnh/Thành phố", value: this.lead.province || "--" },
        { label: "Trình độ học vấn", value: this.lead.education_level || "--" },
        { label: "Chuyên ngành", value: this.lead.major || "--" },
        { label: "Năm tốt nghiệp", value: this.lead.graduation_year || "--" },
        { label: "Đã học tiếng Đức", value: this.lead.learned_german || "--" },
        { label: "Trình độ tiếng Đức", value: this.lead.german_level || "--" },
        { label: "Sẵn sàng học tiếng Đức", value: this.lead.ready_to_learn_german || "--" },
        { label: "Quan tâm chương trình", value: this.lead.program_interest || "--" },
        { label: "Ngành nghề mong muốn", value: this.lead.desired_job || "--" },
        { label: "Thời gian dự kiến đi Đức", value: this.lead.planned_departure_time || "--" },
        { label: "Khả năng tài chính", value: this.lead.financial_capacity || "--" },
        { label: "Kinh nghiệm làm việc", value: this.lead.work_experience || "--" },
        { label: "Công việc hiện tại", value: this.lead.current_job || "--" },
        { label: "Bạn là ai", value: this.lead.registrant_type || "--" },
        { label: "Số điện thoại phụ huynh", value: this.lead.parent_phone || "--" },
        { label: "Nguồn biết đến công ty", value: this.lead.marketing_source || "--" },
      ];
    },
  },
};
</script>

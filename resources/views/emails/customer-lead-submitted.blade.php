<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khách hàng mới đăng ký tư vấn</title>
</head>
<body>
    <h2>Có khách hàng mới đăng ký tư vấn</h2>
    <p><strong>Ho va tên:</strong> {{ $lead->full_name }}</p>
    <p><strong>Ngày sinh:</strong> {{ $lead->birth_date }}</p>
    <p><strong>Giới tính:</strong> {{ $lead->gender ?: 'Khong cung cap' }}</p>
    <p><strong>Số điện thoại:</strong> {{ $lead->phone }}</p>
    <p><strong>Email:</strong> {{ $lead->email ?: 'Khong cung cap' }}</p>
    <p><strong>Tỉnh/Thành phố:</strong> {{ $lead->province }}</p>
    <p><strong>Trình độ học vấn:</strong> {{ $lead->education_level }}</p>
    <p><strong>Chuyên ngành:</strong> {{ $lead->major ?: 'Khong cung cap' }}</p>
    <p><strong>Năm tốt nghiệp:</strong> {{ $lead->graduation_year ?: 'Khong cung cap' }}</p>
    <p><strong>Đã học tiếng Đức:</strong> {{ $lead->learned_german }}</p>
    <p><strong>Trình độ tiếng Đức:</strong> {{ $lead->german_level ?: 'Khong cung cap' }}</p>
    <p><strong>Sẵn sàng học tiếng Đức:</strong> {{ $lead->ready_to_learn_german }}</p>
    <p><strong>Quan tâm chương trình:</strong> {{ $lead->program_interest }}</p>
    <p><strong>Ngành nghề mong muốn:</strong> {{ $lead->desired_job }}</p>
    <p><strong>Thời gian dự kiến đi Đức:</strong> {{ $lead->planned_departure_time ?: 'Khong cung cap' }}</p>
    <p><strong>Khả năng tài chính:</strong> {{ $lead->financial_capacity ?: 'Khong cung cap' }}</p>
    <p><strong>Kinh nghiệm làm việc:</strong> {{ $lead->work_experience ?: 'Khong cung cap' }}</p>
    <p><strong>Công việc hiện tại:</strong> {{ $lead->current_job ?: 'Khong cung cap' }}</p>
    <p><strong>Ban la ai:</strong> {{ $lead->registrant_type ?: 'Khong cung cap' }}</p>
    <p><strong>Số điện thoại phụ huynh:</strong> {{ $lead->parent_phone ?: 'Khong cung cap' }}</p>
    <p><strong>Nguồn biết đến công ty:</strong> {{ $lead->marketing_source ?: 'Khong cung cap' }}</p>
    <p><strong>Nội dung cần tư vấn:</strong> {{ $lead->consultation_content ?: 'Khong cung cap' }}</p>
</body>
</html>

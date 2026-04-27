@extends('layouts.main.master')

@section('title')
Thu thap thong tin khach hang
@endsection

@section('css')
<style>
    .customer-lead-page {
        background: linear-gradient(180deg, #f5f8ff 0%, #ffffff 100%);
    }
    .customer-lead-card {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 18px 45px rgba(25, 42, 86, 0.12);
    }
    .customer-lead-card .card-body {
        padding: 34px;
    }
    .customer-lead-title {
        font-size: 30px;
        font-weight: 700;
        color: #15254b;
        margin-bottom: 8px;
    }
    .customer-lead-subtitle {
        margin-bottom: 24px;
        color: #5f6c84;
        font-size: 15px;
    }
    .customer-lead-page .form-label {
        font-weight: 600;
        color: #1f2f53;
        margin-bottom: 8px;
    }
    .customer-lead-page .form-control,
    .customer-lead-page .form-select {
        border: 1px solid #d6dfef;
        border-radius: 10px;
        height: 48px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s ease;
        background-color: #fff;
    }
    .customer-lead-page textarea.form-control {
        height: auto;
        min-height: 130px;
        padding-top: 12px;
    }
    .customer-lead-page .form-control:focus,
    .customer-lead-page .form-select:focus {
        border-color: #2f66f6;
        box-shadow: 0 0 0 0.2rem rgba(47, 102, 246, 0.12);
    }
    .customer-lead-page .text-danger {
        display: inline-block;
        margin-top: 6px;
        font-size: 13px;
    }
    .customer-lead-page .alert {
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
    }
    .customer-lead-page .theme-btn {
        border: 0;
        border-radius: 10px;
        min-width: 200px;
        height: 48px;
        font-weight: 600;
        font-size: 15px;
        box-shadow: 0 10px 24px rgba(215, 0, 24, 0.24);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .customer-lead-page .theme-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(215, 0, 24, 0.28);
    }
    @media (max-width: 991px) {
        .customer-lead-card .card-body {
            padding: 24px 18px;
        }
        .customer-lead-title {
            font-size: 24px;
        }
        .customer-lead-page .theme-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<main class="main py-80 customer-lead-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card customer-lead-card">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="customer-lead-title">Bảng thu thập thông tin khách hàng</h2>
                        <p class="customer-lead-subtitle">Vui lòng điền đầy đủ thông tin, đối ngũ tư vấn sẽ liên hệ với bạn trong thời gian sớm nhất.</p>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                Vui lòng kiểm tra lại thông tin đã nhập.
                            </div>
                        @endif

                        <form method="POST" action="{{ route('customer-leads.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Ho va tên *</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                                    @error('full_name')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ngày sinh *</label>
                                    <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Giới tính</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Chọn giới tính</option>
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Nam</option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Nu</option>
                                        <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Khac</option>
                                    </select>
                                    @error('gender')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Số điện thoại *</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                    @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tỉnh/Thành phố *</label>
                                    <input type="text" name="province" class="form-control" value="{{ old('province') }}" required>
                                    @error('province')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Trình độ học vấn *</label>
                                    <select name="education_level" class="form-select" required>
                                        <option value="">Chọn trình độ</option>
                                        <option value="THPT" {{ old('education_level') === 'THPT' ? 'selected' : '' }}>THPT</option>
                                        <option value="TC" {{ old('education_level') === 'TC' ? 'selected' : '' }}>TC</option>
                                        <option value="CD" {{ old('education_level') === 'CD' ? 'selected' : '' }}>CD</option>
                                        <option value="DH" {{ old('education_level') === 'DH' ? 'selected' : '' }}>DH</option>
                                    </select>
                                    @error('education_level')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Chuyên ngành</label>
                                    <input type="text" name="major" class="form-control" value="{{ old('major') }}">
                                    @error('major')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Năm tốt nghiệp</label>
                                    <input type="number" name="graduation_year" class="form-control" value="{{ old('graduation_year') }}" min="1950" max="2100">
                                    @error('graduation_year')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Đã học tiếng Đức chưa? *</label>
                                    <select name="learned_german" class="form-select" required>
                                        <option value="">Chon</option>
                                        <option value="yes" {{ old('learned_german') === 'yes' ? 'selected' : '' }}>Co</option>
                                        <option value="no" {{ old('learned_german') === 'no' ? 'selected' : '' }}>Chua</option>
                                    </select>
                                    @error('learned_german')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Trình độ tiếng Đức</label>
                                    <select name="german_level" class="form-select">
                                        <option value="">Chọn trình độ</option>
                                        <option value="A1" {{ old('german_level') === 'A1' ? 'selected' : '' }}>A1</option>
                                        <option value="A2" {{ old('german_level') === 'A2' ? 'selected' : '' }}>A2</option>
                                        <option value="B1" {{ old('german_level') === 'B1' ? 'selected' : '' }}>B1</option>
                                        <option value="B2" {{ old('german_level') === 'B2' ? 'selected' : '' }}>B2</option>
                                    </select>
                                    @error('german_level')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sẵn sàng học tiếng Đức *</label>
                                    <input type="text" name="ready_to_learn_german" class="form-control" value="{{ old('ready_to_learn_german') }}" required>
                                    @error('ready_to_learn_german')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Quan tâm chương trình *</label>
                                    <select name="program_interest" class="form-select" required>
                                        <option value="">Chọn chương trình</option>
                                        <option value="du-hoc-nghe" {{ old('program_interest') === 'du-hoc-nghe' ? 'selected' : '' }}>Du hoc nghe</option>
                                        <option value="xkld" {{ old('program_interest') === 'xkld' ? 'selected' : '' }}>XKLD</option>
                                    </select>
                                    @error('program_interest')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ngành nghề mong muốn *</label>
                                    <select name="desired_job" class="form-select" required>
                                        <option value="">Chọn ngành</option>
                                        <option value="nha-hang" {{ old('desired_job') === 'nha-hang' ? 'selected' : '' }}>Nha hang</option>
                                        <option value="khach-san" {{ old('desired_job') === 'khach-san' ? 'selected' : '' }}>Khach san</option>
                                    </select>
                                    @error('desired_job')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Thời gian dự kiến đi Đức</label>
                                    <input type="text" name="planned_departure_time" class="form-control" value="{{ old('planned_departure_time') }}">
                                    @error('planned_departure_time')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Khả năng tài chính</label>
                                    <input type="text" name="financial_capacity" class="form-control" value="{{ old('financial_capacity') }}">
                                    @error('financial_capacity')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kinh nghiệm làm việc</label>
                                    <input type="text" name="work_experience" class="form-control" value="{{ old('work_experience') }}">
                                    @error('work_experience')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Công việc hiện tại</label>
                                    <input type="text" name="current_job" class="form-control" value="{{ old('current_job') }}">
                                    @error('current_job')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Bạn là ai</label>
                                    <select name="registrant_type" class="form-select">
                                        <option value="">Chon</option>
                                        <option value="tot-nghiep-thpt" {{ old('registrant_type') === 'tot-nghiep-thpt' ? 'selected' : '' }}>Tot nghiep THPT</option>
                                        <option value="sinh-vien" {{ old('registrant_type') === 'sinh-vien' ? 'selected' : '' }}>Sinh vien</option>
                                        <option value="di-lam" {{ old('registrant_type') === 'di-lam' ? 'selected' : '' }}>Di lam</option>
                                    </select>
                                    @error('registrant_type')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Số điện thoại phụ huynh</label>
                                    <input type="text" name="parent_phone" class="form-control" value="{{ old('parent_phone') }}">
                                    @error('parent_phone')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nguồn biết đến công ty</label>
                                    <select name="marketing_source" class="form-select">
                                        <option value="">Chọn nguồn</option>
                                        <option value="quang-cao" {{ old('marketing_source') === 'quang-cao' ? 'selected' : '' }}>Quang cao</option>
                                        <option value="mang-xa-hoi" {{ old('marketing_source') === 'mang-xa-hoi' ? 'selected' : '' }}>Mang xa hoi</option>
                                        <option value="ban-be" {{ old('marketing_source') === 'ban-be' ? 'selected' : '' }}>Ban be</option>
                                        <option value="internet" {{ old('marketing_source') === 'internet' ? 'selected' : '' }}>Internet</option>
                                    </select>
                                    @error('marketing_source')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nội dung cần tư vấn</label>
                                    <textarea name="consultation_content" rows="4" class="form-control">{{ old('consultation_content') }}</textarea>
                                    @error('consultation_content')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="theme-btn">Gửi thông tin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

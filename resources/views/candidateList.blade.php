@extends('layouts.main.master')
@section('title')
Danh sách ứng viên
@endsection
@section('description')
Danh sách ứng viên
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<style>
    .candidate-card {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(12, 40, 70, .10);
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all .25s ease;
        border: 1px solid #eef3f8;
    }
    .candidate-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px rgba(12, 40, 70, .16);
    }
    .candidate-card .candidate-thumb {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .candidate-card .candidate-body {
        padding: 18px;
    }
    .candidate-card .candidate-name {
        font-size: 22px;
        margin-bottom: 12px;
        color: #0f2740;
        font-weight: 700;
    }
    .candidate-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }
    .candidate-badge {
        background: #eef5ff;
        color: #1e4d87;
        border-radius: 999px;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 600;
    }
    .candidate-meta {
        margin: 0;
        padding: 0;
        list-style: none;
        border-top: 1px dashed #dbe6f2;
        border-bottom: 1px dashed #dbe6f2;
        padding-top: 12px;
        padding-bottom: 4px;
    }
    .candidate-meta li {
        margin-bottom: 8px;
        font-size: 15px;
        color: #35506b;
    }
    .candidate-meta li strong {
        color: #0f2740;
        font-weight: 600;
        margin-right: 6px;
    }
    .candidate-card .btn-view-more {
        margin-top: 15px;
        border: none;
        background: linear-gradient(135deg, #0d6efd 0%, #0b57c7 100%);
        color: #fff;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
    }
    .candidate-modal .modal-content {
        border-radius: 16px;
    }
    .candidate-modal.is-open {
        display: block !important;
        background: rgba(0, 0, 0, .55);
    }
    .candidate-modal .modal-img {
        width: 100%;
        max-height: 340px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #edf1f7;
    }
    .candidate-modal .modal-graduate-img {
        width: 100%;
        max-height: 220px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #eee;
    }
    .candidate-modal .modal-meta {
        margin: 0;
        padding: 0;
        list-style: none;
        background: #f8fbff;
        padding: 14px;
        border-radius: 10px;
    }
    .candidate-modal .modal-meta li {
        margin-bottom: 8px;
    }
    .candidate-modal .modal-title {
        color: #0f2740;
        font-weight: 700;
    }
    .candidate-modal .profile-bio {
        margin-top: 14px;
        padding: 14px;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #edf1f7;
    }
    .candidate-modal .profile-bio strong {
        display: inline-block;
        margin-bottom: 8px;
        color: #0f2740;
    }
    .candidate-filter-wrap {
        background: #fff;
        border: 1px solid #e9eff6;
        box-shadow: 0 8px 24px rgba(15, 39, 64, .07);
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 24px;
    }
    .candidate-filter-wrap .filter-title {
        font-size: 14px;
        font-weight: 600;
        color: #1a3551;
        margin-bottom: 8px;
    }
    .candidate-filter-wrap .filter-controls {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .candidate-filter-wrap select {
        min-width: 250px;
        border: 1px solid #d8e3ef;
        border-radius: 10px;
        padding: 10px 12px;
    }
    .candidate-filter-wrap .filter-btn {
        border: none;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 600;
    }
    .candidate-filter-wrap .filter-btn.primary {
        background: #0d6efd;
        color: #fff;
    }
    .candidate-filter-wrap .filter-btn.light {
        background: #edf3fb;
        color: #2e4d6a;
    }
</style>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.bootstrap && window.bootstrap.Modal) {
            return;
        }

        const openButtons = document.querySelectorAll('[data-bs-target^="#candidateModal"]');
        openButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const target = button.getAttribute('data-bs-target');
                const modal = document.querySelector(target);
                if (modal) {
                    modal.classList.add('is-open');
                    modal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        document.querySelectorAll('.candidate-modal .btn-close').forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function () {
                const modal = closeBtn.closest('.candidate-modal');
                if (modal) {
                    modal.classList.remove('is-open');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            });
        });

        document.querySelectorAll('.candidate-modal').forEach(function (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.remove('is-open');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            });
        });
    });
</script>
@endsection
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">Danh sách ứng viên</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{route('home')}}">Trang chủ</a></li>
                <li class="active">Danh sách ứng viên</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    
    <div class="team-area py-100">
        <div class="container">
            <div class="candidate-filter-wrap">
                <div class="filter-title">Lọc theo ngành nghề</div>
                <form method="GET" action="{{ route('candidateList') }}" class="filter-controls">
                    <select name="category">
                        <option value="">Tất cả ngành nghề</option>
                        @foreach($candidateCategory as $cate)
                            <option value="{{ $cate->id }}" {{ (string)$selectedCategory === (string)$cate->id ? 'selected' : '' }}>
                                {{ $cate->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="filter-btn primary">Lọc dữ liệu</button>
                    <a href="{{ route('candidateList') }}" class="filter-btn light">Xóa lọc</a>
                </form>
            </div>
            <div class="row g-4">
                @foreach ($candidate as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="candidate-card wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img class="candidate-thumb" src="{{ url('' . $item->avatar) }}" alt="{{ $item->name }}">
                        </div>
                        <div class="candidate-body">
                            <h4 class="candidate-name">{{ $item->name }}</h4>
                            <div class="candidate-badges">
                                <span class="candidate-badge">{{ $item->german_level ?: 'Chưa có level' }}</span>
                                <span class="candidate-badge">{{ $item->category_name ?: 'Chưa phân ngành' }}</span>
                            </div>
                            <ul class="candidate-meta">
                                <li><strong>Tuổi:</strong> {{ $item->age ? $item->age . ' tuổi' : 'Đang cập nhật' }}</li>
                                <li><strong>Ngày sinh:</strong> {{ $item->birth_date ?: 'Đang cập nhật' }}</li>
                            </ul>
                            <button type="button" class="btn-view-more" data-bs-toggle="modal" data-bs-target="#candidateModal{{ $item->id }}">
                                Xem hồ sơ chi tiết
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade candidate-modal" id="candidateModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $item->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <img class="modal-img" src="{{ url('' . $item->avatar) }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="modal-meta">
                                            <li><strong>Tuổi:</strong> {{ $item->age ? $item->age . ' tuổi' : 'Đang cập nhật' }}</li>
                                            <li><strong>Ngày sinh:</strong> {{ $item->birth_date ?: 'Đang cập nhật' }}</li>
                                            <li><strong>Trình độ tiếng Đức:</strong> {{ $item->german_level ?: 'Đang cập nhật' }}</li>
                                            <li><strong>Ngành nghề:</strong> {{ $item->category_name ?: 'Đang cập nhật' }}</li>
                                        </ul>
                                        <div class="profile-bio">
                                            <strong>Short BIO:</strong>
                                            <div>{!! $item->short_bio ?: 'Đang cập nhật' !!}</div>
                                        </div>
                                        @if(!empty($item->video_url))
                                        <div class="mt-3">
                                            <a href="{{ $item->video_url }}" target="_blank" class="theme-btn">
                                                Xem video
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @if(!empty($item->graduation_image))
                                <div class="mt-3">
                                    <strong>Bằng tốt nghiệp:</strong>
                                    <img class="modal-graduate-img mt-2" src="{{ url('' . $item->graduation_image) }}" alt="Bang tot nghiep">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $candidate->links() }}
            </div>
        </div>
    </div>

</main>
@endsection
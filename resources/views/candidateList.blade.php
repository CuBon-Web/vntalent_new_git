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
        cursor: pointer;
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
    .candidate-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.3;
    }
    .candidate-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .candidate-status--yellow {
        background: #fff8e1;
        color: #8a6100;
    }
    .candidate-status--yellow .candidate-status-dot {
        background: #f5b301;
    }
    .candidate-status--green {
        background: #e7f8ee;
        color: #146c3a;
    }
    .candidate-status--green .candidate-status-dot {
        background: #22a55a;
    }
    .candidate-status--red {
        background: #fdecec;
        color: #a32020;
    }
    .candidate-status--red .candidate-status-dot {
        background: #dc3545;
    }
    .candidate-modal .candidate-status {
        margin-bottom: 10px;
    }
    .candidate-meta {
        margin: 0;
        padding: 0;
        list-style: none;
        border-top: 1px dashed #dbe6f2;
        border-bottom: 1px dashed #dbe6f2;
        padding-top: 8px;
        padding-bottom: 2px;
    }
    .detail-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
        padding: 4px 0;
        border: none;
        background: transparent;
        border-radius: 0;
    }
    .candidate-meta .detail-meta-item + .detail-meta-item {
        border-top: 1px dashed #e2ebf5;
    }
    .candidate-meta .detail-meta-icon {
        flex-shrink: 0;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: #eef5ff;
        color: #0d6efd;
        font-size: 12px;
    }
    .candidate-meta .detail-meta-body {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        gap: 4px;
        line-height: 1.3;
    }
    .candidate-meta .detail-meta-label {
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 600;
        color: #6b849e;
    }
    .candidate-meta .detail-meta-label::after {
        content: ':';
    }
    .candidate-meta .detail-meta-value {
        flex: 1;
        min-width: 0;
        font-size: 13px;
        font-weight: 600;
        color: #0f2740;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
        max-height: 235px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #edf1f7;
    }
    .graduate-cert-section {
        margin-top: 14px;
        padding: 12px 14px;
        background: linear-gradient(145deg, #f8fbff 0%, #fff 100%);
        border: 1px solid #e1eaf4;
        border-radius: 12px;
    }
    .graduate-cert-head {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #0f2740;
        margin-bottom: 10px;
    }
    .graduate-cert-head i {
        color: #0d6efd;
        font-size: 16px;
    }
    .graduate-cert-preview {
        display: block;
        width: 100%;
        padding: 0;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        cursor: zoom-in;
        background: #edf2f7;
        box-shadow: 0 2px 12px rgba(15, 39, 64, .08);
        transition: box-shadow .2s ease, transform .2s ease;
    }
    .graduate-cert-preview:hover {
        box-shadow: 0 6px 20px rgba(13, 110, 253, .18);
        transform: translateY(-1px);
    }
    .graduate-cert-preview:focus-visible {
        outline: 3px solid #0d6efd;
        outline-offset: 2px;
    }
    .graduate-cert-preview-frame {
        position: relative;
        display: block;
        line-height: 0;
    }
    .graduate-cert-thumb {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        vertical-align: middle;
    }
    .graduate-cert-shade {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 50%, rgba(15, 39, 64, .5) 100%);
        pointer-events: none;
        z-index: 1;
    }
    .graduate-cert-zoom {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .95);
        color: #0f2740;
        font-size: 12px;
        font-weight: 600;
        pointer-events: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .12);
    }
    .graduate-cert-zoom i {
        color: #0d6efd;
        font-size: 13px;
    }
    .other-docs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(132px, 1fr));
        gap: 10px;
    }
    .other-docs-grid .graduate-cert-thumb {
        max-height: 120px;
    }
    .other-docs-grid .graduate-cert-zoom {
        font-size: 11px;
        padding: 4px 8px;
    }
    .grad-fullscreen-overlay {
        position: fixed;
        inset: 0;
        z-index: 1090;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(8, 18, 32, .94);
        opacity: 0;
        visibility: hidden;
        transition: opacity .22s ease, visibility .22s ease;
    }
    .grad-fullscreen-overlay.is-visible {
        opacity: 1;
        visibility: visible;
    }
    .grad-fullscreen-close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        color: #fff;
        font-size: 26px;
        line-height: 1;
        cursor: pointer;
        z-index: 2;
        transition: background .2s ease;
    }
    .grad-fullscreen-close:hover {
        background: rgba(255, 255, 255, .22);
    }
    .grad-fullscreen-inner {
        position: relative;
        max-width: 100%;
        max-height: 100%;
    }
    .grad-fullscreen-inner img {
        display: block;
        max-width: calc(100vw - 40px);
        max-height: calc(100vh - 40px);
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 12px 48px rgba(0, 0, 0, .45);
    }
    .candidate-modal .modal-meta {
        margin: 0;
        padding: 10px 12px;
        list-style: none;
        background: #f8fbff;
        border-radius: 10px;
        border: 1px solid #e8eef5;
    }
    .candidate-modal .modal-meta .detail-meta-item {
        padding: 6px 0;
    }
    .candidate-modal .modal-meta .detail-meta-item + .detail-meta-item {
        border-top: 1px dashed #dbe6f2;
    }
    .candidate-modal .modal-meta .detail-meta-icon {
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #fff;
        border: 1px solid #e1eaf4;
        color: #0d6efd;
        font-size: 13px;
    }
    .candidate-modal .modal-meta .detail-meta-body {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        gap: 6px;
        line-height: 1.35;
    }
    .candidate-modal .modal-meta .detail-meta-label {
        flex-shrink: 0;
        font-size: 13px;
        font-weight: 600;
        color: #5a7390;
    }
    .candidate-modal .modal-meta .detail-meta-label::after {
        content: ':';
    }
    .candidate-modal .modal-meta .detail-meta-value {
        flex: 1;
        min-width: 0;
        font-size: 14px;
        font-weight: 600;
        color: #0f2740;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .candidate-modal .modal-title {
        color: #0f2740;
        font-weight: 700;
    }
    .candidate-modal .profile-bio {
        margin-top: 12px;
        padding: 14px;
        border-radius: 10px;
        background: #f8fbff;
        border: 1px solid #e8eef5;
    }
    .candidate-modal .profile-bio strong {
        display: inline-block;
        margin-bottom: 8px;
        color: #0f2740;
    }
    .candidate-modal .modal-section {
        margin-top: 14px;
    }
    .candidate-modal .modal-video-frame {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        border-radius: 10px;
        overflow: hidden;
        background: #000;
    }
    .candidate-modal .modal-video-frame iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    .candidate-filter-wrap {
        background: linear-gradient(180deg, #f8fbff 0%, #fff 40%);
        border: 1px solid #e1eaf4;
        box-shadow: 0 6px 20px rgba(15, 39, 64, .06);
        border-radius: 16px;
        padding: 18px 20px;
        margin-bottom: 28px;
    }
    .candidate-filter-wrap .filter-toolbar-head {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e8eef5;
    }
    .candidate-filter-wrap .filter-title {
        font-size: 17px;
        font-weight: 700;
        color: #0f2740;
        margin: 0 0 4px 0;
        letter-spacing: -0.02em;
    }
    .candidate-filter-wrap .filter-hint {
        font-size: 13px;
        color: #5a7390;
        margin: 0;
        max-width: 36rem;
        line-height: 1.45;
    }
    .candidate-filter-wrap .filter-reset-btn {
        flex-shrink: 0;
        border: 1px solid #d0dce8;
        background: #fff;
        color: #2e4d6a;
        border-radius: 10px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, border-color .2s;
    }
    .candidate-filter-wrap .filter-reset-btn:hover {
        background: #f0f5fb;
        border-color: #b8cadb;
    }
    .candidate-filter-toolbar-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }
    @media (min-width: 992px) {
        .candidate-filter-toolbar-grid {
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.55fr) minmax(0, 0.9fr) minmax(0, 0.45fr) minmax(0, 0.9fr);
            gap: 16px 20px;
            align-items: start;
        }
    }
    .candidate-filter-wrap .filter-block-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #6b849e;
        margin-bottom: 8px;
    }
    .candidate-filter-wrap .filter-select {
        width: 100%;
        max-width: 100%;
        border: 1px solid #d8e3ef;
        border-radius: 10px;
        padding: 9px 12px;
        font-size: 14px;
        background: #fff;
        color: #0f2740;
    }
    .candidate-filter-wrap .filter-select-multiple {
        height: 44px;
        overflow: hidden;
    }
    .candidate-filter-wrap .filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .candidate-filter-wrap .filter-chip {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        user-select: none;
        margin: 0;
    }
    .candidate-filter-wrap .filter-chip input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .candidate-filter-wrap .filter-chip span {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        color: #35506b;
        background: #fff;
        border: 1px solid #d8e3ef;
        transition: background .15s, color .15s, border-color .15s, box-shadow .15s;
    }
    .candidate-filter-wrap .filter-chip input:focus-visible + span {
        outline: 2px solid #0d6efd;
        outline-offset: 2px;
    }
    .candidate-filter-wrap .filter-chip input:checked + span {
        background: linear-gradient(135deg, #0d6efd 0%, #0b57c7 100%);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 2px 8px rgba(13, 110, 253, .25);
    }
    .candidate-filter-wrap .filter-chip:hover span {
        border-color: #9db4cc;
    }
    #candidate-pagination {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .candidate-pagination-nav .cp-list {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin: 0;
        padding: 6px;
        list-style: none;
        background: #fff;
        border: 1px solid #e6eef7;
        border-radius: 999px;
        box-shadow: 0 8px 24px rgba(12, 40, 70, .08);
    }
    .candidate-pagination-nav .cp-item {
        margin: 0;
    }
    .candidate-pagination-nav .cp-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        color: #35506b;
        background: transparent;
        text-decoration: none;
        transition: background .2s ease, color .2s ease, box-shadow .2s ease, transform .2s ease;
    }
    .candidate-pagination-nav a.cp-link:hover {
        background: #eef5ff;
        color: #0d6efd;
        transform: translateY(-1px);
    }
    .candidate-pagination-nav a.cp-link:focus-visible {
        outline: 2px solid #0d6efd;
        outline-offset: 2px;
    }
    .candidate-pagination-nav .cp-link.is-active {
        background: linear-gradient(135deg, #0d6efd 0%, #0b57c7 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, .3);
    }
    .candidate-pagination-nav .cp-arrow {
        color: #0d6efd;
        background: #f3f7fc;
        font-size: 12px;
    }
    .candidate-pagination-nav .cp-link.is-disabled {
        color: #b7c6d6;
        background: #f6f8fb;
        cursor: not-allowed;
    }
    .candidate-pagination-nav .cp-ellipsis {
        display: inline-flex;
        align-items: flex-end;
        justify-content: center;
        min-width: 24px;
        height: 40px;
        padding-bottom: 8px;
        color: #8aa0b6;
        font-weight: 700;
        letter-spacing: 1px;
    }
    #candidate-pagination .cp-summary {
        margin: 0;
        font-size: 13px;
        color: #6b849e;
        text-align: center;
    }
    #candidate-pagination .cp-summary strong {
        color: #0f2740;
    }
    @media (max-width: 575.98px) {
        .candidate-pagination-nav .cp-list {
            border-radius: 16px;
            gap: 4px;
        }
        .candidate-pagination-nav .cp-link {
            min-width: 34px;
            height: 34px;
            padding: 0 8px;
            font-size: 13px;
        }
        .candidate-pagination-nav .cp-ellipsis {
            height: 34px;
            min-width: 16px;
        }
    }
</style>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dataUrl = @json(route('candidateList.data'));

        function escapeHtml(s) {
            if (s == null || s === '') return '';
            return String(s)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        function genderLabel(g) {
            if (g == 1 || g === '1') return 'männlich';
            if (g == 2 || g === '2') return 'weiblich';
            return 'Aktualisierung';
        }

        var PROFILE_STATUSES = {
            1: { label: 'Lernt Deutsch', color: 'yellow' },
            2: { label: 'Wartet auf Dokumente', color: 'yellow' },
            3: { label: 'Bereit für Gespräche', color: 'green' },
            4: { label: 'Bereits im Visaverfahren', color: 'red' }
        };

        function profileStatusBadge(s) {
            var st = PROFILE_STATUSES[s];
            if (!st) return '';
            return '<span class="candidate-status candidate-status--' + st.color + '"><span class="candidate-status-dot" aria-hidden="true"></span>' + escapeHtml(st.label) + '</span>';
        }

        /** Một dòng meta có icon (valueEscaped đã escape nếu cần) */
        function detailMetaItem(iconClass, label, valueEscaped) {
            return '<li class="detail-meta-item"><span class="detail-meta-icon"><i class="' + iconClass + '" aria-hidden="true"></i></span><div class="detail-meta-body"><span class="detail-meta-label">' + escapeHtml(label) + '</span><span class="detail-meta-value">' + valueEscaped + '</span></div></li>';
        }

        /** API/DB thường là Y-m-d; hiển thị d/m/Y */
        function formatBirthDateDMY(raw) {
            if (raw == null || raw === '') return null;
            var s = String(raw).trim();
            var m = s.match(/^(\d{4})-(\d{2})-(\d{2})/);
            if (m) {
                var d = parseInt(m[3], 10), mo = parseInt(m[2], 10), y = m[1];
                if (d >= 1 && d <= 31 && mo >= 1 && mo <= 12) {
                    return String(d).padStart(2, '0') + '/' + String(mo).padStart(2, '0') + '/' + y;
                }
            }
            m = s.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
            if (m) {
                return String(parseInt(m[1], 10)).padStart(2, '0') + '/' + String(parseInt(m[2], 10)).padStart(2, '0') + '/' + m[3];
            }
            return s;
        }

        /** other_documents: JSON string hoặc mảng URL; chỉ trả về chuỗi URL không rỗng */
        function parseOtherDocuments(raw) {
            if (raw == null || raw === '') return [];
            var arr = [];
            if (Array.isArray(raw)) {
                arr = raw;
            } else if (typeof raw === 'string') {
                var t = raw.trim();
                if (!t) return [];
                try {
                    var p = JSON.parse(t);
                    arr = Array.isArray(p) ? p : [];
                } catch (err) {
                    return [];
                }
            } else {
                return [];
            }
            return arr.filter(function (u) {
                return u && typeof u === 'string' && String(u).trim() !== '';
            }).map(function (u) { return String(u).trim(); });
        }

        function getYoutubeVideoId(urlStr) {
            try {
                var u = new URL(urlStr);
                var host = (u.hostname || '').replace(/^www\./, '').toLowerCase();
                if (host === 'youtube.com' || host === 'm.youtube.com') {
                    if (u.pathname === '/watch') return u.searchParams.get('v');
                    if (u.pathname.indexOf('/shorts/') === 0) return u.pathname.split('/')[2] || '';
                    if (u.pathname.indexOf('/embed/') === 0) return u.pathname.split('/')[2] || '';
                }
                if (host === 'youtu.be') return u.pathname.replace(/^\/+/, '').split('/')[0] || '';
            } catch (e) {
                return '';
            }
            return '';
        }

        function normalizeVideoEmbedUrl(urlStr) {
            if (!urlStr) return '';
            var s = String(urlStr).trim();
            var videoId = getYoutubeVideoId(s);
            if (videoId) return 'https://www.youtube.com/embed/' + encodeURIComponent(videoId);
            return s;
        }

        function openModalByTarget(target) {
            var modal = document.querySelector(target);
            if (!modal) return;
            if (window.bootstrap && window.bootstrap.Modal) {
                var instance = window.bootstrap.Modal.getOrCreateInstance(modal);
                instance.show();
                return;
            }
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        /** Nạp lại iframe để dừng video (áp dụng cho mọi nguồn, không cần YouTube JS API) */
        function stopModalVideos(modal) {
            if (!modal) return;
            modal.querySelectorAll('.modal-video-frame iframe').forEach(function (frame) {
                var src = frame.getAttribute('src');
                if (!src) return;
                frame.setAttribute('src', 'about:blank');
                frame.setAttribute('src', src);
            });
        }

        document.addEventListener('hide.bs.modal', function (e) {
            if (e.target && e.target.classList && e.target.classList.contains('candidate-modal')) {
                stopModalVideos(e.target);
            }
        });

        function closeModal(modal) {
            if (!modal) return;
            stopModalVideos(modal);
            if (window.bootstrap && window.bootstrap.Modal) {
                var instance = window.bootstrap.Modal.getInstance(modal);
                if (instance) instance.hide();
                return;
            }
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        document.addEventListener('click', function (e) {
            var openBtn = e.target.closest('.js-open-candidate-modal');
            if (openBtn) {
                e.preventDefault();
                var target = openBtn.getAttribute('data-bs-target');
                if (target) openModalByTarget(target);
                return;
            }
            var card = e.target.closest('.js-candidate-card');
            if (card && grid && grid.contains(card)) {
                var targetCard = card.getAttribute('data-bs-target');
                if (targetCard) {
                    e.preventDefault();
                    openModalByTarget(targetCard);
                }
                return;
            }
            var gradOpen = e.target.closest('.js-open-grad-lightbox');
            if (gradOpen) {
                e.preventDefault();
                e.stopPropagation();
                var oid = gradOpen.getAttribute('data-grad-overlay');
                var ov = oid && document.getElementById(oid);
                if (ov) {
                    ov.classList.add('is-visible');
                    ov.setAttribute('aria-hidden', 'false');
                }
                return;
            }
            var gradClose = e.target.closest('.js-close-grad-lightbox');
            if (gradClose) {
                e.preventDefault();
                e.stopPropagation();
                var go = gradClose.closest('.grad-fullscreen-overlay');
                if (go) {
                    go.classList.remove('is-visible');
                    go.setAttribute('aria-hidden', 'true');
                }
                return;
            }
            if (e.target.classList.contains('grad-fullscreen-overlay')) {
                e.preventDefault();
                e.target.classList.remove('is-visible');
                e.target.setAttribute('aria-hidden', 'true');
                return;
            }
            var closeBtn = e.target.closest('.candidate-modal .btn-close');
            if (closeBtn) {
                e.preventDefault();
                closeModal(closeBtn.closest('.candidate-modal'));
                return;
            }
            var modal = e.target.closest('.candidate-modal');
            if (modal && e.target === modal) {
                closeModal(modal);
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            var open = document.querySelector('.grad-fullscreen-overlay.is-visible');
            if (!open) return;
            e.preventDefault();
            e.stopImmediatePropagation();
            open.classList.remove('is-visible');
            open.setAttribute('aria-hidden', 'true');
        }, true);

        var grid = document.getElementById('candidate-grid');
        var loadingEl = document.getElementById('candidate-loading');
        var paginationEl = document.getElementById('candidate-pagination');
        var filterWrap = document.querySelector('.candidate-filter-wrap');
        var filterAge = document.getElementById('filter-age');
        var filterGender = document.getElementById('filter-gender');
        var filterProfileStatus = document.getElementById('filter-profile-status');
        var currentPage = 1;
        var loadTimer = null;

        function checkedValues(selector) {
            return Array.prototype.map.call(
                document.querySelectorAll(selector),
                function (el) { return el.value; }
            );
        }

        function buildQueryParams(page) {
            var params = new URLSearchParams();
            params.set('page', page || 1);
            checkedValues('.js-filter-category option:checked').forEach(function (v) {
                if (v) params.append('category[]', v);
            });
            if (filterAge && filterAge.value) params.set('age_range', filterAge.value);
            checkedValues('.js-filter-german option:checked').forEach(function (v) {
                if (v) params.append('german_level[]', v);
            });
            if (filterGender && filterGender.value) params.set('gender', filterGender.value);
            if (filterProfileStatus && filterProfileStatus.value) params.set('profile_status', filterProfileStatus.value);
            return params.toString();
        }

        function renderPagination(meta, links) {
            if (!paginationEl) return;
            if (!meta || meta.last_page <= 1) {
                paginationEl.innerHTML = meta && meta.total ? '<p class="cp-summary">Gesamt <strong>' + meta.total + '</strong> Bewerber</p>' : '';
                return;
            }
            var cur = meta.current_page;
            var last = meta.last_page;

            function pageBtn(p, label, extraClass, ariaLabel) {
                return '<li class="cp-item"><a class="cp-link js-candidate-page' + (extraClass ? ' ' + extraClass : '') + '" href="#" data-page="' + p + '"' + (ariaLabel ? ' aria-label="' + ariaLabel + '"' : '') + '>' + label + '</a></li>';
            }

            var pages = [1];
            for (var p = Math.max(2, cur - 1); p <= Math.min(last - 1, cur + 1); p++) pages.push(p);
            if (last > 1) pages.push(last);

            var html = '<nav class="candidate-pagination-nav" aria-label="Seitennavigation"><ul class="cp-list">';
            html += links.prev_url
                ? pageBtn(cur - 1, '<i class="fas fa-chevron-left" aria-hidden="true"></i>', 'cp-arrow', 'Vorherige Seite')
                : '<li class="cp-item"><span class="cp-link cp-arrow is-disabled" aria-hidden="true"><i class="fas fa-chevron-left"></i></span></li>';
            var prevShown = 0;
            pages.forEach(function (pg) {
                if (pg - prevShown > 1) html += '<li class="cp-item"><span class="cp-ellipsis">…</span></li>';
                html += pg === cur
                    ? '<li class="cp-item"><span class="cp-link is-active" aria-current="page">' + pg + '</span></li>'
                    : pageBtn(pg, pg, '', 'Seite ' + pg);
                prevShown = pg;
            });
            html += links.next_url
                ? pageBtn(cur + 1, '<i class="fas fa-chevron-right" aria-hidden="true"></i>', 'cp-arrow', 'Nächste Seite')
                : '<li class="cp-item"><span class="cp-link cp-arrow is-disabled" aria-hidden="true"><i class="fas fa-chevron-right"></i></span></li>';
            html += '</ul></nav>';
            html += '<p class="cp-summary">Anzeigen <strong>' + (meta.from || 0) + '–' + (meta.to || 0) + '</strong> von <strong>' + meta.total + '</strong> Bewerbern</p>';
            paginationEl.innerHTML = html;
        }

        function renderCard(item) {
            var name = escapeHtml(item.name);
            var level = escapeHtml(item.german_level || 'Noch kein Level');
            var cate = escapeHtml(item.category_name || 'Noch kein Berufsbereich');
            var age = item.age ? (escapeHtml(String(item.age))) : 'Aktualisierung';
            var birthFmt = formatBirthDateDMY(item.birth_date);
            var birth = birthFmt == null ? 'Aktualisierung' : escapeHtml(birthFmt);
            var gen = genderLabel(item.gender);
            var avatar = escapeHtml(item.avatar || '/frontend/img/blank-profile-picture.png');
            var grad = item.graduation_image ? escapeHtml(item.graduation_image) : '';
            var otherDocUrls = parseOtherDocuments(item.other_documents);
            var rawVideo = item.video_url ? String(item.video_url).trim() : '';
            var video = rawVideo ? escapeHtml(rawVideo) : '';
            var videoEmbed = rawVideo ? escapeHtml(normalizeVideoEmbedUrl(rawVideo)) : '';
            var bio = item.short_bio || '';
            var statusBadge = profileStatusBadge(item.profile_status);
            var id = item.id;

            var html = '';
            
            html += '<div class="col-md-6 col-lg-4 mb-4">';
            html += '<div class="candidate-card js-candidate-card wow fadeInUp" data-wow-delay=".25s" data-bs-target="#candidateModal' + id + '" title="Profil anschauen">';
            html += '<div class="team-img"><img class="candidate-thumb" src="' + avatar + '" alt="' + name + '"></div>';
            html += '<div class="candidate-body">';
            html += '<h4 class="candidate-name">' + name + '</h4>';
            html += statusBadge;
            // html += '<div class="candidate-badges">';
            // html += '<span class="candidate-badge">' + level + '</span>';
            // html += '<span class="candidate-badge">' + cate + '</span>';
            // html += '</div>';
            html += '<ul class="candidate-meta">';
            html += detailMetaItem('fas fa-briefcase', 'Beruf', cate);
            html += detailMetaItem('fas fa-language', 'Deutschkenntnisse', level);
            html += detailMetaItem('fas fa-venus-mars', 'Geschlecht', escapeHtml(gen));
            html += detailMetaItem('fas fa-hourglass-half', 'Alter', age);
            html += detailMetaItem('far fa-calendar', 'Geburtsdatum', birth);
            html += '</ul>';
            html += '<button type="button" class="btn-view-more js-open-candidate-modal" data-bs-toggle="modal" data-bs-target="#candidateModal' + id + '">Profil anschauen</button>';
            html += '</div></div></div>';

            html += '<div class="modal fade candidate-modal" id="candidateModal' + id + '" tabindex="-1" aria-hidden="true">';
            html += '<div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content">';
            html += '<div class="modal-header"><h5 class="modal-title">' + name + '</h5>';
            html += '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
            html += '<div class="modal-body"><div class="row g-3 align-items-start">';
            html += '<div class="col-md-4"><img class="modal-img" src="' + avatar + '" alt="' + name + '"></div>';
            html += '<div class="col-md-8">' + statusBadge + '<ul class="modal-meta">';
            html += detailMetaItem('fas fa-venus-mars', 'Geschlecht', escapeHtml(gen));
            html += detailMetaItem('fas fa-hourglass-half', 'Alter', age);
            html += detailMetaItem('far fa-calendar', 'Geburtsdatum', birth);
            html += detailMetaItem('fas fa-language', 'Deutschkenntnisse', level);
            html += detailMetaItem('fas fa-briefcase', 'Beruf', cate);
            html += '</ul>';
            
            html += '</div></div>';
            html += '<div class="profile-bio"><strong>Short BIO:</strong><div class="js-candidate-bio" data-candidate-bio="' + id + '"></div></div>';
            if (videoEmbed) {
                html += '<div class="modal-section">';
                html += '<div class="modal-video-frame">';
                html += '<iframe src="' + videoEmbed + '" title="Video ứng viên" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>';
                html += '</div>';
                html += '<a href="' + video + '" target="_blank" rel="noopener noreferrer" class="d-inline-block mt-2 small">Video in neuem Tab öffnen</a>';
                html += '</div>';
            }
            if (grad) {
                html += '<div class="graduate-cert-section modal-section">';
                html += '<div class="graduate-cert-head"><i class="fas fa-award" aria-hidden="true"></i><span>Abschlüsse & Berufsqualifikations</span></div>';
                html += '<button type="button" class="graduate-cert-preview js-open-grad-lightbox" data-grad-overlay="gradOverlay' + id + '" aria-label="Originalbild ansehen">';
                html += '<span class="graduate-cert-preview-frame">';
                html += '<img class="graduate-cert-thumb" src="' + grad + '" alt="">';
                html += '<span class="graduate-cert-shade" aria-hidden="true"></span>';
                html += '<span class="graduate-cert-zoom"><i class="fas fa-search-plus" aria-hidden="true"></i> Originalbild ansehen</span>';
                html += '</span></button>';
                html += '</div>';
            }
            if (otherDocUrls.length) {
                html += '<div class="other-docs-section modal-section graduate-cert-section">';
                html += '<div class="graduate-cert-head"><i class="fas fa-images" aria-hidden="true"></i><span>Andere Dokumente</span></div>';
                html += '<div class="other-docs-grid">';
                otherDocUrls.forEach(function (docUrl, idx) {
                    var escUrl = escapeHtml(docUrl);
                    var overlayId = 'otherDocOverlay' + id + '_' + idx;
                    html += '<button type="button" class="graduate-cert-preview js-open-grad-lightbox" data-grad-overlay="' + overlayId + '" aria-label="Xem ảnh lớn">';
                    html += '<span class="graduate-cert-preview-frame">';
                    html += '<img class="graduate-cert-thumb" src="' + escUrl + '" alt="">';
                    html += '<span class="graduate-cert-shade" aria-hidden="true"></span>';
                    html += '<span class="graduate-cert-zoom"><i class="fas fa-search-plus" aria-hidden="true"></i></span>';
                    html += '</span></button>';
                });
                html += '</div></div>';
            }
            html += '</div></div></div></div>';
            if (grad) {
                html += '<div class="grad-fullscreen-overlay" id="gradOverlay' + id + '" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Originalbild">';
                html += '<button type="button" class="grad-fullscreen-close js-close-grad-lightbox" aria-label="Schließen">&times;</button>';
                html += '<div class="grad-fullscreen-inner"><img src="' + grad + '" alt="Originalbild"></div>';
                html += '</div>';
            }
            otherDocUrls.forEach(function (docUrl, idx) {
                var escUrl = escapeHtml(docUrl);
                var overlayId = 'otherDocOverlay' + id + '_' + idx;
                html += '<div class="grad-fullscreen-overlay" id="' + overlayId + '" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Ảnh giấy tờ">';
                html += '<button type="button" class="grad-fullscreen-close js-close-grad-lightbox" aria-label="Đóng">&times;</button>';
                html += '<div class="grad-fullscreen-inner"><img src="' + escUrl + '" alt=""></div>';
                html += '</div>';
            });

            return { html: html, bio: bio, id: id };
        }

        function loadCandidates(page) {
            var pageNum = page != null ? page : currentPage;
            if (loadingEl) loadingEl.style.display = 'block';
            if (grid) grid.innerHTML = '';
            var url = dataUrl + '?' + buildQueryParams(pageNum);
            fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
                .then(function (r) { return r.json(); })
                .then(function (json) {
                    if (loadingEl) loadingEl.style.display = 'none';
                    currentPage = json.pagination ? json.pagination.current_page : 1;
                    var parts = [];
                    var bios = [];
                    (json.data || []).forEach(function (item) {
                        var rendered = renderCard(item);
                        parts.push(rendered.html);
                        bios.push({ id: rendered.id, html: rendered.bio });
                    });
                    if (!json.data || !json.data.length) {
                        if (grid) grid.innerHTML = '<div class="col-12 text-center py-5 text-muted">Es gibt keine entsprechenden Bewerber</div>';
                    } else if (grid) {
                        grid.innerHTML = parts.join('');
                        bios.forEach(function (b) {
                            var el = grid.querySelector('.js-candidate-bio[data-candidate-bio="' + b.id + '"]');
                            if (el) el.innerHTML = b.html;
                        });
                    }
                    renderPagination(json.pagination, json.links || {});
                })
                .catch(function () {
                    if (loadingEl) loadingEl.style.display = 'none';
                    if (grid) grid.innerHTML = '<div class="col-12 text-center py-5 text-danger">Es gibt keine entsprechenden Bewerber</div>';
                    if (paginationEl) paginationEl.innerHTML = '';
                });
        }

        function scheduleLoad(resetPage) {
            if (resetPage) currentPage = 1;
            clearTimeout(loadTimer);
            loadTimer = setTimeout(function () { loadCandidates(currentPage); }, 350);
        }

        if (filterWrap) {
            filterWrap.addEventListener('change', function (e) {
                if (e.target && (e.target.classList.contains('js-filter-category') || e.target.classList.contains('js-filter-german') || e.target.id === 'filter-age' || e.target.id === 'filter-gender' || e.target.id === 'filter-profile-status')) {
                    scheduleLoad(true);
                }
            });
        }

        var resetBtn = document.getElementById('candidate-filter-reset');
        if (resetBtn) resetBtn.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.js-filter-category option:checked').forEach(function (el) {
                el.selected = false;
            });
            document.querySelectorAll('.js-filter-german option:checked').forEach(function (el) {
                el.selected = false;
            });
            if (filterAge) filterAge.value = '';
            if (filterGender) filterGender.value = '';
            if (filterProfileStatus) filterProfileStatus.value = '';
            scheduleLoad(true);
        });

        document.addEventListener('click', function (e) {
            var pageLink = e.target.closest('.js-candidate-page');
            if (!pageLink || !paginationEl || !paginationEl.contains(pageLink)) return;
            e.preventDefault();
            var p = parseInt(pageLink.getAttribute('data-page'), 10);
            if (!isNaN(p)) {
                currentPage = p;
                loadCandidates(p);
                var top = (filterWrap || grid);
                if (top) top.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });

        scheduleLoad(true);
    });
</script>
@endsection
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">Bewerberliste</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{route('home')}}">Home</a></li>
                <li class="active">Bewerberliste</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    
    <div class="team-area py-100">
        <div class="container">
            <div class="candidate-filter-wrap">
                <div class="filter-toolbar-head">
                    <div>
                        <div class="filter-title">Bewerberfilter</div>
                    </div>
                    {{-- <button type="button" id="candidate-filter-reset" class="filter-reset-btn">Filter</button> --}}
                </div>
                <div class="candidate-filter-toolbar-grid">
                    <div class="filter-block">
                        <span class="filter-block-label">Beruf</span>
                        <select id="filter-category" name="category[]" class="filter-select filter-select-multiple js-filter-category" multiple size="1" title="Halten Sie die Strg-Taste (oder Cmd) gedrückt, um mehrere Berufsbereiche auszuwählen" aria-label="Filter Berufsbereiche">
                            @foreach($candidateCategory as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-block">
                        <span class="filter-block-label">Alter</span>
                        <select id="filter-age" name="age_range" class="filter-select">
                            <option value="">Alle Altersgruppen</option>
                            <option value="18-22">18–22</option>
                            <option value="23-27">23–27</option>
                            <option value="28-32">28–32</option>
                            <option value="32-36">32–36</option>
                            <option value="37+">37+</option>
                        </select>
                    </div>
                    <div class="filter-block">
                        <span class="filter-block-label">Deutschkenntnisse</span>
                        <select id="filter-german" name="german_level[]" class="filter-select filter-select-multiple js-filter-german" multiple size="1" title="Halten Sie die Strg-Taste (oder Cmd) gedrückt, um mehrere Niveaus auszuwählen" aria-label="Filter Deutschkenntnisse">
                            @foreach(['Keine Deutschkenntnisse','A1','A2','B1','B2','C1','C2'] as $lvl)
                                <option value="{{ $lvl }}">{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-block">
                        <span class="filter-block-label">Geschlecht</span>
                        <select id="filter-gender" name="gender" class="filter-select">
                            <option value="">Alle</option>
                            <option value="1">männlich</option>
                            <option value="2">weiblich</option>
                        </select>
                    </div>
                    <div class="filter-block">
                        <span class="filter-block-label">Profilstatus</span>
                        <select id="filter-profile-status" name="profile_status" class="filter-select" aria-label="Filter Profilstatus">
                            <option value="">Alle</option>
                            <option value="1">🟡 Lernt Deutsch</option>
                            <option value="2">🟡 Wartet auf Dokumente</option>
                            <option value="3">🟢 Bereit für Gespräche</option>
                            <option value="4">🔴 Bereits im Visaverfahren</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="candidate-loading" class="text-center py-4 text-muted">Liste der Bewerber wird geladen…</div>
            <div id="candidate-grid" class="row g-4"></div>
            <div id="candidate-pagination" class="mt-4"></div>
        </div>
    </div>

</main>
@endsection

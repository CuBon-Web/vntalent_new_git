/**
 * Giảm thao tác sao chép nội dung trang (không thể chặn hoàn toàn).
 * Cho phép: input, textarea, select, contenteditable, vùng .allow-copy
 */
(function () {
  'use strict';

  function isCopyAllowed(el) {
    if (!el || typeof el.closest !== 'function') return false;
    if (el.closest('.allow-copy')) return true;
    var tag = el.tagName;
    if (tag === 'INPUT' || tag === 'TEXTAREA' || tag === 'SELECT' || tag === 'OPTION') return true;
    if (el.isContentEditable) return true;
    return false;
  }

  function onContextMenu(e) {
    if (isCopyAllowed(e.target)) return;
    e.preventDefault();
  }

  function onCopyCut(e) {
    if (isCopyAllowed(e.target)) return;
    e.preventDefault();
  }

  function onKeyDown(e) {
    var el = e.target;
    if (isCopyAllowed(el)) return;
    if (!(e.ctrlKey || e.metaKey)) return;
    var k = (e.key || '').toLowerCase();
    if (k === 'c' || k === 'x' || k === 'a' || k === 'u') {
      e.preventDefault();
    }
  }

  function onDragStart(e) {
    if (isCopyAllowed(e.target)) return;
    var tag = e.target && e.target.tagName;
    if (tag === 'IMG') e.preventDefault();
  }

  function init() {
    document.addEventListener('contextmenu', onContextMenu, false);
    document.addEventListener('copy', onCopyCut, false);
    document.addEventListener('cut', onCopyCut, false);
    document.addEventListener('keydown', onKeyDown, false);
    document.addEventListener('dragstart', onDragStart, false);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

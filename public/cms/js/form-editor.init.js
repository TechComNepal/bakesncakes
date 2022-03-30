/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************************!*\
  !*** ./resources/assets/cms/assets/js/pages/form-editor.init.js ***!
  \******************************************************************/
ClassicEditor.create(document.querySelector("#ckeditor-classic")).then(function (e) {
  e.ui.view.editable.element.style.height = "200px";
})["catch"](function (e) {
  console.error(e);
});
/******/ })()
;
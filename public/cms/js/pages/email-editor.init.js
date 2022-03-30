/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/assets/js/pages/email-editor.init.js ***!
  \********************************************************/
ClassicEditor.create(document.querySelector("#email-editor")).then(function (e) {
  e.ui.view.editable.element.style.height = "200px";
})["catch"](function (e) {
  console.error(e);
});
/******/ })()
;
if (document.querySelectorAll("[toast-list]").length || document.querySelectorAll("[data-choices]").length || document.querySelectorAll("[data-provider]").length) {
  document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'><\/script>");
  document.writeln("<script type='text/javascript' src='assets/libs/choices.js/public/assets/scripts/choices.min.js'><\/script>");
  document.writeln("<script type='text/javascript' src='assets/libs/flatpickr/flatpickr.min.js'><\/script>");
}